<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Home') | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('fonts/Gilroy Web/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script defer src="{{ asset('js/alpine.min.js') }}"></script>
</head>
<body class="antialiased">

<div class="container">
    <div class="md:flex md:flex-col">
        <div class="md:h-screen md:flex md:flex-col">

            <div class="md:flex md:flex-shrink-0">
                <div class="bg-indigo-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
                    <a href="{{ route('home') }}" class="text-white font-bold">{{ config('app.name') }}</a>
                </div>
                <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </li>

                        @yield('breadcrumb-items')
                    </ul>

                    <div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="font-medium" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:flex md:flex-grow">
                @include('includes.menu')

                <div class="px-4 py-8 w-full" scroll-region>
                    @include('includes.flash-message')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
