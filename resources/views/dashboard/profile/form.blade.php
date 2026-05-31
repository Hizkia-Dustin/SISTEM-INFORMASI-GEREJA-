@extends('dashboard.layouts.app')
@section('title', 'Ubah Profil Saya')

@section('content')
<x-dashboard.page-header title="Ubah Profil Admin" subtitle="Kelola informasi pribadi dan keamanan akun Anda." />

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-5xl">
    <form action="{{ route('dashboard.profil.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-xl font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 text-rose-500 rounded-xl font-bold text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-8">
            <div class="col-span-2 flex flex-col items-center">
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Profil</label>
                <label class="w-32 h-32 bg-gray-50 border-2 border-dashed border-gray-100 rounded-full flex items-center justify-center group hover:border-primary transition-all cursor-pointer relative overflow-hidden block">
                    <input type="file" name="foto_profil" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" onchange="document.getElementById('filename_foto').textContent = this.files[0] ? this.files[0].name : 'Pilih Foto'">
                    @if(!empty($user->foto_profil))
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover rounded-xl" alt="Foto Profil">
                    @else
                        <svg class="w-8 h-8 text-gray-200 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4v16m8-8H4"/></svg>
                    @endif
                </label>
                <span class="text-xs font-bold text-primary mt-2" id="filename_foto">Ubah Foto</span>
            </div>

            <div class="col-span-2">
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" required>
            </div>
            
            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" required>
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Nomor Induk (NIK)</label>
                <input type="text" name="no_induk" value="{{ old('no_induk', $user->no_induk) }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none font-medium">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Status Anggota</label>
                <select name="status_anggota" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none font-medium">
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif" {{ old('status_anggota', $user->status_anggota) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_anggota', $user->status_anggota) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            
            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Status Pernikahan</label>
                <select name="status_pernikahan" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none font-medium">
                    <option value="">-- Pilih Status --</option>
                    <option value="Belum Kawin" {{ old('status_pernikahan', $user->status_pernikahan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_pernikahan', $user->status_pernikahan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_pernikahan', $user->status_pernikahan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_pernikahan', $user->status_pernikahan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
            
            <div class="col-span-2 border-t border-gray-50 pt-6 mt-2">
                <h3 class="text-xs font-bold text-primary uppercase tracking-widest mb-6">Data Gerejawi</h3>
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Sektor</label>
                <input type="text" name="sektor" value="{{ old('sektor', $user->sektor) }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Contoh: 1, 2, 3">
            </div>
            <div>
                <!-- Empty div for grid alignment -->
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Tanggal Baptis</label>
                <input type="date" name="tanggal_baptis" value="{{ old('tanggal_baptis', $user->tanggal_baptis ? \Carbon\Carbon::parse($user->tanggal_baptis)->format('Y-m-d') : '') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>

            <div>
                <label class="block mb-2 font-bold text-primary text-[11px] uppercase tracking-widest">Tanggal Sidi</label>
                <input type="date" name="tanggal_sidi" value="{{ old('tanggal_sidi', $user->tanggal_sidi ? \Carbon\Carbon::parse($user->tanggal_sidi)->format('Y-m-d') : '') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>

            <div class="col-span-2 flex justify-end gap-4 mt-8">
                <a href="{{ route('dashboard.profil') }}" class="px-8 py-3.5 bg-gray-50 text-gray-400 font-bold rounded-xl text-sm hover:bg-gray-100 transition-colors">Batal</a>
                <button type="submit" class="px-8 py-3.5 bg-primary text-white font-bold rounded-xl text-sm hover:bg-blue-700 shadow-lg shadow-primary/20 transition-all">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection
