<style>

 .custom-navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  z-index: 12000;
  height: 75px; /* lebih ramping */
  background: transparent;
  transition: 
    background 0.46s cubic-bezier(.85,.14,.34,1),
    box-shadow 0.44s cubic-bezier(.77,.09,.44,1),
    opacity 0.33s,
    transform 0.46s cubic-bezier(.85,.14,.34,1);
  box-shadow: none;
  backdrop-filter: none;
  border-bottom: 1px solid transparent;
  display: flex;
  align-items: center;
  opacity: 1;
  will-change: background, box-shadow, opacity, transform;
  pointer-events: auto;
}

.custom-navbar.navbar-glass {
  background: radial-gradient(ellipse at 10% 40%, rgba(80,80,80,0.15) 0%, rgba(180,180,180,0.7) 95%);
  box-shadow: 0 8px 36px 0 rgba(0,0,0,0.13);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.custom-navbar.hide-navbar {
  transform: translateY(-120%);
  opacity: 0;
  pointer-events: none;
}
.custom-navbar.show-navbar {
  transform: translateY(0);
  opacity: 1;
  pointer-events: auto;
}

.navbar-inner {
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 56px;
  padding: 0 16px; /* lebih sempit */
  position: relative;
}

.navbar-btn {
  background: none;
  border: none;
  outline: none;
  display: flex;
  align-items: center;
  cursor: pointer;
  padding: 0;
  transition: opacity 0.18s;
  height: 56px;
  width: 44px;
  justify-content: center;
}
.navbar-btn:active { opacity: 0.7; }

.navbar-logo {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  font-family: 'Inter', Arial, sans-serif;
  font-size: 1.11rem;      /* Lebih kecil dan ramping */
  font-weight: 800;
  letter-spacing: 1.7px;
  color: #fff;
  text-shadow: 0 1px 5px rgba(0,0,0,0.09);
  white-space: nowrap;
  pointer-events: none;
  text-transform: uppercase;
  line-height: 1;
}

@media (max-width: 600px) {
  .navbar-inner { padding: 0 7px; }
  .navbar-logo { font-size: 0.89rem; }
}

.mega-menu-main .mega-menu-link {
  opacity: 0;
  transform: translateY(32px);
  transition:
    opacity 0.52s cubic-bezier(.71,.07,.37,.99),
    transform 0.52s cubic-bezier(.71,.07,.37,.99);
}

.mega-menu-overlay.menu-animate .mega-menu-link {
  opacity: 1;
  transform: translateY(0);
}

/* Staggered delay effect */
.mega-menu-link:nth-child(1) { transition-delay: 0.08s; }
.mega-menu-link:nth-child(2) { transition-delay: 0.17s; }
.mega-menu-link:nth-child(3) { transition-delay: 0.25s; }
.mega-menu-link:nth-child(4) { transition-delay: 0.33s; }
.mega-menu-link:nth-child(5) { transition-delay: 0.41s; }
.mega-menu-link:nth-child(6) { transition-delay: 0.49s; }
.mega-menu-link:nth-child(7) { transition-delay: 0.57s; }
.mega-menu-link:nth-child(8) { transition-delay: 0.65s; }

/* Reset transition-delay saat close supaya cepat hilang */
.mega-menu-overlay:not(.menu-animate) .mega-menu-link {
  transition-delay: 0s !important;
}


.mega-menu-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: radial-gradient(ellipse at 70% 60%, rgba(0,0,0,0.98) 80%, #000 100%);
  /* sedikit efek vignette gelap */
  display: none;
  animation: fadeInMenu 0.54s cubic-bezier(.75,0,.2,1);
  overflow-y: auto;
}

@keyframes fadeInMenu {
  from { opacity: 0; }
  to { opacity: 1; }
}
.mega-menu-content {
  max-width: 1600px;
  margin: 0 auto;
  display: flex;
  height: 100vh;
  padding: 120px 80px 48px 80px;
  box-sizing: border-box;
  position: relative;
}

.mega-menu-main {
  flex: 1 0 60%;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  gap: 28px;
  margin-right: 64px;
  min-width: 480px;
  z-index: 3;
}

.mega-menu-link {
  font-family: 'Libre Baskerville', serif;
  /* font-weight: 600; */
  font-size: 85px;
  color: #D7D7D7;
  text-decoration: none;
  letter-spacing: 0.5px;
  display: block;
  position: relative;
  line-height: 1.08;
  /* transition: color 0.23s cubic-bezier(.75,0,.2,1); */
  cursor: pointer;
  transition:
    color 0.24s cubic-bezier(.75,0,.2,1),
    transform 0.38s cubic-bezier(.63,.06,.25,1);   /* <-- animasi geser */
  will-change: color, transform;
}

.mega-menu-link.active,
.mega-menu-link:hover {
  color: #fff;
}

.mega-menu-link.active:after,
.mega-menu-link:hover:after {
  content: '';
  display: block;
  width: 92px;
  height: 2.5px;
  background: #fff;
  position: absolute;
  left: 0;
  bottom: -6px;
  border-radius: 1.5px;
}

.mega-menu-copyright {
  font-family: 'Inter', Arial, sans-serif;
  font-size: 16px;
  color: #999;
  margin-top: 18px;
  margin-bottom: 2px;
}

.mega-menu-aside {
  opacity: 0;
  transform: translateY(22px);
  transition:
    opacity 0.34s cubic-bezier(.71,.07,.37,.99),
    transform 0.34s cubic-bezier(.71,.07,.37,.99);
  transition-delay: 0.21s; /* Setelah menu kiri mulai muncul */
  will-change: opacity, transform;
}

.mega-menu-overlay.menu-animate .mega-menu-aside {
  opacity: 1;
  transform: translateY(0);
}

/* Untuk bagian di dalam aside, kasih efek sedikit berurutan */
/* Bagian dalam aside (staggered, lebih cepat) */
.mega-menu-aside-inner > * {
  opacity: 0;
  transform: translateY(14px);
  transition: 
    opacity 0.22s cubic-bezier(.61,.13,.41,1),
    transform 0.22s cubic-bezier(.61,.13,.41,1);
  transition-delay: 0s;
}
.mega-menu-overlay.menu-animate .mega-menu-aside-inner > *:nth-child(1) { 
  opacity: 1; transform: translateY(0); transition-delay: 0.18s; 
}
.mega-menu-overlay.menu-animate .mega-menu-aside-inner > *:nth-child(2) { 
  opacity: 1; transform: translateY(0); transition-delay: 0.27s; 
}
.mega-menu-overlay.menu-animate .mega-menu-aside-inner > *:nth-child(3) { 
  opacity: 1; transform: translateY(0); transition-delay: 0.33s; 
}

.mega-menu-logo {
  opacity: 0;
  transform: translateY(10px);
  transition: 
    opacity 0.18s cubic-bezier(.65,.11,.52,1),
    transform 0.18s cubic-bezier(.65,.11,.52,1);
  transition-delay: 0s;
}
.mega-menu-overlay.menu-animate .mega-menu-logo {
  opacity: 1; 
  transform: translateY(0);
  transition-delay: 0.36s;
}


.mega-menu-aside-inner {
  width: 340px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.mega-menu-contact {
  font-family: 'Inter', Arial, sans-serif;
  color: #fff;
}

.contact-title {
  font-weight: 700;
  font-size: 28px;
  margin-bottom: 7px;
}
.contact-email,
.contact-phone,
.contact-address {
  font-size: 19px;
  margin-bottom: 4px;
  color: #d9d9d9;
}

.mega-menu-social {
  margin-top: 18px;
}
.follow-title {
  color: #fff;
  font-weight: 600;
  font-size: 19px;
  margin-bottom: 8px;
}
.social-links a {
  color: #d9d9d9;
  margin-right: 22px;
  text-decoration: none;
  font-size: 18px;
  transition: color 0.2s;
}
.social-links a:hover { color: #fff; }

.mega-menu-logo {
  margin-top: 36px;
  color: #8d99ae;
}
.logo-main {
  font-weight: 800;
  font-size: 29px;
  font-family: 'Inter', Arial, sans-serif;
  margin-bottom: 3px;
}
.logo-sub {
  font-size: 15px;
  letter-spacing: 1.3px;
  font-family: 'Inter', Arial, sans-serif;
}
.creative-storytelling {
  writing-mode: vertical-rl;
  text-orientation: mixed;
  font-family: 'Inter', Arial, sans-serif;
  color: #46506a;
  font-size: 15px;
  position: absolute;
  right: 0;
  top: 25%;
  letter-spacing: 2.8px;
  opacity: 0.7;
  z-index: 2;
}

@media (max-width: 1200px) {
  .mega-menu-content { flex-direction: column; padding: 70px 16px 20px 16px; }
  .mega-menu-main { min-width: 200px; margin-right: 0; }
  .mega-menu-link { font-size: 48px; }
  .mega-menu-aside { min-width: 0; align-items: flex-start; }
  .mega-menu-aside-inner { width: 100%; }
  .creative-storytelling { display: none; }
}

.mega-menu-link.active:after,
.mega-menu-link:hover:after {
  content: '';
  display: block;
  width: 130px;    /* Sesuaikan panjang garis */
  height: 1px;     /* Tinggi garis, agak lebih tebal dari sebelumnya */
  background: linear-gradient(
    to right,
    #fff 0%,
    #3b3a3a 60%,
    rgba(255,255,255,0) 100%
  );
  position: absolute;
  left: 0;
  bottom: -12px;  /* Jarak dari text menu */
  border-radius: 2px;
  transition: width 0.2s, background 0.2s;
}

.mega-menu-link:hover,
.mega-menu-link.active {
  color: #fff;
  transform: translateX(38px) scale(1.038);
}

.mega-menu-link::after,
.mega-menu-link.active::after,
.mega-menu-link:hover::after {
  content: '';
  display: block;
  width: 140px;
  height: 1px;
  background: linear-gradient(90deg, 
    #fff 0%,
    #3b3a3a 60%,
    rgba(255,255,255,0) 100%);
  position: absolute;
  left: 0;
  bottom: -6px;
  border-radius: 1.5px;
  opacity: 1;
  transition: opacity 0.22s, width 0.32s cubic-bezier(.56,0,.27,1);
}

/* Hanya tampil pada active/hover */
.mega-menu-link:not(:hover):not(.active)::after {
  opacity: 0;
  width: 0;
}

</style>

<nav class="custom-navbar">
    <div class="navbar-inner">
        <span class="navbar-logo">SINEMAKU PICTURES</span>
        <!-- Hamburger/Close button -->
        <button class="navbar-btn" id="menuToggle" aria-label="Toggle menu">
            <!-- Hamburger Icon (default) -->
            <span class="icon-hamburger">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <rect y="5" width="24" height="2" rx="1" fill="white"/>
                    <rect y="11" width="24" height="2" rx="1" fill="white"/>
                    <rect y="17" width="24" height="2" rx="1" fill="white"/>
                </svg>
            </span>
            <!-- Close Icon (hidden default) -->
            <span class="icon-close" style="display:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" viewBox="0 0 24 24">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </span>
        </button>
        <button class="navbar-btn" aria-label="Toggle search">
            <span class="icon-search">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="white" stroke-width="2"/>
                    <line x1="16.5" y1="16.5" x2="22" y2="22" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
        </button>
    </div>
</nav>

<!-- Mega Menu Overlay -->
<div class="mega-menu-overlay" style="display: none;">
  <div class="mega-menu-content">
    <!-- Bagian Kiri: Menu -->
    <div class="mega-menu-main">
      <a href="/" class="mega-menu-link active" data-desc="Back to homepage">Home</a>
      <a href="{{ route('film') }}" class="mega-menu-link" data-desc="Explore our cinematic works">Films</a>
      <a href="{{ route('series') }}" class="mega-menu-link" data-desc="Long-form storytelling">Series</a>
      <a href="{{ route('shop') }}" class="mega-menu-link" data-desc="Exclusive merchandise">Shop</a>
      <a href="{{ route('articles') }}" class="mega-menu-link" data-desc="Stories and insights">Articles</a>
      <a href="{{ route('event') }}" class="mega-menu-link" data-desc="Premieres and screenings">Events</a>
      <a href="{{ route('frontend.membership') }}" class="mega-menu-link" data-desc="Join our inner circle">Membership</a>
      <a href="{{ route('careers') }}" class="mega-menu-link" data-desc="Join our creative team">Careers</a>
      <div class="mega-menu-copyright">© 2024 Sinemaku Pictures. All rights reserved.</div>
    </div>
    <!-- Bagian Kanan: Kontak -->
    <div class="mega-menu-aside">
      <div class="mega-menu-aside-inner">
        
        <div class="mega-menu-social">
         
        </div>
        
      </div>
      <div class="creative-storytelling">CREATIVE STORYTELLING</div>
    </div>
  </div>
  <div class="mega-menu-desc"></div>
</div>




<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function(){
  var $navbar = $('.custom-navbar');
  var lastScroll = $(window).scrollTop();
  $navbar.addClass('show-navbar');
  
  // Inisialisasi glass di reload
  if($(window).scrollTop() > 24) $navbar.addClass('navbar-glass');
  
  $(window).on('scroll', function(){
    var st = $(this).scrollTop();
    
    // GLASS EFFECT saat scroll > 24px
    if(st > 24){
      $navbar.addClass('navbar-glass');
    } else {
      $navbar.removeClass('navbar-glass');
    }
    
    // HIDE/SHOW NAVBAR saat scroll ke bawah/atas
    if(st > lastScroll && st > 32){
      $navbar.removeClass('show-navbar').addClass('hide-navbar');
    } else {
      $navbar.removeClass('hide-navbar').addClass('show-navbar');
    }
    lastScroll = st;
  });

  $(document).ready(function(){
        // Toggle menu open/close
        $('#menuToggle').on('click', function() {
            var $hamb = $(this).find('.icon-hamburger');
            var $close = $(this).find('.icon-close');
            var $overlay = $('.mega-menu-overlay');
            var isOpen = $overlay.is(':visible');

            if (!isOpen) {
                // Buka Mega Menu + animasi menu
                $overlay.fadeIn(400, function(){
                    setTimeout(function() {
                        $overlay.addClass('menu-animate');
                    }, 20); // memberi waktu agar transition berjalan
                });
                $hamb.fadeOut(150, function(){ $close.fadeIn(250); });
                $('body').css('overflow', 'hidden');
            } else {
                // Tutup Mega Menu + hilangkan animasi
                $overlay.removeClass('menu-animate');
                $overlay.fadeOut(400);
                $close.fadeOut(150, function(){ $hamb.fadeIn(250); });
                $('body').css('overflow', '');
            }
        });

        // ...dan di tempat close lain:
        $('.mega-menu-link').on('click', function(){
            var $overlay = $('.mega-menu-overlay');
            $overlay.removeClass('menu-animate');
            $overlay.fadeOut(400);
            $('#menuToggle .icon-close').fadeOut(150, function(){
                $('#menuToggle .icon-hamburger').fadeIn(250);
            });
            $('body').css('overflow', '');
        });

        $('.mega-menu-overlay').on('click', function(e) {
            if ($(e.target).is('.mega-menu-overlay')) {
                var $overlay = $(this);
                $overlay.removeClass('menu-animate');
                $overlay.fadeOut(400);
                $('#menuToggle .icon-close').fadeOut(150, function(){
                    $('#menuToggle .icon-hamburger').fadeIn(250);
                });
                $('body').css('overflow', '');
            }
        });
    });

});
</script>

