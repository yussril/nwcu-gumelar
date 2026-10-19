<?php $__env->startSection('content'); ?>
<style>[x-cloak] { display: none !important; }</style>
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 font-label-caps text-label-caps text-secondary tracking-widest uppercase">
                <span>Pusat Sensus KartaNU Terpusat</span>
                <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                <span class="text-primary font-semibold">Otoritas Sekretariat MWCNU</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight">
                Verifikasi &amp; Keputusan Sensus KartaNU
            </h1>
            <p class="font-body-md text-body-md text-secondary max-w-2xl">
                Persetujuan langsung data pendaftaran warga oleh Sekretariat MWCNU Gumelar untuk penerbitan fisik &amp; digital e-KartaNU.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="window.location.reload()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md font-semibold hover:bg-surface-container transition-all border border-outline-variant/30" title="Muat ulang data terbaru">
                <span class="material-symbols-outlined text-[18px]">sync</span>
                <span>Sinkron Data</span>
            </button>
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" @click="open = !open" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm" aria-haspopup="true" :aria-expanded="open.toString()">
                    <span class="material-symbols-outlined text-[18px]">file_download</span>
                    <span>Ekspor Data</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-cloak class="absolute right-0 z-20 mt-2 w-56 overflow-hidden rounded-xl border border-outline-variant/30 bg-surface-container-lowest shadow-lg">
                    <a href="<?php echo e(route('admin.kartanu.export.pdf')); ?>" target="_blank" rel="noopener" class="flex items-center gap-2.5 px-4 py-2.5 font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-error">picture_as_pdf</span>
                        <span class="flex-1">PDF</span>
                        <span class="font-label-sm text-label-sm text-secondary">Cetak</span>
                    </a>
                    <a href="<?php echo e(route('admin.kartanu.export.excel')); ?>" class="flex items-center gap-2.5 px-4 py-2.5 font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-primary">table_view</span>
                        <span class="flex-1">Excel (CSV)</span>
                        <span class="font-label-sm text-label-sm text-secondary">Unduh</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Terdata -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Total Terdata</span>
                <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px] text-secondary">groups</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="font-headline-xl text-headline-xl text-on-surface font-extrabold leading-none"><?php echo e(number_format($totalCount)); ?></div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">Total data sensus</p>
            </div>
        </div>
        <!-- Antrean MWCNU -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-error-container/20 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="flex items-center justify-between relative">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Antrean MWCNU</span>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span>
                    Perlu Tindakan
                </span>
            </div>
            <div class="mt-4 relative">
                <div class="font-headline-xl text-headline-xl text-error font-extrabold leading-none"><?php echo e($pendingCount); ?></div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">Permohonan verifikasi tertunda</p>
            </div>
        </div>
        <!-- Disetujui / Dicetak -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Disetujui / Dicetak</span>
                <div class="w-10 h-10 rounded-xl bg-primary-fixed/40 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px] text-on-tertiary-container">verified</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="font-headline-xl text-headline-xl text-primary font-extrabold leading-none"><?php echo e(number_format($approvedCount)); ?></div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">
                    <span class="font-semibold text-primary"><?php echo e($totalCount > 0 ? round(($approvedCount / $totalCount) * 100, 1) : 0); ?>%</span> dari total sensus terbit
                </p>
            </div>
        </div>
    </div>

    <!-- Main Data Table Container -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">
        <!-- Toolbar -->
        <div class="p-4 flex flex-col xl:flex-row xl:items-center justify-between gap-3 bg-surface-container-lowest border-b border-outline-variant/20">
            <!-- Filter Tabs - Dengan fungsionalitas filter -->
            <div class="flex items-center gap-6 overflow-x-auto scrollbar-none pb-1 xl:pb-0" id="filter-tabs">
                <button class="filter-tab relative font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="all">
                    Semua Data <span class="font-label-sm text-secondary">(<?php echo e($totalCount); ?>)</span>
                </button>
                <button class="filter-tab font-label-md text-label-md text-primary font-bold whitespace-nowrap py-1 relative active" data-filter="pending">
                    Menunggu Keputusan MWCNU <span class="font-label-sm">(<?php echo e($pendingCount); ?>)</span>
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                </button>
                <button class="filter-tab relative font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="approved">
                    Disetujui <span class="font-label-sm text-secondary">(<?php echo e($approvedCount); ?>)</span>
                </button>
                <button class="filter-tab relative font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="rejected">
                    Ditolak <span class="font-label-sm text-secondary">(<?php echo e($rejectedCount); ?>)</span>
                </button>
            </div>
            <!-- Filters & Search -->
            <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-center">
                <div class="relative">
                    <select class="w-full appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md pl-3 pr-8 py-2 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/30" id="filter-ranting">
                        <option value="">Semua Ranting</option>
                        <?php $__currentLoopData = $branchOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(Str::lower($branch)); ?>"><?php echo e($branch); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span class="material-symbols-outlined text-[16px] text-secondary absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                </div>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary text-[16px]">search</span>
                    <input class="w-full sm:w-64 h-9 pl-9 pr-3 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-secondary focus:outline-none focus:bg-surface-container-lowest transition-all border border-outline-variant/30" id="filter-search" placeholder="Cari NIK atau Nama warga..." type="search">
                </div>
            </div>
        </div>
        <!-- Table Section -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[760px]">
                <thead class="bg-surface-container-low/70">
                    <tr>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Identitas Warga</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Asal Ranting</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Tanggal Masuk</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Status MWCNU</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary text-right" scope="col">Aksi Keputusan</th>
                    </tr>
                </thead>
                <tbody class="font-body-md text-body-md text-on-surface" id="table-body">
                    <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $statusClass = match(true) {
                                in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified']) => 'pending',
                                $record->verification_status === 'issued' => 'approved',
                                $record->verification_status === 'rejected' => 'rejected',
                                default => 'pending',
                            };

                            // Nomor WhatsApp: buang spasi/pemisah, ubah awalan 0 menjadi 62, dan hilangkan tanda +.
                            $waNomor = preg_replace('/[\s\-\.\(\)]/', '', (string) $record->no_whatsapp);
                            if (str_starts_with($waNomor, '+')) {
                                $waNomor = substr($waNomor, 1);
                            } elseif (str_starts_with($waNomor, '0')) {
                                $waNomor = '62'.substr($waNomor, 1);
                            }

                            // Pesan mengikuti status pengajuan (kolom catatan penolakan: verification_note).
                            $waPesan = match ($statusClass) {
                                'approved' => "Assalamu'alaikum Sahabat {$record->name}, alhamdulillah pendaftaran KartaNU Anda telah *DISETUJUI*.",
                                'rejected' => "Assalamu'alaikum Sahabat {$record->name}, mohon maaf pendaftaran KartaNU Anda belum dapat disetujui. Catatan Admin: *".($record->verification_note ?: '-')."*. Mohon untuk memperbaiki data tersebut.",
                                default => "Assalamu'alaikum Sahabat {$record->name}, data pendaftaran KartaNU Anda sedang kami tinjau.",
                            };

                            $waLink = 'https://wa.me/'.$waNomor.'?text='.urlencode($waPesan);
                        ?>
                        <tr class="data-row hover:bg-surface-container-low/40 transition-colors group border-b border-outline-variant/10 last:border-0" data-status="<?php echo e($statusClass); ?>" data-ranting="<?php echo e(Str::lower($record->branch_name)); ?>" data-search="<?php echo e(Str::lower(trim($record->name.' '.$record->nik.' '.$record->nia.' '.$record->branch_name.' '.($record->desa_ranting ?? '')))); ?>">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-fixed text-on-primary-fixed-variant font-headline-sm text-headline-sm flex items-center justify-center font-bold flex-shrink-0">
                                        <?php echo e(strtoupper(substr($record->name, 0, 2))); ?>

                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-headline-sm text-headline-sm text-on-surface font-semibold tracking-tight"><?php echo e($record->name); ?></div>
                                        <div class="font-label-sm text-label-sm text-on-surface tracking-normal font-medium mt-0.5 font-mono">NIK: <?php echo e($record->nik ?: 'Tidak tersedia'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-label-md text-label-md text-on-surface font-medium"><?php echo e($record->branch_name); ?></div>
                                <div class="font-label-sm text-label-sm text-secondary"><?php echo e($record->desa_ranting); ?></div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-label-md text-label-md text-on-surface"><?php echo e($record->created_at->translatedFormat('d M Y')); ?></div>
                                <div class="font-label-sm text-label-sm text-secondary"><?php echo e($record->created_at->format('H:i')); ?> WIB</div>
                            </td>
                            <td class="px-5 py-4">
                                <?php if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified'])): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container/40 text-on-error-container font-label-caps text-label-caps font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-error animate-ping"></span>
                                        Menunggu Keputusan
                                    </span>
                                <?php elseif($record->verification_status === 'issued'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-label-caps text-label-caps font-semibold">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                        Disetujui MWCNU
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-caps text-label-caps font-semibold">
                                        Ditolak
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified'])): ?>
                                        <form action="<?php echo e(route('admin.kartanu.approve', $record)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="bg-primary-container hover:bg-primary text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm font-semibold inline-flex items-center gap-1 shadow-sm transition-all hover:shadow-md" type="submit" title="Setujui pendaftaran">
                                                <span class="material-symbols-outlined text-[14px]">check</span>
                                                <span>Setujui</span>
                                            </button>
                                        </form>
                                        <button onclick="bukaTolak(<?php echo e($record->id); ?>)" class="bg-surface-container-low hover:bg-error-container hover:text-on-error-container text-error px-3 py-1.5 rounded-lg font-label-sm text-label-sm font-semibold inline-flex items-center gap-1 transition-all border border-outline-variant/30" type="button" title="Tolak pendaftaran">
                                            <span class="material-symbols-outlined text-[14px]">close</span>
                                            <span>Tolak</span>
                                        </button>
                                        <a href="<?php echo e(route('admin.kartanu.show', $record)); ?>" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                        <form id="reject-modal-<?php echo e($record->id); ?>" action="<?php echo e(route('admin.kartanu.reject', $record)); ?>" method="POST" style="display: none" class="fixed inset-0 z-[60] items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm" onclick="if (event.target === this) tutupTolak(<?php echo e($record->id); ?>)" role="dialog" aria-modal="true" aria-labelledby="reject-title-<?php echo e($record->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="w-full max-w-md rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-2xl">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-error-container text-on-error-container">
                                                        <span class="material-symbols-outlined text-[22px]">report</span>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <h2 id="reject-title-<?php echo e($record->id); ?>" class="font-headline-sm text-headline-sm font-bold text-on-surface">Tolak Pendaftaran</h2>
                                                        <p class="mt-1 font-body-sm text-body-sm text-secondary">Berikan alasan penolakan untuk <span class="font-semibold text-on-surface"><?php echo e($record->name); ?></span>.</p>
                                                    </div>
                                                    <button type="button" onclick="tutupTolak(<?php echo e($record->id); ?>)" class="ml-auto -mr-1 -mt-1 rounded-lg p-1.5 text-secondary hover:bg-surface-container-low hover:text-on-surface" aria-label="Tutup">
                                                        <span class="material-symbols-outlined text-[20px]">close</span>
                                                    </button>
                                                </div>

                                                <label class="mt-5 block font-label-sm text-label-sm font-semibold text-on-surface" for="verification-note-<?php echo e($record->id); ?>">Catatan Penolakan</label>
                                                <textarea id="verification-note-<?php echo e($record->id); ?>" name="verification_note" required maxlength="255" rows="4" class="mt-2 w-full rounded-xl border border-outline-variant bg-surface-container-low px-3.5 py-3 font-body-md text-body-md text-on-surface placeholder:text-secondary focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10" placeholder="Contoh: NIK tidak sesuai dengan KTP, mohon perbaiki data tersebut..."></textarea>

                                                <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                                    <button type="button" onclick="tutupTolak(<?php echo e($record->id); ?>)" class="inline-flex items-center justify-center rounded-xl border border-outline-variant px-4 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container-low">Batal</button>
                                                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-error px-4 py-2.5 font-label-md text-label-md font-semibold text-white shadow-sm hover:bg-error/90">
                                                        <span class="material-symbols-outlined text-[18px]">block</span>
                                                        Tolak Pendaftaran
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php elseif($record->verification_status === 'issued'): ?>
                                        <a href="<?php echo e(route('admin.kartanu.show', $record)); ?>" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                    <?php elseif($record->verification_status === 'rejected' && $record->verification_note): ?>
                                        <span class="font-label-sm text-label-sm text-error"><?php echo e(Str::limit($record->verification_note, 30)); ?></span>
                                        <a href="<?php echo e(route('admin.kartanu.show', $record)); ?>" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($waNomor !== ''): ?>
                                        <a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-[#25D366] hover:bg-[#20bd5a] text-white p-1.5 rounded-md transition-colors shadow-sm ml-1" title="Hubungi via WhatsApp" aria-label="Hubungi <?php echo e($record->name); ?> via WhatsApp">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-12 text-center font-body-md text-body-md text-secondary">Belum ada data sensus KartaNU.</td></tr>
                    <?php endif; ?>
                    
                    <tr class="hidden" id="filter-kosong">
                        <td colspan="5" class="py-12 text-center font-body-md text-body-md text-secondary">Tidak ada data yang cocok dengan filter saat ini.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Footer / Pagination -->
        <?php if($records->hasPages()): ?>
            <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-surface-container-lowest border-t border-outline-variant/20">
                <span class="font-label-md text-label-md text-secondary">
                    Menampilkan <span class="font-semibold text-on-surface"><?php echo e($records->firstItem()); ?>-<?php echo e($records->lastItem()); ?></span> dari <span class="font-semibold text-on-surface"><?php echo e($records->total()); ?></span> data
                </span>
                <div class="flex items-center gap-1">
                    <?php echo e($records->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(session('status')): ?>
    <div class="fixed bottom-6 right-6 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container shadow-lg" role="status"><?php echo e(session('status')); ?></div>
<?php endif; ?>
<script>
    // Modal penolakan: dipanggil langsung dari atribut onclick tiap baris.
    function bukaTolak(id) {
        const modal = document.getElementById('reject-modal-' + id);
        if (!modal) return;

        modal.style.display = 'flex';
        document.body.classList.add('overflow-hidden');

        const catatan = modal.querySelector('textarea');
        if (catatan) {
            setTimeout(function () { catatan.focus(); }, 30);
        }
    }

    function tutupTolak(id) {
        const modal = document.getElementById('reject-modal-' + id);
        if (!modal) return;

        modal.style.display = 'none';

        const masihTerbuka = Array.prototype.some.call(
            document.querySelectorAll('[id^="reject-modal-"]'),
            function (item) { return item.style.display === 'flex'; }
        );

        if (!masihTerbuka) {
            document.body.classList.remove('overflow-hidden');
        }
    }

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;

        document.querySelectorAll('[id^="reject-modal-"]').forEach(function (modal) {
            modal.style.display = 'none';
        });
        document.body.classList.remove('overflow-hidden');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const filterTabs = document.querySelectorAll('.filter-tab');
        const dataRows = document.querySelectorAll('.data-row');
        const rantingSelect = document.getElementById('filter-ranting');
        const searchInput = document.getElementById('filter-search');
        const kosong = document.getElementById('filter-kosong');

        // Satu fungsi untuk ketiga kontrol (tab status, ranting, pencarian)
        // supaya mereka salingffects dan tidak perlu saling Override.
        const terapkanFilter = function () {
            const status = (document.querySelector('.filter-tab.active') || {}).dataset;
            const statusAktif = status ? status.filter : 'all';
            const ranting = rantingSelect ? rantingSelect.value : '';
            const cari = searchInput ? searchInput.value.trim().toLowerCase() : '';

            let tampil = 0;
            dataRows.forEach(row => {
                const cocokStatus = statusAktif === 'all' || row.dataset.status === statusAktif;
                const cocokRanting = !ranting || row.dataset.ranting === ranting;
                const cocokCari = !cari || (row.dataset.search || '').includes(cari);
                const tampilkan = cocokStatus && cocokRanting && cocokCari;
                row.style.display = tampilkan ? '' : 'none';
                if (tampilkan) tampil++;
            });

            if (kosong) kosong.classList.toggle('hidden', tampil > 0);
        };

        const aktifkanTab = function (tab) {
            filterTabs.forEach(t => {
                t.classList.remove('text-primary', 'font-bold', 'active');
                t.classList.add('text-secondary');
                const indicator = t.querySelector('.absolute.bottom-0');
                if (indicator) indicator.remove();
            });

            tab.classList.remove('text-secondary');
            tab.classList.add('relative', 'text-primary', 'font-bold', 'active');

            if (!tab.querySelector('.absolute.bottom-0')) {
                const indicator = document.createElement('span');
                indicator.className = 'absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full';
                tab.appendChild(indicator);
            }
        };

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                aktifkanTab(this);
                terapkanFilter();
            });
        });

        if (rantingSelect) rantingSelect.addEventListener('change', terapkanFilter);
        if (searchInput) searchInput.addEventListener('input', terapkanFilter);

        // Terapkan filter sesuai tab yang aktif saat halaman dibuka. Tanpa ini
        // tabel menampilkan seluruh baris padahal tab "Menunggu Keputusan"
        // sudah aktif sejak server, sehingga angka dan isi tabel tidak cocok.
        aktifkanTab(document.querySelector('.filter-tab.active') || filterTabs[0]);
        terapkanFilter();

        // Modal penolakan ditutup lewat backdrop, tombol Batal, tombol X, atau Escape.
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kartanu/index.blade.php ENDPATH**/ ?>