<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Kelas</title>

    <style>
        /* ======= CSS sebelumnya tetap ======= */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .navbar {
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

        .hamburger {
            font-size: 28px;
            cursor: pointer;
            margin-right: 25px;
            transition: transform 0.3s ease;
            padding: 8px;
            border-radius: 50%;
        }

        .hamburger:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.1);
        }

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
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.2);
        }

        .sidebar.active { left: 0; }
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
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            background: linear-gradient(90deg, #b91c1c, #dc2626);
        }

        .content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card h2 {
            color: #1e293b;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #60a5fa;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }

        th {
            background: linear-gradient(90deg, #1e293b, #2d3748);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        tr:hover { background-color: #f8fafc; }
        tr:last-child td { border-bottom: none; }

        /* Status colors */
        .tersedia { color: #10b981; font-weight: 700; background-color: rgba(16,185,129,0.1); padding:6px 15px; border-radius:20px; display:inline-block; min-width:100px; }
        .dipakai { color: #ef4444; font-weight: 700; background-color: rgba(239,68,68,0.1); padding:6px 15px; border-radius:20px; display:inline-block; min-width:100px; }
        .dibooking { color: #f97316; font-weight: 700; background-color: rgba(249,115,22,0.1); padding:6px 15px; border-radius:20px; display:inline-block; min-width:100px; }

        @media (max-width: 768px) {
            .content { margin: 20px auto; padding: 10px; }
            .card { padding: 20px; }
            th, td { padding: 12px 15px; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="hamburger" onclick="toggleSidebar()">☰</div>
    <h3>Informasi Kelas</h3>
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="close-btn" onclick="toggleSidebar()">✖</div>
    <h2>BOOKCLASS</h2>
    <a href="/infokelas"><span>📚</span><span>Informasi Kelas</span></a>
    <a href="/bookingclass"><span>📝</span><span>Booking Kelas</span></a>
    <a href="/riwayatbooking"><span>📄</span><span>Riwayat Booking</span></a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn" type="submit"><span>🚪</span><span>Logout</span></button>
    </form>
</div>

<!-- Content -->
<div class="content">
    <div class="card">
        <h2>Daftar Ruangan Kelas</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ruangan as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->kode_ruangan }}</td>
                        <td>{{ $r->nama_ruangan }}</td>
                        <td>{{ $r->kapasitas }}</td>
                        <td>
                            @if ($r->status === 'kosong')
                                <span class="tersedia">Kosong</span>
                            @elseif ($r->status === 'digunakan')
                                <span class="dipakai">Dipakai</span>
                            @elseif ($r->status === 'dibooking')
                                <span class="dibooking">Dibooking</span>
                            @else
                                <span style="color: gray;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                            Data ruangan belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
    }
</script>

</body>
</html>
