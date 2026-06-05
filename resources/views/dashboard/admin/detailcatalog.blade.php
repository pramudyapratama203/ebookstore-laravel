@extends('layouts.admin')

@section('title', 'Detail Buku Katalog')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-gray-50 min-h-screen">
    <main class="w-full max-w-[1280px] mx-auto pt-24 px-4 sm:px-6 lg:px-8 pb-12 transition-all duration-300">
        <header class="mb-8 border-b border-[#e8dfd1] pb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-['Literata'] text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Informasi Buku</h1>
            </div>
            
            <a href="{{ route('admin.category.edit', $book->id) }}" class="shrink-0">
                <button type="button" class="w-full sm:w-auto bg-[#5f3822] text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 hover:bg-[#7a4f37] active:scale-[0.98] transition-all shadow-sm">
                    <span class="material-symbols-outlined text-sm">edit</span> Edit Produk
                </button>
            </a>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white border border-[#e8dfd1] rounded-2xl p-6 sm:p-8 shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] flex flex-col items-center">
                    
                    <div class="w-40 h-60 rounded-2xl border border-black/10 shadow-xl relative overflow-hidden mb-6 flex-shrink-0 transition-transform duration-300 hover:scale-[1.02]" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                        <div class="absolute left-1.5 top-0 bottom-0 w-2.5 bg-black/10 z-10"></div>
                        
                        @if($book->cover_image)
                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-white/30">
                                <span class="material-symbols-outlined text-6xl select-none">book</span>
                            </div>
                        @endif
                    </div>

                    <div class="text-center w-full">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold bg-[#f4dfcb]/50 text-[#716252] rounded-md uppercase tracking-wide mb-2">{{ $book->category }}</span>
                        <h2 class="font-['Literata'] text-xl font-black text-gray-900 leading-snug mb-1">{{ $book->title }}</h2>
                        <p class="font-['Source_Serif_4'] text-sm text-gray-400 italic">Karya : {{ $book->author }}</p>
                    </div>
                </div>

                <div class="bg-white border border-[#e8dfd1] rounded-2xl p-6 sm:p-8 shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)]">
                    <h3 class="font-['Literata'] text-sm font-bold text-gray-900 uppercase tracking-wider border-b border-gray-100 pb-3 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-[#5f3822]">description</span> Deskripsi Buku
                    </h3>
                    <p class="text-sm text-gray-600 leading-relaxed font-['Source_Serif_4'] whitespace-pre-line bg-[#fcf9f0]/40 p-4 rounded-xl border border-gray-100/60 shadow-inner italic">
                        {{ $book->description ?? 'Penulis belum menyertakan catatan ringkasan cerita pendek mengenai karya cetak digital ini.' }}
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white border border-[#e8dfd1] p-5 rounded-2xl shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 bg-[#5f3822]/5 text-[#5f3822] rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">payments</span>
                        </div>
                        <div>
                            <span class="text-[9px] font-bold tracking-wider text-gray-400 uppercase block">Harga Jual</span>
                            <span class="font-['Literata'] text-lg font-black text-[#5f3822]">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="bg-white border border-[#e8dfd1] p-5 rounded-2xl shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 bg-gray-50 text-gray-700 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">inventory_2</span>
                        </div>
                        <div>
                            <span class="text-[9px] font-bold tracking-wider text-gray-400 uppercase block">Sisa Stok</span>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="font-sans text-base font-bold text-gray-900">{{ $book->stock }} Buku</span>
                                @if($book->stock == 0)
                                    <span class="px-1.5 py-0.5 text-[9px] font-bold uppercase rounded bg-red-50 text-red-600 border border-red-100">Habis</span>
                                @elseif($book->stock <= 5)
                                    <span class="px-1.5 py-0.5 text-[9px] font-bold uppercase rounded bg-amber-50 text-amber-600 border border-amber-100">Kritis</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-[#e8dfd1] rounded-2xl p-6 sm:p-8 shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)]">
                    <h3 class="font-['Literata'] text-sm font-bold text-gray-900 uppercase tracking-wider border-b border-gray-100 pb-3 mb-5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base text-[#5f3822]">import_contacts</span> Informasi Buku
                    </h3>
                    
                    <div class="divide-y divide-gray-100 text-sm">
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Kategori Buku</span>
                            <span class="text-gray-900 font-bold bg-gray-100 px-3 py-1 rounded-lg text-xs border border-gray-200/60">{{ $book->category }}</span>
                        </div>
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Penerbit</span>
                            <span class="text-gray-900 font-semibold">{{ $book->publisher ?? 'Menerbitkan Sendiri (Self-Published)' }}</span>
                        </div>
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Tahun</span>
                            <span class="text-gray-900 font-mono font-bold">{{ $book->year }}</span>
                        </div>
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Total Halaman</span>
                            <span class="text-gray-900 font-mono font-semibold">{{ $book->pages ?? 0 }} Halaman Cetak</span>
                        </div>
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Bahasa</span>
                            <span class="text-gray-900 font-bold uppercase text-xs tracking-wider border border-gray-200 px-2.5 py-0.5 bg-gray-50 rounded-md">
                                {{ $book->language ?? 'indonesia' }}
                            </span>
                        </div>
                        <div class="py-3.5 flex justify-between items-center gap-4">
                            <span class="text-gray-400 font-medium">Warna Cover Book</span>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full border border-black/10 block shadow-sm" style="background-color: {{ $book->cover_color }}"></span>
                                <span class="text-gray-700 font-mono text-xs font-bold uppercase">{{ $book->cover_color ?? '#c8a96e' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#f6f3eb]/40 border border-[#e8dfd1] rounded-2xl p-5 text-xs text-gray-400 font-medium flex flex-col sm:flex-row justify-between gap-3 select-none">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                        Terdaftar di katalog pada: <span class="text-gray-600 font-bold">{{ $book->created_at->format('d F Y (H:i)') }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        Terakhir diperbarui: <span class="text-gray-600 font-bold">{{ $book->updated_at->format('d F Y (H:i)') }}</span>
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>
@endsection