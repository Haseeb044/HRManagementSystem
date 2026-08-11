@extends('layouts.guest')

@section('page-title', 'Verify Email')

@section('content')
    <h2 style="color:#fff;font-size:1.25rem;font-weight:700;margin-bottom:.25rem">Verify your email</h2>
    <p style="color:#94a3b8;font-size:.8125rem;margin:0 0 1.5rem">Thanks for signing up! Before getting started, please verify your email address by clicking the link we emailed you.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="guest-note success">A new verification link has been sent to the email address you provided during registration.</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">
            Resend Verification Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:.75rem">
        @csrf
        <button type="submit" class="btn btn-secondary btn-block">Log Out</button>
    </form>
@endsection
