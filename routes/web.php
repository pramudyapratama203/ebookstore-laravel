<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;

// Buyer Book
Route::get('/home/buyer', [BookController::class, 'showBookToBuyer'])->name('home.buyer');
Route::get('/home/buyer/search', [BookController::class, 'index'])->name('buyer.search');
Route::get('/home/buyer/detail/{id}', [BookController::class, 'showBookById'])->name('buyer.detail');

// Seller Book
Route::get('/home/seller', [DashboardController::class, 'sellerDashboard'])->name('home.seller');
Route::get('/home/seller/catalog', [BookController::class, 'showBookToSeller'])->name('seller.catalog');
Route::get('/home/seller/search', [BookController::class, 'searchSellerBook'])->name('seller.search');
Route::get('/home/seller/create', [BookController::class, 'create'])->name('seller.create');
Route::post('/home/seller/create', [BookController::class, 'store'])->name('seller.store');
Route::get('/home/seller/category/edit/{id}', [BookController::class, 'editCategory'])->name('seller.category.edit');
Route::put('/home/seller/category/update/{id}', [BookController::class, 'updateCategory'])->name('seller.category.update');
Route::delete('/home/seller/book/delete/{id}', [BookController::class, 'destroy'])->name('seller.book.delete');
Route::get('/home/seller/catalog/detail/{id}', [BookController::class, 'showSellerBookById'])->name('seller.catalog.detail');

// Admin
Route::get('/home/admin', function () {
    return view('dasboard.admin.home');
})->name('home.admin');

// Cart
Route::get('/home/buyer/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/home/buyer/cart/show', [CartController::class, 'show'])->name('cart.show');
Route::post('/home/buyer/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('home/buyer/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/home/buyer/cart/checkout', [CartController::class, 'checkout'])->name('checkout');

// Order Buyer
Route::get('/home/buyer/order', [OrderController::class, 'buyerOrders'])->name('order.showorder');
Route::get('/home/buyer/order/search', [OrderController::class, 'index'])->name('order.showorder.search');

// Order Seller 
Route::patch('/home/seller/order/update-status/{id}', [OrderController::class, 'updateStatus'])->name('seller.orders.update-status');
Route::get('/home/seller/order', [OrderController::class, 'sellerOrders'])->name('order.seller');

// Rating Buyer
Route::post('/home/buyer/order/rate/{id}', [OrderController::class, 'storeRating'])->name('buyer.orders.store-rating');

// Profile
Route::get('/home/buyer/profile', [UsersController::class, 'showUserProfile'])->name('profile.buyer.show');
Route::get('/home/seller/profile', [UsersController::class, 'showSellerProfile'])->name('profile.seller.show');


require __DIR__.'/auth.php';
