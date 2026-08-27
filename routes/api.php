<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\produk;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/produk', function (Request $request) {
    if ($request->has('kategori_id')) {
        return produk::where('kategori_id', $request->kategori_id)->get();
    }

    return produk::all();
});

Route::get('/produk/{id}', function ($id) {
    return produk::findOrFail($id);
});

Route::post('/produk', function (Request $request) {
    $produk = produk::create($request->all());

    return $produk;
});

Route::put('/produk/{id}', function (Request $request, $id) {
    $produk = produk::findOrFail($id);

    $produk->update($request->all());

    return $produk;
});

Route::delete('/produk/{id}', function ($id) {
    $produk = produk::findOrFail($id);

    $produk->delete();

    return response()->json([
        'message' => 'Produk berhasil dihapus'
    ]);
});