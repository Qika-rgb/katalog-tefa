<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portofolio_images', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel portofolios. Jika portofolio dihapus, foto slider otomatis terhapus (cascade)
            $table->foreignId('portofolio_id')->constrained('portofolios')->onDelete('cascade');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portofolio_images');
    }
};