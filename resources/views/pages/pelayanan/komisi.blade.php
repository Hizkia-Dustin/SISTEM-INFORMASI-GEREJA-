<x-layouts.main title="Badan Kategorial (Komisi)" :fullWidth="true">
    <div class="max-w-[1024px] mx-auto px-8 py-12 md:py-16" 
         x-data="{ 
            activeTab: window.location.hash ? window.location.hash.substring(1) : 'anak',
            init() {
                window.addEventListener('hashchange', () => {
                    let hash = window.location.hash.substring(1);
                    if(['anak', 'dewasa', 'remaja', 'pemuda', 'usiaindah'].includes(hash)) {
                        this.activeTab = hash;
                    }
                });
            }
         }">
        
        <!-- Header Section -->
        <header class="mb-12 text-center md:text-left">
            <div class="inline-flex items-center px-3 py-1 bg-secondary-container text-white rounded-full mb-4">
                <span class="font-label-sm text-xs uppercase tracking-wider font-bold">Badan Kategorial</span>
            </div>
            <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-4">Komisi <span class="text-secondary">Jemaat</span></h1>
            <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                Temukan komunitas yang tepat untuk bertumbuh bersama. GKI Komplek Pakuwon memiliki berbagai komisi kategorial yang melayani setiap tahapan usia jemaat.
            </p>
        </header>

        @php
            $komisiList = [
                [
                    'id' => 'anak',
                    'title' => 'Komisi Anak',
                    'image' => 'https://images.unsplash.com/photo-1544256718-3bcf237f3974?q=80&w=1200&auto=format&fit=crop',
                    'icon' => 'child_care',
                    'short_desc' => 'Melayani ibadah dan pembinaan iman anak-anak (Balita hingga Pra-Remaja).',
                    'color' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'icon_bg' => 'bg-emerald-100 text-emerald-600',
                    'active_border' => 'border-emerald-500 ring-emerald-500',
                    'content' => '                        <p class="mb-4">Badan Pelayanan yang dibentuk dan dilantik untuk menangani pelayanan bagi anak-anak serta mengkoordinir guru-guru Sekolah Minggu yang menjadi ujung tombak pelayanan bagi anak-anak tersebut.</p>
                        
                        <h4 class="font-bold text-primary-container mt-6 mb-2">Kelas Komisi Anak</h4>
                        <p class="mb-2 text-on-surface">Untuk Komisi Anak terdapat beberapa kelas yaitu:</p>
                        <ul class="list-disc pl-5 mb-6 text-on-surface space-y-1">
                            <li><strong>Betlehem:</strong> Kelas sekolah minggu yang melayani anak usia 1 bln-3 thn</li>
                            <li><strong>Roma:</strong> Kelas sekolah minggu yang melayani anak usia 4-6 thn/Play Group – TKB</li>
                            <li><strong>Yerusalem:</strong> Kelas sekolah minggu yang melayani anak usia 6-8thn/kls 1-2 SD</li>
                            <li><strong>Zipora:</strong> Kelas sekolah minggu yang melayani anak usia 8-10thn/ kls 3-4 SD</li>
                            <li><strong>Daniel:</strong> Kelas sekolah minggu yang melayani anak usia 10-12thn/ kls 5-6 SD</li>
                            <li><strong>Tunas Remaja (TR):</strong> Kelas sekolah minggu yang melayani anak usia 12-14 thn/kls 1-3 SMP</li>
                        </ul>

                        <h4 class="font-bold text-primary-container mt-6 mb-2">Guru Sekolah Minggu</h4>
                        <p class="text-on-surface">Guru Sekolah Minggu adalah anggota jemaat yang terpanggil dan dilengkapi untuk mengajar dan memberikan teladan hidup iman pada anak-anak yang dipercayakan kepada mereka.</p>'
                ],
                [
                    'id' => 'remaja',
                    'title' => 'Komisi Remaja',
                    'image' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?q=80&w=1200&auto=format&fit=crop',
                    'icon' => 'cruelty_free',
                    'short_desc' => 'Wadah persekutuan bagi remaja SMP hingga SMA untuk bertumbuh dalam Kristus.',
                    'color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                    'icon_bg' => 'bg-indigo-100 text-indigo-600',
                    'active_border' => 'border-indigo-500 ring-indigo-500',
                    'content' => '                        <p class="mb-4">Badan Pelayanan yang dibentuk dan dilantik untuk menangani kegiatan yang menghasilkan persekutuan, pembinaan, dan kesaksian bagi dan diantara remaja.</p>'
                ],
                [
                    'id' => 'pemuda',
                    'title' => 'Komisi Pemuda',
                    'image' => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=1200&auto=format&fit=crop',
                    'icon' => 'group',
                    'short_desc' => 'Mempersiapkan pemuda/i menjadi garam dan terang dalam dunia perkuliahan & karir.',
                    'color' => 'bg-orange-50 text-orange-700 border-orange-200',
                    'icon_bg' => 'bg-orange-100 text-orange-600',
                    'active_border' => 'border-orange-500 ring-orange-500',
                    'content' => '                        <p class="mb-4">Badan Pelayanan dibentuk dan dilantik untuk menciptakan persekutuan, pembinaan dan kesaksian bagi muda mudi.</p>'
                ],
                [
                    'id' => 'dewasa',
                    'title' => 'Komisi Dewasa',
                    'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1200&auto=format&fit=crop',
                    'icon' => 'family_restroom',
                    'short_desc' => 'Membina kaum dewasa dan keluarga Kristen yang kokoh serta menjadi teladan.',
                    'color' => 'bg-sky-50 text-sky-700 border-sky-200',
                    'icon_bg' => 'bg-sky-100 text-sky-600',
                    'active_border' => 'border-sky-500 ring-sky-500',
                    'content' => '                        <p class="mb-4">Badan pelayanan yang dibentuk dan dilantik untuk menangani pelayanan bagi jemaat dewasa di gereja. Dalam cakupannya, komisi ini melayani baik para wanita maupun pria dewasa yang baru berkeluarga maupun yang sudah lama berkeluarga atau yang tidak menikah, janda atau duda.</p>'
                ],
                [
                    'id' => 'usiaindah',
                    'title' => 'Komisi Usia Indah',
                    'image' => 'https://images.unsplash.com/photo-1516307365426-bea591f05011?q=80&w=1200&auto=format&fit=crop',
                    'icon' => 'elderly',
                    'short_desc' => 'Persekutuan bagi kaum lansia (55 tahun ke atas) agar tetap produktif dan bersukacita.',
                    'color' => 'bg-rose-50 text-rose-700 border-rose-200',
                    'icon_bg' => 'bg-rose-100 text-rose-600',
                    'active_border' => 'border-rose-500 ring-rose-500',
                    'content' => '                        <p class="mb-4">Badan pelayanan yang dibentuk dan dilantik untuk menangani pelayanan bagi jemaat Usia lanjut. Dalam cakupannya komisi ini membina, menampung, mengarahkan dan menyalurkan talenta-talenta yang ada untuk kehidupan bersama yang sehat, kreatif dan berguna.</p>'
                ],
            ];
        @endphp

        <!-- Accordion List -->
        <div class="space-y-4">
            @foreach($komisiList as $komisi)
                <div class="bg-white rounded-2xl border transition-all duration-300 shadow-sm hover:shadow-md overflow-hidden"
                     :class="activeTab === '{{ $komisi['id'] }}' ? '{{ $komisi['active_border'] }} ring-1' : 'border-outline-variant/60'">
                    
                    <!-- Accordion Header -->
                    <button @click="activeTab = activeTab === '{{ $komisi['id'] }}' ? '' : '{{ $komisi['id'] }}'; window.location.hash = '{{ $komisi['id'] }}';" 
                            class="w-full text-left px-6 py-5 flex items-center justify-between gap-6 focus:outline-none bg-white">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0 {{ $komisi['icon_bg'] }}">
                                <span class="material-symbols-outlined text-[28px]">{{ $komisi['icon'] }}</span>
                            </div>
                            <div>
                                <h3 class="font-h3 text-xl md:text-2xl text-primary-container mb-1">{{ $komisi['title'] }}</h3>
                                <p class="text-sm md:text-base text-on-surface-variant">{{ $komisi['short_desc'] }}</p>
                            </div>
                        </div>
                        <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center bg-surface transition-transform duration-300"
                             :class="activeTab === '{{ $komisi['id'] }}' ? 'rotate-180 bg-secondary text-white' : 'text-on-surface-variant'">
                            <span class="material-symbols-outlined">expand_more</span>
                        </div>
                    </button>

                    <!-- Accordion Content -->
                    <div x-show="activeTab === '{{ $komisi['id'] }}'" 
                         x-collapse 
                         x-cloak
                         class="border-t border-outline-variant/30">
                        <div class="p-6 md:p-8 bg-surface-container-lowest">
                            @if(!empty($komisi['image']))
                                <div class="w-full h-48 md:h-64 rounded-xl overflow-hidden mb-8 shadow-sm">
                                    <img src="{{ $komisi['image'] }}" alt="{{ $komisi['title'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                                </div>
                            @endif
                            <div class="font-body-md text-on-surface">
                                {!! $komisi['content'] !!}
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-outline-variant/50 flex flex-wrap gap-4">
                                <a href="{{ route('pelayanan.daftar', ['komisi' => $komisi['title']]) }}" class="px-6 py-2 bg-secondary text-white rounded-full font-label-md hover:bg-primary transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">group_add</span>
                                    Daftar Pelayanan
                                </a>
                                <a href="{{ route('kontak.index') }}" class="px-6 py-2 bg-white border border-outline-variant text-primary rounded-full font-label-md hover:bg-surface-container transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">forum</span>
                                    Hubungi Pengurus
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>

    </div>
</x-layouts.main>


