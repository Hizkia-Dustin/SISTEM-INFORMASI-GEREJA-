@extends('dashboard.layouts.app')
@section('title', 'Detail Video')

@section('content')
<x-dashboard.page-header
    title="Detail Video Gereja"
    subtitle="Preview konten video sebelum dipublikasikan ke publik."
    backUrl="{{ route('dashboard.video.index') }}"
/>

@php
    $videoUrl = $video->gambar ? asset('storage/' . $video->gambar) : null;
    $videoExt = $videoUrl ? strtolower(pathinfo(parse_url($videoUrl, PHP_URL_PATH), PATHINFO_EXTENSION)) : null;
    $videoMime = $videoExt === 'mov' ? 'video/quicktime' : 'video/' . $videoExt;
@endphp

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-4xl">
    <div class="bg-slate-950 flex items-center justify-center overflow-hidden border-b border-gray-50">
        @if($videoUrl)
            <video controls playsinline preload="metadata" class="w-full max-h-[520px] bg-black">
                <source src="{{ $videoUrl }}" type="{{ $videoMime }}">
                Browser tidak mendukung pemutar video.
            </video>
        @else
            <div class="h-64 flex items-center justify-center">
                <span class="material-symbols-outlined text-gray-700 text-[72px]">videocam_off</span>
            </div>
        @endif
    </div>

    <div class="p-12">
        <div class="flex items-center gap-4 mb-6">
            <span class="px-3 py-1 bg-blue-50 text-primary text-[10px] font-extrabold rounded uppercase tracking-widest">{{ $video->kategori ?? 'Video' }}</span>
            <span class="text-xs text-gray-400 font-bold tracking-widest">{{ optional($video->created_at)->format('d F Y') }}</span>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-800 leading-tight mb-8">{{ $video->judul }}</h1>

        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed space-y-6 whitespace-pre-wrap">
            {!! $video->isi !!}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-50 flex items-center gap-4">
            <a href="{{ route('dashboard.video.edit', $video->id) }}" class="px-6 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah Video</a>
            @if($videoUrl)
                <a href="{{ $videoUrl }}" target="_blank" class="px-6 py-3 bg-gray-50 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">Buka File</a>
            @endif
            <form class="confirm-delete" action="{{ route('dashboard.video.destroy', $video->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus video ini?">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold hover:bg-rose-100 transition-all">Hapus Video</button>
            </form>
        </div>
    </div>
</div>
@endsection
