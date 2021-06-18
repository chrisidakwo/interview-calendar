<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('fonts/Gilroy Web/stylesheet.css') }}">

    <style>
        html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0;font-family:Gilroy,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}a{background-color:transparent}[hidden]{display:none}html{line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}h1{font-size:32px;font-weight:700;letter-spacing:-.022em;line-height:1.25;margin:0}ol,ul{list-style:none;margin:0;padding:0}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.flex{display:flex}.inline-flex{display:inline-flex}.flex-auto{flex:1 1 auto}.flex-col{flex-direction:column}.items-center{align-items:center}.justify-center{justify-content:center}.h-screen{height:100vh}.px-2{padding-left:.5rem;padding-right:.5rem}.mb-3{margin-bottom:.75rem}.text-teal-600{color:#0d9488}.font-medium{font-weight:500}.hover\:underline:hover{text-decoration:underline}
    </style>

    <script defer src="{{ asset('js/alpine.min.js') }}"></script>
</head>
<body class="antialiased">
<div class="flex flex-auto flex-col h-screen items-center justify-center">
    <div class="mb-3">
        <h1>{{ config('app.name') }}</h1>
    </div>

    <div class="routes">
        <ul class="inline-flex">
            <li>
                <a class="text-teal-600 px-2 hover:underline font-medium" href="{{ route('dashboard', ['type' => 'interviewer']) }}">Interviewer Dashboard</a>
                <a class="text-teal-600 px-2 hover:underline font-medium" href="{{ route('dashboard', ['type' => 'candidate']) }}">Candidate Dashboard</a>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
