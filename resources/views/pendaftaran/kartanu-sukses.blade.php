@extends('layouts.site')

@section('content')
<div class="w-full py-16 md:py-20 flex flex-col items-center">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-low shadow-sm">
        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
        <span class="text-xs font-semibold text-primary tracking-widest uppercase">Sistem Sensus Digital MWCNU Gumelar</span>
    </div>

    <!-- Minimalist Refined Checkmark Icon -->
    <div class="mt-8 relative flex items-center justify-center">
        <div class="w-20 h-20 rounded-full bg-surface-container-lowest flex items-center justify-center shadow-sm">
            <div class="w-14 h-14 rounded-full bg-primary-fixed/40 flex items-center justify-center">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>
    </div>

    <!-- Editorial Typography Headline & Description -->
    <div class="text-center mt-6 max-w-2xl px-4">
        <h1 class="text-3xl md:text-4xl text-on-surface tracking-tight font-extrabold">
            Pendaftaran Berhasil Terkirim!
        </h1>
        <p class="text-base text-on-surface-variant mt-3 leading-relaxed max-w-xl mx-auto">
            Berkas sensus KartaNU Anda telah masuk ke pangkalan data terpadu dan sedang dalam antrean verifikasi Pengurus Ranting.
        </p>
    </div>

    <!-- Card Resi Registrasi (Hero Centerpiece) -->
    <div class="w-full max-w-xl px-4 mt-8">
        <div class="bg-surface-container-lowest rounded-2xl p-5 md:p-6 shadow-sm relative overflow-hidden">
            <!-- Architectural hairline accent bar -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-primary"></div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                    <span class="text-xs font-semibold text-on-surface-variant tracking-wider uppercase">
                        Nomor Resi Pendaftaran Anda
                    </span>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-primary-fixed/50 text-on-primary-fixed-variant">
                    Aktif
                </span>
            </div>
            <!-- Token Monospace Block with Copy Interaction -->
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-surface-container-low p-4 rounded-xl">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="material-symbols-outlined text-outline-variant text-[22px]">tag</span>
                    <span class="text-lg md:text-xl text-primary font-bold tracking-widest font-mono truncate" id="resiCode">
                        {{ $registrationCode }}
                    </span>
                </div>
                <button class="shrink-0 inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container-lowest text-on-surface hover:bg-surface-container text-sm font-semibold shadow-sm transition-all active:scale-95" id="copyBtn" onclick="copyResi()" type="button">
                    <span class="material-symbols-outlined text-[16px] text-on-surface-variant" id="copyIcon">content_copy</span>
                    <span id="copyText">Salin Nomor</span>
                </button>
            </div>
            <!-- Metadata Grid -->
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                <div class="flex flex-col p-2">
                    <span class="text-xs text-outline uppercase tracking-wider">Waktu Pengiriman</span>
                    <span class="text-sm text-on-surface font-semibold mt-0.5">{{ now()->format('d F Y') }} • {{ now()->format('H:i') }} WIB</span>
                </div>
                <div class="flex flex-col p-2">
                    <span class="text-xs text-outline uppercase tracking-wider">Ranting Tujuan</span>
                    <span class="text-sm text-on-surface font-semibold mt-0.5">{{ $branchName }}</span>
                </div>
            </div>
            <!-- Visual Signature Detail -->
            <div class="mt-4 pt-3 flex items-center justify-between text-outline text-xs">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px]">qr_code_2</span>
                    <span>Digital Census Signature Token</span>
                </div>
                <span class="font-mono text-[11px] text-outline tracking-wider">#{{ substr($registrationCode, -4) }}</span>
            </div>
        </div>
    </div>

    <!-- Login Notice -->
    <div class="w-full max-w-xl px-4 mt-4">
        <div class="rounded-xl border border-primary-container/40 bg-primary-fixed/20 p-4 flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-white text-[20px]">login</span>
            </div>
            <div class="flex-1">
                <span class="text-base text-primary font-bold">Akun Portal Anda sudah dibuat</span>
                <p class="text-sm text-on-surface-variant leading-relaxed mt-0.5">
                    Masuk memakai <strong>NIK</strong> dan kata sandi default <strong>tanggal lahir (DDMMYYYY)</strong>. Ubah kata sandi setelah berhasil masuk.
                </p>
            </div>
            <a class="shrink-0 inline-flex items-center justify-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary transition-colors" href="{{ route('masuk') }}">
                <span class="material-symbols-outlined text-[18px]">login</span>Masuk Portal
            </a>
        </div>
    </div>

    <!-- SLA Information & Notification Block -->
    <div class="w-full max-w-xl px-4 mt-4">
        <div class="bg-surface-container-low rounded-xl p-4 flex gap-4 items-start shadow-sm">
            <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center shrink-0 mt-0.5">
                <span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
            </div>
            <div class="flex flex-col">
                <span class="text-base text-primary font-bold">Verifikasi & Notifikasi Otomatis</span>
                <p class="text-sm text-on-surface-variant leading-relaxed mt-1">
                    Tim Pengurus Ranting akan memverifikasi keabsahan data Anda dalam waktu maksimal <strong>3x24 jam kerja</strong>. Salinan nomor resi dan notifikasi pembaruan status juga telah kami kirimkan ke nomor WhatsApp Anda.
                </p>
            </div>
        </div>
    </div>

    <!-- Visual Confirmation Document Preview -->
    <div class="w-full max-w-xl px-4 mt-8">
        <div class="p-4 bg-surface-container-lowest rounded-2xl shadow-sm flex items-center gap-4">
            <img class="w-16 h-16 rounded-xl object-cover shrink-0" alt="Dokumen KartaNU" src="{{ asset('images/logo-nu-40178.png') }}">
            <div class="flex flex-col min-w-0">
                <span class="text-xs text-outline uppercase tracking-wider">Arsip Dokumen Elektronik</span>
                <span class="text-base text-on-surface truncate">KartaNU-{{ date('Y') }}-REG-{{ substr($registrationCode, -4) }}.pdf</span>
                <span class="text-sm text-on-surface-variant">Telah terenkripsi 256-bit dan tersimpan otomatis</span>
            </div>
        </div>
    </div>

    <!-- Action Buttons (CTA) -->
    <div class="w-full max-w-xl px-4 mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
        <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-on-primary text-sm font-bold shadow-md hover:bg-primary-container transition-all active:scale-[0.98]" href="{{ route('kartanu') }}">
            <span>Lacak Status Berkas</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
        <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-surface-container-lowest text-on-surface hover:bg-surface-container-low text-sm font-semibold shadow-sm transition-all" href="{{ route('beranda') }}">
            <span class="material-symbols-outlined text-[18px] text-outline">home</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Reassurance Minimalist Footer Strip -->
    <div class="mt-12 flex items-center justify-center gap-2 text-center px-4">
        <span class="material-symbols-outlined text-[16px] text-primary">lock</span>
        <p class="text-sm text-on-surface-variant">
            Data sensus terdaftar resmi pada Sistem Informasi KartaNU MWCNU Kecamatan Gumelar.
        </p>
    </div>
</div>

<script>
    function copyResi() {
        const code = document.getElementById('resiCode').innerText.trim();
        navigator.clipboard.writeText(code).then(() => {
            const copyText = document.getElementById('copyText');
            const copyIcon = document.getElementById('copyIcon');
            const copyBtn = document.getElementById('copyBtn');

            copyText.innerText = 'Tersalin!';
            copyIcon.innerText = 'check';
            copyBtn.classList.add('bg-primary-fixed', 'text-on-primary-fixed-variant');

            setTimeout(() => {
                copyText.innerText = 'Salin Nomor';
                copyIcon.innerText = 'content_copy';
                copyBtn.classList.remove('bg-primary-fixed', 'text-on-primary-fixed-variant');
            }, 2500);
        });
    }
</script>
@endsection
