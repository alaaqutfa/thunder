@extends('auth.layout.app')

@section('title', 'Login')

@push('css')
@endpush

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
        <form method="POST" action="{{ route('login') }}" class="max-w-sm w-full bg-white p-6 rounded-lg shadow">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body @error('email') border-red-500 @enderror"
                    placeholder="name@example.com" required autofocus autocomplete="email">

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Password</label>
                <input type="password" name="password" id="password"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body @error('password') border-red-500 @enderror"
                    placeholder="••••••••" required autocomplete="current-password">

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- عرض رسالة الحساب المعطل --}}
                @if (session('error'))
                    <p class="text-red-600 text-sm mt-1">{{ session('error') }}</p>
                @endif
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between mb-5">
                <label for="remember" class="flex items-start">
                    <input id="remember" type="checkbox" name="remember"
                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft mt-1">
                    <p class="ms-2 text-sm font-medium text-heading select-none">Remember me</p>
                </label>

                {{-- Forgot Password --}}
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-brand hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full text-black bg-brand border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none transition duration-200 mb-4">
                Login
            </button>

            {{-- Register Link --}}
            <div class="text-center">
                <p class="text-sm text-body">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-brand hover:underline font-medium">Create One</a>
                </p>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // إضافة تحقق من البريد الإلكتروني
    document.getElementById('email').addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && !emailRegex.test(email)) {
            this.classList.add('border-red-500');
        } else {
            this.classList.remove('border-red-500');
        }
    });

    // إضافة تأثيرات للزر
    const submitButton = document.querySelector('button[type="submit"]');
    const form = document.querySelector('form');

    form.addEventListener('submit', function() {
        submitButton.disabled = true;
        submitButton.innerHTML = 'Logging in...';
        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
    });
</script>
@endpush
