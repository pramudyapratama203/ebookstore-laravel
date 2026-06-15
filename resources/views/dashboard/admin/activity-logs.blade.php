@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<main class="w-full pt-24 px-4 sm:px-6 lg:px-8 pb-12 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="max-w-[1280px] mx-auto">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8">
            <div class="text-center sm:text-left">
                <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-[#5f3822]">
                    Log Aktivitas
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 font-['Source_Serif_4'] italic">
                    Riwayat aktivitas seluruh pengguna (Buyer, Seller, Admin).
                </p>
            </div>
        </div>

        <section class="bg-white p-6 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)]">
            <form method="GET" action="{{ route('admin.activity-logs') }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi, modul, admin..." 
                            class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Aksi</label>
                        <select name="action" class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                            <option value="">Semua Aksi</option>
                            @foreach($actions as $a)
                                <option value="{{ $a }}" {{ request('action') == $a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Modul</label>
                        <select name="module" class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                            <option value="">Semua Modul</option>
                            @foreach($modules as $m)
                                <option value="{{ $m }}" {{ request('module') == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" 
                            class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                    </div>
                    <div class="flex flex-col space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" 
                            class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl py-2.5 px-3 text-sm text-gray-700 transition-all">
                    </div>
                </div>
                <div class="flex items-center gap-3 mb-6">
                    <button type="submit" class="bg-[#5f3822] text-white px-5 py-2.5 rounded-xl font-semibold text-sm flex items-center gap-2 hover:bg-[#7a4f37] active:scale-[0.98] transition-all shadow-md">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        Filter
                    </button>
                    @if(request()->anyFilled(['search', 'action', 'module', 'date_from', 'date_to']))
                        <a href="{{ route('admin.activity-logs') }}" class="bg-gray-100 text-gray-600 px-5 py-2.5 rounded-xl font-semibold text-sm flex items-center gap-2 hover:bg-gray-200 active:scale-[0.98] transition-all">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                            Reset
                        </a>
                    @endif
                </div>
            </form>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-[#e8dfd1] text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">Pengguna</th>
                            <th class="py-3 px-4">Aksi</th>
                            <th class="py-3 px-4">Modul</th>
                            <th class="py-3 px-4">Deskripsi</th>
                            <th class="py-3 px-4">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="border-b border-[#f4dfcb]/30 hover:bg-[#fcf9f0] transition-colors">
                                <td class="py-3 px-4 text-gray-600 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                <td class="py-3 px-4 font-medium text-[#5f3822] whitespace-nowrap">{{ $log->user->name ?? 'Unknown' }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($log->action === 'view') bg-blue-50 text-blue-700
                                        @elseif($log->action === 'create') bg-green-50 text-green-700
                                        @elseif($log->action === 'update' || $log->action === 'edit') bg-yellow-50 text-yellow-700
                                        @elseif($log->action === 'delete' || $log->action === 'cancel') bg-red-50 text-red-700
                                        @else bg-gray-50 text-gray-700
                                        @endif">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $log->module }}</td>
                                <td class="py-3 px-4 text-gray-600 max-w-xs truncate">{{ $log->description }}</td>
                                <td class="py-3 px-4 text-gray-400 text-xs">{{ $log->ip_address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-400">
                                    Belum ada aktivitas yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        </section>

    </div>
</main>
@endsection
