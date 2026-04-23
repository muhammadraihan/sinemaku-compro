@extends('layouts.app')

@section('title', $event->judul . ' | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<style>
  :root {
    --bg-white: #ffffff;
    --text-core: #0a0a0a;
    --text-muted: #888888;
    --content-max-w: 860px; /* Editorial narrow column */
    --side-pad: clamp(24px, 5vw, 120px);
  }

  body {
    background-color: var(--bg-white) !important;
    color: var(--text-core) !important;
  }

  /* Revert Navbar to standard state (as on other pages) */
  #unified-navbar {
    filter: none !important;
  }
  #nav-overlay-gradient {
    display: block !important;
  }

  .event-page {
    padding-bottom: 120px;
  }

  /* ===== HERO SECTION ===== */
  .event-hero-bleed {
    width: 100%;
    height: clamp(50vh, 75vh, 900px);
    overflow: hidden;
    position: relative;
    background: #f1f1f1;
    margin-bottom: 80px; /* Increased margin for editorial breathing room */
  }

  .event-hero-bleed img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 1.5s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .event-hero-bleed:hover img {
    transform: scale(1.03);
  }

  /* ===== CONTENT HEADER ===== */
  .event-content-container {
    max-width: 1200px; /* Wider for left-aligned impact */
    margin: 0 auto;
    padding: 0 clamp(1.25rem, 6vw, 10rem); /* Matches About page padding */
  }

  .event-meta-top {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.25em;
    color: var(--text-muted);
    margin-bottom: 16px;
    display: block;
    text-align: left; /* Rata Kiri */
  }

  .event-h1 {
    font-size: clamp(32px, 5vw, 72px);
    font-weight: 800;
    line-height: 1.05;
    margin: 0 0 40px;
    letter-spacing: -0.04em;
    text-transform: uppercase;
    text-align: left; /* Rata Kiri */
    max-width: 900px;
  }

  /* ===== SHARE BAR ===== */
  .event-share-row {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Rata Kiri */
    gap: 24px;
    margin-bottom: 80px;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 24px 0;
  }

  .share-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--text-core);
  }

  .share-icon {
    color: var(--text-core);
    text-decoration: none;
    transition: opacity 0.3s;
    display: flex;
    align-items: center;
  }

  .share-icon:hover {
    opacity: 0.5;
  }

  /* ===== EDITORIAL BODY ===== */
  .event-editorial-body {
    font-size: clamp(17px, 1.2vw, 20px);
    line-height: 1.7;
    font-weight: 400;
    color: #222;
  }

  .event-editorial-body p {
    margin-bottom: 2em;
  }

  .event-editorial-body h2 {
    font-size: clamp(24px, 3vw, 40px);
    font-weight: 800;
    margin: 2.5em 0 1em;
    letter-spacing: -0.02em;
    color: var(--text-core);
  }

  .event-editorial-body blockquote {
    margin: 4em 0;
    font-size: clamp(22px, 2.5vw, 32px);
    font-style: italic;
    font-weight: 300;
    line-height: 1.4;
    text-align: center;
    color: var(--text-core);
    padding: 0 40px;
    position: relative;
  }

  .event-editorial-body blockquote footer {
    font-size: 12px;
    font-style: normal;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    margin-top: 20px;
    color: var(--text-muted);
  }

  .event-editorial-body img {
    width: 100%;
    height: auto;
    margin: 3em 0;
    display: block;
    background: #f9f9f9;
  }

  /* ===== BOTTOM / OTHER EVENTS ===== */
  .more-events-section {
    margin-top: 120px;
    padding: 100px var(--side-pad) 0;
    border-top: 1px solid #eee;
  }

  .more-events-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
  }

  .more-events-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
  }

  .more-events-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
  }

  .event-card-small {
    text-decoration: none;
    color: var(--text-core);
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .event-card-small__media {
    aspect-ratio: 16/10;
    overflow: hidden;
    background: #f5f5f5;
  }

  .event-card-small__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s;
  }

  .event-card-small:hover img {
    transform: scale(1.05);
  }

  .event-card-small__title {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.3;
    margin: 0;
    text-transform: uppercase;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 900px) {
    .event-hero-bleed { height: 50vh; }
    .more-events-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 600px) {
    .more-events-grid { grid-template-columns: 1fr; }
    .event-editorial-body { font-size: 17px; }
  }

  /* Animations */
  .reveal { opacity: 0; transform: translateY(30px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); }
  .reveal.is-inview { opacity: 1; transform: translateY(0); }
</style>

<article class="event-page">
  
  <!-- FULL BLEED HERO -->
  <header class="event-hero-bleed reveal">
    <img src="{{ asset('photo/' . $event->photo) }}" alt="{{ $event->judul }}">
  </header>

  <div class="event-content-container">
    <!-- METADATA & TITLE -->
    <header class="reveal">
      <span class="event-meta-top">{{ \Carbon\Carbon::parse($event->tgl_event)->format('F d, Y') }}</span>
      <h1 class="event-h1">@i18n($event, 'judul')</h1>
    </header>

    <!-- SHARE BAR -->
    <div class="event-share-row reveal">
      <span class="share-label">Share</span>
      <a href="#" class="share-icon" aria-label="Share on Instagram">
        <span class="iconify" data-icon="simple-icons:instagram" data-width="18"></span>
      </a>
      <a href="#" class="share-icon" aria-label="Share on X">
        <span class="iconify" data-icon="simple-icons:x" data-width="18"></span>
      </a>
      <a href="#" class="share-icon" aria-label="Copy Link">
        <span class="iconify" data-icon="lucide:link" data-width="18"></span>
      </a>
    </div>

    <!-- MAIN BODY CONTENT -->
    <div class="event-editorial-body reveal">
      @i18n($event, 'detail')
    </div>
  </div>

  <!-- OTHER EVENTS -->
  <section class="more-events-section reveal">
    <div class="more-events-header">
      <span class="more-events-title">Discover More</span>
    </div>
    <div class="more-events-grid">
      @foreach($all_event->take(3) as $item)
        <a href="{{ route('detail-event', $item->slug) }}" class="event-card-small">
          <div class="event-card-small__media">
            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy">
          </div>
          <h3 class="event-card-small__title">@i18n($item, 'judul')</h3>
        </a>
      @endforeach
    </div>
  </section>

</article>

<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<script>
  (function() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-inview');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  })();
</script>

@include('components.footer')

@endsection