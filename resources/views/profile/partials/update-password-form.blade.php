<div class="card">
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Update Password') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="p-2 mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-group d-flex align-items-center mb-3">
            <label for="update_password_current_password" class="me-3" style="min-width: 150px;">Current Password</label>
            <input type="password" id="update_password_current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
            @error('current_password')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group d-flex align-items-center mb-3">
            <label for="password" class="me-3" style="min-width: 150px;">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group d-flex align-items-center mb-3">
            <label for="update_password_password_confirmation" class="me-3" style="min-width: 150px;">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation">
            @error('password_confirmation')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-flex mt-4">
            <button class="btn btn-dark">Save</button>
        </div>
    </form>
</div>
