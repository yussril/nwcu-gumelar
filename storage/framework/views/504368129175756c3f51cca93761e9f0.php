<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Admin MWCNU'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-background font-body-md text-body-md text-on-surface antialiased">
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-surface-container-lowest border-r border-outline-variant/30 z-50 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div class="flex items-center justify-between px-5 pb-5 pt-5 border-b border-outline-variant/20">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0 bg-surface-container-lowest">
                    <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">MWCNU ADMIN</div>
                    <div class="font-label-caps text-label-caps text-secondary tracking-widest mt-0.5">KEC. GUMELAR</div>
                </div>
            </div>
            <button class="lg:hidden p-1.5 rounded-lg hover:bg-surface-container-low" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        <nav class="flex-1 flex flex-col gap-1 px-3 py-4 overflow-y-auto" aria-label="Menu admin">
            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('dashboard') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('admin.articles.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.articles.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <span class="material-symbols-outlined text-[20px]">newspaper</span>
                <span>Warta Nahdliyin</span>
            </a>
            <a href="<?php echo e(route('admin.banoms.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.banoms.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <span class="material-symbols-outlined text-[20px]">group_work</span>
                <span>Manajemen Banom</span>
            </a>
            <a href="<?php echo e(route('admin.kartanu.index')); ?>" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.kartanu.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">id_card</span>
                    <span>Data KartaNU</span>
                </div>
                <?php if(isset($pendingKartanuCount) && $pendingKartanuCount > 0): ?>
                    <span class="px-2 py-0.5 rounded-full bg-primary-container/10 text-primary-container font-label-sm text-[11px] font-bold"><?php echo e($pendingKartanuCount); ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo e(route('admin.kegiatans.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.kegiatans.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <span class="material-symbols-outlined text-[20px]">event</span>
                <span>Kegiatan</span>
            </a>
            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.gallery.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <span class="material-symbols-outlined text-[20px]">photo_library</span>
                <span>Galeri</span>
            </a>
            <a href="<?php echo e(route('admin.pesan.index')); ?>" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-label-md text-label-md transition-all <?php echo e(request()->routeIs('admin.pesan.*') ? 'bg-primary-fixed text-primary font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface'); ?>">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    <span>Pesan Masuk</span>
                </div>
                <?php if(($unreadMessageCount ?? 0) > 0): ?>
                    <span class="px-2 py-0.5 rounded-full bg-primary-container/10 text-primary-container font-label-sm text-[11px] font-bold"><?php echo e($unreadMessageCount); ?></span>
                <?php endif; ?>
            </a>
        </nav>
        <div class="px-3 py-4 border-t border-outline-variant/20">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 text-on-primary">
                        <span class="material-symbols-outlined text-[16px]">verified_user</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-label-sm text-label-sm font-semibold text-on-surface leading-tight truncate"><?php echo e(auth()->user()->name); ?></span>
                        <span class="font-label-caps text-label-caps text-secondary leading-tight truncate">Admin Utama</span>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="p-1.5 text-secondary hover:text-error hover:bg-error-container/40 rounded-lg transition-colors flex items-center justify-center flex-shrink-0" title="Keluar / Logout" type="submit">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:pl-64 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 lg:left-64 h-16 bg-surface-container-lowest/95 backdrop-blur-md border-b border-outline-variant/30 px-4 md:px-6 z-30 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button class="lg:hidden p-1.5 rounded-lg hover:bg-surface-container-low" onclick="toggleSidebar()">
                    <span class="material-symbols-outlined text-[20px]">menu</span>
                </button>
                <p class="font-body-sm text-body-sm text-secondary"><?php echo e($title ?? 'Pusat Informasi MWCNU'); ?></p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative hidden sm:flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary text-[16px]">search</span>
                    <input class="w-56 lg:w-72 h-9 pl-9 pr-3 rounded-lg bg-surface-container-low border border-outline-variant/30 font-body-sm text-body-sm text-on-surface placeholder:text-secondary focus:outline-none focus:border-primary focus:bg-surface-container-lowest transition-all" placeholder="Cari arsip, sensus, warga..." type="text">
                </div>
                <div class="hidden md:flex items-center font-label-sm text-label-sm text-secondary border-l border-outline-variant/30 pl-3 py-1 gap-2">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                    <span><?php echo e(now()->translatedFormat('d M Y')); ?></span>
                </div>
                <button class="w-8 h-8 rounded-full bg-primary text-on-primary hover:opacity-95 transition-opacity flex items-center justify-center" title="Profil Pengguna">
                    <span class="material-symbols-outlined text-[16px]">person</span>
                </button>
            </div>
        </header>
        <!-- Page Content -->
        <main class="w-full pt-16 flex-1 bg-background">
            <div class="p-4 md:p-6 lg:p-8 max-w-[1400px] w-full mx-auto">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isHidden = sidebar.classList.contains('-translate-x-full');

            if (isHidden) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/layout.blade.php ENDPATH**/ ?>