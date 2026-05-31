@extends('dashboard.layouts.app')
@section('title', $type . ' Jemaat')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Data Jemaat" 
    subtitle="Lengkapi data diri dan status keanggotaan jemaat." 
    backUrl="{{ route('dashboard.jemaat.index') }}" 
/>

<form action="{{ $type == 'Tambah' ? route('dashboard.jemaat.store') : route('dashboard.jemaat.update', $id ?? '') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($type == 'Edit')
        @method('PUT')
    @endif
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
                    <div class="col-span-2">
                        <x-form.select label="Pilih Keluarga (No KK & Kepala Keluarga)" name="keluarga_id">
                            <option value="">-- Bukan Anggota Keluarga Terdaftar / Pilih Keluarga --</option>
                            @foreach($keluargaList as $k)
                                <option value="{{ $k->id }}" {{ old('keluarga_id', $jemaat['keluarga_id'] ?? '') == $k->id ? 'selected' : '' }}>
                                    {{ $k->no_kk }} - {{ $k->nama_kepala_keluarga }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <x-form.input label="Nomor Induk Kependudukan (NIK)" name="no_induk" type="number" value="{{ old('no_induk', $jemaat['no_induk'] ?? '') }}" placeholder="16 digit NIK..." />
                    <x-form.input label="Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $jemaat['nama_lengkap'] ?? '') }}" placeholder="Nama lengkap sesuai KTP..." />
                    <x-form.input label="Nomor Telepon" name="no_telepon" type="number" value="{{ old('no_telepon', $jemaat['no_telepon'] ?? '') }}" placeholder="Contoh: 0812..." />
                    <x-form.input label="Username" name="username" value="{{ old('username', $jemaat['username'] ?? '') }}" placeholder="Untuk login aplikasi..." />
                    
                    <x-form.select label="Jenis Kelamin" name="jenis_kelamin">
                        <option value="Laki-laki" {{ old('jenis_kelamin', $jemaat['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $jemaat['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </x-form.select>

                    <x-form.select label="Posisi dalam Keluarga" name="posisi">
                        <option value="Kepala Keluarga" {{ old('posisi', $jemaat['posisi'] ?? '') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Istri" {{ old('posisi', $jemaat['posisi'] ?? '') == 'Istri' ? 'selected' : '' }}>Istri</option>
                        <option value="Anak" {{ old('posisi', $jemaat['posisi'] ?? '') == 'Anak' ? 'selected' : '' }}>Anak</option>
                        <option value="Lainnya" {{ old('posisi', $jemaat['posisi'] ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </x-form.select>

                    <x-form.input label="Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $jemaat['tempat_lahir'] ?? '') }}" placeholder="Kota kelahiran..." />
                    <x-form.input label="Tanggal Lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', $jemaat['tanggal_lahir'] ?? '') }}" />
                </div>
            </div>

            <!-- Church Status -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Status Keanggotaan & Gerejawi
                </h3>
                <div class="grid grid-cols-2 gap-8">
                    <x-form.select label="Status Anggota" name="status_keanggotaan">
                        <option value="Aktif" {{ old('status_keanggotaan', $jemaat['status_keanggotaan'] ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status_keanggotaan', $jemaat['status_keanggotaan'] ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="Pindah" {{ old('status_keanggotaan', $jemaat['status_keanggotaan'] ?? '') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                    </x-form.select>

                    <x-form.select label="Status Pernikahan" name="status_nikah">
                        <option value="Belum Kawin" {{ old('status_nikah', $jemaat['status_nikah'] ?? '') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_nikah', $jemaat['status_nikah'] ?? '') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_nikah', $jemaat['status_nikah'] ?? '') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_nikah', $jemaat['status_nikah'] ?? '') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </x-form.select>

                    <div class="flex flex-col gap-3">
                        <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Sudah Dibaptis?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="baptis" value="Ya" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" {{ old('baptis', $jemaat['baptis'] ?? '') == 'Ya' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-600">Ya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="baptis" value="Tidak" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" {{ old('baptis', $jemaat['baptis'] ?? 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-600">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Sudah Disidi?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sidi" value="Ya" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" {{ old('sidi', $jemaat['sidi'] ?? '') == 'Ya' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-600">Ya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sidi" value="Tidak" class="w-4 h-4 text-primary focus:ring-primary border-gray-200" {{ old('sidi', $jemaat['sidi'] ?? 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-600">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <x-form.input label="Alamat Lengkap" name="alamat" value="{{ old('alamat', $jemaat['alamat'] ?? '') }}" placeholder="Domisili saat ini..." />
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Form Column -->
        <div class="flex flex-col gap-8">
            <!-- Profile Photo -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 text-center">
                <label class="block mb-6 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Profil</label>
                <label class="w-32 h-32 bg-gray-50 border-2 border-dashed border-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center group hover:border-primary transition-all cursor-pointer relative overflow-hidden block">
                    <input type="file" name="foto_profil" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" onchange="document.getElementById('filename_foto').textContent = this.files[0] ? this.files[0].name : 'Pilih Foto'">
                    @if(!empty($jemaat['foto_profil']))
                        <img src="{{ asset('storage/' . $jemaat['foto_profil']) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-gray-200 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4v16m8-8H4"/></svg>
                    @endif
                </label>
                <span class="text-xs font-bold text-primary" id="filename_foto">Pilih Foto</span>
            </div>

            <!-- Attachments -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                <label class="block mb-6 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran Dokumen</label>
                <div class="flex flex-col gap-4">
                    <label class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-3 relative cursor-pointer hover:border-primary transition-all">
                        <input type="file" name="lampiran_baptis" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" onchange="document.getElementById('filename_baptis').textContent = this.files[0] ? this.files[0].name : 'Surat Baptis'">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-gray-700" id="filename_baptis">
                                @if(!empty($jemaat['lampiran_baptis']))
                                    <a href="{{ asset('storage/' . $jemaat['lampiran_baptis']) }}" target="_blank" class="text-primary hover:underline relative z-[60]">Lihat File Saat Ini</a>
                                @else
                                    Surat Baptis
                                @endif
                            </p>
                            <p class="text-[9px] text-gray-400">PDF/JPG</p>
                        </div>
                        <span class="text-[10px] font-bold text-primary">Upload</span>
                    </label>
                    <label class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-3 relative cursor-pointer hover:border-primary transition-all">
                        <input type="file" name="lampiran_sidi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" onchange="document.getElementById('filename_sidi').textContent = this.files[0] ? this.files[0].name : 'Surat Sidi'">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-gray-700" id="filename_sidi">
                                @if(!empty($jemaat['lampiran_sidi']))
                                    <a href="{{ asset('storage/' . $jemaat['lampiran_sidi']) }}" target="_blank" class="text-primary hover:underline relative z-[60]">Lihat File Saat Ini</a>
                                @else
                                    Surat Sidi
                                @endif
                            </p>
                            <p class="text-[9px] text-gray-400">PDF/JPG</p>
                        </div>
                        <span class="text-[10px] font-bold text-primary">Upload</span>
                    </label>
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
