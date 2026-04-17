@extends('layouts.app')

@section('title', (isset($careers->position) ? $careers->position : $casting->pemeran) . ' | Sinemaku Pictures')

@section('content')
@include('partials.navbar')

<style>
  :root {
    --bg: #ffffff;
    --text-primary: #0a0a0a;
    --text-secondary: #6b7280;
    --border-color: #eeeeee;
    --editorial-pad: clamp(24px, 8vw, 120px);
  }

  body {
    background-color: var(--bg);
    color: var(--text-primary);
  }

  .career-detail-container {
    padding-top: 160px;
    padding-bottom: 120px;
    max-width: 1400px;
    margin: 0 auto;
    padding-left: var(--editorial-pad);
    padding-right: var(--editorial-pad);
  }

  .career-layout {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 80px;
  }

  /* Header */
  .career-header {
    margin-bottom: 60px;
  }

  .career-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: var(--text-secondary);
    margin-bottom: 16px;
    display: block;
  }

  .career-title {
    font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 800;
    line-height: 1.0;
    letter-spacing: -0.04em;
    margin: 0 0 24px;
    text-transform: uppercase;
  }

  .career-dept {
    font-size: 18px;
    font-weight: 400;
    color: var(--text-secondary);
  }

  /* Main Content */
  .career-main-content {
    font-size: 16px;
    line-height: 1.8;
  }

  .career-main-content h2, 
  .career-main-content h3 {
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 40px;
    margin-bottom: 20px;
    font-weight: 800;
  }

  .career-main-content p {
    margin-bottom: 24px;
    color: #333;
  }

  .career-main-content ul {
    margin-bottom: 32px;
    padding-left: 20px;
  }

  .career-main-content li {
    margin-bottom: 12px;
  }

  /* Sidebar */
  .career-sidebar {
    position: sticky;
    top: 140px;
    height: fit-content;
  }

  .metadata-block {
    border-top: 1px solid var(--text-primary);
    padding-top: 32px;
    margin-bottom: 48px;
  }

  .metadata-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color);
  }

  .metadata-item__label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--text-secondary);
  }

  .metadata-item__value {
    font-size: 14px;
    font-weight: 600;
    text-align: right;
  }

  .btn-apply {
    display: block;
    width: 100%;
    background: var(--text-primary);
    color: #fff;
    text-align: center;
    padding: 24px;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-decoration: none;
    transition: background 0.3s;
    margin-top: 40px;
  }

  .btn-apply:hover {
    background: #333;
  }

  /* Others Section */
  .others-section {
    margin-top: 80px;
  }

  .others-section h4 {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    margin-bottom: 32px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--text-primary);
  }

  .mini-career-link {
    display: block;
    padding: 16px 0;
    border-bottom: 1px solid var(--border-color);
    text-decoration: none;
    color: inherit;
    transition: opacity 0.3s;
  }

  .mini-career-link:hover {
    opacity: 0.6;
  }

  .mini-career-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 4px;
  }

  .mini-career-meta {
    font-size: 12px;
    color: var(--text-secondary);
  }

  /* Reveal Animations */
  .reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.is-inview {
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 960px) {
    .career-layout {
      grid-template-columns: 1fr;
      gap: 60px;
    }
    .career-sidebar {
      position: static;
    }
  }
</style>

<div class="career-detail-container">
  <div class="career-layout">
    <!-- MAIN COLUMN -->
    <main class="career-main">
      <header class="career-header reveal">
        <span class="career-label">Opportunities</span>
        <h1 class="career-title">{{ $careers->position ?? $casting->pemeran }}</h1>
        <div class="career-dept">{{ $careers->tim ?? $casting->judul_film }}</div>
      </header>

      <div class="career-main-content reveal" style="transition-delay: 0.1s;">
        {!! $careers->detail ?? $casting->detail !!}
      </div>
    </main>

    <!-- SIDEBAR COLUMN -->
    <aside class="career-sidebar reveal" style="transition-delay: 0.2s;">
      <div class="metadata-block">
        <div class="metadata-item">
          <span class="metadata-item__label">Location</span>
          <span class="metadata-item__value">{{ $careers->location ?? $casting->location }}</span>
        </div>

        @if (!empty($careers->status))
          <div class="metadata-item">
            <span class="metadata-item__label">Type</span>
            <span class="metadata-item__value">{{ $careers->status }}</span>
          </div>
          <div class="metadata-item">
            <span class="metadata-item__label">Experience</span>
            <span class="metadata-item__value">{{ $careers->pengalaman }}</span>
          </div>
          @if($careers->salary)
            <div class="metadata-item">
              <span class="metadata-item__label">Salary Range</span>
              <span class="metadata-item__value">
                @if(is_numeric($careers->salary))
                  Rp {{ number_format($careers->salary, 0, ',', '.') }}
                @else
                  {{ $careers->salary }}
                @endif
              </span>
            </div>
          @endif
        @else
          <div class="metadata-item">
            <span class="metadata-item__label">Shoot Date</span>
            <span class="metadata-item__value">{{ \Carbon\Carbon::parse($casting->shoot_date)->format('d M Y') }}</span>
          </div>
          <div class="metadata-item">
            <span class="metadata-item__label">Gender / Age</span>
            <span class="metadata-item__value">{{ $casting->gender == 'L' ? 'Male' : 'Female' }}, {{ $casting->umur }} Yrs</span>
          </div>
          <div class="metadata-item">
            <span class="metadata-item__label">Deadline</span>
            <span class="metadata-item__value">{{ \Carbon\Carbon::parse($casting->deadline)->format('d M Y') }}</span>
          </div>
        @endif
      </div>

      <a href="{{ $careers->link ?? $casting->link }}" class="btn-apply" target="_blank">
        Apply For This Position
      </a>

      <!-- OTHER POSITIONS -->
      <div class="others-section">
        <h4>Other Openings</h4>
        @if (!empty($careers->status))
          @foreach ($all_careers as $item)
            <a href="{{ route('detail-careers', $item->slug) }}" class="mini-career-link">
              <div class="mini-career-title">{{ $item->position }}</div>
              <div class="mini-career-meta">{{ $item->tim }} · {{ $item->location }}</div>
            </a>
          @endforeach
        @else
          @foreach ($all_casting as $item)
            <a href="{{ route('detail-careers', $item->slug) }}" class="mini-career-link">
              <div class="mini-career-title">{{ $item->pemeran }}</div>
              <div class="mini-career-meta">{{ $item->judul_film }} · {{ $item->location }}</div>
            </a>
          @endforeach
        @endif
      </div>
    </aside>
  </div>
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