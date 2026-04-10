@extends('layouts.app')

@section('content')

    @php
        $slides = $films->take(5);
        $first = $slides->first();
    @endphp

    {{-- ============================================================
    SIDEBAR MENU (slides in from left)
    ============================================================ --}}
    <div id="sidebar-menu"
        class="fixed top-0 left-0 w-[300px] md:w-[380px] h-full bg-[#0a0a0a] z-[200] flex flex-col justify-center px-10 md:px-14 border-r border-white/10 pt-20 transform -translate-x-full">
        @php
            $menuItems = [
                ['title' => 'About', 'url' => '/about'],
                ['title' => 'Film', 'url' => '/movies'],
                ['title' => 'Serial Web', 'url' => '/serial'],
                ['title' => 'Televisi', 'url' => '/tv'],
                ['title' => 'Dokumenter', 'url' => '/documentary'],
                ['title' => 'Events', 'url' => '/events'],
                ['title' => 'Merch', 'url' => '/shop'],
                ['title' => 'Komunitas', 'url' => '/community'],
                ['title' => 'Artikel', 'url' => '/articles'],
                ['title' => 'Karir', 'url' => '/jobs'],
            ];
        @endphp
        <div class="flex flex-col space-y-4 text-left font-display font-medium text-3xl text-white">
            @foreach($menuItems as $item)
                <a href="{{ $item['url'] }}"
                    class="menu-link opacity-0 -translate-x-8 hover:text-white/40 transition-colors duration-300">
                    {{ $item['title'] }}
                </a>
            @endforeach
        </div>
        <div
            class="mt-16 flex space-x-6 opacity-0 menu-socials items-center text-white/50 text-[10px] tracking-widest uppercase">
            <a href="#" class="hover:text-white transition-colors">IG</a>
            <a href="#" class="hover:text-white transition-colors">X</a>
            <a href="#" class="hover:text-white transition-colors">YT</a>
        </div>
    </div>

    {{-- Sidebar Backdrop --}}
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-[199] opacity-0 pointer-events-none"></div>


    {{-- ============================================================
    TOP NAV BAR
    ============================================================ --}}
    <div class="fixed top-0 left-0 w-full h-[140px] z-[290] pointer-events-none"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 40%, transparent 100%);"></div>

    <nav class="fixed top-0 left-0 w-full z-[300]
                        flex justify-between items-center
                        px-6 md:px-12 py-8">

        {{-- Hamburger Button (Left) --}}
        <button id="menu-open-btn" class="flex flex-col items-start justify-center gap-1.5 group
                               text-white hover:opacity-75 transition-opacity cursor-pointer">
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
            <span class="block w-6 h-[1.5px] bg-white transition-all duration-300"></span>
        </button>

        {{-- Center: Brand --}}
        <a href="/" class="absolute left-1/2 -translate-x-1/2
                                    text-white text-xs md:text-sm
                                    tracking-[0.3em] uppercase font-light
                                    whitespace-nowrap transition-opacity hover:opacity-80">
            sinemaku pictures
        </a>

        {{-- Right: Get in Touch --}}
        <a href="#get-in-touch" class="text-[10px] md:text-xs tracking-widest uppercase text-white
                          border border-white/40 px-5 py-2.5 rounded-full
                          hover:bg-white hover:text-black transition-colors duration-300
                          inline-flex items-center">
            get in touch
        </a>
    </nav>


    {{-- ============================================================
    HERO SECTION
    ============================================================ --}}
    <section id="hero" class="relative w-full overflow-hidden bg-[#0a0a0a]" style="height: 100dvh; min-height: 560px;">

        {{-- ── Background layers (one per film) ── --}}
        @php
            $fallbacks = [
                'from-[#1c1c2e] via-[#16213e] to-[#0f3460]',
                'from-[#1a1a1a] via-[#2d1b33] to-[#0d0d0d]',
                'from-[#0d1b2a] via-[#1b2a3b] to-[#112233]',
                'from-[#1a0a0a] via-[#2d1010] to-[#0d0505]',
                'from-[#0a1a0a] via-[#1a2d1a] to-[#050d05]',
            ];
        @endphp
        <div class="absolute inset-0 z-0">
            @foreach($slides as $i => $film)
                <div class="hero-bg absolute inset-0 w-full h-full"
                     data-index="{{ $i }}"
                     style="opacity: {{ $i === 0 ? '1' : '0' }}; 
                            filter: {{ $i === 0 ? 'blur(0)' : 'blur(8px)' }};
                            transition: opacity 600ms ease, filter 600ms ease;">
                    
                    {{-- The actual background image --}}
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                         style="background-image: url('{{ asset('photo/' . $film->photo) }}');">
                    </div>

                    {{-- Dark overlay for legibility --}}
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>
            @endforeach
        </div>

        {{-- ── Cinematic vignette (bottom fade) ── --}}
        <div class="absolute inset-0 z-[1] pointer-events-none"
            style="background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 45%, transparent 70%);">
        </div>


        {{-- ── Film list (bottom-left) ── --}}
        <div class="absolute inset-x-0 bottom-0 z-[5] pointer-events-none"
            style="height: 55%; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);">
        </div>

        <div class="absolute z-[10]
                            bottom-10 left-6
                            md:bottom-12 md:left-10
                            lg:left-14">

            <ul id="film-list" class="list-none m-0 p-0">
                @foreach($slides as $i => $film)
                    @php
                        $year = \Carbon\Carbon::parse($film->release_date)->format('Y');
                    @endphp
                    <li class="film-item flex items-baseline cursor-pointer select-none {{ $i === 0 ? 'is-active' : '' }}"
                        data-index="{{ $i }}"
                        style="padding: 3px 0; gap: 0.75rem;">

                        {{-- Film Title --}}
                        <span class="film-title font-display font-medium tracking-tight text-white">
                            {{ $film->title }}
                        </span>

                        {{-- Year badge --}}
                        <span class="film-year font-light tracking-wider shrink-0 text-white"
                              style="font-size: 0.625rem;
                                     opacity: {{ $i === 0 ? '0.6' : '0' }};
                                     transition: opacity 0.4s ease;">
                            {{ $year }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- ── Scroll down indicator (bottom-right) ── --}}
        <div class="absolute bottom-10 right-8 md:right-12 z-[10] hidden md:flex flex-col items-center gap-2">
            <div class="w-[1px] h-12 bg-white/20 relative overflow-hidden">
                <div id="scroll-line" class="absolute top-0 w-full bg-white/60"
                    style="height: 40%; animation: scrollDown 2s ease-in-out infinite;"></div>
            </div>
            <span class="text-white/30 text-[9px] tracking-[0.2em] uppercase"
                style="writing-mode: vertical-lr">scroll</span>
        </div>

    </section>


    {{-- ============================================================
    CONTENT SECTIONS — 7 editorial sections, white bg
    ============================================================ --}}

    {{-- ── 1. EVENTS ── --}}
    <section class="section-feature bg-white border-b border-neutral-100" data-section="events">
        @if($latestEvent)
        <div class="feature-inner reverse">
            <div class="feature-image-wrap">
                <img src="{{ asset('photo/' . $latestEvent->photo) }}"
                     alt="{{ $latestEvent->judul }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Upcoming Events</span>
                <h2 class="feature-title">{{ $latestEvent->judul }}</h2>
                <div class="feature-meta-row">
                    <span class="feature-meta-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5"/></svg>
                        {{ \Carbon\Carbon::parse($latestEvent->tgl_event)->locale('id')->isoFormat('D MMMM YYYY') }} · {{ $latestEvent->jam_event }}
                    </span>
                    <span class="feature-meta-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        {{ $latestEvent->location }}
                    </span>
                </div>
                <p class="feature-excerpt">{{ $latestEvent->title }}</p>
                @if($latestEvent->harga)
                <p class="feature-price">Rp {{ number_format($latestEvent->harga, 0, ',', '.') }}</p>
                @endif
                <a href="{{ $latestEvent->link ?? '#' }}" target="_blank" class="feature-cta">
                    Dapatkan Tiket
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 2. FILM ── --}}
    <section class="section-feature bg-white border-b border-neutral-100" data-section="film">
        @if($latestFilm)
        @php $filmYear = \Carbon\Carbon::parse($latestFilm->release_date)->format('Y'); @endphp
        <div class="feature-inner">
            <div class="feature-image-wrap">
                <img src="{{ asset('photo/' . $latestFilm->photo) }}"
                     alt="{{ $latestFilm->title }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
                <span class="feature-badge">{{ $latestFilm->genre }}</span>
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Film Terbaru</span>
                <h2 class="feature-title">{{ $latestFilm->title }}</h2>
                <div class="feature-meta-row">
                    <span class="feature-meta-pill">{{ $filmYear }}</span>
                    @if($latestFilm->duration)
                    <span class="feature-meta-pill">{{ $latestFilm->duration }} menit</span>
                    @endif
                    @if($latestFilm->director)
                    <span class="feature-meta-pill">Sutradara: {{ $latestFilm->director }}</span>
                    @endif
                </div>
                <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestFilm->sinopsis), ENT_QUOTES | ENT_HTML5), 180) }}</p>
                <a href="/movies" class="feature-cta">
                    Lihat Semua Film
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 3. MERCH ── --}}
    <section class="section-feature bg-[#fafafa] border-b border-neutral-100" data-section="merch">
        @if($latestMerch)
        <div class="feature-inner reverse">
            <div class="feature-image-wrap feature-image-square">
                <img src="{{ asset('photo/' . $latestMerch->photo) }}"
                     alt="{{ $latestMerch->judul }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Sinemaku Store</span>
                <h2 class="feature-title">{{ $latestMerch->judul }}</h2>
                <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestMerch->detail), ENT_QUOTES | ENT_HTML5), 160) }}</p>
                <div class="feature-price-row">
                    @if($latestMerch->discount)
                    <span class="feature-price-original">Rp {{ number_format($latestMerch->harga, 0, ',', '.') }}</span>
                    <span class="feature-price feature-price-discount">Rp {{ number_format($latestMerch->harga - ($latestMerch->harga * $latestMerch->discount / 100), 0, ',', '.') }}</span>
                    <span class="feature-discount-badge">-{{ $latestMerch->discount }}%</span>
                    @else
                    <span class="feature-price">Rp {{ number_format($latestMerch->harga, 0, ',', '.') }}</span>
                    @endif
                </div>
                <a href="{{ $latestMerch->link ?? '/shop' }}" target="_blank" class="feature-cta">
                    Beli Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 4. SERIAL ── --}}
    <section class="section-feature bg-white border-b border-neutral-100" data-section="serial">
        @if($latestSerial)
        @php $serialYear = \Carbon\Carbon::parse($latestSerial->release_date)->format('Y'); @endphp
        <div class="feature-inner">
            <div class="feature-image-wrap">
                <img src="{{ asset('photo/' . $latestSerial->photo) }}"
                     alt="{{ $latestSerial->title }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
                @if($latestSerial->episode)
                <span class="feature-badge">{{ $latestSerial->episode }} Episode</span>
                @endif
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Serial Web</span>
                <h2 class="feature-title">{{ $latestSerial->title }}</h2>
                <div class="feature-meta-row">
                    <span class="feature-meta-pill">{{ $serialYear }}</span>
                    @if($latestSerial->season)
                    <span class="feature-meta-pill">Season {{ $latestSerial->season }}</span>
                    @endif
                    @if($latestSerial->director)
                    <span class="feature-meta-pill">{{ $latestSerial->director }}</span>
                    @endif
                </div>
                <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestSerial->sinopsis), ENT_QUOTES | ENT_HTML5), 180) }}</p>
                <a href="/serial" class="feature-cta">
                    Lihat Serial Lainnya
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 5. ARTIKEL ── --}}
    <section class="section-feature bg-[#fafafa] border-b border-neutral-100" data-section="artikel">
        @if($latestArtikel)
        <div class="feature-inner reverse">
            <div class="feature-image-wrap feature-image-wide">
                <img src="{{ asset('photo/' . $latestArtikel->photo) }}"
                     alt="{{ $latestArtikel->judul }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Artikel Terbaru</span>
                <h2 class="feature-title">{{ $latestArtikel->judul }}</h2>
                <div class="feature-meta-row">
                    @if($latestArtikel->penulis)
                    <span class="feature-meta-pill">Oleh {{ $latestArtikel->penulis }}</span>
                    @endif
                    @if($latestArtikel->tgl_rilis)
                    <span class="feature-meta-pill">{{ \Carbon\Carbon::parse($latestArtikel->tgl_rilis)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                    @endif
                </div>
                <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestArtikel->detail), ENT_QUOTES | ENT_HTML5), 200) }}</p>
                <a href="/articles" class="feature-cta">
                    Baca Artikel Lainnya
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 6. TELEVISI ── --}}
    <section class="section-feature bg-white border-b border-neutral-100" data-section="televisi">
        @if($latestTvShow)
        @php $tvYear = \Carbon\Carbon::parse($latestTvShow->release_date)->format('Y'); @endphp
        <div class="feature-inner">
            <div class="feature-image-wrap">
                <img src="{{ asset('photo/' . $latestTvShow->photo) }}"
                     alt="{{ $latestTvShow->title }}"
                     class="feature-img" loading="lazy">
                <div class="feature-img-overlay"></div>
            </div>
            <div class="feature-content-wrap" data-gsap="fade-up">
                <span class="feature-eyebrow">Tayangan Televisi</span>
                <h2 class="feature-title">{{ $latestTvShow->title }}</h2>
                <div class="feature-meta-row">
                    <span class="feature-meta-pill">{{ $tvYear }}</span>
                    @if($latestTvShow->episode)
                    <span class="feature-meta-pill">{{ $latestTvShow->episode }} Episode</span>
                    @endif
                    @if($latestTvShow->director)
                    <span class="feature-meta-pill">{{ $latestTvShow->director }}</span>
                    @endif
                </div>
                <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestTvShow->sinopsis), ENT_QUOTES | ENT_HTML5), 180) }}</p>
                <a href="/tv" class="feature-cta">
                    Lihat Tayangan Lainnya
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 7. KOMUNITAS (Static Editorial) ── --}}
    <section class="section-komunitas bg-[#0a0a0a]" data-section="komunitas">
        <div class="komunitas-inner" data-gsap="fade-up">
            <span class="feature-eyebrow" style="color: rgba(255,255,255,0.4);">Komunitas</span>
            <h2 class="komunitas-title">Bergabunglah dengan<br>komunitas sineas kami.</h2>
            <p class="komunitas-excerpt">
                Sinemaku Pictures adalah rumah bagi para sineas, penonton setia, dan pecinta cerita.
                Bergabunglah dalam forum diskusi, nonton bareng, dan workshop eksklusif bersama kami.
            </p>
            <div class="komunitas-pillars">
                @php
                    $pillars = [
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>', 'label' => 'Forum Diskusi', 'desc' => 'Berbagi pendapat & ulasan film'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375m1.875-12.75c0-.621-.504-1.125-1.125-1.125H5.625c-.621 0-1.125.504-1.125 1.125m13.5 0v1.5c0 .621-.504 1.125-1.125 1.125M6 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h9.75m-9.75 0a1.125 1.125 0 0 0-1.125 1.125M7.125 8.25h9.75a1.125 1.125 0 0 1 1.125 1.125m0 0v1.5m-1.125-1.125a1.125 1.125 0 0 0-1.125 1.125M7.125 8.25a1.125 1.125 0 0 1 1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125"/></svg>', 'label' => 'Nonton Bareng', 'desc' => 'Screening eksklusif & premier'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>', 'label' => 'Workshop', 'desc' => 'Belajar langsung dari sineas'],
                    ];
                @endphp
                @foreach($pillars as $p)
                <div class="komunitas-pillar">
                    <div class="komunitas-pillar-icon">{!! $p['icon'] !!}</div>
                    <div>
                        <p class="komunitas-pillar-label">{{ $p['label'] }}</p>
                        <p class="komunitas-pillar-desc">{{ $p['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="/community" class="komunitas-cta">
                Gabung Komunitas
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
            </a>
        </div>
    </section>


    {{-- Footer --}}
    @include('components.footer')


    {{-- ============================================================
    STYLES
    ============================================================ --}}
    <style>
        /* ── Scroll indicator ── */
        @keyframes scrollDown {
            0%   { top: -40%; }
            100% { top: 140%; }
        }

        /* ── Sidebar backdrop ── */
        #sidebar-backdrop { transition: opacity 0.4s ease; }
        #sidebar-backdrop.open { opacity: 1; pointer-events: auto; }

        /* ─────────────────────────────────────────────
           HERO — background crossfade with blur
        ───────────────────────────────────────────── */
        .hero-bg {
            /* GPU layer — smooth compositing */
            will-change: opacity, filter;
            transition: opacity 600ms ease, filter 600ms ease;
        }

        /* ─────────────────────────────────────────────
           HERO — film title states
        ───────────────────────────────────────────── */
        .film-title {
            display: block;
            font-size: clamp(1.18rem, 3.04vw, 2.66rem);
            line-height: 1.05;
            color: rgba(255, 255, 255, 0.5);
            opacity: 1; /* opacity carried by color/transform now */
            transition:
                font-size   400ms cubic-bezier(0.4,0,0.2,1),
                color       400ms cubic-bezier(0.4,0,0.2,1),
                transform   400ms cubic-bezier(0.4,0,0.2,1);
            transform: translateX(-4px);
        }

        .film-item.is-active .film-title {
            font-size: clamp(1.25rem, 3.2vw, 2.8rem);
            color: rgba(255, 255, 255, 1);
            transform: translateX(0);
        }

        /* On hover (desktop only), preview the active state */
        @media (hover: hover) {
            .film-item:hover .film-title {
                color: rgba(255, 255, 255, 0.85);
                transform: translateX(0);
            }
        }

        /* Mobile: slightly larger base */
        @media (max-width: 767px) {
            .film-title {
                font-size: clamp(1.33rem, 7.12vw, 2.09rem);
            }
            .film-item.is-active .film-title {
                font-size: clamp(1.4rem, 7.5vw, 2.2rem);
            }
            .film-item { padding: 3px 0; }
        }

        /* ─────────────────────────────────────────────
           SECTION FEATURE — shared layout
        ───────────────────────────────────────────── */
        .section-feature {
            padding: 0;
            overflow: hidden;
        }

        .feature-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 560px;
        }

        /* Reverse: image on the right (use order) */
        .feature-inner.reverse .feature-image-wrap {
            order: 2;
        }
        .feature-inner.reverse .feature-content-wrap {
            order: 1;
        }

        /* Stack on mobile */
        @media (max-width: 767px) {
            .feature-inner,
            .feature-inner.reverse {
                grid-template-columns: 1fr;
                min-height: auto;
            }
            .feature-inner.reverse .feature-image-wrap,
            .feature-inner.reverse .feature-content-wrap {
                order: unset;
            }
        }

        /* ── Image side ── */
        .feature-image-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: #e5e7eb;
        }

        @media (min-width: 768px) {
            .feature-image-wrap {
                aspect-ratio: auto;
                min-height: 560px;
            }
        }

        .feature-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 700ms cubic-bezier(0.4,0,0.2,1);
            display: block;
        }

        .section-feature:hover .feature-img {
            transform: scale(1.04);
        }

        .feature-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        /* ── Badge on image ── */
        .feature-badge {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(10,10,10,0.85);
            color: rgba(255,255,255,0.9);
            font-size: 10px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 5px 12px;
            font-weight: 500;
        }

        /* ── Content side ── */
        .feature-content-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 3rem 4rem 4rem;
            background: #ffffff;
        }

        @media (max-width: 1024px) {
            .feature-content-wrap { padding: 3rem 2rem; }
        }

        @media (max-width: 767px) {
            .feature-content-wrap {
                padding: 2.5rem 1.5rem;
                max-width: 100%;
            }
        }

        /* ── Eyebrow ── */
        .feature-eyebrow {
            display: block;
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #9ca3af;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        /* ── Title ── */
        .feature-title {
            font-size: clamp(1.75rem, 3vw, 2.75rem);
            font-weight: 500;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: #0a0a0a;
            margin-bottom: 1.25rem;
        }

        /* ── Meta pills row ── */
        .feature-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 1.25rem;
        }

        .feature-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #6b7280;
            background: #f3f4f6;
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 400;
        }

        .feature-meta-pill svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
        }

        /* ── Excerpt ── */
        .feature-excerpt {
            font-size: 0.9rem;
            line-height: 1.7;
            color: #6b7280;
            margin-bottom: 1.75rem;
        }

        /* ── Price ── */
        .feature-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0a0a0a;
            margin-bottom: 1.5rem;
        }

        .feature-price-row {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .feature-price-original {
            font-size: 0.9rem;
            color: #9ca3af;
            text-decoration: line-through;
        }

        .feature-price-discount {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0a0a0a;
            margin-bottom: 0;
        }

        .feature-discount-badge {
            font-size: 10px;
            background: #0a0a0a;
            color: #fff;
            padding: 2px 8px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        /* ── CTA link ── */
        .feature-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 500;
            color: #0a0a0a;
            border-bottom: 1px solid #0a0a0a;
            padding-bottom: 2px;
            transition: color 300ms ease, border-color 300ms ease, gap 300ms ease;
            text-decoration: none;
            width: fit-content;
        }

        .feature-cta:hover {
            color: #6b7280;
            border-color: #9ca3af;
            gap: 14px;
        }

        .feature-cta svg {
            width: 14px;
            height: 14px;
            transition: transform 300ms ease;
        }

        .feature-cta:hover svg {
            transform: translateX(4px);
        }

        /* ─────────────────────────────────────────────
           KOMUNITAS section (dark)
        ───────────────────────────────────────────── */
        .section-komunitas {
            padding: 6rem 2rem;
        }

        .komunitas-inner {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .komunitas-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 500;
            line-height: 1.1;
            letter-spacing: -0.025em;
            color: #ffffff;
            margin-bottom: 1.25rem;
        }

        .komunitas-excerpt {
            font-size: 0.95rem;
            line-height: 1.75;
            color: rgba(255,255,255,0.45);
            max-width: 540px;
            margin: 0 auto 3rem;
        }

        .komunitas-pillars {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .komunitas-pillar {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
            max-width: 200px;
        }

        .komunitas-pillar-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            color: rgba(255,255,255,0.6);
            margin-top: 2px;
        }

        .komunitas-pillar-icon svg {
            width: 100%;
            height: 100%;
        }

        .komunitas-pillar-label {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
            margin-bottom: 4px;
        }

        .komunitas-pillar-desc {
            font-size: 12px;
            color: rgba(255,255,255,0.4);
            line-height: 1.5;
        }

        .komunitas-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 500;
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 14px 28px;
            border-radius: 999px;
            transition: background 300ms ease, color 300ms ease, gap 300ms ease;
            text-decoration: none;
        }

        .komunitas-cta:hover {
            background: #ffffff;
            color: #0a0a0a;
            gap: 16px;
        }

        .komunitas-cta svg {
            width: 14px;
            height: 14px;
            transition: transform 300ms ease;
        }

        .komunitas-cta:hover svg {
            transform: translateX(4px);
        }
    </style>

