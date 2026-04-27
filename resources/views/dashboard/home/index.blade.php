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
        <button class="px-5 py-2.5 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-600 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export Laporan
        </button>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-5 gap-4 mb-10">
    <!-- Jumlah Keluarga -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Jumlah Keluarga</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">0</h3>
        <div class="mt-4 w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </div>
    </div>

    <!-- Jumlah Pemuda/Pemudi -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Pemuda/Pemudi</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">0</h3>
        <div class="mt-4 w-8 h-8 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>

    <!-- Jumlah Laki-laki (AMA) -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Laki-laki (AMA)</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">0</h3>
        <div class="mt-4 w-8 h-8 bg-indigo-50 text-indigo-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
    </div>

    <!-- Jumlah Perempuan (INA) -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Perempuan (INA)</p>
        <h3 class="text-2xl font-extrabold text-gray-800 tracking-tight">0</h3>
        <div class="mt-4 w-8 h-8 bg-pink-50 text-pink-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
    </div>

    <!-- Jumlah Jemaat Aktif -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm group hover:border-primary transition-all">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Jemaat Aktif</p>
        <h3 class="text-2xl font-extrabold text-emerald-600 tracking-tight">0</h3>
        <div class="mt-4 w-8 h-8 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-8">
    <!-- Bar Chart -->
    <div class="col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Statistik Keluarga per Sektor</h2>
                <p class="text-xs text-gray-400 font-medium mt-1">Persebaran jumlah keluarga di setiap wilayah sektor</p>
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

    <!-- Quick Links / Recent -->
    <div class="flex flex-col gap-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Aksi Cepat</h2>
            <div class="flex flex-col gap-3">
                <a href="{{ route('dashboard.jemaat.create') }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-50 hover:border-primary hover:bg-blue-50 transition-all group">
                    <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors">Tambah Jemaat</span>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
                </a>
                <a href="{{ route('dashboard.keluarga.create') }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-50 hover:border-indigo-500 hover:bg-indigo-50 transition-all group">
                    <span class="text-sm font-bold text-gray-700 group-hover:text-indigo-600 transition-colors">Tambah Keluarga</span>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
                </a>
            </div>
        </div>

        <div class="bg-primary rounded-2xl p-6 text-white shadow-xl shadow-primary/20">
            <h3 class="text-[10px] font-bold text-blue-200 uppercase tracking-widest mb-4">Aktivitas Terakhir</h3>
            <div class="flex flex-col gap-4">
                @forelse($recentActivities as $activity)
                <div class="flex gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-300 mt-1.5"></div>
                    <div>
                        <p class="text-xs font-bold leading-tight">{{ $activity['action'] }}</p>
                        <p class="text-[10px] text-blue-200/60 mt-1 uppercase">{{ $activity['time'] }}</p>
                    </div>
                </div>
                @empty
                <p class="text-xs text-blue-200/60 italic">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const labels = @json($sektorLabels);
    const chartData = @json($sektorData);

    if (labels.length > 0) {
        const ctx = document.getElementById('sectorChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Keluarga',
                    data: chartData,
                    backgroundColor: '#00236f',
                    borderRadius: 8,
                    barThickness: 32
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f0f0f0' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });
    }
</script>
@endpush
@endsection
