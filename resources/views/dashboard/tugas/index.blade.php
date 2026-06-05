@extends('dashboard.layouts.app')
@section('title', 'Jadwal Pelayanan')

@section('content')
<x-dashboard.page-header title="Jadwal Pelayanan" subtitle="Daftar jadwal tugas pelayanan untuk setiap jemaat GKI Pakuwon.">
    <a href="{{ route('dashboard.tugas.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Jadwal Pelayanan
    </a>
</x-dashboard.page-header>

<!-- Filters -->
<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-10 flex items-end gap-6">
    <div class="flex-1 grid grid-cols-2 gap-6">
        <div>
            <label class="block mb-3 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Pilih Nama Pelayan</label>
            <select class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-xs font-bold text-gray-600 focus:ring-2 focus:ring-primary/10 transition-all">
                <option>Semua Pelayan</option>
                <option>Pnt. Budi Santoso</option>
            </select>
        </div>
        <div>
            <label class="block mb-3 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Tahun</label>
            <select class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-xs font-bold text-gray-600 focus:ring-2 focus:ring-primary/10 transition-all">
                <option>2026</option>
                <option>2025</option>
            </select>
        </div>
    </div>
    <button class="px-8 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
        Cari Jadwal
    </button>
</div>

<!-- Stats Info -->
<div class="mb-8 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <span class="text-sm font-bold text-gray-700">Jumlah Pelayanan:</span>
        <span class="px-3 py-1 bg-blue-50 text-primary rounded-lg font-extrabold text-sm">{{ ($tugas ?? collect())->count() }} Tugas</span>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Nama Ibadah</th>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4 text-center">Status Pelayanan</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($tugas ?? [] as $index => $item)
                <tr class="border-t border-gray-50">
                    <td class="px-8 py-5 text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-8 py-5 font-bold text-gray-800">{{ $item->judul }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') : '-' }}</td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.tugas.edit', $item->id) }}" class="px-3 py-2 rounded-lg bg-blue-50 text-primary text-xs font-bold">Edit</a>
                            <form action="{{ route('dashboard.tugas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal pelayanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-gray-400 italic">Belum ada jadwal pelayanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
