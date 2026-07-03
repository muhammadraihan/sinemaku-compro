@extends('layouts.app')

@section('title', $event->judul . ' | Sinemaku Pictures')

@section('content')

{{-- 1. CSS STYLES (Fine-tuned for the simple layout) --}}
<style>
    html {
        background-color: #FFF6F9 !important;
    }
    body {
        background-color: transparent !important;
        color: #22397A !important;
    }

    /* Override Global Interactive BG to match About/Simple style */
    #interactive-bg {
        background: radial-gradient(
            ellipse 50vw 50vh at var(--mx, 25%) var(--my, 55%),
            rgba(243, 107, 33, 0.3) 0%,
            transparent 60%
        ) !important;
        filter: blur(80px) !important;
        opacity: 0.6 !important;
    }

    .font-peckham { font-family: 'PeckhamPress', sans-serif; }
    .font-serif { font-family: 'Instrument Serif', serif; }

    .detail-content p {
        margin-bottom: 1.5rem;
    }

    /* Light Leaks specific to this page's mood */
    .detail-leak {
        position: fixed;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        opacity: 0.15;
        filter: blur(100px);
    }
</style>

{{-- Additional Light Leaks --}}
<div class="detail-leak w-[50vw] h-[50vw] bg-[#22397A]/20 top-[-10%] left-[-10%] animate-[float-left_25s_infinite]"></div>
<div class="detail-leak w-[40vw] h-[40vw] bg-[#F36B21]/20 bottom-[10%] right-[-5%] animate-[float-right_22s_infinite]"></div>

{{-- 3. NAVBAR --}}
@include('partials.navbar', ['navTheme' => 'event'])

