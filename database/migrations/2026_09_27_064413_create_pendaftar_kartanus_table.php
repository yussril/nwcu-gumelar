<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_kartanus', function (Blueprint $table) {
            $table->id();
            // Tahap 1: Data Pribadi
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_whatsapp');
            
            // Tahap 2: Domisili & Ranting (Persiapan)
            $table->text('alamat_lengkap')->nullable();
            $table->string('desa_ranting')->nullable();
            
            // Tahap 3: Dokumen (Persiapan)
            $table->string('foto_ktp')->nullable();
            $table->string('pas_foto')->nullable();
            
            // Status Sistem
            $table->enum('status', ['draft', 'menunggu_verifikasi', 'diverifikasi', 'ditolak'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_kartanus');
    }
};