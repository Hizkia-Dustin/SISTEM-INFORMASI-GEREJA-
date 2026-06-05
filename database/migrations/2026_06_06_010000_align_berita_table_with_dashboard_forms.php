<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            if (!Schema::hasColumn('berita', 'kategori')) {
                $table->string('kategori')->nullable()->after('judul');
            }

            if (!Schema::hasColumn('berita', 'isi')) {
                $table->text('isi')->nullable()->after('kategori');
            }

            if (!Schema::hasColumn('berita', 'gambar')) {
                $table->string('gambar')->nullable()->after('isi');
            }
        });

        if (Schema::hasColumn('berita', 'konten')) {
            \Illuminate\Support\Facades\DB::table('berita')
                ->whereNull('isi')
                ->update(['isi' => \Illuminate\Support\Facades\DB::raw('konten')]);
        }
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'gambar')) {
                $table->dropColumn('gambar');
            }

            if (Schema::hasColumn('berita', 'isi')) {
                $table->dropColumn('isi');
            }

            if (Schema::hasColumn('berita', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};
