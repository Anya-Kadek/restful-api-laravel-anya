<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;


// ========================================
// HALAMAN UTAMA TOKO
// ========================================

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [HomeController::class, 'index']);


// ========================================
// HALAMAN PROFIL
// ========================================

Route::get('/profil', function () {
    return view('profil');
});


// ========================================
// HALAMAN DETAIL PRODUK
// ========================================

Route::get('/product/{id}', [
    HomeController::class,
    'show'
])->name('product.show');


// ========================================
// KERANJANG BELANJA
// ========================================

Route::post('/add-to-cart/{id}', [
    HomeController::class,
    'addToCart'
])->name('cart.add');

Route::get('/cart', [
    HomeController::class,
    'cartView'
])->name('cart.view');


// ========================================
// CHECKOUT
// ========================================

Route::get('/checkout', [
    HomeController::class,
    'checkoutView'
])->name('checkout.view');

Route::post('/checkout/process', [
    HomeController::class,
    'checkoutProcess'
])->name('checkout.process');


// ========================================
// ADMIN ANTA PASTRY & DESSERT
// ========================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    // Kelola Produk: tambah, simpan, edit, perbarui, hapus
    Route::resource('products', ProductController::class)
        ->except(['show']);


    // Daftar Pesanan
    Route::get('/orders', [
        OrderController::class,
        'index'
    ])->name('orders.index');


    // Detail Pesanan
    Route::get('/orders/{order}', [
        OrderController::class,
        'show'
    ])->name('orders.show');


    // Perbarui Status Pesanan
    Route::patch('/orders/{order}/status', [
        OrderController::class,
        'updateStatus'
    ])->name('orders.status');

});