@extends('layouts.app')

@section('content')
<div class="min-h-[620px] bg-slate-50 px-6 py-16">
    <div class="mx-auto flex max-w-lg items-center justify-center">
        <div class="w-full rounded-2xl border border-slate-200 bg-white p-7 shadow-xl shadow-blue-950/10 sm:p-10">
            <div class="mb-8"><div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-blue-950 text-xl text-white"><i class="fas fa-lock"></i></div><p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-600">Admin portal</p><h1 class="mt-2 text-3xl font-bold text-slate-900">Choose a new password</h1><p class="mt-2 text-sm text-slate-500">Create a strong password for your administrator account.</p></div>
            @if ($errors->any())<div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div><label for="email" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Email Address') }}</label><input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-900 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10"></div>
                <div><label for="password" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Password') }}</label><div class="relative"><input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded-lg border border-slate-300 px-4 py-3 pr-12 text-slate-900 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10"><button type="button" data-password-toggle="password" aria-label="Show password" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600"><i class="fas fa-eye"></i></button></div>@error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror</div>
                <div><label for="password-confirm" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Confirm Password') }}</label><div class="relative"><input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-lg border border-slate-300 px-4 py-3 pr-12 text-slate-900 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10"><button type="button" data-password-toggle="password-confirm" aria-label="Show password" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600"><i class="fas fa-eye"></i></button></div></div>
                <button type="submit" class="w-full rounded-lg bg-blue-950 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-blue-900">{{ __('Reset Password') }}</button>
            </form>
            <a href="{{ route('login') }}" class="mt-7 block text-center text-sm font-semibold text-slate-500 hover:text-blue-950">Back to sign in</a>
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

