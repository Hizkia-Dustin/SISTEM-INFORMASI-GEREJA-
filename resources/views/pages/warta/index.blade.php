<x-layouts.main title="Warta Jemaat" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Warta <span class="text-secondary">Jemaat</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Dokumen Warta Jemaat mingguan yang memuat jadwal pelayanan, laporan keuangan, dan berita gereja.
                </p>
            </div>
            
            <!-- Pencarian (Frontend Mockup) -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari warta jemaat..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        <!-- Kategori Filter (Frontend Mockup) -->
        <div class="flex flex-nowrap overflow-x-auto gap-3 mb-10 pb-2 no-scrollbar">
            <a href="#" class="px-5 py-2 rounded-full bg-secondary text-white font-label-md whitespace-nowrap shadow-sm">Semua</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Bahan Khotbah</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Renungan Harian</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Kajian Teologi</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Kesaksian</a>
        </div>

        @php
            $hasArticles = isset($warta) && $warta->count() > 0;
        @endphp

        @if($hasArticles)
            
            <!-- Grid Warta -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($warta as $dbArticle)
                    @php
                        $articleObj = (object)[
                            'title' => $dbArticle->judul,
                            'category' => $dbArticle->kategori ?? 'Warta',
                            'author' => 'Admin GKI',
                            'date' => $dbArticle->created_at->format('d M Y'),
                            'excerpt' => Str::limit(strip_tags($dbArticle->isi), 100),
                            'image' => $dbArticle->gambar ? asset('storage/' . $dbArticle->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('warta.show', $dbArticle->id) }}"
                        buttonText="Baca Warta" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $warta->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Menyiapkan Warta Terkini">
                <p>Halaman Warta Jemaat belum memiliki dokumen minggu ini atau sedang diperbarui.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
