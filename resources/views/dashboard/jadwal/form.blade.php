@extends('dashboard.layouts.app')
@section('title', $type . ' Jadwal Ibadah')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Jadwal Ibadah" 
    subtitle="Atur waktu pelaksanaan dan detail teknis ibadah gereja." 
    backUrl="{{ route('dashboard.jadwal.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-4xl overflow-hidden relative">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-10">
            <div class="col-span-2">
                <x-form.input label="Nama Ibadah / Kebaktian" name="nama" placeholder="Contoh: Ibadah Minggu Pagi, Kebaktian Penyamaran, dll." />
            </div>

            <x-form.input label="Tanggal" name="tanggal" type="date" />
            <x-form.input label="Waktu / Pukul" name="waktu" type="time" />
            
            <x-form.select label="Jenis Ibadah" name="jenis">
                <option value="Umum">Ibadah Umum</option>
                <option value="Pemuda">Ibadah Pemuda</option>
                <option value="Anak">Ibadah Anak (Sekolah Minggu)</option>
                <option value="Khusus">Ibadah Khusus (Natal/Paskah)</option>
            </x-form.select>

            <x-form.input label="Estimasi / Jumlah Kehadiran" name="jumlah_hadir" type="number" placeholder="Jumlah jemaat..." />

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran Tata Ibadah (PDF)</label>
                <div class="border-2 border-dashed border-gray-100 rounded-2xl p-10 text-center bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer group">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-4 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <p class="text-sm font-bold text-gray-400">Pilih file Tata Ibadah (PDF)</p>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-span-2 flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Jadwal' : 'Ubah Jadwal' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
