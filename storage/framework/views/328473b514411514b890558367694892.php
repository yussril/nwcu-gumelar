<?php $__env->startSection('content'); ?>
<div class="w-full bg-surface-container-lowest text-on-surface">
    <section class="px-4 pb-8 pt-10 sm:px-6 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col gap-8">
            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-8">
                    <div class="mb-6 inline-flex flex-wrap items-center gap-2 rounded-full bg-primary-fixed/40 px-3.5 py-1.5">
                        <span class="h-2 w-2 rounded-full bg-primary"></span>
                        <span class="font-label-caps text-label-caps font-bold uppercase tracking-wider text-primary">ORGANISASI & KELENGKAPAN JAM'IYYAH</span>
                        <span class="h-1 w-1 rounded-full bg-primary/40"></span>
                        <span class="font-label-caps text-label-caps font-bold uppercase tracking-wider text-primary">KECAMATAN GUMELAR, BANYUMAS</span>
                    </div>
                    <h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-[1.1] text-on-surface sm:text-5xl lg:text-[3.5rem]">Struktur Jam'iyyah & Badan Otonom</h1>
                    <p class="mt-5 max-w-2xl font-body-lg text-body-lg leading-relaxed text-on-surface-variant">
                        Profil organisasi, mandat perjuangan, dan susunan kepengurusan resmi Banom serta lembaga di bawah naungan MWCNU Kecamatan Gumelar.
                    </p>
                </div>

                <aside class="rounded-2xl bg-surface-container-low p-6 sm:p-7 lg:col-span-4" aria-label="Ringkasan organisasi">
                    <div class="mb-5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px] text-primary">verified</span>
                        <span class="font-label-caps text-label-caps font-bold uppercase tracking-wider text-on-surface">SK Pengurus Terverifikasi</span>
                    </div>
                    <dl class="flex flex-col gap-4 text-sm">
                        <div class="flex items-center justify-between gap-4">
                            <dt class="font-medium text-on-surface-variant">Banom & lembaga aktif</dt>
                            <dd class="font-headline-sm text-headline-sm font-bold text-primary"><?php echo e($banoms->count()); ?> Entitas</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="font-medium text-on-surface-variant">Masa khidmat</dt>
                            <dd class="font-semibold text-on-surface">2024–2029</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="font-medium text-on-surface-variant">Ranting terkoordinasi</dt>
                            <dd class="font-semibold text-on-surface">10 Desa Se-Gumelar</dd>
                        </div>
                    </dl>
                    <?php if(auth()->guard()->check()): ?>
                        <a class="mt-5 inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline" href="<?php echo e(route('admin.banoms.index')); ?>">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Kelola konten
                        </a>
                    <?php endif; ?>
                </aside>
            </div>

            <?php if($banoms->isNotEmpty()): ?>
                <nav class="overflow-x-auto pb-2" aria-label="Pilih organisasi">
                    <div class="flex min-w-max items-center gap-3" role="tablist" aria-label="Banom dan lembaga">
                        <?php $__currentLoopData = $banoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="banom-tab rounded-full px-5 py-2.5 text-sm font-semibold transition-colors <?php echo e($index === 0 ? 'bg-primary-container text-white' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high'); ?>" id="tab-<?php echo e($banom->slug); ?>" type="button" role="tab" aria-controls="panel-<?php echo e($banom->slug); ?>" aria-selected="<?php echo e($index === 0 ? 'true' : 'false'); ?>" data-banom-tab="<?php echo e($banom->slug); ?>">
                                <?php echo e($banom->name); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </nav>
            <?php endif; ?>
        </div>
    </section>

    <section class="px-4 pb-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <?php $__empty_1 = true; $__currentLoopData = $banoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $leaders = $banom->members->filter(fn ($member) => \Illuminate\Support\Str::startsWith(\Illuminate\Support\Str::lower($member->position), ['ketua ', 'direktur ']) || str_contains(\Illuminate\Support\Str::lower($member->position), 'kasatkoryon'))->take(2);
                    $coreMembers = $banom->members->reject(fn ($member) => $leaders->contains('id', $member->id))->filter(fn ($member) => str_contains(\Illuminate\Support\Str::lower($member->position), 'sekretaris') || str_contains(\Illuminate\Support\Str::lower($member->position), 'bendahara') || str_contains(\Illuminate\Support\Str::lower($member->position), 'wakil'));
                    $divisionMembers = $banom->members->reject(fn ($member) => $leaders->contains('id', $member->id) || $coreMembers->contains('id', $member->id));
                ?>

                <article class="banom-panel scroll-mt-40 flex flex-col gap-8 <?php echo e($index === 0 ? '' : 'hidden'); ?>" id="panel-<?php echo e($banom->slug); ?>" role="tabpanel" aria-labelledby="tab-<?php echo e($banom->slug); ?>" data-banom-panel="<?php echo e($banom->slug); ?>" <?php if($index !== 0): ?> hidden <?php endif; ?>>
                    <header class="flex flex-col gap-6 pt-2">
                        <div class="flex flex-col gap-3">
                            <div class="inline-flex max-w-full items-center gap-2 self-start rounded-full bg-primary-fixed/50 px-3 py-1 text-primary">
                                <span class="material-symbols-outlined text-label-md">shield</span>
                                <span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider"><?php echo e($banom->category); ?> • MWCNU GUMELAR</span>
                            </div>
                            <h2 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-primary lg:text-headline-xl"><?php echo e($banom->title); ?></h2>
                            <p class="max-w-4xl font-body-lg text-body-lg leading-relaxed text-on-surface-variant"><?php echo e($banom->description); ?></p>
                            <?php if($banom->motto): ?>
                                <p class="pt-1 font-headline-sm text-headline-sm font-semibold italic text-primary-container">"<?php echo e($banom->motto); ?>"</p>
                            <?php endif; ?>
                        </div>

                        <dl class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <?php if($banom->member_count): ?>
                                <div class="flex min-h-18.5 items-center gap-3 rounded-lg border border-outline-variant/50 bg-surface-container-lowest p-3.5">
                                    <span class="material-symbols-outlined flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-primary-fixed/50 text-[20px] text-primary">badge</span>
                                    <div class="min-w-0">
                                        <dt class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Anggota / Kegiatan</dt>
                                        <dd class="mt-0.5 font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($banom->member_count); ?></dd>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($banom->coverage): ?>
                                <div class="flex min-h-18.5 items-center gap-3 rounded-lg border border-outline-variant/50 bg-surface-container-lowest p-3.5">
                                    <span class="material-symbols-outlined flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-primary-fixed/50 text-[20px] text-primary">map</span>
                                    <div class="min-w-0">
                                        <dt class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Cakupan wilayah</dt>
                                        <dd class="mt-0.5 font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($banom->coverage); ?></dd>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($banom->legal_status || $banom->term): ?>
                                <div class="flex min-h-18.5 items-center gap-3 rounded-lg border border-outline-variant/50 bg-surface-container-lowest p-3.5">
                                    <span class="material-symbols-outlined flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-primary-fixed/50 text-[20px] text-primary">verified</span>
                                    <div class="min-w-0">
                                        <dt class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant"><?php echo e($banom->legal_status ? 'Legalitas SK Cabang' : 'Masa khidmat'); ?></dt>
                                        <dd class="mt-0.5 font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($banom->term ? 'Masa Khidmat ' . $banom->term : $banom->legal_status); ?></dd>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </header>

                    <section class="flex flex-col gap-10" aria-labelledby="structure-<?php echo e($banom->slug); ?>">
                        <div class="mx-auto flex max-w-2xl flex-col gap-1 text-center">
                            <span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Struktur Organisasi</span>
                            <h3 class="font-headline-lg text-headline-lg font-extrabold text-on-surface" id="structure-<?php echo e($banom->slug); ?>">Komando & Pengurus Harian Terpilih</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                <?php if($banom->legal_status): ?> Berdasarkan <?php echo e($banom->legal_status); ?> <?php else: ?> Susunan pengurus <?php echo e($banom->name); ?> <?php endif; ?>
                                <?php if($banom->term): ?> • Masa Khidmat <?php echo e($banom->term); ?> <?php endif; ?>
                            </p>
                        </div>

                        <?php if($leaders->isNotEmpty()): ?>
                            <div class="flex flex-col gap-3">
                                <span class="text-center font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">Pucuk Pimpinan Organisasi & Satuan Komando</span>
                                <div class="mx-auto grid w-full max-w-4xl grid-cols-1 gap-5 md:grid-cols-2">
                                    <?php $__currentLoopData = $leaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex flex-col items-center rounded-xl border border-outline-variant/50 bg-surface-container-lowest p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                                            <div class="mb-4 w-40 h-48 sm:w-48 sm:h-56 rounded-lg overflow-hidden bg-surface-container border border-outline-variant/40">
                                                <?php if($member->photo_path): ?>
                                                    <img src="<?php echo e($member->photoUrl()); ?>" alt="<?php echo e($member->name); ?>" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                                        <span class="material-symbols-outlined text-4xl text-outline">person</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($member->name); ?></h4>
                                            <p class="mt-1 font-body-sm text-body-sm font-semibold text-primary-container"><?php echo e($member->position); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($coreMembers->isNotEmpty()): ?>
                            <div class="flex flex-col gap-3">
                                <span class="text-center font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">Pengurus Harian Inti</span>
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                                    <?php $__currentLoopData = $coreMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex flex-col items-center rounded-xl border border-outline-variant/50 bg-surface-container-lowest p-5 text-center shadow-sm hover:shadow-md transition-shadow">
                                            <div class="mb-3.5 w-32 h-36 sm:w-36 sm:h-40 rounded-lg overflow-hidden bg-surface-container border border-outline-variant/40">
                                                <?php if($member->photo_path): ?>
                                                    <img src="<?php echo e($member->photoUrl()); ?>" alt="<?php echo e($member->name); ?>" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                                        <span class="material-symbols-outlined text-3xl text-outline">person</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($member->name); ?></h4>
                                            <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant"><?php echo e($member->position); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($divisionMembers->isNotEmpty()): ?>
                            <div class="flex flex-col gap-3">
                                <span class="text-center font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">Jajaran Divisi, Majelis & Komando Satuan</span>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                    <?php $__currentLoopData = $divisionMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex flex-col items-center rounded-xl border border-outline-variant/50 bg-surface-container-lowest p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                                            <div class="mb-3 w-24 h-28 rounded-lg overflow-hidden bg-surface-container border border-outline-variant/40">
                                                <?php if($member->photo_path): ?>
                                                    <img src="<?php echo e($member->photoUrl()); ?>" alt="<?php echo e($member->name); ?>" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                                        <span class="material-symbols-outlined text-2xl text-outline">person</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="font-label-md text-label-md font-bold text-on-surface"><?php echo e($member->name); ?></h4>
                                            <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant"><?php echo e($member->position); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($banom->members->isEmpty()): ?>
                            <p class="rounded-xl bg-surface-container-low p-5 text-center text-sm text-on-surface-variant">Susunan pengurus belum ditambahkan.</p>
                        <?php endif; ?>
                    </section>

                    <?php if($banom->note): ?>
                        <aside class="rounded-lg border border-outline-variant/50 bg-surface-container-lowest p-6 text-center">
                            <div class="mx-auto flex max-w-3xl flex-col gap-2">
                                <span class="font-label-caps text-label-caps font-bold uppercase tracking-wider text-on-surface-variant">Markas Komando & Informasi Pelayanan</span>
                                <p class="font-body-md text-body-md leading-relaxed text-on-surface-variant"><?php echo e($banom->note); ?></p>
                            </div>
                        </aside>
                    <?php endif; ?>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-2xl bg-surface-container-low p-12 text-center">
                    <span class="material-symbols-outlined text-4xl text-primary">groups</span>
                    <h2 class="mt-3 font-headline-md text-headline-md font-bold text-on-surface">Data Banom belum tersedia</h2>
                    <p class="mt-2 text-on-surface-variant">Tambahkan organisasi melalui dashboard NWCU.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php if($banoms->isNotEmpty()): ?>
    <script>
        (() => {
            const tabs = [...document.querySelectorAll('[data-banom-tab]')];
            const panels = [...document.querySelectorAll('[data-banom-panel]')];

            const selectBanom = (slug, updateHistory = true) => {
                tabs.forEach((tab) => {
                    const isSelected = tab.dataset.banomTab === slug;
                    tab.setAttribute('aria-selected', String(isSelected));
                    tab.classList.toggle('bg-primary-container', isSelected);
                    tab.classList.toggle('text-white', isSelected);
                    tab.classList.toggle('bg-surface-container', !isSelected);
                    tab.classList.toggle('text-on-surface-variant', !isSelected);
                });

                panels.forEach((panel) => {
                    const isSelected = panel.dataset.banomPanel === slug;
                    panel.hidden = !isSelected;
                    panel.classList.toggle('hidden', !isSelected);
                });

                if (updateHistory) history.replaceState(null, '', `#${slug}`);
            };

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => selectBanom(tab.dataset.banomTab));
                tab.addEventListener('keydown', (event) => {
                    if (!['ArrowRight', 'ArrowLeft', 'Home', 'End'].includes(event.key)) return;
                    event.preventDefault();
                    const nextIndex = event.key === 'Home' ? 0 : event.key === 'End' ? tabs.length - 1 : (index + (event.key === 'ArrowRight' ? 1 : -1) + tabs.length) % tabs.length;
                    tabs[nextIndex].focus();
                    selectBanom(tabs[nextIndex].dataset.banomTab);
                });
            });

            const activateFromHash = () => {
                const slug = decodeURIComponent(window.location.hash.slice(1));
                const tab = tabs.find((item) => item.dataset.banomTab === slug);
                if (!tab) return;

                selectBanom(slug, false);

                const nav = tab.closest('nav');
                if (nav) {
                    nav.scrollTo({ left: Math.max(tab.offsetLeft - (nav.clientWidth / 2) + (tab.offsetWidth / 2), 0), behavior: 'smooth' });
                }

                const panel = document.getElementById(`panel-${slug}`);
                if (panel) panel.scrollIntoView({ block: 'start' });
            };

            activateFromHash();
            window.addEventListener('hashchange', activateFromHash);
        })();
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/banom.blade.php ENDPATH**/ ?>