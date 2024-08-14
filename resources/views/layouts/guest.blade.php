<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SITAS') }}</title>
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('../assets/1701414769-Ysu6wbLMYS-thumbnail.jpg')] bg-cover">
        </div>
        <div class="px-6 py-4 absolute right-0 top-0 h-screen flex items-center justify-center flex-col bg-white shadow-2xl overflow-hidden sm:rounded-lg">
            <div class="">
                <a href="/">
                    <img src="{{asset('logo/STMIK20200330-1.png')}}" alt="">
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
