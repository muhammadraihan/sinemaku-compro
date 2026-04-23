@extends('layouts.app')
@section('title', 'About — Sinemaku Pictures')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<style>
body { background-color: #F1F1F1; color: #25225E; cursor: none; overflow-x: hidden; -webkit-font-smoothing: antialiased; }
::selection { background-color: #25225E; color: #F1F1F1; }
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #F1F1F1; }
::-webkit-scrollbar-thumb { background: rgba(37,34,94,0.2); }
#cursor-ring {
    position: fixed; top: 0; left: 0; width: 30px; height: 30px;
    border: 1px solid #FFB150; border-radius: 50%; pointer-events: none;
    z-index: 10000; transform: translate(-50%,-50%);
    transition: width .3s, height .3s, background-color .3s; mix-blend-mode: multiply;
}
#cursor-dot {
    position: fixed; top: 0; left: 0; width: 4px; height: 4px;
    background: #25225E; border-radius: 50%; pointer-events: none;
    z-index: 10000; transform: translate(-50%,-50%);
}
.cinematic-grain {
    position: fixed; inset: 0; pointer-events: none; z-index: 9999; opacity: 0.04;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    mix-blend-mode: multiply;
}
.light-leak { position: fixed; border-radius: 50%; filter: blur(150px); opacity: 0.15; pointer-events: none; z-index: 0; }
.hairline { border-color: rgba(37,34,94,0.15); }
.editorial-img-wrap { overflow: hidden; position: relative; }
.editorial-img { width: 100%; height: 120%; object-fit: cover; filter: grayscale(100%) contrast(1.1); transition: filter .8s ease; }
.editorial-img-wrap:hover .editorial-img { filter: grayscale(0%) contrast(1.05); }
.vertical-text { writing-mode: vertical-rl; transform: rotate(180deg); }
a, button { cursor: none; }
</style>
@endpush

@section('content')

<div class="cinematic-grain"></div>
<div class="light-leak w-[50vw] h-[50vw] bg-[#FFB150] top-[-10vw] left-[-10vw]" id="leak-1"></div>
<div class="light-leak w-[40vw] h-[40vw] bg-[#DB5F10] bottom-10 right-[-10vw]" id="leak-2"></div>
<div id="cursor-ring"></div>
<div id="cursor-dot"></div>

@include('partials.navbar')

