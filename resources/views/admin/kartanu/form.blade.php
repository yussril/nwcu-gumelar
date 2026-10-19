@extends('admin.layout')

@section('content')
<div class="mx-auto w-full max-w-4xl">
    <a href="{{ route('admin.kartanu.index') }}" class="mb-5 inline-flex items-center gap-1 font-label-md text-label-md font-semibold text-primary hover:underline">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali ke data KartaNU
    </a>
    <div class="mb-6">
        <p class="mb-2 font-label-caps text-label-caps font-bold uppercase tracking-widest text-primary">Sensus Anggota</p>
        <h1 class="font-headline-xl text-headline-xl-mobile lg:text-headline-xl font-extrabold text-on-surface">{{ $record->exists ? 'Ubah Data Anggota' : 'Tambah Anggota KartaNU' }}</h1>
        <p class="mt-2 font-body-md text-body-md text-secondary">NIK disimpan terenkripsi di basis data dan ditampilkan pada kartu anggota.</p>
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
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Identitas anggota</h2>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="name">Nama lengkap<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="name" name="name" value="{{ old('name', $record->name) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="nia">Nomor Induk Anggota (NIA)<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="nia" name="nia" value="{{ old('nia', $record->nia) }}" required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="nik">NIK (16 digit)<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="nik" name="nik" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" value="{{ old('nik', $record->nik) }}" autocomplete="off"><span class="font-body-sm text-body-sm font-normal text-on-surface-variant">Ditampilkan pada kartu dan halaman pencarian.</span></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="branch_name">Pengurus ranting<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="branch_name" name="branch_name" value="{{ old('branch_name', $record->branch_name) }}" placeholder="PRNU Desa ..." required></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="birth_place">Tempat lahir<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="birth_place" name="birth_place" value="{{ old('birth_place', $record->birth_place) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="birth_date">Tanggal lahir<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $record->birth_date?->format('Y-m-d')) }}"></label>
            </div>
            <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="photo">Foto anggota<input class="block w-full font-body-sm text-body-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-surface-container file:px-3 file:py-2 file:font-semibold file:text-on-surface-variant" id="photo" name="photo" type="file" accept="image/*"><span class="font-body-sm text-body-sm font-normal text-on-surface-variant">Maksimum 5 MB.</span></label>
            @if ($record->photoUrl())
                <img class="h-40 w-30 rounded-lg border border-outline-variant object-cover object-top" src="{{ $record->photoUrl() }}" alt="Foto anggota saat ini">
            @endif
        </section>
        <section class="flex flex-col gap-5 rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 sm:p-7">
            <div>
                <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Verifikasi &amp; masa berlaku</h2>
                <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">Kode pelacakan dibuat otomatis saat data baru disimpan.</p>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="verification_status">Tahap verifikasi<select class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="verification_status" name="verification_status" required>@foreach (['submitted' => 'Berkas Masuk', 'branch_verified' => 'Verifikasi Ranting', 'mwc_verified' => 'Validasi MWCNU', 'issued' => 'Kartu Terbit', 'rejected' => 'Perlu Perbaikan'] as $value => $label)<option value="{{ $value }}" @selected(old('verification_status', $record->verification_status ?: 'submitted') === $value)>{{ $label }}</option>@endforeach</select></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="verification_note">Catatan verifikasi<textarea class="min-h-20 rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="verification_note" name="verification_note">{{ old('verification_note', $record->verification_note) }}</textarea></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="valid_from">Berlaku mulai<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="valid_from" name="valid_from" type="date" value="{{ old('valid_from', $record->valid_from?->format('Y-m-d')) }}"></label>
                <label class="flex flex-col gap-2 font-label-md text-label-md font-semibold text-on-surface" for="valid_until">Berlaku sampai<input class="rounded-lg border border-outline-variant bg-surface-container-lowest px-4 py-3 font-body-md text-body-md font-normal text-on-surface focus:border-primary-container focus:outline-none focus:ring-4 focus:ring-primary/10" id="valid_until" name="valid_until" type="date" value="{{ old('valid_until', $record->valid_until?->format('Y-m-d')) }}"></label>
            </div>
        </section>
        <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <a class="inline-flex min-h-11 items-center justify-center rounded-lg border border-outline-variant px-5 py-2.5 font-label-md text-label-md font-semibold text-on-surface hover:bg-surface-container" href="{{ route('admin.kartanu.index') }}">Batal</a>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-primary-container px-5 py-2.5 font-label-md text-label-md font-semibold text-on-primary hover:bg-tertiary-container" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan Anggota</button>
        </div>
    </form>
</div>
@endsection
