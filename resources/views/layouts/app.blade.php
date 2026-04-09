<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sinemaku Pictures')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">


    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- Iconify for all Lucide icons --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    {{-- Meta Theme --}}
    <meta name="theme-color" content="#0a0a0a">

    @stack('head')
</head>
<body class="bg-[#0a0a0a] text-white antialiased">
    @yield('content')
    
    {{-- GSAP JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    @stack('scripts')
</body>
</html>
