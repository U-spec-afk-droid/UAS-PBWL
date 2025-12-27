<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kelas - BookClass</title>
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

        /* Form Booking */
        .booking-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-label span {
            color: #dc2626;
        }

        .form-input, .form-select {
            padding: 12px 16px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            font-family: inherit;
            width: 100%;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background-color: white;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        /* Time Slots */
        .time-slots {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        .time-slot {
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .time-slot:hover {
            border-color: #60a5fa;
            background-color: #eff6ff;
        }

        .time-slot.selected {
            border-color: #3b82f6;
            background-color: #dbeafe;
            color: #1e40af;
            font-weight: 600;
        }

        .time-slot.unavailable {
            border-color: #fca5a5;
            background-color: #fee2e2;
            color: #dc2626;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Ruangan List */
        .ruangan-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .ruangan-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .ruangan-card:hover {
            border-color: #60a5fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .ruangan-card.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .ruangan-card.unavailable {
            border-color: #fca5a5;
            background-color: #fee2e2;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .ruangan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .ruangan-kode {
            font-weight: 700;
            color: #1e293b;
            font-size: 18px;
        }

        .ruangan-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-tersedia {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-dipakai {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .ruangan-info {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Submit Button */
        .submit-btn {
            grid-column: 1 / -1;
            padding: 16px;
            background: linear-gradient(90deg, #1e293b, #2d3748);
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(30, 41, 59, 0.2);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 41, 59, 0.3);
            background: linear-gradient(90deg, #0f172a, #1e293b);
        }

        .submit-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
            
            .booking-form {
                grid-template-columns: 1fr;
            }
            
            .time-slots {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .ruangan-list {
                grid-template-columns: 1fr;
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
    <a href="/bookingclass" class="active" id="linkBooking">
        <span>📝</span>
        <span>Booking Kelas</span>
    </a>
    <a href="/riwayatbooking" id="linkRiwayat">
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
    <h3>Booking Kelas</h3>
</div>

<!-- Content -->
<div class="content">
    <div class="card">
        <h2>📝 Form Booking Kelas</h2>
        
        <div class="booking-form">
            <!-- Form fields tetap sama -->
            <div class="form-group">
                <label class="form-label">
                    📅 Tanggal Booking <span>*</span>
                </label>
                <input type="date" class="form-input" id="tanggal" min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label class="form-label">
                    🎯 Nama Kegiatan <span>*</span>
                </label>
                <input type="text" class="form-input" id="kegiatan" placeholder="Contoh: Workshop Web Development">
            </div>

            <div class="form-group full-width">
                <label class="form-label">
                    🏫 Pilih Ruangan <span>*</span>
                </label>
                <div class="ruangan-list" id="ruanganList">
                    <div class="ruangan-card" onclick="selectRuangan('A101')">
                        <div class="ruangan-header">
                            <div class="ruangan-kode">A101</div>
                            <div class="ruangan-status status-tersedia">Tersedia</div>
                        </div>
                        <div class="ruangan-info">Lab Komputer - Kapasitas: 30 orang</div>
                    </div>
                    
                    <div class="ruangan-card unavailable">
                        <div class="ruangan-header">
                            <div class="ruangan-kode">A102</div>
                            <div class="ruangan-status status-dipakai">Dipakai</div>
                        </div>
                        <div class="ruangan-info">Ruang Kelas - Kapasitas: 40 orang</div>
                    </div>
                    
                    <div class="ruangan-card" onclick="selectRuangan('B201')">
                        <div class="ruangan-header">
                            <div class="ruangan-kode">B201</div>
                            <div class="ruangan-status status-tersedia">Tersedia</div>
                        </div>
                        <div class="ruangan-info">Auditorium - Kapasitas: 100 orang</div>
                    </div>
                </div>
            </div>

            <div class="form-group full-width">
                <label class="form-label">
                    ⏰ Pilih Waktu <span>*</span>
                </label>
                <div class="time-slots" id="timeSlots">
                    <div class="time-slot" onclick="selectTime('08:00-10:00')">08:00 - 10:00</div>
                    <div class="time-slot" onclick="selectTime('10:00-12:00')">10:00 - 12:00</div>
                    <div class="time-slot" onclick="selectTime('13:00-15:00')">13:00 - 15:00</div>
                    <div class="time-slot" onclick="selectTime('15:00-17:00')">15:00 - 17:00</div>
                    <div class="time-slot unavailable">19:00 - 21:00</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    👥 Jumlah Peserta <span>*</span>
                </label>
                <input type="number" class="form-input" id="peserta" min="1" max="100" placeholder="Contoh: 25">
            </div>

            <div class="form-group">
                <label class="form-label">
                    📝 Keterangan Tambahan
                </label>
                <textarea class="form-input" id="keterangan" rows="3" placeholder="Opsional: Tambahkan keterangan jika diperlukan"></textarea>
            </div>

            <button class="submit-btn" onclick="submitBooking()" id="submitBtn">
                📋 Ajukan Booking
            </button>
        </div>
    </div>
</div>

<script>
    // Debug info
    console.log('Booking page JavaScript loaded');
    
    // Get elements
    const hamburger = document.getElementById('hamburger');
    const closeBtn = document.getElementById('closeBtn');
    const overlay = document.getElementById('overlay');
    const sidebar = document.getElementById('sidebar');
    
    // Check if elements exist
    console.log('Elements found:', {
        hamburger: !!hamburger,
        closeBtn: !!closeBtn,
        overlay: !!overlay,
        sidebar: !!sidebar
    });
    
    // Toggle sidebar function
    function toggleSidebar() {
        console.log('toggleSidebar called');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
    
    // Close sidebar function
    function closeSidebar() {
        console.log('closeSidebar called');
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }
    
    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        
        // Hamburger click
        if (hamburger) {
            hamburger.addEventListener('click', function(e) {
                e.stopPropagation();
                console.log('Hamburger clicked');
                toggleSidebar();
            });
        }
        
        // Close button click
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                console.log('Close button clicked');
                closeSidebar();
            });
        }
        
        // Overlay click
        if (overlay) {
            overlay.addEventListener('click', function() {
                console.log('Overlay clicked');
                closeSidebar();
            });
        }
        
        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (sidebar.classList.contains('active') && 
                !sidebar.contains(e.target) && 
                e.target !== hamburger) {
                console.log('Clicked outside sidebar');
                closeSidebar();
            }
        });
        
        // Close sidebar with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                console.log('ESC key pressed');
                closeSidebar();
            }
        });
    });

    // Existing booking functions
    let selectedRuangan = null;
    let selectedTime = null;

    function selectRuangan(kode) {
        const cards = document.querySelectorAll('.ruangan-card:not(.unavailable)');
        cards.forEach(card => card.classList.remove('selected'));
        
        selectedRuangan = kode;
        const selectedCard = Array.from(cards).find(card => 
            card.querySelector('.ruangan-kode').textContent === kode
        );
        
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
        
        validateForm();
    }

    function selectTime(time) {
        const slots = document.querySelectorAll('.time-slot:not(.unavailable)');
        slots.forEach(slot => slot.classList.remove('selected'));
        
        selectedTime = time;
        const selectedSlot = Array.from(slots).find(slot => slot.textContent === time);
        
        if (selectedSlot) {
            selectedSlot.classList.add('selected');
        }
        
        validateForm();
    }

    function validateForm() {
        const tanggal = document.getElementById('tanggal').value;
        const kegiatan = document.getElementById('kegiatan').value;
        const peserta = document.getElementById('peserta').value;
        const submitBtn = document.getElementById('submitBtn');
        
        if (tanggal && kegiatan && peserta && selectedRuangan && selectedTime) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    function submitBooking() {
        const tanggal = document.getElementById('tanggal').value;
        const kegiatan = document.getElementById('kegiatan').value;
        const peserta = document.getElementById('peserta').value;
        const keterangan = document.getElementById('keterangan').value;
        
        if (!tanggal || !kegiatan || !peserta || !selectedRuangan || !selectedTime) {
            alert('Harap lengkapi semua field yang wajib diisi!');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'Memproses...';
        submitBtn.disabled = true;

        setTimeout(() => {
            const bookingData = {
                tanggal,
                kegiatan,
                ruangan: selectedRuangan,
                waktu: selectedTime,
                peserta: parseInt(peserta),
                keterangan
            };
            
            console.log('Data booking:', bookingData);
            
            document.getElementById('tanggal').value = '';
            document.getElementById('kegiatan').value = '';
            document.getElementById('peserta').value = '';
            document.getElementById('keterangan').value = '';
            
            const cards = document.querySelectorAll('.ruangan-card');
            cards.forEach(card => card.classList.remove('selected'));
            
            const slots = document.querySelectorAll('.time-slot');
            slots.forEach(slot => slot.classList.remove('selected'));
            
            selectedRuangan = null;
            selectedTime = null;
            
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            alert('✅ Booking berhasil diajukan!\n\n' +
                  `Tanggal: ${tanggal}\n` +
                  `Ruangan: ${bookingData.ruangan}\n` +
                  `Waktu: ${bookingData.waktu}\n` +
                  `Kegiatan: ${kegiatan}\n\n` +
                  'Silakan tunggu konfirmasi dari admin.');
        }, 1500);
    }

    // Event listeners for form validation
    document.getElementById('tanggal').addEventListener('change', validateForm);
    document.getElementById('kegiatan').addEventListener('input', validateForm);
    document.getElementById('peserta').addEventListener('input', validateForm);
    document.getElementById('tanggal').min = new Date().toISOString().split('T')[0];
</script>

</body>
</html>