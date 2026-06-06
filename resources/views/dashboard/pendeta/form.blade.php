@extends('dashboard.layouts.app')
@section('title', $type . ' Profil Pendeta')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Profil Pendeta" 
    subtitle="Kelola data pribadi, riwayat pelayanan, visi, dan riwayat pendidikan pendeta jemaat." 
    backUrl="{{ route('dashboard.pendeta.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-5xl overflow-hidden mb-12">
    <form action="{{ $type == 'Edit' ? route('dashboard.pendeta.update', $pendeta->id ?? 0) : route('dashboard.pendeta.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        
        <div class="grid grid-cols-2 gap-10">
            <!-- Informasi Utama -->
            <div class="col-span-2">
                <h3 class="font-heading text-lg font-bold text-gray-800 border-b border-gray-100 pb-3 mb-6">Informasi Utama</h3>
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.input label="Nama Lengkap & Gelar" name="nama" value="{{ old('nama', $pendeta->nama ?? '') }}" placeholder="Contoh: Pdt. Dr. Andreas Wijaya, M.Th." />
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.input label="Jabatan Pelayanan" name="jabatan" value="{{ old('jabatan', $pendeta->jabatan ?? '') }}" placeholder="Contoh: Pendeta Jemaat GKI Komplek Pakuwon" />
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.input label="Suami / Istri (Pasangan)" name="pasangan" value="{{ old('pasangan', $pendeta->pasangan ?? '') }}" placeholder="Contoh: Suami/Istri: Nama Pasangan" />
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.input label="Email Hubungi" name="email" value="{{ old('email', $pendeta->email ?? '') }}" placeholder="Contoh: yerumartin@yahoo.com" type="email" />
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.input label="Jadwal Konseling" name="jadwal_konseling" value="{{ old('jadwal_konseling', $pendeta->jadwal_konseling ?? '') }}" placeholder="Contoh: Selasa & Kamis, 10:00 - 14:00" />
            </div>

            <div class="col-span-2 md:col-span-1">
                <x-form.select label="Status Keaktifan" name="status">
                    <option value="Aktif Melayani" {{ old('status', $pendeta->status ?? '') == 'Aktif Melayani' ? 'selected' : '' }}>Aktif Melayani</option>
                    <option value="Emeritus" {{ old('status', $pendeta->status ?? '') == 'Emeritus' ? 'selected' : '' }}>Emeritus</option>
                    <option value="Non-Aktif" {{ old('status', $pendeta->status ?? '') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </x-form.select>
            </div>

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Profil</label>
                <input type="file" name="foto_file" accept="image/png,image/jpeg,image/webp" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                <p class="mt-2 text-xs text-gray-400 font-medium">Hanya gambar JPG, PNG, atau WebP. Maksimal 2MB.</p>
                <div class="mt-4">
                    <x-form.input label="Atau Gunakan URL Foto (Opsional)" name="foto" value="{{ old('foto', $pendeta->foto ?? '') }}" placeholder="https://example.com/foto.jpg" />
                </div>
                @if(isset($pendeta) && $pendeta->foto)
                    <div class="mt-4 p-3 bg-gray-50 rounded-xl border border-gray-100 inline-block">
                        <p class="text-xs text-gray-500 mb-2 font-bold">Foto saat ini:</p>
                        <img src="{{ $pendeta->foto }}" alt="Preview" class="h-20 w-auto rounded-lg object-cover border border-gray-200">
                    </div>
                @endif
            </div>

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Visi Pelayanan</label>
                <textarea name="visi_pelayanan" rows="4" placeholder="Tulis visi pelayanan pendeta..." class="w-full px-6 py-5 rounded-2xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('visi_pelayanan', $pendeta->visi_pelayanan ?? '') }}</textarea>
            </div>

            <!-- Dynamic Section: Riwayat Pendidikan -->
            <div class="col-span-2" x-data="{ 
                items: {{ json_encode(old('pendidikan', $pendeta->pendidikan ?? [['tahun' => '', 'gelar' => '', 'institusi' => '']])) }} 
            }">
                <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-6 mt-6">
                    <h3 class="font-heading text-lg font-bold text-gray-800">Riwayat Pendidikan</h3>
                    <button type="button" @click="items.push({tahun: '', gelar: '', institusi: ''})" class="px-4 py-2 bg-blue-50 text-primary rounded-xl text-xs font-bold hover:bg-blue-100 transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 4v16m8-8H4"/></svg>
                        Tambah Pendidikan
                    </button>
                </div>
                
                <div class="space-y-4">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="grid grid-cols-12 gap-4 bg-gray-50/30 p-5 rounded-2xl border border-gray-100 relative group">
                            <div class="col-span-12 md:col-span-3">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Tahun</label>
                                <input type="text" :name="`pendidikan[${index}][tahun]`" x-model="item.tahun" placeholder="Contoh: 1997 - 2003" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Gelar / Bidang Studi</label>
                                <input type="text" :name="`pendidikan[${index}][gelar]`" x-model="item.gelar" placeholder="Contoh: S1 Teologi" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Institusi / Universitas</label>
                                <input type="text" :name="`pendidikan[${index}][institusi]`" x-model="item.institusi" placeholder="Contoh: Universitas Gadjah Mada" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-1 flex items-end justify-center pb-2">
                                <button type="button" @click="items.splice(index, 1)" class="w-9 h-9 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-700 transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Dynamic Section: Riwayat Pelayanan -->
            <div class="col-span-2" x-data="{ 
                services: {{ json_encode(old('riwayat_pelayanan', $pendeta->riwayat_pelayanan ?? [['tanggal' => '', 'judul' => '', 'deskripsi' => '']])) }} 
            }">
                <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-6 mt-6">
                    <h3 class="font-heading text-lg font-bold text-gray-800">Riwayat Pelayanan</h3>
                    <button type="button" @click="services.push({tanggal: '', judul: '', deskripsi: ''})" class="px-4 py-2 bg-blue-50 text-primary rounded-xl text-xs font-bold hover:bg-blue-100 transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 4v16m8-8H4"/></svg>
                        Tambah Riwayat
                    </button>
                </div>
                
                <div class="space-y-4">
                    <template x-for="(srv, index) in services" :key="index">
                        <div class="grid grid-cols-12 gap-4 bg-gray-50/30 p-5 rounded-2xl border border-gray-100 relative group">
                            <div class="col-span-12 md:col-span-3">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Tanggal / Tahun</label>
                                <input type="text" :name="`riwayat_pelayanan[${index}][tanggal]`" x-model="srv.tanggal" placeholder="Contoh: 23 Januari 2013" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Peristiwa / Jabatan</label>
                                <input type="text" :name="`riwayat_pelayanan[${index}][judul]`" x-model="srv.judul" placeholder="Contoh: Ditahbiskan sebagai Pendeta" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="block mb-2 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Keterangan Singkat</label>
                                <input type="text" :name="`riwayat_pelayanan[${index}][deskripsi]`" x-model="srv.deskripsi" placeholder="Keterangan singkat peristiwa..." class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary outline-none">
                            </div>
                            <div class="col-span-12 md:col-span-1 flex items-end justify-center pb-2">
                                <button type="button" @click="services.splice(index, 1)" class="w-9 h-9 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-700 transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-span-2 flex items-center gap-4 pt-8 border-t border-gray-50 mt-6">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Profil' : 'Ubah Profil' }}
                </button>
                <a href="{{ route('dashboard.pendeta.index') }}" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all text-center">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
