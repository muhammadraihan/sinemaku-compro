{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-tint-3 pt-24 pb-12 px-8 md:px-16 z-20 relative w-full border-t hairline-border mt-auto font-sans">
    <div class="max-w-[1600px] mx-auto">

        {{-- ============================================================
        TOP CTA: BIG MAILTO
        ============================================================ --}}
        <div class="flex flex-col items-center text-center mb-24 md:mb-32 pt-12">
            <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath/40 mb-8 block">
                <span data-i18n="footer_connect">Connect</span>
            </span>
            <a href="mailto:hello@sinemakupictures.com"
                class="font-serif text-[clamp(2.5rem,7vw,6rem)] leading-none text-brand-deepbreath hover:italic hover:text-brand-orange transition-all duration-500 cursor-none hover-target">
                hello@sinemakupictures.com
            </a>
        </div>

        {{-- ============================================================
        MIDDLE: LINKS & INFO
        ============================================================ --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 md:gap-8 border-t hairline-border pt-16 mb-16">

            {{-- Brand Info --}}
            <div class="md:col-span-5 lg:col-span-4 flex flex-col gap-6">
                <div class="flex items-center gap-3 text-brand-deepbreath">
                    <span class="iconify h-6 w-6 text-brand-orange" data-icon="lucide:film"></span>
                    <h1 class="font-serif text-3xl tracking-tight leading-none m-0">Sinemaku<br>Pictures.</h1>
                </div>
                <p class="text-sm font-light leading-relaxed text-brand-deepbreath/70 max-w-sm">
                    <span data-i18n="footer_brand_desc">Creating cinematic experiences that challenge conventions and
                        inspire new perspectives. We are storytellers, dreamers, and rebels with cameras.</span>
                </p>
            </div>

            {{-- Navigation --}}
            <div class="md:col-span-4 lg:col-span-4 lg:col-start-6">
                <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-6 block">
                    <span data-i18n="footer_navigation">Navigation</span>
                </span>
                <div class="grid grid-cols-2 gap-x-4 gap-y-4 text-sm font-medium">
                    @php
                        $footerNavItems = [
                            ['label' => 'Home', 'i18n' => 'footer_home', 'path' => '/'],
                            ['label' => 'Films', 'i18n' => 'footer_films', 'path' => '/films'],
                            ['label' => 'Serial', 'i18n' => 'footer_serial', 'path' => '/serial'],
                            ['label' => 'Shop', 'i18n' => 'footer_shop', 'path' => '/shops'],
                            ['label' => 'Articles', 'i18n' => 'footer_articles', 'path' => '/article'],
                            ['label' => 'Events', 'i18n' => 'footer_events', 'path' => '/events'],
                            ['label' => 'Careers', 'i18n' => 'footer_careers', 'path' => '/career'],
                            ['label' => 'Komunitas', 'i18n' => 'footer_community', 'path' => '/memberships'],
                        ];
                    @endphp
                    @foreach($footerNavItems as $nav)
                        <a href="{{ url($nav['path']) }}"
                            class="text-brand-deepbreath/70 hover:text-brand-orange transition-colors duration-300 cursor-none hover-target inline-block w-max">
                            <span data-i18n="{{ $nav['i18n'] }}">{{ $nav['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Socials --}}
            <div class="md:col-span-3 lg:col-span-3">
                <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-brand-orange mb-6 block">
                    <span data-i18n="footer_follow_us">Follow Us</span>
                </span>
                <div class="flex flex-col gap-4 text-sm font-medium">
                    @foreach ([['Instagram', '#', 'lucide:instagram'], ['YouTube', '#', 'lucide:youtube'], ['Twitter', '#', 'lucide:twitter']] as [$sName, $sUrl, $sIcon])
                        <a href="{{ $sUrl }}"
                            class="flex items-center gap-3 text-brand-deepbreath/70 hover:text-brand-orange transition-colors duration-300 cursor-none hover-target w-max">
                            <span class="iconify h-4 w-4" data-icon="{{ $sIcon }}"></span>
                            <span>{{ $sName }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ============================================================
        BOTTOM BAR: LEGAL & COPYRIGHT
        ============================================================ --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center md:items-end gap-8 border-t hairline-border pt-8">

            {{-- Legal Links & Copyright --}}
            <div class="flex flex-col gap-4 items-center md:items-start text-center md:text-left">
                <div
                    class="flex flex-wrap justify-center md:justify-start gap-4 md:gap-8 text-xs text-brand-deepbreath/60">
                    @php
                        $footerLinks = [
                            ['label' => 'Privacy Policy', 'i18n' => 'footer_privacy'],
                            ['label' => 'Terms of Service', 'i18n' => 'footer_terms'],
                            ['label' => 'Cookies', 'i18n' => 'footer_cookies'],
                        ];
                    @endphp
                    @foreach($footerLinks as $fl)
                        <a href="#" class="hover:text-brand-orange transition-colors duration-300 cursor-none hover-target">
                            <span data-i18n="{{ $fl['i18n'] }}">{{ $fl['label'] }}</span>
                        </a>
                    @endforeach
                </div>
                <span class="text-[9px] tracking-[0.2em] uppercase text-brand-deepbreath/40">
                    <span data-i18n="footer_copyright">© 2026 Sinemaku Pictures. All rights reserved.</span>
                </span>
            </div>

            {{-- Location --}}
            <div
                class="flex items-center gap-3 text-[9px] tracking-[0.3em] uppercase font-bold text-brand-deepbreath/60">
                <span>EST. 2020</span>
                <div class="w-1 h-1 rounded-full bg-brand-orange"></div>
                <span>JAKARTA, ID</span>
            </div>

        </div>

    </div>
</footer>