<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/50">
    <div class="flex justify-between items-center w-full px-4 sm:px-16 max-w-[1280px] mx-auto h-20">

        <div class="flex items-center gap-3">
            <button onclick="toggleAdminMenu()" class="md:hidden p-2 text-[#7a4f37]">
                <span class="material-symbols-outlined" id="admin-menu-icon">menu</span>
            </button>

            <a href="{{ route('admin.dashboard') }}" class="font-bold text-2xl bg-gradient-to-r from-[#7a4f37] to-[#c8a96e] bg-clip-text text-transparent">
                E-Bookstore
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-1">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#f4dfcb]/60' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.catalog') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.catalog') || request()->routeIs('admin.search') || request()->routeIs('admin.create') || request()->routeIs('admin.category.*') ? 'bg-[#f4dfcb]/60' : '' }}">
                Katalog
            </a>
            <a href="{{ route('admin.activity-logs') }}" class="px-4 py-2 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.activity-logs') ? 'bg-[#f4dfcb]/60' : '' }}">
                Log Aktivitas
            </a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('profile.admin.show') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-[#f4dfcb]/40 transition-all">
                <span class="text-sm font-semibold text-[#7a4f37]">{{ auth()->user()->name }}</span>
                <span class="material-symbols-outlined text-[#7a4f37]">account_circle</span>
            </a>
        </div>
    </div>

    <div id="admin-mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-lg border-t border-gray-200/50 px-4 sm:px-16 py-4 space-y-2 shadow-xl">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#f4dfcb]/60' : '' }}">Dashboard</a>
        <a href="{{ route('admin.catalog') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.catalog') || request()->routeIs('admin.search') || request()->routeIs('admin.category.*') ? 'bg-[#f4dfcb]/60' : '' }}">Katalog</a>
        <a href="{{ route('admin.activity-logs') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('admin.activity-logs') ? 'bg-[#f4dfcb]/60' : '' }}">Log Aktivitas</a>
        <hr class="border-gray-100 my-2">
        <a href="{{ route('profile.admin.show') }}" class="block px-4 py-3 text-sm font-semibold text-[#7a4f37] rounded-xl hover:bg-[#f4dfcb]/40 transition-all {{ request()->routeIs('profile.admin.*') ? 'bg-[#f4dfcb]/60' : '' }}">Profil Saya</a>
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