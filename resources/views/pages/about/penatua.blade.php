<x-layouts.main title="Susunan Majelis Jemaat" :fullWidth="true">
@php
    $fallbackExecutive = collect([
        (object) ['jabatan_tampilan' => 'Ketua Umum', 'nama_tampilan' => 'Pnt. Alex R. Jacobus', 'visi_strategis' => 'Kepemimpinan & Tata Kelola', 'fokus_utama' => 'Pertumbuhan Jemaat', 'urutan' => 1],
        (object) ['jabatan_tampilan' => 'Wakil Ketua', 'nama_tampilan' => 'Pnt. Dodi Wijaja', 'urutan' => 2],
        (object) ['jabatan_tampilan' => 'Sekretaris 1', 'nama_tampilan' => 'Pnt. Marijani', 'urutan' => 3],
        (object) ['jabatan_tampilan' => 'Sekretaris 2', 'nama_tampilan' => 'Pnt. Megayenli', 'urutan' => 4],
        (object) ['jabatan_tampilan' => 'Bendahara 1', 'nama_tampilan' => 'Pnt. Endah Trinawati', 'urutan' => 5],
        (object) ['jabatan_tampilan' => 'Bendahara 2', 'nama_tampilan' => 'Pnt. Hendra Sakaroben', 'urutan' => 6],
    ]);

    $fallbackBidang = collect([
        'Bid. Sarpen' => collect([
            (object) ['nama_tampilan' => 'Pnt. Budi Santoso'],
            (object) ['nama_tampilan' => 'Pnt. Andreas T.'],
            (object) ['nama_tampilan' => 'Pnt. Susi Susanti'],
        ]),
        'Bid. Pembinaan' => collect([
            (object) ['nama_tampilan' => 'Pnt. Heru Wijaya'],
            (object) ['nama_tampilan' => 'Pnt. Maria Ulfa'],
            (object) ['nama_tampilan' => 'Pnt. Lukas G.'],
        ]),
        'Bid. Kespel' => collect([
            (object) ['nama_tampilan' => 'Pnt. David K.'],
            (object) ['nama_tampilan' => 'Pnt. Sarah Jane'],
            (object) ['nama_tampilan' => 'Pnt. Taufik H.'],
        ]),
        'Bid. Persekutuan' => collect([
            (object) ['nama_tampilan' => 'Pnt. Samuel L.'],
            (object) ['nama_tampilan' => 'Pnt. Grace M.'],
            (object) ['nama_tampilan' => 'Pnt. Petrus C.'],
        ]),
    ]);

    $fallbackPendamping = collect([
        (object) ['area_layanan' => 'Komisi Anak', 'nama_tampilan' => 'Pnt. Stefanus Kurnia', 'status' => 'aktif', 'ikon' => 'child_care'],
        (object) ['area_layanan' => 'Komisi Remaja', 'nama_tampilan' => 'Pnt. Jessica Tan', 'status' => 'aktif', 'ikon' => 'school'],
        (object) ['area_layanan' => 'Komisi Pemuda', 'nama_tampilan' => 'Pnt. Jonathan S.', 'status' => 'aktif', 'ikon' => 'psychology_alt'],
        (object) ['area_layanan' => 'Komisi Dewasa', 'nama_tampilan' => 'Pnt. Robertus P.', 'status' => 'aktif', 'ikon' => 'family_restroom'],
        (object) ['area_layanan' => 'Komisi Usia Indah', 'nama_tampilan' => 'Pnt. Elisabeth W.', 'status' => 'aktif', 'ikon' => 'elderly'],
    ]);

    $penatuaData = isset($pelayan)
        ? $pelayan->filter(fn ($item) => ($item->kategori_halaman === 'penatua' || $item->posisi === 'Penatua'))
        : collect();

    $executives = $penatuaData->where('kelompok_layanan', 'pengurus_harian')->sortBy('urutan')->values();
    $bidangCollection = $penatuaData->where('kelompok_layanan', 'bidang_kerja')->sortBy('urutan')->groupBy('area_layanan');
    $pendampingKomisi = $penatuaData->where('kelompok_layanan', 'pendamping_komisi')->sortBy('urutan')->values();

    if ($executives->isEmpty()) {
        $executives = $fallbackExecutive;
    }
    if ($bidangCollection->isEmpty()) {
        $bidangCollection = $fallbackBidang;
    }
    if ($pendampingKomisi->isEmpty()) {
        $pendampingKomisi = $fallbackPendamping;
    }

    $findExecutive = function ($jabatan) use ($executives) {
        return $executives->first(fn ($item) => strtolower($item->jabatan_tampilan ?? '') === strtolower($jabatan));
    };

    $ketua = $findExecutive('Ketua Umum');
    $wakil = $findExecutive('Wakil Ketua');
    $sekretaris1 = $findExecutive('Sekretaris 1');
    $sekretaris2 = $findExecutive('Sekretaris 2');
    $bendahara1 = $findExecutive('Bendahara 1');
    $bendahara2 = $findExecutive('Bendahara 2');

    $metaSource = $executives->first() ?: (object) ['masa_bakti' => '2025 - 2026', 'update_terakhir' => '2024-05-12'];
    $masaBakti = $metaSource->masa_bakti ?? '2025 - 2026';
    $updateTerakhir = !empty($metaSource->update_terakhir)
        ? \Carbon\Carbon::parse($metaSource->update_terakhir)->translatedFormat('d F Y')
        : '12 Mei 2024';

    $bidangIcons = [
        'Bid. Sarpen' => 'construction',
        'Bid. Pembinaan' => 'school',
        'Bid. Kespel' => 'volunteer_activism',
        'Bid. Persekutuan' => 'groups',
    ];
