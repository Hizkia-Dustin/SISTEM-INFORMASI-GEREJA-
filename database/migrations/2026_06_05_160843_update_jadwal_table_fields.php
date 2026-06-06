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
            if (!Schema::hasColumn('jadwal', 'nama_acara')) {
                $table->string('nama_acara')->nullable();
            }
            if (!Schema::hasColumn('jadwal', 'waktu_mulai')) {
                $table->time('waktu_mulai')->nullable();
            }
            if (!Schema::hasColumn('jadwal', 'jenis')) {
                $table->string('jenis')->nullable();
            }
            if (!Schema::hasColumn('jadwal', 'jumlah_hadir')) {
                $table->integer('jumlah_hadir')->nullable();
            }
            if (!Schema::hasColumn('jadwal', 'lampiran')) {
                $table->string('lampiran')->nullable();
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
