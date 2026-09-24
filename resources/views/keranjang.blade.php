@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 font-weight-bold">Keranjang Belanja Kamu</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    @php
        // Normalisasi variabel (mendukung $items maupun $keranjangs)
        $cartItems = $items ?? $keranjangs ?? collect();
    @endphp

    @if(count($cartItems) > 0)
        <div class="row">
            <!-- DAFTAR ITEM KERANJANG -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    @php
                                        $hargaRaw = $item->produk->harga ?? 0;
                                        $hargaClean = (float) preg_replace('/[^0-9]/', '', (string)$hargaRaw);
                                        $jumlah = (int) ($item->jumlah ?? 1);
                                        $subtotal = $hargaClean * $jumlah;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($item->produk->foto))
                                                    <img src="{{ asset('images/' . $item->produk->foto) }}" alt="Foto Produk" class="img-fluid rounded mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <span class="font-weight-bold d-block">{{ $item->produk->nama_produk ?? $item->produk->nama ?? 'Produk' }}</span>
                                                    <small class="text-muted">TEFA SMKN 4</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($hargaClean, 0, ',', '.') }}</td>
                                        <td>{{ $jumlah }}</td>
                                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Produk">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- RINGKASAN TOTAL & CHECKOUT -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="mb-3">Total Belanja</h4>
                    <hr>
                    @php
                        $grandTotal = $cartItems->sum(function ($item) {
                            $hargaClean = (float) preg_replace('/[^0-9]/', '', (string)($item->produk->harga ?? 0));
                            return $hargaClean * (int)($item->jumlah ?? 1);
                        });
                    @endphp
                    <div class="d-flex justify-content-between mb-4">
                        <strong class="h5 mb-0">Total:</strong>
                        <strong class="h5 mb-0 text-primary">Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
                    </div>
                    <a href="{{ url('/checkout') }}" class="btn btn-success btn-block btn-lg shadow-sm">
                        Lanjut ke Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- TAMPILAN KERANJANG KOSONG -->
        <div class="text-center py-5">
            <i class="fa-solid fa-cart-shopping mb-3 text-muted" style="font-size: 60px;"></i>
            <h3>Keranjang belanja kamu masih kosong</h3>
            <p class="text-muted">Silakan pilih produk terlebih dahulu untuk mulai berbelanja.</p>
            <a href="{{ route('katalog.index') }}" class="btn btn-primary mt-2">
                Kembali ke Katalog
            </a>
        </div>
    @endif
</div>
@endsection