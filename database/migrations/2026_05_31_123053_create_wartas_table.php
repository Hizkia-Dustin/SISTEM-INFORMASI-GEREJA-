<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warta', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Warta Jemaat');
            $table->string('status')->default('Draft');
            $table->text('isi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warta');
    }
};
