    // Halaman Katalog untuk Customer (Sudah Dilengkapi Logika Filter & Search)
    public function indexKatalog()
    {
        // 1. Tangkap apa yang diklik/diketik user di URL
        $kategori = request('kategori');
        $cari = request('cari');

        // 2. Siapkan wadah query database (sudah termasuk relasi kategori)
        $query = Produk::with('kategori');

        // 3. Logika Filter Kategori Jurusan
        if ($kategori !== null && $kategori !== 'all') {
            // Saring produk berdasarkan ID kategori (0=RPL, 1=Animasi, dll)
            $query->where('kategori_id', $kategori);
        }

        // 4. Logika Filter Pencarian (Search Bar)
        if ($cari) {
            // Cari produk yang namanya mirip dengan ketikan user