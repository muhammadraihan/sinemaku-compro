<footer class="bg-black text-white relative overflow-hidden">
    <!-- Subtle background pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-transparent to-gray-900"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                <!-- Brand Section -->
                <div class="lg:col-span-5 space-y-8">
                    <div class="flex items-center space-x-3 group">
                        <svg class="h-10 w-10 text-white group-hover:text-gray-300 transition-colors duration-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 3v18"/><path d="M3 7.5h4"/><path d="M3 12h18"/><path d="M3 16.5h4"/><path d="M17 3v18"/><path d="M21 7.5h-4"/><path d="M21 16.5h-4"/></svg>
                        <span class="text-2xl font-bold tracking-tight">SINEMAKU PICTURES</span>
                    </div>
                    
                    <p class="text-gray-400 editorial-text text-lg leading-relaxed max-w-md">
                        Creating cinematic experiences that challenge conventions and inspire new perspectives. 
                        We are storytellers, dreamers, and rebels with cameras.
                    </p>
                </div>

                <!-- Navigation Links -->
                <div class="lg:col-span-4 space-y-8">
                    <h3 class="text-lg font-semibold text-white">Navigation</h3>
                    @php
                        $navigationLinks = [
                            ['name' => 'Home', 'path' => '/'],
                            ['name' => 'Films', 'path' => '/movies'],
                            ['name' => 'Series', 'path' => '/series'],
                            ['name' => 'Shop', 'path' => '/shop'],
                            ['name' => 'Articles', 'path' => '/articles'],
                            ['name' => 'Events', 'path' => '/events'],
                            ['name' => 'Careers', 'path' => '/jobs'],
                        ];
                    @endphp
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($navigationLinks as $link)
                            <a href="{{ url($link['path']) }}" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-base group">
                                <span class="group-hover:translate-x-1 transition-transform duration-300 inline-block">
                                    {{ $link['name'] }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Contact & Social -->
                <div class="lg:col-span-3 space-y-8">
                    <h3 class="text-lg font-semibold text-white">Connect</h3>
                    
                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <svg class="h-4 w-4 text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <a href="mailto:hello@sinemakupictures.com" class="text-gray-400 hover:text-white transition-colors duration-300 editorial-text">
                                hello@sinemakupictures.com
                            </a>
                        </div>
                        <p class="text-gray-500 editorial-text text-sm">
                            Jakarta, Indonesia
                        </p>
                    </div>

                    <!-- Social Media -->
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-white">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="p-3 bg-gray-900 hover:bg-gray-800 transition-all duration-300 group hover:scale-110" aria-label="Instagram">
                                <svg class="h-5 w-5 text-gray-400 group-hover:text-white transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                            </a>
                            <a href="#" class="p-3 bg-gray-900 hover:bg-gray-800 transition-all duration-300 group hover:scale-110" aria-label="YouTube">
                                <svg class="h-5 w-5 text-gray-400 group-hover:text-white transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                            </a>
                            <a href="#" class="p-3 bg-gray-900 hover:bg-gray-800 transition-all duration-300 group hover:scale-110" aria-label="Twitter">
                                <svg class="h-5 w-5 text-gray-400 group-hover:text-white transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 1.4 3.3 4.9 3.3 4.9s-1.4-.6-2.8-.9c-1.2 2.2-2.7 3.8-4.5 4.8s-4.1 1.4-6.3.8c-2.3-.6-4-1.9-5.2-3.9s-1.5-4.5-1-7.1c.5-2.6 1.9-4.9 3.8-6.7s4.3-3.1 7-3.3c2.8-.2 5.1 1.1 6.8 3.1 1.7 2 2.8 4.7 2.8 4.7z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-8">
                    <p class="text-gray-500 editorial-text text-sm">
                        © 2024 Sinemaku Pictures. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        @foreach (['Privacy Policy', 'Terms of Service', 'Cookies'] as $item)
                            <a href="#" class="text-gray-500 hover:text-gray-300 transition-colors duration-300 editorial-text text-sm">
                                {{ $item }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex items-center space-x-2 text-gray-600">
                    <span class="text-xs editorial-text tracking-wider">EST. 2020</span>
                    <div class="w-1 h-1 bg-gray-600 rounded-full"></div>
                    <span class="text-xs editorial-text tracking-wider">JAKARTA</span>
                </div>
            </div>
        </div>
    </div>
</footer>
