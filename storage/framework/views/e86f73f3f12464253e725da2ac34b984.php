<?php $__env->startSection('content'); ?>
<?php
    $filters = [
        'all' => 'Semua Dokumentasi',
        'syuriyah-tanfidziyah' => 'Giat Syuriyah & Tanfidziyah',
        'ansor' => 'Ansor & Banser',
        'fatayat' => 'Fatayat & Muslimat',
        'ipnu-ippnu' => 'IPNU & IPPNU',
        'lazisnu' => 'LAZISNU & Filantropi',
        'dakwah' => 'LBM & Dakwah Pesantren',
        'ranting' => 'Kegiatan Ranting & Desa',
    ];
    $layouts = [
        ['md:col-span-2 lg:col-span-12', 'aspect-[21/9]'],
        ['md:col-span-1 lg:col-span-7', 'aspect-[16/10]'],
        ['md:col-span-1 lg:col-span-5', 'aspect-[16/10]'],
        ['md:col-span-1 lg:col-span-5', 'aspect-[16/10]'],
        ['md:col-span-1 lg:col-span-7', 'aspect-[16/10]'],
        ['md:col-span-1 lg:col-span-4', 'aspect-[4/3]'],
        ['md:col-span-1 lg:col-span-4', 'aspect-[4/3]'],
        ['md:col-span-1 lg:col-span-4', 'aspect-[4/3]'],
    ];
?>

