@extends('dashboard.layouts.app')
@section('title', $type . ' Keluarga')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Data Keluarga" 
    subtitle="Lengkapi informasi kepala keluarga dan dokumen pendukung." 
    backUrl="{{ route('dashboard.keluarga.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 overflow-hidden relative">
    <!-- Decorative background element -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>

    <form action="{{ $type == 'Tambah' ? route('dashboard.keluarga.store') : route('dashboard.keluarga.update', $id ?? '') }}" method="POST" class="max-w-4xl relative z-10" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit')
            @method('PUT')
        @endif
        
        <div class="grid grid-cols-2 gap-10 mb-12">
            <x-form.input label="Nomor Kartu Keluarga (No KK)" name="no_kk" type="text" value="{{ old('no_kk', $keluarga['no_kk'] ?? '') }}" placeholder="16 digit nomor KK..." inputmode="numeric" pattern="\d{16}" minlength="16" maxlength="16" title="Nomor KK harus terdiri dari 16 digit angka." oninput="this.value=this.value.replace(/\D/g,'').slice(0,16)" required />
            <x-form.input label="Nama Keluarga" name="nama" value="{{ old('nama', $keluarga['nama'] ?? '') }}" placeholder="Nama kepala keluarga..." />
            
            <x-form.select label="Sektor" name="sektor">
                <option value="">Pilih Sektor</option>
                @foreach($sektorList as $s)
                    <option value="{{ $s->id }}" {{ old('sektor', $keluarga['sektor'] ?? '') == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                @endforeach
            </x-form.select>

            <div>
                <label class="block mb-2 font-medium text-gray-700 text-sm">Tanggal Pernikahan</label>
                <div class="relative">
                    <span class="pointer-events-auto absolute inset-y-0 left-3 flex items-center text-gray-400 cursor-pointer" onclick="document.getElementById('tanggal_nikah_picker').showPicker?.() || document.getElementById('tanggal_nikah_picker').focus()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 011 1v1h6V3a1 1 0 112 0v1h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 011-1zm11 7H3v7a1 1 0 001 1h12a1 1 0 001-1V9zm-3-3a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input id="tanggal_nikah_display" type="text" value="{{ old('tanggal_nikah', $keluarga['tanggal_nikah'] ?? '') ? \Carbon\Carbon::parse(old('tanggal_nikah', $keluarga['tanggal_nikah'] ?? ''))->format('d / m / Y') : '' }}" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm shadow-sm cursor-pointer" readonly onclick="document.getElementById('tanggal_nikah_picker').showPicker?.() || document.getElementById('tanggal_nikah_picker').focus()" placeholder="Pilih tanggal pernikahan" />
                    <input id="tanggal_nikah_picker" type="date" name="tanggal_nikah" value="{{ old('tanggal_nikah', $keluarga['tanggal_nikah'] ?? '') }}" class="absolute left-0 top-0 w-0 h-0 opacity-0 pointer-events-none" onchange="syncTanggalPernikahan(this.value)" required />
                </div>
                @error('tanggal_nikah')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form.select label="Status" name="status">
                <option value="Aktif" {{ old('status', $keluarga['status'] ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Pindah" {{ old('status', $keluarga['status'] ?? '') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
            </x-form.select>

            <div class="col-span-2">
                <x-form.input label="Alamat Lengkap" name="alamat" value="{{ old('alamat', $keluarga['alamat'] ?? '') }}" placeholder="Jalan, No. Rumah, RT/RW..." />
            </div>

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran (Upload File KK)</label>
                <label class="border-2 border-dashed border-gray-100 rounded-2xl p-6 text-center bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer group relative block">
                    <input id="lampiranInput" type="file" name="lampiran_kk" accept=".png,.jpg,.jpeg,.pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" onchange="handleLampiranPreview(event)">
                    <div id="lampiranPreview" class="flex flex-col items-center justify-center gap-4 {{ !empty($keluarga['lampiran_kk']) && in_array(pathinfo($keluarga['lampiran_kk'], PATHINFO_EXTENSION), ['jpg','jpeg','png']) ? 'has-preview' : '' }}">
                        <div class="relative w-full max-w-full h-40 overflow-hidden rounded-xl bg-white">
                            <img id="lampiranPreviewImage" src="" alt="Preview Lampiran" class="hidden w-full h-full object-contain preview-image" />
                            @if(!empty($keluarga['lampiran_kk']) && in_array(pathinfo($keluarga['lampiran_kk'], PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                                <img id="existingLampiranPreview" src="{{ asset('storage/' . $keluarga['lampiran_kk']) }}" alt="Preview Lampiran" class="w-full h-full object-contain preview-image" />
                            @endif
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none upload-preview-icon">
                                <svg class="w-10 h-10 text-gray-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-gray-400" id="filename_kk">
                            @if(!empty($keluarga['lampiran_kk']))
                                <span class="block">
                                    <a href="{{ asset('storage/' . $keluarga['lampiran_kk']) }}" target="_blank" class="text-primary hover:underline relative z-[60]">Lihat File KK Saat Ini</a>
                                </span>
                                {{ basename($keluarga['lampiran_kk']) }}
                            @else
                                Pilih file atau seret ke sini
                            @endif
                        </p>
                        <p class="text-[10px] text-gray-300 uppercase font-bold tracking-widest">PDF, JPG, PNG (Maks. 2MB)</p>
                        <p id="lampiranError" class="hidden text-sm text-red-600"></p>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                {{ $type == 'Tambah' ? 'Simpan Data' : 'Ubah Data' }}
            </button>
            <button type="reset" class="px-8 py-3.5 bg-gray-50 text-gray-400 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">
                Reset
            </button>
        </div>
    </form>
</div>
<script>
    function syncTanggalPernikahan(value) {
        const display = document.getElementById('tanggal_nikah_display');
        if (!value) {
            display.value = '';
            return;
        }
        const [year, month, day] = value.split('-');
        display.value = `${day} / ${month} / ${year}`;
    }

    function handleLampiranPreview(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('lampiranPreviewImage');
        const existingPreview = document.getElementById('existingLampiranPreview');
        const previewContainer = document.getElementById('lampiranPreview');
        const filenameLabel = document.getElementById('filename_kk');

        const lampiranError = document.getElementById('lampiranError');
        const allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'];

        if (!file) {
            previewImage.classList.add('hidden');
            if (existingPreview) {
                existingPreview.classList.remove('hidden');
            }
            previewContainer.classList.toggle('has-preview', Boolean(existingPreview && !existingPreview.classList.contains('hidden')));
            filenameLabel.textContent = 'Pilih file atau seret ke sini';
            lampiranError.classList.add('hidden');
            lampiranError.textContent = '';
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            document.getElementById('lampiranInput').value = '';
            previewImage.classList.add('hidden');
            if (existingPreview) {
                existingPreview.classList.remove('hidden');
            }
            previewContainer.classList.toggle('has-preview', Boolean(existingPreview && !existingPreview.classList.contains('hidden')));
            filenameLabel.textContent = 'Pilih file atau seret ke sini';
            lampiranError.textContent = 'Tipe file tidak valid. Hanya PNG, JPG, dan PDF yang diizinkan.';
            lampiranError.classList.remove('hidden');
            return;
        }

        lampiranError.classList.add('hidden');
        lampiranError.textContent = '';
        filenameLabel.textContent = file.name;

        if (file.type.startsWith('image/')) {
            if (existingPreview) {
                existingPreview.classList.add('hidden');
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                previewContainer.classList.add('has-preview');
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add('hidden');
            previewContainer.classList.remove('has-preview');
        }
    }
</script>
<style>
    #lampiranPreview.has-preview .upload-preview-icon {
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    label.group:hover #lampiranPreview.has-preview .upload-preview-icon,
    #lampiranPreview.has-preview:hover .upload-preview-icon {
        opacity: 1;
    }
    #lampiranPreview.has-preview .preview-image {
        opacity: 0.45;
        transition: opacity 0.2s ease;
    }
    .upload-preview-icon {
        opacity: 1;
        transition: opacity 0.2s ease;
        z-index: 20;
        background: rgba(255,255,255,0.85);
        border-radius: 9999px;
        padding: 0.5rem;
    }
    .upload-preview-icon svg {
        filter: drop-shadow(0 0 10px rgba(0,0,0,0.1));
    }
</style>
@endsection
