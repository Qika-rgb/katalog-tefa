<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id();

        // Menggunakan foreignId agar terhubung resmi ke tabel users dan produks
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');

        $table->string('no_telepon');
        $table->integer('jumlah')->default(1);
        $table->bigInteger('total_harga')->default(0); // Ditambahkan untuk menyimpan total bayar

        $table->enum('status', [
            'Pending',
            'Tahap Pembuatan',
            'Pengemasan',
            'Siap Diambil',
            'Sudah Diambil',
            'Ditolak'
        ])->default('Pending');

        $table->date('estimasi_selesai')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};