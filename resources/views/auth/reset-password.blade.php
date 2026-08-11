@extends('layouts.guest')

@section('page-title', 'Reset Password')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:1.5rem">Reset your password</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
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
            Reset Password
        </button>
    </form>
@endsection
