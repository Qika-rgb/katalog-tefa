<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PortofolioController;
use App\Models\Pesanan;
use App\Models\Produk;

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

Route::get('/katalog', [ProdukController::class, 'indexKatalog'])->name('katalog.index');
Route::get('/pemesanan/{id}', [KatalogController::class, 'detail']);

// =========================
// HALAMAN PORTOFOLIO PUBLIK
// =========================
Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');

// =========================
// KERANJANG & STATUS PESANAN (CUSTOMER)
// =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    Route::get('/status', [PesananController::class, 'status'])->name('pesanan.status');
    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
});

Route::get('/status/detail', function (Illuminate\Http\Request $request) {
    $pesanan = Pesanan::with('produk')->findOrFail($request->pesanan_id);
    return view('status-detail', compact('pesanan'));
});

// =========================
// ROUTE DASHBOARD GENERAL (redirect berdasarkan role)
// =========================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin_pusat' || $role === 'admin pusat') {
        return redirect()->route('admin-pusat.dashboard');
    } elseif ($role === 'admin_jurusan' || $role === 'admin jurusan') {
        return redirect()->route('admin-jurusan.dashboard');
    }

    return redirect('/katalog');
})->middleware(['auth'])->name('dashboard');

// =========================
// ROUTE ADMIN PUSAT (Terproteksi Role)
// =========================
Route::middleware(['auth'])->prefix('admin-pusat')->group(function () {
    Route::get('/dashboard', function () {
        $produks = \App\Models\Produk::all();
        return view('admin-pusat-status', compact('produks'));
    })->name('admin-pusat.dashboard');

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
// ROUTE ADMIN JURUSAN
// =========================
Route::middleware(['auth'])->prefix('admin-jurusan')->name('admin-jurusan.')->group(function () {
    Route::get('/dashboard', function () {
        $jurusan = auth()->user()->jurusan;

        // Ambil semua produk yang kategorinya sesuai jurusan admin ini
        $produkIds = \App\Models\Produk::whereHas('kategori', function ($q) use ($jurusan) {
            $q->where('nama_kategori', $jurusan);
        })->pluck('id');

        // ORDERS: total pesanan masuk untuk produk-produk jurusan ini
        $totalOrders = Pesanan::whereIn('produk_id', $produkIds)->count();

        // APPROVED: pesanan yang sudah di-ACCEPT (bukan Pending, bukan Ditolak)
        $totalApproved = Pesanan::whereIn('produk_id', $produkIds)
            ->whereNotIn('status', ['Pending', 'Ditolak'])
            ->count();

        // STATUS BREAKDOWN: jumlah pesanan per status untuk produk jurusan ini
        $statusList = ['Pending', 'Tahap Pembuatan', 'Pengemasan', 'Siap Diambil', 'Sudah Diambil'];

        $statusCounts = Pesanan::whereIn('produk_id', $produkIds)
            ->whereIn('status', $statusList)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusData = collect($statusList)->mapWithKeys(function ($status) use ($statusCounts) {
            return [$status => $statusCounts->get($status, 0)];
        });

        $maxStatus = $statusData->max() ?: 1;

        // SALES RESULTS: produk yang paling banyak dipesan (top 4)
        $topProduk = \App\Models\Produk::whereIn('id', $produkIds)
    ->withSum('pesanans', 'jumlah')
    ->orderByDesc('pesanans_sum_jumlah')
    ->take(4)
    ->get();

    $maxPesanan = $topProduk->max('pesanans_sum_jumlah') ?: 1;

        return view('admin-jurusan', compact('totalOrders', 'totalApproved', 'topProduk', 'maxPesanan', 'statusData', 'maxStatus'));
    })->name('dashboard');

    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');

    // Route Kelola Portofolio Khusus Admin Jurusan
    Route::get('/portofolio', [PortofolioController::class, 'adminIndex'])->name('portofolio.index');
    Route::post('/portofolio/store', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::post('/portofolio/update/{id}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/delete/{id}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');
});

// =========================
// ROUTE YANG WAJIB LOGIN (CHECKOUT & CHAT)
// =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/langsung', [CheckoutController::class, 'langsung'])->name('checkout.langsung');

    Route::get('/customer-service', [ChatController::class, 'customerService']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});

// =========================
// ROUTE PROFILE BREEZE
// =========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin-jurusan')->name('admin-jurusan.')->group(function () {
    // ... route yang sudah ada ...

    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});