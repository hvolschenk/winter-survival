<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link
            href="{{ asset('styles/app-compiled.css') }}"
            rel="stylesheet"
        />
    </head>
    <body class="bg-neutral-100 dark:bg-neutral-800 dark:text-neutral-50 h-screen text-neutral-800">
        {{ $slot }}
    </body>
</html>
