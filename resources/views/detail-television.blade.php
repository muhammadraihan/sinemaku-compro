@extends('layouts.app')

@section('title', $films->title . ' | Sinemaku Pictures')

@section('content')

    @include('partials.navbar')

    {{-- ============================================================
    EDITORIAL WRAPPER
    ============================================================ --}}
    <div id="editorial-wrapper" class="text-[#131b4d] relative w-full font-sans bg-[#fdf5f7]">

        {{-- ============================================================
        1. HERO SECTION
        ============================================================ --}}
        <section class="relative w-full h-[60vh] md:h-[75vh] flex flex-col justify-end overflow-hidden z-10">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('photo/' . $films->photo) }}" alt="{{ $films->title }}"
                    class="w-full h-full object-cover hero-parallax-img"
                    style="object-position: top center;">
                
                <!-- Dark gradient overlay to make text readable -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#131b4d]/90 via-[#131b4d]/30 to-transparent z-10"></div>
            </div>

            <!-- Content -->
            <div class="relative z-20 px-8 md:px-16 pb-12 max-w-[1400px] mx-auto w-full">
                <div class="flex flex-col items-start gap-4">
                    @php
                        $video_id = '';
                        if (!empty($films->link) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $films->link, $match)) {
                            $video_id = $match[1];
                        }
                    @endphp

                    @if($video_id)
                        <button onclick="openHeroTrailer('{{ $video_id }}')"
                            class="bg-[#F36B21] text-white px-6 py-2 md:py-3 rounded-full font-sans text-xs md:text-sm tracking-wider uppercase font-bold hover:bg-white hover:text-[#F36B21] transition-colors cursor-none hover-target inline-flex items-center gap-2 hero-reveal shadow-lg">
                            Watch Trailer
                        </button>
                    @endif
                    
                    <h1 class="font-sans text-[8vw] md:text-[5vw] leading-[0.95] text-white tracking-tighter uppercase font-black hero-reveal max-w-4xl" style="font-family: Arial, Helvetica, sans-serif;">
                        @i18n($films, 'title')
                    </h1>
                </div>
            </div>
        </section>

        {{-- ============================================================
        2. DETAILS SECTION
        ============================================================ --}}
        <section class="py-16 md:py-24 px-8 md:px-16 z-10 relative bg-creme-leaks">
            <div class="max-w-[1400px] mx-auto flex flex-col md:flex-row gap-12 md:gap-20">
                
                <!-- Left: Poster & Available On -->
                <div class="w-full md:w-1/3 lg:w-1/4 flex-shrink-0">
                    <div class="rounded-xl overflow-hidden shadow-xl bg-white mb-8 reveal-image p-4 pb-12 relative">
                        <span class="absolute top-6 left-1/2 -translate-x-1/2 text-[8px] font-bold text-red-600 tracking-widest uppercase whitespace-nowrap">Sinemaku Original</span>
                        <img src="{{ asset('photo/' . $films->poster) }}" alt="{{ $films->title }} Poster"
                            class="w-full aspect-[3/4] object-cover rounded shadow mt-6">
                        <div class="absolute bottom-4 left-0 w-full text-center">
                            <span class="font-peckham text-red-600 text-sm italic">@i18n($films, 'title')</span>
                        </div>
                    </div>
                    
                    @php
                        $watchLinks = [];
                        if (!empty($films->link_watch)) {
                            $links = preg_split('/[\n,]+/', $films->link_watch);
                            foreach ($links as $link) {
                                $link = trim($link);
                                if (empty($link)) continue;

                                $provider = ['name' => 'WATCH NOW', 'icon' => 'mdi:play-circle', 'color' => '#131b4d', 'url' => $link, 'is_vidio' => false];

                                if (strpos($link, 'netflix.com') !== false) {
                                    $provider = ['name' => 'NETFLIX', 'icon' => 'mdi:netflix', 'color' => '#E50914', 'url' => $link, 'is_vidio' => false];
                                } elseif (strpos($link, 'vidio.com') !== false) {
                                    $provider = ['name' => 'VIDIO', 'icon' => '', 'color' => '#ED0226', 'url' => $link, 'is_vidio' => true];
                                } elseif (strpos($link, 'disneyplus.com') !== false || strpos($link, 'hotstar.com') !== false) {
                                    $provider = ['name' => 'DISNEY+', 'icon' => 'simple-icons:disneyplus', 'color' => '#0063E5', 'url' => $link, 'is_vidio' => false];
                                } elseif (strpos($link, 'apple.com') !== false) {
                                    $provider = ['name' => 'APPLE TV', 'icon' => 'tabler:brand-apple-tv', 'color' => '#000000', 'url' => $link, 'is_vidio' => false];
                                } elseif (strpos($link, 'youtube.com') !== false || strpos($link, 'youtu.be') !== false) {
                                    $provider = ['name' => 'YOUTUBE', 'icon' => 'mdi:youtube', 'color' => '#FF0000', 'url' => $link, 'is_vidio' => false];
                                } elseif (strpos($link, 'amazon.com') !== false || strpos($link, 'primevideo.com') !== false) {
                                    $provider = ['name' => 'PRIME VIDEO', 'icon' => 'simple-icons:primevideo', 'color' => '#00A8E1', 'url' => $link, 'is_vidio' => false];
                                } elseif (strpos($link, 'hbo') !== false) {
                                    $provider = ['name' => 'HBO', 'icon' => 'simple-icons:hbo', 'color' => '#000000', 'url' => $link, 'is_vidio' => false];
                                }

                                $watchLinks[] = $provider;
                            }
                        }
                    @endphp

                    @if(count($watchLinks) > 0)
                    <div class="reveal-image">
                        <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-4 font-bold">Available On</span>
                        <div class="flex flex-col gap-4">
                            @foreach($watchLinks as $wl)
                            <a href="{{ $wl['url'] }}" target="_blank" class="flex items-center gap-3 text-[#131b4d] font-bold text-sm hover:text-[#F36B21] transition-colors cursor-none hover-target">
                                @if($wl['is_vidio'])
                                    <div class="w-6 h-6 bg-[#ED0226] rounded text-white flex items-center justify-center font-bold text-xs shrink-0">v</div>
                                @else
                                    <span class="iconify w-6 h-6 shrink-0" style="color: {{ $wl['color'] }}" data-icon="{{ $wl['icon'] }}"></span>
                                @endif
                                {{ $wl['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right: Metadata & Synopsis -->
                <div class="w-full md:w-2/3 lg:w-3/4">
                    <!-- Grid Metadata -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-10 gap-x-8 mb-12 border-b border-[#131b4d]/10 pb-12 reveal-text">
                        <div>
                            <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-2 font-bold">Directed By</span>
                            <h3 class="font-sans text-xl text-[#131b4d] font-medium">{{ $films->director ?: 'N/A' }}</h3>
                        </div>
                        <div>
                            <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-2 font-bold">Written By</span>
                            <h3 class="font-sans text-xl text-[#131b4d] font-medium">{{ $films->writer ?: 'N/A' }}</h3>
                        </div>
                        <div>
                            <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-2 font-bold">Year</span>
                            <h3 class="font-sans text-xl text-[#131b4d] font-medium">{{ \Carbon\Carbon::parse($films->release_date)->format('Y') }}</h3>
                        </div>
                        
                        <div class="col-span-2">
                            <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-2 font-bold">Starring</span>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                                @php
                                    $casts = array_filter(explode(',', $films->cast));
                                @endphp
                                @foreach($casts as $cast)
                                    <span class="font-sans text-xl font-medium text-[#131b4d]">{{ trim($cast) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div class="mb-10 reveal-text">
                        <div class="font-sans text-sm md:text-base leading-relaxed text-[#131b4d]/80 max-w-3xl">
                            @if(trim(strip_tags($films->sinopsis)))
                                @i18n($films, 'sinopsis')
                            @else
                                <p>Synopsis not available.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Genres -->
                    <div class="flex flex-wrap gap-3 reveal-text">
                        @php
                            $genres = array_filter(explode(',', $films->genre));
                        @endphp
                        @foreach($genres as $g)
                            <span class="px-5 py-2 rounded-full bg-[#131b4d]/5 text-[#131b4d] font-sans text-xs font-bold uppercase tracking-widest">{{ trim($g) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================
        3. EPISODES & RECOMMENDATIONS
        ============================================================ --}}
        <section class="py-8 md:py-16 px-8 md:px-16 z-10 relative border-t border-[#131b4d]/10">
            <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-16 lg:gap-24">
                
                @php
                    $hasEpisodes = isset($films->episodes) && $films->episodes->count() > 0;
                @endphp

                <!-- Left: Content (Episodes or Photos) -->
                <div class="w-full lg:w-3/5">
                    
                    <!-- Tabs Navigation -->
                    @if($hasEpisodes)
                    <div class="flex flex-wrap gap-4 mb-12" id="detail-tabs">
                        <button onclick="switchTab('episodes')" id="tab-btn-episodes" class="bg-[#F36B21] text-white px-6 py-2.5 rounded-full font-sans text-xs tracking-wider uppercase font-bold cursor-none hover-target transition-colors">
                            Episode Guide
                        </button>
                        <button onclick="switchTab('photos')" id="tab-btn-photos" class="border border-[#F36B21] text-[#F36B21] px-6 py-2.5 rounded-full font-sans text-xs tracking-wider uppercase font-bold hover:bg-[#F36B21] hover:text-white transition-colors cursor-none hover-target">
                            Photos
                        </button>
                    </div>
                    @endif

                    <!-- Episodes Section -->
                    @if($hasEpisodes)
                    <div id="content-episodes" class="block">
                        <h2 class="font-sans font-black text-2xl text-[#F36B21] tracking-tight mb-8 uppercase">Episode</h2>

                        <div class="flex flex-col gap-8">
                            @foreach($films->episodes as $ep)
                            <div class="flex flex-col sm:flex-row gap-6 items-start pb-8 border-b border-[#131b4d]/10 group reveal-rec">
                                <!-- Thumbnail -->
                                <div class="w-full sm:w-48 aspect-[16/10] rounded-xl bg-[#F36B21] overflow-hidden shrink-0 relative">
                                    @if($ep->photo)
                                        <img src="{{ asset('photo/' . $ep->photo) }}" class="w-full h-full object-cover mix-blend-multiply opacity-80" alt="{{ $ep->title }}">
                                    @endif
                                </div>
                                
                                <!-- Details -->
                                <div class="flex-1 pt-1">
                                    <h3 class="font-sans text-lg font-bold text-[#131b4d] mb-2">E{{ $ep->episode_number }} · {{ $ep->title }}</h3>
                                    <p class="font-sans text-xs md:text-sm text-[#131b4d]/70 leading-relaxed mb-4 max-w-lg">
                                        {{ Str::limit($ep->sinopsis, 150) }}
                                    </p>
                                    <a href="#" class="font-sans text-[10px] tracking-wider uppercase font-bold text-[#F36B21] hover:text-[#131b4d] transition-colors inline-block mt-2">
                                        Where to Watch
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Photos Section -->
                    <div id="content-photos" class="{{ $hasEpisodes ? 'hidden' : 'block' }}">
                        <h2 class="font-sans font-black text-2xl text-[#F36B21] tracking-tight mb-1 uppercase">Photos</h2>
                        <span class="font-sans text-[10px] tracking-widest uppercase text-[#131b4d]/50 block mb-8 font-bold">{{ $films->stillShots->count() }} Photos</span>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 auto-rows-[120px] md:auto-rows-[160px] reveal-rec">
                            @foreach($films->stillShots as $index => $shot)
                                @php
                                    $spanClass = 'col-span-1 row-span-1';
                                    if ($index === 0) $spanClass = 'col-span-2 row-span-2';
                                    elseif ($index === 1) $spanClass = 'col-span-2 row-span-1';
                                    elseif ($index === 4) $spanClass = 'col-span-2 row-span-1';
                                    elseif ($index === 5) $spanClass = 'col-span-1 row-span-2';
                                    elseif ($index === 6) $spanClass = 'col-span-1 row-span-2';
                                @endphp
                                <div class="{{ $spanClass }} rounded-xl overflow-hidden shadow-sm hover:opacity-90 transition-all duration-500 cursor-pointer group">
                                    <img src="{{ asset('photo/' . $shot->photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Still Shot {{ $index + 1 }}">
                                </div>
                            @endforeach
                            
                            @if($films->stillShots->count() == 0)
                                <div class="col-span-4 py-20 text-center border-2 border-dashed border-[#131b4d]/10 rounded-2xl">
                                    <span class="font-sans text-sm text-[#131b4d]/30 italic uppercase tracking-widest">No Photos Available</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Right: Recommendations -->
                <div class="w-full lg:w-2/5">
                    <h2 class="font-sans font-black text-2xl text-[#F36B21] tracking-tight mb-8 uppercase">You Might Also Enjoy</h2>
                    
                    <div class="flex flex-col gap-4">
                        @php
                            $recs = $all_film->where('id', '!=', $films->id)->take(3);
                            if($recs->count() < 3) {
                                // Add dummies if not enough
                                $recs = $recs->concat(collect([
                                    (object)['title' => 'PATAH HATI YANG KUPILIH', 'release_date' => '2025-01-01', 'cast' => 'Prilly Latuconsina, Bryan Domani', 'slug' => '#', 'photo' => ''],
                                    (object)['title' => 'PATAH HATI YANG KUPILIH', 'release_date' => '2025-01-01', 'cast' => 'Prilly Latuconsina, Bryan Domani', 'slug' => '#', 'photo' => ''],
                                    (object)['title' => 'PATAH HATI YANG KUPILIH', 'release_date' => '2025-01-01', 'cast' => 'Prilly Latuconsina, Bryan Domani', 'slug' => '#', 'photo' => ''],
                                ]))->take(3);
                            }
                        @endphp
                        
                        @foreach ($recs as $item)
                        <a href="{{ $item->slug == '#' ? '#' : route('detail-tv', $item->slug) }}" class="flex items-center gap-5 p-5 rounded-2xl border border-[#131b4d]/10 hover:border-[#F36B21] transition-colors cursor-none hover-target group reveal-rec bg-white">
                            <div class="w-16 h-16 rounded-lg bg-[#F36B21] shrink-0 overflow-hidden relative">
                                @if(!empty($item->photo))
                                 <img src="{{ asset('photo/' . $item->photo) }}" class="w-full h-full object-cover mix-blend-multiply opacity-80" alt="@i18n($item, 'title')">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-sans text-sm font-bold text-[#131b4d] uppercase leading-tight group-hover:text-[#F36B21] transition-colors mb-1">@i18n($item, 'title')</h4>
                                <span class="font-sans text-[10px] text-[#131b4d]/60 block leading-tight">
                                    {{ \Carbon\Carbon::parse($item->release_date)->format('Y') }}<br>
                                    {{ Str::limit($item->cast, 40) }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

    </div> {{-- End Editorial Wrapper --}}

    {{-- ============================================================
    TRAILER MODAL (Consistent with Film Page)
    ============================================================ --}}
    <div id="hero-trailer-modal"
        class="fixed inset-0 z-[20000] bg-black opacity-0 pointer-events-none transition-opacity duration-500 flex items-center justify-center p-4 md:p-16">
        <button onclick="closeHeroTrailer()"
            class="absolute top-8 right-8 text-white text-4xl hover:text-[#F36B21] transition-colors z-[20010]">&times;</button>
        <div class="w-full max-w-6xl aspect-video bg-black relative shadow-2xl overflow-hidden">
            <iframe id="hero-trailer-iframe" src="" class="absolute inset-0 w-full h-full border-0"
                allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    @include('components.footer')

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') return;

            gsap.registerPlugin(ScrollTrigger);

            // 1. Hero Reveal
            gsap.from(".hero-reveal", {
                y: 30,
                opacity: 0,
                duration: 1,
                stagger: 0.15,
                ease: "power3.out",
                delay: 0.2
            });

            // 2. Details & Images
            const reveals = ['.reveal-image', '.reveal-text', '.reveal-rec'];
            reveals.forEach(selector => {
                gsap.from(selector, {
                    scrollTrigger: {
                        trigger: selector,
                        start: "top 90%",
                    },
                    y: 40,
                    opacity: 0,
                    duration: 1.2,
                    stagger: 0.1,
                    ease: "power3.out"
                });
            });

            /* ─── TAB SWITCHING LOGIC ─── */
            window.switchTab = function(tab) {
                const btnEpisodes = document.getElementById('tab-btn-episodes');
                const btnPhotos = document.getElementById('tab-btn-photos');
                const contentEpisodes = document.getElementById('content-episodes');
                const contentPhotos = document.getElementById('content-photos');

                const activeClass = ['bg-[#F36B21]', 'text-white'];
                const inactiveClass = ['border', 'border-[#F36B21]', 'text-[#F36B21]', 'hover:bg-[#F36B21]', 'hover:text-white'];

                if (tab === 'episodes') {
                    if (btnEpisodes) {
                        btnEpisodes.classList.remove(...inactiveClass);
                        btnEpisodes.classList.add(...activeClass);
                    }
                    if (btnPhotos) {
                        btnPhotos.classList.remove(...activeClass);
                        btnPhotos.classList.add(...inactiveClass);
                    }
                    if (contentEpisodes) contentEpisodes.classList.remove('hidden');
                    if (contentPhotos) contentPhotos.classList.add('hidden');
                } else {
                    if (btnPhotos) {
                        btnPhotos.classList.remove(...inactiveClass);
                        btnPhotos.classList.add(...activeClass);
                    }
                    if (btnEpisodes) {
                        btnEpisodes.classList.remove(...activeClass);
                        btnEpisodes.classList.add(...inactiveClass);
                    }
                    if (contentPhotos) contentPhotos.classList.remove('hidden');
                    if (contentEpisodes) contentEpisodes.classList.add('hidden');
                }
                
                setTimeout(() => {
                    if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
                }, 100);
            };

            /* ─── TRAILER MODAL LOGIC ─── */
            window.openHeroTrailer = function (videoId) {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeHeroTrailer = function () {
                const modal = document.getElementById('hero-trailer-modal');
                const iframe = document.getElementById('hero-trailer-iframe');
                if (modal && iframe) {
                    iframe.src = '';
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    document.body.style.overflow = '';
                }
            };

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeHeroTrailer();
            });
        });
    </script>
@endpush