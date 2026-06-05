<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

// ==========================================
// FRONTEND ROUTES
// ==========================================

Route::get('/', function () {
    $artikel = \App\Models\Artikel::latest()->take(3)->get();
    $racakitri = \App\Models\Racakitri::latest()->take(3)->get();
    $informasi = \App\Models\Informasi::latest()->take(3)->get();
    $video = \App\Models\Video::latest()->take(3)->get();
    $warta = \App\Models\Warta::latest()->take(3)->get();
    $renungan = \App\Models\Renungan::latest()->take(3)->get();
    
    return view('homepage.homepage', compact('artikel', 'racakitri', 'informasi', 'video', 'warta', 'renungan'));
})->name('home');

// Tentang Kami
Route::prefix('tentang-kami')->group(function () {
    Route::get('/sejarah', function () { return view('pages.about.sejarah'); })->name('about.sejarah');
    Route::get('/visi-misi', function () { return view('pages.about.visi-misi'); })->name('about.visi-misi');
    Route::get('/pendeta', function () { return view('pages.about.pendeta'); })->name('about.pendeta');
    Route::get('/penatua', function () { return view('pages.about.penatua'); })->name('about.penatua');
});

// Pelayanan
Route::prefix('pelayanan')->group(function () {
    Route::get('/kebaktian', function () { return view('pages.pelayanan.kebaktian'); })->name('pelayanan.kebaktian');
    Route::get('/komisi', function () { return view('pages.pelayanan.komisi'); })->name('pelayanan.komisi');
    Route::get('/daftar', function () { return view('pages.pelayanan.daftar'); })->name('pelayanan.daftar');
    Route::post('/daftar', function (\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telepon' => 'required|string|max:30',
            'komisi_tujuan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'alasan' => 'nullable|string|max:2000',
        ]);

        \App\Models\Pelayan::create([
            'nama' => $data['nama'],
            'email' => $data['email'] ?? null,
            'no_telepon' => $data['no_telepon'],
            'posisi' => $data['posisi'],
            'komisi_tujuan' => $data['komisi_tujuan'],
            'alasan' => $data['alasan'] ?? null,
            'tanggal_mulai' => now()->toDateString(),
            'status' => 'pending',
        ]);

        return redirect()->route('pelayanan.daftar')->with('success', 'Pendaftaran pelayanan berhasil dikirim. Admin akan meninjau data Anda.');
    })->name('pelayanan.daftar.store');
    Route::get('/katekisasi', function () { return view('pages.pelayanan.katekisasi'); })->name('pelayanan.katekisasi');
    Route::get('/katekisasi/detail', function () { return view('pages.pelayanan.katekisasi-show'); })->name('pelayanan.katekisasi.show');
    Route::get('/konseling', function () { return view('pages.pelayanan.konseling'); })->name('pelayanan.konseling');
    Route::get('/atestasi', function () { return view('pages.pelayanan.atestasi'); })->name('pelayanan.atestasi');
    Route::get('/kedukaan', function () { return view('pages.pelayanan.kedukaan'); })->name('pelayanan.kedukaan');
    Route::get('/kesaksian', function () { return view('pages.pelayanan.kesaksian'); })->name('pelayanan.kesaksian');
    Route::get('/pembinaan', function () { return view('pages.pelayanan.pembinaan'); })->name('pelayanan.pembinaan');
    Route::get('/peribadatan', function () { return view('pages.pelayanan.peribadatan'); })->name('pelayanan.peribadatan');
    Route::get('/perlawatan', function () { return view('pages.pelayanan.perlawatan'); })->name('pelayanan.perlawatan');
    Route::get('/pernikahan', function () { return view('pages.pelayanan.pernikahan'); })->name('pelayanan.pernikahan');
    Route::get('/persekutuan', function () { return view('pages.pelayanan.persekutuan'); })->name('pelayanan.persekutuan');
    Route::get('/seni-musik', function () { return view('pages.pelayanan.seni-musik'); })->name('pelayanan.seni-musik');
});

// Publikasi & Informasi (Warta, Informasi, Artikel, Renungan, Racakitri)
Route::prefix('warta')->group(function () {
    Route::get('/', function () { 
        $kategori = request('kategori');
        $warta = \App\Models\Warta::when($kategori, fn ($query) => $query->where('kategori', $kategori))->latest()->paginate(9)->withQueryString();
        return view('pages.warta.index', compact('warta', 'kategori')); 
    })->name('warta.index');
    Route::get('/{id}', function ($id) { 
        $item = \App\Models\Warta::findOrFail($id);
        return view('pages.warta.show', compact('item')); 
    })->name('warta.show');
});

