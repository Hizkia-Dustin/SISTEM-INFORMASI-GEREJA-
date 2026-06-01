<?php
$file = 'app/Http/Controllers/DashboardController.php';
$content = file_get_contents($file);

// Replace for Racakitri
$content = str_replace(
    ["view('dashboard.racakitri.index', ['artikel' =>", "view('dashboard.racakitri.form', ['type' => 'Tambah', 'artikel' =>", "view('dashboard.racakitri.detail', ['artikel' =>", "view('dashboard.racakitri.form', ['type' => 'Edit', 'artikel' =>"],
    ["view('dashboard.racakitri.index', ['racakitri' =>", "view('dashboard.racakitri.form', ['type' => 'Tambah', 'racakitri' =>", "view('dashboard.racakitri.detail', ['racakitri' =>", "view('dashboard.racakitri.form', ['type' => 'Edit', 'racakitri' =>"],
    $content
);

// Replace for Informasi
$content = str_replace(
    ["view('dashboard.informasi.index', ['artikel' =>", "view('dashboard.informasi.form', ['type' => 'Tambah', 'artikel' =>", "view('dashboard.informasi.detail', ['artikel' =>", "view('dashboard.informasi.form', ['type' => 'Edit', 'artikel' =>"],
    ["view('dashboard.informasi.index', ['informasi' =>", "view('dashboard.informasi.form', ['type' => 'Tambah', 'informasi' =>", "view('dashboard.informasi.detail', ['informasi' =>", "view('dashboard.informasi.form', ['type' => 'Edit', 'informasi' =>"],
    $content
);

// Replace for Video
$content = str_replace(
    ["view('dashboard.video.index', ['artikel' =>", "view('dashboard.video.form', ['type' => 'Tambah', 'artikel' =>", "view('dashboard.video.detail', ['artikel' =>", "view('dashboard.video.form', ['type' => 'Edit', 'artikel' =>"],
    ["view('dashboard.video.index', ['video' =>", "view('dashboard.video.form', ['type' => 'Tambah', 'video' =>", "view('dashboard.video.detail', ['video' =>", "view('dashboard.video.form', ['type' => 'Edit', 'video' =>"],
    $content
);

file_put_contents($file, $content);
echo "Replacement done!\n";
