<?php

use Illuminate\Support\Facades\Route;

// Beranda Utama
Route::get('/', function () {
    return view('homepage.homepage');
})->name('home');

// Kelompok About
Route::prefix('about')->name('about.')->group(function () {
    Route::view('sejarah', 'pages.about.sejarah')->name('sejarah');
    Route::view('visi-misi', 'pages.about.visi-misi')->name('visi-misi');
    Route::view('pendeta', 'pages.about.pendeta')->name('pendeta');
    Route::view('penatua', 'pages.about.penatua')->name('penatua');
});

// Kelompok Pelayanan Jemaat
Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
    // Bidang
    Route::view('persekutuan', 'pages.pelayanan.persekutuan')->name('persekutuan');
    Route::view('pembinaan', 'pages.pelayanan.pembinaan')->name('pembinaan');
    Route::view('kesaksian', 'pages.pelayanan.kesaksian')->name('kesaksian');
    
    // Badan Kategorial
    Route::view('komisi-anak', 'pages.pelayanan.komisi-anak')->name('komisi-anak');
    Route::view('komisi-dewasa', 'pages.pelayanan.komisi-dewasa')->name('komisi-dewasa');
    Route::view('komisi-remaja', 'pages.pelayanan.komisi-remaja')->name('komisi-remaja');
    Route::view('komisi-pemuda', 'pages.pelayanan.komisi-pemuda')->name('komisi-pemuda');
    Route::view('komisi-usia-indah', 'pages.pelayanan.komisi-usia-indah')->name('komisi-usia-indah');
    
    // Badan Non Kategorial
    Route::view('peribadatan', 'pages.pelayanan.peribadatan')->name('peribadatan');
    Route::view('seni-musik', 'pages.pelayanan.seni-musik')->name('seni-musik');
    Route::view('perlawatan', 'pages.pelayanan.perlawatan')->name('perlawatan');
    Route::view('kedukaan', 'pages.pelayanan.kedukaan')->name('kedukaan');
    
    // Kegiatan
    Route::view('kebaktian', 'pages.pelayanan.kebaktian')->name('kebaktian');
    Route::view('konseling', 'pages.pelayanan.konseling')->name('konseling');
    Route::view('katekisasi', 'pages.pelayanan.katekisasi')->name('katekisasi');
    Route::view('pernikahan', 'pages.pelayanan.pernikahan')->name('pernikahan');
    Route::view('atestasi', 'pages.pelayanan.atestasi')->name('atestasi');
});

// Media & Lainnya
Route::view('artikel', 'pages.artikel.index')->name('artikel.index');
Route::view('artikel/{slug}', 'pages.artikel.show')->name('artikel.show');
Route::view('racakitri', 'pages.racakitri.index')->name('racakitri.index');
Route::view('racakitri/{slug}', 'pages.racakitri.show')->name('racakitri.show');
Route::view('informasi', 'pages.informasi.index')->name('informasi.index');
Route::view('informasi/{slug}', 'pages.informasi.show')->name('informasi.show');
Route::view('video', 'pages.video.index')->name('video.index');
Route::view('renungan-harian', 'pages.renungan.index')->name('renungan.index');
Route::view('renungan-harian/{slug}', 'pages.renungan.show')->name('renungan.show');
Route::view('warta-jemaat', 'pages.warta.index')->name('warta.index');
Route::view('warta-jemaat/{slug}', 'pages.warta.show')->name('warta.show');
Route::view('kontak', 'pages.kontak.index')->name('kontak.index');

// Download
Route::prefix('download')->name('download.')->group(function () {
    Route::view('formulir', 'pages.download.formulir')->name('formulir');
    Route::view('lagu-rohani', 'pages.download.lagu-rohani')->name('lagu-rohani');
});
