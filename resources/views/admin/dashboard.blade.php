@extends('admin.layout')

@section('content')
<!-- Top Greeting & Realtime Status Scrim -->
<section class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-8 border-b border-surface-container/50 mb-8">
    <div class="flex flex-col gap-2 max-w-3xl">
        <div class="flex items-center gap-2">
            <span class="text-outline-variant">•</span>
            <span class="font-label-sm text-label-sm text-secondary">Kecamatan Gumelar, Banyumas</span>
        </div>
        <h1 class="font-headline-xl font-semibold text-headline-xl text-on-surface tracking-tight leading-none">
            Selamat Datang di Pusat Informasi MWCNU.
        </h1>
        <p class="font-body-lg text-body-lg text-secondary pt-1">
            Pantau aktivitas administrasi, publikasi warta, dan layanan umat hari ini secara terpadu dan presisi.
        </p>
    </div>
</section>

<!-- Metric Statistics Bento Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
    <!-- Stat 1: KartaNU -->
    <div class="bg-surface-container-lowest rounded-2xl p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md border border-surface-container/50">
        <div class="flex items-center justify-between mb-4">
            <span class="font-label-md text-label-md text-secondary font-medium">Total KartaNU</span>
            <div class="w-10 h-10 rounded-xl bg-primary-fixed/40 flex items-center justify-center text-primary-container">
                <span class="material-symbols-outlined text-[22px]">badge</span>
            </div>
        </div>
        <div>
            <div class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">{{ number_format($kartaNuCount ?? 5) }} <span class="font-body-md text-body-md font-normal text-secondary">Jiwa</span></div>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="material-symbols-outlined text-primary-container text-[16px]">trending_up</span>
                <span class="font-label-sm text-label-sm text-primary-container font-semibold">verifikasi aktif</span>
            </div>
        </div>
    </div>
    <!-- Stat 2: Koin NU -->
    <div class="bg-surface-container-lowest rounded-2xl p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md border border-surface-container/50">
        <div class="flex items-center justify-between mb-4">
            <span class="font-label-md text-label-md text-secondary font-medium">Koin NU Bulan Ini</span>
            <div class="w-10 h-10 rounded-xl bg-primary-fixed/40 flex items-center justify-center text-primary-container">
                <span class="material-symbols-outlined text-[22px]">payments</span>
            </div>
        </div>
        <div>
            <div class="font-headline-lg text-headline-lg font-bold text-primary-container tracking-tight">Rp {{ number_format($koinNuTotal ?? 34200000, 0, ',', '.') }}</div>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="font-label-sm text-label-sm text-primary-container font-semibold">LAZISNU</span>
                <span class="font-body-sm text-body-sm text-secondary">se-Kec. Gumelar</span>
            </div>
        </div>
    </div>
    <!-- Stat 3: Warta Diterbitkan -->
    <div class="bg-surface-container-lowest rounded-2xl p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md border border-surface-container/50">
        <div class="flex items-center justify-between mb-4">
            <span class="font-label-md text-label-md text-secondary font-medium">Warta Diterbitkan</span>
            <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center text-on-surface-variant">
                <span class="material-symbols-outlined text-[22px]">newspaper</span>
            </div>
        </div>
        <div>
            <div class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">{{ number_format($publishedArticleCount ?? 11) }} <span class="font-body-md text-body-md font-normal text-secondary">Artikel</span></div>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="material-symbols-outlined text-secondary text-[16px]">schedule</span>
                <span class="font-label-sm text-label-sm text-secondary">{{ $articleCount ?? 11 }} total tersimpan</span>
            </div>
        </div>
    </div>
    <!-- Stat 4: Banom & Ranting -->
    <div class="bg-surface-container-lowest rounded-2xl p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md border border-surface-container/50">
        <div class="flex items-center justify-between mb-4">
            <span class="font-label-md text-label-md text-secondary font-medium">Banom &amp; Ranting Aktif</span>
            <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center text-on-surface-variant">
                <span class="material-symbols-outlined text-[22px]">diversity_3</span>
            </div>
        </div>
        <div>
            <div class="font-headline-lg text-headline-lg font-bold text-on-surface tracking-tight">{{ number_format($activeBanomCount ?? 6) }} <span class="font-body-md text-body-md font-normal text-secondary">Entitas</span></div>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                <span class="font-label-sm text-label-sm text-secondary">{{ $memberCount ?? 54 }} pengurus terdaftar</span>
            </div>
        </div>
    </div>
