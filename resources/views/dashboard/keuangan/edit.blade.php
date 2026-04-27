@extends('dashboard.layouts.app')
@section('title', 'Ubah Data Keuangan')

@section('content')
<x-dashboard.page-header title="Ubah Data Keuangan" subtitle="Perbarui rincian catatan keuangan gereja.">
    <a href="{{ route('dashboard.keuangan.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-500 rounded-xl text-sm font-bold hover:bg-gray-200 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</x-dashboard.page-header>

<div class="max-w-3xl">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30">
            <h2 class="text-lg font-extrabold text-gray-800 tracking-tight">Formulir Ubah Data</h2>
            <p class="text-xs text-gray-400 font-medium mt-1">Pastikan data yang Anda masukkan sudah sesuai dengan catatan fisik.</p>
        </div>

        <form action="{{ route('dashboard.keuangan.index') }}" method="GET" class="p-8">
            <div class="grid grid-cols-1 gap-6">
                @if(request('type') == 'khusus')
                <!-- Field: Nama Keluarga (Only for Persembahan Khusus) -->
                <div>
                    <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Nama Keluarga</label>
                    <input type="text" value="Ama. Yusuf Sihombing / Br. Munthe" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
                
                <!-- Field: Kategori (Only for Persembahan Khusus) -->
                <div>
                    <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Kategori</label>
                    <select class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                        <option selected>Ucapan Syukur</option>
                        <option>Persembahan Bulanan</option>
                    </select>
                </div>
                @endif

                <!-- Field: Keterangan -->
                <div>
                    <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Keterangan</label>
                    <textarea rows="3" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">@if(request('type') == 'diakoni')Partangiangan Sektor @else Pemberian sukarela keluarga @endif</textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Field: Tanggal -->
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Tanggal</label>
                        <input type="date" value="2024-05-08" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>

                    <!-- Field: Nominal -->
                    <div>
                        <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Nominal (Rp)</label>
                        <input type="number" value="80000" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-50 flex items-center gap-4">
                <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl text-xs font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                    Simpan Perubahan
                </button>
                <button type="reset" class="px-8 py-3 bg-gray-50 text-gray-400 rounded-xl text-xs font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
