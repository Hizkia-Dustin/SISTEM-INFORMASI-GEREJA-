@extends('dashboard.layouts.app')
@section('title', 'Dashboard')

@php
    $summaryCards = [
        ['label' => 'Jumlah Keluarga', 'value' => $stats['keluarga'] ?? 0, 'icon' => 'home', 'tone' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Pemuda/Pemudi', 'value' => $stats['pemuda'] ?? 0, 'icon' => 'diversity_3', 'tone' => 'bg-purple-50 text-purple-600'],
        ['label' => 'Laki-laki (Ama)', 'value' => $stats['ama'] ?? 0, 'icon' => 'person', 'tone' => 'bg-indigo-50 text-indigo-600'],
        ['label' => 'Perempuan (Ina)', 'value' => $stats['ina'] ?? 0, 'icon' => 'person', 'tone' => 'bg-pink-50 text-pink-500'],
        ['label' => 'Jemaat Aktif', 'value' => $stats['aktif'] ?? 0, 'icon' => 'verified', 'tone' => 'bg-emerald-50 text-emerald-600'],
    ];
@endphp

@section('content')
<div class="w-full max-w-[1480px] mx-auto pt-1">
    <div class="mb-6">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold text-slate-900">Selamat Datang, Admin</h1>
            <p class="text-slate-500 text-sm font-semibold mt-1 max-w-2xl">Berikut adalah ringkasan statistik jemaat GKI Pakuwon hari ini.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-6 min-w-0">
        @foreach($summaryCards as $card)
            <div class="min-w-0 dashboard-card p-5 rounded-xl min-h-[124px]">
                <div class="flex flex-col h-full justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-slate-400 text-[10px] font-extrabold uppercase tracking-widest truncate">{{ $card['label'] }}</p>
                        <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ number_format($card['value'], 0, ',', '.') }}</p>
                    </div>
                    <div class="w-9 h-9 shrink-0 rounded-lg {{ $card['tone'] }} flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">{{ $card['icon'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_350px] gap-6 mb-6 min-w-0 items-start">
        <div class="min-w-0 dashboard-card rounded-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-base font-extrabold text-slate-900">Statistik Keluarga per Sektor</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Persebaran keluarga dan anggota jemaat berdasarkan wilayah pelayanan.</p>
            </div>
            <div class="p-6 min-h-[300px]">
                @if(empty($sektorLabels))
                    <div class="min-h-[220px] flex items-center justify-center text-gray-400 italic text-sm">Belum ada data sektor.</div>
                @else
                    <div class="space-y-4">
                        @foreach($sektorLabels as $index => $label)
                            @php
                                $keluargaCount = $sektorData[$index] ?? 0;
                                $jemaatCount = $sektorJemaatData[$index] ?? 0;
                                $maxCount = max(max($sektorJemaatData ?: [1]), max($sektorData ?: [1]), 1);
                                $keluargaWidth = max(6, min(100, ($keluargaCount / $maxCount) * 100));
                                $jemaatWidth = max(6, min(100, ($jemaatCount / $maxCount) * 100));
                            @endphp
                            <div class="grid grid-cols-1 md:grid-cols-[160px_1fr] gap-3 md:items-center">
                                <div class="text-sm font-bold text-gray-700 truncate">{{ $label ?: 'Tanpa Sektor' }}</div>
                                <div class="space-y-2 min-w-0">
                                    <div class="flex items-center gap-3">
                                        <span class="w-16 text-[10px] font-bold text-gray-400 uppercase">Keluarga</span>
                                        <div class="h-3 flex-1 rounded-full bg-blue-50 overflow-hidden">
                                            <div class="h-full rounded-full bg-blue-500" style="width: {{ $keluargaWidth }}%"></div>
                                        </div>
                                        <span class="w-8 text-right text-xs font-bold text-gray-700">{{ $keluargaCount }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="w-16 text-[10px] font-bold text-gray-400 uppercase">Jemaat</span>
                                        <div class="h-3 flex-1 rounded-full bg-indigo-50 overflow-hidden">
                                            <div class="h-full rounded-full bg-primary" style="width: {{ $jemaatWidth }}%"></div>
                                        </div>
                                        <span class="w-8 text-right text-xs font-bold text-gray-700">{{ $jemaatCount }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="min-w-0 flex flex-col gap-5">
            <div class="dashboard-card rounded-xl p-6">
                <h2 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-5">Aksi Cepat</h2>
                <div class="flex flex-col divide-y divide-slate-100">
                    <a href="{{ route('dashboard.jemaat.create') }}" class="flex items-center justify-between gap-4 py-4 group">
                        <span class="text-sm font-extrabold text-slate-700 group-hover:text-primary">Tambah Jemaat</span>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-primary text-[18px]">add</span>
                    </a>
                    <a href="{{ route('dashboard.keluarga.create') }}" class="flex items-center justify-between gap-4 py-4 group">
                        <span class="text-sm font-extrabold text-slate-700 group-hover:text-primary">Tambah Keluarga</span>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-primary text-[18px]">add</span>
                    </a>
                </div>
            </div>

            <div class="bg-primary rounded-xl p-6 text-white shadow-lg shadow-primary/15">
                <h3 class="text-[10px] font-extrabold text-blue-200 uppercase tracking-widest mb-5">Aktivitas Terakhir</h3>
                <div class="flex flex-col gap-4">
                    @forelse($recentActivities as $activity)
                        <div class="flex gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-300 mt-1.5 shrink-0"></div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold leading-tight break-words">{{ $activity['action'] }}</p>
                                <p class="text-[9px] text-blue-200/70 mt-1 uppercase tracking-wider font-semibold">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-blue-200/70 italic font-medium">Belum ada aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_350px] gap-6 min-w-0">
        <div class="min-w-0 dashboard-card rounded-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Jemaat Baru Terdaftar</h2>
                    <p class="text-xs text-gray-500 font-medium mt-1">5 jemaat terakhir di database.</p>
                </div>
                <a href="{{ route('dashboard.jemaat.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="bg-gray-50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">L/P</th>
                            <th class="px-6 py-4">Sektor</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($jemaatTerbaru as $j)
                            <tr class="hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $j->nama_lengkap }}</td>
                                <td class="px-6 py-4 font-medium text-gray-500">{{ in_array($j->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']) ? 'L' : 'P' }}</td>
                                <td class="px-6 py-4 text-gray-500 font-medium">{{ $j->keluarga ? ($j->keluarga->wilayah_pelayanan ?: 'Tanpa Sektor') : '-' }}</td>
                                <td class="px-6 py-4">
                                    @php $isActive = $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif'; @endphp
                                    <span class="px-3 py-1 text-[10px] font-bold rounded-lg {{ $isActive ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-500 border border-slate-100' }}">
                                        {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic font-medium">Belum ada jemaat baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="min-w-0 dashboard-card rounded-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-base font-extrabold text-slate-900">Demografi Usia Jemaat</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Kategori umur jemaat aktif.</p>
            </div>
            <div class="p-6 space-y-4">
                @forelse($ageStats ?? [] as $label => $value)
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="w-2.5 h-2.5 rounded-full {{ $loop->iteration === 1 ? 'bg-blue-500' : ($loop->iteration === 2 ? 'bg-purple-500' : ($loop->iteration === 3 ? 'bg-indigo-500' : ($loop->iteration === 4 ? 'bg-emerald-500' : 'bg-rose-500'))) }}"></span>
                            <span class="text-sm font-bold text-gray-700 truncate">{{ $label }}</span>
                        </div>
                        <span class="text-sm font-extrabold text-gray-900">{{ number_format($value, 0, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="py-12 text-center text-gray-400 italic text-sm">Belum ada data usia.</div>
                @endforelse
                <div class="pt-4 mt-4 border-t border-slate-100" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-3 text-xs font-extrabold text-primary uppercase tracking-widest">
                        Unduh Laporan
                        <span class="material-symbols-outlined text-[18px]" :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="open" x-transition x-cloak class="mt-3 space-y-2">
                        <a href="{{ route('dashboard.export.jemaat.pdf') }}" class="flex items-center gap-3 rounded-lg bg-slate-50 px-3 py-2 text-xs font-bold text-slate-700 hover:text-primary">
                            <span class="material-symbols-outlined text-[17px] text-red-500">picture_as_pdf</span>
                            Statistik Jemaat PDF
                        </a>
                        <a href="{{ route('dashboard.export.jemaat.excel') }}" class="flex items-center gap-3 rounded-lg bg-slate-50 px-3 py-2 text-xs font-bold text-slate-700 hover:text-primary">
                            <span class="material-symbols-outlined text-[17px] text-emerald-500">table_view</span>
                            Data Jemaat Excel
                        </a>
                        <a href="{{ route('dashboard.export.keluarga.excel') }}" class="flex items-center gap-3 rounded-lg bg-slate-50 px-3 py-2 text-xs font-bold text-slate-700 hover:text-primary">
                            <span class="material-symbols-outlined text-[17px] text-indigo-500">backup_table</span>
                            Data Keluarga Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
