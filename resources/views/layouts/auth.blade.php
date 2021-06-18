<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Home') | {{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('fonts/Gilroy Web/stylesheet.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">

        <div class="relative h-screen w-full flex flex-col flex-auto justify-center items-center">
            <div class="w-96">
                @yield('content')
            </div>
        </div>
    </body>
</html>
