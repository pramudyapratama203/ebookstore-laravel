<header class="bg-surface border-b border-outline-variant fixed top-0 w-full z-50">
    <div class="flex justify-between items-center w-full px-16 max-w-[1280px] mx-auto h-20">

        <div class="font-bold text-2xl text-[#7a4f37]">
            E-Bookstore
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
        </nav>

        <div class="flex items-center gap-3">

            <a href="{{ route('profile.buyer.show') }}">
                <button class="p-2 text-[#7a4f37]">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                </button>
            </a>

        </div>
    </div>
</header>