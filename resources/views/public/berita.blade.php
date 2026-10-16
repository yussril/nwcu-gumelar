@extends('layouts.site')

@section('content')
<div class="bg-surface-container-lowest text-on-surface">
    <x-reveal as="section" class="border-b border-outline-variant/50 px-6 py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-primary-fixed/40 px-3 py-1 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary"><span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Kanal Informasi & Publikasi Resmi</p>
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div class="max-w-3xl"><h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-on-surface lg:text-headline-xl">Warta Nahdliyin</h1><p class="mt-3 font-body-lg text-body-lg leading-relaxed text-on-surface-variant">Kumpulan kabar pergerakan khidmah, risalah keagamaan, panduan keumatan, dan dinamika kegiatan Nahdlatul Ulama se-Kecamatan Gumelar.</p></div>
                <span class="shrink-0 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant">{{ $publicationCount }} publikasi tersedia</span>
            </div>
            <div class="mt-7 flex flex-col justify-between gap-4 border-t border-outline-variant/40 pt-5 lg:flex-row lg:items-center">
                <div class="flex flex-wrap gap-2" id="article-filters" aria-label="Filter kategori warta">
                    @foreach (['all' => 'Semua', 'Kegiatan Ranting' => 'Kegiatan Ranting', 'Kajian & Fatwa' => 'Kajian & Fatwa', 'Kabar Banom' => 'Kabar Banom', 'Pengumuman' => 'Pengumuman'] as $key => $label)
                        <button class="article-filter rounded-full border px-4 py-2 font-label-md text-label-md transition-colors {{ $loop->first ? 'border-primary-container bg-primary-container font-semibold text-white' : 'border-outline-variant bg-white font-medium text-on-surface-variant hover:bg-surface-container-low' }}" type="button" data-article-filter="{{ $key }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $label }}</button>
                    @endforeach
                </div>
                <label class="relative block w-full lg:w-80" for="article-search"><span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-slate-400">search</span><input class="w-full rounded-full border border-outline-variant bg-surface px-10 py-2.5 text-sm focus:border-primary focus:bg-white focus:outline-none focus:ring-4 focus:ring-primary/10" id="article-search" type="search" placeholder="Cari warta atau risalah..."></label>
            </div>
        </div>
    </x-reveal>

    <x-reveal as="section" :delay="120" class="px-6 py-10 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col gap-10">
            @if ($featuredArticle)
                <article class="article-card grid overflow-hidden rounded-2xl border border-outline-variant/40 bg-white lg:grid-cols-12" data-article-card data-article-featured data-category="{{ $featuredArticle->category }}" data-search="{{ Str::lower($featuredArticle->title . ' ' . $featuredArticle->excerpt) }}">
                    <a class="relative min-h-64 bg-surface-container lg:col-span-7" href="{{ route('berita.show', $featuredArticle) }}">
                        @if ($featuredArticle->imageSource())<img class="absolute inset-0 h-full w-full object-cover" src="{{ $featuredArticle->imageSource() }}" alt="{{ $featuredArticle->title }}">@endif
                        <span class="absolute left-4 top-4 rounded-full bg-primary-container px-3 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-white">Sorotan utama</span>
                    </a>
                    <div class="flex flex-col justify-between gap-7 p-6 sm:p-8 lg:col-span-5 lg:p-10">
                        <div><div class="flex flex-wrap items-center gap-2 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-on-surface-variant"><span class="text-primary">{{ $featuredArticle->category }}</span><span>•</span><span>{{ $featuredArticle->published_at?->translatedFormat('d F Y') ?? 'Warta terbaru' }}</span></div><h2 class="mt-3 font-headline-lg text-headline-lg font-extrabold leading-tight text-on-surface"><a class="hover:text-primary transition-colors" href="{{ route('berita.show', $featuredArticle) }}">{{ $featuredArticle->title }}</a></h2><p class="mt-4 leading-relaxed text-on-surface-variant">{{ $featuredArticle->excerpt }}</p></div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4"><span class="text-sm font-semibold text-slate-700">{{ $featuredArticle->author ?: 'Redaksi Media MWCNU' }}</span><a class="inline-flex items-center gap-1 font-semibold text-primary" href="{{ route('berita.show', $featuredArticle) }}">Baca warta<span class="material-symbols-outlined text-[18px]">arrow_forward</span></a></div>
                    </div>
                </article>
            @endif

            <div class="scroll-mt-28 flex items-baseline justify-between gap-4 border-b border-outline-variant/50 pb-3" id="article-list-heading"><div class="flex items-baseline gap-2"><h2 class="font-headline-md text-headline-md font-bold">Warta Terbaru</h2><span class="text-sm text-slate-500">{{ $articles->count() }} publikasi</span></div><p class="hidden text-xs text-slate-500 sm:block" aria-live="polite"><span id="article-visible-count">{{ $articles->count() }}</span> warta ditemukan</p></div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3" id="article-grid">
                @foreach ($articles as $article)
                    <article class="article-card flex flex-col overflow-hidden rounded-xl border border-outline-variant/40 bg-white" data-article-card data-category="{{ $article->category }}" data-search="{{ Str::lower($article->title . ' ' . $article->excerpt) }}">
                        <a class="relative aspect-[16/10] overflow-hidden bg-surface-container" href="{{ route('berita.show', $article) }}">@if ($article->imageSource())<img class="h-full w-full object-cover transition-transform duration-500 hover:scale-[1.02]" src="{{ $article->imageSource() }}" alt="{{ $article->title }}" loading="lazy">@endif<span class="absolute left-3 top-3 rounded-full border border-slate-200 bg-white/95 px-2.5 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-primary">{{ $article->category }}</span></a>
                        <div class="flex flex-1 flex-col p-5"><p class="font-label-caps text-label-caps text-slate-500">{{ $article->published_at?->translatedFormat('d F Y') ?? 'Draf terjadwal' }} <span class="mx-1">•</span> {{ $article->author ?: 'Redaksi MWCNU' }}</p>
                <h3 class="mt-2 font-headline-sm text-headline-sm font-bold leading-snug"><a class="text-slate-900 transition-colors hover:text-primary" href="{{ route('berita.show', $article) }}">{{ $article->title }}</a></h3><p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $article->excerpt }}</p><a class="mt-5 inline-flex items-center gap-1 border-t border-slate-100 pt-4 text-sm font-semibold text-primary" href="{{ route('berita.show', $article) }}">Baca selengkapnya<span class="material-symbols-outlined text-[17px]">chevron_right</span></a></div>
                    </article>
                @endforeach
            </div>
            <div class="hidden" id="article-pagination">
                <nav class="flex flex-wrap items-center justify-center gap-2" aria-label="Navigasi halaman warta">
                    <button class="inline-flex items-center gap-1 rounded-full border border-outline-variant bg-white px-4 py-2 font-label-md text-label-md font-medium text-on-surface-variant transition-colors hover:bg-surface-container-low" id="article-prev" type="button">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </button>
                    <div class="flex flex-wrap items-center justify-center gap-1.5 px-1" id="article-pages"></div>
                    <button class="inline-flex items-center gap-1 rounded-full border border-outline-variant bg-white px-4 py-2 font-label-md text-label-md font-medium text-on-surface-variant transition-colors hover:bg-surface-container-low" id="article-next" type="button">
                        <span class="hidden sm:inline">Berikutnya</span>
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </button>
                </nav>
                <p class="mt-3 text-center text-xs text-slate-500" id="article-page-info" aria-live="polite"></p>
            </div>
            <p class="hidden py-12 text-center text-sm text-slate-500" id="article-empty">Tidak ada warta yang sesuai dengan pencarian ini.</p>
        </div>
    </x-reveal>

    <!-- Banner Saluran WhatsApp (Section Terpisah) -->
    <x-reveal as="section" :delay="240" class="px-6 py-6 lg:px-12" aria-labelledby="wa-banner-heading">
        <div class="mx-auto max-w-7xl">
            <div class="relative overflow-hidden rounded-3xl bg-primary-container text-white shadow-lg">
                <div class="pointer-events-none absolute inset-0 opacity-10">
                    <svg class="h-full w-full text-on-primary" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <defs>
                            <pattern height="40" id="wa-grid-pattern" patternUnits="userSpaceOnUse" width="40">
                                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"></path>
                            </pattern>
                        </defs>
                        <rect fill="url(#wa-grid-pattern)" height="100%" width="100%"></rect>
                    </svg>
                </div>
                <div class="relative z-10 flex flex-col items-center gap-7 px-6 py-12 sm:px-12 lg:flex-row lg:justify-between lg:text-left">
                    <div class="flex flex-col items-center gap-5 lg:flex-row lg:items-center">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#25D366] shadow-lg">
                            <svg aria-hidden="true" class="h-9 w-9 fill-current text-white" viewBox="0 0 24 24">
                                <path d="M12.031 2C6.495 2 2 6.493 2 12.028c0 1.97.57 3.807 1.558 5.36L2 22l4.767-1.53a9.972 9.972 0 0 0 5.264 1.558h.005c5.534 0 10.027-4.492 10.027-10.028 0-2.678-1.043-5.197-2.937-7.091A10.007 10.007 0 0 0 12.031 2zm0 18.23a8.212 8.212 0 0 1-4.22-1.162l-.303-.18-2.82.905.918-2.75-.198-.316a8.225 8.225 0 0 1-1.258-4.4c0-4.542 3.696-8.238 8.24-8.238 2.2 0 4.269.858 5.823 2.413a8.217 8.217 0 0 1 2.41 5.826c0 4.542-3.696 8.24-8.24 8.24zm4.516-6.177c-.247-.124-1.464-.723-1.691-.806-.227-.082-.393-.124-.558.124-.165.247-.64.806-.784.97-.144.165-.289.186-.536.062-.247-.124-1.044-.385-1.989-1.228-.735-.656-1.232-1.467-1.376-1.714-.144-.247-.015-.38.109-.503.111-.112.247-.29.371-.434.124-.144.165-.247.247-.412.082-.165.041-.31-.021-.433-.062-.124-.558-1.343-.764-1.84-.2-.484-.403-.418-.558-.426l-.475-.008c-.165 0-.433.062-.66.31-.227.247-.866.847-.866 2.066 0 1.219.887 2.396 1.011 2.561.124.165 1.745 2.665 4.228 3.738.591.256 1.052.409 1.411.523.593.188 1.133.161 1.56.098.476-.071 1.464-.599 1.67-1.176.206-.577.206-1.072.144-1.175-.062-.103-.227-.165-.474-.288z"></path>
                            </svg>
                        </div>
                        <div class="max-w-xl text-center lg:text-left">
                            <span id="wa-banner-heading" class="font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary-fixed">Saluran WhatsApp Resmi</span>
                            <h2 class="mt-2 font-headline-lg text-headline-lg font-extrabold leading-tight">Jangan lewatkan warta berikutnya</h2>
                            <p class="mt-2 font-body-md text-body-md leading-relaxed text-primary-fixed-dim">Ikuti saluran WhatsApp MWCNU Gumelar untuk kabar kegiatan, pengumuman ta'lim, dan info resmi langsung di genggaman Anda.</p>
                        </div>
                    </div>
                    <a href="https://whatsapp.com/channel/0029Vb95DHQ4NVio49ZRCH1y" target="_blank" rel="noopener noreferrer" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#25D366] px-8 py-4 font-headline-sm text-headline-sm font-bold text-white shadow-lg transition-all hover:-translate-y-0.5 hover:bg-[#20bd5a]">
                        <span>Gabung Sekarang</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </x-reveal>
