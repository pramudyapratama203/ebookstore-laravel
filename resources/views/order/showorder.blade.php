@extends('layouts.buyer')

@section('title', 'Detail Pesanan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-gray-50 min-h-screen">
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-16 py-16 min-h-[716px] pt-32">
        
        <header class="mb-8">
            <h1 class="font-['Playfair_Display'] text-3xl sm:text-5xl font-bold text-gray-900 mb-3">Pesanan Anda</h1>
            <div class="w-16 h-1 bg-[#5f3822] rounded-full"></div>
        </header>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col sm:flex-row gap-4">
                
                <div class="flex-1 relative">
                    <input type="text" id="search-order" placeholder="Cari judul buku atau penulis..." 
                        class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822]">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                </div>
                
                <div class="flex gap-3">
                    <select id="filter-status" class="px-4 py-2.5 text-sm rounded-xl border border-gray-200 bg-white text-gray-700 focus:outline-none focus:border-[#5f3822] cursor-pointer min-w-[160px]">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="proses">Diproses</option>
                        <option value="dikirim">Sedang Dikirim</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="flex flex-col gap-6 sm:gap-8">
            @forelse ($orders as $order)
                <div class="order-card bg-white border border-[#e8dfd1] rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-[0_8px_30px_rgb(122,79,55,0.08)]"
                    data-title="{{ strtolower($order->book->title ?? '') }}"
                    data-status="{{ $order->status ?? 'pending' }}" 
                    data-author="{{ strtolower($order->book->author ?? '') }}">
                    
                    <div class="p-5 sm:p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 bg-[#f6f3eb]/50 gap-4">
                        <div class="flex flex-wrap gap-4 sm:gap-6 items-center">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Tanggal Pesanan</span>
                                <span class="text-xs sm:text-sm font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Nomor Invoice</span>
                                <span class="text-xs sm:text-sm font-mono font-semibold text-gray-700">{{ $order->invoice_number ?? 'INV/' . $order->created_at->format('Ymd') . '/WCL/' . $order->id }}</span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="ex-libris-tag {{ $order->status == 'selesai' ? 'opacity-70' : '' }}">
                                <span class="text-[10px] font-bold text-[#5f3822] uppercase tracking-wider">
                                    {{ $order->status ?? 'pending' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 md:p-8 flex flex-col sm:flex-row items-center gap-6 md:gap-8 border-b border-gray-50">
                        <div class="w-24 h-36 flex-shrink-0 shadow-md rounded-xl overflow-hidden border border-gray-100 relative" style="background: {{ $order->book->cover_color ?? '#c8a96e' }}">
                            @if($order->book && $order->book->cover_image)
                                <img src="{{ $order->book->cover_image }}" alt="{{ $order->book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-white/40">
                                    <span class="material-symbols-outlined text-4xl">book</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-grow text-center sm:text-left">
                            <span class="inline-block px-2 py-0.5 bg-gray-100 text-gray-500 rounded text-[10px] font-bold uppercase tracking-wide mb-1.5">{{ $order->book->genre ?? 'Umum' }}</span>
                            <h3 class="font-['Playfair_Display'] text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-1 leading-snug">
                                {{ $order->book->title ?? 'Buku Tidak Tersedia' }}
                            </h3>
                            <p class="font-['Source_Serif_4'] text-xs sm:text-sm text-gray-400 italic mb-3">Oleh {{ $order->book->author ?? 'Anonim' }}</p>
                            <p class="text-xs text-gray-500 font-semibold bg-gray-50 inline-block px-2.5 py-1 rounded-md border border-gray-100">Jumlah: {{ $order->qty ?? 1 }}</p>
                        </div>
                        
                        <div class="text-center sm:text-right flex flex-col items-center sm:items-end gap-1 shrink-0 bg-[#5f3822]/5 p-4 rounded-xl border border-[#5f3822]/5 w-full sm:w-auto">
                            <span class="text-[9px] font-bold tracking-wider text-gray-400 uppercase">Total Pembayaran</span>
                            <span class="font-['Playfair_Display'] text-xl md:text-2xl font-black text-[#5f3822]"> Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="px-5 py-4 sm:px-6 md:px-8 bg-gray-50/50 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="#" class="w-full sm:w-auto">
                            <button type="button" class="btn-action w-full sm:px-6 py-2.5 bg-white border border-[#5f3822] text-[#5f3822] text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#5f3822]/5 transition-all shadow-sm">
                                Detail Pesanan
                            </button>
                        </a>
                    </div>

                </div>
            @empty
                <div class="bg-white py-20 text-center rounded-2xl border border-[#e8dfd1] shadow-sm px-4">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-3 block">search_off</span>
                    <p class="font-['Source_Serif_4'] text-gray-500 text-sm">
                        Tidak ada pesanan yang ditemukan.
                    </p>
                </div>
            @endforelse
        </div>
        
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-order');
        const statusFilter = document.getElementById('filter-status');
        const emptyOrderAlert = document.getElementById('empty-order-alert');
        const orderItems = document.querySelectorAll('.order-card');

        function filterOrders() {
            const keyword = searchInput.value.toLowerCase().trim();
            const selectedStatus = statusFilter.value.toLowerCase();
            let visibleCount = 0;

            orderItems.forEach(item => {
                const title = item.getAttribute('data-title');
                const author = item.getAttribute('data-author');
                const status = item.getAttribute('data-status');

                const matchesKeyword = title.includes(keyword) || author.includes(keyword);
                
                const matchesStatus = selectedStatus === "" || status === selectedStatus;

                if (matchesKeyword && matchesStatus) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (visibleCount === 0 && (keyword !== '' || selectedStatus !== '')) {
                emptyOrderAlert.classList.remove('hidden');
            } else {
                emptyOrderAlert.classList.add('hidden');
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterOrders);
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', filterOrders);
        }
    });
</script>
@endsection