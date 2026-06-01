<x-layouts.main title="Tonton Video" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            $articleObj = (object)[
                'title' => $item->judul,
                'category' => $item->kategori ?? 'Video',
                'author' => 'Admin GKI',
                'date' => $item->created_at->format('d M Y'),
                'image' => $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'content' => $item->isi,
                'tags' => ['Video', 'GKI Pakuwon']
            ];
        @endphp

        <x-article.detail 
            :article="$articleObj"
            backRoute="{{ route('video.index') }}"
            backText="Kembali ke Galeri Video"
            breadcrumbParent="Video"
        />
        
    </div>
</x-layouts.main>
