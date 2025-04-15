<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->text('keluhan')->nullable()->after('tgl_periksa');
        });
    }

    public function down(): void
    {
        Schema::table('periksa', function (Blueprint $table) {
            $table->dropColumn('keluhan');
        });
    }
};
