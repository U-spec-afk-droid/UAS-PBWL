<!-- resources/views/layouts/sidebar-user.blade.php -->
<div id="sidebar" class="sidebar">
    <!-- Logo/Brand Section -->
    <div class="sidebar-header">
        <div class="brand-logo">
            <div class="logo-icon">🏫</div>
            <div class="logo-text">
                <h3 class="app-name">RoomBooking</h3>
                <p class="app-tagline">Kampus System</p>
            </div>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="user-info">
                <p class="user-name">{{ Auth::user()->name }}</p>
                <p class="user-role">Pengguna</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-menu">
        <div class="menu-section">
            <p class="menu-label">NAVIGASI UTAMA</p>
            <a href="{{ route('home') }}" class="menu-item {{ ($active=='dashboard') ? 'active' : '' }}">
                <span class="menu-icon">📊</span>
                <span class="menu-text">Dashboard</span>
                <span class="menu-badge">{{ ($active=='dashboard') ? '•' : '' }}</span>
            </a>

            <a href="{{ route('infokelas') }}" class="menu-item {{ ($active=='infokelas') ? 'active' : '' }}">
                <span class="menu-icon">🏛️</span>
                <span class="menu-text">Informasi Ruangan</span>
                <span class="menu-badge">{{ ($active=='infokelas') ? '•' : '' }}</span>
            </a>

            <a href="{{ route('bookingclass') }}" class="menu-item {{ ($active=='booking') ? 'active' : '' }}">
                <span class="menu-icon">📝</span>
                <span class="menu-text">Booking Ruangan</span>
                <span class="menu-badge">{{ ($active=='booking') ? '•' : '' }}</span>
            </a>

            <a href="{{ route('booking.riwayat') }}" class="menu-item {{ ($active=='riwayat') ? 'active' : '' }}">
                <span class="menu-icon">📋</span>
                <span class="menu-text">Riwayat Booking</span>
                <span class="menu-badge">{{ ($active=='riwayat') ? '•' : '' }}</span>
            </a>
        </div>
    </div>

    <!-- Footer / Logout -->
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">
                <span class="logout-icon">🚪</span>
                <span class="logout-text">Keluar</span>
            </button>
        </form>
    </div>
</div>

<style>
    /* SIDEBAR STYLING */
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        color: white;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    /* Sidebar Header */
    .sidebar-header {
        padding: 30px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand-logo {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .logo-icon {
        font-size: 32px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-text {
        flex: 1;
    }

    .app-name {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: white;
        line-height: 1.2;
    }

    .app-tagline {
        margin: 4px 0 0 0;
        font-size: 12px;
        color: #94a3b8;
        font-weight: 400;
    }

    /* User Profile */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        margin-top: 10px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 18px;
        color: white;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: white;
        line-height: 1.2;
    }

    .user-role {
        margin: 4px 0 0 0;
        font-size: 12px;
        color: #94a3b8;
    }

    /* Navigation Menu */
    .sidebar-menu {
        flex: 1;
        padding: 25px;
        overflow-y: auto;
    }

    .menu-section {
        margin-bottom: 30px;
    }

    .menu-label {
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 15px 0;
        padding-left: 15px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        color: #cbd5e1;
        text-decoration: none;
        border-radius: 12px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    .menu-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(5px);
    }

    .menu-item.active {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.2), rgba(99, 102, 241, 0.2));
        color: white;
        border-left: 4px solid #3b82f6;
    }

    .menu-icon {
        font-size: 20px;
        width: 24px;
        text-align: center;
    }

    .menu-text {
        flex: 1;
        font-size: 15px;
        font-weight: 500;
    }

    .menu-badge {
        font-size: 20px;
        color: #3b82f6;
        font-weight: bold;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { opacity: 0.5; }
        50% { opacity: 1; }
        100% { opacity: 0.5; }
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: auto;
    }

    .logout-form {
        width: 100%;
    }

    .logout-button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #f87171;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 15px;
        font-weight: 500;
    }

    .logout-button:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        transform: translateY(-2px);
    }

    .logout-icon {
        font-size: 20px;
    }

    .logout-text {
        flex: 1;
        text-align: left;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 260px;
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 20px;
        }

        .sidebar-menu {
            padding: 20px;
        }
    }

    /* Scrollbar Styling */
    .sidebar-menu::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 3px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>