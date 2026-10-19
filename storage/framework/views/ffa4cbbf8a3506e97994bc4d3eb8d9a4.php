<?php $__env->startSection('content'); ?>
<div class="w-full bg-surface px-4 py-8 sm:px-6 md:py-10 lg:px-8">
    <div class="w-full max-w-6xl mx-auto">

        <?php if(! $record): ?>
            <div class="rounded-2xl border border-secondary-container bg-surface-container-lowest p-10 text-center">
                <span class="material-symbols-outlined text-5xl text-primary">info</span>
                <h1 class="mt-4 font-headline-lg text-headline-lg font-bold text-on-surface">Data KartaNU belum terhubung</h1>
                <p class="mt-2 font-body-md text-body-md text-on-surface-variant">
                    Akun Anda belum terhubung dengan catatan KartaNU. Silakan hubungi sekretariat MWCNU Gumelar.
                </p>
            </div>
        <?php else: ?>
            <?php
                $status = $record->verification_status;
                $statusIsIssued = $status === 'issued';
                $statusIsRejected = $status === 'rejected';
                $statusPillClass = $statusIsIssued
                    ? 'bg-primary-fixed/50 text-primary-container'
                    : 'bg-error-container/60 text-error';
                $progress = $record->verificationProgress() * 20;
            ?>

            <!-- Greeting & Status Banner -->
            <section class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4" id="dashboard">
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-surface-container font-label-caps text-label-caps text-primary uppercase font-bold tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed-dim"></span>
                            Periode Khidmat 2024–2029
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-surface-container-low font-label-caps text-label-caps text-secondary font-semibold">
                            <?php echo e($record->branch_name); ?>

                        </span>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                        Assalamu'alaikum, <span class="text-primary-container"><?php echo e($record->name); ?></span>
                    </h1>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                        Portal Layanan Jama'ah &amp; Pemantauan Status Penerbitan e-KartaNU MWCNU Kecamatan Gumelar.
                    </p>
                </div>
                <div class="flex items-center gap-2 self-start md:self-auto">
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Sinkronisasi Terakhir:</span>
                    <span class="font-label-sm text-label-sm font-semibold text-on-surface bg-surface-container-high px-2.5 py-1 rounded-md"><?php echo e(now()->translatedFormat('d M Y, H:i')); ?> WIB</span>
                </div>
            </section>

            <!-- Main 12-Column Content Layout -->
            <div class="grid grid-cols-12 gap-6 lg:gap-8 items-start">

                <!-- Menu cepat khusus ponsel: bilah lengket di bawah header -->
                <nav aria-label="Menu Dasbor (ponsel)" class="col-span-12 lg:hidden sticky top-16 z-40 -mx-4 sm:-mx-6 px-4 sm:px-6 py-2.5 bg-surface/95 backdrop-blur border-b border-outline-variant/20">
                    <div class="flex items-center gap-2 overflow-x-auto" style="scrollbar-width: none;">
                        <?php $__currentLoopData = [
                            ['#dashboard', 'dashboard', 'Dashboard'],
                            ['#kartanu', 'badge', 'KartaNU'],
                            ['#data-pribadi', 'person', 'Data Pribadi'],
                            ['#koin', 'account_balance_wallet', 'Koin NU'],
                            ['#pengaturan', 'settings', 'Pengaturan'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$target, $icon, $label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="inline-flex shrink-0 items-center gap-1.5 rounded-full border border-outline-variant/50 bg-surface-container-low px-3.5 py-2 font-label-md text-label-md font-semibold text-on-surface-variant transition-colors hover:bg-primary-fixed/30 hover:text-primary-container" href="<?php echo e($target); ?>">
                                <span class="material-symbols-outlined text-[18px]"><?php echo e($icon); ?></span>
                                <span><?php echo e($label); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </nav>

                <!-- LEFT COLUMN -->
                <aside class="col-span-12 lg:col-span-4 order-2 lg:order-1 flex flex-col gap-6">
                    <!-- Member Profile Overview Card -->
                    <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm flex flex-col items-center text-center relative overflow-hidden">
                        <div class="relative mb-4">
                            <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-sm bg-surface-container-low">
                                <?php if($record->photoUrl()): ?>
                                    <img alt="Foto Profil Jama'ah <?php echo e($record->name); ?>" class="w-full h-full object-cover" src="<?php echo e($record->photoUrl()); ?>">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center font-headline-lg text-headline-lg font-bold text-primary-container"><?php echo e(Str::of($record->name)->substr(0, 2)->upper()); ?></div>
                                <?php endif; ?>
                            </div>
                            <span class="absolute -bottom-1 -right-1 bg-surface-container-lowest rounded-full p-1 shadow-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg block" style="font-variation-settings: 'FILL' 1;">verified</span>
                            </span>
                        </div>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface"><?php echo e($record->name); ?></h2>
                        <p class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Warga Nahdliyin Gumelar</p>

                        <div class="mt-4 px-3.5 py-1.5 rounded-full <?php echo e($statusPillClass); ?> flex items-center justify-center gap-2">
                            <span class="w-2 h-2 rounded-full <?php echo e($statusIsIssued ? 'bg-primary-container' : 'bg-error animate-pulse'); ?>"></span>
                            <span class="font-label-caps text-label-caps uppercase tracking-wider font-bold"><?php echo e($record->verificationLabel()); ?></span>
                        </div>

                        <div class="w-full h-px bg-surface-container-high my-5"></div>

                        <div class="w-full flex items-center justify-between text-left px-1">
                            <span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">ID Registrasi</span>
                            <span class="font-mono text-label-sm font-semibold text-primary-container bg-surface-container px-2 py-0.5 rounded">#<?php echo e(Str::of($record->registration_code)->afterLast('-')); ?></span>
                        </div>
                    </div>

                    <!-- Navigation Menu Card (desktop) -->
                    <nav aria-label="Menu Dasbor" class="hidden lg:flex bg-surface-container-lowest p-2 rounded-2xl shadow-sm flex-col gap-1">
                        <a class="bg-primary-fixed/30 text-primary-container font-semibold px-4 py-3 rounded-xl flex items-center justify-between transition-all" href="#dashboard">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                                <span class="font-label-md text-label-md">Dashboard</span>
                            </div>
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                        </a>
                        <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" href="#kartanu">
                            <span class="material-symbols-outlined text-xl">badge</span>
                            <span class="font-label-md text-label-md">KartaNU Digital</span>
                        </a>
                        <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" href="#data-pribadi">
                            <span class="material-symbols-outlined text-xl">person</span>
                            <span class="font-label-md text-label-md">Data Pribadi</span>
                        </a>
                        <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" href="#koin">
                            <span class="material-symbols-outlined text-xl">account_balance_wallet</span>
                            <span class="font-label-md text-label-md">Koin NU &amp; Infaq</span>
                        </a>
                        <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" href="#pengaturan">
                            <span class="material-symbols-outlined text-xl">settings</span>
                            <span class="font-label-md text-label-md">Pengaturan</span>
                        </a>
                    </nav>

                    <!-- Helpdesk Support Block -->
                    <div class="bg-primary-fixed/20 p-5 rounded-2xl shadow-sm flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-lg">support_agent</span>
                            <span class="font-label-caps text-label-caps text-primary-container uppercase font-bold tracking-wider">Pusat Bantuan MWCNU</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                            Ada kendala data berkas? Hubungi Sekretariat MWCNU Gumelar via WhatsApp Layanan Sensus.
                        </p>
                        <a class="font-label-sm text-label-sm font-semibold text-primary-container hover:text-on-primary-fixed-variant inline-flex items-center gap-1.5 mt-1 underline underline-offset-4" href="https://wa.me/6282134567890" rel="noopener noreferrer" target="_blank">
                            Chat Layanan Sensus
                            <span class="material-symbols-outlined text-sm">arrow_outward</span>
                        </a>
                    </div>

                    <form method="POST" action="<?php echo e(route('keluar')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full text-on-surface-variant hover:text-error hover:bg-error-container/40 px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" type="submit">
                            <span class="material-symbols-outlined text-xl">logout</span>
                            <span class="font-label-md text-label-md">Keluar dari Portal</span>
                        </button>
                    </form>

                    <a class="w-full text-on-surface-variant hover:text-primary hover:bg-primary-fixed/30 px-4 py-3 rounded-xl flex items-center gap-3 transition-colors" href="<?php echo e(route('beranda')); ?>" target="_blank" rel="noopener noreferrer">
                        <span class="material-symbols-outlined text-xl">public</span>
                        <span class="font-label-md text-label-md">Lihat Website</span>
                        <span class="material-symbols-outlined text-sm ml-auto">arrow_outward</span>
                    </a>
                </aside>

                <!-- RIGHT COLUMN -->
                <main class="col-span-12 lg:col-span-8 order-1 lg:order-2 flex flex-col gap-6">

                    <!-- Card 1: Data Pribadi -->
                    <section
                        class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm"
                        id="data-pribadi"
                        x-data="{ edit: <?php echo e($errors->hasAny(['tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_whatsapp', 'alamat_lengkap', 'desa_ranting']) ? 'true' : 'false'); ?> }"
                        x-effect="document.body.style.overflow = edit ? 'hidden' : ''"
                        x-on:keydown.escape.window="edit = false"
                    >
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">account_circle</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Data Pribadi</h3>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-md bg-primary-fixed/40 text-primary-container font-label-caps text-label-caps font-bold">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    Sensus KartaNU
                                </span>
                                <button class="inline-flex items-center gap-1.5 rounded-lg border border-outline-variant px-3 py-1.5 font-label-md text-label-md font-semibold text-on-surface transition-colors hover:bg-surface-container-low active:scale-[0.98]" type="button" @click="edit = true">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                    Edit Data
                                </button>
                            </div>
                        </div>

                        <?php if(session('status_profile')): ?>
                            <div class="mb-5 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status"><?php echo e(session('status_profile')); ?></div>
                        <?php endif; ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8">
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Nama Lengkap</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface mt-1"><?php echo e($record->name); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">NIK (Nomor Induk Kependudukan)</span>
                                <span class="font-mono text-body-md font-medium text-on-surface mt-1 break-all"><?php echo e($record->nik); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Tempat Lahir</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->birth_place ?: '—'); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Tanggal Lahir</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->tanggalIndonesia($record->birth_date, 'd F Y')); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Jenis Kelamin</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->jenisKelaminLabel()); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">No. WhatsApp</span>
                                <span class="font-mono text-body-md font-medium text-on-surface mt-1 break-all"><?php echo e($record->no_whatsapp ?: '—'); ?></span>
                            </div>
                            <div class="sm:col-span-2 flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Alamat Sesuai KTP</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->alamat_lengkap ?: '—'); ?></span>
                            </div>
                        </div>

                        <!-- Modal Edit Data Pribadi -->
                        <div
                            class="fixed inset-0 z-[90]"
                            x-cloak
                            x-show="edit"
                            x-transition.opacity
                            role="dialog"
                            aria-modal="true"
                            aria-label="Edit data pribadi"
                        >
                            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="edit = false"></div>
                            <div class="absolute inset-0 flex items-start justify-center overflow-y-auto p-4 sm:items-center sm:p-6">
                                <div
                                    class="relative w-full max-w-2xl rounded-2xl bg-surface-container-lowest shadow-2xl"
                                    @click.stop
                                    x-show="edit"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                >
                                    <div class="flex items-center justify-between gap-3 border-b border-outline-variant/30 px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2.5 min-w-0">
                                            <span class="material-symbols-outlined text-primary-container text-2xl">edit_note</span>
                                            <div class="min-w-0">
                                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Edit Data Pribadi</h3>
                                                <p class="font-label-sm text-label-sm text-on-surface-variant">Perbarui data Anda agar selalu sesuai berkas terbaru.</p>
                                            </div>
                                        </div>
                                        <button class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-on-surface-variant transition-colors hover:bg-surface-container-low active:scale-95" type="button" @click="edit = false" aria-label="Tutup">
                                            <span class="material-symbols-outlined text-[22px]">close</span>
                                        </button>
                                    </div>

                                    <form class="px-5 py-5 sm:px-6" method="POST" action="<?php echo e(route('portal.data-pribadi')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="flex flex-col gap-1.5 sm:col-span-2">
                                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Nama Lengkap &amp; NIK</span>
                                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                    <input class="w-full rounded-xl border border-outline-variant bg-surface-container px-4 py-3 font-body-md text-body-md text-on-surface-variant" value="<?php echo e($record->name); ?>" disabled>
                                                    <input class="w-full break-all rounded-xl border border-outline-variant bg-surface-container px-4 py-3 font-mono text-body-md text-on-surface-variant" value="<?php echo e($record->nik); ?>" disabled>
                                                </div>
                                                <p class="font-label-sm text-label-sm text-on-surface-variant">Nama dan NIK sesuai KTP tidak dapat diubah sendiri. Hubungi sekretariat MWCNU untuk koreksi data identitas.</p>
                                            </div>

                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="tempat_lahir">Tempat Lahir</label>
                                                <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="tempat_lahir" name="tempat_lahir" type="text" value="<?php echo e(old('tempat_lahir', $record->birth_place)); ?>" required>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('tempat_lahir'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('tempat_lahir')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="tanggal_lahir" name="tanggal_lahir" type="date" value="<?php echo e(old('tanggal_lahir', $record->birth_date?->format('Y-m-d'))); ?>" required>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('tanggal_lahir'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('tanggal_lahir')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="jenis_kelamin" name="jenis_kelamin" required>
                                                    <option value="" disabled <?php echo e(old('jenis_kelamin', $record->jenis_kelamin) ? '' : 'selected'); ?>>Pilih jenis kelamin</option>
                                                    <option value="L" <?php echo e(old('jenis_kelamin', $record->jenis_kelamin) === 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                                                    <option value="P" <?php echo e(old('jenis_kelamin', $record->jenis_kelamin) === 'P' ? 'selected' : ''); ?>>Perempuan</option>
                                                </select>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('jenis_kelamin'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('jenis_kelamin')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="no_whatsapp">No. WhatsApp</label>
                                                <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-mono text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="no_whatsapp" name="no_whatsapp" type="tel" inputmode="tel" value="<?php echo e(old('no_whatsapp', $record->no_whatsapp)); ?>" required>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('no_whatsapp'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('no_whatsapp')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="desa_ranting">Desa / Ranting</label>
                                                <select class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="desa_ranting" name="desa_ranting" required>
                                                    <option value="" disabled <?php echo e(old('desa_ranting', $record->desa_ranting) ? '' : 'selected'); ?>>Pilih desa ranting</option>
                                                    <?php $__currentLoopData = $desaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($desa); ?>" <?php echo e(old('desa_ranting', $record->desa_ranting) === $desa ? 'selected' : ''); ?>><?php echo e($desa); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('desa_ranting'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('desa_ranting')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-1.5 sm:col-span-2">
                                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="alamat_lengkap">Alamat Sesuai KTP</label>
                                                <textarea class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="alamat_lengkap" name="alamat_lengkap" rows="3" required><?php echo e(old('alamat_lengkap', $record->alamat_lengkap)); ?></textarea>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('alamat_lengkap'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('alamat_lengkap')),'class' => 'mt-1']); ?>
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
                                        </div>

                                        <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                            <button class="inline-flex items-center justify-center rounded-xl border border-outline-variant px-5 py-3 font-label-md text-label-md font-semibold text-on-surface transition-colors hover:bg-surface-container-low" type="button" @click="edit = false">Batal</button>
                                            <button class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 font-label-md text-label-md font-bold text-on-primary transition-all hover:bg-primary-container active:scale-[0.98]" type="submit">
                                                <span class="material-symbols-outlined text-[18px]">save</span>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Card: Dokumen KTP -->
                    <section
                        class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm"
                        id="dokumen-ktp"
                        x-data="{ editKtp: <?php echo e($errors->hasAny(['foto_ktp', 'foto_ktp_belakang']) ? 'true' : 'false'); ?>, pratinjauDepan: null, pratinjauBelakang: null }"
                        x-effect="document.body.style.overflow = editKtp ? 'hidden' : ''"
                        x-on:keydown.escape.window="editKtp = false"
                    >
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">badge</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Dokumen KTP</h3>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Arsip identitas yang Anda unggah saat pendaftaran</p>
                                </div>
                            </div>
                            <button class="inline-flex items-center gap-1.5 rounded-lg border border-outline-variant px-3 py-1.5 font-label-md text-label-md font-semibold text-on-surface transition-colors hover:bg-surface-container-low active:scale-[0.98]" type="button" @click="editKtp = true">
                                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                                Edit Foto KTP
                            </button>
                        </div>

                        <?php if(session('status_ktp')): ?>
                            <div class="mb-5 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status"><?php echo e(session('status_ktp')); ?></div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="overflow-hidden rounded-xl border border-outline-variant/50 bg-surface-container">
                                <div class="aspect-[8/5] bg-surface-container-high">
                                    <?php if($record->fotoKtpDepanUrl()): ?>
                                        <img class="h-full w-full object-cover" src="<?php echo e($record->fotoKtpDepanUrl()); ?>" alt="Foto KTP depan <?php echo e($record->name); ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="flex h-full flex-col items-center justify-center gap-1 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-3xl">no_photography</span>
                                            <span class="font-label-sm text-label-sm">Belum diunggah</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center justify-between gap-2 border-t border-outline-variant/40 px-3 py-2">
                                    <span class="font-label-md text-label-md font-semibold text-on-surface">KTP &mdash; Depan</span>
                                    <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Sisi 1</span>
                                </div>
                            </div>

                            <div class="overflow-hidden rounded-xl border border-outline-variant/50 bg-surface-container">
                                <div class="aspect-[8/5] bg-surface-container-high">
                                    <?php if($record->fotoKtpBelakangUrl()): ?>
                                        <img class="h-full w-full object-cover" src="<?php echo e($record->fotoKtpBelakangUrl()); ?>" alt="Foto KTP belakang <?php echo e($record->name); ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="flex h-full flex-col items-center justify-center gap-1 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-3xl">no_photography</span>
                                            <span class="font-label-sm text-label-sm">Belum diunggah</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center justify-between gap-2 border-t border-outline-variant/40 px-3 py-2">
                                    <span class="font-label-md text-label-md font-semibold text-on-surface">KTP &mdash; Belakang</span>
                                    <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Sisi 2</span>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit Foto KTP -->
                        <div
                            class="fixed inset-0 z-[90]"
                            x-cloak
                            x-show="editKtp"
                            x-transition.opacity
                            role="dialog"
                            aria-modal="true"
                            aria-label="Edit foto KTP"
                        >
                            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="editKtp = false"></div>
                            <div class="absolute inset-0 flex items-start justify-center overflow-y-auto p-4 sm:items-center sm:p-6">
                                <div
                                    class="relative w-full max-w-xl rounded-2xl bg-surface-container-lowest shadow-2xl"
                                    @click.stop
                                    x-show="editKtp"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                >
                                    <div class="flex items-center justify-between gap-3 border-b border-outline-variant/30 px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2.5 min-w-0">
                                            <span class="material-symbols-outlined text-primary-container text-2xl">photo_camera</span>
                                            <div class="min-w-0">
                                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Edit Foto KTP</h3>
                                                <p class="font-label-sm text-label-sm text-on-surface-variant">Unggah ulang sisi yang perlu diperbarui saja.</p>
                                            </div>
                                        </div>
                                        <button class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-on-surface-variant transition-colors hover:bg-surface-container-low active:scale-95" type="button" @click="editKtp = false" aria-label="Tutup">
                                            <span class="material-symbols-outlined text-[22px]">close</span>
                                        </button>
                                    </div>

                                    <form class="px-5 py-5 sm:px-6" method="POST" action="<?php echo e(route('portal.foto-ktp')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                            <div class="flex flex-col gap-2">
                                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">KTP &mdash; Depan</span>
                                                <div class="aspect-[8/5] overflow-hidden rounded-xl border border-outline-variant bg-surface-container">
                                                    <template x-if="pratinjauDepan">
                                                        <img class="h-full w-full object-cover" :src="pratinjauDepan" alt="Pratinjau KTP depan">
                                                    </template>
                                                    <?php if($record->fotoKtpDepanUrl()): ?>
                                                        <img class="h-full w-full object-cover" x-show="!pratinjauDepan" src="<?php echo e($record->fotoKtpDepanUrl()); ?>" alt="Foto KTP depan saat ini">
                                                    <?php else: ?>
                                                        <div class="flex h-full flex-col items-center justify-center gap-1 text-on-surface-variant" x-show="!pratinjauDepan">
                                                            <span class="material-symbols-outlined text-2xl">no_photography</span>
                                                            <span class="font-label-sm text-label-sm">Belum diunggah</span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-3 py-2 font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-md file:border-0 file:bg-surface-container file:px-3 file:py-1.5 file:font-label-sm file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high" id="foto_ktp" name="foto_ktp" type="file" accept="image/jpeg,image/png,image/jpg" @change="pratinjauDepan = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('foto_ktp'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('foto_ktp')),'class' => 'mt-1']); ?>
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

                                            <div class="flex flex-col gap-2">
                                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">KTP &mdash; Belakang</span>
                                                <div class="aspect-[8/5] overflow-hidden rounded-xl border border-outline-variant bg-surface-container">
                                                    <template x-if="pratinjauBelakang">
                                                        <img class="h-full w-full object-cover" :src="pratinjauBelakang" alt="Pratinjau KTP belakang">
                                                    </template>
                                                    <?php if($record->fotoKtpBelakangUrl()): ?>
                                                        <img class="h-full w-full object-cover" x-show="!pratinjauBelakang" src="<?php echo e($record->fotoKtpBelakangUrl()); ?>" alt="Foto KTP belakang saat ini">
                                                    <?php else: ?>
                                                        <div class="flex h-full flex-col items-center justify-center gap-1 text-on-surface-variant" x-show="!pratinjauBelakang">
                                                            <span class="material-symbols-outlined text-2xl">no_photography</span>
                                                            <span class="font-label-sm text-label-sm">Belum diunggah</span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-3 py-2 font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-md file:border-0 file:bg-surface-container file:px-3 file:py-1.5 file:font-label-sm file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high" id="foto_ktp_belakang" name="foto_ktp_belakang" type="file" accept="image/jpeg,image/png,image/jpg" @change="pratinjauBelakang = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('foto_ktp_belakang'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('foto_ktp_belakang')),'class' => 'mt-1']); ?>
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
                                        </div>

                                        <p class="mt-4 font-label-sm text-label-sm text-on-surface-variant">Format JPG/PNG, maksimal 2 MB per foto. Biarkan kosong jika tidak ingin mengubah.</p>

                                        <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                            <button class="inline-flex items-center justify-center rounded-xl border border-outline-variant px-5 py-3 font-label-md text-label-md font-semibold text-on-surface transition-colors hover:bg-surface-container-low" type="button" @click="editKtp = false">Batal</button>
                                            <button class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 font-label-md text-label-md font-bold text-on-primary transition-all hover:bg-primary-container active:scale-[0.98]" type="submit">
                                                <span class="material-symbols-outlined text-[18px]">save</span>
                                                Simpan Foto KTP
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Card 2: Data Ranting -->
                    <section class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm">
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">account_tree</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Data Ranting &amp; Kepengurusan</h3>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Pangkalan Jam'iyyah Tingkat Desa / Kelurahan</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8">
                            <div class="flex flex-col p-4 rounded-xl bg-surface-container-low">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Asal Ranting</span>
                                <span class="font-headline-sm text-headline-sm text-primary-container mt-1"><?php echo e($record->branch_name); ?></span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Wilayah Pelayanan MWCNU Gumelar</span>
                            </div>
                            <div class="flex flex-col p-4 rounded-xl bg-surface-container-low">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Desa Administrasi</span>
                                <span class="font-headline-sm text-headline-sm text-on-surface mt-1"><?php echo e($record->desa_ranting ?: '—'); ?></span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">Kecamatan Gumelar</span>
                            </div>
                        </div>
                    </section>

                    <!-- Card 3: Informasi Verifikasi -->
                    <section class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm">
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">published_with_changes</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Informasi Verifikasi</h3>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-secondary-container text-on-secondary-fixed font-label-caps text-label-caps font-bold">
                                Tahap <?php echo e($record->verificationProgress()); ?> dari 4
                            </span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8">
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Status Verifikasi</span>
                                <div class="inline-flex items-center gap-2 mt-1">
                                    <span class="w-2.5 h-2.5 rounded-full <?php echo e($statusIsIssued ? 'bg-primary-container' : 'bg-error'); ?>"></span>
                                    <span class="font-body-md text-body-md font-semibold text-on-surface"><?php echo e($record->verificationLabel()); ?></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Progres Verifikasi</span>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="h-2 flex-1 bg-surface-container rounded-full overflow-hidden">
                                        <div class="bg-primary-container h-full rounded-full transition-all duration-700" style="width: <?php echo e($progress); ?>%;"></div>
                                    </div>
                                    <span class="font-mono text-label-sm font-bold text-primary-container"><?php echo e($progress); ?>%</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Kode Registrasi Unik</span>
                                <div class="mt-1">
                                    <span class="font-mono text-label-md font-bold text-on-surface bg-surface-container-high px-3 py-1 rounded-md inline-block break-all"><?php echo e($record->registration_code); ?></span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Nomor Induk Anggota (NIA)</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->nia ?: '—'); ?></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Tanggal Pendaftaran</span>
                                <span class="font-body-md text-body-md font-medium text-on-surface mt-1"><?php echo e($record->created_at->translatedFormat('d F Y')); ?></span>
                            </div>
                            <div class="sm:col-span-2 flex flex-col mt-2">
                                <span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">Catatan Petugas Verifikator</span>
                                <div class="bg-surface-container-low p-4 rounded-xl flex items-start gap-3 mt-1.5">
                                    <span class="material-symbols-outlined text-secondary text-xl mt-0.5">info</span>
                                    <p class="font-body-sm text-body-sm text-on-surface leading-relaxed">
                                        <?php echo e($record->verification_note ?: 'Belum ada catatan dari petugas verifikator.'); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Card 4: KartaNU Digital -->
                    <section class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm" id="kartanu">
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">badge</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">KartaNU Digital</h3>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Kartu anggota digital Anda</p>
                                </div>
                            </div>
                        </div>

                        <?php if($statusIsIssued): ?>
                            <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-center">
                                <figure class="kartu-blok">
                                    <figcaption class="mb-2 font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">Sisi depan</figcaption>
                                    <div class="kartu-skala" data-kartu-skala>
                                        <?php if (isset($component)) { $__componentOriginal4b3734604f818b6c489edb313a5c1b45 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b3734604f818b6c489edb313a5c1b45 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kartu-anggota','data' => ['record' => $record,'sisi' => 'depan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kartu-anggota'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'sisi' => 'depan']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b3734604f818b6c489edb313a5c1b45)): ?>
<?php $attributes = $__attributesOriginal4b3734604f818b6c489edb313a5c1b45; ?>
<?php unset($__attributesOriginal4b3734604f818b6c489edb313a5c1b45); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b3734604f818b6c489edb313a5c1b45)): ?>
<?php $component = $__componentOriginal4b3734604f818b6c489edb313a5c1b45; ?>
<?php unset($__componentOriginal4b3734604f818b6c489edb313a5c1b45); ?>
<?php endif; ?>
                                    </div>
                                </figure>

                                <figure class="kartu-blok">
                                    <figcaption class="mb-2 font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">Sisi belakang</figcaption>
                                    <div class="kartu-skala" data-kartu-skala>
                                        <?php if (isset($component)) { $__componentOriginal4b3734604f818b6c489edb313a5c1b45 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b3734604f818b6c489edb313a5c1b45 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kartu-anggota','data' => ['record' => $record,'sisi' => 'belakang','qrSvg' => $qrSvg]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kartu-anggota'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'sisi' => 'belakang','qr-svg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($qrSvg)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b3734604f818b6c489edb313a5c1b45)): ?>
<?php $attributes = $__attributesOriginal4b3734604f818b6c489edb313a5c1b45; ?>
<?php unset($__attributesOriginal4b3734604f818b6c489edb313a5c1b45); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b3734604f818b6c489edb313a5c1b45)): ?>
<?php $component = $__componentOriginal4b3734604f818b6c489edb313a5c1b45; ?>
<?php unset($__componentOriginal4b3734604f818b6c489edb313a5c1b45); ?>
<?php endif; ?>
                                    </div>
                                </figure>
                            </div>

                            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                                <a class="inline-flex items-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 font-label-md text-label-md text-white hover:bg-primary" href="<?php echo e(route('cetak-kartanu.show', ['registration_code' => $record->registration_code])); ?>">
                                    <span class="material-symbols-outlined text-[18px]">print</span>Cetak / Simpan PDF
                                </a>
                                <a class="inline-flex items-center gap-2 rounded-lg border border-outline-variant px-4 py-2.5 font-label-md text-label-md text-on-surface hover:bg-surface-container-low" href="<?php echo e(route('kartanu')); ?>">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>Lihat di Pusat Layanan
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="rounded-xl border border-secondary-container bg-surface-container-low p-6 text-center">
                                <span class="material-symbols-outlined text-4xl text-primary">hourglass_top</span>
                                <p class="mt-3 font-headline-sm text-headline-sm font-semibold text-on-surface">Kartu belum diterbitkan</p>
                                <p class="mt-1 text-sm text-on-surface-variant">Tahap saat ini: <?php echo e($record->verificationLabel()); ?>. Kartu digital akan tersedia setelah berkas disetujui sekretariat MWCNU.</p>
                                <a class="mt-4 inline-flex items-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 font-label-md text-label-md text-white hover:bg-primary" href="<?php echo e(route('kartanu.track')); ?>">
                                    <span class="material-symbols-outlined text-[18px]">track_changes</span>Lacak Status
                                </a>
                            </div>
                        <?php endif; ?>
                    </section>

                    <!-- Card 5: Koin NU & Infaq -->
                    <section class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm" id="koin">
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">account_balance_wallet</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Koin NU &amp; Infaq</h3>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Kontribusi dan infaq jama'ah</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-xl border border-secondary-container bg-surface-container-low p-8 text-center">
                            <span class="material-symbols-outlined text-4xl text-primary">savings</span>
                            <p class="mt-3 font-headline-sm text-headline-sm font-semibold text-on-surface">Layanan sedang disiapkan</p>
                            <p class="mt-1 text-sm text-on-surface-variant">Fitur Koin NU &amp; Infaq akan segera hadir di portal ini.</p>
                        </div>
                    </section>

                    <!-- Card 6: Pengaturan (Ubah Kata Sandi) -->
                    <section class="bg-surface-container-lowest rounded-2xl p-5 sm:p-7 shadow-sm" id="pengaturan">
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-4 mb-6">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-primary-container text-2xl">settings</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Pengaturan</h3>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Ubah kata sandi akun portal Anda</p>
                                </div>
                            </div>
                        </div>

                        <?php if(session('status')): ?>
                            <div class="mb-5 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status"><?php echo e(session('status')); ?></div>
                        <?php endif; ?>

                        <form class="grid grid-cols-1 sm:grid-cols-2 gap-5" method="POST" action="<?php echo e(route('portal.kata-sandi')); ?>" x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="flex flex-col sm:col-span-2">
                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="current_password">Kata Sandi Saat Ini</label>
                                <div class="relative mt-1.5">
                                    <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low py-3 pl-4 pr-12 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="current_password" name="current_password" type="password" x-bind:type="showCurrent ? 'text' : 'password'" required autocomplete="current-password">
                                    <button class="absolute inset-y-0 right-0 flex w-11 items-center justify-center rounded-r-xl text-outline transition-colors hover:text-primary-container" type="button" @click="showCurrent = !showCurrent" :aria-label="showCurrent ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'" :aria-pressed="showCurrent.toString()">
                                        <span class="material-symbols-outlined text-[20px]" x-text="showCurrent ? 'visibility_off' : 'visibility'">visibility</span>
                                    </button>
                                </div>
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('current_password'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('current_password')),'class' => 'mt-1']); ?>
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

                            <div class="flex flex-col">
                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="password">Kata Sandi Baru</label>
                                <div class="relative mt-1.5">
                                    <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low py-3 pl-4 pr-12 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="password" name="password" type="password" x-bind:type="showNew ? 'text' : 'password'" required autocomplete="new-password">
                                    <button class="absolute inset-y-0 right-0 flex w-11 items-center justify-center rounded-r-xl text-outline transition-colors hover:text-primary-container" type="button" @click="showNew = !showNew" :aria-label="showNew ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'" :aria-pressed="showNew.toString()">
                                        <span class="material-symbols-outlined text-[20px]" x-text="showNew ? 'visibility_off' : 'visibility'">visibility</span>
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

                            <div class="flex flex-col">
                                <label class="font-label-caps text-label-caps text-outline uppercase tracking-wider" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                <div class="relative mt-1.5">
                                    <input class="w-full rounded-xl border border-outline-variant bg-surface-container-low py-3 pl-4 pr-12 font-body-md text-body-md text-on-surface focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" id="password_confirmation" name="password_confirmation" type="password" x-bind:type="showConfirm ? 'text' : 'password'" required autocomplete="new-password">
                                    <button class="absolute inset-y-0 right-0 flex w-11 items-center justify-center rounded-r-xl text-outline transition-colors hover:text-primary-container" type="button" @click="showConfirm = !showConfirm" :aria-label="showConfirm ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'" :aria-pressed="showConfirm.toString()">
                                        <span class="material-symbols-outlined text-[20px]" x-text="showConfirm ? 'visibility_off' : 'visibility'">visibility</span>
                                    </button>
                                </div>
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password_confirmation'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password_confirmation')),'class' => 'mt-1']); ?>
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

                            <div class="sm:col-span-2 pt-1">
                                <button class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3.5 font-label-md text-label-md font-bold text-on-primary transition-all hover:bg-primary-container active:scale-[0.98] sm:w-auto" type="submit">
                                    <span class="material-symbols-outlined text-[18px]">lock_reset</span>Simpan Kata Sandi Baru
                                </button>
                            </div>
                        </form>
                    </section>

                </main>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.portal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/member/dashboard.blade.php ENDPATH**/ ?>