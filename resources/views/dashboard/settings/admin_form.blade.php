@extends('dashboard.layouts.app')
@section('title', $type . ' Administrator')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Administrator" 
    subtitle="Berikan hak akses panel kontrol kepada personil gereja yang berwenang." 
    backUrl="{{ route('dashboard.settings') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-4xl overflow-hidden relative">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-10">
            <!-- Basic Info -->
            <div class="col-span-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Informasi Akun</h3>
                <div class="grid grid-cols-2 gap-8">
                    <x-form.input label="Nama Lengkap" name="nama" placeholder="Contoh: Budi Santoso" />
                    <x-form.input label="Username" name="username" placeholder="contoh: budi_admin" />
                    <x-form.input label="Email Address" name="email" type="email" placeholder="email@gkipakuwon.or.id" />
                    <x-form.select label="Hak Akses / Role" name="role">
                        <option value="Admin">Administrator Umum</option>
                        <option value="Bendahara">Bendahara (Keuangan)</option>
                        <option value="Penatua">Penatua (Sekretariat)</option>
                        <option value="Super Admin">Super Admin (Full Access)</option>
                    </x-form.select>
                </div>
            </div>

            <!-- Security Info -->
            <div class="col-span-2 pt-8 border-t border-gray-50">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Keamanan & Password</h3>
                <div class="grid grid-cols-2 gap-8">
                    <x-form.input label="Password Baru" name="password" type="password" placeholder="••••••••" />
                    <x-form.input label="Konfirmasi Password" name="password_confirmation" type="password" placeholder="••••••••" />
                </div>
                <p class="text-[11px] text-gray-400 mt-4 italic">* Pastikan password minimal 8 karakter dengan kombinasi angka dan simbol.</p>
            </div>

            <!-- Submit -->
            <div class="col-span-2 flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Daftarkan Admin' : 'Simpan Perubahan' }}
                </button>
                <a href="{{ route('dashboard.settings') }}" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
