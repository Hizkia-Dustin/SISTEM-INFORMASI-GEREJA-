<x-layouts.main title="Susunan Majelis Jemaat" :fullWidth="true">
<div class="max-w-[1440px] mx-auto px-8 py-8">

@php
    $ketua = $penatuas->where('jabatan', 'Ketua Umum')->first();
    $wakil = $penatuas->where('jabatan', 'Wakil Ketua')->first();
    $sekretaris1 = $penatuas->where('jabatan', 'Sekretaris 1')->first();
    $sekretaris2 = $penatuas->where('jabatan', 'Sekretaris 2')->first();
    $bendahara1 = $penatuas->where('jabatan', 'Bendahara 1')->first();
    $bendahara2 = $penatuas->where('jabatan', 'Bendahara 2')->first();

    $sarpen = $penatuas->where('sub_kategori', 'Bid. Sarpen');
    $pembinaan = $penatuas->where('sub_kategori', 'Bid. Pembinaan');
    $kespel = $penatuas->where('sub_kategori', 'Bid. Kespel');
    $persekutuan = $penatuas->where('sub_kategori', 'Bid. Persekutuan');

    $pendampingKomisi = $penatuas->where('kategori', 'Pendamping Komisi');

    // Get the latest updated at timestamp from either table if available
    $latestUpdate = null;
    $latestPenatuaObj = $penatuas->sortByDesc('updated_at')->first();
    if ($latestPenatuaObj) {
        $latestUpdate = \Carbon\Carbon::parse($latestPenatuaObj->updated_at)->translatedFormat('d M Y');
    } else {
        $latestUpdate = '12 Mei 2024';
    }
@endphp

<!-- Header Section -->
<header class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
<div>
<div class="inline-flex items-center px-2 py-1 bg-secondary-container text-white rounded-lg mb-2">
<span class="font-label-sm text-label-sm uppercase tracking-wider">Masa Bakti 2025 - 2026</span>
</div>
<h1 class="font-h1 text-h1 text-primary leading-tight">
                    Susunan Majelis Jemaat<br/>GKI Pakuwon
                </h1>
</div>
<div class="flex items-center gap-2 pb-1">
<div class="text-right">
<p class="font-label-md text-label-md text-gray-600">Update Terakhir</p>
<p class="font-body-md text-body-md font-bold">{{ $latestUpdate }}</p>
</div>
<div class="thin-rule w-12 hidden md:block"></div>
<span class="material-symbols-outlined text-primary" style="font-size: 40px;">verified</span>
</div>
</header>

<!-- Executive Board: Asymmetric Grid -->
<section class="mb-8">
<div class="flex items-center gap-4 mb-6">
<h2 class="font-h2 text-h2 text-primary">Pengurus Harian</h2>
<div class="thin-rule flex-grow"></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<!-- Main Executive: Ketua -->
<div class="md:col-span-8 bg-white border border-outline-variant p-6 rounded-xl shadow-sm flex flex-col justify-between min-h-[200px]">
<div class="flex justify-between items-start">
<div>
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest block mb-1">Ketua Umum</span>
<h3 class="font-h1 text-h2 text-on-surface">{{ $ketua->nama ?? '-' }}</h3>
</div>
<span class="material-symbols-outlined text-secondary-fixed-dim" style="font-size: 48px;">account_balance</span>
</div>
<div class="flex gap-4 mt-6">
<div class="flex-1 border-t border-slate-100 pt-2">
<span class="font-caption text-caption text-gray-600">Visi Strategis</span>
<p class="font-label-md text-label-md">Kepemimpinan &amp; Tata Kelola</p>
</div>
<div class="flex-1 border-t border-slate-100 pt-2">
<span class="font-caption text-caption text-gray-600">Fokus Utama</span>
<p class="font-label-md text-label-md">Pertumbuhan Jemaat</p>
</div>
</div>
</div>
<!-- Wakil Ketua -->
<div class="md:col-span-4 bg-primary text-white p-6 rounded-xl shadow-sm flex flex-col justify-between">
<div>
<span class="font-label-sm text-label-sm text-blue-100 uppercase tracking-widest block mb-1">Wakil Ketua</span>
<h3 class="font-h3 text-h3">{{ $wakil->nama ?? '-' }}</h3>
</div>
<div class="mt-6">
<span class="material-symbols-outlined opacity-50" style="font-size: 32px;">supervisor_account</span>
</div>
</div>
<!-- Sekretaris 1 & 2 -->
<div class="md:col-span-6 grid grid-cols-2 gap-6">
<div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
<span class="font-label-sm text-label-sm text-secondary block mb-1">Sekretaris 1</span>
<p class="font-label-md text-label-md text-on-surface">{{ $sekretaris1->nama ?? '-' }}</p>
</div>
<div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
<span class="font-label-sm text-label-sm text-secondary block mb-1">Sekretaris 2</span>
<p class="font-label-md text-label-md text-on-surface">{{ $sekretaris2->nama ?? '-' }}</p>
</div>
</div>
<!-- Bendahara 1 & 2 -->
<div class="md:col-span-6 grid grid-cols-2 gap-6">
<div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
<span class="font-label-sm text-label-sm text-secondary block mb-1">Bendahara 1</span>
<p class="font-label-md text-label-md text-on-surface">{{ $bendahara1->nama ?? '-' }}</p>
</div>
<div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
<span class="font-label-sm text-label-sm text-secondary block mb-1">Bendahara 2</span>
<p class="font-label-md text-label-md text-on-surface">{{ $bendahara2->nama ?? '-' }}</p>
</div>
</div>
</div>
</section>

