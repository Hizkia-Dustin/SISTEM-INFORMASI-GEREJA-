<x-layouts.main title="Artikel Renungan" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Artikel <span class="text-secondary">Renungan</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Kumpulan bahan khotbah, renungan harian, dan tulisan inspiratif untuk membangun pertumbuhan iman Jemaat GKI Komplek Pakuwon.
                </p>
            </div>
            
            <!-- Pencarian (Frontend Mockup) -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari artikel..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        <x-article.category-chips routeName="artikel.index" :active="$kategori ?? null" :categories="['Bahan Khotbah', 'Kajian Teologi', 'Kesaksian']" />

        @php
            $hasArticles = $articles->count() > 0;
        @endphp

        @if($hasArticles)
            
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($articles as $dbArticle)
                    @php
                        $articleObj = (object)[
                            'title' => $dbArticle->judul,
                            'category' => $dbArticle->kategori ?? 'Artikel',
                            'author' => 'Admin GKI',
                            'date' => $dbArticle->created_at->format('d M Y'),
                            'excerpt' => Str::cleanExcerpt($dbArticle->isi, 100),
                            'image' => $dbArticle->gambar ? asset('storage/' . $dbArticle->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('artikel.show', $dbArticle->id) }}"
                        buttonText="Baca Artikel" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $articles->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Sedang Menyusun Inspirasi">
                <p>Halaman Artikel saat ini belum memiliki konten atau sedang dalam masa pemeliharaan sistem. Ruang ini nantinya akan menjadi sumber <strong>Bahan Khotbah</strong>, <strong>Renungan Harian</strong>, dan inspirasi rohani lainnya bagi Jemaat GKI Pakuwon.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
