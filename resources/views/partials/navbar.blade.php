{{-- resources/views/partials/navbar.blade.php --}}

{{-- ============================================================
    SIDEBAR MENU (slides in from left)
    ============================================================ --}}
<div id="sidebar-menu"
    class="fixed top-0 left-0 w-[300px] md:w-[380px] h-full bg-[#0a0a0a] z-[200] flex flex-col justify-center px-10 md:px-14 border-r border-white/10 pt-20 transform -translate-x-full"
    style="transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);">
    @php
        $menuItems = [
            ['title' => 'About',      'url' => '/about'],
            ['title' => 'Film',       'url' => '/film'],
            ['title' => 'Serial Web', 'url' => '/series'],
            ['title' => 'Televisi',   'url' => '/tv'],
            ['title' => 'Dokumenter', 'url' => '/documentary'],
            ['title' => 'Events',     'url' => '/event'],
            ['title' => 'Merch',      'url' => '/shop'],
            ['title' => 'Komunitas',  'url' => '/community'],
            ['title' => 'Artikel',    'url' => '/articles'],
            ['title' => 'Karir',      'url' => '/careers'],
        ];
    @endphp
    <div class="flex flex-col space-y-4 text-left font-display font-medium text-3xl text-white">
        @foreach($menuItems as $item)
            @php
                $isActive = request()->is(ltrim($item['url'], '/'));
            @endphp
            <a href="{{ $item['url'] }}"
                class="menu-link opacity-0 -translate-x-8 transition-colors duration-300 {{ $isActive ? 'text-white' : 'text-white/40 hover:text-white/80' }}"
                style="transition: color 0.3s ease, opacity 0.4s ease, transform 0.4s ease;">
                {{ $item['title'] }}
            </a>
        @endforeach
    </div>

    <div class="mt-16 flex space-x-6 opacity-0 menu-socials items-center text-white/50 text-[10px] tracking-widest uppercase"
         style="transition: opacity 0.4s ease;">
        <a href="#" class="hover:text-white transition-colors">IG</a>
        <a href="#" class="hover:text-white transition-colors">X</a>
        <a href="#" class="hover:text-white transition-colors">YT</a>
    </div>
</div>

{{-- Sidebar Backdrop --}}
<div id="sidebar-backdrop"
     class="fixed inset-0 bg-black/50 z-[199] opacity-0 pointer-events-none"
     style="transition: opacity 0.4s ease;"></div>


{{-- ============================================================
    TOP NAV BAR
    ============================================================ --}}
<div class="fixed top-0 left-0 w-full h-[140px] z-[290] pointer-events-none"
    style="background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 40%, transparent 100%);"></div>

<nav id="unified-navbar" class="fixed top-0 left-0 w-full z-[300]
                    flex justify-between items-center
                    px-4 md:px-12 py-6 md:py-8">

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
    <a href="/" class="absolute left-1/2 -translate-x-1/2
                                text-white text-sm
                                tracking-[0.3em] uppercase font-light
                                whitespace-nowrap transition-opacity hover:opacity-80">
        sinemaku pictures
    </a>

    {{-- Right: Get in Touch --}}
    <div class="flex items-center">
        {{-- Mobile: icon only, no border --}}
        <a id="nav-cta-mobile" href="#get-in-touch" class="text-white hover:opacity-70 transition-opacity"
           aria-label="Get in touch">
            <x-icons.mail class="w-7 h-7" />
        </a>
        {{-- Desktop: text + capsule --}}
        <a id="nav-cta-desktop" href="#get-in-touch" class="text-xs tracking-widest uppercase text-white
                          border border-white/40 px-5 py-2.5 rounded-full
                          hover:bg-white hover:text-black transition-colors duration-300
                          items-center whitespace-nowrap">
            get in touch
        </a>
    </div>

    <style>
        /* ── Nav CTA: responsive (mobile=icon, desktop=text capsule) ── */
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
            /* This might belong elsewhere but kept as per user request snippet */
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

    // Close on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) closeMenu();
    });
})();
</script>
