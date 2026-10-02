@extends('admin.layout')

@section('content')
<header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-space-lg border-b border-outline-variant/30">
    <div class="flex flex-col">
        <span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest">Organisasi</span>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl text-on-surface font-bold tracking-tight mt-1">Manajemen Banom</h1>
        <p class="font-body-md text-body-md text-secondary mt-1">Kelola badan otonom, ranting, dan struktur kepengurusan MWCNU.</p>
    </div>
    <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('admin.banoms.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold transition-all hover:bg-tertiary-container shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tambah Banom</span>
        </a>
    </div>
</header>

@if (session('status'))
    <div class="rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container" role="status">{{ session('status') }}</div>
@endif

<div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest overflow-hidden shadow-sm mt-6">
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50 border-b border-outline-variant/30 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant font-semibold">
                    <th class="py-3.5 px-6 font-semibold" scope="col">Organisasi</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Kategori</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Pengurus</th>
                    <th class="py-3.5 px-6 font-semibold" scope="col">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30 font-body-md text-body-md">
                @forelse ($banoms as $banom)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-4 px-6">
                            <span class="font-semibold text-on-surface block">{{ $banom->name }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $banom->title }}</span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-label-sm font-medium">{{ $banom->category }}</span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-on-surface-variant font-body-sm text-body-sm">{{ $banom->members_count }} orang</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold {{ $banom->is_active ? 'bg-primary-fixed/40 text-primary-container' : 'bg-surface-container-high text-on-surface-variant' }}">
                                {{ $banom->is_active ? 'Tampil' : 'Disembunyikan' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5 text-outline">
                                <a href="{{ route('admin.banoms.edit', $banom) }}" class="p-1.5 hover:text-primary-container hover:bg-surface-container rounded-lg transition-colors" title="Ubah">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.banoms.destroy', $banom) }}" method="POST" onsubmit="return confirm('Hapus banom ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-1.5 hover:text-error hover:bg-error-container/30 rounded-lg transition-colors" title="Hapus" type="submit">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-12 text-center text-secondary font-body-md text-body-md">Belum ada data Banom.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($banoms->hasPages())
        <div class="px-6 py-4 bg-surface-container-low/50 border-t border-outline-variant/30">
            {{ $banoms->links() }}
        </div>
    @endif
</div>
@endsection
