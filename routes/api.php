<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// ========================================
// TEST API
// ========================================
Route::get('/test', function () {
    return response()->json([
        'message' => 'API berhasil!',
    ]);
});

// ========================================
// AUTHENTICATION
// ========================================

// Register akun baru
Route::post('/register', [AuthController::class, 'register']);

// Login dan mendapatkan token
Route::post('/login', [AuthController::class, 'login']);

// ========================================
// ROUTE YANG MEMERLUKAN TOKEN SANCTUM
// ========================================
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mengambil data pengguna yang sedang login
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
        ]);
    });

    // ========================================
    // PRODUCT API (CRUD)
    // ========================================

    // Menampilkan daftar produk, pencarian, dan filter
    Route::get('/products', [ProductController::class, 'index']);

    // Menampilkan detail satu produk
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Menambahkan produk baru
    Route::post('/products', [ProductController::class, 'store']);

    // Memperbarui produk
    Route::put('/products/{id}', [ProductController::class, 'update']);

    // Menghapus produk
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});
