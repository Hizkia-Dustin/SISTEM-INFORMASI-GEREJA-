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
        if (!Schema::hasTable('renungan') || Schema::hasColumn('renungan', 'ayat')) {
            return;
        }

        Schema::table('renungan', function (Blueprint $table) {
            $table->string('ayat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renungan', function (Blueprint $table) {
            //
        });
    }
};
