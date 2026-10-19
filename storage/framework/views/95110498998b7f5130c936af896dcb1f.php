<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title); ?></title>
    <style>
        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: #191c1e;
            font-family: 'Plus Jakarta Sans', Arial, Helvetica, sans-serif;
            font-size: 11px;
            line-height: 1.35;
        }

        h1 {
            margin: 0;
            font-size: 18px;
            letter-spacing: -0.02em;
        }

        .muted { color: #5c647a; }

        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 10px;
            margin-bottom: 12px;
            border-bottom: 2px solid #064e3b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #eceef0;
            border: 1px solid #bfc9c3;
            padding: 6px 7px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        tbody td {
            border: 1px solid #d8dadc;
            padding: 6px 7px;
            vertical-align: top;
        }

        tbody tr:nth-child(even) td { background: #f7f9fb; }

        .nowrap { white-space: nowrap; }

        .badge {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge--pending { background: #ffdad6; color: #93000a; }
        .badge--approved { background: #b0f0d6; color: #002117; }
        .badge--rejected { background: #e0e3e5; color: #404944; }

        .actions {
            margin-bottom: 12px;
            display: flex;
            gap: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border: 1px solid #bfc9c3;
            border-radius: 8px;
            background: #ffffff;
            color: #191c1e;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        @media print {
            .actions { display: none; }
            thead { display: table-header-group; }
            tr { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="actions">
        <button class="btn" type="button" onclick="window.print()">Cetak / Simpan PDF</button>
        <button class="btn" type="button" onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <div>
            <h1>Data Sensus KartaNU</h1>
            <div class="muted">MWCNU Kecamatan Gumelar &middot; Portal Admin</div>
        </div>
        <div class="muted" style="text-align: right;">
            Dicetak: <?php echo e($printedAt->translatedFormat('d F Y, H:i')); ?> WIB<br>
            Total: <?php echo e(number_format($records->count())); ?> data
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 28px;">No</th>
                <th>Nama</th>
                <th>NIA</th>
                <th>NIK</th>
                <th>Ranting</th>
                <th>Desa/Ranting</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>No. WhatsApp</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $statusClass = match ($record->verification_status) {
                        'issued' => 'approved',
                        'rejected' => 'rejected',
                        default => 'pending',
                    };
                ?>
                <tr>
                    <td class="nowrap"><?php echo e($index + 1); ?></td>
                    <td><?php echo e($record->name); ?></td>
                    <td class="nowrap"><?php echo e($record->nia); ?></td>
                    <td class="nowrap"><?php echo e($record->nik ?: '—'); ?></td>
                    <td><?php echo e($record->branch_name); ?></td>
                    <td><?php echo e($record->desa_ranting ?: '—'); ?></td>
                    <td>
                        <?php echo e($record->birth_place ?: '—'); ?>

                        <?php if($record->birth_date): ?>
                            , <?php echo e($record->birth_date->format('d-m-Y')); ?>

                        <?php endif; ?>
                    </td>
                    <td class="nowrap"><?php echo e($record->no_whatsapp ?: '—'); ?></td>
                    <td>
                        <span class="badge badge--<?php echo e($statusClass); ?>"><?php echo e($record->verificationLabel()); ?></span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" style="text-align: center; padding: 24px;">Belum ada data KartaNU.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>
</body>
</html>
<?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/admin/kartanu/export-pdf.blade.php ENDPATH**/ ?>