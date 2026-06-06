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
<body class="bg-surface font-sans text-on-surface antialiased overflow-hidden">

<div class="flex h-screen w-screen overflow-hidden">

    <!-- SIDEBAR COMPONENT -->
    <x-dashboard.sidebar />

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-w-0 flex flex-col overflow-hidden">
        
        <!-- TOPBAR COMPONENT -->
        <x-dashboard.topbar />

        <!-- PAGE CONTENT -->
        <main class="flex-1 min-w-0 overflow-y-auto overflow-x-hidden px-6 lg:px-10 xl:px-12 pb-16 relative">
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

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4">
    <div class="w-full max-w-md rounded-3xl bg-white shadow-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Konfirmasi Hapus</h2>
            <p id="deleteConfirmMessage" class="mt-2 text-sm text-slate-600">Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="px-6 py-4 bg-slate-50 flex items-center justify-end gap-3">
            <button id="deleteConfirmCancel" type="button" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Batal</button>
            <button id="deleteConfirmAccept" type="button" class="rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-600 transition">Hapus</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('deleteConfirmModal');
        const messageEl = document.getElementById('deleteConfirmMessage');
        const acceptButton = document.getElementById('deleteConfirmAccept');
        const cancelButton = document.getElementById('deleteConfirmCancel');
        let targetForm = null;

        document.querySelectorAll('form.confirm-delete').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                targetForm = form;
                messageEl.textContent = form.dataset.confirm || 'Apakah Anda yakin ingin menghapus data ini?';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            targetForm = null;
        }

        cancelButton.addEventListener('click', closeModal);
        acceptButton.addEventListener('click', function() {
            if (targetForm) {
                targetForm.submit();
            }
        });

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>
