@extends('layouts.buyer')

@section('title', 'Detail Pesanan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-gray-50 min-h-screen">
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-16 py-16 min-h-[716px] pt-32">
        
        <header class="mb-8 border-b border-gray-200/60 pb-6">
            <h1 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Pesanan Anda</h1>
            <p class="text-xs sm:text-sm text-gray-400 font-['Source_Serif_4'] italic">Pantau status transaksi belanja dan riwayat koleksi literasi membaca Anda.</p>
        </header>

        <!-- Notifikasi Berhasil Kirim Ulasan Otomatis Menghilang -->
        @if(session('success'))
            <div id="success-alert" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm transition-all duration-500 opacity-100">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Pencarian & Status -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-[#e8dfd1] mb-8">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" id="search-order" placeholder="Cari judul buku atau penulis..." 
                        class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                </div>
                <div class="flex gap-3">
                    <select id="filter-status" class="px-4 py-2.5 text-sm rounded-xl border border-gray-200 bg-white text-gray-900 font-medium focus:outline-none focus:border-[#5f3822] cursor-pointer min-w-[160px]">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Diproses</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Daftar Kartu Pesanan Pembeli -->
        <div class="flex flex-col gap-6 sm:gap-8">
            @forelse ($orders as $order)
                <div class="order-card bg-white border border-[#e8dfd1] rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-[0_8px_30px_rgb(122,79,55,0.06)]"
                    data-title="{{ strtolower($order->book->title ?? '') }}"
                    data-status="{{ $order->status ?? 'pending' }}" 
                    data-author="{{ strtolower($order->book->author ?? '') }}">
                    
                    <!-- Bagian Atas Kartu (Header) -->
                    <div class="p-5 sm:p-6 border-b border-gray-100 bg-[#f6f3eb]/40 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex flex-wrap gap-4 sm:gap-6 items-center">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Tanggal Pesanan</span>
                                <span class="text-xs sm:text-sm font-semibold text-gray-900">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Nomor Invoice</span>
                                <span class="text-xs sm:text-sm font-mono font-semibold text-gray-700">{{ $order->invoice_number ?? 'INV/' . $order->created_at->format('Ymd') . '/WCL/' . $order->id }}</span>
                            </div>
                        </div>
                        
                        <div>
                            @if($order->status == 'pending')
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-gray-200">Pending</span>
                            @elseif($order->status == 'processing')
                                <span class="inline-block px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-amber-200">Diproses</span>
                            @elseif($order->status == 'completed')
                                <span class="inline-block px-3 py-1 bg-green-50 text-green-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-green-200">Selesai</span>
                            @else
                                <span class="inline-block px-3 py-1 bg-red-50 text-red-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-red-200">Batal</span>
                            @endif
                        </div>
                    </div>

                    <!-- Bagian Tengah Kartu (Body) -->
                    <div class="p-5 sm:p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 md:gap-8 border-b border-gray-100">
                        <div class="w-24 h-36 flex-shrink-0 shadow-md rounded-xl border border-black/10 relative overflow-hidden" style="background: {{ $order->book->cover_color ?? '#c8a96e' }}">
                            <div class="absolute left-1 top-0 bottom-0 w-1.5 bg-black/10 z-10"></div>
                            @if($order->book && $order->book->cover_image)
                                <img src="{{ $order->book->cover_image }}" alt="{{ $order->book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-white/40">
                                    <span class="material-symbols-outlined text-4xl select-none">book</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-grow text-center sm:text-left">
                            <span class="inline-block px-2 py-0.5 bg-[#f4dfcb]/50 text-[#716252] font-bold rounded text-[10px] uppercase tracking-wide mb-1.5">
                                {{ $order->book->category ?? 'Umum' }}
                            </span>
                            <h3 class="font-['Literata'] text-lg sm:text-xl font-bold text-gray-900 mb-1 leading-snug">
                                {{ $order->book->title ?? 'Buku Tidak Tersedia' }}
                            </h3>
                            <p class="font-['Source_Serif_4'] text-xs sm:text-sm text-gray-400 italic mb-4">Oleh {{ $order->book->author ?? 'Anonim' }}</p>
                            <p class="text-xs text-gray-900 font-bold bg-gray-100 inline-block px-3 py-1 rounded-lg border border-gray-200/60">Jumlah: {{ $order->qty ?? 1 }} Pcs</p>
                        </div>
                        
                        <div class="text-center sm:text-right flex flex-col items-center sm:items-end gap-1 shrink-0 bg-[#5f3822]/5 p-4 rounded-xl border border-[#5f3822]/5 w-full sm:w-auto">
                            <span class="text-[9px] font-bold tracking-wider text-gray-400 uppercase">Total Pembayaran</span>
                            <span class="font-['Literata'] text-xl font-black text-[#5f3822]"> Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Bagian Bawah Kartu (Footer) -->
                    <div class="px-5 py-4 sm:px-6 md:px-8 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-3">
                        <p class="text-xs text-gray-900 font-semibold w-full sm:w-auto text-center sm:text-left">
                            Penjual: <span class="text-[#5f3822] font-bold">{{ $order->book->seller->name ?? 'Toko Buku' }}</span>
                        </p>

                        <div class="flex flex-wrap items-center justify-center sm:justify-end gap-3 w-full sm:w-auto">
                            <!-- Tombol muncul jika status selesai (completed) tapi rating belum pernah diisi -->
                            @if($order->status == 'completed' && is_null($order->rating))
                                <button type="button" 
                                    class="w-full sm:w-auto px-5 py-2 bg-amber-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-amber-700 transition-all shadow-sm flex items-center justify-center gap-1.5"
                                    onclick="openReviewModal('{{ $order->id }}', '{{ $order->book->title }}')">
                                    <span class="material-symbols-outlined text-sm">rate_review</span> Beri Ulasan
                                </button>
                            @endif

                            <!-- REVISI PERBAIKAN: Menggunakan is_null yang benar untuk mendeteksi ulasan yang sukses tersimpan -->
                            @if(!is_null($order->rating))
                                <span class="text-xs text-green-600 font-bold flex items-center gap-1 bg-green-50 px-3 py-1.5 rounded-lg border border-green-200/60 shadow-sm select-none">
                                    <span class="material-symbols-outlined text-sm fill-green-600" style="font-variation-settings: 'FILL' 1">check_circle</span> Telah Diulas
                                </span>
                            @endif

                            @if($order->status == 'pending' || $order->status == 'processing')
                                <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="w-full px-5 py-2 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-red-700 transition-all shadow-sm flex items-center justify-center gap-1.5">
                                        <span class="material-symbols-outlined text-sm">cancel</span> Batalkan
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('order.buyer.detail', $order->id) }}" class="w-full sm:w-auto block text-center">
                                <button type="button" class="w-full px-5 py-2 bg-white border border-gray-300 text-gray-700 text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-gray-100 transition-all shadow-sm">
                                    Detail Pesanan
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="bg-white py-20 text-center rounded-2xl border border-[#e8dfd1] shadow-sm px-4">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-3 block">search_off</span>
                    <p class="font-['Source_Serif_4'] text-gray-500 text-sm">Tidak ada transaksi pesanan yang terekam.</p>
                </div>
            @endforelse
        </div>

        <div id="empty-order-alert" class="hidden bg-white py-20 text-center rounded-2xl border border-[#e8dfd1] shadow-sm px-4">
            <span class="material-symbols-outlined text-5xl text-gray-300 mb-3 block">filter_list_off</span>
            <p class="font-['Source_Serif_4'] text-gray-500 text-sm">Tidak ditemukan data orderan yang cocok.</p>
        </div>
        
    </main>
