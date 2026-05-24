<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('homepage.homepage');
})->name('home');

// Authentication
Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

// About Section
Route::prefix('about')->name('about.')->group(function () {
    Route::view('/sejarah', 'pages.about.sejarah')->name('sejarah');
    Route::view('/visi-misi', 'pages.about.visi-misi')->name('visi-misi');
    Route::view('/pendeta', 'pages.about.pendeta')->name('pendeta');
    Route::view('/penatua', 'pages.about.penatua')->name('penatua');
});

// Pelayanan Section
Route::prefix('pelayanan')->name('pelayanan.')->group(function () {

    Route::view('/persekutuan', 'pages.pelayanan.persekutuan')->name('persekutuan');
    Route::view('/pembinaan', 'pages.pelayanan.pembinaan')->name('pembinaan');
    Route::view('/kesaksian', 'pages.pelayanan.kesaksian')->name('kesaksian');
    Route::view('/komisi', 'pages.pelayanan.komisi')->name('komisi');
    Route::view('/peribadatan', 'pages.pelayanan.peribadatan')->name('peribadatan');
    Route::view('/seni-musik', 'pages.pelayanan.seni-musik')->name('seni-musik');
    Route::view('/perlawatan', 'pages.pelayanan.perlawatan')->name('perlawatan');
    Route::view('/kedukaan', 'pages.pelayanan.kedukaan')->name('kedukaan');
    Route::view('/kebaktian', 'pages.pelayanan.kebaktian')->name('kebaktian');
    Route::view('/konseling', 'pages.pelayanan.konseling')->name('konseling');
    Route::view('/katekisasi', 'pages.pelayanan.katekisasi')->name('katekisasi');

    // Detail kelas katekisasi (dummy view)
    Route::view('/katekisasi/{slug}', 'pages.pelayanan.katekisasi')->name('katekisasi.show');


    Route::view('/pernikahan', 'pages.pelayanan.pernikahan')->name('pernikahan');
    Route::view('/atestasi', 'pages.pelayanan.atestasi')->name('atestasi');
});

// News & Articles
Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::view('/', 'pages.artikel.index')->name('index');
    Route::view('/{id}', 'pages.artikel.show')->name('show');
});

Route::prefix('renungan')->name('renungan.')->group(function () {
    Route::view('/', 'pages.renungan.index')->name('index');
    Route::view('/{id}', 'pages.renungan.show')->name('show');
});

Route::prefix('warta')->name('warta.')->group(function () {
    Route::view('/', 'pages.warta.index')->name('index');
    Route::view('/{id}', 'pages.warta.show')->name('show');
});

// Others
Route::view('/racakitri', 'pages.racakitri.index')->name('racakitri.index');
Route::view('/racakitri/{slug}', 'pages.racakitri.show')->name('racakitri.show');
Route::view('/informasi', 'pages.informasi.index')->name('informasi.index');

Route::view('/video', 'pages.video.index')->name('video.index');
Route::view('/kontak', 'pages.kontak.index')->name('kontak.index');

// Download Section
Route::prefix('download')->name('download.')->group(function () {
    Route::view('/formulir', 'pages.download.formulir')->name('formulir');
    Route::view('/lagu-rohani', 'pages.download.lagu-rohani')->name('lagu-rohani');
});

