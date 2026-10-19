<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo e($title ?? 'Portal Nahdliyin - MWCNU Gumelar'); ?></title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { display: none; }
        @layer base {
            html, body { margin: 0; padding: 0; }
            /* Samakan font dasar portal dengan situs publik. */
            body { font-family: var(--font-body-md); }
        }
        /*
         * Header portal bersifat fixed, jadi tautan anchor di menu (#kartanu, dst.)
         * harus diberi jarak agar judul bagian tidak tertutup header — terutama di
         * ponsel yang juga memiliki bilah menu cepat yang lengket.
         */
        html { scroll-padding-top: 7.5rem; }
        @media (min-width: 1024px) {
            html { scroll-padding-top: 5.5rem; }
        }
    </style>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->make('partials.kartu-anggota-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col">
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/85 backdrop-blur-xl border-b border-outline-variant/30">
        <div class="h-16 w-full px-3 sm:px-6 lg:px-8 flex items-center justify-between gap-2 sm:gap-6">
            <a class="flex items-center gap-2 sm:gap-3 min-w-0 shrink" href="<?php echo e(route('portal')); ?>">
                <span class="material-symbols-outlined text-primary-container text-2xl shrink-0">verified</span>
                <span class="flex items-center gap-2 min-w-0">
                    <span class="font-headline-sm text-headline-sm text-primary-container uppercase tracking-widest truncate">Portal Nahdliyin</span>
                    <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded-full bg-surface-container font-label-caps text-label-caps text-primary font-bold tracking-wider shrink-0">MWCNU Gumelar</span>
                </span>
            </a>
            <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">
                <span class="relative p-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors cursor-pointer" title="Notifikasi">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-error ring-2 ring-surface-container-lowest"></span>
                </span>
                <div class="hidden sm:block h-6 w-px bg-outline-variant/40"></div>
                <div class="flex items-center gap-2 sm:gap-3 pl-1 pr-1 sm:pr-3 py-1 rounded-full bg-surface-container-low border border-outline-variant/30">
                    <img alt="Foto Profil" class="w-8 h-8 rounded-full object-cover" src="<?php echo e(auth()->user()?->kartanuRecord?->photoUrl() ?? asset('images/logo-nu-40178.png')); ?>">
                    <span class="font-label-md text-label-md text-on-surface font-medium hidden sm:inline-block max-w-[9rem] truncate"><?php echo e(auth()->user()?->name); ?></span>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full pt-16 flex-1">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="w-full bg-surface-container-lowest border-t border-outline-variant/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 flex flex-col sm:flex-row items-center justify-center sm:justify-between gap-2 sm:gap-4 text-center sm:text-left">
            <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
                <span class="font-label-md text-label-md text-primary font-bold">KartaNU</span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">• Majelis Wakil Cabang Nahdlatul Ulama Gumelar</span>
            </div>
            <p class="font-label-sm text-label-sm text-on-surface-variant">© <?php echo e(date('Y')); ?> MWCNU Gumelar. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
    <?php echo $__env->make('partials.kartu-anggota-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/layouts/portal.blade.php ENDPATH**/ ?>