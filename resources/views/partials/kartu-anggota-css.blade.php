{{--
    Gaya kartu anggota e-KartaNU (85 x 55 mm), dipakai bersama oleh:
      - pratinjau kartu di halaman /kartanu
      - lembar cetak A4 di /cetak-kartanu/show
    Disimpan di satu partial supaya pratinjau tidak pernah berbeda dari hasil cetak.
    Satuan milimeter dipakai karena kartu dicetak pada kertas fisik 85 x 55 mm;
    untuk layar, kartu diperkecil lewat `transform: scale()` pada pembungkusnya.
--}}
<style>
        /* ---------- Kartu 85 x 55 mm ---------- */
        .kartu {
            /* Palet kartu didefinisikan di sini (bukan di .lembar) supaya kartu
               tampil sama benar saat dirender sendiri di pratinjau /kartanu. */
            --hijau: #003527;
            --hijau-muda: #064e3b;
            --hijau-terang: #b0f0d6;
            --garis: #bfc9c3;
            --tinta: #191c1e;
            --tinta-lembut: #404944;
            --abu: #f2f4f6;

            box-sizing: border-box;
            width: 85mm;
            height: 55mm;
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-direction: column;

            /* Font ditetapkan langsung di kartu, bukan diwarisi dari halaman induk,
               supaya pratinjau (/kartanu) dan cetakan (/cetak-kartanu) memakai
               huruf yang benar-benar sama. `font-smoothing` juga dipatok agar
               kelas `antialiased` pada layout situs tidak mengubah tampilan
               teks kartu di pratinjau. */
            font-family: 'Inter', 'Plus Jakarta Sans', system-ui, sans-serif;
            -webkit-font-smoothing: auto;
        }

        /* Pembungkus layar: kartu diskalakan agar muat (dan sedikit diperbesar)
           di lebar yang tersedia tanpa mengubah proporsi.
           Lebar & tinggi pembungkus disetel skrip agar sama dengan ukuran kartu
           setelah diskalakan. Kalau tidak, kartu yang dipusatkan lalu diperbesar
           akan meluber ke kanan lalu terpotong. */
        .kartu-blok {
            margin: 0;
            min-width: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .kartu-skala {
            overflow: hidden;
        }
        .kartu-skala > .kartu {
            transform-origin: top left;
            flex: 0 0 auto;
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
        .kartu__foto img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: top; }
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
</style>
