<nav class="navbar navbar-expand-lg navbar-light navbar-glass">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <div class="brand-icon">SK</div>
            <span class="brand-text">SI KELAS</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">

                @guest
                    <li class="nav-item">
                        <a class="nav-link nav-pill" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-pill login-btn" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <!-- User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-pill" data-bs-toggle="dropdown" href="#">
                            <div class="avatar">
                                {{ substr(Auth::user()->name,0,1) }}
                            </div>
                            <span class="d-none d-md-inline">
                                {{ Auth::user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-soft">
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">🏠 Dashboard Admin</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('home') }}">📊 Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('infokelas') }}">🏛️ Informasi Ruangan</a></li>
                                <li><a class="dropdown-item" href="{{ route('bookingclass') }}">📝 Booking Ruangan</a></li>
                                <li><a class="dropdown-item" href="{{ route('booking.riwayat') }}">📋 Riwayat Booking</a></li>
                            @endif
                            <li><hr></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">🚪 Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

<style>
/* Navbar Glass */
.navbar-glass{
    background: linear-gradient(90deg,#2563eb,#7c3aed);
    padding: 0.7rem 0;
    position: fixed;
    top:0;left:0;right:0;
    z-index:999;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

/* Brand */
.brand-icon{
    width:40px;
    height:40px;
    background:white;
    color:#2563eb;
    font-weight:800;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.brand-text{
    color:white;
    font-weight:700;
    font-size:1.3rem;
}

/* Toggle */
.sidebar-toggle{
    background:rgba(255,255,255,.2);
    border:none;
    color:white;
    width:42px;
    height:42px;
    border-radius:10px;
    font-size:1.4rem;
}

/* Pills */
.nav-pill{
    color:white !important;
    padding:.45rem 1rem !important;
    border-radius:999px;
}
.nav-pill:hover{
    background:rgba(255,255,255,.2);
}

/* Login button */
.login-btn{
    background:white;
    color:#2563eb !important;
    font-weight:600;
}

/* User */
.user-pill{
    display:flex;
    align-items:center;
    gap:8px;
    background:rgba(255,255,255,.2);
    border-radius:999px;
    padding:.35rem .8rem !important;
    color:white !important;
}
.avatar{
    width:34px;
    height:34px;
    background:white;
    color:#2563eb;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

/* Dropdown */
.dropdown-soft{
    border:none;
    border-radius:14px;
    padding:8px;
    box-shadow:0 15px 30px rgba(0,0,0,.2);
}
.dropdown-soft .dropdown-item{
    border-radius:10px;
    padding:10px;
}
.dropdown-soft .dropdown-item:hover{
    background:#eef2ff;
}

/* Body offset */
body{
    padding-top:70px;
}
</style>