</section>

<!-- Middle Row: Analytical Visualizations & Operational Access -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-10">
    <!-- Left Column: Publikasi & Organisasi Progress (8 Cols) -->
    <div class="lg:col-span-8 bg-surface-container-lowest rounded-2xl p-8 flex flex-col justify-between shadow-sm border border-surface-container/50">
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8">
            <div>
                <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Publikasi &amp; Organisasi</span>
                <h2 class="font-headline-md text-headline-md font-bold text-on-surface tracking-tight mt-1">Ringkasan Pengelolaan</h2>
                <p class="font-body-sm text-body-sm text-secondary">Status konten yang dikelola melalui dashboard MWCNU.</p>
            </div>
            <span class="inline-flex items-center gap-2 self-start rounded-full bg-surface-container-low px-4 py-2 font-label-sm text-label-sm font-semibold text-on-surface">
                <span class="material-symbols-outlined text-[16px] text-secondary">calendar_today</span>
                {{ now()->translatedFormat('d M Y') }}
            </span>
        </div>
        <div class="flex flex-col gap-6 pt-2">
            @php
                $progressData = [
                    ['Warta terbit', $publishedArticleCount ?? 11, $articleCount ?? 11, 'article'], 
                    ['Dokumentasi publik', $publishedGalleryCount ?? 12, $galleryCount ?? 12, 'photo_library'], 
                    ['Banom aktif', $activeBanomCount ?? 6, $banomCount ?? 6, 'account_tree']
                ];
            @endphp
            
            @foreach ($progressData as [$label, $visible, $total, $icon])
                <div>
                    <div class="mb-3 flex items-center justify-between gap-4 text-sm">
                        <span class="flex items-center gap-2 font-medium text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px] text-primary">{{ $icon }}</span>{{ $label }}
                        </span>
                        <span class="font-body-sm text-body-sm text-secondary font-bold">{{ $visible }} / {{ $total }}</span>
                    </div>
                    <div class="h-2.5 w-full overflow-hidden rounded-full bg-surface-container-high">
                        <div class="h-full rounded-full bg-primary-container transition-all duration-500" style="width: {{ $total ? round(($visible / $total) * 100) : 0 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 border-t border-surface-container pt-5 font-body-sm text-body-sm text-secondary">Data KartaNU dan galeri dokumentasi dapat dikelola melalui modul masing-masing.</div>
    </div>

    <!-- Right Column: Quick Operational Dispatch (4 Cols) -->
    <div class="lg:col-span-4 bg-surface-container-lowest rounded-2xl p-8 flex flex-col justify-between shadow-sm border border-surface-container/50">
        <div>
            <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Tindakan Cepat</span>
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface tracking-tight mt-1">Akses Cepat</h2>
            <p class="font-body-sm text-body-sm text-secondary mb-6">Operasional harian sekretariat dan koordinasi banom.</p>
            <div class="flex flex-col gap-4">
                <a class="group p-4 rounded-xl bg-surface-container-low hover:bg-primary-fixed/20 transition-all flex items-center justify-between border border-transparent hover:border-primary-fixed" href="{{ route('admin.articles.create') }}">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-sm">
                            <span class="material-symbols-outlined text-[22px]">edit_note</span>
                        </div>
                        <div class="flex flex-col truncate">
                            <span class="font-label-md text-label-md font-bold text-on-surface group-hover:text-primary-container truncate transition-colors">Tulis Warta Baru</span>
                            <span class="font-body-sm text-body-sm text-secondary truncate mt-0.5">Publikasikan warta atau siaran pers</span>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-primary-container transition-colors shrink-0 pl-2">chevron_right</span>
                </a>
                <a class="group p-4 rounded-xl bg-surface-container-low hover:bg-primary-fixed/20 transition-all flex items-center justify-between border border-transparent hover:border-primary-fixed" href="{{ route('admin.banoms.create') }}">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-surface-container text-primary-container flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px]">person_add</span>
                        </div>
                        <div class="flex flex-col truncate">
                            <span class="font-label-md text-label-md font-bold text-on-surface group-hover:text-primary-container truncate transition-colors">Tambah Banom</span>
                            <span class="font-body-sm text-body-sm text-secondary truncate mt-0.5">Mutasi atau input kepengurusan</span>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-primary-container transition-colors shrink-0 pl-2">chevron_right</span>
                </a>
                <a class="group p-4 rounded-xl bg-surface-container-low hover:bg-primary-fixed/20 transition-all flex items-center justify-between border border-transparent hover:border-primary-fixed" href="{{ route('admin.kegiatans.create') }}">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-surface-container text-primary-container flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px]">event</span>
                        </div>
                        <div class="flex flex-col truncate">
                            <span class="font-label-md text-label-md font-bold text-on-surface group-hover:text-primary-container truncate transition-colors">Tambah Kegiatan</span>
                            <span class="font-body-sm text-body-sm text-secondary truncate mt-0.5">Jadwalkan kegiatan yang akan datang</span>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-primary-container transition-colors shrink-0 pl-2">chevron_right</span>
                </a>
                <a class="group p-4 rounded-xl bg-surface-container-low hover:bg-primary-fixed/20 transition-all flex items-center justify-between border border-transparent hover:border-primary-fixed" href="{{ route('admin.pesan.index') }}">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-surface-container text-primary-container flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-[22px]">mail</span>
                        </div>
                        <div class="flex flex-col truncate">
                            <span class="font-label-md text-label-md font-bold text-on-surface group-hover:text-primary-container truncate transition-colors">Buka Kotak Pesan</span>
                            <span class="font-body-sm text-body-sm text-secondary truncate mt-0.5">Tinjau pesan dari halaman kontak</span>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-primary-container transition-colors shrink-0 pl-2">chevron_right</span>
                </a>
            </div>
        </div>
        <div class="mt-8 p-4 rounded-xl bg-surface-container flex items-center gap-4 border border-surface-container-highest">
            <span class="material-symbols-outlined text-primary-container text-[24px]">contact_support</span>
            <div class="flex flex-col">
                <span class="font-label-sm text-label-sm font-semibold text-on-surface">Pusat Bantuan SIK &amp; KartaNU</span>
                <span class="font-body-sm text-[12px] text-secondary mt-0.5">Hubungi Helpdesk Lembaga LTNNU</span>
            </div>
        </div>
    </div>
