@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Dashboard Admin</h4>
        <span class="text-muted">Ringkasan data peminjaman ruangan</span>
    </div>
</div>

{{-- Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Statistik --}}
<div class="row g-3 mb-4">

    <div class="col-md-3 col-6">
        <div class="card text-white border-0 shadow-sm h-100" style="background:#4e73df;">
            <div class="card-body">
                <div class="small">Total Booking</div>
                <div class="fs-2 fw-bold">{{ $total }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 shadow-sm h-100" style="background:#f6c23e;">
            <div class="card-body">
                <div class="small text-dark">Pending</div>
                <div class="fs-2 fw-bold text-dark">{{ $pending }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card text-white border-0 shadow-sm h-100" style="background:#1cc88a;">
            <div class="card-body">
                <div class="small">Diterima</div>
                <div class="fs-2 fw-bold">{{ $accepted }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card text-white border-0 shadow-sm h-100" style="background:#36b9cc;">
            <div class="card-body">
                <div class="small">Selesai</div>
                <div class="fs-2 fw-bold">{{ $completed }}</div>
            </div>
        </div>
    </div>

</div>

{{-- Tabel Booking --}}
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-semibold mb-0">Data Booking Terbaru</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ruangan</th>
                        <th>Peminjam</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($bookings as $b)
                    <tr>
                        <td class="fw-medium">{{ $b->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $b->nama_peminjam }}</td>
                        <td>{{ $b->nama_kegiatan }}</td>
                        <td>{{ $b->tanggal }}</td>
                        <td>
                            <span class="badge
                                @if($b->status=='pending') bg-warning
                                @elseif($b->status=='diterima') bg-success
                                @elseif($b->status=='ditolak') bg-danger
                                @elseif($b->status=='selesai') bg-primary
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        <td class="text-center">

                            {{-- Pending --}}
                            @if($b->status == 'pending')
                                <form method="POST" action="{{ route('admin.booking.approve',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Terima</button>
                                </form>

                                <form method="POST" action="{{ route('admin.booking.reject',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                </form>

                            {{-- Diterima --}}
                            @elseif($b->status == 'diterima')
                                <form method="POST" action="{{ route('admin.booking.complete',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-primary btn-sm">Selesaikan</button>
                                </form>
                            @endif

                            {{-- DELETE (SELALU ADA) --}}
                            <form method="POST"
                                  action="{{ route('admin.booking.delete', $b->id) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">🗑</button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data booking
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
