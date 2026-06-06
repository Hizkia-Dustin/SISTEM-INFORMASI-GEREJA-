<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('renungan') || Schema::hasColumn('renungan', 'gambar')) {
            return;
        }

        Schema::table('renungan', function (Blueprint $table) {
            $table->string('gambar')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('renungan') || !Schema::hasColumn('renungan', 'gambar')) {
            return;
        }

        Schema::table('renungan', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
