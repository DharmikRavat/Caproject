@extends('layouts.app')

@section('content')
<div class="relative isolate overflow-hidden bg-slate-50">
    <div class="mx-auto grid min-h-[620px] max-w-7xl items-center gap-12 px-6 py-16 lg:grid-cols-[1fr_460px] lg:px-12">
        <div class="hidden lg:block">
            <p class="mb-4 text-sm font-bold uppercase tracking-[0.25em] text-emerald-600">Jitesh Telhara & Associates LLP</p>
            <h1 class="max-w-xl text-5xl font-extrabold leading-tight text-blue-950">Welcome back to your admin workspace.</h1>
            <p class="mt-6 max-w-lg text-lg leading-8 text-slate-600">Manage services, articles, enquiries, careers, and the rest of your firm website from one secure dashboard.</p>
            <div class="mt-10 flex items-center gap-3 text-sm font-semibold text-blue-950">
                <span class="grid h-10 w-10 place-items-center rounded-full bg-emerald-100 text-emerald-700"><i class="fas fa-shield-alt"></i></span>
                Secure administrator access
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-xl shadow-blue-950/10 sm:p-10">
            <div class="mb-8">
                <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-blue-950 text-xl text-white">
                    <i class="fas fa-lock"></i>
                </div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-600">Admin portal</p>
                <h2 class="mt-2 text-3xl font-bold text-slate-900">Sign in</h2>
                <p class="mt-2 text-sm text-slate-500">Use your administrator account to continue.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10" placeholder="admin@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-slate-700">{{ __('Password') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800">{{ __('Forgot password?') }}</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-lg border border-slate-300 px-4 py-3 pr-12 text-slate-900 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10">
                        <button type="button" data-password-toggle="password" aria-label="Show password" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600"><i class="fas fa-eye"></i></button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label for="remember" class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600">
                    {{ __('Remember Me') }}
                </label>

                <button type="submit" class="w-full rounded-lg bg-blue-950 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-950/20 transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-950/20">
                    {{ __('Sign in to dashboard') }}
                </button>
            </form>

            <a href="{{ route('home') }}" class="mt-7 block text-center text-sm font-semibold text-slate-500 hover:text-blue-950">Return to website</a>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.dataset.passwordToggle);
            const isVisible = input.type === 'text';
            input.type = isVisible ? 'password' : 'text';
            button.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
            button.innerHTML = `<i class="fas fa-eye${isVisible ? '' : '-slash'}"></i>`;
        });
    });
</script>
@endsection
