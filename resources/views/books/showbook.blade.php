@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="pt-24 pb-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

    @forelse($books as $book)
    <div class="book-item group">
        <a href="{{ route('books.show', $book->id) }}" class="block">
            <div class="book-cover-wrapper rounded-2xl overflow-hidden mb-3 relative aspect-[3/4]" style="background: {{ $book->cover_color }}">
                <div class="absolute inset-0 flex flex-col justify-end p-4">
                    <div class="font-['Playfair_Display'] font-bold text-white text-base">{{ $book->title }}</div>
                    <div class="text-white/70 text-xs">{{ $book->author }}</div>
                </div>
                @if($book->is_new)
                    <div class="absolute top-3 left-3 bg-[#c8a96e] text-black text-[10px] font-bold px-2 py-0.5 rounded-full">BARU</div>
                @endif
            </div>
        </a>
        
        <h3 class="font-semibold text-xs mb-1">
            <a href="{{ route('books.show', $book->id) }}" class="hover:text-[#c8a96e] transition-colors">
                {{ $book->title }}
            </a>
        </h3>
        
        <div class="flex items-center justify-between">
            <span class="text-[#c8a96e] font-bold text-sm">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
            <span class="text-yellow-400 text-xs">★ {{ $book->rating ?? '0' }}</span>
        </div>

        <form action="{{ route('dashboard.buyer.createcart', $book->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary w-full mt-4">Tambah ke Keranjang</button>
        </form>
    </div>
    @empty
        <div class="col-span-2 md:col-span-3 xl:col-span-4 text-center py-12">
            <p class="text-[#a09880]">Belum ada koleksi buku saat ini.</p>
        </div>  
    @endforelse
</div>
@endsection