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
                <x-form.input label="Nama Ibadah / Kebaktian" name="nama" value="{{ old('nama', $jadwal->nama ?? $jadwal->nama_acara ?? '') }}" placeholder="Contoh: Ibadah Minggu Pagi, Kebaktian Penyamaran, dll." />
            </div>

            <x-form.input label="Tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal ?? '') }}" type="date" />
            <div x-data="{
                time: '{{ old('waktu', isset($jadwal->waktu) ? \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') : (isset($jadwal->waktu_mulai) ? \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') : '09:00')) }}',
                incrementHour() {
                    if(!this.time) this.time = '09:00';
                    let parts = this.time.split(':');
                    let h = parseInt(parts[0]);
                    h = (h + 1) % 24;
                    this.time = h.toString().padStart(2, '0') + ':' + parts[1];
                },
                decrementHour() {
                    if(!this.time) this.time = '09:00';
                    let parts = this.time.split(':');
                    let h = parseInt(parts[0]);
                    h = (h - 1 + 24) % 24;
                    this.time = h.toString().padStart(2, '0') + ':' + parts[1];
                }
            }">
                <label class="block mb-2 font-medium text-gray-700 text-sm">Waktu / Pukul</label>
                <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all flex">
                    <input type="time" name="waktu" x-model="time" class="w-full px-4 py-3 border-none bg-transparent outline-none text-sm">
                    <div class="flex flex-col border-l border-gray-200 bg-gray-50/80 w-10">
                        <button type="button" @click="incrementHour" class="flex-1 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                        </button>
                        <button type="button" @click="decrementHour" class="flex-1 flex items-center justify-center border-t border-gray-200 text-gray-500 hover:bg-gray-200 transition-colors">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                </div>
                @error('waktu')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <x-form.select label="Jenis Ibadah" name="jenis">
                <option value="Umum" {{ old('jenis', $jadwal->lokasi ?? '') == 'Umum' ? 'selected' : '' }}>Ibadah Umum</option>
                <option value="Pemuda" {{ old('jenis', $jadwal->lokasi ?? '') == 'Pemuda' ? 'selected' : '' }}>Ibadah Pemuda</option>
                <option value="Anak" {{ old('jenis', $jadwal->lokasi ?? '') == 'Anak' ? 'selected' : '' }}>Ibadah Anak (Sekolah Minggu)</option>
                <option value="Khusus" {{ old('jenis', $jadwal->lokasi ?? '') == 'Khusus' ? 'selected' : '' }}>Ibadah Khusus (Natal/Paskah)</option>
                <option value="Sakramen" {{ old('jenis', $jadwal->lokasi ?? '') == 'Sakramen' ? 'selected' : '' }}>Sakramen (Baptis/Sidi/Perjamuan Kudus)</option>
            </x-form.select>

            <x-form.input label="Estimasi / Jumlah Kehadiran" name="jumlah_hadir" value="{{ old('jumlah_hadir', $jadwal->jumlah_hadir ?? '') }}" type="number" placeholder="Jumlah jemaat..." />

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran Tata Ibadah (PDF/JPG/PNG)</label>
                <input type="file" name="lampiran" accept=".pdf, .jpg, .jpeg, .png" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700 cursor-pointer file:cursor-pointer">
                @if(isset($jadwal) && $jadwal->lampiran)
                    <p class="mt-2 text-xs text-gray-500">File saat ini: <a href="{{ asset('storage/' . $jadwal->lampiran) }}" target="_blank" class="text-primary underline">Lihat File</a></p>
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
