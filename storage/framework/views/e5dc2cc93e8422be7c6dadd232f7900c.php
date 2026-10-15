<?php $__env->startSection('content'); ?>
<header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-space-lg border-b border-outline-variant/30">
    <div class="flex flex-col">
        <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Arsip Visual</span>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-on-surface font-bold tracking-tight mt-1">Dokumentasi Kegiatan</h1>
        <p class="font-body-md text-body-md text-secondary mt-1">Foto-foto dokumentasi kegiatan MWCNU. Ditambahkan otomatis dari kegiatan yang sudah dilaksanakan.</p>
    </div>
    <div class="flex items-center gap-3 shrink-0">
        <a href="<?php echo e(route('admin.kegiatans.index')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold transition-all hover:bg-tertiary-container shadow-sm">
            <span class="material-symbols-outlined text-[18px]">event</span>
            <span>Kelola Kegiatan</span>
        </a>
    </div>
</header>

<?php if(session('status')): ?>
    <div class="rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status"><?php echo e(session('status')); ?></div>
<?php endif; ?>

<div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest overflow-hidden shadow-sm mt-6">
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50 border-b border-outline-variant/30 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold">
                    <th class="py-3.5 px-6 font-semibold" scope="col">Dokumentasi</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Kategori</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Tanggal acara</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30 font-body-md text-body-md">
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img class="h-14 w-20 rounded-lg border border-outline-variant object-cover" src="<?php echo e($item->imageSource()); ?>" alt="<?php echo e($item->alt_text); ?>">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-on-surface block"><?php echo e($item->title); ?></span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant"><?php echo e($item->location ?: 'Lokasi tidak diketahui'); ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-medium"><?php echo e($item->label ?: $item->category); ?></span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-on-surface-variant font-body-sm text-body-sm"><?php echo e($item->event_date?->translatedFormat('d M Y') ?: 'Belum diisi'); ?></td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold <?php echo e($item->is_published ? 'bg-primary-fixed/40 text-primary-container' : 'bg-surface-container-high text-on-surface-variant'); ?>">
                                <?php echo e($item->is_published ? 'Tampil' : 'Disembunyikan'); ?>

                            </span>
                        </td>
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5 text-outline">
                                <a href="<?php echo e(route('admin.gallery.edit', $item)); ?>" class="p-1.5 hover:text-primary-container hover:bg-surface-container rounded-lg transition-colors" title="Ubah">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="<?php echo e(route('admin.gallery.destroy', $item)); ?>" method="POST" onsubmit="return confirm('Hapus dokumentasi ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="p-1.5 hover:text-error hover:bg-error-container/30 rounded-lg transition-colors" title="Hapus" type="submit">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="py-12 text-center text-secondary font-body-md text-body-md">Belum ada dokumentasi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($items->hasPages()): ?>
        <div class="px-6 py-4 bg-surface-container-low/50 border-t border-outline-variant/30">
            <?php echo e($items->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/gallery/index.blade.php ENDPATH**/ ?>