@extends('dashboard.layouts.app')
@section('title', 'Renungan Harian')

@section('content')
<x-dashboard.page-header title="Daftar Renungan Harian" subtitle="Kelola renungan harian dan kutipan ayat untuk jemaat.">
    <a href="{{ route('dashboard.renungan.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Renungan
    </a>
</x-dashboard.page-header>

<!-- Renungan Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Judul Renungan</th>
                    <th class="px-8 py-4">Ayat</th>
                    <th class="px-8 py-4">Penulis</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($renungan ?? [] as $r)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-4 text-gray-600">{{ $r->tanggal ? \Carbon\Carbon::parse($r->tanggal)->format('d M Y') : '-' }}</td>
                    <td class="px-8 py-4 font-bold text-gray-800">{{ $r->judul }}</td>
                    <td class="px-8 py-4 text-gray-600">{{ $r->ayat ?? '-' }}</td>
                    <td class="px-8 py-4 text-gray-600">{{ $r->penulis ?? '-' }}</td>
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.renungan.edit', $r->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('dashboard.renungan.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data renungan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
