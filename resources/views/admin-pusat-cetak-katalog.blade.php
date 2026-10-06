<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - TEFA SMKN 4</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="cetak-body">

    <!-- TOMBOL AKSI LAYAR (TIDAK AKAN DICETAK) -->
    <div class="no-print-bar">
        <div>
            <span style="font-size: 13px; font-weight: 600; color: #475569;">
                <i class="fa-solid fa-circle-info" style="color: #2563eb;"></i> 
                Tips: Hilangkan centang <em>"Headers and footers"</em> di menu cetak agar bersih dari URL dan tanggal bawaan browser.
            </span>
        </div>
        <div style="display: flex; gap: 8px;">
            <button onclick="window.print()" class="btn-action btn-print">
                <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
            </button>
            <button onclick="window.close()" class="btn-action btn-back">
                <i class="fa-solid fa-xmark"></i> Tutup
            </button>
        </div>
    </div>

    <!-- WRAPPER CETAK DENGAN TABLE AGAR HEADER BERULANG DI SETIAP HALAMAN -->
    <table class="table-print-wrapper">
        <!-- THEAD INI YANG AKAN OTOMATIS BERULANG DI SETIAP LEMBAR CETAK -->
        <thead>
            <tr>
                <td>
                    <div class="header-cetak">
                        <div class="header-left">
                            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA">
                            <div class="brand-text">
                                <h2>TEACHING FACTORY SMKN 4</h2>
                                <p>Katalog Resmi Produk & Jasa Kejuruan</p>
                            </div>
                        </div>

                        <div class="header-right">
                            <div class="tag-katalog">Katalog Produk</div>
                            <p class="date-text">Per Tanggal: {{ date('d F Y') }}</p>
                        </div>
                    </div>
                </td>
            </tr>
        </thead>

        <!-- KONTEN PRODUK -->
        <tbody>
            <tr>
                <td>
                    <div class="katalog-grid">
                        @forelse ($produks as $produk)
                            @php
                                $fileMedia = $produk->foto ?? 'produk_dkv2.png';
                                $isStorage = \Illuminate\Support\Str::startsWith($fileMedia, 'produk/');
                                $mediaSrc = $isStorage ? asset('storage/' . $fileMedia) : asset('images/' . $fileMedia);
                                $isVideo = \Illuminate\Support\Str::endsWith(strtolower($fileMedia), ['.mp4', '.webm', '.ogg', '.mov']);
                            @endphp

                            <div class="katalog-item">
                                <div class="img-box">
                                    @if ($isVideo)
                                        <video src="{{ $mediaSrc }}" muted></video>
                                    @else
                                        <img src="{{ $mediaSrc }}" alt="{{ $produk->nama_produk }}">
                                    @endif
                                </div>

                                <div class="content-box">
                                    <span class="katalog-category">
                                        {{ $produk->kategori->nama_kategori ?? $produk->kategori->nama ?? 'Umum' }}
                                    </span>

                                    <h4 class="katalog-title">{{ $produk->nama_produk }}</h4>

                                    <div class="katalog-price">
                                        RP {{ number_format((float) preg_replace('/[^0-9]/', '', (string)$produk->harga), 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p style="text-align: center; color: #64748b; padding: 40px 0;">
                                Belum ada data produk untuk dicetak.
                            </p>
                        @endforelse
                    </div>

                    <!-- FOOTER AKHIR DOKUMEN -->
                    <div class="katalog-footer">
                        <span>© {{ date('Y') }} TEFA SMKN 4 TANJUNGPINANG</span>
                        <span>Dokumen Resmi Informasi Produk</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 300);
        });
    </script>
</body>
</html>