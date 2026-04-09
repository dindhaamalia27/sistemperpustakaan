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
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman', 'buku_id')) {
                $table->unsignedBigInteger('buku_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('peminjaman', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('buku_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'buku_id')) {
                $table->dropColumn('buku_id');
            }
            if (Schema::hasColumn('peminjaman', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
