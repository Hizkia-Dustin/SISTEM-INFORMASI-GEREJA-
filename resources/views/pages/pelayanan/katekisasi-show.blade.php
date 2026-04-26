<x-layout title="Detail Kelas Katekisasi" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        @php
            // =================================================================
            // CATATAN UNTUK BACKEND DEVELOPER:
            // 
            // Variabel $course di bawah ini adalah dummy data. 
            // Di level controller, gunakan Route Model Binding atau 
            // $course = Course::where('slug', $slug)->firstOrFail();
            // =================================================================
            
            $course = (object)[
                'title' => 'Katekisasi Sidi Dasar: Pengenalan Alkitab',
                'category' => 'Persiapan Sidi',
                'instructor' => 'Pdt. Dr. Yerusa Maria Agustini',
                'modules' => 12,
                'duration' => '3 Bulan',
                'level' => 'Dasar',
                'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?q=80&w=1200&auto=format&fit=crop',
                'slug' => 'katekisasi-sidi-dasar',
                'progress' => 35,
                'description' => '
                    <p>Kelas ini dirancang khusus bagi calon sidi untuk memahami dasar-dasar iman Kristen secara komprehensif. Kita akan membahas tentang Allah Tritunggal, penciptaan, kejatuhan manusia, sejarah keselamatan, hingga peran gereja di dunia modern.</p>
                    <p>Materi disampaikan melalui gabungan studi mandiri secara online dan pertemuan tatap muka mingguan untuk diskusi mendalam bersama Pendeta dan Majelis Jemaat.</p>
                    
                    <h4>Tujuan Pembelajaran</h4>
                    <ul>
                        <li>Memahami doktrin dasar kekristenan sesuai dengan pengakuan iman GKI.</li>
                        <li>Mampu membaca dan menggali makna Alkitab secara mandiri.</li>
                        <li>Mempersiapkan diri secara rohani untuk menerima sakramen Sidi (Peneguhan Janji Baptis).</li>
                    </ul>
                ',
                'syllabus' => [
                    [
                        'title' => 'Modul 1: Doktrin Allah Tritunggal',
                        'lessons' => ['Mengenal Allah Bapa', 'Karya Penyelamatan Yesus Kristus', 'Peran Roh Kudus dalam Hidup Orang Percaya']
                    ],
                    [
                        'title' => 'Modul 2: Alkitab sebagai Firman Allah',
                        'lessons' => ['Sejarah Penulisan Alkitab', 'Cara Membaca dan Memahami Konteks', 'Menerapkan Firman dalam Keseharian']
                    ],
                    [
                        'title' => 'Modul 3: Dosa dan Anugerah',
                        'lessons' => ['Kejatuhan Manusia', 'Konsep Keselamatan (Soteriologi)', 'Merespons Kasih Karunia']
                    ],
                    [
                        'title' => 'Modul 4: Gereja dan Sakramen',
                        'lessons' => ['Arti dan Fungsi Gereja', 'Sakramen Baptisan Kudus', 'Sakramen Perjamuan Kudus']
                    ]
                ]
            ];
        @endphp

        <!-- Breadcrumb & Back Button -->
        <div class="mb-8 flex items-center justify-between gap-4 flex-wrap">
            <a href="{{ route('pelayanan.katekisasi') }}" class="inline-flex items-center gap-2 font-label-md text-on-surface-variant hover:text-secondary transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Daftar Kelas
            </a>
            
            <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a href="{{ route('pelayanan.katekisasi') }}" class="hover:text-primary transition-colors">Katekisasi</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="truncate max-w-[150px] text-primary font-medium">{{ $course->title }}</span>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Kiri: Konten Utama -->
            <div class="flex-grow max-w-4xl">
                <!-- Cover Image & Header -->
                <div class="bg-white rounded-3xl overflow-hidden border border-outline-variant/30 shadow-sm mb-8">
                    <div class="w-full h-[250px] md:h-[400px] relative">
                        <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent"></div>
                        
                        <!-- Title Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <div class="mb-3 inline-block px-3 py-1 bg-secondary text-white rounded-md font-label-sm uppercase tracking-widest shadow-sm">
                                {{ $course->category }}
                            </div>
                            <h1 class="font-h1 text-3xl md:text-4xl font-bold leading-tight mb-4">
                                {{ $course->title }}
                            </h1>
                            <div class="flex items-center gap-3 font-caption opacity-90">
                                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                </div>
                                <span class="text-base font-medium">Oleh: {{ $course->instructor }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs (Mockup) -->
                <div class="flex border-b border-outline-variant/50 mb-8 overflow-x-auto no-scrollbar">
                    <button class="px-6 py-4 font-label-md text-primary border-b-2 border-primary whitespace-nowrap">Ikhtisar Kelas</button>
                    <button class="px-6 py-4 font-label-md text-on-surface-variant hover:text-primary whitespace-nowrap transition-colors">Daftar Modul</button>
                    <button class="px-6 py-4 font-label-md text-on-surface-variant hover:text-primary whitespace-nowrap transition-colors">Diskusi Kelas</button>
                </div>

                <!-- Deskripsi Kelas -->
                <div class="mb-12">
                    <h2 class="font-h2 text-2xl text-primary-container mb-6">Tentang Kelas Ini</h2>
                    <div class="prose prose-slate max-w-none 
                                prose-headings:font-h3 prose-headings:text-primary-container
                                prose-p:font-body-lg prose-p:text-on-surface prose-p:leading-relaxed
                                prose-ul:list-disc prose-ul:pl-6 prose-li:font-body-md prose-li:mb-2">
                        {!! $course->description !!}
                    </div>
                </div>

                <!-- Silabus / Kurikulum (Alpine Accordion) -->
                <div class="mb-8" x-data="{ openModul: 0 }">
                    <h2 class="font-h2 text-2xl text-primary-container mb-6">Kurikulum Pembelajaran</h2>
                    
                    <div class="border border-outline-variant/40 rounded-2xl overflow-hidden bg-white">
                        @foreach($course->syllabus as $index => $modul)
                            <div class="border-b border-outline-variant/40 last:border-b-0">
                                <!-- Accordion Header -->
                                <button @click="openModul = openModul === {{ $index }} ? null : {{ $index }}" 
                                        class="w-full text-left px-6 py-4 flex items-center justify-between hover:bg-surface-container-low transition-colors focus:outline-none">
                                    <div class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-full bg-surface flex items-center justify-center text-on-surface-variant shrink-0">
                                            <span class="font-label-md">{{ $index + 1 }}</span>
                                        </div>
                                        <span class="font-h3 text-lg text-primary-container">{{ $modul['title'] }}</span>
                                    </div>
                                    <span class="material-symbols-outlined text-on-surface-variant transition-transform duration-300" 
                                          :class="openModul === {{ $index }} ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                
                                <!-- Accordion Content -->
                                <div x-show="openModul === {{ $index }}" 
                                     x-collapse 
                                     x-cloak>
                                    <div class="px-6 py-4 bg-surface-container-lowest font-body-md text-on-surface">
                                        <ul class="space-y-3">
                                            @foreach($modul['lessons'] as $lessonIndex => $lesson)
                                                <li class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 rounded-xl border border-outline-variant/30 hover:border-secondary/40 hover:bg-surface-container-low transition-colors group">
                                                    <div class="flex items-start gap-3">
                                                        <div class="w-10 h-10 rounded-lg bg-surface flex items-center justify-center text-secondary shrink-0">
                                                            <span class="material-symbols-outlined">description</span>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium text-on-surface">{{ $lesson }}</p>
                                                            <p class="text-sm text-on-surface-variant flex items-center gap-1 mt-1">
                                                                <span class="material-symbols-outlined text-[14px]">picture_as_pdf</span> PDF & PPT
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex gap-2 pl-13 sm:pl-0">
                                                        <a href="#" class="px-3 py-1.5 bg-white border border-outline-variant rounded-lg text-sm font-medium text-primary hover:bg-surface-container hover:text-secondary transition-colors flex items-center gap-1">
                                                            PPT
                                                        </a>
                                                        <a href="#" class="px-3 py-1.5 bg-white border border-outline-variant rounded-lg text-sm font-medium text-primary hover:bg-surface-container hover:text-secondary transition-colors flex items-center gap-1">
                                                            PDF
                                                        </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kanan: Sidebar Mengambang -->
            <div class="lg:w-[380px] shrink-0">
                <div class="sticky top-24 bg-white rounded-3xl border border-outline-variant/50 shadow-lg p-6 lg:p-8">
                    
                    <div class="mb-8 flex flex-col gap-3">
                        <button class="w-full py-4 bg-secondary text-white rounded-full font-label-md hover:bg-primary transition-colors shadow-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">download</span>
                            Unduh Semua Materi (ZIP)
                        </button>
                        <button class="w-full py-3 bg-white border border-outline-variant text-primary rounded-full font-label-md hover:bg-surface-container transition-colors shadow-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">print</span>
                            Cetak Silabus
                        </button>
                    </div>

                    <h3 class="font-h3 text-lg text-primary-container mb-4">Detail Kelas</h3>
                    
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4 text-on-surface">
                            <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div>
                                <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-0.5">Tingkat</p>
                                <p class="font-medium">{{ $course->level }}</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 text-on-surface">
                            <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined">menu_book</span>
                            </div>
                            <div>
                                <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-0.5">Materi</p>
                                <p class="font-medium">{{ $course->modules }} Modul Pembelajaran</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 text-on-surface">
                            <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                            <div>
                                <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-0.5">Estimasi Waktu</p>
                                <p class="font-medium">{{ $course->duration }}</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 text-on-surface">
                            <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined">verified</span>
                            </div>
                            <div>
                                <p class="font-label-sm text-on-surface-variant text-xs uppercase tracking-wider mb-0.5">Sertifikat</p>
                                <p class="font-medium">Sertifikat / Surat Sidi</p>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            
        </div>
        
    </div>
</x-layout>

