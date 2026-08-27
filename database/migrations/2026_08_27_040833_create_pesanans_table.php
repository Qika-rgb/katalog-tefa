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

            $table->unsignedBigInteger('produk_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('no_telepon')->nullable();
            $table->integer('jumlah')->default(1);

            $table->enum('status', [
                'Tahap Pembuatan',
                'Pengemasan',
                'Siap Diambil',
                'Sudah Diambil'
            ])->default('Tahap Pembuatan');

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