</div>

<script>
    (() => {
        const PER_PAGE = 9; // 3 baris x 3 kolom pada tampilan desktop
        const featured = document.querySelector('[data-article-featured]');
        const cards = [...document.querySelectorAll('[data-article-card]')].filter((card) => card !== featured);
        const filters = [...document.querySelectorAll('[data-article-filter]')];
        const search = document.querySelector('#article-search');
        const count = document.querySelector('#article-visible-count');
        const empty = document.querySelector('#article-empty');
        const pagination = document.querySelector('#article-pagination');
        const pages = document.querySelector('#article-pages');
        const prev = document.querySelector('#article-prev');
        const next = document.querySelector('#article-next');
        const pageInfo = document.querySelector('#article-page-info');
        const heading = document.querySelector('#article-list-heading');
        let category = 'all';
        let page = 1;
        let totalPages = 1;

        const markActive = (button, active) => {
            if (active) button.setAttribute('aria-current', 'page');
            else button.removeAttribute('aria-current');
            button.classList.toggle('border-primary-container', active);
            button.classList.toggle('bg-primary-container', active);
            button.classList.toggle('text-white', active);
            button.classList.toggle('border-outline-variant', !active);
            button.classList.toggle('bg-white', !active);
            button.classList.toggle('text-on-surface-variant', !active);
            button.classList.toggle('hover:bg-surface-container-low', !active);
        };

        const markDisabled = (button, disabled) => {
            button.disabled = disabled;
            button.classList.toggle('opacity-40', disabled);
            button.classList.toggle('pointer-events-none', disabled);
        };

        const goTo = (target) => {
            page = target;
            update();
            heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
        };

        const renderPages = (totalPages) => {
            pages.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = String(i);
                button.className = 'flex h-9 min-w-[2.25rem] items-center justify-center rounded-full border px-3 font-label-md text-label-md font-semibold transition-colors';
                button.setAttribute('aria-label', 'Ke halaman ' + i);
                markActive(button, i === page);
                button.addEventListener('click', () => {
                    if (i !== page) goTo(i);
                });
                pages.appendChild(button);
            }
        };

        const update = () => {
            const query = search.value.trim().toLowerCase();
            const isMatch = (card) =>
                (category === 'all' || card.dataset.category === category) && card.dataset.search.includes(query);

            const matches = cards.filter(isMatch);
            const featuredMatch = featured ? isMatch(featured) : false;

            if (featured) {
                featured.hidden = !featuredMatch;
                featured.classList.toggle('hidden', !featuredMatch);
            }

            totalPages = Math.max(1, Math.ceil(matches.length / PER_PAGE));
            if (page > totalPages) page = totalPages;

            const start = (page - 1) * PER_PAGE;
            const current = matches.slice(start, start + PER_PAGE);
            const visible = new Set(current);

            cards.forEach((card) => {
                const shown = visible.has(card);
                card.hidden = !shown;
                card.classList.toggle('hidden', !shown);
            });

            count.textContent = String(matches.length);

            const noResult = matches.length === 0 && !featuredMatch;
            empty.hidden = !noResult;
            empty.classList.toggle('hidden', !noResult);

            const showPagination = totalPages > 1;
            pagination.hidden = !showPagination;
            pagination.classList.toggle('hidden', !showPagination);

            if (showPagination) {
                renderPages(totalPages);
                markDisabled(prev, page === 1);
                markDisabled(next, page === totalPages);
                pageInfo.textContent = 'Menampilkan ' + (start + 1) + '–' + (start + current.length) + ' dari ' + matches.length + ' warta';
            } else {
                pageInfo.textContent = '';
            }
        };

        filters.forEach((button) => button.addEventListener('click', () => {
            category = button.dataset.articleFilter;
            page = 1;
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

        search.addEventListener('input', () => {
            page = 1;
            update();
        });

        prev.addEventListener('click', () => {
            if (page > 1) goTo(page - 1);
        });
        next.addEventListener('click', () => {
            if (page < totalPages) goTo(page + 1);
        });

        update();
    })();
</script>
@endsection