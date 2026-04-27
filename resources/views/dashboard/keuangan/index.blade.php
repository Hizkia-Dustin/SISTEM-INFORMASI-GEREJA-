@extends('dashboard.layouts.app')
@section('title', 'Keuangan')

@section('content')
<x-dashboard.page-header title="Manajemen Keuangan" subtitle="Catatan arus kas persembahan dan pengeluaran gereja.">
    <a href="{{ route('dashboard.keuangan.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Data Keuangan
    </a>
</x-dashboard.page-header>

<!-- Financial Tabs -->
<div x-data="{ 
    activeTab: 'ibadah',
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
                <h3 class="text-xl font-extrabold text-emerald-700">Rp 12.450.000</h3>
            </div>
            <div class="bg-rose-50 p-6 rounded-2xl border border-rose-100">
                <p class="text-rose-600 text-[10px] font-bold uppercase tracking-widest mb-1">Biaya Operasional</p>
                <h3 class="text-xl font-extrabold text-rose-700">Rp 4.200.000</h3>
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
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">12 Mei 2024</td><td class="px-8 py-4 font-bold text-emerald-600">+ 3.200.000</td><td class="px-8 py-4 text-gray-500">Kolekte Ibadah Minggu Pagi</td><td class="px-8 py-4 text-right"><button class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button></td></tr>
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
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">1</td><td class="px-8 py-4">08/05/2024</td><td class="px-8 py-4 font-bold text-emerald-600">200.001</td><td class="px-8 py-4 text-gray-500">Partangiangan Sektor</td><td class="px-8 py-4 text-right"><a href="{{ route('dashboard.keuangan.edit', 1) }}?type=diakoni" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">2</td><td class="px-8 py-4">07/05/2024</td><td class="px-8 py-4 font-bold text-emerald-600">200.001</td><td class="px-8 py-4 text-gray-500">Sekolah Minggu</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">3</td><td class="px-8 py-4">07/05/2024</td><td class="px-8 py-4 font-bold text-emerald-600">200.001</td><td class="px-8 py-4 text-gray-500">Sekolah Minggu</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                </tbody>
            </table>
        </div>

        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4">Keterangan</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">25/05/2024</td><td class="px-8 py-4 font-bold text-rose-600">500.000</td><td class="px-8 py-4 text-gray-500">Sekolah Minggu</td><td class="px-8 py-4 text-right"><a href="{{ route('dashboard.keuangan.edit', 1) }}?type=diakoni" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">26/05/2024</td><td class="px-8 py-4 font-bold text-rose-600">80.000</td><td class="px-8 py-4 text-gray-500">Paskah</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
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
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Kategori</th><th class="px-8 py-4">Nama Keluarga</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">08/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">Ama. Yusuf Sihombing / Br. Munthe</td><td class="px-8 py-4 font-bold text-emerald-600">10.000</td><td class="px-8 py-4 text-right"><a href="{{ route('dashboard.keuangan.edit', 1) }}?type=khusus" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">07/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">GUSTAF LUMBANTOBING (+) / BR. HUTAPEA</td><td class="px-8 py-4 font-bold text-emerald-600">59.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">26/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">Ama. Irwan Hutagalung / Br. Tampubolon</td><td class="px-8 py-4 font-bold text-emerald-600">8.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">06/05/2024</td><td class="px-8 py-4">Persembahan Bulanan</td><td class="px-8 py-4">Ama. Gemende Siboro / Br. Samosir</td><td class="px-8 py-4 font-bold text-emerald-600">120.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">25/05/2024</td><td class="px-8 py-4">Persembahan Bulanan</td><td class="px-8 py-4">Ama. Yosef Pakpahan / Br. Sijabat</td><td class="px-8 py-4 font-bold text-emerald-600">1.000.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                </tbody>
            </table>
        </div>

        <div x-show="activeSubTab === 'pengeluaran'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-4">Tanggal</th><th class="px-8 py-4">Kategori</th><th class="px-8 py-4">Nama Keluarga</th><th class="px-8 py-4">Nominal (Rp)</th><th class="px-8 py-4 text-right">Aksi</th></tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">08/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">Ama. Yusuf Sihombing / Br. Munthe</td><td class="px-8 py-4 font-bold text-rose-600">1.000.000</td><td class="px-8 py-4 text-right"><a href="{{ route('dashboard.keuangan.edit', 1) }}?type=khusus" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">07/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">GUSTAF LUMBANTOBING (+) / BR. HUTAPEA</td><td class="px-8 py-4 font-bold text-rose-600">900.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">26/05/2024</td><td class="px-8 py-4">Ucapan Syukur</td><td class="px-8 py-4">Ama. Irwan Hutagalung / Br. Tampubolon</td><td class="px-8 py-4 font-bold text-rose-600">800.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">06/05/2024</td><td class="px-8 py-4">Persembahan Bulanan</td><td class="px-8 py-4">Ama. Gemende Siboro / Br. Samosir</td><td class="px-8 py-4 font-bold text-rose-600">200.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                    <tr class="border-b border-gray-50"><td class="px-8 py-4">25/05/2024</td><td class="px-8 py-4">Persembahan Bulanan</td><td class="px-8 py-4">Ama. Yosef Pakpahan / Br. Sijabat</td><td class="px-8 py-4 font-bold text-rose-600">150.000</td><td class="px-8 py-4 text-right"><a href="#" class="text-gray-400 hover:text-primary"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