Route::prefix('informasi')->group(function () {
    Route::get('/', function () { 
        $kategori = request('kategori');
        $informasi = \App\Models\Informasi::when($kategori, fn ($query) => $query->where('kategori', $kategori))->latest()->paginate(9)->withQueryString();
        return view('pages.informasi.index', compact('informasi', 'kategori')); 
    })->name('informasi.index');
    Route::get('/{id}', function ($id) { 
        $item = \App\Models\Informasi::findOrFail($id);
        return view('pages.informasi.show', compact('item')); 
    })->name('informasi.show');
});

Route::prefix('artikel')->group(function () {
    Route::get('/', function () { 
        $kategori = request('kategori');
        $articles = \App\Models\Artikel::when($kategori, fn ($query) => $query->where('kategori', $kategori))->latest()->paginate(9)->withQueryString();
        return view('pages.artikel.index', compact('articles', 'kategori')); 
    })->name('artikel.index');
    Route::get('/{id}', function ($id) { 
        $article = \App\Models\Artikel::findOrFail($id);
        return view('pages.artikel.show', compact('article')); 
    })->name('artikel.show');
});

Route::prefix('renungan')->group(function () {
    Route::get('/', function () { 
        $kategori = request('kategori');
        $renungan = \App\Models\Renungan::latest()->paginate(9)->withQueryString();
        return view('pages.renungan.index', compact('renungan', 'kategori')); 
    })->name('renungan.index');
    Route::get('/{id}', function ($id) { 
        $item = \App\Models\Renungan::findOrFail($id);
        return view('pages.renungan.show', compact('item')); 
    })->name('renungan.show');
});

Route::prefix('racakitri')->group(function () {
    Route::get('/', function () { 
        $kategori = request('kategori');
        $racakitri = \App\Models\Racakitri::when($kategori, fn ($query) => $query->where('kategori', $kategori))->latest()->paginate(9)->withQueryString();
        return view('pages.racakitri.index', compact('racakitri', 'kategori')); 
    })->name('racakitri.index');
    Route::get('/{id}', function ($id) { 
        $item = \App\Models\Racakitri::findOrFail($id);
        return view('pages.racakitri.show', compact('item')); 
    })->name('racakitri.show');
});

// Download
Route::prefix('download')->group(function () {
    Route::get('/formulir', function () { return view('pages.download.formulir'); })->name('download.formulir');
    Route::get('/lagu-rohani', function () { return view('pages.download.lagu-rohani'); })->name('download.lagu-rohani');
});

// Kontak & Video
Route::get('/kontak', function () { return view('pages.kontak.index'); })->name('kontak.index');
Route::prefix('video')->group(function () {
    Route::get('/', function () { 
        $videos = \App\Models\Video::latest()->paginate(9);
        return view('pages.video.index', compact('videos')); 
    })->name('video.index');
    Route::get('/{id}', function ($id) { 
        $item = \App\Models\Video::findOrFail($id);
        return view('pages.video.show', compact('item')); 
    })->name('video.show');
});


