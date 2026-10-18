@extends('admin.layout')

@section('content')
<div class="mx-auto w-full max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Kotak Masuk</p>
            <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">Pesan Masuk</h1>
            <p class="mt-2 font-body-md text-body-md text-secondary">Pesan dari formulir <strong>Hubungi Kami</strong> di situs publik. <strong>{{ $unreadMessageCount ?? 0 }}</strong> belum dibaca dari {{ $totalCount }} total pesan.</p>
        </div>
        <span class="inline-flex items-center gap-2 self-start rounded-full bg-surface-container px-4 py-2 font-label-sm text-label-sm font-semibold text-on-surface">
            <span class="material-symbols-outlined text-[16px] text-secondary">inbox</span>
            {{ $totalCount }} Pesan
        </span>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl border border-primary/30 bg-primary-container/30 px-5 py-4 text-sm text-on-surface" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-outline-variant/30 bg-surface-container-lowest">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[760px]">
                <thead>
                    <tr class="border-b border-outline-variant/30 bg-surface-container-low">
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Pengirim</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Kategori</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Isi Pesan</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Dikirim</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Status</th>
                        <th class="px-5 py-4 font-label-md text-label-md font-semibold text-on-surface-variant">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse ($messages as $message)
                        <tr class="hover:bg-surface-container-low/50 {{ $message->is_read ? '' : 'bg-primary-fixed/10' }}">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $message->is_read ? 'bg-surface-container text-on-surface-variant' : 'bg-primary-fixed text-primary-container' }} font-label-md text-label-md font-bold">
                                        {{ $message->initials() }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-body-md text-body-md font-semibold text-on-surface">{{ $message->full_name }}</p>
                                        <p class="font-body-sm text-body-sm text-secondary break-all">{{ $message->contact_point }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary">{{ $message->categoryLabel() }}</span>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $isEmail = filter_var($message->contact_point, FILTER_VALIDATE_EMAIL) !== false;
                                    $isPhone = preg_match('/^[0-9+\s\-]{8,20}$/', $message->contact_point) === 1;
                                @endphp
                                <details class="max-w-md">
                                    <summary class="cursor-pointer font-body-sm text-body-sm leading-relaxed text-on-surface"><span class="line-clamp-3">{{ $message->message }}</span></summary>
                                    <p class="mt-2 whitespace-pre-line font-body-sm text-body-sm leading-relaxed text-secondary">{{ $message->message }}</p>
                                    @if ($isEmail || $isPhone)
                                        <a class="mt-2 inline-flex items-center gap-1.5 font-label-sm text-label-sm font-semibold text-primary hover:underline" href="{{ $isEmail ? 'mailto:' . $message->contact_point : 'https://wa.me/' . preg_replace('/\D/', '', $message->contact_point) }}" target="_blank" rel="noopener noreferrer">
                                            <span class="material-symbols-outlined text-[15px]">{{ $isEmail ? 'reply' : 'chat' }}</span>
                                            {{ $isEmail ? 'Balas via surel' : 'Hubungi via WhatsApp' }}
                                        </a>
                                    @endif
                                </details>
                            </td>
                            <td class="px-5 py-4 font-body-sm text-body-sm text-secondary">
                                {{ $message->created_at->translatedFormat('d M Y') }}
                                <span class="mt-0.5 block text-label-sm text-on-surface-variant">{{ $message->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-5 py-4">
                                @if ($message->is_read)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-3 py-1 font-label-sm text-label-sm font-semibold text-secondary">
                                        <span class="h-1.5 w-1.5 rounded-full bg-outline"></span>Dibaca
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-fixed px-3 py-1 font-label-sm text-label-sm font-semibold text-primary-container">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>Baru
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.pesan.show', $message) }}" class="inline-flex min-h-9 items-center justify-center gap-1 rounded-lg border border-outline-variant px-3 py-1.5 font-label-sm text-label-sm font-semibold text-on-surface hover:bg-surface-container" title="Lihat detail pesan">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        <span class="hidden sm:inline">Detail</span>
                                    </a>
                                    <form action="{{ route('admin.pesan.destroy', $message) }}" method="POST" onsubmit="return confirm({{ json_encode('Hapus pesan dari ' . $message->full_name . '?') }})">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex min-h-9 items-center justify-center rounded-lg border border-error/30 px-3 py-1.5 font-label-sm text-label-sm font-semibold text-error hover:bg-error-container/30" title="Hapus pesan">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <span class="material-symbols-outlined mb-2 text-4xl text-outline">inbox</span>
                                <p class="font-body-md text-body-md text-secondary">Belum ada pesan masuk dari halaman kontak.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($messages->hasPages())
            <div class="border-t border-outline-variant/30 px-5 py-4">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
