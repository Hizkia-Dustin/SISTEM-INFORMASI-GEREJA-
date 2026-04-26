<x-layout title="Jadwal Kebaktian & Persekutuan" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-16 text-center">
            <div class="inline-flex items-center px-3 py-1 bg-secondary-container text-white rounded-full mb-4">
                <span class="font-label-sm text-xs uppercase tracking-wider font-bold">Kegiatan Pelayanan</span>
            </div>
            <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-6">Jadwal <span class="text-secondary">Kebaktian & Persekutuan</span></h1>
            <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed">
                Mari bertumbuh bersama dalam iman dan kasih melalui ibadah dan persekutuan yang diadakan secara rutin untuk setiap jenjang usia.
            </p>
        </header>

        <!-- Jadwal Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-16">
            
            <!-- Kebaktian Anak -->
            <div class="bg-white rounded-3xl p-8 border border-outline-variant/30 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[28px]">child_care</span>
                </div>
                <h3 class="font-h3 text-2xl text-primary-container mb-2">Kebaktian Anak</h3>
                <p class="text-on-surface-variant text-sm mb-6">Ibadah khusus untuk anak-anak sekolah minggu.</p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">calendar_today</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Hari</p>
                            <p class="font-medium text-primary">Minggu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">schedule</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Waktu</p>
                            <p class="font-medium text-primary">07:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kebaktian Remaja -->
            <div class="bg-white rounded-3xl p-8 border border-outline-variant/30 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                <div class="w-14 h-14 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[28px]">cruelty_free</span>
                </div>
                <h3 class="font-h3 text-2xl text-primary-container mb-2">Kebaktian Remaja</h3>
                <p class="text-on-surface-variant text-sm mb-6">Ibadah dan persekutuan untuk pra-remaja dan remaja.</p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">calendar_today</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Hari</p>
                            <p class="font-medium text-primary">Minggu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">schedule</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Waktu</p>
                            <p class="font-medium text-primary">10:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kebaktian Pemuda -->
            <div class="bg-white rounded-3xl p-8 border border-outline-variant/30 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                <div class="w-14 h-14 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[28px]">group</span>
                </div>
                <h3 class="font-h3 text-2xl text-primary-container mb-2">Kebaktian Pemuda</h3>
                <p class="text-on-surface-variant text-sm mb-6">Ibadah dan diskusi interaktif untuk kaum muda/i.</p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">calendar_today</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Hari</p>
                            <p class="font-medium text-primary">Minggu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">schedule</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Waktu</p>
                            <p class="font-medium text-primary">10:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Persekutuan Dewasa -->
            <div class="bg-white rounded-3xl p-8 border border-outline-variant/30 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group md:col-span-2 lg:col-span-1">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                <div class="w-14 h-14 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[28px]">family_restroom</span>
                </div>
                <h3 class="font-h3 text-2xl text-primary-container mb-2">Persekutuan Dewasa</h3>
                <p class="text-on-surface-variant text-sm mb-6">Persekutuan doa dan PA bagi jemaat dewasa & pasutri.</p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">calendar_today</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Hari</p>
                            <p class="font-medium text-primary">Rabu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">schedule</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Waktu</p>
                            <p class="font-medium text-primary">19:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Persekutuan Usia Indah/Lansia -->
            <div class="bg-white rounded-3xl p-8 border border-outline-variant/30 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group md:col-span-2 lg:col-span-2">
                <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[28px]">elderly</span>
                </div>
                <h3 class="font-h3 text-2xl text-primary-container mb-2">Persekutuan Usia Indah / Lansia</h3>
                <p class="text-on-surface-variant text-sm mb-6">Persekutuan khusus bagi jemaat senior (lansia) untuk terus bertumbuh, berbagi kesaksian, dan memuji Tuhan bersama di masa usia indah.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">event_repeat</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Jadwal</p>
                            <p class="font-medium text-primary">Sabtu <span class="text-sm font-normal text-on-surface-variant">(Minggu Ketiga)</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-lowest border border-outline-variant/50 p-3 rounded-xl">
                        <span class="material-symbols-outlined text-secondary">schedule</span>
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase">Waktu</p>
                            <p class="font-medium text-primary">10:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Banner Info Tambahan -->
        <div class="max-w-4xl mx-auto bg-primary-container text-white rounded-3xl p-8 md:p-12 relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined" style="font-size: 200px; line-height: 1;">church</span>
            </div>
            
            <div class="relative z-10 text-center md:text-left flex flex-col md:flex-row items-center gap-8 justify-between">
                <div>
                    <h2 class="font-h2 text-3xl mb-3 text-white">Butuh Informasi Lebih Lanjut?</h2>
                    <p class="font-body-md text-white/80 max-w-xl">
                        Untuk mengetahui detail ruangan, tautan kebaktian online (jika ada), atau pertanyaan lainnya, jangan ragu untuk menghubungi sekretariat gereja kami.
                    </p>
                </div>
                <a href="https://wa.me/6281234567890" target="_blank" class="shrink-0 px-8 py-4 bg-white text-primary-container rounded-full font-label-md hover:bg-surface-container-lowest transition-colors shadow-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    Hubungi Kami
                </a>
            </div>
        </div>

    </div>
</x-layout>
