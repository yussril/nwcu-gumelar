@extends('admin.layout')

@section('content')
<div class="mx-auto w-full max-w-4xl">
    <a href="{{ route('admin.articles.index') }}" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke warta
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Publikasi</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">{{ $article->exists ? 'Ubah Warta' : 'Tulis Warta Baru' }}</h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">Kelola berita, kajian, dan pengumuman resmi MWCNU.</p>
    </div>
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-error/30 bg-error-container/50 px-5 py-4 text-sm text-on-error-container" role="alert">
            <p class="font-bold mb-1">Periksa kembali data yang diisi:</p>
            <ul class="list-disc pl-5 space-y-0.5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form class="flex flex-col gap-5" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf @if ($method === 'PUT') @method('PUT') @endif
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Detail warta</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="title">Judul warta<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="title" name="title" value="{{ old('title', $article->title) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="category">Kategori<select class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="category" name="category" required><option value="" disabled selected>Pilih kategori</option><option value="Kegiatan Ranting" @selected(old('category', $article->category) === 'Kegiatan Ranting')>Kegiatan Ranting</option><option value="Kajian & Fatwa" @selected(old('category', $article->category) === 'Kajian & Fatwa')>Kajian & Fatwa</option><option value="Kabar Banom" @selected(old('category', $article->category) === 'Kabar Banom')>Kabar Banom</option><option value="Pengumuman" @selected(old('category', $article->category) === 'Pengumuman')>Pengumuman</option></select></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="author">Penulis / redaksi<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="author" name="author" value="{{ old('author', $article->author) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="published_at">Tanggal terbit<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"></label>
            </div>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="excerpt">Ringkasan<textarea class="min-h-20 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="excerpt" name="excerpt" required rows="3">{{ old('excerpt', $article->excerpt) }}</textarea></label>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="body">Isi warta<textarea class="min-h-40 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="body" name="body" required rows="8">{{ old('body', $article->body) }}</textarea></label>
        </section>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Media &amp; visibilitas</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="image_url">URL gambar<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="image_url" name="image_url" type="url" value="{{ old('image_url', $article->image_url) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="image">Unggah gambar<input class="block w-full font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-surface-container file:px-3 file:py-2 file:font-semibold file:text-on-surface-variant" id="image" name="image" type="file" accept="image/*"></label>
            </div>
            @if ($article->image_url)
                <img class="h-40 w-64 rounded-lg border border-outline-variant object-cover" src="{{ $article->image_url }}" alt="Gambar saat ini">
            @endif
            <div class="flex flex-col gap-3">
                <label class="flex items-center gap-2 font-body-md text-body-md text-on-surface"><input class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container" id="is_published" name="is_published" type="checkbox" value="1" @checked(old('is_published', $article->is_published))>Terbitkan di situs</label>
                <label class="flex items-center gap-2 font-body-md text-body-md text-on-surface"><input class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container" id="is_featured" name="is_featured" type="checkbox" value="1" @checked(old('is_featured', $article->is_featured))>Jadikan sorotan utama</label>
            </div>
        </section>
        <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <a class="inline-flex min-h-11 items-center justify-center rounded-lg border border-outline-variant px-5 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container" href="{{ route('admin.articles.index') }}">Batal</a>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan Warta</button>
        </div>
    </form>
</div>
@endsection
