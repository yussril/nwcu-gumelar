<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartanu_records', function (Blueprint $table) {
            $table->string('jenis_kelamin', 1)->nullable()->after('birth_date');
            $table->string('no_whatsapp', 30)->nullable()->after('jenis_kelamin');
            $table->text('alamat_lengkap')->nullable()->after('branch_name');
            $table->string('desa_ranting')->nullable()->after('alamat_lengkap');
            $table->string('foto_ktp_path')->nullable()->after('photo_path');
        });
    }

    public function down(): void
    {
        Schema::table('kartanu_records', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'no_whatsapp',
                'alamat_lengkap',
                'desa_ranting',
                'foto_ktp_path',
            ]);
        });
    }
};