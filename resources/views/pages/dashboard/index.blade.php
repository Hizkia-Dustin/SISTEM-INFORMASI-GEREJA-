<x-layouts.main title="Dashboard Admin" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <header class="mb-10">
            <h1 class="font-h1 text-4xl text-primary-container mb-2">Sistem Informasi Manajemen</h1>
            <p class="font-body-md text-on-surface-variant">Selamat datang di Dasbor Majelis & Pengurus GKI Komplek Pakuwon.</p>
        </header>

        <!-- Dummy Dashboard Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-outline-variant/50 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">groups</span>
                </div>
                <div>
                    <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-1">Total Jemaat</p>
                    <p class="font-h2 text-2xl text-primary-container">1,245</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-outline-variant/50 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">event</span>
                </div>
                <div>
                    <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-1">Kegiatan Minggu Ini</p>
                    <p class="font-h2 text-2xl text-primary-container">12</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-outline-variant/50 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">account_balance_wallet</span>
                </div>
                <div>
                    <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-1">Status Keuangan</p>
                    <p class="font-h2 text-2xl text-primary-container">Aman</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-outline-variant/50 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[28px]">campaign</span>
                </div>
                <div>
                    <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-1">Draft Warta</p>
                    <p class="font-h2 text-2xl text-primary-container">1</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-container rounded-3xl p-8 md:p-16 text-center border border-outline-variant/40 max-w-4xl mx-auto mt-16">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                <span class="material-symbols-outlined text-secondary text-5xl">construction</span>
            </div>
            <h2 class="font-h2 text-2xl text-primary-container mb-4">Area Dalam Pembangunan Backend</h2>
            <p class="font-body-md text-on-surface-variant max-w-xl mx-auto leading-relaxed mb-8">
                Halaman dasbor ini adalah *mockup* frontend. Nantinya, halaman ini akan digantikan oleh panel admin asli (misalnya menggunakan <strong>Filament PHP</strong> atau <strong>Laravel Nova</strong>) oleh tim pengembang backend.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-outline-variant text-primary-container rounded-full font-label-md hover:bg-surface-container-low transition-colors shadow-sm">
                <span class="material-symbols-outlined">logout</span>
                Logout & Kembali ke Web
            </a>
        </div>
        
    </div>
</x-layouts.main>
