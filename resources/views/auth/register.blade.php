@extends('layouts.guest')

@section('page-title', 'Register')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:.25rem">Create your account</h2>
    <p style="color:#94a3b8;font-size:.8125rem;margin:0 0 1.5rem">Start managing your organization today.</p>

    @if ($errors->any())
        <div class="guest-note">
            <strong style="color:#fca5a5">Whoops!</strong> There were some problems with your input.
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name">
            @error('name')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@company.com" required autocomplete="username">
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Minimum 8 characters" required autocomplete="new-password">
            @error('password')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Repeat your password" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Create Account
        </button>
    </form>

    <div class="guest-foot">
        Already registered? <a href="{{ route('login') }}">Sign in</a>
    </div>
@endsection
