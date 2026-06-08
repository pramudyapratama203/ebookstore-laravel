@extends('layouts.buyer')

@section('title', 'Detail Pesanan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-gray-50 min-h-screen">
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-16 py-16 min-h-[716px] pt-32">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-red-600">error</span>
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('order.showorder') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#7a4f37] hover:text-[#5f3822] transition-all">
                <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Pesanan
            </a>
        </div>

        <header class="mb-8 border-b border-gray-200/60 pb-6">
            <h1 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Detail Pesanan</h1>
            <p class="text-xs sm:text-sm text-gray-400 font-['Source_Serif_4'] italic">Informasi lengkap mengenai transaksi pesanan Anda.</p>
        </header>

        <div class="bg-white border border-[#e8dfd1] rounded-2xl overflow-hidden shadow-sm">

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

            <div class="p-5 sm:p-6 md:p-8 flex flex-col md:flex-row items-start gap-6 md:gap-8 border-b border-gray-100">
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

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Jumlah</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->qty ?? $order->quantity ?? 1 }} Pcs</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Harga Satuan</span>
                            <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($order->book->price ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Penjual</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->book->seller->name ?? 'Toko Buku' }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Penerbit</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->book->publisher ?? '-' }}</p>
                        </div>
                    </div>

                    @if($order->description)
                    <div class="mt-4 bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Catatan Pesanan</span>
                        <p class="text-sm text-gray-700 mt-1 italic">"{{ $order->description }}"</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-5 sm:p-6 md:p-8 border-b border-gray-100 bg-white">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Total Pembayaran</span>
                        <p class="font-['Literata'] text-2xl font-black text-[#5f3822]">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</p>
                    </div>

                    @if($order->status == 'completed' && is_null($order->rating))
                        <button type="button"
                            class="w-full sm:w-auto px-6 py-3 bg-amber-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-amber-700 transition-all shadow-sm flex items-center justify-center gap-1.5"
                            onclick="openReviewModal('{{ $order->id }}', '{{ $order->book->title }}')">
                            <span class="material-symbols-outlined text-sm">rate_review</span> Beri Ulasan
                        </button>
                    @endif

                    @if($order->status == 'pending' || $order->status == 'processing')
                        <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-red-700 transition-all shadow-sm flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">cancel</span> Batalkan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            @if($order->rating)
            <div class="p-5 sm:p-6 md:p-8 bg-green-50/30">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1">star</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Ulasan Anda</span>
                        <div class="flex items-center gap-0.5 mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-sm {{ $i <= $order->rating ? 'text-amber-500 fill-amber-500' : 'text-gray-300' }}" style="font-variation-settings: 'FILL' {{ $i <= $order->rating ? 1 : 0 }}">star</span>
                            @endfor
                        </div>
                        @if($order->review)
                            <p class="text-sm text-gray-700 mt-1.5 italic">"{{ $order->review }}"</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </main>
</div>

<div id="reviewModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-[#e8dfd1] transform scale-95 transition-transform duration-300 relative">
        <div class="flex justify-between items-start mb-5">
            <h4 class="font-['Literata'] text-lg font-bold text-gray-900 pr-4">Beri Ulasan Buku</h4>
            <button type="button" onclick="closeReviewModal()" class="text-gray-400 hover:text-black transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

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
                <button type="button" onclick="closeReviewModal()" class="w-1/3 border border-gray-300 text-gray-700 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all">Batal</button>
                <button type="submit" class="w-2/3 bg-[#5f3822] text-white py-3 rounded-xl text-sm font-bold shadow-md hover:bg-[#7a4f37] transition-all">Kirim Ulasan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.classList.remove('opacity-100');
                successAlert.classList.add('opacity-0');
                setTimeout(function() { successAlert.remove(); }, 500);
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