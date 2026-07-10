{{-- resources/views/partials/navbar.blade.php --}}
{{-- Editorial Minimalist Navbar — Sinemaku Pictures 2026 Design --}}

{{-- ════════════════════════════════════════════════════════════════
FULLSCREEN MENU OVERLAY
════════════════════════════════════════════════════════════════ --}}
<div id="fullscreen-menu"
    class="fixed inset-y-0 right-0 z-[400] w-full md:w-[45vw] max-w-[600px] flex flex-col justify-center px-8 md:px-16 bg-white/5 backdrop-blur-[8px] border-l border-white/20 shadow-[-10px_0_30px_rgba(0,0,0,0.15)]" style="transform: translateX(100%); will-change: transform; visibility: hidden;">

    <!-- Tombol Close -->
    <button id="close-menu-btn"
        class="absolute top-10 right-8 md:right-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy hover:text-brand-orange' : 'text-white hover:text-brand-navy' }} transition-colors cursor-none hover-target">
        [ X CLOSE ]
    </button>

    {{-- Language Switcher inside menu --}}
    <div class="absolute bottom-10 left-8 md:left-16 flex items-center gap-4">
        <button id="lang-switcher" aria-label="Switch language"
            class="font-sans text-[10px] tracking-[0.25em] uppercase font-bold {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy/50 hover:text-brand-orange' : 'text-white/50 hover:text-white' }} transition-colors cursor-none hover-target"
            onmouseenter="window.__langSwitcherHover && window.__langSwitcherHover(this, true)"
            onmouseleave="window.__langSwitcherHover && window.__langSwitcherHover(this, false)"
            onclick="window.__langToggle && window.__langToggle()">
            <span class="lang-label">EN</span>
        </button>
    </div>

    <!-- Tautan Menu Utama -->
    <div
        class="flex flex-col items-end space-y-2 md:space-y-4 font-peckham mt-16 md:mt-0 max-h-[80vh] overflow-y-auto hide-scrollbar pb-10 w-full relative z-10 pl-16">
        @php
            $mainMenu = [
                ['title' => 'HOME', 'url' => '/', 'i18n' => 'menu_about'],
                  ['title' => 'ABOUT','url' => route('tentang'),'i18n' => 'menu_tentang'
    ],
                [
                    'title' => 'OUR WORKS',
                    'i18n' => 'menu_our_works',
                    'isDropdown' => true,
                    'children' => [
                        ['title' => 'FILMS', 'url' => '/films', 'i18n' => 'menu_films_short'],
                        ['title' => 'WEB SERIES', 'url' => '/serial', 'i18n' => 'menu_web_series_short'],
                        ['title' => 'TELEVISION', 'url' => '/tv', 'i18n' => 'menu_television_short'],
                        ['title' => 'DOCUMENTARIES', 'url' => '/documentary', 'i18n' => 'menu_documentaries_short'],
                    ]
                ],
                // ['title' => 'EVENT', 'url' => '/events', 'i18n' => 'menu_events'],
[
    'title' => 'EVENTS',
    'i18n' => 'menu_events',
    'isDropdown' => true,
    'children' => [
        [
            'title' => 'GALA PREMIERE',
            'url' => route('events.gala'),
            'i18n' => 'menu_gala_premiere',
        ],
        [
            'title' => 'SINEMAKU DAY',
            'url' => route('events.sinemaku-day'),
            'i18n' => 'menu_sinemaku_day',
        ],
    ],
],

                ['title' => 'MERCH', 'url' => '/shop', 'i18n' => 'menu_merch'],
                ['title' => 'COMMUNITY', 'url' => '/membership', 'i18n' => 'menu_community'],
                ['title' => 'ARTICLE', 'url' => '/article', 'i18n' => 'menu_articles'],
                ['title' => 'CAREER', 'url' => '/careers', 'i18n' => 'menu_careers'],
            ];
        @endphp

        @foreach($mainMenu as $index => $item)
            @if(isset($item['isDropdown']))
                <div class="relative w-full flex flex-col items-end">
                    <button type="button" onclick="toggleDropdown('dropdown-{{ $index }}')"
                        class="menu-link flex items-center justify-end gap-2 md:gap-4 text-[clamp(1.5rem,2.5vw,2.5rem)] {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy hover:text-brand-orange' : 'text-white hover:text-brand-navy' }} leading-[1.05] text-right cursor-none hover-target font-peckham not-italic w-full uppercase" style="opacity:0; will-change: transform, opacity;">
                        <span id="icon-dropdown-{{ $index }}"
                            class="font-sans text-lg md:text-xl font-bold transform transition-transform duration-300 {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy' : 'text-white' }} mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                        <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                    </button>
                    <!-- Glass Pills Submenu -->
                    <div id="dropdown-{{ $index }}" class="flex flex-wrap justify-end gap-2 mt-4 max-w-[320px] pr-2">
                        @foreach($item['children'] as $child)
                            <a href="{{ $child['url'] }}"
                                class="inline-block transition-all duration-300 text-[10px] md:text-xs font-sans font-bold tracking-widest px-4 py-2 rounded-md cursor-none hover-target border shadow-sm uppercase {{ ($navTheme ?? '') === 'event' ? 'bg-brand-navy/5 hover:bg-brand-orange hover:border-brand-orange hover:text-white text-brand-navy border-brand-navy/20' : 'bg-white/10 hover:bg-brand-navy hover:text-white text-white border-white/20' }}">
                                <span data-i18n="{{ $child['i18n'] }}">{{ $child['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item['url'] }}"
                    @if(isset($item['trigger'])) onclick="{{ $item['trigger'] }}" @endif
                    class="menu-link inline-block w-max text-[clamp(1.5rem,2.5vw,2.5rem)] {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy hover:text-brand-orange' : 'text-white hover:text-brand-navy' }} leading-[1.05] cursor-none hover-target font-peckham not-italic text-right uppercase" style="opacity:0; will-change: transform, opacity;">
                    <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                </a>
            @endif
        @endforeach
    </div>

    <!-- Info Watermark Bawah -->
    <div class="absolute bottom-10 right-8 md:right-16 text-right">
        <span class="font-sans text-[9px] tracking-[0.2em] uppercase text-white/30 block">EST. 2020</span>
        <span class="font-sans text-[9px] tracking-[0.2em] uppercase text-white/30 block mt-1">Jakarta, ID</span>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════════════
TOP NAVBAR
════════════════════════════════════════════════════════════════ --}}
{{-- Initial Navbar (Absolute at top) --}}
<nav id="unified-navbar"
    class="absolute top-0 left-0 w-full z-[300] flex justify-between items-start px-8 md:px-16 py-10 transition-all duration-500 {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy' : 'text-white' }} bg-transparent">

    {{-- Brand (Left) --}}
    <a href="{{ route('welcome') ?? '/' }}" id="nav-logo"
        class="relative z-10 transition-transform duration-500 hover:scale-105 cursor-none hover-target">
        <img src="{{ asset(($navTheme ?? '') === 'event' ? 'img/logo-new.png' : 'img/sinemaku_horizontal.png') }}" alt="Sinemaku Pictures"
            class="h-8 md:h-10 object-contain logo-img transition-all duration-500">
    </a>

    {{-- Right Controls --}}
    <div id="nav-controls"
        class="flex gap-12 md:gap-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold items-start {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy' : 'text-white' }} transition-colors duration-500">
        <div class="hidden md:flex flex-col gap-1 text-right opacity-90">
            <span>Est. 2020</span>
            <span>Jakarta, ID</span>
        </div>

        {{-- Top Nav Language Switcher --}}
        <button
            class="font-sans text-[10px] tracking-[0.25em] uppercase font-bold {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy' : 'text-white' }} opacity-90 hover:opacity-100 transition-colors relative z-10 cursor-none hover-target"
            onmouseenter="window.__langSwitcherHover && window.__langSwitcherHover(this, true)"
            onmouseleave="window.__langSwitcherHover && window.__langSwitcherHover(this, false)"
            onclick="window.__langToggle && window.__langToggle()">
            <span class="lang-label">EN</span>
        </button>

        <button id="menu-open-btn"
            class="hamburger-btn {{ ($navTheme ?? '') === 'event' ? 'text-brand-navy' : 'text-white' }} opacity-90 hover:opacity-100 transition-colors relative z-10 cursor-none hover-target">
            [ Menu ]
        </button>
    </div>

    <style>
        .is-nav-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Fix background color for fullscreen state */
        #sticky-navbar.is-expanded {
            background-color: #0E1633; /* Pastikan solid saat fullscreen */
        }
    </style>
