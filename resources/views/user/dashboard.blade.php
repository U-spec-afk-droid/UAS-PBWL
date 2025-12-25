@extends('layouts.user')
@section('content')
@php $active = ''; @endphp <!-- Tidak ada menu aktif di dashboard -->
<div class="card">
    <h2>Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p>Silakan pilih menu di samping untuk memulai.</p>
</div>

<div class="dashboard-grid">
    <a href="{{ url('/user/infokelas') }}" class="dashboard-card">
        <i class="fa-solid fa-bullhorn"></i>
        <h3>Info Kelas</h3>
        <p>Lihat jadwal</p>
    </a>

    <a href="{{ url('/user/bookingclass') }}" class="dashboard-card">
        <i class="fa-solid fa-calendar-check"></i>
        <h3>Booking Kelas</h3>
        <p>Pilih kelas</p>
    </a>

    <a href="{{ url('/user/riwayatbooking') }}" class="dashboard-card">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <h3>Riwayat Booking</h3>
        <p>Riwayat lengkap</p>
    </a>
</div>
@endsection
