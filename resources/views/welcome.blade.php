@extends('layouts.app')

@section('content')

    @php
        $slides = $films->take(5);
        $first = $slides->first();
    @endphp

    @include('partials.navbar')



    {{-- ============================================================
    HERO SECTION
    ============================================================ --}}
    <section id="hero" class="relative w-full overflow-hidden bg-[#0a0a0a]" style="height: 100dvh; min-height: 560px;">

        {{-- ── Background layers (one per film) ── --}}
        @php
            $fallbacks = [
                'from-[#0b0a1a] via-[#1a1640] to-[#26225e]',
                'from-[#0b0a1a] via-[#221d55] to-[#120f2d]',
                'from-[#0b0a1a] via-[#1a1640] to-[#332c80]',
                'from-[#120f2d] via-[#221d55] to-[#0b0a1a]',
                'from-[#0b0a1a] via-[#26225e] to-[#1a1640]',
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

        <div id="hero-content-wrapper" class="absolute z-[10]
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
                            <a href="{{ route('detail-film', $film->slug) }}" style="text-decoration: none; color: inherit;">{{ $film->title }}</a>
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

        {{-- ── Mobile Slide Indicator (bottom-right) ── --}}
        <div id="mobile-slide-indicator" class="absolute z-[10] bottom-10 right-6 text-white text-xs tracking-widest font-light md:hidden">
            <span id="current-slide">1</span> / {{ count($slides) }}
        </div>

        {{-- ── Scroll down indicator (bottom-right) ── --}}
        <div class="absolute bottom-10 right-8 md:right-12 z-[10] hidden md:flex flex-col items-center gap-2">
            <div class="w-[1px] h-12 relative overflow-hidden" style="background: rgba(237,149,32,0.2);">
                <div id="scroll-line" class="absolute top-0 w-full"
                    style="height: 40%; background: rgba(237,149,32,0.75); animation: scrollDown 2s ease-in-out infinite;"></div>
            </div>
            <span class="text-[9px] tracking-[0.2em] uppercase"
                style="writing-mode: vertical-lr; color: rgba(237,149,32,0.4);">scroll</span>
        </div>

    </section>


    {{-- ============================================================
    CONTENT SECTIONS — 7 editorial sections, white bg
    ============================================================ --}}

    {{-- ── 1. EVENTS ── --}}
    <section class="section-feature bg-white" data-section="events">
        @if($latestEvent)
        <div class="feature-container">
            <div class="feature-inner reverse">
                <div class="feature-image-wrap">
                    <img src="{{ asset('photo/' . $latestEvent->photo) }}"
                         alt="{{ $latestEvent->judul }}"
                         class="feature-img" loading="lazy">
                    <div class="feature-img-overlay"></div>
                </div>
                <div class="feature-content-wrap" data-gsap="fade-up">
                    <span class="feature-eyebrow">Upcoming Events</span>
                    <h2 class="feature-title">
                        <a href="{{ route('detail-event', $latestEvent->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestEvent->judul }}</a>
                    </h2>
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
        </div>
        @endif
    </section>

    {{-- ── 2. FILM (Edge-to-Edge 75vh) ── --}}
    {{-- NOTE: position:relative + content absolute bottom-0 left-0 = reliable bottom-left anchoring --}}
    <section data-section="film"
        style="position:relative; width:100%; overflow:hidden; height:75vh; min-height:650px; margin:0; padding:0; background:#000;">
        @if($latestFilm)
        @php $filmYear = \Carbon\Carbon::parse($latestFilm->release_date)->format('Y'); @endphp

        {{-- Background Image --}}
        <img src="{{ asset('photo/' . $latestFilm->photo) }}"
             alt="{{ $latestFilm->title }}"
             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block;">

        {{-- Gradient Overlay: dark at bottom, transparent at top --}}
        <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.35) 50%, transparent 100%); pointer-events:none;"></div>

        {{-- ★ Content pinned to BOTTOM LEFT ★ --}}
        <div style="position:absolute; bottom:0; left:0; width:100%; padding-bottom:5rem; padding-left:clamp(1.25rem,6vw,10rem); padding-right:clamp(1.25rem,6vw,10rem);" data-gsap="fade-up">
            <div style="max-width:900px;">
                {{-- Eyebrow --}}
                <p style="font-size:10px; letter-spacing:0.25em; text-transform:uppercase; color:var(--amber-500); margin:0 0 0.75rem; font-weight:500;">Film Terbaru</p>

                {{-- Title + Genre badge --}}
                <h2 style="font-size:clamp(2.25rem,4.5vw,4rem); font-weight:500; line-height:1.05; letter-spacing:-0.025em; color:#fff; margin:0 0 1.25rem; display:flex; flex-wrap:wrap; align-items:center; gap:1rem;">
                    <a href="{{ route('detail-film', $latestFilm->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestFilm->title }}</a>
                    <span style="font-size:10px; font-weight:600; letter-spacing:0.2em; text-transform:uppercase; background:rgba(237,149,32,0.18); color:var(--amber-400); padding:6px 14px; border-radius:2px; border:1px solid rgba(237,149,32,0.35); backdrop-filter:blur(8px);">
                        {{ $latestFilm->genre }}
                    </span>
                </h2>

                {{-- Meta pills --}}
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:1.5rem;">
                    <span style="font-size:11px; background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.85); padding:5px 14px; border-radius:999px; border:1px solid rgba(255,255,255,0.15);">{{ $filmYear }}</span>
                    @if($latestFilm->duration)
                    <span style="font-size:11px; background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.85); padding:5px 14px; border-radius:999px; border:1px solid rgba(255,255,255,0.15);">{{ $latestFilm->duration }} menit</span>
                    @endif
                    @if($latestFilm->director)
                    <span style="font-size:11px; background:rgba(255,255,255,0.12); color:rgba(255,255,255,0.85); padding:5px 14px; border-radius:999px; border:1px solid rgba(255,255,255,0.15);">Sutradara: {{ $latestFilm->director }}</span>
                    @endif
                </div>

                {{-- Synopsis --}}
                <p class="film-synopsis-responsive" style="font-size:1.05rem; line-height:1.65; color:rgba(255,255,255,0.75); margin:0 0 2.5rem; max-width:65ch;">
                    {{ Str::limit(html_entity_decode(strip_tags($latestFilm->sinopsis), ENT_QUOTES | ENT_HTML5), 240) }}
                </p>

                {{-- CTA --}}
                <a href="/films" style="display:inline-flex; align-items:center; gap:8px; font-size:11px; letter-spacing:0.2em; text-transform:uppercase; font-weight:600; color:var(--amber-500); border-bottom:1px solid rgba(237,149,32,0.45); padding-bottom:4px; text-decoration:none; transition: color 280ms ease, gap 280ms ease;">
                    Lihat Semua Film
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
        @endif
    </section>


    {{-- ── 3. MERCH ── --}}
    <section class="section-feature bg-white" data-section="merch">
        @if($latestMerch)
        <div class="feature-container">
            <div class="feature-inner reverse">
                <div class="feature-image-wrap feature-image-square">
                    <img src="{{ asset('photo/' . $latestMerch->photo) }}"
                         alt="{{ $latestMerch->judul }}"
                         class="feature-img" loading="lazy">
                    <div class="feature-img-overlay"></div>
                </div>
                <div class="feature-content-wrap" data-gsap="fade-up">
                    <span class="feature-eyebrow">Sinemaku Store</span>
                    <h2 class="feature-title">
                        <a href="{{ route('detail-shop', $latestMerch->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestMerch->judul }}</a>
                    </h2>
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
        </div>
        @endif
    </section>

    {{-- ── 4. SERIAL ── --}}
    {{-- The section itself uses 100vw + negative margin to break out of any inherited padding --}}
    <section data-section="serial" style="
        background:#ffffff;
        padding-top: var(--site-py);
        padding-bottom: var(--site-py);
        overflow: visible;
        width: 100vw;
        margin-left: calc(50% - 50vw);
    ">
        @if($latestSerial)
        @php $serialYear = \Carbon\Carbon::parse($latestSerial->release_date)->format('Y'); @endphp

        {{-- Two-column layout: left image bleeds to screen edge, right has content --}}
        <div style="
            display: grid;
            grid-template-columns: 58% 1fr;
            min-height: 560px;
            align-items: stretch;
            overflow: hidden;
        ">
            {{-- LEFT: Landscape image — no padding, touches left viewport edge --}}
            <div style="position:relative; overflow:hidden;">
                <a href="{{ route('detail-series', $latestSerial->slug) }}" style="display:block; width:100%; height:100%;">
                    <img src="{{ asset('photo/' . $latestSerial->photo) }}"
                         alt="{{ $latestSerial->title }}"
                         style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;"
                         class="serial-bleed-img"
                         loading="lazy">
                    <div style="position:absolute; inset:0; background:transparent; pointer-events:none;"></div>
                </a>
                @if($latestSerial->episode)
                <span style="position:absolute; bottom:20px; left:20px; background:rgba(10,10,10,0.82); color:rgba(255,255,255,0.9); font-size:10px; letter-spacing:0.15em; text-transform:uppercase; padding:5px 12px; font-weight:500;">
                    {{ $latestSerial->episode }} Episode
                </span>
                @endif
            </div>

            {{-- RIGHT: Serial details --}}
            <div style="
                display:flex;
                flex-direction:column;
                justify-content:center;
                padding: 4rem clamp(1.5rem, 5vw, 6rem) 4rem clamp(1.5rem, 3vw, 3.5rem);
                background:#ffffff;
            " data-gsap="fade-up">
                <span class="feature-eyebrow">Serial Web</span>
                <h2 class="feature-title">
                    <a href="{{ route('detail-series', $latestSerial->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestSerial->title }}</a>
                </h2>
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

        <style>
            .serial-bleed-img { transition: transform 700ms cubic-bezier(0.4,0,0.2,1); }
            [data-section="serial"]:hover .serial-bleed-img { transform: scale(1.04); }

            @media (max-width: 767px) {
                [data-section="serial"] {
                    width: 100vw !important;
                    margin-left: calc(50% - 50vw) !important;
                }
                [data-section="serial"] > div {
                    grid-template-columns: 1fr !important;
                    min-height: auto !important;
                }
                [data-section="serial"] > div > div:first-child {
                    aspect-ratio: 16/9;
                    min-height: 220px;
                }
            }
        </style>
        @endif
    </section>


    {{-- ── 5. ARTIKEL ── --}}
    <section class="section-feature bg-white" data-section="artikel">
        @if($latestArtikel)
        <div class="feature-container">
            <div class="feature-inner reverse">
                <div class="feature-image-wrap feature-image-wide">
                    <img src="{{ asset('photo/' . $latestArtikel->photo) }}"
                         alt="{{ $latestArtikel->judul }}"
                         class="feature-img" loading="lazy">
                    <div class="feature-img-overlay"></div>
                </div>
                <div class="feature-content-wrap" data-gsap="fade-up">
                    <span class="feature-eyebrow">Artikel Terbaru</span>
                    <h2 class="feature-title">
                        <a href="{{ route('detail-articles', $latestArtikel->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestArtikel->judul }}</a>
                    </h2>
                    <div class="feature-meta-row">
                        @if($latestArtikel->penulis)
                        <span class="feature-meta-pill">Oleh {{ $latestArtikel->penulis }}</span>
                        @endif
                        @if($latestArtikel->tgl_rilis)
                        <span class="feature-meta-pill">{{ \Carbon\Carbon::parse($latestArtikel->tgl_rilis)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                        @endif
                    </div>
                    <p class="feature-excerpt">{{ Str::limit(html_entity_decode(strip_tags($latestArtikel->detail), ENT_QUOTES | ENT_HTML5), 200) }}</p>
                    <a href="/article" class="feature-cta">
                        Baca Artikel Lainnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </section>

    {{-- ── 6. TELEVISI ── --}}
    <section class="section-feature bg-[#fafafa]" data-section="televisi">
        @if($latestTvShow)
        @php $tvYear = \Carbon\Carbon::parse($latestTvShow->release_date)->format('Y'); @endphp
        <div class="feature-container">
            <div class="feature-inner">
                <div class="feature-image-wrap">
                    <img src="{{ asset('photo/' . $latestTvShow->photo) }}"
                         alt="{{ $latestTvShow->title }}"
                         class="feature-img" loading="lazy">
                    <div class="feature-img-overlay"></div>
                </div>
                <div class="feature-content-wrap" data-gsap="fade-up">
                    <span class="feature-eyebrow">Tayangan Televisi</span>
                    <h2 class="feature-title">
                        <a href="{{ route('detail-tv', $latestTvShow->slug) }}" style="text-decoration: none; color: inherit;">{{ $latestTvShow->title }}</a>
                    </h2>
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
        </div>
        @endif
    </section>

    {{-- ── 7. KOMUNITAS (Static Editorial) ── --}}
    <section class="section-komunitas" data-section="komunitas" style="background: var(--navy-950);">
        <div class="komunitas-inner" data-gsap="fade-up">
            <span class="feature-eyebrow" style="color: var(--amber-500); opacity: 0.8;">Komunitas</span>
            <h2 class="komunitas-title">Join the Movement</h2>
            <p class="komunitas-excerpt">
                Be part of a community that celebrates bold storytelling and artistic vision. Get exclusive access to premieres, behind-the-scenes content, and limited releases.
            </p>
            <div class="komunitas-pillars">
                @php
                    $pillars = [
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>', 'label' => 'Premieres', 'desc' => 'Exclusive early access'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" /></svg>', 'label' => 'Behind the Scenes', 'desc' => 'Direct process insights'],
                        ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-12v.75m0 3v.75m0 3v.75m0 3V18M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 9.75h.007v.008H3.75V9.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12.75h.007v.008H3.75V12.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 15.75h.007v.008H3.75V15.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM4.5 4.875h15a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V7.125a2.25 2.25 0 012.25-2.25z" /></svg>', 'label' => 'Limited Releases', 'desc' => 'Special rare editions'],
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
            <a href="/memberships" class="komunitas-cta">
                Unlock the Experience
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
        :root {
            --site-px: clamp(1.25rem, 6vw, 10rem);
            --site-py: clamp(5rem, 12vh, 12rem);
        }



        /* ── Scroll indicator ── */
        @keyframes scrollDown {
            0%   { top: -40%; }
            100% { top: 140%; }
        }



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

        /* Mobile: overlapping styling for sequential scroll */
        @media (max-width: 767px) {
            #film-list {
                position: relative;
                display: flex;
                align-items: flex-end;
                height: 48px; /* Constrain height to contain the overlapping text */
            }
            .film-item {
                position: absolute;
                bottom: 0;
                left: 0;
                opacity: 0;
                filter: blur(10px);
                transition: opacity 0.6s ease, filter 0.6s ease, transform 0.6s ease;
                transform: translateY(15px) scale(0.95);
                pointer-events: none;
                padding: 0 !important;
            }
            .film-item.is-active {
                opacity: 1;
                filter: blur(0);
                transform: translateY(0) scale(1);
                pointer-events: auto;
            }
            .film-title {
                font-size: clamp(1.4rem, 7vw, 2.1rem);
            }
            .film-item.is-active .film-title {
                font-size: clamp(1.4rem, 7vw, 2.1rem);
                transform: translateX(0); /* Override desktop offset */
            }
        }

        /* ─────────────────────────────────────────────
           SECTION FEATURE — shared layout
        ───────────────────────────────────────────── */
        .section-feature {
            padding: var(--site-py) 0;
            overflow: hidden;
            background-color: #ffffff;
        }

        .feature-container {
            padding-left: var(--site-px);
            padding-right: var(--site-px);
            max-width: 1540px;
            margin: 0 auto;
        }

        .feature-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 500px;
            gap: 2rem;
            align-items: stretch;
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
            background: transparent;
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
                padding: 2.5rem 0; /* No side padding on mobile content, handled by container */
                max-width: 100%;
            }
            .feature-inner { gap: 1.5rem; }
        }

        /* ── Eyebrow ── */
        .feature-eyebrow {
            display: block;
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--amber-500);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        /* ── Title ── */
        .feature-title {
            font-size: clamp(1.95rem, 3vw, 2.95rem);
            font-weight: 700;
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
            color: var(--navy-600);
            border-bottom: 1px solid rgba(38,34,94,0.5);
            padding-bottom: 2px;
            transition: color 300ms ease, border-color 300ms ease, gap 300ms ease;
            text-decoration: none;
            width: fit-content;
        }

        .feature-cta:hover {
            color: var(--amber-600);
            border-color: var(--amber-500);
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
            padding: var(--site-py) var(--site-px);
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
            color: var(--amber-500);
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
            color: var(--navy-200);
            line-height: 1.5;
        }

        .komunitas-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--navy-950);
            background: var(--amber-500);
            border: 1px solid transparent;
            padding: 14px 28px;
            border-radius: 999px;
            transition: background 300ms ease, box-shadow 300ms ease, gap 300ms ease;
            text-decoration: none;
        }

        .komunitas-cta:hover {
            background: var(--amber-400);
            box-shadow: 0 0 24px rgba(237,149,32,0.35);
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

        /* ── Film Section Responsive Synopsis ── */
        .film-synopsis-responsive {
            display: block;
        }
        @media (max-width: 767px) {
            .film-synopsis-responsive {
                display: none !important;
            }
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
               3. GSAP ScrollTrigger — section reveals & mobile hero
            ───────────────────────────────────────── */
            function initScrollAnimations() {
                if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
                gsap.registerPlugin(ScrollTrigger);

                // --- Mobile Hero Pinning Sequence ---
                let mm = gsap.matchMedia();
                
                mm.add("(max-width: 767px)", () => {
                    const totalSlides = filmItems.length;
                    if (totalSlides > 1) {
                        ScrollTrigger.create({
                            trigger: "#hero",
                            start: "top top",
                            end: `+=${totalSlides * 100}%`,
                            pin: true,
                            scrub: true,
                            onUpdate: (self) => {
                                let progress = self.progress;
                                let activeIdx = Math.min(Math.floor(progress * totalSlides), totalSlides - 1);
                                
                                activateFilm(activeIdx);
                                
                                const indicator = document.getElementById('current-slide');
                                if(indicator) indicator.innerText = activeIdx + 1;
                            }
                        });
                    }
                });

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