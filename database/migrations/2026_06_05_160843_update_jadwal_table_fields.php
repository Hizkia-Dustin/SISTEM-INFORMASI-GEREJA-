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
        Schema::table('jadwal', function (Blueprint $table) {
            $table->renameColumn('nama_acara', 'nama');
            $table->renameColumn('waktu_mulai', 'waktu');
            $table->string('jenis')->nullable();
            $table->integer('jumlah_hadir')->nullable();
            $table->string('lampiran')->nullable();
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
