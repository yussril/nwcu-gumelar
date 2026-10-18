<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Masuk Admin - MWCNU Gumelar' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-dvh bg-background font-body-md text-on-surface antialiased">
        <main class="flex min-h-dvh">
            <!-- Left Panel - Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-[45%] xl:w-[40%] relative overflow-hidden bg-primary">
                <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-tertiary-container opacity-90"></div>
                <div class="relative z-10 flex flex-col justify-between p-10 xl:p-14 text-on-primary w-full">
                    <!-- Top: Logo & Brand -->
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center p-2">
                            <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain filter brightness-0 invert">
                        </div>
                        <div>
                            <h1 class="font-headline-md text-headline-md font-bold tracking-tight">MWCNU ADMIN</h1>
                            <p class="font-label-caps text-label-caps text-on-primary/70 tracking-widest mt-1">KECAMATAN GUMELAR</p>
                        </div>
                    </div>

                    <!-- Center: Welcome Message -->
                    <div class="space-y-6">
                        <h2 class="font-headline-xl text-headline-xl xl:text-display-hero-mobile font-bold tracking-tight leading-tight">
                            Sistem Informasi &<br>Manajemen Data
                        </h2>
                        <p class="font-body-lg text-body-lg text-on-primary/80 max-w-md leading-relaxed">
                            Akses portal administrasi untuk mengelola data kelembagaan, sensus KartaNU, dan publikasi warta MWCNU Kecamatan Gumelar.
                        </p>
                        <div class="flex items-center gap-6 pt-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">shield</span>
                                <span class="font-label-md text-label-md">Aman & Terenkripsi</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">speed</span>
                                <span class="font-label-md text-label-md">Akses Cepat</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom: Footer Info -->
                    <div class="space-y-2">
                        <div class="h-px bg-white/20 w-full"></div>
                        <p class="font-label-sm text-label-sm text-on-primary/60 tracking-wide">
                            MWCNU Kecamatan Gumelar — Kab. Banyumas
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Login Form -->
            <div class="flex-1 flex flex-col justify-center items-center px-4 py-10 sm:px-8 sm:py-12 lg:px-16 xl:px-24 bg-surface-container-lowest">
                <!-- Mobile Logo (Visible only on mobile) -->
                <div class="lg:hidden flex items-center gap-3 mb-8 sm:mb-10">
                    <div class="w-12 h-12 rounded-xl overflow-hidden flex items-center justify-center bg-primary">
                        <img src="{{ asset('images/logo-nu-40178.png') }}" alt="Logo MWCNU Gumelar" class="w-full h-full object-contain filter brightness-0 invert">
                    </div>
                    <div>
                        <h1 class="font-headline-sm text-headline-sm font-bold text-primary tracking-tight">MWCNU ADMIN</h1>
                        <p class="font-label-caps text-label-caps text-secondary tracking-widest mt-0.5">KEC. GUMELAR</p>
                    </div>
                </div>

                <!-- Login Form Container -->
                <div class="w-full max-w-md">
                    <!-- Header -->
                    <div class="text-center mb-10">
                        <h2 class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">
                            Masuk ke Portal
                        </h2>
                        <p class="font-body-md text-body-md text-secondary mt-2">
                            Masukkan kredensial administrator Anda
                        </p>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-5 sm:p-8 shadow-sm">
                        {{ $slot }}
                    </div>

                    <!-- Back Link -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                            <span>Kembali ke situs publik</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
