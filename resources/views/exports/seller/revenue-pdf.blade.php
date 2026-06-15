<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>
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
        .store-name { text-align: center; font-size: 14px; color: #7a4f37; margin-bottom: 4px; }
        .summary { margin-bottom: 20px; }
        .summary table { width: auto; margin: 0 auto; }
        .summary td { padding: 6px 16px; }
        .summary .label { font-weight: bold; color: #5f3822; }
    </style>
</head>
<body>
    <h1>Laporan Pendapatan</h1>
    <div class="store-name">{{ $user->store_name ?? $user->name }}</div>
    <div class="subtitle">Periode: Semua Waktu &mdash; Dicetak: {{ now()->format('d/m/Y H:i') }}</div>

    <div class="summary">
        <table>
            <tr><td class="label">Total Pendapatan</td><td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td></tr>
            <tr><td class="label">Total Buku Terjual</td><td>{{ $totalSold }} Eksemplar</td></tr>
            <tr><td class="label">Total Judul Buku</td><td>{{ $grouped->count() }} Judul</td></tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th class="text-right">Harga</th>
                <th class="text-center">Terjual</th>
                <th class="text-right">Pendapatan</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grouped as $item)
            <tr>
                <td>{{ $item['book']->title }}</td>
                <td class="text-right">Rp {{ number_format($item['book']->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item['total_qty'] }}</td>
                <td class="text-right">Rp {{ number_format($item['total_amount'], 0, ',', '.') }}</td>
                <td class="text-center">{{ $item['book']->stock }}</td>
                <td class="text-center">{{ $item['book']->rating }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td class="text-right">Total Keseluruhan</td>
                <td></td>
                <td class="text-center">{{ $totalSold }}</td>
                <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Laporan ini digenerate secara otomatis dari sistem eBookStore &mdash; {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
