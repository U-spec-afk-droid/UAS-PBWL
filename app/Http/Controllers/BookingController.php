<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking
     */
    public function create()
    {
        try {
            // Ambil semua ruangan yang tersedia
            $ruangans = Ruangan::where('status', 'tersedia')->get();
            
            return view('bookingclass', compact('ruangans'));
            
        } catch (\Exception $e) {
            Log::error('Error in create method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form booking.');
        }
    }

    /**
     * Menyimpan booking baru
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'ruangan_id' => 'required|exists:ruangans,id',
                'nama_kegiatan' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                'jumlah_peserta' => 'required|integer|min:1',
                'keterangan' => 'nullable|string|max:500',
            ]);

            // Cek apakah ruangan masih tersedia
            $ruangan = Ruangan::findOrFail($validated['ruangan_id']);
            
            if ($ruangan->status !== 'tersedia') {
                return back()
                    ->withInput()
                    ->with('error', 'Ruangan tidak tersedia untuk booking!');
            }

            // Cek kapasitas ruangan
            if ($validated['jumlah_peserta'] > $ruangan->kapasitas) {
                return back()
                    ->withInput()
                    ->with('error', 'Jumlah peserta melebihi kapasitas ruangan! Kapasitas maksimal: ' . $ruangan->kapasitas . ' orang');
            }

            // Cek bentrok waktu
            $bentrok = $this->checkTimeConflict(
                $validated['ruangan_id'],
                $validated['tanggal'],
                $validated['jam_mulai'],
                $validated['jam_selesai']
            );

            if ($bentrok) {
                return back()
                    ->withInput()
                    ->with('error', 'Ruangan sudah dibooking pada jam tersebut!');
            }

            // Simpan booking
            $bookingData = [
                'ruangan_id'    => $validated['ruangan_id'],
                'nama_peminjam' => Auth::check() ? Auth::user()->name : 'Guest',
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'tanggal'       => $validated['tanggal'],
                'jam_mulai'     => $validated['jam_mulai'],
                'jam_selesai'   => $validated['jam_selesai'],
                'jumlah_peserta'=> $validated['jumlah_peserta'],
                'keterangan'    => $validated['keterangan'] ?? null,
                'status'        => 'pending',
            ];

            // Tambahkan user_id jika kolom ada dan user login
            if (Schema::hasColumn('bookings', 'user_id') && Auth::check()) {
                $bookingData['user_id'] = Auth::id();
            }

            $booking = Booking::create($bookingData);

            // Update status ruangan
            $ruangan->update(['status' => 'dibooking']);

            return redirect('/riwayatbooking')
                ->with('success', 'Booking berhasil diajukan! Silakan tunggu konfirmasi admin.');

        } catch (\Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan booking: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan riwayat booking
     */
    public function riwayat()
    {
        try {
            $bookings = collect();
            $totalBookings = 0;
            $pendingBookings = 0;
            $acceptedBookings = 0;
            $completedBookings = 0;
            
            // Cek apakah kolom user_id ada di tabel bookings
            if (Schema::hasColumn('bookings', 'user_id') && Auth::check()) {
                // Query dengan user_id
                $bookings = Booking::with('ruangan')
                    ->when(Auth::check(), function($query) {
                        return $query->where('user_id', Auth::id());
                    }, function($query) {
                        // Jika tidak login, tampilkan semua atau berdasarkan nama peminjam
                        return $query->where('nama_peminjam', 'Guest');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
                $totalBookings = $bookings->count();
                $pendingBookings = $bookings->where('status', 'pending')->count();
                $acceptedBookings = $bookings->where('status', 'diterima')->count();
                $completedBookings = $bookings->where('status', 'selesai')->count();
            } else {
                // Fallback: query tanpa user_id
                $bookings = Booking::with('ruangan')
                    ->when(Auth::check(), function($query) {
                        return $query->where('nama_peminjam', Auth::user()->name);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
                $totalBookings = $bookings->count();
                $pendingBookings = $bookings->where('status', 'pending')->count();
                $acceptedBookings = $bookings->where('status', 'diterima')->count();
                $completedBookings = $bookings->where('status', 'selesai')->count();
                
                Log::warning('user_id column not found in bookings table. Using fallback query.');
            }
            
            return view('riwayatbooking', compact(
                'bookings', 
                'totalBookings',
                'pendingBookings',
                'acceptedBookings',
                'completedBookings'
            ));
            
        } catch (\Exception $e) {
            Log::error('Error in riwayat method: ' . $e->getMessage());
            
            return view('riwayatbooking', [
                'bookings' => collect(),
                'totalBookings' => 0,
                'pendingBookings' => 0,
                'acceptedBookings' => 0,
                'completedBookings' => 0,
                'error' => 'Terjadi kesalahan saat mengambil data booking.'
            ]);
        }
    }

    /**
     * Batalkan booking
     */
    public function cancel($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            // Check authorization
            if (Schema::hasColumn('bookings', 'user_id')) {
                // Jika ada user_id, cek apakah user adalah pemilik booking
                if (Auth::check() && Auth::id() !== $booking->user_id) {
                    return back()->with('error', 'Anda tidak memiliki izin untuk membatalkan booking ini!');
                }
            } else {
                // Fallback: cek berdasarkan nama peminjam
                if (Auth::check() && Auth::user()->name !== $booking->nama_peminjam) {
                    return back()->with('error', 'Anda tidak memiliki izin untuk membatalkan booking ini!');
                }
            }
            
            // Hanya bisa dibatalkan jika masih pending
            if ($booking->status !== 'pending') {
                return back()->with('error', 'Hanya booking yang pending bisa dibatalkan!');
            }
            
            // Update status booking
            $booking->update(['status' => 'dibatalkan']);
            
            // Kembalikan status ruangan menjadi tersedia
            if ($booking->ruangan) {
                $booking->ruangan->update(['status' => 'tersedia']);
            }
            
            return back()->with('success', 'Booking berhasil dibatalkan!');
            
        } catch (\Exception $e) {
            Log::error('Error in cancel method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membatalkan booking.');
        }
    }

    /**
     * Admin: Setujui booking
     */
    public function approve($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => 'diterima']);
            
            // Tetap pertahankan status ruangan sebagai dibooking
            if ($booking->ruangan) {
                $booking->ruangan->update(['status' => 'dibooking']);
            }
            
            return back()->with('success', 'Booking berhasil disetujui!');
            
        } catch (\Exception $e) {
            Log::error('Error in approve method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyetujui booking.');
        }
    }

    /**
     * Admin: Tolak booking
     */
    public function reject($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => 'ditolak']);
            
            // Kembalikan status ruangan
            if ($booking->ruangan) {
                $booking->ruangan->update(['status' => 'tersedia']);
            }
            
            return back()->with('success', 'Booking berhasil ditolak!');
            
        } catch (\Exception $e) {
            Log::error('Error in reject method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menolak booking.');
        }
    }

    /**
     * Tandai booking sebagai selesai
     */
    public function complete($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => 'selesai']);
            
            // Kembalikan status ruangan
            if ($booking->ruangan) {
                $booking->ruangan->update(['status' => 'tersedia']);
            }
            
            return back()->with('success', 'Booking ditandai sebagai selesai!');
            
        } catch (\Exception $e) {
            Log::error('Error in complete method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menandai booking sebagai selesai.');
        }
    }

    /**
     * Helper function untuk cek bentrok waktu
     */
    private function checkTimeConflict($ruanganId, $tanggal, $jamMulai, $jamSelesai)
    {
        return Booking::where('ruangan_id', $ruanganId)
            ->where('tanggal', $tanggal)
            ->where(function ($query) use ($jamMulai, $jamSelesai) {
                $query->where(function ($q) use ($jamMulai, $jamSelesai) {
                    // Booking yang ada di dalam rentang waktu baru
                    $q->where('jam_mulai', '>=', $jamMulai)
                      ->where('jam_mulai', '<', $jamSelesai);
                })
                ->orWhere(function ($q) use ($jamMulai, $jamSelesai) {
                    // Booking yang ada di dalam rentang waktu baru
                    $q->where('jam_selesai', '>', $jamMulai)
                      ->where('jam_selesai', '<=', $jamSelesai);
                })
                ->orWhere(function ($q) use ($jamMulai, $jamSelesai) {
                    // Booking yang mencakup rentang waktu baru
                    $q->where('jam_mulai', '<=', $jamMulai)
                      ->where('jam_selesai', '>=', $jamSelesai);
                });
            })
            ->where('status', '!=', 'dibatalkan')
            ->where('status', '!=', 'ditolak')
            ->exists();
    }

    /**
     * Tampilkan detail booking
     */
    public function show($id)
    {
        try {
            $booking = Booking::with('ruangan')->findOrFail($id);
            
            // Check authorization
            $isAuthorized = false;
            
            if (Schema::hasColumn('bookings', 'user_id') && Auth::check()) {
                $isAuthorized = Auth::id() === $booking->user_id;
            } else if (Auth::check()) {
                $isAuthorized = Auth::user()->name === $booking->nama_peminjam;
            }
            
            if (!$isAuthorized) {
                abort(403, 'Unauthorized access');
            }
            
            return view('booking-detail', compact('booking'));
            
        } catch (\Exception $e) {
            Log::error('Error in show method: ' . $e->getMessage());
            return back()->with('error', 'Booking tidak ditemukan.');
        }
    }

    /**
     * Daftar semua booking (untuk admin)
     */
    public function index()
    {
        try {
            $bookings = Booking::with(['ruangan', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();
                
            return view('admin.bookings.index', compact('bookings'));
            
        } catch (\Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data booking.');
        }
    }
}