@extends('admin.layout')

@section('content')
<div class="flex flex-col gap-6">
    <div><p class="mb-2 text-[11px] font-bold uppercase tracking-widest text-primary">AKUN ADMIN</p><h1 class="font-headline-xl text-2xl font-extrabold text-slate-900">Pengaturan</h1><p class="mt-2 text-sm text-slate-500">Informasi akun dan keamanan akses administrator.</p></div>
    @if (session('status') === 'password-updated')<div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">Kata sandi berhasil diperbarui.</div>@endif
    @if ($errors->updatePassword->any())<div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800" role="alert">@foreach ($errors->updatePassword->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
    <section class="grid grid-cols-1 gap-5 xl:grid-cols-2">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-7">
            <div class="mb-5 flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-primary"><span class="material-symbols-outlined">admin_panel_settings</span></span><div><h2 class="font-headline-md text-lg font-bold text-slate-900">Akun administrator</h2><p class="text-xs text-slate-500">Akun dengan akses penuh ke panel admin.</p></div></div>
            <dl class="divide-y divide-slate-100 text-sm"><div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Nama</dt><dd class="text-right font-semibold text-slate-800">{{ auth()->user()->name }}</dd></div><div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Email</dt><dd class="text-right font-semibold text-slate-800">{{ auth()->user()->email }}</dd></div><div class="flex justify-between gap-4 py-3"><dt class="text-slate-500">Akses</dt><dd class="text-right font-semibold text-emerald-800">Administrator</dd></div></dl>
        </div>
        <form class="flex flex-col gap-5 rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-7" action="{{ route('admin.settings.password') }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-1 flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-primary"><span class="material-symbols-outlined">lock</span></span><div><h2 class="font-headline-md text-lg font-bold text-slate-900">Ubah kata sandi</h2><p class="text-xs text-slate-500">Konfirmasi kata sandi saat ini untuk melanjutkan.</p></div></div>
            <label class="flex flex-col gap-2 text-sm font-semibold text-slate-700" for="current_password">Kata sandi saat ini<input class="rounded-lg border-slate-300 bg-slate-50 text-sm font-normal focus:border-primary focus:ring-primary" id="current_password" name="current_password" type="password" autocomplete="current-password" required></label>
            <label class="flex flex-col gap-2 text-sm font-semibold text-slate-700" for="password">Kata sandi baru<input class="rounded-lg border-slate-300 bg-slate-50 text-sm font-normal focus:border-primary focus:ring-primary" id="password" name="password" type="password" autocomplete="new-password" required></label>
            <label class="flex flex-col gap-2 text-sm font-semibold text-slate-700" for="password_confirmation">Ulangi kata sandi baru<input class="rounded-lg border-slate-300 bg-slate-50 text-sm font-normal focus:border-primary focus:ring-primary" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required></label>
            <button class="inline-flex min-h-11 items-center justify-center gap-2 self-start rounded-lg bg-primary-container px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary" type="submit"><span class="material-symbols-outlined text-[18px]">save</span>Simpan kata sandi</button>
        </form>
    </section>
</div>
@endsection