@extends('layouts.site')

@section('content')
<div class="w-full bg-surface px-4 py-8 sm:px-6 sm:py-10 md:py-16">
    <div class="mx-auto max-w-3xl">
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-5 py-4 text-sm font-semibold text-primary-container" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 text-sm text-on-error-container" role="alert">
                <p class="font-bold mb-1">Periksa kembali data yang diisi:</p>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header & Section Intro -->
        <header class="mb-10 text-center md:mb-12">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-outline-variant/60 bg-surface-container-high px-3 py-1">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-primary-container"></span>
                <span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">
                    Sensus &amp; Kaderisasi Digital • MWCNU Kecamatan Gumelar
                </span>
            </div>
            <h1 class="mb-3 font-headline-xl text-headline-xl-mobile font-extrabold tracking-tight text-on-surface lg:text-headline-xl">
                Registrasi Sensus KartaNU
            </h1>
            <p class="mx-auto max-w-xl font-body-md text-body-md leading-relaxed text-on-surface-variant">
                Lengkapi data diri Anda secara bertahap untuk penerbitan nomor identitas resmi warga Nahdliyin MWCNU Gumelar.
            </p>
        </header>

        <!-- Stepper / Progress Bar -->
        <nav aria-label="Progress Tahapan Formulir" class="mb-8 sm:mb-10">
            <div class="relative flex items-start justify-between">
                <div class="absolute left-[16.666%] right-[16.666%] top-5 h-px bg-outline-variant/50"></div>

                <div class="relative z-10 flex min-w-0 flex-1 flex-col items-center px-0.5" id="stepper-1">
                    <div class="stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary-container font-label-md text-label-md font-bold text-on-primary ring-4 ring-surface">1</div>
                    <span class="mt-2.5 text-center font-label-sm text-label-sm font-bold leading-tight text-on-surface sm:font-label-md sm:text-label-md"><span class="sm:hidden">Data</span><span class="hidden sm:inline">Data Pribadi</span></span>
                    <span class="stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-primary-container">Tahap Aktif</span>
                </div>

                <div class="relative z-10 flex min-w-0 flex-1 flex-col items-center px-0.5 opacity-75" id="stepper-2">
                    <div class="stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-outline-variant bg-surface-container-lowest font-label-md text-label-md font-semibold text-on-surface-variant ring-4 ring-surface">2</div>
                    <span class="mt-2.5 text-center font-label-sm text-label-sm font-semibold leading-tight text-on-surface-variant sm:font-label-md sm:text-label-md"><span class="sm:hidden">Domisili</span><span class="hidden sm:inline">Domisili &amp; Ranting</span></span>
                    <span class="stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-outline">Menunggu</span>
                </div>

                <div class="relative z-10 flex min-w-0 flex-1 flex-col items-center px-0.5 opacity-75" id="stepper-3">
                    <div class="stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-outline-variant bg-surface-container-lowest font-label-md text-label-md font-semibold text-on-surface-variant ring-4 ring-surface">3</div>
                    <span class="mt-2.5 text-center font-label-sm text-label-sm font-semibold leading-tight text-on-surface-variant sm:font-label-md sm:text-label-md"><span class="sm:hidden">Dokumen</span><span class="hidden sm:inline">Unggah Dokumen</span></span>
                    <span class="stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-outline">Menunggu</span>
                </div>
            </div>
        </nav>

        <!-- Form Container -->
        <form action="{{ route('pendaftaran.kartanu.store') }}" class="space-y-6" enctype="multipart/form-data" id="kartanu-form" method="POST" novalidate>
            @csrf

            <!-- Step 1: Data Pribadi -->
            <section class="mb-6 rounded-xl border border-outline-variant/70 bg-surface-container-lowest p-5 sm:p-6 md:p-10" id="step-1">
                <div class="mb-6 sm:mb-8 border-b border-outline-variant/30 pb-5 sm:pb-6">
                    <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Langkah 1: Identitas &amp; Data Kependudukan</h2>
                    <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">Pastikan informasi yang diisi sesuai dengan dokumen e-KTP fisik yang masih berlaku.</p>
                </div>

                <div class="space-y-6">
                    <!-- NIK -->
                    <div class="flex flex-col gap-1.5">
                        <label class="flex items-center justify-between font-label-md text-label-md font-semibold text-on-surface" for="nik">
                            <span>Nomor Induk Kependudukan (NIK) <span class="text-error">*</span></span>
                            <span class="font-label-sm text-label-sm font-normal text-on-surface-variant" id="nik-counter">0 / 16</span>
                        </label>
                        <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline transition-colors focus:border-primary-container focus:outline-none" id="nik" inputmode="numeric" maxlength="16" minlength="16" name="nik" pattern="[0-9]{16}" placeholder="Contoh: 330214xxxxxxxxxx (16 Digit)" required title="NIK harus tepat 16 angka" type="text" value="{{ old('nik') }}">
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
                            <span>NIK digunakan untuk verifikasi tunggal basis data sensus PBNU.</span>
                        </p>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="nama_lengkap">Nama Lengkap <span class="text-error">*</span></label>
                        <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline transition-colors focus:border-primary-container focus:outline-none" id="nama_lengkap" maxlength="100" minlength="3" name="nama_lengkap" pattern="[A-Za-z .,'\-]{3,100}" placeholder="Masukkan nama lengkap beserta gelar jika ada" required title="Hanya huruf, spasi, titik, koma, apostrof, dan tanda hubung (3–100 karakter)" type="text" value="{{ old('nama_lengkap') }}">
                        <p class="mt-0.5 font-body-sm text-body-sm text-on-surface-variant">Hanya huruf, spasi, titik, koma, apostrof, dan tanda hubung. Maksimal 100 karakter.</p>
                    </div>

                    <!-- Tempat & Tanggal Lahir -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md font-semibold text-on-surface" for="tempat_lahir">Tempat Lahir <span class="text-error">*</span></label>
                            <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline transition-colors focus:border-primary-container focus:outline-none" id="tempat_lahir" maxlength="100" minlength="3" name="tempat_lahir" pattern="[A-Za-z .,'\-]{3,100}" placeholder="Kabupaten / Kota kelahiran" required title="Hanya huruf, spasi, titik, koma, apostrof, dan tanda hubung (3–100 karakter)" type="text" value="{{ old('tempat_lahir') }}">
                            <p class="mt-0.5 font-body-sm text-body-sm text-on-surface-variant">Hanya huruf. Maksimal 100 karakter.</p>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md font-semibold text-on-surface" for="tanggal_lahir">Tanggal Lahir <span class="text-error">*</span></label>
                            <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface-variant transition-colors focus:border-primary-container focus:outline-none" id="tanggal_lahir" name="tanggal_lahir" required type="date" value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md font-semibold text-on-surface">Jenis Kelamin <span class="text-error">*</span></label>
                        <div class="grid grid-cols-2 gap-2 sm:gap-3" role="radiogroup">
                            <label class="relative flex cursor-pointer items-center justify-between rounded-lg border border-primary-container bg-surface-container-low p-2.5 transition-colors sm:p-3.5" id="label-gender-l">
                                <div class="flex items-center gap-2.5 sm:gap-3">
                                    <input checked class="h-4 w-4 shrink-0 accent-primary-container" name="jenis_kelamin" type="radio" value="L" {{ old('jenis_kelamin', 'L') === 'L' ? 'checked' : '' }}>
                                    <span class="font-label-md text-label-md font-bold text-on-surface">Laki-laki</span>
                                </div>
                                <span class="material-symbols-outlined text-primary text-[20px] max-sm:hidden">male</span>
                            </label>
                            <label class="relative flex cursor-pointer items-center justify-between rounded-lg border border-outline-variant bg-surface-container-lowest p-2.5 transition-colors hover:bg-surface-container-low sm:p-3.5" id="label-gender-p">
                                <div class="flex items-center gap-2.5 sm:gap-3">
                                    <input class="h-4 w-4 shrink-0 accent-primary-container" name="jenis_kelamin" type="radio" value="P" {{ old('jenis_kelamin') === 'P' ? 'checked' : '' }}>
                                    <span class="font-label-md text-label-md font-semibold text-on-surface">Perempuan</span>
                                </div>
                                <span class="material-symbols-outlined text-outline text-[20px] max-sm:hidden">female</span>
                            </label>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex flex-col gap-1.5 pt-2">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="no_whatsapp">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                        <div class="flex overflow-hidden rounded-lg border border-outline-variant transition-colors focus-within:border-primary-container">
                            <span class="inline-flex select-none items-center border-r border-outline-variant bg-surface-container px-4 font-label-md text-label-md text-on-surface-variant">+62</span>
                            <input class="w-full bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" id="no_whatsapp" inputmode="numeric" maxlength="12" minlength="9" name="no_whatsapp" pattern="8[0-9]{8,11}" placeholder="81234567890" required title="9–12 angka setelah +62, diawali angka 8" type="tel" value="{{ old('no_whatsapp') }}">
                        </div>
                        <p class="mt-1 font-body-sm text-body-sm leading-relaxed text-on-surface-variant">Hanya angka, 9–12 digit setelah +62 (contoh: 81234567890).</p>
                        <p class="mt-1 font-body-sm text-body-sm leading-relaxed text-on-surface-variant">Digunakan untuk pengiriman bukti resi pendaftaran, notifikasi status verifikasi, dan barcode pengambilan kartu fisik.</p>
                    </div>
                </div>
            </section>

            <!-- Step 2: Domisili & Ranting -->
            <section class="mb-6 hidden rounded-xl border border-outline-variant/70 bg-surface-container-lowest p-5 sm:p-6 md:p-10" id="step-2">
                <div class="mb-6 sm:mb-8 border-b border-outline-variant/30 pb-5 sm:pb-6">
                    <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Langkah 2: Domisili &amp; Ranting MWCNU</h2>
                    <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">Data domisili digunakan untuk menentukan ranting tempat Anda terdaftar sebagai warga Nahdliyin.</p>
                </div>

                <div class="space-y-6">
                    <!-- Alamat Lengkap -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="alamat_lengkap">Alamat Lengkap Domisili <span class="text-error">*</span></label>
                        <textarea class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline transition-colors focus:border-primary-container focus:outline-none" id="alamat_lengkap" name="alamat_lengkap" placeholder="Contoh: Jl. Raya Gumelar No. 19, RT 03/RW 05, Kec. Gumelar, Banyumas" required rows="3">{{ old('alamat_lengkap') }}</textarea>
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                            <span>Alamat sesuai KTP atau domisili saat ini.</span>
                        </p>
                    </div>

                    <!-- Desa Ranting -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="desa_ranting">Desa / Ranting MWCNU <span class="text-error">*</span></label>
                        <select class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface transition-colors focus:border-primary-container focus:outline-none" id="desa_ranting" name="desa_ranting" required>
                            <option value="" disabled {{ old('desa_ranting') ? '' : 'selected' }}>Pilih desa ranting</option>
                            @foreach ($desaList ?? [] as $desa)
                                <option value="{{ $desa }}" {{ old('desa_ranting') === $desa ? 'selected' : '' }}>{{ $desa }}</option>
                            @endforeach
                        </select>
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">account_balance</span>
                            <span>Pilih desa tempat Anda terdaftar sebagai warga NU.</span>
                        </p>
                    </div>
                </div>
            </section>

            <!-- Step 3: Unggah Dokumen -->
            <section class="mb-6 hidden rounded-xl border border-outline-variant/70 bg-surface-container-lowest p-5 sm:p-6 md:p-10" id="step-3">
                <div class="mb-6 sm:mb-8 border-b border-outline-variant/30 pb-5 sm:pb-6">
                    <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Langkah 3: Unggah Dokumen Pendukung</h2>
                    <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">Unggah pas foto 3x4 dan foto KTP (depan &amp; belakang) untuk verifikasi identitas oleh pengurus ranting.</p>
                </div>

                <div class="space-y-6">
                    <!-- Pas Foto -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="pas_foto">Pas Foto 3x4 <span class="text-error">*</span></label>
                        <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface file:mr-4 file:rounded-md file:border-0 file:bg-surface-container file:px-4 file:py-2 file:font-label-md file:text-label-md file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high transition-colors focus:border-primary-container focus:outline-none" id="pas_foto" name="pas_foto" required type="file" accept="image/jpeg,image/png,image/jpg">
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">face</span>
                            <span>Latar belakang merah atau biru, maksimal 2 MB. Foto ini menjadi foto profil KartaNU Anda.</span>
                        </p>
                    </div>

                    <!-- Foto KTP Depan -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="foto_ktp">Foto KTP Depan <span class="text-error">*</span></label>
                        <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface file:mr-4 file:rounded-md file:border-0 file:bg-surface-container file:px-4 file:py-2 file:font-label-md file:text-label-md file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high transition-colors focus:border-primary-container focus:outline-none" id="foto_ktp" name="foto_ktp" required type="file" accept="image/jpeg,image/png,image/jpg">
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">badge</span>
                            <span>Cantumkan foto KTP bagian depan. Format JPG/PNG, maksimal 2 MB.</span>
                        </p>
                    </div>

                    <!-- Foto KTP Belakang -->
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-label-md font-semibold text-on-surface" for="foto_ktp_belakang">Foto KTP Belakang <span class="text-error">*</span></label>
                        <input class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md text-on-surface file:mr-4 file:rounded-md file:border-0 file:bg-surface-container file:px-4 file:py-2 file:font-label-md file:text-label-md file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high transition-colors focus:border-primary-container focus:outline-none" id="foto_ktp_belakang" name="foto_ktp_belakang" required type="file" accept="image/jpeg,image/png,image/jpg">
                        <p class="mt-0.5 flex items-center gap-1.5 font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">badge</span>
                            <span>Cantumkan foto KTP bagian belakang. Format JPG/PNG, maksimal 2 MB.</span>
                        </p>
                    </div>
                </div>
            </section>

            <!-- Bottom Actions & Security Guarantee -->
            <div class="flex flex-col items-center justify-between gap-4 py-2 sm:flex-row">
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-primary text-[18px]">lock</span>
                    <span class="font-label-sm text-label-sm">Data Anda terenkripsi 256-bit standar sensus resmi MWCNU.</span>
                </div>
                <div class="flex w-full items-center gap-3 sm:w-auto">
                    <button class="inline-flex items-center justify-center rounded-lg border border-outline-variant px-5 py-3.5 font-label-md text-label-md font-semibold text-on-surface transition-colors hover:bg-surface-container cursor-pointer" id="btn-prev" type="button" style="display: none;">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <button class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-primary-container px-7 py-3.5 font-label-md text-label-md font-bold text-on-primary transition-colors hover:bg-tertiary-container cursor-pointer sm:flex-none" id="btn-next" type="button">
                        <span id="btn-next-label">Selanjutnya: Domisili &amp; Ranting</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Institutional Footer Note -->
        <div class="mt-12 border-t border-outline-variant/30 pt-6 text-center">
            <p class="font-body-sm text-body-sm text-outline">Pusat Bantuan &amp; Verifikasi Sensus: Gedung MWCNU Gumelar, Jl. Raya Gumelar No. 19, Banyumas.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentStep = 1;
        const totalSteps = 3;

        const stepSections = { 1: document.getElementById('step-1'), 2: document.getElementById('step-2'), 3: document.getElementById('step-3') };
        const steppers = { 1: document.getElementById('stepper-1'), 2: document.getElementById('stepper-2'), 3: document.getElementById('stepper-3') };
        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const btnNextLabel = document.getElementById('btn-next-label');
        const form = document.getElementById('kartanu-form');

        const stepLabels = { 1: 'Selanjutnya: Domisili & Ranting', 2: 'Selanjutnya: Unggah Dokumen', 3: 'Kirim Pendaftaran' };

        function updateStepper(step) {
            for (let i = 1; i <= totalSteps; i++) {
                const circle = steppers[i].querySelector('.stepper-circle');
                const status = steppers[i].querySelector('.stepper-status');
                if (i < step) {
                    circle.className = 'stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary-container font-label-md text-label-md font-bold text-on-primary ring-4 ring-surface';
                    circle.innerHTML = '<span class="material-symbols-outlined text-[20px]">check</span>';
                    steppers[i].classList.remove('opacity-75');
                    status.textContent = 'Selesai';
                    status.className = 'stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-primary-container';
                } else if (i === step) {
                    circle.className = 'stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary-container font-label-md text-label-md font-bold text-on-primary ring-4 ring-surface';
                    circle.textContent = i;
                    steppers[i].classList.remove('opacity-75');
                    status.textContent = 'Tahap Aktif';
                    status.className = 'stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-primary-container';
                } else {
                    circle.className = 'stepper-circle flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-outline-variant bg-surface-container-lowest font-label-md text-label-md font-semibold text-on-surface-variant ring-4 ring-surface';
                    circle.textContent = i;
                    steppers[i].classList.add('opacity-75');
                    status.textContent = 'Menunggu';
                    status.className = 'stepper-status font-label-caps text-label-caps font-semibold uppercase tracking-wide text-outline';
                }
            }
        }

        function showStep(step) {
            for (let i = 1; i <= totalSteps; i++) stepSections[i].classList.toggle('hidden', i !== step);
            updateStepper(step);
            btnPrev.style.display = step > 1 ? 'inline-flex' : 'none';
            btnNextLabel.textContent = stepLabels[step];
            btnNext.innerHTML = step === totalSteps
                ? '<span id="btn-next-label">' + stepLabels[step] + '</span><span class="material-symbols-outlined text-[18px]">send</span>'
                : '<span id="btn-next-label">' + stepLabels[step] + '</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span>';
        }

        function validateStep(step) {
            const section = stepSections[step];
            let valid = true;
            section.querySelectorAll('[required]').forEach(function(field) {
                if (!field.value || !field.value.trim()) {
                    valid = false;
                    field.classList.add('border-error');
                    field.addEventListener('input', function handler() { field.classList.remove('border-error'); field.removeEventListener('input', handler); });
                } else {
                    field.classList.remove('border-error');
                }
            });
            if (step === 1) {
                const nik = document.getElementById('nik');
                if (nik.value.length !== 16) { valid = false; nik.classList.add('border-error'); }

                const nama = document.getElementById('nama_lengkap');
                if (nama.value.trim().length < 3) { valid = false; nama.classList.add('border-error'); }

                const tempat = document.getElementById('tempat_lahir');
                if (tempat.value.trim().length < 3) { valid = false; tempat.classList.add('border-error'); }

                const wa = document.getElementById('no_whatsapp');
                if (!/^8[0-9]{8,11}$/.test(wa.value)) { valid = false; wa.classList.add('border-error'); }
            }
            return valid;
        }

        btnNext.addEventListener('click', function() {
            if (!validateStep(currentStep)) return;
            if (currentStep < totalSteps) { currentStep++; showStep(currentStep); }
            else { form.submit(); }
        });

        btnPrev.addEventListener('click', function() {
            if (currentStep > 1) { currentStep--; showStep(currentStep); }
        });

        // NIK counter
        const nikInput = document.getElementById('nik');
        const nikCounter = document.getElementById('nik-counter');
        if (nikInput && nikCounter) {
            nikInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                const count = e.target.value.length;
                nikCounter.textContent = count + ' / 16';
                nikCounter.classList.toggle('text-primary', count === 16);
                nikCounter.classList.toggle('text-on-surface-variant', count !== 16);
            });
        }

        // Batasi nama & tempat lahir: hanya huruf, spasi, dan tanda baca nama.
        ['nama_lengkap', 'tempat_lahir'].forEach(function(id) {
            const field = document.getElementById(id);
            if (!field) return;
            field.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^A-Za-z .,'\-]/g, '');
            });
        });

        // Nomor WhatsApp: hanya angka; awalan 0 dibuang karena sudah ada +62.
        const waInput = document.getElementById('no_whatsapp');
        if (waInput) {
            waInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
            });
        }

        // Gender pill styling
        const genderRadios = document.querySelectorAll('input[name="jenis_kelamin"]');
        const labelL = document.getElementById('label-gender-l');
        const labelP = document.getElementById('label-gender-p');
        genderRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'L') {
                    labelL.className = 'relative flex cursor-pointer items-center justify-between rounded-lg border border-primary-container bg-surface-container-low p-2.5 transition-colors sm:p-3.5';
                    labelP.className = 'relative flex cursor-pointer items-center justify-between rounded-lg border border-outline-variant bg-surface-container-lowest p-2.5 transition-colors hover:bg-surface-container-low sm:p-3.5';
                } else {
                    labelP.className = 'relative flex cursor-pointer items-center justify-between rounded-lg border border-primary-container bg-surface-container-low p-2.5 transition-colors sm:p-3.5';
                    labelL.className = 'relative flex cursor-pointer items-center justify-between rounded-lg border border-outline-variant bg-surface-container-lowest p-2.5 transition-colors hover:bg-surface-container-low sm:p-3.5';
                }
            });
        });

        showStep(1);
    });
</script>
@endsection
