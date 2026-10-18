<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? 'MWCNU Kecamatan Gumelar' }}</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        @layer base {
            html, body { margin:0; padding:0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top:0!important; }
            main > :last-child { margin-bottom:0!important; }
        }
    </style>
    @yield('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-surface font-body-md text-on-surface antialiased selection:bg-primary selection:text-on-primary"
    x-data="{ navOpen: false }"
    x-init="
        const desktop = window.matchMedia('(min-width: 64rem)');
        desktop.addEventListener('change', (event) => { if (event.matches) $data.navOpen = false; });
    "
    x-effect="document.documentElement.style.overflow = navOpen ? 'hidden' : ''; document.body.style.overflow = navOpen ? 'hidden' : ''"
    @keydown.escape.window="navOpen = false"
>
    <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[90] focus:rounded-lg focus:bg-primary-container focus:px-4 focus:py-2 focus:text-white" href="#konten-utama">Lompat ke konten utama</a>

    @php
        $navLinks = [
            ['route' => 'beranda', 'match' => 'beranda', 'label' => 'Beranda', 'icon' => 'home'],
            ['route' => 'berita', 'match' => 'berita*', 'label' => 'Berita', 'icon' => 'newspaper'],
            ['route' => 'banom', 'match' => 'banom', 'label' => 'Banom', 'icon' => 'groups'],
            ['route' => 'kegiatan', 'match' => 'kegiatan*', 'label' => 'Kegiatan', 'icon' => 'event'],
            ['route' => 'galeri', 'match' => 'galeri*', 'label' => 'Galeri', 'icon' => 'photo_library'],
            ['route' => 'kartanu', 'match' => 'kartanu*', 'label' => 'KartaNU', 'icon' => 'badge'],
            ['route' => 'kontak', 'match' => 'kontak*', 'label' => 'Kontak', 'icon' => 'call'],
        ];
    @endphp

    <header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/85 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.03)] transition-all">
        <div class="h-16 sm:h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between gap-3 sm:gap-6 w-full border-b border-slate-200/80">
            <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 shrink">
                <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU" class="h-8 sm:h-9 w-auto object-contain shrink-0">
                <div class="flex flex-col leading-none min-w-0">
                    <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold truncate">MWCNU GUMELAR</span>
                    <span class="hidden sm:block font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide mt-1">Kecamatan Gumelar, Banyumas</span>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-6 xl:gap-8" aria-label="Navigasi utama">
                @foreach ($navLinks as $link)
                    <a class="whitespace-nowrap font-label-md text-label-md font-semibold transition-colors pb-0.5 {{ request()->routeIs($link['match']) ? 'text-[#047857] border-b-2 border-[#047857]' : 'text-slate-600 hover:text-slate-900' }}" href="{{ route($link['route']) }}">{{ $link['label'] }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                @auth
                    <a class="hidden sm:inline-flex items-center justify-center px-5 py-2 rounded-xl bg-primary-container text-white font-label-md text-label-md font-semibold hover:bg-primary transition-all" href="{{ route('dashboard') }}">Admin</a>
                @endauth
                <button
                    aria-controls="menu-mobile"
                    aria-expanded="false"
                    aria-label="Buka menu navigasi"
                    class="lg:hidden flex h-10 w-10 items-center justify-center rounded-xl border border-outline-variant/40 bg-surface-container-lowest text-on-surface transition-colors active:scale-95"
                    type="button"
                    x-bind:aria-expanded="navOpen"
                    x-on:click="navOpen = true"
                >
                    <span class="material-symbols-outlined text-[24px]">menu</span>
                </button>
            </div>
        </div>
    </header>

    {{--
        Drawer navigasi untuk layar ponsel & tablet (Android/iOS).
        z-index WAJIB di sini: header memakaim `z-50`, sedangkan elemen `fixed` tanpa
        z-index akan tergambar di lapisan z-index:auto (di bawah header). Tanpa itu,
        baris logo & tombol tutup di bagian atas drawer tertutup header sehingga
        tidak bisa diketuk.
    --}}
    <div class="lg:hidden" id="menu-mobile" x-cloak x-show="navOpen">
        <div
            class="fixed inset-0 z-[60] bg-black/50 backdrop-blur-sm"
            x-show="navOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-on:click="navOpen = false"
        ></div>

        <div
            class="fixed inset-y-0 left-0 z-[70] flex w-[86%] max-w-sm flex-col bg-surface-container-lowest shadow-2xl"
            x-show="navOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            role="dialog"
            aria-modal="true"
            aria-label="Menu navigasi"
        >
            <div class="flex items-center justify-between gap-3 border-b border-outline-variant/30 px-4 py-3.5">
                <div class="flex items-center gap-2.5 min-w-0">
                    <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU" class="h-9 w-auto object-contain shrink-0">
                    <div class="flex flex-col leading-none min-w-0">
                        <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold truncate">MWCNU GUMELAR</span>
                        <span class="font-label-caps text-label-caps text-on-surface-variant tracking-wide mt-1">Kec. Gumelar, Banyumas</span>
                    </div>
                </div>
                <button
                    aria-label="Tutup menu navigasi"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-on-surface transition-colors active:scale-95"
                    type="button"
                    x-on:click="navOpen = false"
                >
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto overscroll-contain px-3 py-4" aria-label="Navigasi utama (ponsel)">
                <ul class="flex flex-col gap-1">
                    @foreach ($navLinks as $link)
                        @php $active = request()->routeIs($link['match']); @endphp
                        <li>
                            <a
                                class="flex items-center gap-3 rounded-xl px-3 py-3.5 font-label-md text-label-md font-semibold transition-colors {{ $active ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant active:bg-surface-container-low' }}"
                                href="{{ route($link['route']) }}"
                                @if ($active) aria-current="page" @endif
                                x-on:click="navOpen = false"
                            >
                                <span class="material-symbols-outlined text-[22px] shrink-0">{{ $link['icon'] }}</span>
                                <span>{{ $link['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="border-t border-outline-variant/30 p-4">
                <a class="mb-3 flex items-center justify-center gap-2 rounded-xl bg-primary-container px-5 py-3.5 font-label-md text-label-md font-semibold text-white transition-colors active:scale-[0.98]" href="{{ route('pendaftaran.kartanu') }}" x-on:click="navOpen = false">
                    <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                    Registrasi KartaNU
                </a>
                @auth
                    <a class="flex items-center justify-center gap-2 rounded-xl border border-outline-variant/50 bg-surface-container-low px-5 py-3.5 font-label-md text-label-md font-semibold text-on-surface transition-colors active:scale-[0.98]" href="{{ route('dashboard') }}" x-on:click="navOpen = false">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        Masuk Dashboard Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <main class="w-full pt-16 sm:pt-20 bg-surface">
        <div class="flex flex-col w-full bg-surface-container-lowest overflow-hidden selection:bg-primary selection:text-on-primary">
            <div id="konten-utama">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="w-full bg-surface-container-lowest border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-8 pb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="flex flex-col">
                    <div class="flex items-center gap-3.5 mb-5">
                        <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU" class="h-8 w-auto object-contain shrink-0">
                        <div class="flex flex-col leading-none min-w-0">
                            <span class="font-headline-sm text-headline-sm text-primary font-bold truncate">MWCNU GUMELAR</span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide mt-1">Kecamatan Gumelar, Banyumas</span>
                        </div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Merawat Jagat Membangun Peradaban: Berkhidmat untuk Ummat, Memperkokoh Tradisi Ahlussunnah wal Jama'ah An-Nahdliyyah.</p>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm text-on-surface font-bold mb-6">Navigasi & Layanan</span>
                    <ul class="-mx-2 flex flex-col font-body-md text-body-md text-on-surface-variant">
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('berita') }}">Berita</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('banom') }}">Badan Otonom (Banom)</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('kegiatan') }}">Kegiatan</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('galeri') }}">Galeri Dokumentasi</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('kartanu') }}">Layanan KartaNU</a></li>
                        <li><a class="inline-block rounded-lg px-2 py-2 transition-colors hover:bg-surface-container-low hover:text-primary" href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm text-on-surface font-bold mb-6">Sekretariat & Gedung Bersama</span>
                    <address class="not-italic font-body-sm text-body-sm text-on-surface-variant flex flex-col gap-2.5">
                        <p class="leading-relaxed">Gedung Bersama MWCNU Gumelar<br>Jl. Raya Gumelar No. 09, Kec. Gumelar, Banyumas 53165</p>
                        <p class="leading-relaxed">Surel: <a href="mailto:sekretariat@mwcnu-gumelar.or.id" class="text-primary hover:underline">sekretariat@mwcnu-gumelar.or.id</a></p>
                        <p class="leading-relaxed font-semibold text-on-surface mt-1">Pusat Pelayanan: <a href="tel:+6281234567890" class="hover:text-primary transition-colors">+62 821-3456-7890</a></p>
                    </address>
                    <a class="mt-3 inline-flex items-center gap-1.5 rounded-lg px-2 py-2 font-label-md text-label-md font-medium text-primary transition-colors hover:bg-primary-fixed/20 hover:underline" href="{{ route('kontak') }}">
                        <span>Halaman Kontak</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant border-t border-slate-200">
                <p class="text-center md:text-start">© 2025 MWCNU Kecamatan Gumelar. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>