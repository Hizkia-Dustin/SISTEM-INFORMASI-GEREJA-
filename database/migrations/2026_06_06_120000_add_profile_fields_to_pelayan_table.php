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
            $columns = [
                'kategori_halaman' => fn() => $table->string('kategori_halaman')->nullable()->after('posisi'),
                'kelompok_layanan' => fn() => $table->string('kelompok_layanan')->nullable()->after('kategori_halaman'),
                'jabatan_tampilan' => fn() => $table->string('jabatan_tampilan')->nullable()->after('kelompok_layanan'),
                'nama_tampilan'    => fn() => $table->string('nama_tampilan')->nullable()->after('jabatan_tampilan'),
                'foto'             => fn() => $table->string('foto')->nullable()->after('nama_tampilan'),
                'pasangan'         => fn() => $table->string('pasangan')->nullable()->after('foto'),
                'email'            => fn() => $table->string('email')->nullable()->after('pasangan'),
                'area_layanan'     => fn() => $table->string('area_layanan')->nullable()->after('email'),
                'ikon'             => fn() => $table->string('ikon')->nullable()->after('area_layanan'),
                'visi_strategis'   => fn() => $table->string('visi_strategis')->nullable()->after('ikon'),
                'fokus_utama'      => fn() => $table->string('fokus_utama')->nullable()->after('visi_strategis'),
                'deskripsi_singkat'=> fn() => $table->text('deskripsi_singkat')->nullable()->after('fokus_utama'),
                'pendidikan'       => fn() => $table->text('pendidikan')->nullable()->after('deskripsi_singkat'),
                'riwayat_pelayanan'=> fn() => $table->text('riwayat_pelayanan')->nullable()->after('pendidikan'),
                'visi_pelayanan'   => fn() => $table->text('visi_pelayanan')->nullable()->after('riwayat_pelayanan'),
                'jadwal_konseling' => fn() => $table->string('jadwal_konseling')->nullable()->after('visi_pelayanan'),
                'masa_bakti'       => fn() => $table->string('masa_bakti')->nullable()->after('jadwal_konseling'),
                'update_terakhir'  => fn() => $table->date('update_terakhir')->nullable()->after('masa_bakti'),
                'urutan'           => fn() => $table->unsignedInteger('urutan')->default(0)->after('update_terakhir'),
            ];

            foreach ($columns as $col => $addCol) {
                if (!Schema::hasColumn('pelayan', $col)) {
                    $addCol();
                }
            }
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
