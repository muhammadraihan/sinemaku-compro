<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sinemaku Pictures')</title>

  {{-- Main CSS (Laravel) --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Tailwind CSS CDN & Config (Prestige Editorial Theme) --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              orange: '#FFB150',
              deepbreath: '#25225E',
            },
            shade: {
              1: '#DB5F10',
              2: '#0E1633',
              3: '#000000',
            },
            tint: {
              1: '#FFD8A8',
              2: '#CACAEF',
              3: '#F1F1F1',
            }
          },
          fontFamily: {
            serif: ['var(--brand-serif)', 'serif'],
            sans: ['Helvetica', 'Arial', 'sans-serif'],
          }
        }
      }
    }
  </script>

  @php
    /*
     * ========================================
     * SINEMAKU FONT TOGGLE — edit di sini
     * Pilih salah satu (hapus // di depannya):
     * ========================================
     */
    $brandSerif = "'Instrument Serif', serif";   // <== AKTIF: Instrument Serif
    // $brandSerif = "'Helvetica', 'Arial', sans-serif"; // <== aktifkan untuk Helvetica penuh
  @endphp

  <style>
    .font-serif,
    .font-serif * {
      font-family: {!! $brandSerif !!} !important;
    }
  </style>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

  {{-- Iconify --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Meta Theme (Menggunakan warna Tint 3) --}}
  <meta name="theme-color" content="#F1F1F1">

  @stack('head')

  <style>
    /* ── PENGATURAN DASAR GLOBAL ── */
    body {
      background-color: #F1F1F1;
      /* Tint 3 */
      color: #25225E;
      /* Deep Breath */
      margin: 0;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      cursor: none;
      /* Menyembunyikan kursor bawaan untuk semua halaman */
    }

    /* ── EFEK CINEMATIC GRAIN GLOBAL ── */
    .cinematic-grain {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 9999;
      opacity: 0.04;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
      mix-blend-mode: multiply;
    }

    /* ── INTERACTIVE GRADIENT BACKGROUND GLOBAL ── */
    #interactive-bg {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 0;
      background:
        radial-gradient(ellipse 70vw 70vh at var(--mx, 25%) var(--my, 55%),
          rgba(255, 177, 80, 0.2) 0%,
          transparent 70%),
        radial-gradient(ellipse 55vw 55vh at calc(100% - var(--mx, 25%)) calc(100% - var(--my, 55%)),
          rgba(37, 34, 94, 0.1) 0%,
          transparent 70%);
    }

    .light-leak {
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
      opacity: 0.08;
    }

    #leak-1 {
      background: radial-gradient(circle, #FFB150 0%, transparent 70%);
      animation: float-blob-1 18s ease-in-out infinite;
    }

    #leak-2 {
      background: radial-gradient(circle, #25225E 0%, transparent 70%);
      animation: float-blob-2 24s ease-in-out infinite;
    }

    @keyframes float-blob-1 {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      40% {
        transform: translate(4%, 3%) scale(1.06);
      }

      70% {
        transform: translate(-3%, 5%) scale(0.96);
      }
    }

    @keyframes float-blob-2 {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      35% {
        transform: translate(-5%, -2%) scale(1.04);
      }

      65% {
        transform: translate(3%, -4%) scale(0.98);
      }
    }

    /* ── CUSTOM CURSOR (EDITORIAL RING) GLOBAL ── */
    #cursor-ring {
      position: fixed;
      top: 0;
      left: 0;
      width: 30px;
      height: 30px;
      border: 1px solid #FFB150;
      border-radius: 50%;
      pointer-events: none;
      z-index: 999999;
      transform: translate(-50%, -50%);
      transition: width 0.3s, height 0.3s, background-color 0.3s;
      mix-blend-mode: multiply;
    }

    #cursor-dot {
      position: fixed;
      top: 0;
      left: 0;
      width: 8px;
      height: 8px;
      background-color: transparent;
      backdrop-filter: invert(1) grayscale(1) contrast(100);
      border-radius: 50%;
      pointer-events: none;
      z-index: 1000000;
      transform: translate(-50%, -50%);
    }

    /* ── UTILITAS EDITORIAL GLOBAL ── */
    .hairline-border {
      border-color: rgba(37, 34, 94, 0.15);
    }

    .vertical-text {
      writing-mode: vertical-rl;
      transform: rotate(180deg);
    }

    ::selection {
      background-color: #25225E;
      color: #F1F1F1;
    }

    /* ── SMOOTH ITALIC ANIMATION ── */
    .smooth-italic {
      display: inline-block;
      transform-origin: center;
      animation: unskewToNormal 0.4s forwards;
    }

    .smooth-italic:hover,
    .group:hover .group-smooth-italic {
      animation: skewToItalic 0.4s forwards;
    }

    .group-smooth-italic {
      display: inline-block;
      transform-origin: center;
      animation: unskewToNormal 0.4s forwards;
    }

    @keyframes skewToItalic {
      0% {
        transform: skewX(0deg) scale(1);
        font-style: normal;
      }

      49% {
        transform: skewX(-12deg) scale(1);
        font-style: normal;
      }

      50% {
        transform: skewX(0deg) scale(0.94);
        font-style: italic;
      }

      100% {
        transform: skewX(0deg) scale(0.94);
        font-style: italic;
      }
    }

    @keyframes unskewToNormal {
      0% {
        transform: skewX(0deg) scale(0.94);
        font-style: italic;
      }

      49% {
        transform: skewX(0deg) scale(0.94);
        font-style: italic;
      }

      50% {
        transform: skewX(-12deg) scale(1);
        font-style: normal;
      }

      100% {
        transform: skewX(0deg) scale(1);
        font-style: normal;
      }
    }

    /* ── CUSTOM SCROLLBAR ── */
    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-track {
      background: #F1F1F1;
    }

    ::-webkit-scrollbar-thumb {
      background: rgba(37, 34, 94, 0.2);
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgba(37, 34, 94, 0.5);
    }
  </style>
