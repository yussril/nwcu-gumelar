<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Kotak Masuk</p>
            <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Pesan Masuk</h1>
            <p class="mt-2 font-body-md text-body-md text-secondary">Pesan dari formulir <strong>Hubungi Kami</strong> di situs publik. <strong><?php echo e($unreadMessageCount ?? 0); ?></strong> belum dibaca dari <?php echo e($totalCount); ?> total pesan.</p>
        </div>
        <span class="inline-flex items-center gap-2 self-start rounded-full bg-surface-container px-4 py-2 font-label-sm text-label-sm font-semibold text-on-surface">
            <span class="material-symbols-outlined text-[16px] text-secondary">inbox</span>
            <?php echo e($totalCount); ?> Pesan
        </span>
    </div>

    <?php if(session('status')): ?>
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/30 bg-surface-container-low">
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Pengirim</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kategori</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Isi Pesan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Dikirim</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Status</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-surface-container-low/50 <?php echo e($message->is_read ? '' : 'bg-primary-fixed/10'); ?>">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full <?php echo e($message->is_read ? 'bg-surface-container text-on-surface-variant' : 'bg-primary-fixed text-primary-container'); ?> font-label-md text-label-md font-bold">
                                        <?php echo e($message->initials()); ?>

                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-body-md text-body-md font-semibold text-on-surface"><?php echo e($message->full_name); ?></p>
                                        <p class="font-body-sm text-body-sm text-secondary break-all"><?php echo e($message->contact_point); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary"><?php echo e($message->categoryLabel()); ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <?php
                                    $isEmail = filter_var($message->contact_point, FILTER_VALIDATE_EMAIL) !== false;
                                    $isPhone = preg_match('/^[0-9+\s\-]{8,20}$/', $message->contact_point) === 1;
                                ?>
                                <details class="max-w-md">
                                    <summary class="cursor-pointer font-body-sm text-body-sm leading-relaxed text-on-surface"><span class="line-clamp-3"><?php echo e($message->message); ?></span></summary>
                                    <p class="mt-2 whitespace-pre-line font-body-sm text-body-sm leading-relaxed text-secondary"><?php echo e($message->message); ?></p>
                                    <?php if($isEmail || $isPhone): ?>
                                        <a class="mt-2 inline-flex items-center gap-1.5 font-label-sm text-label-sm font-semibold text-primary hover:underline" href="<?php echo e($isEmail ? 'mailto:' . $message->contact_point : 'https://wa.me/' . preg_replace('/\D/', '', $message->contact_point)); ?>" target="_blank" rel="noopener noreferrer">
                                            <span class="material-symbols-outlined text-[15px]"><?php echo e($isEmail ? 'reply' : 'chat'); ?></span>
                                            <?php echo e($isEmail ? 'Balas via surel' : 'Hubungi via WhatsApp'); ?>

                                        </a>
                                    <?php endif; ?>
                                </details>
                            </td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary">
                                <?php echo e($message->created_at->translatedFormat('d M Y')); ?>

                                <span class="mt-0.5 block text-label-sm text-on-surface-variant"><?php echo e($message->created_at->format('H:i')); ?> WIB</span>
                            </td>
                            <td class="px-5 py-4">
                                <?php if($message->is_read): ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-outline"></span>Dibaca
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-fixed px-3 py-1 font-label-sm text-label-sm font-semibold text-primary-container">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Baru
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('admin.pesan.show', $message)); ?>" class="inline-flex min-h-9 items-center justify-center gap-1 rounded-lg border border-outline-variant px-3 py-1.5 font-label-sm text-label-sm font-semibold text-on-surface hover:bg-surface-container" title="Lihat detail pesan">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        <span class="hidden sm:inline">Detail</span>
                                    </a>
                                    <form action="<?php echo e(route('admin.pesan.destroy', $message)); ?>" method="POST" onsubmit="return confirm(<?php echo e(json_encode('Hapus pesan dari ' . $message->full_name . '?')); ?>)">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-error/30 px-3 py-1.5 font-label-sm text-label-sm font-semibold text-error hover:bg-error-container/30" title="Hapus pesan">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <span class="material-symbols-outlined mb-2 text-4xl text-outline">inbox</span>
                                <p class="font-body-md text-body-md text-secondary">Belum ada pesan masuk dari halaman kontak.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($messages->hasPages()): ?>
            <div class="border-t border-outline-variant/30 px-5 py-4">
                <?php echo e($messages->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/pesan/index.blade.php ENDPATH**/ ?>