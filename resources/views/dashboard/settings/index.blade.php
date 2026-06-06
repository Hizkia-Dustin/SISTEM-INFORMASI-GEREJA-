@extends('dashboard.layouts.app')
@section('title', 'Pengaturan Sistem')

@section('content')
<x-dashboard.page-header title="Pengaturan Sistem" subtitle="Kelola konfigurasi akun, preferensi sistem, dan keamanan panel administrasi.">
</x-dashboard.page-header>

<div class="grid grid-cols-12 gap-8" x-data="{ activeTab: window.location.hash === '#notifikasi' ? 'notifikasi' : 'profil' }">
    <!-- Sidebar Settings -->
    <div class="col-span-3">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden sticky top-24">
            <div class="p-4 flex flex-col gap-1">
                <button 
                    @click="activeTab = 'profil'"
                    :class="activeTab === 'profil' ? 'bg-blue-50 text-primary font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-primary font-medium'"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Pengguna
                </button>
                <button 
                    @click="activeTab = 'keamanan'"
                    :class="activeTab === 'keamanan' ? 'bg-blue-50 text-primary font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-primary font-medium'"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Keamanan
                </button>
                <button 
                    @click="activeTab = 'admin'"
                    :class="activeTab === 'admin' ? 'bg-blue-50 text-primary font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-primary font-medium'"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen Admin
                </button>
                <button 
                    @click="activeTab = 'notifikasi'"
                    :class="activeTab === 'notifikasi' ? 'bg-blue-50 text-primary font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-primary font-medium'"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    Notifikasi
                </button>
                <button 
                    @click="activeTab = 'sistem'"
                    :class="activeTab === 'sistem' ? 'bg-blue-50 text-primary font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-primary font-medium'"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Sistem
                </button>
            </div>
        </div>
    </div>

    <!-- Main Settings Content -->
    <div class="col-span-9">
        <!-- Account Section -->
        <div x-show="activeTab === 'profil'" x-transition class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-gray-800">Profil Pengguna</h2>
                    <p class="text-xs text-gray-400 font-medium mt-1">Kelola informasi pribadi dan foto profil Anda.</p>
                </div>
            </div>
            <div class="p-8">
                <div class="flex items-center gap-8 mb-10">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-3xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                            @if(!empty($user->foto_profil))
                                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-[#001a57] text-white flex items-center justify-center text-3xl font-bold">{{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}</div>
                            @endif
                        </div>
                        <a href="{{ route('dashboard.profil.edit') }}" class="absolute -bottom-2 -right-2 w-8 h-8 bg-white border border-gray-100 rounded-xl shadow-lg flex items-center justify-center text-primary hover:bg-blue-50 transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        </a>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700">Foto Profil</h3>
                        <p class="text-xs text-gray-400 mt-1">Ubah foto profil di halaman Edit Profil.</p>
                        <div class="flex gap-3 mt-4">
                            <a href="{{ route('dashboard.profil.edit') }}" class="text-[11px] font-bold text-primary hover:underline">Edit Profil</a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name ?? '-' }}" disabled class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Username</label>
                        <input type="text" value="{{ $user->username ?? '-' }}" disabled class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Email Address</label>
                        <input type="email" value="{{ $user->email ?? '-' }}" disabled class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Role</label>
                        <input type="text" value="{{ $user->role ?? '-' }}" disabled class="w-full bg-gray-100 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-400 cursor-not-allowed">
                    </div>
                </div>
            </div>
            <div class="px-8 py-5 bg-gray-50/50 border-t border-gray-50 flex items-center gap-3">
                <a href="{{ route('dashboard.profil.edit') }}" class="px-6 py-2.5 bg-primary text-white rounded-xl text-xs font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">Ubah Selengkapnya</a>
            </div>
        </div>

        <!-- Security Section -->
        <div x-show="activeTab === 'keamanan'" x-transition class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-50">
                <h2 class="text-lg font-extrabold text-gray-800">Keamanan</h2>
                <p class="text-xs text-gray-400 font-medium mt-1">Perbarui kata sandi untuk menjaga keamanan akun Anda.</p>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 gap-6 max-w-xl">
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Kata Sandi Saat Ini</label>
                        <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Kata Sandi Baru</label>
                            <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                        <div>
                            <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Konfirmasi Sandi</label>
                            <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-8 py-5 bg-gray-50/50 border-t border-gray-50 flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-xs font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">Simpan Perubahan</button>
                <button type="reset" class="px-6 py-2.5 bg-white border border-gray-100 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-50 transition-all">Reset</button>
            </div>
        </div>

        <!-- Admin Management Section -->
        <div x-show="activeTab === 'admin'" x-transition class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-gray-800">Manajemen Administrator</h2>
                    <p class="text-xs text-gray-400 font-medium mt-1">Kelola hak akses dan tambahkan administrator baru.</p>
                </div>
                <a href="{{ route('dashboard.settings.admin.create') }}" class="px-5 py-2.5 bg-blue-50 text-primary rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-primary hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Admin
                </a>
            </div>
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Nama Admin</th>
                            <th class="px-8 py-4">Role</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($admins as $admin)
                        <tr class="border-b border-gray-50">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#001a57] text-white text-[10px] font-bold flex items-center justify-center overflow-hidden">
                                        @if(!empty($admin->foto_profil))
                                            <img src="{{ asset('storage/' . $admin->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($admin->name ?? 'A', 0, 2)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $admin->name }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $admin->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 {{ $admin->role == 'Super Admin' ? 'bg-blue-50 text-primary' : ($admin->role == 'Bendahara' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600') }} text-[10px] font-extrabold rounded uppercase">{{ $admin->role ?? 'Admin' }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $admin->id == auth()->user()->id ? 'bg-emerald-500' : 'bg-gray-300' }}"></div>
                                    <span class="text-xs font-bold {{ $admin->id == auth()->user()->id ? 'text-gray-600' : 'text-gray-400' }}">{{ $admin->id == auth()->user()->id ? 'Online (Anda)' : 'Offline' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('dashboard.settings.admin.edit', $admin->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-primary hover:bg-blue-50 transition-all"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                    @if($admin->id != auth()->user()->id)
                                    <form class="confirm-delete" action="{{ route('dashboard.settings.admin.destroy', $admin->id) }}" method="POST" data-confirm="Hapus akun administrator ini?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 transition-all"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notification Section -->
        <div x-show="activeTab === 'notifikasi'" x-transition class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-gray-800">Pengaturan Notifikasi</h2>
                    <p class="text-xs text-gray-400 font-medium mt-1">Pantau aktivitas terbaru dan kelola pemberitahuan dashboard.</p>
                </div>
                <form method="POST" action="{{ route('dashboard.notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 bg-blue-50 text-primary rounded-xl text-xs font-bold hover:bg-primary hover:text-white transition-all">Tandai Semua Dibaca</button>
                </form>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($allNotifications as $notification)
                    <div class="px-8 py-5 flex items-start gap-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50/30' }}">
                        <div class="w-11 h-11 {{ $notification->type === 'success' ? 'bg-emerald-50 text-emerald-500' : ($notification->type === 'warning' ? 'bg-amber-50 text-amber-500' : 'bg-blue-50 text-primary') }} rounded-2xl shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-extrabold text-gray-800">{{ $notification->title }}</h3>
                                @if(!$notification->read_at)
                                    <span class="px-2 py-0.5 bg-rose-50 text-rose-500 rounded-lg text-[10px] font-extrabold uppercase">Baru</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ $notification->message }}</p>
                            <p class="text-[10px] text-gray-300 mt-2 font-bold uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('dashboard.notifications.read', $notification) }}" class="px-4 py-2 bg-white border border-gray-100 text-primary rounded-xl text-[11px] font-bold hover:bg-blue-50 transition-all">Buka</a>
                            <form method="POST" action="{{ route('dashboard.notifications.destroy', $notification) }}" onsubmit="return confirm('Hapus notifikasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-white border border-gray-100 text-rose-500 rounded-xl text-[11px] font-bold hover:bg-rose-50 transition-all">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center text-primary mx-auto mb-6">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Belum Ada Notifikasi</h3>
                        <p class="text-gray-400 mt-2 max-w-sm mx-auto">Aktivitas baru dari dashboard akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
            @if($allNotifications->hasPages())
                <div class="px-8 py-5 bg-gray-50/50 border-t border-gray-50">
                    {{ $allNotifications->fragment('notifikasi')->links() }}
                </div>
            @endif
        </div>

        <!-- System Section -->
        <div x-show="activeTab === 'sistem'" x-transition class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-50">
                <h2 class="text-lg font-extrabold text-gray-800">Pengaturan Sistem &amp; Homepage</h2>
                <p class="text-xs text-gray-400 font-medium mt-1">Kelola konten halaman utama, gambar banner hero, dan informasi kontak gereja secara dinamis.</p>
            </div>
            <form action="{{ route('dashboard.settings.system') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8 space-y-8">
                    <!-- Hero Section Banner -->
                    <div>
                        <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">1. Banner Utama (Hero Section)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Judul Hero Banner</label>
                                <input type="text" name="hero_title" value="{{ \App\Models\Setting::get('hero_title', 'Selamat Datang di GKI PAKUWON') }}" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Subjudul / Deskripsi Hero</label>
                                <textarea name="hero_subtitle" rows="3" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">{{ \App\Models\Setting::get('hero_subtitle', 'Temukan kedamaian dan komunitas dalam perjalanan iman Anda. Mari bergabung dalam ibadah dan bertumbuh bersama dalam kasih Kristus.') }}</textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Gambar Latar Belakang (Hero Image)</label>
                                @php $currentHero = \App\Models\Setting::get('hero_image'); @endphp
                                @if($currentHero)
                                    <div class="mb-3 w-full max-w-md h-48 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                        <img src="{{ asset('storage/' . $currentHero) }}" class="w-full h-full object-cover" alt="Hero Banner Preview">
                                    </div>
                                @endif
                                <input type="file" name="hero_image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 transition-all">
                                <p class="text-[10px] text-gray-400 mt-1">Format gambar: JPG, PNG, JPEG, WEBP. Maksimal 5MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Social Details -->
                    <div>
                        <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">2. Informasi Kontak &amp; Footer</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="phone" value="{{ \App\Models\Setting::get('phone') }}" placeholder="Contoh: +62 812-3456-7890" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Alamat Email Gereja</label>
                                <input type="email" name="email" value="{{ \App\Models\Setting::get('email') }}" placeholder="Contoh: info@gkipakuwon.or.id" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Alamat Fisik Gereja</label>
                                <textarea name="address" rows="2" placeholder="Tulis alamat lengkap gereja" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">{{ \App\Models\Setting::get('address') }}</textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Link Google Maps (Iframe URL / Share Link)</label>
                                <input type="text" name="maps_link" value="{{ \App\Models\Setting::get('maps_link') }}" placeholder="https://maps.google.com/..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Link Instagram Gereja</label>
                                <input type="text" name="instagram_link" value="{{ \App\Models\Setting::get('instagram_link') }}" placeholder="https://instagram.com/..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Link YouTube Channel</label>
                                <input type="text" name="youtube_link" value="{{ \App\Models\Setting::get('youtube_link') }}" placeholder="https://youtube.com/..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-8 py-5 bg-gray-50/50 border-t border-gray-50 flex items-center gap-3">
                    <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-xs font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">Simpan Pengaturan</button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="bg-rose-50 rounded-3xl border border-rose-100 shadow-sm overflow-hidden mb-12">
            <div class="p-8 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-rose-800 tracking-tight">Hapus Akun</h2>
                    <p class="text-xs text-rose-600/70 font-medium mt-1">Setelah Anda menghapus akun, data Anda tidak dapat dikembalikan. Mohon berhati-hati.</p>
                </div>
                <button class="px-6 py-3 bg-rose-500 text-white rounded-xl text-xs font-bold shadow-lg shadow-rose-500/20 hover:bg-rose-600 transition-all">Hapus Akun Permanen</button>
            </div>
        </div>
    </div>
</div>
@endsection
