@extends('admin.layout')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-space-lg border-b border-outline-variant/30">
    <div class="flex flex-col">
        <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Publikasi</span>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-on-surface font-bold tracking-tight mt-1">Daftar Publikasi Warta Nahdliyin</h1>
        <p class="font-body-md text-body-md text-secondary mt-1">Kelola berita, kajian, dan pengumuman resmi MWCNU.</p>
    </div>
    <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold transition-all hover:bg-tertiary-container shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tulis Warta Nahdliyin Baru</span>
        </a>
    </div>
</header>

@if (session('status'))
    <div class="rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status">{{ session('status') }}</div>
@endif

<div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest overflow-hidden shadow-sm mt-6">
    <div class="px-6 pt-4 pb-0 border-b border-outline-variant/30 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <nav aria-label="Status filter" class="flex items-center gap-6 overflow-x-auto font-label-md text-label-md">
            <span class="pb-3 text-primary-container font-semibold border-b-2 border-primary-container flex items-center gap-1.5 whitespace-nowrap">Semua Warta Nahdliyin ({{ $articleCount }})</span>
            <span class="pb-3 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-1.5 whitespace-nowrap">Diterbitkan ({{ $publishedArticleCount }})</span>
            <span class="pb-3 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-1.5 whitespace-nowrap">Draft ({{ $articleCount - $publishedArticleCount }})</span>
        </nav>
        <div class="flex items-center gap-2.5 pb-3">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[16px]">search</span>
                <input class="w-60 pl-8 pr-3 py-1.5 bg-surface-container border border-outline-variant rounded-lg font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:border-primary-container transition-all" placeholder="Cari artikel..." type="text">
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50 border-b border-outline-variant/30 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold">
                    <th class="py-3.5 px-6 font-semibold" scope="col">Judul Artikel</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Kategori</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Penulis</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Tanggal</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30 font-body-md text-body-md">
                @forelse ($articles as $article)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-4 px-6">
                            <span class="font-semibold text-on-surface block">{{ $article->title }}</span>
                            @if ($article->is_featured)
                                <span class="inline-flex items-center gap-1 mt-1 font-label-sm text-label-sm text-primary-container font-semibold"><span class="material-symbols-outlined text-[14px]">star</span>Sorotan utama</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-medium">{{ $article->category }}</span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-on-surface-variant font-body-sm text-body-sm">{{ $article->author ?: 'Redaksi MWCNU' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-on-surface-variant font-body-sm text-body-sm">{{ $article->published_at?->translatedFormat('d M Y') ?: 'Belum dijadwalkan' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold {{ $article->is_published ? 'bg-primary-fixed/40 text-primary-container' : 'bg-surface-container-high text-on-surface-variant' }}">
                                {{ $article->is_published ? 'Diterbitkan' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5 text-outline">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="p-1.5 hover:text-primary-container hover:bg-surface-container rounded-lg transition-colors" title="Ubah">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus warta ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-1.5 hover:text-error hover:bg-error-container/30 rounded-lg transition-colors" title="Hapus" type="submit">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-12 text-center text-secondary font-body-md text-body-md">Belum ada Warta Nahdliyin tersimpan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($articles->hasPages())
        <div class="px-6 py-4 bg-surface-container-low/50 border-t border-outline-variant/30">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
