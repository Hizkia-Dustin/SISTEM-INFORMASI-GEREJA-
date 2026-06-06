<x-layouts.main title="Baca Artikel" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            $articleObj = (object)[
                'title' => $article->judul,
                'category' => $article->kategori ?? 'Artikel',
                'author' => 'Admin GKI',
                'date' => optional($article->created_at)->format('d M Y') ?? '-',
                'image' => $article->gambar ? asset('storage/' . $article->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'content' => $article->isi,
                'tags' => ['Informasi', 'GKI Pakuwon']
            ];
        @endphp

        <x-article.detail 
            :article="$articleObj"
            backRoute="{{ route('artikel.index') }}"
            backText="Kembali ke Daftar Artikel"
            breadcrumbParent="Artikel"
        />
        
    </div>
</x-layouts.main>
