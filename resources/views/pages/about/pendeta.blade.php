<x-layouts.main title="Profil Pendeta" :fullWidth="true">
@php
    $fallbackPendeta = (object) [
        'nama' => 'Pdt. Dr. Yerusa Maria Agustini, S.Si., M.Pd.',
        'nama_tampilan' => 'Pdt. Dr. Yerusa Maria Agustini, S.Si., M.Pd.',
        'jabatan_tampilan' => 'Pendeta Jemaat GKI Komplek Pakuwon',
        'foto' => null,
        'pasangan' => 'Ayub Wahyono',
        'email' => 'yerumartin@yahoo.com',
        'pendidikan' => "1997 - 2003|S1 Teologi|Universitas Kristen Dutawacana Yogyakarta\n2010 - 2012|S2 Manajemen / Administrasi Pendidikan|Universitas Kristen Indonesia\n2016 - 2020|S3 Teknologi Pendidikan Konsentrasi PAUD|Universitas Negeri Jakarta",
        'riwayat_pelayanan' => "23 Januari 2011|Diteguhkan sebagai Penatua Khusus|Langkah awal dalam pengabdian struktural jemaat.\n23 Januari 2013|Ditahbiskan ke dalam jabatan Pendeta|Memasuki masa kependetaan penuh melalui penahbisan resmi.\n1 Oktober 2018|Diteguhkan sebagai pendeta|Pengukuhan komitmen pelayanan berkelanjutan dalam gereja.\nSaat ini|Melayani di GKI Komplek Pakuwon|Memberikan bimbingan spiritual dan kepemimpinan bagi jemaat Pakuwon.",
        'visi_pelayanan' => 'Menghadirkan damai sejahtera Kristus melalui pendidikan dan pendampingan jemaat yang holistik, membangun generasi masa depan yang berlandaskan kasih.',
        'jadwal_konseling' => 'Selasa & Kamis, 10:00 - 14:00',
        'status' => 'aktif',
    ];

    $pendetaData = isset($pelayan)
        ? $pelayan->first(function ($item) {
            return ($item->kategori_halaman === 'pendeta' || $item->posisi === 'Pendeta')
                && (($item->kelompok_layanan ?? null) === 'profil_pendeta' || empty($item->kelompok_layanan));
        })
        : null;

    $pendeta = $pendetaData ?: $fallbackPendeta;
    $pendetaFoto = !empty($pendeta->foto)
        ? asset('storage/' . $pendeta->foto)
        : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBLIGeVdaFtvFOU0dkO2F5DeNZsS1JOIzfYQ0iNwlxUNjj8uRDF4puelkrOEHpiYwrEU1l6wAtlnrHY1Z2QfakK1igLmANANPt3xGMHEJbrNEEX-zsmT0VVsEDnLFwbJAaMXc3kC3Qe5VP7XD0K-PECiEO2I8Fr2EmjPUZDIFWrdq-ys6YCXoe5cYxcBBgebEfCngRQMv8d1H3suBktE-iejugr6j_2mNfWOj3tvtRDXlNMXcmxiLctwA1Ev24ovcTJy-7Whgw83fY';

    $parseTimeline = function ($text) {
        return collect(preg_split("/\r\n|\n|\r/", (string) $text))
            ->filter()
            ->map(function ($line) {
                [$date, $title, $description] = array_pad(explode('|', $line, 3), 3, '');
                return compact('date', 'title', 'description');
            });
    };

    $riwayatPelayanan = $parseTimeline($pendeta->riwayat_pelayanan ?? '');
    $pendidikan = $parseTimeline($pendeta->pendidikan ?? '');
@endphp

