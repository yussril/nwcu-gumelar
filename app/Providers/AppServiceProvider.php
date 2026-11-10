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
        // 1. Paksa buat direktori view compiled di /tmp khusus untuk Vercel
        $viewPath = env('VIEW_COMPILED_PATH');
        if ($viewPath && !is_dir($viewPath)) {
            mkdir($viewPath, 0755, true);
        }

        // 2. Kode bawaanmu untuk badge pesan admin
        View::composer('admin.*', function ($view) {
            $view->with('unreadMessageCount', ContactMessage::where('is_read', false)->count());
        });
    }
}