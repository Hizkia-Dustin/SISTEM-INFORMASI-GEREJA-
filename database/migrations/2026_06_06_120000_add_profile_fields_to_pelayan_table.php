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
        Schema::table('pelayan', function (Blueprint $table) {
            $table->string('kategori_halaman')->nullable()->after('posisi');
            $table->string('kelompok_layanan')->nullable()->after('kategori_halaman');
            $table->string('jabatan_tampilan')->nullable()->after('kelompok_layanan');
            $table->string('nama_tampilan')->nullable()->after('jabatan_tampilan');
            $table->string('foto')->nullable()->after('nama_tampilan');
            $table->string('pasangan')->nullable()->after('foto');
            $table->string('email')->nullable()->after('pasangan');
            $table->string('area_layanan')->nullable()->after('email');
            $table->string('ikon')->nullable()->after('area_layanan');
            $table->string('visi_strategis')->nullable()->after('ikon');
            $table->string('fokus_utama')->nullable()->after('visi_strategis');
            $table->text('deskripsi_singkat')->nullable()->after('fokus_utama');
            $table->text('pendidikan')->nullable()->after('deskripsi_singkat');
            $table->text('riwayat_pelayanan')->nullable()->after('pendidikan');
            $table->text('visi_pelayanan')->nullable()->after('riwayat_pelayanan');
            $table->string('jadwal_konseling')->nullable()->after('visi_pelayanan');
            $table->string('masa_bakti')->nullable()->after('jadwal_konseling');
            $table->date('update_terakhir')->nullable()->after('masa_bakti');
            $table->unsignedInteger('urutan')->default(0)->after('update_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelayan', function (Blueprint $table) {
            $table->dropColumn([
                'kategori_halaman',
                'kelompok_layanan',
                'jabatan_tampilan',
                'nama_tampilan',
                'foto',
                'pasangan',
                'email',
                'area_layanan',
                'ikon',
                'visi_strategis',
                'fokus_utama',
                'deskripsi_singkat',
                'pendidikan',
                'riwayat_pelayanan',
                'visi_pelayanan',
                'jadwal_konseling',
                'masa_bakti',
                'update_terakhir',
                'urutan',
            ]);
        });
    }
};
