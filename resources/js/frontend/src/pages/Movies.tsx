import React, { useState } from 'react';
import { Play, Calendar, Star, Filter } from 'lucide-react';
import { Link } from 'react-router-dom';

const Movies = () => {
  const [filter, setFilter] = useState('all');
  const [hoveredMovie, setHoveredMovie] = useState<string | null>(null);

  const upcomingMovies = [
    {
      id: 'echoes-tomorrow',
      title: 'Echoes of Tomorrow',
      year: '2024',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Sci-Fi Drama',
      status: 'In Production',
      description: 'A haunting exploration of memory and time in a world where the past refuses to stay buried.',
      director: 'Elena Rodriguez'
    },
    {
      id: 'midnight-sequel',
      title: 'Midnight: Awakening',
      year: '2024',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Thriller',
      status: 'Post-Production',
      description: 'The nightmare continues where reality ends in this highly anticipated sequel.',
      director: 'Michael Torres'
    },
    {
      id: 'last-symphony',
      title: 'The Last Symphony',
      year: '2025',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Musical Drama',
      status: 'Pre-Production',
      description: 'Music as the language of the soul in this emotional journey through sound and silence.',
      director: 'Lisa Wang'
    }
  ];

  const allMovies = [
    {
      id: 'midnight',
      title: 'Midnight',
      year: '2024',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Thriller',
      rating: 4.8,
      status: 'Released',
      director: 'Elena Rodriguez'
    },
    {
      id: 'silent-waters',
      title: 'Silent Waters',
      year: '2023',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Drama',
      rating: 4.6,
      status: 'Released',
      director: 'David Kim'
    },
    {
      id: 'neon-dreams',
      title: 'Neon Dreams',
      year: '2023',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Sci-Fi',
      rating: 4.4,
      status: 'Released',
      director: 'Sarah Chen'
    },
    {
      id: 'forgotten-melody',
      title: 'Forgotten Melody',
      year: '2022',
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Romance',
      rating: 4.7,
      status: 'Released',
      director: 'Anna Martinez'
    },
    {
      id: 'shadows-past',
      title: 'Shadows of the Past',
      year: '2022',
      image: 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Mystery',
      rating: 4.5,
      status: 'Released',
      director: 'James Park'
    },
    {
      id: 'golden-hour',
      title: 'Golden Hour',
      year: '2021',
      image: 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Drama',
      rating: 4.9,
      status: 'Released',
      director: 'Robert Chen'
    }
  ];

  const filteredMovies = filter === 'all' 
    ? allMovies 
    : allMovies.filter(movie => movie.genre.toLowerCase().includes(filter.toLowerCase()));

  const getStatusColor = (status: string) => {
    const colors = {
      'Released': 'bg-green-500 text-white',
      'In Production': 'bg-blue-500 text-white',
      'Post-Production': 'bg-yellow-500 text-black',
      'Pre-Production': 'bg-purple-500 text-white'
    };
    return colors[status as keyof typeof colors] || 'bg-gray-500 text-white';
  };

  return (
    <div className="bg-black text-white">
      {/* Coming Soon - Edge to Edge Layout with proper spacing */}
      <section className="inner-page bg-white text-black container-edge">
        <div className="container-content py-16">
          <h2 className="text-6xl md:text-7xl cinematic-title mb-20 animate-slide-in-top">Coming Soon</h2>
          
          <div className="space-y-24 lg:space-y-32">
            {upcomingMovies.map((movie, index) => (
              <div 
                key={movie.id}
                className={`grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center ${
                  index % 2 === 1 ? 'lg:grid-flow-col-dense' : ''
                } ${index % 2 === 0 ? 'animate-fade-in-left' : 'animate-fade-in-right'}`}
                style={{ animationDelay: `${index * 0.2}s` }}
              >
                <div className={`lg:col-span-7 ${index % 2 === 1 ? 'lg:col-start-6' : ''}`}>
                  <div className="group cursor-pointer image-overlay">
                    <div className="relative aspect-[3/4] overflow-hidden">
                      <img 
                        src={movie.image}
                        alt={movie.title}
                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 gpu-accelerated"
                      />
                      <div className="absolute top-8 left-8">
                        <span className={`px-4 py-2 text-sm font-medium ${getStatusColor(movie.status)}`}>
                          {movie.status}
                        </span>
                      </div>
                      <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                      <div className="absolute bottom-8 left-8 right-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div className="flex items-center justify-center">
                          <Play className="h-12 w-12" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div className={`lg:col-span-5 space-y-6 lg:space-y-8 ${index % 2 === 1 ? 'lg:col-start-1' : ''}`}>
                  <div className="animate-text-reveal" style={{ animationDelay: `${index * 0.2 + 0.3}s` }}>
                    <h3 className="text-4xl md:text-5xl lg:text-6xl cinematic-title mb-4 lg:mb-6 leading-tight">
                      {movie.title}
                    </h3>
                    <div className="flex items-center space-x-4 text-gray-600 mb-4 lg:mb-6">
                      <span className="text-lg">{movie.year}</span>
                      <span>•</span>
                      <span className="text-lg">{movie.genre}</span>
                    </div>
                    <p className="text-gray-600 editorial-text leading-relaxed mb-4 lg:mb-6 text-lg">
                      {movie.description}
                    </p>
                    <p className="text-gray-500 editorial-text">
                      Directed by {movie.director}
                    </p>
                  </div>
                  
                  <Link 
                    to={`/movie/${movie.id}`}
                    className="inline-flex items-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic animate-scale-in"
                    style={{ animationDelay: `${index * 0.2 + 0.6}s` }}
                  >
                    LEARN MORE
                    <Play className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* All Films - Integrated with White Background */}
      <section className="py-24 lg:py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-16 lg:mb-20 animate-slide-in-top">
            <h2 className="text-6xl md:text-7xl cinematic-title text-black mb-8 lg:mb-0">All Films</h2>
            
            {/* Enhanced Filter Options */}
            <div className="flex items-center space-x-4 animate-fade-in-right animate-delay-300">
              <Filter className="h-5 w-5 text-gray-600" />
              <div className="flex flex-wrap gap-2">
                {['all', 'drama', 'thriller', 'sci-fi', 'romance'].map((filterOption) => (
                  <button
                    key={filterOption}
                    onClick={() => setFilter(filterOption)}
                    className={`px-4 py-2 text-sm font-medium tracking-wide transition-all duration-300 hover:scale-105 ${
                      filter === filterOption
                        ? 'bg-black text-white'
                        : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                    }`}
                  >
                    {filterOption.charAt(0).toUpperCase() + filterOption.slice(1)}
                  </button>
                ))}
              </div>
            </div>
          </div>
          
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8 grid-stagger">
            {filteredMovies.map((movie, index) => (
              <Link 
                key={movie.id}
                to={`/movie/${movie.id}`}
                className="group cursor-pointer hover-lift hover-tilt"
                onMouseEnter={() => setHoveredMovie(movie.id)}
                onMouseLeave={() => setHoveredMovie(null)}
              >
                <div className="relative overflow-hidden image-overlay">
                  <img 
                    src={movie.image}
                    alt={movie.title}
                    className="w-full aspect-[2/3] object-cover group-hover:scale-110 transition-transform duration-500 gpu-accelerated"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                  
                  {/* Enhanced Hover Content */}
                  <div className="absolute inset-0 flex flex-col justify-between p-4 lg:p-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div className="flex justify-between items-start">
                      <span className="text-xs bg-white/20 px-2 py-1 backdrop-blur-sm">
                        {movie.genre}
                      </span>
                      {movie.rating && (
                        <div className="flex items-center">
                          <Star className="h-4 w-4 text-yellow-400 fill-current mr-1" />
                          <span className="text-sm">{movie.rating}</span>
                        </div>
                      )}
                    </div>
                    
                    <div className="text-center">
                      <Play className="h-8 w-8 mx-auto mb-2 animate-pulse" />
                      <p className="text-xs">Directed by {movie.director}</p>
                    </div>
                  </div>
                </div>
                
                <div className="mt-4">
                  <h3 className="font-semibold text-black group-hover:text-gray-600 transition-colors text-sm mb-1 leading-tight">
                    {movie.title}
                  </h3>
                  <p className="text-gray-600 text-xs">{movie.year}</p>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Call to Action - Enhanced */}
      <section className="py-24 lg:py-32 bg-gray-50 text-black container-edge">
        <div className="container-content">
          <div className="max-w-4xl mx-auto text-center animate-zoom-in">
            <Calendar className="h-20 w-20 text-gray-400 mx-auto mb-8 animate-float-in" />
            <h2 className="text-6xl md:text-7xl cinematic-title mb-8 animate-text-reveal animate-delay-200">
              Stay in the Loop
            </h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-600 mb-12 leading-relaxed animate-text-reveal animate-delay-400">
              Be the first to know about our latest releases, exclusive screenings, 
              and behind-the-scenes content. Join our community of film enthusiasts.
            </p>
            <button className="px-12 py-6 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift text-lg btn-cinematic animate-pulse-glow animate-delay-600">
              SUBSCRIBE TO UPDATES
            </button>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Movies;