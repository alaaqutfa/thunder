@extends('auth.layout.app')

@section('title', 'Register')

@push('css')
@endpush

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
        <form method="POST" action="{{ route('register') }}" class="max-w-md w-full bg-white p-6 rounded-lg shadow">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="John Doe" required>

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="name@example.com" required>

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-5">
                <label for="phone" class="block mb-2.5 text-sm font-medium text-heading">Phone (Optional)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="+1234567890">

                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Password</label>
                <input type="password" name="password" id="password"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="••••••••" required>

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2.5 text-sm font-medium text-heading">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="••••••••" required>
            </div>

            {{-- Terms and Conditions (اختياري) --}}
            <div class="mb-5">
                <label for="terms" class="flex items-start">
                    <input id="terms" type="checkbox" name="terms" required
                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft mt-1">
                    <span class="ms-2 text-sm text-heading">
                        I agree to the <a href="#" class="text-brand hover:underline">Terms and Conditions</a>
                    </span>
                </label>
                @error('terms')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full text-black bg-brand border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none transition duration-200">
                Create Account
            </button>

            {{-- Login Link --}}
            <div class="text-center mt-4">
                <p class="text-sm text-body">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-brand hover:underline font-medium">Sign in</a>
                </p>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // إضافة تحقق بسيط من صحة البريد الإلكتروني
    document.getElementById('email').addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && !emailRegex.test(email)) {
            this.classList.add('border-red-500');
        } else {
            this.classList.remove('border-red-500');
        }
    });

    // تحقق من تطابق كلمات المرور
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;

        if (confirmPassword && password !== confirmPassword) {
            this.classList.add('border-red-500');
        } else {
            this.classList.remove('border-red-500');
        }
    });
</script>
@endpush
