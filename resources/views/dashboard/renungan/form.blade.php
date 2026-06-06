@extends('dashboard.layouts.app')
@section('title', $type . ' Renungan')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Renungan Harian" 
    subtitle="Tuliskan pesan rohani dan kutipan ayat untuk pertumbuhan iman jemaat." 
    backUrl="{{ route('dashboard.renungan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-5xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.renungan.update', $renungan->id ?? 0) : route('dashboard.renungan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="flex flex-col gap-10">
            <div class="grid grid-cols-2 gap-8">
                <x-form.input label="Tanggal Renungan" name="tanggal" type="date" value="{{ old('tanggal', $renungan->tanggal ?? '') }}" />
                <x-form.input label="Ayat Renungan" name="ayat" placeholder="Contoh: Yohanes 3:16 atau Mazmur 23:1" value="{{ old('ayat', $renungan->ayat ?? '') }}" />
            </div>

            <div class="grid grid-cols-2 gap-8">
                <x-form.input label="Judul Renungan" name="judul" placeholder="Masukkan judul yang menginspirasi..." value="{{ old('judul', $renungan->judul ?? '') }}" />
                <x-form.input label="Penulis / Pendeta" name="penulis" placeholder="Contoh: Pdt. Hizkia, S.Th." value="{{ old('penulis', $renungan->penulis ?? '') }}" />
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Isi Renungan</label>
                <textarea name="isi" rows="15" placeholder="Tuliskan detail renungan di sini..." class="w-full px-6 py-5 rounded-2xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('isi', $renungan->isi ?? '') }}</textarea>
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Gambar Renungan</label>
                <input type="file" name="gambar" accept="image/png,image/jpeg,image/webp" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                <p class="mt-2 text-xs text-gray-400 font-medium">Hanya gambar JPG, PNG, atau WebP. Maksimal 5MB.</p>
                @if(isset($renungan) && $renungan->gambar)
                    <p class="mt-2 text-xs text-gray-500">Gambar saat ini: <a href="{{ asset('storage/' . $renungan->gambar) }}" target="_blank" class="text-primary underline">Lihat Gambar</a></p>
                @endif
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Renungan' : 'Ubah Renungan' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
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
        .then(editor => {
            editor.keystrokes.set('Tab', (data, cancel) => {
                editor.model.change(writer => {
                    const text = writer.createText('\u00a0\u00a0\u00a0\u00a0');
                    editor.model.insertContent(text);
                });
                cancel();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
@endpush
@endsection