<div class="max-w-[1440px] mx-auto px-8 py-8">
    <div class="bento-grid">
        <section class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            <div class="glass-card rounded-2xl p-8 flex flex-col md:flex-row gap-8 items-center md:items-start relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32"></div>
                <div class="w-48 h-48 flex-shrink-0 rounded-2xl border-4 border-white shadow-lg overflow-hidden relative z-10">
                    <img alt="{{ $pendeta->nama_tampilan ?? $pendeta->nama }}" class="w-full h-full object-cover" src="{{ $pendetaFoto }}"/>
                </div>
                <div class="flex flex-col gap-2 relative z-10">
                    <span class="font-label-md text-secondary tracking-widest uppercase">Profil Pendeta</span>
                    <h1 class="font-h1 text-h1 text-primary mb-1">{{ $pendeta->nama_tampilan ?? $pendeta->nama }}</h1>
                    <p class="font-h3 text-h3 text-gray-600">{{ $pendeta->jabatan_tampilan ?: 'Pendeta Jemaat GKI Komplek Pakuwon' }}</p>
                    <div class="flex flex-wrap gap-4 mt-4">
                        @if(!empty($pendeta->pasangan))
                            <div class="flex items-center gap-1 px-4 py-2 bg-surface-container rounded-xl">
                                <span class="material-symbols-outlined text-primary">favorite</span>
                                <span class="font-label-md">Suami: {{ $pendeta->pasangan }}</span>
                            </div>
                        @endif
                        @if(!empty($pendeta->email))
                            <div class="flex items-center gap-1 px-4 py-2 bg-surface-container rounded-xl">
                                <span class="material-symbols-outlined text-primary">mail</span>
                                <span class="font-label-md">{{ $pendeta->email }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-8 flex flex-col gap-6">
                <div class="flex items-center gap-4 border-b border-outline-variant pb-4">
                    <span class="material-symbols-outlined text-primary text-3xl">history_edu</span>
                    <h2 class="font-h2 text-h2 text-primary">Riwayat Pelayanan</h2>
                </div>
                <div class="relative pl-2">
                    <div class="absolute left-4 top-2 bottom-2 w-0.5 bg-surface-container-high"></div>
                    <div class="flex flex-col gap-8">
                        @foreach($riwayatPelayanan as $index => $item)
                            <div class="relative pl-12">
                                @if($loop->last)
                                    <div class="absolute left-1.5 top-0 w-5 h-5 bg-primary rounded-full flex items-center justify-center border-4 border-white shadow-md">
                                        <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                                    </div>
                                @else
                                    <div class="absolute left-2.5 top-1.5 w-3 h-3 bg-secondary rounded-full border-2 border-white ring-4 ring-secondary/20"></div>
                                @endif
                                <div class="font-label-sm {{ $loop->last ? 'text-primary' : 'text-secondary' }} mb-1">{{ $item['date'] }}</div>
                                <h3 class="font-h3 text-h3 text-primary {{ $loop->last ? 'font-bold' : '' }}">{{ $item['title'] }}</h3>
                                @if(!empty($item['description']))
                                    <p class="text-gray-600 mt-1">{{ $item['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <aside class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            <div class="glass-card rounded-xl p-8 flex flex-col gap-6 border-l-4 border-l-secondary">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-3xl">school</span>
                    <h2 class="font-h2 text-h2 text-primary">Pendidikan</h2>
                </div>
                <div class="flex flex-col gap-8">
                    @foreach($pendidikan as $item)
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-secondary px-2 py-0.5 bg-secondary/10 rounded-md self-start">{{ $item['date'] }}</span>
                            <h3 class="font-label-md text-primary">{{ $item['title'] }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-primary rounded-xl p-8 text-white relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="grid grid-cols-6 gap-2 rotate-12 -translate-x-10 -translate-y-10">
                        <div class="h-12 w-12 bg-white rounded-full"></div>
                        <div class="h-12 w-12 bg-white rounded-full"></div>
                        <div class="h-12 w-12 bg-white rounded-full"></div>
                        <div class="h-12 w-12 bg-white rounded-full"></div>
                        <div class="h-12 w-12 bg-white rounded-full"></div>
                    </div>
                </div>
                <h3 class="font-h3 text-h3 mb-4 relative z-10">Visi Pelayanan</h3>
                <p class="font-body-lg text-body-lg text-blue-100 relative z-10 italic">
                    "{{ $pendeta->visi_pelayanan }}"
                </p>
                <div class="mt-8 pt-6 border-t border-white/10 flex justify-between items-center relative z-10">
                    <div class="flex flex-col">
                        <span class="font-label-sm uppercase opacity-60">Status</span>
                        <span class="font-label-md">{{ strtolower($pendeta->status ?? '') === 'aktif' ? 'Aktif Melayani' : 'Tidak Aktif' }}</span>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-blue-100 opacity-40">church</span>
                </div>
            </div>

            @if(!empty($pendeta->jadwal_konseling))
                <div class="glass-card rounded-xl p-4">
                    <div class="flex items-center gap-4 p-4 bg-surface-container rounded-lg">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">calendar_today</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-label-sm text-gray-600">Jadwal Konseling</span>
                            <span class="font-label-md text-primary">{{ $pendeta->jadwal_konseling }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </aside>
    </div>
</div>
</x-layouts.main>
