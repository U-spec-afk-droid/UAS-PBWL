// ---------------- Sidebar Toggle ----------------
const toggleBtn = document.getElementById('toggle');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
if(toggleBtn){
    toggleBtn.addEventListener('click', ()=>{
        sidebar.classList.toggle('hide');
        content.classList.toggle('sidebar-hide');
    });
}

// ---------------- Booking Filter ----------------
function filterBookings(){
    const status = document.getElementById('filterStatus')?.value;
    const month = document.getElementById('filterMonth')?.value;
    const year = document.getElementById('filterYear')?.value;

    document.querySelectorAll('.booking-card').forEach(card=>{
        let show = true;
        if(status && status!=='semua' && card.dataset.status!==status) show=false;
        if(month && month!=='semua' && card.dataset.month!==month) show=false;
        if(year && year!=='semua' && card.dataset.year!==year) show=false;
        card.style.display = show?'block':'none';
    });
}

// ---------------- Booking Modal ----------------
function showBookingDetail(id){
    const modal = document.getElementById('detailModal');
    const modalBody = document.getElementById('modalBody');
    const card = document.querySelector(`.booking-card[data-id="${id}"]`);
    if(card){
        modalBody.innerHTML = card.innerHTML; // Bisa dikustom lebih detail
    }
    modal.style.display = 'flex';
}
function closeModal(){ document.getElementById('detailModal').style.display='none'; }
