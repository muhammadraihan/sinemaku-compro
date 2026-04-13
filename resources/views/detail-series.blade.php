@extends('layouts.app')

@section('title', 'Series Details | Sinemaku Pictures')

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

  /* ===== SERIES DETAIL: HERO ===== */
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

  /* ===== DETAIL STRIP ===== */
  .detail-strip {
    background: #fff; padding: 64px var(--side-pad);
    border-bottom: 1px solid var(--border-color);
  }
  .detail-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px;
  }
  .detail-item { border-left: 1px solid var(--border-color); padding-left: 32px; }
  .detail-item:first-child { border-left: none; padding-left: 0; }
  
  .detail-label {
    font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase;
    color: #888; font-weight: 600; margin-bottom: 12px; display: block;
  }
  .detail-value {
    font-size: clamp(20px, 2.2vw, 32px); font-weight: 800; color: #111;
    line-height: 1.1; display: block;
  }
  .detail-value--small { font-size: clamp(14px, 1.2vw, 18px); color: #444; margin-top: 4px; }


  /* ===== SYNOPSIS & EPISODES ===== */
  .synopsis-sec {
    padding: var(--sec-pad) var(--side-pad); background: #fff;
    display: grid; grid-template-columns: 1fr 2fr; gap: clamp(40px, 8vw, 120px);
    align-items: start;
  }
  .syn-poster img {
    width: 100%; border-radius: 0; box-shadow: none;
    aspect-ratio: 2/3; object-fit: cover;
  }
  .syn-content { max-width: 800px; width: 100%; }
  .syn-label {
    font-size: 10px; letter-spacing: 0.16em; text-transform: uppercase;
    color: #aaa; margin-bottom: 24px; display: block;
  }
  .syn-text {
    font-size: clamp(17px, 1.8vw, 21px); line-height: 1.8; color: #2c2c2c;
    font-weight: 300; letter-spacing: -0.01em; margin-bottom: 80px;
  }

  /* Dedicated Episode List Section */
  .sec-episodes { padding: var(--sec-pad) var(--side-pad); background: #fff; }
  .ep-list-header {
    font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase;
    color: #888; margin-bottom: 60px; display: flex; align-items: center; gap: 20px;
  }
  .ep-list-header::after { content: ""; height: 1px; flex: 1; background: var(--border-color); }

  .ep-row {
    display: grid; grid-template-columns: 1.2fr 2fr; gap: clamp(30px, 5vw, 60px);
    margin-bottom: 80px; align-items: start;
  }
  .ep-image {
    width: 100%; aspect-ratio: 16/9; border-radius: 0; overflow: hidden;
    background: #f5f5f5; box-shadow: none;
  }
  .ep-image img { width: 100%; height: 100%; object-fit: cover; }

  .ep-details { max-width: 750px; }
  .ep-num { font-size: 11px; font-weight: 700; color: #888; letter-spacing: 0.12em; margin-bottom: 8px; text-transform: uppercase; }
  .ep-heading { font-size: clamp(24px, 2.5vw, 32px); font-weight: 800; color: #111; margin-bottom: 20px; letter-spacing: -0.02em; }
  .ep-desc {
    font-size: 16px; line-height: 1.7; color: #444; font-weight: 300;
    margin-bottom: 24px;
  }
  .ep-actions-row { display: flex; align-items: center; gap: 24px; }
  
  .ep-watch-link {
    color: #e51e25; text-decoration: none; font-weight: 800; font-size: 14px;
    letter-spacing: 0.02em; border-bottom: 2px solid transparent; transition: all 0.2s;
  }
  .ep-watch-link:hover { border-bottom-color: #e51e25; }

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

  .ep-item { margin-bottom: 48px; border-bottom: 1px solid #f2f2f2; padding-bottom: 48px; }
  .ep-item:last-child { border-bottom: none; }
  
  .ep-card { display: flex; gap: 32px; align-items: flex-start; }
  .ep-thumb {
    width: 240px; min-width: 240px; aspect-ratio: 16/9;
    border-radius: 8px; overflow: hidden; background: #eee;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative;
  }
  .ep-thumb img { width: 100%; height: 100%; object-fit: cover; }
  
  .ep-info { flex: 1; }
  .ep-meta { font-size: 11px; font-weight: 700; color: #888; letter-spacing: 0.1em; margin-bottom: 8px; }
  .ep-title { font-size: 24px; font-weight: 800; color: #111; margin-bottom: 14px; letter-spacing: -0.02em; }
  
  .ep-synopsis-wrap { position: relative; cursor: pointer; }
  .ep-synopsis {
    font-size: 15px; line-height: 1.7; color: #555; font-weight: 300;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
  }
  
  .ep-tooltip {
    visibility: hidden; opacity: 0; position: absolute; bottom: calc(100% + 12px); left: 0;
    width: 100%; max-width: 400px; background: #111; color: #fff; padding: 16px 20px;
    border-radius: 12px; font-size: 14px; line-height: 1.6; font-weight: 300;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3); transition: all 0.25s ease; z-index: 100;
    pointer-events: none;
  }
  .ep-synopsis-wrap:hover .ep-tooltip { visibility: visible; opacity: 1; transform: translateY(-5px); }

  .ep-actions { display: flex; gap: 12px; margin-top: 24px; }
  .btn-ep {
    display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; padding: 10px 20px; border-radius: 40px;
    text-decoration: none; transition: all 0.2s;
  }
  .btn-ep--trailer { background: #f5f5f5; color: #111; border: none; cursor: pointer; }
  .btn-ep--trailer:hover { background: #e8e8e8; }
  .btn-ep--watch { background: #111; color: #fff; }
  .btn-ep--watch:hover { opacity: 0.9; transform: translateY(-2px); }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }


  /* ===== GALLERY SECTIONS ===== */
  .sec-gallery { padding: var(--sec-pad) var(--side-pad); background: #fff; }
  .sec-label-wrap { display: flex; align-items: center; gap: 20px; margin-bottom: 40px; }
  .sec-label-wrap span { font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: #888; white-space: nowrap; }
  .sec-label-wrap .line { height: 1px; flex: 1; background: var(--border-color); }

  /* Edge-to-Edge Stills Slideshow */
  .sec-stills { padding: var(--sec-pad) 0 0; background: #fff; }
  .sec-stills .sec-label-wrap { padding: 0 var(--side-pad); margin-bottom: 40px; }
  
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

  /* BTS Masonry Row */
  .sec-bts { padding: var(--sec-pad) var(--side-pad); background: #fff; }
  .bts-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px;
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
  @media (max-width: 1200px) {
    .detail-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 980px) {
    .synopsis-sec { grid-template-columns: 1fr; }
    .syn-poster { max-width: 400px; }
  }
  @media (max-width: 850px) {
    .ep-card { flex-direction: column; }
    .ep-thumb { width: 100%; }
    .bts-grid { grid-template-columns: repeat(2, 1fr); }
    .bts-grid > .g-item { grid-column: span 1 !important; }
  }
  @media (max-width: 640px) {
    .detail-grid { grid-template-columns: 1fr; gap: 30px; }
    .detail-item { padding-left: 0; border-left: none; border-bottom: 1px solid var(--border-color); padding-bottom: 24px; }
    .rec-grid { grid-template-columns: repeat(2, 1fr); }
    .film-hero__title { font-size: 56px; }
  }
</style>

@php
  $video_id = '';
  if (!empty($films->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $films->link, $match)) {
      $video_id = $match[1];
  }
@endphp

<!-- ===== SERIES DETAIL: HERO ===== -->
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
      <span>{{ $films->season }} Season</span>
      <span class="dot">•</span>
      <span>{{ $films->episode }} Episode</span>
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
      <span class="detail-label">SEASON</span>
      <span class="detail-value">{{ $films->season }} Season</span>
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

<!-- ===== SYNOPSIS & EPISODES SECTION ===== -->
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
  <div class="sec-label-wrap">
    <span>Still Shots</span>
    <div class="line"></div>
  </div>
  
  <div class="stills-slideshow" id="stills-series">
    <div class="stills-track">
      @if($films->stillShots->count() > 0)
        @foreach($films->stillShots as $gallery)
        <div class="slide-item">
          <img src="{{ asset('photo/' . $gallery->photo) }}" alt="Still" loading="lazy">
        </div>
        @endforeach
      @else
        @for($i=1; $i<=3; $i++)
        <div class="slide-item">
          <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}still{{ $i }}/1920/1080" alt="Still {{ $i }}" loading="lazy">
        </div>
        @endfor
      @endif
    </div>
    <button class="slide-nav slide-nav--prev" onclick="slideMove('stills-series', -1)" aria-label="Previous">
      <svg viewBox="0 0 24 40"><path d="M20 4 L4 20 L20 36 Z" /></svg>
    </button>
    <button class="slide-nav slide-nav--next" onclick="slideMove('stills-series', 1)" aria-label="Next">
      <svg viewBox="0 0 24 40"><path d="M4 4 L20 20 L4 36 Z" /></svg>
    </button>
    <div class="slide-counter" id="stills-series-dots"></div>
  </div>
</section>

<!-- ===== DEDICATED EPISODE LIST SECTION ===== -->
<section class="sec-episodes">
  <div class="ep-list-header">Daftar Episode</div>

  @php
    $episodes = [
      ['no' => 1, 'title' => 'The Beginning of the End', 'desc' => 'In a world where secrets are buried deep beneath the surface, a group of unlikely allies must come together to face an ancient threat that has been dormant for centuries. The tension rises as the first signs of the coming storm appear on the horizon, threatening to destroy everything they hold dear.', 'yt' => 'h_D3VFfhvs4'],
      ['no' => 2, 'title' => 'Shadows of the Past', 'desc' => 'As the group ventures further into the unknown, they are haunted by shadows of their past. Old wounds are reopened and loyalties are tested as they realize that the enemy they face might be closer than they ever imagined.', 'yt' => 'dQw4w9WgXcQ'],
      ['no' => 3, 'title' => 'Broken Alliances', 'desc' => 'The fragility of their bond is exposed when a critical decision leads to a rift within the group. As they struggle to find common ground, a surprise attack from a rival faction forces them to rethink their strategy.', 'yt' => 'y6120QOlsfU'],
      ['no' => 4, 'title' => 'The Silent Oath', 'desc' => 'Silent vows are made in the cold of night. The group prepares for a battle they know they might not win. Every character faces their inner demons before the real ones arrive.', 'yt' => 'h_D3VFfhvs4'],
    ];
  @endphp

  @foreach($episodes as $ep)
  <div class="ep-row">
    <div class="ep-image">
      <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}ep{{ $ep['no'] }}/800/450" alt="Episode {{ $ep['no'] }}">
    </div>
    <div class="ep-details">
      <div class="ep-num">Episode {{ sprintf('%02d', $ep['no']) }}</div>
      <h3 class="ep-heading">{{ $ep['title'] }}</h3>
      <p class="ep-desc">{{ $ep['desc'] }}</p>
      
      <div class="ep-actions-row">
        <a href="https://www.netflix.com" target="_blank" class="ep-watch-link">Watch now.</a>
        <button class="btn-ep-trailer" onclick="openTrailerModal('{{ $ep['yt'] }}')">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
          Trailer
        </button>
      </div>
    </div>
  </div>
  @endforeach
</section>

<!-- ===== BEHIND THE SCENES GALLERY (3 COLUMNS) ===== -->
<section class="sec-bts">
  <div class="sec-label-wrap">
    <span>Behind The Scenes</span>
    <div class="line"></div>
  </div>
  
  <div class="bts-grid">
    @if($films->btsGalleries->count() > 0)
      @foreach($films->btsGalleries as $gallery)
      <div class="g-item {{ $loop->iteration % 3 == 2 ? 'g-item--tall' : '' }}">
        <img src="{{ asset('photo/' . $gallery->photo) }}" alt="BTS">
      </div>
      @endforeach
    @else
      <div class="g-item">
        <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts1/800/800" alt="BTS 1">
      </div>
      <div class="g-item g-item--tall">
        <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts2/800/1200" alt="BTS 2">
      </div>
      <div class="g-item">
        <img src="https://picsum.photos/seed/{{ str_slug($films->title) }}bts3/800/600" alt="BTS 3">
      </div>
    @endif
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
      <a class="rec-card" href="{{ route('detail-series', $item->slug) }}">
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
@endif

<script>
    function openTrailerModal(videoId) {
        var modal = document.getElementById('ytTrailerModal');
        var iframe = document.getElementById('ytTrailerIframe');
        if(!modal || !iframe) return;
        
        // If vid is not passed, use the default from hero
        var vid = videoId || '{{ $video_id }}';
        
        modal.classList.add('is-open');
        iframe.src = "https://www.youtube.com/embed/" + vid + "?autoplay=1&rel=0&showinfo=0";
    }
    function closeTrailerModal() {
        var modal = document.getElementById('ytTrailerModal');
        var iframe = document.getElementById('ytTrailerIframe');
        if(!modal || !iframe) return;
        modal.classList.remove('is-open');
        iframe.src = "";
    }
    
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            const modal = document.getElementById('ytTrailerModal');
            if(modal && modal.classList.contains('is-open')) closeTrailerModal();
        }
    });
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
  document.addEventListener('DOMContentLoaded', function() { initSlideshow('stills-series'); });
</script>

@endsection