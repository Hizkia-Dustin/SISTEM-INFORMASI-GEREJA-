@extends('dashboard.layouts.app')
@section('title', 'Berita Gereja')

@section('content')
<x-dashboard.page-header title="Daftar Berita Gereja" subtitle="Informasi kegiatan dan berita terbaru seputar GKI Pakuwon." />

<!-- Berita Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Judul Berita</th>
                    <th class="px-8 py-4">Gambar</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($berita as $b)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 text-gray-400 font-bold tracking-widest">{{ optional($b->created_at)->format('d M Y') ?? '-' }}</td>
                    <td class="px-8 py-5">
                        <a href="{{ route('dashboard.berita.show', $b->id) }}" class="font-bold text-gray-700 block text-base hover:text-primary transition-colors">{{ $b->judul }}</a>
                        <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">{{ $b->kategori ?? 'Berita' }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="w-16 h-10 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center overflow-hidden">
                            @if(!empty($b->gambar))
                                <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-4 h-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('dashboard.berita.show', $b->id) }}" class="px-4 py-2 bg-white border border-gray-100 rounded-lg text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-primary transition-all shadow-sm">Detail</a>
                            <a href="{{ route('dashboard.berita.edit', $b->id) }}" class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold shadow-lg shadow-primary/10 hover:bg-blue-700 transition-all">Ubah</a>
                            <form class="confirm-delete" action="{{ route('dashboard.berita.destroy', $b->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus berita ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada berita terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