</nav>

{{-- ════════════════════════════════════════════════════════════════
STICKY MORPHING NAVBAR (THE "PONI")
════════════════════════════════════════════════════════════════ --}}
<nav id="sticky-navbar"
    class="fixed top-6 left-1/2 z-[350] w-[90%] max-w-[800px] h-[64px] bg-[#0E1633] rounded-2xl flex flex-col items-center justify-start shadow-2xl border border-white/10 overflow-hidden"
    style="opacity: 0; visibility: hidden; will-change: transform, width, height, top, border-radius;">

    {{-- Header: Always visible, stable centering --}}
    <div id="sticky-header" class="w-full flex justify-between items-center px-6 md:px-10 h-[64px] shrink-0 transition-colors duration-300">
        {{-- Left --}}
        <div class="basis-1/3 flex justify-start">
            <a href="/films" class="font-sans text-[10px] md:text-[11px] tracking-[0.2em] uppercase font-bold text-white/80 hover:text-white transition-colors cursor-none hover-target">
                Our Works
            </a>
        </div>

                        {{-- Center Logo --}}
        <div class="basis-1/3 flex justify-center">
            <a href="/" class="transition-transform hover:scale-110 cursor-none hover-target">
                <img src="{{ asset('img/logo-sinemaku.png') }}" alt="Sinemaku" class="h-8 md:h-10 w-auto relative z-10">
            </a>
        </div>

        {{-- Right Controls --}}
        <div class="basis-1/3 flex justify-end">
            <button id="menu-open-sticky" class="group flex items-center gap-3 cursor-none hover-target relative h-[24px]">
                <div class="relative w-[80px] h-full flex items-center justify-end">
                    <span id="sticky-menu-text" class="absolute right-0 top-1/2 -translate-y-1/2 font-sans text-[10px] md:text-[11px] tracking-[0.2em] uppercase font-bold text-white/80 transition-colors duration-300">Menu</span>
                    <span id="sticky-close-text" class="absolute right-0 top-1/2 -translate-y-1/2 font-sans text-[10px] md:text-[11px] tracking-[0.2em] uppercase font-bold text-white/80 opacity-0 pointer-events-none translate-x-4 transition-colors duration-300 whitespace-nowrap">[ CLOSE ]</span>
                </div>
                <div id="sticky-menu-icon" class="flex flex-col gap-1 transition-colors duration-300 origin-right">
                    <div class="w-4 h-[1.5px] bg-white"></div>
                    <div class="w-4 h-[1.5px] bg-white"></div>
                </div>
            </button>
        </div>
    </div>

    {{-- Center Links (Hidden by default, triggered by GSAP) --}}
    <div id="sticky-links-container" class="hidden flex-1 w-full flex-col items-center justify-center opacity-0 overflow-y-auto hide-scrollbar pb-20">
        <div class="flex flex-col items-center space-y-6 md:space-y-8 font-peckham w-full max-w-[90vw]">
            @foreach($mainMenu as $index => $item)
                @if(isset($item['isDropdown']))
                    <div class="flex flex-col items-center w-full">
                        <button type="button" onclick="toggleStickyDropdown('sticky-drop-{{ $index }}')"
                            class="sticky-menu-link flex items-center justify-center gap-4 text-[clamp(2rem,5vw,4rem)] text-white hover:text-brand-orange transition-colors duration-300 font-peckham uppercase leading-tight transform translate-y-8 opacity-0">
                            <span>{{ $item['title'] }}</span>
                            <span id="icon-sticky-drop-{{ $index }}" class="transition-transform duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div id="sticky-drop-{{ $index }}" class="hidden flex-wrap justify-center gap-3 mt-8 max-w-[600px] px-4">
                            @foreach($item['children'] as $child)
                                <a href="{{ $child['url'] }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-md font-sans font-bold tracking-widest text-xs border border-white/10 uppercase">
                                    {{ $child['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['url'] }}"
                        @if(isset($item['trigger'])) onclick="{{ $item['trigger'] }}" @endif
                        class="sticky-menu-link text-[clamp(2rem,5vw,4rem)] text-white hover:text-brand-orange transition-colors duration-300 font-peckham uppercase leading-tight transform translate-y-8 opacity-0">
                        {{ $item['title'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</nav>

<script>
    (function () {
        const openBtn = document.getElementById('menu-open-btn');
        const closeBtn = document.getElementById('close-menu-btn');
        const menu = document.getElementById('fullscreen-menu');
        const menuLinks = document.querySelectorAll('.menu-link');
        let isOpen = false;

        // Pre-set menu links so GSAP owns the transform from the start
        if (window.gsap) {
            gsap.set(menuLinks, { x: 60, opacity: 0, force3D: true });
        }

        function openMenu() {
            isOpen = true;
            document.body.style.overflow = 'hidden';
            menu.style.visibility = 'visible';

            if (window.gsap) {
                // Slide the panel in with GSAP (not CSS transition)
                gsap.to(menu, {
                    x: 0, duration: 0.9, ease: 'expo.inOut', force3D: true,
                    onComplete: function() { menu.style.willChange = 'auto'; }
                });
                // Stagger links in after panel lands
                gsap.to(menuLinks, {
                    x: 0, opacity: 1, force3D: true,
                    duration: 0.8, stagger: 0.07, ease: 'power4.out', delay: 0.3
                });
            } else {
                menu.style.transform = 'translateX(0)';
                menuLinks.forEach(function (l, i) {
                    setTimeout(function () { l.style.opacity = '1'; l.style.transform = 'none'; }, 350 + i * 70);
                });
            }
        }

        function closeMenu() {
            isOpen = false;
            document.body.style.overflow = '';

            if (window.gsap) {
                gsap.to(menuLinks, { x: 40, opacity: 0, force3D: true, duration: 0.25, stagger: 0.03, ease: 'power2.in' });
                gsap.to(menu, {
                    x: '100%', duration: 0.75, ease: 'expo.inOut', force3D: true, delay: 0.1,
                    onComplete: function() {
                        menu.style.visibility = 'hidden';
                        // Reset dropdowns
                        document.querySelectorAll('[id^="dropdown-"]').forEach(function (el) {
                            el.classList.add('hidden'); el.classList.remove('flex');
                        });
                        document.querySelectorAll('[id^="icon-dropdown-"]').forEach(function (el) {
                            el.style.transform = 'rotate(90deg)';
                        });
                        // Re-set links for next open
                        gsap.set(menuLinks, { x: 60, opacity: 0, force3D: true });
                    }
                });
            } else {
                menu.style.transform = 'translateX(100%)';
                menu.style.visibility = 'hidden';
                menuLinks.forEach(function (l) { l.style.opacity = '0'; l.style.transform = 'translateX(60px)'; });
            }
        }

        window.toggleDropdown = function (id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('flex');
                icon.style.transform = 'rotate(-90deg)';
                if (window.gsap) {
                    gsap.fromTo(dropdown.children,
                        { opacity: 0, y: -10 },
                        { opacity: 1, y: 0, duration: 0.4, stagger: 0.05, ease: "power2.out" }
                    );
                }
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('flex');
                icon.style.transform = 'rotate(90deg)';
            }
        };

        // ── MENU STYLE 1 LOGIC (Initial Navbar) ───────
        if (openBtn) openBtn.addEventListener('click', function () { isOpen ? closeMenu() : openMenu(); });
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                if (isOpen) closeMenu();
                if (isStickyMenuOpen) closeStickyMenu();
            }
        });

    // ── MORPHING STICKY MENU LOGIC ──────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const stickyNav = document.getElementById('sticky-navbar');
        const stickyHeader = document.getElementById('sticky-header');
        const stickyMenuText = document.getElementById('sticky-menu-text');
        const stickyCloseText = document.getElementById('sticky-close-text');
        const stickyMenuIcon = document.getElementById('sticky-menu-icon');
        const stickyLinksContainer = document.getElementById('sticky-links-container');
        const stickyLinks = document.querySelectorAll('.sticky-menu-link');
        const unifiedNav = document.getElementById('unified-navbar');
        let isStickyMenuOpen = false;

        // Initialize position - set autoAlpha 0 here since we hide it with CSS initially
        // but we want GSAP to control it from now on.
        gsap.set(stickyNav, { yPercent: -150, xPercent: -50, left: '50%', autoAlpha: 0 });

        function openStickyMenu() {
            if (isStickyMenuOpen) return;
            isStickyMenuOpen = true;
            document.body.style.overflow = 'hidden';

            const tl = gsap.timeline({ defaults: { ease: "expo.inOut", duration: 0.85, force3D: true } });

            tl.to(stickyNav, {
                width: '100%',
                maxWidth: '100%',
                height: '100dvh',
                top: 0,
                borderRadius: 0,
                autoAlpha: 1,
                onStart: () => {
                    stickyNav.classList.add('is-expanded');
                    stickyLinksContainer.style.display = 'flex';
                }
            });

            tl.to(stickyHeader, { paddingTop: '2.5rem', paddingBottom: '2.5rem' }, 0);
            tl.to([stickyMenuText, stickyMenuIcon], { opacity: 0, x: -20, duration: 0.4 }, 0);
            tl.to(stickyCloseText, { opacity: 1, x: 0, pointerEvents: 'auto', duration: 0.4 }, 0.4);

            tl.to(stickyLinksContainer, { opacity: 1, duration: 0.3 }, 0.5);
            tl.fromTo(stickyLinks,
                { y: 40, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.7, stagger: 0.06, ease: "power4.out" },
                0.6
            );
        }

        function closeStickyMenu() {
            if (!isStickyMenuOpen) return;
            isStickyMenuOpen = false;
            document.body.style.overflow = '';

            const tl = gsap.timeline({ defaults: { ease: "expo.inOut", duration: 0.8, force3D: true } });

            tl.to(stickyLinks, { opacity: 0, y: 20, duration: 0.3 });
            tl.to(stickyLinksContainer, { opacity: 0, duration: 0.3 }, 0.1);

            tl.to(stickyNav, {
                width: '90%',
                maxWidth: '800px',
                height: '64px',
                top: '1.5rem',
                borderRadius: '1rem',
                onComplete: () => {
                    stickyNav.classList.remove('is-expanded');
                    stickyLinksContainer.style.display = 'none';
                }
            }, 0.2);

            tl.to(stickyHeader, { paddingTop: '0', paddingBottom: '0' }, 0.2);
            tl.to(stickyCloseText, { opacity: 0, x: 10, pointerEvents: 'none', duration: 0.3 }, 0.2);
            tl.to([stickyMenuText, stickyMenuIcon], { opacity: 1, x: 0, duration: 0.4 }, 0.5);
        }

        const openStickyBtn = document.getElementById('menu-open-sticky');
        if (openStickyBtn) {
            openStickyBtn.addEventListener('click', () => isStickyMenuOpen ? closeStickyMenu() : openStickyMenu());
        }

        window.toggleStickyDropdown = function (id) {
            const el = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            if (el.classList.contains('hidden')) {
                el.classList.remove('hidden');
                el.classList.add('flex');
                icon.style.transform = 'rotate(180deg)';
                gsap.fromTo(el.children, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.4, stagger: 0.05 });
            } else {
                el.classList.add('hidden');
                el.classList.remove('flex');
                icon.style.transform = 'rotate(0deg)';
            }
        };

                        // ── SMART NAVBAR: SCROLL LOGIC (REVISI) ──────────────────────────
        // Logika:
        // - Scroll ke bawah > 80px: navbar statis hilang (ketarik ke atas), poni tidak muncul
        // - Scroll ke ATAS (dimana saja, kecuali di top): navbar poni muncul
        // - Sampai di top (scroll <= 10px): navbar poni hilang, navbar statis muncul kembali
        // - Scroll ke bawah lagi (saat poni sedang muncul): poni ikut menghilang
        let lastScrollY = window.scrollY;
        let poniState = 'hidden';

        function hidePoni() {
            if (poniState === 'hidden') return;
            poniState = 'hidden';
            gsap.to(stickyNav, {
                yPercent: -150,
                autoAlpha: 0,
                duration: 0.4,
                ease: "power3.in",
                overwrite: true
            });
        }

        function showPoni() {
            if (poniState === 'visible' || isStickyMenuOpen) return;
            poniState = 'visible';
            unifiedNav.classList.add('is-nav-hidden');
            gsap.to(stickyNav, {
                yPercent: 0,
                autoAlpha: 1,
                duration: 0.5,
                ease: "power3.out",
                overwrite: true
            });
        }

                window.addEventListener('scroll', function() {
            const currentScrollY = window.scrollY;
            const scrollingDown = currentScrollY > lastScrollY;
            const scrollingUp = currentScrollY < lastScrollY;

            if (currentScrollY <= 10) {
                // Di TOP: statis muncul, poni hilang
                unifiedNav.classList.remove('is-nav-hidden');
                hidePoni();
            }
            else if (scrollingDown && currentScrollY > 80) {
                // Scroll ke BAWAH: statis hilang, poni ikut hilang
                if (!isStickyMenuOpen) {
                    unifiedNav.classList.add('is-nav-hidden');
                    hidePoni();
                }
            }
            else if (scrollingUp && currentScrollY > 10) {
                // Scroll ke ATAS (tidak di top): poni muncul
                if (!isStickyMenuOpen) {
                    showPoni();
                }
            }

            lastScrollY = currentScrollY;
        });
    });
    })();
