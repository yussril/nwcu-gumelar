<?php $__env->startSection('content'); ?>
<div class="w-full bg-[#FAFAF9] text-on-surface">
    <section class="w-full border-b border-[#E5E7EB] bg-[#FAFAF9] px-6 pb-10 pt-12 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col items-start">
            <a href="<?php echo e(route('galeri')); ?>" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke galeri
            </a>
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-[#D1D5DB] bg-[#FAFAF9] px-3 py-1"><span class="h-1.5 w-1.5 rounded-full bg-primary-container"></span><span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary-container"><?php echo e($item->label ?: $item->category); ?></span></div>
            <div class="flex max-w-4xl flex-col gap-3">
                <h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-[#111827] lg:text-headline-xl"><?php echo e($item->title); ?></h1>
                <?php if($item->description): ?><p class="max-w-2xl font-body-lg text-body-lg leading-relaxed text-[#4B5563]"><?php echo e($item->description); ?></p><?php endif; ?>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-body-sm text-body-sm text-[#4B5563]">
                    <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">calendar_today</span><?php echo e($item->event_date?->translatedFormat('d F Y') ?? 'Tanggal belum diisi'); ?></span>
                    <?php if($item->location): ?><span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">location_on</span><?php echo e($item->location); ?></span><?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#FAFAF9] px-6 py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <?php
                $photos = $item->photos;
                $cover = $item->imageSource();
            ?>

            <?php if($photos->isNotEmpty() || $cover): ?>
                <div class="grid grid-cols-4 gap-4">
                    <?php if($cover && $photos->isEmpty()): ?>
                        <div class="col-span-2 sm:col-span-3 lg:col-span-4">
                            <img src="<?php echo e($cover); ?>" alt="<?php echo e($item->alt_text ?: $item->title); ?>" class="w-full rounded-xl border border-[#E5E7EB] object-cover">
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <figure class="group">
                                <div class="overflow-hidden rounded-xl border border-[#E5E7EB] bg-[#F3F4F6]">
                                    <img src="<?php echo e($photo->photoUrl()); ?>" alt="<?php echo e($photo->caption ?: $item->title); ?>" class="aspect-[4/3] w-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]" loading="lazy">
                                </div>
                                <?php if($photo->caption): ?><figcaption class="mt-2 font-body-sm text-body-sm text-[#4B5563]"><?php echo e($photo->caption); ?></figcaption><?php endif; ?>
                            </figure>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="rounded-2xl bg-white px-6 py-16 text-center text-slate-500">
                    <span class="material-symbols-outlined mb-3 text-5xl text-slate-300">photo_library</span>
                    <p class="font-body-md text-body-md">Foto-foto kegiatan akan ditambahkan oleh admin.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/public/galeri-detail.blade.php ENDPATH**/ ?>