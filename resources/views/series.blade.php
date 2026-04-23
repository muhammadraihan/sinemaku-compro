@extends('layouts.app')

@section('title', 'Seri | Sinemaku Pictures')

@section('content')

@include('partials.navbar')

{{-- ============================================================
    HERO SLIDESHOW SECTION — Film Strip Model
    ============================================================ --}}
<section id="film-hero" class="relative w-full overflow-hidden bg-[#0a0a0a]" style="height: 100dvh; min-height: 560px;">

    {{-- ── Film Strip: all images side by side in a single wide row ── --}}
    @php 
      $heroItems = $genre->take(5);
      $totalHero = count($heroItems); 
    @endphp
    <div id="hero-strip"
         style="position: absolute; inset: 0; display: flex; width: {{ $totalHero * 100 }}%; height: 100%; transform: translateX(0); will-change: transform;">
        @foreach($heroItems as $i => $item)
            <div class="hero-slide-img"
                 style="position: relative; width: {{ 100 / $totalHero }}%; height: 100%; flex-shrink: 0; background-image: url('{{ asset('photo/' . $item->photo) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
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
            @foreach($heroItems as $i => $item)
                <div class="hero-slide-content text-left w-full"
                    style="position: absolute; left: 0; bottom: 0; transform: {{ $i === 0 ? 'translateX(0)' : 'translateX(100vw)' }}; pointer-events: {{ $i === 0 ? 'auto' : 'none' }};">
                    <h1 class="hero-film-title">
                        <a href="{{ route('detail-series', $item->slug) }}" class="no-underline text-inherit hover:opacity-80 transition-opacity">
                            {{ $item->title }}
                        </a>
                    </h1>
                    <div class="hero-film-meta">
                        <span>{{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}</span>
                        <span class="dot">•</span>
                        <span>{{ $item->genre }}</span>
                        @if($item->duration)
                        <span class="dot">•</span>
                        <span>{{ $item->duration }} Min</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── Slide Indicators (Bottom Right: 1/2/3/4/5) ── --}}
    <div class="hero-indicators-container absolute z-[20] flex items-baseline font-display font-bold select-none">
        @foreach($heroItems as $i => $item)
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

    {{-- ── Minimalist Nav Arrows (Desktop Only) ── --}}
    <div class="hero-nav-desktop absolute inset-y-0 inset-x-0 z-[15] pointer-events-none hidden md:flex items-center justify-between px-6 lg:px-10">
        <button id="hero-prev" class="pointer-events-auto group bg-transparent border-none p-4 cursor-pointer opacity-40 hover:opacity-100 transition-opacity" aria-label="Previous Slide">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" class="text-white transform group-hover:-translate-x-1 transition-transform"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button id="hero-next" class="pointer-events-auto group bg-transparent border-none p-4 cursor-pointer opacity-40 hover:opacity-100 transition-opacity" aria-label="Next Slide">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" class="text-white transform group-hover:translate-x-1 transition-transform"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
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
        .hero-nav-desktop {
            display: none !important;
        }
    }
