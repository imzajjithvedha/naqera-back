<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('storage/global/favicon.ico') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <main>
            @include('components.notification')
            @include('components.navbar')

            <div class="pt-19 min-[1100px]:pt-23 grid gap-2 relative">
                @include('components.sidebar')
                <div class="wrapper-fluid text-(--color-primary)">
                    <div class="min-[1100px]:ps-62.5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-4.0.0.slim.js" integrity="sha256-M+GjhMBfXikM1izMplICCTscIj5hzPCp6uDzaypxtgg=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                $('#sidebarToggle').on('click', function() {
                    $('#sidebar').toggleClass('hidden flex');
                })
            });
        </script>

        @stack('after-scripts')
    </body>
</html>