</script>

{{-- ════════════════════════════════════════════════════════════════
GLOBAL i18n ENGINE
════════════════════════════════════════════════════════════════ --}}
<script>
    (function () {
        const TRANSLATIONS = {
            menu_about: { en: 'Home', id: 'Beranda' },
            menu_our_works: { en: 'Our Works', id: 'Karya Kami' },
            menu_films: { en: '↳ Films', id: '↳ Film' },
            menu_films_short: { en: 'Films', id: 'Film' },
            menu_web_series: { en: '↳ Web Series', id: '↳ Serial' },
            menu_web_series_short: { en: 'Web Series', id: 'Serial' },
            menu_television: { en: '↳ Television', id: '↳ Televisi' },
            menu_television_short: { en: 'Television', id: 'Televisi' },
            menu_documentaries: { en: '↳ Documentaries', id: '↳ Dokumenter' },
            menu_documentaries_short: { en: 'Documentaries', id: 'Dokumenter' },
            menu_events: { en: 'Events', id: 'Kegiatan Sinemaku' },
            menu_merch: { en: 'Merch', id: 'Merch' },
            menu_community: { en: 'Community', id: 'Komunitas' },
            menu_articles: { en: 'Articles', id: 'Artikel' },
            menu_careers: { en: 'Careers', id: 'Pintu Terbuka' },
            nav_cta: { en: 'get in touch', id: 'hubungi kami' },
            footer_brand_desc: { en: 'Creating cinematic experiences that challenge conventions and inspire new perspectives. We are storytellers, dreamers, and rebels with cameras.', id: 'Menciptakan pengalaman sinematik yang menantang konvensi dan menginspirasi perspektif baru. Kami adalah pencerita, pemimpi, dan pemberontak berkamera.' },
            footer_navigation: { en: 'Navigation', id: 'Navigasi' },
            footer_connect: { en: 'Connect', id: 'Terhubung' },
            footer_follow_us: { en: 'Follow Us', id: 'Ikuti Kami' },
            footer_home: { en: 'Home', id: 'Beranda' },
            footer_films: { en: 'Films', id: 'Film' },
            footer_serial: { en: 'Serial', id: 'Serial' },
            footer_shop: { en: 'Shop', id: 'Toko' },
            footer_articles: { en: 'Articles', id: 'Artikel' },
            footer_events: { en: 'Events', id: 'Acara' },
            footer_careers: { en: 'Careers', id: 'Karier' },
            footer_community: { en: 'Community', id: 'Komunitas' },
            footer_copyright: { en: '© 2026 Sinemaku Pictures. All rights reserved.', id: '© 2026 Sinemaku Pictures. Hak cipta dilindungi.' },
            footer_privacy: { en: 'Privacy Policy', id: 'Kebijakan Privasi' },
            footer_terms: { en: 'Terms of Service', id: 'Syarat Layanan' },
            footer_cookies: { en: 'Cookies', id: 'Cookie' },
            home_events_eyebrow: { en: 'Upcoming Events', id: 'Acara Mendatang' },
            home_get_ticket: { en: 'Get Tickets', id: 'Dapatkan Tiket' },
            home_latest_film: { en: 'Latest Films', id: 'Film Terbaru' },
            home_see_all_films: { en: 'See All Films', id: 'Lihat Semua Film' },
            home_merch_eyebrow: { en: 'Sinemaku Store', id: 'Sinemaku Store' },
            home_buy_now: { en: 'Buy Now', id: 'Beli Sekarang' },
            home_serial_eyebrow: { en: 'Web Series', id: 'Serial Web' },
            home_see_serials: { en: 'See More Series', id: 'Lihat Serial Lainnya' },
            home_article_eyebrow: { en: 'Latest Articles', id: 'Artikel Terbaru' },
            home_read_articles: { en: 'Read More Articles', id: 'Baca Artikel Lainnya' },
            home_tv_eyebrow: { en: 'Television', id: 'Tayangan Televisi' },
            home_see_tv: { en: 'See More Shows', id: 'Lihat Tayangan Lainnya' },
            home_community_eyebrow: { en: 'Community', id: 'Komunitas' },
            home_community_title: { en: 'Join the Movement', id: 'Bergabung dalam Gerakan' },
            home_unlock_exp: { en: 'Unlock the Experience', id: 'Buka Pengalaman Ini' },
            about_cta_company: { en: 'ABOUT OUR COMPANY', id: 'TENTANG PERUSAHAAN' },
            about_cta_team: { en: 'MEET OUR TEAM', id: 'TEMUI TIM KAMI' },
            about_read_more: { en: 'Read More', id: 'Selengkapnya' },
            about_meet_link: { en: 'meet our team ...', id: 'temui tim kami ...' },
            about_team_eyebrow: { en: 'Team', id: 'Tim' },
            about_team_heading: { en: 'Orang-orang di balik kamera.', id: 'Orang-orang di balik kamera.' },
            about_wwd_eyebrow: { en: 'What We Do', id: 'Apa yang Kami Lakukan' },
            about_wwd_heading: { en: 'More than just creating works.', id: 'Bukan hanya sekadar membuat karya.' },
            about_collab_eyebrow: { en: 'Collaboration', id: 'Kolaborasi' },
            about_collab_heading: { en: 'Have a great project to work on together?', id: 'Ada proyek hebat yang bisa dikerjakan bersama?' },
            label_director: { en: 'DIRECTOR', id: 'Sutradara' },
            label_minutes: { en: 'minutes', id: 'menit' },
            label_episode: { en: 'Episode', id: 'Episode' },
            label_season: { en: 'Season', id: 'Musim' },
            page_our_films: { en: 'OUR FILMS', id: 'FILM KAMI' },
            page_our_series: { en: 'OUR SERIES', id: 'SERIAL KAMI' },
            page_our_tv: { en: 'OUR TV SHOWS', id: 'TAYANGAN TV KAMI' },
            page_our_docs: { en: 'OUR DOCUMENTARIES', id: 'DOKUMENTER KAMI' },
            page_catalog_1: { en: 'Work', id: 'Katalog' },
            page_catalog_2: { en: 'Catalogue.', id: 'Karya.' },
            page_series_1: { en: 'Our', id: 'Katalog' },
            page_series_2: { en: 'Series.', id: 'Serial.' },
            page_tv_1: { en: 'Our', id: 'Katalog' },
            page_tv_2: { en: 'Television.', id: 'TV.' },
            page_docs_1: { en: 'Our', id: 'Katalog' },
            page_docs_2: { en: 'Documentaries.', id: 'Dokumenter.' },
            detail_episodes: { en: 'Episodes List.', id: 'Daftar Episode.' },
            page_articles_1: { en: 'Our', id: 'Katalog' },
            page_articles_2: { en: 'Articles.', id: 'Artikel.' },
            page_community_1: { en: 'Our', id: 'Gabung' },
            page_community_2: { en: 'Community.', id: 'Komunitas.' },
            membership_form_title: { en: 'Join the Family.', id: 'Gabung Keluarga Kami.' },
            membership_form_subtitle: { en: 'Fill in your details below to get exclusive access.', id: 'Isi detail Anda di bawah untuk akses eksklusif.' },
            label_first_name: { en: 'First Name', id: 'Nama Depan' },
            label_last_name: { en: 'Last Name', id: 'Nama Belakang' },
            label_birth_date: { en: 'Date of Birth', id: 'Tanggal Lahir' },
            label_email: { en: 'Email Address', id: 'Alamat Email' },
            label_city: { en: 'City', id: 'Kota' },
            label_phone: { en: 'Mobile Phone', id: 'Nomor HP' },
            label_submit_membership: { en: 'Count Me In', id: 'Daftarkan Saya' },
            page_careers_1: { en: 'Our', id: 'Jelajahi' },
            page_careers_2: { en: 'Careers.', id: 'Karier.' },
            label_open_positions: { en: 'Open Positions', id: 'Posisi Terbuka' },
            label_casting_calls: { en: 'Casting Calls', id: 'Panggilan Casting' },
            label_apply_now: { en: 'Apply For This Position', id: 'Lamar Posisi Ini' },
            label_other_openings: { en: 'Other Openings', id: 'Lowongan Lainnya' },
            label_explore_event: { en: 'Explore Event', id: 'Eksplorasi Event' },
            label_read_story: { en: 'Read Story', id: 'Baca Artikel' },
            label_article_source: { en: 'Source', id: 'Sumber' },
            label_article_ref: { en: 'Article Reference', id: 'Referensi Artikel' },
            label_read_full_story: { en: 'Read Full Story', id: 'Baca Selengkapnya' },
            label_author: { en: 'Author', id: 'Penulis' },
            label_date: { en: 'Date', id: 'Tanggal' },
            label_top_stories: { en: 'Top Stories', id: 'Berita Populer' },
            label_back_to_articles: { en: 'Back to Articles', id: 'Kembali ke Artikel' },
            label_visit_source: { en: 'Read full story on', id: 'Baca selengkapnya di' },
            detail_watch_trailer: { en: 'Watch Trailer', id: 'Tonton Trailer' },
            detail_director: { en: 'Director', id: 'Sutradara' },
            detail_cast: { en: 'Cast', id: 'Pemeran' },
            detail_duration: { en: 'Duration', id: 'Durasi' },
            detail_language: { en: 'Language', id: 'Bahasa' },
            detail_and_more: { en: 'and more...', id: 'dan lainnya...' },
            detail_lang_value: { en: 'Indonesian', id: 'Bahasa Indonesia' },
            detail_narrative: { en: 'The Narrative.', id: 'Narasi.' },
            detail_still_shots: { en: 'Still Shots.', id: 'Cuplikan.' },
            detail_recommendations: { en: 'You might also enjoy.', id: 'Mungkin Anda juga suka.' },
        };

        const STORAGE_KEY = 'sinemaku_lang';
        let currentLang = localStorage.getItem(STORAGE_KEY) || 'en';

        const TEXT_MAP = {
            id: {
                'About': 'Mengapa Kami Ada', 'Our Works': 'Karya Kami', 'Events': 'Acara',
                'Merch': 'Merchandise', 'Articles': 'Artikel', 'Careers': 'Karier',
                'Home': 'Beranda', 'Community': 'Komunitas', 'Films': 'Film',
                'Web Series': 'Serial Web', 'Television': 'Televisi', 'Documentaries': 'Dokumenter',
                'get in touch': 'hubungi kami', 'Get in Touch': 'Hubungi Kami',
                'Navigation': 'Navigasi', 'Connect': 'Terhubung', 'Follow Us': 'Ikuti Kami',
                '© 2026 Sinemaku Pictures. All rights reserved.': '© 2026 Sinemaku Pictures. Hak cipta dilindungi.',
                'Privacy Policy': 'Kebijakan Privasi', 'Terms of Service': 'Syarat Layanan', 'Cookies': 'Cookie',
                'Read More': 'Selengkapnya', 'See More': 'Lihat Lainnya', 'View All': 'Lihat Semua',
                'Buy Now': 'Beli Sekarang', 'Watch Now': 'Tonton Sekarang', 'Watch Trailer': 'Tonton Trailer',
                'ABOUT OUR COMPANY': 'TENTANG PERUSAHAAN', 'MEET OUR TEAM': 'TEMUI TIM KAMI',
                'What We Do': 'Apa yang Kami Lakukan', 'Kolaborasi': 'Kolaborasi',
                'meet our team ...': 'temui tim kami ...', 'Upcoming Events': 'Acara Mendatang',
                'Director': 'Sutradara', 'Duration': 'Durasi', 'Genre': 'Genre',
                'Synopsis': 'Sinopsis', 'Cast': 'Pemeran', 'Release Date': 'Tanggal Rilis',
                'All Films': 'Semua Film', 'All': 'Semua',
                'Get Tickets': 'Dapatkan Tiket', 'Get Ticket': 'Dapatkan Tiket',
                'Join Now': 'Gabung Sekarang', 'Subscribe': 'Berlangganan',
            },
            en: {}
        };
        Object.keys(TEXT_MAP.id).forEach(function (k) {
            var v = TEXT_MAP.id[k];
            if (v !== k) TEXT_MAP.en[v] = k;
        });

        function collectTextNodes(root) {
            var nodes = [];
            var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, {
                acceptNode: function (node) {
                    var p = node.parentElement;
                    if (!p) return NodeFilter.FILTER_REJECT;
                    var tag = p.tagName;
                    if (tag === 'SCRIPT' || tag === 'STYLE' || tag === 'NOSCRIPT') return NodeFilter.FILTER_REJECT;
                    if (node.textContent.trim() === '') return NodeFilter.FILTER_SKIP;
                    return NodeFilter.FILTER_ACCEPT;
                }
            });
            var n;
            while ((n = walker.nextNode())) nodes.push(n);
            return nodes;
        }

        function applyTextMap(lang) {
            var map = TEXT_MAP[lang];
            if (!map) return;
            collectTextNodes(document.body).forEach(function (node) {
                var trimmed = node.textContent.trim();
                if (map[trimmed] !== undefined) {
                    node.textContent = node.textContent.replace(trimmed, map[trimmed]);
                    return;
                }
                Object.keys(map).forEach(function (phrase) {
                    if (phrase.length < 3) return;
                    if (trimmed.toLowerCase() === phrase.toLowerCase()) {
                        node.textContent = node.textContent.replace(new RegExp(phrase, 'i'), map[phrase]);
                    }
                });
            });
        }

        // Ubah logika hover untuk JS (warna inline dibuang karena sudah pakai Tailwind Hover)
        window.__langSwitcherHover = function (btn, isEnter) {
            var label = btn.querySelector('.lang-label');
            if (!label) return;
            if (isEnter) {
                label.textContent = currentLang === 'en' ? 'ID' : 'EN';
            } else {
                label.textContent = currentLang.toUpperCase();
            }
        };

        window.__langToggle = function () {
            currentLang = currentLang === 'en' ? 'id' : 'en';
            localStorage.setItem(STORAGE_KEY, currentLang);
            applyLang(currentLang);
        };

        function applyLang(lang) {
            document.querySelectorAll('[data-i18n]').forEach(function (el) {
                var key = el.getAttribute('data-i18n');
                if (TRANSLATIONS[key] && TRANSLATIONS[key][lang]) el.textContent = TRANSLATIONS[key][lang];
            });
            document.querySelectorAll('.dynamic-i18n').forEach(function (el) {
                var text = el.getAttribute('data-lang-' + lang);
                if (text !== null && text !== '') el.innerHTML = text;
            });
            applyTextMap(lang);
            document.querySelectorAll('.lang-label').forEach(function (label) {
                label.textContent = lang.toUpperCase();
            });
        }

        function init() { applyLang(currentLang); }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else { init(); }

        window.__i18n = { apply: applyLang, t: TRANSLATIONS, getCurrent: function () { return currentLang; } };
    })();
