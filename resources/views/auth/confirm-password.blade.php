<x-guest-layout>

    <div class="alert alert-warning small">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Confirm
            </button>
        </div>
    </form>

</x-guest-layout>
