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
<div class="w-full max-w-7xl mx-auto pt-2">
    <div class="mb-6 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-950">Selamat Datang, Admin</h1>
            <p class="mt-1 max-w-2xl text-sm font-semibold text-slate-500">Berikut adalah ringkasan statistik jemaat GKI Pakuwon hari ini.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-primary/20 hover:bg-blue-800 transition">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Homepage
            </a>
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" @click="open = !open" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-700 shadow-sm hover:bg-slate-50 transition">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Export Laporan Jemaat
                    <span class="material-symbols-outlined text-[18px]" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition x-cloak class="absolute right-0 z-20 mt-2 w-64 overflow-hidden rounded-2xl border border-slate-100 bg-white p-2 shadow-xl shadow-slate-900/10">
                    <a href="{{ route('dashboard.export.jemaat.pdf') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:text-primary">
                        <span class="material-symbols-outlined text-[18px] text-rose-500">picture_as_pdf</span>
                        Statistik Jemaat PDF
                    </a>
                    <a href="{{ route('dashboard.export.jemaat.excel') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:text-primary">
                        <span class="material-symbols-outlined text-[18px] text-emerald-500">table_view</span>
                        Data Jemaat Excel
                    </a>
                    <a href="{{ route('dashboard.export.keluarga.excel') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:text-primary">
                        <span class="material-symbols-outlined text-[18px] text-indigo-500">backup_table</span>
                        Data Keluarga Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        @foreach($summaryCards as $card)
            <div class="dashboard-card rounded-xl p-5">
                <div class="flex min-h-24 items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="truncate text-[10px] font-extrabold uppercase tracking-widest text-slate-400">{{ $card['label'] }}</p>
                        <p class="mt-4 text-3xl font-extrabold text-slate-950">{{ number_format($card['value'], 0, ',', '.') }}</p>
                    </div>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $card['tone'] }}">
                        <span class="material-symbols-outlined text-[20px]">{{ $card['icon'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">
        <section class="xl:col-span-8">
            <div class="dashboard-card overflow-hidden rounded-xl">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-base font-extrabold text-slate-950">Statistik Keluarga per Sektor</h2>
                    <p class="mt-1 text-xs font-medium text-slate-500">Persebaran keluarga dan anggota jemaat berdasarkan wilayah pelayanan.</p>
                </div>
                <div class="min-h-80 p-6">
                    @if(empty($sektorLabels))
                        <div class="flex min-h-64 items-center justify-center text-sm italic text-slate-400">Belum ada data sektor.</div>
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
                                <div class="grid grid-cols-1 gap-3 md:grid-cols-4 md:items-center">
                                    <div class="truncate text-sm font-bold text-slate-700">{{ $label ?: 'Tanpa Sektor' }}</div>
                                    <div class="space-y-2 md:col-span-3">
                                        <div class="flex items-center gap-3">
                                            <span class="w-16 text-[10px] font-bold uppercase text-slate-400">Keluarga</span>
                                            <div class="h-3 flex-1 overflow-hidden rounded-full bg-blue-50">
                                                <div class="h-full rounded-full bg-blue-500" style="width: {{ $keluargaWidth }}%"></div>
                                            </div>
                                            <span class="w-8 text-right text-xs font-bold text-slate-700">{{ $keluargaCount }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="w-16 text-[10px] font-bold uppercase text-slate-400">Jemaat</span>
                                            <div class="h-3 flex-1 overflow-hidden rounded-full bg-indigo-50">
                                                <div class="h-full rounded-full bg-primary" style="width: {{ $jemaatWidth }}%"></div>
                                            </div>
                                            <span class="w-8 text-right text-xs font-bold text-slate-700">{{ $jemaatCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <aside class="space-y-6 xl:col-span-4">
            <div class="dashboard-card rounded-xl p-6">
                <h2 class="mb-5 text-xs font-extrabold uppercase tracking-widest text-slate-400">Aksi Cepat</h2>
                <div class="divide-y divide-slate-100">
                    <a href="{{ route('dashboard.jemaat.create') }}" class="flex items-center justify-between gap-4 py-4 group">
                        <span class="text-sm font-extrabold text-slate-700 group-hover:text-primary">Tambah Jemaat</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:text-primary">add</span>
                    </a>
                    <a href="{{ route('dashboard.keluarga.create') }}" class="flex items-center justify-between gap-4 py-4 group">
                        <span class="text-sm font-extrabold text-slate-700 group-hover:text-primary">Tambah Keluarga</span>
                        <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:text-primary">add</span>
                    </a>
                </div>
            </div>

            <div class="rounded-xl bg-primary p-6 text-white shadow-lg shadow-primary/15">
                <h3 class="mb-5 text-[10px] font-extrabold uppercase tracking-widest text-blue-200">Aktivitas Terakhir</h3>
                <div class="flex flex-col gap-4">
                    @forelse($recentActivities as $activity)
                        <div class="flex gap-3">
                            <div class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-300"></div>
                            <div class="min-w-0">
                                <p class="break-words text-xs font-bold leading-tight">{{ $activity['action'] }}</p>
                                <p class="mt-1 text-[9px] font-semibold uppercase tracking-wider text-blue-200/70">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs font-medium italic text-blue-200/70">Belum ada aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-12">
        <section class="xl:col-span-8">
            <div class="dashboard-card overflow-hidden rounded-xl">
                <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-sm font-extrabold uppercase tracking-wider text-slate-950">Jemaat Baru Terdaftar</h2>
                        <p class="mt-1 text-xs font-medium text-slate-500">5 jemaat terakhir di database.</p>
                    </div>
                    <a href="{{ route('dashboard.jemaat.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px] text-left text-sm">
                        <thead class="bg-slate-50 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            <tr>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">L/P</th>
                                <th class="px-6 py-4">Sektor</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-slate-700">
                            @forelse($jemaatTerbaru as $j)
                                <tr class="hover:bg-slate-50/50">
                                    <td class="px-6 py-4 font-bold text-slate-950">{{ $j->nama_lengkap }}</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">{{ in_array($j->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']) ? 'L' : 'P' }}</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">{{ $j->keluarga ? ($j->keluarga->wilayah_pelayanan ?: 'Tanpa Sektor') : '-' }}</td>
                                    <td class="px-6 py-4">
                                        @php $isActive = $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif'; @endphp
                                        <span class="rounded-lg border px-3 py-1 text-[10px] font-bold {{ $isActive ? 'border-emerald-100 bg-emerald-50 text-emerald-600' : 'border-slate-100 bg-slate-50 text-slate-500' }}">
                                            {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center font-medium italic text-slate-400">Belum ada jemaat baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <aside class="xl:col-span-4">
            <div class="dashboard-card overflow-hidden rounded-xl">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-base font-extrabold text-slate-950">Demografi Usia Jemaat</h2>
                    <p class="mt-1 text-xs font-medium text-slate-500">Kategori umur jemaat aktif.</p>
                </div>
                <div class="space-y-4 p-6">
                    @forelse($ageStats ?? [] as $label => $value)
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex min-w-0 items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full {{ $loop->iteration === 1 ? 'bg-blue-500' : ($loop->iteration === 2 ? 'bg-purple-500' : ($loop->iteration === 3 ? 'bg-indigo-500' : ($loop->iteration === 4 ? 'bg-emerald-500' : 'bg-rose-500'))) }}"></span>
                                <span class="truncate text-sm font-bold text-slate-700">{{ $label }}</span>
                            </div>
                            <span class="text-sm font-extrabold text-slate-950">{{ number_format($value, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="py-12 text-center text-sm italic text-slate-400">Belum ada data usia.</div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
