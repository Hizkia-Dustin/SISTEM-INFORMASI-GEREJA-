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
            if (!Schema::hasColumn('pelayan', 'posisi')) {
                $table->string('posisi')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'kategori_halaman')) {
                $table->string('kategori_halaman')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'kelompok_layanan')) {
                $table->string('kelompok_layanan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'jabatan_tampilan')) {
                $table->string('jabatan_tampilan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'nama_tampilan')) {
                $table->string('nama_tampilan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'foto')) {
                $table->string('foto')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'pasangan')) {
                $table->string('pasangan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'area_layanan')) {
                $table->string('area_layanan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'ikon')) {
                $table->string('ikon')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'visi_strategis')) {
                $table->string('visi_strategis')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'fokus_utama')) {
                $table->string('fokus_utama')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'deskripsi_singkat')) {
                $table->text('deskripsi_singkat')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'pendidikan')) {
                $table->text('pendidikan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'riwayat_pelayanan')) {
                $table->text('riwayat_pelayanan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'visi_pelayanan')) {
                $table->text('visi_pelayanan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'jadwal_konseling')) {
                $table->string('jadwal_konseling')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'masa_bakti')) {
                $table->string('masa_bakti')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'update_terakhir')) {
                $table->date('update_terakhir')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'urutan')) {
                $table->unsignedInteger('urutan')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelayan', function (Blueprint $table) {
            $columns = array_filter([
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
            ], fn ($column) => Schema::hasColumn('pelayan', $column));

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
