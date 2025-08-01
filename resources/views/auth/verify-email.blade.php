<x-guest-layout>

    <div class="alert alert-info small">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Resend Verification -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-danger p-0 m-0" style="text-decoration: none;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

</x-guest-layout>
