import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { 
  Calendar, 
  Clock, 
  MapPin, 
  ArrowLeft, 
  Users, 
  Star,
  ExternalLink,
  Ticket,
  Share2,
  Heart
} from 'lucide-react';

const EventDetail = () => {
  const { id } = useParams();
  const [isWishlisted, setIsWishlisted] = useState(false);
  const [showFloatingButton, setShowFloatingButton] = useState(false);

  // Mock event data - in a real app, this would come from an API
  const eventData = {
    'midnight-premiere': {
      title: 'Midnight Premiere',
      date: 'March 15, 2024',
      time: '7:00 PM',
      location: 'Grand Cinema Jakarta',
      category: 'Premiere',
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop',
      ticketPlatform: 'Loket.com',
      ticketUrl: 'https://loket.com/event/midnight-premiere',
      price: 'Rp 150.000',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">Join us for an unforgettable evening as we premiere our latest psychological thriller "Midnight" in an exclusive screening that promises to be as captivating as the film itself.</p>
          
          <p>This special premiere event will feature an intimate Q&A session with the cast and crew, offering unique insights into the creative process behind this haunting masterpiece. Following the screening, guests are invited to a sophisticated reception where you can mingle with fellow film enthusiasts and industry professionals.</p>
          
          <blockquote>
            "Midnight represents our boldest creative vision yet - a film that challenges audiences to question the nature of reality itself."
            <cite>— Elena Rodriguez, Director</cite>
          </blockquote>
          
          <p>The evening will conclude with an exclusive behind-the-scenes presentation, featuring never-before-seen footage from the production and commentary from our cinematographer and sound designer.</p>
        </div>
      `,
      schedule: [
        { time: '6:30 PM', activity: 'Red Carpet & Registration' },
        { time: '7:00 PM', activity: 'Welcome Reception' },
        { time: '7:30 PM', activity: 'Film Screening - "Midnight"' },
        { time: '9:15 PM', activity: 'Q&A with Cast & Crew' },
        { time: '10:00 PM', activity: 'Networking Reception' },
        { time: '11:00 PM', activity: 'Event Conclusion' }
      ],
      speakers: [
        {
          name: 'Elena Rodriguez',
          role: 'Director',
          image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop',
          bio: 'Award-winning director known for psychological thrillers'
        },
        {
          name: 'Sarah Chen',
          role: 'Lead Actress',
          image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop',
          bio: 'Acclaimed actress with multiple film festival awards'
        },
        {
          name: 'Michael Torres',
          role: 'Cinematographer',
          image: 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop',
          bio: 'Visionary cinematographer specializing in atmospheric storytelling'
        }
      ],
      highlights: [
        'Exclusive first screening of "Midnight"',
        'Meet & greet with cast and crew',
        'Behind-the-scenes presentation',
        'Complimentary welcome drink',
        'Limited edition poster for attendees'
      ]
    },
    'cinematography-masterclass': {
      title: 'Cinematography Masterclass',
      date: 'March 22, 2024',
      time: '2:00 PM',
      location: 'CinemaStudio Headquarters',
      category: 'Workshop',
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop',
      ticketPlatform: 'Eventbrite',
      ticketUrl: 'https://eventbrite.com/cinematography-masterclass',
      price: 'Rp 250.000',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">Dive deep into the art and craft of cinematography with our comprehensive masterclass led by industry professionals who have shaped the visual language of modern cinema.</p>
          
          <p>This intensive workshop covers everything from fundamental camera techniques to advanced lighting setups, color theory, and the psychological impact of visual storytelling. Participants will gain hands-on experience with professional equipment and learn the secrets behind creating compelling visual narratives.</p>
          
          <h3>What You'll Learn</h3>
          <ul>
            <li>Advanced camera movement and composition techniques</li>
            <li>Lighting design for different moods and genres</li>
            <li>Color grading and post-production workflows</li>
            <li>Working with actors and directors</li>
            <li>Equipment selection and budget management</li>
          </ul>
          
          <p>Whether you're an aspiring filmmaker, a seasoned professional looking to refine your skills, or simply passionate about the visual arts, this masterclass offers invaluable insights into the craft that brings stories to life on screen.</p>
        </div>
      `,
      schedule: [
        { time: '2:00 PM', activity: 'Registration & Welcome Coffee' },
        { time: '2:30 PM', activity: 'Introduction to Visual Storytelling' },
        { time: '3:30 PM', activity: 'Camera Techniques Workshop' },
        { time: '4:30 PM', activity: 'Coffee Break' },
        { time: '4:45 PM', activity: 'Lighting Design Session' },
        { time: '5:45 PM', activity: 'Q&A and Networking' },
        { time: '6:30 PM', activity: 'Workshop Conclusion' }
      ],
      speakers: [
        {
          name: 'Michael Torres',
          role: 'Master Cinematographer',
          image: 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop',
          bio: 'Award-winning cinematographer with 15+ years experience'
        },
        {
          name: 'Lisa Wang',
          role: 'Color Grading Specialist',
          image: 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop',
          bio: 'Expert in digital color correction and visual enhancement'
        }
      ],
      highlights: [
        'Hands-on experience with professional equipment',
        'Small group setting (max 20 participants)',
        'Certificate of completion',
        'Access to exclusive online resources',
        'Networking with industry professionals'
      ]
    }
  };

  const event = eventData[id as keyof typeof eventData] || eventData['midnight-premiere'];

  const relatedEvents = [
    {
      id: 'script-reading-session',
      title: 'Script Reading Session',
      date: 'April 18, 2024',
      image: 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
      category: 'Reading'
    },
    {
      id: 'industry-networking-night',
      title: 'Industry Networking Night',
      date: 'April 5, 2024',
      image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
      category: 'Networking'
    },
    {
      id: 'behind-scenes-exhibition',
      title: 'Behind the Scenes Exhibition',
      date: 'April 12, 2024',
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
      category: 'Exhibition'
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

  const handleExternalTicket = () => {
    window.open(event.ticketUrl, '_blank', 'noopener,noreferrer');
  };

  const handleWishlist = () => {
    setIsWishlisted(!isWishlisted);
  };

  const handleShare = () => {
    if (navigator.share) {
      navigator.share({
        title: event.title,
        text: `Check out this event: ${event.title}`,
        url: window.location.href,
      });
    } else {
      navigator.clipboard.writeText(window.location.href);
    }
  };

  // Floating button visibility on scroll
  useEffect(() => {
    const handleScroll = () => {
      const scrollPosition = window.scrollY;
      const windowHeight = window.innerHeight;
      setShowFloatingButton(scrollPosition > windowHeight * 0.5);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <div className="bg-white text-black min-h-screen">
      {/* Back Navigation */}
      <div className="inner-page">
        <div className="max-w-7xl mx-auto px-6 lg:px-8 pb-8">
          <Link 
            to="/events"
            className="inline-flex items-center text-gray-600 hover:text-black transition-colors duration-300 group"
          >
            <ArrowLeft className="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" />
            Back to Events
          </Link>
        </div>
      </div>

      {/* Hero Section */}
      <section className="pb-16">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {/* Left Column - Event Image */}
            <div className="lg:col-span-7">
              <div className="relative group">
                <img 
                  src={event.image}
                  alt={event.title}
                  className="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-500"
                />
                <div className="absolute top-8 left-8">
                  <span className={`px-4 py-2 text-sm font-medium tracking-wide ${getCategoryColor(event.category)}`}>
                    {event.category}
                  </span>
                </div>
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
              </div>
            </div>

            {/* Right Column - Event Information */}
            <div className="lg:col-span-5">
              <div className="sticky top-32 space-y-8">
                
                {/* Event Header */}
                <div className="space-y-6">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-4">
                      <button
                        onClick={handleWishlist}
                        className={`p-2 transition-colors duration-300 ${
                          isWishlisted ? 'text-red-500' : 'text-gray-400 hover:text-red-500'
                        }`}
                      >
                        <Heart className={`h-5 w-5 ${isWishlisted ? 'fill-current' : ''}`} />
                      </button>
                      <button
                        onClick={handleShare}
                        className="p-2 text-gray-400 hover:text-black transition-colors duration-300"
                      >
                        <Share2 className="h-5 w-5" />
                      </button>
                    </div>
                  </div>
                  
                  <h1 className="text-4xl md:text-5xl cinematic-title leading-tight">
                    {event.title}
                  </h1>
                  
                  {/* Event Details */}
                  <div className="space-y-4">
                    <div className="flex items-center text-gray-700">
                      <Calendar className="h-5 w-5 mr-3" />
                      <span className="font-medium">{event.date}</span>
                    </div>
                    <div className="flex items-center text-gray-700">
                      <Clock className="h-5 w-5 mr-3" />
                      <span className="font-medium">{event.time}</span>
                    </div>
                    <div className="flex items-center text-gray-700">
                      <MapPin className="h-5 w-5 mr-3" />
                      <span className="font-medium">{event.location}</span>
                    </div>
                    <div className="flex items-center text-gray-700">
                      <Ticket className="h-5 w-5 mr-3" />
                      <span className="font-medium">{event.price}</span>
                    </div>
                  </div>
                </div>

                {/* Ticket Purchase Button */}
                <div className="space-y-4">
                  <button
                    onClick={handleExternalTicket}
                    className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                  >
                    <span>BELI TIKET DI {event.ticketPlatform.toUpperCase()}</span>
                    <ExternalLink className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                  </button>
                  
                  {/* Purchase Note */}
                  <p className="text-center text-gray-500 editorial-text text-sm">
                    Pembelian tiket dilakukan melalui platform eksternal resmi kami.
                  </p>
                </div>

                {/* Event Highlights */}
                {event.highlights && (
                  <div className="space-y-4 pt-8 border-t border-gray-200">
                    <h3 className="text-lg font-semibold">Event Highlights</h3>
                    <ul className="space-y-2">
                      {event.highlights.map((highlight, index) => (
                        <li key={index} className="flex items-center text-gray-600">
                          <Star className="h-4 w-4 text-yellow-400 mr-3 flex-shrink-0" />
                          <span className="editorial-text text-sm">{highlight}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Event Description */}
      <section className="py-20 bg-gray-50">
        <div className="max-w-4xl mx-auto px-6 lg:px-8">
          <div className="space-y-12">
            <div>
              <h2 className="text-4xl cinematic-title mb-8">About This Event</h2>
              <div 
                className="prose prose-lg max-w-none editorial-content"
                dangerouslySetInnerHTML={{ __html: event.description }}
              />
            </div>
          </div>
        </div>
      </section>

      {/* Event Schedule */}
      {event.schedule && (
        <section className="py-20">
          <div className="max-w-4xl mx-auto px-6 lg:px-8">
            <h2 className="text-4xl cinematic-title mb-12">Event Schedule</h2>
            <div className="space-y-6">
              {event.schedule.map((item, index) => (
                <div 
                  key={index}
                  className="flex items-center space-x-6 p-6 bg-gray-50 hover:bg-gray-100 transition-colors duration-300"
                >
                  <div className="flex-shrink-0">
                    <span className="text-2xl font-light text-gray-800">{item.time}</span>
                  </div>
                  <div className="flex-1">
                    <h3 className="text-lg font-semibold text-gray-800">{item.activity}</h3>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* Speakers/Guests Section */}
      {event.speakers && (
        <section className="py-20 bg-gray-50">
          <div className="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 className="text-4xl cinematic-title mb-12">Featured Speakers</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {event.speakers.map((speaker, index) => (
                <div 
                  key={index}
                  className="bg-white p-8 shadow-lg hover:shadow-xl transition-all duration-500 hover-lift"
                >
                  <div className="text-center space-y-4">
                    <div className="w-24 h-24 mx-auto overflow-hidden rounded-full">
                      <img 
                        src={speaker.image}
                        alt={speaker.name}
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <h3 className="text-xl font-semibold">{speaker.name}</h3>
                      <p className="text-gray-600 font-medium">{speaker.role}</p>
                      <p className="text-gray-500 editorial-text text-sm mt-2">{speaker.bio}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* Related Events */}
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <h2 className="text-4xl cinematic-title mb-12">Other Events</h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {relatedEvents.map((relatedEvent, index) => (
              <Link
                key={relatedEvent.id}
                to={`/event/${relatedEvent.id}`}
                className="group hover-lift"
              >
                <div className="relative overflow-hidden mb-4">
                  <img 
                    src={relatedEvent.image}
                    alt={relatedEvent.title}
                    className="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <div className="absolute top-4 left-4">
                    <span className={`px-3 py-1 text-xs font-medium tracking-wide ${getCategoryColor(relatedEvent.category)}`}>
                      {relatedEvent.category}
                    </span>
                  </div>
                </div>
                <div className="space-y-2">
                  <h3 className="font-semibold group-hover:text-gray-600 transition-colors duration-300">
                    {relatedEvent.title}
                  </h3>
                  <p className="text-sm text-gray-500">{relatedEvent.date}</p>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Floating Ticket Button (Mobile) */}
      {showFloatingButton && (
        <div className="fixed bottom-6 left-6 right-6 z-50 md:hidden">
          <button
            onClick={handleExternalTicket}
            className="w-full flex items-center justify-center px-6 py-4 bg-black text-white font-semibold tracking-wide shadow-lg hover:bg-gray-800 transition-all duration-300 group"
          >
            <Ticket className="mr-3 h-5 w-5" />
            <span>BELI TIKET</span>
            <ExternalLink className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
          </button>
        </div>
      )}
    </div>
  );
};

export default EventDetail;