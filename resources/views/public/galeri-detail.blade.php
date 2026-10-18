@extends('layouts.site')

@section('content')
<div class="w-full bg-[#FAFAF9] text-on-surface">
    <section class="w-full border-b border-[#E5E7EB] bg-[#FAFAF9] px-4 sm:px-6 pb-8 pt-10 sm:pb-10 sm:pt-12 lg:px-12">
        <div class="mx-auto flex max-w-7xl flex-col items-start">
            <a href="{{ route('galeri') }}" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke galeri
            </a>
            <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-[#D1D5DB] bg-[#FAFAF9] px-3 py-1"><span class="h-1.5 w-1.5 rounded-full bg-primary-container"></span><span class="font-label-caps text-label-caps font-semibold uppercase tracking-wider text-primary-container">{{ $item->label ?: $item->category }}</span></div>
            <div class="flex max-w-4xl flex-col gap-3">
                <h1 class="font-headline-xl text-headline-xl-mobile font-extrabold leading-tight text-[#111827] lg:text-headline-xl">{{ $item->title }}</h1>
                @if ($item->description)<p class="max-w-2xl font-body-lg text-body-lg leading-relaxed text-[#4B5563]">{{ $item->description }}</p>@endif
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-body-sm text-body-sm text-[#4B5563]">
                    <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">calendar_today</span>{{ $item->event_date?->translatedFormat('d F Y') ?? 'Tanggal belum diisi' }}</span>
                    @if ($item->location)<span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">location_on</span>{{ $item->location }}</span>@endif
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#FAFAF9] px-4 sm:px-6 py-10 sm:py-12 lg:px-12">
        <div class="mx-auto max-w-7xl">
            @php
                $photos = $item->photos;
                $cover = $item->imageSource();
            @endphp

            @if ($photos->isNotEmpty() || $cover)
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @if ($cover && $photos->isEmpty())
                        <div class="sm:col-span-2 lg:col-span-4">
                            <img src="{{ $cover }}" alt="{{ $item->alt_text ?: $item->title }}" class="w-full rounded-xl border border-[#E5E7EB] object-cover">
                        </div>
                    @else
                        @foreach ($photos as $photo)
                            <figure class="group">
                                <div class="overflow-hidden rounded-xl border border-[#E5E7EB] bg-[#F3F4F6]">
                                    <img src="{{ $photo->photoUrl() }}" alt="{{ $photo->caption ?: $item->title }}" class="aspect-[4/3] w-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]" loading="lazy">
                                </div>
                                @if ($photo->caption)<figcaption class="mt-2 font-body-sm text-body-sm text-[#4B5563]">{{ $photo->caption }}</figcaption>@endif
                            </figure>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="rounded-2xl bg-white px-6 py-16 text-center text-slate-500">
                    <span class="material-symbols-outlined mb-3 text-5xl text-slate-300">photo_library</span>
                    <p class="font-body-md text-body-md">Foto-foto kegiatan akan ditambahkan oleh admin.</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
