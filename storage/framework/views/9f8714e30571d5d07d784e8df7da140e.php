<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-4xl">
    <a href="<?php echo e(route('admin.kegiatans.index')); ?>" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke kegiatan
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Manajemen Kegiatan</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface"><?php echo e($kegiatan->exists ? 'Ubah Kegiatan' : 'Tambah Kegiatan'); ?></h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">Kegiatan otomatis pindah ke galeri setelah <strong>akhir pelaksanaan</strong> terlewati.</p>
    </div>
    <?php if($errors->any()): ?>
        <div class="mb-5 rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 text-sm text-on-error-container" role="alert">
            <p class="font-bold mb-1">Periksa kembali data yang diisi:</p>
            <ul class="list-disc pl-5 space-y-0.5"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>
    <form class="flex flex-col gap-5" action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php if($method === 'PUT'): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Detail kegiatan</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="title">Judul kegiatan<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="title" name="title" value="<?php echo e(old('title', $kegiatan->title)); ?>" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="category">Kategori<select class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="category" name="category"><option value="" disabled selected>Pilih kategori</option><option value="syuriyah-tanfidziyah" <?php if(old('category', $kegiatan->category) === 'syuriyah-tanfidziyah'): echo 'selected'; endif; ?>>Giat Syuriyah & Tanfidziyah</option><option value="ansor" <?php if(old('category', $kegiatan->category) === 'ansor'): echo 'selected'; endif; ?>>Ansor & Banser</option><option value="fatayat" <?php if(old('category', $kegiatan->category) === 'fatayat'): echo 'selected'; endif; ?>>Fatayat & Muslimat</option><option value="ipnu-ippnu" <?php if(old('category', $kegiatan->category) === 'ipnu-ippnu'): echo 'selected'; endif; ?>>IPNU & IPPNU</option><option value="lazisnu" <?php if(old('category', $kegiatan->category) === 'lazisnu'): echo 'selected'; endif; ?>>LAZISNU & Filantropi</option><option value="dakwah" <?php if(old('category', $kegiatan->category) === 'dakwah'): echo 'selected'; endif; ?>>LBM & Dakwah Pesantren</option><option value="ranting" <?php if(old('category', $kegiatan->category) === 'ranting'): echo 'selected'; endif; ?>>Kegiatan Ranting & Desa</option></select></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="scheduled_at">Waktu pelaksanaan<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="scheduled_at" name="scheduled_at" type="datetime-local" value="<?php echo e(old('scheduled_at', $kegiatan->scheduled_at?->format('Y-m-d\TH:i'))); ?>" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="scheduled_end_at">Akhir pelaksanaan<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="scheduled_end_at" name="scheduled_end_at" type="datetime-local" value="<?php echo e(old('scheduled_end_at', $kegiatan->scheduled_end_at?->format('Y-m-d\TH:i'))); ?>" aria-describedby="scheduled-end-hint" required><span class="font-body-sm text-body-sm font-normal text-secondary" id="scheduled-end-hint">Dilewati otomatis ke galeri setelah waktu ini.</span></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="location">Lokasi<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="location" name="location" value="<?php echo e(old('location', $kegiatan->location)); ?>"></label>
            </div>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="description">Deskripsi<textarea class="min-h-20 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="description" name="description" rows="4"><?php echo e(old('description', $kegiatan->description)); ?></textarea></label>
        </section>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Foto sampul &amp; visibilitas</h2>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="cover_image">Foto sampul kegiatan<input class="block w-full font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-surface-container file:px-3 file:py-2 file:font-semibold file:text-on-surface-variant" id="cover_image" name="cover_image" type="file" accept="image/*"></label>
            <?php if($kegiatan->cover_image_path): ?>
                <img class="h-40 w-64 rounded-lg border border-outline-variant object-cover" src="<?php echo e($kegiatan->coverImageUrl()); ?>" alt="Foto sampul saat ini">
            <?php endif; ?>
            <label class="flex items-center gap-2 font-body-md text-body-md text-on-surface"><input class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container" id="is_published" name="is_published" type="checkbox" value="1" <?php if(old('is_published', $kegiatan->is_published)): echo 'checked'; endif; ?>>Tampilkan kegiatan ini</label>
        </section>
        <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <a class="inline-flex min-h-11 items-center justify-center rounded-lg border border-outline-variant px-5 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container" href="<?php echo e(route('admin.kegiatans.index')); ?>">Batal</a>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan Kegiatan</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kegiatans/form.blade.php ENDPATH**/ ?>