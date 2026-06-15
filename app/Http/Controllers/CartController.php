<?php

namespace App\Http\Controllers;
use App\Models\AdminActivityLog;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('book')->get();
        $total = $carts->sum(fn ($cart) => $cart->book->price * $cart->qty);
        
        return view('cart.showcart', compact('carts', 'total'));
    }
    public function show()
    {
        $carts = Cart::where('user_id', Auth::id())->with('book')->get();
        $total = $carts->sum(fn ($cart) => $cart->book->price * $cart->qty);

        return view('cart.showcart', compact('carts', 'total'));
    }

    public function add(Request $request, int $bookId)
    {
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan buku ke keranjang!');
        }

        $book = Book::findOrFail($bookId);
        $userId = Auth::id();

        $inputQty = $request->input('quantity', 1);

        $cart = Cart::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();

        $currentCartQty = $cart ? $cart->qty : 0;
        $totalRequested = $cart ? $currentCartQty + ($inputQty > 1 ? $inputQty : 1) : $inputQty;

        if ($totalRequested > $book->stock) {
            $remaining = $book->stock - $currentCartQty;
            if ($remaining <= 0) {
                return back()->with('error', 'Stok buku "' . $book->title . '" tidak mencukupi. Sudah ' . $currentCartQty . ' di keranjang Anda.');
            }
            return back()->with('error', 'Stok buku "' . $book->title . '" tersisa ' . $remaining . ', tidak bisa menambah ' . $inputQty . ' lagi.');
        }

        if ($cart) {
            $cart->increment('qty', $inputQty > 1 ? $inputQty : 1);
        } else {
            Cart::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'qty' => $inputQty,
                'added_at' => now(),
            ]);
        }

        AdminActivityLog::log('create', 'cart', 'Buyer menambahkan buku ke keranjang: ' . $book->title);

        return back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, int $qty, int $cartId)
    {
        Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->update(['qty' => $qty]);

        return back()->with('success', 'Jumlah buku berhasil diperbarui!');
    }
    public function remove(int $cartId)
    {
        $cart = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->with('book')
            ->first();

        if ($cart) {
            AdminActivityLog::log('delete', 'cart', 'Buyer menghapus buku dari keranjang: ' . $cart->book->title);
            $cart->delete();
        }

        return back()->with('success', 'Buku dihapus dari keranjang!');
    }

    public function checkout(Request $request)
    {
        $quantities = $request->input('cart_quantities', []);

        foreach ($quantities as $cartId => $newQty) {
            $cart = Cart::with('book')->find($cartId);
            if ($cart && $cart->user_id === Auth::id()) {
                if ($newQty > $cart->book->stock) {
                    return back()->with('error', 'Stok "' . $cart->book->title . '" hanya ' . $cart->book->stock . ', tidak bisa checkout ' . $newQty . '.');
                }
                $cart->update(['qty' => $newQty]);
            }
        }

        $carts = Cart::where('user_id', Auth::id())->with('book')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong!');
        }

        foreach ($carts as $cart) {
            if ($cart->qty > $cart->book->stock) {
                return back()->with('error', 'Stok "' . $cart->book->title . '" tidak mencukupi.');
            }
        }

        $totalPrice = $carts->sum(fn ($cart) => $cart->book->price * $cart->qty);

        $order = Order::create([
            'buyer_id'    => Auth::id(),
            'book_id'     => $cart->book_id,
            'quantity'    => $cart->qty,
            'total'       => $cart->book->price * $cart->qty,
            'status'      => 'pending',
            'date'        => now()->toDateString(), 
            'description' => 'Pembelian buku ' . $cart->book->title,
        ]);

        $carts->each(function ($cart) {
            $cart->delete();
        });

        AdminActivityLog::log('checkout', 'cart', 'Buyer melakukan checkout pesanan #' . $order->id);

        return redirect()->route('order.showorder', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
