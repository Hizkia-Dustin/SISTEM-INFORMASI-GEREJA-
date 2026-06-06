@extends('dashboard.layouts.app')
@section('title', $type . ' Pelayan')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Pelayan Gereja" 
    subtitle="Tugaskan jemaat sebagai pelayan (Pendeta, Penatua, atau Diaken)." 
    backUrl="{{ route('dashboard.pelayan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-3xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.pelayan.update', $pelayan->id ?? 0) : route('dashboard.pelayan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="flex flex-col gap-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-form.input label="Nama Lengkap" name="nama" value="{{ old('nama', $pelayan->nama ?? '') }}" placeholder="Masukkan nama pelayan..." />
                <x-form.input label="Nama Tampil / Gelar Lengkap" name="nama_tampilan" value="{{ old('nama_tampilan', $pelayan->nama_tampilan ?? '') }}" placeholder="Contoh: Pdt. Dr. Yerusa Maria Agustini, S.Si., M.Pd." />
                <x-form.select label="Posisi / Jabatan" name="posisi">
                    <option value="Pendeta" {{ (old('posisi', $pelayan->posisi ?? '') == 'Pendeta') ? 'selected' : '' }}>Pendeta</option>
                    <option value="Penatua" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penatua') ? 'selected' : '' }}>Penatua</option>
                    <option value="Diaken" {{ (old('posisi', $pelayan->posisi ?? '') == 'Diaken') ? 'selected' : '' }}>Diaken</option>
                    <option value="Penginjil" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penginjil') ? 'selected' : '' }}>Penginjil</option>
                </x-form.select>
                <x-form.input label="Jabatan Tampil" name="jabatan_tampilan" value="{{ old('jabatan_tampilan', $pelayan->jabatan_tampilan ?? '') }}" placeholder="Contoh: Pendeta Jemaat GKI Komplek Pakuwon / Ketua Umum" />
                <x-form.select label="Halaman Tujuan" name="kategori_halaman">
                    <option value="">Pilih halaman tujuan</option>
                    <option value="pendeta" {{ (old('kategori_halaman', $pelayan->kategori_halaman ?? '') == 'pendeta') ? 'selected' : '' }}>About Pendeta</option>
                    <option value="penatua" {{ (old('kategori_halaman', $pelayan->kategori_halaman ?? '') == 'penatua') ? 'selected' : '' }}>About Penatua</option>
                </x-form.select>
                <x-form.select label="Kelompok Layanan" name="kelompok_layanan">
                    <option value="">Pilih kelompok data</option>
                    <option value="profil_pendeta" {{ (old('kelompok_layanan', $pelayan->kelompok_layanan ?? '') == 'profil_pendeta') ? 'selected' : '' }}>Profil Pendeta</option>
                    <option value="pengurus_harian" {{ (old('kelompok_layanan', $pelayan->kelompok_layanan ?? '') == 'pengurus_harian') ? 'selected' : '' }}>Penatua: Pengurus Harian</option>
                    <option value="bidang_kerja" {{ (old('kelompok_layanan', $pelayan->kelompok_layanan ?? '') == 'bidang_kerja') ? 'selected' : '' }}>Penatua: Bidang Kerja</option>
                    <option value="pendamping_komisi" {{ (old('kelompok_layanan', $pelayan->kelompok_layanan ?? '') == 'pendamping_komisi') ? 'selected' : '' }}>Penatua: Pendamping Komisi</option>
                </x-form.select>
                <x-form.select label="Status" name="status">
                    <option value="aktif" {{ (old('status', $pelayan->status ?? '') == 'aktif') ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ (old('status', $pelayan->status ?? '') == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                </x-form.select>
                <x-form.input label="Tanggal Mulai Jabatan" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai', $pelayan->tanggal_mulai ?? '') }}" />
                <x-form.input label="Urutan Tampil" name="urutan" type="number" value="{{ old('urutan', $pelayan->urutan ?? 0) }}" placeholder="0, 1, 2..." />
                <x-form.input label="Area Layanan / Komisi" name="area_layanan" value="{{ old('area_layanan', $pelayan->area_layanan ?? '') }}" placeholder="Contoh: Bid. Sarpen / Komisi Anak" />
                <x-form.input label="Ikon Material Symbols" name="ikon" value="{{ old('ikon', $pelayan->ikon ?? '') }}" placeholder="Contoh: school, groups, volunteer_activism" />
                <x-form.input label="Nama Pasangan" name="pasangan" value="{{ old('pasangan', $pelayan->pasangan ?? '') }}" placeholder="Contoh: Ayub Wahyono" />
                <x-form.input label="Email" name="email" type="email" value="{{ old('email', $pelayan->email ?? '') }}" placeholder="contoh@email.com" />
                <x-form.input label="Visi Strategis" name="visi_strategis" value="{{ old('visi_strategis', $pelayan->visi_strategis ?? '') }}" placeholder="Contoh: Kepemimpinan & Tata Kelola" />
                <x-form.input label="Fokus Utama" name="fokus_utama" value="{{ old('fokus_utama', $pelayan->fokus_utama ?? '') }}" placeholder="Contoh: Pertumbuhan Jemaat" />
                <x-form.input label="Jadwal Konseling" name="jadwal_konseling" value="{{ old('jadwal_konseling', $pelayan->jadwal_konseling ?? '') }}" placeholder="Contoh: Selasa & Kamis, 10:00 - 14:00" />
                <x-form.input label="Masa Bakti" name="masa_bakti" value="{{ old('masa_bakti', $pelayan->masa_bakti ?? '') }}" placeholder="Contoh: 2025 - 2026" />
                <x-form.input label="Update Terakhir" name="update_terakhir" type="date" value="{{ old('update_terakhir', $pelayan->update_terakhir ?? '') }}" />
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Pelayan</label>
                <input type="file" name="foto" accept="image/*" class="w-full cursor-pointer px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                @if(isset($pelayan) && $pelayan->foto)
                    <p class="mt-2 text-xs text-gray-500">Foto saat ini: <a href="{{ asset('storage/' . $pelayan->foto) }}" target="_blank" class="text-primary underline">Lihat Foto</a></p>
                @endif
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" rows="4" placeholder="Subteks singkat untuk profil pelayan..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('deskripsi_singkat', $pelayan->deskripsi_singkat ?? '') }}</textarea>
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Pendidikan</label>
                <textarea name="pendidikan" rows="6" placeholder="Satu baris per item. Format: 1997 - 2003|S1 Teologi|Universitas Kristen Dutawacana Yogyakarta" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('pendidikan', $pelayan->pendidikan ?? '') }}</textarea>
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Riwayat Pelayanan</label>
                <textarea name="riwayat_pelayanan" rows="6" placeholder="Satu baris per item. Format: 23 Januari 2011|Diteguhkan sebagai Penatua Khusus|Langkah awal dalam pengabdian struktural jemaat." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('riwayat_pelayanan', $pelayan->riwayat_pelayanan ?? '') }}</textarea>
            </div>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Visi Pelayanan</label>
                <textarea name="visi_pelayanan" rows="4" placeholder="Tuliskan visi pelayanan pelayan ini..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('visi_pelayanan', $pelayan->visi_pelayanan ?? '') }}</textarea>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Tambahkan Data Pelayan' : 'Simpan Perubahan' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