// ==========================================
// DASHBOARD ROUTES (Admin)
// ==========================================

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Keluarga
    Route::get('/keluarga', [DashboardController::class, 'keluarga'])->name('dashboard.keluarga.index');
    Route::get('/keluarga/create', [DashboardController::class, 'createKeluarga'])->name('dashboard.keluarga.create');
    Route::post('/keluarga', [DashboardController::class, 'storeKeluarga'])->name('dashboard.keluarga.store');
    Route::get('/keluarga/{id}', [DashboardController::class, 'showKeluarga'])->name('dashboard.keluarga.show');
    Route::get('/keluarga/{id}/edit', [DashboardController::class, 'editKeluarga'])->name('dashboard.keluarga.edit');
    Route::put('/keluarga/{id}', [DashboardController::class, 'updateKeluarga'])->name('dashboard.keluarga.update');
    Route::delete('/keluarga/{id}', [DashboardController::class, 'destroyKeluarga'])->name('dashboard.keluarga.destroy');

    // Jemaat
    Route::get('/jemaat', [DashboardController::class, 'jemaat'])->name('dashboard.jemaat.index');
    Route::get('/jemaat/create', [DashboardController::class, 'createJemaat'])->name('dashboard.jemaat.create');
    Route::post('/jemaat', [DashboardController::class, 'storeJemaat'])->name('dashboard.jemaat.store');
    Route::get('/jemaat/{id}', [DashboardController::class, 'showJemaat'])->name('dashboard.jemaat.show');
    Route::get('/jemaat/{id}/edit', [DashboardController::class, 'editJemaat'])->name('dashboard.jemaat.edit');
    Route::put('/jemaat/{id}', [DashboardController::class, 'updateJemaat'])->name('dashboard.jemaat.update');
    Route::delete('/jemaat/{id}', [DashboardController::class, 'destroyJemaat'])->name('dashboard.jemaat.destroy');

    // Sektor
    Route::get('/sektor', [DashboardController::class, 'sektor'])->name('dashboard.sektor.index');
    Route::get('/sektor/create', [DashboardController::class, 'createSektor'])->name('dashboard.sektor.create');
    Route::post('/sektor', [DashboardController::class, 'storeSektor'])->name('dashboard.sektor.store');
    Route::get('/sektor/{id}/edit', [DashboardController::class, 'editSektor'])->name('dashboard.sektor.edit');
    Route::put('/sektor/{id}', [DashboardController::class, 'updateSektor'])->name('dashboard.sektor.update');
    Route::delete('/sektor/{id}', [DashboardController::class, 'destroySektor'])->name('dashboard.sektor.destroy');

    // Keuangan
    Route::get('/keuangan', [DashboardController::class, 'keuangan'])->name('dashboard.keuangan.index');
    Route::get('/keuangan/create', [DashboardController::class, 'createKeuangan'])->name('dashboard.keuangan.create');
    Route::post('/keuangan', [DashboardController::class, 'storeKeuangan'])->name('dashboard.keuangan.store');
    Route::get('/keuangan/laporan', [DashboardController::class, 'laporanKeuangan'])->name('dashboard.keuangan.laporan');
    Route::get('/keuangan/laporan/download', [DashboardController::class, 'downloadLaporanKeuangan'])->name('dashboard.keuangan.laporan.download');
    Route::get('/keuangan/laporan/pdf', [DashboardController::class, 'downloadLaporanKeuanganPdf'])->name('dashboard.keuangan.laporan.pdf');
    Route::get('/keuangan/{id}/edit', [DashboardController::class, 'editKeuangan'])->name('dashboard.keuangan.edit');
    Route::put('/keuangan/{id}', [DashboardController::class, 'updateKeuangan'])->name('dashboard.keuangan.update');
    Route::delete('/keuangan/{id}', [DashboardController::class, 'destroyKeuangan'])->name('dashboard.keuangan.destroy');

    // Pelayan
    Route::get('/pelayan', [DashboardController::class, 'pelayan'])->name('dashboard.pelayan.index');
    Route::get('/pelayan/create', [DashboardController::class, 'createPelayan'])->name('dashboard.pelayan.create');
    Route::post('/pelayan', [DashboardController::class, 'storePelayan'])->name('dashboard.pelayan.store');
    Route::get('/pelayan/{id}/edit', [DashboardController::class, 'editPelayan'])->name('dashboard.pelayan.edit');
    Route::put('/pelayan/{id}/approve', [DashboardController::class, 'approvePelayan'])->name('dashboard.pelayan.approve');
    Route::put('/pelayan/{id}/reject', [DashboardController::class, 'rejectPelayan'])->name('dashboard.pelayan.reject');
    Route::put('/pelayan/{id}', [DashboardController::class, 'updatePelayan'])->name('dashboard.pelayan.update');
    Route::delete('/pelayan/{id}', [DashboardController::class, 'destroyPelayan'])->name('dashboard.pelayan.destroy');

    // Renungan
    Route::get('/renungan', [DashboardController::class, 'renungan'])->name('dashboard.renungan.index');
    Route::get('/renungan/create', [DashboardController::class, 'createRenungan'])->name('dashboard.renungan.create');
    Route::post('/renungan', [DashboardController::class, 'storeRenungan'])->name('dashboard.renungan.store');
    Route::get('/renungan/{id}/edit', [DashboardController::class, 'editRenungan'])->name('dashboard.renungan.edit');
    Route::put('/renungan/{id}', [DashboardController::class, 'updateRenungan'])->name('dashboard.renungan.update');
    Route::delete('/renungan/{id}', [DashboardController::class, 'destroyRenungan'])->name('dashboard.renungan.destroy');

    // Jadwal
    Route::get('/jadwal', [DashboardController::class, 'jadwal'])->name('dashboard.jadwal.index');
    Route::get('/jadwal/create', [DashboardController::class, 'createJadwal'])->name('dashboard.jadwal.create');
    Route::post('/jadwal', [DashboardController::class, 'storeJadwal'])->name('dashboard.jadwal.store');
    Route::get('/jadwal/{id}/edit', [DashboardController::class, 'editJadwal'])->name('dashboard.jadwal.edit');
    Route::put('/jadwal/{id}', [DashboardController::class, 'updateJadwal'])->name('dashboard.jadwal.update');
    Route::delete('/jadwal/{id}', [DashboardController::class, 'destroyJadwal'])->name('dashboard.jadwal.destroy');

    // Tugas
    Route::get('/tugas', [DashboardController::class, 'tugas'])->name('dashboard.tugas.index');
    Route::get('/tugas/create', [DashboardController::class, 'createTugas'])->name('dashboard.tugas.create');
    Route::post('/tugas', [DashboardController::class, 'storeTugas'])->name('dashboard.tugas.store');
    Route::get('/tugas/{id}/edit', [DashboardController::class, 'editTugas'])->name('dashboard.tugas.edit');
    Route::put('/tugas/{id}', [DashboardController::class, 'updateTugas'])->name('dashboard.tugas.update');
    Route::delete('/tugas/{id}', [DashboardController::class, 'destroyTugas'])->name('dashboard.tugas.destroy');

    // Program Kerja
    Route::get('/program-kerja', [DashboardController::class, 'programKerja'])->name('dashboard.program_kerja.index');
    Route::get('/program-kerja/create', [DashboardController::class, 'createProgramKerja'])->name('dashboard.program_kerja.create');
    Route::post('/program-kerja', [DashboardController::class, 'storeProgramKerja'])->name('dashboard.program_kerja.store');
    Route::get('/program-kerja/{id}/edit', [DashboardController::class, 'editProgramKerja'])->name('dashboard.program_kerja.edit');
    Route::put('/program-kerja/{id}', [DashboardController::class, 'updateProgramKerja'])->name('dashboard.program_kerja.update');
    Route::delete('/program-kerja/{id}', [DashboardController::class, 'destroyProgramKerja'])->name('dashboard.program_kerja.destroy');

    // Berita
    Route::get('/berita', [DashboardController::class, 'berita'])->name('dashboard.berita.index');
    Route::get('/berita/create', [DashboardController::class, 'createBerita'])->name('dashboard.berita.create');
    Route::post('/berita', [DashboardController::class, 'storeBerita'])->name('dashboard.berita.store');
    Route::get('/berita/{id}', [DashboardController::class, 'showBerita'])->name('dashboard.berita.show');
    Route::get('/berita/{id}/edit', [DashboardController::class, 'editBerita'])->name('dashboard.berita.edit');
    Route::put('/berita/{id}', [DashboardController::class, 'updateBerita'])->name('dashboard.berita.update');
    Route::delete('/berita/{id}', [DashboardController::class, 'destroyBerita'])->name('dashboard.berita.destroy');

    // Warta
    Route::get('/warta', [DashboardController::class, 'warta'])->name('dashboard.warta.index');
    Route::get('/warta/create', [DashboardController::class, 'createWarta'])->name('dashboard.warta.create');
    Route::post('/warta', [DashboardController::class, 'storeWarta'])->name('dashboard.warta.store');
    Route::get('/warta/{id}', [DashboardController::class, 'showWarta'])->name('dashboard.warta.show');
    Route::get('/warta/{id}/edit', [DashboardController::class, 'editWarta'])->name('dashboard.warta.edit');
    Route::put('/warta/{id}', [DashboardController::class, 'updateWarta'])->name('dashboard.warta.update');
    Route::delete('/warta/{id}', [DashboardController::class, 'destroyWarta'])->name('dashboard.warta.destroy');

    // Artikel
    Route::get('/artikel', [DashboardController::class, 'artikel'])->name('dashboard.artikel.index');
    Route::get('/artikel/create', [DashboardController::class, 'createArtikel'])->name('dashboard.artikel.create');
    Route::post('/artikel', [DashboardController::class, 'storeArtikel'])->name('dashboard.artikel.store');
    Route::get('/artikel/{id}', [DashboardController::class, 'showArtikel'])->name('dashboard.artikel.show');
    Route::get('/artikel/{id}/edit', [DashboardController::class, 'editArtikel'])->name('dashboard.artikel.edit');
    Route::put('/artikel/{id}', [DashboardController::class, 'updateArtikel'])->name('dashboard.artikel.update');
    Route::delete('/artikel/{id}', [DashboardController::class, 'destroyArtikel'])->name('dashboard.artikel.destroy');

    // Racakitri
    Route::get('/racakitri', [DashboardController::class, 'racakitri'])->name('dashboard.racakitri.index');
    Route::get('/racakitri/create', [DashboardController::class, 'createRacakitri'])->name('dashboard.racakitri.create');
    Route::post('/racakitri', [DashboardController::class, 'storeRacakitri'])->name('dashboard.racakitri.store');
    Route::get('/racakitri/{id}', [DashboardController::class, 'showRacakitri'])->name('dashboard.racakitri.show');
    Route::get('/racakitri/{id}/edit', [DashboardController::class, 'editRacakitri'])->name('dashboard.racakitri.edit');
    Route::put('/racakitri/{id}', [DashboardController::class, 'updateRacakitri'])->name('dashboard.racakitri.update');
    Route::delete('/racakitri/{id}', [DashboardController::class, 'destroyRacakitri'])->name('dashboard.racakitri.destroy');

    // Informasi
    Route::get('/informasi', [DashboardController::class, 'informasi'])->name('dashboard.informasi.index');
    Route::get('/informasi/create', [DashboardController::class, 'createInformasi'])->name('dashboard.informasi.create');
    Route::post('/informasi', [DashboardController::class, 'storeInformasi'])->name('dashboard.informasi.store');
    Route::get('/informasi/{id}', [DashboardController::class, 'showInformasi'])->name('dashboard.informasi.show');
    Route::get('/informasi/{id}/edit', [DashboardController::class, 'editInformasi'])->name('dashboard.informasi.edit');
    Route::put('/informasi/{id}', [DashboardController::class, 'updateInformasi'])->name('dashboard.informasi.update');
    Route::delete('/informasi/{id}', [DashboardController::class, 'destroyInformasi'])->name('dashboard.informasi.destroy');

    // Video
    Route::get('/video', [DashboardController::class, 'video'])->name('dashboard.video.index');
    Route::get('/video/create', [DashboardController::class, 'createVideo'])->name('dashboard.video.create');
    Route::post('/video', [DashboardController::class, 'storeVideo'])->name('dashboard.video.store');
    Route::get('/video/{id}', [DashboardController::class, 'showVideo'])->name('dashboard.video.show');
    Route::get('/video/{id}/edit', [DashboardController::class, 'editVideo'])->name('dashboard.video.edit');
    Route::put('/video/{id}', [DashboardController::class, 'updateVideo'])->name('dashboard.video.update');
    Route::delete('/video/{id}', [DashboardController::class, 'destroyVideo'])->name('dashboard.video.destroy');

    // Komisi
    Route::get('/komisi', [DashboardController::class, 'komisi'])->name('dashboard.komisi.index');
    Route::get('/komisi/create', [DashboardController::class, 'createKomisi'])->name('dashboard.komisi.create');
    Route::post('/komisi', [DashboardController::class, 'storeKomisi'])->name('dashboard.komisi.store');
    Route::get('/komisi/{id}/edit', [DashboardController::class, 'editKomisi'])->name('dashboard.komisi.edit');
    Route::put('/komisi/{id}', [DashboardController::class, 'updateKomisi'])->name('dashboard.komisi.update');
    Route::delete('/komisi/{id}', [DashboardController::class, 'destroyKomisi'])->name('dashboard.komisi.destroy');

    // Profil (Dashboard Profil)
    Route::get('/profil', [DashboardController::class, 'profil'])->name('dashboard.profil');
    Route::get('/profil/edit', [DashboardController::class, 'editProfil'])->name('dashboard.profil.edit');
    Route::put('/profil', [DashboardController::class, 'updateProfil'])->name('dashboard.profil.update');

    // Settings
    Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::get('/settings/admin/create', [DashboardController::class, 'createAdmin'])->name('dashboard.settings.admin.create');
    Route::post('/settings/admin', [DashboardController::class, 'storeAdmin'])->name('dashboard.settings.admin.store');
    Route::get('/settings/admin/{id}/edit', [DashboardController::class, 'editAdmin'])->name('dashboard.settings.admin.edit');
    Route::put('/settings/admin/{id}', [DashboardController::class, 'updateAdmin'])->name('dashboard.settings.admin.update');
    Route::delete('/settings/admin/{id}', [DashboardController::class, 'destroyAdmin'])->name('dashboard.settings.admin.destroy');

    Route::get('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('dashboard.notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('dashboard.notifications.read-all');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('dashboard.notifications.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
