<x-layouts.main title="Raca Kitri" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Raca <span class="text-secondary">Kitri</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Majalah dan buletin internal GKI Komplek Pakuwon yang berisi ulasan pelayanan dan kesaksian jemaat.
                </p>
            </div>
            
            <!-- Pencarian (Frontend Mockup) -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari edisi Raca Kitri..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        <x-article.category-chips routeName="racakitri.index" :active="$kategori ?? null" />

        @php
            $hasArticles = $racakitri->count() > 0;
        @endphp

        @if($hasArticles)
            
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Looping Data Artikel -->
                @foreach($racakitri as $dbRacakitri)
                    @php
                        $articleObj = (object)[
                            'title' => $dbRacakitri->judul,
                            'category' => $dbRacakitri->kategori ?? 'Racakitri',
                            'author' => 'Admin GKI',
                            'date' => $dbRacakitri->created_at->format('d M Y'),
                            'excerpt' => Str::limit(strip_tags($dbRacakitri->isi), 100),
                            'image' => $dbRacakitri->gambar ? asset('storage/' . $dbRacakitri->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('racakitri.show', $dbRacakitri->id) }}"
                        buttonText="Baca Edisi" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $racakitri->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Sedang Menyiapkan Edisi">
                <p>Halaman Raca Kitri saat ini belum memiliki edisi terbaru atau sedang dalam masa pemeliharaan.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
