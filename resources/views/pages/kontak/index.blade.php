<x-layouts.main title="Hubungi & Temukan Kami" :fullWidth="true">
    @php
        $phone = \App\Models\Setting::get('phone', '+62 812-3456-7890');
        $email = \App\Models\Setting::get('email', 'info@gkipakuwon.or.id');
        $address = \App\Models\Setting::get('address', 'Jl. Pakuwon Indah Raya No. 12, Surabaya, Jawa Timur');
        $mapsLink = \App\Models\Setting::get('maps_link');
        $instagram = \App\Models\Setting::get('instagram_link');
        $youtube = \App\Models\Setting::get('youtube_link');

        $embedUrl = '';
        $fallbackEmbed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.575230303866!2d112.6732386!3d-7.2890697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fc20c3848b61%3A0xeab43ad18e47bf1b!2sGKI%20Pakuwon!5e0!3m2!1sid!2sid!4v1717640000000!5m2!1sid!2sid';

        if ($mapsLink) {
            if (str_contains($mapsLink, '<iframe')) {
                if (preg_match('/src="([^"]+)"/', $mapsLink, $matches)) {
                    $embedUrl = $matches[1];
                }
            } elseif (str_contains($mapsLink, 'maps.google') || str_contains($mapsLink, 'goo.gl/maps') || str_contains($mapsLink, 'google.com/maps')) {
                if (str_contains($mapsLink, '/embed')) {
                    $embedUrl = $mapsLink;
                } else {
                    $embedUrl = ''; // We'll link to it and use fallback for embed
                }
            }
        }
        
        $finalEmbed = $embedUrl ?: $fallbackEmbed;
        $finalLink = $mapsLink ?: 'https://maps.app.goo.gl/tWp12345';
    @endphp

    <div class="py-12 bg-gradient-to-b from-[#f4f7ff] to-[#f8f9ff]">
        <div class="container mx-auto px-8 max-w-7xl">
            <!-- Header Section -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="bg-[#0058bf]/10 text-[#0058bf] px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest mb-4 inline-block">Kontak Kami</span>
                <h1 class="font-[Manrope] text-5xl font-extrabold text-[#001142] tracking-tight mb-4">Mari Terhubung Bersama</h1>
                <p class="text-slate-500 text-base leading-relaxed">Punya pertanyaan seputar ibadah, pendaftaran jemaat, atau pelayanan kasih kami? Hubungi kami atau kunjungi gereja kami secara langsung.</p>
            </div>

            <!-- Contact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Address Card -->
                <div class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm flex flex-col items-center text-center group hover:border-[#0058bf]/30 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-[#eff4ff] text-[#0058bf] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#0058bf] group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                    </div>
                    <h3 class="font-[Manrope] text-lg font-bold text-[#001142] mb-3">Alamat Gereja</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $address }}</p>
                    <a href="{{ $finalLink }}" target="_blank" class="mt-auto text-[#0058bf] hover:text-[#00236f] text-xs font-bold flex items-center gap-1">
                        Petunjuk Arah <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>

                <!-- Call Card -->
                <div class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm flex flex-col items-center text-center group hover:border-[#0058bf]/30 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-[#eff4ff] text-[#0058bf] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#0058bf] group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">phone</span>
                    </div>
                    <h3 class="font-[Manrope] text-lg font-bold text-[#001142] mb-3">Telepon & WhatsApp</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Hubungi sekretariat gereja untuk layanan administrasi dan informasi umum.</p>
                    <a href="tel:{{ $phone }}" class="mt-auto text-[#0058bf] hover:text-[#00236f] text-sm font-extrabold">
                        {{ $phone }}
                    </a>
                </div>

                <!-- Mail Card -->
                <div class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm flex flex-col items-center text-center group hover:border-[#0058bf]/30 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-[#eff4ff] text-[#0058bf] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#0058bf] group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">mail</span>
                    </div>
                    <h3 class="font-[Manrope] text-lg font-bold text-[#001142] mb-3">E-mail</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Kirimkan korespondensi atau surat elektronik resmi ke alamat email kami.</p>
                    <a href="mailto:{{ $email }}" class="mt-auto text-[#0058bf] hover:text-[#00236f] text-sm font-extrabold">
                        {{ $email }}
                    </a>
                </div>
            </div>

            <!-- Form & Map Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Interactive Contact Form -->
                <div class="lg:col-span-5 bg-white border border-slate-100 rounded-2xl p-8 shadow-sm flex flex-col justify-between" x-data="{ 
                    submitted: false, 
                    nama: '', 
                    email: '', 
                    subjek: '', 
                    pesan: '', 
                    whatsappUrl() {
                        const text = `Halo GKI Pakuwon,\n\nSaya: ${this.nama}\nEmail: ${this.email}\nKeperluan: ${this.subjek}\n\nPesan:\n${this.pesan}`;
                        return 'https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone) }}?text=' + encodeURIComponent(text);
                    }
                }">
                    <div x-show="!submitted">
                        <h2 class="font-[Manrope] text-2xl font-bold text-[#001142] mb-2">Kirim Pesan</h2>
                        <p class="text-slate-500 text-xs mb-6">Lengkapi form di bawah untuk mengirim pesan langsung kepada kami.</p>
                        
                        <form @submit.prevent="submitted = true" class="space-y-5">
                            <div>
                                <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                <input type="text" x-model="nama" required placeholder="Contoh: John Doe" class="w-full bg-slate-50/50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-[#0058bf] focus:ring-4 focus:ring-[#0058bf]/5 transition-all">
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
                                <input type="email" x-model="email" required placeholder="Contoh: johndoe@gmail.com" class="w-full bg-slate-50/50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-[#0058bf] focus:ring-4 focus:ring-[#0058bf]/5 transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Subjek / Perihal</label>
                                <input type="text" x-model="subjek" required placeholder="Contoh: Konseling / Pelayanan" class="w-full bg-slate-50/50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-[#0058bf] focus:ring-4 focus:ring-[#0058bf]/5 transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Isi Pesan</label>
                                <textarea x-model="pesan" rows="4" required placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." class="w-full bg-slate-50/50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-[#0058bf] focus:ring-4 focus:ring-[#0058bf]/5 transition-all"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#0058bf] hover:bg-[#00236f] text-white py-3.5 rounded-xl text-sm font-bold shadow-lg shadow-[#0058bf]/15 transition-all">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>

                    <!-- Success State -->
                    <div x-show="submitted" x-cloak class="text-center py-8 flex flex-col items-center justify-center h-full">
                        <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">check_circle</span>
                        </div>
                        <h2 class="font-[Manrope] text-2xl font-bold text-[#001142] mb-3">Pesan Terkirim!</h2>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto mb-8">Terima kasih telah menghubungi kami. Kami akan merespons pesan Anda secepatnya.</p>
                        
                        <div class="flex flex-col gap-3 w-full max-w-xs">
                            <a :href="whatsappUrl()" target="_blank" class="w-full bg-[#25d366] hover:bg-[#20ba5a] text-white py-3.5 rounded-xl text-xs font-bold shadow-lg shadow-green-500/10 flex items-center justify-center gap-2 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.858-4.42 9.863-9.858.002-2.634-1.02-5.11-2.881-6.974-1.862-1.864-4.337-2.89-6.975-2.891-5.442 0-9.866 4.423-9.87 9.86-.001 1.902.502 3.759 1.45 5.378l-.946 3.456 3.538-.926zm11.391-7.072c-.274-.136-1.62-.8-1.874-.893-.254-.094-.439-.14-.624.137-.184.276-.713.893-.872 1.077-.16.184-.319.208-.593.072-.274-.137-1.157-.427-2.203-1.36-.814-.727-1.364-1.626-1.524-1.901-.16-.274-.017-.423.12-.559.124-.122.274-.321.411-.481.137-.16.183-.274.274-.457.09-.183.045-.343-.022-.48-.069-.137-.624-1.503-.855-2.061-.225-.544-.45-.47-.624-.478-.16-.008-.344-.01-.529-.01-.184 0-.485.07-.74.343-.254.274-.972.95-.972 2.318 0 1.369.996 2.693 1.134 2.88.137.187 1.96 2.993 4.749 4.195.663.286 1.181.457 1.583.585.666.211 1.272.181 1.751.11.534-.08 1.62-.663 1.849-1.27.228-.607.228-1.127.16-1.236-.069-.11-.254-.183-.529-.32z"/></svg>
                                Chat via WhatsApp
                            </a>
                            <button @click="submitted = false; nama = ''; email = ''; subjek = ''; pesan = ''" class="w-full bg-slate-50 hover:bg-slate-100 text-slate-500 py-3.5 rounded-xl text-xs font-bold transition-all border border-slate-150">
                                Kirim Pesan Baru
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Card -->
                <div class="lg:col-span-7 bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm flex flex-col justify-between">
                    <div class="p-8 pb-4">
                        <h2 class="font-[Manrope] text-2xl font-bold text-[#001142] mb-2">Lokasi Gereja</h2>
                        <p class="text-slate-500 text-xs">Temukan kami melalui peta interaktif Google Maps di bawah ini.</p>
                    </div>
                    
                    <div class="w-full flex-1 min-h-[350px] relative border-y border-slate-100 bg-slate-50">
                        <iframe 
                            src="{{ $finalEmbed }}" 
                            class="absolute inset-0 w-full h-full border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="p-6 flex flex-col sm:flex-row justify-between items-center gap-4 bg-slate-50/50">
                        <span class="text-xs text-slate-500 font-medium">Buka peta di aplikasi Google Maps untuk navigasi lebih mudah:</span>
                        <a href="{{ $finalLink }}" target="_blank" class="bg-[#0058bf] hover:bg-[#00236f] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-[#0058bf]/10 flex items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                            Buka Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
