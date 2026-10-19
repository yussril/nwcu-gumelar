<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'record',
    'sisi' => 'depan',
    'qrSvg' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'record',
    'sisi' => 'depan',
    'qrSvg' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>



<?php if($sisi === 'belakang'): ?>
    <article class="kartu kartu--belakang">
        <header class="kartu__kepala kartu__kepala--ringkas">
            <span class="kartu__logo"><img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo Nahdlatul Ulama"></span>
            <div class="kartu__nama">
                <p class="kartu__nama-utama">Kartu Tanda Anggota</p>
                <p class="kartu__nama-sub">Nahdlatul Ulama</p>
            </div>
            <div class="kartu__wilayah">
                <span>Kode Registrasi</span>
                <strong><?php echo e($record->registration_code); ?></strong>
            </div>
        </header>

        <div class="kartu__badan kartu__badan--belakang">
            <div class="kartu__qr">
                <div class="kartu__qr-kotak"><?php echo $qrSvg; ?></div>
                <p>Scan untuk verifikasi</p>
            </div>

            <div class="kartu__data kartu__data--belakang">
                <div class="bidang">
                    <p class="bidang__label">Kode Registrasi</p>
                    <p class="bidang__nilai mononowrap"><?php echo e($record->registration_code); ?></p>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">NIA</p>
                        <p class="bidang__nilai mono nowrap"><?php echo e($record->nia ?: '—'); ?></p>
                    </div>
                    <div class="bidang">
                        <p class="bidang__label">NIK</p>
                        <p class="bidang__nilai mono nowrap"><?php echo e($record->nik ?: '—'); ?></p>
                    </div>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">Tempat, Tgl Lahir</p>
                        <p class="bidang__nilai nowrap"><?php echo e($record->birth_place ?: '—'); ?>, <?php echo e($record->tanggalIndonesia($record->birth_date)); ?></p>
                    </div>
                    <div class="bidang bidang--sempit">
                        <p class="bidang__label">Jenis Kelamin</p>
                        <p class="bidang__nilai"><?php echo e($record->jenis_kelamin ? $record->jenisKelaminLabel() : '—'); ?></p>
                    </div>
                </div>

                <div class="bidang">
                    <p class="bidang__label">Alamat</p>
                    <p class="bidang__nilai potong"><?php echo e($record->alamat_lengkap ?: '—'); ?></p>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">Asal Ranting</p>
                        <p class="bidang__nilai potong potong-1"><?php echo e($record->branch_name); ?></p>
                    </div>
                    <div class="bidang">
                        <p class="bidang__label">Desa Ranting</p>
                        <p class="bidang__nilai potong potong-1"><?php echo e($record->desa_ranting ?: '—'); ?></p>
                    </div>
                </div>

                <div class="baris">
                    <div class="bidang bidang--sempit">
                        <p class="bidang__label">No. WhatsApp</p>
                        <p class="bidang__nilai mono nowrap"><?php echo e($record->no_whatsapp ?: '—'); ?></p>
                    </div>
                    <div class="bidang bidang--sempit">
                        <p class="bidang__label">Masa Berlaku</p>
                        <p class="bidang__nilai nowrap"><?php echo e($record->tanggalIndonesia($record->valid_from, 'd M y')); ?> s/d <?php echo e($record->tanggalIndonesia($record->valid_until, 'd M y')); ?></p>
                    </div>
                </div>

                <p class="kartu__catatan">
                    Kartu ini merupakan bukti keanggotaan MWCNU Kecamatan Gumelar dan tidak dapat dipindahtangankan.
                    Kerusakan atau kehilangan kartu segera dilaporkan ke sekretariat MWCNU Gumelar.
                </p>
            </div>
        </div>

        <footer class="kartu__kaki kartu__kaki--belakang">
            <p>MWCNU Kecamatan Gumelar<strong>Gedung Bersama MWCNU Gumelar, Jl. Raya Gumelar No. 09, Gumelar, Banyumas</strong></p>
            <p class="kartu__kaki-teks">Sekretariat<strong>sekretariat@mwcnu-gumelar.or.id</strong></p>
        </footer>
    </article>
