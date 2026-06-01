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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk')->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('nama')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('jenis_kelamin');
            $table->string('posisi')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->string('status_nikah')->nullable();
            $table->string('status_keanggotaan')->default('Anggota');
            $table->boolean('status_aktif')->default(true);
            $table->string('baptis')->nullable();
            $table->string('sidi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('lampiran_baptis')->nullable();
            $table->string('lampiran_sidi')->nullable();
            $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaat');
    }
};
