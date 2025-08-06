import React, { useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import { 
  ArrowLeft, 
  MapPin, 
  Clock, 
  Calendar,
  Users,
  Briefcase,
  DollarSign,
  ExternalLink,
  Share2,
  Heart,
  CheckCircle,
  Star
} from 'lucide-react';

const JobDetail = () => {
  const { id } = useParams();
  const [isWishlisted, setIsWishlisted] = useState(false);

  // Mock job data - in a real app, this would come from an API
  const jobData = {
    'lead-cinematographer': {
      title: 'Lead Cinematographer',
      department: 'Production',
      type: 'Full-time',
      location: 'Jakarta, Indonesia',
      posted: '2 days ago',
      salary: 'Rp 15,000,000 - 25,000,000',
      experience: '5+ years',
      applicationUrl: 'mailto:careers@sinemakupictures.com?subject=Application for Lead Cinematographer',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">Join our creative team as Lead Cinematographer and shape the visual language of our upcoming sci-fi drama with innovative cinematography techniques that push the boundaries of storytelling.</p>
          
          <p>We're seeking a visionary cinematographer who can translate complex narratives into compelling visual experiences. You'll work closely with our directors to create atmospheric, emotionally resonant imagery that serves the story while maintaining our signature aesthetic.</p>
          
          <blockquote>
            "At Sinemaku Pictures, we believe cinematography is the soul of filmmaking - it's where technical mastery meets artistic vision."
            <cite>— Elena Rodriguez, Creative Director</cite>
          </blockquote>
          
          <p>This role offers the opportunity to work on cutting-edge productions with state-of-the-art equipment while collaborating with some of the industry's most talented professionals.</p>
        </div>
      `,
      responsibilities: [
        'Lead cinematography for feature films and series productions',
        'Collaborate with directors to develop visual concepts and shot lists',
        'Manage camera and lighting departments during production',
        'Oversee technical aspects of image capture and color workflow',
        'Mentor junior cinematographers and camera operators',
        'Work with post-production teams to ensure visual consistency',
        'Research and implement new cinematographic techniques and technologies'
      ],
      requirements: [
        'Minimum 5 years experience as cinematographer or camera operator',
        'Proven track record in narrative filmmaking',
        'Expertise with professional camera systems (RED, ARRI, Sony)',
        'Strong understanding of lighting design and color theory',
        'Experience with various lens systems and specialty equipment',
        'Ability to work under pressure and meet tight deadlines',
        'Excellent communication and leadership skills',
        'Portfolio demonstrating range and technical proficiency'
      ],
      benefits: [
        'Competitive salary with performance bonuses',
        'Health insurance and medical benefits',
        'Professional development opportunities',
        'Access to cutting-edge equipment and technology',
        'Flexible working arrangements',
        'Creative freedom and artistic input',
        'Opportunity to work on award-winning productions',
        'International film festival attendance'
      ],
      companyValues: `
        <p>At Sinemaku Pictures, we foster a collaborative environment where creativity thrives. Our team is passionate about pushing the boundaries of visual storytelling while maintaining the highest standards of professionalism and artistic integrity.</p>
        
        <p>We believe in supporting our team members' growth through mentorship, continuous learning opportunities, and exposure to diverse projects that challenge conventional filmmaking approaches.</p>
      `
    },
    'sound-designer': {
      title: 'Sound Designer',
      department: 'Post-Production',
      type: 'Contract',
      location: 'Remote',
      posted: '1 week ago',
      salary: 'Rp 8,000,000 - 12,000,000',
      experience: '3+ years',
      applicationUrl: 'mailto:careers@sinemakupictures.com?subject=Application for Sound Designer',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">Create immersive audio landscapes for our psychological thriller productions as our Sound Designer, crafting sonic experiences that enhance narrative tension and emotional depth.</p>
          
          <p>We're looking for a creative sound designer who understands the psychological impact of audio in storytelling. You'll be responsible for creating original sound effects, designing ambient soundscapes, and collaborating with our composers to create cohesive audio experiences.</p>
          
          <p>This remote position offers flexibility while working on high-profile productions that demand innovative audio solutions and meticulous attention to detail.</p>
        </div>
      `,
      responsibilities: [
        'Design and create original sound effects for films and series',
        'Develop ambient soundscapes and atmospheric audio',
        'Collaborate with directors and editors on audio vision',
        'Record and edit field recordings and foley sounds',
        'Mix and master audio elements for final delivery',
        'Maintain organized sound libraries and asset management',
        'Work with composers to integrate music and sound design'
      ],
      requirements: [
        'Minimum 3 years experience in sound design for film/TV',
        'Proficiency in Pro Tools, Logic Pro, or similar DAWs',
        'Experience with field recording and foley techniques',
        'Understanding of audio post-production workflows',
        'Creative approach to sound design and audio storytelling',
        'Ability to work independently and meet deadlines',
        'Strong communication skills for remote collaboration',
        'Portfolio demonstrating range in different genres'
      ],
      benefits: [
        'Competitive project-based compensation',
        'Flexible remote working arrangement',
        'Access to professional audio software licenses',
        'Opportunity to work on diverse projects',
        'Creative freedom in audio design',
        'Collaboration with award-winning filmmakers',
        'Professional development support',
        'Potential for long-term partnership'
      ],
      companyValues: `
        <p>Our remote team members are integral to our creative process. We provide the support and resources needed for exceptional work while respecting the flexibility that remote work offers.</p>
        
        <p>We value innovation, attention to detail, and the ability to translate creative vision into compelling audio experiences that serve the story.</p>
      `
    }
  };

  const job = jobData[id as keyof typeof jobData] || jobData['lead-cinematographer'];

  const relatedJobs = [
    {
      id: 'vfx-supervisor',
      title: 'VFX Supervisor',
      department: 'Visual Effects',
      type: 'Full-time',
      location: 'Jakarta'
    },
    {
      id: 'script-supervisor',
      title: 'Script Supervisor',
      department: 'Production',
      type: 'Contract',
      location: 'Bandung'
    },
    {
      id: 'casting-director',
      title: 'Casting Director',
      department: 'Creative',
      type: 'Full-time',
      location: 'Jakarta'
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

  const handleExternalApplication = () => {
    window.open(job.applicationUrl, '_blank', 'noopener,noreferrer');
  };

  const handleWishlist = () => {
    setIsWishlisted(!isWishlisted);
  };

  const handleShare = () => {
    if (navigator.share) {
      navigator.share({
        title: job.title,
        text: `Check out this job opportunity: ${job.title} at Sinemaku Pictures`,
        url: window.location.href,
      });
    } else {
      navigator.clipboard.writeText(window.location.href);
    }
  };

  return (
    <div className="bg-white text-black min-h-screen">
      {/* Back Navigation */}
      <div className="inner-page">
        <div className="max-w-7xl mx-auto px-6 lg:px-8 pb-8">
          <Link 
            to="/jobs"
            className="inline-flex items-center text-gray-600 hover:text-black transition-colors duration-300 group"
          >
            <ArrowLeft className="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" />
            Back to Careers
          </Link>
        </div>
      </div>

      {/* Job Header */}
      <section className="pb-16">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {/* Left Column - Job Information */}
            <div className="lg:col-span-8">
              <div className="space-y-8">
                
                {/* Job Header */}
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
                    <span className={`px-4 py-2 text-sm font-medium ${getTypeColor(job.type)}`}>
                      {job.type}
                    </span>
                  </div>
                  
                  <h1 className="text-5xl md:text-6xl cinematic-title leading-tight">
                    {job.title}
                  </h1>
                  
                  <div className="text-xl text-gray-600 font-medium">
                    {job.department}
                  </div>
                  
                  {/* Job Details */}
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <MapPin className="h-5 w-5 mr-3" />
                        <span className="font-medium">{job.location}</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <DollarSign className="h-5 w-5 mr-3" />
                        <span className="font-medium">{job.salary}</span>
                      </div>
                    </div>
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <Calendar className="h-5 w-5 mr-3" />
                        <span className="font-medium">Posted {job.posted}</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <Users className="h-5 w-5 mr-3" />
                        <span className="font-medium">{job.experience} experience</span>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Job Description */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">About This Role</h2>
                  <div 
                    className="prose prose-lg max-w-none editorial-content"
                    dangerouslySetInnerHTML={{ __html: job.description }}
                  />
                </div>

                {/* Responsibilities */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Key Responsibilities</h2>
                  <ul className="space-y-3">
                    {job.responsibilities.map((responsibility, index) => (
                      <li key={index} className="flex items-start">
                        <CheckCircle className="h-5 w-5 text-green-500 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{responsibility}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Requirements */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Requirements</h2>
                  <ul className="space-y-3">
                    {job.requirements.map((requirement, index) => (
                      <li key={index} className="flex items-start">
                        <Star className="h-5 w-5 text-yellow-400 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{requirement}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Benefits */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">What We Offer</h2>
                  <ul className="space-y-3">
                    {job.benefits.map((benefit, index) => (
                      <li key={index} className="flex items-start">
                        <CheckCircle className="h-5 w-5 text-blue-500 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{benefit}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Company Values */}
                <div className="bg-gray-50 p-8 border-l-4 border-black">
                  <h3 className="text-xl font-semibold mb-4">Our Culture</h3>
                  <div 
                    className="editorial-text text-gray-600 leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: job.companyValues }}
                  />
                </div>
              </div>
            </div>

            {/* Right Column - Application Sidebar */}
            <div className="lg:col-span-4">
              <div className="sticky top-32 space-y-8">
                
                {/* Application Card */}
                <div className="bg-gray-50 p-8">
                  <h3 className="text-2xl font-semibold mb-6">Apply for This Position</h3>
                  
                  <div className="space-y-6">
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <Briefcase className="h-5 w-5 mr-3" />
                        <span className="font-medium">{job.type} Position</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <Clock className="h-5 w-5 mr-3" />
                        <span className="font-medium">Apply by April 30, 2024</span>
                      </div>
                    </div>
                    
                    <button
                      onClick={handleExternalApplication}
                      className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                    >
                      <span>APPLY NOW</span>
                      <ExternalLink className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                    </button>
                    
                    <p className="text-center text-gray-500 editorial-text text-sm">
                      Applications are processed via email. Please include your portfolio and cover letter.
                    </p>
                  </div>
                </div>

                {/* Related Jobs */}
                <div>
                  <h3 className="text-xl font-semibold mb-6">Other Open Positions</h3>
                  <div className="space-y-4">
                    {relatedJobs.map((relatedJob, index) => (
                      <Link 
                        key={relatedJob.id}
                        to={`/job/${relatedJob.id}`}
                        className="block p-4 bg-gray-50 hover:bg-gray-100 transition-colors duration-300 group"
                      >
                        <h4 className="font-semibold group-hover:text-gray-600 transition-colors duration-300 mb-2">
                          {relatedJob.title}
                        </h4>
                        <div className="flex items-center justify-between text-sm text-gray-600">
                          <span>{relatedJob.department}</span>
                          <span className={`px-2 py-1 text-xs font-medium ${getTypeColor(relatedJob.type)}`}>
                            {relatedJob.type}
                          </span>
                        </div>
                        <p className="text-sm text-gray-500 mt-1">{relatedJob.location}</p>
                      </Link>
                    ))}
                  </div>
                  
                  <div className="mt-6">
                    <Link 
                      to="/jobs"
                      className="block w-full text-center px-6 py-3 border border-black text-black font-semibold tracking-wide hover:bg-black hover:text-white transition-all duration-300"
                    >
                      VIEW ALL POSITIONS
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default JobDetail;