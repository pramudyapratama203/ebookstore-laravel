<?php

namespace App\Http\Controllers;

use App\Models\AdminActivityLog;
use App\Models\Book;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;

class SellerExportController extends Controller
{
    public function exportSalesExcel()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->where('status', 'completed')->with(['buyer', 'book'])->orderByDesc('id')->get();

        $writer = new Writer();
        $filename = 'penjualan-' . now()->format('Y-m-d') . '.xlsx';

        $writer->openToBrowser($filename);

        $header = ['ID Pesanan', 'Pembeli', 'Judul Buku', 'Jumlah', 'Total', 'Status', 'Tanggal', 'Rating'];
        $writer->addRow(Row::fromValues($header));

        foreach ($orders as $order) {
            $writer->addRow(Row::fromValues([
                '#ORD-' . $order->id,
                $order->buyer->name ?? 'Pembeli',
                $order->book->title ?? 'Buku',
                $order->quantity,
                $order->total,
                ucfirst($order->status),
                $order->date ? $order->date->format('d-m-Y') : '-',
                $order->rating ? $order->rating . '/5' : '-',
            ]));
        }

        AdminActivityLog::log('export', 'orders', 'Seller mengekspor penjualan (Excel)');

        $writer->close();
    }

    public function exportRevenueExcel()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->where('status', 'completed')->with('book')->get();

        $grouped = $orders->groupBy('book_id')->map(function ($items) {
            return [
                'book' => $items->first()->book,
                'total_qty' => $items->sum('quantity'),
                'total_amount' => $items->sum('total'),
                'order_count' => $items->count(),
            ];
        });

        $writer = new Writer();
        $filename = 'pendapatan-' . now()->format('Y-m-d') . '.xlsx';

        $writer->openToBrowser($filename);

        $header = ['Judul Buku', 'Harga', 'Terjual', 'Total Pendapatan', 'Stok', 'Rating'];
        $writer->addRow(Row::fromValues($header));

        $grandTotal = 0;
        foreach ($grouped as $item) {
            $book = $item['book'];
            $revenue = $item['total_amount'];
            $grandTotal += $revenue;
            $writer->addRow(Row::fromValues([
                $book->title,
                $book->price,
                $item['total_qty'],
                $revenue,
                $book->stock,
                $book->rating,
            ]));
        }

        $writer->addRow(Row::fromValues([]));
        $writer->addRow(Row::fromValues(['Total Keseluruhan', '', '', $grandTotal, '', '']));

        AdminActivityLog::log('export', 'orders', 'Seller mengekspor pendapatan (Excel)');

        $writer->close();
    }

    public function exportSalesPdf()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->where('status', 'completed')->with(['buyer', 'book'])->orderByDesc('id')->get();

        $totalEarnings = $orders->sum('total');

        AdminActivityLog::log('export', 'orders', 'Seller mengekspor penjualan (PDF)');

        $pdf = Pdf::loadView('exports.seller.sales-pdf', compact('orders', 'totalEarnings', 'user'));
        return $pdf->download('penjualan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportRevenuePdf()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->where('status', 'completed')->with('book')->get();

        $grouped = $orders->groupBy('book_id')->map(function ($items) {
            return [
                'book' => $items->first()->book,
                'total_qty' => $items->sum('quantity'),
                'total_amount' => $items->sum('total'),
            ];
        });

        $totalRevenue = $grouped->sum('total_amount');
        $totalSold = $grouped->sum('total_qty');

        AdminActivityLog::log('export', 'orders', 'Seller mengekspor pendapatan (PDF)');

        $pdf = Pdf::loadView('exports.seller.revenue-pdf', compact('grouped', 'totalRevenue', 'totalSold', 'user'));
        return $pdf->download('pendapatan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function previewSales()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->where('status', 'completed')->with(['buyer', 'book'])->orderByDesc('id')->get();

        $grouped = $orders->groupBy('book_id')->map(function ($items) {
            return [
                'book' => $items->first()->book,
                'total_qty' => $items->sum('quantity'),
                'total_amount' => $items->sum('total'),
                'order_count' => $items->count(),
            ];
        });

        $totalEarnings = $orders->sum('total');

        AdminActivityLog::log('view', 'orders', 'Seller melihat preview penjualan');

        return view('exports.seller.preview-sales', compact('grouped', 'totalEarnings', 'user'));
    }


}