</section>

<!-- Inbox: Messages from the Public Contact Page -->
<section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-surface-container/50 mb-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-6 border-b border-surface-container">
        <div>
            <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Kotak Masuk</span>
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface tracking-tight mt-1">Pesan dari Halaman Kontak</h2>
            <p class="font-body-sm text-body-sm text-secondary">Pertanyaan, masukan, dan permohonan informasi yang dikirim warga melalui situs.</p>
        </div>
        <a href="{{ route('admin.pesan.index') }}" class="inline-flex items-center gap-2 self-start rounded-full bg-surface-container px-4 py-2 font-label-sm text-label-sm font-semibold text-on-surface transition-colors hover:bg-primary-fixed hover:text-primary">
            <span class="material-symbols-outlined text-[16px]">inbox</span>
            <span>Lihat Semua Pesan</span>
            @if(($unreadMessageCount ?? 0) > 0)
                <span class="px-2 py-0.5 rounded-full bg-primary-container text-on-primary font-label-sm text-[11px] font-bold">{{ $unreadMessageCount }} baru</span>
            @endif
        </a>
    </div>
    <div class="flex flex-col divide-y divide-surface-container">
        @forelse ($recentMessages ?? [] as $message)
            <div class="py-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-surface-container-low/50 px-4 rounded-xl transition-colors -mx-4">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-full {{ $message->is_read ? 'bg-surface-container text-on-surface-variant' : 'bg-primary-fixed text-primary-container' }} flex items-center justify-center font-bold font-label-md shrink-0">{{ $message->initials() }}</div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-label-md text-label-md font-semibold text-on-surface">{{ $message->full_name }} <span class="font-normal text-secondary">• {{ $message->contact_point }}</span></span>
                        <span class="font-body-sm text-body-sm text-secondary mt-1">{{ \Illuminate\Support\Str::limit($message->message, 160) }}</span>
                        <span class="font-label-sm text-label-sm text-secondary mt-1">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-start md:self-auto">
                    <span class="px-4 py-1.5 rounded-full font-label-caps text-label-caps uppercase font-bold bg-surface-container text-secondary">{{ $message->categoryLabel() }}</span>
                    <span class="px-4 py-1.5 rounded-full font-label-caps text-label-caps uppercase font-bold {{ $message->is_read ? 'bg-surface-container text-secondary' : 'bg-primary-container/40 text-primary-container' }}">{{ $message->is_read ? 'Dibaca' : 'Baru' }}</span>
                </div>
            </div>
        @empty
            <p class="py-10 text-center font-body-sm text-body-sm text-secondary">Belum ada pesan masuk dari halaman kontak.</p>
        @endforelse
    </div>
