@extends('layouts.guest')

@section('page-title', 'Forgot Password')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:.25rem">Forgot your password?</h2>
    <p style="color:#94a3b8;font-size:.8125rem;margin:0 0 1.5rem">No problem. Just tell us your email and we'll send you a reset link.</p>

    @if (session('status'))
        <div class="guest-note success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@company.com" required autofocus>
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Email Password Reset Link
        </button>
    </form>

    <div class="guest-foot">
        Remembered it? <a href="{{ route('login') }}">Back to sign in</a>
    </div>
@endsection
