@extends('layouts.guest')

@section('page-title', 'Confirm Password')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:.25rem">Secure area</h2>
    <p style="color:#94a3b8;font-size:.8125rem;margin:0 0 1.5rem">Please confirm your password before continuing.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
            @error('password')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Confirm
        </button>
    </form>
@endsection
