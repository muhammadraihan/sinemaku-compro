{{-- resources/views/partials/navbar.blade.php --}}

{{-- ============================================================
    SIDEBAR MENU (slides in from left)
    ============================================================ --}}
<div id="sidebar-menu"
    class="fixed top-0 left-0 w-[300px] md:w-[380px] h-full z-[200] flex flex-col justify-center px-10 md:px-14 border-r border-white/10 pt-20 transform -translate-x-full"
    style="background: #0b0a1a; border-right-color: rgba(112,105,199,0.18); transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);">
    @php
        $menuItems = [
            ['title' => 'About',      'url' => '/',            'i18n' => 'menu_about'],
            [
                'title' => 'Our Works', 
                'url' => '#',
                'id' => 'works-toggle',
                'i18n' => 'menu_our_works',
                'subItems' => [
                    ['title' => 'Films',         'url' => '/films',       'i18n' => 'menu_films'],
                    ['title' => 'Web Series',    'url' => '/serial',      'i18n' => 'menu_web_series'],
                    ['title' => 'Television',    'url' => '/tv',          'i18n' => 'menu_television'],
                    ['title' => 'Documentaries', 'url' => '/documentary', 'i18n' => 'menu_documentaries'],
                ]
            ],
            ['title' => 'Events',     'url' => '/events',      'i18n' => 'menu_events'],
            ['title' => 'Merch',      'url' => '/shops',       'i18n' => 'menu_merch'],
            ['title' => 'Community',  'url' => '/memberships', 'i18n' => 'menu_community'],
            ['title' => 'Articles',   'url' => '/article',     'i18n' => 'menu_articles'],
            ['title' => 'Careers',    'url' => '/career',      'i18n' => 'menu_careers'],
        ];
    @endphp
    <div class="flex flex-col space-y-4 text-left font-display font-medium text-3xl text-white">
        @foreach($menuItems as $item)
            @php
                $isActive = !isset($item['subItems']) && request()->is(ltrim($item['url'], '/'));
                $hasSub = isset($item['subItems']);
            @endphp
            
            @if($hasSub)
                <div class="flex flex-col">
                    <button id="{{ $item['id'] }}"
                        class="menu-link opacity-0 -translate-x-8 text-left transition-colors duration-300 text-white/40 hover:text-white group inline-flex items-center"
                        style="transition: color 0.3s ease, opacity 0.4s ease, transform 0.4s ease;"
                        onmouseenter="this.style.color='#ed9520'"
                        onmouseleave="this.style.color='rgba(255,255,255,0.4)'">
                        <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                        <span class="ml-4 text-[18px] transition-transform duration-300 inline-block origin-center" id="works-arrow">▷</span>
                    </button>
                    
                    <div id="works-submenu" class="flex flex-col space-y-2 mt-4 ml-6 overflow-hidden max-h-0 transition-all duration-500 ease-in-out opacity-0">
                        @foreach($item['subItems'] as $sub)
                            <a href="{{ $sub['url'] }}" 
                               class="text-xl text-white/30 hover:text-white transition-colors duration-300"
                               onmouseenter="this.style.color='#ed9520'"
                               onmouseleave="this.style.color='rgba(255,255,255,0.3)'">
                                <span data-i18n="{{ $sub['i18n'] }}">{{ $sub['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item['url'] }}"
                    class="menu-link opacity-0 -translate-x-8 transition-colors duration-300 {{ $isActive ? 'text-white' : 'text-white/40 hover:text-white/80' }}"
                    style="transition: color 0.3s ease, opacity 0.4s ease, transform 0.4s ease;"
                    onmouseenter="if(!{{ $isActive ? 'true' : 'false' }}) this.style.color='#ed9520'"
                    onmouseleave="if(!{{ $isActive ? 'true' : 'false' }}) this.style.color='rgba(255,255,255,0.4)'">
                    <span data-i18n="{{ $item['i18n'] }}">{{ $item['title'] }}</span>
                </a>
            @endif
        @endforeach
    </div>

    <div class="mt-16 flex space-x-6 opacity-0 menu-socials items-center text-white/50 text-[10px] tracking-widest uppercase"
         style="transition: opacity 0.4s ease;">
        <a href="#" class="hover:text-white transition-colors"
           onmouseenter="this.style.color='#ed9520'" onmouseleave="this.style.color='rgba(255,255,255,0.5)'">IG</a>
        <a href="#" class="hover:text-white transition-colors"
           onmouseenter="this.style.color='#ed9520'" onmouseleave="this.style.color='rgba(255,255,255,0.5)'">X</a>
        <a href="#" class="hover:text-white transition-colors"
           onmouseenter="this.style.color='#ed9520'" onmouseleave="this.style.color='rgba(255,255,255,0.5)'">YT</a>
    </div>
</div>

{{-- Sidebar Backdrop --}}
<div id="sidebar-backdrop"
     class="fixed inset-0 bg-black/50 z-[199] opacity-0 pointer-events-none"
     style="transition: opacity 0.4s ease;"></div>


{{-- ============================================================
    TOP NAV BAR
    ============================================================ --}}
<div id="nav-overlay-gradient" class="fixed top-0 left-0 w-full h-[140px] z-[290] pointer-events-none transition-transform duration-500"
    style="background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 40%, transparent 100%);"></div>

<nav id="unified-navbar" class="fixed top-0 left-0 w-full z-[300]
                    flex justify-between items-center
                    px-4 md:px-12 py-6 md:py-8 transition-all duration-500 ease-in-out">

    {{-- Hamburger Button (Left) — animates into X when menu opens --}}
    <button id="menu-open-btn"
            class="hamburger-btn flex flex-col items-start justify-center gap-1.5 group text-white hover:opacity-75 transition-opacity cursor-pointer focus:outline-none"
            aria-label="Toggle menu">
        <span class="ham-line block w-6 h-[1.5px] bg-white origin-center"
              style="transition: transform 0.35s cubic-bezier(0.76,0,0.24,1), opacity 0.35s ease;"></span>
        <span class="ham-line block w-6 h-[1.5px] bg-white origin-center"
              style="transition: transform 0.35s cubic-bezier(0.76,0,0.24,1), opacity 0.35s ease;"></span>
        <span class="ham-line block w-6 h-[1.5px] bg-white origin-center"
              style="transition: transform 0.35s cubic-bezier(0.76,0,0.24,1), opacity 0.35s ease;"></span>
    </button>
    <style>
        /* Hamburger → X morph */
        .hamburger-btn.is-open .ham-line:nth-child(1) {
            transform: translateY(7.5px) rotate(45deg);
        }
        .hamburger-btn.is-open .ham-line:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }
        .hamburger-btn.is-open .ham-line:nth-child(3) {
            transform: translateY(-7.5px) rotate(-45deg);
        }
    </style>

    {{-- Center: Brand --}}
    <a href="{{ route('welcome') }}" class="absolute left-1/2 -translate-x-1/2
                                text-white text-sm
                                tracking-[0.3em] uppercase font-bold
                                whitespace-nowrap transition-opacity hover:opacity-80"
       style="transition: color 0.3s ease, opacity 0.3s ease;"
       onmouseenter="this.style.color='#ed9520'; this.style.opacity='1';"
       onmouseleave="this.style.color='#fff'; this.style.opacity='';">
        sinemaku pictures
    </a>

    {{-- Right: Language Switcher + Get in Touch --}}
    <div class="flex items-center gap-3 md:gap-5">

        {{-- Language Switcher --}}
        <button id="lang-switcher"
                aria-label="Switch language"
                style="
                    font-size: 10px;
                    letter-spacing: 0.18em;
                    text-transform: uppercase;
                    font-weight: 600;
                    color: rgba(255,255,255,0.55);
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    line-height: 1;
                    min-width: 20px;
                    text-align: center;
                    transition: color 0.25s ease;
                    position: relative;
                "
                onmouseenter="window.__langSwitcherHover(this, true)"
                onmouseleave="window.__langSwitcherHover(this, false)"
                onclick="window.__langToggle()">
            <span id="lang-label">EN</span>
        </button>

        {{-- Mobile: icon only --}}
        <a id="nav-cta-mobile" href="#get-in-touch" class="text-white hover:opacity-70 transition-opacity"
           aria-label="Get in touch">
            <x-icons.mail class="w-7 h-7" />
        </a>
        {{-- Desktop: text + capsule --}}
        <a id="nav-cta-desktop" href="#get-in-touch"
           class="text-xs tracking-widest uppercase text-white border border-white/40 px-5 py-2.5 rounded-full items-center whitespace-nowrap transition-all duration-300"
           onmouseenter="this.style.background='#ed9520'; this.style.color='#0b0a1a'; this.style.borderColor='#ed9520';"
           onmouseleave="this.style.background=''; this.style.color='#fff'; this.style.borderColor='';">
            <span data-i18n="nav_cta">get in touch</span>
        </a>
    </div>

    <style>
        /* ── Hidden state for scroll ── */
        .is-nav-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        /* ── Nav CTA: responsive ── */
        #nav-cta-mobile {
            display: inline-flex;
            line-height: 1;
            align-items: center;
        }
        #nav-cta-desktop {
            display: none;
        }
        @media (min-width: 768px) {
            #nav-cta-mobile  { display: none; }
            #nav-cta-desktop { display: inline-flex; }
            #mobile-slide-indicator { display: none !important; }
        }
    </style>
