import React from 'react';
import { Calendar, Clock, MapPin, Users, ArrowRight } from 'lucide-react';
import { Link } from 'react-router-dom';

const Events = () => {
  const events = [
    {
      id: 'midnight-premiere',
      title: "Midnight Premiere",
      description: "Join us for the exclusive premiere featuring an intimate Q&A with cast and crew, followed by a reception celebrating the film's artistic journey.",
      date: "March 15, 2024",
      time: "7:00 PM",
      location: "Grand Cinema Jakarta",
      image: "https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Premiere",
      featured: true,
      ticketPlatform: "Loket.com",
      ticketUrl: "https://loket.com/event/midnight-premiere"
    },
    {
      id: 'cinematography-masterclass',
      title: "Cinematography Masterclass",
      description: "Learn advanced cinematography techniques from our award-winning directors and explore the visual language of modern filmmaking.",
      date: "March 22, 2024",
      time: "2:00 PM",
      location: "CinemaStudio Headquarters",
      image: "https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Workshop",
      ticketPlatform: "Eventbrite",
      ticketUrl: "https://eventbrite.com/cinematography-masterclass"
    },
    {
      id: 'industry-networking-night',
      title: "Industry Networking Night",
      description: "Connect with filmmakers, actors, and industry professionals in an evening dedicated to collaboration and creative exchange.",
      date: "April 5, 2024",
      time: "6:30 PM",
      location: "Rooftop Lounge, Jakarta",
      image: "https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Networking",
      ticketPlatform: "Loket.com",
      ticketUrl: "https://loket.com/event/networking-night"
    },
    {
      id: 'behind-scenes-exhibition',
      title: "Behind the Scenes Exhibition",
      description: "Explore exclusive behind-the-scenes content, original props, costumes, and concept art from our recent productions.",
      date: "April 12, 2024",
      time: "10:00 AM",
      location: "Jakarta Art Gallery",
      image: "https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Exhibition",
      ticketPlatform: "Tix.id",
      ticketUrl: "https://tix.id/behind-scenes-exhibition"
    },
    {
      id: 'script-reading-session',
      title: "Script Reading Session",
      description: "Join our writers and actors for live readings of upcoming scripts and provide feedback on new creative projects.",
      date: "April 18, 2024",
      time: "3:00 PM",
      location: "CinemaStudio Reading Room",
      image: "https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Reading",
      ticketPlatform: "Eventbrite",
      ticketUrl: "https://eventbrite.com/script-reading"
    },
    {
      id: 'film-festival-screening',
      title: "Film Festival Screening",
      description: "Special screening of our award-winning short films at the Jakarta International Film Festival with director commentary.",
      date: "May 3, 2024",
      time: "8:00 PM",
      location: "Festival Cinema Complex",
      image: "https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop",
      category: "Festival",
      ticketPlatform: "Loket.com",
      ticketUrl: "https://loket.com/event/festival-screening"
    }
  ];

  const getCategoryColor = (category: string) => {
    const colors = {
      'Premiere': 'bg-red-500 text-white',
      'Workshop': 'bg-blue-500 text-white',
      'Networking': 'bg-green-500 text-white',
      'Exhibition': 'bg-purple-500 text-white',
      'Reading': 'bg-yellow-500 text-black',
      'Festival': 'bg-indigo-500 text-white'
    };
    return colors[category as keyof typeof colors] || 'bg-gray-500 text-white';
  };

  const featuredEvent = events.find(event => event.featured);
  const regularEvents = events.filter(event => !event.featured);

  return (
    <div className="bg-black text-white">
      {/* Featured Event */}
      {featuredEvent && (
        <section className="inner-page bg-white text-black">
          <div className="max-w-7xl mx-auto px-6 lg:px-8">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
              <div className="lg:col-span-7">
                <div className="relative group image-overlay">
                  <img 
                    src={featuredEvent.image}
                    alt={featuredEvent.title}
                    className="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-700"
                  />
                  <div className="absolute top-8 left-8">
                    <span className={`px-4 py-2 text-sm font-medium tracking-wide ${getCategoryColor(featuredEvent.category)}`}>
                      {featuredEvent.category}
                    </span>
                  </div>
                  <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                </div>
              </div>
              
              <div className="lg:col-span-5 space-y-8">
                <div>
                  <span className="inline-block px-4 py-2 bg-black text-white text-sm font-medium tracking-wide mb-6">
                    Featured Event
                  </span>
                  <h2 className="text-5xl cinematic-title mb-6">
                    {featuredEvent.title}
                  </h2>
                  <p className="text-gray-600 editorial-text leading-relaxed mb-8 text-lg">
                    {featuredEvent.description}
                  </p>
                </div>
                
                <div className="space-y-4">
                  <div className="flex items-center text-gray-700">
                    <Calendar className="h-5 w-5 mr-3" />
                    <span className="font-medium">{featuredEvent.date}</span>
                  </div>
                  <div className="flex items-center text-gray-700">
                    <Clock className="h-5 w-5 mr-3" />
                    <span className="font-medium">{featuredEvent.time}</span>
                  </div>
                  <div className="flex items-center text-gray-700">
                    <MapPin className="h-5 w-5 mr-3" />
                    <span className="font-medium">{featuredEvent.location}</span>
                  </div>
                </div>
                
                <Link
                  to={`/event/${featuredEvent.id}`}
                  className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group"
                >
                  LIHAT DETAIL ACARA
                  <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                </Link>
              </div>
            </div>
          </div>
        </section>
      )}

      {/* Events Grid */}
      <section className="py-32 bg-gray-50 text-black">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <h2 className="text-6xl cinematic-title mb-20">Upcoming Events</h2>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {regularEvents.map((event, index) => (
              <div 
                key={event.id} 
                className="bg-white shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-500 hover-lift"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="relative overflow-hidden image-overlay">
                  <img 
                    src={event.image}
                    alt={event.title}
                    className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <div className="absolute top-4 left-4">
                    <span className={`px-3 py-1 text-xs font-medium tracking-wide ${getCategoryColor(event.category)}`}>
                      {event.category}
                    </span>
                  </div>
                  <div className="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                </div>
                
                <div className="p-6">
                  <h3 className="text-xl font-semibold mb-3 group-hover:text-gray-600 transition-colors duration-300">
                    {event.title}
                  </h3>
                  
                  <p className="text-gray-600 editorial-text mb-6 leading-relaxed">
                    {event.description}
                  </p>
                  
                  <div className="space-y-3 mb-6">
                    <div className="flex items-center text-gray-500">
                      <Calendar className="h-4 w-4 mr-2" />
                      <span className="text-sm">{event.date}</span>
                    </div>
                    <div className="flex items-center text-gray-500">
                      <Clock className="h-4 w-4 mr-2" />
                      <span className="text-sm">{event.time}</span>
                    </div>
                    <div className="flex items-center text-gray-500">
                      <MapPin className="h-4 w-4 mr-2" />
                      <span className="text-sm">{event.location}</span>
                    </div>
                  </div>
                  
                  <Link
                    to={`/event/${event.id}`}
                    className="w-full px-4 py-3 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-colors duration-300 text-center block"
                  >
                    LIHAT DETAIL ACARA
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter Signup */}
      <section className="py-32 bg-black">
        <div className="max-w-4xl mx-auto text-center px-6 lg:px-8">
          <Users className="h-20 w-20 text-gray-400 mx-auto mb-8" />
          <h2 className="text-6xl cinematic-title mb-8 text-white">
            Never Miss<br />an Event
          </h2>
          <p className="text-xl editorial-text text-gray-300 mb-12 leading-relaxed">
            Subscribe to our newsletter for exclusive event invitations, 
            early access tickets, and behind-the-scenes content.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input 
              type="email" 
              placeholder="Enter your email"
              className="flex-1 px-6 py-4 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-300 editorial-text"
            />
            <button className="px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-colors duration-300">
              SUBSCRIBE
            </button>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Events;