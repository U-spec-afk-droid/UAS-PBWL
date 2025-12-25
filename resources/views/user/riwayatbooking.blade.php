@extends('layouts.user')
@section('title','Riwayat Booking')
@section('header','Riwayat Booking')

@section('content')
<div class="card">
    <h2>📋 Riwayat Booking Anda</h2>

    @if($bookings->isEmpty())
        <div class="empty-state" style="margin-top:20px;">
            <div class="empty-icon">📋</div>
            <div class="empty-message">Belum ada riwayat booking</div>
            <div class="empty-submessage">Mulai dengan membuat booking ruangan terlebih dahulu</div>
            <a href="{{ url('/user/bookingclass') }}" class="submit-btn" style="margin-top:15px;">📝 Buat Booking Sekarang</a>
        </div>
    @else
        <div class="filter-section" style="margin-bottom:20px;">
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-select" onchange="filterBookings()">
                    <option value="semua">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
        </div>

        <div class="booking-list">
            @foreach($bookings as $booking)
                <div class="booking-card" data-status="{{ $booking->status }}" data-month="{{ date('n', strtotime($booking->tanggal)) }}" data-year="{{ date('Y', strtotime($booking->tanggal)) }}">
                    <div class="booking-header">
                        <div class="booking-title">{{ $booking->nama_kegiatan ?? $booking->ruangan->nama_ruangan }}</div>
                        <div class="booking-status status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </div>
                    </div>

                    <div class="booking-details">
                        <div class="detail-item"><span class="detail-label">📅 Tanggal</span> <span class="detail-value">{{ date('d F Y', strtotime($booking->tanggal)) }}</span></div>
                        <div class="detail-item"><span class="detail-label">⏰ Waktu</span> <span class="detail-value">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span></div>
                        <div class="detail-item"><span class="detail-label">🏫 Ruangan</span> <span class="detail-value">{{ $booking->ruangan->kode_ruangan }} - {{ $booking->ruangan->nama_ruangan }}</span></div>
                        <div class="detail-item"><span class="detail-label">👥 Peserta</span> <span class="detail-value">{{ $booking->jumlah_peserta }} orang</span></div>
                        @if($booking->keterangan)
                        <div class="detail-item"><span class="detail-label">📝 Keterangan</span> <span class="detail-value">{{ $booking->keterangan }}</span></div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=>{ filterBookings(); });
</script>
@endsection
