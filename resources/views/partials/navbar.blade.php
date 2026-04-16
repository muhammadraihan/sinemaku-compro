{{-- resources/views/partials/navbar.blade.php --}}

{{-- ============================================================
    SIDEBAR MENU (slides in from left)
    ============================================================ --}}
<div id="sidebar-menu"
    class="fixed top-0 left-0 w-[300px] md:w-[380px] h-full z-[200] flex flex-col justify-center px-10 md:px-14 border-r border-white/10 pt-20 transform -translate-x-full"
    style="background: #0b0a1a; border-right-color: rgba(112,105,199,0.18); transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);">
    @php
        $menuItems = [
            ['title' => 'About',      'url' => '/'],
            [
                'title' => 'Our Works', 
                'url' => '#',
                'id' => 'works-toggle',
                'subItems' => [
                    ['title' => 'Films',         'url' => '/films'],
                    ['title' => 'Web Series',    'url' => '/serial'],
                    ['title' => 'Television',    'url' => '/tv'],
                    ['title' => 'Documentaries', 'url' => '/documentary'],
                ]
            ],
            ['title' => 'Events',     'url' => '/events'],
            ['title' => 'Merch',      'url' => '/shops'],
            ['title' => 'Community',  'url' => '/memberships'],
            ['title' => 'Articles',   'url' => '/article'],
            ['title' => 'Careers',    'url' => '/career'],
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
                        {{ $item['title'] }}
                        <span class="ml-4 text-[18px] transition-transform duration-300 inline-block origin-center" id="works-arrow">▷</span>
                    </button>
                    
                    <div id="works-submenu" class="flex flex-col space-y-2 mt-4 ml-6 overflow-hidden max-h-0 transition-all duration-500 ease-in-out opacity-0">
                        @foreach($item['subItems'] as $sub)
                            <a href="{{ $sub['url'] }}" 
                               class="text-xl text-white/30 hover:text-white transition-colors duration-300"
                               onmouseenter="this.style.color='#ed9520'"
                               onmouseleave="this.style.color='rgba(255,255,255,0.3)'">
                                {{ $sub['title'] }}
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
                    {{ $item['title'] }}
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

    {{-- Right: Get in Touch --}}
    <div class="flex items-center">
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
            get in touch
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
