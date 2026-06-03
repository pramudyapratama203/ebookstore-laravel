@extends('layouts.buyer')

@section('title', 'E-Bookstore')

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    <section class="pt-32 pb-16 px-4 sm:px-6 md:px-16 bg-[#f6f3eb]">
        <div class="max-w-[1280px] mx-auto text-center">
            <h1 class="font-['Playfair_Display'] text-3xl sm:text-4xl md:text-5xl font-bold text-[#7a4f37] mb-6 leading-tight">
                Temukan Jendela <em class="italic font-normal">Dunia</em> Anda
            </h1>

            <div class="max-w-3xl mx-auto mt-8">
                <form action="{{ route('buyer.search') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    
                    <div class="relative w-full md:flex-1">
                        <input
                            id="search-input"
                            name="q"
                            value="{{ request('q') }}"
                            class="w-full h-14 pl-12 pr-4 text-sm sm:text-base rounded-xl border-none focus:outline-none focus:ring-0 placeholder-gray-400"
                            placeholder="Cari judul buku, penulis, atau genre..."
                            type="text"
                        >
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                    </div>

                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-2 shrink-0">
                        <select name="category" onchange="this.form.submit()" class="w-full sm:w-48 h-14 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-700 focus:outline-none focus:border-[#7a4f37] cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                                <option value="">Tidak ada kategori</option>
                            @endforelse
                        </select>
                        
                        <button type="button" onclick="handleSearchSubmit(this.form)" class="w-full sm:w-auto h-14 px-8 bg-[#7a4f37] text-white text-sm font-semibold rounded-xl hover:bg-[#653d26] transition shadow-sm">
                            Cari
                        </button>
                    </div>
                </form>  
            </div>
        </div>
    </section>

    <section class="py-16 px-4 sm:px-6 md:px-16 max-w-[1280px] mx-auto">
        <div class="mb-8">
            <h2 class="font-['Playfair_Display'] text-2xl sm:text-3xl font-bold text-[#7a4f37]">
                Pilih Katalog Terbaikmu
            </h2>
            <div class="w-16 h-1 bg-[#7a4f37] mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse ($books as $book)
            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col h-full transition-all duration-300 hover:-translate-y-1">
                <div class="p-3 sm:p-4 flex flex-col flex-1">
                    
                    <div class="w-full aspect-[3/4] rounded-xl mb-4 overflow-hidden relative shadow-inner shrink-0" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                        <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    
                    <div class="flex flex-col flex-1 justify-between">
                        <div class="mb-3">
                            <p class="text-[10px] font-bold text-[#c8a96e] uppercase tracking-wider mb-1">
                               {{ $book->genre ?? 'Umum' }}
                            </p>

                            <h3 class="text-sm sm:text-base font-bold text-gray-800 line-clamp-1 group-hover:text-[#7a4f37] transition-colors" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>

                            <p class="text-gray-400 text-xs mt-0.5 line-clamp-1">
                                {{ $book->author }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-gray-50 space-y-3">
                            <span class="block font-black text-sm sm:text-base text-[#7a4f37]">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>

                            <a href="{{ route('buyer.detail', $book->id) }}" class="block w-full">
                                <button type="button" class="w-full bg-[#7a4f37] text-white text-xs font-bold py-3 rounded-xl shadow-sm hover:bg-[#5c3a27] active:scale-[0.98] transition-all tracking-wide">
                                    Lihat Detail
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty 
            <div class="text-center col-span-full py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <span class="text-4xl block mb-2">📭</span>
                <p class="text-gray-400 text-sm font-medium">
                    Tidak ada buku yang tersedia saat ini.
                </p>
            </div>
        @endforelse
        </div>
    </section>
</div>

<script>
    function handleSearchSubmit(form) {
        const searchInput = document.getElementById('search-input');
        
        if (searchInput.value.trim() === '') {
            searchInput.focus();
        } else {
            form.submit();
        }
    }
</script>
@endsection