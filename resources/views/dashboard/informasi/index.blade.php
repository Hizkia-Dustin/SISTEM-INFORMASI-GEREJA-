@extends('dashboard.layouts.app')
@section('title', 'informasi Gereja')

@section('content')
<x-dashboard.page-header title="Daftar informasi Gereja" subtitle="Informasi kegiatan dan informasi terbaru seputar GKI Pakuwon.">
    <a href="{{ route('dashboard.informasi.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah informasi Gereja
    </a>
</x-dashboard.page-header>

<!-- informasi Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Judul informasi</th>
                    <th class="px-8 py-4">Gambar</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($informasi as $b)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 text-gray-400 font-bold tracking-widest">{{ $b['tanggal'] ?? '27 Apr 2026' }}</td>
                    <td class="px-8 py-5">
                        <a href="{{ route('dashboard.informasi.show', 1) }}" class="font-bold text-gray-700 block text-base hover:text-primary transition-colors">{{ $b['judul'] }}</a>
                        <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">{{ $b['kategori'] }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="w-16 h-10 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center overflow-hidden">
                            <svg class="w-4 h-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard.informasi.show', 1) }}" class="px-3 py-1.5 bg-white border border-gray-100 rounded-lg text-xs font-bold text-gray-500 hover:text-primary transition-all">Detail</a>
                            <a href="{{ route('dashboard.informasi.edit', 1) }}" class="text-primary font-bold text-xs hover:underline">Ubah</a>
                            <form action="{{ route('dashboard.informasi.destroy', 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 font-bold text-xs hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada informasi terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
