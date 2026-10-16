@extends('layouts.site')

@section('content')
<div class="w-full bg-[#FAFAF9] px-4 py-10 text-on-surface sm:px-6 md:py-16 lg:px-8">
    <div class="mx-auto max-w-6xl space-y-14 md:space-y-20">
        <section class="space-y-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 rounded-full border border-outline-variant/40 bg-surface-container px-3 py-1">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-primary-container"></span>
                    <span class="font-label-caps text-label-caps uppercase tracking-wider text-primary">Sistem Informasi KartaNU • MWCNU Kecamatan Gumelar</span>
                </div>
                <h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight tracking-tight text-on-surface lg:text-headline-xl">Pusat Layanan KartaNU</h1>
                <p class="max-w-2xl font-body-lg text-body-lg leading-relaxed text-on-surface-variant">Akses kartu anggota digital, pelacakan verifikasi berkas ranting, dan layanan data warga Nahdliyin Kecamatan Gumelar.</p>
            </div>

            <div class="space-y-8 rounded-2xl border border-outline-variant/60 bg-surface-container-lowest p-6 sm:p-8 lg:p-10">
                <div class="flex flex-col justify-between gap-4 border-b border-outline-variant/40 pb-6 md:flex-row md:items-end">
                    <div class="max-w-3xl space-y-1">
                        <span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Layanan anggota</span>
                        <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Unduh & Cetak e-KartaNU</h2>
                        <p class="font-body-md text-body-md leading-relaxed text-on-surface-variant">Masukkan NIA atau NIK yang telah diverifikasi oleh pengurus ranting. Data identitas ditampilkan seperlunya dan NIK disamarkan.</p>
                    </div>
                    <div class="inline-flex shrink-0 items-center gap-2 text-sm text-on-surface-variant"><span class="material-symbols-outlined text-[18px] text-primary">verified_user</span>Data dilindungi</div>
                </div>

                <form class="flex flex-col gap-3 sm:flex-row" action="{{ route('kartanu.lookup') }}" method="POST">
                    @csrf
                    <label class="relative flex-1" for="identifier">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">badge</span>
                            <input class="w-full rounded-lg border border-outline-variant bg-surface-container-low py-3.5 pl-12 pr-4 font-body-md text-body-md transition-colors placeholder:text-slate-400 focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="identifier" name="identifier" type="text" value="{{ old('identifier') }}" placeholder="Masukkan NIA atau NIK 16 digit" autocomplete="off" required>
                    </label>
                    <button class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-primary-container px-6 py-3.5 font-label-md text-label-md text-white transition-colors hover:bg-primary" type="submit"><span class="material-symbols-outlined text-[18px]">search</span>Tampilkan Kartu</button>
                </form>
                @error('identifier')<p class="text-sm text-rose-700" role="alert">{{ $message }}</p>@enderror
                @if ($lookupMessage)<p class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900" role="status">{{ $lookupMessage }}</p>@endif

                @if ($card && $card->verification_status === 'issued')
                    <div class="print-card pt-4" id="kartu-preview">
                        <div class="mb-3 flex items-center justify-between gap-3">
                            <span class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant">Pratinjau Kartu Anggota</span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-primary-fixed/40 px-2.5 py-1 font-label-sm text-label-sm font-semibold text-primary-container"><span class="h-1.5 w-1.5 rounded-full bg-primary-container"></span>{{ $card->verification_status === 'issued' ? 'Terverifikasi Aktif' : $card->verificationLabel() }}</span>
                        </div>
                        <div class="mx-auto max-w-2xl overflow-hidden rounded-2xl border border-outline-variant/70 bg-white">
                            <div class="h-1.5 w-full bg-primary-container"></div>
                            <div class="p-5 sm:p-6">
                                <div class="flex items-center justify-between gap-3 border-b border-outline-variant/40 pb-4">
                                    <div class="flex min-w-0 items-center gap-3.5">
                                        <img class="h-10 w-10 shrink-0 rounded-lg border border-outline-variant/40 object-contain" src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo Nahdlatul Ulama">
                                        <div class="min-w-0"><h2 class="font-headline-sm text-sm font-bold uppercase leading-tight text-primary sm:text-base">Kartu Tanda Anggota Nahdlatul Ulama</h2><p class="mt-1 text-[10px] font-semibold uppercase tracking-wider text-on-surface-variant">Pengurus MWCNU Kecamatan Gumelar</p></div>
                                    </div>
                                    <span class="hidden shrink-0 rounded border border-outline-variant/40 bg-surface-container-low px-2.5 py-1 font-label-caps text-label-caps uppercase text-on-surface-variant sm:inline">KTA Elektronik</span>
                                </div>
                                <div class="flex flex-col gap-5 pt-5 sm:flex-row">
                                    <div class="mx-auto flex h-40 w-32 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-outline-variant/70 bg-surface-container sm:mx-0">
                                        @if ($card->photoUrl())<img class="h-full w-full object-cover" src="{{ $card->photoUrl() }}" alt="Foto anggota {{ $card->name }}">@else<span class="material-symbols-outlined text-4xl text-slate-400">person</span>@endif
                                    </div>
                                    <div class="flex min-w-0 flex-1 flex-col gap-3">
                                        <div class="border-b border-outline-variant/30 pb-2"><h3 class="font-headline-md text-lg font-bold tracking-tight text-on-surface">{{ $card->name }}</h3><p class="mt-1 font-label-md text-label-md font-bold text-primary">NIA: {{ $card->nia }}</p></div>
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-2 text-sm sm:grid-cols-2">
                                            <div><dt class="font-label-caps text-label-caps uppercase text-on-surface-variant">NIK</dt><dd class="mt-0.5 font-medium text-on-surface">{{ $card->maskedNik() }}</dd></div>
                                            <div><dt class="font-label-caps text-label-caps uppercase text-on-surface-variant">Ranting</dt><dd class="mt-0.5 font-medium text-on-surface">{{ $card->branch_name }}</dd></div>
                                            <div><dt class="font-label-caps text-label-caps uppercase text-on-surface-variant">Masa berlaku</dt><dd class="mt-0.5 font-medium text-on-surface">{{ $card->valid_from?->format('Y') ?? '—' }} — {{ $card->valid_until?->format('Y') ?? '—' }}</dd></div>
                                            <div><dt class="font-label-caps text-label-caps uppercase text-on-surface-variant">Kode validasi</dt><dd class="mt-0.5 font-medium text-on-surface">{{ $card->registration_code }}</dd></div>
                                        </dl>
                                        <div class="mt-auto flex items-center justify-between gap-3 border-t border-outline-variant/40 pt-3">
                                            <div><p class="font-label-caps text-label-caps font-semibold uppercase text-primary">Pengesahan Digital MWCNU Gumelar</p><p class="mt-0.5 text-xs text-on-surface-variant">Sensus warga Nahdliyin Banyumas</p></div>
                                            <span class="material-symbols-outlined text-3xl text-primary">verified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="print:hidden mt-4 flex flex-wrap items-center justify-between gap-3">
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Gunakan fitur cetak browser untuk mencetak atau menyimpan kartu sebagai PDF.</p>
                            <a href="{{ route('cetak-kartanu.show', ['registration_code' => $card->registration_code]) }}" class="inline-flex items-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 font-label-md text-label-md text-white hover:bg-primary"><span class="material-symbols-outlined text-[18px]">print</span>Cetak / Simpan PDF</a>
                        </div>
                    </div>
                @elseif ($card)
                    <div class="rounded-xl border border-secondary-container bg-surface-container-low p-5 text-center">
                        <span class="material-symbols-outlined text-3xl text-primary">hourglass_top</span>
                        <p class="mt-2 font-headline-sm text-headline-sm font-semibold text-on-surface">Data ditemukan, kartu belum diterbitkan</p>
                        <p class="mt-1 text-sm text-on-surface-variant">Tahap saat ini: {{ $card->verificationLabel() }}. Lacak detail proses menggunakan kode registrasi yang diberikan pengurus ranting.</p>
                    </div>
                @elseif (!$tracking && !$lookupMessage)
                    <div class="rounded-xl border border-dashed border-outline-variant bg-surface-container-low/60 px-5 py-8 text-center">
                        <span class="material-symbols-outlined text-3xl text-primary">credit_card</span>
                        <p class="mt-2 font-headline-sm text-headline-sm font-semibold text-on-surface">Pratinjau kartu akan tampil setelah data ditemukan</p>
                        <p class="mt-1 text-sm text-on-surface-variant">Pastikan NIA atau NIK sudah diverifikasi oleh pengurus ranting.</p>
                    </div>
                @endif
            </div>
        </section>

        <section class="scroll-mt-24 space-y-6" id="lacak-status">
            <div class="rounded-2xl border border-outline-variant/60 bg-surface-container-lowest p-6 sm:p-8 lg:p-10">
                <div class="max-w-2xl space-y-1"><span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Transparansi Pelayanan</span><h2 class="font-headline-md text-headline-md font-bold text-on-surface">Lacak Status Verifikasi Data</h2><p class="font-body-md text-body-md text-on-surface-variant">Periksa tahapan verifikasi pendaftaran menggunakan kode registrasi dari pengurus ranting.</p></div>
                <form class="mt-6 flex flex-col gap-3 sm:flex-row" action="{{ route('kartanu.track') }}" method="POST">
                    @csrf
                        <label class="relative flex-1" for="registration_code"><span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">assignment_turned_in</span><input class="w-full rounded-lg border border-outline-variant bg-surface-container-low py-3.5 pl-12 pr-4 text-sm focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="registration_code" name="registration_code" type="text" placeholder="Contoh: REG-GML-2026-XXXXXXXX" value="{{ old('registration_code') }}" required></label>
                    <button class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg border border-primary-container px-6 py-3.5 font-label-md text-label-md font-semibold text-primary-container transition-colors hover:bg-primary-fixed/20" type="submit"><span class="material-symbols-outlined text-[18px]">sync</span>Cek Status</button>
                </form>
                @error('registration_code')<p class="mt-2 text-sm text-rose-700" role="alert">{{ $message }}</p>@enderror
                @if ($tracking)
                    <div class="mt-6 rounded-xl border border-outline-variant/40 bg-surface-container-low p-4 sm:flex sm:items-center sm:justify-between">
                        <div><p class="text-sm text-on-surface-variant">Data registrasi ditemukan</p><p class="mt-1 font-headline-sm text-headline-sm font-semibold text-on-surface">{{ $tracking->name }} <span class="font-normal text-on-surface-variant">({{ $tracking->branch_name }})</span></p><p class="mt-1 text-xs text-on-surface-variant">Kode {{ $tracking->registration_code }} · diajukan {{ $tracking->created_at->translatedFormat('d F Y') }}</p></div>
                        <span class="mt-3 inline-flex items-center gap-2 rounded-full border border-outline-variant bg-white px-3 py-1.5 font-label-caps text-label-caps font-semibold uppercase text-primary sm:mt-0"><span class="h-1.5 w-1.5 rounded-full bg-primary-container"></span>{{ $tracking->verificationLabel() }}</span>
                    </div>
                    @if ($tracking->verification_status === 'rejected' && $tracking->verification_note)<p class="mt-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">Catatan verifikasi: {{ $tracking->verification_note }}</p>@endif
                    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4" aria-label="Tahapan verifikasi">
                        @foreach (['Berkas Masuk', 'Verifikasi Ranting', 'Validasi MWCNU', 'Penerbitan e-KartaNU'] as $step => $label)
                            @php $complete = $tracking->verificationProgress() > $step + 1; $current = $tracking->verificationProgress() === $step + 1; @endphp
                            <div class="rounded-xl border {{ $current ? 'border-2 border-primary-container' : 'border-outline-variant' }} {{ $complete ? 'bg-white' : 'bg-[#FAFAF9]' }} p-4 {{ !$complete && !$current ? 'opacity-60' : '' }}">
                                <div class="flex items-center justify-between"><span class="flex h-7 w-7 items-center justify-center rounded-full {{ $complete || $current ? 'bg-primary-container text-white' : 'bg-surface-variant text-on-surface-variant' }} font-label-sm text-label-sm font-bold">{{ $step + 1 }}</span><span class="font-label-caps text-label-caps font-semibold {{ $complete ? 'text-primary-container' : ($current ? 'text-primary' : 'text-on-surface-variant') }}">{{ $complete ? 'Selesai' : ($current ? 'Proses' : 'Menunggu') }}</span></div>
                                <h3 class="mt-3 font-headline-sm text-headline-sm {{ $current ? 'text-primary-container' : 'text-on-surface' }}">{{ $label }}</h3>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($trackingMessage)<p class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900" role="status">{{ $trackingMessage }}</p>@endif
            </div>
        </section>

        <section class="space-y-6">
            <div class="space-y-1"><span class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Pedoman & Layanan Terpadu</span><h2 class="font-headline-md text-headline-md font-bold text-on-surface">Informasi & Pusat Layanan Ranting</h2></div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                @foreach ([['fact_check', 'Syarat e-KartaNU', 'Warga berdomisili di wilayah Kecamatan Gumelar dan data keanggotaan telah diverifikasi oleh pengurus ranting.', 'Gratis tanpa biaya cetak kartu digital'], ['holiday_village', 'Posko Layanan Ranting', 'Pemutakhiran berkas difasilitasi di sekretariat PRNU desa pada pertemuan rutin atau majelis selapanan warga.', '10 desa se-Kecamatan Gumelar'], ['support_agent', 'Kendala & Bantuan', 'Untuk koreksi data, duplikasi identitas, atau kartu belum terbit, hubungi sekretariat MWCNU melalui kanal resmi.', 'sekretariat@mwcnu-gumelar.or.id']] as [$icon, $heading, $copy, $foot])
                    <article class="flex flex-col justify-between gap-5 rounded-xl border border-outline-variant/60 bg-surface-container-lowest p-6 sm:p-7"><div><div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-surface-container text-primary-container"><span class="material-symbols-outlined text-headline-md">{{ $icon }}</span></div><h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">{{ $heading }}</h3><p class="mt-2 font-body-md text-body-md leading-relaxed text-on-surface-variant">{{ $copy }}</p></div><div class="border-t border-outline-variant/30 pt-4"><span class="flex items-center gap-1 text-sm font-semibold text-primary"><span class="material-symbols-outlined text-[16px]">check_circle</span>{{ $foot }}</span></div></article>
                @endforeach
            </div>
        </section>

        <section class="pb-6">
            <div class="rounded-2xl border border-primary bg-primary-container p-8 text-center text-white sm:p-12 lg:p-16">
                <div class="mx-auto max-w-3xl space-y-5"><div class="inline-flex items-center gap-2 rounded-full border border-primary-fixed/20 bg-primary px-3 py-1"><span class="h-2 w-2 rounded-full bg-on-tertiary-container"></span><span class="font-label-caps text-label-caps uppercase tracking-widest text-primary-fixed">Pendaftaran e-KartaNU</span></div><h2 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-white lg:text-headline-xl">Belum punya KartaNU? Yuk, buat sekarang!</h2><p class="mx-auto max-w-2xl font-body-lg text-body-lg leading-relaxed text-primary-fixed-dim">Daftarkan dirimu secara daring, lengkapi data identitas, lalu tunggu verifikasi pengurus ranting. Gratis, dan e-KartaNU langsung aktif untuk mengakses layanan keummatan MWCNU Gumelar.</p><div class="flex flex-col items-center justify-center gap-3 pt-2 sm:flex-row"><a class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-7 py-3.5 font-headline-sm text-headline-sm font-semibold text-primary-container transition-colors hover:bg-surface-container-low sm:w-auto" href="{{ route('pendaftaran.kartanu') }}"><span>Daftar KartaNU Sekarang</span><span class="material-symbols-outlined text-[20px]">arrow_forward</span></a><a class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-primary-fixed/40 px-6 py-3.5 font-label-md text-label-md text-white transition-colors hover:bg-primary sm:w-auto" href="{{ route('kartanu') }}#lacak-status"><span class="material-symbols-outlined text-[18px]">assignment_turned_in</span>Lacak Status Pendaftaran</a></div><p class="font-body-sm text-body-sm text-primary-fixed/70">Pendaftaran dan penerbitan e-KartaNU tidak dipungut biaya. Layanan resmi dikelola oleh Tim Sensus Data Terpadu MWCNU Gumelar.</p></div>
            </div>
        </section>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden !important; }
        #kartu-preview, #kartu-preview * { visibility: visible !important; }
        #kartu-preview { position: absolute; inset: 0 auto auto 0; width: 100%; padding: 0; margin: 0; }
        @page { size: 85mm 55mm; margin: 0; }
    }
</style>
@endsection