<footer class="bg-slate-900 text-slate-400 border-t border-slate-800 py-16 w-full">
    <div class="container mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <!-- Brand & Tagline -->
            <div class="flex flex-col gap-4 text-left">
                <div class="flex items-center gap-2 text-white">
                    <span class="material-symbols-outlined text-blue-500 text-3xl" style="font-variation-settings: 'FILL' 1;">church</span>
                    <span class="font-[Manrope] font-bold text-xl tracking-tight">GKI Pakuwon</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">Menjadi jembatan kasih dan kasih karunia bagi komunitas untuk bertumbuh bersama dalam iman.</p>
            </div>
            
            <!-- Contact Info -->
            <div class="flex flex-col gap-3 text-left">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-2">Hubungi Kami</h4>
                @php 
                    $phone = \App\Models\Setting::get('phone', '+62 812-3456-7890');
                    $email = \App\Models\Setting::get('email', 'info@gkipakuwon.or.id');
                    $address = \App\Models\Setting::get('address', 'Jl. Pakuwon Raya No. 12, Surabaya');
                @endphp
                <p class="text-sm flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-slate-500 text-lg">location_on</span>
                    <span>{{ $address }}</span>
                </p>
                <p class="text-sm flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-slate-500 text-lg">phone</span>
                    <a href="tel:{{ $phone }}" class="hover:text-white transition-colors">{{ $phone }}</a>
                </p>
                <p class="text-sm flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-slate-500 text-lg">mail</span>
                    <a href="mailto:{{ $email }}" class="hover:text-white transition-colors">{{ $email }}</a>
                </p>
            </div>

            <!-- Maps / Social Media -->
            <div class="flex flex-col gap-4 text-left">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider">Temukan Kami</h4>
                @php
                    $maps = \App\Models\Setting::get('maps_link');
                    $instagram = \App\Models\Setting::get('instagram_link');
                    $youtube = \App\Models\Setting::get('youtube_link');
                @endphp
                @if($maps)
                    <a href="{{ $maps }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors">
                        <span class="material-symbols-outlined text-sm">map</span>
                        Buka Google Maps
                    </a>
                @endif
                <div class="flex gap-3 mt-2">
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-gradient-to-tr hover:from-yellow-600 hover:to-purple-600 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-rose-600 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163c-.272-1.016-1.074-1.819-2.09-2.09C19.563 3.745 12 3.745 12 3.745s-7.563 0-9.408.328c-1.016.272-1.819 1.074-2.09 2.09C0 8.008 0 12 0 12s0 3.992.302 5.837c.272 1.016 1.074 1.819 2.09 2.09 1.845.328 9.408.328 9.408.328s7.563 0 9.408-.328c1.016-.272 1.819-1.074 2.09-2.09C24 15.992 24 12 24 12s0-3.992-.302-5.837zm-9.722 9.097V8.74L19.8 12l-6.024 3.26z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-slate-500">© {{ date('Y') }} GKI Pakuwon. Seluruh hak cipta dilindungi.</p>
            <div class="flex gap-6">
                <a class="text-xs text-slate-500 hover:text-slate-300 transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-xs text-slate-500 hover:text-slate-300 transition-colors" href="#">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer>
