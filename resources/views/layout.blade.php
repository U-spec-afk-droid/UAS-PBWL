<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Sistem Peminjaman Ruangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex">
    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1">
        @include('admin.partials.navbar')

        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
