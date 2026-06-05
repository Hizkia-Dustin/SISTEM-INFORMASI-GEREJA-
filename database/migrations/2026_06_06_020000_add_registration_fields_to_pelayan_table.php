<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelayan', function (Blueprint $table) {
            if (!Schema::hasColumn('pelayan', 'email')) {
                $table->string('email')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('pelayan', 'no_telepon')) {
                $table->string('no_telepon')->nullable()->after('email');
            }
            if (!Schema::hasColumn('pelayan', 'komisi_tujuan')) {
                $table->string('komisi_tujuan')->nullable()->after('posisi');
            }
            if (!Schema::hasColumn('pelayan', 'alasan')) {
                $table->text('alasan')->nullable()->after('komisi_tujuan');
            }
            if (!Schema::hasColumn('pelayan', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('alasan');
            }
            if (!Schema::hasColumn('pelayan', 'tanggal_approve')) {
                $table->timestamp('tanggal_approve')->nullable()->after('tanggal_mulai');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pelayan', function (Blueprint $table) {
            foreach (['tanggal_approve', 'catatan_admin', 'alasan', 'komisi_tujuan', 'no_telepon', 'email'] as $column) {
                if (Schema::hasColumn('pelayan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
