@extends('layouts.app')

@section('content')

{{-- Header Minimal --}}
<div class="mb-4">
    <h5 class="fw-semibold mb-0">Dashboard Admin</h5>
</div>

{{-- Alert --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Statistik Card Berwarna --}}
<div class="row mb-4 g-3">

    <div class="col-md-3 col-6">
        <div class="card border-0 text-white h-100" style="background:#4e73df;">
            <div class="card-body">
                <div class="small">Total Booking</div>
                <div class="fs-2 fw-bold">{{ $total }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 text-dark h-100" style="background:#f6c23e;">
            <div class="card-body">
                <div class="small">Pending</div>
                <div class="fs-2 fw-bold">{{ $pending }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 text-white h-100" style="background:#1cc88a;">
            <div class="card-body">
                <div class="small">Diterima</div>
                <div class="fs-2 fw-bold">{{ $accepted }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="card border-0 text-white h-100" style="background:#36b9cc;">
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

        <h6 class="fw-semibold mb-3">Data Booking Terbaru</h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ruangan</th>
                        <th>Peminjam</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $b)
                    <tr>
                        <td class="fw-medium">{{ $b->ruangan->nama_ruangan }}</td>
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
                            @if($b->status == 'pending')
                                <form method="POST" action="{{ route('admin.booking.approve',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Terima</button>
                                </form>
                                <form method="POST" action="{{ route('admin.booking.reject',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @elseif($b->status == 'diterima')
                                <form method="POST" action="{{ route('admin.booking.complete',$b->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-primary btn-sm">Selesaikan</button>
                                </form>
                            @endif
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
