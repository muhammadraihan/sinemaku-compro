@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

@section('content')
    {{-- ================== NAVBAR & HERO ================== --}}
    <section class="hero-section" role="banner" aria-label="Hero">
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
    </section>

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
    <section class="feature-sidetext" id="podcast-1" aria-labelledby="feature-title-1">
        <div class="feature-wrap">
            <!-- Kolom Kiri: Teks -->
            <div class="feature-text">
                <div class="feature-eyebrow">SHOP</div>
                <h2 id="feature-title-1" class="feature-title">
                    Midnight<br />
                    Soundtrack
                </h2>

                <a href="{{ route('detail-shop') }}" class="feature-cta" aria-label="Listen now - Midnight Soundtrack">
                    <span class="cta-line" aria-hidden="true"></span>&nbsp;
                    <span class="cta-label">LISTEN NOW</span>
                </a>
            </div>

            <!-- Kolom Kanan: Media -->
            <a href="{{ route('detail-shop') }}" class="feature-media" aria-label="Open Midnight Soundtrack">
                <div class="feature-media-frame">
                    <img
                        src="{{ asset('img/temp-imagehc-vht-6-10.png') }}"
                        alt="Midnight Soundtrack artwork"
                        loading="lazy"
                    />
                </div>
            </a>
        </div>
    </section>

    {{-- ================== SHOP / FEATURE 2 (mirrored) ================== --}}
    <section class="feature-sidetext" id="podcast-2" aria-labelledby="feature-title-2">
        <div class="feature-wrap">
            <!-- Foto -->
            <a href="{{ route('detail-shop') }}" class="feature-media" aria-label="Open Creative Affair">
                <div class="feature-media-frame">
                    <img
                        src="{{ asset('img/15HNDD.png') }}"
                        alt="Creative Affair cover"
                        loading="lazy"
                    />
                </div>
            </a>

            <!-- Teks -->
            <div class="feature-media-content">
                <span class="feature-eyebrow">SHOP</span>
                <h2 id="feature-title-2" class="feature-title">
                    Creative Affair with Celine Song &amp; Eva Victor
                </h2>
                <a href="{{ route('detail-shop') }}" class="feature-cta" aria-label="Listen now - Creative Affair">
                    <span class="cta-line" aria-hidden="true"></span>&nbsp;
                    <span class="cta-label">LISTEN NOW</span>
                </a>
            </div>
        </div>
    </section>

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
            <a href="#" class="view-all" aria-label="View all articles">View All →</a>
        </div>

        <div class="articles-grid">
            <!-- Featured Article -->
            <article class="article-featured">
                <img src="{{ asset('img/artikel1.jpg') }}" alt="Featured article cover" loading="lazy" />
                <div class="article-featured-text">
                    <h3>Sinopsis Film Hanya Namamu dalam Doaku dan Fakta Menariknya!</h3>
                    <p>
                        Film "Hanya Namamu dalam Doaku" bercerita tentang Arga yang berjuang melawan ALS sambil menyimpan
                        rahasia dari keluarganya....
                    </p>
                </div>
            </article>

            <!-- List Articles -->
            <div class="article-list" role="list">
                <article class="article-item" role="listitem">
                    <img src="{{ asset('img/artikel1.jpg') }}" alt="Behind the Scenes thumbnail" loading="lazy" />
                    <div>
                        <h4>Behind the Scenes: Creating Midnight's Score</h4>
                        <span class="date" aria-label="Published 2 days ago">2 days ago</span>
                    </div>
                </article>

                <article class="article-item" role="listitem">
                    <img src="{{ asset('img/artikel1.jpg') }}" alt="Director's Vision thumbnail" loading="lazy" />
                    <div>
                        <h4>Director's Vision for the Future of Cinema</h4>
                        <span class="date" aria-label="Published 2 days ago">2 days ago</span>
                    </div>
                </article>

                <article class="article-item" role="listitem">
                    <img src="{{ asset('img/artikel1.jpg') }}" alt="Evolution of Film Production thumbnail" loading="lazy" />
                    <div>
                        <h4>The Evolution of Film Production in the Digital Age</h4>
                        <span class="date" aria-label="Published 2 days ago">2 days ago</span>
                    </div>
                </article>
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
            <button class="join-member-btn" type="button" aria-label="Join now">JOIN NOW — IT'S FREE →</button>
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
                <article class="career-card" role="listitem">
                    <h3 class="career-role">Lead Cinematographer</h3>
                    <div class="career-dept">Production</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Jakarta
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>

                <article class="career-card" role="listitem">
                    <h3 class="career-role">Sound Designer</h3>
                    <div class="career-dept">Post-Production</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Remote
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>

                <article class="career-card" role="listitem">
                    <h3 class="career-role">VFX Supervisor</h3>
                    <div class="career-dept">Visual Effects</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Jakarta
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>

                <article class="career-card" role="listitem">
                    <h3 class="career-role">Script Supervisor</h3>
                    <div class="career-dept">Production</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Bandung
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>

                <article class="career-card" role="listitem">
                    <h3 class="career-role">Casting Director</h3>
                    <div class="career-dept">Creative</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Jakarta
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>

                <article class="career-card" role="listitem">
                    <h3 class="career-role">Marketing Manager</h3>
                    <div class="career-dept">Marketing</div>
                    <div class="career-meta">
                        <span class="career-loc">
                            <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true">
                                <path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/>
                            </svg>
                            Jakarta
                        </span>
                    </div>
                    <button class="career-apply" type="button">APPLY</button>
                </article>
            </div>
        </div>

        <!-- Button View All Careers -->
        <div class="careers-footer">
            <a class="careers-viewall" href="#" aria-label="View all careers">
                <span class="careers-view">VIEW ALL CAREERS →</span>
            </a>
        </div>
    </section>
@endsection
