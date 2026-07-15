<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="description" content="@yield('meta_description')">
        <link rel="icon" href="{{ asset('storage/global/favicon.ico') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <main>
            @include('components.notification')
            <div class="grid items-center h-screen">
                @yield('content')
            </div>
        </main>
        @stack('after-scripts')
    </body>
</html>