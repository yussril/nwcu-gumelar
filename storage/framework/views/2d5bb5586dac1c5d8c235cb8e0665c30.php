<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak KartaNU - <?php echo e($record->name); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#003527',
                        'primary-container': '#064e3b',
                        'on-primary': '#ffffff',
                        'primary-fixed': '#b0f0d6',
                        'on-primary-fixed': '#002117',
                        'on-primary-fixed-variant': '#0b513d',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f2f4f6',
                        'surface-container': '#eceef0',
                        'on-surface': '#191c1e',
                        'on-surface-variant': '#404944',
                        'outline-variant': '#bfc9c3',
                        'secondary': '#565e74',
                        'tertiary-container': '#004f34',
                        'on-tertiary-container': '#31c98f',
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            @page { size: A4; margin: 0; }
        }
        .card-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hologram {
            background: linear-gradient(135deg, rgba(176,240,214,0.3) 0%, rgba(176,240,214,0.1) 50%, rgba(176,240,214,0.3) 100%);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 print:p-0">
    <!-- Print Button (Hidden when printing) -->
    <div class="no-print fixed top-4 right-4 flex gap-2 z-50">
        <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-container transition-colors shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            <span class="font-semibold">Cetak Kartu</span>
        </button>
        <a href="<?php echo e(route('admin.kartanu.show', $record)); ?>" class="flex items-center gap-2 px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors shadow-lg border border-gray-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="font-semibold">Kembali</span>
        </a>
    </div>

    <!-- KartaNU Card -->
    <div class="w-full max-w-[850px] bg-white rounded-2xl shadow-2xl overflow-hidden print:shadow-none print:rounded-none print:max-w-none">
        <!-- Card Header -->
        <div class="bg-primary card-pattern p-6 print:p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center p-2">
                        <img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo MWCNU" class="w-full h-full object-contain filter brightness-0 invert">
                    </div>
                    <div class="text-white">
                        <h1 class="text-2xl font-bold tracking-tight">KARTA NU</h1>
                        <p class="text-white/70 text-sm tracking-widest uppercase">Nahdlatul Ulama</p>
                    </div>
                </div>
                <div class="text-right text-white">
                    <p class="text-xs text-white/60 uppercase tracking-wider">Kecamatan</p>
                    <p class="font-bold text-lg">GUMELAR</p>
                    <p class="text-xs text-white/60">Kab. Banyumas</p>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6 print:p-4">
            <div class="flex gap-6">
                <!-- Photo Section -->
                <div class="flex-shrink-0">
                    <div class="w-36 h-44 bg-surface-container-low rounded-xl overflow-hidden border-2 border-outline-variant/30">
                        <?php if($record->photo_path): ?>
                            <img src="<?php echo e($record->photoUrl()); ?>" alt="Foto <?php echo e($record->name); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-primary-fixed">
                                <span class="text-4xl font-bold text-primary-container"><?php echo e(strtoupper(substr($record->name, 0, 2))); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- QR Code Placeholder -->
                    <div class="mt-3 w-36 h-36 bg-white border-2 border-outline-variant/30 rounded-xl flex items-center justify-center p-2">
                        <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                                <p class="text-[8px] text-gray-500 mt-1">Scan untuk verifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="flex-1 space-y-4">
                    <!-- Name & NIA -->
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider">Nama Lengkap</p>
                        <h2 class="text-xl font-bold text-on-surface"><?php echo e($record->name); ?></h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">NIA</p>
                            <p class="font-mono font-semibold text-on-surface"><?php echo e($record->nia); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">Kode Registrasi</p>
                            <p class="font-mono font-semibold text-on-surface text-sm"><?php echo e($record->registration_code); ?></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">Tempat, Tanggal Lahir</p>
                            <p class="font-medium text-on-surface"><?php echo e($record->birth_place ?? '-'); ?>, <?php echo e($record->birth_date?->translatedFormat('d M Y') ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">Jenis Kelamin</p>
                            <p class="font-medium text-on-surface"><?php echo e($record->jenis_kelamin ?? '-'); ?></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider">Alamat</p>
                        <p class="font-medium text-on-surface"><?php echo e($record->alamat_lengkap ?? '-'); ?></p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">Asal Ranting</p>
                            <p class="font-medium text-on-surface"><?php echo e($record->branch_name); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider">Desa Ranting</p>
                            <p class="font-medium text-on-surface"><?php echo e($record->desa_ranting ?? '-'); ?></p>
                        </div>
                    </div>

                    <!-- Validity Period -->
                    <div class="bg-surface-container-low rounded-xl p-3 border border-outline-variant/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider">Masa Berlaku</p>
                                <p class="font-semibold text-on-surface">
                                    <?php echo e($record->valid_from?->translatedFormat('d M Y') ?? '—'); ?> s/d <?php echo e($record->valid_until?->translatedFormat('d M Y') ?? '—'); ?>

                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider">Status</p>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed-variant text-xs font-bold">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    AKTIF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="bg-surface-container-low border-t border-outline-variant/20 p-4 print:p-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="hologram w-10 h-10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-container" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant">Kartu ini diterbitkan oleh</p>
                        <p class="font-semibold text-on-surface text-sm">MWCNU Kecamatan Gumelar</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-on-surface-variant">Diterbitkan pada</p>
                    <p class="font-semibold text-on-surface text-sm"><?php echo e($record->updated_at->translatedFormat('d M Y')); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Instructions (Hidden when printing) -->
    <div class="no-print fixed bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-lg shadow-lg px-4 py-2 text-sm text-gray-600 border border-gray-200">
        <p class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Gunakan tombol "Cetak Kartu" atau tekan Ctrl+P untuk mencetak
        </p>
    </div>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kartanu/print.blade.php ENDPATH**/ ?>