<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/50">
    <div class="flex justify-between items-center w-full px-4 sm:px-16 max-w-[1280px] mx-auto h-20">

        <div class="flex items-center gap-3">
            <button onclick="toggleSellerMenu()" class="md:hidden p-2 text-[#7a4f37]">
                <span class="material-symbols-outlined" id="seller-menu-icon">menu</span>
            </button>

            <a href="{{ route('home.seller') }}" class="font-bold text-2xl bg-gradient-to-r from-[#7a4f37] to-[#c8a96e] bg-clip-text text-transparent">
                E-Bookstore
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-1">
            <a href="{{ route('home.seller') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('home.seller') ? 'bg-[#f4dfcb]/60' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('seller.catalog') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('seller.catalog') || request()->routeIs('seller.*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Katalog Saya
            </a>
            <a href="{{ route('order.seller') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('order.seller') || request()->routeIs('seller.order*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Order Anda
            </a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('profile.seller.show') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-[#f4dfcb]/40 transition-all">
                <span class="text-sm font-semibold text-[#7a4f37]">{{ auth()->user()->name }}</span>
                <span class="material-symbols-outlined text-[#7a4f37]">account_circle</span>
            </a>
        </div>
    </div>

    <div id="seller-mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-lg border-t border-gray-200/50 px-4 sm:px-16 py-4 space-y-2 shadow-xl">
        <a href="{{ route('home.seller') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('home.seller') ? 'bg-[#f4dfcb]/60' : '' }}">Dashboard</a>
        <a href="{{ route('seller.catalog') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('seller.catalog') || request()->routeIs('seller.*') ? 'bg-[#f4dfcb]/60' : '' }}">Katalog Saya</a>
        <a href="{{ route('order.seller') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('order.seller') || request()->routeIs('seller.order*') ? 'bg-[#f4dfcb]/60' : '' }}">Order Anda</a>
        <hr class="border-gray-100 my-2">
        <a href="{{ route('profile.seller.show') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('profile.seller.*') ? 'bg-[#f4dfcb]/60' : '' }}">Profil Saya</a>
    </div>
</header>

<script>
    function toggleSellerMenu() {
        const menu = document.getElementById('seller-mobile-menu');
        const icon = document.getElementById('seller-menu-icon');
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    }
</script>