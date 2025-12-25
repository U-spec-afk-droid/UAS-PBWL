<!-- resources/views/layouts/script-user.blade.php -->
<script>
document.getElementById('hamburger')?.addEventListener('click', function() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('overlay').style.display = 'block';
});

document.getElementById('overlay')?.addEventListener('click', function() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').style.display = 'none';
});
</script>
