<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>{{ $title ?? 'GKI PAKUWON' }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
[x-cloak] { display: none !important; }
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    display: inline-block;
    vertical-align: middle;
}
.page-container {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: calc(100vh - 300px);
}
</style>
</head>
<body class="bg-[#f8f9ff] font-[Inter] text-[#0b1c30]">
    <x-header />
    
    <main class="page-container container mx-auto px-8 {{ isset($fullWidth) && $fullWidth ? 'max-w-[1600px]' : '' }}">
        @if(isset($fullWidth) && $fullWidth)
            {{ $slot }}
        @else
            <div class="bg-white border border-slate-100 shadow-sm rounded-2xl p-10">
                <h1 class="font-[Manrope] text-4xl font-bold text-[#001142] mb-6">{{ $title ?? 'Halaman' }}</h1>
                <div class="text-slate-600 prose max-w-none">
                    {{ $slot }}
                </div>
            </div>
        @endif
    </main>

    <x-footer />
</body>
</html>
