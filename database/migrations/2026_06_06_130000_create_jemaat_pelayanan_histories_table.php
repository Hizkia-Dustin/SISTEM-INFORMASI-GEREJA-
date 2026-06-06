<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('jemaat_pelayanan_histories')) {
            return;
        }

        Schema::create('jemaat_pelayanan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaat_id')->constrained('jemaat')->cascadeOnDelete();
            $table->string('bidang_pelayanan');
            $table->string('peran')->nullable();
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
            $table->string('status')->default('Aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jemaat_pelayanan_histories');
    }
};
