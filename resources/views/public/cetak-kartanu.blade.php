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

        @page { size: A4 portrait; margin: 0; }

        @media print {
            html, body { margin: 0 !important; padding: 0 !important; background: #fff !important; }
            .no-print { display: none !important; }
            .pratinjau { padding: 0 !important; background: #fff !important; }
            .lembar { box-shadow: none !important; margin: 0 auto; transform: none !important; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
    @include('partials.kartu-anggota-css')
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
                            <x-kartu-anggota :record="$record" sisi="depan" />
                        </div>
                    </section>

                    <!-- ============ SISI BELAKANG ============ -->
                    <section>
                        <p class="petak__label"><strong>02</strong> Sisi belakang kartu &nbsp;✂&nbsp; gunting di garis putus-putus</p>
                        <div class="pandu">
                            <x-kartu-anggota :record="$record" sisi="belakang" :qr-svg="$qrSvg" />
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