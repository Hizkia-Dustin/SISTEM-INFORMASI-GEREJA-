<?php

$file = __DIR__ . '/app/Http/Controllers/DashboardController.php';

if (! file_exists($file)) {
    fwrite(STDERR, "DashboardController.php not found.\n");
    exit(1);
}

$content = file_get_contents($file);
$requiredMethods = [
    'racakitri',
    'createRacakitri',
    'storeRacakitri',
    'showRacakitri',
    'editRacakitri',
    'updateRacakitri',
    'destroyRacakitri',
    'informasi',
    'createInformasi',
    'storeInformasi',
    'showInformasi',
    'editInformasi',
    'updateInformasi',
    'destroyInformasi',
    'video',
    'createVideo',
    'storeVideo',
    'showVideo',
    'editVideo',
    'updateVideo',
    'destroyVideo',
];

$missing = [];
foreach ($requiredMethods as $method) {
    if (! preg_match('/function\s+' . preg_quote($method, '/') . '\s*\(/', $content)) {
        $missing[] = $method;
    }
}

if ($missing === []) {
    echo "DashboardController already contains Racakitri, Informasi, and Video methods. No changes made.\n";
    exit(0);
}

fwrite(STDERR, 'Missing methods: ' . implode(', ', $missing) . "\n");
fwrite(STDERR, "Do not append generated methods automatically; restore DashboardController.php from the latest branch instead.\n");
exit(1);
