<x-layouts.main title="Kelas Katekisasi" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <div class="inline-flex items-center px-3 py-1 bg-secondary-container text-white rounded-full mb-4">
                    <span class="font-label-sm text-xs uppercase tracking-wider font-bold">Portal Pembelajaran</span>
                </div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Kelas <span class="text-secondary">Katekisasi</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Akses materi persiapan Baptis Kudus dan Sidi secara online. Pelajari dasar-dasar iman Kristen dari mana saja dan kapan saja.
                </p>
            </div>
            
            <!-- Pencarian Kelas -->
            <div class="w-full md:w-80 relative">
                <input type="text" placeholder="Cari kelas atau materi..." class="w-full pl-12 pr-4 py-3 rounded-full border border-outline-variant bg-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all font-body-md text-on-surface shadow-sm">
                <span class="material-symbols-outlined absolute left-4 top-3 text-outline">search</span>
            </div>
        </header>

        <!-- Kategori Filter -->
        <div class="flex flex-nowrap overflow-x-auto gap-3 mb-10 pb-2 no-scrollbar">
            <a href="#" class="px-5 py-2 rounded-full bg-secondary text-white font-label-md whitespace-nowrap shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">school</span> Semua Kelas
            </a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Persiapan Baptis Anak</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Persiapan Baptis Dewasa / Sidi</a>
            <a href="#" class="px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm">Katekisasi Pra-Nikah</a>
        </div>

        @php
            // =================================================================
            // CATATAN UNTUK BACKEND DEVELOPER:
            // 
            // Ubah variabel `$hasCourses` menjadi `false` untuk melihat 
            // tampilan Empty State.
            // =================================================================
            
            $hasCourses = true; 
            
            // Dummy Data untuk Kelas Katekisasi
            $courses = [
                (object)[
                    'title' => 'Katekisasi Sidi Dasar: Pengenalan Alkitab',
                    'category' => 'Persiapan Sidi',
                    'instructor' => 'Pdt. Dr. Yerusa Maria Agustini',
                    'modules' => 12,
                    'duration' => '3 Bulan',
                    'level' => 'Dasar',
                    'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'katekisasi-sidi-dasar',
                    'progress' => 0
                ],
                (object)[
                    'title' => 'Dogmatika & Sejarah Gereja',
                    'category' => 'Persiapan Sidi',
                    'instructor' => 'Pnt. Alex R. Jacobus',
                    'modules' => 8,
                    'duration' => '2 Bulan',
                    'level' => 'Menengah',
                    'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'dogmatika-sejarah-gereja',
                    'progress' => 35
                ],
                (object)[
                    'title' => 'Bina Pra-Nikah: Membangun Keluarga Kristen',
                    'category' => 'Pra-Nikah',
                    'instructor' => 'Pdt. Dodi Wijaja',
                    'modules' => 10,
                    'duration' => '10 Minggu',
                    'level' => 'Khusus',
                    'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'bina-pra-nikah',
                    'progress' => 100
                ],
                (object)[
                    'title' => 'Persiapan Baptis Anak untuk Orang Tua',
                    'category' => 'Persiapan Baptis',
                    'instructor' => 'Komisi Dewasa & Pendeta',
                    'modules' => 4,
                    'duration' => '1 Bulan',
                    'level' => 'Dasar',
                    'image' => 'https://images.unsplash.com/photo-1516307365426-bea591f05011?q=80&w=800&auto=format&fit=crop',
                    'slug' => 'baptis-anak-ortu',
                    'progress' => 0
                ],
            ];
        @endphp

        @if($hasCourses && count($courses) > 0)
            
            <!-- Grid Kelas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @foreach($courses as $course)
                    <!-- Course Card -->
                    <article class="bg-white rounded-2xl overflow-hidden border border-outline-variant/50 shadow-sm hover:shadow-xl hover:border-secondary/30 transition-all duration-300 group flex flex-col h-full relative">
                        
                        <!-- Thumbnail Area -->
                        <div class="aspect-video overflow-hidden relative">
                            <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-md">
                                <span class="font-label-sm text-[10px] text-secondary uppercase tracking-wider font-bold">{{ $course->category }}</span>
                            </div>
                            
                            <div class="absolute bottom-3 left-3 flex items-center gap-3 text-white text-xs font-medium">
                                <div class="flex items-center gap-1 bg-black/40 backdrop-blur-md px-2 py-1 rounded-md">
                                    <span class="material-symbols-outlined text-[14px]">menu_book</span>
                                    {{ $course->modules }} Modul
                                </div>
                                <div class="flex items-center gap-1 bg-black/40 backdrop-blur-md px-2 py-1 rounded-md">
                                    <span class="material-symbols-outlined text-[14px]">schedule</span>
                                    {{ $course->duration }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-5 flex flex-col flex-grow">
                            <!-- Title -->
                            <h2 class="font-h3 text-lg text-primary-container mb-3 group-hover:text-secondary transition-colors line-clamp-2 leading-tight">
                                <a href="{{ route('pelayanan.katekisasi.show', $course->slug) }}" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $course->title }}
                                </a>
                            </h2>
                            
                            <!-- Instructor -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center text-primary overflow-hidden shrink-0">
                                    <span class="material-symbols-outlined text-[14px]">person</span>
                                </div>
                                <span class="font-caption text-sm text-on-surface-variant truncate">{{ $course->instructor }}</span>
                            </div>
                            
                            <!-- Action (Bottom) -->
                            <div class="mt-auto pt-4 border-t border-outline-variant/30">
                                <div class="flex items-center justify-between font-label-md text-primary uppercase tracking-wider text-xs group-hover:text-secondary transition-colors mt-2">
                                    <span>Lihat Modul & Materi</span>
                                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination Mock -->
            <x-ui.pagination />

        @else
            <!-- Empty State -->
            <x-ui.empty-state title="Belum Ada Kelas Aktif" icon="school">
                <p>Saat ini belum ada jadwal kelas Katekisasi yang dibuka. Silakan hubungi Sekretariat Gereja untuk informasi pendaftaran gelombang berikutnya.</p>
            </x-ui.empty-state>
        @endif
        
    </div>
</x-layouts.main>

