<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('video')) {
            return;
        }

        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Video');
            $table->string('status')->default('Draft');
            $table->text('isi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
