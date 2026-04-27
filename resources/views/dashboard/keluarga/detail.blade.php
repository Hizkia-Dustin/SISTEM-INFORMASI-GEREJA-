@extends('dashboard.layouts.app')
@section('title', 'Detail Keluarga')

@section('content')
<x-dashboard.page-header 
    title="Detail Data Keluarga" 
    subtitle="Informasi kartu keluarga dan daftar anggota jemaat terdaftar." 
    backUrl="{{ route('dashboard.keluarga.index') }}" 
/>

<div class="grid grid-cols-3 gap-10">
    <!-- Family Info Card -->
    <div class="col-span-1">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10 flex flex-col gap-8">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nomor KK</span>
                <span class="text-lg font-extrabold text-gray-800 tracking-wider">3273010101010001</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Keluarga</span>
                <span class="text-lg font-extrabold text-gray-800 tracking-tight">Keluarga Budi Santoso</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sektor</span>
                <span class="text-sm font-bold text-primary">Sektor 1 (Wilayah Pusat)</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat</span>
                <span class="text-sm font-bold text-gray-700 leading-relaxed">Jl. Pakuwon Regency Blok A1 No. 5, Kota Bandung</span>
            </div>
            <div class="pt-8 border-t border-gray-50 flex flex-col gap-3">
                <a href="{{ route('dashboard.keluarga.edit', 1) }}" class="w-full py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah Data Keluarga</a>
                <form action="{{ route('dashboard.keluarga.destroy', 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data keluarga ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3.5 bg-rose-50 text-rose-500 rounded-xl text-sm font-bold hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center gap-2">Hapus Keluarga</button>
                </form>
                <button class="w-full py-3.5 bg-blue-50 text-primary rounded-xl text-sm font-bold hover:bg-blue-100 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Anggota
                </button>
            </div>
        </div>
    </div>

    <!-- Members Table -->
    <div class="col-span-2">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-widest">Daftar Anggota Keluarga</h3>
                <span class="px-3 py-1 bg-white border border-gray-100 rounded-lg text-[10px] font-extrabold text-gray-400 uppercase">5 Orang</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Nama Anggota</th>
                            <th class="px-8 py-4">Hubungan</th>
                            <th class="px-8 py-4">Jenis Kelamin</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-5 font-bold text-gray-700">Budi Santoso</td>
                            <td class="px-8 py-5"><span class="px-2 py-0.5 bg-blue-50 text-primary text-[9px] font-extrabold rounded uppercase">Kepala Keluarga</span></td>
                            <td class="px-8 py-5 text-gray-500 font-medium">Laki-laki</td>
                            <td class="px-8 py-5 text-right"><a href="#" class="text-primary font-bold text-xs hover:underline">Detail</a></td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-5 font-bold text-gray-700">Siti Aminah</td>
                            <td class="px-8 py-5"><span class="px-2 py-0.5 bg-gray-50 text-gray-500 text-[9px] font-extrabold rounded uppercase">Istri</span></td>
                            <td class="px-8 py-5 text-gray-500 font-medium">Perempuan</td>
                            <td class="px-8 py-5 text-right"><a href="#" class="text-primary font-bold text-xs hover:underline">Detail</a></td>
                        </tr>
                        @for($i=1; $i<=3; $i++)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-5 font-bold text-gray-700">Anak Ke-{{ $i }}</td>
                            <td class="px-8 py-5"><span class="px-2 py-0.5 bg-gray-50 text-gray-500 text-[9px] font-extrabold rounded uppercase">Anak</span></td>
                            <td class="px-8 py-5 text-gray-500 font-medium">Laki-laki</td>
                            <td class="px-8 py-5 text-right"><a href="#" class="text-primary font-bold text-xs hover:underline">Detail</a></td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
