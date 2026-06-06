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
@endphp
<x-dashboard.page-header title="Manajemen Keuangan" subtitle="Catatan arus kas persembahan dan pengeluaran gereja.">
    <a href="{{ route('dashboard.keuangan.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Data Keuangan
    </a>
</x-dashboard.page-header>

<!-- Financial Tabs -->
<div x-data="{ 
    activeTab: '{{ request('kategori') ? (request('kategori') == 'diakoni' ? 'diakoni' : 'khusus') : 'ibadah' }}',
    activeSubTab: 'pemasukan'
}">
    <div class="flex items-center justify-between mb-8 border-b border-gray-100">
        <div class="flex items-center gap-8">
            <button 
                @click="activeTab = 'ibadah'"
                :class="activeTab === 'ibadah' ? 'text-primary border-primary' : 'text-gray-400 border-transparent'"
                class="pb-4 px-2 text-sm font-bold border-b-2 transition-all">
                Persembahan Ibadah
            </button>
            <button 
                @click="activeTab = 'diakoni'"
                :class="activeTab === 'diakoni' ? 'text-primary border-primary' : 'text-gray-400 border-transparent'"
                class="pb-4 px-2 text-sm font-bold border-b-2 transition-all">
                Diakoni Sosial
            </button>
            <button 
                @click="activeTab = 'khusus'"
                :class="activeTab === 'khusus' ? 'text-primary border-primary' : 'text-gray-400 border-transparent'"
                class="pb-4 px-2 text-sm font-bold border-b-2 transition-all">
                Persembahan Khusus
            </button>
        </div>

        <!-- Filter/Search Mockup (Only for Diakoni & Khusus) -->
        <div class="flex items-center gap-3 pb-4" x-show="activeTab !== 'ibadah'">
            <div class="relative">
                <input type="text" placeholder="Cari data..." class="pl-9 pr-4 py-2 bg-gray-50 border-none rounded-xl text-xs font-medium focus:ring-2 focus:ring-primary/10 w-64 transition-all">
                <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <select class="bg-gray-50 border-none rounded-xl py-2 px-4 text-xs font-bold text-gray-500 focus:ring-2 focus:ring-primary/10">
                <option>Tampilkan 10</option>
                <option>Tampilkan 50</option>
            </select>
        </div>
    </div>

    <!-- Tab Content: Persembahan Ibadah -->
    <div x-show="activeTab === 'ibadah'" x-transition>
        <div class="grid grid-cols-4 gap-6 mb-10">
            <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-widest mb-1">Pemasukan Ibadah</p>
                <h3 class="text-xl font-extrabold text-emerald-700">Rp {{ number_format($pemasukanIbadah, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-rose-50 p-6 rounded-2xl border border-rose-100">
                <p class="text-rose-600 text-[10px] font-bold uppercase tracking-widest mb-1">Biaya Operasional</p>
                <h3 class="text-xl font-extrabold text-rose-700">Rp {{ number_format($pengeluaranIbadah, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Catatan Kas Ibadah</h3>
            </div>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($ibadah as $k)
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td><td class="px-8 py-4 font-bold {{ $k->jenis_transaksi == 'Pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">{{ $k->jenis_transaksi == 'Pemasukan' ? '+' : '-' }} {{ number_format($k->jumlah, 0, ',', '.') }}</td><td class="px-8 py-4 text-gray-500">{{ $k->keterangan }}</td><td class="px-8 py-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </a>
        <form class="confirm-delete" action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </form>
    </div>
</td></tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-4 text-center text-gray-400">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab Content: Diakoni Sosial -->
    <div x-show="activeTab === 'diakoni'" x-transition>
        <div class="flex items-center gap-4 mb-6">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-primary text-white' : 'bg-gray-50 text-gray-500'" class="px-6 py-2 rounded-xl text-xs font-bold transition-all">Pemasukan</button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-primary text-white' : 'bg-gray-50 text-gray-500'" class="px-6 py-2 rounded-xl text-xs font-bold transition-all">Pengeluaran</button>
        </div>

        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">No</th><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($diakoniPemasukan as $index => $k)
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">{{ $loop->iteration }}</td><td class="px-8 py-4">{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td><td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td><td class="px-8 py-4 text-gray-500">{{ $k->keterangan }}</td><td class="px-8 py-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </a>
        <form class="confirm-delete" action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </form>
    </div>
</td></tr>
                    @empty
                    <tr><td colspan="5" class="px-8 py-4 text-center text-gray-400">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($diakoniPengeluaran as $k)
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td><td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td><td class="px-8 py-4 text-gray-500">{{ $k->keterangan }}</td><td class="px-8 py-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </a>
        <form class="confirm-delete" action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </form>
    </div>
</td></tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-4 text-center text-gray-400">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab Content: Persembahan Khusus -->
    <div x-show="activeTab === 'khusus'" x-transition>
        <div class="flex items-center gap-4 mb-6">
            <button @click="activeSubTab = 'pemasukan'" :class="activeSubTab === 'pemasukan' ? 'bg-primary text-white' : 'bg-gray-50 text-gray-500'" class="px-6 py-2 rounded-xl text-xs font-bold transition-all">Pemasukan</button>
            <button @click="activeSubTab = 'pengeluaran'" :class="activeSubTab === 'pengeluaran' ? 'bg-primary text-white' : 'bg-gray-50 text-gray-500'" class="px-6 py-2 rounded-xl text-xs font-bold transition-all">Pengeluaran</button>
        </div>

        <div x-show="activeSubTab === 'pemasukan'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">No</th><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($khususPemasukan as $index => $k)
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">{{ $loop->iteration }}</td><td class="px-8 py-4">{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td><td class="px-8 py-4">{{ $k->keterangan }}</td><td class="px-8 py-4 font-bold text-emerald-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td><td class="px-8 py-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </a>
        <form class="confirm-delete" action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </form>
    </div>
</td></tr>
                    @empty
                    <tr><td colspan="5" class="px-8 py-4 text-center text-gray-400">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($khususPengeluaran as $k)
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td><td class="px-8 py-4">{{ $k->keterangan }}</td><td class="px-8 py-4 font-bold text-rose-600">{{ number_format($k->jumlah, 0, ',', '.') }}</td><td class="px-8 py-4 text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('dashboard.keuangan.edit', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </a>
        <form class="confirm-delete" action="{{ route('dashboard.keuangan.destroy', $k->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </form>
    </div>
</td></tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-4 text-center text-gray-400">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
