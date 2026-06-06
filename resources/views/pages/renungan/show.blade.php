<x-layouts.main title="Baca Renungan" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            $article = (object)[
                'title' => $item->judul,
                'category' => $item->kategori ?? 'Renungan Pagi',
                'author' => 'Admin GKI',
                'date' => optional($item->created_at)->format('d M Y') ?? '-',
                'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop', // Renungan tidak ada gambar di database
                'content' => $item->isi,
                'tags' => []
            ];
        @endphp

        <x-article.detail 
            :article="$article"
            backRoute="{{ route('renungan.index') }}"
            backText="Kembali ke Daftar Renungan"
            breadcrumbParent="Renungan"
        />
        
    </div>
</x-layouts.main>
