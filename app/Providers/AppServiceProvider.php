<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Jumlah pesan kontak yang belum dibaca, ditampilkan sebagai badge menu sidebar
        // dan di halaman isi (dashboard / kotak masuk) agar keduanya selalu konsisten.
        View::composer('admin.*', function ($view) {
            $view->with('unreadMessageCount', ContactMessage::where('is_read', false)->count());
        });
    }
}
