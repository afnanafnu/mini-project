@push('styles')
@vite('resources/css/web/register/register.css')
@endpush

@push('scripts')
@vite('resources/js/web/register/register.js')
@endpush

<x-default-layout :title="'Premium Blog Platform / Register User'">

    <div class="auth-container mt-5">
        <h2>User Registration</h2>
        <form method="POST" action="{{ route('user_register_submit') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="{{ route('user_login') }}">Already have an account? Login</a>
        </form>
    </div>

</x-default-layout>