</script>

<style>
    /* Navbar Theme Styles */
    #unified-navbar.nav-light {
        color: var(--color-regal-navy);
        /* New Brand Navy */
    }

    #unified-navbar.nav-dark {
        color: var(--color-autumn-leaf);
        /* New Brand Orange */
    }

    /* Ensure the hamburger button also inherits color */
    #menu-toggle-btn,
    #menu-open-btn {
        color: inherit;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Wait for GSAP to be available
        setTimeout(() => {
            if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

            const navbar = document.getElementById('unified-navbar');

            // Function to switch navbar theme
            const setNavTheme = (isDark) => {
                if (isDark) {
                    navbar.classList.remove('nav-light');
                    navbar.classList.add('nav-dark');
                } else {
                    navbar.classList.remove('nav-dark');
                    navbar.classList.add('nav-light');
                }
            };

            // Automatically detect dark sections
            // Refined selectors: include almost all media containers and dark backgrounds
            const darkSections = document.querySelectorAll('.bg-brand-navy, section.hero-media, .bg-black, section.relative.h-\\[60vh\\], section.relative.h-\\[80vh\\], .reveal-image, .img-container, .hero-parallax-img');

            darkSections.forEach(section => {
                ScrollTrigger.create({
                    trigger: section,
                    start: "top 100px", // Trigger when the section reaches the bottom of the logo
                    end: "bottom 100px",
                    onEnter: () => setNavTheme(true),
                    onLeave: () => setNavTheme(false),
                    onEnterBack: () => setNavTheme(true),
                    onLeaveBack: () => setNavTheme(false)
                });
            });
        }, 500);
    });
</script>

