<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'keluarga' => \App\Models\Keluarga::count(),
            'pemuda' => \App\Models\Jemaat::where('status_keanggotaan', 'Pemuda')->count(),
            'ama' => \App\Models\Jemaat::whereIn('jenis_kelamin', ['Laki-laki', 'L', 'Laki-Laki'])->count(),
            'ina' => \App\Models\Jemaat::whereIn('jenis_kelamin', ['Perempuan', 'P'])->count(),
            'aktif' => \App\Models\Jemaat::where('status_aktif', true)->orWhere('status_aktif', '1')->count(),
        ];

        $sektors = \App\Models\Keluarga::whereNotNull('wilayah_pelayanan')->get()->groupBy('wilayah_pelayanan');
        $sektorLabels = [];
        $sektorData = [];
        foreach($sektors as $sektor => $keluargas) {
            $sektorLabels[] = $sektor;
            $sektorData[] = $keluargas->count();
        }

        $jemaatTerbaru = [];

        $kategorialLabels = [];
        $kategorialData = [];

        $recentActivities = [];

        return view('dashboard.home.index', compact('stats', 'sektorLabels', 'sektorData', 'kategorialLabels', 'kategorialData', 'recentActivities', 'jemaatTerbaru'));
    }

    // 2. Keluarga
    public function keluarga() 
    { 
        $query = \App\Models\Keluarga::query();
        if (request('status') == 'tidak_aktif') {
            $query->whereIn('status', ['Pindah', 'Meninggal']);
        } else {
            $query->where(function($q) {
                $q->where('status', 'Aktif')->orWhereNull('status');
            });
        }
        $keluarga = $query->get();
        return view('dashboard.keluarga.index', compact('keluarga')); 
    }
    public function createKeluarga() { 
        $sektorList = \App\Models\Sektor::all();
        return view('dashboard.keluarga.form', ['type' => 'Tambah', 'keluarga' => [], 'sektorList' => $sektorList]); 
    }
    public function storeKeluarga(Request $request) 
    {
        $messages = [
            'required' => 'Ada yang belum diisi dan harus diisi.',
            'numeric' => 'Bagian ini hanya dapat diisi dengan angka.',
            'digits' => 'Nomor KK harus terdiri dari tepat 16 digit angka.',
            'mimes' => 'Lampiran harus berupa file PNG, JPG, atau PDF.',
            'max' => 'Ukuran file lampiran tidak boleh lebih dari 2MB.',
        ];

        $validated = $request->validate([
            'no_kk' => 'required|digits:16',
            'nama' => 'required|string',
            'sektor' => 'required|string',
            'tanggal_nikah' => 'required|date',
            'status' => 'required|string',
            'alamat' => 'required|string',
            'lampiran_kk' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
        ], $messages);

        $data = [
            'no_kk' => $validated['no_kk'],
            'nama_kepala_keluarga' => $validated['nama'],
            'wilayah_pelayanan' => $validated['sektor'],
            'tanggal_registrasi' => $validated['tanggal_nikah'], // Or handle this differently if tanggal_registrasi means something else
            'status' => $validated['status'],
            'alamat_keluarga' => $validated['alamat'],
        ];

        if ($request->hasFile('lampiran_kk')) {
            $data['lampiran_kk'] = $request->file('lampiran_kk')->store('uploads/keluarga', 'public');
        }

        \App\Models\Keluarga::create($data);
        return redirect()->route('dashboard.keluarga.index')->with('success', 'Data keluarga berhasil ditambahkan.');
    }

    public function showKeluarga($id) { 
        $keluarga = \App\Models\Keluarga::findOrFail($id);
        return view('dashboard.keluarga.detail', compact('keluarga')); 
    }
    
    public function editKeluarga($id) { 
        $keluargaModel = \App\Models\Keluarga::findOrFail($id);
        $keluarga = [
            'id' => $keluargaModel->id,
            'no_kk' => $keluargaModel->no_kk,
            'nama' => $keluargaModel->nama_kepala_keluarga,
            'sektor' => $keluargaModel->wilayah_pelayanan,
            'tanggal_nikah' => $keluargaModel->tanggal_registrasi,
            'status' => $keluargaModel->status,
            'alamat' => $keluargaModel->alamat_keluarga,
        ];
        $sektorList = \App\Models\Sektor::all();
        return view('dashboard.keluarga.form', ['type' => 'Edit', 'id' => $id, 'keluarga' => $keluarga, 'sektorList' => $sektorList]); 
    }

    public function updateKeluarga(Request $request, $id) 
    {
        $messages = [
            'required' => 'Ada yang belum diisi dan harus diisi.',
            'digits' => 'Nomor KK harus terdiri dari tepat 16 digit angka.',
            'mimes' => 'Lampiran harus berupa file PNG, JPG, atau PDF.',
            'max' => 'Ukuran file lampiran tidak boleh lebih dari 2MB.',
        ];

        $validated = $request->validate([
            'no_kk' => 'required|digits:16',
            'nama' => 'required|string',
            'sektor' => 'required|string',
            'tanggal_nikah' => 'required|date',
            'status' => 'required|string',
            'alamat' => 'required|string',
            'lampiran_kk' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
        ], $messages);

        $keluarga = \App\Models\Keluarga::findOrFail($id);
        $data = [
            'nama_kepala_keluarga' => $validated['nama'],
            'wilayah_pelayanan' => $validated['sektor'],
            'tanggal_registrasi' => $validated['tanggal_nikah'],
            'status' => $validated['status'],
            'alamat_keluarga' => $validated['alamat'],
        ];

        if ($request->hasFile('lampiran_kk')) {
            $data['lampiran_kk'] = $request->file('lampiran_kk')->store('uploads/keluarga', 'public');
        }

        $keluarga->update($data);

        return redirect()->route('dashboard.keluarga.index')->with('success', 'Data keluarga berhasil diperbarui.');
    }

    public function destroyKeluarga($id) { 
        \App\Models\Keluarga::destroy($id);
        return redirect()->back()->with('success', 'Data keluarga berhasil dihapus.'); 
    }

    // 3. Jemaat
    public function jemaat() 
    { 
        $query = \App\Models\Jemaat::query();
        if (request('status') == 'tidak_aktif') {
            $query->whereIn('status_keanggotaan', ['Tidak Aktif', 'Pindah']);
        } else {
            $query->where(function($q) {
                $q->where('status_keanggotaan', 'Aktif')->orWhereNull('status_keanggotaan');
            });
        }
        $jemaat = $query->get();
        return view('dashboard.jemaat.index', compact('jemaat')); 
    }
    public function createJemaat() { 
        $keluargaList = \App\Models\Keluarga::all();
        return view('dashboard.jemaat.form', ['type' => 'Tambah', 'jemaat' => [], 'keluargaList' => $keluargaList]); 
    }

    public function storeJemaat(Request $request) 
    {
        $messages = [
            'required' => 'Ada yang belum diisi dan harus diisi.',
            'numeric' => 'Bagian ini hanya dapat diisi dengan angka.',
            'no_induk.digits' => 'NIK harus terdiri dari 16 digit.',
        ];

        $request->validate([
            'no_induk' => 'required|digits:16',
            'nama_lengkap' => 'required|string',
            'no_telepon' => 'required|numeric',
            'username' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'posisi' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status_keanggotaan' => 'required|string',
            'status_nikah' => 'required|string',
            'baptis' => 'required|string',
            'sidi' => 'required|string',
            'alamat' => 'required|string',
        ], $messages);

        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('uploads/jemaat/foto', 'public');
        }
        if ($request->hasFile('lampiran_baptis')) {
            $data['lampiran_baptis'] = $request->file('lampiran_baptis')->store('uploads/jemaat/baptis', 'public');
        }
        if ($request->hasFile('lampiran_sidi')) {
            $data['lampiran_sidi'] = $request->file('lampiran_sidi')->store('uploads/jemaat/sidi', 'public');
        }

        \App\Models\Jemaat::create($data);
        return redirect()->route('dashboard.jemaat.index')->with('success', 'Data jemaat berhasil ditambahkan.');
    }

    public function showJemaat($id) { 
        $jemaat = \App\Models\Jemaat::findOrFail($id);
        return view('dashboard.jemaat.detail', compact('jemaat')); 
    }
    
    public function editJemaat($id) { 
        $jemaat = \App\Models\Jemaat::findOrFail($id);
        $keluargaList = \App\Models\Keluarga::all();
        return view('dashboard.jemaat.form', ['type' => 'Edit', 'id' => $id, 'jemaat' => $jemaat, 'keluargaList' => $keluargaList]); 
    }

    public function updateJemaat(Request $request, $id) 
    {
        $messages = [
            'required' => 'Ada yang belum diisi dan harus diisi.',
            'numeric' => 'Bagian ini hanya dapat diisi dengan angka.',
            'no_induk.digits' => 'NIK harus terdiri dari 16 digit.',
        ];

        $request->validate([
            'no_induk' => 'required|digits:16',
            'nama_lengkap' => 'required|string',
            'no_telepon' => 'required|numeric',
            'username' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'posisi' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status_keanggotaan' => 'required|string',
            'status_nikah' => 'required|string',
            'baptis' => 'required|string',
            'sidi' => 'required|string',
            'alamat' => 'required|string',
        ], $messages);

        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('uploads/jemaat/foto', 'public');
        }
        if ($request->hasFile('lampiran_baptis')) {
            $data['lampiran_baptis'] = $request->file('lampiran_baptis')->store('uploads/jemaat/baptis', 'public');
        }
        if ($request->hasFile('lampiran_sidi')) {
            $data['lampiran_sidi'] = $request->file('lampiran_sidi')->store('uploads/jemaat/sidi', 'public');
        }

        $jemaat = \App\Models\Jemaat::findOrFail($id);
        $jemaat->update($data);

        return redirect()->route('dashboard.jemaat.index')->with('success', 'Data jemaat berhasil diperbarui.');
    }

    public function destroyJemaat($id) { 
        \App\Models\Jemaat::destroy($id);
        return redirect()->back()->with('success', 'Data jemaat berhasil dihapus.'); 
    }

    // 4. Sektor
    public function sektor(Request $request) 
    { 
        $sektors = \App\Models\Sektor::latest()->get();
        $selectedSektorId = $request->query('sektor_id');

        $anggotaJemaat = [];
        if ($selectedSektorId) {
            $keluargaIds = \App\Models\Keluarga::where('wilayah_pelayanan', $selectedSektorId)->pluck('id')->toArray();
            $anggotaJemaat = \App\Models\Jemaat::whereIn('keluarga_id', $keluargaIds)->get();
        }

        return view('dashboard.sektor.index', compact('sektors', 'selectedSektorId', 'anggotaJemaat')); 
    }
    public function createSektor() 
    { 
        return view('dashboard.sektor.form', ['type' => 'Tambah', 'sektor' => new \App\Models\Sektor()]); 
    }
    public function storeSektor(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        \App\Models\Sektor::create($data);
        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil ditambahkan.');
    }
    public function editSektor($id) 
    { 
        $sektor = \App\Models\Sektor::findOrFail($id);
        return view('dashboard.sektor.form', ['type' => 'Edit', 'sektor' => $sektor]); 
    }
    public function updateSektor(Request $request, $id)
    {
        $sektor = \App\Models\Sektor::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        $sektor->update($data);
        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil diperbarui.');
    }
    public function destroySektor($id) 
    { 
        \App\Models\Sektor::destroy($id);
        return redirect()->back()->with('success', 'Sektor berhasil dihapus.'); 
    }

    // 5. Keuangan
    public function keuangan() 
    { 
        $keuangan = \App\Models\Keuangan::latest()->get();
        return view('dashboard.keuangan.index', compact('keuangan')); 
    }
    public function createKeuangan() 
    { 
        return view('dashboard.keuangan.form', ['type' => 'Tambah', 'keuangan' => new \App\Models\Keuangan()]); 
    }
    public function storeKeuangan(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        \App\Models\Keuangan::create($data);
        return redirect()->route('dashboard.keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan.');
    }
    public function editKeuangan($id) 
    { 
        $keuangan = \App\Models\Keuangan::findOrFail($id);
        return view('dashboard.keuangan.form', ['type' => 'Edit', 'keuangan' => $keuangan]); 
    }
    public function updateKeuangan(Request $request, $id)
    {
        $keuangan = \App\Models\Keuangan::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        $keuangan->update($data);
        return redirect()->route('dashboard.keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }
    public function laporanKeuangan() { return view('dashboard.keuangan.laporan'); }
    public function destroyKeuangan($id) 
    { 
        \App\Models\Keuangan::destroy($id);
        return redirect()->back()->with('success', 'Data keuangan berhasil dihapus.'); 
    }

    // 6. Pelayan
    public function pelayan() 
    { 
        $pelayan = \App\Models\Pelayan::latest()->get();
        return view('dashboard.pelayan.index', compact('pelayan')); 
    }
    public function createPelayan() 
    { 
        return view('dashboard.pelayan.form', ['type' => 'Tambah', 'pelayan' => new \App\Models\Pelayan()]); 
    }
    public function storePelayan(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/pelayan', 'public');
        }
        \App\Models\Pelayan::create($data);
        return redirect()->route('dashboard.pelayan.index')->with('success', 'Data pelayan berhasil ditambahkan.');
    }
    public function editPelayan($id) 
    { 
        $pelayan = \App\Models\Pelayan::findOrFail($id);
        return view('dashboard.pelayan.form', ['type' => 'Edit', 'pelayan' => $pelayan]); 
    }
    public function updatePelayan(Request $request, $id)
    {
        $pelayan = \App\Models\Pelayan::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/pelayan', 'public');
        }
        $pelayan->update($data);
        return redirect()->route('dashboard.pelayan.index')->with('success', 'Data pelayan berhasil diperbarui.');
    }
    public function destroyPelayan($id) 
    { 
        \App\Models\Pelayan::destroy($id);
        return redirect()->back()->with('success', 'Data pelayan berhasil dihapus.'); 
    }

    // 7. Renungan
    public function renungan() { 
        $renungan = \App\Models\Renungan::latest()->get();
        return view('dashboard.renungan.index', compact('renungan')); 
    }
    public function createRenungan() { return view('dashboard.renungan.form', ['type' => 'Tambah', 'renungan' => new \App\Models\Renungan()]); }
    public function storeRenungan(\Illuminate\Http\Request $request) 
    {
        $data = $request->except(['_token', '_method']);
        \App\Models\Renungan::create($data);
        return redirect()->route('dashboard.renungan.index')->with('success', 'Renungan berhasil ditambahkan.');
    }
    public function editRenungan($id) { 
        $renungan = \App\Models\Renungan::findOrFail($id);
        return view('dashboard.renungan.form', ['type' => 'Edit', 'renungan' => $renungan]); 
    }
    public function updateRenungan(\Illuminate\Http\Request $request, $id) 
    {
        $renungan = \App\Models\Renungan::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        $renungan->update($data);
        return redirect()->route('dashboard.renungan.index')->with('success', 'Renungan berhasil diperbarui.');
    }
    public function destroyRenungan($id) { 
        \App\Models\Renungan::destroy($id);
        return redirect()->back()->with('success', 'Renungan berhasil dihapus.'); 
    }

    // 8. Jadwal Ibadah
    public function jadwal() 
    { 
        $jadwal = \App\Models\Jadwal::latest()->get();
        return view('dashboard.jadwal.index', compact('jadwal')); 
    }
    public function createJadwal() { return view('dashboard.jadwal.form', ['type' => 'Tambah', 'jadwal' => new \App\Models\Jadwal()]); }
    
    public function storeJadwal(\Illuminate\Http\Request $request) 
    {
        $request->validate([
            'lampiran' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('uploads/jadwal', 'public');
        }
        
        \App\Models\Jadwal::create($data);
        return redirect()->route('dashboard.jadwal.index')->with('success', 'Jadwal ibadah berhasil ditambahkan.');
    }

    public function editJadwal($id) { 
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        return view('dashboard.jadwal.form', ['type' => 'Edit', 'jadwal' => $jadwal]); 
    }
    
    public function updateJadwal(\Illuminate\Http\Request $request, $id) 
    {
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        
        $request->validate([
            'lampiran' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('uploads/jadwal', 'public');
        }
        
        $jadwal->update($data);
        return redirect()->route('dashboard.jadwal.index')->with('success', 'Jadwal ibadah berhasil diperbarui.');
    }

    public function destroyJadwal($id) { 
        \App\Models\Jadwal::destroy($id);
        return redirect()->back()->with('success', 'Jadwal ibadah berhasil dihapus.'); 
    }

    // 9. Jadwal Pelayanan (Tugas)
    public function tugas() { return view('dashboard.tugas.index'); }
    public function createTugas() { return view('dashboard.tugas.form', ['type' => 'Tambah']); }
    public function editTugas($id) { return view('dashboard.tugas.form', ['type' => 'Edit']); }
    public function destroyTugas($id) { return redirect()->back()->with('success', 'Jadwal pelayanan berhasil dihapus.'); }

    // 10. Program Kerja
    public function programKerja() 
    { 
        $program = \App\Models\ProgramKerja::latest()->get();
        return view('dashboard.program_kerja.index', compact('program')); 
    }
    
    public function createProgramKerja() 
    { 
        return view('dashboard.program_kerja.form', ['type' => 'Tambah', 'program_kerja' => new \App\Models\ProgramKerja()]); 
    }

    public function storeProgramKerja(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('uploads/program_kerja', 'public');
        }
        
        \App\Models\ProgramKerja::create($data);
        return redirect()->route('dashboard.program_kerja.index')->with('success', 'Program kerja berhasil ditambahkan.');
    }
    
    public function editProgramKerja($id) 
    { 
        $program_kerja = \App\Models\ProgramKerja::findOrFail($id);
        return view('dashboard.program_kerja.form', ['type' => 'Edit', 'program_kerja' => $program_kerja]); 
    }

    public function updateProgramKerja(Request $request, $id)
    {
        $program_kerja = \App\Models\ProgramKerja::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('uploads/program_kerja', 'public');
        }
        
        $program_kerja->update($data);
        return redirect()->route('dashboard.program_kerja.index')->with('success', 'Program kerja berhasil diperbarui.');
    }
    
    public function destroyProgramKerja($id) 
    { 
        \App\Models\ProgramKerja::destroy($id);
        return redirect()->back()->with('success', 'Program kerja berhasil dihapus.'); 
    }

    // 11. Berita
    public function berita() 
    { 
        $berita = \App\Models\Berita::latest()->get();
        return view('dashboard.berita.index', compact('berita')); 
    }
    
    public function createBerita() 
    { 
        return view('dashboard.berita.form', ['type' => 'Tambah', 'berita' => new \App\Models\Berita()]); 
    }

    public function storeBerita(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/berita', 'public');
        }
        
        \App\Models\Berita::create($data);
        return redirect()->route('dashboard.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    
    public function showBerita($id) 
    { 
        $berita = \App\Models\Berita::findOrFail($id);
        return view('dashboard.berita.detail', compact('berita')); 
    }
    
    public function editBerita($id) 
    { 
        $berita = \App\Models\Berita::findOrFail($id);
        return view('dashboard.berita.form', ['type' => 'Edit', 'berita' => $berita]); 
    }

    public function updateBerita(Request $request, $id)
    {
        $berita = \App\Models\Berita::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/berita', 'public');
        }
        
        $berita->update($data);
        return redirect()->route('dashboard.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }
    
    public function destroyBerita($id) 
    { 
        \App\Models\Berita::destroy($id);
        return redirect()->back()->with('success', 'Berita berhasil dihapus.'); 
    }

    // Warta
    public function warta() 
    { 
        $warta = \App\Models\Warta::latest()->get();
        return view('dashboard.warta.index', compact('warta')); 
    }
    
    public function createWarta() 
    { 
        return view('dashboard.warta.form', ['type' => 'Tambah', 'warta' => new \App\Models\Warta()]); 
    }

    public function storeWarta(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/warta', 'public');
        }
        
        \App\Models\Warta::create($data);
        return redirect()->route('dashboard.warta.index')->with('success', 'Warta berhasil ditambahkan.');
    }
    
    public function showWarta($id) 
    { 
        $warta = \App\Models\Warta::findOrFail($id);
        return view('dashboard.warta.detail', compact('warta')); 
    }
    
    public function editWarta($id) 
    { 
        $warta = \App\Models\Warta::findOrFail($id);
        return view('dashboard.warta.form', ['type' => 'Edit', 'warta' => $warta]); 
    }

    public function updateWarta(Request $request, $id)
    {
        $warta = \App\Models\Warta::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/warta', 'public');
        }
        
        $warta->update($data);
        return redirect()->route('dashboard.warta.index')->with('success', 'Warta berhasil diperbarui.');
    }
    
    public function destroyWarta($id) 
    { 
        \App\Models\Warta::destroy($id);
        return redirect()->back()->with('success', 'Warta berhasil dihapus.'); 
    }

    // 12. Artikel
    public function artikel() 
    { 
        $artikel = \App\Models\Artikel::latest()->get();
        return view('dashboard.artikel.index', compact('artikel')); 
    }
    
    public function createArtikel() 
    { 
        return view('dashboard.artikel.form', ['type' => 'Tambah', 'artikel' => new \App\Models\Artikel()]); 
    }

    public function storeArtikel(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/artikel', 'public');
        }
        
        \App\Models\Artikel::create($data);
        return redirect()->route('dashboard.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }
    
    public function showArtikel($id) 
    { 
        $artikel = \App\Models\Artikel::findOrFail($id);
        return view('dashboard.artikel.detail', compact('artikel')); 
    }
    
    public function editArtikel($id) 
    { 
        $artikel = \App\Models\Artikel::findOrFail($id);
        return view('dashboard.artikel.form', ['type' => 'Edit', 'artikel' => $artikel]); 
    }

    public function updateArtikel(Request $request, $id)
    {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/artikel', 'public');
        }
        
        $artikel->update($data);
        return redirect()->route('dashboard.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }
    
    public function destroyArtikel($id) 
    { 
        \App\Models\Artikel::destroy($id);
        return redirect()->back()->with('success', 'Artikel berhasil dihapus.'); 
    }

    // Extra
    public function profil() { 
        $user = auth()->user();
        return view('dashboard.profile.index', compact('user')); 
    }
    
    public function editProfil() { 
        $user = auth()->user();
        return view('dashboard.profile.form', compact('user')); 
    }
    
    public function updateProfil(Request $request) { 
        $user = auth()->user();
        $messages = [
            'required' => 'Ada yang belum diisi dan harus diisi.',
            'numeric' => 'Bagian ini hanya dapat diisi dengan angka.',
        ];

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'no_induk' => 'nullable|numeric',
            'username' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'alamat' => 'nullable|string',
            'status_anggota' => 'nullable|string',
            'status_pernikahan' => 'nullable|string',
            'tanggal_baptis' => 'nullable|date',
            'tanggal_sidi' => 'nullable|date',
            'sektor' => 'nullable|string',
        ], $messages);
        
        $data = $validated;
        
        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('uploads/admin', 'public');
        }
        
        // Use Model->update to avoid issues with MongoDB update syntax
        $userModel = \App\Models\User::find($user->id);
        $userModel->update($data);
        
        return redirect()->route('dashboard.profil')->with('success', 'Profil berhasil diperbarui.');
    }
    public function settings() { 
        $user = auth()->user();
        $admins = \App\Models\User::all();
        return view('dashboard.settings.index', compact('user', 'admins')); 
    }
    public function createAdmin() { return view('dashboard.settings.admin_form', ['type' => 'Tambah']); }
    public function storeAdmin(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        \App\Models\User::create($validated);
        
        return redirect()->route('dashboard.settings')->with('success', 'Admin baru berhasil ditambahkan.');
    }
    public function editAdmin($id) { 
        $admin = \App\Models\User::findOrFail($id);
        return view('dashboard.settings.admin_form', ['type' => 'Edit', 'id' => $id, 'admin' => $admin]); 
    }
    public function updateAdmin(Request $request, $id) 
    {
        $admin = \App\Models\User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'password' => 'nullable|min:8|confirmed'
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $admin->update($validated);
        return redirect()->route('dashboard.settings')->with('success', 'Data admin berhasil diperbarui.');
    }
    public function destroyAdmin($id) { 
        if ($id == auth()->user()->id) {
            return redirect()->back()->withErrors(['Hapus Gagal' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }
        $admin = \App\Models\User::findOrFail($id);
        $admin->delete();
        return redirect()->back()->with('success', 'Akun administrator berhasil dihapus.'); 
    }
    public function komisi() 
    { 
        $komisi = [];
        return view('dashboard.komisi.index', compact('komisi')); 
    }
    public function createKomisi() { return view('dashboard.komisi.form', ['type' => 'Tambah']); }
    public function editKomisi($id) { return view('dashboard.komisi.form', ['type' => 'Edit']); }
    public function destroyKomisi($id) { return redirect()->back()->with('success', 'Komisi berhasil dihapus.'); }

    // Racakitri
    public function racakitri() { 
        $data = \App\Models\Racakitri::latest()->get();
        return view('dashboard.racakitri.index', ['racakitri' => $data]); 
    }
    public function createRacakitri() { return view('dashboard.racakitri.form', ['type' => 'Tambah', 'racakitri' => new \App\Models\Racakitri()]); }
    public function storeRacakitri(\Illuminate\Http\Request $request) 
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/racakitri', 'public');
        }
        \App\Models\Racakitri::create($data);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showRacakitri($id) { 
        $data = \App\Models\Racakitri::findOrFail($id);
        return view('dashboard.racakitri.detail', ['racakitri' => $data]); 
    }
    public function editRacakitri($id) { 
        $data = \App\Models\Racakitri::findOrFail($id);
        return view('dashboard.racakitri.form', ['type' => 'Edit', 'racakitri' => $data]); 
    }
    public function updateRacakitri(\Illuminate\Http\Request $request, $id) 
    {
        $model = \App\Models\Racakitri::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/racakitri', 'public');
        }
        $model->update($data);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyRacakitri($id) 
    {
        \App\Models\Racakitri::destroy($id);
        return redirect()->route('dashboard.racakitri.index')->with('success', 'Data berhasil dihapus.');
    }

    // Informasi
    public function informasi() { 
        $data = \App\Models\Informasi::latest()->get();
        return view('dashboard.informasi.index', ['informasi' => $data]); 
    }
    public function createInformasi() { return view('dashboard.informasi.form', ['type' => 'Tambah', 'informasi' => new \App\Models\Informasi()]); }
    public function storeInformasi(\Illuminate\Http\Request $request) 
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/informasi', 'public');
        }
        \App\Models\Informasi::create($data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showInformasi($id) { 
        $data = \App\Models\Informasi::findOrFail($id);
        return view('dashboard.informasi.detail', ['informasi' => $data]); 
    }
    public function editInformasi($id) { 
        $data = \App\Models\Informasi::findOrFail($id);
        return view('dashboard.informasi.form', ['type' => 'Edit', 'informasi' => $data]); 
    }
    public function updateInformasi(\Illuminate\Http\Request $request, $id) 
    {
        $model = \App\Models\Informasi::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/informasi', 'public');
        }
        $model->update($data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyInformasi($id) 
    {
        \App\Models\Informasi::destroy($id);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Data berhasil dihapus.');
    }

    // Video
    public function video() { 
        $data = \App\Models\Video::latest()->get();
        return view('dashboard.video.index', ['video' => $data]); 
    }
    public function createVideo() { return view('dashboard.video.form', ['type' => 'Tambah', 'video' => new \App\Models\Video()]); }
    public function storeVideo(\Illuminate\Http\Request $request) 
    {
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/video', 'public');
        }
        \App\Models\Video::create($data);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function showVideo($id) { 
        $data = \App\Models\Video::findOrFail($id);
        return view('dashboard.video.detail', ['video' => $data]); 
    }
    public function editVideo($id) { 
        $data = \App\Models\Video::findOrFail($id);
        return view('dashboard.video.form', ['type' => 'Edit', 'video' => $data]); 
    }
    public function updateVideo(\Illuminate\Http\Request $request, $id) 
    {
        $model = \App\Models\Video::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/video', 'public');
        }
        $model->update($data);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroyVideo($id) 
    {
        \App\Models\Video::destroy($id);
        return redirect()->route('dashboard.video.index')->with('success', 'Data berhasil dihapus.');
    }
}
