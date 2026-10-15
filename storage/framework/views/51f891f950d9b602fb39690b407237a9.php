<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('admin.kartanu.index')); ?>" class="p-2 rounded-lg hover:bg-surface-container-low transition-colors" title="Kembali">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Detail KartaNU</h1>
                <p class="font-body-sm text-body-sm text-secondary mt-0.5">Informasi lengkap data sensus KartaNU</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <?php if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified'])): ?>
                <form action="<?php echo e(route('admin.kartanu.approve', $record)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all" type="submit">
                        <span class="material-symbols-outlined text-[16px]">check</span>
                        <span>Setujui</span>
                    </button>
                </form>
                <button onclick="document.getElementById('reject-form').classList.toggle('hidden')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-surface-container-low text-error font-label-md text-label-md font-semibold hover:bg-error-container transition-all" type="button">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                    <span>Tolak</span>
                </button>
            <?php elseif($record->verification_status === 'issued'): ?>
                <a href="<?php echo e(route('admin.kartanu.print', $record)); ?>" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">print</span>
                    <span>Cetak Kartu</span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Reject Form (Hidden by default) -->
    <?php if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified'])): ?>
        <div id="reject-form" class="hidden rounded-xl border border-error-container/50 bg-error-container/20 p-4">
            <form action="<?php echo e(route('admin.kartanu.reject', $record)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <label class="block font-label-sm text-label-sm font-semibold text-on-surface mb-2">Catatan Penolakan</label>
                <textarea name="verification_note" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-secondary focus:outline-none focus:border-primary" placeholder="Alasan penolakan..." rows="3"></textarea>
                <div class="flex justify-end gap-2 mt-3">
                    <button type="button" onclick="document.getElementById('reject-form').classList.add('hidden')" class="px-3 py-1.5 text-sm text-secondary hover:text-on-surface">Batal</button>
                    <button type="submit" class="px-3 py-1.5 text-sm bg-error text-white rounded-lg hover:bg-error/90">Tolak</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Photo & Quick Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Photo Card -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 overflow-hidden shadow-sm">
                <div class="aspect-square bg-surface-container-low flex items-center justify-center">
                    <?php if($record->photo_path): ?>
                        <img src="<?php echo e($record->photoUrl()); ?>" alt="Foto <?php echo e($record->name); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-24 h-24 rounded-full bg-primary-fixed flex items-center justify-center">
                            <span class="font-headline-lg text-headline-lg text-primary-container font-bold"><?php echo e(strtoupper(substr($record->name, 0, 2))); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Status</span>
                        <?php if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified'])): ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container/40 text-on-error-container font-label-caps text-label-caps font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span>
                                Menunggu
                            </span>
                        <?php elseif($record->verification_status === 'issued'): ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-label-caps text-label-caps font-semibold">
                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                Disetujui
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-caps text-label-caps font-semibold">
                                Ditolak
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Registration Info -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-5 shadow-sm">
                <h3 class="font-label-md text-label-md font-semibold text-on-surface mb-3">Informasi Registrasi</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="font-body-sm text-body-sm text-secondary">Kode Registrasi</span>
                        <span class="font-label-sm text-label-sm font-mono text-on-surface"><?php echo e($record->registration_code); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-body-sm text-body-sm text-secondary">Tanggal Daftar</span>
                        <span class="font-label-sm text-label-sm text-on-surface"><?php echo e($record->created_at->translatedFormat('d M Y')); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-body-sm text-body-sm text-secondary">NIA</span>
                        <span class="font-label-sm text-label-sm text-on-surface"><?php echo e($record->nia); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Detailed Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-sm">
                <h3 class="font-label-md text-label-md font-semibold text-on-surface mb-4">Data Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Nama Lengkap</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->name); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">NIK</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->maskedNik()); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Tempat Lahir</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->birth_place ?? '-'); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Tanggal Lahir</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->birth_date?->translatedFormat('d M Y') ?? '-'); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Jenis Kelamin</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->jenis_kelamin ?? '-'); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">No. WhatsApp</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->no_whatsapp ?? '-'); ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Alamat Lengkap</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->alamat_lengkap ?? '-'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Branch Information -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-sm">
                <h3 class="font-label-md text-label-md font-semibold text-on-surface mb-4">Data Ranting</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Asal Ranting</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->branch_name); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Desa Ranting</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->desa_ranting ?? '-'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Verification Information -->
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-sm">
                <h3 class="font-label-md text-label-md font-semibold text-on-surface mb-4">Informasi Verifikasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Status Verifikasi</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->verificationLabel()); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Progres Verifikasi</span>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-1 h-2 rounded-full bg-surface-container">
                                <div class="h-full rounded-full bg-primary-container" style="width: <?php echo e($record->verificationProgress() * 20); ?>%"></div>
                            </div>
                            <span class="font-label-sm text-label-sm text-secondary"><?php echo e($record->verificationProgress() * 20); ?>%</span>
                        </div>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Berlaku Dari</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->valid_from?->translatedFormat('d M Y') ?? '-'); ?></p>
                    </div>
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Berlaku Sampai</span>
                        <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->valid_until?->translatedFormat('d M Y') ?? '-'); ?></p>
                    </div>
                    <?php if($record->verification_note): ?>
                        <div class="md:col-span-2">
                            <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider">Catatan Verifikasi</span>
                            <p class="font-body-md text-body-md text-on-surface mt-1"><?php echo e($record->verification_note); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(session('status')): ?>
    <div class="fixed bottom-6 right-6 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container shadow-lg" role="status"><?php echo e(session('status')); ?></div>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectButtons = document.querySelectorAll('[onclick*="reject-form"]');
        rejectButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        document.addEventListener('click', function(e) {
            const form = document.getElementById('reject-form');
            if (form && !form.contains(e.target) && !form.classList.contains('hidden')) {
                form.classList.add('hidden');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kartanu/show.blade.php ENDPATH**/ ?>