@endsection


{{-- ============================================================
SCRIPTS
============================================================ --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* ─────────────────────────────────────────
               1. SIDEBAR MENU
            ───────────────────────────────────────── */
            const sidebar   = document.getElementById('sidebar-menu');
            const backdrop  = document.getElementById('sidebar-backdrop');
            const openBtn   = document.getElementById('menu-open-btn');
            const menuLinks = document.querySelectorAll('.menu-link');
            const menuSocials = document.querySelector('.menu-socials');
            let menuOpen = false;

            function openMenu() {
                menuOpen = true;
                backdrop.classList.add('open');
                document.body.style.overflow = 'hidden';
                gsap.to(sidebar, { x: 0, duration: 0.8, ease: "power4.out" });
                gsap.to(menuLinks, { x: 0, opacity: 1, duration: 0.6, stagger: 0.05, ease: "power3.out", delay: 0.2 });
                gsap.to(menuSocials, { opacity: 1, duration: 0.6, delay: 0.5 });
            }

            function closeMenu() {
                menuOpen = false;
                backdrop.classList.remove('open');
                document.body.style.overflow = '';
                gsap.to(menuSocials, { opacity: 0, duration: 0.3 });
                gsap.to(menuLinks, { x: -20, opacity: 0, duration: 0.3, stagger: -0.05, ease: "power3.in" });
                gsap.to(sidebar, { x: "-100%", duration: 0.8, ease: "power4.inOut", delay: 0.1 });
            }

            openBtn.addEventListener('click', () => menuOpen ? closeMenu() : openMenu());
            backdrop.addEventListener('click', closeMenu);
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });


            /* ─────────────────────────────────────────
               2. HERO — blur-crossfade background switcher
            ───────────────────────────────────────── */
            const filmItems  = document.querySelectorAll('.film-item');
            const heroBgs    = document.querySelectorAll('.hero-bg');
            const filmYears  = document.querySelectorAll('.film-year');
            let activeIdx = 0;

            function activateFilm(idx) {
                if (idx === activeIdx) return;

                // — Background: blur-out current, blur-in next —
                heroBgs.forEach((bg, i) => {
                    if (i === idx) {
                        // Incoming: start blurred, transition to sharp
                        bg.style.opacity = '1';
                        bg.style.filter  = 'blur(0px) brightness(1)';
                    } else {
                        // Outgoing: fade + blur
                        bg.style.opacity = '0';
                        bg.style.filter  = 'blur(8px) brightness(0.6)';
                    }
                });

                // — Film title: toggle is-active class for CSS transitions —
                filmItems.forEach((item, i) => {
                    item.classList.toggle('is-active', i === idx);
                });

                // — Year badge —
                filmYears.forEach((y, i) => {
                    y.style.opacity = (i === idx) ? '0.6' : '0';
                });

                activeIdx = idx;
            }

            // Desktop: hover
            filmItems.forEach((item, idx) => {
                item.addEventListener('mouseenter', () => activateFilm(idx));
            });

            // Mobile: tap
            filmItems.forEach((item, idx) => {
                item.addEventListener('touchstart', (e) => {
                    e.preventDefault();
                    activateFilm(idx);
                }, { passive: false });
            });


            /* ─────────────────────────────────────────
               3. GSAP ScrollTrigger — section reveals
            ───────────────────────────────────────── */
            function initScrollAnimations() {
                if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
                gsap.registerPlugin(ScrollTrigger);

                document.querySelectorAll('[data-gsap="fade-up"]').forEach(el => {
                    gsap.fromTo(el,
                        { y: 40, opacity: 0 },
                        {
                            y: 0, opacity: 1,
                            duration: 0.9,
                            ease: 'power3.out',
                            scrollTrigger: { trigger: el, start: 'top 88%' }
                        }
                    );
                });
            }

            if (typeof ScrollTrigger !== 'undefined') {
                initScrollAnimations();
            } else {
                setTimeout(initScrollAnimations, 300);
            }

        });
    </script>
@endpush