<x-layouts.main title="Baca Raca Kitri" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            $articleObj = (object)[
                'title' => $item->judul,
                'category' => $item->kategori ?? 'Racakitri',
                'author' => 'Admin GKI',
                'date' => $item->created_at->format('d M Y'),
                'image' => $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'content' => $item->isi,
                'tags' => ['Racakitri', 'GKI Pakuwon']
            ];
        @endphp

        <x-article.detail 
            :article="$articleObj"
            backRoute="{{ route('racakitri.index') }}"
            backText="Kembali ke Daftar Racakitri"
            breadcrumbParent="Racakitri"
        />
        
    </div>
</x-layouts.main>
