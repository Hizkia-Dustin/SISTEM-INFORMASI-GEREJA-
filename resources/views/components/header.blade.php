<nav class="bg-white/80 backdrop-blur-md flex justify-between items-center h-16 px-8 w-full z-40 fixed top-0 border-b border-slate-100 shadow-sm">
    <div class="flex items-center gap-8 h-full">
        <div class="flex items-center ">
            <a href="{{ route('home') }}" class="flex items-center gap-2 cursor-pointer">
                <img src="/img/gereja.png" class="h-10 w-auto" />
                <span class="font-[Manrope] font-semibold text-[#00236f] tracking-tight ml-2">GKI PAKUWON</span>
            </a>
        </div>
        <div class="hidden md:flex items-center gap-6 h-full">
            <a class="text-[#00236f] font-semibold border-b-2 border-[#00236f] px-1 py-5 h-full flex items-center" href="{{ route('home') }}">Beranda</a>
            
            <!-- Dropdown About -->
            <div x-data="{ isOpen: false }" @click.outside="isOpen = false" class="relative h-full flex items-center">
                <a @click.prevent="isOpen = !isOpen" class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center gap-1 cursor-pointer" :class="{'text-[#0058bf]': isOpen}" href="#">About <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="{'rotate-180': isOpen}">expand_more</span></a>
                
                <div x-cloak x-show="isOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute top-[calc(100%-8px)] left-0 w-max min-w-[200px] bg-white border border-slate-100 shadow-xl rounded-xl z-50 p-2 flex flex-col gap-1">
                    
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('about.sejarah') }}">Sejarah Gereja</a>
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('about.visi-misi') }}">Visi dan Misi</a>
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('about.pendeta') }}">Pendeta</a>
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('about.penatua') }}">Penatua</a>
                </div>
            </div>

            <!-- Dropdown Pelayanan Jemaat -->
            <div x-data="{ isOpen: false }" @click.outside="isOpen = false" class="relative h-full flex items-center">
                <a @click.prevent="isOpen = !isOpen" class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center gap-1 cursor-pointer" :class="{'text-[#0058bf]': isOpen}" href="#">Pelayanan Jemaat <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="{'rotate-180': isOpen}">expand_more</span></a>
                
                <div x-cloak x-show="isOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute top-[calc(100%-8px)] left-1/2 -translate-x-1/2 w-[800px] bg-white border border-slate-100 shadow-xl rounded-2xl z-50 p-6 flex gap-6">
                    
                    <!-- Col 1 -->
                    <div class="flex-1 flex flex-col gap-1">
                        <h4 class="px-3 text-[11px] font-bold text-[#00236f] uppercase tracking-wider mb-2">Bidang Pelayanan</h4>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.persekutuan') }}">Persekutuan</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.pembinaan') }}">Pembinaan</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.kesaksian') }}">Kesaksian Pelayanan</a>
                    </div>
                    
                    <!-- Col 2 -->
                    <div class="flex-1 flex flex-col gap-1">
                        <h4 class="px-3 text-[11px] font-bold text-[#00236f] uppercase tracking-wider mb-2">Badan Pelayanan</h4>
                        
                        <h5 class="px-3 text-[10px] font-bold text-slate-400 uppercase mt-1 mb-0.5">Kategorial</h5>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.komisi-anak') }}">Komisi Anak</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.komisi-dewasa') }}">Komisi Dewasa</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.komisi-remaja') }}">Komisi Remaja</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.komisi-pemuda') }}">Komisi Pemuda</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.komisi-usia-indah') }}">Komisi Usia Indah</a>

                        <h5 class="px-3 text-[10px] font-bold text-slate-400 uppercase mt-3 mb-0.5">Non Kategorial</h5>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.peribadatan') }}">Peribadatan</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.seni-musik') }}">Seni Musik Gerejawi</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.perlawatan') }}">Perlawatan</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.kedukaan') }}">Kedukaan</a>
                    </div>
                    
                    <!-- Col 3 -->
                    <div class="flex-1 flex flex-col gap-1">
                        <h4 class="px-3 text-[11px] font-bold text-[#00236f] uppercase tracking-wider mb-2">Kegiatan Pelayanan</h4>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.kebaktian') }}">Kebaktian</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.konseling') }}">Konseling Pastoral</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.katekisasi') }}">Bahan Katekisasi</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.pernikahan') }}">Pernikahan</a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap" href="{{ route('pelayanan.atestasi') }}">Atestasi</a>
                    </div>
                    
                    <!-- Col 4 -->
                    <div class="flex-1 flex flex-col gap-1 pt-[30px]">
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-2" href="{{ route('artikel.index') }}">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">article</span> Artikel
                        </a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-2" href="{{ route('racakitri.index') }}">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">menu_book</span> Racakitri
                        </a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-2" href="{{ route('informasi.index') }}">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">info</span> Informasi
                        </a>
                        <a class="px-3 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-2" href="{{ route('video.index') }}">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">play_circle</span> Video
                        </a>
                    </div>
                </div>
            </div>

            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center" href="{{ route('renungan.index') }}">Renungan Harian</a>
            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center" href="{{ route('warta.index') }}">Warta Jemaat</a>
            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center" href="{{ route('kontak.index') }}">Kontak</a>

            <!-- Dropdown Download -->
            <div x-data="{ isOpen: false }" @click.outside="isOpen = false" class="relative h-full flex items-center">
                <a @click.prevent="isOpen = !isOpen" class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium h-full flex items-center gap-1 cursor-pointer" :class="{'text-[#0058bf]': isOpen}" href="#">Download <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="{'rotate-180': isOpen}">expand_more</span></a>
                
                <div x-cloak x-show="isOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute top-[calc(100%-8px)] right-0 w-max min-w-[240px] bg-white border border-slate-100 shadow-xl rounded-xl z-50 p-2 flex flex-col gap-1">
                    
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-3" href="{{ route('download.formulir') }}">
                        <div class="w-8 h-8 rounded-md bg-[#eff4ff] text-[#0058bf] flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">description</span>
                        </div>
                        Download Formulir
                    </a>
                    <a class="px-4 py-2.5 text-sm text-slate-600 font-medium hover:bg-[#f8f9ff] hover:text-[#0058bf] rounded-lg transition-colors whitespace-nowrap flex items-center gap-3" href="{{ route('download.lagu-rohani') }}">
                        <div class="w-8 h-8 rounded-md bg-[#eff4ff] text-[#0058bf] flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">music_note</span>
                        </div>
                        Download Lagu Rohani
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden lg:block">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input class="pl-10 pr-4 py-2 bg-[#e5eeff] rounded-full border-none text-sm focus:ring-2 focus:ring-[#0058bf] w-64 outline-none" placeholder="Cari di ..." type="text"/>
        </div>
        <button class="bg-[#00236f] text-white px-6 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-all">Ikuti Ibadah</button>
    </div>
</nav>
