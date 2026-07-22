<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sinemaku Pictures')</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

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
              orange: '#F36B21',
              navy: '#22397A',
            },
            tint: {
              orange: '#FFE4D9',
              navy: '#8E95B7',
            }
          },
          fontFamily: {
            serif: ['var(--font-serif)', 'serif'],
            sans: ['"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
            display: ['var(--font-display)', 'sans-serif'],
            peckham: ['PeckhamPress', 'sans-serif'],
            instrument: ['"Instrument Serif"', 'serif'],
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
    @font-face {
        font-family: 'Instrument Serif';
        src: url('{{ asset('fonts/instrument-serif/InstrumentSerif-Regular.ttf') }}') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Instrument Serif';
        src: url('{{ asset('fonts/instrument-serif/InstrumentSerif-Italic.ttf') }}') format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }

    .font-serif,
    .font-serif * {
      font-family: {!! $brandSerif !!} !important;
    }

    @font-face {
        font-family: 'PeckhamPress';
        src: url('{{ asset('fonts/PeckhamPress.otf') }}') format('opentype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
  </style>

  {{-- Iconify --}}
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Meta Theme (Menggunakan warna Tint 3) --}}
  <meta name="theme-color" content="#f6f6ed">

  @stack('head')

  <style>
    /* ── PENGATURAN DASAR GLOBAL ── */
    html {
      background-color: #f6f6ed;
      overflow-x: hidden;
    scroll-behavior:smooth;
    }
    #event-list{
    scroll-margin-top:120px;
    }


    body {
      background-color: transparent;
      color: #0f6ab0;
      margin: 0;
      position: relative;
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

    /* ── INTERACTIVE GRADIENT BACKGROUND GLOBAL (Synced with About Page) ── */
    #interactive-bg {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: -1;
      background: radial-gradient(
        circle 40vw at var(--mx, 25%) var(--my, 55%),
        #F36B21 0%,
        #F36B21 10%,
        transparent 80%
      );
      filter: blur(100px);
      opacity: 0.3;
    }


    /* ── CUSTOM CURSOR (EDITORIAL RING) GLOBAL ── */
    #cursor-ring {
      position: fixed;
      top: 0;
      left: 0;
      width: 30px;
      height: 30px;
      border: 1px solid #f46a21;
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

    @media (pointer: coarse) {
      #cursor-ring,
      #cursor-dot {
        display: none !important;
      }
      body {
        cursor: auto !important;
      }
    }

    /* ── UTILITY: BACKGROUND CREME WITH LEAKS ── */
    .bg-creme-leaks {
      position: relative;
      background-color: transparent;
      /* overflow: visible (default) — light leaks menembus batas section */
    }
    .bg-creme-leaks::before,
    .bg-creme-leaks::after {
      content: '';
      position: absolute;
      width: 70vw;
      height: 70vw;
      border-radius: 50%;
      pointer-events: none;
      filter: blur(120px);
      z-index: -1;
    }
    .bg-creme-leaks::before {
      top: -45vw;
      bottom: auto;
      left: -45vw;
      right: auto;
      background: radial-gradient(circle, #F36B21 0%, #F36B21 10%, transparent 50%);
      opacity: 0.55;
    }
    .bg-creme-leaks::after {
      top: auto;
      bottom: -45vw;
      left: auto;
      right: -45vw;
      background: radial-gradient(circle, #22397A 0%, #22397A 10%, transparent 50%);
      opacity: 0.55;
    }

    /* ── UTILITAS EDITORIAL GLOBAL ── */
    .hairline-border {
      border-color: rgba(15, 106, 176, 0.15);
    }

    .vertical-text {
      writing-mode: vertical-rl;
      transform: rotate(180deg);
    }

    ::selection {
      background-color: #0f6ab0;
      color: #f6f6ed;
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
      background: rgba(15, 106, 176, 0.2);
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgba(15, 106, 176, 0.5);
    }
  </style>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe.css"
/>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/lightgallery@2.8.1/css/lightgallery-bundle.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.8.3/css/lightgallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.8.3/css/lg-thumbnail.css">

</head>

<body class="font-sans">

  <!-- Interactive Gradient Background Global -->
  <div id="interactive-bg"></div>

  <!-- Efek Grain & Light Leak Global (Synced with About) -->
  <div class="cinematic-grain"></div>



  <!-- Custom Cursor Global -->
  <div id="cursor-ring"></div>
  <div id="cursor-dot"></div>

  <!-- ═══ CINEMATIC TRANSITION OVERLAYS (SPA) ═══ -->
  <!-- Zoom image clone lives here during transition -->
  <div id="film-zoom-overlay"
       style="position:fixed;inset:0;z-index:5000;pointer-events:none;overflow:hidden;">
  </div>
  <!-- Detail panel (injected by film-transition.js) -->
  <div id="film-detail-panel-container"
       style="position:fixed;inset:0;z-index:4999;overflow-y:auto;pointer-events:none;opacity:0;background:#f6f6ed;">
  </div>

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

      // Hide cursor on touch devices when touch is detected
      window.addEventListener('touchstart', function onFirstTouch() {
        if (cursorRing) cursorRing.style.display = 'none';
        if (cursorDot) cursorDot.style.display = 'none';
        document.body.style.cursor = 'auto';
        window.removeEventListener('touchstart', onFirstTouch);
      });

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

  {{-- ── Cinematic SPA Transition Engine ── --}}
  <script src="{{ asset('js/film-transition.js') }}" defer></script>

  {{-- Script spesifik halaman --}}
  @stack('scripts')

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
    duration: 1000,      // lama animasi
    once: true,          // hanya sekali muncul
    easing: 'ease-out',
});
</script>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
let typedStarted = false;

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {

        if (entry.isIntersecting && !typedStarted) {

            typedStarted = true;

            new Typed("#typing-text", {
                strings: [
                    "Tidak setiap langkah akan berakhir menjadi sebuah film.<br>Tidak setiap pertemuan akan melahirkan sebuah karya.<br>Namun setiap kesempatan untuk saling mendengarkan selalu layak untuk dimulai."
                ],
                typeSpeed: 35,
                showCursor: true,
                cursorChar: "|",
                contentType: "html"
            });

        }

    });
}, {
    threshold: 0.5
});

observer.observe(document.querySelector("#typing-text"));
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const quote = document.getElementById("typingQuote");
    const author = document.getElementById("quoteAuthor");

    const text = `"Setiap kesempatan yang diberikan
dengan tulus dapat melahirkan sebuah cerita."`;

    let i = 0;
    let started = false;

    function typeEffect() {
        if (i < text.length) {
            quote.innerHTML += text.charAt(i) === "\n" ? "<br>" : text.charAt(i);
            i++;
            setTimeout(typeEffect, 40);
        } else {
            author.classList.remove("opacity-0");
        }
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
                started = true;
                quote.classList.remove("opacity-0");
                typeEffect();
            }
        });
    }, {
        threshold: 0.4
    });

    observer.observe(quote);

});
</script>

<script src="https://cdn.jsdelivr.net/npm/photoswipe@5/dist/umd/photoswipe.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/photoswipe@5/dist/umd/photoswipe-lightbox.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.8.1/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.8.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.8.1/plugins/zoom/lg-zoom.min.js"></script>

</body>

</html>
