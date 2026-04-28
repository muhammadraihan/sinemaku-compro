{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-brand-deepbreath text-white pt-24 pb-12 px-8 md:px-16 z-20 relative w-full border-t border-white/10 mt-auto font-sans">
    <div class="max-w-[1600px] mx-auto">

        {{-- ============================================================
        TOP SECTION: CTA & INFO COLUMNS
        ============================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-8 mb-24 items-start">
            
            {{-- Left: Big CTA --}}
            <div class="lg:col-span-6 flex flex-col items-start gap-12">
                <h2 class="font-serif text-5xl md:text-6xl leading-[1.1] max-w-xl">
                    You have a project idea?<br>
                    <span class="italic text-brand-orange">Let's talk about it!</span>
                </h2>
                <a href="mailto:hello@sinemakupictures.com" 
                   class="bg-white text-brand-deepbreath px-8 py-4 rounded-full font-sans text-sm font-bold uppercase tracking-widest hover:bg-brand-orange hover:text-white transition-all duration-300 cursor-none hover-target">
                    Contact us
                </a>
            </div>

            {{-- Right: Three Info Columns --}}
            <div class="lg:col-span-6 grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-8 pt-4">
                
                {{-- Navigation --}}
                <div>
                    <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-8 block">
                        <span data-i18n="footer_navigation">Pages</span>
                    </span>
                    <div class="flex flex-col gap-4 text-sm font-medium">
                        @php
                            $footerNavItems = [
                                ['label' => 'Home', 'i18n' => 'footer_home', 'path' => '/'],
                                ['label' => 'Films', 'i18n' => 'footer_films', 'path' => '/films'],
                                ['label' => 'Serial', 'i18n' => 'footer_serial', 'path' => '/serial'],
                                ['label' => 'Articles', 'i18n' => 'footer_articles', 'path' => '/article'],
                                ['label' => 'Events', 'i18n' => 'footer_events', 'path' => '/events'],
                            ];
                        @endphp
                        @foreach($footerNavItems as $nav)
                            <a href="{{ url($nav['path']) }}"
                                class="text-white/60 hover:text-white transition-colors duration-300 cursor-none hover-target inline-block w-max">
                                <span data-i18n="{{ $nav['i18n'] }}">{{ $nav['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-8 block">Email</span>
                    <a href="mailto:hello@sinemakupictures.com" 
                       class="text-white/60 hover:text-white transition-colors duration-300 cursor-none hover-target text-sm font-medium break-all">
                        hello@sinemakupictures.com
                    </a>
                </div>

                {{-- Address --}}
                <div>
                    <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-8 block">Address</span>
                    <address class="text-white/60 text-sm font-medium not-italic leading-relaxed">
                        Jakarta, Indonesia<br>
                        EST. 2020
                    </address>
                </div>

            </div>
        </div>

        {{-- ============================================================
        BOTTOM BAR: LOGO, SOCIALS & COPYRIGHT
        ============================================================ --}}
        <div class="border-t border-white/10 pt-12 flex flex-col md:flex-row justify-between items-center gap-12">
            
            {{-- Brand Logo --}}
            <div class="flex items-center gap-4">
                <span class="iconify h-8 w-8 text-brand-orange" data-icon="lucide:film"></span>
                <h1 class="font-serif text-3xl tracking-tight leading-none m-0">Sinemaku Pictures.</h1>
            </div>

            {{-- Socials --}}
            <div class="flex gap-8">
                @foreach ([['Instagram', '#', 'lucide:instagram'], ['YouTube', '#', 'lucide:youtube'], ['Twitter', '#', 'lucide:twitter']] as [$sName, $sUrl, $sIcon])
                    <a href="{{ $sUrl }}"
                        class="text-white/40 hover:text-white transition-colors duration-300 cursor-none hover-target flex items-center gap-2 text-[10px] tracking-widest uppercase font-bold">
                        <span class="iconify h-4 w-4" data-icon="{{ $sIcon }}"></span>
                        <span>{{ $sName }}</span>
                    </a>
                @endforeach
            </div>

            {{-- Copyright --}}
            <div class="text-[9px] tracking-[0.2em] uppercase text-white/40">
                <span data-i18n="footer_copyright">© 2026 Sinemaku Pictures. All rights reserved.</span>
            </div>

        </div>

    </div>
</footer>