<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProdukController;
use App\Models\Pesanan;

// =========================
// AUTH ROUTES (BREEZE / FRONTEND)
// =========================
require __DIR__.'/auth.php';

// =========================
// HALAMAN UTAMA & KATALOG
// =========================
Route::get('/', function () {
    return view('home');
});

// Katalog terintegrasi dengan ProdukController
Route::get('/katalog', [ProdukController::class, 'indexKatalog'])->name('katalog.index');
Route::get('/pemesanan/{id}', [KatalogController::class, 'detail']);

// =========================
// KERANJANG & CHECKOUT
// =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');

    // =========================
    // STATUS PESANAN (CUSTOMER)
    // =========================
    Route::get('/status', [App\Http\Controllers\PesananController::class, 'status'])->name('pesanan.status');
    Route::post('/pesanan/store', [App\Http\Controllers\PesananController::class, 'store'])->name('pesanan.store');
});
Route::get('/status/detail', function (Illuminate\Http\Request $request) {
    $pesanan = Pesanan::with('produk')->findOrFail($request->pesanan_id);
    return view('status-detail', compact('pesanan'));
});

// =========================
// ROUTE DASHBOARD GENERAL
// =========================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin_pusat') {
        return redirect()->route('admin-pusat.dashboard');
    } elseif ($role === 'admin_jurusan') {
        return redirect()->route('admin-jurusan.dashboard');
    }

    return redirect('/katalog');
})->middleware(['auth'])->name('dashboard');

// =========================
// ROUTE ADMIN PUSAT (Terproteksi Role)
// =========================
Route::middleware(['auth', 'role:admin_pusat'])->prefix('admin-pusat')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-pusat-status');
    })->name('admin-pusat.dashboard');

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

    // CHAT ADMIN
    Route::get('/chat', [ChatController::class, 'adminChat']);
});

// =========================
// ROUTE ADMIN JURUSAN (Terproteksi Role)
// =========================
Route::middleware(['auth', 'role:admin_jurusan'])->prefix('admin-jurusan')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-jurusan');
    })->name('admin-jurusan.dashboard');

    // Fitur Tambah Produk
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('admin-jurusan.produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('admin-jurusan.produk.store');
});

// =========================
// ROUTE CUSTOMER SERVICE / CHAT
// =========================
Route::get('/customer-service', [ChatController::class, 'customerService']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);