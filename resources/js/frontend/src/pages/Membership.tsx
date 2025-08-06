import React, { useState } from 'react';
import { Users, Star, Calendar, Film, Play, ArrowRight, Check, Mail, User, MapPin } from 'lucide-react';

const Membership = () => {
  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    interests: []
  });

  const memberBenefits = [
    {
      icon: Calendar,
      title: 'Exclusive Premieres',
      description: 'First access to film screenings, gala premieres, and red carpet events before general release.',
      highlight: 'VIP Access'
    },
    {
      icon: Play,
      title: 'Behind the Scenes',
      description: 'Exclusive content including director commentaries, deleted scenes, and production diaries.',
      highlight: 'Exclusive Content'
    },
    {
      icon: Star,
      title: 'Early Access',
      description: 'Be the first to watch trailers, teasers, and get early access to merchandise drops.',
      highlight: 'First Look'
    },
    {
      icon: Users,
      title: 'Casting Opportunities',
      description: 'Priority invitations to casting calls, auditions, and opportunities to be featured as extras.',
      highlight: 'Be Part of the Story'
    },
    {
      icon: Film,
      title: 'Digital Releases',
      description: 'Complimentary access to select digital releases and streaming content from our archive.',
      highlight: 'Free Content'
    },
    {
      icon: Mail,
      title: 'Member Newsletter',
      description: 'Monthly insider updates with production news, industry insights, and member-only announcements.',
      highlight: 'Insider Info'
    }
  ];

  const interestOptions = [
    'Acting & Performance',
    'Directing & Filmmaking',
    'Screenwriting',
    'Cinematography',
    'Sound Design',
    'Production Design',
    'Film Criticism',
    'Industry Networking'
  ];

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleInterestToggle = (interest: string) => {
    setFormData(prev => ({
      ...prev,
      interests: prev.interests.includes(interest)
        ? prev.interests.filter(i => i !== interest)
        : [...prev.interests, interest]
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // Handle form submission
    console.log('Membership application:', formData);
  };

  return (
    <div className="bg-black text-white">
      {/* Hero Section - Edge to Edge */}
      <section className="inner-page relative overflow-hidden container-edge">
        <div className="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800" />
        <div className="relative z-10 container-content">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <div className="lg:col-span-7 space-y-8 animate-fade-in-left">
              <div className="space-y-6">
                <div className="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-white text-sm font-medium tracking-wide animate-fade-in-up">
                  Free Membership
                </div>
                <h1 className="text-6xl md:text-7xl lg:text-8xl cinematic-title tracking-tight leading-none animate-text-reveal animate-delay-200">
                  Become part<br />
                  of the story
                </h1>
                <p className="text-xl md:text-2xl editorial-text text-gray-300 leading-relaxed max-w-2xl animate-text-reveal animate-delay-400">
                  Join our inner circle of film enthusiasts and gain exclusive access to premieres, 
                  behind-the-scenes content, and opportunities to be part of our creative journey.
                </p>
              </div>
              
              <div className="flex flex-col sm:flex-row gap-6 animate-scale-in animate-delay-600">
                <button 
                  onClick={() => document.getElementById('membership-form')?.scrollIntoView({ behavior: 'smooth' })}
                  className="px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic animate-pulse-glow"
                >
                  JOIN NOW — IT'S FREE
                  <ArrowRight className="inline ml-3 h-5 w-5 group-hover:translate-x-2 transition-transform duration-300" />
                </button>
                <div className="flex items-center space-x-4 text-gray-400 animate-fade-in-up animate-delay-800">
                  <div className="flex items-center">
                    <Users className="h-5 w-5 mr-2" />
                    <span className="editorial-text">2,847 members</span>
                  </div>
                  <div className="w-1 h-1 bg-gray-500 rounded-full" />
                  <span className="editorial-text">Always free</span>
                </div>
              </div>
            </div>
            
            <div className="lg:col-span-5 animate-fade-in-right animate-delay-400">
              <div className="relative group">
                <div className="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-blue-500/20 blur-3xl animate-pulse" />
                <img 
                  src="https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=600&h=800&fit=crop"
                  alt="Exclusive Member Event"
                  className="relative w-full aspect-[3/4] object-cover group-hover:scale-105 transition-transform duration-700 gpu-accelerated"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                <div className="absolute bottom-8 left-8 right-8 text-white animate-text-reveal animate-delay-800">
                  <p className="text-sm editorial-text mb-2">Latest Member Event</p>
                  <h3 className="text-xl font-semibold">Midnight Premiere Screening</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Member Benefits - Edge to Edge */}
      <section className="py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="text-center mb-20 animate-zoom-in">
            <h2 className="text-5xl md:text-6xl cinematic-title mb-8 animate-text-reveal">
              Member Exclusive Benefits
            </h2>
            <p className="text-xl editorial-text text-gray-600 max-w-3xl mx-auto leading-relaxed animate-text-reveal animate-delay-300">
              As a Sinemaku Pictures member, you'll gain access to a world of exclusive experiences 
              and opportunities that bring you closer to the art of filmmaking.
            </p>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 grid-stagger">
            {memberBenefits.map((benefit, index) => (
              <div 
                key={index} 
                className="group p-8 bg-gray-50 hover:bg-gray-100 transition-all duration-500 hover-lift float-card"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="space-y-6">
                  <div className="flex items-center justify-between">
                    <div className="p-3 bg-black text-white group-hover:bg-gray-800 transition-colors duration-300 group-hover:scale-110 transform">
                      <benefit.icon className="h-6 w-6" />
                    </div>
                    <span className="px-3 py-1 bg-black text-white text-xs font-medium tracking-wide">
                      {benefit.highlight}
                    </span>
                  </div>
                  
                  <div>
                    <h3 className="text-xl font-semibold mb-3 group-hover:text-gray-600 transition-colors duration-300">
                      {benefit.title}
                    </h3>
                    <p className="text-gray-600 editorial-text leading-relaxed">
                      {benefit.description}
                    </p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Membership Form - Edge to Edge */}
      <section id="membership-form" className="py-32 bg-gray-50 text-black container-edge">
        <div className="container-content">
          <div className="max-w-4xl mx-auto">
            <div className="text-center mb-16 animate-zoom-in">
              <h2 className="text-5xl md:text-6xl cinematic-title mb-8 animate-text-reveal">
                Join Our Community
              </h2>
              <p className="text-xl editorial-text text-gray-600 leading-relaxed animate-text-reveal animate-delay-300">
                Ready to become part of our creative family? Fill out the form below to start your journey 
                as a Sinemaku Pictures member. It's completely free and takes less than 2 minutes.
              </p>
            </div>
            
            <form onSubmit={handleSubmit} className="space-y-8 animate-fade-in-up animate-delay-500">
              <div className="bg-white p-8 md:p-12 shadow-lg hover:shadow-xl transition-shadow duration-500">
                {/* Personal Information */}
                <div className="space-y-8">
                  <h3 className="text-2xl font-semibold mb-6 animate-text-reveal">Personal Information</h3>
                  
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div className="animate-fade-in-left animate-delay-700">
                      <label htmlFor="firstName" className="block text-sm font-medium text-gray-700 mb-3">
                        First Name *
                      </label>
                      <div className="relative">
                        <User className="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
                        <input
                          type="text"
                          id="firstName"
                          name="firstName"
                          value={formData.firstName}
                          onChange={handleInputChange}
                          required
                          className="w-full pl-12 pr-4 py-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 editorial-text hover:border-gray-400"
                          placeholder="Enter your first name"
                        />
                      </div>
                    </div>
                    
                    <div className="animate-fade-in-right animate-delay-700">
                      <label htmlFor="lastName" className="block text-sm font-medium text-gray-700 mb-3">
                        Last Name *
                      </label>
                      <div className="relative">
                        <User className="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
                        <input
                          type="text"
                          id="lastName"
                          name="lastName"
                          value={formData.lastName}
                          onChange={handleInputChange}
                          required
                          className="w-full pl-12 pr-4 py-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 editorial-text hover:border-gray-400"
                          placeholder="Enter your last name"
                        />
                      </div>
                    </div>
                  </div>
                  
                  <div className="animate-fade-in-up animate-delay-800">
                    <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-3">
                      Email Address *
                    </label>
                    <div className="relative">
                      <Mail className="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
                      <input
                        type="email"
                        id="email"
                        name="email"
                        value={formData.email}
                        onChange={handleInputChange}
                        required
                        className="w-full pl-12 pr-4 py-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 editorial-text hover:border-gray-400"
                        placeholder="Enter your email address"
                      />
                    </div>
                  </div>
                  
                  <div className="animate-fade-in-up animate-delay-900">
                    <label htmlFor="city" className="block text-sm font-medium text-gray-700 mb-3">
                      City
                    </label>
                    <div className="relative">
                      <MapPin className="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
                      <input
                        type="text"
                        id="city"
                        name="city"
                        value={formData.city}
                        onChange={handleInputChange}
                        className="w-full pl-12 pr-4 py-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 editorial-text hover:border-gray-400"
                        placeholder="Enter your city"
                      />
                    </div>
                  </div>
                </div>
                
                {/* Interests */}
                <div className="mt-12 pt-8 border-t border-gray-200">
                  <h3 className="text-2xl font-semibold mb-6 animate-text-reveal animate-delay-1000">Areas of Interest</h3>
                  <p className="text-gray-600 editorial-text mb-6 animate-text-reveal animate-delay-1100">
                    Select the areas that interest you most. This helps us personalize your member experience.
                  </p>
                  
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 grid-stagger">
                    {interestOptions.map((interest, index) => (
                      <button
                        key={interest}
                        type="button"
                        onClick={() => handleInterestToggle(interest)}
                        className={`p-4 border-2 text-left transition-all duration-300 hover:border-black group hover:scale-105 ${
                          formData.interests.includes(interest)
                            ? 'border-black bg-black text-white'
                            : 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50'
                        }`}
                        style={{ animationDelay: `${1200 + index * 50}ms` }}
                      >
                        <div className="flex items-center justify-between">
                          <span className="editorial-text font-medium">{interest}</span>
                          <div className={`w-5 h-5 border-2 flex items-center justify-center transition-all duration-300 ${
                            formData.interests.includes(interest)
                              ? 'border-white bg-white'
                              : 'border-gray-400 group-hover:border-black'
                          }`}>
                            {formData.interests.includes(interest) && (
                              <Check className="h-3 w-3 text-black" />
                            )}
                          </div>
                        </div>
                      </button>
                    ))}
                  </div>
                </div>
                
                {/* Submit Button */}
                <div className="mt-12 pt-8 border-t border-gray-200 animate-scale-in animate-delay-1500">
                  <button
                    type="submit"
                    className="w-full px-8 py-6 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group text-lg btn-cinematic animate-pulse-glow"
                  >
                    <span className="flex items-center justify-center">
                      BECOME A MEMBER — FREE
                      <ArrowRight className="ml-3 h-6 w-6 group-hover:translate-x-2 transition-transform duration-300" />
                    </span>
                  </button>
                  
                  <p className="text-center text-gray-500 editorial-text text-sm mt-6">
                    By joining, you agree to receive member communications and exclusive updates. 
                    You can unsubscribe at any time.
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      {/* Member Testimonials - Enhanced */}
      <section className="py-32 bg-black container-edge">
        <div className="container-content">
          <div className="text-center mb-20 animate-zoom-in">
            <h2 className="text-5xl md:text-6xl cinematic-title mb-8 text-white animate-text-reveal">
              What Members Say
            </h2>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 slide-alternate">
            {[
              {
                quote: "Being a Sinemaku Pictures member opened doors I never imagined. I was invited to a premiere and even got to meet the director.",
                author: "Sarah Chen",
                role: "Film Enthusiast"
              },
              {
                quote: "The behind-the-scenes content is incredible. It's like having a film school education delivered to your inbox.",
                author: "Michael Torres",
                role: "Aspiring Director"
              },
              {
                quote: "I love the exclusive access to early screenings. It makes me feel like I'm part of the creative process.",
                author: "Lisa Wang",
                role: "Member since 2022"
              }
            ].map((testimonial, index) => (
              <div 
                key={index} 
                className="p-8 bg-gray-900 text-white hover:bg-gray-800 transition-all duration-500 hover-lift float-card"
                style={{ animationDelay: `${index * 0.2}s` }}
              >
                <div className="space-y-6">
                  <div className="flex items-center space-x-1">
                    {[...Array(5)].map((_, i) => (
                      <Star key={i} className="h-5 w-5 text-yellow-400 fill-current animate-pulse" style={{ animationDelay: `${i * 100}ms` }} />
                    ))}
                  </div>
                  
                  <blockquote className="text-gray-300 editorial-text leading-relaxed text-lg">
                    "{testimonial.quote}"
                  </blockquote>
                  
                  <div>
                    <p className="font-semibold text-white">{testimonial.author}</p>
                    <p className="text-gray-400 editorial-text text-sm">{testimonial.role}</p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};

export default Membership;