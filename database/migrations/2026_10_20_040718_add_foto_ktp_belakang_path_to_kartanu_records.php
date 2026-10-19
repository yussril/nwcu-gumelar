<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartanu_records', function (Blueprint $table) {
            $table->string('foto_ktp_belakang_path')->nullable()->after('foto_ktp_path');
        });
    }

    public function down(): void
    {
        Schema::table('kartanu_records', function (Blueprint $table) {
            $table->dropColumn('foto_ktp_belakang_path');
        });
    }
};
