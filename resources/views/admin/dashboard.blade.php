@extends('layouts.app')

@section('content')
<style>
/* ===== DASHBOARD ADMIN PROFESIONAL STYLES ===== */
:root {
    --primary: #4361ee;
    --primary-light: #eef2ff;
    --secondary: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #1f2937;
    --gray-800: #374151;
    --gray-700: #4b5563;
    --gray-600: #6b7280;
    --gray-500: #9ca3af;
    --gray-300: #e5e7eb;
    --gray-100: #f9fafb;
    --white: #ffffff;
    --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.1);
    --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
    --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    --radius: 12px;
    --radius-sm: 8px;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: #f8fafc;
    min-height: 100vh;
}

/* ===== LAYOUT CONTAINER ===== */
.container {
    max-width: 1400px !important;
    margin: 0 auto !important;
    padding: 30px 25px !important;
}

/* ===== HEADER SECTION ===== */
h2.mb-4.fw-bold {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: var(--dark) !important;
    position: relative !important;
    padding-left: 15px !important;
    margin-bottom: 30px !important;
}

h2.mb-4.fw-bold:before {
    content: '' !important;
    position: absolute !important;
    left: 0 !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    height: 24px !important;
    width: 4px !important;
    background: linear-gradient(to bottom, var(--primary), #3b82f6) !important;
    border-radius: 10px !important;
}

/* ===== ALERT STYLES ===== */
.alert-success {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%) !important;
    color: white !important;
    border: none !important;
    border-radius: var(--radius-sm) !important;
    padding: 16px 20px !important;
    margin-bottom: 30px !important;
    box-shadow: var(--shadow) !important;
    font-weight: 500 !important;
    border-left: 4px solid #059669 !important;
}

/* ===== STATISTIC CARDS ===== */
.row.g-3.mb-4 {
    margin-bottom: 35px !important;
}

.card.shadow-sm.border-0 {
    border: none !important;
    border-radius: var(--radius) !important;
    background: var(--white) !important;
    box-shadow: var(--shadow) !important;
    transition: all 0.3s ease !important;
    height: 100% !important;
    border-top: 4px solid transparent !important;
    position: relative !important;
    overflow: hidden !important;
}

.card.shadow-sm.border-0:hover {
    transform: translateY(-5px) !important;
    box-shadow: var(--shadow-lg) !important;
}

.card.shadow-sm.border-0:nth-child(1) {
    border-top-color: var(--primary) !important;
}

.card.shadow-sm.border-0:nth-child(2) {
    border-top-color: var(--warning) !important;
}

.card.shadow-sm.border-0:nth-child(3) {
    border-top-color: var(--secondary) !important;
}

.card.shadow-sm.border-0:nth-child(4) {
    border-top-color: #8b5cf6 !important;
}

.card-body {
    padding: 24px !important;
    position: relative !important;
}

.card-body h6.text-muted {
    font-size: 14px !important;
    font-weight: 600 !important;
    color: var(--gray-600) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin-bottom: 12px !important;
}

.card-body h3.fw-bold {
    font-size: 36px !important;
    font-weight: 800 !important;
    margin-bottom: 0 !important;
    color: var(--dark) !important;
}

.card-body h3.fw-bold.text-warning {
    color: var(--warning) !important;
}

.card-body h3.fw-bold.text-success {
    color: var(--secondary) !important;
}

.card-body h3.fw-bold.text-primary {
    color: var(--primary) !important;
}

/* ===== DIVIDER ===== */
hr {
    margin: 35px 0 !important;
    border: none !important;
    height: 1px !important;
    background: linear-gradient(to right, transparent, var(--gray-300), transparent) !important;
    opacity: 0.7 !important;
}