@endphp

<div class="max-w-[1440px] mx-auto px-8 py-8">
    <header class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <div class="inline-flex items-center px-2 py-1 bg-secondary-container text-white rounded-lg mb-2">
                <span class="font-label-sm text-label-sm uppercase tracking-wider">Masa Bakti {{ $masaBakti }}</span>
            </div>
            <h1 class="font-h1 text-h1 text-primary leading-tight">
                Susunan Majelis Jemaat<br/>GKI Pakuwon
            </h1>
        </div>
        <div class="flex items-center gap-2 pb-1">
            <div class="text-right">
                <p class="font-label-md text-label-md text-gray-600">Update Terakhir</p>
                <p class="font-body-md text-body-md font-bold">{{ $updateTerakhir }}</p>
            </div>
            <div class="thin-rule w-12 hidden md:block"></div>
            <span class="material-symbols-outlined text-primary" style="font-size: 40px;">verified</span>
        </div>
    </header>

    <section class="mb-8">
        <div class="flex items-center gap-4 mb-6">
            <h2 class="font-h2 text-h2 text-primary">Pengurus Harian</h2>
            <div class="thin-rule flex-grow"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-8 bg-white border border-outline-variant p-6 rounded-xl shadow-sm flex flex-col justify-between min-h-[200px]">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest block mb-1">{{ $ketua->jabatan_tampilan ?? 'Ketua Umum' }}</span>
                        <h3 class="font-h1 text-h2 text-on-surface">{{ $ketua->nama_tampilan ?? $ketua->nama ?? 'Pnt. Alex R. Jacobus' }}</h3>
                    </div>
                    <span class="material-symbols-outlined text-secondary-fixed-dim" style="font-size: 48px;">account_balance</span>
                </div>
                <div class="flex gap-4 mt-6">
                    <div class="flex-1 border-t border-slate-100 pt-2">
                        <span class="font-caption text-caption text-gray-600">Visi Strategis</span>
                        <p class="font-label-md text-label-md">{{ $ketua->visi_strategis ?? 'Kepemimpinan & Tata Kelola' }}</p>
                    </div>
                    <div class="flex-1 border-t border-slate-100 pt-2">
                        <span class="font-caption text-caption text-gray-600">Fokus Utama</span>
                        <p class="font-label-md text-label-md">{{ $ketua->fokus_utama ?? 'Pertumbuhan Jemaat' }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-4 bg-primary text-white p-6 rounded-xl shadow-sm flex flex-col justify-between">
                <div>
                    <span class="font-label-sm text-label-sm text-blue-100 uppercase tracking-widest block mb-1">{{ $wakil->jabatan_tampilan ?? 'Wakil Ketua' }}</span>
                    <h3 class="font-h3 text-h3">{{ $wakil->nama_tampilan ?? $wakil->nama ?? 'Pnt. Dodi Wijaja' }}</h3>
                </div>
                <div class="mt-6">
                    <span class="material-symbols-outlined opacity-50" style="font-size: 32px;">supervisor_account</span>
                </div>
            </div>

            <div class="md:col-span-6 grid grid-cols-2 gap-6">
                <div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-secondary block mb-1">{{ $sekretaris1->jabatan_tampilan ?? 'Sekretaris 1' }}</span>
                    <p class="font-label-md text-label-md text-on-surface">{{ $sekretaris1->nama_tampilan ?? $sekretaris1->nama ?? 'Pnt. Marijani' }}</p>
                </div>
                <div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-secondary block mb-1">{{ $sekretaris2->jabatan_tampilan ?? 'Sekretaris 2' }}</span>
                    <p class="font-label-md text-label-md text-on-surface">{{ $sekretaris2->nama_tampilan ?? $sekretaris2->nama ?? 'Pnt. Megayenli' }}</p>
                </div>
            </div>

            <div class="md:col-span-6 grid grid-cols-2 gap-6">
                <div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-secondary block mb-1">{{ $bendahara1->jabatan_tampilan ?? 'Bendahara 1' }}</span>
                    <p class="font-label-md text-label-md text-on-surface">{{ $bendahara1->nama_tampilan ?? $bendahara1->nama ?? 'Pnt. Endah Trinawati' }}</p>
                </div>
                <div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-secondary block mb-1">{{ $bendahara2->jabatan_tampilan ?? 'Bendahara 2' }}</span>
                    <p class="font-label-md text-label-md text-on-surface">{{ $bendahara2->nama_tampilan ?? $bendahara2->nama ?? 'Pnt. Hendra Sakaroben' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-8">
        <div class="flex items-center gap-4 mb-6">
            <h2 class="font-h2 text-h2 text-primary">Bidang Kerja</h2>
            <div class="thin-rule flex-grow"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($bidangCollection as $bidangNama => $anggota)
                @php
                    $firstBidang = $anggota->first();
                    $bidangIcon = $firstBidang->ikon ?? ($bidangIcons[$bidangNama] ?? 'groups');
                @endphp
                <div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-surface-container-low p-4 border-b border-outline-variant flex items-center justify-between">
                        <h4 class="font-label-md text-label-md text-primary uppercase tracking-tight">{{ $bidangNama }}</h4>
                        <span class="material-symbols-outlined text-gray-600">{{ $bidangIcon }}</span>
                    </div>
                    <div class="p-4 space-y-sm">
                        @foreach($anggota as $person)
                            <p class="font-body-md text-body-md border-b border-slate-50 pb-1">{{ $person->nama_tampilan ?? $person->nama }}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

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
                    @foreach($pendampingKomisi as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary text-[20px]">{{ $item->ikon ?? 'groups' }}</span>
                                <span class="font-label-md text-label-md">{{ $item->area_layanan ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-body-md text-body-md">{{ $item->nama_tampilan ?? $item->nama }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-2 py-1 {{ strtolower($item->status ?? '') === 'aktif' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-700 border-red-100' }} text-[10px] font-bold uppercase rounded-full border">
                                    {{ strtolower($item->status ?? '') === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

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
