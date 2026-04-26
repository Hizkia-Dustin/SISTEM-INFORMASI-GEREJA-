<x-layout title="Artikel & Renungan" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Artikel & <span class="text-secondary">Renungan</span></h1>
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
            // Ubah variabel $hasArticles di bawah ini menjadi `false` untuk 
            // melihat tampilan "Empty State / Maintenance".
            // 
            // Di level controller nantinya, cukup berikan array/collection 
            // $articles dari hasil query paginate().
            // Contoh: $articles = App\Models\Article::latest()->paginate(9);
            // =================================================================
            
            $hasArticles = true; 
            
            // Dummy Data untuk keperluan UI
            $dummyArticles = [
                (object)[
                    'title' => 'Menemukan Damai Sejahtera di Tengah Badai Kehidupan',
                    'category' => 'Renungan Harian',
                    'author' => 'Pdt. Dr. Yerusa Maria Agustini',
                    'date' => '12 Mei 2024',
                    'excerpt' => 'Seringkali kita merasa sendirian saat menghadapi cobaan berat. Namun, firman Tuhan menjanjikan damai sejahtera yang melampaui segala akal.',
                    'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'menemukan-damai-sejahtera'
                ],
                (object)[
                    'title' => 'Memahami Konsep Rekan Sekerja Allah dalam Pelayanan',
                    'category' => 'Kajian Teologi',
                    'author' => 'Pnt. Alex R. Jacobus',
                    'date' => '08 Mei 2024',
                    'excerpt' => 'Menjadi kawan sekerja Allah menyiratkan hubungan timbal balik yang mesra antara Allah dan manusia dalam mengerjakan keselamatan dunia.',
                    'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'memahami-konsep-rekan-sekerja'
                ],
                (object)[
                    'title' => 'Pentingnya Ibadah Keluarga di Era Digital',
                    'category' => 'Bahan Khotbah',
                    'author' => 'Pdt. Dodi Wijaja',
                    'date' => '01 Mei 2024',
                    'excerpt' => 'Di tengah kesibukan gawai dan media sosial, menyisihkan waktu 15 menit untuk mezbah keluarga dapat membawa transformasi rohani yang luar biasa.',
                    'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'pentingnya-ibadah-keluarga'
                ],
            ];
        @endphp

        @if($hasArticles && count($dummyArticles) > 0)
            
            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Looping Data Artikel (Gunakan foreach($articles as $article) nanti) -->
                @foreach($dummyArticles as $article)
                    <article class="bg-white rounded-2xl overflow-hidden border border-outline-variant/50 shadow-sm hover:shadow-lg transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
                        <!-- Thumbnail -->
                        <div class="aspect-[16/10] overflow-hidden relative">
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <!-- Kategori Badge -->
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-md">
                                <span class="font-label-sm text-secondary uppercase tracking-wider">{{ $article->category }}</span>
                            </div>
                        </div>
                        
                        <!-- Konten -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Meta Data -->
                            <div class="flex items-center gap-3 font-caption text-on-surface-variant mb-4">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    <span>{{ $article->date }}</span>
                                </div>
                                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">person</span>
                                    <span class="truncate max-w-[120px]">{{ $article->author }}</span>
                                </div>
                            </div>
                            
                            <!-- Judul -->
                            <h2 class="font-h3 text-h3 text-primary-container mb-3 group-hover:text-secondary transition-colors line-clamp-2">
                                <a href="{{ route('artikel.show', $article->slug) }}" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $article->title }}
                                </a>
                            </h2>
                            
                            <!-- Ringkasan -->
                            <p class="font-body-md text-on-surface-variant leading-relaxed mb-6 line-clamp-3 flex-grow">
                                {{ $article->excerpt }}
                            </p>
                            
                            <!-- Tombol Aksi -->
                            <div class="mt-auto flex items-center font-label-md text-secondary uppercase tracking-widest group-hover:text-primary-container transition-colors">
                                <span>Baca Artikel</span>
                                <span class="material-symbols-outlined ml-1 group-hover:translate-x-2 transition-transform duration-300">arrow_forward</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination (Backend Note: cukup gunakan $articles->links() jika pakai Tailwind pagination bawaan Laravel) -->
            <!-- Di bawah ini adalah referensi visual jika butuh custom styling -->
            <div class="flex justify-center items-center gap-2 border-t border-outline-variant/30 pt-8">
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-colors disabled:opacity-50">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-secondary text-white font-label-md">1</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface hover:bg-surface-container font-label-md transition-colors">2</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface hover:bg-surface-container font-label-md transition-colors">3</a>
                <span class="w-10 h-10 flex items-center justify-center text-outline">...</span>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface hover:bg-surface-container font-label-md transition-colors">12</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            </div>

        @else
            <!-- ========================================== -->
            <!-- EMPTY STATE / PEMELIHARAAN                 -->
            <!-- ========================================== -->
            <div class="bg-surface-container rounded-[2rem] p-8 md:p-16 text-center flex flex-col items-center justify-center border-2 border-dashed border-outline-variant/50 max-w-4xl mx-auto my-12">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-secondary text-5xl">edit_document</span>
                </div>
                <h2 class="font-h1 text-h1 text-primary-container mb-4">Sedang Menyusun Inspirasi</h2>
                <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed mb-8">
                    Halaman Artikel saat ini belum memiliki konten atau sedang dalam masa pemeliharaan sistem. Ruang ini nantinya akan menjadi sumber <strong>Bahan Khotbah</strong>, <strong>Renungan Harian</strong>, dan inspirasi rohani lainnya bagi Jemaat GKI Pakuwon.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-primary-container text-white rounded-full font-label-md hover:bg-primary transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">home</span>
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('warta.index') }}" class="px-6 py-3 bg-white border border-outline-variant text-primary-container rounded-full font-label-md hover:bg-surface-container-low transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">newspaper</span>
                        Baca Warta Jemaat
                    </a>
                </div>
            </div>
        @endif
        
    </div>
</x-layout>
