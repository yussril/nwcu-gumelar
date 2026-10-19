<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo e($title ?? 'Masuk Portal Nahdliyin - MWCNU Gumelar'); ?></title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>[x-cloak] { display: none !important; } ::-webkit-scrollbar { display: none; } body { font-family: var(--font-body-md); }</style>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="min-h-dvh bg-background font-body-md text-on-surface antialiased">
    <main class="flex min-h-dvh">
        <!-- Panel branding -->
        <div class="hidden lg:flex lg:w-[45%] xl:w-[40%] relative overflow-hidden bg-primary">
            <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-tertiary-container opacity-90"></div>
            <div class="relative z-10 flex flex-col justify-between p-10 xl:p-14 text-on-primary w-full">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center p-2">
                        <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain filter brightness-0 invert">
                    </div>
                    <div>
                        <h1 class="font-headline-md text-headline-md font-bold tracking-tight uppercase">Portal Nahdliyin</h1>
                        <p class="font-label-caps text-label-caps text-on-primary/70 tracking-widest mt-1">MWCNU Kecamatan Gumelar</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="font-headline-xl text-headline-xl xl:text-display-hero-mobile font-bold tracking-tight leading-tight">
                        Layanan Jama'ah &<br>e-KartaNU Digital
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-primary/80 max-w-md leading-relaxed">
                        Pantau status verifikasi, data kependudukan, dan kartu anggota digital Anda dalam satu portal terpadu MWCNU Kecamatan Gumelar.
                    </p>
                    <div class="flex items-center gap-6 pt-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">shield</span>
                            <span class="font-label-md text-label-md">Aman & Terenkripsi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">speed</span>
                            <span class="font-label-md text-label-md">Akses Cepat</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="h-px bg-white/20 w-full"></div>
                    <p class="font-label-sm text-label-sm text-on-primary/60 tracking-wide">MWCNU Kecamatan Gumelar — Kab. Banyumas</p>
                </div>
            </div>
        </div>

        <!-- Panel form -->
        <div class="flex-1 flex flex-col justify-center items-center px-4 py-10 sm:px-8 sm:py-12 lg:px-16 xl:px-24 bg-surface-container-lowest">
            <div class="lg:hidden flex items-center gap-3 mb-8 sm:mb-10">
                <div class="w-12 h-12 rounded-xl overflow-hidden flex items-center justify-center bg-primary">
                    <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain filter brightness-0 invert">
                </div>
                <div>
                    <h1 class="font-headline-sm text-headline-sm font-bold text-primary tracking-tight uppercase">Portal Nahdliyin</h1>
                    <p class="font-label-caps text-label-caps text-secondary tracking-widest mt-0.5">MWCNU Kec. Gumelar</p>
                </div>
            </div>

            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <h2 class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">Masuk ke Portal</h2>
                    <p class="font-body-md text-body-md text-secondary mt-2">Gunakan NIK dan kata sandi Anda</p>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-5 sm:p-8 shadow-sm">
                    <?php if(session('status')): ?>
                        <div class="mb-5 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status"><?php echo e(session('status')); ?></div>
                    <?php endif; ?>

                    <form class="w-full space-y-5" method="POST" action="<?php echo e(route('masuk')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="space-y-1.5">
                            <label class="block font-label-caps text-label-caps font-semibold text-secondary uppercase tracking-widest" for="nik">NIK</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">badge</span>
                                <input id="nik" class="w-full rounded-xl border border-outline-variant bg-surface-container-low pl-10 pr-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all" type="text" name="nik" value="<?php echo e(old('nik')); ?>" required autofocus autocomplete="username" inputmode="numeric" maxlength="16" placeholder="16 digit NIK sesuai KTP" />
                            </div>
                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('nik'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('nik')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-label-caps text-label-caps font-semibold text-secondary uppercase tracking-widest" for="password">Kata Sandi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">lock</span>
                                <input id="password" class="w-full rounded-xl border border-outline-variant bg-surface-container-low pl-10 pr-12 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all" type="password" name="password" required autocomplete="current-password" placeholder="••••••••••••" />
                                <button aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-outline hover:text-on-surface transition-colors" id="togglePassword" type="button">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </button>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input id="remember_me" class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" name="remember" type="checkbox">
                                <span class="font-body-sm text-body-sm text-on-surface-variant font-normal select-none">Ingat Saya</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-semibold py-3.5 px-6 rounded-xl transition-all flex items-center justify-center gap-2 font-label-md text-label-md shadow-sm hover:shadow-md" type="submit">
                                <span>Masuk ke Portal</span>
                                <span class="material-symbols-outlined text-[18px]">login</span>
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 rounded-xl bg-primary-fixed/20 border border-primary-fixed/40 px-4 py-3 flex gap-3">
                        <span class="material-symbols-outlined text-primary-container text-[18px] shrink-0">info</span>
                        <p class="text-sm text-on-surface-variant leading-relaxed">
                            Kata sandi default adalah <strong>tanggal lahir</strong> dengan format <strong>DDMMYYYY</strong> (contoh: 10061999). Ubah kata sandi Anda setelah berhasil masuk.
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-center space-y-2">
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Belum mendaftar KartaNU?
                        <a class="font-semibold text-primary hover:text-primary-container transition-colors" href="<?php echo e(route('pendaftaran.kartanu')); ?>">Daftar di sini</a>
                    </p>
                    <a href="<?php echo e(route('beranda')); ?>" class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span>Kembali ke situs publik</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePasswordBtn.innerHTML = isPassword
                        ? '<span class="material-symbols-outlined text-[20px]">visibility_off</span>'
                        : '<span class="material-symbols-outlined text-[20px]">visibility</span>';
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/member/login.blade.php ENDPATH**/ ?>