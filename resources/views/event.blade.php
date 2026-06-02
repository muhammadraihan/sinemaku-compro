@extends('layouts.app')

@section('title', 'Events | Sinemaku Pictures')

@section('content')

    @include('partials.navbar', ['navTheme' => 'event'])



{{-- ============================================================
EDITORIAL WRAPPER
============================================================ --}}
<div id="editorial-wrapper" class="text-brand-navy relative w-full font-sans min-h-screen bg-[#FFF6F9]">
    


    {{-- ============================================================
    HEADER
    ============================================================ --}}
    <section class="pt-40 md:pt-48 px-8 md:px-16 max-w-[1400px] mx-auto relative z-10 text-center">
        <h2 class="font-serif italic text-5xl md:text-7xl text-brand-navy leading-none tracking-tight mb-12">
            Our <span class="font-sans font-black not-italic text-brand-orange uppercase mx-2">Events</span>
        </h2>

        <!-- Filter Pills -->
        <div class="flex flex-wrap justify-center gap-3 mb-24">
            <button class="filter-pill active" data-category="all">ALL</button>
            @foreach($event_kategori as $cat)
                <button class="filter-pill" data-category="{{ $cat->uuid }}">{{ strtoupper($cat->name) }}</button>
            @endforeach
        </div>
    </section>

    {{-- ============================================================
    CONTENT SECTION
    ============================================================ --}}
    <section class="px-8 md:px-16 pb-32 max-w-[1400px] mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- LEFT: Photos Collage -->
            <div class="lg:col-span-4 sticky top-48">
                <div class="flex flex-col gap-4">
                    <!-- Top Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $collageImages = $event->take(6);
                        @endphp
                        @foreach($collageImages->take(2) as $img)
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-lg">
                                <img src="{{ asset('photo/' . $img->photo) }}" class="w-full h-full object-cover" alt="Event photo">
                            </div>
                        @endforeach
                    </div>
                    <!-- Middle Grid (3 columns) -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($collageImages->slice(2, 3) as $img)
                            <div class="aspect-square rounded-2xl overflow-hidden shadow-lg">
                                <img src="{{ asset('photo/' . $img->photo) }}" class="w-full h-full object-cover" alt="Event photo">
                            </div>
                        @endforeach
                    </div>
                    <!-- Bottom Large -->
                    @if($collageImages->count() > 5)
                        <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('photo/' . $collageImages->last()->photo) }}" class="w-full h-full object-cover" alt="Event photo">
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT: Timeline -->
            <div class="lg:col-span-8">
                <div class="flex flex-col">
                    @forelse($event as $index => $item)
                        <div class="event-timeline-item flex items-start gap-6 py-8 border-b border-brand-navy/10 group hover:bg-brand-orange/[0.02] transition-colors duration-500 rounded-xl px-4" 
                             data-category="{{ $item->event_kategori_uuid }}">
                            
                            <!-- Date Badge & Connector -->
                            <div class="flex flex-col items-center shrink-0">
                                <div class="w-16 h-16 rounded-xl bg-white shadow-sm border border-brand-navy/5 flex flex-col items-center justify-center">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-brand-navy/40 leading-none mb-1">{{ \Carbon\Carbon::parse($item->tgl_event)->format('M') }}</span>
                                    <span class="text-xs font-bold text-brand-navy leading-none">{{ \Carbon\Carbon::parse($item->tgl_event)->format('Y') }}</span>
                                </div>
                                @if(!$loop->last)
                                    <div class="w-px flex-grow border-l-2 border-dashed border-brand-navy/10 my-2 min-h-[4rem]"></div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="flex-grow pt-2">
                                <a href="{{ route('detail-event', $item->slug) }}" class="block group/link">
                                    <h3 class="text-xl md:text-2xl font-bold text-brand-navy mb-2 group-hover/link:text-brand-orange transition-colors">
                                        [{{ strtoupper($item->eventKategori->name ?? 'Event') }}] {{ $item->judul }}
                                    </h3>
                                    <p class="text-xs md:text-sm uppercase tracking-widest text-brand-navy/40">
                                        {{ \Carbon\Carbon::parse($item->tgl_event)->format('d M Y') }} — {{ $item->title }}
                                    </p>
                                </a>
                            </div>

                            <!-- Thumbnail Image Action (Uniform & Fixed) -->
                            <div class="shrink-0 hidden md:block self-center">
                                <a href="{{ route('detail-event', $item->slug) }}" class="w-60 h-36 rounded-xl overflow-hidden block shadow-lg hover:scale-105 transition-transform duration-500 cursor-none hover-target">
                                    <img src="{{ asset('photo/' . $item->photo) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center font-sans text-xs tracking-widest uppercase font-bold text-brand-navy/30">
                            No events found.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

</div>

<style>
    .filter-pill {
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        font-family: var(--font-sans);
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        border: 2px solid #f46a21;
        color: #f46a21;
    }
    .filter-pill:hover {
        background-color: rgba(244, 106, 33, 0.1);
        transform: translateY(-2px);
    }
    .filter-pill.active {
        background-color: #f46a21;
        color: white;
        box-shadow: 0 10px 20px rgba(244, 106, 33, 0.2);
    }

    .event-timeline-item {
        /* Remove CSS transition as it conflicts with GSAP */
        opacity: 1;
        transform: none;
    }
</style>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        // Removed initial ScrollTrigger animation to prevent the items from disappearing
    }

    // Filter Logic
    const pills = document.querySelectorAll('.filter-pill');
    const items = document.querySelectorAll('.event-timeline-item');

    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            // Update UI
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const category = pill.getAttribute('data-category');

            items.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                
                if (category === 'all' || itemCategory === category) {
                    item.style.display = 'flex';
                    gsap.fromTo(item, { opacity: 0, y: 10 }, { opacity: 1, y: 0, duration: 0.5 });
                } else {
                    item.style.display = 'none';
                }
            });

            // Re-trigger ScrollTrigger to recalculate positions
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.refresh();
            }
        });
    });
});
</script>

@include('components.footer')

@endsection