// Dashboard Section
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // 2. Modul Keluarga
    Route::get('/keluarga', [DashboardController::class, 'keluarga'])->name('keluarga.index');
    Route::get('/keluarga/tambah', [DashboardController::class, 'createKeluarga'])->name('keluarga.create');
    Route::get('/keluarga/{id}', [DashboardController::class, 'showKeluarga'])->name('keluarga.show');
    Route::get('/keluarga/{id}/edit', [DashboardController::class, 'editKeluarga'])->name('keluarga.edit');
    Route::delete('/keluarga/{id}', [DashboardController::class, 'destroyKeluarga'])->name('keluarga.destroy');

    // 3. Modul Jemaat
    Route::get('/jemaat', [DashboardController::class, 'jemaat'])->name('jemaat.index');
    Route::get('/jemaat/tambah', [DashboardController::class, 'createJemaat'])->name('jemaat.create');
    Route::get('/jemaat/{id}', [DashboardController::class, 'showJemaat'])->name('jemaat.show');
    Route::get('/jemaat/{id}/edit', [DashboardController::class, 'editJemaat'])->name('jemaat.edit');
    Route::delete('/jemaat/{id}', [DashboardController::class, 'destroyJemaat'])->name('jemaat.destroy');

    // 4. Modul Sektor
    Route::get('/sektor', [DashboardController::class, 'sektor'])->name('sektor.index');
    Route::get('/sektor/tambah', [DashboardController::class, 'createSektor'])->name('sektor.create');
    Route::get('/sektor/{id}/edit', [DashboardController::class, 'editSektor'])->name('sektor.edit');
    Route::delete('/sektor/{id}', [DashboardController::class, 'destroySektor'])->name('sektor.destroy');

    // 5. Modul Keuangan
    Route::get('/keuangan', [DashboardController::class, 'keuangan'])->name('keuangan.index');
    Route::get('/keuangan/tambah', [DashboardController::class, 'createKeuangan'])->name('keuangan.create');
    Route::get('/keuangan/{id}/edit', [DashboardController::class, 'editKeuangan'])->name('keuangan.edit');
    Route::get('/keuangan/laporan', [DashboardController::class, 'laporanKeuangan'])->name('keuangan.laporan');
    Route::delete('/keuangan/{id}', [DashboardController::class, 'destroyKeuangan'])->name('keuangan.destroy');

    // 6. Modul Pelayan Gereja
    Route::get('/pelayan', [DashboardController::class, 'pelayan'])->name('pelayan.index');
    Route::get('/pelayan/tambah', [DashboardController::class, 'createPelayan'])->name('pelayan.create');
    Route::get('/pelayan/{id}/edit', [DashboardController::class, 'editPelayan'])->name('pelayan.edit');
    Route::delete('/pelayan/{id}', [DashboardController::class, 'destroyPelayan'])->name('pelayan.destroy');

    // 7. Modul Renungan Ibadah
    Route::get('/renungan', [DashboardController::class, 'renungan'])->name('renungan.index');
    Route::get('/renungan/tambah', [DashboardController::class, 'createRenungan'])->name('renungan.create');
    Route::get('/renungan/{id}/edit', [DashboardController::class, 'editRenungan'])->name('renungan.edit');
    Route::delete('/renungan/{id}', [DashboardController::class, 'destroyRenungan'])->name('renungan.destroy');

    // 8. Modul Jadwal Ibadah
    Route::get('/jadwal-ibadah', [DashboardController::class, 'jadwal'])->name('jadwal.index');
    Route::get('/jadwal-ibadah/tambah', [DashboardController::class, 'createJadwal'])->name('jadwal.create');
    Route::get('/jadwal-ibadah/{id}/edit', [DashboardController::class, 'editJadwal'])->name('jadwal.edit');
    Route::delete('/jadwal-ibadah/{id}', [DashboardController::class, 'destroyJadwal'])->name('jadwal.destroy');

    // 9. Modul Jadwal Pelayanan
    Route::get('/jadwal-pelayanan', [DashboardController::class, 'tugas'])->name('tugas.index');
    Route::get('/jadwal-pelayanan/tambah', [DashboardController::class, 'createTugas'])->name('tugas.create');
    Route::get('/jadwal-pelayanan/{id}/edit', [DashboardController::class, 'editTugas'])->name('tugas.edit');
    Route::delete('/jadwal-pelayanan/{id}', [DashboardController::class, 'destroyTugas'])->name('tugas.destroy');

    // 10. Modul Program Kerja
    Route::get('/program-kerja', [DashboardController::class, 'programKerja'])->name('program_kerja.index');
    Route::get('/program-kerja/tambah', [DashboardController::class, 'createProgramKerja'])->name('program_kerja.create');
    Route::get('/program-kerja/{id}/edit', [DashboardController::class, 'editProgramKerja'])->name('program_kerja.edit');
    Route::delete('/program-kerja/{id}', [DashboardController::class, 'destroyProgramKerja'])->name('program_kerja.destroy');

    // 11. Modul Berita Gereja
    Route::get('/berita', [DashboardController::class, 'berita'])->name('berita.index');
    Route::get('/berita/tambah', [DashboardController::class, 'createBerita'])->name('berita.create');
    Route::get('/berita/{id}', [DashboardController::class, 'showBerita'])->name('berita.show');
    Route::get('/berita/{id}/edit', [DashboardController::class, 'editBerita'])->name('berita.edit');
    Route::delete('/berita/{id}', [DashboardController::class, 'destroyBerita'])->name('berita.destroy');

    // Extra: Profil & Komisi
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
    Route::get('/pengaturan', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/pengaturan/admin/tambah', [DashboardController::class, 'createAdmin'])->name('settings.admin.create');
    Route::get('/pengaturan/admin/{id}/edit', [DashboardController::class, 'editAdmin'])->name('settings.admin.edit');
    Route::delete('/pengaturan/admin/{id}', [DashboardController::class, 'destroyAdmin'])->name('settings.admin.destroy');

    Route::get('/komisi', [DashboardController::class, 'komisi'])->name('komisi.index');
    Route::get('/komisi/tambah', [DashboardController::class, 'createKomisi'])->name('komisi.create');
    Route::get('/komisi/{id}/edit', [DashboardController::class, 'editKomisi'])->name('komisi.edit');
    Route::delete('/komisi/{id}', [DashboardController::class, 'destroyKomisi'])->name('komisi.destroy');
});
