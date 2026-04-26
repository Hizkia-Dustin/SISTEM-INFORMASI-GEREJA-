<x-layout title="Konseling Pastoral" :fullWidth="true">
    <div class="max-w-[1440px] mx-auto px-8 py-12 md:py-16">
        
        <!-- Header Section -->
        <header class="mb-16 text-center md:text-left flex flex-col md:flex-row items-center gap-10">
            <div class="flex-grow">
                <div class="inline-flex items-center px-3 py-1 bg-secondary-container text-white rounded-full mb-4">
                    <span class="font-label-sm text-xs uppercase tracking-wider font-bold">Layanan Pastoral</span>
                </div>
                <h1 class="font-h1 text-4xl md:text-5xl text-primary-container mb-6">Konseling <span class="text-secondary">Pastoral</span></h1>
                <p class="font-body-lg text-on-surface-variant max-w-2xl leading-relaxed mb-6">
                    Gereja hadir untuk mendampingi, mendengarkan, dan mendoakan Anda. Jika Anda sedang menghadapi pergumulan hidup, krisis keluarga, atau sekadar membutuhkan bimbingan rohani, hamba Tuhan kami siap melayani Anda.
                </p>
            </div>
            
            <!-- Hero Illustration/Image (Mockup) -->
            <div class="w-full md:w-5/12 h-64 md:h-80 rounded-3xl overflow-hidden shadow-lg relative shrink-0">
                <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?q=80&w=800&auto=format&fit=crop" alt="Ilustrasi Konseling Pastoral" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-primary/20"></div>
            </div>
        </header>

        <!-- Main Card Profil & Jadwal -->
        <div class="max-w-4xl mx-auto bg-white rounded-3xl border border-outline-variant/40 shadow-xl overflow-hidden flex flex-col md:flex-row relative">
            
            <!-- Dekorasi Kiri -->
            <div class="absolute top-0 left-0 w-2 h-full bg-secondary"></div>

            <!-- Bagian Profil (Kiri) -->
            <div class="md:w-1/2 p-8 md:p-12 bg-surface-container-lowest border-b md:border-b-0 md:border-r border-outline-variant/30 flex flex-col items-center md:items-start text-center md:text-left">
                <!-- Foto Pendeta (Mockup) -->
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-md mb-6 bg-surface-container flex justify-center items-center">
                    <span class="material-symbols-outlined text-[64px] text-primary/40">person</span>
                </div>
                
                <h2 class="font-h2 text-2xl text-primary-container mb-1">Pdt. Yerusa Maria Agustini</h2>
                <p class="font-label-md text-secondary uppercase tracking-widest mb-6 text-sm">Konselor Pastoral</p>
                
                <p class="text-on-surface-variant font-body-md leading-relaxed mb-6">
                    Melayani konseling pribadi, pra-nikah, pernikahan, keluarga, dan kedukaan berdasarkan kebenaran Firman Tuhan.
                </p>
            </div>

            <!-- Bagian Detail & Jadwal (Kanan) -->
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                
                <div class="mb-8">
                    <div class="flex items-start gap-4 mb-5">
                        <div class="w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary shrink-0 mt-1">
                            <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-on-surface-variant uppercase text-xs font-bold mb-1">Hari Pelayanan</p>
                            <p class="font-h3 text-lg text-primary-container">Setiap Hari Kamis & Jumat</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 mb-5">
                        <div class="w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary shrink-0 mt-1">
                            <span class="material-symbols-outlined text-[20px]">schedule</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-on-surface-variant uppercase text-xs font-bold mb-1">Jam Pelayanan</p>
                            <p class="font-h3 text-lg text-primary-container">10.00 – 12.00 WIB</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary shrink-0 mt-1">
                            <span class="material-symbols-outlined text-[20px]">call</span>
                        </div>
                        <div>
                            <p class="font-label-sm text-on-surface-variant uppercase text-xs font-bold mb-1">Hubungi</p>
                            <p class="font-medium text-primary-container">Pastori: (021) 22956638</p>
                            <p class="font-medium text-primary-container">HP/WA: 0852 1774 7827</p>
                        </div>
                    </div>
                </div>

                <div class="bg-surface p-4 rounded-xl border border-outline-variant/50 flex gap-3 items-start">
                    <span class="material-symbols-outlined text-primary mt-0.5">event_available</span>
                    <div>
                        <p class="font-bold text-sm text-primary mb-1">Perhatian</p>
                        <p class="text-sm text-on-surface-variant">Harap membuat perjanjian (<i>appointment</i>) terlebih dahulu melalui nomor kontak di atas sebelum datang ke Pastori.</p>
                    </div>
                </div>

                <a href="https://wa.me/6285217747827" target="_blank" class="mt-8 w-full py-4 bg-primary-container text-white rounded-full font-label-md hover:bg-primary transition-colors shadow-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    Buat Perjanjian via WA
                </a>
            </div>
            
        </div>

    </div>
</x-layout>
