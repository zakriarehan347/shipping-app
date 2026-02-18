<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicons -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="text-center">
                <a href="{{ route('login') }}" class="inline-block">
                    @if(file_exists(public_path('images/scs-logo.webp')) || file_exists(public_path('images/scs-logo.png')))
                        <picture>
                            @if(file_exists(public_path('images/scs-logo.webp')))
                                <source srcset="{{ asset('images/scs-logo.webp') }}" type="image/webp">
                            @endif
                            <img src="{{ asset(file_exists(public_path('images/scs-logo.png')) ? 'images/scs-logo.png' : 'images/scs-logo.webp') }}" alt="{{ config('app.name') }}" class="mx-auto shrink-0 object-contain" style="width: 80px; height: 80px; max-width: 80px; max-height: 80px;" />
                        </picture>
                    @else
                        <div class="w-20 h-20 rounded-full bg-amber-400 border-2 border-red-600 flex items-center justify-center mx-auto text-red-600 font-bold text-lg shrink-0">SCS</div>
                    @endif
                </a>
                <p class="mt-2 font-semibold text-gray-800">{{ config('app.name') }}</p>
                <p class="text-xs text-gray-500">Syed Cargo Service</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
