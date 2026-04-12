@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

@section('content')
<style>
  /* ===== Global Editorial Variables ===== */
  :root {
    --side-pad: clamp(16px, 6vw, 84px);
    --sec-pad: clamp(48px, 8vw, 120px);
    --border-color: #e8e8e8;
  }

  /* ===== Youtube Modal & Play Button ===== */
  .play-btn-huge {
    position: absolute;
    top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 100px; height: 100px; border-radius: 50%;
    background: rgba(255,255,255,0.1); backdrop-filter: blur(8px);
    border: 2px solid rgba(255,255,255,0.4);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.3s ease; z-index: 10;
  }
  .play-btn-huge:hover {
    background: rgba(255,255,255,0.25); transform: translate(-50%, -50%) scale(1.05);
    border-color: #fff;
  }
  .play-btn-huge svg { width: 40px; height: 40px; fill: #fff; margin-left: 6px; }

  .yt-modal {
    position: fixed; inset: 0; z-index: 99999;
    background: rgba(0,0,0,0.95);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity 0.4s ease;
  }
  .yt-modal.is-open { opacity: 1; pointer-events: auto; }
  .yt-modal-close {
    position: absolute; top: 30px; right: 40px;
    background: none; border: none; color: #fff;
    font-size: 50px; font-weight: 300; cursor: pointer; line-height: 1;
    z-index: 10000; transition: transform 0.2s;
  }
  .yt-modal-close:hover { transform: scale(1.1); }
  .yt-modal-content {
    width: 90%; max-width: 1200px; aspect-ratio: 16/9;
    background: #000; position: relative;
    box-shadow: none; border-radius: 0; overflow: hidden;
  }
  .yt-modal-content iframe { width: 100%; height: 100%; border: none; }

  /* ===== FILM DETAIL: HERO ===== */
  .film-hero {
    margin-top: 85px; position: relative; min-height: 100vh;
    color: #fff; overflow: hidden; display: flex; align-items: flex-end;
  }
  .film-hero__bg-wrap { position: absolute; inset: 0; z-index: 0; }
  .film-hero__bg {
    width: 100%; height: 100%; object-fit: cover;
    transform: scale(1.0); transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
  .film-hero:hover .film-hero__bg { transform: scale(1.04); }
  
  .film-hero__overlay {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(0deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 40%, rgba(0,0,0,0) 100%);
  }

  .film-hero__inner {
    position: relative; z-index: 2; width: 100%;
    padding: var(--sec-pad) var(--side-pad);
    max-width: 1600px;
  }

  .film-hero__title {
    font-weight: 800; line-height: 0.92; margin: 0 0 0.2em;
    font-size: clamp(48px, 7.5vw, 110px);
    letter-spacing: -0.04em; filter: drop-shadow(0 0 30px rgba(0,0,0,0.3));
  }

  .film-hero__meta {
    display: flex; gap: 16px; align-items: center;
    font-size: clamp(14px, 1.2vw, 18px); color: #ccc;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: 400;
  }

  .film-hero__actions { margin-top: 40px; }

  /* Trailer Button */
  .btn-trailer {
    display: inline-flex; align-items: center; gap: 14px;
    padding: 18px 32px; background: #fff; color: #111;
    border-radius: 0; text-decoration: none; font-weight: 700;
    font-size: 13px; letter-spacing: 0.1em; text-transform: uppercase;
    transition: all 0.3s ease; box-shadow: none;
    cursor: pointer; border: none;
  }
  .btn-trailer:hover { transform: translateY(-3px); background: #f0f0f0; }
  .btn-trailer svg { width: 18px; height: 18px; fill: currentColor; }


  /* ===== DETAIL STRIP ===== */
  .detail-strip {
    background: #fff; padding: 64px var(--side-pad);
    border-bottom: 1px solid var(--border-color);
  }
  .detail-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;
  }
  .detail-item { border-left: 1px solid var(--border-color); padding-left: 32px; }
  .detail-item:first-child { border-left: none; padding-left: 0; }
  
  .detail-label {
    font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase;
    color: #888; font-weight: 600; margin-bottom: 12px; display: block;
  }
  .detail-value {
    font-size: clamp(20px, 2.4vw, 36px); font-weight: 800; color: #111;
    line-height: 1.1; display: block;
  }
  .detail-value--small { font-size: clamp(16px, 1.4vw, 22px); color: #444; margin-top: 4px; }


  /* ===== SYNOPSIS SECTION ===== */
  .synopsis-sec {
    padding: var(--sec-pad) var(--side-pad); background: #fff;
    display: grid; grid-template-columns: 1fr 2fr; gap: clamp(40px, 8vw, 120px);
  }
  .syn-poster img {
    width: 100%; border-radius: 0; box-shadow: none;
    aspect-ratio: 2/3; object-fit: cover;
  }
  .syn-content { max-width: 800px; }
  .syn-label {
    font-size: 10px; letter-spacing: 0.16em; text-transform: uppercase;
    color: #aaa; margin-bottom: 24px; display: block;
  }
  .syn-text {
    font-size: clamp(17px, 1.8vw, 22px); line-height: 1.8; color: #2c2c2c;
    font-weight: 300; letter-spacing: -0.01em;
  }
  .syn-text p { margin-bottom: 1.5em; }


  /* Edge-to-Edge Stills Slideshow */
  .sec-stills { padding: var(--sec-pad) 0 0; background: #fff; }
  .sec-stills .sec-label-wrap { padding: 0 var(--side-pad); margin-bottom: 40px; }
  .sec-label-wrap { display: flex; align-items: center; gap: 20px; }
  .sec-label-wrap span { font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: #888; white-space: nowrap; }
  .sec-label-wrap .line { height: 1px; flex: 1; background: var(--border-color); }
  
  .stills-slideshow {
    position: relative; width: 100%; overflow: hidden;
    background: #111;
  }
  .stills-track {
    display: flex;
    transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: transform;
  }
  .slide-item {
    flex: 0 0 100%; width: 100%;
    aspect-ratio: 16/9; overflow: hidden;
  }
  .slide-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
  
  .slide-nav {
    position: absolute; top: 0; bottom: 0; width: 80px;
    background: none; border: none; cursor: pointer; z-index: 10;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s;
  }
  .stills-slideshow:hover .slide-nav { opacity: 0.8; }
  .slide-nav:hover { opacity: 1 !important; transform: scale(1.1); }
  .slide-nav--prev { left: 0; }
  .slide-nav--next { right: 0; }
  .slide-nav svg { width: 24px; height: 32px; fill: #fff; }

  .slide-counter {
    position: absolute; bottom: 24px; left: 50%; transform: translateX(-50%);
    display: flex; gap: 8px; z-index: 10;
  }
  .slide-dot {
    width: 6px; height: 6px; background: rgba(255,255,255,0.4); border: none;
    cursor: pointer; transition: background 0.3s; padding: 0;
  }
  .slide-dot.is-active { background: #fff; }

  /* BTS Masonry Grid (3 Columns) */
  .sec-bts { padding: var(--sec-pad) var(--side-pad); background: #fff; }
  .bts-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
  }
  .g-item { position: relative; overflow: hidden; border-radius: 0; background: #f5f5f5; box-shadow: none; }
  .g-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.2,0.7,0.2,1); }
  .g-item:hover img { transform: scale(1.05); }
  .g-item--tall { grid-row: span 2; }


  /* ===== RECOMMENDATIONS ROW ===== */
  .recommendations { padding: var(--sec-pad) var(--side-pad); background: #fafafa; border-top: 1px solid var(--border-color); }
  .rec-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;
  }
  .rec-card { text-decoration: none; color: inherit; display: block; transition: transform 0.3s; }
  .rec-card:hover { transform: translateY(-8px); }
  .rec-img { aspect-ratio: 2/3; overflow: hidden; border-radius: 0; margin-bottom: 16px; background: #eee; box-shadow: none; }
  .rec-img img { width: 100%; height: 100%; object-fit: cover; }
  .rec-title { font-weight: 700; font-size: 16px; margin: 0 0 4px; color: #111; letter-spacing: -0.02em; }
  .rec-meta { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.05em; }


  /* ===== RESPONSIVE ===== */
  @media (max-width: 1100px) {
    .detail-grid { grid-template-columns: repeat(2, 1fr); }
    .stills-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 200px; }
    .rec-grid { grid-template-columns: repeat(3, 1fr); }
  }
  @media (max-width: 850px) {
    .synopsis-sec { grid-template-columns: 1fr; }
    .syn-poster { max-width: 400px; }
    .bts-grid { grid-template-columns: repeat(2, 1fr); }
    .bts-grid > .g-item { grid-column: span 1 !important; }
  }
  @media (max-width: 640px) {
    .detail-grid { grid-template-columns: 1fr; gap: 30px; }
    .detail-item { padding-left: 0; border-left: none; border-bottom: 1px solid var(--border-color); padding-bottom: 24px; }
    .rec-grid { grid-template-columns: repeat(2, 1fr); }
    .film-hero__title { font-size: 56px; }
    .sec-gallery { padding-left: 16px; padding-right: 16px; }
  }
</style>
@php
  $video_id = '';
  if (!empty($films->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $films->link, $match)) {
      $video_id = $match[1];
  }
@endphp
<!-- ===== FILM DETAIL: HERO ===== -->
<section class="film-hero">
  <div class="film-hero__bg-wrap">
    <img src="{{ asset('photo/' . $films->photo) }}" alt="{{ $films->title }}" class="film-hero__bg">
  </div>
  <div class="film-hero__overlay"></div>

  @if($video_id)
    <!-- Big Play Button -->
    <div class="play-btn-huge" onclick="openTrailerModal()">
      <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
    </div>
  @endif

  <div class="film-hero__inner">
    <h1 class="film-hero__title">{{ $films->title }}</h1>

    <div class="film-hero__meta">
      <span>{{ \Carbon\Carbon::parse($films->release_date)->format('Y') }}</span>
      <span class="dot">•</span>
      <span>{{ $films->genre }}</span>
      <span class="dot">•</span>
      <span>{{ $films->duration }} Min</span>
    </div>
  </div>
</section>

<!-- ===== DETAIL STRIP ===== -->
<section class="detail-strip">
  <div class="detail-grid">
    <div class="detail-item">
      <span class="detail-label">DIRECTED BY</span>
      <span class="detail-value">{{ $films->director }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">YEAR</span>
      <span class="detail-value">{{ \Carbon\Carbon::parse($films->release_date)->format('Y') }}</span>
    </div>
    <div class="detail-item">
      <span class="detail-label">STARRING</span>
      @php
        $main_cast = array_slice(explode(',', $films->cast), 0, 3);
      @endphp
      <span class="detail-value">{{ implode(', ', $main_cast) }}</span>
      @if(count(explode(',', $films->cast)) > 3)
        <span class="detail-value--small">and others</span>
      @endif
    </div>
  </div>
</section>

<!-- ===== SYNOPSIS SECTION ===== -->
<section class="synopsis-sec">
  <div class="syn-poster">
    <img src="{{ asset('photo/' . $films->poster) }}" alt="{{ $films->title }} Poster">
  </div>
  <div class="syn-content">
    <span class="syn-label">Sinopsis</span>
    <div class="syn-text">
      {!! $films->sinopsis !!}
    </div>
  </div>
</section>

<!-- ===== STILL SHOTS GALLERY (SLIDESHOW) ===== -->
<section class="sec-stills">
  <div class="sec-stills__label sec-label-wrap">
    <span>Still Shots</span>
    <div class="line"></div>
  </div>
  
  <div class="stills-slideshow" id="stills-film">
    <div class="stills-track">
      @for($i=1; $i<=6; $i++)
      <div class="slide-item">
        <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}still{{ $i }}/1920/1080" alt="Still {{ $i }}" loading="lazy">
      </div>
      @endfor
    </div>
    <button class="slide-nav slide-nav--prev" onclick="slideMove('stills-film', -1)" aria-label="Previous">
      <svg viewBox="0 0 24 40"><path d="M20 4 L4 20 L20 36 Z" /></svg>
    </button>
    <button class="slide-nav slide-nav--next" onclick="slideMove('stills-film', 1)" aria-label="Next">
      <svg viewBox="0 0 24 40"><path d="M4 4 L20 20 L4 36 Z" /></svg>
    </button>
    <div class="slide-counter" id="stills-film-dots"></div>
  </div>
</section>

<!-- ===== BEHIND THE SCENES GALLERY (3 COLUMNS) ===== -->
<section class="sec-bts">
  <div class="sec-label-wrap">
    <span>Behind The Scenes</span>
    <div class="line"></div>
  </div>
  
  <div class="bts-grid">
    <div class="g-item">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts1/800/800" alt="BTS 1">
    </div>
    <div class="g-item g-item--tall">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts2/800/1200" alt="BTS 2">
    </div>
    <div class="g-item">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts3/800/600" alt="BTS 3">
    </div>
    <div class="g-item">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts4/800/600" alt="BTS 4">
    </div>
    <div class="g-item">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts5/800/800" alt="BTS 5">
    </div>
  </div>
</section>

<!-- ===== RECOMMENDATIONS ===== -->
<section class="recommendations">
  <div class="sec-label-wrap">
    <span>You Might Also Like</span>
    <div class="line"></div>
  </div>

  <div class="rec-grid">
    @foreach ($all_film->take(4) as $item)
      <a class="rec-card" href="{{ route('detail-film', $item->slug) }}">
        <div class="rec-img">
          <img src="{{ asset('photo/' . $item->poster) }}" alt="{{ $item->title }}" loading="lazy">
        </div>
        <h4 class="rec-title">{{ $item->title }}</h4>
        <div class="rec-meta">
          {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }} • {{ $item->genre }}
        </div>
      </a>
    @endforeach
  </div>
</section>

@if($video_id)
<div class="yt-modal" id="ytTrailerModal">
    <button class="yt-modal-close" onclick="closeTrailerModal()">&times;</button>
    <div class="yt-modal-content">
        <iframe id="ytTrailerIframe" src="" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<script>
    function openTrailerModal() {
        var modal = document.getElementById('ytTrailerModal');
        var iframe = document.getElementById('ytTrailerIframe');
        modal.classList.add('is-open');
        // Add autoplay parameter dynamically
        iframe.src = "https://www.youtube.com/embed/{{ $video_id }}?autoplay=1&rel=0&showinfo=0";
    }
    function closeTrailerModal() {
        var modal = document.getElementById('ytTrailerModal');
        var iframe = document.getElementById('ytTrailerIframe');
        modal.classList.remove('is-open');
        // Clear src to stop video
        iframe.src = "";
    }
    
    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape" && document.getElementById('ytTrailerModal').classList.contains('is-open')) {
            closeTrailerModal();
        }
    });
</script>
@endif
<script>
(function(){
  const isMobile = window.matchMedia('(max-width: 640px)').matches;
  if(!isMobile) return; // desktop/tablet: elements already visible

  // Mark that JS/IO is ready; only then mobile-hiding CSS kicks in
  document.documentElement.classList.add('io-ready');

  const els = Array.from(document.querySelectorAll('.reveal-m'));
  // If IO unsupported, reveal all to avoid hidden content
  if(!('IntersectionObserver' in window)){
    els.forEach(el => el.classList.add('revealed'));
    return;
  }

  // Stagger suggested items a bit for nicer flow
  const suggestItems = Array.from(document.querySelectorAll('.suggest-item.reveal-m'));
  suggestItems.forEach((el, i) => {
    el.style.transitionDelay = (i * 90) + 'ms';
  });

//   const io = new IntersectionObserver((entries) => {
//     entries.forEach((e) => {
//       if(e.isIntersecting){
//         e.target.classList.add('revealed');
//         io.unobserve(e.target);
//       }
//     });
//   }, { root: null, rootMargin: '0px 0px -6% 0px', threshold: 0.05 });

//   els.forEach(el => io.observe(el));
})();
</script>
@include('components.footer')
<script>
  var slideshows = {};
  function initSlideshow(id) {
    var el = document.getElementById(id);
    if (!el) return;
    var track = el.querySelector('.stills-track');
    var slides = el.querySelectorAll('.slide-item');
    var dotsWrap = document.getElementById(id + '-dots');
    slideshows[id] = { track: track, slides: slides, dotsWrap: dotsWrap, current: 0 };
    slides.forEach(function(_, i) {
      var dot = document.createElement('button');
      dot.className = 'slide-dot' + (i === 0 ? ' is-active' : '');
      dot.addEventListener('click', function() { goTo(id, i); });
      dotsWrap.appendChild(dot);
    });
  }
  function goTo(id, index) {
    var sw = slideshows[id];
    sw.current = ((index % sw.slides.length) + sw.slides.length) % sw.slides.length;
    sw.track.style.transform = 'translateX(-' + (sw.current * 100) + '%)';
    sw.dotsWrap.querySelectorAll('.slide-dot').forEach(function(d, i) {
      d.classList.toggle('is-active', i === sw.current);
    });
  }
  function slideMove(id, dir) { var sw = slideshows[id]; goTo(id, sw.current + dir); }
  document.addEventListener('DOMContentLoaded', function() { initSlideshow('stills-film'); });
</script>
@endsection