@extends('layouts.buyer')

@section('title', 'Keranjang Saya')

@section('content')
<div class="pt-24 pb-20 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6 max-w-4xl">
        
        <h1 class="font-['Playfair_Display'] text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

        @if($carts->count() > 0)
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" id="search-cart" placeholder="Cari buku di keranjang..." 
                           class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                </div>
                
                <div class="flex gap-3">
                    <select id="filter-price" class="px-4 py-2.5 text-sm rounded-xl border border-gray-200 bg-white text-gray-700 focus:outline-none focus:border-[#c8a96e] cursor-pointer min-w-[180px]">
                        <option value="default">Urutan Standar</option>
                        <option value="price-asc">Harga Rendah ke Tinggi</option>
                        <option value="price-desc">Harga Tinggi ke Rendah</option>
                    </select>
                </div>
            </div>

            <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                @csrf
                
                <div class="space-y-4">
                    @foreach($carts as $cart)
                        <div class="cart-item flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100" 
                            data-price="{{ $cart->book->price }}" 
                            data-title="{{ strtolower($cart->book->title) }}"
                            data-author="{{ strtolower($cart->book->author) }}"
                            data-id="{{ $cart->id }}">
                            
                            <div class="w-16 h-24 rounded-lg shrink-0 shadow-inner" style="background: {{ $cart->book->cover_color ?? '#c8a96e' }}"></div>
                            
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-sm sm:text-base">{{ $cart->book->title }}</h3>
                                <p class="text-gray-400 text-xs mt-0.5">{{ $cart->book->author }}</p>
                                <div class="text-[#c8a96e] font-extrabold text-sm mt-2">
                                    Rp {{ number_format($cart->book->price, 0, ',', '.') }}
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2 bg-gray-100 p-1 rounded-xl">
                                <button type="button" class="btn-decrease w-8 h-8 flex items-center justify-center bg-white rounded-lg text-sm font-bold hover:bg-gray-50 shadow-sm transition">-</button>
                                
                                <span class="quantity-value text-sm font-bold px-2">{{ $cart->qty ?? 1 }}</span>
                                
                                <input type="hidden" name="cart_quantities[{{ $cart->id }}]" class="input-quantity" value="{{ $cart->qty ?? 1 }}">
                                
                                <button type="button" class="btn-increase w-8 h-8 flex items-center justify-center bg-white rounded-lg text-sm font-bold hover:bg-gray-50 shadow-sm transition">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Total Pembayaran</span>
                        <span id="total-payment" class="text-2xl font-black text-[#c8a96e]">Rp 0</span>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#c8a96e] text-white rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#b0925a] transition shadow-md">
                        Lanjut ke Checkout
                    </button>
                </div>
            </form>
            
            @foreach($carts as $cart)
                <form id="delete-form-{{ $cart->id }}" action="{{ route('cart.remove', $cart->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

        @else
            <div class="bg-white py-16 text-center rounded-2xl shadow-sm border border-gray-100">
                <span class="text-5xl block mb-3">🛒</span>
                <p class="text-gray-400 text-sm font-medium">Keranjang belanja Anda masih kosong.</p>
                <a href="{{ route('home.buyer') }}" class="inline-block mt-4 text-xs font-bold uppercase tracking-wider text-[#c8a96e] hover:underline">Cari Buku Sekarang</a>
            </div>
        @endif

    </div>
</div>

<script>
    const searchInput = document.getElementById('search-cart');
    const emptySearchAlert = document.getElementById('empty-search-alert');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            let visibleItems = 0;
            const items = document.querySelectorAll('.cart-item');

            items.forEach(item => {
                const title = item.getAttribute('data-title');
                const author = item.getAttribute('data-author');

                if (title.includes(keyword) || author.includes(keyword)) {
                    item.classList.remove('hidden');
                    item.classList.add('flex');
                    visibleItems++;
                } else {
                    item.classList.remove('flex');
                    item.classList.add('hidden');
                }
            });

            if (visibleItems === 0 && keyword !== '') {
                emptySearchAlert.classList.remove('hidden');
            } else {
                emptySearchAlert.classList.add('hidden');
            }

            calculateTotalPayment();
        });
    }

    const priceFilter = document.getElementById('filter-price');
    const container = document.getElementById('cart-items-container');

    if (priceFilter && container) {
        priceFilter.addEventListener('change', function() {
            const mode = this.value;
            const items = Array.from(container.querySelectorAll('.cart-item'));

            if (mode === 'default') return;

            items.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));
                return mode === 'price-asc' ? priceA - priceB : priceB - priceA;
            });

            items.forEach(item => container.appendChild(item));
        });
    }

    function calculateTotalPayment() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const qty = parseInt(item.querySelector('.quantity-value').textContent);
            total += (price * qty);
        });
        
        document.getElementById('total-payment').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    calculateTotalPayment();

    document.querySelectorAll('.cart-item').forEach(item => {
        const btnIncrease = item.querySelector('.btn-increase');
        const btnDecrease = item.querySelector('.btn-decrease');
        const quantityValue = item.querySelector('.quantity-value');
        const inputQuantity = item.querySelector('.input-quantity');
        const cartId = item.getAttribute('data-id');

        btnIncrease.addEventListener('click', () => {
            let currentQty = parseInt(quantityValue.textContent);
            currentQty++;
            
            quantityValue.textContent = currentQty; 
            inputQuantity.value = currentQty;      
            calculateTotalPayment();              
        });

        btnDecrease.addEventListener('click', () => {
            let currentQty = parseInt(quantityValue.textContent);
            
            if (currentQty > 1) { 
                currentQty--;
                quantityValue.textContent = currentQty;
                inputQuantity.value = currentQty;      
                calculateTotalPayment();              
            } else if (currentQty === 1) {
                if (confirm('Apakah Anda ingin menghapus buku ini dari keranjang belanja?')) {
                    const deleteForm = document.getElementById(`delete-form-${cartId}`);
                    if (deleteForm) {
                        deleteForm.submit(); 
                    }
                }
            }
        });
    });
</script>
@endsection