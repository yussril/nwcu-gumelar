@extends('layouts.site')

@section('content')
<div class="w-full bg-surface text-on-surface">
    <section class="w-full px-6 py-8 md:py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <!-- Header Halaman -->
            <header class="mb-10 lg:mb-12">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-primary-fixed/40 px-3 py-1 text-primary">
                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-primary"></span>
                    <span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider">Pusat Informasi &amp; Layanan Warga • Kecamatan Gumelar</span>
                </div>
                <h1 class="mb-3 font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-on-surface lg:text-headline-xl">
                    Hubungi Kami
                </h1>
                <p class="max-w-3xl font-body-lg text-body-lg leading-relaxed text-on-surface-variant">
                    Pusat informasi, layanan bantuan KartaNU, dan lokasi sekretariat Majelis Wakil Cabang Nahdlatul Ulama Kecamatan Gumelar.
                </p>
            </header>

            <!-- Tata Letak 2 Kolom Seimbang -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <!-- KOLOM KIRI: Informasi, Kontak Cepat & Lokasi -->
                <div class="space-y-6 lg:col-span-6">
                    <!-- Kotak Alamat & Sekretariat -->
                    <article class="rounded-2xl bg-surface-container-lowest p-6 lg:p-7">
                        <div class="mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[22px] text-primary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            <span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary">Sekretariat Utama</span>
                        </div>
                        <h2 class="mb-2 font-headline-md text-headline-md font-bold leading-snug text-on-surface">
                            Sekretariat MWCNU Gumelar
                        </h2>
                        <p class="mb-5 font-body-md text-body-md leading-relaxed text-on-surface-variant">
                            Gedung Bersama MWCNU, Jl. Raya Gumelar No. 19, Kecamatan Gumelar, Kabupaten Banyumas, Jawa Tengah 53165
                        </p>
                        <div class="flex items-start gap-2.5 rounded-xl bg-surface-container-low p-3.5">
                            <span class="material-symbols-outlined mt-0.5 text-[18px] text-primary">schedule</span>
                            <div class="font-body-sm text-body-sm text-on-surface">
                                <span class="font-medium">Senin – Sabtu:</span> 08.00 – 16.00 WIB
                                <span class="mx-1 text-on-surface-variant">•</span>
                                <span class="text-on-surface-variant">Ahad / Hari Libur Nasional: Pelayanan Janji Temu</span>
                            </div>
                        </div>
                    </article>

                    <!-- Kotak Kontak Cepat -->
                    <article class="space-y-5 rounded-2xl bg-surface-container-lowest p-6 lg:p-7">
                        <div class="flex items-center justify-between pb-3">
                            <h3 class="font-headline-sm text-headline-sm font-bold leading-snug text-on-surface">Saluran Komunikasi Langsung</h3>
                            <span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">Respons Cepat</span>
                        </div>
                        <!-- Email -->
                        <div class="flex items-center justify-between gap-3 rounded-xl bg-surface-container-low p-3 transition-colors hover:bg-surface-container">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-surface-container-highest">
                                    <span class="material-symbols-outlined text-[20px] text-primary">mail</span>
                                </div>
                                <div class="min-w-0">
                                    <span class="block font-label-caps text-label-caps font-semibold uppercase tracking-wide text-on-surface-variant">Email Resmi</span>
                                    <span class="block truncate font-body-md text-body-md font-medium text-on-surface" id="email-text">admin@mwcnu-gumelar.or.id</span>
                                </div>
                            </div>
                            <button class="flex shrink-0 items-center gap-1 rounded-lg bg-surface-container px-3 py-1.5 font-label-sm text-label-sm text-on-surface transition-colors hover:bg-primary-fixed hover:text-primary" id="copy-btn" onclick="copyEmail()" title="Salin alamat surel" type="button">
                                <span class="material-symbols-outlined text-[16px]">content_copy</span>
                                <span>Salin</span>
                            </button>
                        </div>
                        <!-- Hotline WhatsApp -->
                        <a class="group flex items-center justify-between gap-3 rounded-xl bg-surface-container-low p-3 transition-colors hover:bg-surface-container" href="https://wa.me/6281228901926" rel="noopener noreferrer" target="_blank">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[20px]">call</span>
                                </div>
                                <div class="min-w-0">
                                    <span class="block font-label-caps text-label-caps font-semibold uppercase tracking-wide text-on-surface-variant">Hotline &amp; Layanan Warga</span>
                                    <span class="block truncate font-body-md text-body-md font-semibold text-on-surface">0812-2890-1926</span>
                                </div>
                            </div>
                            <span class="flex shrink-0 items-center gap-1 rounded-full bg-primary-fixed/40 px-2.5 py-1 font-label-caps text-label-caps font-semibold uppercase text-primary">
                                <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                                WhatsApp Aktif
                            </span>
                        </a>
                        <!-- Konsultasi KartaNU -->
                        <div class="flex items-start gap-3 rounded-xl bg-surface-container-high/60 p-3.5">
                            <span class="material-symbols-outlined mt-0.5 shrink-0 text-[20px] text-primary">badge</span>
                            <div class="font-body-sm text-body-sm leading-relaxed text-on-surface-variant">
                                <strong class="font-semibold text-on-surface">Konsultasi Sensus KartaNU Ranting:</strong> Hubungi Pengurus Ranting NU di 10 Desa binaan setempat atau loket layanan KartaNU Lantai 1 Gedung MWCNU Gumelar.
                            </div>
                        </div>
                    </article>

                    <!-- Tombol Saluran WhatsApp -->
                    <a class="group block rounded-2xl bg-surface-container-lowest p-5 transition-colors hover:bg-primary-fixed/20" href="https://whatsapp.com/channel" rel="noopener noreferrer" target="_blank">
                        <div class="mb-1 flex items-center justify-center gap-2.5 font-headline-sm text-headline-sm font-bold text-primary">
                            <svg aria-hidden="true" class="h-5 w-5 shrink-0 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 2C6.495 2 2 6.493 2 12.028c0 1.97.57 3.807 1.558 5.36L2 22l4.767-1.53a9.972 9.972 0 0 0 5.264 1.558h.005c5.534 0 10.027-4.492 10.027-10.028 0-2.678-1.043-5.197-2.937-7.091A10.007 10.007 0 0 0 12.031 2zm0 18.23a8.212 8.212 0 0 1-4.22-1.162l-.303-.18-2.82.905.918-2.75-.198-.316a8.225 8.225 0 0 1-1.258-4.4c0-4.542 3.696-8.238 8.24-8.238 2.2 0 4.269.858 5.823 2.413a8.217 8.217 0 0 1 2.41 5.826c0 4.542-3.696 8.24-8.24 8.24zm4.516-6.177c-.247-.124-1.464-.723-1.691-.806-.227-.082-.393-.124-.558.124-.165.247-.64.806-.784.97-.144.165-.289.186-.536.062-.247-.124-1.044-.385-1.989-1.228-.735-.656-1.232-1.467-1.376-1.714-.144-.247-.015-.38.109-.503.111-.112.247-.29.371-.434.124-.144.165-.247.247-.412.082-.165.041-.31-.021-.433-.062-.124-.558-1.343-.764-1.84-.2-.484-.403-.418-.558-.426l-.475-.008c-.165 0-.433.062-.66.31-.227.247-.866.847-.866 2.066 0 1.219.887 2.396 1.011 2.561.124.165 1.745 2.665 4.228 3.738.591.256 1.052.409 1.411.523.593.188 1.133.161 1.56.098.476-.071 1.464-.599 1.67-1.176.206-.577.206-1.072.144-1.175-.062-.103-.227-.165-.474-.288z"></path>
                            </svg>
                            <span>Ikuti Saluran WhatsApp MWCNU</span>
                        </div>
                        <p class="mx-auto max-w-md text-center font-body-sm text-body-sm text-on-surface-variant">
                            Dapatkan warta harian, pengumuman ta'lim, dan info resmi langsung di aplikasi WhatsApp Anda.
                        </p>
                    </a>

                    <!-- Placeholder Peta Interaktif -->
                    <article class="space-y-3 overflow-hidden rounded-2xl bg-surface-container-lowest p-3">
                        <div class="relative flex h-64 flex-col items-center justify-center overflow-hidden rounded-xl bg-surface-container-high bg-cover bg-center p-6 text-center" data-location="Gedung Bersama MWCNU Gumelar, Banyumas">
                            <!-- Peta Grafis Geometris Vektor Pelengkap -->
                            <div class="pointer-events-none absolute inset-0 opacity-15">
                                <svg class="h-full w-full text-on-surface" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern height="36" id="grid-pattern" patternUnits="userSpaceOnUse" width="36">
                                            <path d="M 36 0 L 0 0 0 36" fill="none" stroke="currentColor" stroke-width="1"></path>
                                        </pattern>
                                    </defs>
                                    <rect fill="url(#grid-pattern)" height="100%" width="100%"></rect>
                                </svg>
                            </div>
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-on-primary">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">pin_drop</span>
                                </div>
                                <span class="mb-1 font-headline-sm text-headline-sm font-bold text-on-surface">Gedung Bersama MWCNU Gumelar</span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Peta Interaktif (Google Maps) • Gumelar, Banyumas</p>
                                <div class="mt-2 rounded-full bg-surface-container-lowest px-3 py-1 font-label-caps text-label-caps font-semibold uppercase text-primary">
                                    Lat: -7.3684, Long: 108.9881
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between px-2 pb-1 pt-1">
                            <span class="font-label-sm text-label-sm text-on-surface-variant">Titik Penjemputan &amp; Parkir Kendaraan Tersedia</span>
                            <a class="inline-flex items-center gap-1.5 rounded-lg bg-surface-container px-3 py-1.5 font-label-md text-label-md font-medium text-on-surface transition-colors hover:bg-primary-fixed hover:text-primary" href="https://maps.google.com/?q=Gedung+MWCNU+Gumelar+Banyumas" rel="noopener noreferrer" target="_blank">
                                <span>Buka di Google Maps</span>
                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- KOLOM KANAN: Formulir Pesan Singkat -->
                <div class="lg:col-span-6">
                    <article class="rounded-2xl bg-surface-container-lowest p-6 sm:p-8 lg:p-10">
                        <header class="mb-8">
                            <div class="mb-3 inline-flex items-center gap-1.5 rounded-full bg-primary-fixed/40 px-2.5 py-1 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary">
                                <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                                Respons Cepat
                            </div>
                            <h2 class="mb-2 font-headline-lg text-headline-lg font-extrabold leading-tight text-on-surface">
                                Kirim Pesan
                            </h2>
                            <p class="font-body-md text-body-md leading-relaxed text-on-surface-variant">
                                Sampaikan pertanyaan, masukan perkhidmatan, atau permohonan informasi kepada pengurus harian MWCNU Gumelar.
                            </p>
                        </header>
                        <form class="space-y-6" id="contact-form" action="{{ route('kontak.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 font-body-sm text-body-sm text-on-error-container" role="alert">
                                    <p class="mb-1 font-bold">Periksa kembali isian pesan Anda:</p>
                                    <ul class="list-disc space-y-0.5 pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Nama Lengkap -->
                            <div class="space-y-2">
                                <label class="block font-label-md text-label-md font-medium text-on-surface" for="full_name">
                                    Nama Lengkap <span class="text-error">*</span>
                                </label>
                                <input class="w-full rounded-xl bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface transition-all placeholder:text-on-surface-variant/50 focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary" id="full_name" name="full_name" placeholder="Contoh: Ahmad Fauzan Wahid" required type="text" value="{{ old('full_name') }}">
                            </div>
                            <!-- WhatsApp / Email -->
                            <div class="space-y-2">
                                <label class="block font-label-md text-label-md font-medium text-on-surface" for="contact_point">
                                    Nomor WhatsApp / Email <span class="text-error">*</span>
                                </label>
                                <input class="w-full rounded-xl bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface transition-all placeholder:text-on-surface-variant/50 focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary" id="contact_point" name="contact_point" placeholder="Contoh: 08123456789 atau nama@email.com" required type="text" value="{{ old('contact_point') }}">
                            </div>
                            <!-- Kategori Pesan / Topik -->
                            <div class="space-y-2">
                                <label class="block font-label-md text-label-md font-medium text-on-surface" for="category">
                                    Kategori Keperluan
                                </label>
                                <div class="relative">
                                    <select class="w-full cursor-pointer appearance-none rounded-xl bg-surface-container-low px-4 py-3 pr-10 font-body-md text-body-md text-on-surface transition-all focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary" id="category" name="category">
                                        <option value="kartanu" {{ old('category', 'kartanu') === 'kartanu' ? 'selected' : '' }}>Layanan KartaNU</option>
                                        <option value="jamiyyah" {{ old('category') === 'jamiyyah' ? 'selected' : '' }}>Informasi Jam'iyyah / Banom</option>
                                        <option value="lazisnu" {{ old('category') === 'lazisnu' ? 'selected' : '' }}>UPZIS LAZISNU</option>
                                        <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    <span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">
                                        expand_more
                                    </span>
                                </div>
                            </div>
                            <!-- Isi Pesan -->
                            <div class="space-y-2">
                                <label class="block font-label-md text-label-md font-medium text-on-surface" for="message">
                                    Isi Pesan <span class="text-error">*</span>
                                </label>
                                <textarea class="w-full resize-y rounded-xl bg-surface-container-low px-4 py-3 font-body-md text-body-md text-on-surface transition-all placeholder:text-on-surface-variant/50 focus:bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary" id="message" name="message" placeholder="Tuliskan pesan, permohonan informasi, atau saran Anda secara rinci di sini..." required rows="5">{{ old('message') }}</textarea>
                            </div>
                            <!-- Catatan Privasi Singkat -->
                            <div class="flex items-start gap-2.5 rounded-xl bg-surface-container-low p-3 text-on-surface-variant">
                                <span class="material-symbols-outlined mt-0.5 shrink-0 text-[18px] text-primary">lock</span>
                                <p class="font-body-sm text-body-sm leading-relaxed">
                                    Data kontak Anda hanya digunakan oleh sekretariat MWCNU Gumelar untuk keperluan konfirmasi balasan pesan resmi.
                                </p>
                            </div>
                            <!-- Pesan Konfirmasi Kirim (tampil setelah pesan tersimpan) -->
                            <div class="{{ session('success') ? 'flex' : 'hidden' }} items-center gap-3 rounded-xl bg-primary-fixed p-4 font-body-md text-body-md text-primary" id="form-success" role="status">
                                <span class="material-symbols-outlined text-[24px]">check_circle</span>
                                <div>
                                    <p class="font-bold">Pesan Berhasil Terkirim!</p>
                                    <p class="font-body-sm text-body-sm font-normal leading-relaxed">{{ session('success', 'Sekretariat MWCNU Gumelar akan menghubungi Anda dalam waktu 1x24 jam.') }}</p>
                                </div>
                            </div>
                            <!-- Tombol Aksi Solid Hijau Gelap -->
                            <button class="group flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-primary-container px-6 py-4 font-headline-sm text-headline-sm font-bold text-on-primary transition-all duration-200 hover:bg-primary" id="submit-btn" type="submit">
                                <span>Kirim Pesan</span>
                                <span class="material-symbols-outlined text-[20px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                            </button>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function copyEmail() {
        const email = document.getElementById('email-text').innerText;
        navigator.clipboard.writeText(email).then(() => {
            const btn = document.getElementById('copy-btn');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `<span class="material-symbols-outlined text-[16px]">done</span><span>Tersalin</span>`;
            btn.classList.add('bg-primary-fixed', 'text-primary');
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-primary-fixed', 'text-primary');
            }, 2000);
        });
    }

    // Tampilkan status "mengirim" selama formulir diproses server, lalu sembunyikan notifikasi sukses.
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const successMsg = document.getElementById('form-success');

    contactForm.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span><span>Mengirimkan Pesan...</span>`;
    });

    if (!successMsg.classList.contains('hidden')) {
        setTimeout(() => successMsg.classList.add('hidden'), 8000);
    }
</script>
@endsection
