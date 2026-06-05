<x-layouts.main title="Renungan Harian" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Renungan <span class="text-secondary">Harian</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Sajian firman Tuhan setiap hari untuk menuntun dan memberkati langkah kehidupan Anda.
                </p>
            </div>
            
            <!-- Pencarian (Frontend Mockup) -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari renungan..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        <x-article.category-chips routeName="renungan.index" :active="$kategori ?? null" />

        @php
            $hasArticles = isset($renungan) && $renungan->count() > 0;
        @endphp

        @if($hasArticles)
            
            <!-- Grid Renungan -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($renungan as $dbArticle)
                    @php
                        $articleObj = (object)[
                            'title' => $dbArticle->judul,
                            'category' => $dbArticle->kategori ?? 'Renungan',
                            'author' => 'Admin GKI',
                            'date' => $dbArticle->created_at->format('d M Y'),
                            'excerpt' => Str::limit(strip_tags($dbArticle->isi), 100),
                            'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop', // Renungan tidak ada gambar di database
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('renungan.show', $dbArticle->id) }}"
                        buttonText="Baca Renungan" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $renungan->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Mempersiapkan Renungan">
                <p>Halaman Renungan Harian saat ini belum memiliki konten terbaru. Silakan kembali lagi nanti.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