<div class="w-full bg-[#FAFAF9] text-on-surface">
    <section class="w-full border-b border-[#E5E7EB] bg-[#FAFAF9] px-6 pb-10 pt-12 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col items-start">
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-[#D1D5DB] bg-[#FAFAF9] px-3 py-1"><span class="h-1.5 w-1.5 rounded-full bg-primary-container"></span><span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary-container">ARSIP VISUAL & REKAM JEJAK • KECAMATAN GUMELAR, BANYUMAS</span></div>
            <div class="flex max-w-4xl flex-col gap-3"><h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-[#111827] lg:text-headline-xl">Galeri & Dokumentasi Khidmat</h1><p class="max-w-2xl font-body-lg text-body-lg leading-relaxed text-[#4B5563]">Arsip visual pergerakan, kegiatan sosial, dan syiar dakwah keluarga besar MWCNU Kecamatan Gumelar.</p></div>
            <div class="mt-8 flex w-full flex-col justify-between gap-4 border-t border-[#E5E7EB] pt-6 lg:flex-row lg:items-center">
                <div class="flex flex-wrap items-center gap-2" id="gallery-filters" role="group" aria-label="Filter kategori dokumentasi">
                    <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="gallery-filter inline-flex items-center rounded-full border px-4 py-2 font-label-md text-label-md transition-colors <?php echo e($loop->first ? 'border-primary-container bg-primary-container font-semibold text-white' : 'border-[#D1D5DB] bg-[#FAFAF9] font-medium text-[#374151] hover:border-[#9CA3AF] hover:text-[#111827]'); ?>" type="button" data-gallery-filter="<?php echo e($key); ?>" aria-pressed="<?php echo e($loop->first ? 'true' : 'false'); ?>"><?php echo e($label); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="inline-flex items-center gap-2 text-label-sm text-[#4B5563]" aria-live="polite"><span class="material-symbols-outlined text-[16px] text-primary-container">folder_open</span><span><strong id="gallery-visible-count" class="font-semibold text-[#111827]"><?php echo e(min(6, $galleryItems->count())); ?></strong> dari <?php echo e($galleryItems->count()); ?> entri terdokumentasi</span></div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#FAFAF9] px-6 py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-12" id="gallery-grid">
                <?php $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php [$layout, $ratio] = $layouts[$index] ?? ['md:col-span-1 lg:col-span-4', 'aspect-[4/3]']; ?>
                    <article class="gallery-item group flex flex-col <?php echo e($layout); ?> <?php echo e($index >= 6 ? 'hidden' : ''); ?>" data-gallery-item data-category="<?php echo e($item->category); ?>" data-title="<?php echo e(Str::lower($item->title)); ?>">
                        <a class="w-full overflow-hidden rounded-lg border border-[#E5E7EB] bg-[#F3F4F6]" href="<?php echo e(route('galeri.show', $item)); ?>">
                            <?php if($item->imageSource()): ?><img alt="<?php echo e($item->alt_text ?: $item->title); ?>" class="<?php echo e($ratio); ?> w-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.01]" src="<?php echo e($item->imageSource()); ?>" loading="<?php echo e($index === 0 ? 'eager' : 'lazy'); ?>"><?php else: ?><div class="<?php echo e($ratio); ?> flex items-center justify-center text-slate-400"><span class="material-symbols-outlined text-4xl">image</span></div><?php endif; ?>
                        </a>
                        <div class="mt-4 flex flex-col">
                            <div class="mb-1.5 flex flex-wrap items-center gap-2"><span class="inline-block rounded border border-[#D1E7DD] bg-[#E6F4EA] px-2.5 py-0.5 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary-container"><?php echo e($item->label ?: $item->category); ?></span><?php if($index === 0): ?><span class="font-label-sm text-label-sm font-medium text-[#6B7280]">Dokumentasi Utama</span><?php endif; ?></div>
                            <h2 class="font-headline-md text-headline-md font-bold leading-snug tracking-tight text-[#111827]"><?php echo e($item->title); ?></h2>
                            <?php if($item->description): ?><p class="mt-1 text-sm leading-relaxed text-slate-600"><?php echo e($item->description); ?></p><?php endif; ?>
                            <div class="mt-2 flex flex-wrap items-center gap-x-1.5 gap-y-1 font-body-sm text-body-sm text-[#4B5563]"><span class="material-symbols-outlined text-[16px]">calendar_today</span><span><?php echo e($item->event_date?->translatedFormat('d F Y') ?? 'Tanggal belum diisi'); ?></span><span class="mx-1">•</span><span class="material-symbols-outlined text-[16px]">location_on</span><span><?php echo e($item->location ?: 'Lokasi belum diisi'); ?></span></div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <p class="hidden py-16 text-center font-body-md text-body-md text-[#6B7280]" id="gallery-empty" role="status">Belum ada dokumentasi untuk kategori ini.</p>
            <?php if($galleryItems->isEmpty()): ?><div class="rounded-2xl bg-white px-6 py-16 text-center text-slate-500">Belum ada dokumentasi yang diterbitkan.</div><?php endif; ?>
            <?php if($galleryItems->count() > 6): ?>
                <div class="mt-16 flex w-full flex-col items-center justify-center border-t border-[#E5E7EB] pb-8 pt-12"><div class="flex flex-col items-center gap-3"><p class="font-body-sm text-body-sm text-[#6B7280]">Menampilkan <span class="font-bold text-[#111827]" id="gallery-status-count"><?php echo e(min(6, $galleryItems->count())); ?></span> dari <span class="font-bold text-[#111827]"><?php echo e($galleryItems->count()); ?></span> arsip foto digital</p><button class="inline-flex items-center justify-center gap-2 rounded-full border border-[#D1D5DB] bg-[#FAFAF9] px-8 py-3 font-label-md text-label-md font-semibold text-[#111827] transition-colors hover:border-[#9CA3AF] hover:bg-[#F3F4F6]" id="gallery-load-more" type="button"><span>Muat Lebih Banyak</span><span class="material-symbols-outlined text-[18px]">expand_more</span></button></div></div>
            <?php endif; ?>
        </div>
    </section>
</div>

<script>
    (() => {
        const filters = [...document.querySelectorAll('[data-gallery-filter]')];
        const items = [...document.querySelectorAll('[data-gallery-item]')];
        const loadMoreButton = document.querySelector('#gallery-load-more');
        const visibleCount = document.querySelector('#gallery-visible-count');
        const statusCount = document.querySelector('#gallery-status-count');
        const emptyState = document.querySelector('#gallery-empty');
        let activeFilter = 'all';
        let expanded = false;

        const update = () => {
            const matches = items.filter((item) => activeFilter === 'all' || item.dataset.category === activeFilter);
            const visible = expanded ? matches : matches.slice(0, 6);
            items.forEach((item) => {
                const show = visible.includes(item);
                item.hidden = !show;
                item.classList.toggle('hidden', !show);
            });
            visibleCount.textContent = visible.length;
            if (statusCount) statusCount.textContent = visible.length;
            if (loadMoreButton) loadMoreButton.hidden = visible.length >= matches.length;
            if (emptyState) {
                emptyState.hidden = matches.length > 0;
                emptyState.classList.toggle('hidden', matches.length > 0);
            }
        };

        filters.forEach((button) => button.addEventListener('click', () => {
            activeFilter = button.dataset.galleryFilter;
            expanded = false;
            filters.forEach((filter) => {
                const selected = filter === button;
                filter.setAttribute('aria-pressed', String(selected));
                filter.classList.toggle('border-primary-container', selected);
                filter.classList.toggle('bg-primary-container', selected);
                filter.classList.toggle('font-semibold', selected);
                filter.classList.toggle('text-white', selected);
                filter.classList.toggle('border-[#D1D5DB]', !selected);
                filter.classList.toggle('bg-[#FAFAF9]', !selected);
                filter.classList.toggle('font-medium', !selected);
                filter.classList.toggle('text-[#374151]', !selected);
            });
            update();
        }));
        loadMoreButton?.addEventListener('click', () => { expanded = true; update(); });
        update();
    })();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/public/galeri.blade.php ENDPATH**/ ?>