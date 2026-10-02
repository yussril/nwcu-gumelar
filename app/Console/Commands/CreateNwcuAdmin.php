<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateNwcuAdmin extends Command
{
    protected $signature = 'nwcu:admin:create';

    protected $description = 'Create an account that can access the NWCU dashboard';

    public function handle(): int
    {
        $name = trim((string) $this->ask('Nama pengelola'));
        $email = mb_strtolower(trim((string) $this->ask('Email pengelola')));
        $password = (string) $this->secret('Kata sandi (minimal 12 karakter)');
        $passwordConfirmation = (string) $this->secret('Ulangi kata sandi');
        $existingUser = User::where('email', $email)->first();

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:12', 'max:255'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        if (! hash_equals($password, $passwordConfirmation)) {
            $this->error('Konfirmasi kata sandi tidak sama.');

            return self::FAILURE;
        }

        $attributes = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ];

        if ($existingUser) {
            $existingUser->update($attributes);
            $this->info('Akun yang sudah ada diperbarui dan diberi akses admin NWCU.');
        } else {
            User::create($attributes);
            $this->info('Akun pengelola NWCU berhasil dibuat.');
        }

        return self::SUCCESS;
    }
}