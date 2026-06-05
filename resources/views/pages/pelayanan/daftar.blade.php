<x-layouts.main title="Daftar Pelayanan">
    <div class="max-w-3xl mx-auto px-6 py-12 md:py-16">
        <div class="mb-10">
            <a href="{{ route('pelayanan.komisi') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0058bf] mb-6">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Komisi
            </a>
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#00236f] mb-3">Daftar Pelayanan</h1>
            <p class="text-slate-600 leading-relaxed">Isi data pelayanan yang diminati. Pendaftaran akan masuk ke dashboard admin untuk ditinjau dan disetujui.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                <p class="font-bold mb-2">Mohon cek kembali data pendaftaran.</p>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelayanan.daftar.store') }}" method="POST" class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8 space-y-6">
            @csrf
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input name="nama" value="{{ old('nama') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Nama sesuai data jemaat">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">No. Telepon / WhatsApp</label>
                    <input name="no_telepon" value="{{ old('no_telepon') }}" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none" placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none" placeholder="nama@email.com">
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Komisi Tujuan</label>
                    <select name="komisi_tujuan" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none bg-white">
                        @foreach(['Komisi Anak', 'Komisi Remaja', 'Komisi Pemuda', 'Komisi Dewasa', 'Komisi Usia Indah'] as $komisi)
                            <option value="{{ $komisi }}" {{ old('komisi_tujuan', request('komisi')) === $komisi ? 'selected' : '' }}>{{ $komisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Bidang yang Diminati</label>
                    <select name="posisi" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none bg-white">
                        @foreach(['Pengurus Komisi', 'Guru Sekolah Minggu', 'Tim Musik', 'Multimedia', 'Usher', 'Konsumsi', 'Acara & Persekutuan', 'Doa & Perlawatan'] as $posisi)
                            <option value="{{ $posisi }}" {{ old('posisi') === $posisi ? 'selected' : '' }}>{{ $posisi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alasan / Talenta yang Bisa Dilayani</label>
                <textarea name="alasan" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#0058bf] focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Ceritakan singkat pengalaman, minat, atau jadwal yang tersedia...">{{ old('alasan') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#0058bf] text-white font-bold hover:bg-[#00236f] transition-colors">
                    <span class="material-symbols-outlined text-[18px]">send</span>
                    Kirim Pendaftaran
                </button>
                <a href="{{ route('kontak.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-slate-200 text-[#00236f] font-bold hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">forum</span>
                    Hubungi Pengurus
                </a>
            </div>
        </form>
    </div>
</x-layouts.main>
