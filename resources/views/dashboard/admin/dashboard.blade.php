@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<main class="w-full pt-24 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Section Banner Selamat Datang Admin -->
        <section class="relative overflow-hidden mb-10 rounded-2xl border border-[#e8dfd1] bg-[#5f3822] p-6 sm:p-10 lg:p-12 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-[0_4px_20px_rgba(122,79,55,0.12)]">
            <div class="z-10 text-center sm:text-left max-w-2xl">
                <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight">
                    Selamat Datang Kembali, {{ $adminInfo->name ?? 'Administrator' }}!
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

        <!-- GRID 1: 4 Kartu Ringkasan Utama Global Platform -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <!-- Kartu 1: Total Omset Keuangan Platform -->
            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl select-none">payments</span>
                </div>
                <div class="flex items-center gap-1.5 text-green-700 text-xs font-semibold">
                    <span class="material-symbols-outlined text-sm font-bold">trending_up</span>
                    <span>{{ number_format($earningsChange ?? 0, 1) }}% dibanding bulan lalu</span>
                </div>
            </div>

            <!-- Kartu 2: Kuantitas Pengguna Aktif -->
            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pengguna</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">{{ number_format($totalUsers) }} Anggota</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl select-none">group</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-500 text-xs font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>
                    <span>Total seluruh pembeli & penjual</span>
                </div>
            </div>

            <!-- Kartu 3: Kuantitas Buku di Sistem -->
            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Koleksi Buku</p>
                        <h3 class="font-['Literata'] text-xl sm:text-2xl font-bold text-[#5f3822]">{{ number_format($totalBooks) }} Judul Buku</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl select-none">menu_book</span>
                </div>
                <div class="flex items-center gap-1.5 text-gray-400 text-xs font-medium">
                    <span class="material-symbols-outlined text-sm select-none">visibility</span>
                    <span>Tersebar aktif di etalase toko</span>
                </div>
            </div>

            <!-- Kartu 4: Uptime Kinerja Sistem -->
            <div class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] flex flex-col justify-between group hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(122,79,55,0.08)] transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Uptime Server</p>
                        <h3 class="font-['Literata'] text-sm font-bold text-gray-900 truncate max-w-[170px] mt-1">{{ $uptime }}</h3>
                    </div>
                    <span class="p-2 bg-[#5f3822]/5 rounded-xl text-[#5f3822] material-symbols-outlined text-xl select-none">dns</span>
                </div>
                <div class="flex items-center gap-1 text-emerald-600 text-xs font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                    <span>Sistem Terpantau Stabil</span>
                </div>
            </div>
        </div>

        <!-- GRID 2: Dua Kolom Tata Letak Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- KOLOM KIRI (Lebar 2): Tabel Order Terbaru & Chart Mingguan -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Blok Tabel -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="font-['Literata'] text-base sm:text-lg font-bold text-[#5f3822]">Pesanan Terbaru Global</h4>
                        <span class="text-[10px] font-mono font-bold bg-gray-100 text-gray-500 px-2 py-0.5 rounded uppercase">Live Data</span>
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
                                @forelse($latestOrders as $order)
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="py-4 font-mono text-xs font-semibold text-gray-500">#ORD-{{ $order->id }}</td>
                                    <td class="py-4 font-medium">{{ $order->buyer->name ?? 'Pembeli' }}</td>
                                    <td class="py-4 italic font-['Source_Serif_4'] text-gray-900 max-w-[180px] truncate">{{ $order->book->title ?? 'Buku' }}</td>
                                    <td class="py-4 text-right font-semibold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="py-4 text-center">
                                        @if($order->status === 'pending')
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-yellow-700 bg-yellow-50 rounded-md border border-yellow-200/50">Pending</span>
                                        @elseif($order->status === 'processing')
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 rounded-md border border-amber-200/50">Diproses</span>
                                        @elseif($order->status === 'completed')
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-green-700 bg-green-50 rounded-md border border-green-200/50">Selesai</span>
                                        @else
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-red-700 bg-red-50 rounded-md border border-red-200/50">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-xs text-gray-400 italic">Belum ada rekaman transaksi hari ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Blok Grafik Manual -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                        <h4 class="font-['Literata'] text-base sm:text-lg font-bold text-[#5f3822]">Performa Transaksi Mingguan</h4>
                        <div class="flex items-center gap-4 text-xs font-semibold text-gray-500">
                            <span class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#5f3822]"></span> Pendapatan
                            </span>
                            <span class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#f4dfcb]"></span> Aktivitas
                            </span>
                        </div>
                    </div>
                    
                    <div class="h-64 flex items-end justify-between gap-2 sm:gap-4 px-2 sm:px-4 pb-2 border-b border-gray-100 overflow-hidden select-none">
                        @foreach($weeklyBars as $dayName => $heights)
                            <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end group">
                                <div class="w-full max-w-[32px] flex items-end gap-1 h-[80%] relative">
                                    <div class="w-1/2 bg-[#f4dfcb] rounded-t-sm transition-all group-hover:brightness-95 shadow-sm" style="height: {{ $heights['visitor_height'] ?? 10 }}%;"></div>
                                    <div class="w-1/2 bg-[#5f3822] rounded-t-sm transition-all group-hover:brightness-110 shadow-sm" style="height: {{ $heights['earning_height'] ?? 10 }}%;"></div>  
                                </div>  
                                <span class="text-[11px] font-bold text-gray-400">{{ $dayName }}</span>
                            </div>
                        @endforeach
                    </div>
                </div> 
            </div>

            <!-- KOLOM KANAN (Lebar 1): Kontrol Sisa Stok Toko Secara Global -->
            <div class="space-y-6">
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] border-l-4 border-l-[#5f3822]">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-[#5f3822] text-xl font-bold select-none">warning</span>
                        <h4 class="font-['Literata'] text-base sm:text-lg font-bold text-[#5f3822]">Peringatan Inventaris Stok</h4>
                    </div>
                    
                    <div class="space-y-4 max-h-[380px] overflow-y-auto pr-1">
                        @forelse ($lowStockBooks as $book)
                            @if ($book->stock < 5)
                                <div class="flex gap-4 p-2 rounded-xl hover:bg-gray-50 transition-colors border border-red-100/50 bg-red-50/20">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden shadow-inner shrink-0 border border-gray-100 flex items-center justify-center relative select-none" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                                        <span class="material-symbols-outlined text-white/40 text-lg">book</span>
                                    </div>
                                    <div class="flex flex-col justify-center min-w-0 flex-1">
                                        <h5 class="font-['Source_Serif_4'] italic text-sm font-bold text-gray-900 leading-snug truncate">{{ $book->title }}</h5>
                                        <p class="text-[11px] font-black text-red-600 mt-0.5 uppercase tracking-wide flex items-center gap-1">
                                            <span class="w-1 h-1 rounded-full bg-red-600 inline-block"></span> Kritis: Sisa {{ $book->stock }} Pcs
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="flex gap-4 p-2 rounded-xl hover:bg-gray-50 transition-colors border border-amber-100/50 bg-amber-50/20">
                                    <div class="w-10 h-14 rounded-lg overflow-hidden shadow-inner shrink-0 border border-gray-100 flex items-center justify-center relative select-none" style="background: {{ $book->cover_color ?? '#c8a96e' }}">
                                        <span class="material-symbols-outlined text-white/40 text-lg">book</span>
                                    </div>
                                    <div class="flex flex-col justify-center min-w-0 flex-1">
                                        <h5 class="font-['Source_Serif_4'] italic text-sm font-bold text-gray-900 leading-snug truncate">{{ $book->title }}</h5>
                                        <p class="text-[11px] font-bold text-amber-600 mt-0.5 uppercase tracking-wide flex items-center gap-1">
                                            <span class="w-1 h-1 rounded-full bg-amber-500 inline-block"></span> Tipis: Sisa {{ $book->stock }} Pcs
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-xs text-gray-400 italic text-center py-4">Seluruh stok buku di ekosistem terpantau aman.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Garis Pembatas Estetis Bawah Halaman -->
        <div class="py-12 flex items-center justify-center select-none">
            <div class="w-20 h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            <div class="mx-4 text-gray-300 text-[10px]">◆</div>
            <div class="w-20 h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>
        
    </div>
</main>
@endsection