@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ============================================================
    HERO SLIDESHOW SECTION — Film Strip Model
    ============================================================ --}}
<section id="film-hero" class="relative w-full overflow-hidden bg-[#0a0a0a]" style="height: 100dvh; min-height: 560px;">

    {{-- ── Film Strip: all images side by side in a single wide row ── --}}
    @php $totalFilm = count($film); @endphp
    <div id="hero-strip"
         style="position: absolute; inset: 0; display: flex; width: {{ $totalFilm * 100 }}%; height: 100%; transform: translateX(0); will-change: transform;">
        @foreach($film as $i => $item)
            <div class="hero-slide-img"
                 style="position: relative; width: {{ 100 / $totalFilm }}%; height: 100%; flex-shrink: 0; background-image: url('{{ asset('photo/' . $item->photo) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                {{-- Dark overlay --}}
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.30);"></div>
            </div>
        @endforeach
    </div>

    {{-- ── Gradient overlay for text legibility ── --}}
    <div class="absolute inset-0 z-[1] pointer-events-none"
         style="background: linear-gradient(to top, rgba(0,0,0,0.80) 0%, transparent 55%);">
    </div>

    {{-- ── Slide Content (Titles & Meta): individually slide in/out with quint easing ── --}}
    <div class="hero-title-container absolute inset-0 z-[10] flex items-end pointer-events-none" style="padding: clamp(48px, 8vw, 120px) clamp(16px, 6vw, 84px);">
        <div style="position: relative; width: 100%; max-width: 1600px; margin: 0 auto; height: 100%;">
            @foreach($film as $i => $item)
                <div class="hero-slide-content text-left w-full"
                    style="position: absolute; left: 0; bottom: 0; transform: {{ $i === 0 ? 'translateX(0)' : 'translateX(100vw)' }}; pointer-events: {{ $i === 0 ? 'auto' : 'none' }};">
                    <h1 class="hero-film-title">
                        <a href="{{ route('detail-film', $item->slug) }}" class="no-underline text-inherit hover:opacity-80 transition-opacity">
                            {{ $item->title }}
                        </a>
                    </h1>
                    <div class="hero-film-meta">
                        <span>{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                        <span class="dot">•</span>
                        <span>{{ $item->genre }}</span>
                        <span class="dot">•</span>
                        <span>{{ $item->duration }} Min</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── Slide Indicators (Bottom Right: 1/2/3/4/5) ── --}}
    <div class="hero-indicators-container absolute z-[20] flex items-baseline font-display font-bold select-none">
        @foreach($film as $i => $item)
            <button class="slide-indicator {{ $i === 0 ? 'text-white' : 'text-white/40' }} hover:text-white"
                    style="border: none; background: transparent; cursor: pointer; padding: 0; line-height: 1.1; transition: color 0.4s ease;"
                    data-index="{{ $i }}">
                {{ $i + 1 }}
            </button>
            @if(!$loop->last)
                <span class="indicator-slash" style="color: rgba(255,255,255,0.4); line-height: 1.1; margin: 0 2px;">/</span>
            @endif
        @endforeach
    </div>

</section>

