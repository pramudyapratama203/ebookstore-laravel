@extends('layouts.seller')

@section('title', 'Dashboard Penjual')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<main class="w-full pt-24 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <section class="relative overflow-hidden mb-10 rounded-2xl border border-[#e8dfd1] bg-[#5f3822] p-6 sm:p-10 lg:p-12 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-[0_4px_20px_rgba(122,79,55,0.12)]">
            <div class="z-10 text-center sm:text-left max-w-2xl">
                <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight">
                    Selamat Datang Kembali, {{ $user->name }}!
                </h2>
                <blockquote class="font-['Source_Serif_4'] italic text-sm sm:text-base text-[#f4dfcb]/90 leading-relaxed border-l-2 border-[#7a4f37] pl-4 mt-2">
                    "A room without books is like a body without a soul. Your stewardship of these pages continues to breathe life into the archives."
                </blockquote>
            </div>
            <div class="hidden md:block z-10 text-white/15 shrink-0">
                <span class="material-symbols-outlined text-[100px] lg:text-[130px] select-none" style="font-variation-settings: 'wght' 200;">history_edu</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-tr from-[#7a4f37]/30 via-transparent to-white/5 pointer-events-none"></div>
        </section>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">Rp {{ number_format($totalEarnings ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl">payments</span>
                </div>
                <div class="flex items-center gap-1.5 text-green-700 text-xs font-medium">
                    <span class="material-symbols-outlined text-sm font-bold">trending_up</span>
                    <span>{{ number_format($earningsChange ?? 0, 0, ',', '.') }}% dari bulan lalu</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Pesanan</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">{{ $orders->count() }} Pesanan</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl">shopping_bag</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-400 text-xs">
                    <span class="material-symbols-outlined text-sm">history</span>
                    <span>Pesanan terakhir 20 menit lalu</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Judul</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">{{ $books->count() }} Judul</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl">menu_book</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-500 text-xs">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    <span>{{ $user->count() }} kunjungan hari ini</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Rata-rata Rating</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">{{ number_format($averageRating, 1) }}</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl">star</span>
                </div>
                <div class="flex items-center gap-1 text-amber-600 text-xs font-semibold">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span>{{ number_format($averageRating, 1) }}/5</span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-8">
            <div class="text-sm font-semibold text-gray-500 self-center mr-2">Export:</div>
            <a href="{{ route('seller.export.sales.excel') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#5f3822] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#7a4f37] active:scale-[0.98] transition-all duration-200 shadow-sm">
                <span class="material-symbols-outlined text-sm">table</span> Excel Penjualan
            </a>
            <a href="{{ route('seller.export.revenue.excel') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#5f3822] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#7a4f37] active:scale-[0.98] transition-all duration-200 shadow-sm">
                <span class="material-symbols-outlined text-sm">payments</span> Excel Pendapatan
            </a>
            <a href="{{ route('seller.export.sales.pdf') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-[#5f3822] text-[#5f3822] text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#5f3822] hover:text-white active:scale-[0.98] transition-all duration-200 shadow-sm">
                <span class="material-symbols-outlined text-sm">picture_as_pdf</span> PDF Penjualan
            </a>
            <a href="{{ route('seller.export.revenue.pdf') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-[#5f3822] text-[#5f3822] text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#5f3822] hover:text-white active:scale-[0.98] transition-all duration-200 shadow-sm">
                <span class="material-symbols-outlined text-sm">description</span> PDF Pendapatan
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="font-['Literata'] text-lg sm:text-xl font-bold text-[#5f3822]">Pesanan Terbaru</h4>
                        <a class="text-sm font-semibold text-[#5f3822] hover:text-[#7a4f37] hover:underline flex items-center gap-1 transition-all" href="#">
                            Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto -mx-6 px-6">
                        <table class="w-full text-left border-collapse min-w-[550px]">
                            <thead>
                                <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="pb-3">Order ID</th>
                                    <th class="pb-3">Pelanggan</th>
                                    <th class="pb-3">Judul Buku</th>
                                    <th class="pb-3 text-right">Total</th>
                                    <th class="pb-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                                @foreach($orders as $order)
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="py-4 font-mono text-xs font-semibold text-gray-500">#ORD-{{ $order->id }}</td>
                                    <td class="py-4 font-medium">{{ $order->buyer->name ?? 'Pembeli' }}</td>
                                    <td class="py-4 italic font-['Source_Serif_4'] text-gray-900 max-w-[180px] truncate">{{ $order->book->title ?? 'Buku' }}</td>
                                    <td class="py-4 text-right font-semibold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="py-4 text-center">
                                        @if($order->status === 'pending')
                                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-yellow-700 bg-yellow-50 rounded-md border border-yellow-200/50">Pending</span>
                                        @elseif($order->status === 'shipped')
                                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-green-700 bg-green-50 rounded-md border border-green-200/50">Shipped</span>
                                        @elseif($order->status === 'delivered')
                                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 rounded-md border border-blue-200/50">Delivered</span>    
                                        @elseif($order->status === 'cancelled')
                                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-red-700 bg-red-50 rounded-md border border-red-200/50">Cancelled</span>
                                        @else
                                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-gray-700 bg-gray-50 rounded-md border border-gray-200/50">Unknown</span>  
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                        <h4 class="font-['Literata'] text-lg sm:text-xl font-bold text-[#5f3822]">Performa Mingguan</h4>
                        <div class="flex items-center gap-4 text-xs font-semibold text-gray-500">
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#5f3822]"></span> Pendapatan
                            </span>
                            <span class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#f4dfcb]"></span> Pengunjung
                            </span>
                        </div>
                    </div>
                    
                    <div class="h-64 flex items-end justify-between gap-2 sm:gap-4 px-2 sm:px-4 pb-2 border-b border-gray-100 overflow-hidden">
                        @foreach($weeklyBars as $dayName => $heights)
                            <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end group">
                                <div class="w-full max-w-[32px] flex items-end gap-0.5 h-[80%] relative">
                                    <div class="w-1/2 bg-[#f4dfcb] rounded-t-sm transition-all group-hover:brightness-95" style="height: {{ $heights['visitor_height'] }}%;"></div>
                                    <div class="w-1/2 bg-[#5f3822] rounded-t-sm transition-all group-hover:brightness-110" style="height: {{ $heights['earning_height'] }}%;"></div>  
                                </div>  
                                <span class="text-[11px] font-medium text-gray-400">{{ $dayName }}</span>
                            </div>
                        @endforeach
                    </div>
                </div> </div>

            <div class="space-y-6">
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] border-l-4 border-l-[#5f3822]">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-[#5f3822] text-xl font-bold">warning</span>
                        <h4 class="font-['Literata'] text-base sm:text-lg font-bold text-[#5f3822]">Sisa Stok</h4>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach ($books as $book)
                            @if ($book->stock < 5)
                                <div class="flex gap-4 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden shadow-inner shrink-0 border border-gray-100 flex items-center justify-center relative" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                                        <span class="material-symbols-outlined text-white/30 text-lg">book</span>
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h5 class="font-['Source_Serif_4'] italic text-sm font-semibold text-gray-900 leading-snug truncate max-w-[160px]">{{ $book->title }}</h5>
                                        <p class="text-[11px] font-bold text-red-600 mt-0.5">Sisa {{ $book->stock }} buku</p>
                                    </div>
                                </div>
                            @elseif ($book->stock <= 10)
                                <div class="flex gap-4 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden shadow-inner shrink-0 border border-gray-100 flex items-center justify-center relative" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                                        <span class="material-symbols-outlined text-white/30 text-lg">book</span>
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h5 class="font-['Source_Serif_4'] italic text-sm font-semibold text-gray-900 leading-snug truncate max-w-[160px]">{{ $book->title }}</h5>
                                        <p class="text-[11px] font-bold text-amber-600 mt-0.5">Sisa {{ $book->stock }} buku</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <a href="{{ route('seller.catalog') }}">
                        <button class="w-full mt-6 py-2.5 bg-transparent border border-[#5f3822] text-[#5f3822] font-semibold text-xs uppercase tracking-wider rounded-xl hover:bg-[#5f3822] hover:text-white active:scale-[0.98] transition-all duration-200 shadow-sm">
                            Kelola Katalog Buku
                        </button>
                    </a>
                </div>
            </div> </div>
    </div>
</main>
@endsection