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
        Schema::create('penatuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('kategori'); // Pengurus Harian, Bidang Kerja, Pendamping Komisi
            $table->string('sub_kategori')->nullable(); // Bid. Sarpen, Komisi Anak, dll.
            $table->string('status')->default('Aktif');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penatuas');
    }
};
