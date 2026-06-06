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
        if (!Schema::hasTable('artikel')) {
            return;
        }

        Schema::table('artikel', function (Blueprint $table) {
            if (Schema::hasColumn('artikel', 'konten') && !Schema::hasColumn('artikel', 'isi')) {
                $table->renameColumn('konten', 'isi');
            }
            if (!Schema::hasColumn('artikel', 'gambar')) {
                $table->string('gambar')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('artikel')) {
            return;
        }

        Schema::table('artikel', function (Blueprint $table) {
            if (Schema::hasColumn('artikel', 'gambar')) {
                $table->dropColumn('gambar');
            }
            if (Schema::hasColumn('artikel', 'isi') && !Schema::hasColumn('artikel', 'konten')) {
                $table->renameColumn('isi', 'konten');
            }
        });
    }
};
