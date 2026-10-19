<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Manajemen Kegiatan</p>
            <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Kegiatan</h1>
            <p class="mt-2 font-body-md text-body-md text-secondary">Kelola kegiatan yang akan datang. Kegiatan otomatis pindah ke galeri setelah <strong>akhir pelaksanaan</strong> terlewati.</p>
        </div>
        <a href="<?php echo e(route('admin.kegiatans.create')); ?>" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container">
            <span class="material-symbols-outlined text-[18px]">add</span>Tambah Kegiatan
        </a>
    </div>

    <?php if(session('status')): ?>
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[720px]">
                <thead>
                    <tr class="border-b border-outline-variant/30 bg-surface-container-low">
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kegiatan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kategori</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Waktu Pelaksanaan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Status</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    <?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-surface-container-low/50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($kegiatan->cover_image_path): ?>
                                        <img src="<?php echo e($kegiatan->coverImageUrl()); ?>" alt="" class="h-12 w-16 rounded-lg object-cover">
                                    <?php else: ?>
                                        <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-surface-container">
                                            <span class="material-symbols-outlined text-outline">image</span>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-body-md text-body-md font-semibold text-on-surface"><?php echo e($kegiatan->title); ?></p>
                                        <?php if($kegiatan->location): ?>
                                            <p class="font-body-sm text-body-sm text-secondary"><?php echo e($kegiatan->location); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary"><?php echo e($kegiatan->category ?? '-'); ?></td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary"><?php echo e($kegiatan->scheduled_at->format('d M Y H:i')); ?><?php if($kegiatan->scheduled_end_at): ?><span class="mt-0.5 block text-label-sm text-on-surface-variant">s/d <?php echo e($kegiatan->scheduled_end_at->format('d M Y H:i')); ?></span><?php endif; ?></td>
                            <td class="px-5 py-4">
                                <?php if($kegiatan->is_published): ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-container/50 px-3 py-1 font-label-sm text-label-sm font-semibold text-primary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-outline"></span>Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('admin.kegiatans.edit', $kegiatan)); ?>" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-outline-variant px-3 py-1.5 font-label-sm text-label-sm font-semibold text-on-surface hover:bg-surface-container">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </a>
                                    <form action="<?php echo e(route('admin.kegiatans.destroy', $kegiatan)); ?>" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-error/30 px-3 py-1.5 font-label-sm text-label-sm font-semibold text-error hover:bg-error-container/30">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <span class="material-symbols-outlined mb-2 text-4xl text-outline">event</span>
                                <p class="font-body-md text-body-md text-secondary">Belum ada kegiatan. Klik "Tambah Kegiatan" untuk membuat.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($kegiatans->hasPages()): ?>
            <div class="border-t border-outline-variant/30 px-5 py-4">
                <?php echo e($kegiatans->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kegiatans/index.blade.php ENDPATH**/ ?>