@extends('dashboard.layouts.app')
@section('title', 'Detail informasi')

@section('content')
<x-dashboard.page-header 
    title="Detail informasi Gereja" 
    subtitle="Preview konten informasi sebelum dipublikasikan ke publik." 
    backUrl="{{ route('dashboard.informasi.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-4xl">
    <div class="h-64 bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-50">
        @if($informasi->gambar)
            <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="w-full h-full object-cover">
        @else
            <svg class="w-20 h-20 text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        @endif
    </div>

    <div class="p-12">
        <div class="flex items-center gap-4 mb-6">
            <span class="px-3 py-1 bg-blue-50 text-primary text-[10px] font-extrabold rounded uppercase tracking-widest">{{ $informasi->kategori }}</span>
            <span class="text-xs text-gray-400 font-bold tracking-widest">{{ $informasi->created_at->format('d F Y') }}</span>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-800 leading-tight mb-8">{{ $informasi->judul }}</h1>

        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed space-y-6 whitespace-pre-wrap">
            {{ $informasi->isi }}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-50 flex items-center gap-4">
            <a href="{{ route('dashboard.informasi.edit', $informasi->id) }}" class="px-6 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah informasi</a>
            <form class="confirm-delete" action="{{ route('dashboard.informasi.destroy', $informasi->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus informasi ini?">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold hover:bg-rose-100 transition-all">Hapus informasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
