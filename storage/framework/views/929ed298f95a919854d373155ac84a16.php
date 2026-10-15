<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Cetak KartaNU - MWCNU Gumelar'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#003527',
                        'primary-container': '#064e3b',
                        'on-primary': '#ffffff',
                        'primary-fixed': '#b0f0d6',
                        'on-primary-fixed': '#002117',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f2f4f6',
                        'surface-container': '#eceef0',
                        'on-surface': '#191c1e',
                        'on-surface-variant': '#404944',
                        'outline-variant': '#bfc9c3',
                        'secondary': '#565e74',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl overflow-hidden flex items-center justify-center bg-primary">
                    <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain filter brightness-0 invert">
                </div>
                <div class="text-left">
                    <h1 class="font-headline-sm text-headline-sm font-bold text-primary tracking-tight">MWCNU ADMIN</h1>
                    <p class="font-label-caps text-label-caps text-secondary tracking-widest mt-0.5">KEC. GUMELAR</p>
                </div>
            </div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">Cetak KartaNU</h2>
            <p class="font-body-md text-body-md text-secondary mt-2">Masukkan kode registrasi untuk mencetak kartu Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-sm">
            <?php if(session('success')): ?>
                <div class="mb-4 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(isset($error)): ?>
                <div class="mb-4 rounded-xl border border-error/30 bg-error-container/50 px-4 py-3 text-sm text-on-error-container" role="alert">
                    <?php echo e($error); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('cetak-kartanu.show')); ?>" method="GET" class="space-y-4">
                <div>
                    <label class="block font-label-caps text-label-caps font-semibold text-secondary uppercase tracking-widest mb-2" for="registration_code">
                        Kode Registrasi
                    </label>
                    <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-mono text-body-md text-on-surface placeholder:text-outline focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all" id="registration_code" name="registration_code" placeholder="REG-GML-2025-XXXXXXXX" required type="text">
                    <p class="mt-1.5 text-xs text-on-surface-variant">Kode registrasi diberikan saat Anda mendaftar</p>
                </div>

                <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-semibold py-3.5 px-6 rounded-xl transition-all flex items-center justify-center gap-2 font-label-md text-label-md shadow-sm" type="submit">
                    <span>Cari & Cetak Kartu</span>
                    <span class="material-symbols-outlined text-[18px]">search</span>
                </button>
            </form>
        </div>

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="<?php echo e(route('beranda')); ?>" class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke situs publik</span>
            </a>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/public/cetak-kartanu-form.blade.php ENDPATH**/ ?>