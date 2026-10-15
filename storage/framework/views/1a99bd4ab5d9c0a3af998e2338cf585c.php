<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo e($title ?? 'MWCNU Kecamatan Gumelar'); ?></title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        @layer base {
            html, body { margin:0; padding:0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top:0!important; }
            main > :last-child { margin-bottom:0!important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-primary selection:text-on-primary">
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/85 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.03)] transition-all">
        <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-6 w-full border-b border-slate-200/80">
            <a href="<?php echo e(route('beranda')); ?>" class="flex items-center gap-3.5 shrink-0">
                <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU" class="h-9 w-auto object-contain">
                <div class="flex flex-col leading-none">
                    <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold">MWCNU GUMELAR</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide mt-1">Kecamatan Gumelar, Banyumas</span>
                </div>
            </a>
            <nav class="hidden lg:flex items-center gap-8">
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('beranda') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('beranda')); ?>">Beranda</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('berita') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('berita')); ?>">Berita</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('banom') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('banom')); ?>">Banom</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('kegiatan') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('kegiatan')); ?>">Kegiatan</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('galeri') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('galeri')); ?>">Galeri</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('kartanu') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('kartanu')); ?>">KartaNU</a>
                <a class="font-label-md text-label-md font-semibold transition-colors pb-0.5 <?php echo e(request()->routeIs('kontak') ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900'); ?>" href="<?php echo e(route('kontak')); ?>">Kontak</a>
            </nav>
            <div class="flex items-center gap-4">
                <?php if(auth()->guard()->check()): ?>
                    <a class="inline-flex items-center justify-center px-5 py-2 rounded-xl bg-primary-container text-white font-label-md text-label-md font-semibold hover:bg-primary transition-all" href="<?php echo e(route('dashboard')); ?>">Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="w-full pt-20 bg-surface">
        <div class="flex flex-col w-full bg-surface-container-lowest overflow-hidden selection:bg-primary selection:text-on-primary">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
    <footer class="w-full bg-surface-container-lowest border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-8 pb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="flex flex-col">
                    <div class="flex items-center gap-3.5 mb-5">
                        <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU" class="h-8 w-auto object-contain">
                        <div class="flex flex-col leading-none">
                            <span class="font-headline-sm text-headline-sm text-primary font-bold">MWCNU GUMELAR</span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide mt-1">Kecamatan Gumelar, Banyumas</span>
                        </div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Merawat Jagat Membangun Peradaban: Berkhidmat untuk Ummat, Memperkokoh Tradisi Ahlussunnah wal Jama'ah An-Nahdliyyah.</p>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm text-on-surface font-bold mb-6">Navigasi & Layanan</span>
                    <ul class="flex flex-col gap-3 font-body-md text-body-md text-on-surface-variant">
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('beranda')); ?>">Beranda</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('berita')); ?>">Berita</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('banom')); ?>">Badan Otonom (Banom)</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('kegiatan')); ?>">Kegiatan</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('galeri')); ?>">Galeri Dokumentasi</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('kartanu')); ?>">Layanan KartaNU</a></li>
                        <li><a class="hover:text-primary transition-colors" href="<?php echo e(route('kontak')); ?>">Kontak</a></li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm text-on-surface font-bold mb-6">Sekretariat & Gedung Bersama</span>
                    <address class="not-italic font-body-sm text-body-sm text-on-surface-variant flex flex-col gap-2.5">
                        <p class="leading-relaxed">Gedung Bersama MWCNU Gumelar<br>Jl. Raya Gumelar No. 09, Kec. Gumelar, Banyumas 53165</p>
                        <p class="leading-relaxed">Surel: <a href="mailto:sekretariat@mwcnu-gumelar.or.id" class="text-primary hover:underline">sekretariat@mwcnu-gumelar.or.id</a></p>
                        <p class="leading-relaxed font-semibold text-on-surface mt-1">Pusat Pelayanan: +62 821-3456-7890</p>
                    </address>
                    <a class="mt-4 inline-flex items-center gap-1.5 font-label-md text-label-md font-medium text-primary hover:underline" href="<?php echo e(route('kontak')); ?>">
                        <span>Halaman Kontak</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant border-t border-slate-200">
                <p>© 2025 MWCNU Kecamatan Gumelar. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/layouts/site.blade.php ENDPATH**/ ?>