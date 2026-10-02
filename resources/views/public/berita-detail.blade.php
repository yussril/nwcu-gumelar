@extends('layouts.site')

@section('content')
<article class="mx-auto w-full max-w-4xl px-6 py-10 lg:px-12 lg:py-16">
    <a class="mb-8 inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline" href="{{ route('berita') }}"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke Warta Nahdliyin</a>
    <header>
        <div class="flex flex-wrap items-center gap-2 font-label-caps text-label-caps font-semibold uppercase tracking-wider text-slate-500"><span class="text-primary">{{ $article->category }}</span><span>•</span><span>{{ $article->published_at?->translatedFormat('d F Y') }}</span><span>•</span><span>{{ $article->author ?: 'Redaksi MWCNU' }}</span></div>
        <h1 class="mt-4 font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-slate-900 lg:text-headline-xl">{{ $article->title }}</h1>
        <p class="mt-5 font-body-lg text-body-lg leading-relaxed text-slate-600">{{ $article->excerpt }}</p>
    </header>
    @if ($article->imageSource())<figure class="mt-8 overflow-hidden rounded-2xl border border-slate-200"><img class="max-h-[560px] w-full object-cover" src="{{ $article->imageSource() }}" alt="{{ $article->title }}"><figcaption class="bg-slate-50 px-4 py-3 text-xs text-slate-500">Dokumentasi {{ $article->author ?: 'MWCNU Gumelar' }}</figcaption></figure>@endif
    <div class="prose prose-slate mt-10 max-w-none whitespace-pre-line font-body-md text-body-md leading-relaxed text-slate-700">{{ $article->body ?: $article->excerpt }}</div>
</article>
@endsection