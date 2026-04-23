<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>GraceGate Sanctuary - Digital Sanctuary</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    display: inline-block;
    vertical-align: middle;
}
.church-card {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(0, 35, 111, 0.04);
    border-radius: 0.75rem;
    padding: 24px;
}
</style>
</head>
<body class="bg-[#f8f9ff] font-[Inter] text-[#0b1c30]">

{{-- TopNavBar --}}
<nav class="bg-white/80 backdrop-blur-md flex justify-between items-center h-16 px-8 w-full z-40 fixed top-0 border-b border-slate-100 shadow-sm">
    <div class="flex items-center gap-8">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#00236f]" style="font-variation-settings: 'FILL' 1;">church</span>
            <span class="font-[Manrope] font-semibold text-[#00236f] tracking-tight">GraceGate</span>
        </div>
        <div class="hidden md:flex items-center gap-6">
            <a class="text-[#00236f] font-semibold border-b-2 border-[#00236f] px-1 py-5" href="#">Beranda</a>
            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium" href="#">Khotbah</a>
            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium" href="#">Acara</a>
            <a class="text-slate-600 hover:text-[#0058bf] transition-colors text-sm font-medium" href="#">Persembahan</a>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden lg:block">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input class="pl-10 pr-4 py-2 bg-[#e5eeff] rounded-full border-none text-sm focus:ring-2 focus:ring-[#0058bf] w-64 outline-none" placeholder="Cari di Sanctuary..." type="text"/>
        </div>
        <button class="bg-[#00236f] text-white px-6 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-all">Ikuti Ibadah</button>
        <div class="flex items-center gap-2 border-l border-slate-200 pl-4 ml-2">
            <span class="material-symbols-outlined text-slate-600 cursor-pointer">notifications</span>
            <span class="material-symbols-outlined text-slate-600 cursor-pointer">account_circle</span>
        </div>
    </div>
</nav>

<main class="pt-16">
    {{-- Hero Section --}}
    <section class="relative h-[600px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzU5taX6A_7HKANT8o5WTu9FHHpU8zR1h2hL7TPFvrZpLbjJENkN7n11uSy2hmu9BdjK9XnoRo3FdcguxWqr3z2ooBAP2GVaVwPa54Xii3UnI1_hJEal0Mr6UcQYNeIu1VthYKVWLuglgek5eopmR8LOC0UHbNH5d4S2VBsbwXqt4DyQBRfIg2dw9Dtt4L4n65hJoqI1V69YrYk5hNF62Ai0esXgCXhixafowJRufp6IJisRt0v0J9vPswEox6CiEqYIWTXkic3tU" alt="Interior gereja modern"/>
            <div class="absolute inset-0 bg-gradient-to-r from-[#00236f]/80 to-transparent"></div>
        </div>
        <div class="container mx-auto px-8 relative z-10">
            <div class="max-w-2xl text-white">
                <span class="bg-[#0058bf]/20 backdrop-blur-md px-4 py-1 rounded-full text-xs uppercase tracking-widest mb-6 inline-block font-bold">Selamat Datang di GraceGate</span>
                <h1 class="font-[Manrope] text-6xl font-bold leading-tight mb-6">Selamat Datang di Digital Sanctuary</h1>
                <p class="text-slate-200 mb-8 max-w-lg text-lg">Temukan kedamaian dan komunitas dalam perjalanan iman Anda. Mari bergabung dalam ibadah dan bertumbuh bersama dalam kasih Kristus.</p>
                <div class="flex gap-4">
                    <button class="bg-white text-[#00236f] px-8 py-3 rounded-lg text-sm font-bold shadow-lg hover:bg-slate-100 transition-all">Ikuti Ibadah Online</button>
                    <button class="border-2 border-white text-white px-8 py-3 rounded-lg text-sm font-bold hover:bg-white/10 transition-all">Jadwal Kegiatan</button>
                </div>
            </div>
        </div>
    </section>

    {{-- Daily Devotion & Quick Stats --}}
    <section class="container mx-auto px-8 -mt-16 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8 church-card flex flex-col md:flex-row gap-8 items-center">
                <div class="w-full md:w-1/3 aspect-square rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3E6SRkA8Mb_jSCNQXculT7LsMYf6htflbbIrjtMt69_HNNUT-AisofKH-_9euLjJek_IpKKnFH7awSK7kDOhsIUH3ee-UXTKq36wC61TgzmbGnOCXRJSKtYYIawr51tMkit1CLCit6fmJggM4PEgu4uLAzw_sh7PnxiufSGC6c3MV-SvJgrxpD9rN86G8go80fITKOEHT-Ooah5YwogOhxLA9rDtDfVShP0OZ2U0K7VoOMpCloDlof1fvZg1ZPtf7270sq7j2U1M" alt="Renungan harian"/>
                </div>
                <div class="w-full md:w-2/3">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#0058bf]">auto_stories</span>
                        <span class="text-[#0058bf] text-xs uppercase font-bold tracking-widest">Renungan Harian</span>
                    </div>
                    <h2 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-4">Mazmur 23:1 - TUHAN adalah gembalaku, takkan kekurangan aku.</h2>
                    <p class="text-slate-600 mb-6 italic leading-relaxed">"Di tengah badai kehidupan yang tak menentu, ingatlah bahwa kita memiliki Gembala yang Agung. Dia tidak hanya menuntun, tetapi juga mencukupkan segala kebutuhan kita tepat pada waktu-Nya."</p>
                    <div class="flex items-center gap-4">
                        <img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCB4N9ElRVNeg_OEQIsZeT4znLR5Y8NPf46jRHaW7qmb_eJ7X9bt1G49oFkjng6VhSPnxU4IHBLhTDFJnBxycSNbwpds8z7ttAszPCYUEYGgbylqWBzu2bUorTY4NhhL5ZwtqrZpBGzOO2Mr8J-YG86plmTdCfcRMlYEwkWE-il8-GOa28rkZgR3jPJBOdrneXJ22QA-wklRCRirl12DJW0KVx3YH7OV_umvT_T078xvUGnzG-t81pAAGa52ke6Ur5uY1d3RyZv2Ik" alt="Pastor"/>
                        <div>
                            <p class="text-sm font-bold text-[#001142]">Pdt. Dr. Andreas Wijaya</p>
                            <p class="text-xs text-slate-500">Gembala Sidang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 church-card bg-[#00236f] text-white border-none flex flex-col justify-between">
                <div>
                    <h3 class="font-[Manrope] font-semibold text-2xl mb-6">Pertumbuhan Jemaat</h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-end border-b border-white/10 pb-4">
                            <div>
                                <p class="text-slate-300 text-sm">Total Keluarga</p>
                                <p class="text-4xl font-bold font-[Manrope]">1,240</p>
                            </div>
                            <span class="material-symbols-outlined text-[#d8e2ff]">family_restroom</span>
                        </div>
                        <div class="flex justify-between items-end border-b border-white/10 pb-4">
                            <div>
                                <p class="text-slate-300 text-sm">Jemaat Aktif</p>
                                <p class="text-4xl font-bold font-[Manrope]">4,850</p>
                            </div>
                            <span class="material-symbols-outlined text-[#d8e2ff]">groups</span>
                        </div>
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-slate-300 text-sm">Pelayan Tuhan</p>
                                <p class="text-4xl font-bold font-[Manrope]">312</p>
                            </div>
                            <span class="material-symbols-outlined text-[#d8e2ff]">volunteer_activism</span>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-6 py-3 bg-white/10 rounded-lg text-sm font-medium hover:bg-white/20 transition-all">Lihat Laporan Lengkap</button>
            </div>
        </div>
    </section>

    {{-- Service & Activity Schedule --}}
    <section class="py-24 container mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div class="max-w-xl">
                <h2 class="font-[Manrope] font-bold text-4xl text-[#001142] mb-4">Jadwal Ibadah &amp; Kegiatan</h2>
                <p class="text-slate-600">Mari bersekutu dan melayani bersama. Berikut adalah jadwal rutin pertemuan jemaat di GraceGate Sanctuary.</p>
            </div>
            <button class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                Unduh Kalender Liturgi
                <span class="material-symbols-outlined">download</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="church-card group hover:border-[#0058bf] transition-all">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-lg bg-[#eff4ff] flex items-center justify-center text-[#0058bf]">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">calendar_today</span>
                    </div>
                    <span class="bg-[#0058bf]/10 text-[#0058bf] px-3 py-1 rounded-full text-xs font-bold uppercase">Minggu</span>
                </div>
                <h4 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-2">Ekaristi Kudus</h4>
                <p class="text-slate-500 text-sm mb-6">Ibadah Raya Mingguan</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">schedule</span><span class="text-sm">Sesi 1: 07:00 WIB</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">schedule</span><span class="text-sm">Sesi 2: 10:00 WIB</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">person</span><span class="text-sm">Pemimpin: Pdt. Andreas Wijaya</span></div>
                </div>
            </div>
            <div class="church-card group hover:border-[#0058bf] transition-all">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-lg bg-[#eff4ff] flex items-center justify-center text-[#0058bf]">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                    </div>
                    <span class="bg-[#d3e4fe] text-[#00236f] px-3 py-1 rounded-full text-xs font-bold uppercase">Rabu</span>
                </div>
                <h4 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-2">Pendalaman Alkitab</h4>
                <p class="text-slate-500 text-sm mb-6">Studi Firman Tematik</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">schedule</span><span class="text-sm">19:00 WIB (Hybrid)</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">location_on</span><span class="text-sm">Ruang Konsistori / Zoom</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">person</span><span class="text-sm">Pemimpin: Ev. Maria Susanti</span></div>
                </div>
            </div>
            <div class="church-card group hover:border-[#0058bf] transition-all">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-lg bg-[#eff4ff] flex items-center justify-center text-[#0058bf]">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">music_note</span>
                    </div>
                    <span class="bg-[#d3e4fe] text-[#00236f] px-3 py-1 rounded-full text-xs font-bold uppercase">Jumat</span>
                </div>
                <h4 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-2">Latihan Paduan Suara</h4>
                <p class="text-slate-500 text-sm mb-6">Pelayanan Musik &amp; Pujian</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">schedule</span><span class="text-sm">18:00 WIB</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">location_on</span><span class="text-sm">Balkon Utama Gereja</span></div>
                    <div class="flex items-center gap-3 text-slate-600"><span class="material-symbols-outlined text-sm">person</span><span class="text-sm">Dirigen: Bpk. Samuel Hartono</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest News Section --}}
    <section class="py-24 bg-[#eff4ff]">
        <div class="container mx-auto px-8">
            <div class="text-center mb-16">
                <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Warta Jemaat</span>
                <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Berita Terbaru Gereja</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOQWxxxggWWRBWN8jU3HdwdFJ1IekzYjPpR_ihwDmO0uNoCVB5diFjbcB3F2cVg33JxSyuArQSmoXdhExfeOf4PqcCyQwHo3GkJz-n0204ET4tVvfT_C8xu9SU7e1RT6ofjdbid09V-zLDwf-oLYMMGLwM-YyoRoSiD1hVJBSEfj5QihskjZfQzHGhViF59G6YAePes2SPJ7QHPR2QNdPfYR9_vc39M48Hj9lFZsB2_f6As447jc7NVUo5krBnDbo9sus2PLEjKB4" alt="Aksi sosial"/>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="bg-[#e5eeff] text-[#29428c] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide">Pelayanan</span>
                            <span class="text-slate-400 text-[10px] font-medium">12 Okt 2023</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">Aksi Sosial Kasih di Bantaran Sungai</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">Gereja GraceGate mengadakan aksi pembagian paket sembako dan layanan kesehatan gratis bagi warga...</p>
                        <a class="text-[#0058bf] font-bold text-sm flex items-center gap-2" href="#">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3qinsvU1fHIlEiaOsFd5RllXY22OK8XrucSArg-xNTu3dSms7lWmyMxs1aWCTI9ngMRgiDCd_g2c6JcCLqG7uzPp8aVzsBZ9mHyO6tkleLeWIo8jfkD_01r51cP98KsrCKlkZj8HeqG2Fy4yukVkwukN7ldn9HAPMcxdkNY36aDgIYjwp3sZc2dtgVZETSfgx9NFMVaD92OO1TNpOBH_1yVKBXa7Pc4aMGdHynD-ZehcwNsvGfWgNQDzTxbbswD_I_L6H8Z3Lb-0" alt="Youth camp"/>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="bg-[#e5eeff] text-[#29428c] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide">Pemuda</span>
                            <span class="text-slate-400 text-[10px] font-medium">08 Okt 2023</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">Youth Revival Camp: Ignite Your Passion</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">Persiapan kamp pemuda tahunan sudah dimulai! Pastikan Anda mendaftar untuk akhir pekan yang transformatif...</p>
                        <a class="text-[#0058bf] font-bold text-sm flex items-center gap-2" href="#">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg">
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAa7gnPl9KzQzu7Z7RY6vnK3dP3E-yyi5ejYrURY2MrbkqtIbLO5jk7ggOZqXq_WSfBjM2aOl_kHcIuwGLftnOngihR4fGLJzgkwDQZRMf-4QZa28SHbArwHBv8vVFloUCGYXjR2PRbCu_h1Ljh51NsncNUo8hnblehioBZ2NYmLckwCluwVaVdPqPM4SJmTrwZnmwEyqRbn9b7Ek4mS2rktfdUpUS7scLPFrJ_iBRcnl2NOnlqJivt1GfaEPzI3yx-BvIReISBmH8" alt="Renovasi gedung"/>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="bg-[#e5eeff] text-[#29428c] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide">Pembangunan</span>
                            <span class="text-slate-400 text-[10px] font-medium">05 Okt 2023</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">Progres Renovasi Gedung Serbaguna</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">Laporan terbaru pembangunan sayap utara gereja. Kami bersyukur atas dukungan dan doa jemaat sekalian...</p>
                        <a class="text-[#0058bf] font-bold text-sm flex items-center gap-2" href="#">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

{{-- Footer --}}
<footer class="bg-slate-50 border-t border-slate-200 py-12 w-full">
    <div class="container mx-auto px-8 flex flex-col items-center gap-8 text-center">
        <div class="flex flex-col items-center gap-2">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[#00236f] text-3xl" style="font-variation-settings: 'FILL' 1;">church</span>
                <span class="font-[Manrope] font-semibold text-slate-900">GraceGate Digital Sanctuary</span>
            </div>
            <p class="text-slate-500 max-w-md">Menjadi jembatan kasih dan kasih karunia bagi komunitas di era digital.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            <a class="text-slate-500 text-sm no-underline hover:text-[#0058bf] transition-colors" href="#">Kebijakan Privasi</a>
            <a class="text-slate-500 text-sm no-underline hover:text-[#0058bf] transition-colors" href="#">Ketentuan Layanan</a>
            <a class="text-slate-500 text-sm no-underline hover:text-[#0058bf] transition-colors" href="#">Pusat Bantuan</a>
            <a class="text-slate-500 text-sm no-underline hover:text-[#0058bf] transition-colors" href="#">Panduan Pelayanan Aman</a>
        </div>
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-[#00236f] cursor-pointer hover:bg-[#0058bf] hover:text-white transition-all">
                <span class="material-symbols-outlined">social_leaderboard</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-[#00236f] cursor-pointer hover:bg-[#0058bf] hover:text-white transition-all">
                <span class="material-symbols-outlined">play_circle</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-[#00236f] cursor-pointer hover:bg-[#0058bf] hover:text-white transition-all">
                <span class="material-symbols-outlined">camera_alt</span>
            </div>
        </div>
        <p class="text-slate-500 text-xs mt-4">© 2024 GraceGate Digital Sanctuary. Seluruh hak cipta dilindungi.</p>
    </div>
</footer>

</body>
</html>
