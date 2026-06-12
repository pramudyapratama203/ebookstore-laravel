<?php

namespace App\Http\Controllers;

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
        })->with(['buyer', 'book'])->orderByDesc('id')->get();

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

        $writer->close();
    }

    public function exportRevenueExcel()
    {
        $user = Auth::user();
        $books = Book::where('seller_id', $user->id)->get();

        $writer = new Writer();
        $filename = 'pendapatan-' . now()->format('Y-m-d') . '.xlsx';

        $writer->openToBrowser($filename);

        $header = ['Judul Buku', 'Harga', 'Terjual', 'Total Pendapatan', 'Stok', 'Rating'];
        $writer->addRow(Row::fromValues($header));

        $grandTotal = 0;
        foreach ($books as $book) {
            $revenue = $book->sold * $book->price;
            $grandTotal += $revenue;
            $writer->addRow(Row::fromValues([
                $book->title,
                $book->price,
                $book->sold,
                $revenue,
                $book->stock,
                $book->rating,
            ]));
        }

        $writer->addRow(Row::fromValues([]));
        $writer->addRow(Row::fromValues(['Total Keseluruhan', '', '', $grandTotal, '', '']));

        $writer->close();
    }

    public function exportSalesPdf()
    {
        $user = Auth::user();
        $orders = Order::whereHas('book', function ($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->with(['buyer', 'book'])->orderByDesc('id')->get();

        $totalEarnings = $orders->sum('total');

        $pdf = Pdf::loadView('exports.seller.sales-pdf', compact('orders', 'totalEarnings', 'user'));
        return $pdf->download('penjualan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportRevenuePdf()
    {
        $user = Auth::user();
        $books = Book::where('seller_id', $user->id)->get();

        $totalRevenue = $books->sum(fn($b) => $b->sold * $b->price);
        $totalSold = $books->sum('sold');

        $pdf = Pdf::loadView('exports.seller.revenue-pdf', compact('books', 'totalRevenue', 'totalSold', 'user'));
        return $pdf->download('pendapatan-' . now()->format('Y-m-d') . '.pdf');
    }
}
