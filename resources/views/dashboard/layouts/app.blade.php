<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — GKI Pakuwon</title>
    <meta name="description" content="Sistem Informasi Manajemen GKI Pakuwon - Panel Administrasi Gereja">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-surface font-sans text-on-surface antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR COMPONENT -->
    <x-dashboard.sidebar />

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- TOPBAR COMPONENT -->
        <x-dashboard.topbar />

        <!-- PAGE CONTENT -->
        <main class="flex-1 overflow-y-auto px-12 pb-16 relative">
            <!-- Flash Message -->
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition class="fixed top-24 right-12 z-[100] bg-emerald-500 text-white px-6 py-3 rounded-2xl shadow-xl shadow-emerald-500/20 flex items-center gap-3 font-bold text-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>
