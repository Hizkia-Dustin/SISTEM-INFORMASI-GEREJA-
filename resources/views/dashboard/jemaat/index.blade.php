@extends('dashboard.layouts.app')
@section('title', 'Data Jemaat')

@section('content')
<x-dashboard.page-header title="Data Jemaat" subtitle="Manajemen data pribadi dan status pelayanan jemaat.">
    <a href="{{ route('dashboard.jemaat.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Data Jemaat
    </a>
</x-dashboard.page-header>

<!-- Tabs -->
<div class="flex items-center gap-8 mb-8 border-b border-gray-100">
    <button class="pb-4 px-2 text-sm font-bold text-primary border-b-2 border-primary">Jemaat Aktif</button>
    <button class="pb-4 px-2 text-sm font-bold text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all">Jemaat Tidak Aktif</button>
</div>

<!-- Filters -->
<div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-8 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="relative w-72">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" placeholder="Cari NIK atau nama..." class="w-full bg-gray-50 border-none rounded-xl py-2.5 pl-10 pr-4 text-xs font-medium focus:ring-2 focus:ring-primary/10 transition-all">
        </div>
        <select class="bg-gray-50 border-none rounded-xl py-2.5 px-4 text-xs font-bold text-gray-500">
            <option>Tampilkan 10</option>
            <option>Tampilkan 25</option>
        </select>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">NIK</th>
                    <th class="px-8 py-4">Nama Lengkap</th>
                    <th class="px-8 py-4">Alamat</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($jemaat as $j)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 font-bold text-gray-400 tracking-wider">#{{ rand(3273010101010001, 3273010101019999) }}</td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 bg-blue-50 text-primary rounded-lg flex items-center justify-center font-bold text-xs">
                                {{ substr($j['nama'], 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-700">{{ $j['nama'] }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-gray-500 font-medium max-w-xs truncate">Jl. Pakuwon Indah No. {{ rand(1, 100) }}, Bandung</td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('dashboard.jemaat.show', 1) }}" class="px-3 py-1.5 bg-white border border-gray-100 rounded-lg text-xs font-bold text-gray-500 hover:text-primary transition-all">Detail</a>
                            <a href="{{ route('dashboard.jemaat.edit', 1) }}" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-bold shadow-sm hover:bg-blue-700 transition-all">Ubah</a>
                            <form action="{{ route('dashboard.jemaat.destroy', 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data jemaat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
