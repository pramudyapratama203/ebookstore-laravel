<?php

namespace App\Http\Controllers;

use App\Models\AdminActivityLog;
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
            ->paginate(4);
            
        return view('order.buyer.showorder', compact('orders'));
    }
    public function buyerOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with('book.seller')
            ->orderByDesc('id')
            ->paginate(4);

        AdminActivityLog::log('view', 'orders', 'Buyer melihat daftar pesanan');

        return view('order.buyer.showorder', compact('orders'));
    }

    public function sellerOrders()
    {
        $sellerBooks = Auth::user()->books()->pluck('id');

        $orders = Order::whereIn('book_id', $sellerBooks)
            ->with('book', 'buyer')
            ->orderByDesc('id')
            ->paginate(4);

        AdminActivityLog::log('view', 'orders', 'Seller melihat daftar pesanan');

        return view('order.seller.showorder', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with('book', 'buyer', 'book.seller')
            ->orderByDesc('id')
            ->paginate(4);

        AdminActivityLog::log('view', 'orders', 'Admin melihat daftar pesanan');

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

        $role = ucfirst(Auth::user()->role);
        AdminActivityLog::log('update', 'orders', $role . ' memperbarui status pesanan #' . $order->id . ' menjadi ' . $request->status);

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

        AdminActivityLog::log('rate', 'orders', 'Buyer memberikan rating ' . $request->rating . ' untuk pesanan #' . $order->id);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil disimpan.');
    }

    public function buyerOrderDetail($id)
    {
        $order = Order::where('id', $id)
            ->where('buyer_id', Auth::id())
            ->with('book.seller', 'buyer')
            ->firstOrFail();

        AdminActivityLog::log('view', 'orders', 'Buyer melihat detail pesanan #' . $order->id);

        return view('order.buyer.detail', compact('order'));
    }

    public function sellerOrderDetail($id)
    {
        $sellerBookIds = Auth::user()->books()->pluck('id');

        $order = Order::where('id', $id)
            ->whereIn('book_id', $sellerBookIds)
            ->with('book', 'buyer', 'book.seller')
            ->firstOrFail();

        AdminActivityLog::log('view', 'orders', 'Seller melihat detail pesanan #' . $order->id);

        return view('order.seller.detail', compact('order'));
    }

    public function adminOrderDetail($id)
    {
        $order = Order::with('book', 'buyer', 'book.seller')
            ->findOrFail($id);

        AdminActivityLog::log('view', 'orders', 'Admin melihat detail pesanan #' . $order->id);

        return view('order.admin.detail', compact('order'));
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if ($user->isBuyer()) {
            if ($order->buyer_id !== $user->id) {
                abort(403);
            }
        } elseif ($user->isSeller()) {
            $sellerBookIds = $user->books()->pluck('id')->toArray();
            if (!in_array($order->book_id, $sellerBookIds)) {
                abort(403);
            }
        } elseif (!$user->isAdmin()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena statusnya sudah ' . $order->status);
        }

        $order->update(['status' => 'cancelled']);

        $role = ucfirst($user->role);
        AdminActivityLog::log('cancel', 'orders', $role . ' membatalkan pesanan #' . $order->id);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
    }
}