<?php else: ?>
    <article class="kartu kartu--depan">
        <header class="kartu__kepala">
            <span class="kartu__logo"><img src="<?php echo e(asset('images/logo-nu-40178.png')); ?>" alt="Logo Nahdlatul Ulama"></span>
            <div class="kartu__nama">
                <p class="kartu__nama-utama">Karta NU</p>
                <p class="kartu__nama-sub">Nahdlatul Ulama</p>
            </div>
            <div class="kartu__wilayah">
                <span>Kecamatan</span>
                <strong>Gumelar</strong>
                <span>Kab. Banyumas</span>
            </div>
        </header>

        <div class="kartu__badan">
            <div class="kartu__foto">
                <?php if($record->photoUrl()): ?>
                    <img src="<?php echo e($record->photoUrl()); ?>" alt="Foto <?php echo e($record->name); ?>" onerror="this.remove()">
                <?php else: ?>
                    <span><?php echo e(Str::of($record->name)->substr(0, 2)->upper()); ?></span>
                <?php endif; ?>
            </div>

            <div class="kartu__data">
                <div class="bidang bidang--nama">
                    <p class="bidang__label">Nama Lengkap</p>
                    <p class="bidang__nilai potong potong-1"><?php echo e($record->name); ?></p>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">NIA</p>
                        <p class="bidang__nilai mono potong potong-1"><?php echo e($record->nia ?: '—'); ?></p>
                    </div>
                    <div class="bidang">
                        <p class="bidang__label">NIK</p>
                        <p class="bidang__nilai mono potong potong-1"><?php echo e($record->nik ?: '—'); ?></p>
                    </div>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">Tempat, Tgl Lahir</p>
                        <p class="bidang__nilai"><?php echo e($record->birth_place ?: '—'); ?>, <?php echo e($record->tanggalIndonesia($record->birth_date)); ?></p>
                    </div>
                    <div class="bidang bidang--sempit">
                        <p class="bidang__label">Jenis Kelamin</p>
                        <p class="bidang__nilai potong potong-1"><?php echo e($record->jenis_kelamin ? $record->jenisKelaminLabel() : '—'); ?></p>
                    </div>
                </div>

                <div class="bidang">
                    <p class="bidang__label">Alamat</p>
                    <p class="bidang__nilai potong"><?php echo e($record->alamat_lengkap ?: '—'); ?></p>
                </div>

                <div class="baris">
                    <div class="bidang">
                        <p class="bidang__label">Asal Ranting</p>
                        <p class="bidang__nilai potong potong-1"><?php echo e($record->branch_name); ?></p>
                    </div>
                    <div class="bidang">
                        <p class="bidang__label">Desa Ranting</p>
                        <p class="bidang__nilai potong potong-1"><?php echo e($record->desa_ranting ?: '—'); ?></p>
                    </div>
                </div>

                <div class="kartu__berlaku">
                    <div class="bidang">
                        <p class="bidang__label">Masa Berlaku</p>
                        <p class="bidang__nilai"><?php echo e($record->tanggalIndonesia($record->valid_from)); ?> s/d <?php echo e($record->tanggalIndonesia($record->valid_until)); ?></p>
                    </div>
                    <span class="kartu__status">Aktif</span>
                </div>
            </div>
        </div>

        <footer class="kartu__kaki">
            <p>Kartu ini diterbitkan oleh<strong>MWCNU Kecamatan Gumelar</strong></p>
            <p class="text-right">Diterbitkan pada<strong><?php echo e($record->tanggalIndonesia($record->updated_at, 'd F Y')); ?></strong></p>
        </footer>
    </article>
<?php endif; ?><?php /**PATH /home/laptoptempur/laravelCuy/nwcu-gumelar/resources/views/components/kartu-anggota.blade.php ENDPATH**/ ?>