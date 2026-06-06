<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('email');
            $table->string('role')->default('Admin')->nullable()->after('username');
            $table->string('no_induk')->nullable()->after('role');
            $table->string('jenis_kelamin')->nullable()->after('no_induk');
            $table->text('alamat')->nullable()->after('jenis_kelamin');
            $table->string('status_anggota')->nullable()->after('alamat');
            $table->string('status_pernikahan')->nullable()->after('status_anggota');
            $table->date('tanggal_baptis')->nullable()->after('status_pernikahan');
            $table->date('tanggal_sidi')->nullable()->after('tanggal_baptis');
            $table->string('foto_profil')->nullable()->after('tanggal_sidi');
            $table->string('sektor')->nullable()->after('foto_profil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'role',
                'no_induk',
                'jenis_kelamin',
                'alamat',
                'status_anggota',
                'status_pernikahan',
                'tanggal_baptis',
                'tanggal_sidi',
                'foto_profil',
                'sektor',
            ]);
        });
    }
};
