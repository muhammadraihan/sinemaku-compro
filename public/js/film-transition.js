/**
 * film-transition.js
 * Cinematic Grid-to-Detail SPA Transition — Sinemaku Pictures
 *
 * Flow:
 *  Click card → zoom image → fetch JSON → build detail panel → progressive reveal
 *  Back button → reverse zoom → restore grid
 */

(function () {
    'use strict';

    /* ─── CONFIG ─────────────────────────────────────────────── */
    const ZOOM_DURATION = 0.9;   // slightly faster, but dramatic easing
    const REVEAL_STAGGER = 0.12;  // snappier reveal
    const EASE_ZOOM = 'expo.inOut';  // very slow start/end, fast middle
    const EASE_OUT = 'power4.out';

    /* ─── STATE ──────────────────────────────────────────────── */
    let isTransitioning = false;
    let currentSlug = null;
    let savedScrollY = 0;
    let savedCardRect = null;

    /* ─── DOM REFS ───────────────────────────────────────────── */
    const overlay = document.getElementById('film-zoom-overlay');
    const panel = document.getElementById('film-detail-panel-container');

    /* ═══════════════════════════════════════════════════════════
       MODULE 1 — CLICK INTERCEPTOR
    ══════════════════════════════════════════════════════════════ */
    function initCardTriggers() {
        document.querySelectorAll('.film-card-trigger').forEach(card => {
            card.addEventListener('click', function (e) {
                e.preventDefault();
                if (isTransitioning) return;

                const slug = this.dataset.slug;
                const url = this.dataset.url;
                const photo = this.dataset.photo;
                const img = this.querySelector('.film-card-img');

                if (!slug || !img) return;
                openFilmDetail(slug, url, photo, img, this);
            });
        });
    }

    /* ═══════════════════════════════════════════════════════════
       MODULE 2 — ZOOM ANIMATION
    ══════════════════════════════════════════════════════════════ */
    function openFilmDetail(slug, url, photo, imgEl, cardEl) {
        isTransitioning = true;
        currentSlug = slug;
        savedScrollY = window.scrollY;
        savedCardRect = cardEl.getBoundingClientRect();

        const rect = savedCardRect;

        /* 1. Lock scroll & kill any competing CSS transitions */
        document.body.style.overflow = 'hidden';
        document.querySelectorAll('.film-card-img, .film-card-trigger').forEach(el => {
            el.style.transition = 'none';
        });
        if (window.ScrollTrigger) {
            window.ScrollTrigger.getAll().forEach(t => t.disable());
        }

        /* 2. Build the detail panel immediately (hidden under the grid) */
        buildPanelShell(photo);
        panel.style.opacity = '0';
        panel.style.pointerEvents = 'none';

        /* 3. Zoom the entire grid as one unit from the clicked card's center */
        const gridSection = document.querySelector('.film-catalog-section') ||
                            document.querySelector('.film-row-container')?.parentElement ||
                            document.querySelector('.film-row-container');
        const gridRows   = document.querySelector('.film-row-container');

        if (gridRows) {
            const containerRect = gridRows.getBoundingClientRect();
            const originX = (rect.left + rect.width / 2) - containerRect.left;
            const originY = (rect.top + rect.height / 2) - containerRect.top;

            gsap.set(gridRows, { transformOrigin: `${originX}px ${originY}px`, willChange: 'transform, opacity' });

            gsap.to(gridRows, {
                scale: 3.5,
                opacity: 0,
                duration: ZOOM_DURATION,
                ease: EASE_ZOOM,
                onComplete: () => {
                    /* Grid is gone — reset it silently for later restore */
                    gsap.set(gridRows, { scale: 1, opacity: 1, transformOrigin: 'center center', clearProps: 'willChange' });
                }
            });
        }

        /* 4. Panel fades in at the midpoint of the grid zoom */
        gsap.to(panel, {
            opacity: 1,
            duration: ZOOM_DURATION * 0.6,
            ease: 'power3.out',
            delay: ZOOM_DURATION * 0.4,
            onStart: () => { panel.style.pointerEvents = 'auto'; },
            onComplete: () => { isTransitioning = false; }
        });

        /* 5. Update URL */
        history.pushState(
            { slug, url, rect: { left: rect.left, top: rect.top, width: rect.width, height: rect.height } },
            '',
            url
        );

        /* 6. Fetch and populate data (parallel) */
        fetchAndPopulate(slug);
    }

    /* ═══════════════════════════════════════════════════════════
       MODULE 3 — PANEL SHELL (immediate structure)
    ══════════════════════════════════════════════════════════════ */
    function buildPanelShell(photo) {
        panel.innerHTML = `
        <div id="film-detail-content" style="min-height:100vh;background:#f6f6ed;" class="text-brand-deepbreath font-sans">

            <!-- HERO -->
            <section data-section="hero" class="detail-section relative w-full h-[90vh] md:h-[100vh] flex flex-col justify-end overflow-hidden z-10">
                <div class="absolute inset-0 z-0">
                    <img src="${photo}" class="w-full h-[120%] object-cover" id="detail-hero-img"
                         style="opacity:0;transition:opacity 0.8s;transform:translateY(-10%);filter:sepia(0.2) saturate(1.1);">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#F1F1F1] via-transparent to-transparent opacity-80 z-20"></div>
                    <div class="absolute inset-0 bg-brand-deepbreath/5 mix-blend-multiply z-20"></div>
                </div>

                <div class="relative z-30 px-8 md:px-16 pb-20 max-w-[1800px] mx-auto w-full">
                    <div class="flex flex-col md:flex-row items-end justify-between gap-8">
                        <div id="detail-hero-text" class="w-full md:w-2/3"
                             style="opacity:0;transform:translateY(30px);transition:opacity 0.8s,transform 0.8s;">
                            <span id="detail-eyebrow" class="block font-sans text-[10px] tracking-[0.4em] uppercase text-brand-orange mb-6">— —</span>
                            <h1 id="detail-title" class="font-serif text-[12vw] md:text-[8vw] leading-[0.85] text-brand-deepbreath tracking-tighter">
                                <span class="block">...</span>
                            </h1>
                        </div>
                        <div id="detail-hero-cta" class="w-full md:w-auto" style="opacity:0;transition:opacity 0.8s 0.4s;"></div>
                    </div>
                </div>

                <button id="detail-back-btn" onclick="window.__filmTransitionBack()"
                    class="absolute top-8 left-8 md:left-16 z-40 flex items-center gap-3 font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath hover:text-brand-orange transition-colors cursor-none hover-target"
                    style="opacity:0;transition:opacity 0.4s;">
                    <span class="iconify" data-icon="lucide:arrow-left"></span> Back to Films
                </button>
            </section>

            <!-- META SECTION -->
            <section data-section="meta" class="detail-section py-24 px-8 md:px-16 z-10 relative bg-[#F1F1F1]/80 backdrop-blur-md">
                <div id="detail-meta-inner" class="max-w-[1800px] mx-auto border-t border-b border-brand-deepbreath/10 py-16 grid grid-cols-1 md:grid-cols-4 gap-12">
                    ${sectionLoader()}
                </div>
            </section>

            <!-- SYNOPSIS SECTION -->
            <section data-section="synopsis" class="detail-section py-32 px-8 md:px-16 z-10 relative">
                <div id="detail-synopsis-inner" class="max-w-[1800px] mx-auto flex flex-col md:flex-row gap-20 md:gap-32 items-start">
                    ${sectionLoader()}
                </div>
            </section>

            <!-- EPISODES SECTION (hidden until populated) -->
            <section id="episodes-section" class="detail-section py-24 px-8 md:px-16 z-10 relative bg-[#F1F1F1] hidden">
                <div id="detail-episodes-inner" class="max-w-[1800px] mx-auto border-t border-brand-deepbreath/10 pt-16"></div>
            </section>

            <!-- STILL SHOTS SECTION -->
            <section data-section="stillshots" class="detail-section py-32 px-8 md:px-16 z-10 relative bg-brand-deepbreath text-white">
                <div id="detail-shots-inner" class="max-w-[1800px] mx-auto">
                    ${sectionLoader('white')}
                </div>
            </section>

            <!-- RECOMMENDATIONS SECTION -->
            <section data-section="recommendations" class="detail-section py-32 px-8 md:px-16 z-10 relative bg-[#F1F1F1]">
                <div id="detail-recs-inner" class="max-w-[1800px] mx-auto">
                    ${sectionLoader()}
                </div>
            </section>

            <div style="height:120px;background:#F1F1F1;"></div>
        </div>`;

        setTimeout(() => {
            const heroImg = document.getElementById('detail-hero-img');
            if (heroImg) heroImg.style.opacity = '1';
        }, 400);
    }

    function sectionLoader(color = 'brand-deepbreath') {
        const borderColor = color === 'white' ? 'rgba(255,255,255,0.2)' : 'rgba(15,106,176,0.2)';
        const topColor = color === 'white' ? '#ffffff' : '#f46a21';
        return `<div class="section-loader-wrap" style="width:100%;display:flex;align-items:center;justify-content:center;padding:64px 0;">
            <div style="width:32px;height:32px;border:1.5px solid ${borderColor};border-top-color:${topColor};border-radius:50%;animation:sinemaku-spin 0.8s linear infinite;"></div>
        </div>`;
    }

    /* ═══════════════════════════════════════════════════════════
       MODULE 4 — FETCH + PROGRESSIVE POPULATE
    ══════════════════════════════════════════════════════════════ */
    async function fetchAndPopulate(slug) {
        try {
            const res = await fetch(`/api/films/${slug}/partial`);
            const data = await res.json();

            if (data.error) return;

            /* Populate sections one by one with staggered timing */
            populateHero(data);
            setTimeout(() => populateMeta(data), 300);
            setTimeout(() => populateSynopsis(data), 600);
            setTimeout(() => populateEpisodes(data), 800);
            setTimeout(() => populateStillShots(data), 1000);
            setTimeout(() => populateRecs(data), 1300);

        } catch (err) {
            console.error('[FilmTransition] Fetch error:', err);
        }
    }

    /* ─── Hero ────────────────────────────────────────────────── */
    function populateHero(d) {
        const lang = (localStorage.getItem('sinemaku_lang') || 'en');
        const title = (lang === 'id' && d.title) ? d.title : (d.title_en || d.title);
        const year = d.release_date ? d.release_date.substring(0, 4) : '';

        const eyebrow = document.getElementById('detail-eyebrow');
        const titleEl = document.getElementById('detail-title');
        const text    = document.getElementById('detail-hero-text');
        const ctaEl   = document.getElementById('detail-hero-cta');
        const backBtn = document.getElementById('detail-back-btn');

        if (eyebrow) eyebrow.textContent = `${year} • ${d.genre}`;
        if (titleEl) titleEl.innerHTML = `<span class="block">${title}</span>`;

        /* Inject Watch Trailer button if video available */
        if (ctaEl && d.youtube_id) {
            ctaEl.innerHTML = `
                <button onclick="window.__openTrailer('${d.youtube_id}')"
                    class="group flex items-center gap-6 hover-target cursor-none">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full border border-brand-deepbreath/20 flex items-center justify-center group-hover:bg-brand-deepbreath group-hover:text-white transition-all duration-500">
                        <span class="iconify w-8 h-8" data-icon="lucide:play"></span>
                    </div>
                    <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath">Watch Trailer</span>
                </button>`;
        }

        /* Reveal */
        if (text) { text.style.opacity = '1'; text.style.transform = 'translateY(0)'; }
        if (ctaEl) ctaEl.style.opacity = '1';
        if (backBtn) backBtn.style.opacity = '1';

        if (window.bindCursorHoverEffects) window.bindCursorHoverEffects();
    }

    /* ─── Meta ────────────────────────────────────────────────── */
    function populateMeta(d) {
        const el = document.getElementById('detail-meta-inner');
        if (!el) return;

        const castList = Array.isArray(d.cast) ? d.cast : [];
        const castHTML = castList.slice(0, 3).map(c =>
            `<span class="font-sans text-sm font-medium text-brand-deepbreath">${c}</span>`
        ).join('') + (castList.length > 3
            ? `<span class="font-sans text-[10px] text-brand-orange italic mt-1">and more...</span>`
            : '');

        el.innerHTML = `
            <div class="metadata-item">
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Director</span>
                <h3 class="font-serif text-3xl text-brand-deepbreath italic">${d.director || '—'}</h3>
            </div>
            <div class="metadata-item">
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Cast</span>
                <div class="flex flex-col gap-1">${castHTML}</div>
            </div>
            <div class="metadata-item">
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Duration</span>
                <h3 class="font-sans text-2xl font-light text-brand-deepbreath">${d.duration} <span class="text-sm uppercase tracking-widest opacity-40">Min</span></h3>
            </div>
            <div class="metadata-item">
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-brand-deepbreath/40 block mb-4">Language</span>
                <h3 class="font-sans text-2xl font-light text-brand-deepbreath">Bahasa Indonesia</h3>
            </div>`;

        revealElement(el);
    }

    /* ─── Synopsis ────────────────────────────────────────────── */
    function populateSynopsis(d) {
        const el = document.getElementById('detail-synopsis-inner');
        if (!el) return;

        const lang = (localStorage.getItem('sinemaku_lang') || 'en');
        const synopsis = (lang === 'id' && d.sinopsis) ? d.sinopsis : (d.sinopsis_en || d.sinopsis);

        el.innerHTML = `
            <div class="w-full md:w-2/5">
                <div class="aspect-[2/3] w-full rounded-xl overflow-hidden shadow-2xl bg-tint-2/20">
                    <img src="${d.poster}" alt="Poster" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="w-full md:w-3/5 flex flex-col justify-center">
                <span class="font-sans text-[10px] tracking-[0.4em] uppercase text-brand-orange block mb-8">The Narrative.</span>
                <div class="font-serif text-xl md:text-2xl leading-[1.8] font-light text-brand-deepbreath/80 max-w-3xl">${synopsis || ''}</div>
                ${d.youtube_id ? `
                <button onclick="window.__openTrailer('${d.youtube_id}')"
                    class="mt-12 flex items-center gap-6 hover-target cursor-none group">
                    <div class="w-20 h-20 rounded-full border border-brand-deepbreath/20 flex items-center justify-center group-hover:bg-brand-deepbreath group-hover:text-white transition-all duration-500">
                        <span class="iconify w-8 h-8" data-icon="lucide:play"></span>
                    </div>
                    <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath">Watch Trailer</span>
                </button>` : ''}
            </div>`;

        revealElement(el);
        if (window.bindCursorHoverEffects) window.bindCursorHoverEffects();
    }

    /* ─── Episodes ────────────────────────────────────────────── */
    function populateEpisodes(d) {
        const sec = document.getElementById('episodes-section');
        const el  = document.getElementById('detail-episodes-inner');
        if (!sec || !el || !d.episodes || d.episodes.length === 0) return;

        sec.classList.remove('hidden');

        const epsHTML = d.episodes.map(ep => {
            const num = String(ep.episode_number).padStart(2, '0');
            const playAttr = ep.youtube_id ? `onclick="window.__openTrailer('${ep.youtube_id}')"` : '';
            return `
            <div class="flex flex-col md:flex-row gap-8 items-start pb-12 border-b border-brand-deepbreath/10 group">
                <div class="w-full md:w-1/3 aspect-video relative overflow-hidden rounded-xl bg-tint-2/20 shrink-0 ${ep.youtube_id ? 'cursor-none hover-target' : ''}" ${playAttr}>
                    <img src="${ep.photo || 'https://picsum.photos/800/450'}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700" alt="${ep.title}">
                    ${ep.youtube_id ? `<div class="absolute inset-0 bg-brand-deepbreath/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"><div class="w-16 h-16 rounded-full border border-white/40 flex items-center justify-center bg-white/10 backdrop-blur-md"><span class="iconify w-8 h-8 text-white ml-1" data-icon="lucide:play"></span></div></div>` : ''}
                </div>
                <div class="w-full md:w-2/3 flex flex-col justify-center py-2">
                    <span class="font-sans text-[10px] tracking-[0.2em] uppercase text-brand-deepbreath/40 block mb-2">Episode ${num}</span>
                    <h3 class="font-serif text-3xl md:text-4xl text-brand-deepbreath leading-tight mb-4 group-hover:text-brand-orange transition-colors">${ep.title}</h3>
                    <p class="font-sans text-sm font-light text-brand-deepbreath/70 leading-relaxed mb-6 max-w-2xl">${ep.sinopsis || ''}</p>
                    <div class="flex gap-6 items-center">
                        ${ep.link ? `<a href="${ep.link}" target="_blank" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-orange hover:text-brand-deepbreath transition-colors cursor-none hover-target flex items-center gap-2">Watch Now <span class="iconify" data-icon="lucide:external-link"></span></a>` : ''}
                        ${ep.youtube_id ? `<button onclick="window.__openTrailer('${ep.youtube_id}')" class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold text-brand-deepbreath hover:text-brand-orange transition-colors cursor-none hover-target flex items-center gap-2">Play Trailer <span class="iconify" data-icon="lucide:play-circle"></span></button>` : ''}
                    </div>
                </div>
            </div>`;
        }).join('');

        el.innerHTML = `<h2 class="font-serif text-5xl text-brand-deepbreath tracking-tight mb-16">Episodes List.</h2><div class="flex flex-col gap-12">${epsHTML}</div>`;
        revealElement(el);
        if (window.bindCursorHoverEffects) window.bindCursorHoverEffects();
    }

    /* ─── Still Shots ─────────────────────────────────────────── */
    function populateStillShots(d) {
        const el = document.getElementById('detail-shots-inner');
        if (!el) return;

        const shots = d.still_shots || [];

        /* Build alternating 2-3 row grid (same logic as Blade) */
        const rows = [];
        let offset = 0, rowNum = 0;
        while (offset < shots.length) {
            const take = (rowNum % 2 === 0) ? 2 : 3;
            const chunk = shots.slice(offset, offset + take);
            if (chunk.length) rows.push({ type: rowNum % 2, items: chunk });
            offset += take;
            rowNum++;
        }

        /* Fallback dummies */
        if (!rows.length) {
            el.innerHTML = '<p class="font-sans text-white/40 text-sm">No still shots available.</p>';
            return;
        }

        const headerHTML = `
            <div class="mb-20">
                <div class="flex justify-between items-end border-b border-white/10 pb-12">
                    <h2 class="font-serif text-6xl md:text-8xl tracking-tighter italic">Still Shots.</h2>
                    <span class="font-sans text-[10px] tracking-[0.4em] uppercase opacity-40 pb-4">Gallery 01</span>
                </div>
            </div>`;

        const gridHTML = rows.map(row => {
            const rowItems = row.items.map((shot, i) => {
                const isHalf = (row.type === 1 && (i === 0 || i === 2));
                const widthStyle = isHalf
                    ? 'width: calc((100vw - 64px) / 4);'
                    : 'width: calc((100vw - 48px) / 2);';
                return `<div class="relative overflow-hidden rounded-xl flex-shrink-0" style="${widthStyle}">
                    <img src="${shot.photo}" class="w-full h-full object-cover" alt="Still Shot">
                </div>`;
            }).join('');
            return `<div class="flex w-full justify-center" style="height:clamp(180px,22vw,450px);gap:16px;">${rowItems}</div>`;
        }).join('');

        el.innerHTML = headerHTML + `<div class="w-full overflow-hidden flex flex-col" style="gap:16px;">${gridHTML}</div>`;
        revealElement(el);
    }

    /* ─── Recommendations ─────────────────────────────────────── */
    function populateRecs(d) {
        const el = document.getElementById('detail-recs-inner');
        if (!el) return;

        const recs = d.recommendations || [];
        const lang = (localStorage.getItem('sinemaku_lang') || 'en');

        const recsHTML = recs.map(item => {
            const title = (lang === 'id' && item.title) ? item.title : (item.title_en || item.title);
            const year = item.release_date ? item.release_date.substring(0, 4) : '';
            return `
            <a href="${item.url}"
               class="group block cursor-none hover-target"
               data-slug="${item.slug}">
                <div class="aspect-[4/5] w-full overflow-hidden rounded-xl bg-tint-2/20 mb-6">
                    <img src="${item.photo}" class="film-card-img w-full h-full object-cover group-hover:scale-105 transition-all duration-700" alt="${title}">
                </div>
                <h4 class="font-serif text-2xl text-brand-deepbreath leading-tight group-hover:text-brand-orange transition-colors">${title}</h4>
                <span class="font-sans text-[10px] tracking-[0.2em] uppercase text-brand-deepbreath/40 mt-2 block">${year} • ${item.genre}</span>
            </a>`;
        }).join('');

        el.innerHTML = `
            <div class="border-t border-brand-deepbreath/10 pt-16 mb-20">
                <h2 class="font-serif text-5xl text-brand-deepbreath tracking-tight">You might also enjoy.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">${recsHTML}</div>`;

        revealElement(el);



        if (window.bindCursorHoverEffects) window.bindCursorHoverEffects();
    }

    /* ─── Reveal Helper ───────────────────────────────────────── */
    function revealElement(el) {
        if (typeof gsap === 'undefined') return;
        gsap.from(el, {
            opacity: 0,
            y: 30,
            duration: 1.1,
            ease: 'power2.out'
        });
    }

    /* ═══════════════════════════════════════════════════════════
       MODULE 5 — BACK NAVIGATION (REVERSE ANIMATION)
    ══════════════════════════════════════════════════════════════ */
    window.__filmTransitionBack = function () {
        history.back();
    };

    window.addEventListener('popstate', function (e) {
        /* Only handle if we're coming back from a detail view */
        if (panel.style.opacity === '0' || !panel.innerHTML.trim()) return;
        reverseTransition();
    });

    function reverseTransition() {
        if (isTransitioning) return;
        isTransitioning = true;

        /* 1. Fade out detail panel */
        gsap.to(panel, {
            opacity: 0,
            duration: ZOOM_DURATION * 0.5,
            ease: 'power3.out',
            onComplete: () => {
                panel.innerHTML = '';
                panel.style.pointerEvents = 'none';
            }
        });

        /* 2. Grid zooms back in from the enlarged state (mirroring forward) */
        const gridRows = document.querySelector('.film-row-container');
        if (gridRows && savedCardRect) {
            const containerRect = gridRows.getBoundingClientRect();
            const originX = (savedCardRect.left + savedCardRect.width / 2) - containerRect.left;
            const originY = (savedCardRect.top + savedCardRect.height / 2) - containerRect.top;

            /* Start from the state where forward animation ended: scale 3.5, opacity 0 */
            gsap.set(gridRows, { 
                scale: 3.5, 
                opacity: 0, 
                transformOrigin: `${originX}px ${originY}px`,
                willChange: 'transform, opacity' 
            });

            gsap.to(gridRows, {
                scale: 1,
                opacity: 1,
                duration: ZOOM_DURATION,
                ease: EASE_ZOOM,
                onComplete: () => {
                    /* Restore only the props GSAP modified, preserving inline gap/etc */
                    gsap.set(gridRows, { clearProps: 'transform, opacity, transformOrigin, willChange' });
                    document.querySelectorAll('.film-card-img, .film-card-trigger').forEach(el => {
                        el.style.transition = '';
                    });
                    if (window.ScrollTrigger) {
                        window.ScrollTrigger.getAll().forEach(t => t.enable());
                    }
                    isTransitioning = false;
                    currentSlug = null;
                }
            });
        } else {
            if (gridRows) gsap.set(gridRows, { opacity: 1, scale: 1 });
            isTransitioning = false;
            currentSlug = null;
        }

        /* 3. Restore scroll & unlock body */
        setTimeout(() => {
            window.scrollTo({ top: savedScrollY, behavior: 'instant' });
            document.body.style.overflow = '';
        }, 60);
    }

    /* ─── Close panel (for rec-card navigation) ───────────────── */
    function closeDetailPanel(callback) {
        gsap.to(panel, {
            opacity: 0,
            duration: 0.3,
            ease: EASE_OUT,
            onComplete: () => {
                panel.innerHTML = '';
                if (callback) callback();
            }
        });
    }

    /* ═══════════════════════════════════════════════════════════
       TRAILER MODAL (mirrored from detail-film.blade.php)
    ══════════════════════════════════════════════════════════════ */
    window.__openTrailer = function (videoId) {
        let modal = document.getElementById('hero-trailer-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'hero-trailer-modal';
            modal.style.cssText = 'position:fixed;inset:0;z-index:20000;background:rgba(0,0,0,0.95);display:flex;align-items:center;justify-content:center;padding:16px;';
            modal.innerHTML = `
                <button onclick="window.__closeTrailer()" style="position:absolute;top:32px;right:32px;color:#fff;font-size:2rem;background:none;border:none;cursor:pointer;">&times;</button>
                <div style="width:100%;max-width:900px;aspect-ratio:16/9;position:relative;overflow:hidden;">
                    <iframe id="spa-trailer-iframe" src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1"
                        style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                        allow="autoplay;encrypted-media;picture-in-picture" allowfullscreen></iframe>
                </div>`;
            document.body.appendChild(modal);
        } else {
            const iframe = document.getElementById('spa-trailer-iframe');
            if (iframe) iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
        }
        document.body.style.overflow = 'hidden';
    };

    window.__closeTrailer = function () {
        const modal = document.getElementById('hero-trailer-modal');
        if (modal) { modal.remove(); document.body.style.overflow = ''; }
    };

    /* ═══════════════════════════════════════════════════════════
       GLOBAL SPINNER KEYFRAME (injected once)
    ══════════════════════════════════════════════════════════════ */
    if (!document.getElementById('sinemaku-spin-style')) {
        const style = document.createElement('style');
        style.id = 'sinemaku-spin-style';
        style.textContent = `
            @keyframes sinemaku-spin {
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    }

    /* ═══════════════════════════════════════════════════════════
       INIT
    ══════════════════════════════════════════════════════════════ */
    function init() {
        if (!overlay || !panel) return;
        initCardTriggers();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
