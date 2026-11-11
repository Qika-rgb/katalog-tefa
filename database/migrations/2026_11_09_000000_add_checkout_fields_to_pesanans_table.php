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
        Schema::table('pesanans', function (Blueprint $table) {
            if (!Schema::hasColumn('pesanans', 'nama_pemesan')) {
                $table->string('nama_pemesan')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('pesanans', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('no_telepon');
            }
            if (!Schema::hasColumn('pesanans', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('pesanans', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->nullable()->default('Transfer')->after('alamat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $columnsToDrop = [];
            foreach (['nama_pemesan', 'no_hp', 'alamat', 'metode_pembayaran'] as $col) {
                if (Schema::hasColumn('pesanans', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
