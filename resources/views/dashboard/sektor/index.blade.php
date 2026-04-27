@extends('dashboard.layouts.app')
@section('title', 'Data Sektor')

@section('content')
<x-dashboard.page-header title="Sektor & Wilayah" subtitle="Pembagian wilayah pelayanan jemaat GKI Pakuwon.">
    <a href="{{ route('dashboard.sektor.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Sektor
    </a>
</x-dashboard.page-header>

<!-- Tabs -->
<div class="flex items-center gap-8 mb-8 border-b border-gray-100">
    <button class="pb-4 px-2 text-sm font-bold text-primary border-b-2 border-primary">Anggota Sektor</button>
    <button class="pb-4 px-2 text-sm font-bold text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all">Data Master Sektor</button>
</div>

<!-- Sektor Selector -->
<div class="mb-10">
    <label class="block mb-3 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Pilih Sektor</label>
    <select class="w-64 bg-white border border-gray-100 rounded-xl py-2.5 px-4 text-xs font-bold text-gray-600 focus:ring-2 focus:ring-primary/10 transition-all shadow-sm">
        <option>Belum ada sektor</option>
    </select>
</div>

<!-- Penatua Table (Screen 1) -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="px-8 py-5 border-b border-gray-50 bg-blue-50/30 flex items-center justify-between">
        <h3 class="text-sm font-bold text-primary uppercase tracking-widest">Daftar Penatua Sektor</h3>
        <span class="text-[10px] font-bold text-primary bg-white px-3 py-1 rounded-full uppercase border border-blue-100 shadow-sm">Koordinator</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Nama Penatua</th>
                    <th class="px-8 py-4">Alamat</th>
                    <th class="px-8 py-4">Nomor Telepon</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data penatua sektor.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Anggota Table (Screen 1 lower) -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Daftar Anggota Jemaat</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Alamat</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr>
                    <td colspan="3" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data anggota jemaat di sektor ini.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
