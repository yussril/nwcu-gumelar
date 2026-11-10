<?php

// 1. Tentukan jalur folder view di dalam memori /tmp Vercel
$viewPath = '/tmp/storage/framework/views';

// 2. Buat foldernya secara otomatis jika belum ada
if (!is_dir($viewPath)) {
    mkdir($viewPath, 0777, true);
}

// 3. Paksa Laravel menggunakan folder tersebut untuk cache tampilan
putenv('VIEW_COMPILED_PATH=' . $viewPath);
$_SERVER['VIEW_COMPILED_PATH'] = $viewPath;
$_ENV['VIEW_COMPILED_PATH'] = $viewPath;

// 4. Meneruskan request ke aplikasi utama Laravel
require __DIR__ . '/../public/index.php';