{{-- ══════════════════════════════════════════
     1. HERO SECTION
══════════════════════════════════════════ --}}
<section class="relative w-full min-h-[100svh] flex flex-col justify-center px-8 md:px-16 pb-16 z-10" style="padding-top: clamp(8rem, 18vh, 14rem);">
    <div class="flex flex-col md:flex-row justify-between items-end gap-12 w-full">
        <div class="w-full md:w-3/4 hero-reveal">
            <h1 class="font-serif text-[15vw] md:text-[12vw] leading-[0.85] tracking-tighter m-0"
                style="font-family:'Instrument Serif',serif; color:#25225E;">
                @php
                    $titleId = $settings['about_hero_title'] ?? "Here Comes";
                    $titleEn = $settings['about_hero_title_en'] ?? "Here Comes";
                @endphp
                <span class="dynamic-i18n" data-lang-id="{{ $titleId }}" data-lang-en="{{ $titleEn }}">{{ $titleId }}</span><br>
                <span class="italic pl-[5vw]" style="color:#FFB150;">The Fun.</span>
            </h1>
        </div>
        <div class="w-full md:w-1/4 pb-4 hero-reveal">
            @php
                $subId = $settings['about_hero_subtitle'] ?? 'Sebuah ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.';
                $subEn = $settings['about_hero_subtitle_en'] ?? 'A playground for a new generation of storytellers who dare to break rigid traditions to change the landscape of Indonesian cinema.';
            @endphp
            <p class="font-sans text-xs md:text-sm font-light leading-relaxed" style="color:rgba(37,34,94,0.7);">
                <span class="dynamic-i18n" data-lang-id="{{ $subId }}" data-lang-en="{{ $subEn }}">{{ $subId }}</span>
            </p>
            <div class="mt-8 pt-4 border-t hairline flex justify-between font-sans text-[9px] tracking-widest uppercase" style="color:rgba(37,34,94,0.5);">
                <span>Scroll to explore</span><span>↓</span>
            </div>
        </div>
    </div>
    <div class="mt-16 w-full flex justify-center hero-reveal">
        <div class="editorial-img-wrap w-full md:w-[60%] bg-[#CACAEF]/30" style="aspect-ratio:21/9;">
            <img src="{{ isset($settings['about_hero_image']) ? asset($settings['about_hero_image']) : 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=2000&auto=format&fit=crop' }}"
                alt="Sinemaku" class="editorial-img para-img">
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     2. MANIFESTO (01 — Misi)
══════════════════════════════════════════ --}}
<section id="about-mission" class="py-32 px-8 md:px-16 z-10 relative bg-[#F1F1F1]">
    <div class="border-t hairline pt-12 flex flex-col md:flex-row gap-12 md:gap-32">
        <div class="w-full md:w-1/12">
            <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold block mb-4" style="color:#FFB150;">01 — Misi</span>
        </div>
        <div class="w-full md:w-11/12 flex flex-col gap-24">
            @php
                $missionHeading = $settings['about_identity_heading'] ?? 'Bukan sekadar rumah produksi, kami menghidupkan narasi segar dengan visual premium tanpa pernah melupakan semangat kolaborasi.';
                $missionHeadingEn = $settings['about_identity_heading_en'] ?? 'Not just a production house — we bring fresh narratives to life with premium visuals without ever forgetting the spirit of collaboration.';
            @endphp
            <h2 class="font-serif text-4xl md:text-6xl lg:text-7xl leading-[1.1] tracking-tight max-w-4xl text-reveal"
                style="font-family:'Instrument Serif',serif; color:#25225E;">
                <span class="dynamic-i18n" data-lang-id="{{ $missionHeading }}" data-lang-en="{{ $missionHeadingEn }}">{{ $missionHeading }}</span>
            </h2>
            <div class="flex flex-col md:flex-row gap-16 md:gap-32 w-full md:w-4/5 ml-auto">
                <div class="flex-1 text-reveal">
                    <span class="font-serif italic text-3xl mb-6 block" style="font-family:'Instrument Serif',serif; color:#FFB150;">Company.</span>
                    <p class="font-sans text-sm md:text-base font-light leading-loose" style="color:rgba(37,34,94,0.8);">
                        @php
                            $studioBody = $settings['about_studio_body'] ?? 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.';
                            $studioBodyEn = $settings['about_studio_body_en'] ?? 'Learn how Sinemaku operates. Explore our identity, our approach, and our role in nurturing young filmmakers for the Indonesian film ecosystem.';
                        @endphp
                        <span class="dynamic-i18n" data-lang-id="{{ $studioBody }}" data-lang-en="{{ $studioBodyEn }}">{{ $studioBody }}</span>
                    </p>
                </div>
                <div class="flex-1 text-reveal">
                    <span class="font-serif italic text-3xl mb-6 block" style="font-family:'Instrument Serif',serif; color:#FFB150;">Culture.</span>
                    <p class="font-sans text-sm md:text-base font-light leading-loose" style="color:rgba(37,34,94,0.8);">
                        @php
                            $cultureBody = $settings['about_team_body'] ?? 'Kami percaya bahwa cerita terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar lebar.';
                            $cultureBodyEn = $settings['about_team_body_en'] ?? 'We believe the best stories are born from the courage to explore crazy ideas and magically transform reality onto the big screen.';
                        @endphp
                        <span class="dynamic-i18n" data-lang-id="{{ $cultureBody }}" data-lang-en="{{ $cultureBodyEn }}">{{ $cultureBody }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     3. THE CREW (02 — Kru)
══════════════════════════════════════════ --}}
<section id="about-team" class="py-32 px-8 md:px-16 z-10 relative bg-[#F1F1F1]">
    <div class="border-t hairline pt-12 flex flex-col md:flex-row gap-12 md:gap-32 mb-24">
        <div class="w-full md:w-1/12">
            <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold block mb-4" style="color:#FFB150;">
                02 — <span data-i18n="about_team_eyebrow">Kru</span>
            </span>
        </div>
        <div class="w-full md:w-11/12">
            <h2 class="font-serif text-5xl md:text-8xl leading-none tracking-tighter text-reveal"
                style="font-family:'Instrument Serif',serif; color:#25225E;">
                Orang-orang di<br>balik <span class="italic" style="color:#FFB150;">kamera.</span>
            </h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-24 md:gap-x-12 relative pb-20">
        <div class="md:col-start-6 md:col-span-6 flex items-end gap-6 group reveal-image relative">
            <div class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase pb-4" style="color:rgba(37,34,94,0.4);">Founder / Producer</div>
            <div class="w-full editorial-img-wrap bg-[#CACAEF]/20" style="aspect-ratio:3/4;">
                <img src="{{ isset($settings['about_team_image_1']) ? asset($settings['about_team_image_1']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1200&auto=format&fit=crop' }}"
                    class="editorial-img para-img" alt="Team">
            </div>
        </div>
        <div class="md:col-start-2 md:col-span-3 flex items-end gap-4 group md:-mt-32 reveal-image">
            <div class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase pb-4" style="color:rgba(37,34,94,0.4);">Director</div>
            <div class="w-full editorial-img-wrap bg-[#CACAEF]/20" style="aspect-ratio:4/5;">
                <img src="{{ isset($settings['about_team_image_2']) ? asset($settings['about_team_image_2']) : 'https://images.unsplash.com/photo-1499996860823-5214fcc65f8f?q=80&w=800&auto=format&fit=crop' }}"
                    class="editorial-img para-img" alt="Team">
            </div>
        </div>
        <div class="md:col-start-4 md:col-span-5 flex items-start gap-4 group reveal-image">
            <div class="w-full editorial-img-wrap bg-[#CACAEF]/20" style="aspect-ratio:1/1;">
                <img src="{{ isset($settings['about_team_image_3']) ? asset($settings['about_team_image_3']) : 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=1000&auto=format&fit=crop' }}"
                    class="editorial-img para-img" alt="Team">
            </div>
            <div class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase pt-4" style="color:rgba(37,34,94,0.4);">Cinematographer</div>
        </div>
        <div class="md:col-start-8 md:col-span-5 flex items-end gap-4 group md:-mt-40 reveal-image">
            <div class="vertical-text font-sans text-[10px] tracking-[0.3em] uppercase pb-4" style="color:rgba(37,34,94,0.4);">Art Director</div>
            <div class="w-full editorial-img-wrap bg-[#CACAEF]/20" style="aspect-ratio:16/9;">
                <img src="{{ isset($settings['about_team_image_4']) ? asset($settings['about_team_image_4']) : 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800&auto=format&fit=crop' }}"
                    class="editorial-img para-img" alt="Team">
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     4. WHAT WE DO (03 — Fokus)
══════════════════════════════════════════ --}}
<section id="about-what-we-do" class="py-32 px-8 md:px-16 z-10 relative bg-[#F1F1F1]">
    <div class="border-t hairline pt-12 flex flex-col md:flex-row gap-12 md:gap-32">
        <div class="w-full md:w-1/12">
            <span class="font-sans text-[10px] tracking-[0.2em] uppercase font-bold block mb-4" style="color:#FFB150;">03 — Fokus</span>
        </div>
        <div class="w-full md:w-11/12">
            <div class="flex flex-col">
                @php
                    $wwdItems = [
                        [
                            'title'    => $settings['about_values_1_title'] ?? 'Film & Seri Web',
                            'title_en' => $settings['about_values_1_title_en'] ?? 'Film & Web Series',
                            'body'     => $settings['about_values_1_body'] ?? 'Estetika visual yang menantang batas-batas konvensional.',
                            'body_en'  => $settings['about_values_1_body_en'] ?? 'Visual aesthetics that challenge conventional boundaries.',
                        ],
                        [
                            'title'    => $settings['about_values_2_title'] ?? 'Tayangan Televisi',
                            'title_en' => $settings['about_values_2_title_en'] ?? 'Television Shows',
                            'body'     => $settings['about_values_2_body'] ?? 'Kisah hangat untuk ruang keluarga yang dekat dengan realitas.',
                            'body_en'  => $settings['about_values_2_body_en'] ?? 'Warm stories for the family room, close to reality.',
                        ],
                        [
                            'title'    => $settings['about_values_3_title'] ?? 'Komunitas & Event',
                            'title_en' => $settings['about_values_3_title_en'] ?? 'Community & Events',
                            'body'     => $settings['about_values_3_body'] ?? 'Rantai penghubung antarsineas lewat Sinemaku Day.',
                            'body_en'  => $settings['about_values_3_body_en'] ?? 'Connecting filmmakers through Sinemaku Day.',
                        ],
                    ];
                @endphp
                @foreach($wwdItems as $item)
                <div class="group flex flex-col md:flex-row justify-between items-start md:items-center py-10 md:py-16 border-b hairline list-row">
                    <h3 class="font-serif text-5xl md:text-7xl transition-all duration-500"
                        style="font-family:'Instrument Serif',serif; color:#25225E;"
                        onmouseenter="this.style.fontStyle='italic'; this.style.color='#FFB150'"
                        onmouseleave="this.style.fontStyle=''; this.style.color='#25225E'">
                        <span class="dynamic-i18n" data-lang-id="{{ $item['title'] }}" data-lang-en="{{ $item['title_en'] }}">{{ $item['title'] }}</span>
                    </h3>
                    <p class="font-sans font-light text-sm md:w-1/3 mt-4 md:mt-0 leading-relaxed text-left md:text-right" style="color:rgba(37,34,94,0.5);">
                        <span class="dynamic-i18n" data-lang-id="{{ $item['body'] }}" data-lang-en="{{ $item['body_en'] }}">{{ $item['body'] }}</span>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     5. FOOTER COLOPHON
