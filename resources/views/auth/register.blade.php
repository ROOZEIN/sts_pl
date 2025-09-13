@extends('layouts.log')
@section('content')
    <form method="POST" action="{{ route('register') }}" class="ml-[8.5rem]">
        @csrf

        <h1 class="ml-[5rem]">Register</h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-[1rem]">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Your Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-[1rem]">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-[1rem]">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-[20rem] h-[2rem] rounded-[5px]"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-[1rem]">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center mt-4 ml-[1.8rem]">
            <p>Already have an account?</p>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Log In here') }}
            </a>
        </div>
    </form>
@endsection