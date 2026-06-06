<?php

$file = __DIR__ . '/app/Http/Controllers/DashboardController.php';

if (! file_exists($file)) {
    fwrite(STDERR, "DashboardController.php not found.\n");
    exit(1);
}

$content = file_get_contents($file);
$obsoletePatterns = [
    "dashboard.racakitri.index', ['artikel' =>",
    "dashboard.racakitri.form', ['type' => 'Tambah', 'artikel' =>",
    "dashboard.racakitri.detail', ['artikel' =>",
    "dashboard.racakitri.form', ['type' => 'Edit', 'artikel' =>",
    "dashboard.informasi.index', ['artikel' =>",
    "dashboard.informasi.form', ['type' => 'Tambah', 'artikel' =>",
    "dashboard.informasi.detail', ['artikel' =>",
    "dashboard.informasi.form', ['type' => 'Edit', 'artikel' =>",
    "dashboard.video.index', ['artikel' =>",
    "dashboard.video.form', ['type' => 'Tambah', 'artikel' =>",
    "dashboard.video.detail', ['artikel' =>",
    "dashboard.video.form', ['type' => 'Edit', 'artikel' =>",
];

foreach ($obsoletePatterns as $pattern) {
    if (str_contains($content, $pattern)) {
        fwrite(STDERR, "Found obsolete view variable pattern: {$pattern}\n");
        fwrite(STDERR, "Fix DashboardController.php from source control instead of running a blind replacement.\n");
        exit(1);
    }
}

echo "DashboardController view variables are already correct. No changes made.\n";
exit(0);