<div id="event-detail-simple" class="relative z-10 pt-40 pb-32 px-8 md:px-16">
    <div class="max-w-6xl mx-auto">

        {{-- Header Section: Centered & Minimal --}}
        <div class="text-center mb-20">
            <span class="inline-block text-brand-orange font-bold text-[10px] md:text-xs uppercase tracking-[0.4em] mb-6">
                @i18n($event, 'category') {{-- Fallback to a static string if category doesn't exist --}}
                @if(!$event->category) GALA PREMIERE @endif
            </span>
            <h1 class="font-peckham text-brand-navy text-3xl md:text-[2.5vw] uppercase leading-[1.1] tracking-tighter mb-10 max-w-5xl mx-auto">
                @i18n($event, 'judul')
            </h1>
            <div class="font-serif text-brand-navy/60 text-xl md:text-2xl max-w-3xl mx-auto leading-relaxed detail-content italic">
                @i18n($event, 'detail')
            </div>
        </div>

        {{-- Main Media Section (After Movie or Thumbnail) --}}
        <div class="mb-12">
            @php
                $youtube_id = '';
                if ($event->video_link && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $event->video_link, $match)) {
                    $youtube_id = $match[1];
                }
            @endphp

            <div class="aspect-video w-full rounded-[2.5rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(34,57,122,0.3)] bg-brand-navy/5 relative group transition-transform duration-500 hover:scale-[1.01]">
                @if($youtube_id)
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <img src="{{ asset('photo/' . $event->photo) }}" alt="{{ $event->judul }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-brand-navy/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="openLightbox('{{ asset('photo/' . $event->photo) }}')">
                         <span class="iconify text-white" data-icon="lucide:zoom-in" data-width="64"></span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Info & Share Bar (Balanced below media)
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 mb-24 py-12 px-4 md:px-8 bg-white/30 backdrop-blur-md rounded-3xl border border-white/40 shadow-sm">
            <div class="flex flex-wrap gap-x-12 gap-y-8">
                {{-- Date/Time --}}
                {{-- <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Schedule</span>
                    <span class="text-sm font-bold text-brand-navy">
                        {{ \Carbon\Carbon::parse($event->tgl_event)->format('M d, Y') }}
                        @if($event->jam_event) <span class="text-brand-navy/30 mx-1">|</span> {{ \Carbon\Carbon::parse($event->jam_event)->format('H:i') }} WIB @endif
                    </span>
                </div> --}}
                {{-- Location --}}
                {{-- <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Location</span>
                    <span class="text-sm font-bold text-brand-navy">@i18n($event, 'location')</span>
                </div> --}}
                {{-- Price & CTA --}}
                {{-- <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Admission</span>
                    <div class="flex items-center gap-6">
                        <span class="text-sm font-bold text-brand-navy">
                            {{ $event->harga == 0 ? 'FREE ADMISSION' : 'IDR ' . number_format($event->harga, 0, ',', '.') }}
                        </span>
                        @if($event->link)
                        <a href="{{ $event->link }}" target="_blank" class="px-5 py-2 bg-brand-navy text-white text-[10px] font-bold rounded-full hover:bg-brand-orange transition-colors uppercase tracking-widest">
                            Book Tickets
                        </a>
                        @endif
                    </div>
                </div>
            </div> --}}

            {{-- Share
            <div class="flex flex-col md:items-end">
                <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-3">Share Event</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:instagram-line" data-width="18"></span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:twitter-x-line" data-width="16"></span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:whatsapp-line" data-width="18"></span>
                    </a>
                </div>
            </div>
        </div> --}}

        {{-- Dynamic Gallery Grid (2-3-2-3 Layout) --}}
        @php
            $allPhotos = collect();
            if($youtube_id) {
                // If video exists, thumbnail becomes a photo
                $allPhotos->push((object)[
                    'photo' => $event->photo,
                    'is_main' => true
                ]);
            }
            foreach($event->photos as $p) {
                $allPhotos->push($p);
            }
        @endphp

        <div class="grid grid-cols-4 gap-2 md:gap-3" style="grid-auto-rows: clamp(200px, 25vw, 500px);">
            @php
                $layoutClasses = [];
                $tempCount = $allPhotos->count();
                $i = 0;
                while ($tempCount > 0) {
                    if ($tempCount >= 5) {
                        array_push($layoutClasses, 'col-span-2', 'col-span-2', 'col-span-1', 'col-span-2', 'col-span-1');
                        $tempCount -= 5;
                    } elseif ($tempCount == 4) {
                        array_push($layoutClasses, 'col-span-2', 'col-span-2', 'col-span-2', 'col-span-2');
                        $tempCount = 0;
                    } elseif ($tempCount == 3) {
                        array_push($layoutClasses, 'col-span-1', 'col-span-2', 'col-span-1');
                        $tempCount = 0;
                    } elseif ($tempCount == 2) {
                        array_push($layoutClasses, 'col-span-2', 'col-span-2');
                        $tempCount = 0;
                    } elseif ($tempCount == 1) {
                        array_push($layoutClasses, 'col-span-2 col-start-2');
                        $tempCount = 0;
                    }
                }
            @endphp

            @foreach($allPhotos as $index => $photo)
                @php
                    $class = $layoutClasses[$index] ?? 'col-span-2';
                @endphp

                <div class="group relative {{ $class }} overflow-hidden rounded-[2rem] bg-brand-navy/5 cursor-pointer shadow-lg"
                     onclick="openLightbox('{{ asset('photo/' . $photo->photo) }}')">
                    <img src="{{ asset('photo/' . $photo->photo) }}" alt="Gallery Image"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-brand-navy/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center">
                            <span class="iconify text-white" data-icon="lucide:maximize-2" data-width="24"></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

         {{-- Info & Share Bar (Balanced below media) --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 mb-24 py-12 px-4 md:px-8 bg-white/30 backdrop-blur-md rounded-3xl border border-white/40 shadow-sm">
            <div class="flex flex-wrap gap-x-12 gap-y-8">
                {{-- Date/Time --}}
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Schedule</span>
                    <span class="text-sm font-bold text-brand-navy">
                        {{ \Carbon\Carbon::parse($event->tgl_event)->format('M d, Y') }}
                        @if($event->jam_event) <span class="text-brand-navy/30 mx-1">|</span> {{ \Carbon\Carbon::parse($event->jam_event)->format('H:i') }} WIB @endif
                    </span>
                </div>
                {{-- Location --}}
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Location</span>
                    <span class="text-sm font-bold text-brand-navy">@i18n($event, 'location')</span>
                </div>
                {{-- Price & CTA --}}
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-2">Admission</span>
                    <div class="flex items-center gap-6">
                        <span class="text-sm font-bold text-brand-navy">
                            {{ $event->harga == 0 ? 'FREE ADMISSION' : 'IDR ' . number_format($event->harga, 0, ',', '.') }}
                        </span>
                        @if($event->link)
                        <a href="{{ $event->link }}" target="_blank" class="px-5 py-2 bg-brand-navy text-white text-[10px] font-bold rounded-full hover:bg-brand-orange transition-colors uppercase tracking-widest">
                            Book Tickets
                        </a>
                        @endif
                    </div>
                </div>
            </div>

             {{-- Share --}}
            <div class="flex flex-col md:items-end">
                <span class="text-[9px] uppercase tracking-widest text-brand-navy/40 font-bold mb-3">Share Event</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:instagram-line" data-width="18"></span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:twitter-x-line" data-width="16"></span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/50 border border-brand-navy/5 flex items-center justify-center text-brand-navy hover:bg-brand-navy hover:text-white transition-all shadow-sm">
                        <span class="iconify" data-icon="ri:whatsapp-line" data-width="18"></span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Discover More footer --}}
        <div class="mt-32 text-center">
            <a href="/events" class="inline-flex flex-col items-center group">
                <span class="text-[10px] font-bold uppercase tracking-[0.4em] text-brand-navy/40 group-hover:text-brand-orange transition-colors mb-4">View All Events</span>
                <div class="w-12 h-12 rounded-full border border-brand-navy/10 flex items-center justify-center group-hover:bg-brand-navy group-hover:text-white transition-all">
                    <span class="iconify" data-icon="lucide:arrow-right" data-width="20"></span>
                </div>
            </a>
        </div>

    </div>
</div>

{{-- 4. LIGHTBOX --}}
<div id="lightbox" class="fixed inset-0 z-[9999] bg-brand-navy/95 hidden items-center justify-center p-8 backdrop-blur-2xl" onclick="closeLightbox()">
    <button class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors">
        <span class="iconify" data-icon="lucide:x" data-width="48"></span>
    </button>
    <img id="lightbox-img" src="" alt="Full preview" class="max-w-full max-h-full object-contain shadow-2xl scale-95 opacity-0 transition-all duration-500">
</div>

@include('components.footer')

@endsection

@push('scripts')
<script>
    // Lightbox Logic
    function openLightbox(src) {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        img.src = src;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        setTimeout(() => {
            img.classList.remove('scale-95', 'opacity-0');
            img.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        img.classList.add('scale-95', 'opacity-0');
        img.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }, 500);
    }
</script>
@endpush
