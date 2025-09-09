@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

@section('content')
    {{-- ================== NAVBAR & HERO ================== --}}
    {{-- <section class="hero-section" role="banner" aria-label="Hero">
        <div class="hero-gradient" aria-hidden="true"></div>

        <img
            class="temp-imagehc-vht-6-1 hero-bg"
            src="{{ asset('img/temp-imagehc-vht-6-10.png') }}"
            alt="Hero background"
            loading="eager"
            fetchpriority="high"
        />

        <div class="rectangle-5" aria-hidden="true"></div>

        <div class="hero-content">
        <div class="hero-meta" role="group" aria-label="Movie meta">
            <span class="meta-year">2023</span>
            <span class="meta-dot" aria-hidden="true">•</span>
            <span class="meta-cast">Starring Prilly Latuconsina</span>
        </div>

    <!-- Tetap biarkan 01 - 04 di kiri bawah -->
    <div class="_01-04">01 - 04</div>

            <h1 class="bolehkah-sekali-saja-ku-menangis" aria-label="BOLEHKAH SEKALI SAJA KU MENANGIS">
                <span>BOLEHKAH</span><br />
                <span>SEKALI SAJA</span><br />
                <span>KU MENANGIS</span>
            </h1>
        </div>
    </section> --}}

    @php
        $total = str_pad($film->count(), 2, '0', STR_PAD_LEFT);
    @endphp
    <div class="hero-slider" aria-roledescription="carousel">
        @foreach($film as $i => $h)
            <section class="hero-section {{ $loop->first ? 'is-active' : '' }}"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="Slide {{ $i+1 }} of {{ $film->count() }}">
                <div class="hero-gradient" aria-hidden="true"></div>

                <img class="hero-bg"
                    src="{{ asset('photo/' . $h->photo) }}"
                    alt="Hero background {{ $h->title }}"
                    @if($loop->first) loading="eager" fetchpriority="high" @else loading="lazy" @endif>

                <div class="rectangle-5" aria-hidden="true"></div>

                <div class="hero-content">
                    <div class="hero-meta" role="group" aria-label="Movie meta">
                        <span class="meta-year">{{ \Carbon\Carbon::parse($h->release_date)->format('Y') }}</span>
                        <span class="meta-dot" aria-hidden="true">•</span>
                        <span class="meta-cast">{{ $h->cast }}</span>
                    </div>

                    <!-- <div class="_01-04">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }} - {{ $total }}</div> -->

                    <h1 class="bolehkah-sekali-saja-ku-menangis">
                        <span>{{ $h->title }}</span><br />
                    </h1>
                </div>
            </section>
        @endforeach
    </div>


<!-- ============ COMING SOON (Horizontal Scroll) ============ -->
<section class="cs-scroll" aria-labelledby="cs-scroll-title">
  <div class="cs-scroll-head">
    <h2 id="cs-scroll-title">Coming Soon</h2>
    {{-- Opsional: kalau ada rute list semua film/series, isi href-nya --}}
  </div>

  <div class="cs-row" role="list">
    @foreach ($coming_soon as $item)
      <article class="cs-tile" role="listitem">
        @if (strtolower($item->Categories->name) == 'film')
          <a class="cs-link" href="{{ route('detail-film', $item->uuid) }}" aria-label="{{ $item->title }}">
        @else
          <a class="cs-link" href="{{ route('detail-series', $item->uuid) }}" aria-label="{{ $item->title }}">
        @endif

            <div class="cs-tile-media">
                <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->title }} poster" loading="lazy">
                <span class="cs-date">
                    ON SCREENS {{ strtoupper(\Carbon\Carbon::parse($item->release_date)->format('M d, Y')) }}
                </span>
            </div>

            <div class="cs-tile-caption">
              <h3 class="cs-tile-title">{{ strtoupper($item->title) }}</h3>
              <p class="cs-tile-sub">
                {{ $item->Categories->name }}
                ({{ \Carbon\Carbon::parse($item->release_date)->format('Y') }})
              </p>
            </div>

          </a>
      </article>
    @endforeach
  </div>
</section>

{{-- ================== FILMS (New Release rail) ================== --}}
<section class="nr-rail" aria-labelledby="nr-films-title">
  <div class="nr-rail-head">
    <h2 id="nr-films-title" class="nr-rail-title">Films</h2>
    <a class="nr-rail-viewall" href="{{ route('film') }}">View All →</a>
  </div>

  <div class="nr-rail-wrap">
    {{-- <button class="nr-nav nr-prev" aria-label="Previous" type="button">‹</button> --}}

    <ul class="nr-track" role="list" aria-label="Films scroller">
      @foreach ($film as $item)
        <li class="nr-item" role="listitem">
          <a class="nr-card" href="{{ route('detail-film', $item->uuid) }}">
            <figure class="nr-media">
              <img
                src="{{ asset('photo/' . $item->poster) }}"
                alt="{{ $item->title }} poster"
                loading="lazy"
              />
              <span class="nr-year">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
            </figure>
            <figcaption class="nr-caption">
              <h3 class="nr-name">{{ $item->title }}</h3>
              <span class="nr-sub">Film</span>
            </figcaption>
          </a>
        </li>
      @endforeach
    </ul>

    {{-- <button class="nr-nav nr-next" aria-label="Next" type="button">›</button> --}}

    <!-- edge fade -->
    <div class="nr-fade nr-fade-left" aria-hidden="true"></div>
    <div class="nr-fade nr-fade-right" aria-hidden="true"></div>
  </div>
