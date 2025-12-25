<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle me-3" id="hamburger" style="background: none; border: none; color: white; font-size: 1.5rem;">
            ☰
        </button>
        
        <a class="navbar-brand d-flex align-items-center" href="/">
            <div class="brand-logo-small me-2">
                🏫
            </div>
            <span>SI Ruangan</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <!-- User Info on Navbar -->
                    <li class="nav-item dropdown user-profile-nav">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar-nav me-2">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="d-none d-md-block">
                                <div class="user-name-nav">{{ Auth::user()->name }}</div>
                                <div class="user-role-nav">
                                    @if(auth()->user()->role === 'admin')
                                        Administrator
                                    @else
                                        Pengguna
                                    @endif
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">🏠 Dashboard Admin</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('home') }}">📊 Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('infokelas') }}">🏛️ Informasi Ruangan</a></li>
                                <li><a class="dropdown-item" href="{{ route('bookingclass') }}">📝 Booking Ruangan</a></li>
                                <li><a class="dropdown-item" href="{{ route('booking.riwayat') }}">📋 Riwayat Booking</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="logout-form-nav">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-button-nav">
                                        🚪 Logout
                                    </button>
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
    /* Navbar Custom Styling */
    .navbar {
        background: linear-gradient(90deg, #1e293b 0%, #0f172a 100%) !important;
        padding: 0.8rem 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 999;
        height: 70px;
    }

    /* Sidebar Toggle Button */
    .sidebar-toggle {
        font-size: 1.8rem;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: scale(1.05);
    }

    /* Brand Logo */
    .brand-logo-small {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: white !important;
    }

    /* User Profile in Navbar */
    .user-profile-nav .nav-link {
        color: white !important;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
    }

    .user-profile-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .user-avatar-nav {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        color: white;
    }

    .user-name-nav {
        font-size: 14px;
        font-weight: 600;
        color: white;
        line-height: 1.2;
    }

    .user-role-nav {
        font-size: 12px;
        color: #94a3b8;
        line-height: 1.2;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        background: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 10px;
        margin-top: 10px;
        min-width: 220px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .dropdown-item {
        color: #cbd5e1;
        padding: 12px 15px;
        border-radius: 8px;
        margin: 2px 0;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: rgba(59, 130, 246, 0.2);
        color: white;
        transform: translateX(5px);
    }

    .dropdown-divider {
        border-color: rgba(255, 255, 255, 0.1);
        margin: 8px 0;
    }

    /* Logout Button in Dropdown */
    .logout-form-nav {
        margin: 0;
    }

    .logout-button-nav {
        width: 100%;
        text-align: left;
        background: rgba(239, 68, 68, 0.1) !important;
        color: #f87171 !important;
        border: none;
        padding: 12px 15px !important;
    }

    .logout-button-nav:hover {
        background: rgba(239, 68, 68, 0.2) !important;
        color: #fca5a5 !important;
    }

    /* Navbar Links */
    .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.1);
    }

    /* Adjust content padding for fixed navbar */
    body {
        padding-top: 70px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar {
            padding: 0.5rem 0;
            height: 60px;
        }

        .sidebar-toggle {
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .brand-logo-small {
            width: 35px;
            height: 35px;
            font-size: 18px;
        }

        .navbar-brand {
            font-size: 1.3rem;
        }

        body {
            padding-top: 60px;
        }

        .user-name-nav,
        .user-role-nav {
            display: none;
        }

        .dropdown-menu {
            min-width: 200px;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand span {
            font-size: 1.2rem;
        }

        .nav-link {
            padding: 0.5rem 0.75rem !important;
        }

        .dropdown-menu {
            min-width: 180px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    if (hamburger && sidebar && overlay) {
        hamburger.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.style.display = 'none';
        });
    }
});
</script>