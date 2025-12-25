<!-- resources/views/layouts/navbar-user.blade.php -->
<div class="navbar">
    <div class="hamburger" id="hamburger">☰</div>
    <h3>{{ $title }}</h3>
</div>

@push('styles')
<style>
.navbar {
    height: 70px;
    background: #1e293b;
    color:white;
    display:flex;
    align-items:center;
    padding:0 20px;
    position: fixed;
    width: 100%;
    top:0;
    left:0;
    z-index: 1000;
}

.hamburger {
    font-size: 24px;
    margin-right: 15px;
    cursor:pointer;
}
.content { padding-top: 100px; } /* untuk turun isi */
</style>
@endpush
