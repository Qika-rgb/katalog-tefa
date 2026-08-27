<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Status Pesanan</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

<div class="pemesanan-wrapper">

    <!-- HEADER -->
    <div class="pemesanan-header">

        <div class="pemesanan-title">

            <a href="/status">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

            <span class="text-blue">
                STATUS
            </span>

        </div>

        <div class="nav-icons">

            <a href="/keranjang"
               style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <a href="/register"
               style="color: inherit; text-decoration: none;">
                <i class="fa-regular fa-user"></i>
            </a>

            <a href="#"
               style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-headset"></i>
            </a>

        </div>

    </div>


    <!-- DETAIL PESANAN -->
    <div class="detail-status-card">

        <!-- HEADER TOKO -->
        <div class="detail-status-header">

            <div class="detail-store-info">

                <img
                    src="{{ asset('images/icon_dkv1.png') }}"
                    alt="Store"
                >

                <span>
                    TEFA DKV
                    <i class="fa-solid fa-chevron-right"
                       style="font-size: 10px; margin-left:5px;">
                    </i>
                </span>

            </div>

            <div class="text-take-it">
                {{ strtoupper($pesanan->status) }}
            </div>

        </div>


        <!-- STATUS PESANAN -->
        <div class="detail-alert">

            @if ($pesanan->status == 'Menunggu')

                <h2>PESANAN SEDANG DIPROSES</h2>

                <p>
                    Pesanan kamu sedang menunggu untuk diproses.
                </p>

            @elseif ($pesanan->status == 'Diproses')

                <h2>PESANAN SEDANG DIPROSES</h2>

                <p>
                    Pesanan kamu sedang dikerjakan.
                </p>

            @elseif ($pesanan->status == 'Siap Diambil')

                <h2>BARANG ANDA SIAP DIAMBIL</h2>

                <p>
                    Dipersilahkan untuk mengambil barangmu di tempat kami.
                </p>

            @elseif ($pesanan->status == 'Selesai')

                <h2>PESANAN SELESAI</h2>

                <p>
                    Pesanan telah selesai dan sudah diambil.
                </p>

            @else

                <h2>
                    {{ strtoupper($pesanan->status) }}
                </h2>

                <p>
                    Status pesanan kamu saat ini.
                </p>

            @endif

        </div>


        <!-- PRODUK -->
        @foreach ($pesanan->detailPesanans as $detail)

            <div class="detail-product-row">

                <img
                    src="{{ asset('images/' . $detail->produk->foto) }}"
                    alt="{{ $detail->produk->nama_produk }}"
                    class="detail-product-img"
                >

                <div class="detail-product-info">

                    <h3>
                        {{ $detail->produk->nama_produk }}
                    </h3>

                    <div class="price">
                        RP {{ number_format(
                            $detail->harga,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                    <div class="est">
                        Jumlah:
                        <strong>
                            {{ $detail->jumlah }}
                        </strong>
                    </div>

                    <div>
                        <button class="btn-masukan">
                            BERI MASUKAN
                        </button>

                        @if ($pesanan->status == 'Siap Diambil')

                            <button class="btn-belum-ambil">
                                ANDA BELUM MENGAMBIL
                            </button>

                        @elseif ($pesanan->status == 'Selesai')

                            <button class="btn-belum-ambil">
                                SUDAH DIAMBIL
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @endforeach


        <!-- TOTAL PESANAN -->
        <div style="
            padding: 20px;
            border-top: 1px solid #ddd;
            text-align: right;
        ">

            <strong>
                TOTAL PESANAN:
            </strong>

            <span style="
                font-size: 20px;
                margin-left: 10px;
            ">

                RP {{ number_format(
                    $pesanan->total,
                    0,
                    ',',
                    '.'
                ) }}

            </span>

        </div>


        <!-- TIMELINE -->
        <div class="tracking-timeline">

            <!-- PEMBUATAN -->
            <div class="tracking-step">

                <div class="tracking-icon">

                    <i class="fa-solid fa-industry"></i>

                </div>

                <div class="tracking-line"></div>

                <div class="tracking-text">
                    Sedang tahap<br>
                    pembuatan
                </div>

            </div>


            <!-- PENGEMASAN -->
            <div class="tracking-step">

                <div class="tracking-icon">

                    <i class="fa-solid fa-dolly"></i>

                </div>

                <div class="tracking-line"></div>

                <div class="tracking-text">
                    Tahap Pengemasan
                </div>

            </div>


            <!-- SIAP DIAMBIL -->
            <div class="tracking-step">

                <div class="tracking-icon">

                    <i class="fa-solid fa-box-open"></i>

                </div>

                <div class="tracking-line"></div>

                <div class="tracking-text">
                    Barang Siap diambil
                </div>

            </div>


            <!-- SELESAI -->
            <div class="tracking-step">

                <div class="tracking-icon">

                    <i class="fa-regular fa-handshake"></i>

                </div>

                <div class="tracking-text">
                    Barang Sudah diambil
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>