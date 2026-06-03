<?php

namespace App\Http\Controllers;
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

        if ($cart) {
            $cart->increment('qty');
        } else {
            Cart::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'qty' => $inputQty,
                'added_at' => now(),
            ]);
        }

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
        Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Buku dihapus dari keranjang!');
    }

    public function checkout(Request $request)
    {
        $quantities = $request->input('cart_quantities', []);

        foreach ($quantities as $cartId => $newQty) {
            $cart = Cart::find($cartId);
            if ($cart) {
                $cart->update([
                    'qty' => $newQty
                ]);
            }
        }

        $carts = Cart::where('user_id', Auth::id())->with('book')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong!');
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

        return redirect()->route('order.showorder', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
