@push('styles')
@vite('resources/css/web/login/login.css') <!-- reuse the same minimal style -->
@endpush

@push('scripts')
@vite('resources/js/web/login/login.js') <!-- optional if you have JS validation -->
@endpush

<x-default-layout :title="'Premium Blog Platform / User Login'">

    <div class="auth-container" login-url="{{ route('user_login') }}" >
        <h2>User Login</h2>
        <form method="POST" action="{{ route('user_login_submit') }}" >
            @csrf

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required value="{{ old('email') }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3" style="text-align: right;">
                <a href="{{ route('user_register') }}" style="font-size: 0.9rem; color: #2563eb;">Create an account?</a>
            </div>

            <button type="submit">Login</button>

        </form>
    </div>

</x-default-layout>
