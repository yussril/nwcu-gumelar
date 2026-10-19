<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-4xl">
    <a href="<?php echo e(route('admin.gallery.index')); ?>" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke galeri
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Arsip Visual</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Foto Kegiatan</h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">Tambahkan foto-foto dokumentasi untuk kegiatan ini.</p>
    </div>

    <?php if($errors->any()): ?>
        <div class="mb-5 rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 text-sm text-on-error-container" role="alert">
            <p class="font-bold mb-1">Periksa kembali data yang diisi:</p>
            <ul class="list-disc pl-5 space-y-0.5"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>

    <?php if(session('status')): ?>
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="mb-6 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
        <h2 class="font-headline-md text-headline-md font-bold text-on-surface"><?php echo e($item->title); ?></h2>
        <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 font-body-sm text-body-sm text-secondary">
            <?php if($item->event_date): ?><span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px]">calendar_today</span><?php echo e($item->event_date->translatedFormat('d F Y')); ?></span><?php endif; ?>
            <?php if($item->location): ?><span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px]">location_on</span><?php echo e($item->location); ?></span><?php endif; ?>
            <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px]">category</span><?php echo e($item->category); ?></span>
        </div>
    </div>

    <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
        <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Foto-foto kegiatan</h2>
        <p class="font-body-sm text-body-sm text-secondary">Tambahkan foto-foto dokumentasi kegiatan ini. Foto akan ditampilkan di halaman detail galeri.</p>

        <?php if($item->photos->isNotEmpty()): ?>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
            <?php $__currentLoopData = $item->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group relative">
                <img src="<?php echo e($photo->photoUrl()); ?>" alt="<?php echo e($photo->caption ?? 'Foto kegiatan'); ?>" class="h-32 w-full rounded-lg border border-outline-variant object-cover">
                <?php if($photo->caption): ?>
                <p class="mt-1 truncate font-body-sm text-body-sm text-secondary"><?php echo e($photo->caption); ?></p>
                <?php endif; ?>
                <form action="<?php echo e(route('admin.gallery.deletePhoto', [$item, $photo])); ?>" method="POST" onsubmit="return confirm('Hapus foto ini?')" class="absolute right-2 top-2">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full bg-error/90 text-white opacity-0 transition-opacity group-hover:opacity-100 hover:bg-error">
                        <span class="material-symbols-outlined text-[16px]">delete</span>
                    </button>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="rounded-xl border border-dashed border-outline-variant/50 bg-surface-container-low px-6 py-10 text-center">
            <span class="material-symbols-outlined mb-2 text-4xl text-outline">photo_library</span>
            <p class="font-body-sm text-body-sm text-secondary">Belum ada foto. Tambahkan foto kegiatan di bawah.</p>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.gallery.addPhoto', $item)); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 rounded-xl border border-dashed border-outline-variant/50 bg-surface-container-low p-4 sm:flex-row sm:items-end">
            <?php echo csrf_field(); ?>
            <label class="flex flex-1 flex-col gap-2 font-label-sm text-label-sm font-semibold text-on-surface" for="photo">Foto baru<input class="block w-full font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-surface-container file:px-3 file:py-2 file:font-semibold file:text-on-surface-variant" id="photo" name="photo" type="file" accept="image/*" required></label>
            <label class="flex flex-1 flex-col gap-2 font-label-sm text-label-sm font-semibold text-on-surface" for="caption">Caption (opsional)<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-2.5 font-body-sm text-body-sm font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="caption" name="caption" placeholder="cth: Penyerahan bantuan"></label>
            <button type="submit" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container">
                <span class="material-symbols-outlined text-[18px]">add_photo_alternate</span>Tambah
            </button>
        </form>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/gallery/form.blade.php ENDPATH**/ ?>