</style>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const totalSlides = {{ $totalHero }};
        if (totalSlides === 0) return;

        const strip     = document.getElementById('hero-strip');
        const titles    = document.querySelectorAll('#film-hero .hero-slide-content');
        const indicators = document.querySelectorAll('#film-hero .slide-indicator');

        let current  = 0;
        let timer    = null;
        let busy     = false;

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

            prevTitle.style.transition = `transform 1.2s ${quintEase}`;
            prevTitle.style.transform  = `translateX(${-100 * direction}vw)`;
            prevTitle.style.pointerEvents = 'none';

            nextTitle.style.transition = 'none';
            nextTitle.style.transform  = `translateX(${100 * direction}vw)`;

            nextTitle.getBoundingClientRect();

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

            slideStripTo(current, direction);
            slideTitle(prev, current, direction);

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
            timer = setInterval(autoAdvance, 8000);
        }

        indicators.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.dataset.index, 10);
                if (idx === current || busy) return;
                goTo(idx);
                startTimer();
            });
        });

        const heroPrev = document.getElementById('hero-prev');
        const heroNext = document.getElementById('hero-next');

        if(heroPrev) {
            heroPrev.addEventListener('click', () => {
                if (busy) return;
                goTo((current - 1 + totalSlides) % totalSlides);
                startTimer();
            });
        }

        if(heroNext) {
            heroNext.addEventListener('click', () => {
                if (busy) return;
                goTo((current + 1) % totalSlides);
                startTimer();
            });
        }

        let lastScrollTime = 0;
        const scrollCooldown = 1500;

        function handleScrollIntent(delta) {
            const now = Date.now();
            if (now - lastScrollTime < scrollCooldown || busy) return false;

            if (delta > 30) {
                if (current < totalSlides - 1) {
                    goTo(current + 1);
                    lastScrollTime = now;
                    startTimer();
                    return true;
                }
            } else if (delta < -30) {
                if (current > 0) {
                    goTo(current - 1);
                    lastScrollTime = now;
                    startTimer();
                    return true;
                }
            }
            return false;
        }

        const heroElement = document.getElementById('film-hero');
        let touchStartY = 0;
        let isTouching = false;

        if(heroElement) {
            heroElement.addEventListener('touchstart', function(e) {
                if (window.scrollY <= 10) {
                    touchStartY = e.touches[0].clientY;
                    isTouching = true;
                } else {
                    isTouching = false;
                }
            }, { passive: true });

            heroElement.addEventListener('touchmove', function(e) {
                if (!isTouching) return;

                const touchEndY = e.touches[0].clientY;
                const deltaY = touchStartY - touchEndY;

                if (Math.abs(deltaY) < 10) return;

                if (current === totalSlides - 1 && deltaY > 0) {
                    isTouching = false;
                    return;
                }
                if (current === 0 && deltaY < 0) {
                    isTouching = false; 
                    return;
                }

                if (e.cancelable) e.preventDefault();
                handleScrollIntent(deltaY);
            }, { passive: false });
        }

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

  /* All Films Styling */
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

  /* Filter Chips */
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
    color: #111;
  }

  .chip.is-active {
    color: #111;
    font-weight: 700;
  }

  /* Carousel Sizing CSS */
  .films-carousel-track::-webkit-scrollbar { display: none; }
  
  .film-card {
    flex: 0 0 calc(25% - 18px);
  }
  @media (max-width: 1024px) {
    .film-card { flex: 0 0 calc(33.333% - 16px); }
  }
  @media (max-width: 768px) {
    .film-card { flex: 0 0 calc(50% - 12px); }
  }
  @media (max-width: 480px) {
    .film-card { flex: 0 0 calc(85%); }
  }

  @media (max-width: 680px) {
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
  }
</style>

{{-- ================== SECTION OUR SERIES ================== --}}
<section class="allfilms reveal">
  <div class="allfilms-head">
    <h2 class="allfilms-title"><span data-i18n="page_our_series">OUR SERIES</span></h2>

    <div class="allfilms-filters" role="tablist" aria-label="Filter series by genre">
      <button class="chip is-active" data-filter="all" role="tab" aria-selected="true">All</button>
      @foreach ($chipGenres as $g)
        <button class="chip" data-filter="{{ $g }}">{{ ucwords($g) }}</button>
      @endforeach
    </div>
  </div>

  <div class="films-carousel-wrap relative w-full mt-10">
    <div class="films-carousel-track flex gap-6 overflow-x-auto pb-5" id="our-films-track" style="scroll-snap-type: x mandatory; scrollbar-width: none; -webkit-overflow-scrolling: touch;">
      @foreach ($genre as $item)
        <article class="film-card flex flex-col no-underline shrink-0" data-genres='@json($item->genres_array)' style="scroll-snap-align: start;">
          <a href="{{ route('detail-series', $item->slug) }}" class="film-card__link block no-underline outline-none group text-inherit">
            <div class="film-card__poster w-full overflow-hidden bg-[#111] mb-4 flex items-center justify-center relative" style="aspect-ratio: 2/3;">
              <img src="{{ asset('photo/' . $item->poster) }}" alt="{{ $item->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105 block !m-0">
            </div>
            <h3 class="film-card__title font-display font-extrabold uppercase text-[15px] sm:text-[16px] text-gray-900 leading-[1.2] tracking-[-0.02em] m-0 !m-0">{{ $item->title }}</h3>
          </a>
        </article>
      @endforeach
    </div>

    <!-- Controls -->
    <div class="films-carousel-controls flex items-center justify-between mt-8">
      <button class="fc-nav-btn w-10 h-10 rounded-full border-none bg-transparent text-gray-400 flex items-center justify-center cursor-pointer transition-colors duration-300 hover:text-gray-900" aria-label="Previous" id="our-films-prev">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M15 18l-6-6 6-6"/></svg>
      </button>

      <div class="fc-dots flex gap-3 flex-wrap justify-center items-center" id="our-films-dots"></div>

      <button class="fc-nav-btn w-10 h-10 rounded-full border-none bg-transparent text-gray-400 flex items-center justify-center cursor-pointer transition-colors duration-300 hover:text-gray-900" aria-label="Next" id="our-films-next">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
  </div>
