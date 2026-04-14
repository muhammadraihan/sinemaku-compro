@extends('layouts.app')

@section('title', 'Events | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<style>
  :root {
    --editorial-pad: clamp(32px, 8vw, 160px);
    --bg: #ffffff;
    --text-primary: #0a0a0a;
    --text-secondary: #888888;
    --text-muted: #b0b0b0;
  }

  body {
    background-color: var(--bg);
    color: var(--text-primary);
  }

  /* Revert navbar to standard look to match other pages */
  #nav-overlay-gradient {
    display: block !important;
  }
  #unified-navbar {
    filter: none !important;
  }

  .events-container {
    padding-top: 140px;
    overflow-x: hidden;
    background-color: var(--bg);
  }

  /* ===== CATEGORY FILTERS ===== */
  .event-filters-section {
    padding: 0 var(--editorial-pad);
    margin-bottom: 60px;
    display: flex;
    justify-content: center; /* Center filters */
  }

  .event-filters {
    display: flex;
    gap: 8px; /* Slightly tighter gap */
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }

  .chip {
    position: relative;
    border: none;
    background: transparent;
    color: #888;
    font: 300 12px/1; /* Smaller font size (12px) */
    padding: 6px 12px;
    cursor: pointer;
    transition: all .2s ease;
    text-transform: uppercase;
    letter-spacing: 0.1em;
  }

  .chip::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 60%;
    height: 1.5px;
    background-color: #111;
    transition: transform 0.4s cubic-bezier(0.2, 0.7, 0.2, 1);
  }

  .chip.is-active::after {
    transform: translateX(-50%) scaleX(1);
  }

  .chip.is-active, .chip:hover {
    color: #111;
    font-weight: 700;
  }

  /* ===== LISTING SECTION ===== */
  .event-list {
    display: flex;
    flex-direction: column;
    gap: 18vh; /* Large spacing between events */
  }

  .event-row {
    display: flex;
    align-items: stretch;
    min-height: 70vh;
    border: none;
  }

  /* Alternating: Image Left/Right */
  .event-row:nth-child(even) {
    flex-direction: row-reverse;
  }

  .event-row__media {
    flex: 0 0 40%; /* 2:3 ratio — Image is 40% (less dominant) */
    background: #fcfcfc;
    overflow: hidden;
  }

  .event-row__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .event-row:hover .event-row__media img {
    transform: scale(1.04);
  }

  .event-row__content {
    flex: 1; /* 2:3 ratio — Text is 60% (more dominant) */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 60px var(--editorial-pad);
    background-color: var(--bg);
  }

  /* Text padding to ensure NOT hitting the edge or image */
  .event-row:nth-child(odd) .event-row__content {
    padding-left: clamp(40px, 8vw, 120px);
  }

  .event-row:nth-child(even) .event-row__content {
    padding-right: clamp(40px, 8vw, 120px);
  }

  .event-row__header {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .event-row__title {
    font-size: clamp(28px, 4.5vw, 60px);
    font-weight: 800;
    line-height: 1.0;
    margin: 0;
    letter-spacing: -0.04em;
    color: var(--text-primary);
    text-transform: uppercase;
  }

  /* Faded event details */
  .event-row__detail {
    font-size: clamp(14px, 1.2vw, 16px);
    font-weight: 300;
    line-height: 1.6;
    color: var(--text-secondary);
    max-width: 65ch;
    position: relative;
    max-height: 120px; /* Limit height to trigger fade */
    overflow: hidden;
    mask-image: linear-gradient(to bottom, black 50%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 50%, transparent 100%);
  }

  .event-row__cta {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-decoration: none;
    transition: all 0.3s ease;
    padding-bottom: 2px;
    border-bottom: 1.5px solid transparent;
    align-self: flex-start;
  }

  .event-row__cta:hover {
    color: var(--text-primary);
    border-bottom-color: var(--text-primary);
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .event-row__media { flex: 0 0 45%; }
    .event-row__content { padding: 40px 32px !important; }
    .event-filters-section { padding: 0 24px; }
  }

  @media (max-width: 768px) {
    .event-row {
      flex-direction: column !important;
      min-height: auto;
    }
    .event-row__media {
      width: 100%;
      aspect-ratio: 4/3;
    }
    .event-row__content {
      padding: 40px 24px !important;
      min-height: 250px;
    }
    .event-row__title { font-size: 36px; }
    .events-container { padding-top: 100px; }
    .event-list { gap: 10vh; }
  }

  /* Animation */
  .reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.is-inview {
    opacity: 1;
    transform: translateY(0);
  }
</style>

<div class="events-container">
  
  {{-- FILTER KATEGORI --}}
  <div class="event-filters-section reveal">
    <div class="event-filters">
      <button class="chip is-active" data-filter="all">All</button>
      <button class="chip" data-filter="sinemaku-day">Sinemaku Day</button>
      <button class="chip" data-filter="special-events">Special Events</button>
      <button class="chip" data-filter="gala-premiere">Gala Premiere</button>
      <button class="chip" data-filter="trailer-launch">Trailer Launch</button>
      <button class="chip" data-filter="roadshow">Roadshow</button>
      <button class="chip" data-filter="volunteer">Daftar Volunteer</button>
    </div>
  </div>

  @if($event->count() > 0)
    <!-- LISTING SECTION -->
    <div class="event-list">
      @foreach($event as $item)
        <article class="event-row reveal">
          <div class="event-row__media">
            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy">
          </div>
          <div class="event-row__content">
            <div class="event-row__header">
              <h2 class="event-row__title">{{ $item->judul }}</h2>
              <div class="event-row__detail">
                {{-- Detail event dengan efek fade --}}
                @if($item->title)
                  {{ $item->title }}. 
                @endif
                {{-- Example long text for fade demonstration --}}
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              </div>
            </div>
            <a href="{{ route('detail-event', $item->slug) }}" class="event-row__cta">Read More</a>
          </div>
        </article>
      @endforeach
    </div>
  @else
    <div style="padding: 160px 24px; text-align: center; color: #888; font-size: 14px; letter-spacing: 0.1em; text-transform: uppercase;">
      No events available at this moment.
    </div>
  @endif
</div>

<script>
  (function() {
    // Scroll Reveal
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-inview');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Filter Chips (UI Only)
    const chips = document.querySelectorAll('.chip');
    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        chips.forEach(c => c.classList.remove('is-active'));
        chip.classList.add('is-active');
        // Logic filter akan ditambahkan setelah database siap
      });
    });
  })();
</script>

@include('components.footer')

@endsection