<section class="card">
    <div class="card-header">
        <div>
            <h3 style="color:var(--danger)">Delete Account</h3>
            <p class="text-muted" style="font-size:.8125rem;margin:0">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        </div>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-danger" id="deleteAccountBtn">
            <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            Delete Account
        </button>

        <div id="deletePanel" style="display:none;margin-top:1.25rem">
            <div class="divider" style="margin:.25rem 0 1rem"></div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <p style="font-size:.875rem;color:var(--muted);margin:0 0 1rem">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="form-group">
                    <label for="delete_password" class="form-label">Password</label>
                    <input id="delete_password" name="password" type="password" class="form-control" placeholder="Enter your password to confirm">
                    @if ($errors->userDeletion->has('password'))
                        <div class="input-error">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>

                <div class="flex-center">
                    <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    (function () {
        var btn = document.getElementById('deleteAccountBtn');
        var panel = document.getElementById('deletePanel');
        var cancel = document.getElementById('cancelDeleteBtn');

        function toggle(show) {
            panel.style.display = show ? 'block' : 'none';
        }

        if (btn && panel) {
            btn.addEventListener('click', function () { toggle(true); });
            if (cancel) {
                cancel.addEventListener('click', function () { toggle(false); });
            }
        }
    })();
</script>
