<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sinemaku Pictures')</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">


  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Iconify for all Lucide icons --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Meta Theme --}}
  <meta name="theme-color" content="#26225e">

  @stack('head')

  <style>
    /* ── SINEMAKU BRAND COLOR TOKENS ─────────────────────
       Primary  : Indigo-Navy  #26225e (Pantone 2756 C)
       Secondary: Amber-Orange #ed9520 (Pantone 7549 C)
    ──────────────────────────────────────────────────── */
    :root {
      /* Navy scale */
      --navy-950: #0b0a1a;
      --navy-900: #120f2d;
      --navy-800: #1a1640;
      --navy-700: #221d55;
      --navy-600: #26225e;
      --navy-500: #332c80;
      --navy-400: #4a42aa;
      --navy-300: #7069c7;
      --navy-200: #a39de0;
      --navy-100: #d4d1f2;
      --navy-050: #eeedf9;
      /* Amber scale */
      --amber-900: #6b3d08;
      --amber-800: #9a5810;
      --amber-700: #c47214;
      --amber-600: #d9871a;
      --amber-500: #ed9520;
      --amber-400: #f2aa4a;
      --amber-300: #f6c276;
      --amber-200: #fada9e;
      --amber-100: #fdeece;
      /* Semantic */
      --color-border-subtle:  rgba(112,105,199,0.12);
      --color-border-mid:     rgba(112,105,199,0.22);
      --color-border-amber:   rgba(237,149,32,0.35);
    }

    /* Global Cinematic Style: Noise Grain on images */
    img,
    .hero-bg,
    .serial-bleed-img,
    [style*="background-image"] {
      filter: sepia(0.2) url(#cinematic-grain);
      transition: filter 0.3s ease;
    }

    a:hover img,
    .section-feature:hover .feature-img,
    .serial-bleed-img:hover {
      filter: sepia(0.1) url(#cinematic-grain);
    }
  </style>

</head>

<body class="text-white antialiased" style="background: #0b0a1a;">
  <!-- SVG Filter for Cinematic Grain -->
  <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" xmlns="http://www.w3.org/2000/svg">
    <filter id="cinematic-grain">
      <feTurbulence type="fractalNoise" baseFrequency="0.9" numOctaves="1" stitchTiles="stitch" result="noise" />
      <feColorMatrix in="noise" type="saturate" values="0.5" result="monoNoise" />
      <feComponentTransfer in="monoNoise" result="subtleNoise">
        <feFuncA type="linear" slope="0.05" />
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