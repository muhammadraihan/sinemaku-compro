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

                    <div class="_01-04">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }} - {{ $total }}</div>

                    <h1 class="bolehkah-sekali-saja-ku-menangis">
                        <span>{{ $h->title }}</span><br />
                    </h1>
                </div>
            </section>
        @endforeach
    </div>

    {{-- ================== FEATURED MOVIE / SLIDER ================== --}}
    <section class="section-coming-soon" aria-labelledby="coming-soon-title">
        <div class="coming-soon-header">
            <h2 id="coming-soon-title" class="coming-soon-title">COMING SOON</h2>

            <div class="coming-soon-controls" role="group" aria-label="Slider controls">
                <button class="slider-btn prev" type="button" aria-label="Previous">
                    <span class="icon" aria-hidden="true">&#8592;</span>
                </button>
                <button class="slider-btn next" type="button" aria-label="Next">
                    <span class="icon" aria-hidden="true">&#8594;</span>
                </button>
            </div>
        </div>

        <div class="coming-soon-slider" role="list">
            <!-- Slide 1 -->
            <article class="coming-soon-slide" role="listitem">
                <div class="coming-soon-image-wrapper">
                    <img
                        src="{{ asset('img/temp-imagen-cx-lql-10.png') }}"
                        alt="Bolehkah Sekali Saja Ku Menangis poster"
                        class="coming-soon-image"
                        loading="lazy"
                    />
                    <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                </div>
                <h3 class="coming-soon-caption">Bolehkah Sekali Saja Ku Menangis</h3>
            </article>

            <!-- Slide 2 -->
            <article class="coming-soon-slide" role="listitem">
                <div class="coming-soon-image-wrapper">
                    <img
                        src="{{ asset('img/temp-imagen-cx-lql-10.png') }}"
                        alt="Bolehkah Sekali Saja Ku Menangis poster"
                        class="coming-soon-image"
                        loading="lazy"
                    />
                    <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                </div>
                <h3 class="coming-soon-caption">Bolehkah Sekali Saja Ku Menangis</h3>
            </article>

            <!-- Slide 3 -->
            <article class="coming-soon-slide" role="listitem">
                <div class="coming-soon-image-wrapper">
                    <img
                        src="{{ asset('img/temp-imagen-cx-lql-10.png') }}"
                        alt="Bolehkah Sekali Saja Ku Menangis poster"
                        class="coming-soon-image"
                        loading="lazy"
                    />
                    <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                </div>
                <h3 class="coming-soon-caption">Bolehkah Sekali Saja Ku Menangis</h3>
            </article>
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
                            <span class="cta-label">LISTEN NOW</span>
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
                            <span class="cta-label">LISTEN NOW</span>
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
                src="{{ asset('img/temp-imagehc-vht-6-10.png') }}"
                alt="Bolehkah Sekali Saja Ku Menangis still"
                loading="lazy"
            />
            <div class="spotlight__overlay" aria-hidden="true"></div>

            <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">Bolehkah Sekali Saja Ku Menangis</h2>
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
            <!-- Featured Article -->
            @foreach ($article as $item)
                @if($item->kategori == 'external')
                    <article class="article-featured">
                        <a href="{{ $item->link }}">
                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" />
                            <div class="article-featured-text">
                                <h3>{{ $item->judul }}</h3>
                                <p>
                                    {{ $item->title }}
                                </p>
                            </div>
                        </a>
                    </article>
                @else
                    <article class="article-featured">
                        <a href="{{ route('detail-articles', $item->uuid) }}">
                            <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" />
                            <div class="article-featured-text">
                                <h3>{{ $item->judul }}</h3>
                                <p>
                                    {{ $item->title }}
                                </p>
                            </div>
                        </a>
                    </article>
                @endif
            @endforeach

            <!-- List Articles -->
            @foreach ($all_article as $item)
                @if($item->kategori == 'external')
                <a href="{{ $item->link }}">
                    <div class="article-list" role="list">
                        <article class="article-item" role="listitem">
                                <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" />
                                <div>
                                    <h4>{{ $item->judul }}</h4>
                                    <span class="date">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                        </article>
                    </div>
                </a>
                @else
                <a href="{{ route('detail-articles', $item->uuid) }}">
                    <div class="article-list" role="list">
                        <article class="article-item" role="listitem">
                                <img src="{{ asset('photo/' . $item->photo) }}" alt="{{ $item->judul }}" loading="lazy" />
                                <div>
                                    <h4>{{ $item->judul }}</h4>
                                    <span class="date">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                        </article>
                    </div>
                </a>
                @endif
            @endforeach
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
            <a href="{{ route('membership') }}">
                <button class="join-member-btn" type="button" aria-label="Join now">JOIN NOW — IT'S FREE →</button>
            </a>
        </div>
    </section>

    {{-- ================== SPOTLIGHT 2 ================== --}}
    <section class="spotlight" aria-label="Spotlight">
        <div class="spotlight__frame">
            <img
                class="spotlight__image"
                src="{{ asset('img/hndd.jpg') }}"
                alt="HNDD still"
                loading="lazy"
            />
            <div class="spotlight__overlay" aria-hidden="true"></div>

            <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">HNDD</h2>
            </div>
        </div>
    </section>

    {{-- ================== CAREERS ================== --}}
    <section class="careers-section" id="careers" aria-labelledby="careers-title">
        <div class="careers-wrap">
            <header class="careers-header">
                <h2 class="careers-title" id="careers-title">Join Our Vision</h2>
                <p class="careers-subtitle">
                    We're looking for passionate creators who share our commitment to bold storytelling.
                </p>
            </header>

            <div class="careers-grid" role="list">
                <!-- Card -->
                @foreach ($careers as $item)
                    <article class="career-card" role="listitem">
                        <h3 class="career-role">{{ $item->position }}</h3>
                        <div class="career-dept">{{ $item->tim }}</div>
                        <div class="career-meta">
                            <span class="career-loc">
                                <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                    <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                                </svg>
                                {{ $item->location }}
                            </span>
                        </div>
                        <button class="career-apply" type="button">APPLY</button>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Button View All Careers -->
        <div class="careers-footer">
            <a class="careers-viewall" href="{{ route('careers') }}" aria-label="View all careers">
                <span class="careers-view">VIEW ALL CAREERS →</span>
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
