<section class="card">
    <div class="card-header">
        <div>
            <h3>Profile Information</h3>
            <p class="text-muted" style="font-size:.8125rem;margin:0">Update your account's profile information and email address.</p>
        </div>
    </div>
    <div class="card-body">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <p class="text-muted" style="font-size:.8125rem;margin-top:.75rem">
                        Your email address is unverified.
                        <button form="send-verification" type="submit" class="link-primary" style="background:none;border:none;padding:0;cursor:pointer;font-size:.8125rem">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="color:var(--success);font-size:.8125rem;margin-top:.5rem">A new verification link has been sent to your email address.</p>
                    @endif
                @endif
            </div>

            <div class="flex-center">
                <button type="submit" class="btn btn-primary">Save</button>

                @if (session('status') === 'profile-updated')
                    <span class="saved-msg text-muted" style="font-size:.8125rem;font-weight:500">Saved.</span>
                @endif
            </div>
        </form>
    </div>
</section>
