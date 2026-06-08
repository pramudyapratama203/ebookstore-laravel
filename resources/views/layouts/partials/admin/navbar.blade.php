<header class="bg-surface border-b border-outline-variant fixed top-0 w-full z-50">
    <div class="flex justify-between items-center w-full px-4 sm:px-16 max-w-[1280px] mx-auto h-20">

        <div class="flex items-center gap-3">
            <button onclick="toggleAdminMenu()" class="md:hidden p-2 text-[#7a4f37]">
                <span class="material-symbols-outlined" id="admin-menu-icon">menu</span>
            </button>

            <div class="font-bold text-2xl text-[#7a4f37]">
                E-Bookstore
            </div>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <a class=" text-[#7a4f37]" href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <a class=" text-[#7a4f37]" href="{{ route('admin.catalog') }}">
                Katalog
            </a>
            
            <a class=" text-[#7a4f37]" href="{{ route('admin.orders') }}">
                Order
            </a>

            <a class=" text-[#7a4f37]" href="{{ route('admin.activity-logs') }}">
                Log Aktivitas
            </a>
        </nav>

        <div class="flex items-center gap-3">

            <a href="{{ route('profile.admin.show') }}">
                <button class="p-2 text-[#7a4f37]">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                </button>
            </a>

        </div>
    </div>

    <div id="admin-mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 px-4 sm:px-16 py-4 space-y-3 shadow-lg">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Dashboard</a>
        <a href="{{ route('admin.catalog') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Katalog</a>
        <a href="{{ route('admin.orders') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Order</a>
        <a href="{{ route('admin.activity-logs') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Log Aktivitas</a>
        <a href="{{ route('profile.admin.show') }}" class="block px-4 py-2.5 text-sm font-semibold text-[#7a4f37] bg-[#f4dfcb]/30 rounded-xl hover:bg-[#f4dfcb]/60 transition-all">Profil Saya</a>
    </div>
</header>

<script>
    function toggleAdminMenu() {
        const menu = document.getElementById('admin-mobile-menu');
        const icon = document.getElementById('admin-menu-icon');
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    }
</script>