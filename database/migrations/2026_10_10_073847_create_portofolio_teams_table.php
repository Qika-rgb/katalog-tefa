<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portofolio_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portofolio_id')->constrained('portofolios')->onDelete('cascade');
            $table->string('nama');
            $table->string('peran'); // Contoh: Frontend, Backend, Desainer
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portofolio_teams');
    }
};