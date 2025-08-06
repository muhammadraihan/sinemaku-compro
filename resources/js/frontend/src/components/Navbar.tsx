import React, { useState, useEffect } from 'react';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import { Menu, X, Search, Film, Calendar, Briefcase, ShoppingBag, Users, ArrowRight } from 'lucide-react';

const Navbar = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [isSearchOpen, setIsSearchOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');
  const [searchResults, setSearchResults] = useState<any[]>([]);
  const [scrolled, setScrolled] = useState(false);
  const [visible, setVisible] = useState(true);
  const [lastScrollY, setLastScrollY] = useState(0);
  const location = useLocation();
  const navigate = useNavigate();

  // Determine if current page is homepage
  const isHomepage = location.pathname === '/';

  // Mock search data - in a real app, this would come from an API
  const searchData = {
    films: [
      { id: 'midnight', title: 'Midnight', year: '2024', type: 'Film', description: 'Psychological thriller exploring reality and dreams' },
      { id: 'silent-waters', title: 'Silent Waters', year: '2023', type: 'Film', description: 'Drama about family and redemption' },
      { id: 'neon-dreams', title: 'Neon Dreams', year: '2023', type: 'Film', description: 'Sci-fi exploration of digital consciousness' }
    ],
    series: [
      { id: 'shadows-within', title: 'Shadows Within', year: '2024', type: 'Series', description: 'Psychological drama in suburban community' },
      { id: 'urban-chronicles', title: 'Urban Chronicles', year: '2024', type: 'Series', description: 'Crime drama set in modern Jakarta' },
      { id: 'digital-souls', title: 'Digital Souls', year: '2024', type: 'Series', description: 'Sci-fi thriller about consciousness uploading' }
    ],
    events: [
      { id: 'midnight-premiere', title: 'Midnight Premiere', date: 'March 15, 2024', type: 'Event', description: 'Exclusive premiere with Q&A session' },
      { id: 'cinematography-masterclass', title: 'Cinematography Masterclass', date: 'March 22, 2024', type: 'Event', description: 'Advanced techniques workshop' },
      { id: 'industry-networking-night', title: 'Industry Networking Night', date: 'April 5, 2024', type: 'Event', description: 'Connect with film professionals' }
    ],
    articles: [
      { id: 'cinematic-storytelling', title: 'The Evolution of Cinematic Storytelling', year: '2024', type: 'Article', description: 'Modern filmmaking techniques and innovation' },
      { id: 'midnight-score', title: "Behind the Scenes: Creating Midnight's Score", year: '2024', type: 'Article', description: 'Composer insights and creative process' },
      { id: 'practical-effects', title: 'The Art of Practical Effects', year: '2024', type: 'Article', description: 'Why practical effects still matter' }
    ],
    careers: [
      { id: 'lead-cinematographer', title: 'Lead Cinematographer', department: 'Production', type: 'Job', description: 'Shape visual language of sci-fi drama' },
      { id: 'sound-designer', title: 'Sound Designer', department: 'Post-Production', type: 'Job', description: 'Create immersive audio landscapes' },
      { id: 'urban-chronicles-lead', title: 'Lead Actor - Urban Chronicles', character: 'Detective Marco Santos', type: 'Casting', description: 'Charismatic lead for crime drama series' }
    ]
  };

  useEffect(() => {
    const handleScroll = () => {
      const currentScrollY = window.scrollY;
      
      // Determine if we've scrolled enough to trigger changes
      const hasScrolled = currentScrollY > 50;
      setScrolled(hasScrolled);
      
      // Determine visibility based on scroll direction
      if (currentScrollY < 10) {
        // Always show when near top
        setVisible(true);
      } else if (currentScrollY < lastScrollY) {
        // Scrolling up - show navbar
        setVisible(true);
      } else if (currentScrollY > lastScrollY && currentScrollY > 100) {
        // Scrolling down and past threshold - hide navbar
        setVisible(false);
      }
      
      setLastScrollY(currentScrollY);
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, [lastScrollY]);

  // Close menu when route changes
  useEffect(() => {
    setIsMenuOpen(false);
    setIsSearchOpen(false);
  }, [location]);

  // Prevent body scroll when menu is open
  useEffect(() => {
    if (isMenuOpen || isSearchOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'unset';
    }
    
    return () => {
      document.body.style.overflow = 'unset';
    };
  }, [isMenuOpen, isSearchOpen]);

  // Handle search
  useEffect(() => {
    if (searchQuery.trim() === '') {
      setSearchResults([]);
      return;
    }

    const query = searchQuery.toLowerCase();
    const results: any[] = [];

    // Search through all content types
    Object.entries(searchData).forEach(([category, items]) => {
      items.forEach((item: any) => {
        const searchableText = `${item.title} ${item.description || ''} ${item.year || ''} ${item.department || ''} ${item.character || ''}`.toLowerCase();
        
        if (searchableText.includes(query)) {
          results.push({
            ...item,
            category: item.type // Use the item's type directly instead of manipulating category name
          });
        }
      });
    });

    // Sort results by relevance (title matches first)
    results.sort((a, b) => {
      const aTitle = a.title.toLowerCase().includes(query);
      const bTitle = b.title.toLowerCase().includes(query);
      if (aTitle && !bTitle) return -1;
      if (!aTitle && bTitle) return 1;
      return 0;
    });

    setSearchResults(results.slice(0, 8)); // Limit to 8 results
  }, [searchQuery]);

  const navItems = [
    { name: 'Home', path: '/', description: 'Return to homepage' },
    { name: 'Films', path: '/movies', description: 'Explore our cinematic works' },
    { name: 'Series', path: '/series', description: 'Long-form storytelling' },
    { name: 'Shop', path: '/shop', description: 'Exclusive merchandise' },
    { name: 'Articles', path: '/articles', description: 'Stories and insights' },
    { name: 'Events', path: '/events', description: 'Premieres and screenings' },
    { name: 'Membership', path: '/membership', description: 'Join our inner circle' },
    { name: 'Careers', path: '/jobs', description: 'Join our creative team' },
  ];

  const handleSearchSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (searchResults.length > 0) {
      const firstResult = searchResults[0];
      navigateToResult(firstResult);
    }
  };

  const navigateToResult = (result: any) => {
    let path = '';
    
    switch (result.category) {
      case 'Film':
        path = `/movie/${result.id}`;
        break;
      case 'Series':
        path = `/series/${result.id}`;
        break;
      case 'Event':
        path = `/event/${result.id}`;
        break;
      case 'Article':
        path = `/article/${result.id}`;
        break;
      case 'Job':
        path = `/job/${result.id}`;
        break;
      case 'Casting':
        path = `/casting/${result.id}`;
        break;
      default:
        return;
    }
    
    navigate(path);
    setIsSearchOpen(false);
    setSearchQuery('');
  };

  const getResultIcon = (category: string) => {
    switch (category) {
      case 'Film':
      case 'Series':
        return <Film className="h-4 w-4" />;
      case 'Event':
        return <Calendar className="h-4 w-4" />;
      case 'Article':
        return <Users className="h-4 w-4" />;
      case 'Job':
      case 'Casting':
        return <Briefcase className="h-4 w-4" />;
      default:
        return <Search className="h-4 w-4" />;
    }
  };

  // Dynamic navbar styling based on page, scroll state, and menu state
  const getNavbarStyles = () => {
    // When mega menu or search is open, always use dark styling
    if (isMenuOpen || isSearchOpen) {
      return {
        background: 'bg-black/95 backdrop-blur-xl border-b border-white/10',
        logoColor: 'text-white group-hover:text-gray-300',
        textColor: 'text-white',
        iconColor: 'text-white hover:text-gray-300'
      };
    }

    if (isHomepage) {
      // Homepage: transparent/dark styling with glassmorphism on scroll
      return {
        background: scrolled 
          ? 'bg-black/30 backdrop-blur-xl border-b border-white/20' 
          : 'bg-transparent',
        logoColor: scrolled 
          ? 'text-white/95 group-hover:text-white' 
          : 'text-white group-hover:text-gray-300',
        textColor: scrolled 
          ? 'text-white/95 group-hover:text-white' 
          : 'text-white',
        iconColor: scrolled 
          ? 'text-white/95 hover:text-white' 
          : 'text-white hover:text-gray-300'
      };
    } else {
      // Other pages: light background with glassmorphism on scroll
      return {
        background: scrolled 
          ? 'bg-white/80 backdrop-blur-xl border-b border-gray-200/50 shadow-lg' 
          : 'bg-white border-b border-gray-200',
        logoColor: 'text-black group-hover:text-gray-700',
        textColor: 'text-black',
        iconColor: 'text-black hover:text-gray-700'
      };
    }
  };

  const styles = getNavbarStyles();

  return (
    <>
      {/* Main Navigation Bar - Edge to Edge */}
      <nav className={`fixed top-0 w-full z-50 transition-all duration-500 ease-out ${
        visible ? 'translate-y-0' : '-translate-y-full'
      } ${styles.background}`}>
        {/* Edge-to-edge container with full width */}
        <div className="w-full px-6 lg:px-8">
          <div className="flex justify-between items-center h-20">
            
            {/* Menu Button - Left Side */}
            <button
              onClick={() => setIsMenuOpen(!isMenuOpen)}
              className={`transition-all duration-500 z-60 relative ${styles.iconColor}`}
              aria-label="Toggle menu"
            >
              <div className="relative w-6 h-6">
                <Menu 
                  className={`h-6 w-6 absolute inset-0 transition-all duration-500 ${
                    isMenuOpen ? 'opacity-0 rotate-180' : 'opacity-100 rotate-0'
                  }`} 
                />
                <X 
                  className={`h-6 w-6 absolute inset-0 transition-all duration-500 ${
                    isMenuOpen ? 'opacity-100 rotate-0' : 'opacity-0 -rotate-180'
                  }`} 
                />
              </div>
            </button>

            {/* Logo - Center */}
            <Link to="/" className="group z-60 absolute left-1/2 transform -translate-x-1/2">
              <span className={`text-xl font-bold tracking-tight transition-all duration-500 ${styles.textColor}`}>
                SINEMAKU PICTURES
              </span>
            </Link>

            {/* Search Button - Right Side */}
            <button
              onClick={() => setIsSearchOpen(!isSearchOpen)}
              className={`transition-all duration-500 z-60 relative ${styles.iconColor}`}
              aria-label="Toggle search"
            >
              <div className="relative w-6 h-6">
                <Search 
                  className={`h-6 w-6 absolute inset-0 transition-all duration-500 ${
                    isSearchOpen ? 'opacity-0 rotate-180' : 'opacity-100 rotate-0'
                  }`} 
                />
                <X 
                  className={`h-6 w-6 absolute inset-0 transition-all duration-500 ${
                    isSearchOpen ? 'opacity-100 rotate-0' : 'opacity-0 -rotate-180'
                  }`} 
                />
              </div>
            </button>
          </div>
        </div>
      </nav>

      {/* Full-Screen Mega Menu Overlay */}
      <div className={`fixed inset-0 z-40 transition-all duration-700 ease-in-out ${
        isMenuOpen 
          ? 'opacity-100 visible' 
          : 'opacity-0 invisible'
      }`}>
        {/* Background with enhanced glassmorphism */}
        <div className={`absolute inset-0 bg-black/95 backdrop-blur-2xl transition-all duration-700 ${
          isMenuOpen ? 'opacity-100' : 'opacity-0'
        }`} />
        
        {/* Menu Content */}
        <div className={`relative h-full overflow-y-auto transition-all duration-700 delay-200 ${
          isMenuOpen 
            ? 'opacity-100 translate-y-0' 
            : 'opacity-0 translate-y-8'
        }`}>
          <div className="min-h-full flex items-center justify-center py-20">
            <div className="w-full px-6 lg:px-8">
              <div className="grid grid-cols-1 xl:grid-cols-12 gap-16 items-center">
                
                {/* Main Navigation Links */}
                <div className="xl:col-span-8">
                  <div className="space-y-4 md:space-y-6 lg:space-y-8">
                    {navItems.map((item, index) => (
                      <div 
                        key={item.name}
                        className={`transition-all duration-700 ${
                          isMenuOpen 
                            ? 'opacity-100 translate-x-0' 
                            : 'opacity-0 -translate-x-8'
                        }`}
                        style={{ 
                          transitionDelay: isMenuOpen ? `${300 + index * 100}ms` : '0ms' 
                        }}
                      >
                        <Link
                          to={item.path}
                          className={`group block transition-all duration-500 ${
                            location.pathname === item.path
                              ? 'text-white'
                              : 'text-gray-400 hover:text-white'
                          }`}
                        >
                          <div className="flex flex-col lg:flex-row lg:items-baseline lg:space-x-6">
                            <h2 className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl cinematic-title tracking-tight group-hover:translate-x-2 lg:group-hover:translate-x-4 transition-transform duration-500">
                              {item.name}
                            </h2>
                            <span className="text-sm md:text-base lg:text-lg editorial-text opacity-0 group-hover:opacity-100 transition-all duration-500 delay-100 mt-2 lg:mt-0">
                              {item.description}
                            </span>
                          </div>
                          <div className={`h-px bg-gradient-to-r from-white to-transparent mt-2 md:mt-4 transition-all duration-700 ${
                            location.pathname === item.path 
                              ? 'w-16 md:w-32 opacity-100' 
                              : 'w-0 group-hover:w-12 md:group-hover:w-24 opacity-0 group-hover:opacity-50'
                          }`} />
                        </Link>
                      </div>
                    ))}
                  </div>
                </div>

                {/* Contact Information & Logo */}
                <div className="xl:col-span-4 mt-16 xl:mt-0">
                  <div className="space-y-8 lg:space-y-12">
                    {/* Studio Info */}
                    <div className={`transition-all duration-700 delay-500 ${
                      isMenuOpen 
                        ? 'opacity-100 translate-y-0' 
                        : 'opacity-0 translate-y-8'
                    }`}>
                      <div className="space-y-6 lg:space-y-8">
                        <div>
                          <h3 className="text-xl md:text-2xl font-semibold text-white mb-4 md:mb-6 tracking-wide">
                            Get in Touch
                          </h3>
                          <div className="space-y-3 md:space-y-4 text-gray-300">
                            <div className="flex items-center space-x-3 md:space-x-4">
                              <span className="editorial-text text-sm md:text-base">hello@sinemakupictures.com</span>
                            </div>
                            <div className="flex items-center space-x-3 md:space-x-4">
                              <span className="editorial-text text-sm md:text-base">+62 21 1234 5678</span>
                            </div>
                            <div className="flex items-center space-x-3 md:space-x-4">
                              <span className="editorial-text text-sm md:text-base">Jakarta, Indonesia</span>
                            </div>
                          </div>
                        </div>

                        {/* Social Links */}
                        <div>
                          <h3 className="text-base md:text-lg font-medium text-white mb-3 md:mb-4 tracking-wide">
                            Follow Us
                          </h3>
                          <div className="flex flex-wrap gap-4 md:gap-6">
                            {['Instagram', 'Twitter', 'YouTube'].map((social) => (
                              <a 
                                key={social}
                                href="#" 
                                className="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-sm md:text-base"
                              >
                                {social}
                              </a>
                            ))}
                          </div>
                        </div>
                      </div>
                    </div>

                    {/* Large Logo */}
                    <div className={`transition-all duration-700 delay-700 ${
                      isMenuOpen 
                        ? 'opacity-100 scale-100' 
                        : 'opacity-0 scale-95'
                    }`}>
                      <div className="text-gray-600">
                        <div className="text-xl md:text-2xl font-bold tracking-tight">SINEMAKU PICTURES</div>
                        <div className="text-xs md:text-sm editorial-text">EST. 2020</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Decorative Elements */}
        <div className={`absolute bottom-6 md:bottom-8 left-6 md:left-8 transition-all duration-700 delay-600 ${
          isMenuOpen 
            ? 'opacity-100 translate-y-0' 
            : 'opacity-0 translate-y-4'
        }`}>
          <div className="text-gray-600 editorial-text text-xs md:text-sm">
            © 2024 Sinemaku Pictures. All rights reserved.
          </div>
        </div>

        <div className={`hidden lg:block absolute top-1/2 right-6 md:right-8 -translate-y-1/2 transition-all duration-700 delay-800 ${
          isMenuOpen 
            ? 'opacity-100 translate-x-0' 
            : 'opacity-0 translate-x-4'
        }`}>
          <div className="writing-mode-vertical text-gray-600 editorial-text text-xs md:text-sm tracking-widest">
            CREATIVE STORYTELLING
          </div>
        </div>
      </div>

      {/* Search Modal Overlay */}
      <div className={`fixed inset-0 z-40 transition-all duration-500 ease-in-out ${
        isSearchOpen 
          ? 'opacity-100 visible' 
          : 'opacity-0 invisible'
      }`}>
        {/* Background */}
        <div className={`absolute inset-0 bg-black/95 backdrop-blur-2xl transition-all duration-500 ${
          isSearchOpen ? 'opacity-100' : 'opacity-0'
        }`} />
        
        {/* Search Content */}
        <div className={`relative h-full transition-all duration-500 delay-100 ${
          isSearchOpen 
            ? 'opacity-100 translate-y-0' 
            : 'opacity-0 translate-y-4'
        }`}>
          <div className="flex flex-col h-full">
            
            {/* Search Header */}
            <div className="flex-shrink-0 pt-32 pb-8">
              <div className="max-w-4xl mx-auto px-6 lg:px-8">
                <h2 className="text-4xl md:text-5xl cinematic-title text-white mb-8 text-center">
                  Search Sinemaku
                </h2>
                
                {/* Search Input */}
                <form onSubmit={handleSearchSubmit} className="relative">
                  <input
                    type="text"
                    value={searchQuery}
                    onChange={(e) => setSearchQuery(e.target.value)}
                    placeholder="Search films, series, events, articles, and careers..."
                    className="w-full px-8 py-6 text-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-white/40 transition-all duration-300 editorial-text"
                    autoFocus
                  />
                  <button
                    type="submit"
                    className="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-white transition-colors duration-300"
                  >
                    <Search className="h-6 w-6" />
                  </button>
                </form>
              </div>
            </div>

            {/* Search Results */}
            <div className="flex-1 overflow-y-auto">
              <div className="max-w-4xl mx-auto px-6 lg:px-8 pb-20">
                {searchQuery.trim() === '' ? (
                  <div className="text-center text-gray-400 editorial-text">
                    <p className="text-lg">Start typing to search across our content...</p>
                    <div className="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                      <div className="flex items-center justify-center space-x-2 p-4 bg-white/5 backdrop-blur-sm">
                        <Film className="h-4 w-4" />
                        <span>Films & Series</span>
                      </div>
                      <div className="flex items-center justify-center space-x-2 p-4 bg-white/5 backdrop-blur-sm">
                        <Calendar className="h-4 w-4" />
                        <span>Events</span>
                      </div>
                      <div className="flex items-center justify-center space-x-2 p-4 bg-white/5 backdrop-blur-sm">
                        <Users className="h-4 w-4" />
                        <span>Articles</span>
                      </div>
                      <div className="flex items-center justify-center space-x-2 p-4 bg-white/5 backdrop-blur-sm">
                        <Briefcase className="h-4 w-4" />
                        <span>Careers</span>
                      </div>
                    </div>
                  </div>
                ) : searchResults.length === 0 ? (
                  <div className="text-center text-gray-400 editorial-text">
                    <Search className="h-16 w-16 mx-auto mb-4 opacity-50" />
                    <p className="text-lg">No results found for "{searchQuery}"</p>
                    <p className="text-sm mt-2">Try different keywords or browse our content sections.</p>
                  </div>
                ) : (
                  <div className="space-y-4">
                    <p className="text-gray-400 editorial-text text-sm mb-6">
                      Found {searchResults.length} result{searchResults.length !== 1 ? 's' : ''} for "{searchQuery}"
                    </p>
                    
                    {searchResults.map((result, index) => (
                      <button
                        key={`${result.category}-${result.id}-${index}`}
                        onClick={() => navigateToResult(result)}
                        className="w-full text-left p-6 bg-white/5 backdrop-blur-sm hover:bg-white/10 transition-all duration-300 group border border-white/10 hover:border-white/20"
                      >
                        <div className="flex items-start space-x-4">
                          <div className="flex-shrink-0 p-2 bg-white/10 text-gray-400 group-hover:text-white transition-colors duration-300">
                            {getResultIcon(result.category)}
                          </div>
                          <div className="flex-1 min-w-0">
                            <div className="flex items-center space-x-3 mb-2">
                              <h3 className="text-lg font-semibold text-white group-hover:text-gray-200 transition-colors duration-300 truncate">
                                {result.title}
                              </h3>
                              <span className="flex-shrink-0 px-2 py-1 bg-white/10 text-white text-xs font-medium tracking-wide">
                                {result.category}
                              </span>
                            </div>
                            <p className="text-gray-400 editorial-text text-sm leading-relaxed mb-2">
                              {result.description}
                            </p>
                            <div className="flex items-center space-x-4 text-xs text-gray-500">
                              {result.year && <span>{result.year}</span>}
                              {result.date && <span>{result.date}</span>}
                              {result.department && <span>{result.department}</span>}
                              {result.character && <span>Character: {result.character}</span>}
                            </div>
                          </div>
                          <div className="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <ArrowRight className="h-5 w-5 text-gray-400" />
                          </div>
                        </div>
                      </button>
                    ))}
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Navbar;