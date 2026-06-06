<x-layouts.main title="Baca Warta Jemaat" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            $article = (object)[
                'title' => $item->judul,
                'category' => $item->kategori ?? 'Warta Mingguan',
                'author' => 'Admin GKI',
                'date' => optional($item->created_at)->format('d M Y') ?? '-',
                'image' => $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'content' => $item->isi,
                'tags' => []
            ];
        @endphp

        <x-article.detail 
            :article="$article"
            backRoute="{{ route('warta.index') }}"
            backText="Kembali ke Daftar Warta"
            breadcrumbParent="Warta"
        />
        
    </div>
</x-layouts.main>
