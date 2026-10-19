<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-4xl">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.pesan.index')); ?>" class="inline-flex items-center gap-1.5 font-label-md text-label-md font-semibold text-primary hover:underline">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Pesan Masuk</span>
        </a>

        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Detail Pesan</p>
                <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Pesan dari <?php echo e($message->full_name); ?></h1>
                <p class="mt-2 font-body-md text-body-md text-secondary">Dikirim <?php echo e($message->created_at->translatedFormat('d F Y')); ?> pukul <?php echo e($message->created_at->format('H:i')); ?> WIB</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 self-start">
                <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1.5 font-label-sm text-label-sm font-semibold text-secondary"><?php echo e($message->categoryLabel()); ?></span>
                <span class="inline-flex items-center gap-1 rounded-full <?php echo e($message->is_read ? 'bg-surface-container text-secondary' : 'bg-primary-fixed text-primary-container'); ?> px-3 py-1.5 font-label-sm text-label-sm font-semibold">
                    <span class="h-1.5 w-1.5 rounded-full <?php echo e($message->is_read ? 'bg-outline' : 'bg-primary'); ?>"></span>
                    <?php echo e($message->is_read ? 'Dibaca' : 'Baru'); ?>

                </span>
            </div>
        </div>
    </div>

    <?php if(session('status')): ?>
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Isi pesan -->
        <div class="rounded-2xl border border-surface-container/50 bg-surface-container-lowest p-6 sm:p-8 lg:col-span-2">
            <span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Isi Pesan</span>
            <p class="mt-4 whitespace-pre-line font-body-md text-body-md leading-relaxed text-on-surface"><?php echo e($message->message); ?></p>
        </div>

        <!-- Info pengirim & aksi -->
        <aside class="h-fit rounded-2xl border border-surface-container/50 bg-surface-container-lowest p-6 sm:p-8">
            <span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Pengirim</span>

            <div class="mt-4 flex items-center gap-3">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full <?php echo e($message->is_read ? 'bg-surface-container text-on-surface-variant' : 'bg-primary-fixed text-primary-container'); ?> font-label-md text-label-md font-bold">
                    <?php echo e($message->initials()); ?>

                </div>
                <div class="min-w-0">
                    <p class="font-headline-sm text-headline-sm font-bold text-on-surface"><?php echo e($message->full_name); ?></p>
                    <p class="break-all font-body-sm text-body-sm text-secondary"><?php echo e($message->contact_point); ?></p>
                </div>
            </div>

            <dl class="mt-5 flex flex-col gap-3 border-t border-surface-container pt-5 font-body-sm text-body-sm">
                <div class="flex items-start justify-between gap-3">
                    <dt class="text-secondary">Kategori</dt>
                    <dd class="text-right font-semibold text-on-surface"><?php echo e($message->categoryLabel()); ?></dd>
                </div>
                <div class="flex items-start justify-between gap-3">
                    <dt class="text-secondary">Dikirim</dt>
                    <dd class="text-right font-semibold text-on-surface"><?php echo e($message->created_at->translatedFormat('d M Y H:i')); ?> WIB</dd>
                </div>
                <div class="flex items-start justify-between gap-3">
                    <dt class="text-secondary">Status</dt>
                    <dd class="text-right font-semibold text-on-surface">
                        <?php if($message->is_read): ?>
                            Dibaca <?php echo e($message->read_at?->diffForHumans()); ?>

                        <?php else: ?>
                            Belum dibaca
                        <?php endif; ?>
                    </dd>
                </div>
            </dl>

            <?php
                $isEmail = filter_var($message->contact_point, FILTER_VALIDATE_EMAIL) !== false;
                $isPhone = preg_match('/^[0-9+\s\-]{8,20}$/', $message->contact_point) === 1;
            ?>
            <?php if($isEmail || $isPhone): ?>
                <a class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-3 font-label-md text-label-md font-semibold text-on-primary transition-colors hover:bg-primary" href="<?php echo e($isEmail ? 'mailto:' . $message->contact_point : 'https://wa.me/' . preg_replace('/\D/', '', $message->contact_point)); ?>" target="_blank" rel="noopener noreferrer">
                    <span class="material-symbols-outlined text-[18px]"><?php echo e($isEmail ? 'reply' : 'chat'); ?></span>
                    <span><?php echo e($isEmail ? 'Balas via Surel' : 'Hubungi via WhatsApp'); ?></span>
                </a>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.pesan.destroy', $message)); ?>" method="POST" onsubmit="return confirm(<?php echo e(json_encode('Hapus pesan dari ' . $message->full_name . '? Tindakan ini tidak bisa dibatalkan.')); ?>)">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-lg border border-error/30 px-5 py-3 font-label-md text-label-md font-semibold text-error transition-colors hover:bg-error-container/30">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    <span>Hapus Pesan</span>
                </button>
            </form>
        </aside>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/pesan/show.blade.php ENDPATH**/ ?>