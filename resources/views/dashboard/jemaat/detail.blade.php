@extends('dashboard.layouts.app')
@section('title', 'Detail Jemaat')

@section('content')
<x-dashboard.page-header 
    title="Detail Data Jemaat" 
    subtitle="Informasi lengkap riwayat jemaat dan status gerejawi." 
    backUrl="{{ route('dashboard.jemaat.index') }}" 
/>

<div class="grid grid-cols-3 gap-10">
    <!-- Profile Card -->
    <div class="col-span-1">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="h-24 bg-primary"></div>
            <div class="px-8 pb-8">
                <div class="-mt-12 mb-6 flex justify-center">
                    <div class="w-24 h-24 bg-white rounded-2xl p-1 shadow-lg shadow-primary/10">
                        @if(!empty($jemaat->foto_profil))
                            <img src="{{ asset('storage/' . $jemaat->foto_profil) }}" alt="{{ $jemaat->nama_lengkap }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="w-full h-full bg-blue-50 rounded-xl flex items-center justify-center text-primary font-bold text-2xl uppercase">
                                {{ substr($jemaat->nama_lengkap ?? 'A', 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-lg font-extrabold text-gray-800 tracking-tight">{{ $jemaat->nama_lengkap ?? '-' }}</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">NIK: {{ $jemaat->no_induk ?? '-' }}</p>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Anggota</span>
                        <span class="px-2 py-0.5 {{ ($jemaat->status_keanggotaan == 'Aktif' || $jemaat->status_aktif == '1') ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }} text-[9px] font-extrabold rounded uppercase">{{ $jemaat->status_keanggotaan ?? 'Tidak Diketahui' }}</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Keluarga (Sektor)</span>
                        <span class="text-xs font-bold text-gray-700">{{ $jemaat->keluarga ? 'Sektor ' . $jemaat->keluarga->wilayah_pelayanan : '-' }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-3 mt-8">
                    <a href="{{ route('dashboard.jemaat.edit', $jemaat->id) }}" class="w-full py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah Profil</a>
                    <form class="confirm-delete" action="{{ route('dashboard.jemaat.destroy', $jemaat->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data jemaat ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3.5 bg-rose-50 text-rose-500 rounded-xl text-sm font-bold hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center gap-2">Hapus Jemaat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tabs & Details -->
    <div class="col-span-2 flex flex-col gap-8">
        <!-- Tabs -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
            <div class="flex items-center gap-8 mb-10 border-b border-gray-50">
                <button class="pb-4 px-2 text-xs font-extrabold text-primary border-b-2 border-primary uppercase tracking-widest">Data Pribadi</button>
                <button class="pb-4 px-2 text-xs font-extrabold text-gray-400 hover:text-gray-600 border-b-2 border-transparent uppercase tracking-widest transition-all">Data Gerejawi</button>
                <button class="pb-4 px-2 text-xs font-extrabold text-gray-400 hover:text-gray-600 border-b-2 border-transparent uppercase tracking-widest transition-all">Riwayat Pelayanan</button>
            </div>

            <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tempat, Tanggal Lahir</span>
                    <span class="text-sm font-bold text-gray-700">{{ $jemaat->tempat_lahir ?? '-' }}, {{ $jemaat->tanggal_lahir ? date('d M Y', strtotime($jemaat->tanggal_lahir)) : '-' }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jenis Kelamin</span>
                    <span class="text-sm font-bold text-gray-700">{{ $jemaat->jenis_kelamin ?? '-' }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nomor Telepon</span>
                    <span class="text-sm font-bold text-gray-700">{{ $jemaat->no_telepon ?? '-' }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pernikahan</span>
                    <span class="text-sm font-bold text-gray-700">{{ $jemaat->status_nikah ?? '-' }}</span>
                </div>
                <div class="col-span-2 flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat Lengkap</span>
                    <span class="text-sm font-bold text-gray-700">{{ $jemaat->alamat ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Church Info (Visible in another tab or below) -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
            <h3 class="text-xs font-bold text-primary uppercase tracking-widest mb-8 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Status Gerejawi
            </h3>
            <div class="grid grid-cols-2 gap-10">
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Baptis</span>
                        <span class="px-2 py-0.5 {{ ($jemaat->baptis == 'Ya') ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600' }} text-[9px] font-extrabold rounded uppercase tracking-tighter">{{ $jemaat->baptis == 'Ya' ? 'Sudah' : 'Belum' }}</span>
                    </div>
                    @if(!empty($jemaat->lampiran_baptis))
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <button type="button" onclick="openLampiranModal('{{ asset('storage/' . $jemaat->lampiran_baptis) }}')" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            Lihat Lampiran Baptis
                        </button>
                    </div>
                    @endif
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sidi</span>
                        <span class="px-2 py-0.5 {{ ($jemaat->sidi == 'Ya') ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600' }} text-[9px] font-extrabold rounded uppercase tracking-tighter">{{ $jemaat->sidi == 'Ya' ? 'Sudah' : 'Belum' }}</span>
                    </div>
                    @if(!empty($jemaat->lampiran_sidi))
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <button type="button" onclick="openLampiranModal('{{ asset('storage/' . $jemaat->lampiran_sidi) }}')" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            Lihat Lampiran Sidi
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div id="lampiranModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="relative w-full max-w-3xl rounded-3xl overflow-hidden bg-white shadow-2xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-bold text-gray-700">Preview Lampiran</h3>
            <button type="button" onclick="closeLampiranModal()" class="text-gray-400 hover:text-gray-700 transition-all">✕</button>
        </div>
        <div class="p-4 bg-gray-50 flex items-center justify-center min-h-[320px]">
            <img id="lampiranModalImage" src="" alt="Preview Lampiran" class="max-h-[600px] w-full object-contain" />
        </div>
    </div>
</div>

<script>
    function openLampiranModal(src) {
        const modal = document.getElementById('lampiranModal');
        const img = document.getElementById('lampiranModalImage');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLampiranModal() {
        const modal = document.getElementById('lampiranModal');
        const img = document.getElementById('lampiranModalImage');
        img.src = '';
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLampiranModal();
        }
    });

    document.getElementById('lampiranModal').addEventListener('click', function(event) {
        if (event.target.id === 'lampiranModal') {
            closeLampiranModal();
        }
    });
</script>
@endsection