</section>

<script>
  (function () {
    const scope = document.querySelector('.allfilms') || document;
    const chips = scope.querySelectorAll('.chip');
    const cards = scope.querySelectorAll('.film-card');
    const track = document.getElementById('our-films-track');
    const prevBtn = document.getElementById('our-films-prev');
    const nextBtn = document.getElementById('our-films-next');
    const dotsWrap = document.getElementById('our-films-dots');

    function updateCarousel() {
        if (!track) return;
        const visibleCards = Array.from(cards).filter(c => c.style.display !== 'none');
        dotsWrap.innerHTML = '';
        
        if (visibleCards.length <= 1) {
            if(prevBtn) prevBtn.style.visibility = 'hidden';
            if(nextBtn) nextBtn.style.visibility = 'hidden';
            return;
        } else {
            if(prevBtn) prevBtn.style.visibility = 'visible';
            if(nextBtn) nextBtn.style.visibility = 'visible';
        }

        const cardWidth = visibleCards[0].offsetWidth + 24;
        const maxScroll = track.scrollWidth - track.clientWidth;
        const numSteps = Math.ceil(maxScroll / cardWidth) + 1;

        for (let i = 0; i < numSteps; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-1.5 h-1.5 rounded-full border-none p-0 cursor-pointer transition-all duration-300';
            dot.style.background = i === 0 ? '#111' : '#ddd';
            dot.addEventListener('click', () => {
                track.scrollTo({ left: i * cardWidth, behavior: 'smooth' });
            });
            dotsWrap.appendChild(dot);
        }

        const updateUI = () => {
            const scrollLeft = track.scrollLeft;
            if(prevBtn) prevBtn.style.opacity = scrollLeft <= 10 ? '0' : '1';
            if(nextBtn) nextBtn.style.opacity = scrollLeft >= maxScroll - 10 ? '0' : '1';
            
            let currentIndex = Math.round(scrollLeft / cardWidth);
            Array.from(dotsWrap.children).forEach((dot, i) => {
                const isActive = i === currentIndex;
                dot.style.background = isActive ? '#111' : '#ddd';
                dot.style.transform = isActive ? 'scale(1.2)' : 'scale(1)';
            });
        };

        track.addEventListener('scroll', updateUI, { passive: true });
        updateUI();
    }

    if(prevBtn) {
        prevBtn.addEventListener('click', () => {
            const visibleCards = Array.from(cards).filter(c => c.style.display !== 'none');
            if(!visibleCards.length) return;
            const cardWidth = visibleCards[0].offsetWidth + 24;
            track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
        });
    }

    if(nextBtn) {
        nextBtn.addEventListener('click', () => {
            const visibleCards = Array.from(cards).filter(c => c.style.display !== 'none');
            if(!visibleCards.length) return;
            const cardWidth = visibleCards[0].offsetWidth + 24;
            track.scrollBy({ left: cardWidth, behavior: 'smooth' });
        });
    }

    function setActive(btn) {
      chips.forEach(c => {
        const on = c === btn;
        c.classList.toggle('is-active', on);
        c.setAttribute('aria-selected', on ? 'true' : 'false');
      });
    }

    function applyFilter(key) {
      cards.forEach(card => {
        let genres = [];
        try { genres = JSON.parse(card.dataset.genres || '[]'); } catch (e) { }
        const match = (key === 'all') ? true : genres.includes(key);
        card.style.display = match ? 'flex' : 'none';
      });
      if(track) track.scrollTo({ left: 0 });
      setTimeout(updateCarousel, 50);
    }

    chips.forEach(btn => {
      btn.addEventListener('click', () => {
        const key = (btn.dataset.filter || '').toLowerCase();
        setActive(btn);
        applyFilter(key);
      });
      btn.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
      });
    });

    const first = scope.querySelector('.chip.is-active') || chips[0];
    if (first) {
      setActive(first);
      applyFilter((first.dataset.filter || '').toLowerCase());
    }
  })();

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
</script>

@include('components.footer')
@endsection