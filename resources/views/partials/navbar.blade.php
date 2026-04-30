{{-- resources/views/partials/navbar.blade.php --}}
{{-- Editorial Minimalist Navbar — Sinemaku Pictures 2026 Design --}}

{{-- ════════════════════════════════════════════════════════════════
FULLSCREEN MENU OVERLAY
════════════════════════════════════════════════════════════════ --}}
<div id="fullscreen-menu"
    class="fixed inset-0 z-[400] flex flex-col justify-center px-8 md:px-32 bg-brand-deepbreath transform -translate-y-full transition-transform duration-1000 ease-[cubic-bezier(0.85,0,0.15,1)]">

    <!-- Tombol Close -->
    <button id="close-menu-btn"
        class="absolute top-10 right-8 md:right-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold text-white/50 hover:text-white transition-colors cursor-none hover-target">
        [ Close ]
    </button>

    {{-- Language Switcher inside menu --}}
    <div class="absolute top-10 left-8 md:left-16 flex items-center gap-4">
        <button id="lang-switcher" aria-label="Switch language"
            class="font-sans text-[10px] tracking-[0.25em] uppercase font-bold text-white/50 hover:text-white transition-colors cursor-none hover-target"
            onmouseenter="window.__langSwitcherHover && window.__langSwitcherHover(this, true)"
            onmouseleave="window.__langSwitcherHover && window.__langSwitcherHover(this, false)"
            onclick="window.__langToggle && window.__langToggle()">
            <span class="lang-label">EN</span>
        </button>
    </div>

    <!-- Tautan Menu Utama -->
    <div class="flex flex-col space-y-1 md:space-y-2 font-serif mt-16 md:mt-0 max-h-[75vh] overflow-y-auto hide-scrollbar pb-10">
        @php
            $mainMenu = [
                ['title' => 'About', 'url' => '/', 'i18n' => 'menu_about'],
                [
                    'title' => 'Our Works',
                    'i18n' => 'menu_our_works',
                    'isDropdown' => true,
                    'children' => [
                        ['title' => 'Films', 'url' => '/films', 'i18n' => 'menu_films'],
                        ['title' => 'Web Series', 'url' => '/serial', 'i18n' => 'menu_web_series'],
                        ['title' => 'Television', 'url' => '/tv', 'i18n' => 'menu_television'],
                        ['title' => 'Documentaries', 'url' => '/documentary', 'i18n' => 'menu_documentaries'],
                    ]
                ],
                ['title' => 'Events', 'url' => '/events', 'i18n' => 'menu_events'],
                ['title' => 'Merch', 'url' => '/shops', 'i18n' => 'menu_merch'],
                ['title' => 'Community', 'url' => '/memberships', 'i18n' => 'menu_community'],
                ['title' => 'Articles', 'url' => '/article', 'i18n' => 'menu_articles'],
                ['title' => 'Careers', 'url' => '/career', 'i18n' => 'menu_careers'],
            ];
        @endphp

        @foreach($mainMenu as $index => $item)
            @if(isset($item['isDropdown']))
                <div class="relative w-max flex flex-col">
                    <button type="button" onclick="toggleDropdown('dropdown-{{ $index }}')"
                        class="menu-link flex items-center gap-4 transition-all duration-500 opacity-0 transform translate-y-[50px] text-[clamp(2.5rem,6vw,5rem)] text-white hover:text-brand-orange leading-[1.05] text-left cursor-none hover-target font-serif not-italic">
                        <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                        <span id="icon-dropdown-{{ $index }}" class="font-sans text-xl md:text-3xl font-light transform transition-transform duration-300 text-brand-orange">+</span>
                    </button>
                    <div id="dropdown-{{ $index }}" class="hidden flex-col pl-8 md:pl-16 space-y-1 md:space-y-2 mt-2 mb-4 overflow-hidden">
                        @foreach($item['children'] as $child)
                            <a href="{{ $child['url'] }}"
                                class="inline-block w-max transition-all duration-300 text-[clamp(1.5rem,4vw,3.5rem)] text-white/60 hover:text-brand-orange leading-[1.1] cursor-none hover-target font-serif not-italic">
                                <span data-i18n="{{ $child['i18n'] }}">{{ $child['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item['url'] }}"
                    class="menu-link inline-block w-max transition-all duration-500 opacity-0 transform translate-y-[50px] text-[clamp(2.5rem,6vw,5rem)] text-white hover:text-brand-orange leading-[1.05] cursor-none hover-target font-serif not-italic">
                    <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                </a>
            @endif
        @endforeach
    </div>

    <!-- Info Watermark Bawah -->
    <div class="absolute bottom-10 right-8 md:right-16">
        <span class="font-sans text-[9px] tracking-[0.2em] uppercase text-white/30">EST. 2020 • Jakarta, ID</span>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════════════
TOP NAVBAR
════════════════════════════════════════════════════════════════ --}}
<nav id="unified-navbar"
    class="fixed top-0 left-0 w-full z-[300] flex justify-between items-start px-8 md:px-16 py-10 transition-all duration-500 mix-blend-multiply text-brand-deepbreath">

    {{-- Brand (Left) --}}
    <a href="{{ route('welcome') ?? '/' }}"
        class="font-serif text-3xl tracking-tight leading-none relative z-10 transition-colors duration-300 text-brand-deepbreath hover:text-brand-orange cursor-none hover-target">
        Sinemaku<br>Pictures.
    </a>

    {{-- Right Controls --}}
    <div
        class="flex gap-12 md:gap-16 font-sans text-[10px] tracking-[0.25em] uppercase font-bold items-start text-brand-deepbreath/60">
        <div class="hidden md:flex flex-col gap-1 text-right">
            <span>Est. 2020</span>
            <span>Jakarta, ID</span>
        </div>
        
        {{-- Top Nav Language Switcher --}}
        <button class="font-sans text-[10px] tracking-[0.25em] uppercase font-bold text-brand-deepbreath/50 hover:text-brand-deepbreath/90 transition-colors relative z-10 cursor-none hover-target"
            onmouseenter="window.__langSwitcherHover && window.__langSwitcherHover(this, true)"
            onmouseleave="window.__langSwitcherHover && window.__langSwitcherHover(this, false)"
            onclick="window.__langToggle && window.__langToggle()">
            <span class="lang-label">EN</span>
        </button>

        <button id="menu-open-btn"
            class="hamburger-btn text-brand-deepbreath/60 hover:text-brand-orange transition-colors relative z-10 cursor-none hover-target">
            [ Menu ]
        </button>
    </div>

    <style>
        .is-nav-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</nav>

{{-- ════════════════════════════════════════════════════════════════
NAVBAR JAVASCRIPT
════════════════════════════════════════════════════════════════ --}}
<script>
    (function () {
        const openBtn = document.getElementById('menu-open-btn');
        const closeBtn = document.getElementById('close-menu-btn');
        const menu = document.getElementById('fullscreen-menu');
        const menuLinks = document.querySelectorAll('.menu-link');
        let isOpen = false;

        function openMenu() {
            isOpen = true;
            menu.style.transform = 'translateY(0)';
            document.body.style.overflow = 'hidden';

            // GSAP animate links in
            if (window.gsap) {
                gsap.to(menuLinks, {
                    y: 0, opacity: 1,
                    duration: 1, stagger: 0.07, ease: 'power4.out', delay: 0.35,
                    onStart: function () {
                        menuLinks.forEach(function (l) { l.style.opacity = '0'; });
                    }
                });
            } else {
                menuLinks.forEach(function (l, i) {
                    setTimeout(function () {
                        l.style.opacity = '1';
                        l.style.transform = 'translateY(0)';
                    }, 350 + i * 70);
                });
            }
        }

        function closeMenu() {
            isOpen = false;
            menu.style.transform = 'translateY(-100%)';
            document.body.style.overflow = '';
            // Reset for next open
            menuLinks.forEach(function (l) {
                l.style.opacity = '0';
                l.style.transform = 'translateY(50px)';
            });
            // Reset dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(function(el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
            });
            document.querySelectorAll('[id^="icon-dropdown-"]').forEach(function(el) {
                el.style.transform = 'rotate(0deg)';
            });
        }

        window.toggleDropdown = function(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('flex');
                icon.style.transform = 'rotate(45deg)';
                if (window.gsap) {
                    gsap.fromTo(dropdown.children, 
                        { opacity: 0, x: -20 },
                        { opacity: 1, x: 0, duration: 0.4, stagger: 0.05, ease: "power2.out" }
                    );
                }
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('flex');
                icon.style.transform = 'rotate(0deg)';
            }
        };

        if (openBtn) openBtn.addEventListener('click', function () { isOpen ? closeMenu() : openMenu(); });
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) closeMenu();
        });

        // ── SMART NAVBAR: HIDE ON SCROLL DOWN ──────────────────────────
        const navbar = document.getElementById('unified-navbar');
        let lastScrollTop = 0;

        window.addEventListener('scroll', function () {
            if (isOpen) return;
            let st = window.pageYOffset || document.documentElement.scrollTop;
            if (st < 100) {
                navbar.classList.remove('is-nav-hidden');
            } else if (st > lastScrollTop) {
                navbar.classList.add('is-nav-hidden');
            } else {
                navbar.classList.remove('is-nav-hidden');
            }
            lastScrollTop = st <= 0 ? 0 : st;
        }, { passive: true });
    })();