<style>
    /* ── Hero Slide Content ── */
    .hero-slide-content {
        will-change: transform;
    }
    .hero-film-title {
        font-family: var(--font-display);
        font-weight: 800; 
        line-height: 0.92; 
        margin: 0 0 0.2em;
        font-size: clamp(48px, 7.5vw, 110px);
        letter-spacing: -0.04em; 
        filter: drop-shadow(0 0 30px rgba(0,0,0,0.3));
        text-transform: uppercase;
        color: #fff;
    }
    .hero-film-meta {
        display: flex; gap: 16px; align-items: center;
        font-size: clamp(14px, 1.2vw, 18px); color: #ccc;
        text-transform: uppercase; letter-spacing: 0.12em; font-weight: 400;
        filter: drop-shadow(0 0 10px rgba(0,0,0,0.3));
    }
    .hero-film-meta .dot {
        font-size: 0.8em;
    }
    /* ── Indicators ── */
    .hero-indicators-container {
        bottom: 1.2rem;
        right: 1.5%;
        font-size: 1.5rem;
    }
    @media (min-width: 768px) {
        .hero-indicators-container {
            font-size: 1.875rem;
        }
    }
    @media (max-width: 767px) {
        .hero-film-title {
            font-size: clamp(36px, 12vw, 64px);
        }
        .hero-indicators-container {
            right: 4%;
            bottom: 2.5rem;
            font-size: 1.25rem;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .indicator-slash {
            display: none;
        }
    }
</style>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const totalSlides = {{ $totalFilm }};
        if (totalSlides === 0) return;

        const strip     = document.getElementById('hero-strip');
        const titles    = document.querySelectorAll('#film-hero .hero-slide-content');
        const indicators = document.querySelectorAll('#film-hero .slide-indicator');

        let current  = 0;
        let timer    = null;
        let busy     = false;

        // Each slide occupies 1/(totalSlides) of the strip width.
        // Strip translateX to show slide i: -(i / totalSlides * 100)%
        const expoEase  = 'cubic-bezier(0.19, 1, 0.22, 1)';
        const quintEase = 'cubic-bezier(0.23, 1, 0.32, 1)';

        function slideStripTo(index, direction) {
            const pct = -(index / totalSlides * 100);
            strip.style.transition = `transform 1.2s ${expoEase}`;
            strip.style.transform  = `translateX(${pct}%)`;
        }

        function slideTitle(fromIndex, toIndex, direction) {
            const prevTitle = titles[fromIndex];
            const nextTitle = titles[toIndex];

            // Outgoing title
            prevTitle.style.transition = `transform 1.2s ${quintEase}`;
            prevTitle.style.transform  = `translateX(${-100 * direction}vw)`;
            prevTitle.style.pointerEvents = 'none';

            // Position incoming title off-screen without transition
            nextTitle.style.transition = 'none';
            nextTitle.style.transform  = `translateX(${100 * direction}vw)`;

            // Force reflow
            nextTitle.getBoundingClientRect();

            // Slide incoming in
            requestAnimationFrame(function() {
                nextTitle.style.transition  = `transform 1.2s ${quintEase}`;
                nextTitle.style.transform   = 'translateX(0)';
                nextTitle.style.pointerEvents = 'auto';
            });
        }

        function goTo(index) {
            if (index === current || busy) return;
            busy = true;

            const direction = index > current ? 1 : -1;
            const prev      = current;
            current         = index;

            // Move the strip
            slideStripTo(current, direction);

            // Move the titles separately
            slideTitle(prev, current, direction);

            // Update indicators
            indicators.forEach(function(btn, i) {
                btn.classList.toggle('text-white',      i === current);
                btn.classList.toggle('text-white/40',   i !== current);
            });

            setTimeout(function() { busy = false; }, 1200);
        }

        function autoAdvance() {
            goTo((current + 1) % totalSlides);
        }

        function startTimer() {
            clearInterval(timer);
            timer = setInterval(autoAdvance, 6000);
        }

        // Indicator clicks
        indicators.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.dataset.index, 10);
                if (idx === current || busy) return;
                goTo(idx);
                startTimer();
            });
        });

        // Pause when tab hidden, resume when visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) clearInterval(timer);
            else startTimer();
        });

        startTimer();
    });
}());
</script>
<style>
  body {
    background-color: #ffffff !important;
    color: #111111 !important;
  }

  /* === Scroll Reveal Animations === */
  .reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity .9s cubic-bezier(.22, .61, .36, 1),
      transform .9s cubic-bezier(.22, .61, .36, 1),
      filter .9s cubic-bezier(.22, .61, .36, 1);
    will-change: opacity, transform, filter;
  }

  .reveal.is-inview {
    opacity: 1;
    transform: none;
    filter: none;
  }

  @media (prefers-reduced-motion: reduce) {
    .reveal {
      opacity: 1 !important;
      transform: none !important;
      filter: none !important;
    }
  }

  .title {
    margin: 0 0 36px;

    font-weight: 300;
    line-height: .95;
    color: #0d0d0d;
    /* ukuran fleksibel: kecil di mobile, besar di desktop */
    font-size: 25px;
    letter-spacing: -0.5px;
    margin-top: 100px;
    margin-left: 55px;
  }

  .feature-text {
    margin-top: 300px;
  }

  .feature-title {
    margin: 0 0 36px;

    font-weight: 300;
    line-height: .95;
    color: #0d0d0d;
    /* ukuran fleksibel: kecil di mobile, besar di desktop */
    font-size: clamp(40px, 6vw, 112px);
    letter-spacing: -0.5px;
  }

  .feature-media-frame2 {
    position: relative;
    background: #f1f1f1;
    border-radius: 0px;
    /* bingkai tipis seperti mockup */
    box-shadow:
      0 0 0 10px #fff inset,
      /* inner white mat */
      0 1px 0 0 #e5e5e5 inset;
    /* garis tipis abu-abu */
    padding: 10px;
    /* jarak ke gambar */
  }

  .feature-media-frame2::before {
    /* memberi proporsi landscape stabil mirip screenshot */
    content: "";
    display: block;
    aspect-ratio: 9/12;
  }

  .feature-media-frame2>img {
    position: absolute;
    inset: 10px;
    /* sejajar dengan padding container */
    width: calc(100% - 20px);
    height: calc(100% - 20px);
    object-fit: cover;
    /* penuh, seperti contoh */
    border-radius: 4px;
  }

  /* pastikan frame di atas “kertas” abu-abu */
  .feature-media-frame2 {
    position: relative;
    z-index: 1;
    transition: transform .45s cubic-bezier(.22, .61, .36, 1),
      box-shadow .45s cubic-bezier(.22, .61, .36, 1);
  }

  .feature-media-frame2>img {
    transition: transform .55s cubic-bezier(.22, .61, .36, 1);
    will-change: transform;
  }

  /* efek saat hover: frame sedikit terangkat + gambar zoom ringan,
    “kertas” abu-abu ikut bergeser untuk memberi rasa depth */
  .feature-media:hover .feature-media-frame2 {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0, 0, 0, .16), 0 6px 16px rgba(0, 0, 0, .08);
  }

  .feature-media:hover .feature-media-frame2>img {
    transform: scale(1.035);
  }

  .feature-media:hover::before {
    transform: translate(16px, 16px);
    /* offset abu-abu sedikit bertambah */
  }


  /* ====== Responsive ====== */
  @media (max-width: 1200px) {
    .feature-wrap {
      grid-template-columns: 1fr;
      /* stack */
      gap: 32px;
    }

    .feature-title {
      margin-bottom: 24px;
    }

    .feature-media-frame2::before {
      aspect-ratio: 16/9;
    }
  }

  @media (max-width: 640px) {
    .feature-sidetext {
      padding: 28px 20px 52px;
    }

    .feature-cta .cta-label {
      font-size: 18px;
    }

    .feature-cta .cta-line {
      width: 64px;
    }
  }

  /* ===== All Films ===== */
  .allfilms {
    max-width: 1740px;
    margin: 140px auto 120px;
    padding: 0 clamp(12px, 3vw, 32px);
  }

  .allfilms-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
  }

  .allfilms-title {
    font: 700 clamp(24px, 4vw, 36px)/1.1 var(--font-display);
    letter-spacing: -0.02em;
    margin: 0;
    text-transform: uppercase;
  }

  .allfilms-filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 10px;
  }

  .chip {
    position: relative;
    border: none;
    background: transparent;
    color: #888;
    font: 300 14px/1;
    padding: 8px 14px;
    border-radius: 0;
    cursor: pointer;
    transition: all .2s ease;
  }

  .chip::after {
    content: '';
    position: absolute;
    bottom: 0px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 50%;
    height: 1.5px;
    background-color: #111;
    transition: transform 0.4s cubic-bezier(0.2, 0.7, 0.2, 1);
  }

  .chip.is-active::after {
    transform: translateX(-50%) scaleX(1);
  }

  .chip:hover {
    background: transparent;
    color: #111;
  }

  .chip.is-active {
    background: transparent;
    color: #111;
    border-color: transparent;
    font-weight: 700;
  }

  /* --- MASONRY GRID (CSS Columns) --- */
  .allfilms-grid {
    columns: 3;
    column-gap: clamp(32px, 4.5vw, 64px);
    margin-top: 24px;
  }

  @media (max-width: 1200px) {
    .allfilms-grid {
      columns: 3;
    }
  }



    .allfilms-grid {
      columns: 2;
    }
  }

  @media (max-width: 520px) {
    .allfilms-grid {
      columns: 1;
    }
  }

  /* Card */
  .filmitem {
    break-inside: avoid;
    margin-bottom: clamp(72px, 8vw, 120px);
    display: block;
  }

  .filmitem-link {
    text-decoration: none;
    color: inherit;
    display: block;
  }

  .filmitem-media {
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: 0;
    background: #111;
    transition: transform .35s cubic-bezier(.2, .7, .2, 1);
  }

  .filmitem-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transform: scale(1.02);
    transition: transform .6s cubic-bezier(.18, .72, .18, 1);
  }

  .filmitem-link:hover .filmitem-media {
    transform: translateY(-4px);
    box-shadow: 0 28px 50px rgba(0, 0, 0, .12);
  }

  .filmitem-link:hover .filmitem-media img {
    transform: scale(1.06);
  }

  /* Optional overlay info */
  .filmitem-media.has-overlay .film-badge {
    position: absolute;
    left: 12px;
    top: 12px;
    background: rgba(17, 17, 17, .82);
    color: #fff;
    font: 600 12px/1;
    letter-spacing: .05em;
    padding: 7px 10px;
    border-radius: 8px;
  }

  .filmitem-media.has-overlay .film-rate {
    position: absolute;
    right: 12px;
    top: 12px;
    background: #fff;
    color: #111;
    font: 700 12px/1;
    padding: 7px 10px;
    border-radius: 8px;
  }

  .filmitem-media.has-overlay .film-play {
    position: absolute;
    left: 14px;
    bottom: 14px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: rgba(255, 255, 255, .92);
    color: #111;
    font-weight: 700;
    transition: transform .2s ease;
  }

  .filmitem-link:hover .film-play {
    transform: scale(1.07);
  }

  .filmitem-media.has-overlay .film-dir {
    position: absolute;
    right: 12px;
    bottom: 12px;
    color: #fff;
    font: 500 12px/1.2;
    text-shadow: 0 1px 5px rgba(0, 0, 0, .45);
  }

  /* Caption */
  .filmitem-caption {
    margin-top: 20px;
    margin-bottom: 0;
    padding: 0;
  }

  .filmitem-title {
    margin: 0;
    font: 800 clamp(24px, 2.2vw, 34px)/1.1 var(--font-display) !important;
    font-weight: 800 !important;
    color: #111;
    letter-spacing: -0.02em;
    text-transform: capitalize;
  }

  .filmitem-year {
    color: #888;
    font: 300 14px/1;
    letter-spacing: 0.04em;
    margin-bottom: 4px;
  }

  /* Hide when filtered */
  .filmitem.is-hidden {
    display: none;
  }

  /* ===== Overlay detail pada hover ===== */
  .filmitem-media.has-overlay {
    position: relative;
  }

  /* Lapisan gradasi + wadah teks */
  .film-detail {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 6px;
    padding: 16px;
    /* gradasi dari bawah ke atas supaya teks terbaca */
    background: linear-gradient(to top,
        rgba(0, 0, 0, .78) 12%,
        rgba(0, 0, 0, .35) 46%,
        rgba(0, 0, 0, .08) 70%,
        rgba(0, 0, 0, 0) 100%);
    /* start state: sedikit turun + transparan */
    opacity: 0;
    transform: translateY(10px);
    transition:
      opacity .36s cubic-bezier(.2, .7, .2, 1),
      transform .36s cubic-bezier(.2, .7, .2, 1);
    pointer-events: none;
    /* biar klik tetap tembus ke link */
  }

  /* baris teks di dalam overlay */
  .film-detail-row {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 8px 10px;
    align-items: baseline;
  }

  .film-detail-label {
    color: rgba(255, 255, 255, .78);
    font: 300 11px/1;
    letter-spacing: .08em;
    text-transform: uppercase;
  }

  .film-detail-value {
    color: #fff;
    font: 300 14px/1.25;
  }

  /* Tampilkan saat hover (desktop/hover devices) */
  @media (hover: hover) and (pointer: fine) {
    .filmitem-link:hover .film-detail {
      opacity: 1;
      transform: translateY(0);
    }

    /* kalau ada badge & rating, ikut halus juga */
    .filmitem-link .film-badge,
    .filmitem-link .film-rate {
      transform: translateY(-6px);
      opacity: 0;
      transition: opacity .25s ease, transform .25s ease;
    }

    .filmitem-link:hover .film-badge,
    .filmitem-link:hover .film-rate {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @media (hover: none) {

    /* Mobile/touch: HIDE overlay completely */
    .film-detail {
      display: none !important;
    }
  }

  /* Sedikit responsif untuk density konten */
  @media (max-width: 520px) {
    .film-detail {
      padding: 14px;
      gap: 4px;
    }

    .film-detail-value {
      font-size: 13px;
    }

    .film-detail-label {
      font-size: 10px;
    }
  }

  /* ====================== A24-style overlay ====================== */
  /* 1) Kartu: full width cell, tanpa aspect-ratio tetap agar masonry jalan */
  .allfilms-grid .filmitem-media {
    width: 100% !important;
    height: auto !important;
    margin: 0;
    border-radius: 0;
    overflow: hidden;
    position: relative;
  }

  .allfilms-grid .filmitem-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transform: scale(1.02);
    transition: transform .6s cubic-bezier(.18, .72, .18, 1);
  }

  /* 2) Gradient gelap seluruh poster (muncul saat hover desktop) */
  .allfilms-grid .filmitem-media::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, .34);
    /* tingkat dasar */
    opacity: 0;
    /* default non-hover */
    transition: opacity .36s cubic-bezier(.2, .7, .2, 1);
    pointer-events: none;
    z-index: 0;
  }

  .allfilms-grid .filmitem-media::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top,
        rgba(0, 0, 0, .55) 0%,
        rgba(0, 0, 0, .22) 38%,
        rgba(0, 0, 0, .22) 62%,
        rgba(0, 0, 0, .72) 100%);
    opacity: 0;
    transition: opacity .36s cubic-bezier(.2, .7, .2, 1);
    pointer-events: none;
  }

  /* Saat hover: keduanya aktif → efek gelap merata + tebal di tepi */
  .allfilms-grid .filmitem:hover .filmitem-media::before {
    opacity: 1;
  }

  .allfilms-grid .filmitem:hover .filmitem-media::after {
    opacity: 1;
  }

  /* (Opsional) mobile: selalu sedikit gelap agar teks terbaca */
  @media (max-width: 768px) {
    .allfilms-grid .filmitem-media::before {
      opacity: .35;
    }

    .allfilms-grid .filmitem-media::after {
      opacity: .8;
    }
  }

  /* (Opsional) respect reduced motion */
  @media (prefers-reduced-motion: reduce) {

    .allfilms-grid .filmitem-media::before,
    .allfilms-grid .filmitem-media::after {
      transition: none;
    }
  }

  /* 3) Blok teks kiri-atas (bukan panel rounded) */
  .film-detail {
    position: absolute;
    top: clamp(24px, 14%, 84px);
    /* posisi vertikal ala A24 */
    left: clamp(16px, 2.6vw, 32px);
    right: auto;
    bottom: auto;
    max-width: min(72%, 540px);
    z-index: 2;

    /* tampilkan sebagai daftar blok, bukan grid 2 kolom */
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(10px, 1.6vw, 18px);

    padding: 0;
    /* tidak ada kotak/panel */
    background: none !important;
    border: 0 !important;
    border-radius: 0 !important;
    backdrop-filter: none !important;
    box-shadow: none !important;

    /* animasi muncul */
    opacity: 0;
    transform: translateY(8px);
    transition: opacity .36s cubic-bezier(.2, .7, .2, 1),
      transform .36s cubic-bezier(.2, .7, .2, 1);
    pointer-events: none;
    /* klik tetap ke link kartu */
  }

  @media (hover:hover) and (pointer:fine) {
    .filmitem-link:hover .film-detail {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @media (hover:none) {
    .film-detail {
      opacity: 1;
      transform: none;
    }
  }

  /* 4) Tipografi label & value ala A24 */
  .film-detail-row {
    display: block;
  }

  /* label di atas value */
  .film-detail-label {
    display: block;
    color: rgba(255, 255, 255, .68);
    font: 600 clamp(12px, .8vw, 12px)/1.15;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: clamp(4px, .5vw, 6px);
  }

  .film-detail-value {
    display: block;
    color: #fff;
    font: 500 clamp(14px, 1.25vw, 14px)/1.35;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .25);
    word-break: break-word;
    /* nama pemain panjang aman */
  }

  /* nilai pertama (tanggal rilis) sedikit lebih tebal */
  .film-detail .film-detail-row:nth-of-type(1) .film-detail-value {
    font-weight: 650;
  }

  /* 5) Badge & rating tetap smooth */
  @media (hover:hover) and (pointer:fine) {

    .filmitem-link .film-badge,
    .filmitem-link .film-rate {
      transform: translateY(-6px);
      opacity: 0;
      transition: opacity .25s ease, transform .25s ease;
    }

    .filmitem-link:hover .film-badge,
    .filmitem-link:hover .film-rate {
      transform: translateY(0);
      opacity: 1;
    }
  }

  /* 6) CSS columns / masonry configuration */
  .allfilms-grid {
    columns: 3;
  }

  @media (max-width:1200px) {
    .allfilms-grid {
      columns: 3;
    }
  }

  @media (max-width:800px) {
    .allfilms-grid {
      columns: 2;
    }
  }

  @media (max-width:520px) {
    .allfilms-grid {
      columns: 1;
    }
  }

  /* ---- tempatkan overlay di atas gambar, di bawah teks ---- */
  .allfilms-grid .filmitem-media {
    position: relative;
    isolation: isolate;
    /* bikin stacking context sendiri */
  }

  /* Layer gelap merata */
  .allfilms-grid .filmitem-media::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, .35);
    /* dasar */
    opacity: 0;
    /* desktop: muncul saat hover */
    z-index: 1;
    /* di atas IMG, di bawah teks */
    transition: opacity .36s cubic-bezier(.2, .7, .2, 1);
  }

  /* Gradient dari bawah ke atas */
  .allfilms-grid .filmitem-media::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top,
        rgba(0, 0, 0, .82) 18%,
        rgba(0, 0, 0, .40) 46%,
        rgba(0, 0, 0, .08) 70%,
        rgba(0, 0, 0, 0) 100%);
    opacity: 0;
    /* desktop: muncul saat hover */
    z-index: 1;
    transition: opacity .36s cubic-bezier(.2, .7, .2, 1);
    pointer-events: none;
  }

  /* Teks overlay tetap di atas overlay */
  .film-detail,
  .film-badge,
  .film-rate {
    z-index: 2;
  }

  /* Hover (device dengan hover) */
  @media (hover:hover) and (pointer:fine) {
    .filmitem-link:hover .filmitem-media::before {
      opacity: .45;
    }

    /* gelap merata */
    .filmitem-link:hover .filmitem-media::after {
      opacity: 1;
    }

    /* + gradient */
    /* opsional: tambah sedikit gelap dari gambar */
    .filmitem-link:hover .filmitem-media img {
      filter: brightness(.65) contrast(1.02);
    }
  }

  /* Perangkat sentuh: jangan tampilkan layer gelap */
  @media (hover:none) {

    .allfilms-grid .filmitem-media::before,
    .allfilms-grid .filmitem-media::after {
      opacity: 0 !important;
    }
  }

  .filmitem.is-hidden {
    display: none !important;
  }

  /* ===================== Mobile-only reveal for each film card (progressive enhancement) ===================== */
  @media (max-width: 680px) {

    /* default visible (no JS / no IO fallback) */
    .filmitem {
      opacity: 1;
      transform: none;
      filter: none;
    }

    /* only hidden if JS adds this class */
    .filmitem.reveal-mobile {
      opacity: 0;
      transform: translateY(16px);
      filter: blur(2px);
      transition: opacity .6s cubic-bezier(.22, .61, .36, 1),
        transform .6s cubic-bezier(.22, .61, .36, 1),
        filter .6s cubic-bezier(.22, .61, .36, 1);
      will-change: opacity, transform, filter;
    }

    .filmitem.reveal-mobile.is-inview {
      opacity: 1;
      transform: none;
      filter: none;
    }
  }

  /* Respect reduced motion: disable animation */
  @media (prefers-reduced-motion: reduce) {
    .filmitem.reveal-mobile {
      opacity: 1 !important;
      transform: none !important;
      filter: none !important;
    }
  }

  /* ===================== Mobile-first responsive refinements (Films) ===================== */
  @media (max-width: 680px) {

    /* Page title spacing */
    .title {
      margin-left: 16px;
      margin-top: 72px;
      margin-bottom: 2px;
      font-size: 20px;
    }

    /* Spotlight (COMING SOON) – tighter & stacked */
    .feature-sidetext {
      padding: 12px 14px 18px;
    }

    .feature-wrap {
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .feature-text {
      margin-top: 0;
    }

    .feature-title {
      font-size: clamp(24px, 7.2vw, 32px);
      margin: 0 0 6px;
      line-height: 1.05;
    }

    /* tighter CTA + year next to title on small screens */
    .feature-title .feature-eyebrow {
      margin-left: 8px;
      font-size: 14px;
      position: relative;
      top: -2px;
    }

    .feature-cta {
      margin-top: 6px;
    }

    .feature-cta .cta-line {
      width: 44px;
    }

    .feature-media-frame2 {
      padding: 4px;
      border-radius: 8px;
    }

    .feature-media-frame2::before {
      aspect-ratio: 16/9;
    }

    /* Section container & header */
    .allfilms {
      padding: 0 16px;
      margin: 100px auto 40px;
    }

    .allfilms-head {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 8px;
    }



    /* Chips: horizontal scroll on small screens */
    .allfilms-filters {
      width: 100%;
      gap: 8px;
      padding-top: 4px;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      white-space: nowrap;
    }

    .allfilms-filters::-webkit-scrollbar {
      display: none;
    }

    .chip {
      font-size: 12px;
      padding: 7px 10px;
      flex: 0 0 auto;
      /* keep width tight for scroll */
      border-radius: 0;
    }

    /* Masonry columns: 1 on mobile devices */
    .allfilms-grid {
      columns: 1;
      column-gap: 12px;
      margin-top: 10px;
    }

    /* Card media & caption */
    .filmitem-caption {
      margin-top: 8px;
    }

    .filmitem-title {
      font: 600 13px/1.3;

    }

    .filmitem-year {
      font-size: 10.5px;
    }

    /* Overlay on mobile: hidden for cleaner cards */
    .film-detail {
      display: none !important;
    }

    .allfilms-grid .filmitem-media::before,
    .allfilms-grid .filmitem-media::after {
      opacity: 0 !important;
    }
  }

  /* Extra-small tweaks */
  @media (max-width: 360px) {
    .chip {
      padding: 6px 9px;
      font-size: 11px;
    }

    .filmitem-title {
      font-size: 12.5px;
    }
  }

  .reveal-m,
  .reveal-y,
  .reveal-x {
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
  }

  /* ===================== Tablet/iPad tightening (reduce whitespace) ===================== */
  @media (min-width: 768px) and (max-width: 1180px) {

    /* Section heading */
    .title {
      margin-left: 24px;
      margin-top: 72px;
      margin-bottom: 4px;
      font-size: 22px;
    }

    /* Spotlight (COMING SOON) */
    .feature-sidetext {
      padding: 20px 24px 28px;
    }

    .feature-wrap {
      grid-template-columns: 1fr 1.1fr;
      /* dua kolom rapat */
      gap: 22px;
      align-items: center;
    }

    .feature-text {
      margin-top: 0;
    }

    .feature-title {
      font-size: clamp(32px, 4.6vw, 56px);
      line-height: 1.05;
      margin: 0 0 8px;
    }

    .feature-cta {
      margin-top: 8px;
    }

    .feature-media-frame2 {
      padding: 6px;
      border-radius: 8px;
    }

    .feature-media-frame2::before {
      aspect-ratio: 16/10;
    }

    /* All Films list */
    .allfilms {
      padding: 0 24px;
      margin: 120px auto 48px;
    }

    .allfilms-head {
      margin-bottom: 6px;
    }

    .allfilms-grid {
      columns: 3;
      column-gap: 16px;
      margin-top: 10px;
    }

    .filmitem-caption {
      margin-top: 8px;
    }
  }
</style>
{{-- ================== SECTION ALL FILMS ================== --}}
<section class="allfilms reveal">
  <div class="allfilms-head">
    <h2 class="allfilms-title">Our Films</h2>

    <div class="allfilms-filters" role="tablist" aria-label="Filter films by genre">
      <button class="chip is-active" data-filter="all" role="tab" aria-selected="true">All</button>
      {{-- @foreach ($genre as $item)
      <button class="chip" data-filter="{{ strtolower(trim($item->genre)) }}" role="tab">{{ $item->genre }}</button>
      @endforeach --}}
      @foreach ($chipGenres as $g)
        <button class="chip" data-filter="{{ $g }}">{{ ucwords($g) }}</button>
      @endforeach
    </div>
  </div>

  <div class="allfilms-grid">
    @php
      $ratios = ['2/3', '16/10', '3/4', '1/1', '4/5'];
    @endphp
    @foreach ($genre as $item)
      <article class="filmitem" data-genres='@json($item->genres_array)'>
        {{-- <article class="filmitem" data-genre="{{ strtolower($item->genre) }}"> --}}
          <a href="{{ route('detail-film', $item->slug) }}" class="filmitem-link">
            <figure class="filmitem-media has-overlay" style="aspect-ratio: {{ $ratios[$loop->index % 5] }}">
              <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->title }}" loading="lazy">

              <!-- badge/rate opsional (boleh dihapus kalau tidak dipakai) -->
              <span class="film-badge">{{ $item->genre }}</span>

              <!-- DETAIL OVERLAY (baru) -->
              <div class="film-detail">
                <div class="film-detail-row">
                  <span class="film-detail-label">RELEASE DATE</span>
                  <span class="film-detail-value">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                </div>
                <div class="film-detail-row">
                  <span class="film-detail-label">WRITTEN & DIRECTED BY</span>
                  <span class="film-detail-value">{{ $item->director }}</span>
                </div>
                <div class="film-detail-row">
                  <span class="film-detail-label">STARRING</span>
                  <span class="film-detail-value">{{ $item->cast }}</span>
                </div>
              </div>
            </figure>

            <div class="filmitem-caption">
              <div class="filmitem-year">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</div>
              <h2 class="filmitem-title">{{ $item->title }}</h2>
            </div>
          </a>
        </article>
    @endforeach

      <!-- Tambah film lain di sini, set data-genre sesuai: drama | thriller | sci-fi | romance -->
  </div>
