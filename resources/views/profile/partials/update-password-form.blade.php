<section class="card">
    <div class="card-header">
        <div>
            <h3>Update Password</h3>
            <p class="text-muted" style="font-size:.8125rem;margin:0">Ensure your account is using a long, random password to stay secure.</p>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="update_password_current_password" class="form-label">Current Password</label>
                <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                @if ($errors->updatePassword->has('current_password'))
                    <div class="input-error">{{ $errors->updatePassword->first('current_password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="update_password_password" class="form-label">New Password</label>
                <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
                @if ($errors->updatePassword->has('password'))
                    <div class="input-error">{{ $errors->updatePassword->first('password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                @if ($errors->updatePassword->has('password_confirmation'))
                    <div class="input-error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                @endif
            </div>

            <div class="flex-center">
                <button type="submit" class="btn btn-primary">Save</button>

                @if (session('status') === 'password-updated')
                    <span class="saved-msg text-muted" style="font-size:.8125rem;font-weight:500">Saved.</span>
                @endif
            </div>
        </form>
    </div>
</section>
