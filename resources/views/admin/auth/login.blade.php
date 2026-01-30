@push('styles')
    @vite('resources/css/admin/auth/login.css')
@endpush

@push('scripts')
    @vite('resources/js/admin/auth/login.js')
@endpush

<x-default-guest-layout :title="'Premium Property Management'">

   <div class="login-container">
    <div class="login-card">
        <h2>Admin Login</h2>

        {{-- Error message --}}
        @if($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin_login_submit') }}" id="loginForm">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>


</x-default-guest-layout>
