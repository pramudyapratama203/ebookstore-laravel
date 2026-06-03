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
            
        return view('order.showorder', compact('orders'));
    }
    public function buyerOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with('book.seller')
            ->orderByDesc('id')
            ->paginate(10);

        return view('order.showorder', compact('orders'));
    }

    public function sellerOrders()
    {
        $sellerBooks = Auth::user()->books->pluck('id');

        $orders = Order::whereIn('book_id', $sellerBooks)
            ->with('book', 'buyer')
            ->orderByDesc('id')
            ->paginate(10);

        return view('orders.seller', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->book->seller_id !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui!');
    }
}