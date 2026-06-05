@extends('dashboard.layouts.app')
@section('title', $type . ' Jadwal Ibadah')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Jadwal Ibadah" 
    subtitle="Atur waktu pelaksanaan dan detail teknis ibadah gereja." 
    backUrl="{{ route('dashboard.jadwal.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-4xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.jadwal.update', $jadwal->id ?? 0) : route('dashboard.jadwal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="grid grid-cols-2 gap-10">
            <div class="col-span-2">
                <x-form.input label="Nama Ibadah / Kebaktian" name="nama" value="{{ old('nama', $jadwal->nama_acara ?? '') }}" placeholder="Contoh: Ibadah Minggu Pagi, Kebaktian Penyamaran, dll." />
            </div>

            <x-form.input label="Tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal ?? '') }}" type="date" />
            <x-form.input label="Waktu / Pukul" name="waktu" value="{{ old('waktu', $jadwal->waktu_mulai ?? '') }}" type="time" />
            
            <x-form.select label="Jenis Ibadah" name="jenis">
                <option value="Umum" {{ old('jenis', $jadwal->lokasi ?? '') == 'Umum' ? 'selected' : '' }}>Ibadah Umum</option>
                <option value="Pemuda" {{ old('jenis', $jadwal->lokasi ?? '') == 'Pemuda' ? 'selected' : '' }}>Ibadah Pemuda</option>
                <option value="Anak" {{ old('jenis', $jadwal->lokasi ?? '') == 'Anak' ? 'selected' : '' }}>Ibadah Anak (Sekolah Minggu)</option>
                <option value="Khusus" {{ old('jenis', $jadwal->lokasi ?? '') == 'Khusus' ? 'selected' : '' }}>Ibadah Khusus (Natal/Paskah)</option>
                <option value="Sakramen" {{ old('jenis', $jadwal->lokasi ?? '') == 'Sakramen' ? 'selected' : '' }}>Sakramen (Baptis/Sidi/Perjamuan Kudus)</option>
            </x-form.select>

            <x-form.input label="Estimasi / Jumlah Kehadiran" name="jumlah_hadir" value="{{ old('jumlah_hadir', $jadwal->jumlah_hadir ?? '') }}" type="number" placeholder="Jumlah jemaat..." />

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran Tata Ibadah (PDF)</label>
                <input type="file" name="lampiran" accept=".pdf" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                @if(isset($jadwal) && $jadwal->lampiran)
                    <p class="mt-2 text-xs text-gray-500">File saat ini: <a href="{{ asset('storage/' . $jadwal->lampiran) }}" target="_blank" class="text-primary underline">Lihat PDF</a></p>
                @endif
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