</div>

<!-- POPUP MODAL COMPONENT FORM INPUT REVIEW -->
<div id="reviewModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-[#e8dfd1] transform scale-95 transition-transform duration-300 relative">
        
        <div class="flex justify-between items-start mb-5">
            <h4 class="font-['Literata'] text-lg font-bold text-gray-900 pr-4">Beri Ulasan Buku</h4>
            <button type="button" onclick="closeReviewModal()" class="text-gray-400 hover:text-black transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- REVISI FORM: Atribut action dikosongkan agar diisi dinamis via JavaScript openReviewModal -->
        <form id="form-review" method="POST" action="">
            @csrf
            <div class="space-y-5">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Buku Yang Dibeli</span>
                    <p id="review-book-title" class="text-sm font-bold text-[#5f3822]">Nama Judul Buku</p>
                </div>
                
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Pilih Rating Bintang <span class="text-red-500">*</span></span>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="rating" id="input-rating-value" value="5">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-2xl cursor-pointer text-amber-500 fill-amber-500 star-btn transition-transform hover:scale-110" 
                                  data-value="{{ $i }}" onclick="selectStarRating({{ $i }})" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                    </div>
                </div>

                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Deskripsi Ulasan Anda <span class="text-red-500">*</span></span>
                    <textarea name="review" required rows="4" minlength="5" maxlength="1000"
                        class="w-full bg-[#fcf9f0]/30 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 resize-none placeholder-gray-400 shadow-sm"
                        placeholder="Bagaimana kualitas cetakan buku, isi cerita, atau pelayanan pengemasan toko? Ceritakan di sini..."></textarea>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 flex gap-3">
                <button type="button" onclick="closeReviewModal()" class="w-1/3 border border-gray-300 text-gray-700 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <button type="submit" class="w-2/3 bg-[#5f3822] text-white py-3 rounded-xl text-sm font-bold shadow-md hover:bg-[#7a4f37] transition-all">
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
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

                // REVISI LIVE-FILTER: Sinkronisasi kata selesai ke completed agar pencarian JavaScript berfungsi
                const normalizedFilterStatus = selectedStatus === 'selesai' ? 'completed' : (selectedStatus === 'proses' ? 'processing' : selectedStatus);

                const matchesKeyword = title.includes(keyword) || author.includes(keyword);
                const matchesStatus = normalizedFilterStatus === "" || status === normalizedFilterStatus;

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

        if (searchInput) searchInput.addEventListener('input', filterOrders);
        if (statusFilter) statusFilter.addEventListener('change', filterOrders);

        // Efek Flash Message Sukses Otomatis Menghilang
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.classList.remove('opacity-100');
                successAlert.classList.add('opacity-0');
                setTimeout(function() {
                    successAlert.remove();
                }, 500);
            }, 3000);
        }
    });

    function openReviewModal(orderId, bookTitle) {
        document.getElementById('review-book-title').innerText = bookTitle;
        const form = document.getElementById('form-review');
        form.action = `/home/buyer/order/rate/${orderId}`;

        selectStarRating(5);

        const modal = document.getElementById('reviewModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.firstElementChild.classList.remove('scale-95');
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.firstElementChild.classList.add('scale-95');
    }

    function selectStarRating(score) {
        document.getElementById('input-rating-value').value = score;
        const stars = document.querySelectorAll('.star-btn');
        
        stars.forEach(star => {
            const val = parseInt(star.getAttribute('data-value'));
            if (val <= score) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-amber-500', 'fill-amber-500');
                star.style.fontVariationSettings = "'FILL' 1";
            } else {
                star.classList.remove('text-amber-500', 'fill-amber-500');
                star.classList.add('text-gray-300');
                star.style.fontVariationSettings = "'FILL' 0";
            }
        });
    }
</script>
@endsection