@extends('dashboard.layouts.app')
@section('title', $type . ' Program Kerja')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Program Kerja / RAPB" 
    subtitle="Unggah dokumen rancangan program kerja atau anggaran tahunan." 
    backUrl="{{ route('dashboard.program_kerja.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-2xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.program_kerja.update', $program_kerja->id ?? 0) : route('dashboard.program_kerja.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="flex flex-col gap-8">
            <x-form.select label="Jenis Dokumen" name="jenis">
                <option value="Rancangan Program Kerja" {{ old('jenis', $program_kerja->jenis ?? '') == 'Rancangan Program Kerja' ? 'selected' : '' }}>Rancangan Program Kerja</option>
                <option value="RAPB" {{ old('jenis', $program_kerja->jenis ?? '') == 'RAPB' ? 'selected' : '' }}>Rancangan Anggaran Penerimaan dan Belanja (RAPB)</option>
            </x-form.select>

            <x-form.select label="Tahun Program" name="tahun">
                @for($i=date('Y')+1; $i>=2024; $i--)
                    <option value="{{ $i }}" {{ old('tahun', $program_kerja->tahun ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </x-form.select>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Unggah Lampiran (PDF)</label>
                <input type="file" name="lampiran" accept=".pdf" class="w-full cursor-pointer px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                @if(isset($program_kerja) && $program_kerja->lampiran)
                    <p class="mt-2 text-xs text-gray-500">File saat ini: <a href="{{ asset('storage/' . $program_kerja->lampiran) }}" target="_blank" class="text-primary underline">Lihat PDF</a></p>
                @endif
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Program' : 'Ubah Program' }}
                </button>
                <a href="{{ route('dashboard.program_kerja.index') }}" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
