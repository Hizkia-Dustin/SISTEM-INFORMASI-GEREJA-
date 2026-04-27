@extends('dashboard.layouts.app')
@section('title', $type . ' Program Kerja')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Program Kerja / RAPB" 
    subtitle="Unggah dokumen rancangan program kerja atau anggaran tahunan." 
    backUrl="{{ route('dashboard.program_kerja.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-2xl overflow-hidden relative">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="flex flex-col gap-8">
            <x-form.select label="Jenis Dokumen" name="jenis">
                <option value="Rancangan Program Kerja">Rancangan Program Kerja</option>
                <option value="RAPB">Rancangan Anggaran Penerimaan dan Belanja (RAPB)</option>
            </x-form.select>

            <x-form.select label="Tahun Program" name="tahun">
                @for($i=date('Y')+1; $i>=2024; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-form.select>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Unggah Lampiran (PDF)</label>
                <div class="border-2 border-dashed border-gray-100 rounded-2xl p-12 text-center bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer group">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-4 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <p class="text-sm font-bold text-gray-400">Pilih file program kerja (PDF)</p>
                    <p class="text-[10px] text-gray-300 mt-2 uppercase font-bold tracking-widest">Maksimal 5MB</p>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    Simpan Program
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
