@extends('dashboard.layouts.app')
@section('title', 'Detail Jemaat')

@section('content')
<x-dashboard.page-header
    title="Detail Data Jemaat"
    subtitle="Informasi lengkap riwayat jemaat, status gerejawi, dan pelayanan."
    backUrl="{{ route('dashboard.jemaat.index') }}"
/>

@php
    $isActive = ($jemaat->status_keanggotaan === 'Aktif' || (string) $jemaat->status_aktif === '1');
    $statusClass = $isActive ? 'bg-blue-50 text-blue-600' : 'bg-gray-100 text-gray-500';
    $riwayatPelayanan = $jemaat->riwayatPelayanan ?? collect();
@endphp

<div class="grid grid-cols-1 xl:grid-cols-[360px_minmax(0,1fr)] gap-8" x-data="{ tab: 'pribadi' }">
    <aside class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-fit">
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
                <h3 class="text-lg font-extrabold text-gray-900 tracking-tight">{{ $jemaat->nama_lengkap ?? '-' }}</h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">NIK: {{ $jemaat->no_induk ?? '-' }}</p>
            </div>

            <div class="flex flex-col gap-4">
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between gap-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Anggota</span>
                    <span class="px-2 py-0.5 {{ $statusClass }} text-[9px] font-extrabold rounded uppercase">{{ $jemaat->status_keanggotaan ?? '-' }}</span>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between gap-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Keluarga (Sektor)</span>
                    <span class="text-xs font-bold text-gray-700 text-right">{{ $jemaat->keluarga ? 'Sektor ' . $jemaat->keluarga->wilayah_pelayanan : '-' }}</span>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between gap-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pelayanan</span>
                    <span class="text-xs font-bold text-primary">{{ $riwayatPelayanan->count() }} riwayat</span>
                </div>
            </div>

            <div class="flex flex-col gap-3 mt-8">
                <a href="{{ route('dashboard.jemaat.edit', $jemaat->id) }}" class="w-full py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah Profil</a>
                <form class="confirm-delete" action="{{ route('dashboard.jemaat.destroy', $jemaat->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data jemaat ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3.5 bg-rose-50 text-rose-500 rounded-xl text-sm font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus Jemaat</button>
                </form>
            </div>
        </div>
    </aside>

    <section class="min-w-0 flex flex-col gap-8">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 lg:p-10">
            <div class="flex flex-wrap items-center gap-6 mb-10 border-b border-gray-100">
                <button type="button" @click="tab = 'pribadi'" class="pb-4 px-2 text-xs font-extrabold uppercase tracking-widest border-b-2 transition-all" :class="tab === 'pribadi' ? 'text-primary border-primary' : 'text-gray-400 border-transparent hover:text-gray-600'">Data Pribadi</button>
                <button type="button" @click="tab = 'gerejawi'" class="pb-4 px-2 text-xs font-extrabold uppercase tracking-widest border-b-2 transition-all" :class="tab === 'gerejawi' ? 'text-primary border-primary' : 'text-gray-400 border-transparent hover:text-gray-600'">Data Gerejawi</button>
                <button type="button" @click="tab = 'pelayanan'" class="pb-4 px-2 text-xs font-extrabold uppercase tracking-widest border-b-2 transition-all" :class="tab === 'pelayanan' ? 'text-primary border-primary' : 'text-gray-400 border-transparent hover:text-gray-600'">Riwayat Pelayanan</button>
            </div>

            <div x-show="tab === 'pribadi'" x-cloak>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <x-jemaat.detail-item label="Tempat, Tanggal Lahir" :value="trim(($jemaat->tempat_lahir ?? '-') . ', ' . ($jemaat->tanggal_lahir ? date('d M Y', strtotime($jemaat->tanggal_lahir)) : '-'))" />
                    <x-jemaat.detail-item label="Jenis Kelamin" :value="$jemaat->jenis_kelamin ?? '-'" />
                    <x-jemaat.detail-item label="Nomor Telepon" :value="$jemaat->no_telepon ?? '-'" />
                    <x-jemaat.detail-item label="Status Pernikahan" :value="$jemaat->status_nikah ?? '-'" />
                    <x-jemaat.detail-item label="Posisi Keluarga" :value="$jemaat->posisi ?? '-'" />
                    <x-jemaat.detail-item label="Username" :value="$jemaat->username ?? '-'" />
                    <div class="md:col-span-2">
                        <x-jemaat.detail-item label="Alamat Lengkap" :value="$jemaat->alamat ?? '-'" />
                    </div>
                </div>
            </div>

            <div x-show="tab === 'gerejawi'" x-cloak>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach([
                        ['label' => 'Baptis', 'value' => $jemaat->baptis, 'file' => $jemaat->lampiran_baptis, 'text' => 'Lihat Lampiran Baptis'],
                        ['label' => 'Sidi', 'value' => $jemaat->sidi, 'file' => $jemaat->lampiran_sidi, 'text' => 'Lihat Lampiran Sidi'],
                    ] as $item)
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $item['label'] }}</span>
                                <span class="px-2 py-0.5 {{ ($item['value'] === 'Ya') ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-600' }} text-[9px] font-extrabold rounded uppercase">
                                    {{ $item['value'] === 'Ya' ? 'Sudah' : 'Belum' }}
                                </span>
                            </div>
                            @if(!empty($item['file']))
                                <a href="{{ asset('storage/' . $item['file']) }}" target="_blank" rel="noopener" class="text-xs font-bold text-primary hover:underline flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">attach_file</span>
                                    {{ $item['text'] }}
                                </a>
                            @else
                                <p class="text-sm text-gray-400 font-medium">Belum ada lampiran.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div x-show="tab === 'pelayanan'" x-cloak>
                <div class="grid grid-cols-1 2xl:grid-cols-[minmax(0,1fr)_360px] gap-8">
                    <div class="min-w-0">
                        <div class="flex items-center justify-between gap-4 mb-5">
                            <h3 class="text-sm font-extrabold text-primary uppercase tracking-widest">Daftar Riwayat Pelayanan</h3>
                            <span class="text-xs font-bold text-gray-400">{{ $riwayatPelayanan->count() }} catatan</span>
                        </div>

                        @if($riwayatPelayanan->isEmpty())
                            <div class="min-h-56 rounded-2xl border border-dashed border-gray-200 bg-gray-50 flex items-center justify-center text-center px-6">
                                <p class="text-sm font-semibold text-gray-400">Belum ada riwayat pelayanan untuk jemaat ini.</p>
                            </div>
                        @else
                            <div class="flex flex-col gap-4">
                                @foreach($riwayatPelayanan as $history)
                                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                            <div>
                                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                                    <h4 class="text-base font-extrabold text-gray-900">{{ $history->bidang_pelayanan }}</h4>
                                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $history->status === 'Aktif' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-600' }}">{{ $history->status }}</span>
                                                </div>
                                                <p class="text-sm font-bold text-gray-600">{{ $history->peran ?: 'Pelayan' }}</p>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $history->periode_mulai ? date('d M Y', strtotime($history->periode_mulai)) : 'Tanggal mulai belum diisi' }}
                                                    -
                                                    {{ $history->periode_selesai ? date('d M Y', strtotime($history->periode_selesai)) : 'Sekarang' }}
                                                </p>
                                            </div>
                                            <form class="confirm-delete" action="{{ route('dashboard.jemaat.riwayat-pelayanan.destroy', [$jemaat->id, $history->id]) }}" method="POST" data-confirm="Hapus riwayat pelayanan ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 rounded-xl bg-white text-rose-500 text-xs font-bold border border-rose-100 hover:bg-rose-50 transition-all">Hapus</button>
                                            </form>
                                        </div>
                                        @if($history->keterangan)
                                            <p class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-500 leading-relaxed">{{ $history->keterangan }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('dashboard.jemaat.riwayat-pelayanan.store', $jemaat->id) }}" method="POST" class="bg-gray-50 rounded-2xl border border-gray-100 p-6 h-fit">
                        @csrf
                        <h3 class="text-sm font-extrabold text-gray-900 mb-5">Tambah Riwayat</h3>
                        <div class="flex flex-col gap-4">
                            <x-form.input label="Bidang Pelayanan" name="bidang_pelayanan" value="{{ old('bidang_pelayanan') }}" placeholder="Contoh: Musik, Singer, Multimedia" />
                            <x-form.input label="Peran" name="peran" value="{{ old('peran') }}" placeholder="Contoh: Keyboardis, WL, Operator" />
                            <div class="grid grid-cols-2 gap-4">
                                <x-form.input label="Mulai" name="periode_mulai" type="date" value="{{ old('periode_mulai') }}" />
                                <x-form.input label="Selesai" name="periode_selesai" type="date" value="{{ old('periode_selesai') }}" />
                            </div>
                            <x-form.select label="Status" name="status">
                                <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Nonaktif" {{ old('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </x-form.select>
                            <div>
                                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Keterangan</label>
                                <textarea name="keterangan" rows="4" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Catatan jadwal, komisi, atau keterangan pelayanan">{{ old('keterangan') }}</textarea>
                            </div>
                            <button type="submit" class="w-full py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">Simpan Riwayat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
