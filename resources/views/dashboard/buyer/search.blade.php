@extends('layouts.buyer')

@section('title', 'E-Bookstore - Pencarian')

@section('content')
<div class="min-h-screen">
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-16 py-12 pt-32">
        
        <div class="mb-10">
            <h2 class="font-['Literata'] text-3xl sm:text-5xl font-bold text-[#5f3822] mb-3">
                Hasil Pencarian
            </h2>
            <div class="w-16 h-1 bg-gradient-to-r from-[#7a4f37] to-[#c8a96e] mb-4 rounded-full"></div>
            <p class="text-sm sm:text-base text-gray-500 font-medium">
                @if($books->count() > 0)
                    Menampilkan <span class="text-[#5f3822] font-bold">{{ $books->total() }}</span> karya terbaik untuk kata kunci <em class="text-gray-800 font-semibold">"{{ request('q') }}"</em>
                @else
                    Maaf, tidak ada hasil yang cocok untuk kata kunci <em class="text-gray-800 font-semibold">"{{ request('q') }}"</em>
                @endif
            </p>
        </div>                                              
        
        <form action="{{ url()->current() }}" method="GET" class="flex flex-col lg:flex-row gap-8">
            <input type="hidden" name="q" value="{{ request('q') }}">

            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-gray-100 space-y-6 lg:sticky lg:top-32">

                    <div>
                        <h3 class="text-xs uppercase tracking-[0.15em] text-[#5f3822] mb-4 font-bold flex items-center gap-2">
                            📁 Kategori
                        </h3>
                        <div class="space-y-2.5 max-h-48 lg:max-h-none overflow-y-auto pr-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 accent-[#5f3822] cursor-pointer">
                                <span class="text-xs sm:text-sm text-gray-600 group-hover:text-[#5f3822] transition-colors {{ !request('category') ? 'font-bold text-[#5f3822]' : '' }}">Semua Kategori</span>
                            </label>

                            @forelse ($categories as $category)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 accent-[#5f3822] cursor-pointer">
                                    <span class="text-xs sm:text-sm text-gray-600 group-hover:text-[#5f3822] transition-colors {{ request('category') == $category->id ? 'font-bold text-[#5f3822]' : '' }}">{{ $category->name }}</span>  
                                </label>
                            @empty
                                <p class="text-gray-400 italic text-xs">Tidak ada kategori tersedia</p>
                            @endforelse
                        </div>  
                    </div>

                    <div class="border-b border-gray-100"></div>

                    <div>
                        <h3 class="text-xs uppercase tracking-[0.15em] text-[#5f3822] mb-3 font-bold flex items-center gap-2">
                            💰 Rentang Harga
                        </h3>
                        <input
                            name="max_price"
                            value="{{ request('max_price', 500000) }}"
                            min="0"
                            max="500000"
                            step="25000"
                            onchange="this.form.submit()"
                            class="w-full accent-[#5f3822] cursor-pointer"
                            type="range"
                        >
                        <div class="flex justify-between mt-2 text-xs text-gray-400 font-medium">
                            <span>Rp 0</span>
                            <span class="text-[#5f3822] font-bold bg-[#5f3822]/5 px-2 py-0.5 rounded">Maks: Rp {{ number_format(request('max_price', 500000), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-b border-gray-100"></div>

                    <div>
                        <h3 class="text-xs uppercase tracking-[0.15em] text-[#5f3822] mb-3 font-bold flex items-center gap-2">
                            ⭐ Ulasan Pembeli
                        </h3>
                        <button type="submit" name="min_rating" value="4.5" class="w-full flex items-center justify-between p-2.5 rounded-xl border transition-all text-left {{ request('min_rating') == '4.5' ? 'bg-[#5f3822]/5 border-[#5f3822] text-[#5f3822]' : 'bg-gray-50 border-gray-200 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-1.5">
                                <div class="flex text-amber-500">
                                    <span class="material-symbols-outlined text-[16px] fill-current">star</span>
                                    <span class="material-symbols-outlined text-[16px] fill-current">star</span>
                                    <span class="material-symbols-outlined text-[16px] fill-current">star</span>
                                    <span class="material-symbols-outlined text-[16px] fill-current">star</span>
                                    <span class="material-symbols-outlined text-[16px]">star_half</span>
                                </div>
                                <span class="text-xs font-bold text-gray-700">4.5+</span>
                            </div>
                            <span class="material-symbols-outlined text-sm opacity-50">chevron_right</span>
                        </button>
                    </div>

                </div>
            </aside>

            <div class="flex-grow w-full">
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                    @forelse ($books as $book)
                        <div class="group bg-white p-3 sm:p-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 flex flex-col h-full hover:-translate-y-1">
                            
                            <div class="relative aspect-[3/4] mb-4 rounded-xl overflow-hidden shadow-inner shrink-0" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                                <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition-colors"></div>
                            </div>

                            <div class="flex flex-col flex-grow">
                                <div class="mb-2">
                                    <span class="inline-block px-2.5 py-0.5 rounded-md bg-[#5f3822]/5 text-[#5f3822] text-[9px] font-bold uppercase tracking-wider">
                                        {{ $book->genre ?? 'Umum' }}
                                    </span>
                                </div>

                                <h4 class="text-sm sm:text-base font-bold text-gray-800 line-clamp-2 group-hover:text-[#5f3822] transition-colors min-h-[2.5rem] flex items-start leading-snug mb-1" title="{{ $book->title }}">
                                    {{ $book->title }}
                                </h4>

                                <p class="text-xs text-gray-400 font-medium truncate mb-4">
                                    Oleh <span class="text-gray-600 font-semibold">{{ $book->author }}</span>
                                </p>

                                <div class="mt-auto flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-gray-50">
                                    <div>
                                        <span class="font-black text-[#5f3822] text-sm sm:text-base">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </span>
                                        @if($book->stock > 0)
                                            <div class="text-[10px] font-bold text-green-600 mt-0.5">Stok {{ $book->stock }}</div>
                                        @else
                                            <div class="text-[10px] font-bold text-red-600 mt-0.5">Habis</div>
                                        @endif
                                    </div>

                                    <a href="{{ route('buyer.detail', $book->id) }}" class="block w-full sm:w-auto">
                                        <button type="button" class="w-full text-center bg-[#5f3822] text-white text-xs font-bold px-4 py-2.5 rounded-xl hover:bg-[#7a4f37] transition-all shadow-sm tracking-wide">
                                            Detail
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center col-span-full py-16 bg-white rounded-2xl border border-gray-200 shadow-sm px-4">
                            <span class="material-symbols-outlined text-5xl text-gray-300 mb-2 block">auto_stories</span>
                            <p class="text-gray-400 text-sm font-medium">
                                Tidak ada buku yang cocok dengan kriteria pencarian dan filter Anda.
                            </p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            </div>
        </form>
    </main>
</div>
@endsection