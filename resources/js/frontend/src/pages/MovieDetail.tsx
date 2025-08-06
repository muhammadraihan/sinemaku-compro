import React, { useEffect, useRef } from 'react';
import { useParams, Link } from 'react-router-dom';
import { Play, Star, Calendar, Clock, Users, ArrowRight } from 'lucide-react';

const MovieDetail = () => {
  const { id } = useParams();
  const heroRef = useRef<HTMLDivElement>(null);
  const parallaxRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleScroll = () => {
      if (parallaxRef.current) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.3;
        parallaxRef.current.style.transform = `translateY(${rate}px)`;
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Mock data - in a real app, this would come from an API
  const movieData = {
    'midnight': {
      title: 'Midnight',
      year: '2024',
      genre: 'Psychological Thriller',
      duration: '118 min',
      rating: 4.8,
      director: 'Elena Rodriguez',
      cast: ['Sarah Chen', 'Michael Torres', 'Lisa Wang', 'David Kim'],
      synopsis: 'In the depths of a sleepless city, a detective unravels a mystery that blurs the line between reality and nightmare. As midnight approaches, time becomes the enemy, and every shadow holds a secret that could change everything. A psychological thriller that questions the nature of perception and truth.',
      longDescription: 'Midnight explores the fragile boundary between consciousness and dreams through the eyes of Detective Sarah Chen, who finds herself trapped in a case that defies logic. As she delves deeper into the investigation, the city around her begins to shift and change, reflecting her own psychological state. The film combines practical effects with innovative cinematography to create a truly immersive experience that challenges audiences to question what they see.',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1200&h=1800&fit=crop',
      trailer: 'https://example.com/trailer',
      releaseDate: 'March 15, 2024',
      awards: ['Best Cinematography - Jakarta Film Festival', 'Audience Choice Award - Asian Cinema Week']
    }
  };

  const movie = movieData[id as keyof typeof movieData] || movieData.midnight;

  const recommendations = [
    {
      id: 'silent-waters',
      title: 'Silent Waters',
      year: '2023',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.6,
      genre: 'Drama'
    },
    {
      id: 'neon-dreams',
      title: 'Neon Dreams',
      year: '2023',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.4,
      genre: 'Sci-Fi'
    },
    {
      id: 'forgotten-melody',
      title: 'Forgotten Melody',
      year: '2022',
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.7,
      genre: 'Romance'
    }
  ];

  return (
    <div className="bg-black text-white">
      {/* Hero Section */}
      <section ref={heroRef} className="relative h-screen overflow-hidden">
        <div 
          ref={parallaxRef}
          className="absolute inset-0 w-full h-120 bg-cover bg-center parallax"
          style={{
            backgroundImage: `url(${movie.image})`,
          }}
        />
        <div className="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-black/40" />
        
        <div className="relative z-10 h-full flex items-center">
          <div className="max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
              <div className="lg:col-span-7 space-y-8 animate-fade-in-left">
                <div className="text-reveal animate">
                  <span className="block text-8xl md:text-9xl cinematic-title tracking-tight">
                    {movie.title}
                  </span>
                </div>
                
                <div className="space-y-6 animate-fade-in-up" style={{ animationDelay: '0.3s' }}>
                  <div className="flex items-center space-x-6 text-lg text-gray-300">
                    <span>{movie.year}</span>
                    <span>•</span>
                    <span>{movie.genre}</span>
                    <span>•</span>
                    <span>{movie.duration}</span>
                  </div>
                  
                  <div className="flex items-center space-x-4">
                    <div className="flex items-center">
                      {[...Array(5)].map((_, i) => (
                        <Star 
                          key={i} 
                          className={`h-6 w-6 ${i < Math.floor(movie.rating) ? 'text-yellow-400 fill-current' : 'text-gray-400'}`} 
                        />
                      ))}
                    </div>
                    <span className="text-xl text-gray-300">{movie.rating}/5</span>
                  </div>
                  
                  <p className="text-xl text-gray-300 editorial-text leading-relaxed max-w-2xl">
                    {movie.synopsis}
                  </p>
                </div>
                
                <div className="flex flex-col sm:flex-row gap-6" style={{ animationDelay: '0.6s' }}>
                  <button className="flex items-center px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift group">
                    <Play className="mr-3 h-5 w-5" />
                    WATCH TRAILER
                  </button>
                  <button className="flex items-center px-8 py-4 border border-white text-white font-semibold tracking-wide hover:bg-white hover:text-black transition-all duration-500">
                    ADD TO WATCHLIST
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Movie Details */}
      <section className="py-32 bg-white text-black">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            {/* Main Content */}
            <div className="lg:col-span-8">
              <div className="space-y-12">
                <div>
                  <h2 className="text-5xl cinematic-title mb-8">About the Film</h2>
                  <p className="text-gray-600 editorial-text leading-relaxed text-lg mb-8">
                    {movie.longDescription}
                  </p>
                </div>
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Film Details</h3>
                    <div className="space-y-4">
                      <div className="flex items-center">
                        <Calendar className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Release Date: {movie.releaseDate}</span>
                      </div>
                      <div className="flex items-center">
                        <Clock className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Duration: {movie.duration}</span>
                      </div>
                      <div className="flex items-center">
                        <Users className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Director: {movie.director}</span>
                      </div>
                    </div>
                  </div>
                  
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Cast</h3>
                    <div className="space-y-3">
                      {movie.cast.map((actor, index) => (
                        <div key={index} className="text-gray-600 editorial-text text-lg">
                          {actor}
                        </div>
                      ))}
                    </div>
                  </div>
                </div>

                {movie.awards && (
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Awards & Recognition</h3>
                    <div className="space-y-3">
                      {movie.awards.map((award, index) => (
                        <div key={index} className="flex items-center">
                          <Star className="h-5 w-5 text-yellow-400 mr-3" />
                          <span className="text-gray-600 editorial-text">{award}</span>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            </div>

            {/* Recommendations Sidebar */}
            <div className="lg:col-span-4">
              <div className="bg-gray-50 p-8 sticky top-24">
                <h3 className="text-2xl font-semibold mb-8">You Might Also Like</h3>
                <div className="space-y-8">
                  {recommendations.map((rec, index) => (
                    <Link 
                      key={rec.id}
                      to={`/movie/${rec.id}`}
                      className="flex space-x-4 group cursor-pointer hover-lift"
                    >
                      <div className="relative overflow-hidden flex-shrink-0 image-overlay">
                        <img 
                          src={rec.image}
                          alt={rec.title}
                          className="w-20 h-28 object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                      </div>
                      <div className="flex-1">
                        <h4 className="font-semibold text-lg mb-2 group-hover:text-gray-600 transition-colors duration-300">
                          {rec.title}
                        </h4>
                        <p className="text-gray-600 text-sm mb-2">{rec.year} • {rec.genre}</p>
                        <div className="flex items-center">
                          <Star className="h-4 w-4 text-yellow-400 fill-current mr-1" />
                          <span className="text-sm text-gray-600">{rec.rating}</span>
                        </div>
                      </div>
                    </Link>
                  ))}
                </div>
                
                <div className="mt-12 pt-8 border-t border-gray-200">
                  <Link 
                    to="/movies"
                    className="block w-full text-center px-6 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group"
                  >
                    VIEW ALL FILMS
                    <ArrowRight className="inline ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default MovieDetail;