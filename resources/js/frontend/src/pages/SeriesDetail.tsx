import React, { useEffect, useRef } from 'react';
import { useParams, Link } from 'react-router-dom';
import { Play, Star, Calendar, Clock, Users, ArrowRight, Tv } from 'lucide-react';

const SeriesDetail = () => {
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
  const seriesData = {
    'shadows-within': {
      title: 'Shadows Within',
      year: '2024',
      genre: 'Psychological Drama',
      duration: '45 min per episode',
      rating: 4.7,
      director: 'Elena Rodriguez',
      cast: ['Sarah Chen', 'Michael Torres', 'Lisa Wang', 'David Kim'],
      synopsis: 'A psychological drama that explores the hidden depths of human nature through the interconnected lives of residents in a seemingly perfect suburban community. As secrets unravel, the line between reality and perception becomes increasingly blurred.',
      longDescription: 'Shadows Within delves into the complex psychology of its characters, revealing how past traumas and hidden desires shape present actions. Each episode peels back another layer of the community\'s facade, exposing the darkness that lurks beneath the surface of everyday life. The series combines masterful storytelling with stunning cinematography to create an immersive experience that challenges viewers to question their own perceptions of truth and morality.',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1200&h=1800&fit=crop',
      trailer: 'https://example.com/trailer',
      releaseDate: 'January 15, 2024',
      seasons: 1,
      episodes: 8,
      status: 'Released',
      awards: ['Best Drama Series - Jakarta Television Awards', 'Outstanding Cinematography - Asian Series Festival']
    }
  };

  const series = seriesData[id as keyof typeof seriesData] || seriesData['shadows-within'];

  const recommendations = [
    {
      id: 'neon-nights',
      title: 'Neon Nights',
      year: '2023',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.5,
      genre: 'Neo-Noir',
      seasons: 2
    },
    {
      id: 'broken-mirrors',
      title: 'Broken Mirrors',
      year: '2023',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.6,
      genre: 'Mystery',
      seasons: 1
    },
    {
      id: 'silent-voices',
      title: 'Silent Voices',
      year: '2022',
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=300&h=450&fit=crop',
      rating: 4.8,
      genre: 'Drama',
      seasons: 2
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
            backgroundImage: `url(${series.image})`,
          }}
        />
        <div className="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-black/40" />
        
        <div className="relative z-10 h-full flex items-center">
          <div className="max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
              <div className="lg:col-span-7 space-y-8 animate-fade-in-left">
                <div className="text-reveal animate">
                  <span className="block text-8xl md:text-9xl cinematic-title tracking-tight">
                    {series.title}
                  </span>
                </div>
                
                <div className="space-y-6 animate-fade-in-up" style={{ animationDelay: '0.3s' }}>
                  <div className="flex items-center space-x-6 text-lg text-gray-300">
                    <span>{series.year}</span>
                    <span>•</span>
                    <span>{series.genre}</span>
                    <span>•</span>
                    <span>{series.seasons} Season{series.seasons > 1 ? 's' : ''}</span>
                    <span>•</span>
                    <span>{series.episodes} Episodes</span>
                  </div>
                  
                  <div className="flex items-center space-x-4">
                    <div className="flex items-center">
                      {[...Array(5)].map((_, i) => (
                        <Star 
                          key={i} 
                          className={`h-6 w-6 ${i < Math.floor(series.rating) ? 'text-yellow-400 fill-current' : 'text-gray-400'}`} 
                        />
                      ))}
                    </div>
                    <span className="text-xl text-gray-300">{series.rating}/5</span>
                  </div>
                  
                  <p className="text-xl text-gray-300 editorial-text leading-relaxed max-w-2xl">
                    {series.synopsis}
                  </p>
                </div>
                
                <div className="flex flex-col sm:flex-row gap-6" style={{ animationDelay: '0.6s' }}>
                  <button className="flex items-center px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift group">
                    <Play className="mr-3 h-5 w-5" />
                    WATCH TRAILER
                  </button>
                  <button className="flex items-center px-8 py-4 border border-white text-white font-semibold tracking-wide hover:bg-white hover:text-black transition-all duration-500">
                    <Tv className="mr-3 h-5 w-5" />
                    ADD TO WATCHLIST
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Series Details */}
      <section className="py-32 bg-white text-black">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            {/* Main Content */}
            <div className="lg:col-span-8">
              <div className="space-y-12">
                <div>
                  <h2 className="text-5xl cinematic-title mb-8">About the Series</h2>
                  <p className="text-gray-600 editorial-text leading-relaxed text-lg mb-8">
                    {series.longDescription}
                  </p>
                </div>
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Series Details</h3>
                    <div className="space-y-4">
                      <div className="flex items-center">
                        <Calendar className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Release Date: {series.releaseDate}</span>
                      </div>
                      <div className="flex items-center">
                        <Clock className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Duration: {series.duration}</span>
                      </div>
                      <div className="flex items-center">
                        <Users className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">Created by: {series.director}</span>
                      </div>
                      <div className="flex items-center">
                        <Tv className="h-5 w-5 text-gray-400 mr-4" />
                        <span className="text-gray-600 editorial-text">
                          {series.seasons} Season{series.seasons > 1 ? 's' : ''}, {series.episodes} Episodes
                        </span>
                      </div>
                    </div>
                  </div>
                  
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Main Cast</h3>
                    <div className="space-y-3">
                      {series.cast.map((actor, index) => (
                        <div key={index} className="text-gray-600 editorial-text text-lg">
                          {actor}
                        </div>
                      ))}
                    </div>
                  </div>
                </div>

                {series.awards && (
                  <div>
                    <h3 className="text-2xl font-semibold mb-6">Awards & Recognition</h3>
                    <div className="space-y-3">
                      {series.awards.map((award, index) => (
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
                      to={`/series/${rec.id}`}
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
                        <p className="text-gray-600 text-sm mb-2">
                          {rec.year} • {rec.genre}
                        </p>
                        <p className="text-gray-600 text-sm mb-2">
                          {rec.seasons} Season{rec.seasons > 1 ? 's' : ''}
                        </p>
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
                    to="/series"
                    className="block w-full text-center px-6 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group"
                  >
                    VIEW ALL SERIES
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

export default SeriesDetail;