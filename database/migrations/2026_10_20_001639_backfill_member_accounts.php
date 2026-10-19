<?php

use App\Models\KartaNu;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Membuatkan akun login bagi jamaah KartaNU yang sudah terdaftar sebelumnya.
     * Kata sandi default memakai tanggal lahir format DDMMYYYY, sama seperti
     * akun yang dibuat dari formulir pendaftaran.
     */
    public function up(): void
    {
        KartaNu::query()
            ->whereNotNull('nik')
            ->whereNotNull('birth_date')
            ->whereNull('user_id')
            ->chunkById(100, function ($records): void {
                foreach ($records as $record) {
                    $user = User::firstOrCreate(
                        ['nik' => $record->nik],
                        [
                            'name' => $record->name,
                            'email' => null,
                            'password' => Hash::make($record->birth_date->format('dmY')),
                            'is_admin' => false,
                        ],
                    );

                    $record->update(['user_id' => $user->id]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data backfill dibiarkan apa adanya; tidak ada penghapusan akun.
    }
};