</section>

{{-- ================== SERIES (New Release rail) ================== --}}
<section class="nr-rail" aria-labelledby="nr-films-title">
  <div class="nr-rail-head">
    <h2 id="nr-films-title" class="nr-rail-title">Series</h2>
    <a class="nr-rail-viewall" href="{{ route('series') }}">View All →</a>
  </div>

  <div class="nr-rail-wrap">
    {{-- <button class="nr-nav nr-prev" aria-label="Previous" type="button">‹</button> --}}

    <ul class="nr-track" role="list" aria-label="Films scroller">
      @foreach ($series as $item)
        <li class="nr-item" role="listitem">
          <a class="nr-card" href="{{ route('detail-series', $item->uuid) }}">
            <figure class="nr-media">
              <img
                src="{{ asset('photo/' . $item->poster) }}"
                alt="{{ $item->title }} poster"
                loading="lazy"
              />
              <span class="nr-year">{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
            </figure>
            <figcaption class="nr-caption">
              <h3 class="nr-name">{{ $item->title }}</h3>
              <span class="nr-sub">Series</span>
            </figcaption>
          </a>
        </li>
      @endforeach
    </ul>

    {{-- <button class="nr-nav nr-next" aria-label="Next" type="button">›</button> --}}

    <!-- edge fade -->
    <div class="nr-fade nr-fade-left" aria-hidden="true"></div>
    <div class="nr-fade nr-fade-right" aria-hidden="true"></div>
  </div>
</section>

    {{-- ================== SHOP / FEATURE 1 ================== --}}
    @foreach ($shop as $i => $item)
        @if($loop->odd)
            {{-- Layout default: teks kiri, gambar kanan --}}
            <section class="feature-sidetext">
                <div class="feature-wrap">
                    <!-- Kolom Kiri: Teks -->
                    <div class="feature-text">
                        <div class="feature-eyebrow">SHOP</div>
                        <h2 class="feature-title">{{ $item->name }}</h2>

                        <a href="{{ route('detail-shop', $item->uuid) }}" class="feature-cta">
                            <span class="cta-line"></span>&nbsp;
                            <span class="cta-label">EXPLORE PRODUCT</span>
                        </a>
                    </div>

                    <!-- Kolom Kanan: Media -->
                    <a href="{{ route('detail-shop', $item->uuid) }}" class="feature-media">
                        <div class="feature-media-frame">
                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->name }}" loading="lazy" />
                        </div>
                    </a>
                </div>
            </section>
        @else
            {{-- Layout alternate: gambar kiri, teks kanan --}}
            <section class="feature-sidetext">
                <div class="feature-wrap">
                    <!-- Foto -->
                    <a href="{{ route('detail-shop', $item->uuid) }}" class="feature-media">
                        <div class="feature-media-frame">
                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->name }}" loading="lazy" />
                        </div>
                    </a>

                    <!-- Teks -->
                    <div class="feature-media-content">
                        <span class="feature-eyebrow">SHOP</span>
                        <h2 class="feature-title">{{ $item->name }}</h2>

                        <a href="{{ route('detail-shop', $item->uuid) }}" class="feature-cta">
                            <span class="cta-line"></span>&nbsp;
                            <span class="cta-label">EXPLORE PRODUCT</span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
    @endforeach


    {{-- ================== SPOTLIGHT 1 ================== --}}
    <section class="spotlight" aria-label="Spotlight">
        <div class="spotlight__frame">
            <img
                class="spotlight__image"
                src="{{ asset('photo/' . $spotlight1->photo) }}"
                alt="{{ $spotlight1->title }} still"
                loading="lazy"
            />
            <div class="spotlight__overlay" aria-hidden="true"></div>

            <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">{{ strtoupper($spotlight1->title) }}</h2>
            </div>
        </div>
    </section>

    {{-- ================== ARTICLES ================== --}}
<section class="articles-section" aria-labelledby="articles-title">
  <div class="articles-header">
    <h2 id="articles-title">Articles</h2>
    <a href="{{ route('articles') }}" class="view-all" aria-label="View all articles">View All →</a>
  </div>

  <div class="articles-grid">
    {{-- LEFT: 1 Featured only --}}
    @php $featured = collect($article)->first(); @endphp
    @if($featured)
      <article class="article-featured">
        <a href="{{ $featured->kategori === 'external' ? $featured->link : route('detail-articles', $featured->uuid) }}">
          <img src="{{ asset('photo/' . $featured->photo) }}" alt="{{ $featured->judul }}" loading="lazy" />
          <div class="article-featured-text">
            <h3>{{ $featured->judul }}</h3>
            <p>{{ $featured->title }}</p>
          </div>
        </a>
      </article>
    @endif

    {{-- RIGHT: ONE list container, items di-loop di dalamnya --}}
    <div class="article-list" role="list">
      @foreach ($all_article as $item)
        <article class="article-item" role="listitem">
          <a href="{{ $item->kategori === 'external' ? $item->link : route('detail-articles', $item->uuid) }}" class="article-item-link">
            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" />
            <div>
              <h4>{{ $item->judul }}</h4>
              <span class="date">{{ $item->created_at->format('d M Y') }}</span>
            </div>
          </a>
        </article>
      @endforeach
    </div>
  </div>
