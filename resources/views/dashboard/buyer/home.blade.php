@extends('layouts.buyer')

@section('title', 'E-Bookstore')

@section('content')
<div class="min-h-screen">
    
    <section class="relative pt-32 pb-20 px-4 sm:px-6 md:px-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#f6f3eb] via-[#fcf9f0] to-[#f0ebe0]"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#c8a96e]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-[#7a4f37]/5 rounded-full blur-3xl"></div>
        <div class="max-w-[1280px] mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/60 backdrop-blur-sm border border-gray-200/50 px-4 py-2 rounded-full text-xs text-[#7a4f37] font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-[#7a4f37] animate-pulse"></span>
                Ratusan buku digital siap dijelajahi
            </div>
            <h1 class="font-['Literata'] text-4xl sm:text-5xl md:text-6xl font-bold text-[#5f3822] mb-6 leading-tight">
                Temukan Jendela <em class="italic font-normal text-[#c8a96e]">Dunia</em> Anda
            </h1>
            <p class="text-gray-500 text-sm sm:text-base max-w-xl mx-auto mb-8">Dari fiksi hingga non-fiksi, temukan buku digital favorit Anda di sini.</p>

            <div class="max-w-2xl mx-auto">
                <form action="{{ route('buyer.search') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center bg-white p-1.5 rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100">
                    
                    <div class="relative w-full md:flex-1">
                        <input
                            id="search-input"
                            name="q"
                            value="{{ request('q') }}"
                            class="w-full h-13 pl-12 pr-4 text-sm rounded-xl border-0 focus:outline-none focus:ring-0 placeholder-gray-400"
                            placeholder="Cari judul buku, penulis, atau genre..."
                            type="text"
                        >
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                            search
                        </span>
                    </div>

                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-2 shrink-0">
                        <select name="category" onchange="this.form.submit()" class="w-full sm:w-44 h-13 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-700 focus:outline-none focus:border-[#7a4f37] cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                                <option value="">Tidak ada kategori</option>
                            @endforelse
                        </select>
                        
                        <button type="button" onclick="handleSearchSubmit(this.form)" class="w-full sm:w-auto h-13 px-8 bg-gradient-to-r from-[#7a4f37] to-[#5c3a27] text-white text-sm font-semibold rounded-xl hover:from-[#653d26] hover:to-[#4a2e1d] active:scale-[0.98] transition-all shadow-md">
                            Cari
                        </button>
                    </div>
                </form>  
            </div>
        </div>
    </section>

    <section class="py-16 px-4 sm:px-6 md:px-16 max-w-[1280px] mx-auto">
        <div class="mb-10">
            <h2 class="font-['Literata'] text-2xl sm:text-3xl font-bold text-[#5f3822]">
                Pilih Katalog Terbaikmu
            </h2>
            <div class="w-16 h-1 bg-gradient-to-r from-[#7a4f37] to-[#c8a96e] mt-3 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse ($books as $book)
            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col h-full transition-all duration-300 hover:-translate-y-1.5">
                <div class="p-3 sm:p-4 flex flex-col flex-1">
                    
                    <div class="w-full aspect-[3/4] rounded-xl mb-4 overflow-hidden relative shadow-inner shrink-0" style="background: linear-gradient(135deg, {{ $book->cover_color ?? '#c8a96e' }}, {{ $book->cover_color ?? '#7a4f37' }}cc);">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                        <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition-colors duration-300"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <div class="text-white/90 font-['Literata'] text-xs font-semibold leading-tight line-clamp-2">{{ $book->title }}</div>
                            <div class="text-white/50 text-[10px] mt-0.5">{{ $book->author }}</div>
                        </div>
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
                            <div class="flex items-center justify-between">
                                <span class="font-black text-sm sm:text-base text-[#7a4f37]">
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </span>
                                @if($book->rating > 0)
                                <span class="text-amber-500 text-xs flex items-center gap-0.5">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    {{ number_format($book->rating, 1) }}
                                </span>
                                @endif
                            </div>

                            <a href="{{ route('buyer.detail', $book->id) }}">
                                <button type="button" class="w-full bg-gradient-to-r from-[#7a4f37] to-[#5c3a27] text-white text-xs font-bold py-3 rounded-xl shadow-sm hover:shadow-md hover:from-[#653d26] hover:to-[#4a2e1d] active:scale-[0.98] transition-all tracking-wide">
                                    Lihat Detail
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty 
            <div class="text-center col-span-full py-20 bg-white/60 backdrop-blur-sm rounded-2xl border border-dashed border-gray-200">
                <span class="material-symbols-outlined text-5xl text-gray-300 block mb-3">menu_book</span>
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