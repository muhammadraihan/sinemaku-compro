@extends('layouts.app')

@section('title', 'Home | Sinemaku Pictures')

@include('partials.navbar')

@section('content')
        {{-- ================== NAVBAR & HERO ================== --}}
        <div class="hero-section">
            <div class="hero-gradient"></div>
            <img class="temp-imagehc-vht-6-1" src={{ asset("img/temp-imagehc-vht-6-10.png") }} />

            <div class="rectangle-5"></div>
            <div class="hero-content">
                <div class="_2023">2023</div>
                <div class="_01-04">01 - 04</div>
                <div class="div">.</div>
                <div class="starring-prilly-latuconsina">Starring Prilly Latuconsina</div>
                <div class="bolehkah-sekali-saja-ku-menangis">
                    BOLEHKAH<br />SEKALI SAJA<br />KU MENANGIS
                </div>
            </div>
        </div>

        {{-- ================== FEATURED MOVIE / SLIDER ================== --}}
        <section class="section-coming-soon">
            <div class="coming-soon-header">
                <h2 class="coming-soon-title">COMING SOON</h2>
                <div class="coming-soon-controls">
                <button class="slider-btn prev">
                    <span class="icon">&#8592;</span> <!-- Atau bisa pakai SVG -->
                </button>
                <button class="slider-btn next">
                    <span class="icon">&#8594;</span>
                </button>
                </div>
            </div>
            <div class="coming-soon-slider">
                <!-- Slide 1 -->
                <div class="coming-soon-slide">
                    <div class="coming-soon-image-wrapper">
                        <img src={{ asset("img/temp-imagen-cx-lql-10.png") }} alt="Bolehkah Sekali Saja Ku Menangis" class="coming-soon-image">
                        <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                    </div>
                    <div class="coming-soon-caption">
                        Bolehkah Sekali Saja Ku Menangis
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="coming-soon-slide">
                    <div class="coming-soon-image-wrapper">
                        <img src={{ asset("img/temp-imagen-cx-lql-10.png") }} alt="Bolehkah Sekali Saja Ku Menangis" class="coming-soon-image">
                        <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                    </div>
                    <div class="coming-soon-caption">
                        Bolehkah Sekali Saja Ku Menangis
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="coming-soon-slide">
                    <div class="coming-soon-image-wrapper">
                        <img src={{ asset("img/temp-imagen-cx-lql-10.png") }} alt="Bolehkah Sekali Saja Ku Menangis" class="coming-soon-image">
                        <span class="coming-soon-date">IN THEATERS DEC 15, 2025</span>
                    </div>
                    <div class="coming-soon-caption">
                        Bolehkah Sekali Saja Ku Menangis
                    </div>
                </div>
            </div>
        </section>


        {{-- ================== SHOP / ARTICLES / JOIN OUR VISION ========== --}}
        <section class="feature-sidetext" id="podcast">
            <div class="feature-wrap">
                <!-- Kolom Kiri: Teks -->
                <div class="feature-text">
                <div class="feature-eyebrow">SHOP</div>
                <h2 class="feature-title">
                    Midnight<br>
                    Soundtrack
                </h2>

                <a href="{{ route('detail-shop') }}" class="feature-cta" aria-label="Listen now">
                    <span class="cta-line" aria-hidden="true"></span>&nbsp;
                    <span class="cta-label">LISTEN NOW</span>
                </a>
                </div>

                <!-- Kolom Kanan: Media -->
                <a href="{{ route('detail-shop') }}" class="feature-media">
                <div class="feature-media-frame">
                    <img
                    src="{{ asset('img/temp-imagehc-vht-6-10.png') }}"
                    alt="Midnight Soundtrack">
                </div>
                </a>
            </div>
        </section>

        <section class="feature-sidetext" id="podcast">
            <div class="feature-wrap">
                <!-- Foto -->
                <a href="{{ route('detail-shop') }}" class="feature-media">
                    <div class="feature-media-frame">
                        <img src="{{ asset('img/15HNDD.png') }}" alt="Creative Affair">
                    </div>
                </a>
                <!-- Teks -->
                <div class="feature-media-content">
                    <span class="feature-eyebrow">SHOP</span>
                    <h2 class="feature-title">Creative Affair with Celine Song & Eva Victor</h2>
                    <a href="{{ route('detail-shop') }}" class="feature-cta" aria-label="Listen now">
                        <span class="cta-line" aria-hidden="true"></span>&nbsp;
                        <span class="cta-label">LISTEN NOW</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- ================== SECTION SPOTLIGHT ================== --}}
        <section class="spotlight">
            <div class="spotlight__frame">
                <img class="spotlight__image" src={{ asset('img/temp-imagehc-vht-6-10.png') }} alt="Bring Her Back">
                <div class="spotlight__overlay"></div>

                <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">Bolehkah Sekali Saja Ku Menangis</h2>
                </div>
            </div>
        </section>

        {{-- ================== ARTICLES CARD ================== --}}
        <section class="articles-section">
            <div class="articles-header">
                <h2>Articles</h2>
                <a href="#" class="view-all">View All →</a>
            </div>

            <div class="articles-grid">
                <!-- Featured Article -->
                <div class="article-featured">
                <img src={{ asset('img/artikel1.jpg') }} alt="Featured Article">
                <div class="article-featured-text">
                    <h3>Sinopsis Film Hanya Namamu dalam Doaku dan Fakta Menariknya !</h3>
                    <p>Film "Hanya Namamu dalam Doaku" bercerita tentang Arga yang berjuang melawan ALS sambil menyimpan rahasia dari keluarganya....</p>
                </div>
                </div>

                <!-- List Articles -->
                <div class="article-list">
                <div class="article-item">
                    <img src={{ asset('img/artikel1.jpg') }} alt="Article 1">
                    <div>
                    <h4>Behind the Scenes: Creating Midnight's Score</h4>
                    <span class="date">2 days ago</span>
                    </div>
                </div>

                <div class="article-item">
                    <img src={{ asset('img/artikel1.jpg') }} alt="Article 2">
                    <div>
                    <h4>Director's Vision for the Future of Cinema</h4>
                    <span class="date">2 days ago</span>
                    </div>
                </div>

                <div class="article-item">
                    <img src={{ asset('img/artikel1.jpg') }} alt="Article 3">
                    <div>
                    <h4>The Evolution of Film Production in the Digital Age</h4>
                    <span class="date">2 days ago</span>
                    </div>
                </div>
                </div>
            </div>
        </section>

        {{-- ================== SECTION JOIN MEMBER ================== --}}
        <section class="join-member">
            <div class="join-member-inner">
                <h2 class="join-member-title">Join the Movement</h2>
                <p class="join-member-desc">
                Be part of a community that celebrates bold storytelling and artistic vision. 
                Get exclusive access to premieres, behind-the-scenes content, and limited releases.
                </p>
                <button class="join-member-btn">JOIN NOW — IT'S FREE →</button>
            </div>
        </section>

        {{-- ================== SECTION SPOTLIGHT ================== --}}
        <section class="spotlight">
            <div class="spotlight__frame">
                <img class="spotlight__image" src={{ asset('img/hndd.jpg') }} alt="Bring Her Back">
                <div class="spotlight__overlay"></div>

                <div class="spotlight__content">
                <span class="spotlight__eyebrow">WATCH NOW</span>
                <h2 class="spotlight__title">HNDD</h2>
                </div>
            </div>
        </section>

        {{-- ================== SECTION CAREER ================== --}}
        <section class="careers-section" id="careers">
            <div class="careers-wrap">
                <header class="careers-header">
                <h2 class="careers-title">Join Our Vision</h2>
                <p class="careers-subtitle">
                    We're looking for passionate creators who share our commitment to bold storytelling.
                </p>
                </header>

                <div class="careers-grid">
                <!-- Card -->
                <article class="career-card">
                    <h3 class="career-role">Lead Cinematographer</h3>
                    <div class="career-dept">Production</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Jakarta
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>

                <article class="career-card">
                    <h3 class="career-role">Sound Designer</h3>
                    <div class="career-dept">Post-Production</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Remote
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>

                <article class="career-card">
                    <h3 class="career-role">VFX Supervisor</h3>
                    <div class="career-dept">Visual Effects</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Jakarta
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>

                <article class="career-card">
                    <h3 class="career-role">Script Supervisor</h3>
                    <div class="career-dept">Production</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Bandung
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>

                <article class="career-card">
                    <h3 class="career-role">Casting Director</h3>
                    <div class="career-dept">Creative</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Jakarta
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>

                <article class="career-card">
                    <h3 class="career-role">Marketing Manager</h3>
                    <div class="career-dept">Marketing</div>
                    <div class="career-meta">
                    <span class="career-loc">
                        <svg viewBox="0 0 24 24" class="loc-ic" aria-hidden="true"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.246 5.09 10.14 5.308 10.39a.9.9 0 0 0 1.384 0C12.91 18.14 18 12.246 18 8c0-3.314-2.686-6-6-6Zm0 8.5A2.5 2.5 0 1 1 12 5a2.5 2.5 0 0 1 0 5.5Z" fill="currentColor"/></svg>
                        Jakarta
                    </span>
                    </div>
                    <button class="career-apply">APPLY</button>
                </article>
                </div>
            </div>
            
            <!-- Button View All Careers -->
            <div class="careers-footer">
                <a href="#">
                <span class="careers-view">VIEW ALL CAREERS →</span>
                </a>
                
            </div>
        </section>

@endsection
