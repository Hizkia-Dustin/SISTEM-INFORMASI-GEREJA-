@extends('dashboard.layouts.app')
@section('title', $type . ' video')

@section('content')
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $type }} Video</h1>
        <p class="text-gray-400 text-sm font-medium mt-1">Publikasikan video terbaru untuk seluruh jemaat.</p>
    </div>
    <a href="{{ route('dashboard.video.index') }}" class="flex items-center gap-2 text-gray-500 font-bold hover:text-primary transition-all text-sm uppercase tracking-wider">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12">
    <form action="{{ $type == 'Edit' ? route('dashboard.video.update', $video->id) : route('dashboard.video.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl flex flex-col gap-10">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif

        <x-form.input label="Judul video" name="judul" value="{{ old('judul', $video->judul ?? '') }}" placeholder="Masukkan judul yang menarik..." />

        <div class="grid grid-cols-2 gap-8">
            <x-form.select label="Kategori" name="kategori">
                <option value="Video Umum" {{ old('kategori', $video->kategori ?? '') == 'Video Umum' ? 'selected' : '' }}>Video Umum</option>
                <option value="Kegiatan Gereja" {{ old('kategori', $video->kategori ?? '') == 'Kegiatan Gereja' ? 'selected' : '' }}>Kegiatan Gereja</option>
                <option value="Renungan" {{ old('kategori', $video->kategori ?? '') == 'Renungan' ? 'selected' : '' }}>Renungan</option>
            </x-form.select>
            
            <x-form.select label="Status Publikasi" name="status">
                <option value="Draft" {{ old('status', $video->status ?? '') == 'Draft' ? 'selected' : '' }}>Draft (Belum Terbit)</option>
                <option value="Published" {{ old('status', $video->status ?? 'Published') == 'Published' ? 'selected' : '' }}>Publish (Terbitkan Sekarang)</option>
            </x-form.select>
        </div>

        <div>
            <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Deskripsi Video</label>
            <textarea name="isi" rows="6" placeholder="Tuliskan deskripsi video di sini..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('isi', $video->isi ?? '') }}</textarea>
        </div>

        <div>
            <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">File Video (MP4)</label>
            <input type="file" name="gambar" accept="video/mp4,video/x-m4v,video/*" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
            @if(isset($video) && $video->gambar)
                <p class="mt-2 text-xs text-gray-500">Video saat ini: <a href="{{ asset('storage/' . $video->gambar) }}" target="_blank" class="text-primary underline">Lihat Video</a></p>
            @endif
        </div>

        <div class="pt-8 border-t border-gray-50 flex gap-4">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                {{ $type == 'Edit' ? 'Simpan Perubahan' : 'Publikasikan Sekarang' }}
            </button>
            <a href="{{ route('dashboard.video.index') }}" class="px-8 py-3.5 bg-gray-50 text-gray-500 rounded-xl font-bold hover:bg-gray-100 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('textarea[name="isi"]'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 250px;
    }
</style>
@endpush
@endsection
