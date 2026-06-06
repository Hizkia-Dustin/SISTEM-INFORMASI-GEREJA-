<x-layouts.main title="Informasi Jemaat" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Informasi <span class="text-secondary">Jemaat</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Pengumuman, berita terkini, dan informasi penting untuk seluruh Jemaat GKI Komplek Pakuwon.
                </p>
            </div>
            
            <!-- Pencarian (Frontend Mockup) -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari informasi..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>


        @php
            $hasArticles = $informasi->count() > 0;
        @endphp

        @if($hasArticles)
            
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Looping Data Artikel -->
                @foreach($informasi as $dbInformasi)
                    @php
                        $articleObj = (object)[
                            'title' => $dbInformasi->judul,
                            'category' => $dbInformasi->kategori ?? 'Informasi',
                            'author' => 'Admin GKI',
                            'date' => $dbInformasi->created_at->format('d M Y'),
                            'excerpt' => Str::cleanExcerpt($dbInformasi->isi, 100),
                            'image' => $dbInformasi->gambar ? asset('storage/' . $dbInformasi->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('informasi.show', $dbInformasi->id) }}"
                        buttonText="Baca Informasi" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $informasi->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Belum Ada Informasi">
                <p>Halaman Informasi saat ini belum memiliki konten atau sedang dalam masa pemeliharaan sistem.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
