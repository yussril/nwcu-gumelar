@extends('admin.layout')

@section('content')
<div class="mx-auto w-full max-w-4xl">
    <a href="{{ route('admin.banoms.index') }}" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke banom
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Organisasi</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">{{ $banom->exists ? 'Ubah Banom' : 'Tambah Banom' }}</h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">Kelola badan otonom, ranting, dan struktur kepengurusan MWCNU.</p>
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
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Profil organisasi</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="name">Nama organisasi<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="name" name="name" value="{{ old('name', $banom->name) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="category">Kategori<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="category" name="category" value="{{ old('category', $banom->category) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="title">Gelar / singkatan<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="title" name="title" value="{{ old('title', $banom->title) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="term">Masa khidmat<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="term" name="term" value="{{ old('term', $banom->term) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="member_count">Jumlah anggota / kegiatan<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="member_count" name="member_count" type="number" value="{{ old('member_count', $banom->member_count) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="coverage">Cakupan wilayah / program<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="coverage" name="coverage" value="{{ old('coverage', $banom->coverage) }}"></label>
            </div>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="description">Deskripsi<textarea class="min-h-20 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="description" name="description" required rows="3">{{ old('description', $banom->description) }}</textarea></label>
            <label class="flex items-center gap-2 font-body-md text-body-md text-on-surface"><input class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container" id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $banom->is_active))>Tampilkan di halaman publik</label>
        </section>

        <!-- Members Section -->
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Anggota / Pengurus</h2>
                    <p class="mt-1 font-body-sm text-body-sm text-secondary">Kelola susunan pengurus beserta foto anggota</p>
                </div>
                <button type="button" id="add-member-btn" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-semibold hover:bg-primary transition-all">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    <span>Tambah Anggota</span>
                </button>
            </div>

            <div id="members-container" class="flex flex-col gap-4">
                @foreach ($members as $index => $member)
                    <div class="member-item flex flex-col gap-4 rounded-xl border border-outline-variant/30 bg-surface-container-low p-4 sm:p-5" data-index="{{ $index }}">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg bg-surface-container border border-outline-variant/40 overflow-hidden flex items-center justify-center flex-shrink-0">
                                    @if($member->photo_path)
                                        <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" class="w-full h-full object-cover member-preview">
                                    @else
                                        <span class="material-symbols-outlined text-[24px] text-outline">person</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-label-md text-label-md font-semibold text-on-surface">{{ $member->name }}</p>
                                    <p class="font-body-sm text-body-sm text-secondary">{{ $member->position }}</p>
                                </div>
                            </div>
                            <button type="button" class="remove-member-btn p-2 rounded-lg text-outline hover:text-error hover:bg-error-container/30 transition-colors" title="Hapus anggota">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                                <span>Nama</span>
                                <input type="text" name="members[{{ $index }}][name]" value="{{ $member->name }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2.5 text-sm text-on-surface placeholder:text-outline focus:border-primary focus:outline-none" required>
                            </label>
                            <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                                <span>Jabatan</span>
                                <input type="text" name="members[{{ $index }}][position]" value="{{ $member->position }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2.5 text-sm text-on-surface placeholder:text-outline focus:border-primary focus:outline-none" required>
                            </label>
                            <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                                <span>Foto</span>
                                <input type="file" name="member_photos[{{ $index }}]" accept="image/jpeg,image/png,image/jpg" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-md file:border-0 file:bg-surface-container file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high">
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="empty-members-msg" class="{{ $members->isEmpty() ? '' : 'hidden' }} rounded-xl border border-dashed border-outline-variant/50 bg-surface-container-low p-8 text-center">
                <span class="material-symbols-outlined text-4xl text-outline">groups</span>
                <p class="mt-2 font-body-md text-body-md text-secondary">Belum ada anggota. Klik "Tambah Anggota" untuk menambahkan.</p>
            </div>
        </section>

        <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <a class="inline-flex min-h-11 items-center justify-center rounded-lg border border-outline-variant px-5 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container" href="{{ route('admin.banoms.index') }}">Batal</a>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan Banom</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('members-container');
        const addBtn = document.getElementById('add-member-btn');
        const emptyMsg = document.getElementById('empty-members-msg');
        let memberIndex = {{ $members->count() }};

        addBtn.addEventListener('click', function() {
            const template = document.createElement('div');
            template.className = 'member-item flex flex-col gap-4 rounded-xl border border-outline-variant/30 bg-surface-container-low p-4 sm:p-5';
            template.dataset.index = memberIndex;
            template.innerHTML = `
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-lg bg-surface-container border border-outline-variant/40 overflow-hidden flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[24px] text-outline">person</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-label-md text-label-md font-semibold text-on-surface">Anggota Baru</p>
                            <p class="font-body-sm text-body-sm text-secondary">Isi nama dan jabatan</p>
                        </div>
                    </div>
                    <button type="button" class="remove-member-btn p-2 rounded-lg text-outline hover:text-error hover:bg-error-container/30 transition-colors" title="Hapus anggota">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                        <span>Nama</span>
                        <input type="text" name="members[${memberIndex}][name]" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2.5 text-sm text-on-surface placeholder:text-outline focus:border-primary focus:outline-none" required>
                    </label>
                    <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                        <span>Jabatan</span>
                        <input type="text" name="members[${memberIndex}][position]" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2.5 text-sm text-on-surface placeholder:text-outline focus:border-primary focus:outline-none" required>
                    </label>
                    <label class="flex flex-col gap-1.5 font-label-sm text-label-sm font-semibold text-on-surface">
                        <span>Foto</span>
                        <input type="file" name="member_photos[${memberIndex}]" accept="image/jpeg,image/png,image/jpg" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-md file:border-0 file:bg-surface-container file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-on-surface-variant file:cursor-pointer hover:file:bg-surface-container-high">
                    </label>
                </div>
            `;
            container.appendChild(template);
            memberIndex++;
            updateEmptyMsg();
            attachRemoveHandlers();
        });

        function attachRemoveHandlers() {
            document.querySelectorAll('.remove-member-btn').forEach(btn => {
                if (!btn.hasAttribute('data-attached')) {
                    btn.setAttribute('data-attached', 'true');
                    btn.addEventListener('click', function() {
                        this.closest('.member-item').remove();
                        updateEmptyMsg();
                    });
                }
            });
        }

        function updateEmptyMsg() {
            const count = document.querySelectorAll('.member-item').length;
            emptyMsg.classList.toggle('hidden', count > 0);
        }

        attachRemoveHandlers();
    });
</script>
@endsection
