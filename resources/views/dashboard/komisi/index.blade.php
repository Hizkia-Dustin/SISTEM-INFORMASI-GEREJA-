@extends('dashboard.layouts.app')
@section('title', 'Data Komisi')

@section('content')
<x-dashboard.page-header title="Komisi & Bagian" subtitle="Struktur organisasi pelayanan fungsional dan kategorial.">
    <a href="{{ route('dashboard.komisi.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Komisi
    </a>
</x-dashboard.page-header>

<!-- Komisi Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Nama Komisi</th>
                    <th class="px-8 py-4">Kategori</th>
                    <th class="px-8 py-4">Keterangan</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($komisi as $k)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 font-bold text-gray-700">{{ $k['nama'] }}</td>
                    <td class="px-8 py-5">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 text-primary text-[10px] font-extrabold uppercase">{{ $k['kategori'] }}</span>
                    </td>
                    <td class="px-8 py-5 text-gray-500 font-medium italic">Tugas dan fungsi komisi {{ strtolower($k['nama']) }}...</td>
                    <td class="px-8 py-5">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('dashboard.komisi.edit', 1) }}" class="text-primary font-bold text-xs hover:underline">Ubah</a>
                            <form action="{{ route('dashboard.komisi.destroy', 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komisi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 font-bold text-xs hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada komisi terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
