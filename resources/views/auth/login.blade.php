<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
        <label class="form-check-label" for="remember_me">Remember me</label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            Log in
        </button>
    </div>
</form>

</x-guest-layout>
