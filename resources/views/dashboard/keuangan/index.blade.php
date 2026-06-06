@extends('dashboard.layouts.app')
@section('title', 'Keuangan')

@section('content')
@php
    $ibadah = $keuangan->where('kategori', 'Persembahan Ibadah');
    $pemasukanIbadah = $ibadah->where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
    $pengeluaranIbadah = $ibadah->where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');

    $diakoni = $keuangan->where('kategori', 'Diakoni Sosial');
    $diakoniPemasukan = $diakoni->where('jenis_transaksi', 'Pemasukan');
    $diakoniPengeluaran = $diakoni->where('jenis_transaksi', 'Pengeluaran');

    $khusus = $keuangan->where('kategori', 'Persembahan Khusus');
    $khususPemasukan = $khusus->where('jenis_transaksi', 'Pemasukan');
    $khususPengeluaran = $khusus->where('jenis_transaksi', 'Pengeluaran');

    $pembangunan = $keuangan->where('kategori', 'Pembangunan');
    $pembangunanPemasukan = $pembangunan->where('jenis_transaksi', 'Pemasukan');
    $pembangunanPengeluaran = $pembangunan->where('jenis_transaksi', 'Pengeluaran');

    $operasional = $keuangan->where('kategori', 'Operasional');
    $operasionalPemasukan = $operasional->where('jenis_transaksi', 'Pemasukan');
    $operasionalPengeluaran = $operasional->where('jenis_transaksi', 'Pengeluaran');
@endphp
<x-dashboard.page-header title="Manajemen Keuangan" subtitle="Catatan arus kas persembahan dan pengeluaran gereja.">
    <a href="{{ route('dashboard.keuangan.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Data Keuangan
    </a>
</x-dashboard.page-header>

