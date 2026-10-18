@props([
    'record',
    'sisi' => 'depan',
    'qrSvg' => null,
])

{{--
    Kartu anggota e-KartaNU (85 x 55 mm) dalam satuan milimeter asli.
    Komponen ini dipakai bersama oleh:
      - pratinjau kartu di /kartanu            (sisi depan, diskalakan untuk layar)
      - lembar cetak A4 di /cetak-kartanu/show (depan + belakang, skala 100%)

    Karena keduanya memakai markup & CSS yang sama, pratinjau selalu identik
    dengan hasil cetak. Jangan mengedit gaya di sini -- semuanya ada di
    partials.kartu-anggota-css.
--}}

@if ($sisi === 'belakang')
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
@else
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
@endif