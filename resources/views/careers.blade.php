@extends('layouts.app')

@section('title', 'Careers | Sinemaku Pictures')

@section('content')
@include('partials.navbar')

<style>
  :root {
    --bg: #ffffff;
    --text-primary: #0a0a0a;
    --text-secondary: #6b7280;
    --border-color: #eeeeee;
    --editorial-pad: clamp(24px, 15vw, 320px);
  }

  body {
    background-color: var(--bg);
    color: var(--text-primary);
  }

  .careers-container {
    padding-top: 140px;
    padding-bottom: 120px;
    max-width: 1800px;
    margin: 0 auto;
  }

  .careers-header {
    padding: 0 var(--editorial-pad);
    margin-bottom: 80px;
  }

  .careers-header h1 {
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    margin: 0;
  }

  .section-label {
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.35em;
    color: var(--text-primary);
    margin-bottom: 20px;
    display: block;
    position: relative;
    padding-bottom: 12px;
  }
  
  .section-label::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 1px;
    background: var(--text-primary);
  }

  /* Directory List Layout */
  .directory-list {
    margin-top: 20px;
  }

  .directory-item {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
    padding: 64px var(--editorial-pad);
    border-bottom: 1px solid var(--border-color);
    text-decoration: none;
    color: inherit;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .directory-item:first-child {
    border-top: 1px solid var(--border-color);
  }

  .directory-item:hover {
    background-color: #fafafa;
    padding-left: calc(var(--editorial-pad) + 12px);
    padding-right: calc(var(--editorial-pad) - 12px);
  }

  .directory-item:hover .directory-item__title,
  .directory-item:hover svg {
    color: #000 !important;
  }

  .directory-item:hover .directory-item__meta {
    color: #444 !important;
  }

  .directory-item__content {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .directory-item__title {
    font-size: clamp(16px, 1.8vw, 20px);
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    line-height: 1.2;
    margin: 0;
  }

  .directory-item__meta {
    font-size: 11px;
    font-weight: 400;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--text-secondary);
    display: flex;
    gap: 32px;
    align-items: center;
  }

  .directory-item__arrow {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    opacity: 0.3;
  }

  .directory-item:hover .directory-item__arrow {
    transform: translateX(12px);
    opacity: 1;
  }

  .directory-item__arrow svg {
    width: 20px;
    height: 20px;
    stroke-width: 1.2;
  }

  .casting-section {
    margin-top: 120px;
  }

  /* Reveal Animations */
  .reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.is-inview {
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 768px) {
    .directory-item {
      padding: 30px var(--editorial-pad);
    }
    .directory-item__meta {
      flex-direction: column;
      align-items: flex-start;
      gap: 4px;
    }
  }
</style>

<div class="careers-container">
  <!-- OPEN POSITIONS SECTION -->
  <section class="careers-section">
    <div class="careers-header reveal">
      <span class="section-label">Join Our Team</span>
      <h1>Open Positions</h1>
    </div>

    <div class="directory-list">
      @foreach ($careers as $item)
        <a href="{{ route('detail-careers', $item->slug) }}" class="directory-item reveal">
          <div class="directory-item__content">
            <h3 class="directory-item__title">{{ $item->position }}</h3>
            <div class="directory-item__meta">
              <span>{{ $item->tim }}</span>
              <span>{{ $item->location }}</span>
              <span>Posted {{ $item->created_at->diffForHumans() }}</span>
            </div>
          </div>
          <div class="directory-item__arrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </div>
        </a>
      @endforeach
    </div>
  </section>

  <!-- CURRENT CASTINGS SECTION -->
  <section class="casting-section">
    <div class="careers-header reveal">
      <span class="section-label">Casting Calls</span>
      <h1>Current Castings</h1>
    </div>

    <div class="directory-list">
      @foreach ($casting as $item)
        <a href="{{ route('detail-careers', $item->slug) }}" class="directory-item reveal">
          <div class="directory-item__content">
            <h3 class="directory-item__title">{{ $item->pemeran }}</h3>
            <div class="directory-item__meta">
              <span style="font-weight: 700;">{{ $item->judul_film }}</span>
              <span>{{ $item->gender == 'L' ? 'Male' : 'Female' }}, {{ $item->umur }} Yrs</span>
              <span>{{ $item->location }}</span>
            </div>
          </div>
          <div class="directory-item__arrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </div>
        </a>
      @endforeach
    </div>
  </section>
</div>

<script>
(function(){
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
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