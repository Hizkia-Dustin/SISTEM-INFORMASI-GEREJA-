<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - GKI Pakuwon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .login-gradient {
            background: linear-gradient(135deg, var(--color-primary-container) 0%, var(--color-primary) 100%);
        }
        .glass-login {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-[#f8f9ff] font-[Inter] text-on-surface antialiased h-screen overflow-hidden">
    
    <div class="flex w-full h-full">
        
        <!-- Left Side: Visual Experience -->
        <div class="hidden lg:flex lg:w-3/5 relative flex-col justify-center items-center overflow-hidden login-gradient">
            <!-- Background Image with Overlay -->
            <img src="https://images.unsplash.com/photo-1438283173091-5dbf5c5a3206?q=80&w=1600&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-luminosity scale-110" alt="Church Interior" />
            
            <!-- Animated Background Circles -->
            <div class="absolute top-0 -left-20 w-96 h-96 bg-secondary/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-primary-container/30 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>

            <!-- Floating Content -->
            <div class="relative z-10 w-full max-w-2xl px-12">
                <div class="glass-login p-10 rounded-[40px] shadow-2xl">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-10 shadow-xl rotate-3 hover:rotate-0 transition-transform duration-500">
                        <span class="material-symbols-outlined text-primary text-4xl">church</span>
                    </div>
                    
                    <h1 class="font-h1 text-5xl text-white mb-6 leading-[1.1] font-extrabold tracking-tight">
                        Portal <span class="text-secondary-container">GKI Pakuwon</span>
                    </h1>
                    
                    <p class="font-body-lg text-white/70 leading-relaxed mb-10 text-xl">
                        Akses layanan digital gereja, manajemen data jemaat, dan pendaftaran kegiatan dalam satu platform terintegrasi.
                    </p>

                    <div class="flex flex-wrap gap-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-xl">security</span>
                            </div>
                            <span class="text-white/80 font-medium">Akses Aman</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-xl">verified_user</span>
                            </div>
                            <span class="text-white/80 font-medium">Data Terproteksi</span>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Left -->
                <div class="mt-12 flex items-center gap-4 text-white/50">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 hover:text-white transition-colors group">
                        <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        <span class="text-sm font-semibold tracking-wide uppercase">Kembali ke Website</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-2/5 flex items-center justify-center p-6 sm:p-12 md:p-16 lg:p-20 bg-white shadow-[-20px_0_40px_rgba(0,0,0,0.03)] z-20 overflow-y-auto">
            
            <div class="w-full max-w-sm">
                <!-- Mobile Header -->
                <div class="lg:hidden mb-12 flex flex-col items-center">
                    <div class="w-14 h-14 bg-surface-container rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <span class="material-symbols-outlined text-primary text-3xl">church</span>
                    </div>
                    <h2 class="font-h1 text-2xl text-primary-container font-bold">Portal GKI Pakuwon</h2>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h2 class="font-h1 text-4xl text-primary-container font-extrabold mb-3">Selamat Datang</h2>
                    <p class="font-body-md text-on-surface-variant font-medium">Silakan masuk untuk melanjutkan.</p>
                </div>

                <form action="{{ route('dashboard.index') }}" method="GET" class="space-y-6">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-bold text-primary-container/80 ml-1">Email / ID Jemaat</label>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-[22px]">mail</span>
                            </div>
                            <input type="email" id="email" name="email" placeholder="nama@email.com" required
                                   class="block w-full pl-12 pr-4 py-4 bg-surface rounded-2xl border border-outline-variant/60 focus:border-secondary focus:ring-4 focus:ring-secondary/10 outline-none transition-all font-body-md text-on-surface placeholder:text-outline-variant">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="text-sm font-bold text-primary-container/80">Kata Sandi</label>
                            <a href="#" class="text-xs font-bold text-secondary hover:underline">Lupa Sandi?</a>
                        </div>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-[22px]">lock</span>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" placeholder="••••••••" required
                                   class="block w-full pl-12 pr-12 py-4 bg-surface rounded-2xl border border-outline-variant/60 focus:border-secondary focus:ring-4 focus:ring-secondary/10 outline-none transition-all font-body-md text-on-surface placeholder:text-outline-variant">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-outline hover:text-on-surface-variant transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-[22px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between px-1">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded-lg border-outline-variant text-secondary focus:ring-secondary transition-all cursor-pointer">
                            <span class="ml-3 text-sm font-semibold text-on-surface-variant group-hover:text-on-surface transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Action Button -->
                    <button type="submit" class="w-full py-5 bg-primary text-white rounded-2xl font-bold uppercase tracking-widest text-sm hover:bg-primary-container hover:shadow-[0_20px_40px_rgba(0,17,66,0.2)] transition-all duration-300 flex items-center justify-center gap-3 group active:scale-[0.98]">
                        Masuk Sekarang
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <!-- Help Link -->
                <p class="mt-10 text-center text-sm text-on-surface-variant font-medium">
                    Belum punya akun? <a href="#" class="text-secondary font-bold hover:underline">Hubungi Sekretariat</a>
                </p>

                <!-- Small Footer -->
                <div class="mt-16 text-center text-[10px] text-outline uppercase tracking-[0.2em] font-bold">
                    &copy; 2024 GKI PAKUWON &bull; Management System
                </div>
            </div>
            
        </div>
        
    </div>

</body>
</html>
