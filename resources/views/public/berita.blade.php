@extends('layouts.site')

@section('content')
<div class="bg-surface-container-lowest text-on-surface">
    <section class="border-b border-outline-variant/50 px-6 py-12 lg:px-12">
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
    </section>

    <section class="px-6 py-10 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col gap-10">
            @if ($featuredArticle)
                <article class="article-card grid overflow-hidden rounded-2xl border border-outline-variant/40 bg-white lg:grid-cols-12" data-article-card data-category="{{ $featuredArticle->category }}" data-search="{{ Str::lower($featuredArticle->title . ' ' . $featuredArticle->excerpt) }}">
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

            <div class="flex items-baseline justify-between gap-4 border-b border-outline-variant/50 pb-3"><div class="flex items-baseline gap-2"><h2 class="font-headline-md text-headline-md font-bold">Warta Terbaru</h2><span class="text-sm text-slate-500">{{ $articles->count() }} publikasi</span></div><p class="hidden text-xs text-slate-500 sm:block" aria-live="polite"><span id="article-visible-count">{{ $articles->count() + ($featuredArticle ? 1 : 0) }}</span> ditampilkan</p></div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3" id="article-grid">
                @foreach ($articles as $article)
                    <article class="article-card flex flex-col overflow-hidden rounded-xl border border-outline-variant/40 bg-white" data-article-card data-category="{{ $article->category }}" data-search="{{ Str::lower($article->title . ' ' . $article->excerpt) }}">
                        <a class="relative aspect-[16/10] overflow-hidden bg-surface-container" href="{{ route('berita.show', $article) }}">@if ($article->imageSource())<img class="h-full w-full object-cover transition-transform duration-500 hover:scale-[1.02]" src="{{ $article->imageSource() }}" alt="{{ $article->title }}" loading="lazy">@endif<span class="absolute left-3 top-3 rounded-full border border-slate-200 bg-white/95 px-2.5 py-1 font-label-caps text-label-caps font-bold uppercase tracking-wider text-primary">{{ $article->category }}</span></a>
                        <div class="flex flex-1 flex-col p-5"><p class="font-label-caps text-label-caps text-slate-500">{{ $article->published_at?->translatedFormat('d F Y') ?? 'Draf terjadwal' }} <span class="mx-1">•</span> {{ $article->author ?: 'Redaksi MWCNU' }}</p><h3 class="mt-2 font-headline-sm text-headline-sm font-bold leading-snug"><a class="text-slate-900 transition-colors hover:text-primary" href="{{ route('berita.show', $article) }}">{{ $article->title }}</a></h3><p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">{{ $article->excerpt }}</p><a class="mt-5 inline-flex items-center gap-1 border-t border-slate-100 pt-4 text-sm font-semibold text-primary" href="{{ route('berita.show', $article) }}">Baca selengkapnya<span class="material-symbols-outlined text-[17px]">chevron_right</span></a></div>
                    </article>
                @endforeach
            </div>
            <p class="hidden py-12 text-center text-sm text-slate-500" id="article-empty">Tidak ada warta yang sesuai dengan pencarian ini.</p>
        </div>
    </section>
</div>

<script>
    (() => {
        const cards = [...document.querySelectorAll('[data-article-card]')];
        const filters = [...document.querySelectorAll('[data-article-filter]')];
        const search = document.querySelector('#article-search');
        const count = document.querySelector('#article-visible-count');
        const empty = document.querySelector('#article-empty');
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
            category = button.dataset.articleFilter;
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