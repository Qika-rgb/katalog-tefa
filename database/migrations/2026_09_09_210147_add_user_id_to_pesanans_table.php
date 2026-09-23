<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hanya tambahkan kolom jika 'user_id' belum ada
        if (!Schema::hasColumn('pesanans', 'user_id')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        // Hanya hapus kolom jika 'user_id' memang ada
        if (Schema::hasColumn('pesanans', 'user_id')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};