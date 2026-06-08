@extends('layouts.seller')

@section('title', 'Detail Pesanan Seller')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-gray-50 min-h-screen">
    <main class="w-full max-w-[1280px] mx-auto pt-24 px-4 sm:px-6 lg:px-8 pb-12 transition-all duration-300">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
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
            <a href="{{ route('order.seller') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#7a4f37] hover:text-[#5f3822] transition-all">
                <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Daftar Order
            </a>
        </div>

        <header class="mb-8 border-b border-[#e8dfd1] pb-6">
            <h1 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Detail Pesanan</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-['Source_Serif_4'] italic">Informasi lengkap pesanan masuk untuk buku Anda.</p>
        </header>

        <div class="bg-white border border-[#e8dfd1] rounded-2xl overflow-hidden shadow-sm">

            <div class="p-5 sm:p-6 border-b border-gray-100 bg-[#f6f3eb]/40 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
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
                    <div class="absolute left-1 top-0 bottom-0 w-1.5 bg-black/10"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-white/40">
                        <span class="material-symbols-outlined text-4xl select-none">book</span>
                    </div>
                </div>

                <div class="flex-grow text-center sm:text-left">
                    <span class="inline-block px-2 py-0.5 bg-[#f4dfcb]/50 text-[#716252] font-bold rounded text-[10px] uppercase tracking-wide mb-1.5">{{ $order->book->category ?? 'Umum' }}</span>
                    <h3 class="font-['Literata'] text-lg sm:text-xl font-bold text-gray-900 mb-1 leading-snug">
                        {{ $order->book->title ?? 'Buku Tidak Tersedia' }}
                    </h3>
                    <p class="font-['Source_Serif_4'] text-xs sm:text-sm text-gray-400 italic mb-4">Oleh {{ $order->book->author ?? 'Anonim' }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Jumlah Dibeli</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->qty ?? $order->quantity ?? 1 }} Pcs</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Harga Satuan</span>
                            <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($order->book->price ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Pembeli</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->buyer->name ?? 'Pelanggan' }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Email Pembeli</span>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->buyer->email ?? '-' }}</p>
                        </div>
                    </div>

                    @if($order->description)
                    <div class="mt-4 bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Catatan dari Pembeli</span>
                        <p class="text-sm text-gray-700 mt-1 italic">"{{ $order->description }}"</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-5 sm:p-6 md:p-8 border-b border-gray-100 bg-white">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Total Pendapatan</span>
                        <p class="font-['Literata'] text-2xl font-black text-[#5f3822]">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                            <form action="{{ route('seller.orders.update-status', $order->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                @method('PATCH')
                                @if($order->status == 'pending')
                                    <button type="submit" name="status" value="processing" class="w-full sm:w-auto px-5 py-2 bg-amber-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-amber-700 transition-all shadow-sm flex items-center justify-center gap-1.5">
                                        <span class="material-symbols-outlined text-sm">hourglass_empty</span> Proses Pesanan
                                    </button>
                                @elseif($order->status == 'processing')
                                    <button type="submit" name="status" value="completed" class="w-full sm:w-auto px-5 py-2 bg-green-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-green-700 transition-all shadow-sm flex items-center justify-center gap-1.5">
                                        <span class="material-symbols-outlined text-sm">task_alt</span> Selesai
                                    </button>
                                @endif
                            </form>

                            <form action="{{ route('seller.orders.cancel', $order->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                <button type="submit" class="w-full px-5 py-2 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-red-700 transition-all shadow-sm flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">cancel</span> Batalkan
                                </button>
                            </form>
                        @endif

                        @if($order->status == 'completed')
                            <button type="button"
                                class="w-full sm:w-auto px-5 py-2 bg-white border border-[#c8a96e] text-[#5f3822] text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-amber-50/40 transition-all shadow-sm flex items-center justify-center gap-1.5"
                                onclick="openRatingModal('{{ $order->book->title }}', '{{ $order->rating ?? 5 }}', '{{ $order->review ?? 'Tidak ada ulasan tertulis.' }}')">
                                <span class="material-symbols-outlined text-sm text-amber-500 fill-amber-500" style="font-variation-settings: 'FILL' 1;">star</span> Lihat Rating
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            @if($order->rating)
            <div class="p-5 sm:p-6 md:p-8 bg-green-50/30">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1">star</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Ulasan Pembeli</span>
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

<div id="ratingModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-[#e8dfd1] transform scale-95 transition-transform duration-300 relative">
        <div class="flex justify-between items-start mb-6">
            <h4 class="font-['Literata'] text-lg font-bold text-gray-900 pr-4">Ulasan Pembeli</h4>
            <button type="button" onclick="closeRatingModal()" class="text-gray-400 hover:text-black transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Judul Buku</span>
                <p id="modal-book-title" class="text-sm font-bold text-[#5f3822]">Nama Judul Buku</p>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Penilaian Skor</span>
                <div id="modal-stars-container" class="flex items-center gap-1"></div>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Pesan Feedback</span>
                <div class="bg-[#fcf9f0] p-4 rounded-xl border border-[#e8dfd1]/40 text-sm text-gray-900 font-medium font-['Source_Serif_4'] italic leading-relaxed">
                    "<span id="modal-review-text">Isi ulasan tulisan pembeli.</span>"
                </div>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100">
            <button type="button" onclick="closeRatingModal()" class="w-full bg-[#5f3822] text-white py-3 rounded-xl text-sm font-bold shadow-md hover:bg-[#7a4f37] transition-all">Selesai Membaca</button>
        </div>
    </div>
</div>

<script>
    function openRatingModal(title, score, review) {
        document.getElementById('modal-book-title').innerText = title;
        document.getElementById('modal-review-text').innerText = review;
        const starContainer = document.getElementById('modal-stars-container');
        starContainer.innerHTML = '';
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('span');
            star.className = 'material-symbols-outlined text-xl select-none';
            star.innerText = 'star';
            if (i <= score) {
                star.classList.add('text-amber-500', 'fill-amber-500');
                star.style.fontVariationSettings = "'FILL' 1";
            } else {
                star.classList.add('text-gray-300');
            }
            starContainer.appendChild(star);
        }
        const modal = document.getElementById('ratingModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.firstElementChild.classList.remove('scale-95');
    }

    function closeRatingModal() {
        const modal = document.getElementById('ratingModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.firstElementChild.classList.add('scale-95');
    }
</script>
@endsection