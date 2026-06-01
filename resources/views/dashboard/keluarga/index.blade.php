@extends('dashboard.layouts.app')
@section('title', 'Data Keluarga')

@section('content')
<x-dashboard.page-header title="Data Keluarga" subtitle="Manajemen data kepala keluarga dan anggota jemaat.">
    <a href="{{ route('dashboard.keluarga.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Data Keluarga
    </a>
</x-dashboard.page-header>

<!-- Tabs -->
<div class="flex items-center gap-8 mb-8 border-b border-gray-100">
    <a href="{{ route('dashboard.keluarga.index') }}" class="pb-4 px-2 text-sm font-bold {{ request('status') != 'tidak_aktif' ? 'text-primary border-b-2 border-primary' : 'text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all' }}">Keluarga Aktif</a>
    <a href="{{ route('dashboard.keluarga.index', ['status' => 'tidak_aktif']) }}" class="pb-4 px-2 text-sm font-bold {{ request('status') == 'tidak_aktif' ? 'text-primary border-b-2 border-primary' : 'text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all' }}">Keluarga Tidak Aktif</a>
</div>

<!-- Filters -->
<div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-8 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="relative w-72">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" placeholder="Cari nama keluarga..." class="w-full bg-gray-50 border-none rounded-xl py-2.5 pl-10 pr-4 text-xs font-medium focus:ring-2 focus:ring-primary/10 transition-all">
        </div>
        <select class="bg-gray-50 border-none rounded-xl py-2.5 px-4 text-xs font-bold text-gray-500">
            <option>Tampilkan 10</option>
            <option>Tampilkan 25</option>
            <option>Tampilkan 50</option>
        </select>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">No. KK</th>
                    <th class="px-8 py-4">Nama Keluarga</th>
                    <th class="px-8 py-4">Sektor</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($keluarga as $k)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 font-bold text-gray-700">#{{ $k->no_kk ?? '-' }}</td>
                    <td class="px-8 py-5">
                        <span class="font-bold text-gray-700 block text-base">{{ $k->nama_kepala_keluarga }}</span>
                        <span class="text-[11px] text-gray-400 font-medium">{{ $k->jemaat ? $k->jemaat->count() : 0 }} Anggota Keluarga</span>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-lg bg-gray-50 text-gray-600 text-[11px] font-bold">Sektor {{ $k->wilayah_pelayanan }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-2.5 py-1 rounded-lg {{ $k->status == 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }} text-[10px] font-extrabold uppercase">{{ $k->status ?? 'Tidak Diketahui' }}</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('dashboard.keluarga.show', $k->id) }}" class="px-4 py-2 bg-white border border-gray-100 rounded-lg text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-primary transition-all shadow-sm">Detail</a>
                            <a href="{{ route('dashboard.keluarga.edit', $k->id) }}" class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold shadow-lg shadow-primary/10 hover:bg-blue-700 transition-all">Ubah</a>
                            <form action="{{ route('dashboard.keluarga.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data keluarga.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