══════════════════════════════════════════ --}}
<footer id="get-in-touch" class="bg-[#F1F1F1] pt-32 pb-12 px-8 md:px-16 z-20 relative">
    <div class="border-t hairline pt-16 flex flex-col items-center text-center mb-32">
        @php
            $collabEyebrow   = $settings['about_collab_eyebrow'] ?? 'Kolaborasi';
            $collabEyebrowEn = $settings['about_collab_eyebrow_en'] ?? 'Collaboration';
        @endphp
        <span class="font-sans text-[10px] tracking-[0.3em] uppercase font-bold mb-8 block" style="color:rgba(37,34,94,0.4);">
            <span class="dynamic-i18n" data-lang-id="{{ $collabEyebrow }}" data-lang-en="{{ $collabEyebrowEn }}">{{ $collabEyebrow }}</span>
        </span>
        <a href="mailto:hello@sinemakupictures.com"
            class="font-serif text-5xl md:text-8xl transition-all duration-500"
            style="font-family:'Instrument Serif',serif; color:#25225E; text-decoration:none;"
            onmouseenter="this.style.fontStyle='italic'; this.style.color='#FFB150'"
            onmouseleave="this.style.fontStyle=''; this.style.color='#25225E'">
            hello@sinemakupictures.com
        </a>
    </div>
    <div class="w-full flex flex-col md:flex-row justify-between items-end gap-12 border-t hairline pt-8">
        <div class="flex gap-8 md:gap-16 font-sans text-[9px] font-bold uppercase tracking-[0.2em]" style="color:rgba(37,34,94,0.6);">
            <a href="#" style="color:rgba(37,34,94,0.6); text-decoration:none;" onmouseenter="this.style.color='#FFB150'" onmouseleave="this.style.color='rgba(37,34,94,0.6)'">Instagram</a>
            <a href="#" style="color:rgba(37,34,94,0.6); text-decoration:none;" onmouseenter="this.style.color='#FFB150'" onmouseleave="this.style.color='rgba(37,34,94,0.6)'">YouTube</a>
            <a href="#" style="color:rgba(37,34,94,0.6); text-decoration:none;" onmouseenter="this.style.color='#FFB150'" onmouseleave="this.style.color='rgba(37,34,94,0.6)'">Twitter</a>
        </div>
        <div class="flex flex-col items-end gap-2 text-right">
            <h2 class="font-serif text-2xl m-0" style="font-family:'Instrument Serif',serif; color:#25225E;">Sinemaku Pictures</h2>
            <span class="font-sans text-[9px] tracking-[0.2em] uppercase" style="color:rgba(37,34,94,0.4);">© 2026 Hak Cipta Dilindungi</span>
        </div>
    </div>
