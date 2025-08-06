import React, { useState } from 'react';
import { Play, Calendar, Star, Filter, Tv } from 'lucide-react';
import { Link } from 'react-router-dom';

const Series = () => {
  const [filter, setFilter] = useState('all');
  const [hoveredSeries, setHoveredSeries] = useState<string | null>(null);

  const upcomingSeries = [
    {
      id: 'urban-chronicles',
      title: 'Urban Chronicles',
      year: '2024',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Crime Drama',
      status: 'In Production',
      description: 'A gritty exploration of city life through the eyes of those who live in its shadows.',
      director: 'Elena Rodriguez',
      episodes: '8 Episodes'
    },
    {
      id: 'digital-souls',
      title: 'Digital Souls',
      year: '2024',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Sci-Fi Thriller',
      status: 'Post-Production',
      description: 'In a world where consciousness can be uploaded, what defines humanity?',
      director: 'Michael Torres',
      episodes: '6 Episodes'
    },
    {
      id: 'midnight-stories',
      title: 'Midnight Stories',
      year: '2025',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=600&h=900&fit=crop',
      genre: 'Anthology',
      status: 'Pre-Production',
      description: 'An anthology series exploring the darker corners of human nature.',
      director: 'Lisa Wang',
      episodes: '10 Episodes'
    }
  ];

  const allSeries = [
    {
      id: 'shadows-within',
      title: 'Shadows Within',
      year: '2024',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Psychological Drama',
      rating: 4.7,
      status: 'Released',
      director: 'Elena Rodriguez',
      episodes: '8 Episodes',
      seasons: 1
    },
    {
      id: 'neon-nights',
      title: 'Neon Nights',
      year: '2023',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Neo-Noir',
      rating: 4.5,
      status: 'Released',
      director: 'David Kim',
      episodes: '6 Episodes',
      seasons: 2
    },
    {
      id: 'broken-mirrors',
      title: 'Broken Mirrors',
      year: '2023',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Mystery',
      rating: 4.6,
      status: 'Released',
      director: 'Sarah Chen',
      episodes: '10 Episodes',
      seasons: 1
    },
    {
      id: 'silent-voices',
      title: 'Silent Voices',
      year: '2022',
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Drama',
      rating: 4.8,
      status: 'Released',
      director: 'Anna Martinez',
      episodes: '12 Episodes',
      seasons: 2
    },
    {
      id: 'time-fragments',
      title: 'Time Fragments',
      year: '2022',
      image: 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Sci-Fi',
      rating: 4.4,
      status: 'Released',
      director: 'James Park',
      episodes: '8 Episodes',
      seasons: 1
    },
    {
      id: 'city-dreams',
      title: 'City Dreams',
      year: '2021',
      image: 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=400&h=600&fit=crop',
      genre: 'Drama',
      rating: 4.9,
      status: 'Released',
      director: 'Robert Chen',
      episodes: '10 Episodes',
      seasons: 3
    }
  ];

  const filteredSeries = filter === 'all' 
    ? allSeries 
    : allSeries.filter(series => series.genre.toLowerCase().includes(filter.toLowerCase()));

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
            {upcomingSeries.map((series, index) => (
              <div 
                key={series.id}
                className={`grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center ${
                  index % 2 === 1 ? 'lg:grid-flow-col-dense' : ''
                } ${index % 2 === 0 ? 'animate-fade-in-left' : 'animate-fade-in-right'}`}
                style={{ animationDelay: `${index * 0.2}s` }}
              >
                <div className={`lg:col-span-7 ${index % 2 === 1 ? 'lg:col-start-6' : ''}`}>
                  <div className="group cursor-pointer image-overlay">
                    <div className="relative aspect-[3/4] overflow-hidden">
                      <img 
                        src={series.image}
                        alt={series.title}
                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 gpu-accelerated"
                      />
                      <div className="absolute top-8 left-8">
                        <span className={`px-4 py-2 text-sm font-medium ${getStatusColor(series.status)}`}>
                          {series.status}
                        </span>
                      </div>
                      <div className="absolute top-8 right-8">
                        <span className="px-4 py-2 bg-black/80 text-white text-sm font-medium backdrop-blur-sm">
                          {series.episodes}
                        </span>
                      </div>
                      <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                      <div className="absolute bottom-8 left-8 right-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div className="flex items-center justify-center">
                          <Tv className="h-12 w-12" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div className={`lg:col-span-5 space-y-6 lg:space-y-8 ${index % 2 === 1 ? 'lg:col-start-1' : ''}`}>
                  <div className="animate-text-reveal" style={{ animationDelay: `${index * 0.2 + 0.3}s` }}>
                    <h3 className="text-4xl md:text-5xl lg:text-6xl cinematic-title mb-4 lg:mb-6 leading-tight">
                      {series.title}
                    </h3>
                    <div className="flex items-center space-x-4 text-gray-600 mb-4 lg:mb-6">
                      <span className="text-lg">{series.year}</span>
                      <span>•</span>
                      <span className="text-lg">{series.genre}</span>
                      <span>•</span>
                      <span className="text-lg">{series.episodes}</span>
                    </div>
                    <p className="text-gray-600 editorial-text leading-relaxed mb-4 lg:mb-6 text-lg">
                      {series.description}
                    </p>
                    <p className="text-gray-500 editorial-text">
                      Created by {series.director}
                    </p>
                  </div>
                  
                  <Link 
                    to={`/series/${series.id}`}
                    className="inline-flex items-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic animate-scale-in"
                    style={{ animationDelay: `${index * 0.2 + 0.6}s` }}
                  >
                    LEARN MORE
                    <Tv className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* All Series - Integrated with White Background */}
      <section className="py-24 lg:py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-16 lg:mb-20 animate-slide-in-top">
            <h2 className="text-6xl md:text-7xl cinematic-title text-black mb-8 lg:mb-0">All Series</h2>
            
            {/* Enhanced Filter Options */}
            <div className="flex items-center space-x-4 animate-fade-in-right animate-delay-300">
              <Filter className="h-5 w-5 text-gray-600" />
              <div className="flex flex-wrap gap-2">
                {['all', 'drama', 'thriller', 'sci-fi', 'mystery'].map((filterOption) => (
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
            {filteredSeries.map((series, index) => (
              <Link 
                key={series.id}
                to={`/series/${series.id}`}
                className="group cursor-pointer hover-lift hover-tilt"
                onMouseEnter={() => setHoveredSeries(series.id)}
                onMouseLeave={() => setHoveredSeries(null)}
              >
                <div className="relative overflow-hidden image-overlay">
                  <img 
                    src={series.image}
                    alt={series.title}
                    className="w-full aspect-[2/3] object-cover group-hover:scale-110 transition-transform duration-500 gpu-accelerated"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                  
                  {/* Enhanced Hover Content */}
                  <div className="absolute inset-0 flex flex-col justify-between p-4 lg:p-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div className="flex justify-between items-start">
                      <span className="text-xs bg-white/20 px-2 py-1 backdrop-blur-sm">
                        {series.genre}
                      </span>
                      {series.rating && (
                        <div className="flex items-center">
                          <Star className="h-4 w-4 text-yellow-400 fill-current mr-1" />
                          <span className="text-sm">{series.rating}</span>
                        </div>
                      )}
                    </div>
                    
                    <div className="text-center">
                      <Tv className="h-8 w-8 mx-auto mb-2 animate-pulse" />
                      <p className="text-xs mb-1">{series.episodes}</p>
                      <p className="text-xs">
                        {series.seasons} Season{series.seasons > 1 ? 's' : ''}
                      </p>
                    </div>
                  </div>
                </div>
                
                <div className="mt-4">
                  <h3 className="font-semibold text-black group-hover:text-gray-600 transition-colors text-sm mb-1 leading-tight">
                    {series.title}
                  </h3>
                  <p className="text-gray-600 text-xs">{series.year}</p>
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
            <Tv className="h-20 w-20 text-gray-400 mx-auto mb-8 animate-float-in" />
            <h2 className="text-6xl md:text-7xl cinematic-title mb-8 animate-text-reveal animate-delay-200">
              Binge-Worthy<br />Content
            </h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-600 mb-12 leading-relaxed animate-text-reveal animate-delay-400">
              Subscribe to get notified when new episodes drop and gain access to 
              exclusive behind-the-scenes content from your favorite series.
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

export default Series;