</nav>



<script>
(function () {
    const openBtn   = document.getElementById('menu-open-btn');
    const sidebar   = document.getElementById('sidebar-menu');
    const backdrop  = document.getElementById('sidebar-backdrop');
    const menuLinks = document.querySelectorAll('.menu-link');
    const socials   = document.querySelector('.menu-socials');

    let isOpen = false;

    function openMenu() {
        isOpen = true;
        openBtn.classList.add('is-open');

        sidebar.style.transform = 'translateX(0)';
        backdrop.style.opacity  = '1';
        backdrop.style.pointerEvents = 'auto';
        document.body.style.overflow = 'hidden';

        // Stagger menu links in
        menuLinks.forEach(function(link, i) {
            setTimeout(function() {
                link.style.opacity = '1';
                link.style.transform = 'translateX(0)';
            }, 120 + i * 60);
        });

        // Fade in socials
        setTimeout(function() {
            if (socials) socials.style.opacity = '1';
        }, 500);
    }

    function closeMenu() {
        isOpen = false;
        openBtn.classList.remove('is-open');

        sidebar.style.transform = 'translateX(-100%)';
        backdrop.style.opacity  = '0';
        backdrop.style.pointerEvents = 'none';
        document.body.style.overflow = '';

        // Reset menu links
        menuLinks.forEach(function(link) {
            link.style.opacity = '0';
            link.style.transform = 'translateX(-2rem)';
        });

        if (socials) socials.style.opacity = '0';
    }

    openBtn.addEventListener('click', function() {
        isOpen ? closeMenu() : openMenu();
    });

    if (backdrop) backdrop.addEventListener('click', closeMenu);

    // ============================================================
    // OUR WORKS SUB-MENU TOGGLE
    // ============================================================
    const worksToggle = document.getElementById('works-toggle');
    const worksSubmenu = document.getElementById('works-submenu');
    const worksArrow = document.getElementById('works-arrow');
    let subOpen = false;

    if (worksToggle) {
        worksToggle.addEventListener('click', function() {
            subOpen = !subOpen;
            if (subOpen) {
                worksSubmenu.style.maxHeight = '500px';
                worksSubmenu.style.opacity = '1';
                worksSubmenu.style.marginTop = '1.5rem';
                worksArrow.style.transform = 'rotate(90deg)';
            } else {
                worksSubmenu.style.maxHeight = '0';
                worksSubmenu.style.opacity = '0';
                worksSubmenu.style.marginTop = '0';
                worksArrow.style.transform = 'rotate(0deg)';
            }
        });
    }

    // Close submen on sidebar close
    function closeAllSubs() {
        subOpen = false;
        if (worksSubmenu) {
            worksSubmenu.style.maxHeight = '0';
            worksSubmenu.style.opacity = '0';
            worksSubmenu.style.marginTop = '0';
        }
        if (worksArrow) worksArrow.style.transform = 'rotate(0deg)';
    }

    // Close on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) {
            closeMenu();
            closeAllSubs();
        }
    });

    // ============================================================
    // SMART NAVBAR: HIDE ON SCROLL DOWN, SHOW ON SCROLL UP
    // ============================================================
    const navbar = document.getElementById('unified-navbar');
    const navOverlay = document.getElementById('nav-overlay-gradient');
    let lastScrollTop = 0;
    const scrollThreshold = 80;

    window.addEventListener('scroll', function() {
        if (isOpen) return;

        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop < 100) {
            navbar.classList.remove('is-nav-hidden');
            navOverlay.classList.remove('is-nav-hidden');
            return;
        }

        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            navbar.classList.add('is-nav-hidden');
            navOverlay.classList.add('is-nav-hidden');
        } else {
            navbar.classList.remove('is-nav-hidden');
            navOverlay.classList.remove('is-nav-hidden');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, { passive: true });
})();
</script>

