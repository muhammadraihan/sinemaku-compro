<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sinemaku Pictures')</title>

  {{-- Brand fonts loaded as local @font-face in resources/css/app.css
       Body / Display : Helvetica (all pages)
       Special        : Instrument Serif Modified (About intro animation only) --}}


  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Iconify for all Lucide icons --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Meta Theme --}}
  <meta name="theme-color" content="#26225e">

  @stack('head')

  <style>
    /* ── SINEMAKU BRAND COLOR TOKENS (2026 Design Guidelines) ─────────
       Font : Helvetica for ALL text. Instrument Serif Modified used
              ONLY in the "Here Comes The Fun" intro on the About page.

       Color — Orange palette:
         CORE   #DB5F10  (R219 G95  B16)   ← guidelines orange core
         TINT   #FFB150  (R255 G177 B80)   ← guidelines orange tint
         LIGHT  #FFD8A8  (R255 G216 B168)  ← guidelines orange light

       Color — Deep Breath palette:
         CORE   #25225E  (R37  G34  B94)   ← guidelines navy core ✓
         SHADE  #0E1633  (R14  G22  B51)   ← guidelines navy shade
         TINT   #CACAEF  (R202 G202 B239)  ← guidelines navy tint
    ──────────────────────────────────────────────────────────────────── */
    :root {
      /* Navy / Deep Breath scale — per guidelines */
      --navy-950: #0b0a1a;
      --navy-900: #0e1633;   /* ★ Shade (guidelines exact) */
      --navy-800: #1a1640;
      --navy-700: #221d55;
      --navy-600: #25225e;   /* ★ Core (guidelines exact) */
      --navy-500: #332c80;
      --navy-400: #4a42aa;
      --navy-300: #7069c7;
      --navy-200: #a39de0;
      --navy-100: #cacaef;   /* ★ Tint (guidelines exact) */
      --navy-050: #eeedf9;
      /* Orange / Brand palette — per guidelines */
      --amber-900: #6b3d08;
      --amber-800: #9a5810;
      --amber-700: #c47214;
      --amber-600: #db5f10;  /* ★ Orange CORE (guidelines exact) */
      --amber-500: #ed9520;  /* web-safe bright variant (previously used) */
      --amber-400: #ffb150;  /* ★ Orange Tint (guidelines exact) */
      --amber-300: #f6c276;
      --amber-200: #ffd8a8;  /* ★ Orange Light (guidelines exact) */
      --amber-100: #fdeece;
      /* Semantic */
      --color-brand:         var(--navy-600);
      --color-accent:        var(--amber-600);  /* primary orange = CORE */
      --color-accent-hover:  var(--amber-400);  /* hover = Tint */
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