</section>

<!-- Bottom Row: Realtime Activity Ledger -->
<section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-surface-container/50">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-6 border-b border-surface-container">
        <div>
            <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Audit Trail Realtime</span>
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface tracking-tight mt-1">Aktivitas Terbaru</h2>
            <p class="font-body-sm text-body-sm text-secondary">Log transaksi data, pergerakan berkas, dan pembaruan sistem secara langsung.</p>
        </div>
    </div>
    <!-- Activity Stream Entries -->
    <div class="flex flex-col divide-y divide-surface-container">
        @forelse ($recentActivities ?? [] as $activity)
            <div class="py-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-surface-container-low/50 px-4 rounded-xl transition-colors -mx-4">
                <div class="flex items-start md:items-center gap-4">
                    <div class="w-12 h-12 rounded-full {{ $activity['bg'] }} {{ $activity['text'] }} flex items-center justify-center font-bold font-label-md shrink-0">
                        {{ strtoupper(substr($activity['initials'], 0, 2)) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-label-md text-label-md font-semibold text-on-surface text-base">{{ $activity['message'] }}</span>
                        <span class="font-body-sm text-body-sm text-secondary mt-0.5">Oleh {{ $activity['author'] }} • {{ $activity['time'] }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-start md:self-auto">
                    <span class="px-4 py-1.5 rounded-full font-label-caps text-label-caps uppercase font-bold {{ $activity['badgeBg'] }} {{ $activity['badgeText'] }}">
                        {{ $activity['category'] }}
                    </span>
                </div>
            </div>
        @empty
            <p class="py-10 text-center font-body-sm text-body-sm text-secondary">Belum ada aktivitas tercatat.</p>
        @endforelse
    </div>
</section>

<!-- Editorial Institutional Footer Detail -->
<footer class="mt-10 mb-6 flex flex-col sm:flex-row items-center justify-between text-secondary font-label-sm text-label-sm gap-4 px-2">
    <div>MWCNU Kecamatan Gumelar — Kab. Banyumas • Sistem Informasi Manajemen Terpadu v2.4</div>
    <div class="flex items-center gap-4">
        <span class="hover:text-on-surface transition-colors cursor-pointer">Panduan Admin</span>
        <span>•</span>
        <span class="hover:text-on-surface transition-colors cursor-pointer">Arsip Surat Keputusan</span>
        <span>•</span>
        <span class="hover:text-on-surface transition-colors cursor-pointer">Pusat Regulasi AD/ART</span>
    </div>
</footer>
@endsection