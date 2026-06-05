<aside class="w-[280px] bg-white border-r border-gray-100 flex flex-col z-50 shrink-0 h-screen overflow-hidden shadow-sm">
    <!-- Brand -->
    <div class="px-8 py-8 flex items-center gap-3">
        <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <div>
            <h1 class="font-heading text-lg font-bold text-gray-800 leading-tight">GKI Pakuwon</h1>
            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest">Panel Administrasi</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 pb-10 overflow-y-auto no-scrollbar">
        @php
            $navItemClass = "flex items-center gap-3 px-4 py-2.5 text-gray-500 font-medium rounded-xl transition-all duration-200 mb-1 hover:bg-gray-50 hover:text-primary group text-sm";
            $navItemActiveClass = "flex items-center gap-3 px-4 py-2.5 bg-blue-50 text-primary font-bold rounded-xl transition-all duration-200 mb-1 border-r-4 border-primary shadow-sm text-sm";
        @endphp

        <!-- 1. Beranda -->
        <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? $navItemActiveClass : $navItemClass }}">
            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Beranda
        </a>

        <!-- 2. Modul Keluarga -->
        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 pt-6 pb-2">Manajemen Data</div>
        <div x-data="{ open: {{ request()->routeIs('dashboard.keluarga.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    Keluarga
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.keluarga.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.keluarga.index') && request('status') != 'tidak_aktif' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Keluarga Aktif</a>
                <a href="{{ route('dashboard.keluarga.index', ['status' => 'tidak_aktif']) }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.keluarga.index') && request('status') == 'tidak_aktif' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Keluarga Tidak Aktif</a>
            </div>
        </div>

        <!-- 3. Modul Jemaat -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.jemaat.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Jemaat
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.jemaat.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.jemaat.index') && request('status') != 'tidak_aktif' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Jemaat Aktif</a>
                <a href="{{ route('dashboard.jemaat.index', ['status' => 'tidak_aktif']) }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.jemaat.index') && request('status') == 'tidak_aktif' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Jemaat Tidak Aktif</a>
            </div>
        </div>

        <!-- 4. Modul Sektor -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.sektor.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Sektor
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.sektor.index', ['tab' => 'anggota']) }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.sektor.index') && request('tab', 'anggota') == 'anggota' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Anggota Sektor</a>
                <a href="{{ route('dashboard.sektor.index', ['tab' => 'master']) }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.sektor.index') && request('tab') == 'master' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Data Sektor</a>
                <a href="{{ route('dashboard.sektor.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.sektor.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Sektor</a>
            </div>
        </div>

        <!-- 5. Keuangan -->
        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 pt-6 pb-2">Administrasi</div>
        <div x-data="{ open: {{ request()->routeIs('dashboard.keuangan.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    Keuangan
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.keuangan.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.keuangan.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Data Keuangan</a>
                <a href="{{ route('dashboard.keuangan.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.keuangan.index') && !request('kategori') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Persembahan Ibadah</a>
                <a href="{{ route('dashboard.keuangan.index', ['kategori' => 'diakoni']) }}" class="text-xs font-medium py-2 {{ request('kategori') == 'diakoni' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Diakoni Sosial</a>
                <a href="{{ route('dashboard.keuangan.index', ['kategori' => 'khusus']) }}" class="text-xs font-medium py-2 {{ request('kategori') == 'khusus' ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Persembahan Khusus</a>
                <a href="{{ route('dashboard.keuangan.laporan') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.keuangan.laporan*') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Laporan Keuangan</a>
            </div>
        </div>

        <!-- 6. Pelayan Gereja -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.pelayan.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/></svg>
                    Pelayan Gereja
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.pelayan.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.pelayan.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Pelayan</a>
                <a href="{{ route('dashboard.pelayan.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.pelayan.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Pelayan</a>
            </div>
        </div>

        <!-- 7. Renungan Harian -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.renungan.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Renungan Harian
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.renungan.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.renungan.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Renungan</a>
                <a href="{{ route('dashboard.renungan.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.renungan.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Renungan</a>
            </div>
        </div>

        <!-- 7b. Warta Jemaat -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.warta.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Warta Jemaat
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.warta.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.warta.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Warta</a>
                <a href="{{ route('dashboard.warta.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.warta.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Warta</a>
            </div>
        </div>

        <!-- 8 & 9. Jadwal Ibadah & Pelayanan -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.jadwal.*') || request()->routeIs('dashboard.tugas.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Jadwal & Pelayanan
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.jadwal.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.jadwal.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Jadwal Ibadah</a>
                <a href="{{ route('dashboard.jadwal.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.jadwal.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Jadwal Ibadah</a>
                <a href="{{ route('dashboard.tugas.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.tugas.*') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Jadwal Pelayan</a>
            </div>
        </div>

        <!-- 10. Program Kerja Pelayanan -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.program_kerja.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Program Kerja
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.program_kerja.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.program_kerja.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Program & RAPB</a>
                <a href="{{ route('dashboard.program_kerja.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.program_kerja.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Program</a>
            </div>
        </div>

        <!-- 11. Berita Gereja -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.berita.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Berita Gereja
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.berita.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.berita.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Berita Gereja</a>
                <a href="{{ route('dashboard.berita.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.berita.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Berita Gereja</a>
            </div>
        </div>

        <!-- 12. Artikel -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.artikel.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Artikel
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.artikel.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.artikel.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Artikel</a>
                <a href="{{ route('dashboard.artikel.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.artikel.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Artikel</a>
            </div>
        </div>

        <!-- 13. Racakitri -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.racakitri.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 2l3 6 7 1-5 5 1.5 7.5L12 18l-6.5 3.5L7 14l-5-5 7-1z"/></svg>
                    Racakitri
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.racakitri.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.racakitri.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Racakitri</a>
                <a href="{{ route('dashboard.racakitri.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.racakitri.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Racakitri</a>
            </div>
        </div>

        <!-- 14. Informasi -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.informasi.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Informasi
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.informasi.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.informasi.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Informasi</a>
                <a href="{{ route('dashboard.informasi.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.informasi.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Informasi</a>
            </div>
        </div>

        <!-- 15. Video -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.video.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Video
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.video.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.video.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Lihat Video</a>
                <a href="{{ route('dashboard.video.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.video.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Video</a>
            </div>
        </div>

        <!-- 16. Komisi & Bagian -->
        <div x-data="{ open: {{ request()->routeIs('dashboard.komisi.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="{{ $navItemClass }} w-full justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Komisi & Bagian
                </div>
                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-collapse x-cloak class="pl-12 flex flex-col gap-1 mb-2">
                <a href="{{ route('dashboard.komisi.index') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.komisi.index') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Daftar Komisi</a>
                <a href="{{ route('dashboard.komisi.create') }}" class="text-xs font-medium py-2 {{ request()->routeIs('dashboard.komisi.create') ? 'text-primary font-bold' : 'text-gray-400 hover:text-primary' }}">Tambah Komisi</a>
            </div>
        </div>
    </nav>

    <!-- Bottom Actions -->
    <div class="p-6 border-t border-gray-50 flex flex-col gap-2">
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 text-rose-500 font-bold text-sm hover:bg-rose-50 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Keluar Panel
        </a>
    </div>
</aside>
