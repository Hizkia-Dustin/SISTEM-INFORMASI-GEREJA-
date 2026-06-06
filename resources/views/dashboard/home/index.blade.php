@extends('dashboard.layouts.app')
@section('title', 'Dashboard')

@php
    $summaryCards = [
        ['label' => 'Keluarga', 'value' => $stats['keluarga'] ?? 0, 'icon' => 'family_home', 'tone' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Total Jemaat', 'value' => $stats['jemaat'] ?? 0, 'icon' => 'groups', 'tone' => 'bg-indigo-50 text-indigo-600'],
        ['label' => 'Jemaat Aktif', 'value' => $stats['aktif'] ?? 0, 'icon' => 'verified', 'tone' => 'bg-emerald-50 text-emerald-600'],
        ['label' => 'Pemuda/Pemudi', 'value' => $stats['pemuda'] ?? 0, 'icon' => 'diversity_3', 'tone' => 'bg-purple-50 text-purple-600'],
        ['label' => 'Sudah Baptis', 'value' => $stats['baptis'] ?? 0, 'icon' => 'water_drop', 'tone' => 'bg-sky-50 text-sky-600'],
        ['label' => 'Sudah Sidi', 'value' => $stats['sidi'] ?? 0, 'icon' => 'workspace_premium', 'tone' => 'bg-teal-50 text-teal-600'],
    ];
@endphp

@section('content')
<div class="w-full max-w-[1280px] mx-auto">
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5 mb-8">
        <div class="min-w-0">
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang, Admin</h1>
            <p class="text-gray-500 text-sm font-medium mt-1 max-w-2xl">Ringkasan data jemaat GKI Pakuwon hari ini dari database sistem.</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Homepage
            </a>

            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" @click="open = !open" class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Export Laporan
                    <span class="material-symbols-outlined text-[18px]" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition x-cloak class="absolute right-0 mt-2 w-72 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden py-2">
                    <a href="{{ route('dashboard.export.jemaat.pdf') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-red-500">picture_as_pdf</span>
                        Laporan Statistik Jemaat (PDF)
                    </a>
                    <a href="{{ route('dashboard.export.jemaat.excel') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-emerald-500">table_view</span>
                        Data Jemaat Lengkap (Excel)
                    </a>
                    <a href="{{ route('dashboard.export.keluarga.excel') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-indigo-500">backup_table</span>
                        Data Keluarga Lengkap (Excel)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6 gap-4 mb-8">
        @foreach($summaryCards as $card)
            <div class="min-w-0 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-gray-400 text-[10px] font-extrabold uppercase tracking-widest truncate">{{ $card['label'] }}</p>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight mt-2">{{ number_format($card['value'], 0, ',', '.') }}</p>
                    </div>
                    <div class="w-10 h-10 shrink-0 rounded-xl {{ $card['tone'] }} flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px]">{{ $card['icon'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        <div class="xl:col-span-2 min-w-0 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-base font-extrabold text-gray-900">Statistik Keluarga & Jemaat per Sektor</h2>
                <p class="text-xs text-gray-500 font-medium mt-1">Persebaran keluarga dan anggota jemaat berdasarkan wilayah pelayanan.</p>
            </div>
            <div class="p-6">
                @if(empty($sektorLabels))
                    <div class="py-16 text-center text-gray-400 italic text-sm">Belum ada data sektor.</div>
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

        <div class="min-w-0 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-base font-extrabold text-gray-900">Demografi Usia Jemaat</h2>
                <p class="text-xs text-gray-500 font-medium mt-1">Ringkasan kategori umur jemaat aktif.</p>
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
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 min-w-0 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider">Jemaat Baru Terdaftar</h2>
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

        <div class="min-w-0 flex flex-col gap-6">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-5">Aksi Cepat</h2>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('dashboard.jemaat.create') }}" class="flex items-center justify-between gap-4 p-4 rounded-2xl border border-gray-100 hover:border-primary hover:bg-blue-50/30 transition-all group">
                        <span class="text-sm font-bold text-gray-700 group-hover:text-primary">Tambah Anggota Jemaat</span>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-primary">chevron_right</span>
                    </a>
                    <a href="{{ route('dashboard.keluarga.create') }}" class="flex items-center justify-between gap-4 p-4 rounded-2xl border border-gray-100 hover:border-indigo-500 hover:bg-indigo-50/30 transition-all group">
                        <span class="text-sm font-bold text-gray-700 group-hover:text-indigo-600">Daftarkan Keluarga Baru</span>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-indigo-600">chevron_right</span>
                    </a>
                </div>
            </div>

            <div class="bg-primary rounded-3xl p-6 text-white shadow-xl shadow-primary/20">
                <h3 class="text-[10px] font-extrabold text-blue-200 uppercase tracking-widest mb-5">Aktivitas Terakhir Admin</h3>
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
</div>
@endsection