/* ===== TABLE HEADER ===== */
h4.fw-bold.mb-3 {
    font-size: 20px !important;
    font-weight: 700 !important;
    color: var(--dark) !important;
    margin-bottom: 20px !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

h4.fw-bold.mb-3:before {
    content: '' !important;
    display: inline-block !important;
    width: 6px !important;
    height: 22px !important;
    background: linear-gradient(to bottom, var(--primary), #3b82f6) !important;
    border-radius: 3px !important;
}

/* ===== TABLE STYLES ===== */
.table-responsive.shadow-sm.rounded {
    border-radius: var(--radius) !important;
    overflow: hidden !important;
    box-shadow: var(--shadow-md) !important;
    border: 1px solid var(--gray-300) !important;
}

.table.table-striped.align-middle.mb-0 {
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

.table.table-striped tbody tr:nth-of-type(odd) {
    background-color: var(--gray-100) !important;
}

.table.table-striped tbody tr:hover {
    background-color: var(--primary-light) !important;
    transition: background-color 0.2s !important;
}

.table-dark {
    background: linear-gradient(135deg, var(--dark) 0%, #374151 100%) !important;
    color: white !important;
    border: none !important;
}

.table-dark th {
    border: none !important;
    padding: 18px 16px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.table.table-striped td {
    padding: 16px !important;
    border-top: 1px solid var(--gray-300) !important;
    vertical-align: middle !important;
    color: var(--gray-700) !important;
    font-size: 14.5px !important;
}

/* ===== BADGE STYLES ===== */
.badge {
    padding: 6px 14px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    border-radius: 20px !important;
    text-transform: capitalize !important;
    letter-spacing: 0.3px !important;
}

.badge.bg-warning {
    background: linear-gradient(135deg, var(--warning) 0%, #fbbf24 100%) !important;
    color: var(--dark) !important;
}

.badge.bg-success {
    background: linear-gradient(135deg, var(--secondary) 0%, #34d399 100%) !important;
    color: white !important;
}

.badge.bg-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #f87171 100%) !important;
    color: white !important;
}

.badge.bg-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%) !important;
    color: white !important;
}

.badge.bg-secondary {
    background: linear-gradient(135deg, var(--gray-600) 0%, var(--gray-500) 100%) !important;
    color: white !important;
}

/* ===== BUTTON STYLES ===== */
.btn {
    font-size: 13.5px !important;
    font-weight: 600 !important;
    padding: 8px 18px !important;
    border-radius: var(--radius-sm) !important;
    border: none !important;
    transition: all 0.2s ease !important;
    letter-spacing: 0.3px !important;
}

.btn-sm {
    padding: 6px 16px !important;
    font-size: 13px !important;
}

.btn-success {
    background: linear-gradient(135deg, var(--secondary) 0%, #34d399 100%) !important;
    border: none !important;
    color: white !important;
}

.btn-success:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4) !important;
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #f87171 100%) !important;
    border: none !important;
    color: white !important;
}

.btn-danger:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4) !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%) !important;
    border: none !important;
    color: white !important;
}

.btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4) !important;
}

/* ===== FORM STYLES ===== */
form.d-inline {
    display: inline-block !important;
    margin-right: 8px !important;
}

/* ===== EMPTY STATE ===== */
td.text-center.text-muted {
    padding: 40px !important;
    font-style: italic !important;
    color: var(--gray-500) !important;
    background: var(--gray-100) !important;
}

/* ===== CARD DECORATIONS ===== */
.card.shadow-sm.border-0:after {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
    width: 60px !important;
    height: 60px !important;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%) !important;
    border-radius: 0 12px 0 60px !important;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card.shadow-sm.border-0 {
    animation: fadeIn 0.5s ease-out forwards !important;
}

.card.shadow-sm.border-0:nth-child(2) {
    animation-delay: 0.1s !important;
}

.card.shadow-sm.border-0:nth-child(3) {
    animation-delay: 0.2s !important;
}

.card.shadow-sm.border-0:nth-child(4) {
    animation-delay: 0.3s !important;
}

.table.table-striped tbody tr {
    animation: fadeIn 0.3s ease-out !important;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 992px) {
    .container {
        padding: 20px 15px !important;
    }
    
    .card-body h3.fw-bold {
        font-size: 30px !important;
    }
}

@media (max-width: 768px) {
    .row.g-3.mb-4 {
        margin-bottom: 20px !important;
    }
    
    .col-md-3 {
        margin-bottom: 15px !important;
    }
    
    .btn {
        display: block !important;
        width: 100% !important;
        margin-bottom: 8px !important;
    }
    
    form.d-inline {
        width: 48% !important;
        margin-right: 2% !important;
    }
}

@media (max-width: 576px) {
    h2.mb-4.fw-bold {
        font-size: 24px !important;
        margin-bottom: 25px !important;
    }
    
    .card-body {
        padding: 18px !important;
    }
    
    form.d-inline {
        width: 100% !important;
        margin-right: 0 !important;
    }
}
</style>

<div class="container">
    <h2 class="mb-4 fw-bold">Dashboard Admin</h2>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Statistik Booking --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Booking</h6>
                    <h3 class="fw-bold">{{ $total }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Pending</h6>
                    <h3 class="fw-bold text-warning">{{ $pending }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Diterima</h6>
                    <h3 class="fw-bold text-success">{{ $accepted }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Selesai</h6>
                    <h3 class="fw-bold text-primary">{{ $completed }}</h3>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Tabel Data Booking --}}
    <h4 class="fw-bold mb-3">Data Booking Terbaru</h4>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Ruangan</th>
                    <th>Peminjam</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                <tr>
                    <td>{{ $b->ruangan->nama_ruangan }}</td>
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
                    <td>
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
                    <tr><td colspan="6" class="text-center text-muted">Belum ada data booking</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan font Inter untuk hasil terbaik -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@endsection