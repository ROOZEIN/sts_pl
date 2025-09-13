@extends('layouts.log')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('login') }}" class="ml-[10rem]">
        @csrf

        <h1 class="ml-[7.6rem]">Login</h1>

        <!-- Email Address -->
        <div>
            <x-input-label class="font-bold" for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Your Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-[1rem]">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center ml-[10.4rem]">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <div>
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex items-center mt-4 ml-[2rem]">
            <p>Don't have an account?</p>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Register here') }}
            </a>
        </div>
    </form>
@endsection