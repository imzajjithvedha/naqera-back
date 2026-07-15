@extends('layouts.frontend')

@section('title', 'Login to Your Account')

@section('meta_description', 'Securely log in to your ' . config('app.name') . ' account to manage bookings, access your dashboard, track earnings, and explore properties.')

@section('content')
    <div class="wrapper auth-page">
        <div class="width">
            <h1 class="title">Welcome Back</h1>
            <p class="description">Access your bookings and dashboard securely.</p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="grid mb-4 md:mb-5">
                    <label for="email" class="label">Email Address<span class="asterisk">*</span></label>

                    <input type="email" class="input" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>

                    <x-input-error field="email"></x-input-error>
                </div>

                <div class="grid mb-2.5 md:mb-3 relative">
                    <label for="password" class="label">Password<span class="asterisk">*</span></label>
                    <input type="password" class="input" id="password" name="password" placeholder="Enter your password" required>
                    <span class="bi bi-eye-slash-fill toggle-password"></span>
                </div>

                <div class="flex justify-between items-center mb-4 md:mb-5">
                    <div class="flex items-center gap-1.5">
                        <input type="checkbox" class="w-3 h-3 md:w-4.25 md:h-4.25 accent-(--color-primary)" id="remember" name="remember">
                        <label class="text-sm cursor-pointer hover:font-medium" for="remember">Remember Me</label>
                    </div>

                    <a href="#" class="text-sm hover:font-medium hover:underline">Forgot Password?</a>
                </div>

                <button type="submit" class="submit-button mb-4 md:mb-5">Login Now</button>
            </form>

            <p class="text">
                Don't have an account?
                <a href="#" class="span-link">Create an Account</a>
            </p>
        </div>
    </div>
@endsection
