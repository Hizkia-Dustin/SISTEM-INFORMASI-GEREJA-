<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function notifyAdmins(string $title, string $message, ?string $url = null, string $type = 'info'): void
    {
        \App\Models\User::query()->select('id')->chunkById(100, function ($admins) use ($title, $message, $url, $type) {
            foreach ($admins as $admin) {
                \App\Models\Notification::create([
                    'user_id' => $admin->id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                    'url' => $url,
                ]);
            }
        });
    }

    private function validateImageUpload(Request $request, string $field = 'gambar', int $maxKb = 2048): void
    {
        $request->validate([
            $field => 'nullable|image|mimes:jpg,jpeg,png,webp|max:' . $maxKb,
        ], [
            $field . '.image' => 'File harus berupa gambar.',
            $field . '.mimes' => 'Gambar harus berupa JPG, PNG, atau WebP.',
            $field . '.max' => 'Ukuran gambar tidak boleh lebih dari ' . (int) ($maxKb / 1024) . 'MB.',
        ]);
    }

    private function validateDocumentUpload(Request $request, string $field, string $mimes, int $maxKb): void
    {
        $request->validate([
            $field => 'nullable|file|mimes:' . $mimes . '|max:' . $maxKb,
        ], [
            $field . '.file' => 'Lampiran harus berupa file yang valid.',
            $field . '.mimes' => 'Tipe file lampiran tidak sesuai.',
            $field . '.max' => 'Ukuran lampiran tidak boleh lebih dari ' . (int) ($maxKb / 1024) . 'MB.',
        ]);
    }

    public function index()
    {
        $jemaatList = \App\Models\Jemaat::all();
        
        $stats = [
            'keluarga' => \App\Models\Keluarga::count(),
            'jemaat' => $jemaatList->count(),
            'pemuda' => $jemaatList->where('status_keanggotaan', 'Pemuda')->count(),
            'ama' => $jemaatList->filter(fn($j) => in_array($j->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']))->count(),
            'ina' => $jemaatList->filter(fn($j) => in_array($j->jenis_kelamin, ['Perempuan', 'P']))->count(),
            'aktif' => $jemaatList->filter(fn($j) => $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif')->count(),
            'baptis' => $jemaatList->where('baptis', 'Ya')->count(),
            'sidi' => $jemaatList->where('sidi', 'Ya')->count(),
        ];

        // Sektor Calculations (Families count vs Jemaat count)
        $sektors = \App\Models\Keluarga::with('jemaat')->whereNotNull('wilayah_pelayanan')->get()->groupBy('wilayah_pelayanan');
        $sektorLabels = [];
        $sektorData = [];
        $sektorJemaatData = [];
        foreach($sektors as $sektor => $keluargas) {
            $sektorLabels[] = $sektor;
            $sektorData[] = $keluargas->count();
            
            $jCount = 0;
            foreach ($keluargas as $k) {
                $jCount += $k->jemaat ? $k->jemaat->count() : 0;
            }
            $sektorJemaatData[] = $jCount;
        }

        // Age Demographics
        $ageStats = [
            'Anak' => 0,
            'Remaja' => 0,
            'Pemuda' => 0,
            'Dewasa' => 0,
            'Lansia' => 0,
        ];
        foreach ($jemaatList as $j) {
            if ($j->tanggal_lahir) {
                $age = \Carbon\Carbon::parse($j->tanggal_lahir)->age;
                if ($age < 12) $ageStats['Anak']++;
                elseif ($age < 18) $ageStats['Remaja']++;
                elseif ($age < 36) $ageStats['Pemuda']++;
                elseif ($age < 60) $ageStats['Dewasa']++;
                else $ageStats['Lansia']++;
            }
        }

        $jemaatTerbaru = \App\Models\Jemaat::latest()->take(5)->get();

        $recentActivities = [
            ['action' => 'Penambahan data jemaat baru', 'time' => 'Baru Saja'],
            ['action' => 'Pembaruan data keuangan warta', 'time' => '1 Jam Yang Lalu'],
        ];

        return view('dashboard.home.index', compact('stats', 'sektorLabels', 'sektorData', 'sektorJemaatData', 'ageStats', 'recentActivities', 'jemaatTerbaru'));
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

        $keluarga = \App\Models\Keluarga::create($data);
        $this->notifyAdmins('Keluarga baru ditambahkan', $keluarga->nama_kepala_keluarga . ' masuk ke data keluarga.', route('dashboard.keluarga.index'), 'success');
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
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lampiran_baptis' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lampiran_sidi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
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

        $jemaat = \App\Models\Jemaat::create($data);
        $this->notifyAdmins('Jemaat baru terdaftar', ($jemaat->nama_lengkap ?? 'Data jemaat baru') . ' telah ditambahkan.', route('dashboard.jemaat.index'), 'success');
        return redirect()->route('dashboard.jemaat.index')->with('success', 'Data jemaat berhasil ditambahkan.');
    }

    public function showJemaat($id) { 
        $jemaat = \App\Models\Jemaat::with(['keluarga', 'riwayatPelayanan'])->findOrFail($id);
        return view('dashboard.jemaat.detail', compact('jemaat')); 
    }

    public function storeJemaatPelayananHistory(Request $request, $id)
    {
        $jemaat = \App\Models\Jemaat::findOrFail($id);

        $data = $request->validate([
            'bidang_pelayanan' => 'required|string|max:120',
            'peran' => 'nullable|string|max:120',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'status' => 'required|in:Aktif,Selesai,Nonaktif',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'bidang_pelayanan.required' => 'Bidang pelayanan wajib diisi.',
            'periode_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
        ]);

        $jemaat->riwayatPelayanan()->create($data);

        return redirect()
            ->route('dashboard.jemaat.show', $jemaat->id)
            ->with('success', 'Riwayat pelayanan berhasil ditambahkan.');
    }

    public function destroyJemaatPelayananHistory($jemaatId, $historyId)
    {
        $history = \App\Models\JemaatPelayananHistory::where('jemaat_id', $jemaatId)->findOrFail($historyId);
        $history->delete();

        return redirect()
            ->route('dashboard.jemaat.show', $jemaatId)
            ->with('success', 'Riwayat pelayanan berhasil dihapus.');
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
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lampiran_baptis' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lampiran_sidi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
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
        $sektor = \App\Models\Sektor::create($data);
        $this->notifyAdmins('Sektor baru dibuat', ($sektor->nama ?? 'Sektor baru') . ' telah ditambahkan.', route('dashboard.sektor.index'));
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
        $data = $request->validate([
            'kategori' => 'required|string',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
        ]);
        if (isset($data['jumlah'])) {
            $data['jumlah'] = abs((float)$data['jumlah']);
        }
        \App\Models\Keuangan::create($data);
        $this->notifyAdmins('Data keuangan ditambahkan', 'Catatan keuangan baru telah masuk ke sistem.', route('dashboard.keuangan.index'), 'success');
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
        $data = $request->validate([
            'kategori' => 'required|string',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
        ]);
        if (isset($data['jumlah'])) {
            $data['jumlah'] = abs((float)$data['jumlah']);
        }
        $keuangan->update($data);
        return redirect()->route('dashboard.keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }
    public function laporanKeuangan(Request $request)
    {
        $periodeAwal = $request->query('periode_awal', now()->startOfMonth()->toDateString());
        $periodeAkhir = $request->query('periode_akhir', now()->endOfMonth()->toDateString());
        $kategori = $request->query('kategori');

        $query = \App\Models\Keuangan::query()
            ->whereBetween('tanggal', [$periodeAwal, $periodeAkhir])
            ->orderBy('tanggal')
            ->orderBy('id');

        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }

        $keuangan = $query->get();
        $laporan = $this->buildLaporanKeuangan($keuangan);
        $kategoriList = \App\Models\Keuangan::query()
            ->select('kategori')
            ->whereNotNull('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('dashboard.keuangan.laporan', compact('laporan', 'keuangan', 'periodeAwal', 'periodeAkhir', 'kategori', 'kategoriList'));
    }

    public function downloadLaporanKeuangan(Request $request)
    {
        [$laporan, $periodeAwal, $periodeAkhir, $kategori] = $this->getLaporanKeuanganData($request);
        $filename = 'laporan-keuangan-' . $periodeAwal . '-sd-' . $periodeAkhir . '.xls';

        return response()
            ->view('dashboard.keuangan.exports.excel', compact('laporan', 'periodeAwal', 'periodeAkhir', 'kategori'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function downloadLaporanKeuanganPdf(Request $request)
    {
        [$laporan, $periodeAwal, $periodeAkhir, $kategori] = $this->getLaporanKeuanganData($request);
        $filename = 'laporan-keuangan-' . $periodeAwal . '-sd-' . $periodeAkhir . '.pdf';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.keuangan.exports.pdf', compact('laporan', 'periodeAwal', 'periodeAkhir', 'kategori'))
            ->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }

    private function getLaporanKeuanganData(Request $request): array
    {
        $periodeAwal = $request->query('periode_awal', now()->startOfMonth()->toDateString());
        $periodeAkhir = $request->query('periode_akhir', now()->endOfMonth()->toDateString());
        $kategori = $request->query('kategori');

        $query = \App\Models\Keuangan::query()
            ->whereBetween('tanggal', [$periodeAwal, $periodeAkhir])
            ->orderBy('tanggal')
            ->orderBy('id');

        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }

        return [$this->buildLaporanKeuangan($query->get()), $periodeAwal, $periodeAkhir, $kategori];
    }

    private function buildLaporanKeuangan($keuangan): array
    {
        $saldo = 0;
        $totalDebit = 0;
        $totalKredit = 0;
        $rows = [];

        foreach ($keuangan as $item) {
            $isPemasukan = $item->jenis_transaksi === 'Pemasukan';
            $jumlah = (float) $item->jumlah;
            $debit = $isPemasukan ? $jumlah : 0;
            $kredit = $isPemasukan ? 0 : $jumlah;
            $saldo += $debit - $kredit;
            $totalDebit += $debit;
            $totalKredit += $kredit;

            $rows[] = [
                'tanggal' => \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d'),
                'nomor_bukti' => 'KAS-' . str_pad((string) $item->id, 5, '0', STR_PAD_LEFT),
                'uraian' => $item->keterangan,
                'kategori' => $item->kategori,
                'akun_debit' => $isPemasukan ? 'Kas' : $item->kategori,
                'akun_kredit' => $isPemasukan ? $item->kategori : 'Kas',
                'debit' => $debit,
                'kredit' => $kredit,
                'saldo' => $saldo,
                'jenis_transaksi' => $item->jenis_transaksi,
            ];
        }

        $rekapKategori = $keuangan
            ->groupBy('kategori')
            ->map(function ($items, $namaKategori) {
                $pemasukan = $items->where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
                $pengeluaran = $items->where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');

                return [
                    'kategori' => $namaKategori,
                    'pemasukan' => $pemasukan,
                    'pengeluaran' => $pengeluaran,
                    'saldo' => $pemasukan - $pengeluaran,
                ];
            })
            ->values();

        return [
            'rows' => $rows,
            'rekap_kategori' => $rekapKategori,
            'total_debit' => $totalDebit,
            'total_kredit' => $totalKredit,
            'saldo_akhir' => $saldo,
        ];
    }
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
        $this->validateImageUpload($request, 'foto');
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/pelayan', 'public');
        }
        \App\Models\Pelayan::create($data);
        $this->notifyAdmins('Data pelayan ditambahkan', 'Pelayan baru telah masuk ke data pelayanan.', route('dashboard.pelayan.index'));
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
        $this->validateImageUpload($request, 'foto');
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/pelayan', 'public');
        }
        $pelayan->update($data);
        return redirect()->route('dashboard.pelayan.index')->with('success', 'Data pelayan berhasil diperbarui.');
    }

    public function approvePelayan($id)
    {
        $pelayan = \App\Models\Pelayan::findOrFail($id);
        $pelayan->update([
            'status' => 'aktif',
            'tanggal_approve' => now(),
            'catatan_admin' => null,
        ]);

        return redirect()->route('dashboard.pelayan.index')->with('success', 'Pendaftaran pelayanan disetujui.');
    }

    public function rejectPelayan(Request $request, $id)
    {
        $pelayan = \App\Models\Pelayan::findOrFail($id);
        $pelayan->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->input('catatan_admin'),
        ]);

        return redirect()->route('dashboard.pelayan.index')->with('success', 'Pendaftaran pelayanan ditolak.');
    }

    public function destroyPelayan($id) 
    { 
        \App\Models\Pelayan::destroy($id);
        return redirect()->back()->with('success', 'Data pelayan berhasil dihapus.'); 
    }

    // 7. Renungan
    public function renungan()
    {
        $renungan = \App\Models\Renungan::latest()->get();
        return view('dashboard.renungan.index', compact('renungan'));
    }

    public function createRenungan()
    {
        return view('dashboard.renungan.form', ['type' => 'Tambah', 'renungan' => new \App\Models\Renungan()]);
    }

    public function storeRenungan(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'ayat' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $data['penulis'] = $data['ayat'] ?? null;
        $data['status'] = 'published';
        unset($data['ayat']);

        \App\Models\Renungan::create($data);
        return redirect()->route('dashboard.renungan.index')->with('success', 'Renungan berhasil ditambahkan.');
    }

    public function editRenungan($id)
    {
        $renungan = \App\Models\Renungan::findOrFail($id);
        return view('dashboard.renungan.form', ['type' => 'Edit', 'renungan' => $renungan]);
    }

    public function updateRenungan(Request $request, $id)
    {
        $renungan = \App\Models\Renungan::findOrFail($id);
        $data = $request->validate([
            'tanggal' => 'required|date',
            'ayat' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $data['penulis'] = $data['ayat'] ?? null;
        unset($data['ayat']);

        $renungan->update($data);
        return redirect()->route('dashboard.renungan.index')->with('success', 'Renungan berhasil diperbarui.');
    }

    public function destroyRenungan($id)
    {
        \App\Models\Renungan::destroy($id);
        return redirect()->back()->with('success', 'Renungan berhasil dihapus.');
    }

    // 8. Jadwal Ibadah
    public function jadwal()
    {
        $jadwal = \App\Models\Jadwal::latest()->get();
        return view('dashboard.jadwal.index', compact('jadwal'));
    }

    public function createJadwal()
    {
        return view('dashboard.jadwal.form', ['type' => 'Tambah', 'jadwal' => new \App\Models\Jadwal()]);
    }

    public function storeJadwal(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'jenis' => 'nullable|string|max:255',
            'jumlah_hadir' => 'nullable|integer|min:0',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $payload = [
            'nama_acara' => $data['nama'],
            'tanggal' => $data['tanggal'],
            'waktu_mulai' => $data['waktu'],
            'lokasi' => $data['jenis'] ?? 'GKI Pakuwon',
            'deskripsi' => 'Jumlah hadir: ' . ($data['jumlah_hadir'] ?? 0),
        ];

        if ($request->hasFile('lampiran')) {
            $payload['deskripsi'] .= "\nLampiran: " . $request->file('lampiran')->store('uploads/jadwal', 'public');
        }

        \App\Models\Jadwal::create($payload);
        return redirect()->route('dashboard.jadwal.index')->with('success', 'Jadwal ibadah berhasil ditambahkan.');
    }

    public function editJadwal($id)
    {
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        return view('dashboard.jadwal.form', ['type' => 'Edit', 'jadwal' => $jadwal]);
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'jenis' => 'nullable|string|max:255',
            'jumlah_hadir' => 'nullable|integer|min:0',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $payload = [
            'nama_acara' => $data['nama'],
            'tanggal' => $data['tanggal'],
            'waktu_mulai' => $data['waktu'],
            'lokasi' => $data['jenis'] ?? $jadwal->lokasi,
            'deskripsi' => 'Jumlah hadir: ' . ($data['jumlah_hadir'] ?? 0),
        ];

        if ($request->hasFile('lampiran')) {
            $payload['deskripsi'] .= "\nLampiran: " . $request->file('lampiran')->store('uploads/jadwal', 'public');
        }

        $jadwal->update($payload);
        return redirect()->route('dashboard.jadwal.index')->with('success', 'Jadwal ibadah berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        \App\Models\Jadwal::destroy($id);
        return redirect()->back()->with('success', 'Jadwal ibadah berhasil dihapus.');
    }

    // 9. Jadwal Pelayanan (Tugas)
    public function tugas()
    {
        $tugas = \App\Models\Tugas::latest()->get();
        return view('dashboard.tugas.index', compact('tugas'));
    }

    public function createTugas()
    {
        return view('dashboard.tugas.form', ['type' => 'Tambah', 'tugas' => new \App\Models\Tugas()]);
    }

    public function storeTugas(Request $request)
    {
        $data = $this->mapTugasRequest($request);
        \App\Models\Tugas::create($data);
        return redirect()->route('dashboard.tugas.index')->with('success', 'Jadwal pelayanan berhasil ditambahkan.');
    }

    public function editTugas($id)
    {
        $tugas = \App\Models\Tugas::findOrFail($id);
        return view('dashboard.tugas.form', ['type' => 'Edit', 'tugas' => $tugas]);
    }

    public function updateTugas(Request $request, $id)
    {
        $tugas = \App\Models\Tugas::findOrFail($id);
        $tugas->update($this->mapTugasRequest($request));
        return redirect()->route('dashboard.tugas.index')->with('success', 'Jadwal pelayanan berhasil diperbarui.');
    }

    public function destroyTugas($id)
    {
        \App\Models\Tugas::destroy($id);
        return redirect()->back()->with('success', 'Jadwal pelayanan berhasil dihapus.');
    }

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
        $this->validateDocumentUpload($request, 'lampiran', 'pdf', 5120);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('uploads/program_kerja', 'public');
        }
        
        \App\Models\ProgramKerja::create($data);
        $this->notifyAdmins('Program kerja baru', 'Program kerja baru telah dibuat.', route('dashboard.program_kerja.index'));
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
        $this->validateDocumentUpload($request, 'lampiran', 'pdf', 5120);
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
        $this->validateImageUpload($request);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/berita', 'public');
        }
        
        $berita = \App\Models\Berita::create($data);
        $this->notifyAdmins('Berita baru dipublikasikan', ($berita->judul ?? 'Berita baru') . ' telah ditambahkan.', route('dashboard.berita.index'), 'success');
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
        $this->validateImageUpload($request);
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
        $this->validateImageUpload($request);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/warta', 'public');
        }
        
        $warta = \App\Models\Warta::create($data);
        $this->notifyAdmins('Warta baru ditambahkan', ($warta->judul ?? 'Warta baru') . ' telah masuk.', route('dashboard.warta.index'), 'success');
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
        $this->validateImageUpload($request);
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
        $this->validateImageUpload($request);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/artikel', 'public');
        }
        
        $artikel = \App\Models\Artikel::create($data);
        $this->notifyAdmins('Artikel baru ditambahkan', ($artikel->judul ?? 'Artikel baru') . ' telah masuk.', route('dashboard.artikel.index'), 'success');
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
        $this->validateImageUpload($request);
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
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
        $allNotifications = \App\Models\Notification::where('user_id', auth()->id())->latest()->paginate(10);
        return view('dashboard.settings.index', compact('user', 'admins', 'allNotifications')); 
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
        $admin = \App\Models\User::create($validated);
        $this->notifyAdmins('Admin baru ditambahkan', $admin->name . ' telah diberi akses ke dashboard.', route('dashboard.settings'), 'success');
        
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
        $komisi = \App\Models\Komisi::latest()->get();
        return view('dashboard.komisi.index', compact('komisi')); 
    }
    public function createKomisi() { return view('dashboard.komisi.form', ['type' => 'Tambah', 'komisi' => new \App\Models\Komisi()]); }
    public function storeKomisi(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        \App\Models\Komisi::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['keterangan'] ?? null,
            'status' => $validated['kategori'] ?? 'aktif',
        ]);

        return redirect()->route('dashboard.komisi.index')->with('success', 'Komisi berhasil ditambahkan.');
    }
    public function editKomisi($id)
    {
        $komisi = \App\Models\Komisi::findOrFail($id);
        return view('dashboard.komisi.form', ['type' => 'Edit', 'komisi' => $komisi]);
    }
    public function updateKomisi(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $komisi = \App\Models\Komisi::findOrFail($id);
        $komisi->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['keterangan'] ?? null,
            'status' => $validated['kategori'] ?? $komisi->status,
        ]);

        return redirect()->route('dashboard.komisi.index')->with('success', 'Komisi berhasil diperbarui.');
    }
    public function destroyKomisi($id)
    {
        \App\Models\Komisi::destroy($id);
        return redirect()->back()->with('success', 'Komisi berhasil dihapus.');
    }

    // Racakitri
    public function racakitri() { 
        $data = \App\Models\Racakitri::latest()->get();
        return view('dashboard.racakitri.index', ['racakitri' => $data]); 
    }
    public function createRacakitri() { return view('dashboard.racakitri.form', ['type' => 'Tambah', 'racakitri' => new \App\Models\Racakitri()]); }
    public function storeRacakitri(\Illuminate\Http\Request $request) 
    {
        $this->validateImageUpload($request);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/racakitri', 'public');
        }
        \App\Models\Racakitri::create($data);
        $this->notifyAdmins('Racakitri baru ditambahkan', 'Konten Racakitri baru telah masuk.', route('dashboard.racakitri.index'), 'success');
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
        $this->validateImageUpload($request);
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
        $this->validateImageUpload($request);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/informasi', 'public');
        }
        \App\Models\Informasi::create($data);
        $this->notifyAdmins('Informasi baru ditambahkan', 'Informasi jemaat baru telah masuk.', route('dashboard.informasi.index'), 'success');
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
        $this->validateImageUpload($request);
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
        $this->validateDocumentUpload($request, 'gambar', 'mp4,webm,mov', 20480);
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/video', 'public');
        }
        \App\Models\Video::create($data);
        $this->notifyAdmins('Video baru ditambahkan', 'Konten video baru telah masuk.', route('dashboard.video.index'), 'success');
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
        $this->validateDocumentUpload($request, 'gambar', 'mp4,webm,mov', 20480);
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

    private function mapTugasRequest(Request $request): array
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'pengkhotbah' => 'nullable|string|max:255',
            'liturgis' => 'nullable|string|max:255',
            'doa_syafaat' => 'nullable|string|max:255',
            'warta' => 'nullable|string|max:255',
            'pemusik' => 'nullable|string|max:255',
            'song_leader' => 'nullable|string|max:255',
            'liturgis_sm' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $roles = collect($data)
            ->except(['judul', 'tanggal', 'status'])
            ->filter()
            ->map(fn ($value, $key) => str_replace('_', ' ', ucwords($key, '_')) . ': ' . $value)
            ->implode("\n");

        return [
            'judul' => $data['judul'] ?? 'Jadwal Pelayanan',
            'deskripsi' => $roles ?: 'Belum ada detail pelayan.',
            'penerima' => $data['pengkhotbah'] ?? $data['liturgis'] ?? 'Majelis',
            'deadline' => $data['tanggal'] ?? now()->toDateString(),
            'status' => $data['status'] ?? 'pending',
        ];
    }

    // ==========================================
    // PENDETA CRUD
    // ==========================================
    public function pendeta()
    {
        $pendetas = \App\Models\Pendeta::latest()->get();
        return view('dashboard.pendeta.index', compact('pendetas'));
    }

    public function createPendeta()
    {
        return view('dashboard.pendeta.form', ['type' => 'Tambah', 'pendeta' => new \App\Models\Pendeta()]);
    }

    public function storePendeta(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string|max:2048',
            'pasangan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'visi_pelayanan' => 'nullable|string',
            'jadwal_konseling' => 'nullable|string|max:255',
            'riwayat_pelayanan' => 'nullable|array',
            'pendidikan' => 'nullable|array',
            'status' => 'required|string',
            'foto_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_file')) {
            $data['foto'] = asset('storage/' . $request->file('foto_file')->store('uploads/pendeta', 'public'));
        }

        // Clean arrays
        $data['riwayat_pelayanan'] = array_values(array_filter($data['riwayat_pelayanan'] ?? []));
        $data['pendidikan'] = array_values(array_filter($data['pendidikan'] ?? []));

        \App\Models\Pendeta::create($data);

        return redirect()->route('dashboard.pendeta.index')->with('success', 'Profil pendeta berhasil ditambahkan.');
    }

    public function editPendeta($id)
    {
        $pendeta = \App\Models\Pendeta::findOrFail($id);
        return view('dashboard.pendeta.form', ['type' => 'Edit', 'pendeta' => $pendeta]);
    }

    public function updatePendeta(Request $request, $id)
    {
        $pendeta = \App\Models\Pendeta::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string|max:2048',
            'pasangan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'visi_pelayanan' => 'nullable|string',
            'jadwal_konseling' => 'nullable|string|max:255',
            'riwayat_pelayanan' => 'nullable|array',
            'pendidikan' => 'nullable|array',
            'status' => 'required|string',
            'foto_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_file')) {
            $data['foto'] = asset('storage/' . $request->file('foto_file')->store('uploads/pendeta', 'public'));
        }

        // Clean arrays
        $data['riwayat_pelayanan'] = array_values(array_filter($data['riwayat_pelayanan'] ?? []));
        $data['pendidikan'] = array_values(array_filter($data['pendidikan'] ?? []));

        $pendeta->update($data);

        return redirect()->route('dashboard.pendeta.index')->with('success', 'Profil pendeta berhasil diperbarui.');
    }

    public function destroyPendeta($id)
    {
        \App\Models\Pendeta::destroy($id);
        return redirect()->route('dashboard.pendeta.index')->with('success', 'Profil pendeta berhasil dihapus.');
    }

    // ==========================================
    // PENATUA CRUD
    // ==========================================
    public function penatua()
    {
        $penatuas = \App\Models\Penatua::orderBy('urutan')->get();
        return view('dashboard.penatua.index', compact('penatuas'));
    }

    public function createPenatua()
    {
        return view('dashboard.penatua.form', ['type' => 'Tambah', 'penatua' => new \App\Models\Penatua()]);
    }

    public function storePenatua(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sub_kategori' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        \App\Models\Penatua::create($data);

        return redirect()->route('dashboard.penatua.index')->with('success', 'Data penatua berhasil ditambahkan.');
    }

    public function editPenatua($id)
    {
        $penatua = \App\Models\Penatua::findOrFail($id);
        return view('dashboard.penatua.form', ['type' => 'Edit', 'penatua' => $penatua]);
    }

    public function updatePenatua(Request $request, $id)
    {
        $penatua = \App\Models\Penatua::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'sub_kategori' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $penatua->update($data);

        return redirect()->route('dashboard.penatua.index')->with('success', 'Data penatua berhasil diperbarui.');
    }

    public function destroyPenatua($id)
    {
        \App\Models\Penatua::destroy($id);
        return redirect()->route('dashboard.penatua.index')->with('success', 'Data penatua berhasil dihapus.');
    }

    public function exportJemaatPdf()
    {
        $jemaatList = \App\Models\Jemaat::with('keluarga')->get();
        $stats = [
            'keluarga' => \App\Models\Keluarga::count(),
            'jemaat' => $jemaatList->count(),
            'pemuda' => $jemaatList->where('status_keanggotaan', 'Pemuda')->count(),
            'ama' => $jemaatList->filter(fn($j) => in_array($j->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']))->count(),
            'ina' => $jemaatList->filter(fn($j) => in_array($j->jenis_kelamin, ['Perempuan', 'P']))->count(),
            'aktif' => $jemaatList->filter(fn($j) => $j->status_aktif == true || $j->status_aktif == '1' || $j->status_aktif == 'Aktif')->count(),
            'baptis' => $jemaatList->where('baptis', 'Ya')->count(),
            'sidi' => $jemaatList->where('sidi', 'Ya')->count(),
        ];

        // Sektor stats
        $sektors = \App\Models\Keluarga::with('jemaat')->whereNotNull('wilayah_pelayanan')->get()->groupBy('wilayah_pelayanan');
        $sektorStats = [];
        foreach($sektors as $sektor => $keluargas) {
            $jCount = 0;
            foreach ($keluargas as $k) {
                $jCount += $k->jemaat ? $k->jemaat->count() : 0;
            }
            $sektorStats[] = [
                'nama' => $sektor,
                'keluarga_count' => $keluargas->count(),
                'jemaat_count' => $jCount,
            ];
        }

        // Age Demographics
        $ageStats = [
            'Anak (< 12 tahun)' => 0,
            'Remaja (12 - 17 tahun)' => 0,
            'Pemuda (18 - 35 tahun)' => 0,
            'Dewasa (36 - 59 tahun)' => 0,
            'Lansia (>= 60 tahun)' => 0,
        ];
        foreach ($jemaatList as $j) {
            if ($j->tanggal_lahir) {
                $age = \Carbon\Carbon::parse($j->tanggal_lahir)->age;
                if ($age < 12) $ageStats['Anak (< 12 tahun)']++;
                elseif ($age < 18) $ageStats['Remaja (12 - 17 tahun)']++;
                elseif ($age < 36) $ageStats['Pemuda (18 - 35 tahun)']++;
                elseif ($age < 60) $ageStats['Dewasa (36 - 59 tahun)']++;
                else $ageStats['Lansia (>= 60 tahun)']++;
            }
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.home.exports.jemaat_pdf', compact('stats', 'sektorStats', 'ageStats', 'jemaatList'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-statistik-jemaat-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportJemaatExcel()
    {
        $jemaatList = \App\Models\Jemaat::with('keluarga')->get();
        $filename = 'data-jemaat-lengkap-' . now()->format('Y-m-d') . '.xls';

        return response()
            ->view('dashboard.home.exports.jemaat_excel', compact('jemaatList'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function exportKeluargaExcel()
    {
        $keluargaList = \App\Models\Keluarga::with('jemaat')->get();
        $filename = 'data-keluarga-lengkap-' . now()->format('Y-m-d') . '.xls';

        return response()
            ->view('dashboard.home.exports.keluarga_excel', compact('keluargaList'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
