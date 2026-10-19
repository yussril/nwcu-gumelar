@extends('layouts.site')

@section('content')
<div class="bg-surface-container-lowest text-on-surface">
    <x-reveal as="section" class="border-b border-outline-variant/50 px-4 sm:px-6 py-10 sm:py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-primary-fixed/40 px-3 py-1 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary"><span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Agenda & Jadwal Kegiatan</p>
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div class="max-w-3xl"><h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-on-surface lg:text-headline-xl">Kegiatan MWCNU</h1><p class="mt-3 font-body-lg text-body-lg leading-relaxed text-on-surface-variant">Jadwal kegiatan, syiar dakwah, dan program khidmat keluarga besar Nahdlatul Ulama se-Kecamatan Gumelar.</p></div>
                <span class="shrink-0 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">{{ $kegiatanCount }} kegiatan terjadwal</span>
            </div>
            <div class="mt-7 flex flex-col justify-between gap-4 border-t border-outline-variant/40 pt-5 lg:flex-row lg:items-center">
                <div class="flex flex-wrap gap-2" id="kegiatan-filters" aria-label="Filter kategori kegiatan">
                    @foreach (['all' => 'Semua', 'syuriyah-tanfidziyah' => 'Syuriyah & Tanfidziyah', 'ansor' => 'Ansor & Banser', 'fatayat' => 'Fatayat & Muslimat', 'ipnu-ippnu' => 'IPNU & IPPNU', 'lazisnu' => 'LAZISNU & Filantropi', 'dakwah' => 'LBM & Dakwah', 'ranting' => 'Ranting & Desa'] as $key => $label)
                        <button class="kegiatan-filter rounded-full border px-4 py-2 font-label-md text-label-md transition-colors {{ $loop->first ? 'border-primary-container bg-primary-container font-semibold text-white' : 'border-outline-variant bg-white font-medium text-on-surface-variant hover:bg-surface-container-low' }}" type="button" data-kegiatan-filter="{{ $key }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $label }}</button>
                    @endforeach
                </div>
                <label class="relative block w-full lg:w-80" for="kegiatan-search"><span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-slate-400">search</span><input class="w-full rounded-full border border-outline-variant bg-surface px-10 py-2.5 text-sm focus:border-primary focus:bg-white focus:outline-none focus:ring-4 focus:ring-primary/10" id="kegiatan-search" type="search" placeholder="Cari kegiatan..."></label>
            </div>
        </div>
    </x-reveal>

    <x-reveal as="section" :delay="120" class="px-4 sm:px-6 py-10 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col gap-10">
            @if ($featuredKegiatan)
                @php
                    $featuredKegiatanData = [
                        'title' => $featuredKegiatan->title,
                        'category' => $featuredKegiatan->category ?: 'Kegiatan',
                        'description' => $featuredKegiatan->description,
                        'location' => $featuredKegiatan->location ?: 'Lokasi akan diumumkan',
                        'start' => $featuredKegiatan->scheduled_at->translatedFormat('d F Y H:i'),
                        'end' => ($featuredKegiatan->scheduled_end_at ?? $featuredKegiatan->scheduled_at)->translatedFormat('d F Y H:i'),
                        'cover' => $featuredKegiatan->coverImageUrl(),
                    ];
                @endphp
                <article class="kegiatan-card group grid cursor-pointer overflow-hidden rounded-2xl border border-outline-variant/40 bg-white transition-shadow hover:shadow-lg lg:grid-cols-12" data-kegiatan-card data-category="{{ $featuredKegiatan->category }}" data-search="{{ Str::lower($featuredKegiatan->title . ' ' . $featuredKegiatan->description) }}" data-kegiatan="{{ json_encode($featuredKegiatanData, JSON_UNESCAPED_UNICODE) }}" x-on:click="openKegiatan($el)" x-on:keydown.enter.prevent="openKegiatan($el)" x-on:keydown.space.prevent="openKegiatan($el)" role="button" tabindex="0">
                    <div class="relative min-h-64 bg-surface-container lg:col-span-7">
                        @if ($featuredKegiatan->coverImageUrl())<img class="absolute inset-0 h-full w-full object-cover" src="{{ $featuredKegiatan->coverImageUrl() }}" alt="{{ $featuredKegiatan->title }}">@else<div class="absolute inset-0 flex items-center justify-center text-slate-300"><span class="material-symbols-outlined text-6xl">event</span></div>@endif
                        <span class="absolute left-4 top-4 rounded-full bg-primary-container px-3 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-white">Akan Datang</span>
                    </div>
                    <div class="flex flex-col justify-between gap-7 p-6 sm:p-8 lg:col-span-5 lg:p-10">
                        <div><div class="flex flex-wrap items-center gap-2 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant"><span class="text-primary">{{ $featuredKegiatan->category ?: 'Kegiatan' }}</span><span>•</span><span>{{ $featuredKegiatan->scheduled_at->translatedFormat('d F Y H:i') }}@if ($featuredKegiatan->scheduled_end_at) s/d {{ $featuredKegiatan->scheduled_end_at->translatedFormat('d F Y H:i') }}@endif</span></div><h2 class="mt-3 font-headline-lg text-headline-lg font-extrabold leading-tight text-on-surface transition-colors group-hover:text-primary">{{ $featuredKegiatan->title }}</h2><p class="mt-4 leading-relaxed text-on-surface-variant">{{ $featuredKegiatan->description }}</p></div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4"><span class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-700"><span class="material-symbols-outlined text-[16px] text-primary">location_on</span>{{ $featuredKegiatan->location ?: 'Lokasi akan diumumkan' }}</span><span class="inline-flex items-center gap-1 text-sm font-semibold text-primary"><span class="material-symbols-outlined text-[16px]">schedule</span>{{ $featuredKegiatan->scheduled_at->diffForHumans() }}</span></div>
                    </div>
                </article>
            @endif

            <div class="flex items-baseline justify-between gap-4 border-b border-outline-variant/50 pb-3"><div class="flex items-baseline gap-2"><h2 class="font-headline-md text-headline-md font-bold">Jadwal Kegiatan</h2><span class="text-sm text-slate-500">{{ $kegiatans->count() }} kegiatan</span></div><p class="hidden text-xs text-slate-500 sm:block" aria-live="polite"><span id="kegiatan-visible-count">{{ $kegiatans->count() + ($featuredKegiatan ? 1 : 0) }}</span> ditampilkan</p></div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3" id="kegiatan-grid">
                @foreach ($kegiatans as $kegiatan)
                    @php
                        $kegiatanData = [
                            'title' => $kegiatan->title,
                            'category' => $kegiatan->category ?: 'Kegiatan',
                            'description' => $kegiatan->description,
                            'location' => $kegiatan->location ?: 'Lokasi akan diumumkan',
                            'start' => $kegiatan->scheduled_at->translatedFormat('d F Y H:i'),
                            'end' => ($kegiatan->scheduled_end_at ?? $kegiatan->scheduled_at)->translatedFormat('d F Y H:i'),
                            'cover' => $kegiatan->coverImageUrl(),
                        ];
                    @endphp
                    <article class="kegiatan-card group flex cursor-pointer flex-col overflow-hidden rounded-xl border border-outline-variant/40 bg-white transition-shadow hover:shadow-lg" data-kegiatan-card data-category="{{ $kegiatan->category }}" data-search="{{ Str::lower($kegiatan->title . ' ' . $kegiatan->description) }}" data-kegiatan="{{ json_encode($kegiatanData, JSON_UNESCAPED_UNICODE) }}" x-on:click="openKegiatan($el)" x-on:keydown.enter.prevent="openKegiatan($el)" x-on:keydown.space.prevent="openKegiatan($el)" role="button" tabindex="0">
                        <div class="relative aspect-[16/10] overflow-hidden bg-surface-container">
                            @if ($kegiatan->coverImageUrl())<img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" src="{{ $kegiatan->coverImageUrl() }}" alt="{{ $kegiatan->title }}" loading="lazy">@else<div class="flex h-full w-full items-center justify-center text-slate-300"><span class="material-symbols-outlined text-5xl">event</span></div>@endif
                            <span class="absolute left-3 top-3 rounded-full border border-slate-200 bg-white/95 px-2.5 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-primary">{{ $kegiatan->category ?: 'Kegiatan' }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <p class="font-label-caps text-label-caps text-slate-500">{{ $kegiatan->scheduled_at->translatedFormat('d F Y H:i') }}@if ($kegiatan->scheduled_end_at) s/d {{ $kegiatan->scheduled_end_at->translatedFormat('d F Y H:i') }}@endif <span class="mx-1">•</span> {{ $kegiatan->scheduled_at->diffForHumans() }}</p>
                            <h3 class="mt-2 font-headline-sm text-headline-sm font-bold leading-snug text-slate-900 transition-colors group-hover:text-primary">{{ $kegiatan->title }}</h3>
                            <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $kegiatan->description }}</p>
                            <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4"><span class="inline-flex min-w-0 items-center gap-1.5 truncate text-sm font-semibold text-slate-700"><span class="material-symbols-outlined shrink-0 text-[16px] text-primary">location_on</span><span class="truncate">{{ $kegiatan->location ?: 'Lokasi akan diumumkan' }}</span></span><span class="inline-flex shrink-0 items-center gap-1 text-sm font-semibold text-primary"><span class="font-label-sm text-label-sm">Lihat Detail</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span></span></div>
                        </div>
                    </article>
                @endforeach
            </div>
            <p class="hidden py-12 text-center text-sm text-slate-500" id="kegiatan-empty">Tidak ada kegiatan yang sesuai dengan pencarian ini.</p>
        </div>
    </x-reveal>
