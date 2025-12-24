<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - BookClass</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            height: 70px;
            background: linear-gradient(90deg, #1e293b 0%, #2d3748 100%);
            color: white;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .hamburger {
            font-size: 28px;
            cursor: pointer;
            margin-right: 25px;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .hamburger:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* OVERLAY */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 25px;
            transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
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

        .sidebar a.active {
            background: linear-gradient(90deg, rgba(96, 165, 250, 0.2), rgba(167, 139, 250, 0.2));
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

        /* Content */
        .content {
            max-width: 1200px;
            margin: 90px auto 40px;
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
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card h2 {
            color: #1e293b;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #60a5fa;
            font-size: 28px;
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 200px;
        }

        .filter-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .filter-select {
            padding: 10px 15px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 14px;
            background-color: #f8fafc;
            font-family: inherit;
        }

        /* Booking Cards */
        .booking-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .booking-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 6px solid #3b82f6;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .booking-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
        }

        .booking-status {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .status-diterima {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .status-selesai {
            background-color: #e0e7ff;
            color: #3730a3;
            border: 1px solid #6366f1;
        }

        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-weight: 600;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 500;
            color: #1e293b;
            font-size: 15px;
        }

        .booking-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-cancel {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }

        .btn-cancel:hover {
            background-color: #fee2e2;
        }

        .btn-cancel:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-detail {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #93c5fd;
        }

        .btn-detail:hover {
            background-color: #dbeafe;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-message {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .empty-submessage {
            font-size: 14px;
            color: #94a3b8;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content {
                margin: 80px auto 20px;
                padding: 10px;
            }
            
            .card {
                padding: 20px;
            }
            
            .filter-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .booking-details {
                grid-template-columns: 1fr;
            }
            
            .booking-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

<!-- OVERLAY -->
<div class="overlay" id="overlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="close-btn" id="closeBtn">✖</div>

    <h2>BOOKCLASS</h2>

    <a href="/infokelas" id="linkInfoKelas">
        <span>📚</span>
        <span>Informasi Kelas</span>
    </a>
    <a href="/bookingclass" id="linkBooking">
        <span>📝</span>
        <span>Booking Kelas</span>
    </a>
    <a href="/riwayatbooking" class="active" id="linkRiwayat">
        <span>📄</span>
        <span>Riwayat Booking</span>
    </a>

    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
        @csrf
        <button class="logout-btn" type="submit">
            <span>🚪</span>
            <span>Logout</span>
        </button>
    </form>
</div>

<!-- Navbar -->
<div class="navbar">
    <div class="hamburger" id="hamburger">☰</div>
    <h3>Riwayat Booking</h3>
</div>

<!-- Content -->
<div class="content">
    <div class="card">
        <h2>📋 Riwayat Booking Anda</h2>
        
        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $totalBookings }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $pendingBookings }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $acceptedBookings }}</div>
                <div class="stat-label">Diterima</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $completedBookings }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select class="filter-select" id="filterStatus" onchange="filterBookings()">
                    <option value="semua">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Bulan</label>
                <select class="filter-select" id="filterMonth" onchange="filterBookings()">
                    <option value="semua">Semua Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Tahun</label>
                <select class="filter-select" id="filterYear" onchange="filterBookings()">
                    <option value="semua">Semua Tahun</option>
                    <option value="2024">2024</option>
                    <option value="2025" selected>2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>
        </div>

        <!-- Booking List -->
        <div class="booking-list" id="bookingList">
            @forelse($bookings as $booking)
                <div class="booking-card" data-status="{{ $booking->status }}" data-month="{{ date('n', strtotime($booking->tanggal)) }}" data-year="{{ date('Y', strtotime($booking->tanggal)) }}">
                    <div class="booking-header">
                        <div class="booking-title">
                            {{ $booking->nama_kegiatan ?? $booking->kode_ruangan }}
                        </div>
                        <div class="booking-status status-{{ $booking->status }}">
                            @if($booking->status == 'pending')
                                Menunggu Konfirmasi
                            @elseif($booking->status == 'diterima')
                                Diterima
                            @elseif($booking->status == 'ditolak')
                                Ditolak
                            @elseif($booking->status == 'selesai')
                                Selesai
                            @else
                                {{ ucfirst($booking->status) }}
                            @endif
                        </div>
                    </div>
                    
                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-label">📅 Tanggal</span>
                            <span class="detail-value">{{ date('d F Y', strtotime($booking->tanggal)) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">⏰ Waktu</span>
                            <span class="detail-value">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">🏫 Ruangan</span>
                            <span class="detail-value">{{ $booking->ruangan->kode_ruangan }} - {{ $booking->ruangan->nama_ruangan }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">👥 Peserta</span>
                            <span class="detail-value">{{ $booking->jumlah_peserta }} orang</span>
                        </div>
                        @if($booking->keterangan)
                        <div class="detail-item">
                            <span class="detail-label">📝 Keterangan</span>
                            <span class="detail-value">{{ $booking->keterangan }}</span>
                        </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-label">📅 Dibuat</span>
                            <span class="detail-value">{{ date('d F Y H:i', strtotime($booking->created_at)) }}</span>
                        </div>
                    </div>
                    
                    <div class="booking-actions">
                        @if($booking->status == 'pending')
                        <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-cancel" onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                Batalkan
                            </button>
                        </form>
                        @endif
                        
                        <button class="action-btn btn-detail" onclick="showBookingDetail({{ $booking->id }})">
                            Detail
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div class="empty-message">Belum ada riwayat booking</div>
                    <div class="empty-submessage">Mulai dengan membuat booking ruangan terlebih dahulu</div>
                    <a href="/bookingclass" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: linear-gradient(90deg, #1e293b, #2d3748); color: white; text-decoration: none; border-radius: 10px; font-weight: 600;">
                        📝 Buat Booking Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 30px; border-radius: 16px; max-width: 500px; width: 90%; max-height: 80vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: #1e293b;">Detail Booking</h3>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #64748b;">✖</button>
        </div>
        <div id="modalContent">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script>
    // Sidebar Functions
    const hamburger = document.getElementById('hamburger');
    const closeBtn = document.getElementById('closeBtn');
    const overlay = document.getElementById('overlay');
    const sidebar = document.getElementById('sidebar');

    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
    
    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (hamburger) {
            hamburger.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
        }
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeSidebar();
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', function() {
                closeSidebar();
            });
        }
        
        document.addEventListener('click', function(e) {
            if (sidebar.classList.contains('active') && 
                !sidebar.contains(e.target) && 
                e.target !== hamburger) {
                closeSidebar();
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
    });

    // Filter Functionality
    function filterBookings() {
        const statusFilter = document.getElementById('filterStatus').value;
        const monthFilter = document.getElementById('filterMonth').value;
        const yearFilter = document.getElementById('filterYear').value;
        
        const bookingCards = document.querySelectorAll('.booking-card');
        
        bookingCards.forEach(card => {
            const status = card.getAttribute('data-status');
            const month = card.getAttribute('data-month');
            const year = card.getAttribute('data-year');
            
            let show = true;
            
            if (statusFilter !== 'semua' && status !== statusFilter) {
                show = false;
            }
            
            if (monthFilter !== 'semua' && month !== monthFilter) {
                show = false;
            }
            
            if (yearFilter !== 'semua' && year !== yearFilter) {
                show = false;
            }
            
            card.style.display = show ? 'block' : 'none';
        });
    }

    // Modal Functions
    function showBookingDetail(bookingId) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');
        
        // Fetch booking data (simulasi)
        const bookingCard = document.querySelector(`.booking-card[data-id="${bookingId}"]`);
        
        if (bookingCard) {
            // Ambil data dari card (dalam real app, ini akan AJAX request ke server)
            modalContent.innerHTML = `
                <div style="margin-bottom: 20px;">
                    <strong style="color: #475569; display: block; margin-bottom: 5px;">Kegiatan:</strong>
                    <span style="color: #1e293b;">${bookingCard.querySelector('.booking-title').textContent}</span>
                </div>
                <div style="margin-bottom: 20px;">
                    <strong style="color: #475569; display: block; margin-bottom: 5px;">Status:</strong>
                    <span style="color: #1e293b;">${bookingCard.querySelector('.booking-status').textContent}</span>
                </div>
                <div style="margin-bottom: 20px;">
                    <strong style="color: #475569; display: block; margin-bottom: 5px;">Detail:</strong>
                    <div style="color: #1e293b; line-height: 1.6;">
                        ${Array.from(bookingCard.querySelectorAll('.detail-item')).map(item => 
                            `<div>${item.querySelector('.detail-label').textContent}: ${item.querySelector('.detail-value').textContent}</div>`
                        ).join('')}
                    </div>
                </div>
                <div style="text-align: right; margin-top: 20px;">
                    <button onclick="closeModal()" style="padding: 10px 20px; background: #e2e8f0; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Tutup</button>
                </div>
            `;
        } else {
            modalContent.innerHTML = `<p>Data booking tidak ditemukan.</p>`;
        }
        
        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }

    // Auto-refresh jika ada booking baru (simulasi)
    let lastUpdate = Date.now();
    
    function checkForUpdates() {
        // Dalam aplikasi nyata, ini akan AJAX request ke server
        // untuk mengecek apakah ada booking baru
        console.log('Checking for updates...');
        
        // Simulasi: Refresh setiap 30 detik
        if (Date.now() - lastUpdate > 30000) {
            window.location.reload();
        }
    }
    
    // Check for updates setiap 10 detik
    setInterval(checkForUpdates, 10000);
</script>

</body>
</html>