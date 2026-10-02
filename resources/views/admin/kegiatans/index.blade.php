@extends('admin.layout')

@section('content')
<div class="mx-auto w-full max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Manajemen Kegiatan</p>
            <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Kegiatan</h1>
            <p class="mt-2 font-body-md text-body-md text-secondary">Kelola kegiatan yang akan datang. Kegiatan otomatis pindah ke galeri setelah <strong>akhir pelaksanaan</strong> terlewati.</p>
        </div>
        <a href="{{ route('admin.kegiatans.create') }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container">
            <span class="material-symbols-outlined text-[18px]">add</span>Tambah Kegiatan
        </a>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/30 bg-surface-container-low">
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kegiatan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kategori</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Waktu Pelaksanaan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Status</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse ($kegiatans as $kegiatan)
                        <tr class="hover:bg-surface-container-low/50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($kegiatan->cover_image_path)
                                        <img src="{{ $kegiatan->coverImageUrl() }}" alt="" class="h-12 w-16 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-surface-container">
                                            <span class="material-symbols-outlined text-outline">image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-body-md text-body-md font-semibold text-on-surface">{{ $kegiatan->title }}</p>
                                        @if ($kegiatan->location)
                                            <p class="font-body-sm text-body-sm text-secondary">{{ $kegiatan->location }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary">{{ $kegiatan->category ?? '-' }}</td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary">{{ $kegiatan->scheduled_at->format('d M Y H:i') }}@if ($kegiatan->scheduled_end_at)<span class="mt-0.5 block text-label-sm text-on-surface-variant">s/d {{ $kegiatan->scheduled_end_at->format('d M Y H:i') }}</span>@endif</td>
                            <td class="px-5 py-4">
                                @if ($kegiatan->is_published)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-container/50 px-3 py-1 font-label-sm text-label-sm font-semibold text-primary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-outline"></span>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.kegiatans.edit', $kegiatan) }}" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-outline-variant px-3 py-1.5 font-label-sm text-label-sm font-semibold text-on-surface hover:bg-surface-container">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </a>
                                    <form action="{{ route('admin.kegiatans.destroy', $kegiatan) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-error/30 px-3 py-1.5 font-label-sm text-label-sm font-semibold text-error hover:bg-error-container/30">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <span class="material-symbols-outlined mb-2 text-4xl text-outline">event</span>
                                <p class="font-body-md text-body-md text-secondary">Belum ada kegiatan. Klik "Tambah Kegiatan" untuk membuat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($kegiatans->hasPages())
            <div class="border-t border-outline-variant/30 px-5 py-4">
                {{ $kegiatans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
