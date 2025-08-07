@extends('layouts.app')

@section('content')

{{-- Opening Sequence --}}
@include('components.opening-sequence')

<div id="main-content" style="display:none">

    @include('components.navbar')

    {{-- HERO SECTION --}}
    <section id="hero-section" class="relative h-screen overflow-hidden">

        {{-- Video Background --}}
        <div class="absolute inset-0 w-full h-full">
            <video id="hero-video"
                class="w-full h-full object-cover transition-opacity duration-2000 opacity-0"
                autoplay muted loop playsinline
                poster="https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop">
                {{-- <source src="https://player.vimeo.com/external/434045526.sd.mp4?s=c27eecc69a27dbc4ff2b87d38afc35f1a9e7c02d&profile_id=164&oauth2_token_id=57447761" type="video/mp4"/>
                <source src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4" type="video/mp4"/> --}}
            </video>
        </div>

        {{-- Background Images with Crossfade --}}
        @php
            $heroSlides = [
                [
                    'title' => 'PERAYAAN MATI RASA',
                    'year' => '2024',
                    'starring' => 'Iqbaal Ramadhan',
                    'tagline' => 'Berfokus pada kisah seorang anak pertama bernama Ian Antono yang bercita-cita menjadi musisi.',
                    'image' => 'https://akcdn.detik.net.id/visual/2025/01/29/film-perayaan-mati-rasa-2025-1_169.png?w=1200',
                    'link'  => '/movies'
                ],
                [
                    'title' => 'KETIKA BERHENTI DI SINI',
                    'year' => '2023',
                    'starring' => 'Prilly Latuconsina',
                    'tagline' => 'Berkisah tentang Anindita Semesta yang bertemu dengan Ed dalam pertemuan tak terduga.',
                    'image' => 'https://occ-0-8407-92.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABSYpb03lAZrLnddgej_eO3wCckPgtY5MmDCR121DeRMVx7bZK9YxBJsIhtgUR4SX_54-tAdzK6RQ0o3liqnWTO0c7TTsZTDcZ4jM.jpg?r=e6d',
                    'link'  => '/movies'
                ],
                [
                    'title' => 'KU KIRA KAU RUMAH',
                    'year' => '2021',
                    'starring' => 'Jourdy Pranata',
                    'tagline' => 'Sebuah perjalanan emosional tentang pencarian makna rumah dan keluarga.',
                    'image' => 'https://imgsrv2.voi.id/_nvSjjN1kQP13Ow4BgSP8-V_iHBdRggEruAyAOy4Hn0/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy8xMzIwNTYvMjAyMjAyMDcxMzMzLW1haW4uanBn.jpg',
                    'link'  => '/movies'
                ],
                [
                    'title' => 'BOLEHKAH SEKALI SAJA KUMENANGIS',
                    'year' => '2024',
                    'starring' => 'Pradikta Wicaksono',
                    'tagline' => 'Tari (Prilly Latuconsina) harus berjuang menghadapi situasi yang tidak dikehendaki oleh siapapun. Sifat temperamen sang ayah membuat Tari dan kakaknya trauma hingga sang kakak memutuskan untuk keluar dari rumah yang membuat hatinya terasa sakit.',
                    'image' => 'https://occ-0-8407-114.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABRApQiafj0_-u6nK5_xjajzLUz1lHiTxCVo12rRvGE0FCWIlhVe_fE7yXMLuJROUwwvMnznIrjHbv80RWh4Xt8km4Yg5SIyjKhaO.jpg?r=917',
                    'link'  => '/movies'
                ]
            ];
        @endphp

        @foreach ($heroSlides as $i => $slide)
        <div class="absolute inset-0 hero-background transition-opacity duration-2000 slide-bg"
            data-slide="{{ $i }}"
            style="background-image:url('{{ $slide['image'] }}'); opacity: {{ $i == 0 ? '0.6' : '0' }};">
            <div class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image:url('{{ $slide['image'] }}');"></div>
        </div>
        @endforeach

        {{-- NEON-Style Bottom Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

        {{-- Hero Content --}}
        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-6 lg:px-8">

            <div class="max-w-4xl mx-auto transition-all duration-1500 hero-content" style="">
                {{-- Film Title --}}
                <div class="mb-8">
                    <h1 class="text-6xl md:text-7xl lg:text-8xl xl:text-9xl cinematic-title tracking-tight leading-none text-white font-black hero-text-glow mb-4" id="slide-title">
                        {{ $heroSlides[0]['title'] }}
                    </h1>
                    <div class="flex items-center justify-center space-x-6 text-lg md:text-xl text-white/90 mb-6" id="slide-meta">
                        <span class="font-light tracking-wider" id="slide-year">{{ $heroSlides[0]['year'] }}</span>
                        <span class="w-1 h-1 bg-white/60 rounded-full"></span>
                        <span class="font-light tracking-wider" id="slide-starring">Starring {{ $heroSlides[0]['starring'] }}</span>
                    </div>
                    <p class="text-lg md:text-xl lg:text-2xl text-white/80 editorial-text font-light leading-relaxed max-w-3xl mx-auto hero-text-shadow" id="slide-tagline">
                        {{ $heroSlides[0]['tagline'] }}
                    </p>
                </div>
                <div>
                    <a id="slide-link" href="{{ $heroSlides[0]['link'] }}"
                        class="inline-flex items-center px-12 py-4 border border-white/60 text-white font-medium tracking-widest hover:bg-white hover:text-black transition-all duration-700 transform hover:scale-105 hover-lift group backdrop-blur-sm text-sm uppercase">
                        EXPLORE
                        <span class="iconify ml-4 h-4 w-4" data-icon="lucide:arrow-right"></span>
                    </a>
                </div>
            </div>

            {{-- Scroll Down Indicator --}}
            <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 transition-all duration-1000 delay-1200 animate-fade-in-up">
                <button onclick="scrollToNextSection()"
                    class="flex flex-col items-center space-y-3 text-white/60 hover:text-white transition-colors duration-500 group scroll-indicator"
                    aria-label="Scroll to next section">
                    <div class="w-px h-12 bg-white/40 group-hover:bg-white/80 transition-colors duration-500"></div>
                    <span class="iconify h-5 w-5 animate-bounce group-hover:translate-y-1 transition-transform duration-300"
                        data-icon="lucide:chevron-down"></span>
                </button>
            </div>

            {{-- Progress Indicators --}}
            <div class="absolute bottom-12 right-12 transition-all duration-1000 delay-1000">
                <div class="flex flex-col space-y-3">
                    @foreach ($heroSlides as $i => $slide)
                        <button class="w-px h-8 transition-all duration-500 bg-white/30 hover:bg-white/60 slide-dot"
                            data-index="{{ $i }}" aria-label="Go to film {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            </div>
            <div class="absolute bottom-12 left-12 transition-all duration-1000 delay-1000">
                <div class="text-white/60 editorial-text text-sm tracking-widest" id="slide-counter">
                    01 — 04
                </div>
            </div>
        </div>
    </section>

    {{-- SHOP SECTION --}}
    <section id="shop-section" class="py-32 bg-white text-black container-edge">
        <div class="container-content">
            <div class="flex justify-between items-end mb-20">
                <h2 class="text-6xl md:text-7xl cinematic-title">Shop</h2>
                <a href="/shop" class="inline-flex items-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic">
                    SHOP NOW
                    <span class="iconify ml-3 h-5 w-5" data-icon="lucide:arrow-right"></span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Featured Product --}}
                <div class="lg:col-span-8 group cursor-pointer image-overlay">
                    <div class="relative h-96 lg:h-[600px] overflow-hidden">
                        <img src="https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                            alt="Midnight Soundtrack"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8">
                            <h3 class="text-4xl font-bold mb-2 text-white hero-text-shadow">Midnight Soundtrack</h3>
                            <p class="text-gray-300 editorial-text mb-4 text-lg hero-text-shadow">Limited vinyl edition</p>
                            <span class="text-3xl font-light text-white hero-text-shadow">$34.99</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 space-y-6">
                    <div class="group cursor-pointer image-overlay hover-lift">
                        <div class="relative h-44 overflow-hidden">
                            <img src="https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                                alt="Limited Poster"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="absolute bottom-4 left-4">
                                <h4 class="text-lg font-semibold text-white hero-text-shadow">Limited Poster</h4>
                                <span class="text-sm text-gray-300 hero-text-shadow">$19.99</span>
                            </div>
                        </div>
                    </div>
                    <div class="group cursor-pointer image-overlay hover-lift">
                        <div class="relative h-44 overflow-hidden">
                            <img src="https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                                alt="Art Book"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="absolute bottom-4 left-4">
                                <h4 class="text-lg font-semibold text-white hero-text-shadow">Art Book</h4>
                                <span class="text-sm text-gray-300 hero-text-shadow">$29.99</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JOIN SECTION --}}
    <section class="py-32 bg-black text-white relative overflow-hidden container-edge">
        <div class="absolute inset-0 opacity-20">
            <div class="w-full h-full bg-gradient-to-br from-gray-900 to-black"></div>
        </div>
        <div class="relative z-10 container-content">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-7xl md:text-8xl lg:text-9xl cinematic-title mb-8 leading-none hero-text-glow">
                    Join the<br />Movement
                </h2>
                <p class="text-xl md:text-2xl text-gray-300 editorial-text mb-12">
                    Collaborate with a passionate team of filmmakers, creators, and dreamers.<br>
                    See open positions and help us make something unforgettable.
                </p>
                <a href="/jobs" class="inline-flex items-center px-10 py-5 border border-white/60 text-white font-medium tracking-widest hover:bg-white hover:text-black transition-all duration-700 transform hover:scale-105 hover-lift group backdrop-blur-sm text-lg uppercase">
                    CAREERS
                    <span class="iconify ml-4 h-5 w-5" data-icon="lucide:arrow-right"></span>
                </a>
            </div>
        </div>
    </section>

    {{-- ARTICLES SECTION --}}
    <section id="articles-section" class="py-32 bg-white text-black container-edge">
        <div class="container-content">
            <div class="flex justify-between items-end mb-16">
                <h2 class="text-6xl md:text-7xl cinematic-title">Articles</h2>
                <a href="/articles" class="text-lg font-medium hover:text-gray-600 transition-colors duration-300 group">
                    View All
                    <span class="iconify inline ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" data-icon="lucide:arrow-right"></span>
                </a>
            </div>
            @php
                // Data dummy, samakan urutannya dengan versi React
                $featuredArticle = [
                    'title' => 'The Art of Cinematic Storytelling in Modern Film',
                    'desc'  => 'Explore how contemporary filmmakers are pushing the boundaries of visual narrative, combining traditional techniques with cutting-edge technology...',
                    'image' => 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=800&h=500&fit=crop',
                    'url'   => '/article/cinematic-storytelling'
                ];
                $sideArticles = [
                    [
                        'title' => "Behind the Scenes: Creating Midnight's Atmospheric Score",
                        'desc'  => 'Deep dive into the process behind the atmospheric score for "Midnight".',
                        'date'  => '2 days ago',
                        'image' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80',
                        'url'   => '/article/midnight-score'
                    ],
                    [
                        'title' => "Interview: Director's Vision for the Future of Cinema",
                        'desc'  => "Exclusive Q&A with Sinemaku Pictures' visionary director.",
                        'date'  => '4 days ago',
                        'image' => 'https://images.unsplash.com/photo-1454023492550-5696f8ff10e1?auto=format&fit=crop&w=400&q=80',
                        'url'   => '/article/director-vision'
                    ],
                    [
                        'title' => 'The Evolution of Film Production in the Digital Age',
                        'desc'  => 'How digital technology has changed Indonesian film production.',
                        'date'  => '1 week ago',
                        'image' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80',
                        'url'   => '/article/digital-production'
                    ],
                ];
            @endphp
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Featured Article --}}
                <a href="{{ $featuredArticle['url'] }}" class="lg:col-span-8 group cursor-pointer block">
                    <div class="relative overflow-hidden image-overlay rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-500 bg-black/80 hover:bg-black">
                        <img src="{{ $featuredArticle['image'] }}" alt="Featured Article"
                            class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8">
                            <h3 class="text-3xl md:text-4xl font-bold mb-4 text-white hero-text-shadow">
                                {{ $featuredArticle['title'] }}
                            </h3>
                            <p class="text-gray-300 editorial-text leading-relaxed text-lg hero-text-shadow mb-2">
                                {{ $featuredArticle['desc'] }}
                            </p>
                            <span class="inline-flex items-center text-yellow-400 group-hover:underline">
                                Read Article
                                <span class="iconify ml-2 h-4 w-4" data-icon="lucide:arrow-right"></span>
                            </span>
                        </div>
                    </div>
                </a>
                {{-- Side Articles --}}
                <div class="lg:col-span-4 space-y-8">
                    @foreach ($sideArticles as $side)
                    <a href="{{ $side['url'] }}" class="group cursor-pointer hover-lift block">
                        <div class="flex space-x-4">
                            <div class="w-24 h-24 bg-gray-200 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="{{ $side['image'] }}" alt="{{ $side['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold mb-2 group-hover:text-gray-600 transition-colors duration-300 leading-tight">
                                    {{ $side['title'] }}
                                </h4>
                                <p class="text-sm text-gray-500 editorial-text mb-1">{{ $side['desc'] }}</p>
                                <p class="text-xs text-gray-400 editorial-text">{{ $side['date'] }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



    {{-- FOOTER --}}
    @include('components.footer')

</div>

{{-- JS untuk Hero Slider --}}
<script>
    // === Hero Section Carousel ===
    const heroSlides = @json($heroSlides);
    let currentSlide = 0;
    let heroInterval;

    function showSlide(idx) {
        // update background crossfade
        $('.slide-bg').css('opacity', 0);
        $('.slide-bg[data-slide="'+idx+'"]').css('opacity', 0.6);

        // update text/content
        $('#slide-title').text(heroSlides[idx].title);
        $('#slide-year').text(heroSlides[idx].year);
        $('#slide-starring').text('Starring ' + heroSlides[idx].starring);
        $('#slide-tagline').text(heroSlides[idx].tagline);
        $('#slide-link').attr('href', heroSlides[idx].link);

        // update dot indicator
        $('.slide-dot').removeClass('bg-white scale-110').addClass('bg-white/30');
        $('.slide-dot[data-index="'+idx+'"]').addClass('bg-white scale-110').removeClass('bg-white/30');

        // counter
        $('#slide-counter').text(('0'+(idx+1)).slice(-2)+' — 0'+heroSlides.length);
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % heroSlides.length;
        showSlide(currentSlide);
    }

    $(function(){
        // video fade in on loaded
        $('#hero-video').on('loadeddata', function(){
            $(this).addClass('opacity-100');
        });

        // slide dot click
        $('.slide-dot').on('click', function(){
            currentSlide = Number($(this).data('index'));
            showSlide(currentSlide);
        });

        // autoplay
        heroInterval = setInterval(nextSlide, 4000);

        // pause autoplay on hover
        $('.slide-dot').on('mouseenter', function(){ clearInterval(heroInterval); });
        $('.slide-dot').on('mouseleave', function(){ heroInterval = setInterval(nextSlide, 4000); });

        // show first slide
        showSlide(currentSlide);

        // Opening sequence auto (handled in opening-sequence.blade.php)
    });

    // scroll down
    function scrollToNextSection() {
        const nextSection = document.querySelector('#shop-section');
        if(nextSection) {
            nextSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
</script>
@endsection