</script>

{{-- ════════════════════════════════════════════════════════════════
GLOBAL i18n ENGINE
════════════════════════════════════════════════════════════════ --}}
<script>
    (function () {
        const TRANSLATIONS = {
            menu_about: { en: 'About', id: 'Tentang' },
            menu_our_works: { en: 'Our Works', id: 'Karya Kami' },
            menu_films: { en: '↳ Films', id: '↳ Film' },
            menu_web_series: { en: '↳ Web Series', id: '↳ Serial Web' },
            menu_television: { en: '↳ Television', id: '↳ Televisi' },
            menu_documentaries: { en: '↳ Documentaries', id: '↳ Dokumenter' },
            menu_events: { en: 'Events', id: 'Acara' },
            menu_merch: { en: 'Merch', id: 'Merchandise' },
            menu_community: { en: 'Community', id: 'Komunitas' },
            menu_articles: { en: 'Articles', id: 'Artikel' },
            menu_careers: { en: 'Careers', id: 'Karier' },
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
            label_director: { en: 'Director', id: 'Sutradara' },
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
            label_explore_event: { en: 'Explore Event', id: 'Eksplorasi Event' },
            label_read_story: { en: 'Read Story', id: 'Baca Artikel' },
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
                'About': 'Tentang', 'Our Works': 'Karya Kami', 'Events': 'Acara',
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
            document.querySelectorAll('.lang-label').forEach(function(label) {
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