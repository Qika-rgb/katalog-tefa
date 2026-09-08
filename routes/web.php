<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChatController;
use App\Models\Pesanan;
use App\Http\Controllers\ProfileController;

// =========================
// HALAMAN UTAMA & KATALOG
// =========================
Route::get('/', function () {
    // Kita arahkan kembali ke view 'home' buatanmu!
    return view('home'); 
});

Route::get('/katalog', [KatalogController::class, 'index']);
Route::get('/pemesanan/{id}', [KatalogController::class, 'detail']);

// =========================
// KERANJANG & CHECKOUT
// =========================
Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);

// =========================
// STATUS PESANAN (CUSTOMER)
// =========================
Route::get('/status', function () {
    $pesanans = Pesanan::with('produk')->latest()->get();
    return view('status', compact('pesanans'));
});

Route::get('/status/detail', function (Illuminate\Http\Request $request) {
    $pesanan = Pesanan::with('produk')->findOrFail($request->pesanan_id);
    return view('status-detail', compact('pesanan'));
});

// =========================
// ROUTE ADMIN PUSAT
// =========================
Route::prefix('admin-pusat')->group(function () {
    Route::get('/product-report', [AdminPusatController::class, 'productReport'])->name('admin.product-report');
    Route::get('/verifikasi', [AdminPusatController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::post('/accept/{id}', [AdminPusatController::class, 'accept'])->name('admin.accept');
    Route::post('/decline/{id}', [AdminPusatController::class, 'decline'])->name('admin.decline');
    Route::get('/status-pesanan', [AdminPusatController::class, 'statusPesanan'])->name('admin.status-pesanan');
    Route::post('/ubah-status/{id}', [AdminPusatController::class, 'ubahStatus'])->name('admin.ubah-status');
    Route::get('/done', [AdminPusatController::class, 'done'])->name('admin.done');
    Route::get('/chat', [ChatController::class, 'adminChat']);
});

// =========================
// ROUTE LAINNYA (JURUSAN & CS)
// =========================
Route::get('/admin-jurusan', function () {
    return view('admin-jurusan');
});

Route::get('/admin-jurusan/products', function () {
    return view('admin-products');
});

Route::get('/customer-service', [ChatController::class, 'customerService']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);

// =========================
// ROUTE DASHBOARD BREEZE (REDIRECT KE HOME)
// =========================
Route::get('/dashboard', function () {
    return redirect('/'); // Otomatis arahkan user ke halaman utama setelah login
})->middleware(['auth'])->name('dashboard');

// =========================
// ROUTE PROFILE BREEZE
// =========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// REQUIRE BREEZE AUTH ROUTES
// =========================
// Sekarang baris ini sudah aman untuk dijalankan karena file auth.php sudah dibuat oleh Breeze
require __DIR__.'/auth.php';