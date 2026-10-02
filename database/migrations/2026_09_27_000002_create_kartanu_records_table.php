<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartanu_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nia', 40)->unique();
            $table->text('nik')->nullable();
            $table->char('nik_hash', 64)->nullable()->unique();
            $table->string('branch_name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('registration_code', 40)->unique();
            $table->string('verification_status', 32)->default('submitted');
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('verification_note')->nullable();
            $table->timestamps();
            $table->index(['verification_status', 'updated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartanu_records');
    }
};