<x-guest-layout :title="'Login Portal Admin - MWCNU Gumelar'">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Form Login -->
    <form class="w-full space-y-5" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Field 1: Email -->
        <div class="space-y-1.5">
            <label class="block font-label-caps text-label-caps font-semibold text-secondary uppercase tracking-widest" for="email">
                Email
            </label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">mail</span>
                <input id="email" class="w-full rounded-xl border border-outline-variant bg-surface-container-low pl-10 pr-4 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@mwcnu.or.id" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Field 2: Password -->
        <div class="space-y-1.5">
            <label class="block font-label-caps text-label-caps font-semibold text-secondary uppercase tracking-widest" for="password">
                Kata Sandi
            </label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">lock</span>
                <input id="password" class="w-full rounded-xl border border-outline-variant bg-surface-container-low pl-10 pr-12 py-3 font-body-md text-body-md text-on-surface placeholder:text-outline focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all" type="password" name="password" required autocomplete="current-password" placeholder="••••••••••••" />
                <button aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-outline hover:text-on-surface transition-colors" id="togglePassword" type="button">
                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Extra Options -->
        <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" name="remember" type="checkbox">
                <span class="font-body-sm text-body-sm text-on-surface-variant font-normal select-none">Ingat Saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="font-body-sm text-body-sm text-secondary hover:text-primary transition-colors" href="{{ route('password.request') }}">
                    Lupa Kata Sandi?
                </a>
            @endif
        </div>

        <!-- Action Button -->
        <div class="pt-2">
            <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-semibold py-3.5 px-6 rounded-xl transition-all flex items-center justify-center gap-2 font-label-md text-label-md shadow-sm hover:shadow-md" type="submit">
                <span>Masuk ke Sistem</span>
                <span class="material-symbols-outlined text-[18px]">login</span>
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePasswordBtn.innerHTML = isPassword
                        ? '<span class="material-symbols-outlined text-[20px]">visibility_off</span>'
                        : '<span class="material-symbols-outlined text-[20px]">visibility</span>';
                });
            }
        });
    </script>
</x-guest-layout>
