<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerExportController;

// Root route - redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

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
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/catalog', [BookController::class, 'showAdminCatalog'])->name('admin.catalog');
Route::get('/admin/catalog/search', [BookController::class, 'searchAdminBook'])->name('admin.search');
Route::get('/admin/create', [BookController::class, 'create'])->name('admin.create');
Route::post('/admin/create', [BookController::class, 'store'])->name('admin.store');
Route::get('/admin/category/edit/{id}', [BookController::class, 'editCategory'])->name('admin.category.edit');
Route::put('/admin/category/update/{id}', [BookController::class, 'updateCategory'])->name('admin.category.update');
Route::delete('/admin/book/delete/{id}', [BookController::class, 'destroy'])->name('admin.book.delete');
Route::get('/admin/catalog/detail/{id}', [BookController::class, 'showAdminBookById'])->name('admin.catalog.detail');
Route::get('/admin/orders', [OrderController::class, 'adminOrders'])->name('admin.orders');
Route::get('/admin/activity-logs', [AdminDashboardController::class, 'activityLogs'])->name('admin.activity-logs');

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
Route::get('/home/buyer/order/download/{id}', [BookController::class, 'download'])->name('buyer.order.download');

// Order Detail
Route::get('/home/buyer/order/detail/{id}', [OrderController::class, 'buyerOrderDetail'])->name('order.buyer.detail');
Route::get('/home/seller/order/detail/{id}', [OrderController::class, 'sellerOrderDetail'])->name('order.seller.detail');
Route::get('/admin/orders/detail/{id}', [OrderController::class, 'adminOrderDetail'])->name('admin.orders.detail');

// Cancel Order
Route::post('/home/buyer/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('buyer.orders.cancel');
Route::post('/home/seller/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('seller.orders.cancel');
Route::post('/admin/orders/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('admin.orders.cancel');

// Profile
Route::get('/home/buyer/profile', [UsersController::class, 'showUserProfile'])->name('profile.buyer.show');
Route::put('/home/buyer/profile', [UsersController::class, 'updateProfile'])->name('profile.buyer.update');
Route::delete('/home/buyer/profile', [UsersController::class, 'destroyAccount'])->name('profile.buyer.destroy');
Route::get('/home/seller/profile', [UsersController::class, 'showSellerProfile'])->name('profile.seller.show');
Route::put('/home/seller/profile', [UsersController::class, 'updateProfile'])->name('profile.seller.update');
Route::delete('/home/seller/profile', [UsersController::class, 'destroyAccount'])->name('profile.seller.destroy');

Route::get('/admin/profile', [UsersController::class, 'showAdminProfile'])->name('profile.admin.show');
Route::put('/admin/profile', [UsersController::class, 'updateProfile'])->name('profile.admin.update');
Route::delete('/admin/profile', [UsersController::class, 'destroyAccount'])->name('profile.admin.destroy');

// Seller Export
Route::get('/home/seller/export/sales-excel', [SellerExportController::class, 'exportSalesExcel'])->name('seller.export.sales.excel');
Route::get('/home/seller/export/revenue-excel', [SellerExportController::class, 'exportRevenueExcel'])->name('seller.export.revenue.excel');
Route::get('/home/seller/export/sales-pdf', [SellerExportController::class, 'exportSalesPdf'])->name('seller.export.sales.pdf');
Route::get('/home/seller/export/revenue-pdf', [SellerExportController::class, 'exportRevenuePdf'])->name('seller.export.revenue.pdf');

require __DIR__.'/auth.php';
