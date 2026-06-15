<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/50">
    <div class="flex justify-between items-center w-full px-4 sm:px-16 max-w-[1280px] mx-auto h-20">

        <div class="flex items-center gap-3">
            <button onclick="toggleBuyerMenu()" class="md:hidden p-2 text-[#7a4f37]">
                <span class="material-symbols-outlined" id="buyer-menu-icon">menu</span>
            </button>

            <a href="{{ route('home.buyer') }}" class="font-bold text-2xl bg-gradient-to-r from-[#7a4f37] to-[#c8a96e] bg-clip-text text-transparent">
                E-Bookstore
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-1">
            <a href="{{ route('home.buyer') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('home.buyer') || request()->routeIs('buyer.*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Jelajahi Katalog
            </a>
            <a href="{{ route('cart.show') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('cart.*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Keranjang Anda
            </a>
            <a href="{{ route('order.showorder') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('order.showorder') || request()->routeIs('order.buyer.*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Pesanan Anda
            </a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('profile.buyer.show') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-[#f4dfcb]/40 transition-all">
                <span class="text-sm font-semibold text-[#7a4f37]">{{ auth()->user()->name }}</span>
                <span class="material-symbols-outlined text-[#7a4f37]">account_circle</span>
            </a>
        </div>
    </div>

    <div id="buyer-mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-lg border-t border-gray-200/50 px-4 sm:px-16 py-4 space-y-2 shadow-xl">
        <a href="{{ route('home.buyer') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('home.buyer') || request()->routeIs('buyer.*') ? 'bg-[#f4dfcb]/60' : '' }}">Jelajahi Katalog</a>
        <a href="{{ route('cart.show') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('cart.*') ? 'bg-[#f4dfcb]/60' : '' }}">Keranjang Anda</a>
        <a href="{{ route('order.showorder') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('order.showorder') || request()->routeIs('order.buyer.*') ? 'bg-[#f4dfcb]/60' : '' }}">Pesanan Anda</a>
        <hr class="border-gray-100 my-2">
        <a href="{{ route('profile.buyer.show') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('profile.buyer.*') ? 'bg-[#f4dfcb]/60' : '' }}">Profil Saya</a>
    </div>
</header>

<script>
    function toggleBuyerMenu() {
        const menu = document.getElementById('buyer-mobile-menu');
        const icon = document.getElementById('buyer-menu-icon');
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    }
</script>