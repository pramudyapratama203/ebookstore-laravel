@extends('layouts.seller')

@section('title', 'Preview Penjualan')

@section('content')
<main class="w-full pt-24 px-4 sm:px-6 lg:px-8 pb-12 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="max-w-[1280px] mx-auto">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-[#5f3822]">
                    Preview Laporan Penjualan
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 font-['Source_Serif_4'] italic">
                    {{ $user->store_name ?? $user->name }} &mdash; Dicetak: {{ now()->format('d/m/Y H:i') }}
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('seller.export.sales.excel') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#5f3822] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#7a4f37] active:scale-[0.98] transition-all duration-200 shadow-sm">
                    <span class="material-symbols-outlined text-sm">download</span> Download Excel
                </a>
                <a href="{{ route('seller.export.sales.pdf') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-[#5f3822] text-[#5f3822] text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#5f3822] hover:text-white active:scale-[0.98] transition-all duration-200 shadow-sm">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> Download PDF
                </a>
                <a href="{{ route('home.seller') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 active:scale-[0.98] transition-all duration-200">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
                </a>
            </div>
        </div>

        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-[#e8dfd1] text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">Judul Buku</th>
                            <th class="py-3 px-4 text-right">Harga</th>
                            <th class="py-3 px-4 text-center">Total Qty Terjual</th>
                            <th class="py-3 px-4 text-center">Jumlah Pesanan</th>
                            <th class="py-3 px-4 text-right">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grouped as $item)
                            <tr class="border-b border-[#f4dfcb]/30 hover:bg-[#fcf9f0] transition-colors">
                                <td class="py-3 px-4 font-medium text-[#5f3822]">{{ $item['book']->title }}</td>
                                <td class="py-3 px-4 text-right">Rp {{ number_format($item['book']->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center font-bold text-lg">{{ $item['total_qty'] }}</td>
                                <td class="py-3 px-4 text-center">{{ $item['order_count'] }}x</td>
                                <td class="py-3 px-4 text-right font-semibold">Rp {{ number_format($item['total_amount'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400">Belum ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-[#f4dfcb]/30 font-bold">
                            <td colspan="3" class="py-3 px-4 text-right text-[#5f3822]">Total Keseluruhan</td>
                            <td class="py-3 px-4 text-center text-[#5f3822]">{{ $grouped->sum('order_count') }}x</td>
                            <td class="py-3 px-4 text-right text-[#5f3822]">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection