<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>GKI PAKUWON  -  </title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
[x-cloak] { display: none !important; }
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

<x-navigation.header />

<main class="pt-16">
    {{-- Hero Section --}}
    <section class="relative h-[600px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzU5taX6A_7HKANT8o5WTu9FHHpU8zR1h2hL7TPFvrZpLbjJENkN7n11uSy2hmu9BdjK9XnoRo3FdcguxWqr3z2ooBAP2GVaVwPa54Xii3UnI1_hJEal0Mr6UcQYNeIu1VthYKVWLuglgek5eopmR8LOC0UHbNH5d4S2VBsbwXqt4DyQBRfIg2dw9Dtt4L4n65hJoqI1V69YrYk5hNF62Ai0esXgCXhixafowJRufp6IJisRt0v0J9vPswEox6CiEqYIWTXkic3tU" alt="Interior gereja modern"/>
            <div class="absolute inset-0 bg-gradient-to-r from-[#00236f]/80 to-transparent"></div>
        </div>
        <div class="container mx-auto px-8 relative z-10">
            <div class="max-w-2xl text-white">
                <span class="bg-[#0058bf]/20 backdrop-blur-md px-4 py-1 rounded-full text-xs uppercase tracking-widest mb-6 inline-block font-bold">Selamat Datang di GKI PAKUWON</span>
                <h1 class="font-[Manrope] text-6xl font-bold leading-tight mb-6">Selamat Datang di GKI PAKUWON </h1>
                <p class="text-slate-200 mb-8 max-w-lg text-lg">Temukan kedamaian dan komunitas dalam perjalanan iman Anda. Mari bergabung dalam ibadah dan bertumbuh bersama dalam kasih Kristus.</p>
                <div class="flex gap-4">
                    <button class="bg-white text-[#00236f] px-8 py-3 rounded-lg text-sm font-bold shadow-lg hover:bg-slate-100 transition-all">Ikuti Ibadah Offline</button>
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
                    @php $renunganUtama = $renungan->first(); @endphp
                    @if($renunganUtama)
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        @if(!empty($renunganUtama->ayat))
                        <span class="inline-flex items-center rounded-full bg-[#e5eeff] px-3 py-1 text-[11px] font-bold tracking-wide text-[#29428c]">
                            {{ $renunganUtama->ayat }}
                        </span>
                        @endif
                        <span class="text-xs font-medium text-slate-400">
                            {{ \Carbon\Carbon::parse($renunganUtama->tanggal ?? $renunganUtama->created_at)->format('d M Y') }}
                        </span>
                    </div>
                    <h2 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-4">{{ $renunganUtama->judul }}</h2>
                    <p class="text-slate-600 mb-6 italic leading-relaxed">"{{ strip_tags($renunganUtama->isi) }}"</p>
                    @else
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="inline-flex items-center rounded-full bg-[#e5eeff] px-3 py-1 text-[11px] font-bold tracking-wide text-[#29428c]">
                            Mazmur 23:1
                        </span>
                    </div>
                    <h2 class="font-[Manrope] font-semibold text-[#001142] text-2xl mb-4">TUHAN adalah gembalaku, takkan kekurangan aku.</h2>
                    <p class="text-slate-600 mb-6 italic leading-relaxed">"Di tengah badai kehidupan yang tak menentu, ingatlah bahwa kita memiliki Gembala yang Agung. Dia tidak hanya menuntun, tetapi juga mencukupkan segala kebutuhan kita tepat pada waktu-Nya."</p>
                    @endif
                    <div class="flex items-center gap-4">
                        <img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCB4N9ElRVNeg_OEQIsZeT4znLR5Y8NPf46jRHaW7qmb_eJ7X9bt1G49oFkjng6VhSPnxU4IHBLhTDFJnBxycSNbwpds8z7ttAszPCYUEYGgbylqWBzu2bUorTY4NhhL5ZwtqrZpBGzOO2Mr8J-YG86plmTdCfcRMlYEwkWE-il8-GOa28rkZgR3jPJBOdrneXJ22QA-wklRCRirl12DJW0KVx3YH7OV_umvT_T078xvUGnzG-t81pAAGa52ke6Ur5uY1d3RyZv2Ik" alt="Pastor"/>
                        <div>
                            <p class="text-sm font-bold text-[#001142]">Pdt. Dr. Andreas Wijaya</p>
                            <p class="text-xs text-slate-500">Gembala Sidang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 church-card text-white border-none flex flex-col justify-between" style="background-color: #00236f;">
                <div>
                    <h3 class="font-[Manrope] font-semibold text-2xl mb-6">Pertumbuhan Jemaat</h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-end border-b border-white/10 pb-4">
                            <div>
                               
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
                <p class="text-slate-600">Mari bersekutu dan melayani bersama. Berikut adalah jadwal rutin pertemuan jemaat di GKI PAKUWON .</p>
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

    {{-- Sacramen Schedule --}}
    <section class="py-10 container mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div class="max-w-xl">
                <h2 class="font-[Manrope] font-bold text-4xl text-[#001142] mb-4">Jadwal Sakramen </h2>
                <p class="text-slate-600">Mari bersekutu dan melayani bersama. Berikut adalah jadwal rutin pertemuan jemaat di GKI PAKUWON .</p>
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

    {{-- Warta Section --}}
    <section class="py-16 bg-[#eff4ff]">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="max-w-xl">
                    <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Warta</span>
                    <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Warta Jemaat</h2>
                </div>
                <a href="{{ route('warta.index') }}" class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($warta as $item)
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg bg-white">
                    @if($item->gambar)
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"/>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="text-slate-400 text-[10px] font-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">{{ $item->judul }}</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('warta.show', $item->id) }}" class="text-[#0058bf] font-bold text-sm flex items-center gap-2 mt-auto">Detail Warta <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500 italic">Belum ada warta jemaat.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Artikel Section --}}
    <section class="py-16 bg-[#eff4ff]">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="max-w-xl">
                    <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Artikel</span>
                    <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Artikel Gereja</h2>
                </div>
                <a href="{{ route('artikel.index') }}" class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($artikel as $item)
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg bg-white">
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"/>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="bg-[#e5eeff] text-[#29428c] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide">{{ $item->kategori ?? 'Umum' }}</span>
                            <span class="text-slate-400 text-[10px] font-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">{{ $item->judul }}</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('artikel.show', $item->id) }}" class="text-[#0058bf] font-bold text-sm flex items-center gap-2">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500 italic">Belum ada artikel.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Racakitri Section --}}
    <section class="py-16">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="max-w-xl">
                    <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Racakitri</span>
                    <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Majalah Racakitri</h2>
                </div>
                <a href="{{ route('racakitri.index') }}" class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($racakitri as $item)
                <div class="church-card p-0 overflow-hidden flex flex-col group border border-gray-100 shadow-sm bg-white">
                    @if($item->gambar)
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"/>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="text-slate-400 text-[10px] font-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">{{ $item->judul }}</h3>
                        <a href="{{ route('racakitri.show', $item->id) }}" class="text-[#0058bf] font-bold text-sm flex items-center gap-2 mt-auto">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500 italic">Belum ada data racakitri.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Informasi Section --}}
    <section class="py-16">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="max-w-xl">
                    <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Informasi</span>
                    <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Informasi Terkini</h2>
                </div>
                <a href="{{ route('informasi.index') }}" class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($informasi as $item)
                <div class="church-card p-0 overflow-hidden flex flex-col group border-none shadow-lg bg-white">
                    @if($item->gambar)
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"/>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="text-slate-400 text-[10px] font-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">{{ $item->judul }}</h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-2">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('informasi.show', $item->id) }}" class="text-[#0058bf] font-bold text-sm flex items-center gap-2 mt-auto">Detail Informasi <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500 italic">Belum ada informasi.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Video Section --}}
    <section class="py-16">
        <div class="container mx-auto px-8">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="max-w-xl">
                    <span class="text-[#0058bf] text-xs uppercase font-bold tracking-[0.2em] block mb-4">Video</span>
                    <h2 class="font-[Manrope] font-bold text-4xl text-[#001142]">Video & Dokumentasi</h2>
                </div>
                <a href="{{ route('video.index') }}" class="flex items-center gap-2 text-[#0058bf] font-bold text-sm hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @forelse($video as $item)
                <div class="church-card p-0 overflow-hidden flex flex-col group border border-gray-100 shadow-sm bg-white">
                    <div class="relative h-48 overflow-hidden bg-gray-900 flex items-center justify-center">
                        @if($item->gambar)
                            @php
                                $videoUrl = asset('storage/' . $item->gambar);
                                $videoExt = strtolower(pathinfo(parse_url($videoUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                            @endphp
                            @if(in_array($videoExt, ['mp4', 'webm', 'ogg']))
                                <video controls class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:scale-105 transition-transform duration-500" muted loop playsinline preload="metadata">
                                    <source src="{{ $videoUrl }}" type="video/{{ $videoExt }}">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:scale-105 transition-transform duration-500" src="{{ $videoUrl }}" alt="{{ $item->judul }}"/>
                            @endif
                        @endif
                        <span class="material-symbols-outlined text-white text-5xl relative z-10 opacity-90 drop-shadow-lg pointer-events-none">play_circle</span>
                    </div>
                    <div class="p-6">
                        <div class="flex gap-2 mb-4">
                            <span class="text-slate-400 text-[10px] font-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-[Manrope] font-semibold text-xl mb-3 text-[#001142] group-hover:text-[#0058bf] transition-colors">{{ $item->judul }}</h3>
                        <a href="{{ route('video.show', $item->id) }}" class="text-[#0058bf] font-bold text-sm flex items-center gap-2 mt-auto">Tonton Video <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8 text-gray-500 italic">Belum ada video.</div>
                @endforelse
            </div>
        </div>
    </section>
</main>

<x-navigation.footer />

</body>
</html>
