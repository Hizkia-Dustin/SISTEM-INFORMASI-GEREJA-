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
        .glass-login {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-[#f8f9ff] font-[Inter] text-gray-800 antialiased h-screen overflow-hidden">
    
    <div class="flex w-full h-full">
        
        <!-- Left Side: Visual Experience -->
        <div class="hidden lg:flex lg:w-3/5 relative flex-col justify-center items-center overflow-hidden bg-gradient-to-br from-blue-100 to-blue-800">
            <!-- Background Image with Overlay -->
            <img src="https://images.unsplash.com/photo-1543459176-4426b37223ba?q=80&w=1600&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-luminosity scale-110" alt="Church Interior" />
            
            <!-- Animated Background Circles -->
            <div class="absolute top-0 -left-20 w-96 h-96 bg-teal-600/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-100/30 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>

            <!-- Floating Content -->
            <div class="relative z-10 w-full max-w-2xl px-12">
                <div class="glass-login p-10 rounded-[40px] shadow-2xl">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-10 shadow-xl rotate-3 hover:rotate-0 transition-transform duration-500">
                        <span class="material-symbols-outlined text-blue-700 text-4xl">church</span>
                    </div>
                    
                    <h1 class="font-h1 text-5xl text-white mb-6 leading-[1.1] font-extrabold tracking-tight">
                        Portal <span class="text-teal-50">GKI Pakuwon</span>
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
                    <a href="{{ route('home') ?? '/' }}" class="flex items-center gap-2 hover:text-white transition-colors group">
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
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <span class="material-symbols-outlined text-blue-700 text-3xl">church</span>
                    </div>
                    <h2 class="font-h1 text-2xl text-blue-800 font-bold">Portal GKI Pakuwon</h2>
                </div>

                <div class="mb-10 text-center lg:text-left relative">
                    <!-- Back Button for Mobile -->
                    <a href="{{ route('home') ?? '/' }}" class="lg:hidden absolute -top-16 left-0 flex items-center gap-2 text-blue-700/60 hover:text-blue-700 transition-all font-bold text-xs uppercase tracking-wider group">
                        <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        Kembali
                    </a>

                    <h2 class="font-h1 text-4xl text-blue-800 font-extrabold mb-3">Selamat Datang</h2>
                    <p class="font-body-md text-gray-600 font-medium">Silakan masuk untuk melanjutkan.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-bold text-blue-800/80 ml-1">Email / ID Jemaat</label>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-teal-600 transition-colors">
                                <span class="material-symbols-outlined text-[22px]">mail</span>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="username"
                                   class="block w-full pl-12 pr-4 py-4 bg-white rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-4 focus:ring-teal-600/10 outline-none transition-all font-body-md text-gray-800 placeholder:text-gray-400">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="text-sm font-bold text-blue-800/80">Kata Sandi</label>
                        </div>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-teal-600 transition-colors">
                                <span class="material-symbols-outlined text-[22px]">lock</span>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" placeholder="••••••••" required autocomplete="current-password"
                                   class="block w-full pl-12 pr-12 py-4 bg-white rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-4 focus:ring-teal-600/10 outline-none transition-all font-body-md text-gray-800 placeholder:text-gray-400">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-[22px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between px-1">
                        <label for="remember_me" class="flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-gray-200 text-teal-600 focus:ring-teal-600 transition-all cursor-pointer">
                            <span class="ml-3 text-sm font-semibold text-gray-600 group-hover:text-gray-800 transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Action Button -->
                    <button type="submit" class="w-full py-5 bg-blue-700 text-white rounded-2xl font-bold uppercase tracking-widest text-sm hover:bg-blue-800 hover:shadow-[0_20px_40px_rgba(0,17,66,0.2)] transition-all duration-300 flex items-center justify-center gap-3 group active:scale-[0.98]">
                        Masuk Sekarang
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <!-- Help Link -->
                <p class="mt-10 text-center text-sm text-gray-600 font-medium">
                    Belum punya akun? <span class="text-teal-600 font-bold">Hubungi Sekretariat</span>
                </p>

                <!-- Small Footer -->
                <div class="mt-16 text-center text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">
                    &copy; 2024 GKI PAKUWON &bull; Management System
                </div>
            </div>
            
        </div>
        
    </div>

</body>
</html>
