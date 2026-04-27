@extends('dashboard.layouts.app')
@section('title', $type . ' Jemaat')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Data Jemaat" 
    subtitle="Lengkapi data diri dan status keanggotaan jemaat." 
    backUrl="{{ route('dashboard.jemaat.index') }}" 
/>

<form action="#" method="POST" enctype="multipart/form-data">
    <div class="grid grid-cols-3 gap-8">
        <!-- Main Form Column -->
        <div class="col-span-2 flex flex-col gap-8">
            <!-- Basic Identity -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    Identitas Diri
                </h3>
                <div class="grid grid-cols-2 gap-8">
                    <x-form.input label="No. Kartu Keluarga" name="no_kk" placeholder="Cari atau masukkan No KK..." />
                    <x-form.input label="Nama Keluarga" name="nama_keluarga" placeholder="Sesuai kepala keluarga..." />
                    <x-form.input label="Nomor Induk Kependudukan (NIK)" name="nik" placeholder="16 digit NIK..." />
                    <x-form.input label="Nama Lengkap" name="nama" placeholder="Nama lengkap sesuai KTP..." />
                    <x-form.input label="Nomor Telepon" name="telepon" placeholder="Contoh: 0812..." />
                    <x-form.input label="Username" name="username" placeholder="Untuk login aplikasi..." />
                    
                    <x-form.select label="Jenis Kelamin" name="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </x-form.select>

                    <x-form.select label="Posisi dalam Keluarga" name="posisi">
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Lainnya">Lainnya</option>
                    </x-form.select>

                    <x-form.input label="Tempat Lahir" name="tempat_lahir" placeholder="Kota kelahiran..." />
                    <x-form.input label="Tanggal Lahir" name="tanggal_lahir" type="date" />
                </div>
            </div>

            <!-- Church Status -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Status Keanggotaan & Gerejawi
                </h3>
                <div class="grid grid-cols-2 gap-8">
                    <x-form.select label="Status Anggota" name="status_anggota">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Pindah">Pindah</option>
                    </x-form.select>

                    <x-form.select label="Status Pernikahan" name="status_nikah">
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </x-form.select>

                    <div class="flex flex-col gap-3">
                        <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Sudah Dibaptis?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="baptis" value="Ya" class="w-4 h-4 text-primary focus:ring-primary border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Ya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="baptis" value="Tidak" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" checked>
                                <span class="text-sm font-medium text-gray-600">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Sudah Disidi?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sidi" value="Ya" class="w-4 h-4 text-primary focus:ring-primary border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Ya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sidi" value="Tidak" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" checked>
                                <span class="text-sm font-medium text-gray-600">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <x-form.input label="Alamat Lengkap" name="alamat" placeholder="Domisili saat ini..." />
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Form Column -->
        <div class="flex flex-col gap-8">
            <!-- Profile Photo -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 text-center">
                <label class="block mb-6 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Profil</label>
                <div class="w-32 h-32 bg-gray-50 border-2 border-dashed border-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center group hover:border-primary transition-all cursor-pointer">
                    <svg class="w-8 h-8 text-gray-200 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4v16m8-8H4"/></svg>
                </div>
                <button type="button" class="text-xs font-bold text-primary hover:underline">Pilih Foto</button>
            </div>

            <!-- Attachments -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <label class="block mb-6 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran Dokumen</label>
                <div class="flex flex-col gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-gray-700">Surat Baptis</p>
                            <p class="text-[9px] text-gray-400">PDF/JPG</p>
                        </div>
                        <button type="button" class="text-[10px] font-bold text-primary">Upload</button>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-gray-700">Surat Sidi</p>
                            <p class="text-[9px] text-gray-400">PDF/JPG</p>
                        </div>
                        <button type="button" class="text-[10px] font-bold text-primary">Upload</button>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex flex-col gap-3">
                <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    Simpan Data Jemaat
                </button>
                <button type="reset" class="w-full py-4 bg-white border border-gray-100 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-50 transition-all">
                    Reset Form
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
