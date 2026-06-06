<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pelayan')) {
            return;
        }

        Schema::table('pelayan', function (Blueprint $table) {
            if (!Schema::hasColumn('pelayan', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'no_telepon')) {
                $table->string('no_telepon')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'komisi_tujuan')) {
                $table->string('komisi_tujuan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'alasan')) {
                $table->text('alasan')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable();
            }
            if (!Schema::hasColumn('pelayan', 'tanggal_approve')) {
                $table->timestamp('tanggal_approve')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('pelayan')) {
            return;
        }

        Schema::table('pelayan', function (Blueprint $table) {
            foreach (['tanggal_approve', 'catatan_admin', 'alasan', 'komisi_tujuan', 'no_telepon', 'email'] as $column) {
                if (Schema::hasColumn('pelayan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
