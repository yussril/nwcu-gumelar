@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 font-label-caps text-label-caps text-secondary tracking-widest uppercase">
                <span>Pusat Sensus KartaNU Terpusat</span>
                <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                <span class="text-primary font-semibold">Otoritas Sekretariat MWCNU</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight">
                Verifikasi &amp; Keputusan Sensus KartaNU
            </h1>
            <p class="font-body-md text-body-md text-secondary max-w-2xl">
                Persetujuan langsung data pendaftaran warga oleh Sekretariat MWCNU Gumelar untuk penerbitan fisik &amp; digital e-KartaNU.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md font-semibold hover:bg-surface-container transition-all border border-outline-variant/30">
                <span class="material-symbols-outlined text-[18px]">sync</span>
                <span>Sinkron Data</span>
            </button>
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">file_download</span>
                <span>Ekspor Data</span>
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Terdata -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Total Terdata</span>
                <div class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px] text-secondary">groups</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="font-headline-xl text-headline-xl text-on-surface font-extrabold leading-none">{{ number_format($totalCount) }}</div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">Total data sensus</p>
            </div>
        </div>
        <!-- Antrean MWCNU -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-error-container/20 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="flex items-center justify-between relative">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Antrean MWCNU</span>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span>
                    Perlu Tindakan
                </span>
            </div>
            <div class="mt-4 relative">
                <div class="font-headline-xl text-headline-xl text-error font-extrabold leading-none">{{ $pendingCount }}</div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">Permohonan verifikasi tertunda</p>
            </div>
        </div>
        <!-- Disetujui / Dicetak -->
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider font-semibold">Disetujui / Dicetak</span>
                <div class="w-10 h-10 rounded-xl bg-primary-fixed/40 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px] text-on-tertiary-container">verified</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="font-headline-xl text-headline-xl text-primary font-extrabold leading-none">{{ number_format($approvedCount) }}</div>
                <p class="font-body-sm text-body-sm text-secondary mt-2">
                    <span class="font-semibold text-primary">{{ $totalCount > 0 ? round(($approvedCount / $totalCount) * 100, 1) : 0 }}%</span> dari total sensus terbit
                </p>
            </div>
        </div>
    </div>

    <!-- Main Data Table Container -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">
        <!-- Toolbar -->
        <div class="p-4 flex flex-col xl:flex-row xl:items-center justify-between gap-3 bg-surface-container-lowest border-b border-outline-variant/20">
            <!-- Filter Tabs - Dengan fungsionalitas filter -->
            <div class="flex items-center gap-6 overflow-x-auto scrollbar-none pb-1 xl:pb-0" id="filter-tabs">
                <button class="filter-tab font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="all">
                    Semua Data <span class="font-label-sm text-secondary">({{ $totalCount }})</span>
                </button>
                <button class="filter-tab font-label-md text-label-md text-primary font-bold whitespace-nowrap py-1 relative active" data-filter="pending">
                    Menunggu Keputusan MWCNU <span class="font-label-sm">({{ $pendingCount }})</span>
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                </button>
                <button class="filter-tab font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="approved">
                    Disetujui <span class="font-label-sm text-secondary">({{ $approvedCount }})</span>
                </button>
                <button class="filter-tab font-label-md text-label-md text-secondary hover:text-on-surface whitespace-nowrap py-1 font-medium transition-colors" data-filter="rejected">
                    Ditolak <span class="font-label-sm text-secondary">({{ $rejectedCount }})</span>
                </button>
            </div>
            <!-- Filters & Search -->
            <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-center">
                <div class="relative">
                    <select class="w-full appearance-none bg-surface-container-low text-on-surface font-label-md text-label-md pl-3 pr-8 py-2 rounded-xl focus:outline-none focus:bg-surface-container-lowest transition-colors cursor-pointer border border-outline-variant/30" id="filter-ranting">
                        <option value="">Semua Ranting</option>
                        @foreach ($branchOptions as $branch)
                            <option value="{{ Str::lower($branch) }}">{{ $branch }}</option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined text-[16px] text-secondary absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                </div>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary text-[16px]">search</span>
                    <input class="w-full sm:w-64 h-9 pl-9 pr-3 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-secondary focus:outline-none focus:bg-surface-container-lowest transition-all border border-outline-variant/30" id="filter-search" placeholder="Cari NIK atau Nama warga..." type="search">
                </div>
            </div>
        </div>
        <!-- Table Section -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[760px]">
                <thead class="bg-surface-container-low/70">
                    <tr>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Identitas Warga</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Asal Ranting</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Tanggal Masuk</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary" scope="col">Status MWCNU</th>
                        <th class="px-5 py-3 font-label-caps text-label-caps font-semibold uppercase text-secondary text-right" scope="col">Aksi Keputusan</th>
                    </tr>
                </thead>
                <tbody class="font-body-md text-body-md text-on-surface" id="table-body">
                    @forelse ($records as $record)
                        @php
                            $statusClass = match(true) {
                                in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified']) => 'pending',
                                $record->verification_status === 'issued' => 'approved',
                                $record->verification_status === 'rejected' => 'rejected',
                                default => 'pending',
                            };
                        @endphp
                        <tr class="data-row hover:bg-surface-container-low/40 transition-colors group border-b border-outline-variant/10 last:border-0" data-status="{{ $statusClass }}" data-ranting="{{ Str::lower($record->branch_name) }}" data-search="{{ Str::lower(trim($record->name.' '.$record->nik.' '.$record->nia.' '.$record->branch_name.' '.($record->desa_ranting ?? ''))) }}">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-fixed text-on-primary-fixed-variant font-headline-sm text-headline-sm flex items-center justify-center font-bold flex-shrink-0">
                                        {{ strtoupper(substr($record->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-headline-sm text-headline-sm text-on-surface font-semibold tracking-tight">{{ $record->name }}</div>
                                        <div class="font-label-sm text-label-sm text-on-surface tracking-normal font-medium mt-0.5 font-mono">NIK: {{ $record->nik ?: 'Tidak tersedia' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-label-md text-label-md text-on-surface font-medium">{{ $record->branch_name }}</div>
                                <div class="font-label-sm text-label-sm text-secondary">{{ $record->desa_ranting }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-label-md text-label-md text-on-surface">{{ $record->created_at->translatedFormat('d M Y') }}</div>
                                <div class="font-label-sm text-label-sm text-secondary">{{ $record->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-5 py-4">
                                @if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified']))
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container/40 text-on-error-container font-label-caps text-label-caps font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-error animate-ping"></span>
                                        Menunggu Keputusan
                                    </span>
                                @elseif($record->verification_status === 'issued')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-label-caps text-label-caps font-semibold">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                        Disetujui MWCNU
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-caps text-label-caps font-semibold">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(in_array($record->verification_status, ['submitted', 'branch_verified', 'mwc_verified']))
                                        <form action="{{ route('admin.kartanu.approve', $record) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="bg-primary-container hover:bg-primary text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm font-semibold inline-flex items-center gap-1 shadow-sm transition-all hover:shadow-md" type="submit" title="Setujui pendaftaran">
                                                <span class="material-symbols-outlined text-[14px]">check</span>
                                                <span>Setujui</span>
                                            </button>
                                        </form>
                                        <button onclick="document.getElementById('reject-form-{{ $record->id }}').classList.toggle('hidden')" class="bg-surface-container-low hover:bg-error-container hover:text-on-error-container text-error px-3 py-1.5 rounded-lg font-label-sm text-label-sm font-semibold inline-flex items-center gap-1 transition-all border border-outline-variant/30" type="button" title="Tolak pendaftaran">
                                            <span class="material-symbols-outlined text-[14px]">close</span>
                                            <span>Tolak</span>
                                        </button>
                                        <a href="{{ route('admin.kartanu.show', $record) }}" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                        <form id="reject-form-{{ $record->id }}" action="{{ route('admin.kartanu.reject', $record) }}" method="POST" class="hidden absolute right-0 top-full z-10 bg-surface-container-lowest border border-outline-variant rounded-xl p-3 shadow-lg w-64">
                                            @csrf
                                            <label class="block font-label-sm text-label-sm font-semibold text-on-surface mb-1">Catatan Penolakan</label>
                                            <textarea name="verification_note" required class="w-full rounded-lg border border-outline-variant bg-surface-container-low px-2 py-1.5 text-xs text-on-surface placeholder:text-secondary focus:outline-none focus:border-primary" placeholder="Alasan penolakan..." rows="2"></textarea>
                                            <div class="flex justify-end gap-1 mt-2">
                                                <button type="button" onclick="document.getElementById('reject-form-{{ $record->id }}').classList.add('hidden')" class="px-2 py-1 text-xs text-secondary hover:text-on-surface">Batal</button>
                                                <button type="submit" class="px-2 py-1 text-xs bg-error text-white rounded-lg hover:bg-error/90">Tolak</button>
                                            </div>
                                        </form>
                                    @elseif($record->verification_status === 'issued')
                                        <a href="{{ route('admin.kartanu.show', $record) }}" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                    @elseif($record->verification_status === 'rejected' && $record->verification_note)
                                        <span class="font-label-sm text-label-sm text-error">{{ Str::limit($record->verification_note, 30) }}</span>
                                        <a href="{{ route('admin.kartanu.show', $record) }}" class="bg-surface-container-low hover:bg-surface-container text-on-surface px-2.5 py-1.5 rounded-lg font-label-sm text-label-sm font-medium transition-all inline-flex items-center gap-1 border border-outline-variant/30" title="Lihat detail">
                                            <span class="material-symbols-outlined text-[14px] text-secondary">visibility</span>
                                            <span>Detail</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-12 text-center font-body-md text-body-md text-secondary">Belum ada data sensus KartaNU.</td></tr>
                    @endforelse
                    {{-- Ditampilkan skrip ketika filter tidak menghasilkan baris apa pun. --}}
                    <tr class="hidden" id="filter-kosong">
                        <td colspan="5" class="py-12 text-center font-body-md text-body-md text-secondary">Tidak ada data yang cocok dengan filter saat ini.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Footer / Pagination -->
        @if ($records->hasPages())
            <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-surface-container-lowest border-t border-outline-variant/20">
                <span class="font-label-md text-label-md text-secondary">
                    Menampilkan <span class="font-semibold text-on-surface">{{ $records->firstItem() }}-{{ $records->lastItem() }}</span> dari <span class="font-semibold text-on-surface">{{ $records->total() }}</span> data
                </span>
                <div class="flex items-center gap-1">
                    {{ $records->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@if (session('status'))
    <div class="fixed bottom-6 right-6 rounded-xl border border-primary-container/30 bg-primary-fixed/20 px-4 py-3 text-sm font-medium text-primary-container shadow-lg" role="status">{{ session('status') }}</div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterTabs = document.querySelectorAll('.filter-tab');
        const dataRows = document.querySelectorAll('.data-row');
        const rantingSelect = document.getElementById('filter-ranting');
        const searchInput = document.getElementById('filter-search');
        const kosong = document.getElementById('filter-kosong');

        // Satu fungsi untuk ketiga kontrol (tab status, ranting, pencarian)
        // supaya mereka salingffects dan tidak perlu saling Override.
        const terapkanFilter = function () {
            const status = (document.querySelector('.filter-tab.active') || {}).dataset;
            const statusAktif = status ? status.filter : 'all';
            const ranting = rantingSelect ? rantingSelect.value : '';
            const cari = searchInput ? searchInput.value.trim().toLowerCase() : '';

            let tampil = 0;
            dataRows.forEach(row => {
                const cocokStatus = statusAktif === 'all' || row.dataset.status === statusAktif;
                const cocokRanting = !ranting || row.dataset.ranting === ranting;
                const cocokCari = !cari || (row.dataset.search || '').includes(cari);
                const tampilkan = cocokStatus && cocokRanting && cocokCari;
                row.style.display = tampilkan ? '' : 'none';
                if (tampilkan) tampil++;
            });

            if (kosong) kosong.classList.toggle('hidden', tampil > 0);
        };

        const aktifkanTab = function (tab) {
            filterTabs.forEach(t => {
                t.classList.remove('text-primary', 'font-bold', 'active');
                t.classList.add('text-secondary');
                const indicator = t.querySelector('.absolute.bottom-0');
                if (indicator) indicator.remove();
            });

            tab.classList.remove('text-secondary');
            tab.classList.add('text-primary', 'font-bold', 'active');

            if (!tab.querySelector('.absolute.bottom-0')) {
                const indicator = document.createElement('span');
                indicator.className = 'absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full';
                tab.appendChild(indicator);
            }
        };

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                aktifkanTab(this);
                terapkanFilter();
            });
        });

        if (rantingSelect) rantingSelect.addEventListener('change', terapkanFilter);
        if (searchInput) searchInput.addEventListener('input', terapkanFilter);

        // Terapkan filter sesuai tab yang aktif saat halaman dibuka. Tanpa ini
        // tabel menampilkan seluruh baris padahal tab "Menunggu Keputusan"
        // sudah aktif sejak server, sehingga angka dan isi tabel tidak cocok.
        aktifkanTab(document.querySelector('.filter-tab.active') || filterTabs[0]);
        terapkanFilter();

        // Reject form toggle
        const rejectButtons = document.querySelectorAll('[onclick*="reject-form"]');
        rejectButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        document.addEventListener('click', function(e) {
            document.querySelectorAll('[id^="reject-form-"]').forEach(form => {
                if (!form.contains(e.target) && !form.classList.contains('hidden')) {
                    form.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