</div>

<div
    x-data="{ open: false, item: null }"
    x-cloak
    x-show="open"
    x-transition.opacity.duration.200ms
    class="fixed inset-0 z-[100] flex items-end justify-center sm:items-center sm:p-4"
    role="dialog"
    aria-modal="true"
    aria-label="Detail kegiatan"
    @open-kegiatan.window="open = true; item = $event.detail"
    @keydown.escape.window="open = false"
>
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-md" x-on:click="open = false"></div>

    <div class="relative z-10 w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl" x-on:click.outside="open = false">
        <template x-if="item">
            <div class="grid md:grid-cols-2">
                <div class="relative bg-surface-container">
                    <template x-if="item.cover">
                        <img class="h-56 w-full object-cover md:h-full md:min-h-[26rem]" x-bind:src="item.cover" x-bind:alt="item.title">
                    </template>
                    <template x-if="!item.cover">
                        <div class="flex h-56 w-full items-center justify-center text-slate-300 md:h-full md:min-h-[26rem]"><span class="material-symbols-outlined text-7xl">event</span></div>
                    </template>
                    <span class="absolute left-4 top-4 rounded-full bg-primary-container px-3 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-white" x-text="item.category"></span>
                </div>

                <div class="relative p-6 sm:p-8">
                    <button class="absolute right-3 top-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition-colors hover:bg-slate-200 hover:text-slate-900" type="button" x-on:click="open = false" aria-label="Tutup detail kegiatan">
                        <span class="material-symbols-outlined text-[22px]">close</span>
                    </button>

                    <h2 class="pr-10 font-headline-lg text-headline-lg font-extrabold leading-tight text-on-surface" x-text="item.title"></h2>

                    <dl class="mt-5 grid gap-4 border-y border-slate-100 py-5">
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined shrink-0 text-[20px] text-primary">calendar_today</span>
                            <div><dt class="font-label-sm text-label-sm font-semibold uppercase tracking-wider text-slate-500">Waktu Mulai</dt><dd class="mt-1 font-body-md text-body-md text-slate-800"><span x-text="item.start"></span> WIB</dd></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined shrink-0 text-[20px] text-primary">schedule</span>
                            <div><dt class="font-label-sm text-label-sm font-semibold uppercase tracking-wider text-slate-500">Waktu Selesai</dt><dd class="mt-1 font-body-md text-body-md text-slate-800"><span x-text="item.end"></span> WIB</dd></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined shrink-0 text-[20px] text-primary">location_on</span>
                            <div><dt class="font-label-sm text-label-sm font-semibold uppercase tracking-wider text-slate-500">Lokasi</dt><dd class="mt-1 font-body-md text-body-md text-slate-800" x-text="item.location"></dd></div>
                        </div>
                    </dl>

                    <p class="mt-5 max-h-40 overflow-y-auto whitespace-pre-line font-body-md text-body-md leading-relaxed text-slate-700" x-text="item.description"></p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a class="inline-flex items-center gap-2 rounded-xl bg-primary-container px-5 py-3 font-label-md text-label-md font-semibold text-white transition-colors hover:bg-primary" href="{{ route('kontak') }}">
                            <span class="material-symbols-outlined text-[20px]">contact_support</span>Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    (() => {
        window.openKegiatan = (card) => {
            window.dispatchEvent(new CustomEvent('open-kegiatan', {
                detail: JSON.parse(card.dataset.kegiatan),
            }));
        };

        const cards = [...document.querySelectorAll('[data-kegiatan-card]')];
        const filters = [...document.querySelectorAll('[data-kegiatan-filter]')];
        const search = document.querySelector('#kegiatan-search');
        const count = document.querySelector('#kegiatan-visible-count');
        const empty = document.querySelector('#kegiatan-empty');
        let category = 'all';

        const update = () => {
            const query = search.value.trim().toLowerCase();
            let visible = 0;
            cards.forEach((card) => {
                const matches = (category === 'all' || card.dataset.category === category) && card.dataset.search.includes(query);
                card.hidden = !matches;
                card.classList.toggle('hidden', !matches);
                if (matches) visible++;
            });
            count.textContent = visible;
            empty.hidden = visible > 0;
            empty.classList.toggle('hidden', visible > 0);
        };

        filters.forEach((button) => button.addEventListener('click', () => {
            category = button.dataset.kegiatanFilter;
            filters.forEach((filter) => {
                const selected = filter === button;
                filter.setAttribute('aria-pressed', String(selected));
                filter.classList.toggle('border-primary-container', selected);
                filter.classList.toggle('bg-primary-container', selected);
                filter.classList.toggle('font-semibold', selected);
                filter.classList.toggle('text-white', selected);
                filter.classList.toggle('border-outline-variant', !selected);
                filter.classList.toggle('bg-white', !selected);
                filter.classList.toggle('font-medium', !selected);
                filter.classList.toggle('text-on-surface-variant', !selected);
            });
            update();
        }));
        search.addEventListener('input', update);
    })();
</script>
@endsection
