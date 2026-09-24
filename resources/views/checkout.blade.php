@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 font-weight-bold">Checkout Pesanan</h2>

    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        @if(isset($produk))
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            <input type="hidden" name="qty" value="{{ $qty ?? 1 }}">
        @endif

        <div class="row">
            <!-- SISI KIRI: INFORMASI PENGIRIMAN & PEMESAN -->
            <div class="col-md-7">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h4 class="mb-3">Informasi Pengiriman & Pemesan</h4>
                    
                    <div class="form-group mb-3">
                        <label for="nama_pemesan" class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" value="{{ old('nama_pemesan', Auth::user()->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_hp" class="font-weight-bold">Nomor Handphone / WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat" class="font-weight-bold">Alamat Lengkap Pengiriman / Catatan</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat lengkap tujuan..." required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="metode_pembayaran" class="font-weight-bold">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank (BCA/BRI/Mandiri)</option>
                            <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS / E-Wallet (GoPay/OVO/Dana)</option>
                            <option value="COD" {{ old('metode_pembayaran') == 'COD' ? 'selected' : '' }}>Bayar di Tempat (COD)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: RINGKASAN PESANAN -->
            <div class="col-md-5">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="mb-3">Ringkasan Pesanan</h4>
                    <hr>
                    
                    @if(isset($items) && count($items) > 0)
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($items as $item)
                                @php
                                    $hargaRaw = $item->produk->harga ?? 0;
                                    $hargaClean = (float) preg_replace('/[^0-9]/', '', (string)$hargaRaw);
                                    $jumlahItem = $item->jumlah ?? $qty ?? 1;
                                    $subtotal = $hargaClean * $jumlahItem;
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <h6 class="my-0">{{ $item->produk->nama_produk ?? $item->produk->nama ?? 'Produk' }}</h6>
                                        <small class="text-muted">Jumlah: {{ $jumlahItem }}</small>
                                    </div>
                                    <span class="text-muted">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted text-center py-3">Tidak ada item yang dipilih.</p>
                    @endif

                    <div class="d-flex justify-content-between mb-4">
                        <strong class="h5">Total Pembayaran:</strong>
                        <strong class="h5 text-primary">
                            Rp {{ number_format($totalHarga ?? 0, 0, ',', '.') }}
                        </strong>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg btn-block shadow-sm">
                        Buat Pesanan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection