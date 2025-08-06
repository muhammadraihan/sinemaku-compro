import React, { useEffect, useRef, useState } from 'react';
import { ArrowRight, Play, ShoppingBag, Users, Calendar, MapPin, Briefcase, ChevronDown, ChevronLeft, ChevronRight } from 'lucide-react';
import { Link } from 'react-router-dom';
import OpeningSequence from '../components/OpeningSequence';

const Homepage = () => {
  const heroRef = useRef<HTMLDivElement>(null);
  const videoRef = useRef<HTMLVideoElement>(null);
  const [currentSlide, setCurrentSlide] = useState(0);
  const [showOpening, setShowOpening] = useState(true);
  const [showContent, setShowContent] = useState(false);
  const [videoLoaded, setVideoLoaded] = useState(false);

  const heroSlides = [
    {
      title: 'PERAYAAN MATI RASA',
      year: '2024',
      starring: 'Iqbaal Ramadhan',
      tagline: 'Berfokus pada kisah seorang anak pertama bernama Ian Antono yang bercita-cita menjadi musisi.',
      image: 'https://akcdn.detik.net.id/visual/2025/01/29/film-perayaan-mati-rasa-2025-1_169.png?w=1200',
      link: '/movie/midnight'
    },
    {
      title: 'KETIKA BERHENTI DI SINI',
      year: '2023',
      starring: 'Prilly Latuconsina',
      tagline: 'Berkisah tentang Anindita Semesta yang bertemu dengan Ed dalam pertemuan tak terduga.',
      image: 'https://occ-0-8407-92.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABSYpb03lAZrLnddgej_eO3wCckPgtY5MmDCR121DeRMVx7bZK9YxBJsIhtgUR4SX_54-tAdzK6RQ0o3liqnWTO0c7TTsZTDcZ4jM.jpg?r=e6d',
      link: '/movie/echoes-tomorrow'
    },
    {
      title: 'KU KIRA KAU RUMAH',
      year: '2021',
      starring: 'Jourdy Pranata',
      tagline: 'Sebuah perjalanan emosional tentang pencarian makna rumah dan keluarga.',
      image: 'https://imgsrv2.voi.id/_nvSjjN1kQP13Ow4BgSP8-V_iHBdRggEruAyAOy4Hn0/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy8xMzIwNTYvMjAyMjAyMDcxMzMzLW1haW4uanBn.jpg',
      link: '/movie/silent-waters'
    },
    {
      title: 'BOLEHKAH SEKALI SAJA KUMENANGIS',
      year: '2024',
      starring: 'Pradikta Wicaksono',
      tagline: 'Tari (Prilly Latuconsina) harus berjuang menghadapi situasi yang tidak dikehendaki oleh siapapun. Sifat temperamen sang ayah membuat Tari dan kakaknya trauma hingga sang kakak memutuskan untuk keluar dari rumah yang membuat hatinya terasa sakit.',
      image: 'https://occ-0-8407-114.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABRApQiafj0_-u6nK5_xjajzLUz1lHiTxCVo12rRvGE0FCWIlhVe_fE7yXMLuJROUwwvMnznIrjHbv80RWh4Xt8km4Yg5SIyjKhaO.jpg?r=917',
      link: '/movie/silent-waters'
    }
  ];

  const handleOpeningComplete = () => {
    setShowOpening(false);
    setTimeout(() => {
      setShowContent(true);
    }, 300);
  };

  useEffect(() => {
    if (!showContent) return;

    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % heroSlides.length);
    }, 4000);

    return () => clearInterval(interval);
  }, [heroSlides.length, showContent]);

  useEffect(() => {
    if (videoRef.current && showContent) {
      videoRef.current.load();
    }
  }, [showContent]);

  const handleVideoLoad = () => {
    setVideoLoaded(true);
  };

  const scrollToNextSection = () => {
    const nextSection = document.querySelector('#shop-section');
    if (nextSection) {
      nextSection.scrollIntoView({ 
        behavior: 'smooth',
        block: 'start'
      });
    }
  };

  const jobVacancies = [
    { title: 'Lead Cinematographer', department: 'Production', location: 'Jakarta' },
    { title: 'Sound Designer', department: 'Post-Production', location: 'Remote' },
    { title: 'VFX Supervisor', department: 'Visual Effects', location: 'Jakarta' },
    { title: 'Script Supervisor', department: 'Production', location: 'Bandung' },
    { title: 'Casting Director', department: 'Creative', location: 'Jakarta' },
    { title: 'Marketing Manager', department: 'Marketing', location: 'Jakarta' }
  ];

  // Show opening sequence
  if (showOpening) {
    return <OpeningSequence onComplete={handleOpeningComplete} />;
  }

  return (
    <div className={`bg-black text-white transition-opacity duration-500 ${showContent ? 'opacity-100' : 'opacity-0'}`}>
      {/* NEON-Inspired Hero Section - Full Screen */}
      <section 
        ref={heroRef} 
        className="relative h-screen overflow-hidden"
      >
        
        {/* Video Background Layer */}
        <div className="absolute inset-0 w-full h-full">
          <video
            ref={videoRef}
            className={`w-full h-full object-cover transition-opacity duration-2000 ${
              videoLoaded ? 'opacity-100' : 'opacity-0'
            }`}
            autoPlay
            muted
            loop
            playsInline
            onLoadedData={handleVideoLoad}
            poster="https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop"
          >
            <source 
              src="https://player.vimeo.com/external/434045526.sd.mp4?s=c27eecc69a27dbc4ff2b87d38afc35f1a9e7c02d&profile_id=164&oauth2_token_id=57447761" 
              type="video/mp4" 
            />
            <source 
              src="https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4" 
              type="video/mp4" 
            />
          </video>
        </div>

        {/* Film Background Images with Crossfade */}
        {heroSlides.map((slide, index) => (
          <div
            key={index}
            className={`absolute inset-0 hero-background transition-opacity duration-2000 ${
              index === currentSlide ? 'opacity-60' : 'opacity-0'
            }`}
          >
            <div 
              className="absolute inset-0 w-full h-full bg-cover bg-center"
              style={{ backgroundImage: `url(${slide.image})` }}
            />
          </div>
        ))}

        {/* NEON-Style Bottom Gradient Overlay */}
        <div className="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent" />

        {/* Hero Content - NEON Style Centered */}
        <div className="relative z-10 h-full flex flex-col justify-center items-center text-center px-6 lg:px-8">
          
          {/* Featured Film Content */}
          <div className={`max-w-4xl mx-auto transition-all duration-1500 ${showContent ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'}`}>
            
            {/* Film Title - Large and Bold like NEON */}
            <div className="mb-8">
              <h1 className="text-6xl md:text-7xl lg:text-8xl xl:text-9xl cinematic-title tracking-tight leading-none text-white font-black hero-text-glow mb-4">
                {heroSlides[currentSlide].title}
              </h1>
              
              {/* Film Details */}
              <div className={`transition-all duration-1000 delay-500 ${showContent ? 'animate-text-reveal' : 'opacity-0 translate-y-4'}`}>
                <div className="flex items-center justify-center space-x-6 text-lg md:text-xl text-white/90 mb-6">
                  <span className="font-light tracking-wider">{heroSlides[currentSlide].year}</span>
                  <span className="w-1 h-1 bg-white/60 rounded-full"></span>
                  <span className="font-light tracking-wider">Starring {heroSlides[currentSlide].starring}</span>
                </div>
                
                {/* Tagline */}
                <p className="text-lg md:text-xl lg:text-2xl text-white/80 editorial-text font-light leading-relaxed max-w-3xl mx-auto hero-text-shadow">
                  {heroSlides[currentSlide].tagline}
                </p>
              </div>
            </div>

            {/* NEON-Style Minimal Button */}
            <div className={`transition-all duration-1000 delay-800 ${showContent ? 'animate-scale-in' : 'opacity-0 scale-95'}`}>
              <Link 
                to={heroSlides[currentSlide].link}
                className="inline-flex items-center px-12 py-4 border border-white/60 text-white font-medium tracking-widest hover:bg-white hover:text-black transition-all duration-700 transform hover:scale-105 hover-lift group backdrop-blur-sm text-sm uppercase"
              >
                EXPLORE
                <ArrowRight className="ml-4 h-4 w-4 group-hover:translate-x-2 transition-transform duration-300" />
              </Link>
            </div>
          </div>

          {/* Scroll Down Indicator - NEON Style */}
          <div className={`absolute bottom-12 left-1/2 transform -translate-x-1/2 transition-all duration-1000 delay-1200 ${showContent ? 'animate-fade-in-up' : 'opacity-0 translate-y-4'}`}>
            <button 
              onClick={scrollToNextSection}
              className="flex flex-col items-center space-y-3 text-white/60 hover:text-white transition-colors duration-500 group scroll-indicator"
              aria-label="Scroll to next section"
            >
              <div className="w-px h-12 bg-white/40 group-hover:bg-white/80 transition-colors duration-500" />
              <ChevronDown className="h-5 w-5 animate-bounce group-hover:translate-y-1 transition-transform duration-300" />
            </button>
          </div>

          {/* Film Progress Indicators - Minimal NEON Style */}
          <div className={`absolute bottom-12 right-12 transition-all duration-1000 delay-1000 ${showContent ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'}`}>
            <div className="flex flex-col space-y-3">
              {heroSlides.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentSlide(index)}
                  className={`w-px h-8 transition-all duration-500 ${
                    index === currentSlide 
                      ? 'bg-white scale-110' 
                      : 'bg-white/30 hover:bg-white/60'
                  }`}
                  aria-label={`Go to film ${index + 1}`}
                />
              ))}
            </div>
          </div>

          {/* Film Counter - NEON Style */}
          <div className={`absolute bottom-12 left-12 transition-all duration-1000 delay-1000 ${showContent ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'}`}>
            <div className="text-white/60 editorial-text text-sm tracking-widest">
              {String(currentSlide + 1).padStart(2, '0')} — {String(heroSlides.length).padStart(2, '0')}
            </div>
          </div>
        </div>
      </section>

      {/* Shop Section */}
      <section id="shop-section" className="py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="flex justify-between items-end mb-20">
            <h2 className="text-6xl md:text-7xl cinematic-title">Shop</h2>
            <Link 
              to="/shop" 
              className="inline-flex items-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
            >
              SHOP NOW
              <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
            </Link>
          </div>
          
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {/* Featured Product */}
            <div className="lg:col-span-8 group cursor-pointer image-overlay">
              <div className="relative h-96 lg:h-[600px] overflow-hidden">
                <img 
                  src="https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                  alt="Midnight Soundtrack"
                  className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                <div className="absolute bottom-8 left-8 right-8">
                  <h3 className="text-4xl font-bold mb-2 text-white hero-text-shadow">Midnight Soundtrack</h3>
                  <p className="text-gray-300 editorial-text mb-4 text-lg hero-text-shadow">Limited vinyl edition</p>
                  <span className="text-3xl font-light text-white hero-text-shadow">$34.99</span>
                </div>
              </div>
            </div>
            
            {/* Side Products */}
            <div className="lg:col-span-4 space-y-6">
              <div className="group cursor-pointer image-overlay hover-lift">
                <div className="relative h-44 overflow-hidden">
                  <img 
                    src="https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                    alt="Limited Poster"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <div className="absolute inset-0 bg-black/40" />
                  <div className="absolute bottom-4 left-4">
                    <h4 className="text-lg font-semibold text-white hero-text-shadow">Limited Poster</h4>
                    <span className="text-sm text-gray-300 hero-text-shadow">$19.99</span>
                  </div>
                </div>
              </div>
              
              <div className="group cursor-pointer image-overlay hover-lift">
                <div className="relative h-44 overflow-hidden">
                  <img 
                    src="https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                    alt="Art Book"
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <div className="absolute inset-0 bg-black/40" />
                  <div className="absolute bottom-4 left-4">
                    <h4 className="text-lg font-semibold text-white hero-text-shadow">Art Book</h4>
                    <span className="text-sm text-gray-300 hero-text-shadow">$29.99</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Join Section */}
      <section className="py-32 bg-black text-white relative overflow-hidden container-edge">
        <div className="absolute inset-0 opacity-20">
          <div className="w-full h-full bg-gradient-to-br from-gray-900 to-black" />
        </div>
        <div className="relative z-10 container-content">
          <div className="max-w-4xl mx-auto text-center">
            <h2 className="text-7xl md:text-8xl lg:text-9xl cinematic-title mb-8 leading-none hero-text-glow">
              Join the<br />Movement
            </h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed hero-text-shadow">
              Be part of a community that celebrates bold storytelling and artistic vision. 
              Get exclusive access to premieres, behind-the-scenes content, and limited releases.
            </p>
            <Link 
              to="/membership"
              className="inline-flex items-center px-12 py-6 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift group text-lg btn-cinematic hero-button-glow"
            >
              JOIN NOW — IT'S FREE
              <ArrowRight className="ml-3 h-6 w-6 group-hover:translate-x-2 transition-transform duration-300" />
            </Link>
          </div>
        </div>
      </section>

      {/* Latest Articles */}
      <section className="py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="flex justify-between items-end mb-16">
            <h2 className="text-6xl md:text-7xl cinematic-title">Articles</h2>
            <Link to="/articles" className="text-lg font-medium hover:text-gray-600 transition-colors duration-300 group">
              View All
              <ArrowRight className="inline ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
            </Link>
          </div>
          
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
            {/* Featured Article */}
            <div className="lg:col-span-8 group cursor-pointer">
              <div className="relative overflow-hidden image-overlay">
                <img 
                  src="https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=800&h=500&fit=crop"
                  alt="Featured Article"
                  className="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                <div className="absolute bottom-8 left-8 right-8">
                  <h3 className="text-3xl md:text-4xl font-bold mb-4 text-white hero-text-shadow">
                    The Art of Cinematic Storytelling in Modern Film
                  </h3>
                  <p className="text-gray-300 editorial-text leading-relaxed text-lg hero-text-shadow">
                    Explore how contemporary filmmakers are pushing the boundaries of visual narrative, 
                    combining traditional techniques with cutting-edge technology...
                  </p>
                </div>
              </div>
            </div>
            
            {/* Side Articles */}
            <div className="lg:col-span-4 space-y-8">
              {[
                "Behind the Scenes: Creating Midnight's Atmospheric Score",
                "Interview: Director's Vision for the Future of Cinema",
                "The Evolution of Film Production in the Digital Age"
              ].map((title, index) => (
                <div key={index} className="group cursor-pointer hover-lift">
                  <div className="flex space-x-4">
                    <div className="w-24 h-24 bg-gray-200 flex-shrink-0 overflow-hidden">
                      <div className="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 group-hover:scale-105 transition-transform duration-500" />
                    </div>
                    <div className="flex-1">
                      <h4 className="font-semibold mb-2 group-hover:text-gray-600 transition-colors duration-300 leading-tight">
                        {title}
                      </h4>
                      <p className="text-sm text-gray-500 editorial-text">2 days ago</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Job Vacancies Grid */}
      <section className="py-32 bg-gray-100 text-black container-edge">
        <div className="container-content">
          <div className="text-center mb-20">
            <h2 className="text-6xl md:text-7xl cinematic-title mb-6">Join Our Vision</h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-600 max-w-3xl mx-auto">
              We're looking for passionate creators who share our commitment to bold storytelling.
            </p>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            {jobVacancies.map((job, index) => (
              <div 
                key={index} 
                className="bg-white p-8 shadow-lg hover:shadow-xl transition-all duration-500 group hover-lift"
              >
                <div className="space-y-4">
                  <h3 className="text-xl font-semibold group-hover:text-gray-600 transition-colors duration-300">
                    {job.title}
                  </h3>
                  <p className="text-gray-600 editorial-text">
                    {job.department}
                  </p>
                  <div className="flex items-center text-gray-500 text-sm">
                    <MapPin className="h-4 w-4 mr-2" />
                    {job.location}
                  </div>
                  <button className="w-full px-4 py-3 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-colors duration-300 btn-cinematic">
                    APPLY
                  </button>
                </div>
              </div>
            ))}
          </div>
          
          <div className="text-center">
            <Link 
              to="/jobs"
              className="inline-flex items-center px-12 py-6 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group text-lg btn-cinematic"
            >
              <Briefcase className="mr-3 h-6 w-6" />
              VIEW ALL CAREERS
              <ArrowRight className="ml-3 h-6 w-6 group-hover:translate-x-2 transition-transform duration-300" />
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Homepage;