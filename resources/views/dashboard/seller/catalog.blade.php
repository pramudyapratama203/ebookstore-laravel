@extends('layouts.seller')

@section('title', 'Katalog Saya')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<main class="w-full pt-24 px-4 sm:px-6 lg:px-8 pb-12 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="max-w-[1280px] mx-auto">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8">
            <div class="text-center sm:text-left">
                <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-[#5f3822]">
                    Kelola Katalog
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 font-['Source_Serif_4'] italic">
                    Pantau dan kurasi koleksi mahakarya buku Anda.
                </p>
            </div>
            <a href="{{ route('seller.create') }}">
                <button type="button" class="w-full sm:w-auto bg-[#5f3822] text-white px-6 py-3 rounded-xl font-semibold text-sm flex items-center justify-center gap-2 hover:bg-[#7a4f37] active:scale-[0.98] transition-all shadow-md shrink-0">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Buku
                </button>
            </a>
        </div>

        <section class="bg-white p-6 rounded-2xl border border-[#e8dfd1] mb-8 shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
            <form action="{{ route('seller.search') }}" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-end">
                    
                    <div class="flex flex-col space-y-1.5 relative">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Cari Buku</label>
                        <div class="relative w-full">
                            <input type="text" id="search-inventory" name="search-inventory" value="{{ request('search-inventory') }}" placeholder="Cari judul atau penulis..." 
                                class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 pl-9 pr-3 text-sm text-gray-700 transition-all">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-1.5">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Semua Kategori</label>
                        <select name="category" class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                            <option value="">Semua Kategori</option>
                            
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1.5">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</label>
                        <select id="filter-status" name="filter-status" class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                            <option value="">Semua Status</option>
                            @foreach([
                                'in_stock' => 'In Stock',
                                'low_stock' => 'Low Stock',
                                'out_of_stock' => 'Out of Stock'
                            ] as $value => $label)
                                <option value="{{ $value }}" {{ request('filter-status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="w-full bg-[#6b5c4c] text-white px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-[#524436] active:scale-[0.97] transition-all shadow-sm text-center">
                            Cari
                        </button>
                    </div>        
                </div> 
            </form>
        </section>

        <div class="bg-white rounded-2xl border border-[#e8dfd1] overflow-hidden shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-[#f6f3eb]/40 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-4 px-6">Judul Buku</th>
                            <th class="py-4 px-6">Total Halaman</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6 text-center">Stok</th>
                            <th class="py-4 px-6">Harga</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                        @forelse($books as $book)
                        <tr class="book-row hover:bg-gray-50/60 transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden shadow-inner shrink-0 border border-gray-100 flex items-center justify-center relative">
                                        <div class="w-full h-full" style="background-color: {{ $book->cover_color ?? '#c8a96e' }};"></div>
                                    </div>
                                    <div>
                                        <div class="font-['Literata'] font-bold text-gray-900 text-base leading-tight">{{ $book->title }}</div>
                                        <div class="text-xs text-gray-400 font-['Source_Serif_4'] italic mt-0.5">{{ $book->author }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-mono text-xs text-gray-500 font-semibold">{{ $book->pages }} hlm</td>
                            <td class="py-4 px-6">
                                <span class="inline-block px-2.5 py-0.5 text-[11px] font-bold bg-[#f4dfcb]/40 text-[#716252] border border-[#d5c3ba]/30 rounded-md uppercase tracking-wide">{{ $book->category }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($book->stock == 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-red-50 text-red-700 border border-red-200/50">Out of Stock</span>
                                @elseif($book->stock <= 5)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/50">Low Stock ({{ $book->stock }})</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-green-50 text-green-700 border border-green-200/50">In Stock ({{ $book->stock }})</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 font-semibold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-1 md:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <button type="button" class="p-2 hover:bg-gray-100 rounded-xl text-gray-400 hover:text-[#5f3822]" title="View Details"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                    <button type="button" class="p-2 hover:bg-gray-100 rounded-xl text-gray-400 hover:text-[#5f3822]" title="Edit"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                    <button type="button" class="p-2 hover:bg-red-50 rounded-xl text-gray-400 hover:text-red-600" title="Delete"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 font-medium bg-white">
                                <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300 select-none">menu_book</span>
                                Tidak ada data buku yang tersedia dalam katalog pencarian Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-[#f6f3eb]/30 border-t border-gray-100 flex justify-center sm:justify-end">
                <div class="w-full sm:w-auto overflow-x-auto">
                    {{ $books->links() }}
                </div>
            </div>
            
        </div>
        
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="relative overflow-hidden group border-t border-gray-200/60 pt-4">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Buku</div>
                <div class="font-['Literata'] text-2xl sm:text-3xl font-bold text-[#5f3822]">{{ $books->total() }} Judul</div>
                <div class="text-[11px] text-gray-400 mt-1">Terbagi dalam {{ $categories->count() }} kategori katalog aktif</div>
            </div>  
        </div>

    </div>
</main>
@endsection