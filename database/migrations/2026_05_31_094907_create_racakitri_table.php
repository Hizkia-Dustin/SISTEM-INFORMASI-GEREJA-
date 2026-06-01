<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('racakitri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Racakitri');
            $table->string('status')->default('Draft');
            $table->text('isi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('racakitri');
    }
};