</footer>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
gsap.registerPlugin(ScrollTrigger);

// 1. Custom Cursor
const cursorRing = document.getElementById('cursor-ring');
const cursorDot  = document.getElementById('cursor-dot');
let mouseX = window.innerWidth / 2, mouseY = window.innerHeight / 2;
let ringX = mouseX, ringY = mouseY;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX; mouseY = e.clientY;
    gsap.to(cursorDot, { x: mouseX, y: mouseY, duration: 0.1, ease: 'none' });
});
gsap.ticker.add(() => {
    ringX += (mouseX - ringX) * 0.15;
    ringY += (mouseY - ringY) * 0.15;
    gsap.set(cursorRing, { x: ringX, y: ringY });
});
document.querySelectorAll('a, button').forEach(el => {
    el.addEventListener('mouseenter', () => {
        gsap.to(cursorRing, { scale: 1.8, backgroundColor: 'rgba(255,177,80,0.2)', duration: 0.3 });
        gsap.to(cursorDot,  { scale: 0, duration: 0.2 });
    });
    el.addEventListener('mouseleave', () => {
        gsap.to(cursorRing, { scale: 1, backgroundColor: 'transparent', duration: 0.3 });
        gsap.to(cursorDot,  { scale: 1, duration: 0.2 });
    });
});

