@extends('dashboard.layouts.app')
@section('title', $type . ' Sektor')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Wilayah Sektor" 
    subtitle="Kelola data wilayah pelayanan dan keterangan sektor jemaat." 
    backUrl="{{ route('dashboard.sektor.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-2xl overflow-hidden relative">
    <form action="#" method="POST">
        <div class="flex flex-col gap-8">
            <x-form.input label="Nama Sektor" name="nama" placeholder="Contoh: Sektor 1, Sektor Efesus, dll." />
            
            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Keterangan / Deskripsi Wilayah</label>
                <textarea name="keterangan" rows="6" placeholder="Tuliskan wilayah cakupan sektor ini..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner"></textarea>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Sektor' : 'Ubah Sektor' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
