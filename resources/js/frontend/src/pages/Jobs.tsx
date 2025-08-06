import React from 'react';
import { MapPin, Clock, Users, ArrowRight, Briefcase, Star } from 'lucide-react';
import { Link } from 'react-router-dom';

const Jobs = () => {
  const jobListings = [
    {
      id: 'lead-cinematographer',
      title: "Lead Cinematographer",
      location: "Jakarta, Indonesia",
      type: "Full-time",
      department: "Production",
      posted: "2 days ago",
      description: "Shape the visual language of our upcoming sci-fi drama with innovative cinematography techniques.",
      salary: "Rp 15,000,000 - 25,000,000",
      experience: "5+ years"
    },
    {
      id: 'sound-designer',
      title: "Sound Designer",
      location: "Remote",
      type: "Contract",
      department: "Post-Production",
      posted: "1 week ago",
      description: "Create immersive audio landscapes for psychological thriller productions.",
      salary: "Rp 8,000,000 - 12,000,000",
      experience: "3+ years"
    },
    {
      id: 'vfx-supervisor',
      title: "VFX Supervisor",
      location: "Jakarta, Indonesia",
      type: "Full-time",
      department: "Visual Effects",
      posted: "3 days ago",
      description: "Lead visual effects team for musical drama production with cutting-edge technology.",
      salary: "Rp 18,000,000 - 30,000,000",
      experience: "7+ years"
    },
    {
      id: 'script-supervisor',
      title: "Script Supervisor",
      location: "Bandung, Indonesia",
      type: "Contract",
      department: "Production",
      posted: "5 days ago",
      description: "Ensure continuity and script accuracy during filming of urban drama series.",
      salary: "Rp 6,000,000 - 10,000,000",
      experience: "2+ years"
    },
    {
      id: 'casting-director',
      title: "Casting Director",
      location: "Jakarta, Indonesia",
      type: "Full-time",
      department: "Creative",
      posted: "1 day ago",
      description: "Discover and cast talent for upcoming film and series productions.",
      salary: "Rp 12,000,000 - 20,000,000",
      experience: "4+ years"
    },
    {
      id: 'marketing-manager',
      title: "Marketing Manager",
      location: "Jakarta, Indonesia",
      type: "Full-time",
      department: "Marketing",
      posted: "4 days ago",
      description: "Develop and execute marketing strategies for film releases and brand partnerships.",
      salary: "Rp 10,000,000 - 16,000,000",
      experience: "3+ years"
    },
    {
      id: 'production-assistant',
      title: "Production Assistant",
      location: "Jakarta, Indonesia",
      type: "Part-time",
      department: "Production",
      posted: "6 days ago",
      description: "Support production team with daily operations and coordination tasks.",
      salary: "Rp 4,000,000 - 6,000,000",
      experience: "Entry level"
    },
    {
      id: 'color-grading-artist',
      title: "Color Grading Artist",
      location: "Remote",
      type: "Freelance",
      department: "Post-Production",
      posted: "1 week ago",
      description: "Enhance visual storytelling through expert color correction and grading techniques.",
      salary: "Rp 7,000,000 - 11,000,000",
      experience: "2+ years"
    }
  ];

  const castingCalls = [
    {
      id: 'urban-chronicles-lead',
      title: "Lead Actor - Urban Chronicles",
      film: "Urban Chronicles (Series)",
      tags: ["Male", "25-35 years", "Jakarta"],
      posted: "2 days ago",
      description: "Seeking charismatic lead actor for crime drama series set in modern Jakarta.",
      character: "Detective Marco Santos",
      shootPeriod: "June - September 2024",
      auditionDeadline: "April 15, 2024"
    },
    {
      id: 'midnight-sequel-supporting',
      title: "Supporting Actress - Midnight Sequel",
      film: "Midnight: Awakening",
      tags: ["Female", "30-40 years", "Experienced"],
      posted: "1 week ago",
      description: "Looking for experienced actress to play complex supporting role in psychological thriller.",
      character: "Dr. Sarah Mitchell",
      shootPeriod: "May - August 2024",
      auditionDeadline: "April 10, 2024"
    },
    {
      id: 'last-symphony-child',
      title: "Child Actor - The Last Symphony",
      film: "The Last Symphony",
      tags: ["Child", "8-12 years", "Musical"],
      posted: "3 days ago",
      description: "Talented child actor needed for musical drama. Previous musical experience preferred.",
      character: "Young Aria",
      shootPeriod: "July - October 2024",
      auditionDeadline: "April 20, 2024"
    },
    {
      id: 'digital-souls-extras',
      title: "Background Extras - Digital Souls",
      film: "Digital Souls (Series)",
      tags: ["All Ages", "Tech Background", "Jakarta"],
      posted: "5 days ago",
      description: "Multiple background actors needed for sci-fi series filming in Jakarta tech district.",
      character: "Tech Workers & Citizens",
      shootPeriod: "April - July 2024",
      auditionDeadline: "April 5, 2024"
    }
  ];

  const getTypeColor = (type: string) => {
    const colors = {
      'Full-time': 'bg-green-500 text-white',
      'Part-time': 'bg-blue-500 text-white',
      'Contract': 'bg-yellow-500 text-black',
      'Freelance': 'bg-purple-500 text-white'
    };
    return colors[type as keyof typeof colors] || 'bg-gray-500 text-white';
  };

  return (
    <div className="bg-black text-white">
      {/* Job Listings */}
      <section className="inner-page bg-white text-black">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <h2 className="text-6xl cinematic-title mb-20">Open Positions</h2>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {jobListings.map((job, index) => (
              <div 
                key={job.id} 
                className="bg-gray-50 p-8 hover:shadow-xl transition-all duration-500 group hover-lift"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="space-y-6">
                  <div className="flex justify-between items-start">
                    <div>
                      <h3 className="text-2xl font-semibold group-hover:text-gray-600 transition-colors duration-300 mb-2">
                        {job.title}
                      </h3>
                      <p className="text-gray-600 editorial-text font-medium">
                        {job.department}
                      </p>
                    </div>
                    <span className="text-sm text-gray-500 flex items-center">
                      <Clock className="h-4 w-4 mr-2" />
                      {job.posted}
                    </span>
                  </div>
                  
                  <p className="text-gray-600 editorial-text leading-relaxed">
                    {job.description}
                  </p>
                  
                  <div className="flex flex-wrap gap-3">
                    <span className={`px-3 py-1 text-sm font-medium ${getTypeColor(job.type)}`}>
                      {job.type}
                    </span>
                    <span className="px-3 py-1 bg-gray-200 text-gray-700 text-sm font-medium">
                      {job.department}
                    </span>
                  </div>
                  
                  <div className="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div className="flex items-center text-gray-600">
                      <MapPin className="h-4 w-4 mr-2" />
                      {job.location}
                    </div>
                    <Link
                      to={`/job/${job.id}`}
                      className="inline-flex items-center px-6 py-3 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 group"
                    >
                      LIHAT DETAIL
                      <ArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" />
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Casting Calls */}
      <section className="py-32 bg-gray-50 text-black">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <h2 className="text-6xl cinematic-title mb-20">Current Casting</h2>
          
          <div className="space-y-8">
            {castingCalls.map((casting, index) => (
              <div 
                key={casting.id} 
                className="bg-white p-8 shadow-lg hover:shadow-xl transition-all duration-500 group hover-lift"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                  <div className="lg:col-span-8">
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                      <h3 className="text-2xl font-semibold group-hover:text-gray-600 transition-colors duration-300 mb-2 sm:mb-0">
                        {casting.title}
                      </h3>
                      <span className="text-sm text-gray-500 flex items-center">
                        <Clock className="h-4 w-4 mr-2" />
                        {casting.posted}
                      </span>
                    </div>
                    
                    <p className="text-gray-600 editorial-text mb-4 text-lg">
                      {casting.description}
                    </p>
                    
                    <p className="text-gray-700 font-medium mb-4 flex items-center">
                      <Star className="h-4 w-4 mr-2" />
                      {casting.film}
                    </p>
                    
                    <div className="flex flex-wrap gap-3">
                      {casting.tags.map((tag, tagIndex) => (
                        <span 
                          key={tagIndex}
                          className="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium tracking-wide"
                        >
                          {tag}
                        </span>
                      ))}
                    </div>
                  </div>
                  
                  <div className="lg:col-span-4 lg:text-right">
                    <Link
                      to={`/casting/${casting.id}`}
                      className="w-full lg:w-auto inline-flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 group"
                    >
                      LIHAT DETAIL
                      <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Call to Action */}
      <section className="py-32 bg-black">
        <div className="max-w-4xl mx-auto text-center px-6 lg:px-8">
          <Briefcase className="h-20 w-20 text-gray-400 mx-auto mb-8" />
          <h2 className="text-6xl cinematic-title mb-8 text-white">
            Don't See<br />Your Role?
          </h2>
          <p className="text-xl editorial-text text-gray-300 mb-12 leading-relaxed">
            We're always looking for exceptional talent to join our creative family. 
            Send us your portfolio and tell us how you'd contribute to our vision.
          </p>
          <button className="px-12 py-5 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift text-lg">
            SUBMIT GENERAL APPLICATION
          </button>
        </div>
      </section>
    </div>
  );
};

export default Jobs;