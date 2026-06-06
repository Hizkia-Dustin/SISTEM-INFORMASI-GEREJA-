@extends('dashboard.layouts.app')
@section('title', 'video Gereja')

@section('content')
<x-dashboard.page-header title="Daftar video Gereja" subtitle="Informasi kegiatan dan video terbaru seputar GKI Pakuwon.">
    <a href="{{ route('dashboard.video.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah video Gereja
    </a>
</x-dashboard.page-header>

<!-- video Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Judul video</th>
                    <th class="px-8 py-4">Video</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($video as $b)
                <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                    <td class="px-8 py-5 text-gray-400 font-bold tracking-widest">{{ optional($b->created_at)->format('d M Y') ?? '-' }}</td>
                    <td class="px-8 py-5">
                        <a href="{{ route('dashboard.video.show', $b->id) }}" class="font-bold text-gray-700 block text-base hover:text-primary transition-colors">{{ $b->judul }}</a>
                        <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">{{ $b->kategori ?? 'Video' }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="w-16 h-10 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center overflow-hidden">
                            @if($b->gambar)
                                <span class="material-symbols-outlined text-primary text-[22px]">play_circle</span>
                            @else
                                <span class="material-symbols-outlined text-gray-200 text-[22px]">videocam_off</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard.video.show', $b->id) }}" class="px-4 py-2 bg-white border border-gray-100 rounded-lg text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-primary transition-all shadow-sm">Detail</a>
                            <a href="{{ route('dashboard.video.edit', $b->id) }}" class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold shadow-lg shadow-primary/10 hover:bg-blue-700 transition-all">Ubah</a>
                            <form action="{{ route('dashboard.video.destroy', $b->id) }}" method="POST" class="confirm-delete" data-confirm="Apakah Anda yakin ingin menghapus video ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada video terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
