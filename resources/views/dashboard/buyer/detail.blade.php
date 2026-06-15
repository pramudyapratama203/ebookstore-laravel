@extends('layouts.buyer')

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    @if(session('success'))
        <div id="success-alert" class="fixed top-4 left-4 right-4 sm:left-auto sm:right-6 max-w-sm z-50 transition-all duration-500 opacity-100 transform translate-y-0">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl flex items-center gap-3 text-sm shadow-lg">
                <span class="material-symbols-outlined text-xl text-emerald-600">check_circle</span>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-16 py-12 pt-32 md:pt-40">
        
        <form action="{{ route('cart.add', $book->id) }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">
                
                <div class="lg:col-span-5 flex justify-center w-full">
                    <div class="w-full aspect-[3/4] max-w-[320px] sm:max-w-[380px] rounded-2xl shadow-md overflow-hidden relative border border-gray-200 shrink-0 bg-gray-200" style="background: {{ $book->cover_color ?? '#7a4f37' }}">
                        @if($book->cover_image)
                            <img
                                src="{{ $book->cover_image }}"
                                alt="{{ $book->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-white/40">
                                <span class="material-symbols-outlined text-5xl">book</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-7 w-full space-y-6">
                    
                    <div>
                        <span class="inline-block px-3 py-1 bg-[#7a4f37]/5 text-[#7a4f37] text-xs font-bold rounded-md uppercase tracking-wider mb-3">
                            {{ $book->genre ?? 'Umum' }}
                        </span>
                        
                        <h1 class="font-['Playfair_Display'] text-2xl sm:text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
                            {{ $book->title }}
                        </h1>
                        
                        <p class="text-sm sm:text-base text-gray-400 font-medium mt-1">
                            Karya <span class="text-[#7a4f37] font-semibold italic">{{ $book->author }}</span>
                        </p>
                    </div>

                    <div class="text-2xl sm:text-3xl font-black text-[#7a4f37] bg-white inline-block px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </div>

                    <div class="border-b border-gray-200"></div>

                    <div>
                        <h3 class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-2">Sinopsis Buku</h3>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed text-justify">
                            {{ $book->description ?? 'Belum ada deskripsi untuk buku ini.' }}
                        </p>
                    </div>

                    <div class="border-b border-gray-200"></div>

                    <div class="space-y-4">
                        <h3 class="text-xs uppercase tracking-widest text-gray-400 font-bold">Tentukan Jumlah</h3>

                        @if($book->stock > 0)
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-bold text-green-700 bg-green-50 px-2.5 py-1 rounded-lg border border-green-200">
                                    Stok tersedia: {{ $book->stock }}
                                </span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-bold text-red-700 bg-red-50 px-2.5 py-1 rounded-lg border border-red-200">
                                    Stok habis
                                </span>
                            </div>
                        @endif
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 w-full">
                            
                            <div class="flex items-center gap-3 bg-gray-100 p-1.5 rounded-xl border border-gray-200 w-full sm:w-auto justify-between sm:justify-start">
                                <button type="button" id="btn-dec" class="w-10 h-10 flex items-center justify-center bg-white rounded-lg text-lg font-bold text-gray-700 hover:bg-gray-50 shadow-sm transition active:scale-95">-</button>
                                
                                <span id="qty-text" class="text-sm font-black text-gray-800 px-4 min-w-[2.5rem] text-center">1</span>
                                
                                <input type="hidden" name="quantity" id="quantity-input" value="1">
                                
                                <button type="button" id="btn-inc" class="w-10 h-10 flex items-center justify-center bg-white rounded-lg text-lg font-bold text-gray-700 hover:bg-gray-50 shadow-sm transition active:scale-95">+</button>
                            </div>

                            <button type="submit" class="w-full sm:flex-1 bg-[#7a4f37] text-white h-14 rounded-xl text-sm font-bold uppercase tracking-wider shadow-md hover:bg-[#633f2b] active:scale-[0.98] transition-all {{ $book->stock < 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $book->stock < 1 ? 'disabled' : '' }}>
                                🛒 Tambah ke Keranjang
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('success-alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.remove('opacity-100', 'translate-y-0');
                alertBox.classList.add('opacity-0', '-translate-y-4'); 
                setTimeout(() => { alertBox.remove(); }, 500); 
            }, 3000); 
        }

        const btnInc = document.getElementById('btn-inc');
        const btnDec = document.getElementById('btn-dec');
        const qtyText = document.getElementById('qty-text');
        const qtyInput = document.getElementById('quantity-input');
        const maxStock = {{ $book->stock }};

        btnInc.addEventListener('click', () => {
            let currentQty = parseInt(qtyText.textContent);
            if (currentQty < maxStock) {
                currentQty++;
                qtyText.textContent = currentQty;
                qtyInput.value = currentQty;
            }
        });

        btnDec.addEventListener('click', () => {
            let currentQty = parseInt(qtyText.textContent);
            if (currentQty > 1) {
                currentQty--;
                qtyText.textContent = currentQty;
                qtyInput.value = currentQty; 
            }
        });
    });
</script>
@endsection