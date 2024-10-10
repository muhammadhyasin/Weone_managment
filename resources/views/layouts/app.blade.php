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
        <!-- PWA manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <!-- Full-screen mode for iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <!-- Theme color for Android's address bar and task switcher -->
        <meta name="theme-color" content="#000000">

        <!-- App icons -->
        <link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">

        <!-- Splash screens for iOS -->
        <link rel="apple-touch-startup-image" href="/images/splash/splash-640x1136.png" media="(device-width: 320px)">
        <link rel="apple-touch-startup-image" href="/images/splash/splash-750x1334.png" media="(device-width: 375px)">
        <link rel="apple-touch-startup-image" href="/images/splash/splash-1125x2436.png" media="(device-width: 375px) and (-webkit-device-pixel-ratio: 3)">
        <link rel="apple-touch-startup-image" href="/images/splash/splash-1242x2208.png" media="(device-width: 414px)">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
