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

        <!-- Kategori Filter (Frontend Mockup) -->
        <div class="flex flex-nowrap overflow-x-auto gap-3 mb-10 pb-2 no-scrollbar">
            <a href="#" class="px-5 py-2 rounded-full bg-secondary text-white font-label-md whitespace-nowrap shadow-sm">Semua</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Bahan Khotbah</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Renungan Harian</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Kajian Teologi</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Kesaksian</a>
        </div>

        @php
            // =================================================================
            // CATATAN UNTUK BACKEND DEVELOPER:
            // 
            // Ubah variabel $hasArticles di bawah ini menjadi alse untuk 
            // melihat tampilan "Empty State / Maintenance".
            // 
            // Di level controller nantinya, cukup berikan array/collection 
            // dari hasil query paginate().
            // =================================================================
            
            $hasArticles = true; 
            
            // Dummy Data untuk keperluan UI
            $dummyArticles = [
                (object)[
                    'title' => 'Penyesuaian Jadwal Kebaktian Minggu',
                    'category' => 'Renungan Harian',
                    'author' => 'Pdt. Dr. Yerusa Maria Agustini',
                    'date' => '12 Mei 2024',
                    'excerpt' => 'Seringkali kita merasa sendirian saat menghadapi cobaan berat. Namun, firman Tuhan menjanjikan damai sejahtera yang melampaui segala akal.',
                    'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'artikel-1'
                ],
                (object)[
                    'title' => 'Pendaftaran Katekisasi Tahun 2024',
                    'category' => 'Kajian Teologi',
                    'author' => 'Pnt. Alex R. Jacobus',
                    'date' => '08 Mei 2024',
                    'excerpt' => 'Menjadi kawan sekerja Allah menyiratkan hubungan timbal balik yang mesra antara Allah dan manusia dalam mengerjakan keselamatan dunia.',
                    'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'artikel-2'
                ],
                (object)[
                    'title' => 'Laporan Pertanggungjawaban Panitia Paskah',
                    'category' => 'Bahan Khotbah',
                    'author' => 'Pdt. Dodi Wijaja',
                    'date' => '01 Mei 2024',
                    'excerpt' => 'Di tengah kesibukan gawai dan media sosial, menyisihkan waktu 15 menit untuk mezbah keluarga dapat membawa transformasi rohani yang luar biasa.',
                    'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'artikel-3'
                ],
            ];
        @endphp

        @if($hasArticles && count($dummyArticles) > 0)
            
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Looping Data Artikel (Gunakan foreach($articles as $article) nanti) -->
                @foreach($dummyArticles as $article)
                    <x-article.card 
                        :article="$article" 
                        url="{{ route('informasi.show', $article->slug) }}"
                        buttonText="Baca Informasi" 
                    />
                @endforeach
            </div>

            <!-- Pagination (Backend Note: cukup gunakan $articles->links() jika pakai Tailwind pagination bawaan Laravel) -->
            <x-ui.pagination />

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
