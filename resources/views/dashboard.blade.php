<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistem Ruangan</title>
</head>
<body style="margin:0; font-family:Arial, Helvetica, sans-serif; background:#f3f4f6;">

<!-- HEADER -->
<div style="background:#1e3a8a; color:white; padding:20px;">
    <div style="max-width:1200px; margin:auto; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin:0;">Sistem Informasi Ruangan Kelas</h2>
            <small>Prodi Sistem Informasi – FST UIN Sumatera Utara</small>
        </div>

        <div style="display:flex; align-items:center; gap:15px;">
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="
                    background:#dc2626;
                    color:white;
                    border:none;
                    padding:8px 14px;
                    border-radius:4px;
                    cursor:pointer;
                ">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div style="max-width:1200px; margin:30px auto; padding:0 20px;">

    <!-- STATISTIK -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:20px;">

        <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin:0; color:#6b7280;">Total Ruangan</p>
            <h1 style="margin:10px 0; color:#1e3a8a;">12</h1>
        </div>

        <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin:0; color:#6b7280;">Total Booking</p>
            <h1 style="margin:10px 0; color:#047857;">25</h1>
        </div>

        <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin:0; color:#6b7280;">Ruangan Kosong Hari Ini</p>
            <h1 style="margin:10px 0; color:#7c3aed;">4</h1>
        </div>

    </div>

    <!-- INFO -->
    <div style="background:white; margin-top:30px; padding:25px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
        <h3 style="margin-top:0;">Informasi Sistem</h3>
        <p style="color:#4b5563; line-height:1.6;">
            Website ini digunakan untuk menampilkan informasi ketersediaan
            ruangan kelas yang terintegrasi dengan jadwal perkuliahan.
            Mahasiswa dapat melihat ruangan kosong dan melakukan peminjaman
            (booking) untuk menghindari bentrok penggunaan ruangan.
        </p>

        <div style="
            background:#eff6ff;
            border-left:5px solid #1e3a8a;
            padding:15px;
            margin-top:15px;
            color:#1e3a8a;
        ">
            💡 Silakan cek ketersediaan ruangan sebelum melakukan booking.
        </div>
    </div>

</div>

<!-- FOOTER -->
<div style="text-align:center; padding:15px; color:#6b7280; font-size:14px;">
    © {{ date('Y') }} Prodi Sistem Informasi – FST UIN Sumatera Utara
</div>

</body>
</html>
