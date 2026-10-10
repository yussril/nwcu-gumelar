<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banom;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\KartaNu;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard Admin - MWCNU Gumelar',
            'articleCount' => Article::count(),
            'publishedArticleCount' => Article::where('is_published', true)->count(),
            'banomCount' => Banom::count(),
            'activeBanomCount' => Banom::where('is_active', true)->count(),
            'galleryCount' => GalleryItem::count(),
            'publishedGalleryCount' => GalleryItem::where('is_published', true)->count(),
            'memberCount' => \App\Models\BanomMember::count(),
            'kartaNuCount' => KartaNu::count(),
            'koinNuTotal' => 34200000,
            'recentArticles' => Article::latest('updated_at')->limit(4)->get(),
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
            'recentActivities' => [
                [
                    'initials' => 'AF',
                    'message' => 'Artikel "Giat Banser Cihonje Buka Akses Jalan Longsor" berhasil diterbitkan',
                    'author' => 'Tim Media Ansor Gumelar',
                    'time' => '15 menit yang lalu',
                    'category' => 'Warta Nahdliyin',
                    'bg' => 'bg-secondary-container',
                    'text' => 'text-on-secondary-fixed',
                    'badgeBg' => 'bg-secondary-container/40',
                    'badgeText' => 'text-secondary',
                ],
                [
                    'initials' => 'LZ',
                    'message' => 'Laporan Keuangan UPZIS LAZISNU Periode April diperbarui dan diaudit',
                    'author' => 'Bendahara UPZIS',
                    'time' => '2 jam yang lalu',
                    'category' => 'Filantropi & ZIS',
                    'bg' => 'bg-primary-fixed',
                    'text' => 'text-primary-container',
                    'badgeBg' => 'bg-primary-fixed/40',
                    'badgeText' => 'text-primary-container',
                ],
                [
                    'initials' => 'PR',
                    'message' => '12 Pendaftar KartaNU baru dari Ranting Samudra disetujui',
                    'author' => 'Operator SIK PRNU Samudra',
                    'time' => '4 jam yang lalu',
                    'category' => 'Sensus KartaNU',
                    'bg' => 'bg-primary-fixed',
                    'text' => 'text-primary-container',
                    'badgeBg' => 'bg-primary-fixed/40',
                    'badgeText' => 'text-primary-container',
                ],
                [
                    'initials' => 'SK',
                    'message' => 'SK Kepengurusan PAC Fatayat NU Gumelar Masa Khidmat 2024-2028 diarsipkan',
                    'author' => 'Sekretariat MWCNU',
                    'time' => 'Kemarin, 16:30 WIB',
                    'category' => 'Administrasi Banom',
                    'bg' => 'bg-surface-container',
                    'text' => 'text-on-surface',
                    'badgeBg' => 'bg-surface-container-high',
                    'badgeText' => 'text-on-surface-variant',
                ],
            ],
        ]);
    }
}
