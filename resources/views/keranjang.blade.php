@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 font-weight-bold">Keranjang Belanja Kamu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(isset($items) && $items->count() > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-3">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold">{{ $item->produk->nama_produk ?? $item->produk->nama ?? 'Produk' }}</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4">
                    <h4>Total Belanja</h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total:</strong>
                        <strong class="text-primary">Rp {{ number_format($items->sum(fn($i) => $i->produk->harga * $i->jumlah), 0, ',', '.') }}</strong>
                    </div>
                    <a href="{{ url('/checkout') }}" class="btn btn-success btn-block">Lanjut ke Checkout</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">Keranjang belanja kamu masih kosong. <a href="{{ route('katalog.index') }}">Belanja sekarang</a></div>
    @endif
</div>
@endsection