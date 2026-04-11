<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sinemaku Pictures')</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap"
    rel="stylesheet">


  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Iconify for all Lucide icons --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Meta Theme --}}
  <meta name="theme-color" content="#0a0a0a">

  @stack('head')

  <style>
    /* Global Cinematic Style: Noise Grain on images */
    img,
    .hero-bg,
    .serial-bleed-img,
    [style*="background-image"] {
      filter: saturate(0.85) url(#cinematic-grain);
      transition: filter 0.3s ease;
    }

    /* Hover states: consistent filter application */
    a:hover img,
    .section-feature:hover .feature-img,
    .serial-bleed-img:hover {
      filter: saturate(0.90) url(#cinematic-grain);
    }
  </style>
</head>

<body class="bg-[#0a0a0a] text-white antialiased">
  <!-- SVG Filter for Cinematic Grain -->
  <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" xmlns="http://www.w3.org/2000/svg">
    <filter id="cinematic-grain">
      <feTurbulence type="fractalNoise" baseFrequency="0.55" numOctaves="4" stitchTiles="stitch" result="noise" />
      <feColorMatrix in="noise" type="saturate" values="0" result="monoNoise" />
      <feComponentTransfer in="monoNoise" result="subtleNoise">
        <feFuncA type="linear" slope="0.07" />
      </feComponentTransfer>
      <feBlend in="SourceGraphic" in2="subtleNoise" mode="screen" />
    </filter>
  </svg>

  @yield('content')

  {{-- GSAP JS --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  @stack('scripts')
</body>

</html>