<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#4C47D6]">
        <div class="flex lg:flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-[#fff] rounded-[10px] ml-[8.4rem] mt-[1.8rem] w-[79rem] md:w-[50rem] lg:w-[79rem] h-[42rem] md:h-[13rem] lg:h-[42rem] ">
            <div class="bg-[#4C47D6] w-[60rem] h-[39rem] ml-[2rem] rounded-[10px]">
                <img src="{{ asset('images/image 3.png') }}" alt="" class="ml-[3rem]">
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </body>
</html>