{{-- ============================================================
     GLOBAL i18n ENGINE
     - Translations keyed by data-i18n attribute value
     - Persisted in localStorage under 'sinemaku_lang'
     - Lang-switcher: shows current lang, hovers to opposite
============================================================ --}}
<script>
(function () {

    // ─── TRANSLATION DICTIONARY ─────────────────────────────────────
    const TRANSLATIONS = {
        // ── Navbar ──────────────────────────────────────────────────
        menu_about:          { en: 'About',        id: 'Tentang' },
        menu_our_works:      { en: 'Our Works',    id: 'Karya Kami' },
        menu_films:          { en: 'Films',        id: 'Film' },
        menu_web_series:     { en: 'Web Series',   id: 'Serial Web' },
        menu_television:     { en: 'Television',   id: 'Televisi' },
        menu_documentaries:  { en: 'Documentaries',id: 'Dokumenter' },
        menu_events:         { en: 'Events',       id: 'Acara' },
        menu_merch:          { en: 'Merch',        id: 'Merchandise' },
        menu_community:      { en: 'Community',    id: 'Komunitas' },
        menu_articles:       { en: 'Articles',     id: 'Artikel' },
        menu_careers:        { en: 'Careers',      id: 'Karier' },
        nav_cta:             { en: 'get in touch', id: 'hubungi kami' },

        // ── Footer ──────────────────────────────────────────────────
        footer_brand_desc:   {
            en: 'Creating cinematic experiences that challenge conventions and inspire new perspectives. We are storytellers, dreamers, and rebels with cameras.',
            id: 'Menciptakan pengalaman sinematik yang menantang konvensi dan menginspirasi perspektif baru. Kami adalah pencerita, pemimpi, dan pemberontak berkamera.'
        },
        footer_navigation:   { en: 'Navigation',  id: 'Navigasi' },
        footer_connect:      { en: 'Connect',      id: 'Terhubung' },
        footer_follow_us:    { en: 'Follow Us',    id: 'Ikuti Kami' },
        footer_home:         { en: 'Home',         id: 'Beranda' },
        footer_films:        { en: 'Films',        id: 'Film' },
        footer_serial:       { en: 'Serial',       id: 'Serial' },
        footer_shop:         { en: 'Shop',         id: 'Toko' },
        footer_articles:     { en: 'Articles',     id: 'Artikel' },
        footer_events:       { en: 'Events',       id: 'Acara' },
        footer_careers:      { en: 'Careers',      id: 'Karier' },
        footer_community:    { en: 'Komunitas',    id: 'Komunitas' },
        footer_copyright:    { en: '© 2024 Sinemaku Pictures. All rights reserved.', id: '© 2024 Sinemaku Pictures. Hak cipta dilindungi.' },
        footer_privacy:      { en: 'Privacy Policy', id: 'Kebijakan Privasi' },
        footer_terms:        { en: 'Terms of Service', id: 'Syarat Layanan' },
        footer_cookies:      { en: 'Cookies',      id: 'Cookie' },

        // ── Welcome page ────────────────────────────────────────────
        home_events_eyebrow:    { en: 'Upcoming Events',   id: 'Acara Mendatang' },
        home_get_ticket:        { en: 'Dapatkan Tiket',    id: 'Dapatkan Tiket' },
        home_latest_film:       { en: 'Film Terbaru',      id: 'Film Terbaru' },
        home_see_all_films:     { en: 'Lihat Semua Film',  id: 'Lihat Semua Film' },
        home_merch_eyebrow:     { en: 'Sinemaku Store',    id: 'Sinemaku Store' },
        home_buy_now:           { en: 'Beli Sekarang',     id: 'Beli Sekarang' },
        home_serial_eyebrow:    { en: 'Serial Web',        id: 'Serial Web' },
        home_see_serials:       { en: 'Lihat Serial Lainnya', id: 'Lihat Serial Lainnya' },
        home_article_eyebrow:   { en: 'Latest Articles',   id: 'Artikel Terbaru' },
        home_read_articles:     { en: 'Read More Articles', id: 'Baca Artikel Lainnya' },
        home_tv_eyebrow:        { en: 'Television',        id: 'Tayangan Televisi' },
        home_see_tv:            { en: 'See More Shows',    id: 'Lihat Tayangan Lainnya' },
        home_community_eyebrow: { en: 'Community',         id: 'Komunitas' },
        home_community_title:   { en: 'Join the Movement', id: 'Bergabung dalam Gerakan' },
        home_community_desc:    {
            en: 'Be part of a community that celebrates bold storytelling and artistic vision. Get exclusive access to premieres, behind-the-scenes content, and limited releases.',
            id: 'Jadilah bagian dari komunitas yang merayakan penceritaan berani dan visi artistik. Dapatkan akses eksklusif ke pemutaran perdana, konten di balik layar, dan rilis terbatas.'
        },
        home_community_premieres:     { en: 'Premieres',          id: 'Perdana' },
        home_community_exc_access:    { en: 'Exclusive early access', id: 'Akses awal eksklusif' },
        home_community_bts:           { en: 'Behind the Scenes',  id: 'Di Balik Layar' },
        home_community_insights:      { en: 'Direct process insights', id: 'Wawasan proses langsung' },
        home_community_limited:       { en: 'Limited Releases',   id: 'Rilis Terbatas' },
        home_community_editions:      { en: 'Special rare editions', id: 'Edisi langka spesial' },
        home_unlock_exp:              { en: 'Unlock the Experience', id: 'Buka Pengalaman Ini' },

        // ── About page ──────────────────────────────────────────────
        about_cta_company:   { en: 'ABOUT OUR COMPANY', id: 'TENTANG PERUSAHAAN' },
        about_cta_team:      { en: 'MEET OUR TEAM',     id: 'TEMUI TIM KAMI' },
        about_read_more:     { en: 'Read More',          id: 'Selengkapnya' },
        about_coming_soon:   { en: 'Coming Soon',        id: 'Segera Hadir' },
        about_meet_link:     { en: 'meet our team ...',  id: 'temui tim kami ...' },
        about_team_eyebrow:  { en: 'Team',               id: 'Tim' },
        about_team_heading:  { en: 'Orang-orang di balik kamera.', id: 'Orang-orang di balik kamera.' },
        about_numbers_films: { en: 'Karya Film',         id: 'Karya Film' },
        about_numbers_years: { en: 'Tahun Berdiri',      id: 'Tahun Berdiri' },
        about_numbers_comm:  { en: 'Anggota Komunitas',  id: 'Anggota Komunitas' },
        about_numbers_city:  { en: 'Kota Roadshow',      id: 'Kota Roadshow' },
        about_wwd_eyebrow:   { en: 'What We Do',         id: 'Apa yang Kami Lakukan' },
        about_wwd_heading:   { en: 'Bukan hanya sekadar membuat karya.', id: 'Bukan hanya sekadar membuat karya.' },
        about_collab_eyebrow:{ en: 'Kolaborasi',         id: 'Kolaborasi' },
        about_collab_heading:{ en: 'Ada proyek hebat yang bisa dikerjakan bersama?', id: 'Ada proyek hebat yang bisa dikerjakan bersama?' },

        // ── General shared ──────────────────────────────────────────
        label_director:      { en: 'Director',      id: 'Sutradara' },
        label_minutes:       { en: 'minutes',        id: 'menit' },
        label_episode:       { en: 'Episode',        id: 'Episode' },
        label_season:        { en: 'Season',         id: 'Musim' },
    };

    // ─── STATE ──────────────────────────────────────────────────────
    const STORAGE_KEY = 'sinemaku_lang';
    let currentLang = localStorage.getItem(STORAGE_KEY) || 'en';

    // ─── TEXT MAP: exact EN↔ID replacements, auto-scans ALL pages ──
    const TEXT_MAP = {
        id: {
            // ── Navbar / General ──────────────────────────────────────
            'About': 'Tentang',
            'Our Works': 'Karya Kami',
            'Events': 'Acara',
            'Merch': 'Merchandise',
            'Articles': 'Artikel',
            'Careers': 'Karier',
            'Home': 'Beranda',
            'Community': 'Komunitas',
            'Films': 'Film',
            'Web Series': 'Serial Web',
            'Television': 'Televisi',
            'Documentaries': 'Dokumenter',
            'Documentary': 'Dokumenter',
            'get in touch': 'hubungi kami',
            'Get in Touch': 'Hubungi Kami',

            // ── Footer ────────────────────────────────────────────────
            'Navigation': 'Navigasi',
            'Connect': 'Terhubung',
            'Follow Us': 'Ikuti Kami',
            '© 2024 Sinemaku Pictures. All rights reserved.': '© 2024 Sinemaku Pictures. Hak cipta dilindungi.',
            'Privacy Policy': 'Kebijakan Privasi',
            'Terms of Service': 'Syarat Layanan',
            'Cookies': 'Cookie',
            'Creating cinematic experiences that challenge conventions and inspire new perspectives. We are storytellers, dreamers, and rebels with cameras.': 'Menciptakan pengalaman sinematik yang menantang konvensi dan menginspirasi perspektif baru. Kami adalah pencerita, pemimpi, dan pemberontak berkamera.',

            // ── Buttons / Actions ─────────────────────────────────────
            'Read More': 'Selengkapnya',
            'Read Story': 'Baca Cerita',
            'See More': 'Lihat Lainnya',
            'View All': 'Lihat Semua',
            'Load More': 'Muat Lebih Banyak',
            'Buy Now': 'Beli Sekarang',
            'BUY NOW': 'BELI SEKARANG',
            'Add to Cart': 'Tambah ke Keranjang',
            'Watch Now': 'Tonton Sekarang',
            'Watch Trailer': 'Tonton Trailer',
            'Discover More': 'Jelajahi Lebih',
            'Share': 'Bagikan',
            'Back': 'Kembali',
            'Back to Films': 'Kembali ke Film',
            'Back to Events': 'Kembali ke Acara',
            'Back to Articles': 'Kembali ke Artikel',
            'Close': 'Tutup',
            'Submit': 'Kirim',
            'Send Message': 'Kirim Pesan',
            'Contact Us': 'Hubungi Kami',
            'Join Now': 'Gabung Sekarang',
            'Subscribe': 'Berlangganan',
            'Unlock the Experience': 'Buka Pengalaman Ini',
            'Join the Movement': 'Bergabung dalam Gerakan',

            // ── Films page ────────────────────────────────────────────
            'All Films': 'Semua Film',
            'All': 'Semua',
            'Latest': 'Terbaru',
            'Featured': 'Pilihan',
            'More Films': 'Film Lainnya',
            'Related Films': 'Film Terkait',

            // ── Detail Film/Series/TV/Documentary ─────────────────────
            'DIRECTED BY': 'SUTRADARA',
            'STARRING': 'PEMERAN',
            'SEASON': 'MUSIM',
            'Director': 'Sutradara',
            'Duration': 'Durasi',
            'Genre': 'Genre',
            'Season': 'Musim',
            'Episode': 'Episode',
            'Episodes': 'Episode',
            'Synopsis': 'Sinopsis',
            'Sinopsis': 'Sinopsis',
            'Cast': 'Pemeran',
            'Release': 'Rilis',
            'Release Date': 'Tanggal Rilis',
            'Daftar Episode': 'Daftar Episode',
            'Behind The Scenes': 'Di Balik Layar',
            'Behind the Scenes': 'Di Balik Layar',
            'Still Shots': 'Foto Set',
            'You Might Also Like': 'Anda Mungkin Juga Suka',
            'More Series': 'Serial Lainnya',
            'More Shows': 'Tayangan Lainnya',
            'About the Film': 'Tentang Film',
            'About the Series': 'Tentang Serial',
            'About the Show': 'Tentang Tayangan',
            'and others': 'dan lainnya',

            // ── Events page ───────────────────────────────────────────
            'Upcoming Events': 'Acara Mendatang',
            'All Events': 'Semua Acara',
            'Get Tickets': 'Dapatkan Tiket',
            'Get Ticket': 'Dapatkan Tiket',
            'Buy Tickets': 'Beli Tiket',
            'No events available at this moment.': 'Belum ada acara saat ini.',

            // ── Articles page ─────────────────────────────────────────
            'All Stories': 'Semua Cerita',
            'Related Articles': 'Artikel Terkait',
            'Top Stories': 'Cerita Pilihan',
            'Sinemaku Article': 'Artikel Sinemaku',
            'No articles available.': 'Belum ada artikel.',

            // ── Careers page ──────────────────────────────────────────
            'Join Our Team': 'Bergabung dengan Kami',
            'Open Positions': 'Posisi Terbuka',
            'Other Openings': 'Lowongan Lainnya',
            'Casting Calls': 'Pendaftaran Casting',
            'Current Castings': 'Casting Berlangsung',
            'Posted': 'Diposting',
            'Male': 'Pria',
            'Female': 'Wanita',
            'Yrs': 'Thn',
            'Salary': 'Gaji',
            'Position': 'Posisi',
            'Experience': 'Pengalaman',
            'Personal Information': 'Informasi Pribadi',
            'First Name': 'Nama Depan',
            'Last Name': 'Nama Belakang',
            'Email Address': 'Alamat Email',
            'Mobile Phone': 'Nomor HP',

            // ── Shop / Merch ──────────────────────────────────────────
            'Shop': 'Toko',
            'Shop By Category': 'Belanja per Kategori',
            'Out of Stock': 'Habis',
            'In Stock': 'Tersedia',
            'Price': 'Harga',
            'Discount': 'Diskon',

            // ── Membership ────────────────────────────────────────────
            'Member': 'Anggota',
            'Membership': 'Keanggotaan',
            'Benefits': 'Keuntungan',
            'Exclusive Access': 'Akses Eksklusif',
            'World': 'Dunia',
            'Ready to become part of our': 'Siap menjadi bagian dari',
            'creative family?': 'keluarga kreatif kami?',
            'Sign up today and get exclusive access to events and behind the scenes content.': 'Daftar hari ini dan dapatkan akses eksklusif ke acara dan konten di balik layar.',
            'Fill out the form below to start your journey as a Sinemaku Pictures member. It\'s completely free.': 'Isi formulir di bawah ini untuk memulai perjalanan Anda sebagai anggota Sinemaku Pictures. Sepenuhnya gratis.',
            'City': 'Kota',
            'Count Me In': 'Daftarkan Saya',

            // ── About page ────────────────────────────────────────────
            'ABOUT OUR COMPANY': 'TENTANG PERUSAHAAN',
            'MEET OUR TEAM': 'TEMUI TIM KAMI',
            'Coming Soon': 'Segera Hadir',
            'meet our team ...': 'temui tim kami ...',
            'What We Do': 'Apa yang Kami Lakukan',
            'Kolaborasi': 'Kolaborasi',

            // ── Welcome page ──────────────────────────────────────────
            'Upcoming Events': 'Acara Mendatang',
        },
        en: {}
    };
    // Build reverse ID→EN map automatically
    Object.keys(TEXT_MAP.id).forEach(function(idKey) {
        var enVal = TEXT_MAP.id[idKey];
        if (enVal !== idKey) TEXT_MAP.en[enVal] = idKey;
    });

    // ─── APPLY TRANSLATIONS ─────────────────────────────────────────
    // Store original text nodes so we can reverse on lang switch
    var _origNodes = null;

    function collectTextNodes(root) {
        var nodes = [];
        var walker = document.createTreeWalker(
            root,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function(node) {
                    // Skip script, style, noscript, and already-tagged elements
                    var p = node.parentElement;
                    if (!p) return NodeFilter.FILTER_REJECT;
                    var tag = p.tagName;
                    if (tag === 'SCRIPT' || tag === 'STYLE' || tag === 'NOSCRIPT') return NodeFilter.FILTER_REJECT;
                    if (node.textContent.trim() === '') return NodeFilter.FILTER_SKIP;
                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );
        var n;
        while ((n = walker.nextNode())) nodes.push(n);
        return nodes;
    }

    function applyTextMap(lang) {
        var map = TEXT_MAP[lang];
        if (!map) return;
        var otherLang = lang === 'en' ? 'id' : 'en';
        var reverseMap = TEXT_MAP[otherLang];

        var nodes = collectTextNodes(document.body);
        nodes.forEach(function(node) {
            var raw = node.textContent;
            var trimmed = raw.trim();
            // Try exact match first
            if (map[trimmed] !== undefined) {
                node.textContent = raw.replace(trimmed, map[trimmed]);
                return;
            }
            // Try case-insensitive partial matches for key phrases
            var found = false;
            Object.keys(map).forEach(function(phrase) {
                if (found) return;
                if (phrase.length < 3) return;
                if (trimmed.toLowerCase() === phrase.toLowerCase()) {
                    node.textContent = raw.replace(new RegExp(phrase, 'i'), map[phrase]);
                    found = true;
                }
            });
        });
    }

    function applyLang(lang) {
        // 1. data-i18n tagged elements
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            var key = el.getAttribute('data-i18n');
            if (TRANSLATIONS[key] && TRANSLATIONS[key][lang]) {
                el.textContent = TRANSLATIONS[key][lang];
            }
        });

        // 2. Auto text-node replacement for all other pages
        applyTextMap(lang);

        // 3. Update switcher label
        var label = document.getElementById('lang-label');
        if (label) label.textContent = lang.toUpperCase();
    }

    // ─── SWITCHER HOVER ─────────────────────────────────────────────
    window.__langSwitcherHover = function (btn, isEnter) {
        var label = btn.querySelector('#lang-label');
        if (!label) return;
        if (isEnter) {
            // Show the OPPOSITE language on hover
            var opposite = currentLang === 'en' ? 'ID' : 'EN';
            label.textContent = opposite;
            btn.style.color = 'rgba(255,255,255,0.9)';
        } else {
            // Restore current lang label
            label.textContent = currentLang.toUpperCase();
            btn.style.color = 'rgba(255,255,255,0.55)';
        }
    };

    // ─── SWITCHER CLICK ─────────────────────────────────────────────
    window.__langToggle = function () {
        currentLang = currentLang === 'en' ? 'id' : 'en';
        localStorage.setItem(STORAGE_KEY, currentLang);
        applyLang(currentLang);

        // Reset hover state after toggle
        var btn = document.getElementById('lang-switcher');
        if (btn) btn.style.color = 'rgba(255,255,255,0.55)';
    };

    // ─── INIT on DOM ready ──────────────────────────────────────────
    function init() {
        applyLang(currentLang);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose for other scripts to call if needed
    window.__i18n = { apply: applyLang, t: TRANSLATIONS, getCurrent: function() { return currentLang; } };

})();
</script>