</section>

<script>
  (function () {
    const scope = document.querySelector('.allfilms') || document;
    const chips = scope.querySelectorAll('.chip');
    const cards = scope.querySelectorAll('.filmitem');

    function setActive(btn) {
      chips.forEach(c => {
        const on = c === btn;
        c.classList.toggle('is-active', on);
        c.setAttribute('aria-selected', on ? 'true' : 'false');
      });
    }

    function applyFilter(key) {
      cards.forEach(card => {
        // BACA ARRAY GENRE dari data-genres='["drama","thriller",...]'
        let genres = [];
        try { genres = JSON.parse(card.dataset.genres || '[]'); } catch (e) { }
        const match = (key === 'all') ? true : genres.includes(key);
        card.classList.toggle('is-hidden', !match);
      });
    }

    chips.forEach(btn => {
      btn.addEventListener('click', () => {
        const key = (btn.dataset.filter || '').toLowerCase();
        setActive(btn);
        applyFilter(key);
      });
      // akses keyboard
      btn.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
      });
    });

    // initial state
    const first = scope.querySelector('.chip.is-active') || chips[0];
    if (first) {
      setActive(first);
      applyFilter((first.dataset.filter || '').toLowerCase());
    }
  })();
  // === Scroll Reveal Observer ===
  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-inview');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: .18 });
  revealEls.forEach(el => io.observe(el));
  // === Mobile-only reveal for each film card (progressive enhancement) ===
  (function () {
    // Require IntersectionObserver support
    if (!('IntersectionObserver' in window)) return;

    const mq = window.matchMedia('(max-width: 680px)');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let ioCards = null;

    function init() {
      if (!mq.matches || reduceMotion.matches) return cleanup();

      const cards = document.querySelectorAll('.allfilms-grid .filmitem');
      if (!cards.length) return;

      // Add reveal class only on mobile
      cards.forEach(el => el.classList.add('reveal-mobile'));

      ioCards = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-inview');
            ioCards.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.01,
        root: null,
        rootMargin: '0px 0px -10% 0px'
      });

      cards.forEach(el => ioCards.observe(el));
    }

    function cleanup() {
      if (ioCards) { ioCards.disconnect(); ioCards = null; }
      document.querySelectorAll('.filmitem.reveal-mobile').forEach(el => {
        el.classList.remove('reveal-mobile', 'is-inview');
      });
    }

    // Init on load (mobile only)
    init();

    // Re-run when breakpoint changes (e.g., rotate device / resize devtools)
    if (mq.addEventListener) {
      mq.addEventListener('change', () => { cleanup(); init(); });
    } else if (mq.addListener) { // Safari fallback
      mq.addListener(() => { cleanup(); init(); });
    }
  })();
</script>

@include('components.footer')
@endsection