// 2. Light Leak Parallax
document.addEventListener('mousemove', (e) => {
    const x = (e.clientX / window.innerWidth - 0.5) * 100;
    const y = (e.clientY / window.innerHeight - 0.5) * 100;
    gsap.to('#leak-1', { x: x * 1.5, y: y * 1.5, duration: 3, ease: 'power1.out' });
    gsap.to('#leak-2', { x: -x * 2,  y: -y * 2,  duration: 4, ease: 'power1.out' });
});

// 3. Editorial Image Parallax
gsap.utils.toArray('.editorial-img-wrap').forEach(container => {
    const img = container.querySelector('.para-img');
    if (!img) return;
    gsap.to(img, {
        yPercent: 15, ease: 'none',
        scrollTrigger: { trigger: container, start: 'top bottom', end: 'bottom top', scrub: true }
    });
});

// 4. Hero Reveal
gsap.from('.hero-reveal', { y: 40, opacity: 0, stagger: 0.2, duration: 1.5, ease: 'expo.out', delay: 0.2 });

// 5. Text Reveals
gsap.utils.toArray('.text-reveal').forEach(el => {
    gsap.from(el, {
        scrollTrigger: { trigger: el, start: 'top 85%' },
        y: 30, opacity: 0, duration: 1.5, ease: 'power3.out'
    });
});

// 6. Image Grid Reveals
gsap.utils.toArray('.reveal-image').forEach(el => {
    gsap.from(el, {
        scrollTrigger: { trigger: el, start: 'top 85%' },
        y: 50, opacity: 0, duration: 1.5, ease: 'power2.out'
    });
});

// 7. List Row Reveals
gsap.utils.toArray('.list-row').forEach((row, i) => {
    gsap.from(row, {
        scrollTrigger: { trigger: row, start: 'top 90%' },
        opacity: 0, y: 20, duration: 1, delay: i * 0.1, ease: 'power2.out'
    });
});
</script>
@endpush
@endsection