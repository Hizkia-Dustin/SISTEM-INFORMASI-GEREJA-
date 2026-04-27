@extends('dashboard.layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')
<x-dashboard.page-header title="Laporan Keuangan" subtitle="Unduh dan cetak laporan arus kas bulanan." />

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center flex flex-col items-center">
    <div class="w-20 h-20 bg-blue-50 text-primary rounded-3xl flex items-center justify-center mb-8 shadow-inner">
        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    </div>
    
    <h3 class="text-xl font-bold text-gray-800 mb-2">Pilih Periode Laporan</h3>
    <p class="text-sm text-gray-400 mb-10 max-w-sm font-medium">Laporan akan dibuat secara otomatis dalam format dokumen yang siap cetak.</p>
    
    <div class="grid grid-cols-2 gap-4 w-full max-w-lg">
        <button class="flex flex-col items-center gap-3 p-6 rounded-2xl border border-gray-50 bg-gray-50/50 hover:bg-white hover:border-emerald-500 hover:shadow-lg hover:shadow-emerald-500/10 transition-all group">
            <div class="w-12 h-12 bg-white text-emerald-500 rounded-xl flex items-center justify-center shadow-sm group-hover:bg-emerald-500 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
            </div>
            <span class="text-sm font-bold text-gray-700">Excel (.xlsx)</span>
        </button>
        <button class="flex flex-col items-center gap-3 p-6 rounded-2xl border border-gray-50 bg-gray-50/50 hover:bg-white hover:border-rose-500 hover:shadow-lg hover:shadow-rose-500/10 transition-all group">
            <div class="w-12 h-12 bg-white text-rose-500 rounded-xl flex items-center justify-center shadow-sm group-hover:bg-rose-500 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
            </div>
            <span class="text-sm font-bold text-gray-700">PDF (.pdf)</span>
        </button>
    </div>
    
    <div class="mt-12 pt-8 border-t border-gray-50 w-full max-w-lg">
        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-4">Laporan Terakhir Diunduh</p>
        <div class="flex items-center justify-between text-xs font-bold text-gray-500 bg-gray-50 px-4 py-3 rounded-xl">
            <span>Laporan_April_2026.pdf</span>
            <span class="text-gray-300">27 Apr 2026</span>
        </div>
    </div>
</div>
@endsection
