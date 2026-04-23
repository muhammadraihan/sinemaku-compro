@extends('layouts.app')

@section('title', 'Articles | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

<style>
  :root {
    --editorial-pad: clamp(32px, 8vw, 160px);
    --bg: #ffffff;
    --text-primary: #0a0a0a;
    --text-secondary: #4b5563;
    --text-muted: #9ca3af;
  }

  body {
    background-color: var(--bg) !important;
    color: var(--text-primary) !important;
  }

  /* Standard navbar look */
  #nav-overlay-gradient {
    display: block !important;
  }
  #unified-navbar {
    filter: none !important;
  }

  .articles-container {
    padding-top: 140px;
    padding-bottom: 120px;
    overflow-x: hidden;
    background-color: var(--bg);
  }

  /* ===== CATEGORY FILTERS ===== */
  .article-filters-section {
    padding: 0 var(--editorial-pad);
    margin-bottom: 80px;
    display: flex;
    justify-content: center;
  }

  .article-filters {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }

  .chip {
    position: relative;
    border: none;
    background: transparent;
    color: #888;
    font: 300 12px/1;
    padding: 6px 16px;
    cursor: pointer;
    transition: all .2s ease;
    text-transform: uppercase;
    letter-spacing: 0.12em;
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
  .article-list {
    display: flex;
    flex-direction: column;
    gap: 15vh;
  }

  .article-row {
    display: flex;
    align-items: stretch;
    min-height: 70vh;
    border: none;
    text-decoration: none;
    color: inherit;
  }

  /* Alternating: Image Left/Right */
  .article-row:nth-child(even) {
    flex-direction: row-reverse;
  }

  .article-row__media {
    flex: 0 0 45%; 
    background: #fbfbfb;
    overflow: hidden;
  }

  .article-row__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .article-row:hover .article-row__media img {
    transform: scale(1.05);
  }

  .article-row__content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 60px var(--editorial-pad);
    background-color: var(--bg);
  }

  /* Text padding for alternating layout */
  .article-row:nth-child(odd) .article-row__content {
    padding-left: clamp(40px, 8vw, 120px);
  }

  .article-row:nth-child(even) .article-row__content {
    padding-right: clamp(40px, 8vw, 120px);
  }

  .article-row__header {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .article-row__meta {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--text-muted);
    display: flex;
    gap: 20px;
    align-items: center;
  }

  .article-row__title {
    font-size: clamp(32px, 5vw, 64px);
    font-weight: 800;
    line-height: 1.05;
    margin: 0;
    letter-spacing: -0.04em;
    color: var(--text-primary);
    text-transform: uppercase;
  }

  .article-row__excerpt {
    font-size: clamp(15px, 1.25vw, 18px);
    font-weight: 300;
    line-height: 1.6;
    color: var(--text-secondary);
    max-width: 65ch;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .article-row__cta {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    text-transform: uppercase;
    letter-spacing: 0.2em;
    text-decoration: none;
    transition: all 0.3s ease;
    padding-bottom: 4px;
    border-bottom: 2px solid #efefef;
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    gap: 12px;
  }

  .article-row__cta svg {
    transition: transform 0.3s ease;
  }

  .article-row:hover .article-row__cta {
    border-bottom-color: var(--text-primary);
  }

  .article-row:hover .article-row__cta svg {
    transform: translateX(4px);
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .article-row__media { flex: 0 0 50%; }
    .article-row__content { padding: 40px 48px !important; }
    .article-filters-section { padding: 0 32px; }
  }

  @media (max-width: 768px) {
    .article-row {
      flex-direction: column !important;
      min-height: auto;
    }
    .article-row__media {
      width: 100%;
      aspect-ratio: 16/10;
    }
    .article-row__content {
      padding: 40px 24px !important;
      min-height: auto;
    }
    .article-row__title { font-size: 38px; }
    .articles-container { padding-top: 100px; }
    .article-list { gap: 8vh; }
    .article-row__header { gap: 16px; }
  }

  /* Scroll Reveal Animation */
  .reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.is-inview {
    opacity: 1;
    transform: translateY(0);
  }
</style>

<div class="articles-container">
  
  {{-- FILTER KATEGORI --}}
  <div class="article-filters-section reveal">
    <div class="article-filters" role="tablist">
      @foreach($artikel_kategori as $cat)
        <button class="chip" data-filter="{{ $cat->uuid }}" role="tab">{{ $cat->name }}</button>
      @endforeach
    </div>
  </div>
 
  <div class="article-list">
    {{-- FEATURED ARTICLE (Row 1) --}}
    @if($articles)
      <a href="{{ ($articles->kategori == 'external') ? $articles->link : route('detail-articles', $articles->slug) }}" 
         class="article-row reveal" 
         data-category="{{ $articles->artikel_kategori_uuid }}"
         @if($articles->kategori == 'external') target="_blank" @endif>
        <div class="article-row__media">
          <img src="{{ asset('photo/' . $articles->photo) }}" alt="{{ $articles->judul }}" loading="lazy">
        </div>
        <div class="article-row__content">
          <div class="article-row__header">
            <div class="article-row__meta">
              @if($articles->artikelKategori)
                <span style="color: #111; font-weight: 800;">{{ $articles->artikelKategori->name }}</span>
                <span>&bull;</span>
              @endif
              <span>{{ $articles->penulis }}</span>
              <span>&bull;</span>
              <span>{{ \Carbon\Carbon::parse($articles->tgl_rilis)->format('d M Y') }}</span>
            </div>
            <h2 class="article-row__title">@i18n($articles, 'judul')</h2>
            <div class="article-row__excerpt">
              @i18n($articles, 'title')
            </div>
          </div>
          <div class="article-row__cta">
            Read Story
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </div>
        </div>
      </a>
    @endif
 
    {{-- REMAINING ARTICLES --}}
    @foreach($all_articles as $item)
      <a href="{{ ($item->kategori == 'external') ? $item->link : route('detail-articles', $item->slug) }}" 
         class="article-row reveal"
         data-category="{{ $item->artikel_kategori_uuid }}"
         @if($item->kategori == 'external') target="_blank" @endif>
        <div class="article-row__media">
          <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy">
        </div>
        <div class="article-row__content">
          <div class="article-row__header">
            <div class="article-row__meta">
              @if($item->artikelKategori)
                <span style="color: #111; font-weight: 800;">{{ $item->artikelKategori->name }}</span>
                <span>&bull;</span>
              @endif
              <span>{{ $item->penulis }}</span>
              <span>&bull;</span>
              <span>{{ \Carbon\Carbon::parse($item->tgl_rilis)->format('d M Y') }}</span>
            </div>
            <h2 class="article-row__title">@i18n($item, 'judul')</h2>
            <div class="article-row__excerpt">
              @i18n($item, 'title')
            </div>
          </div>
          <div class="article-row__cta">
            Read Story
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </div>
        </div>
      </a>
    @endforeach
  </div>
</div>
 
<script>
  (function() {
    // Scroll Reveal Intersection Observer
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-inview');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
 
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
 
    // Dynamic Filtering Logic
    const chips = document.querySelectorAll('.chip');
    const articles = document.querySelectorAll('.article-row');
 
    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        const filter = chip.getAttribute('data-filter');
        const isAlreadyActive = chip.classList.contains('is-active');
        
        // UI State
        chips.forEach(c => {
          c.classList.remove('is-active');
          c.setAttribute('aria-selected', 'false');
        });
 
        let currentFilter = filter;
        if (isAlreadyActive) {
          // If clicking active, deactivate it -> show all
          currentFilter = 'all';
        } else {
          chip.classList.add('is-active');
          chip.setAttribute('aria-selected', 'true');
        }
 
        // Logic
        articles.forEach(article => {
          const category = article.getAttribute('data-category');
          if (currentFilter === 'all' || category === currentFilter) {
            article.style.display = 'flex';
            // Trigger reveal again in case it was hidden
            setTimeout(() => article.classList.add('is-inview'), 10);
          } else {
            article.style.display = 'none';
          }
        });
      });
    });
  })();
</script>

@include('components.footer')

@endsection
