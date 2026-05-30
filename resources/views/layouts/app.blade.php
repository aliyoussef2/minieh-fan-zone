<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minieh Fan Zone 2026')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Sans:wght@400;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    @stack('styles')
    @yield('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@yield('content')
@stack('scripts')
</body>
</html>