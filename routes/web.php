<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ini route baru untuk halaman Katalog TEFA
Route::get('/katalog', function () {
    // Mengambil semua data produk dari database
    $produks = Produk::all(); 
    
    // Mengirim data tersebut ke file katalog.blade.php
    return view('katalog', compact('produks'));
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/pemesanan', function () {
    return view('pemesanan');
});

Route::get('/pemesanan/{id}', function ($id) {
    // Mencari produk di database berdasarkan ID
    $produk = Produk::findOrFail($id); 
    
    // Mengirim data $produk ke halaman pemesanan
    return view('pemesanan', compact('produk'));
});

Route::get('/keranjang', function () {
    return view('keranjang');
});

// Rute untuk halaman Daftar Status Pesanan
Route::get('/status', function () {
    return view('status');
});

// Rute untuk halaman Detail Status Pesanan (Tracking)
Route::get('/status/detail', function () {
    return view('status-detail');
});

Route::get('/admin-jurusan', function () {
    return view('admin-jurusan');
});

Route::get('/admin-jurusan/products', function () {
    return view('admin-products');
});

Route::get('/admin-pusat/status', function () {
    return view('admin-pusat-status');
});

Route::get('/admin-pusat/chat', function () {
    return view('admin-pusat-chat');
});