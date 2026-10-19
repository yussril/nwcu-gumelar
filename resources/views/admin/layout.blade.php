<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin MWCNU' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Sama seperti layout situs publik: keluarga font dipasang lewat `font-body-md`.
         Ukuran dasar sengaja TIDAK dikunci dengan `text-body-md`, sehingga yang
         berlaku warisan 16px dari browser -- identik dengan web publik. --}}
<body class="bg-background font-body-md text-on-surface antialiased">
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 max-w-[85vw] lg:w-64 bg-surface-container-lowest border-r border-outline-variant/30 z-50 flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300" role="dialog" aria-modal="false" aria-label="Menu admin">
        <div class="flex items-center justify-between gap-3 px-4 sm:px-5 pb-5 pt-4 sm:pt-5 border-b border-outline-variant/20">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0 bg-surface-container-lowest">
                    <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain">
                </div>
                <div class="min-w-0">
                    {{-- Tipografi disamakan dengan blok brand header web publik:
                         nama tebal (font-bold), sub-teks memakai font-label-sm
                         dengan font-medium + tracking-wide. --}}
                    <div class="font-headline-sm text-headline-sm font-bold text-primary tracking-tight leading-none truncate">MWCNU ADMIN</div>
                    <div class="font-label-sm text-label-sm font-medium text-secondary tracking-wide mt-1 truncate">KEC. GUMELAR</div>
                </div>
            </div>
            <button class="lg:hidden p-2 -mr-1 rounded-lg hover:bg-surface-container-low shrink-0" onclick="toggleSidebar()" aria-label="Tutup menu" type="button">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        <nav class="flex-1 flex flex-col gap-1 px-3 py-4 overflow-y-auto" aria-label="Menu admin">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('dashboard') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.articles.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                <span>Warta Nahdliyin</span>
            </a>
            <a href="{{ route('admin.banoms.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.banoms.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[20px]">group_work</span>
                <span>Manajemen Banom</span>
            </a>
            <a href="{{ route('admin.kartanu.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.kartanu.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">id_card</span>
                    <span>Data KartaNU</span>
                </div>
                @if(isset($pendingKartanuCount) && $pendingKartanuCount > 0)
                    <span class="px-2 py-0.5 rounded-full bg-primary-container/10 text-primary-container font-label-sm text-[11px] font-bold">{{ $pendingKartanuCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.kegiatans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.kegiatans.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[20px]">event</span>
                <span>Kegiatan</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[20px]">photo_library</span>
                <span>Galeri</span>
            </a>
            <a href="{{ route('admin.pesan.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all {{ request()->routeIs('admin.pesan.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    <span>Pesan Masuk</span>
                </div>
                @if(($unreadMessageCount ?? 0) > 0)
                    <span class="px-2 py-0.5 rounded-full bg-primary-container/10 text-primary-container font-label-sm text-[11px] font-bold">{{ $unreadMessageCount }}</span>
                @endif
            </a>
        </nav>
        <div class="px-3 py-4 border-t border-outline-variant/20">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 text-on-primary">
                        <span class="material-symbols-outlined text-[16px]">verified_user</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-label-sm text-label-sm font-semibold text-on-surface leading-tight truncate">{{ auth()->user()->name }}</span>
                        <span class="font-label-caps text-label-caps text-secondary leading-tight truncate">Admin Utama</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="p-1.5 text-secondary hover:text-error hover:bg-error-container/40 rounded-lg transition-colors flex items-center justify-center flex-shrink-0" title="Keluar / Logout" type="submit">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                    </button>
                </form>
            </div>

            <a class="mt-3 flex items-center gap-2.5 rounded-xl px-3 py-2.5 font-label-md text-label-md text-on-surface-variant transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('beranda') }}" target="_blank" rel="noopener noreferrer">
                <span class="material-symbols-outlined text-[20px]">public</span>
                <span>Lihat Website</span>
                <span class="material-symbols-outlined text-[16px] ml-auto">arrow_outward</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:pl-64 min-h-dvh flex flex-col">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 lg:left-64 h-16 bg-surface-container-lowest/95 backdrop-blur-md border-b border-outline-variant/30 px-3 sm:px-4 md:px-6 z-30 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <button class="lg:hidden p-2 -ml-1 rounded-lg hover:bg-surface-container-low shrink-0" onclick="toggleSidebar()" aria-label="Buka menu" type="button">
                    <span class="material-symbols-outlined text-[20px]">menu</span>
                </button>
                <p class="font-body-sm text-body-sm text-secondary truncate">{{ $title ?? 'Pusat Informasi MWCNU' }}</p>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <div class="relative hidden sm:flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary text-[16px]">search</span>
                    <input class="w-48 md:w-56 lg:w-72 h-9 pl-9 pr-3 rounded-lg bg-surface-container-low border border-outline-variant/30 font-body-sm text-body-sm text-on-surface placeholder:text-secondary focus:outline-none focus:border-primary focus:bg-surface-container-lowest transition-all" placeholder="Cari arsip, sensus, warga..." type="text">
                </div>
                <div class="hidden md:flex items-center font-label-sm text-label-sm text-secondary border-l border-outline-variant/30 pl-3 py-1 gap-2">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                    <span>{{ now()->translatedFormat('d M Y') }}</span>
                </div>
                <button class="w-8 h-8 rounded-full bg-primary text-on-primary hover:opacity-95 transition-opacity flex items-center justify-center shrink-0" title="Profil Pengguna" type="button">
                    <span class="material-symbols-outlined text-[16px]">person</span>
                </button>
            </div>
        </header>
        <!-- Page Content -->
        <main class="w-full pt-16 flex-1 bg-background">
            <div class="p-4 md:p-6 lg:p-8 max-w-[1400px] w-full mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar(force) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isHidden = sidebar.classList.contains('-translate-x-full');
            const open = typeof force === 'boolean' ? force : isHidden;

            sidebar.classList.toggle('-translate-x-full', !open);
            overlay.classList.toggle('hidden', !open);
            sidebar.setAttribute('aria-modal', open ? 'true' : 'false');

            // Kunci gulir halaman di balik sidebar pada layar ponsel.
            document.body.style.overflow = open ? 'hidden' : '';
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') toggleSidebar(false);
        });

        // Tutup sidebar otomatis saat layar membesar atau pengguna berpindah halaman.
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) toggleSidebar(false);
        });
    </script>
</body>
</html>
