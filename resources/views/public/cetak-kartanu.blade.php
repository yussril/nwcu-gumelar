<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak KartaNU - {{ $record->name }}</title>
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
                        secondary: '#565e74',
                    }
                }
            }
        }
    </script>
    <style>
        /* ---------- Kertas A4: 1 kartu (depan + belakang) ---------- */
        .lembar {
            --hijau: #003527;
            --hijau-muda: #064e3b;
            --hijau-terang: #b0f0d6;
            --garis: #bfc9c3;
            --tinta: #191c1e;
            --tinta-lembut: #404944;
            --abu: #f2f4f6;

            position: relative;
            box-sizing: border-box;
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 12mm 14mm;
            overflow: hidden;
            background: #fff;
            color: var(--tinta);
            font-family: 'Inter', 'Plus Jakarta Sans', system-ui, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10mm;
            transform-origin: top center;
        }

        @media screen {
            body { background: #eceef0; }
            .lembar { box-shadow: 0 20px 50px rgba(15, 23, 42, .22); }
        }

        /* Catatan di dalam kertas (ikut tercetak, terpotong saat digunting) */
        .lembar__catatan {
            font-size: 6.5pt;
            line-height: 1.45;
            color: var(--tinta-lembut);
            text-align: center;
        }
        .lembar__catatan strong { color: var(--hijau); font-weight: 700; }
        .lembar__catatan--bawah { border-top: .25mm dashed var(--garis); padding-top: 2.5mm; }

        .lembar__grup { display: flex; flex-direction: column; gap: 22mm; }

        /* ---------- Petak gunting ---------- */
        .petak__label {
            width: fit-content;
            margin: 0 auto 1.2mm;
            font-size: 6pt;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--tinta-lembut);
            display: flex;
            align-items: center;
            gap: 1.5mm;
        }
        .petak__label strong { color: var(--hijau); }
        .pandu {
            box-sizing: border-box;
            width: fit-content;
            margin: 0 auto;
            padding: 2mm;
            border: .25mm dashed #8c9a93;
        }

        /* ---------- Kartu 85 x 55 mm ---------- */
        .kartu {
            box-sizing: border-box;
            width: 85mm;
            height: 55mm;
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .kartu__kepala {
            box-sizing: border-box;
            height: 11mm;
            padding: 1.5mm 2.6mm;
            background: var(--hijau);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            color: #fff;
            display: flex;
            align-items: center;
            gap: 2mm;
        }
        .kartu__logo {
            flex: 0 0 auto;
            width: 7mm;
            height: 7mm;
            padding: .7mm;
            box-sizing: border-box;
            border-radius: 1.2mm;
            background: rgba(255, 255, 255, .12);
        }
        .kartu__logo img { width: 100%; height: 100%; object-fit: contain; filter: brightness(0) invert(1); }
        .kartu__nama { min-width: 0; line-height: 1.05; }
        .kartu__nama-utama { font-size: 9pt; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; white-space: nowrap; }
        .kartu__nama-sub { font-size: 4.4pt; letter-spacing: .16em; text-transform: uppercase; color: rgba(255, 255, 255, .72); white-space: nowrap; }
        .kartu__wilayah { margin-left: auto; text-align: right; line-height: 1.1; }
        .kartu__wilayah span { display: block; font-size: 4.2pt; letter-spacing: .1em; text-transform: uppercase; color: rgba(255, 255, 255, .62); }
        .kartu__wilayah strong { display: block; font-size: 7pt; font-weight: 800; text-transform: uppercase; }

        .kartu__badan {
            box-sizing: border-box;
            flex: 1 1 auto;
            padding: 1.8mm 2.6mm;
            display: flex;
            gap: 2.4mm;
            overflow: hidden;
        }

        .kartu__foto {
            flex: 0 0 auto;
            width: 20mm;
            height: 27mm;
            border: .25mm solid var(--garis);
            border-radius: 1mm;
            background: var(--hijau-terang);
            overflow: hidden;
            position: relative;
        }
        .kartu__foto img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .kartu__foto span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-size: 11pt;
            font-weight: 800;
            color: var(--hijau-muda);
        }

        .kartu__data { flex: 1 1 auto; min-width: 0; display: flex; flex-direction: column; gap: .9mm; }

        .baris { display: flex; gap: 2mm; }
        .baris > * { flex: 1 1 0; min-width: 0; }

        .bidang { min-width: 0; }
        .bidang__label {
            margin: 0;
            font-size: 4.2pt;
            line-height: 1.1;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--tinta-lembut);
        }
        .bidang__nilai {
            margin: 0;
            font-size: 6pt;
            line-height: 1.2;
            font-weight: 600;
            color: var(--tinta);
            overflow-wrap: anywhere;
        }
        .bidang__nilai.mono { font-family: 'SFMono-Regular', ui-monospace, Menlo, Consolas, monospace; letter-spacing: .01em; }
        .bidang__nilai.nowrap, .bidang__nilai.mononowrap { white-space: nowrap; overflow-wrap: normal; }
        .bidang__nilai.mononowrap { font-family: 'SFMono-Regular', ui-monospace, Menlo, Consolas, monospace; letter-spacing: .04em; }
        .bidang--nama .bidang__nilai { font-size: 7.6pt; font-weight: 800; text-transform: uppercase; line-height: 1.1; }
        .bidang--sempit .bidang__nilai { font-size: 5.6pt; }
        .potong {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }
        .potong-1 { -webkit-line-clamp: 1; }

        .kartu__berlaku {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5mm;
            padding: .9mm 1.4mm;
            border: .25mm solid var(--garis);
            border-radius: 1mm;
            background: var(--abu);
        }
        .kartu__status {
            flex: 0 0 auto;
            padding: .3mm 1.2mm;
            border-radius: 20mm;
            background: var(--hijau-terang);
            color: #0b513d;
            font-size: 4.6pt;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .kartu__kaki {
            box-sizing: border-box;
            height: 8mm;
            padding: 1.2mm 2.6mm;
            border-top: .25mm solid var(--garis);
            background: var(--abu);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2mm;
            font-size: 4.4pt;
            line-height: 1.25;
            color: var(--tinta-lembut);
        }
        .kartu__kaki strong { display: block; font-size: 5.2pt; color: var(--tinta); }
        .kartu__kaki-teks { text-align: right; white-space: nowrap; }
        .kartu__kaki--belakang { height: 7.5mm; }
        .kartu__kaki--belakang strong { font-size: 4.6pt; font-weight: 600; }

        /* ---------- Sisi belakang ---------- */
        .kartu__kepala--ringkas { height: 9mm; }
        .kartu__kepala--ringkas .kartu__nama-utama { font-size: 6.6pt; }
        .kartu__kepala--ringkas .kartu__logo { width: 6mm; height: 6mm; }
        .kartu__kepala--ringkas .kartu__wilayah strong { font-size: 5pt; letter-spacing: 0; white-space: nowrap; }
        .kartu__badan--belakang { gap: 2.6mm; }
        .kartu__qr { flex: 0 0 auto; width: 21mm; text-align: center; }
        .kartu__qr-kotak {
            width: 21mm;
            height: 21mm;
            padding: .8mm;
            box-sizing: border-box;
            border: .25mm solid var(--garis);
            border-radius: 1mm;
            background: #fff;
        }
        .kartu__qr-kotak svg { width: 100%; height: 100%; display: block; }
        .kartu__qr p { margin: .8mm 0 0; font-size: 4pt; line-height: 1.25; color: var(--tinta-lembut); }
        .kartu__data--belakang { gap: .6mm; }
        .kartu__data--belakang .bidang__nilai { font-size: 5.8pt; }
        .kartu__catatan {
            margin: auto 0 0;
            padding-top: .8mm;
            border-top: .25mm solid var(--garis);
            font-size: 4pt;
            line-height: 1.3;
            color: var(--tinta-lembut);
        }

        @page { size: A4 portrait; margin: 0; }

        @media print {
            html, body { margin: 0 !important; padding: 0 !important; background: #fff !important; }
            .no-print { display: none !important; }
            .pratinjau { padding: 0 !important; background: #fff !important; }
            .lembar { box-shadow: none !important; margin: 0 auto; transform: none !important; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Toolbar (tidak ikut tercetak) -->
    <header class="no-print bg-primary text-white">
        <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-4 py-3.5">
            <div class="flex items-center gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 p-1.5">
                    <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU" class="h-full w-full object-contain brightness-0 invert">
                </span>
                <div>
                    <h1 class="text-sm font-bold uppercase tracking-tight leading-tight">Unduh &amp; Cetak e-KartaNU</h1>
                    <p class="text-[11px] text-white/70">1 kertas A4 · 1 kartu (depan &amp; belakang) · {{ $record->name }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('kartanu') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3.5 py-2.5 text-xs font-semibold transition-colors hover:bg-white/20">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Halaman KartaNU
                </a>
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg bg-white px-4 py-2.5 text-xs font-bold text-primary transition-colors hover:bg-primary-fixed">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"></path></svg>
                    Unduh PDF / Cetak
                </button>
            </div>
        </div>
    </header>

    <!-- Pratinjau lembar A4 -->
    <main class="pratinjau px-4 py-6">
        <div id="susun" class="mx-auto overflow-hidden" style="max-width: 210mm">
            <div class="lembar" id="lembar">
                <p class="lembar__catatan">
                    <strong>e-KartaNU MWCNU Kecamatan Gumelar</strong> — cetak pada kertas <strong>A4</strong> skala 100%, aktifkan <strong>latar belakang grafis</strong>.<br>
                    Satu lembar ini berisi satu kartu: sisi <strong>depan</strong> (atas) dan sisi <strong>belakang</strong> (bawah). Gunting mengikuti garis putus-putus.
                </p>

                <div class="lembar__grup">
                    <!-- ============ SISI DEPAN ============ -->
                    <section>
                        <p class="petak__label"><strong>01</strong> Sisi depan kartu &nbsp;✂&nbsp; gunting di garis putus-putus</p>
                        <div class="pandu">
                            <article class="kartu kartu--depan">
                                <header class="kartu__kepala">
                                    <span class="kartu__logo"><img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo Nahdlatul Ulama"></span>
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
                                        @if ($record->photoUrl())
                                            <img src="{{ $record->photoUrl() }}" alt="Foto {{ $record->name }}" onerror="this.remove()">
                                        @else
                                            <span>{{ Str::of($record->name)->substr(0, 2)->upper() }}</span>
                                        @endif
                                    </div>

                                    <div class="kartu__data">
                                        <div class="bidang bidang--nama">
                                            <p class="bidang__label">Nama Lengkap</p>
                                            <p class="bidang__nilai potong potong-1">{{ $record->name }}</p>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">NIA</p>
                                                <p class="bidang__nilai mono potong potong-1">{{ $record->nia ?: '—' }}</p>
                                            </div>
                                            <div class="bidang">
                                                <p class="bidang__label">NIK</p>
                                                <p class="bidang__nilai mono potong potong-1">{{ $record->nik ?: '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">Tempat, Tgl Lahir</p>
                                                <p class="bidang__nilai">{{ $record->birth_place ?: '—' }}, {{ $record->tanggalIndonesia($record->birth_date) }}</p>
                                            </div>
                                            <div class="bidang bidang--sempit">
                                                <p class="bidang__label">Jenis Kelamin</p>
                                                <p class="bidang__nilai potong potong-1">{{ $record->jenis_kelamin ? $record->jenisKelaminLabel() : '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="bidang">
                                            <p class="bidang__label">Alamat</p>
                                            <p class="bidang__nilai potong">{{ $record->alamat_lengkap ?: '—' }}</p>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">Asal Ranting</p>
                                                <p class="bidang__nilai potong potong-1">{{ $record->branch_name }}</p>
                                            </div>
                                            <div class="bidang">
                                                <p class="bidang__label">Desa Ranting</p>
                                                <p class="bidang__nilai potong potong-1">{{ $record->desa_ranting ?: '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="kartu__berlaku">
                                            <div class="bidang">
                                                <p class="bidang__label">Masa Berlaku</p>
                                                <p class="bidang__nilai">{{ $record->tanggalIndonesia($record->valid_from) }} s/d {{ $record->tanggalIndonesia($record->valid_until) }}</p>
                                            </div>
                                            <span class="kartu__status">Aktif</span>
                                        </div>
                                    </div>
                                </div>

                                <footer class="kartu__kaki">
                                    <p>Kartu ini diterbitkan oleh<strong>MWCNU Kecamatan Gumelar</strong></p>
                                    <p class="text-right">Diterbitkan pada<strong>{{ $record->tanggalIndonesia($record->updated_at, 'd F Y') }}</strong></p>
                                </footer>
                            </article>
                        </div>
                    </section>

                    <!-- ============ SISI BELAKANG ============ -->
                    <section>
                        <p class="petak__label"><strong>02</strong> Sisi belakang kartu &nbsp;✂&nbsp; gunting di garis putus-putus</p>
                        <div class="pandu">
                            <article class="kartu kartu--belakang">
                                <header class="kartu__kepala kartu__kepala--ringkas">
                                    <span class="kartu__logo"><img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo Nahdlatul Ulama"></span>
                                    <div class="kartu__nama">
                                        <p class="kartu__nama-utama">Kartu Tanda Anggota</p>
                                        <p class="kartu__nama-sub">Nahdlatul Ulama</p>
                                    </div>
                                    <div class="kartu__wilayah">
                                        <span>Kode Registrasi</span>
                                        <strong>{{ $record->registration_code }}</strong>
                                    </div>
                                </header>

                                <div class="kartu__badan kartu__badan--belakang">
                                    <div class="kartu__qr">
                                        <div class="kartu__qr-kotak">{!! $qrSvg !!}</div>
                                        <p>Scan untuk verifikasi</p>
                                    </div>

                                    <div class="kartu__data kartu__data--belakang">
                                        <div class="bidang">
                                            <p class="bidang__label">Kode Registrasi</p>
                                            <p class="bidang__nilai mononowrap">{{ $record->registration_code }}</p>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">NIA</p>
                                                <p class="bidang__nilai mono nowrap">{{ $record->nia ?: '—' }}</p>
                                            </div>
                                            <div class="bidang">
                                                <p class="bidang__label">NIK</p>
                                                <p class="bidang__nilai mono nowrap">{{ $record->nik ?: '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">Tempat, Tgl Lahir</p>
                                                <p class="bidang__nilai nowrap">{{ $record->birth_place ?: '—' }}, {{ $record->tanggalIndonesia($record->birth_date) }}</p>
                                            </div>
                                            <div class="bidang bidang--sempit">
                                                <p class="bidang__label">Jenis Kelamin</p>
                                                <p class="bidang__nilai">{{ $record->jenis_kelamin ? $record->jenisKelaminLabel() : '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="bidang">
                                            <p class="bidang__label">Alamat</p>
                                            <p class="bidang__nilai potong">{{ $record->alamat_lengkap ?: '—' }}</p>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang">
                                                <p class="bidang__label">Asal Ranting</p>
                                                <p class="bidang__nilai potong potong-1">{{ $record->branch_name }}</p>
                                            </div>
                                            <div class="bidang">
                                                <p class="bidang__label">Desa Ranting</p>
                                                <p class="bidang__nilai potong potong-1">{{ $record->desa_ranting ?: '—' }}</p>
                                            </div>
                                        </div>

                                        <div class="baris">
                                            <div class="bidang bidang--sempit">
                                                <p class="bidang__label">No. WhatsApp</p>
                                                <p class="bidang__nilai mono nowrap">{{ $record->no_whatsapp ?: '—' }}</p>
                                            </div>
                                            <div class="bidang bidang--sempit">
                                                <p class="bidang__label">Masa Berlaku</p>
                                                <p class="bidang__nilai nowrap">{{ $record->tanggalIndonesia($record->valid_from, 'd M y') }} s/d {{ $record->tanggalIndonesia($record->valid_until, 'd M y') }}</p>
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
                        </div>
                    </section>
                </div>

                <p class="lembar__catatan lembar__catatan--bawah">
                    Verifikasi keanggotaan: <strong>{{ $verificationUrl }}</strong><br>
                    Kartu berlaku sebagai bukti keanggotaan MWCNU Kecamatan Gumelar dan tidak dapat dipindahtangankan. Kerusakan atau kehilangan kartu segera dilaporkan ke sekretariat MWCNU Gumelar.
                </p>
            </div>
        </div>

        <div class="no-print mx-auto mt-6 max-w-3xl rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 text-sm text-on-surface-variant">
            <h2 class="font-semibold text-on-surface">Tips mengunduh &amp; mencetak</h2>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                <li>Klik <strong class="text-on-surface">Unduh PDF / Cetak</strong>, lalu pilih printer atau <em>Simpan sebagai PDF</em>.</li>
                <li>Ukuran kertas <strong class="text-on-surface">A4</strong>, skala <strong class="text-on-surface">100%</strong>, aktifkan <strong class="text-on-surface">Latar belakang grafis</strong>.</li>
                <li>Cetak pada kertas <strong class="text-on-surface">karton</strong> atau kertas tebal agar kartu tidak mudah rusak.</li>
                <li>Gunting kedua sisi kartu pada garis putus-putus, lalu rapikan dengan gunting sudut.</li>
            </ul>
        </div>
    </main>

    <script>
        (function () {
            var lembar = document.getElementById('lembar');
            var susun = document.getElementById('susun');

            if (!lembar || !susun) {
                return;
            }

            var sesuaikan = function () {
                var tersedia = susun.clientWidth;
                var skala = Math.min(1, tersedia / lembar.offsetWidth);

                // Lembar tetap berukuran A4 asli; hanya tampilan layar yang diperkecil.
                lembar.style.transformOrigin = 'top left';
                lembar.style.transform = 'scale(' + skala + ')';
                lembar.style.marginLeft = Math.max(0, (tersedia - lembar.offsetWidth * skala) / 2) + 'px';
                susun.style.height = (lembar.offsetHeight * skala) + 'px';
            };

            sesuaikan();
            window.addEventListener('resize', sesuaikan);
        })();
    </script>
</body>
</html>