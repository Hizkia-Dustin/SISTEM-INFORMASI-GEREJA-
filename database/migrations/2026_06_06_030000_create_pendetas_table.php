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
        Schema::create('pendetas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->text('foto')->nullable();
            $table->string('pasangan')->nullable();
            $table->string('email')->nullable();
            $table->text('visi_pelayanan')->nullable();
            $table->string('jadwal_konseling')->nullable();
            $table->json('riwayat_pelayanan')->nullable();
            $table->json('pendidikan')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendetas');
    }
};