<!-- Financial Tabs -->
<div x-data="{ 
    activeTab: '{{ request()->query('tab', 'ibadah') }}',
    activeSubTab: 'pemasukan'
}">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-100/80 pb-4">
        <!-- Segmented Tab Control -->
        <div class="bg-gray-100/80 p-1 rounded-2xl flex flex-wrap gap-1 shadow-inner border border-gray-200/20">
            <button 
                @click="activeTab = 'ibadah'"
                :class="activeTab === 'ibadah' ? 'bg-white text-primary shadow-md shadow-gray-200/50 scale-[1.02]' : 'text-gray-500 hover:text-gray-800 hover:bg-white/40'"
                class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200">
                Persembahan Ibadah
            </button>
            <button 
                @click="activeTab = 'diakoni'"
                :class="activeTab === 'diakoni' ? 'bg-white text-primary shadow-md shadow-gray-200/50 scale-[1.02]' : 'text-gray-500 hover:text-gray-800 hover:bg-white/40'"
                class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200">
                Diakoni Sosial
            </button>
            <button 
                @click="activeTab = 'khusus'"
                :class="activeTab === 'khusus' ? 'bg-white text-primary shadow-md shadow-gray-200/50 scale-[1.02]' : 'text-gray-500 hover:text-gray-800 hover:bg-white/40'"
                class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200">
                Persembahan Khusus
            </button>
            <button 
                @click="activeTab = 'pembangunan'"
                :class="activeTab === 'pembangunan' ? 'bg-white text-primary shadow-md shadow-gray-200/50 scale-[1.02]' : 'text-gray-500 hover:text-gray-800 hover:bg-white/40'"
                class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200">
                Pembangunan
            </button>
            <button 
                @click="activeTab = 'operasional'"
                :class="activeTab === 'operasional' ? 'bg-white text-primary shadow-md shadow-gray-200/50 scale-[1.02]' : 'text-gray-500 hover:text-gray-800 hover:bg-white/40'"
                class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200">
                Operasional
            </button>
        </div>

        <!-- Filter/Search Mockup (Only for Diakoni, Khusus, Pembangunan, Operasional) -->
        <div class="flex items-center gap-3" x-show="activeTab !== 'ibadah'">
            <div class="relative">
                <input type="text" placeholder="Cari data..." class="pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-medium focus:ring-4 focus:ring-primary/5 focus:border-primary w-60 transition-all shadow-inner">
                <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <select class="bg-gray-50 border border-gray-100 rounded-xl py-2.5 px-4 text-xs font-bold text-gray-600 focus:ring-4 focus:ring-primary/5 focus:border-primary transition-all">
                <option>Tampilkan 10</option>
                <option>Tampilkan 50</option>
            </select>
        </div>
    </div>

    <!-- Tab Content: Persembahan Ibadah -->
    <div x-show="activeTab === 'ibadah'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Pemasukan Card -->
            <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/[0.02] p-6 rounded-3xl border border-emerald-100 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[120px]">
                <div>
                    <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-wider mb-1">Pemasukan Ibadah</p>
                    <h3 class="text-2xl font-extrabold text-emerald-800 tracking-tight">Rp {{ number_format($pemasukanIbadah, 0, ',', '.') }}</h3>
                </div>
                <div class="absolute right-4 bottom-4 w-10 h-10 bg-emerald-500/10 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                </div>
            </div>
            <!-- Pengeluaran Card -->
            <div class="bg-gradient-to-br from-rose-500/10 to-rose-500/[0.02] p-6 rounded-3xl border border-rose-100 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[120px]">
                <div>
                    <p class="text-rose-600 text-[10px] font-bold uppercase tracking-wider mb-1">Biaya Operasional</p>
                    <h3 class="text-2xl font-extrabold text-rose-800 tracking-tight">Rp {{ number_format($pengeluaranIbadah, 0, ',', '.') }}</h3>
                </div>
                <div class="absolute right-4 bottom-4 w-10 h-10 bg-rose-500/10 text-rose-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/20">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Catatan Kas Ibadah</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($ibadah as $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 font-bold {{ $k->jenis_transaksi == 'Pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $k->jenis_transaksi == 'Pemasukan' ? '+' : '-' }} {{ number_format($k->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data warta keuangan ibadah.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Content: Diakoni Sosial -->
    <div x-show="activeTab === 'diakoni'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <!-- Sub Tabs -->
        <div class="flex items-center gap-1.5 bg-gray-100/80 p-1 rounded-xl w-fit mb-6 border border-gray-200/10">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Pemasukan
            </button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-white text-rose-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                Pengeluaran
            </button>
        </div>

        <!-- Pemasukan Table -->
        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">No</th>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($diakoniPemasukan as $index => $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-semibold text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pemasukan diakoni sosial.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengeluaran Table -->
        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($diakoniPengeluaran as $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pengeluaran diakoni sosial.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Content: Persembahan Khusus -->
    <div x-show="activeTab === 'khusus'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <!-- Sub Tabs -->
        <div class="flex items-center gap-1.5 bg-gray-100/80 p-1 rounded-xl w-fit mb-6 border border-gray-200/10">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Pemasukan
            </button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-white text-rose-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                Pengeluaran
            </button>
        </div>

        <!-- Pemasukan Table -->
        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">No</th>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($khususPemasukan as $index => $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-semibold text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pemasukan persembahan khusus.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengeluaran Table -->
        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($khususPengeluaran as $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pengeluaran persembahan khusus.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Content: Pembangunan -->
    <div x-show="activeTab === 'pembangunan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <!-- Sub Tabs -->
        <div class="flex items-center gap-1.5 bg-gray-100/80 p-1 rounded-xl w-fit mb-6 border border-gray-200/10">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Pemasukan
            </button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-white text-rose-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                Pengeluaran
            </button>
        </div>

        <!-- Pemasukan Table -->
        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">No</th>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($pembangunanPemasukan as $index => $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-semibold text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pemasukan pembangunan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengeluaran Table -->
        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($pembangunanPengeluaran as $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pengeluaran pembangunan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab Content: Operasional -->
    <div x-show="activeTab === 'operasional'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <!-- Sub Tabs -->
        <div class="flex items-center gap-1.5 bg-gray-100/80 p-1 rounded-xl w-fit mb-6 border border-gray-200/10">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Pemasukan
            </button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-white text-rose-600 shadow-sm' : 'text-gray-500 hover:text-gray-900'" class="px-5 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                Pengeluaran
            </button>
        </div>

        <!-- Pemasukan Table -->
        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">No</th>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($operasionalPemasukan as $index => $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-semibold text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pemasukan operasional.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengeluaran Table -->
        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden" x-transition>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Keterangan</th>
                            <th class="px-8 py-5">Nominal (Rp)</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-gray-700">
                        @forelse($operasionalPengeluaran as $k)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $k->keterangan }}</td>
                            <td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="inline-flex p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-xl transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keuangan ini?')" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pengeluaran operasional.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
