@extends('layouts.app')

@section('page-title', 'Profile')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Profile</h2>
            <p class="page-subtitle">Manage your account information and security.</p>
        </div>
    </div>

    <div class="grid-2" style="align-items:start">
        <div class="fade-in-1">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div style="display:flex;flex-direction:column;gap:1.5rem">
            <div class="fade-in-2">
                @include('profile.partials.update-password-form')
            </div>

            <div class="fade-in-3">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            var saved = document.querySelectorAll('.saved-msg');
            saved.forEach(function (el) {
                setTimeout(function () {
                    el.style.transition = 'opacity .4s ease';
                    el.style.opacity = '0';
                    setTimeout(function () { el.style.display = 'none'; }, 400);
                }, 2500);
            });
        })();
    </script>
@endsection
