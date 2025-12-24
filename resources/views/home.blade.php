<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 70px;
            background: linear-gradient(90deg, #1e293b 0%, #2d3748 100%);
            color: white;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }

        .menu-btn {
            font-size: 28px;
            cursor: pointer;
            margin-right: 20px;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .menu-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.1);
        }

        /* OVERLAY */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
            backdrop-filter: blur(3px);
            transition: opacity 0.3s ease;
        }

        .overlay.active {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: -320px;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 25px;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.25);
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin: 50px 0 40px;
            font-size: 28px;
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 16px 20px;
            margin-bottom: 15px;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: linear-gradient(90deg, rgba(96, 165, 250, 0.2), rgba(167, 139, 250, 0.2));
            transform: translateX(5px);
            border-left: 4px solid #60a5fa;
            color: white;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: rotate(90deg);
        }

        .logout-btn {
            margin-top: 40px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #dc2626, #ef4444);
            border: none;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            background: linear-gradient(90deg, #b91c1c, #dc2626);
        }

        /* CONTENT AREA */
        .content-wrapper {
            min-height: calc(100vh - 70px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 45px 50px;
            border-radius: 20px;
            width: 100%;
            max-width: 750px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease-out;
            text-align: center;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card h1 {
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 42px;
            background: linear-gradient(90deg, #1e293b, #3b82f6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        .card p {
            color: #4b5563;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card strong {
            color: #3b82f6;
            font-weight: 700;
        }

        .card b {
            color: #1e293b;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 20px;
            }
            
            .card {
                padding: 30px 25px;
            }
            
            .card h1 {
                font-size: 32px;
            }
            
            .card p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<!-- OVERLAY -->
<div id="overlay" class="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="close-btn" onclick="toggleSidebar()">✖</div>

    <h2>BOOKCLASS</h2>

    <a href="/infokelas">
        <span>📚</span>
        <span>Informasi Kelas</span>
    </a>
    <a href="/bookingclass">
        <span>📝</span>
        <span>Booking Kelas</span>
    </a>
    <a href="riwayatbooking">
        <span>📄</span>
        <span>Riwayat Booking</span>
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn" type="submit">
            <span>🚪</span>
            <span>Logout</span>
        </button>
    </form>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <div class="menu-btn" onclick="toggleSidebar()">☰</div>
    <h3>Home Mahasiswa</h3>
</div>

<!-- CONTENT -->
<div class="content-wrapper">
    <div class="card">
        <h1>Selamat Datang</h1>
        <p>Halo, <strong>{{ Auth::user()->name }}</strong></p>
        <p>Ini adalah halaman <b>HOME Mahasiswa</b>.</p>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>

</body>
</html>