</head>

<body class="font-sans">

  <!-- Interactive Gradient Background Global -->
  <div id="interactive-bg"></div>

  <!-- Efek Grain & Light Leak Global -->
  <div class="cinematic-grain"></div>
  <div id="leak-1" class="light-leak w-[50vw] h-[50vw] top-[-10vw] left-[-10vw]"></div>
  <div id="leak-2" class="light-leak w-[40vw] h-[40vw] bottom-10 right-[-10vw]"></div>

  <!-- Custom Cursor Global -->
  <div id="cursor-ring"></div>
  <div id="cursor-dot"></div>

  {{-- KONTEN UTAMA DARI HALAMAN LAIN AKAN MASUK KE SINI --}}
  @yield('content')

  {{-- GSAP JS (Load Global) --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  {{-- SCRIPT KURSOR GLOBAL --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cursorRing = document.getElementById('cursor-ring');
      const cursorDot = document.getElementById('cursor-dot');

      let mouseX = window.innerWidth / 2;
      let mouseY = window.innerHeight / 2;
      let ringX = mouseX;
      let ringY = mouseY;
      let bgX = mouseX;
      let bgY = mouseY;

      // Dot mengikuti langsung
      document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        gsap.to(cursorDot, {
          x: mouseX,
          y: mouseY,
          duration: 0.1,
          ease: "none"
        });
      });

      // Animasi mengikuti dengan delay (Lerp)
      gsap.ticker.add(() => {
        // Ring
        ringX += (mouseX - ringX) * 0.15;
        ringY += (mouseY - ringY) * 0.15;
        gsap.set(cursorRing, { x: ringX, y: ringY });

        // Background gradient (lebih lambat/halus)
        bgX += (mouseX - bgX) * 0.05;
        bgY += (mouseY - bgY) * 0.05;
        document.body.style.setProperty('--mx', (bgX / window.innerWidth * 100) + '%');
        document.body.style.setProperty('--my', (bgY / window.innerHeight * 100) + '%');
      });

      // Re-bind hover logic function agar bisa dipanggil ulang jika ada konten dinamis (AJAX/Livewire)
      window.bindCursorHoverEffects = function () {
        const hoverTargets = document.querySelectorAll('.hover-target, a, button');
        hoverTargets.forEach(target => {
          // Hindari binding ganda
          if (target.dataset.cursorBound) return;
          target.dataset.cursorBound = "true";

          target.addEventListener('mouseenter', () => {
            gsap.to(cursorRing, { scale: 1.8, backgroundColor: 'rgba(255, 177, 80, 0.2)', duration: 0.3 });
            gsap.to(cursorDot, { scale: 0.5, duration: 0.2 });
          });
          target.addEventListener('mouseleave', () => {
            gsap.to(cursorRing, { scale: 1, backgroundColor: 'transparent', duration: 0.3 });
            gsap.to(cursorDot, { scale: 1, duration: 0.2 });
          });
        });
      };

      // Inisiasi awal
      bindCursorHoverEffects();
    });
  </script>

  {{-- Script spesifik halaman --}}
  @stack('scripts')
</body>

</html>