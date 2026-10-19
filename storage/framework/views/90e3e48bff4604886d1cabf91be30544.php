<?php $__env->startSection('content'); ?>
    <!-- Top Ambient Glow -->
    <div class="relative w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        <div class="absolute top-0 right-1/4 -z-10 w-96 h-96 bg-primary-fixed/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- SECTION A: High-Impact Hero Section -->
        <section class="w-full pt-10 sm:pt-12 lg:pt-20 pb-16 sm:pb-20 lg:pb-28 opacity-0 animate-fade-up" style="animation-delay: 0.2s; animation-fill-mode: forwards;">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-12 lg:gap-8 items-center">
                <!-- Left Hero (55% -> 7 Cols) -->
                <div class="lg:col-span-7 relative flex flex-col items-start">
                    <div class="pointer-events-none absolute -top-12 -left-8 w-96 h-96 select-none opacity-[0.04] text-[#047857] z-0 overflow-hidden">
                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100"><polygon points="50,2 62,35 97,35 69,56 80,89 50,68 20,89 31,56 3,35 38,35"></polygon><circle cx="50" cy="50" fill="none" r="42" stroke="currentColor" stroke-dasharray="3,3" stroke-width="1.5"></circle></svg>
                    </div>
                    <div class="relative z-10 flex flex-col items-start w-full">
                        <h1 class="font-display-hero text-display-hero-mobile lg:text-display-hero text-on-background tracking-tight font-extrabold max-w-2xl leading-[1.08] lg:leading-[1.05]">
                            Meneguhkan <span class="text-[#047857] font-black">Aswaja</span> An-Nahdliyah.
                        </h1>
                        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed mt-5 sm:mt-6 mb-7 sm:mb-10">
                            Pusat koordinasi dakwah kultural, kemandirian ekonomi umat, dan pembinaan kader di 10 Ranting se-Kecamatan Gumelar, Kabupaten Banyumas.
                        </p>
                        <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:flex-wrap sm:items-center sm:gap-4">
                            <a class="group inline-flex items-center justify-center gap-3 px-6 sm:px-8 py-4 rounded-2xl bg-primary-container text-on-primary font-headline-sm text-headline-sm font-bold shadow-md hover:bg-primary transition-all duration-200 hover:-translate-y-0.5 active:scale-[0.99]" href="<?php echo e(route('pendaftaran.kartanu')); ?>">
                                <span>Registrasi Kader Mandiri</span>
                                <span class="material-symbols-outlined text-[20px] transition-transform duration-200 group-hover:translate-x-1">arrow_forward</span>
                            </a>
                            <a class="inline-flex items-center justify-center px-6 sm:px-7 py-4 rounded-2xl bg-surface-container-low text-on-surface font-headline-sm text-headline-sm font-semibold hover:bg-surface-container transition-all duration-200 active:scale-[0.99]" href="#ekosistem-banom">
                                Jelajahi Ekosistem
                            </a>
                        </div>

                        <?php if(auth()->guard()->guest()): ?>
                            <div class="mt-4 sm:mt-5 flex flex-wrap items-center gap-x-3 gap-y-2">
                                <a class="group inline-flex items-center justify-center gap-2 rounded-2xl border border-primary-container/30 bg-surface-container-lowest px-5 sm:px-6 py-3 font-label-md text-label-md font-semibold text-primary-container hover:bg-primary-fixed/30 hover:border-primary-container/50 transition-all duration-200 active:scale-[0.99]" href="<?php echo e(route('masuk')); ?>">
                                    <span class="material-symbols-outlined text-[20px]">login</span>
                                    <span>Masuk / Login</span>
                                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:translate-x-0.5">arrow_forward</span>
                                </a>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Sudah mendaftar KartaNU? Masuk ke portal Anda.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right Hero Visual Capsule (45% -> 5 Cols) -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-lg lg:max-w-none">
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden bg-gradient-to-br from-primary-container via-primary to-[#046c4e] shadow-2xl">
                            <picture class="absolute inset-0 block">
                                <source srcset="<?php echo e(asset('images/hero-nu-dokumentasi.webp')); ?>" type="image/webp">
                                <img src="<?php echo e(asset('images/hero-nu-dokumentasi.jpg')); ?>" alt="Dokumentasi Pergerakan Nahdlatul Ulama" class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700 ease-out" width="1280" height="771" fetchpriority="high" decoding="async">
                            </picture>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
                            <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 z-10 inline-flex max-w-[calc(100%-1.5rem)] items-center gap-2 px-3 sm:px-3.5 py-1.5 rounded-full bg-primary-container/90 backdrop-blur-md text-white border border-white/20 shadow-lg">
                                <span class="material-symbols-outlined text-[16px] text-primary-fixed shrink-0">verified</span>
                                <span class="font-label-sm text-label-sm font-semibold tracking-wide text-white truncate">Syuriyah &amp; Tanfidziyah <span class="text-primary-fixed font-normal opacity-80">• 2023–2028</span></span>
                            </div>
                        </div>
                        <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-2xl bg-[#047857]/10 -z-10 blur-xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION B: Typography Stats -->
        <section class="w-full py-12 sm:py-16 lg:py-24 border-t border-slate-100 opacity-0 animate-fade-up" style="animation-delay: 200ms;">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 sm:gap-10 lg:gap-14">
                <div class="flex flex-col">
                    <span class="font-display-hero text-[2.125rem] sm:text-[3rem] lg:text-[4.25rem] font-black text-on-background tracking-tighter leading-none counter-value" data-target="10">0</span>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold mt-2 sm:mt-3">Ranting Desa</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-display-hero text-[2.125rem] sm:text-[3rem] lg:text-[4.25rem] font-black text-on-background tracking-tighter leading-none counter-value" data-target="1842">0</span>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold mt-2 sm:mt-3">Kader Terdata</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-display-hero text-[2.125rem] sm:text-[3rem] lg:text-[4.25rem] font-black text-on-background tracking-tighter leading-none counter-value" data-target="128">0</span>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold mt-2 sm:mt-3">Risalah Fatwa</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-display-hero text-[2.125rem] sm:text-[3rem] lg:text-[4.25rem] font-black text-on-background tracking-tighter leading-none">
                        <span class="counter-value" data-target="24.8" data-float="true">0</span><span class="text-headline-md align-top font-bold ml-1 text-primary-container">Jt</span>
                    </span>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold mt-2 sm:mt-3">Koin NU (Des)</span>
                </div>
            </div>
        </section>

        <!-- SECTION C: Ekosistem Banom (Bento Grid) -->
            <section class="w-full py-16 sm:py-20 lg:py-28 border-t border-slate-100" id="ekosistem-banom">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 sm:mb-12 gap-5 sm:gap-6">
                    <div>
                        <div class="w-12 h-1 bg-[#047857] rounded-full mb-3"></div>
                        <span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Struktur Jam'iyyah</span>
                        <h2 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-on-surface font-black tracking-tight mt-2">Keluarga Besar MWCNU</h2>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                        Sinergi badan otonom dan lembaga dakwah khidmah keumatan se-Kecamatan Gumelar untuk kemandirian warga.
                    </p>
                </div>

                <?php if($banoms->isNotEmpty()): ?>
                    <?php
                        // Tema banner per kategori banom: monogram, watermark, dan palet
                        // warna kartu. Banom tanpa tema khusus memakai tema yang ada
                        // secara bergilir sesuai urutan tampilnya.
                        $bannerThemes = [
                            'gp-ansor-banser' => [
                                'monogram' => 'GP',
                                'watermark' => 'BANSER',
                                'surface' => 'bg-[#ecfdf5]',
                                'border' => 'border-[#a7f3d0]/60 hover:border-[#34d399]',
                                'watermark_text' => 'text-[#065f46]/[0.07]',
                                'monogram_bg' => 'bg-[#047857]',
                                'chip' => 'bg-[#d1fae5] text-[#065f46]',
                                'heading' => 'text-[#064e3b] group-hover:text-[#047857]',
                                'body' => 'text-[#065f46]/80',
                                'divider' => 'border-[#a7f3d0]/50',
                                'footer' => 'text-[#065f46]',
                                'arrow' => 'bg-[#047857] text-white group-hover:bg-[#065f46]',
                            ],
                            'fatayat-nu' => [
                                'monogram' => 'FM',
                                'watermark' => 'FATAYAT',
                                'surface' => 'bg-[#f0fdf4]',
                                'border' => 'border-[#bbf7d0]/60 hover:border-[#4ade80]',
                                'watermark_text' => 'text-[#166534]/[0.08]',
                                'monogram_bg' => 'bg-[#15803d]',
                                'chip' => 'bg-[#dcfce7] text-[#166534]',
                                'heading' => 'text-[#14532d] group-hover:text-[#15803d]',
                                'body' => 'text-[#166534]/80',
                                'divider' => 'border-[#bbf7d0]/50',
                                'footer' => 'text-[#15803d]',
                                'arrow' => 'bg-white text-[#15803d] group-hover:bg-[#15803d] group-hover:text-white',
                            ],
                            'ipnu-ippnu' => [
                                'monogram' => 'IP',
                                'watermark' => 'PELAJAR',
                                'surface' => 'bg-[#ecfdf5]',
                                'border' => 'border-[#a7f3d0]/60 hover:border-[#34d399]',
                                'watermark_text' => 'text-[#065f46]/[0.08]',
                                'monogram_bg' => 'bg-[#059669]',
                                'chip' => 'bg-[#d1fae5] text-[#065f46]',
                                'heading' => 'text-[#064e3b] group-hover:text-[#059669]',
                                'body' => 'text-[#065f46]/80',
                                'divider' => 'border-[#a7f3d0]/50',
                                'footer' => 'text-[#059669]',
                                'arrow' => 'bg-white text-[#059669] group-hover:bg-[#059669] group-hover:text-white',
                            ],
                            'upzis-lazisnu' => [
                                'monogram' => 'LZ',
                                'watermark' => 'KOIN NU',
                                'surface' => 'bg-[#f0fdfa]',
                                'border' => 'border-[#99f6e4]/60 hover:border-[#2dd4bf]',
                                'watermark_text' => 'text-[#115e59]/[0.08]',
                                'monogram_bg' => 'bg-[#0d9488]',
                                'chip' => 'bg-[#ccfbf1] text-[#115e59]',
                                'heading' => 'text-[#134e4a] group-hover:text-[#0d9488]',
                                'body' => 'text-[#115e59]/80',
                                'divider' => 'border-[#99f6e4]/50',
                                'footer' => 'text-[#0d9488]',
                                'arrow' => 'bg-white text-[#0d9488] group-hover:bg-[#0d9488] group-hover:text-white',
                            ],
                            'lbmnu-ldnu' => [
                                'monogram' => 'BM',
                                'watermark' => 'FATWA',
                                'surface' => 'bg-[#f8fafc]',
                                'border' => 'border-slate-200/80 hover:border-[#047857]/40',
                                'watermark_text' => 'text-slate-800/[0.06]',
                                'monogram_bg' => 'bg-[#334155]',
                                'chip' => 'bg-slate-100 text-slate-700',
                                'heading' => 'text-slate-900 group-hover:text-[#047857]',
                                'body' => 'text-slate-600',
                                'divider' => 'border-slate-200/60',
                                'footer' => 'text-slate-700',
                                'arrow' => 'bg-white text-slate-700 group-hover:bg-[#047857] group-hover:text-white',
                            ],
                        ];

                        $bannerThemeKeys = array_keys($bannerThemes);

                        $bannerMonogram = function (string $name): string {
                            $initials = collect(preg_split('/\s+/', trim($name)) ?: [])
                                ->filter(fn ($word) => ctype_alpha($word[0] ?? ''))
                                ->take(2)
                                ->map(fn ($word) => \Illuminate\Support\Str::upper($word[0]))
                                ->implode('');

                            return $initials !== '' ? $initials : \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($name, 0, 2));
                        };
                    ?>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 sm:gap-6">
                        <?php $__currentLoopData = $banoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $customTheme = $bannerThemes[$banom->slug] ?? null;
                                $theme = $customTheme ?? $bannerThemes[$bannerThemeKeys[$index % count($bannerThemeKeys)]];
                                $monogram = $customTheme['monogram'] ?? $bannerMonogram($banom->name);
                                $featured = $index === 0;
                            ?>

                            <a href="<?php echo e(route('banom')); ?>#<?php echo e($banom->slug); ?>" class="<?php echo e($featured ? 'md:col-span-7' : ($index === 1 ? 'md:col-span-5' : 'md:col-span-4')); ?> <?php echo e($featured ? 'p-6 sm:p-8 md:p-10' : 'p-6 sm:p-8'); ?> relative group flex flex-col justify-between rounded-3xl <?php echo e($theme['surface']); ?> border <?php echo e($theme['border']); ?> transition-all duration-300 shadow-sm hover:shadow-lg overflow-hidden cursor-pointer">
                                <div class="pointer-events-none absolute -right-2 -bottom-2 font-black tracking-tighter <?php echo e($theme['watermark_text']); ?> select-none leading-none z-0 <?php echo e($featured ? 'text-[4rem] sm:text-[5rem] lg:text-[7.5rem]' : 'text-[4rem] sm:text-[5rem]'); ?>"><?php echo e($theme['watermark']); ?></div>
                                <div class="relative z-10">
                                    <div class="flex items-center justify-between <?php echo e($featured ? 'mb-8' : 'mb-6'); ?>">
                                        <div class="<?php echo e($featured ? 'w-14 h-14 font-black shadow-md' : 'w-12 h-12 font-bold shadow-sm'); ?> rounded-2xl <?php echo e($theme['monogram_bg']); ?> text-white flex items-center justify-center font-headline-sm group-hover:scale-105 transition-transform"><?php echo e($monogram); ?></div>
                                        <span class="inline-flex items-center gap-2 px-3 sm:px-3.5 py-1.5 rounded-full text-left <?php echo e($theme['chip']); ?> font-label-caps text-label-caps font-bold tracking-wider">
                                            <?php if($featured): ?>
                                                <span class="w-2 h-2 shrink-0 rounded-full bg-current animate-pulse"></span>
                                            <?php endif; ?>
                                            <?php echo e($banom->member_count ?: $banom->coverage); ?>

                                        </span>
                                    </div>
                                    <h3 class="<?php echo e($featured ? 'text-headline-md font-extrabold mb-3' : 'text-headline-sm font-bold mb-2'); ?> <?php echo e($theme['heading']); ?> tracking-tight transition-colors"><?php echo e($banom->name); ?></h3>
                                    <p class="<?php echo e($featured ? 'font-body-md text-body-md max-w-xl' : 'font-body-sm text-body-sm'); ?> <?php echo e($theme['body']); ?> leading-relaxed"><?php echo e($banom->motto ?: $banom->coverage); ?></p>
                                </div>
                                <div class="relative z-10 mt-6 flex items-center justify-between gap-3 <?php echo e($featured ? 'pt-8' : 'pt-6'); ?> border-t <?php echo e($theme['divider']); ?>">
                                    <span class="<?php echo e($featured ? 'text-body-sm font-semibold' : 'font-label-caps uppercase tracking-wider font-bold'); ?> <?php echo e($theme['footer']); ?>"><?php echo e($banom->category); ?></span>
                                    <div class="<?php echo e($featured ? 'w-10 h-10' : 'w-9 h-9'); ?> rounded-full flex items-center justify-center transition-all shadow-sm <?php echo e($theme['arrow']); ?>">
                                        <span class="material-symbols-outlined <?php echo e($featured ? 'text-[20px]' : 'text-[18px]'); ?>"><?php echo e($featured ? 'arrow_forward' : 'arrow_outward'); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="rounded-3xl bg-surface-container-low px-6 py-16 text-center text-slate-500">
                        Data badan otonom belum tersedia.
                    </div>
                <?php endif; ?>
            </section>

        <!-- SECTION D: Warta Terkini (Editorial Magazine Layout) -->
        <section class="w-full py-16 sm:py-20 lg:py-28 border-t border-slate-100">
            <div class="mb-10 sm:mb-12 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <div class="w-12 h-1 bg-[#047857] rounded-full mb-3"></div>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Kanal Informasi</span>
                    <h2 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-on-surface font-black tracking-tight mt-1">Warta Nahdliyin Terkini</h2>
                </div>
                <a class="inline-flex shrink-0 items-center gap-2 rounded-lg px-2 py-2 font-headline-sm text-headline-sm text-primary hover:text-primary-container hover:bg-primary-fixed/30 font-bold transition-all self-start sm:self-auto" href="<?php echo e(route('berita')); ?>">
                    <span>Lihat Semua Arsip</span>
                    <span class="material-symbols-outlined text-[20px]">arrow_right_alt</span>
                </a>
            </div>

            <?php if($articles->isNotEmpty()): ?>
            <!-- Asymmetric Editorial Grid (60% : 40%) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-stretch">

                <?php
                    $featured = $articles->first();
                    $regularArticles = $articles->slice(1)->values();
                ?>

                <!-- Left Featured News (60% -> 7 Cols) -->
                <a href="<?php echo e(route('berita.show', $featured)); ?>" class="lg:col-span-7 group relative rounded-xl sm:rounded-2xl overflow-hidden bg-on-background min-h-[360px] sm:min-h-[460px] flex flex-col justify-end p-6 sm:p-8 md:p-12 cursor-pointer shadow-lg">
                    <?php if($featured->imageSource()): ?>
                        <img alt="<?php echo e($featured->title); ?>" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out opacity-60" src="<?php echo e($featured->imageSource()); ?>">
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                    <div class="relative z-10 flex flex-col items-start">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary-container text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold mb-4">
                            Sorotan Utama
                        </div>
                        <h3 class="font-headline-lg text-headline-lg font-black text-white tracking-tight leading-snug mb-3 group-hover:text-primary-fixed transition-colors">
                            <?php echo e($featured->title); ?>

                        </h3>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-white/80 font-body-sm text-body-sm">
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">calendar_today</span> <?php echo e($featured->published_at?->translatedFormat('d F Y') ?? 'Tanpa Tanggal'); ?></span>
                            <?php if($featured->author): ?>
                                <span class="hidden sm:inline">•</span>
                                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">person</span> <?php echo e($featured->author); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>

                <!-- Right Stacked News Cards (40% -> 5 Cols) -->
                <div class="lg:col-span-5 flex flex-col gap-5 sm:gap-6">

                    <?php $__currentLoopData = $regularArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Card Berita -->
                        <a href="<?php echo e(route('berita.show', $article)); ?>" class="group flex gap-4 sm:gap-5 p-4 sm:p-5 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 cursor-pointer">
                            <div class="w-28 h-24 sm:w-36 sm:h-28 shrink-0 rounded-lg overflow-hidden bg-surface-container">
                                <?php if($article->imageSource()): ?>
                                    <img alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?php echo e($article->imageSource()); ?>">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined text-3xl">image</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col justify-between py-1 min-w-0">
                                <div>
                                    <span class="font-label-caps text-label-caps uppercase tracking-wider text-primary font-bold">Berita</span>
                                    <h4 class="font-headline-sm text-headline-sm font-bold text-on-surface line-clamp-2 mt-1 group-hover:text-primary transition-colors">
                                        <?php echo e($article->title); ?>

                                    </h4>
                                </div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant"><?php echo e($article->published_at?->translatedFormat('d F Y') ?? 'Tanpa Tanggal'); ?><?php echo e($article->author ? ' • ' . $article->author : ''); ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
            <?php else: ?>
            <div class="rounded-2xl bg-surface-container-low px-6 py-16 text-center text-slate-500">
                Belum ada warta yang diterbitkan.
            </div>
            <?php endif; ?>
        </section>
        <!-- SECTION E: Bottom CTA -->
        <section class="w-full pt-10 pb-20 sm:pb-28">
            <div class="relative w-full rounded-[1.75rem] sm:rounded-[2.5rem] bg-primary-container p-6 sm:p-10 md:p-16 overflow-hidden shadow-xl text-on-primary">
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-7 sm:gap-8 items-center justify-between">
                    <div class="lg:col-span-8 flex flex-col items-start">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-on-primary/10 backdrop-blur text-primary-fixed font-label-caps text-label-caps uppercase tracking-widest font-semibold mb-5 sm:mb-6">Sensus Jam'iyyah Mandiri</div>
                        <h2 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-white font-extrabold tracking-tight leading-tight max-w-2xl">Pastikan Anda Terdaftar Resmi dalam Sensus KartaNU MWCNU Gumelar</h2>
                        <p class="font-body-lg text-body-lg text-primary-fixed-dim max-w-xl leading-relaxed mt-4">Integrasi basis data warga untuk pelayanan administrasi surat keterangan dan program sosial.</p>
                    </div>
                    <div class="lg:col-span-4 flex flex-col items-stretch lg:items-end justify-center gap-4">
                        <a class="group inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-surface-container-lowest text-primary-container font-headline-sm text-headline-sm font-bold shadow-lg hover:bg-surface-container-low transition-all duration-200" href="<?php echo e(route('pendaftaran.kartanu')); ?>">
                            <span>Registrasi KartaNU</span>
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Script Animasi Counter -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter-value');
            
            // Konfigurasi observer: trigger saat elemen terlihat 50% di layar
            const observerOptions = { threshold: 0.5 };
            
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseFloat(counter.getAttribute('data-target'));
                        const isFloat = counter.getAttribute('data-float') === 'true';
                        
                        // Kecepatan animasi (semakin besar semakin lama)
                        const duration = 2000; 
                        let startTimestamp = null;
                        
                        const step = (timestamp) => {
                            if (!startTimestamp) startTimestamp = timestamp;
                            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                            
                            // Fungsi easing (easeOutExpo) agar angka melambat di akhir
                            const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                            const currentCount = easeProgress * target;
                            
                            if (isFloat) {
                                // Format angka desimal koma (misal: 24,8)
                                counter.innerText = currentCount.toFixed(1).replace('.', ',');
                            } else {
                                // Format angka ribuan titik (misal: 1.842)
                                counter.innerText = Math.floor(currentCount).toLocaleString('id-ID');
                            }
                            
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            } else {
                                // Pastikan angka final presisi sesuai target
                                counter.innerText = isFloat 
                                    ? target.toFixed(1).replace('.', ',') 
                                    : target.toLocaleString('id-ID');
                            }
                        };
                        
                        window.requestAnimationFrame(step);
                        // Hentikan pantauan agar animasi tidak berulang saat di-scroll naik-turun
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/beranda.blade.php ENDPATH**/ ?>