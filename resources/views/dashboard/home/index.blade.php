@extends('dashboard.layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight">Selamat Datang, Admin</h1>
        <p class="text-gray-400 text-sm font-medium mt-1">Berikut adalah ringkasan statistik jemaat GKI Pakuwon hari ini.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ url('/') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Homepage
        </a>
        
        <!-- Alpine Dropdown for Export Laporan -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="px-5 py-2.5 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-600 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export Laporan Jemaat
            <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div x-show="open" x-transition class="absolute right-0 mt-2 w-64 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden py-1.5" style="display: none;">
            <a href="{{ route('dashboard.export.jemaat.pdf') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Laporan Statistik Jemaat (PDF)
            </a>
            <a href="{{ route('dashboard.export.jemaat.excel') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Data Jemaat Lengkap (Excel)
            </a>
            <a href="{{ route('dashboard.export.keluarga.excel') }}" class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Data Keluarga Lengkap (Excel)
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
    <!-- Jumlah Keluarga -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Keluarga</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ $stats['keluarga'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
    </div>

    <!-- Total Jemaat -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Total Jemaat</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ $stats['jemaat'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-indigo-50 text-indigo-500 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
    </div>

    <!-- Jemaat Aktif -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Jemaat Aktif</p>
        <h3 class="text-2xl font-extrabold text-emerald-600 tracking-tight">{{ $stats['aktif'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>

    <!-- Pemuda / Pemudi -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Pemuda/Pemudi</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ $stats['pemuda'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>

    <!-- Jemaat Baptis -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Sudah Baptis</p>
        <h3 class="text-2xl font-extrabold text-blue-600 tracking-tight">{{ $stats['baptis'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-[18px]">water_drop</span>
        </div>
    </div>

    <!-- Jemaat Sidi -->
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all duration-300">
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-wider mb-1">Sudah Sidi</p>
        <h3 class="text-2xl font-extrabold text-teal-600 tracking-tight">{{ $stats['sidi'] }}</h3>
        <div class="mt-3 w-8 h-8 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-[18px]">verified</span>
        </div>
    </div>
</div>

<!-- Charts Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <!-- Bar Chart: Sektor -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Statistik Keluarga & Jemaat per Sektor</h2>
                <p class="text-xs text-gray-400 font-medium mt-1">Persebaran jumlah keluarga dan total anggota jemaat per wilayah sektor pelayanan</p>
            </div>
        </div>
        <div class="p-8 h-[350px] flex items-center justify-center">
            @if(empty($sektorLabels))
            <p class="text-gray-400 italic text-sm">Belum ada data sektor.</p>
            <canvas id="sectorChart" style="display: none;"></canvas>
            @else
            <canvas id="sectorChart"></canvas>
            @endif
        </div>
    </div>

    <!-- Doughnut Chart: Age Demographics -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-800">Demografi Usia Jemaat</h2>
            <p class="text-xs text-gray-400 font-medium mt-1">Pembagian kategori umur anggota jemaat aktif</p>
        </div>
        
        <div class="relative h-[220px] my-4 flex items-center justify-center">
            <canvas id="ageDemographicsChart"></canvas>
        </div>

        <div class="grid grid-cols-5 gap-1 text-center text-[10px] font-bold text-gray-400 mt-2">
            <div>
                <div class="w-2.5 h-2.5 rounded-full bg-blue-500 mx-auto mb-1"></div>
                Anak
            </div>
            <div>
                <div class="w-2.5 h-2.5 rounded-full bg-purple-500 mx-auto mb-1"></div>
                Remaja
            </div>
            <div>
                <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 mx-auto mb-1"></div>
                Pemuda
            </div>
            <div>
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 mx-auto mb-1"></div>
                Dewasa
            </div>
            <div>
                <div class="w-2.5 h-2.5 rounded-full bg-rose-500 mx-auto mb-1"></div>
                Lansia
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Jemaat Terbaru Table -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Jemaat Baru Terdaftar</h2>
                <p class="text-xs text-gray-400 font-medium mt-0.5">5 jemaat terdaftar terakhir di dalam sistem database</p>
            </div>
            <a href="{{ route('dashboard.jemaat.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Nama Lengkap</th>
                        <th class="px-8 py-4">L/P</th>
                        <th class="px-8 py-4">Sektor</th>
                        <th class="px-8 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($jemaatTerbaru as $j)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-3.5 font-bold text-gray-800">{{ $j->nama_lengkap }}</td>
                        <td class="px-8 py-3.5 font-medium text-gray-400">{{ in_array($j->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']) ? 'L' : 'P' }}</td>
                        <td class="px-8 py-3.5 text-gray-500 font-medium">{{ $j->keluarga ? ($j->keluarga->wilayah_pelayanan ?: 'Tanpa Sektor') : '-' }}</td>
                        <td class="px-8 py-3.5">
                            <span class="px-2.5 py-1 text-[9px] font-bold rounded-lg {{ $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-500 border border-slate-100' }}">
                                {{ $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-8 text-center text-gray-400 italic font-medium">Belum ada jemaat baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Links / Recent Activities -->
    <div class="flex flex-col gap-6">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Aksi Cepat</h2>
            <div class="flex flex-col gap-3">
                <a href="{{ route('dashboard.jemaat.create') }}" class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-primary hover:bg-blue-50/30 transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-50 text-primary rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                        </div>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-primary transition-colors">Tambah Anggota Jemaat</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-primary transition-all group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('dashboard.keluarga.create') }}" class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-indigo-500 hover:bg-indigo-50/30 transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">family_home</span>
                        </div>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600 transition-colors">Daftarkan Keluarga Baru</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-indigo-600 transition-all group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="bg-primary rounded-3xl p-8 text-white shadow-xl shadow-primary/20 relative overflow-hidden">
            <div class="absolute right-[-10px] top-[-10px] w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
            <h3 class="text-[9px] font-bold text-blue-200 uppercase tracking-widest mb-4 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-300 animate-pulse"></span>
                Aktivitas Terakhir Admin
            </h3>
            <div class="flex flex-col gap-4">
                @forelse($recentActivities as $activity)
                <div class="flex gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-300 mt-1.5 flex-shrink-0"></div>
                    <div>
                        <p class="text-xs font-bold leading-tight">{{ $activity['action'] }}</p>
                        <p class="text-[9px] text-blue-200/60 mt-1 uppercase tracking-wider font-semibold">{{ $activity['time'] }}</p>
                    </div>
                </div>
                @empty
                <p class="text-xs text-blue-200/60 italic font-medium">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const labels = @json($sektorLabels);
    const sectorFamilyData = @json($sektorData);
    const sectorJemaatData = @json($sektorJemaatData);

    if (labels.length > 0) {
        const ctx = document.getElementById('sectorChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Jumlah Keluarga',
                        data: sectorFamilyData,
                        backgroundColor: '#3b82f6', // Light Blue
                        borderRadius: 6,
                        barThickness: 16
                    },
                    {
                        label: 'Jumlah Anggota Jemaat',
                        data: sectorJemaatData,
                        backgroundColor: '#00236f', // Deep Blue
                        borderRadius: 6,
                        barThickness: 16
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { 
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 10, weight: 'bold' },
                            color: '#64748b'
                        }
                    } 
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#f8fafc' }, 
                        border: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    },
                    x: { 
                        grid: { display: false }, 
                        border: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10, weight: 'bold' } }
                    }
                }
            }
        });
    }

    // Age Demographics Doughnut Chart
    const ageStats = @json($ageStats);
    const ageCtx = document.getElementById('ageDemographicsChart').getContext('2d');
    new Chart(ageCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(ageStats),
            datasets: [{
                data: Object.values(ageStats),
                backgroundColor: [
                    '#3b82f6', // Anak (Blue)
                    '#a855f7', // Remaja (Purple)
                    '#6366f1', // Pemuda (Indigo)
                    '#10b981', // Dewasa (Emerald)
                    '#f43f5e'  // Lansia (Rose)
                ],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
@endsection