</section>

    {{-- ================== JOIN MEMBER ================== --}}
    <section class="join-member" aria-labelledby="join-title">
        <div class="join-member-inner">
            <h2 id="join-title" class="join-member-title">Join the Movement</h2>
            <p class="join-member-desc">
                Be part of a community that celebrates bold storytelling and artistic vision.
                Get exclusive access to premieres, behind-the-scenes content, and limited releases.
            </p>
            <a href="{{ route('frontend.membership') }}">
                <button class="join-member-btn" type="button" aria-label="Join now">→ UNLOCK THE EXPERIENCE</button>
            </a>
        </div>
    </section>

    {{-- ================== SPOTLIGHT 2 ================== --}}
    <section class="spotlight" aria-label="Spotlight">
        <div class="spotlight__frame">
            <img
                class="spotlight__image"
                src="{{ asset('photo/' . $spotlight2->photo) }}"
                alt="{{ $spotlight2->title }} still"
                loading="lazy"
            />
            <div class="spotlight__overlay" aria-hidden="true"></div>

            <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">{{ strtoupper($spotlight2->title) }}</h2>
            </div>
        </div>
    </section>

    {{-- ================== CAREERS ================== --}}
    <section class="careers-section" id="careers" aria-labelledby="careers-title">
        <div class="careers-wrap">
            <header class="careers-header">
                <h2 class="careers-title" id="careers-title">Join Our Vision</h2>
                
            </header>

            <div class="careers-grid" role="list">
  @foreach ($careers as $item)
    <article class="career-card" role="listitem">
      <div class="career-card__body">
        <h3 class="career-role">{{ $item->position }}</h3>
        <div class="career-dept">{{ $item->tim }}</div>

        <div class="career-meta">
          <span class="career-loc">
            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
              <path d="M12 22s8-4.5 8-12a8 8 0 10-16 0c0 7.5 8 12 8 12z" fill="none" stroke="currentColor" stroke-width="1.8"/>
              <circle cx="12" cy="10" r="2" fill="currentColor"/>
            </svg>
            {{ $item->location }}
          </span>
        </div>
      </div>

      <hr class="career-sep" />

      <a class="career-apply" href="{{ $item->link }}" target="_blank" rel="noopener">
        APPLY NOW
        <svg class="career-apply__ic" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </article>
  @endforeach
</div>
        </div>

        <!-- Button View All Careers -->
        <div class="careers-footer">
            <a class="careers-viewall" href="{{ route('careers') }}" aria-label="View all careers">
                <span class="careers-view">→ VIEW ALL CAREERS</span>
            </a>
        </div>
    </section>
@endsection

<script>
$(function () {
  var $slider = $('.hero-slider');
  if (!$slider.length) return;

  var $slides = $slider.find('.hero-section');
  var idx = $slides.index($slides.filter('.is-active'));
  if (idx < 0) idx = 0;

  // (opsional) buat dot nav
  var $dots = $('<div class="hero-dots" role="tablist" aria-label="Hero slides"></div>').appendTo($slider);
  $slides.each(function(i){
    $('<button type="button" class="dot" role="tab" aria-selected="'+(i===idx)+'" aria-label="Go to slide '+(i+1)+'"></button>')
      .on('click', function(){
        stopAuto();
        show(i);
      })
      .appendTo($dots);
  });

  function updateDots(i){
    $dots.find('.dot')
      .attr('aria-selected','false')
      .removeClass('is-active')
      .eq(i).attr('aria-selected','true').addClass('is-active');
  }

  function show(i){
    $slides
      .removeClass('is-active')
      .attr('aria-hidden','true')
      .eq(i)
      .addClass('is-active')
      .attr('aria-hidden','false');
    idx = i;
    updateDots(i);
  }

  function next(){ show((idx + 1) % $slides.length); }
  function prev(){ show((idx - 1 + $slides.length) % $slides.length); }

  // autoplay
  var interval = 6000, timer = null;
  function startAuto(){ if (!timer) timer = setInterval(next, interval); }
  function stopAuto(){ clearInterval(timer); timer = null; }

  startAuto();

  // pause saat hover / fokus
  $slider.on('mouseenter focusin', stopAuto)
         .on('mouseleave focusout', startAuto);

  // keyboard (opsional): panah kanan/kiri
  $(document).on('keydown', function(e){
    // hanya saat mouse di atas slider biar tidak ganggu halaman lain
    if (!$slider.is(':hover')) return;
    if (e.key === 'ArrowRight') { stopAuto(); next(); }
    if (e.key === 'ArrowLeft')  { stopAuto(); prev(); }
  });

  // inisialisasi state awal
  show(idx);
});
</script>