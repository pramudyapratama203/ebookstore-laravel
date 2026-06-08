<header class="bg-surface border-b border-outline-variant fixed top-0 w-full z-50">
    <div class="flex justify-between items-center w-full px-4 sm:px-16 max-w-[1280px] mx-auto h-20">

        <div class="flex items-center gap-3">
            <button onclick="toggleSellerMenu()" class="md:hidden p-2 text-[#7a4f37]">
                <span class="material-symbols-outlined" id="seller-menu-icon">menu</span>
            </button>

            <div class="font-bold text-2xl text-[#7a4f37]">
                E-Bookstore
            </div>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <a class=" text-[#7a4f37]" href="{{ route('home.seller') }}">
                Dashboard
            </a>

            <a class=" text-[#7a4f37]" href="{{ route('seller.catalog') }}">
                Katalog Saya
            </a>
            
            <a class=" text-[#7a4f37]" href="{{ route('order.seller') }}">
                Order Anda
            </a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('profile.seller.show') }}">
                <button class="p-2 text-[#7a4f37]">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                </button>
            </a>

        </div>
    </div>

    <div id="seller-mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 px-4 sm:px-16 py-4 space-y-3 shadow-lg">
        <a href="{{ route('home.seller') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Dashboard</a>
        <a href="{{ route('seller.catalog') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Katalog Saya</a>
        <a href="{{ route('order.seller') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Order Anda</a>
        <a href="{{ route('profile.seller.show') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Profil Saya</a>
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