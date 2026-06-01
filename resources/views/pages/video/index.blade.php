<x-layouts.main title="Galeri Video" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Galeri <span class="text-secondary">Video</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Dokumentasi kegiatan, liputan acara, dan video inspiratif dari GKI Komplek Pakuwon.
                </p>
            </div>
            
            <!-- Pencarian -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari video..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        @php
            $hasVideos = $videos->count() > 0;
        @endphp

        @if($hasVideos)
            
            <!-- Grid Video -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($videos as $dbVideo)
                    @php
                        $articleObj = (object)[
                            'title' => $dbVideo->judul,
                            'category' => $dbVideo->kategori ?? 'Video',
                            'author' => 'Admin GKI',
                            'date' => $dbVideo->created_at->format('d M Y'),
                            'excerpt' => Str::limit(strip_tags($dbVideo->isi), 100),
                            'image' => $dbVideo->gambar ? asset('storage/' . $dbVideo->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                        ];
                    @endphp
                    <x-article.card 
                        :article="$articleObj" 
                        url="{{ route('video.show', $dbVideo->id) }}"
                        buttonText="Tonton Video" 
                    />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $videos->links() }}
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <x-ui.empty-state title="Belum Ada Video">
                <p>Galeri Video saat ini belum memiliki konten atau sedang dalam masa pemeliharaan sistem.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>
