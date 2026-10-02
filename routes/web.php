<?php

use App\Http\Controllers\Admin\BanomController as AdminBanomController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KartaNuController as AdminKartaNuController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CetakKartanuController;
use App\Http\Controllers\KartaNuController;
use App\Http\Controllers\PendaftarKartanuController;
use App\Models\Article;
use App\Models\Banom;
use App\Models\GalleryItem;
use App\Models\Kegiatan;
use App\Services\KegiatanMover;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $articles = Article::where('is_published', true)
        ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(3)
        ->get();

    return view('beranda', [
        'articles' => $articles,
    ]);
})->name('beranda');

Route::get('/berita', function () {
    $published = Article::where('is_published', true)
        ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()));
    $featuredArticle = (clone $published)->where('is_featured', true)->orderByDesc('published_at')->first();

    return view('public.berita', [
        'title' => 'Warta Nahdliyin - MWCNU Gumelar',
        'featuredArticle' => $featuredArticle,
        'articles' => (clone $published)->when($featuredArticle, fn ($query) => $query->whereKeyNot($featuredArticle->id))->orderByDesc('published_at')->orderByDesc('id')->get(),
        'publicationCount' => (clone $published)->count(),
    ]);
})->name('berita');

Route::get('/berita/{article:slug}', function (Article $article) {
    abort_unless($article->is_published && (! $article->published_at || $article->published_at->isPast()), 404);

    return view('public.berita-detail', ['title' => $article->title . ' - Warta Nahdliyin', 'article' => $article]);
})->name('berita.show');

Route::get('/banom', fn () => view('banom', [
    'title' => 'Struktur Jam\'iyyah & Badan Otonom - MWCNU Gumelar',
    'banoms' => Banom::with('members')->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
]))->name('banom');

Route::get('/kegiatan', function () {
    // Otomatis memindahkan kegiatan yang sudah melewati akhir pelaksanaannya ke galeri,
    // tanpa perlu cron/scheduler.
    KegiatanMover::moveDue();

    $kegiatans = Kegiatan::where('is_published', true)
        ->upcoming()
        ->orderBy('scheduled_at')
        ->get();

    $featuredKegiatan = $kegiatans->first();
    $remainingKegiatans = $kegiatans->slice(1);

    return view('public.kegiatan', [
        'title' => 'Kegiatan MWCNU Gumelar',
        'kegiatans' => $remainingKegiatans,
        'featuredKegiatan' => $featuredKegiatan,
        'kegiatanCount' => $kegiatans->count(),
    ]);
})->name('kegiatan');

Route::get('/galeri', function () {
    // Halaman galeri juga memicu pemindahan agar arsip selalu ter-update saat dibuka.
    KegiatanMover::moveDue();

    return view('public.galeri', [
        'title' => 'Galeri & Dokumentasi Khidmat - MWCNU Gumelar',
        'galleryItems' => GalleryItem::where('is_published', true)->orderByDesc('event_date')->orderByDesc('id')->get(),
    ]);
})->name('galeri');

Route::get('/galeri/{gallery:slug}', function (GalleryItem $gallery) {
    abort_unless($gallery->is_published, 404);

    return view('public.galeri-detail', [
        'title' => $gallery->title . ' - Galeri MWCNU Gumelar',
        'item' => $gallery->load('photos'),
    ]);
})->name('galeri.show');

Route::get('/kartanu', [KartaNuController::class, 'index'])->name('kartanu');
Route::post('/kartanu/lookup', [KartaNuController::class, 'lookup'])->middleware('throttle:6,1')->name('kartanu.lookup');
Route::post('/kartanu/track', [KartaNuController::class, 'track'])->middleware('throttle:6,1')->name('kartanu.track');

Route::get('/kontak', fn () => view('public.kontak', [
    'title' => 'Hubungi Kami - MWCNU Gumelar',
]))->name('kontak');

Route::get('/pendaftaran/kartanu', [PendaftarKartanuController::class, 'index'])->name('pendaftaran.kartanu');
Route::post('/pendaftaran/kartanu', [PendaftarKartanuController::class, 'store'])->name('pendaftaran.kartanu.store');
Route::get('/pendaftaran/kartanu/sukses', [PendaftarKartanuController::class, 'success'])->name('pendaftaran.kartanu.sukses');

Route::get('/cetak-kartanu', [CetakKartanuController::class, 'index'])->name('cetak-kartanu.index');
Route::get('/cetak-kartanu/show', [CetakKartanuController::class, 'show'])->name('cetak-kartanu.show');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('banoms', AdminBanomController::class)
        ->except('show')
        ->parameters(['banoms' => 'banom'])
        ->names('admin.banoms');

    Route::resource('articles', ArticleController::class)
        ->except('show')
        ->names('admin.articles');

    Route::resource('gallery', GalleryController::class)
        ->only(['index', 'edit', 'destroy'])
        ->names('admin.gallery');

    Route::post('gallery/{gallery}/photos', [GalleryController::class, 'addPhoto'])->name('admin.gallery.addPhoto');
    Route::delete('gallery/{gallery}/photos/{photo}', [GalleryController::class, 'deletePhoto'])->name('admin.gallery.deletePhoto');

    Route::resource('kegiatans', KegiatanController::class)
        ->except('show')
        ->parameters(['kegiatans' => 'kegiatan'])
        ->names('admin.kegiatans');

    Route::resource('kartanu', AdminKartaNuController::class)
        ->names('admin.kartanu');
Route::post('kartanu/{kartanu}/approve', [AdminKartaNuController::class, 'approve'])->name('admin.kartanu.approve');
Route::post('kartanu/{kartanu}/reject', [AdminKartaNuController::class, 'reject'])->name('admin.kartanu.reject');
Route::get('kartanu/{kartanu}/print', [AdminKartaNuController::class, 'print'])->name('admin.kartanu.print');

    Route::view('/settings', 'admin.settings', ['title' => 'Pengaturan Akun - Admin NWCU'])->name('admin.settings');
    Route::put('/settings/password', [PasswordController::class, 'update'])->name('admin.settings.password');
});

require __DIR__.'/auth.php';
