@extends('dashboard.layouts.app')
@section('title', $type . ' Artikel')

@section('content')
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $type }} Berita / Warta</h1>
        <p class="text-gray-400 text-sm font-medium mt-1">Publikasikan informasi terbaru untuk seluruh jemaat.</p>
    </div>
    <a href="{{ route('dashboard.berita.index') }}" class="flex items-center gap-2 text-gray-500 font-bold hover:text-primary transition-all text-sm uppercase tracking-wider">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12">
    <form action="#" method="POST" class="max-w-4xl flex flex-col gap-10">
        <x-form.input label="Judul Berita" name="judul" value="{{ $berita['judul'] ?? '' }}" placeholder="Masukkan judul yang menarik..." />

        <div class="grid grid-cols-2 gap-8">
            <x-form.select label="Kategori" name="kategori">
                <option value="Warta">Warta Jemaat</option>
                <option value="Berita">Berita Umum</option>
                <option value="Renungan">Renungan</option>
            </x-form.select>
            
            <x-form.select label="Status Publikasi" name="status">
                <option value="Draft">Draft (Belum Terbit)</option>
                <option value="Published" selected>Publish (Terbitkan Sekarang)</option>
            </x-form.select>
        </div>

        <div>
            <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Isi Berita / Artikel</label>
            <textarea name="isi" rows="12" placeholder="Tuliskan detail berita di sini..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner"></textarea>
        </div>

        <div>
            <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Gambar Sampul</label>
            <div class="border-2 border-dashed border-gray-100 rounded-2xl p-12 text-center bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer group">
                <svg class="w-10 h-10 text-gray-300 mx-auto mb-4 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm font-bold text-gray-400">Klik atau seret file gambar ke sini</p>
                <p class="text-[10px] text-gray-300 uppercase tracking-widest mt-2 font-bold">Maksimal 2MB (JPG/PNG)</p>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-50 flex gap-4">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                Publikasikan Sekarang
            </button>
            <a href="{{ route('dashboard.berita.index') }}" class="px-8 py-3.5 bg-gray-50 text-gray-500 rounded-xl font-bold hover:bg-gray-100 transition-all">
                Simpan Draft
            </a>
        </div>
    </form>
</div>
@endsection
