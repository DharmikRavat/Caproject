@extends('layouts.app')

@section('content')
<style>
    .password-page { background:#f1f5f9; min-height:620px; padding:64px 24px; font-family:Arial,sans-serif; }.password-card { background:#fff; border:1px solid #e2e8f0; border-radius:16px; box-shadow:0 18px 45px rgba(15,23,42,.12); margin:auto; max-width:510px; padding:40px; }.password-icon { align-items:center; background:#172f4d; border-radius:10px; color:#fff; display:flex; height:48px; justify-content:center; width:48px; }.password-kicker { color:#059669; font-size:12px; font-weight:700; letter-spacing:2px; margin:20px 0 8px; text-transform:uppercase; }.password-card h1 { color:#0f172a; font-size:30px; line-height:1.2; margin:0 0 8px; }.password-copy { color:#64748b; font-size:14px; line-height:1.6; margin:0 0 26px; }.password-label { color:#334155; display:block; font-size:14px; font-weight:700; margin-bottom:8px; }.password-input { border:1px solid #cbd5e1; border-radius:8px; box-sizing:border-box; font-size:15px; padding:13px 15px; width:100%; }.password-input:focus { border-color:#059669; outline:3px solid rgba(5,150,105,.12); }.password-button { background:#172f4d; border:0; border-radius:8px; color:#fff; cursor:pointer; font-size:14px; font-weight:700; padding:14px 20px; width:100%; }.password-button:hover { background:#244568; }.password-alert { border-radius:8px; font-size:14px; margin-bottom:22px; padding:13px 15px; }.password-success { background:#ecfdf5; border:1px solid #a7f3d0; color:#047857; }.password-error { background:#fef2f2; border:1px solid #fecaca; color:#b91c1c; }.password-back { color:#64748b; display:block; font-size:14px; font-weight:700; margin-top:24px; text-align:center; text-decoration:none; }.password-back:hover { color:#172f4d; } @media(max-width:600px){.password-card{padding:28px 22px}.password-page{padding:36px 16px}}
</style>
<div class="password-page min-h-[620px] bg-slate-50 px-6 py-16">
    <div class="mx-auto flex max-w-lg items-center justify-center">
        <div class="password-card w-full rounded-2xl border border-slate-200 bg-white p-7 shadow-xl shadow-blue-950/10 sm:p-10">
            <div class="mb-8"><div class="password-icon mb-5 grid h-12 w-12 place-items-center rounded-xl bg-blue-950 text-xl text-white"><i class="fas fa-key"></i></div>
                <p class="password-kicker text-sm font-bold uppercase tracking-[0.2em] text-emerald-600">Admin portal</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-900">Reset your password</h1>
                <p class="password-copy mt-2 text-sm leading-6 text-slate-500">Enter your administrator email and we will send a secure password reset link.</p>
            </div>

            @if (session('status'))
                <div class="password-alert password-success mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700" role="alert">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="password-alert password-error mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="password-label mb-2 block text-sm font-semibold text-slate-700">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="admin@example.com" class="password-input block w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10">
                    @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="password-button w-full rounded-lg bg-blue-950 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-950/20 transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-950/20">{{ __('Send Password Reset Link') }}</button>
            </form>
            <a href="{{ route('login') }}" class="password-back mt-7 block text-center text-sm font-semibold text-slate-500 hover:text-blue-950"><i class="fas fa-arrow-left mr-2 text-xs"></i>Back to sign in</a>
        </div>
    </div>
</div>
@endsection
