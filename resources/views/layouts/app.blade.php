<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sinemaku Pictures')</title>

    {{-- Google Fonts (sudah di index.css, di sini untuk preconnect agar lebih cepat) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Main CSS --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- <link href="{{ asset('css/index.css') }}" rel="stylesheet" /> --}}

    {{-- Iconify for all Lucide icons --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    {{-- jQuery (untuk semua animasi/interaksi di homepage) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Meta Theme --}}
    <meta name="theme-color" content="#000000">

    @stack('head')
</head>
<body class="bg-black text-white antialiased">
    @yield('content')
    @stack('scripts')
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
