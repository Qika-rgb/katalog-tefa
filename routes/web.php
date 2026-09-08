<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Models\Pesanan;
use App\Http\Controllers\ChatController;

// =========================
// HALAMAN UTAMA & KATALOG
// =========================
Route::get('/', function () {
    return view('home');
});

Route::get('/katalog', [KatalogController::class, 'index']);
Route::get('/pemesanan/{id}', [KatalogController::class, 'detail']);

// =========================
// AUTH (LOGIN & REGISTER)
// =========================
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

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
// ROUTE ADMIN PUSAT (TUGAS QIKA)
// =========================
Route::prefix('admin-pusat')->group(function () {
    // STEP 1: Product Report
    Route::get('/product-report', [AdminPusatController::class, 'productReport'])->name('admin.product-report');

    // STEP 2: Verifikasi Pesanan
    Route::get('/verifikasi', [AdminPusatController::class, 'verifikasi'])->name('admin.verifikasi');

    // STEP 3 & 4: ACCEPT & DECLINE
    Route::post('/accept/{id}', [AdminPusatController::class, 'accept'])->name('admin.accept');
    Route::post('/decline/{id}', [AdminPusatController::class, 'decline'])->name('admin.decline');

    // STEP 5 & 6: Status Pesanan & Ubah Status
    Route::get('/status-pesanan', [AdminPusatController::class, 'statusPesanan'])->name('admin.status-pesanan');
    Route::post('/ubah-status/{id}', [AdminPusatController::class, 'ubahStatus'])->name('admin.ubah-status');

    // STEP 7: DONE
    Route::get('/done', [AdminPusatController::class, 'done'])->name('admin.done');
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

Route::get('/admin-pusat/status', function () {
    return view('admin-pusat-status');
});

Route::get('/admin-pusat/chat', [ChatController::class, 'adminChat']);

Route::get('/admin-pusat/verifikasi', function () {
    return view('admin-pusat-verifikasi');
});

Route::get('/admin-pusat/status-pesanan', function () {
    return view('admin-pusat-status-pesanan');
});

Route::get('/admin-pusat/done', function () {
    return view('admin-pusat-done');
});

Route::get('/customer-service', [ChatController::class, 'customerService']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);