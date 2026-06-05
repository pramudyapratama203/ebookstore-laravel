<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with('book.seller')
            ->orderByDesc('id')
            ->get();
            
        return view('order.buyer.showorder', compact('orders'));
    }
    public function buyerOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with('book.seller')
            ->orderByDesc('id')
            ->paginate(10);

        return view('order.buyer.showorder', compact('orders'));
    }

    public function sellerOrders()
    {
        $sellerBooks = Auth::user()->books()->pluck('id');

        $orders = Order::whereIn('book_id', $sellerBooks)
            ->with('book', 'buyer')
            ->orderByDesc('id')
            ->paginate(10);

        return view('order.seller.showorder', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with('book', 'buyer', 'book.seller')
            ->orderByDesc('id')
            ->paginate(10);

        return view('order.admin.showorder', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function storeRating(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('buyer_id', Auth::id())->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:5|max:1000',
        ]);

        $order->update([
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'completed',
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil disimpan.');
    }
}