<header class="h-20 px-12 flex items-center justify-between bg-transparent shrink-0">
    <!-- Search Bar -->
    <div class="relative w-96 group">
        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input 
            type="text" 
            placeholder="Cari jemaat atau kegiatan..." 
            class="w-full bg-white border border-gray-100 rounded-2xl py-3 pl-12 pr-4 text-sm font-medium focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 shadow-sm transition-all"
        >
    </div>

    <!-- User & Notifications -->
    <div class="flex items-center gap-6">
        <!-- Lihat Website Button -->
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-50 hover:text-primary transition-all shadow-sm">
            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            Lihat Website
        </a>
        <!-- Icons -->
        <div class="flex items-center gap-2">
            <!-- Notification Dropdown -->
            <div x-data="{ open: false }" @click.away="open = false" class="relative">
                <button @click="open = !open" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-white rounded-xl transition-all relative">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if(($unreadNotificationCount ?? 0) > 0)
                        <span class="absolute top-2 right-2 min-w-[1rem] h-4 px-1 bg-rose-500 text-white rounded-full border-2 border-surface text-[9px] leading-3 font-extrabold flex items-center justify-center">{{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}</span>
                    @endif
                </button>

                <div 
                    x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-cloak
                    class="absolute top-full right-0 mt-3 w-80 bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden z-[60] py-2"
                >
                    <div class="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                        <span class="text-xs font-extrabold text-gray-800 uppercase tracking-widest">Notifikasi</span>
                        <span class="text-[10px] font-bold text-primary bg-blue-50 px-2 py-0.5 rounded-lg">{{ $unreadNotificationCount ?? 0 }} Baru</span>
                    </div>
                    <div class="max-h-96 overflow-y-auto no-scrollbar">
                        @forelse(($notifications ?? collect()) as $notification)
                            <a href="{{ route('dashboard.notifications.read', $notification) }}" class="flex gap-4 px-5 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50/50 {{ $notification->read_at ? '' : 'bg-blue-50/30' }}">
                                <div class="w-10 h-10 {{ $notification->type === 'success' ? 'bg-emerald-50 text-emerald-500' : ($notification->type === 'warning' ? 'bg-amber-50 text-amber-500' : 'bg-blue-50 text-primary') }} rounded-xl shrink-0 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[13px] font-bold text-gray-700 leading-tight">{{ $notification->title }}</p>
                                    <p class="text-[11px] text-gray-400 mt-1 font-medium line-clamp-1">{{ $notification->message }}</p>
                                    <p class="text-[10px] text-gray-300 mt-2 font-bold uppercase tracking-wider">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="px-5 py-8 text-center">
                                <p class="text-sm font-bold text-gray-500">Belum ada notifikasi</p>
                                <p class="text-xs text-gray-400 mt-1">Aktivitas baru akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="grid grid-cols-2 bg-gray-50/50 border-t border-gray-100">
                        <form method="POST" action="{{ route('dashboard.notifications.read-all') }}">
                            @csrf
                            <button type="submit" class="w-full py-3 text-[11px] font-extrabold text-gray-500 hover:bg-white transition-colors uppercase tracking-widest">Tandai Dibaca</button>
                        </form>
                        <a href="{{ route('dashboard.settings') }}#notifikasi" class="block text-center py-3 text-[11px] font-extrabold text-primary hover:bg-blue-50 transition-colors uppercase tracking-widest">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <!-- Settings Button -->
            <a href="{{ route('dashboard.settings') }}" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-white rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </a>
        </div>

        <!-- Profile -->
        <div 
            x-data="{ open: false }" 
            @click.away="open = false"
            class="relative"
        >
            <button 
                @click="open = !open"
                class="flex items-center gap-4 group"
            >
                <div class="text-right hidden sm:block">
                    <p class="text-base font-extrabold text-gray-800 leading-none">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                    <p class="text-[10px] font-bold text-blue-300/80 uppercase tracking-[0.1em] mt-1.5">{{ auth()->user()->role ?? 'Administrator' }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-[#001a57] text-white text-base font-bold flex items-center justify-center shadow-xl shadow-blue-900/10 group-hover:scale-105 transition-all border-2 border-white overflow-hidden">
                    @if(auth()->check() && !empty(auth()->user()->foto_profil))
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    @endif
                </div>
            </button>
            
            <!-- Dropdown Menu -->
            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                x-cloak
                class="absolute top-full right-0 mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden z-50 py-2"
            >
                <a href="{{ route('dashboard.profil') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-primary transition-colors">
                    Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
