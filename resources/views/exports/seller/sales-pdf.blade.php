<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        h1 { text-align: center; font-size: 20px; color: #5f3822; margin-bottom: 4px; }
        .subtitle { text-align: center; color: #888; font-size: 12px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th { background: #5f3822; color: #fff; padding: 8px 6px; text-align: left; font-size: 10px; text-transform: uppercase; }
        td { padding: 6px; border-bottom: 1px solid #e0d6c8; }
        tr:nth-child(even) td { background: #f9f6f0; }
        .total-row td { font-weight: bold; background: #f4dfcb !important; border-top: 2px solid #5f3822; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { text-align: center; color: #aaa; font-size: 9px; margin-top: 24px; border-top: 1px solid #e0d6c8; padding-top: 12px; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 9px; font-weight: bold; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-processing { background: #dbeafe; color: #1e40af; }
        .badge-completed { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }
        .store-name { text-align: center; font-size: 14px; color: #7a4f37; margin-bottom: 4px; }
    </style>
</head>
<body>
    <h1>Laporan Penjualan</h1>
    <div class="store-name">{{ $user->store_name ?? $user->name }}</div>
    <div class="subtitle">Periode: Semua Waktu &mdash; Dicetak: {{ now()->format('d/m/Y H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pembeli</th>
                <th>Judul Buku</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Total</th>
                <th class="text-center">Status</th>
                <th>Tanggal</th>
                <th class="text-center">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#ORD-{{ $order->id }}</td>
                <td>{{ $order->buyer->name ?? 'Pembeli' }}</td>
                <td>{{ $order->book->title ?? 'Buku' }}</td>
                <td class="text-center">{{ $order->quantity }}</td>
                <td class="text-right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td class="text-center">
                    <span class="badge badge-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->date ? $order->date->format('d/m/Y') : '-' }}</td>
                <td class="text-center">{{ $order->rating ? $order->rating . '/5' : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total Keseluruhan</td>
                <td class="text-right">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Laporan ini digenerate secara otomatis dari sistem eBookStore &mdash; {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
