@extends('layouts.guest')

@section('page-title', 'Login')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:.25rem">Welcome back</h2>
    <p style="color:#94a3b8;font-size:.8125rem;margin:0 0 1.5rem">Sign in to your account to continue.</p>

    @if (session('status'))
        <div class="guest-note success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="guest-note">
            <strong style="color:#fca5a5">Whoops!</strong> There were some problems with your input.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@company.com" required autofocus autocomplete="username">
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
            @error('password')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex-between mb-4" style="flex-wrap:nowrap">
            <label class="guest-check" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:.8125rem;font-weight:600">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Sign In
        </button>
    </form>

    <div class="guest-foot">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </div>
@endsection
