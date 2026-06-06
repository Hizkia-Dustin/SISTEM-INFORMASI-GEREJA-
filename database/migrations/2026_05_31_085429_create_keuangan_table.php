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
        if (Schema::hasTable('keuangan')) {
            return;
        }

        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('jenis_transaksi');
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
