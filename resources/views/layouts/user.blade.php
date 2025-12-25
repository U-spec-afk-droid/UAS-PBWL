<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard User')</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <script src="{{ asset('js/user.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fa-solid fa-motorcycle"></i>
        <span class="logo-text"></span>
    </div>

    <a href="{{ url('/user/infokelas') }}" class="{{ ($active ?? '') == 'infokelas' ? 'active' : '' }}">
        <i class="fa fa-bullhorn"></i> <span>Info Kelas</span>
    </a>
    <a href="{{ url('/user/bookingclass') }}" class="{{ ($active ?? '') == 'bookingclass' ? 'active' : '' }}">
        <i class="fa fa-calendar-check"></i> <span>Booking Kelas</span>
    </a>
    <a href="{{ url('/user/riwayatbooking') }}" class="{{ ($active ?? '') == 'riwayatbooking' ? 'active' : '' }}">
        <i class="fa fa-clock-rotate-left"></i> <span>Riwayat Booking</span>
    </a>

    <a href="{{ route('logout') }}" class="logout"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       <i class="fa fa-arrow-right-from-bracket"></i> <span>Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</div>


{{-- Header --}}
<div class="header">
    <span class="dashboard-title">@yield('header','Dashboard')</span>
    <span id="toggle" class="toggle-btn"><i class="fa fa-bars"></i></span>
</div>

{{-- Content --}}
<div class="content" id="content">
    @yield('content')
</div>

<script src="{{ asset('js/user.js') }}"></script>
@yield('scripts')
</body>
</html>
