<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Models\Pesanan;

// =========================
// HALAMAN UTAMA
// =========================
Route::get('/', function () {
    return view('home');
});

// =========================
// KATALOG
// =========================
Route::get('/katalog', [KatalogController::class, 'index']);

// =========================
// PEMESANAN / DETAIL PRODUK
// =========================
Route::get('/pemesanan/{id}', [KatalogController::class, 'detail']);

// =========================
// LOGIN & REGISTER
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
// KERANJANG
// =========================
Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);

// =========================
// STATUS PESANAN
// =========================
Route::get('/status', function () {
    $pesanans = Pesanan::with('detailPesanans.produk')
        ->latest()
        ->get();

    return view('status', compact('pesanans'));
});

Route::get('/status/detail', function (Illuminate\Http\Request $request) {

    $pesanan = Pesanan::with('detailPesanans.produk')
        ->findOrFail($request->pesanan_id);

    return view('status-detail', compact('pesanan'));
});

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);