<!-- Divisions Section -->
<section class="mb-8">
<div class="flex items-center gap-4 mb-6">
<h2 class="font-h2 text-h2 text-primary">Bidang Kerja</h2>
<div class="thin-rule flex-grow"></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Bidang Sarana & Penunjang -->
<div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<div class="bg-surface-container-low p-4 border-b border-outline-variant flex items-center justify-between">
<h4 class="font-label-md text-label-md text-primary uppercase tracking-tight">Bid. Sarpen</h4>
<span class="material-symbols-outlined text-gray-600">construction</span>
</div>
<div class="p-4 space-y-sm">
    @forelse($sarpen as $p)
        <p class="font-body-md text-body-md border-b border-slate-50 pb-1">{{ $p->nama }}</p>
    @empty
        <p class="text-gray-400 italic text-xs">Belum ada data</p>
    @endforelse
</div>
</div>
<!-- Bidang Pembinaan -->
<div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<div class="bg-surface-container-low p-4 border-b border-outline-variant flex items-center justify-between">
<h4 class="font-label-md text-label-md text-primary uppercase tracking-tight">Bid. Pembinaan</h4>
<span class="material-symbols-outlined text-gray-600">school</span>
</div>
<div class="p-4 space-y-sm">
    @forelse($pembinaan as $p)
        <p class="font-body-md text-body-md border-b border-slate-50 pb-1">{{ $p->nama }}</p>
    @empty
        <p class="text-gray-400 italic text-xs">Belum ada data</p>
    @endforelse
</div>
</div>
<!-- Bidang Kesaksian & Pelayanan -->
<div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<div class="bg-surface-container-low p-4 border-b border-outline-variant flex items-center justify-between">
<h4 class="font-label-md text-label-md text-primary uppercase tracking-tight">Bid. Kespel</h4>
<span class="material-symbols-outlined text-gray-600">volunteer_activism</span>
</div>
<div class="p-4 space-y-sm">
    @forelse($kespel as $p)
        <p class="font-body-md text-body-md border-b border-slate-50 pb-1">{{ $p->nama }}</p>
    @empty
        <p class="text-gray-400 italic text-xs">Belum ada data</p>
    @endforelse
</div>
</div>
<!-- Bidang Persekutuan -->
<div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<div class="bg-surface-container-low p-4 border-b border-outline-variant flex items-center justify-between">
<h4 class="font-label-md text-label-md text-primary uppercase tracking-tight">Bid. Persekutuan</h4>
<span class="material-symbols-outlined text-gray-600">groups</span>
</div>
<div class="p-4 space-y-sm">
    @forelse($persekutuan as $p)
        <p class="font-body-md text-body-md border-b border-slate-50 pb-1">{{ $p->nama }}</p>
    @empty
        <p class="text-gray-400 italic text-xs">Belum ada data</p>
    @endforelse
</div>
</div>
</div>
</section>

<!-- Liaisons Section -->
<section class="mb-8">
<div class="flex items-center gap-4 mb-6">
<h2 class="font-h2 text-h2 text-primary">Pendamping Komisi</h2>
<div class="thin-rule flex-grow"></div>
</div>
<div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container text-on-surface">
<th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider border-b border-outline-variant">Komisi / Kategorial</th>
<th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider border-b border-outline-variant">Pejabat Penghubung</th>
<th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider border-b border-outline-variant text-right">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">
@forelse($pendampingKomisi as $pk)
    @php
        $icon = 'groups';
        $subLower = strtolower($pk->sub_kategori);
        if (str_contains($subLower, 'anak')) {
            $icon = 'child_care';
        } elseif (str_contains($subLower, 'remaja')) {
            $icon = 'school';
        } elseif (str_contains($subLower, 'pemuda')) {
            $icon = 'psychology_alt';
        } elseif (str_contains($subLower, 'dewasa')) {
            $icon = 'family_restroom';
        } elseif (str_contains($subLower, 'indah') || str_contains($subLower, 'lansia')) {
            $icon = 'elderly';
        }
    @endphp
    <tr class="hover:bg-slate-50 transition-colors">
        <td class="px-6 py-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary text-[20px]">{{ $icon }}</span>
            <span class="font-label-md text-label-md">{{ $pk->sub_kategori }}</span>
        </td>
        <td class="px-6 py-4 font-body-md text-body-md">{{ $pk->nama }}</td>
        <td class="px-6 py-4 text-right">
            <span class="px-2 py-1 bg-green-50 text-green-700 text-[10px] font-bold uppercase rounded-full border border-green-100">{{ $pk->status }}</span>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="px-6 py-4 text-center text-gray-400 italic">Belum ada data pendamping komisi.</td>
    </tr>
@endforelse
</tbody>
</table>
</div>
</section>

<!-- Footer / Signature Block (Editorial Mix) -->
<footer class="mt-8 pt-6 border-t border-outline-variant flex flex-col md:flex-row justify-between items-start gap-6 opacity-80">
<div class="max-w-md">
<p class="font-caption text-caption text-gray-600 italic leading-relaxed">
                    "Maka Allah, Sumber damai sejahtera, yang oleh darah perjanjian yang kekal telah membangkitkan dari antara orang mati Gembala Agung segala domba, yaitu Yesus, Tuhan kita, kiranya memperlengkapi kamu dengan segala yang baik untuk melakukan kehendak-Nya." (Ibrani 13:20-21)
                </p>
</div>
<div class="text-right">
<p class="font-label-md text-label-md text-primary">GKI Pakuwon Administrative Portal</p>
<p class="font-caption text-caption">Digital Governance &amp; Stewardship System v2.4</p>
</div>
</footer>

</div>
</x-layouts.main>
