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
        if (!Schema::hasTable('jadwal')) {
            return;
        }

        Schema::table('jadwal', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal', 'lokasi')) {
                $table->string('lokasi')->nullable()->change();
            }
            if (Schema::hasColumn('jadwal', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            //
        });
    }
};
