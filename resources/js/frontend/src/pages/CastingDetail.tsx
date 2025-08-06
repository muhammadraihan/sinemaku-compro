import React, { useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import { 
  ArrowLeft, 
  MapPin, 
  Clock, 
  Calendar,
  Users,
  Star,
  ExternalLink,
  Share2,
  Heart,
  CheckCircle,
  Camera,
  Film,
  User
} from 'lucide-react';

const CastingDetail = () => {
  const { id } = useParams();
  const [isWishlisted, setIsWishlisted] = useState(false);

  // Mock casting data - in a real app, this would come from an API
  const castingData = {
    'urban-chronicles-lead': {
      title: 'Lead Actor - Urban Chronicles',
      character: 'Detective Marco Santos',
      film: 'Urban Chronicles (Series)',
      castingType: 'Lead Role',
      gender: 'Male',
      ageRange: '25-35 years',
      ethnicity: 'Any',
      location: 'Jakarta, Indonesia',
      shootPeriod: 'June - September 2024',
      auditionDeadline: 'April 15, 2024',
      posted: '2 days ago',
      applicationUrl: 'mailto:casting@sinemakupictures.com?subject=Audition for Detective Marco Santos',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">We are seeking a charismatic and versatile actor to portray Detective Marco Santos, the complex protagonist of our upcoming crime drama series "Urban Chronicles" set in modern Jakarta.</p>
          
          <p>Detective Santos is a morally ambiguous character who navigates the gray areas between justice and corruption in Jakarta's urban landscape. The role requires an actor capable of conveying both vulnerability and strength, with the ability to portray internal conflict and moral complexity.</p>
          
          <blockquote>
            "Marco Santos represents the modern urban detective - someone caught between idealism and pragmatism, fighting for justice in a system that often works against him."
            <cite>— Elena Rodriguez, Series Creator</cite>
          </blockquote>
          
          <p>This is a career-defining role that will span multiple seasons, offering the opportunity to develop a character arc that explores themes of justice, family, and personal redemption against the backdrop of Jakarta's evolving cityscape.</p>
        </div>
      `,
      characterBackground: `
        <p>Detective Marco Santos is a 30-year-old investigator with the Jakarta Metropolitan Police. Born and raised in the city's working-class neighborhoods, he understands both the streets and the system. His personal history with crime - having lost his younger brother to gang violence - drives his relentless pursuit of justice.</p>
        
        <p>Marco is fluent in Indonesian, English, and Javanese. He's physically fit, intellectually sharp, and emotionally complex. The character requires an actor who can convey intelligence, determination, and the weight of personal trauma while maintaining the charisma necessary for a leading role.</p>
      `,
      requirements: [
        'Male actor, aged 25-35 years',
        'Fluent in Indonesian (native or near-native level)',
        'Strong dramatic acting experience',
        'Physical fitness for action sequences',
        'Ability to portray complex emotional range',
        'Experience with on-camera work preferred',
        'Comfortable with intimate and intense dramatic scenes',
        'Available for 4-month shooting schedule'
      ],
      auditionPreparation: [
        'Prepare two contrasting monologues (2-3 minutes each)',
        'One contemporary dramatic piece',
        'One piece showing vulnerability or emotional depth',
        'Be prepared for cold reading from the script',
        'Physical movement and basic action sequence demonstration',
        'Bring headshot and current resume',
        'Dress in contemporary, professional attire'
      ],
      whatToExpect: [
        'Initial audition: 15-20 minutes',
        'Monologue performance and cold reading',
        'Brief interview about the character and series',
        'Callback auditions for shortlisted candidates',
        'Chemistry reads with potential co-stars',
        'Final screen test with series creator'
      ]
    },
    'midnight-sequel-supporting': {
      title: 'Supporting Actress - Midnight Sequel',
      character: 'Dr. Sarah Mitchell',
      film: 'Midnight: Awakening',
      castingType: 'Supporting Role',
      gender: 'Female',
      ageRange: '30-40 years',
      ethnicity: 'Any',
      location: 'Jakarta, Indonesia',
      shootPeriod: 'May - August 2024',
      auditionDeadline: 'April 10, 2024',
      posted: '1 week ago',
      applicationUrl: 'mailto:casting@sinemakupictures.com?subject=Audition for Dr. Sarah Mitchell',
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">We are looking for an experienced actress to play Dr. Sarah Mitchell, a brilliant psychiatrist who becomes entangled in the psychological mystery of "Midnight: Awakening," the highly anticipated sequel to our acclaimed thriller.</p>
          
          <p>Dr. Mitchell is a complex character who serves as both ally and potential antagonist to the protagonist. She's intellectually formidable, emotionally guarded, and harbors secrets that could unravel the entire narrative. The role requires an actress capable of subtle manipulation and psychological depth.</p>
          
          <p>This supporting role is crucial to the film's psychological framework and offers significant screen time with memorable, impactful scenes that will showcase the actress's range and talent.</p>
        </div>
      `,
      characterBackground: `
        <p>Dr. Sarah Mitchell is a renowned psychiatrist specializing in trauma and memory disorders. She's academically brilliant, having published extensively on the nature of consciousness and memory. However, her professional success masks personal struggles and ethical compromises that will be revealed throughout the film.</p>
        
        <p>The character requires an actress who can portray intelligence, authority, and hidden vulnerability. Dr. Mitchell must be believable as both a trusted professional and someone capable of psychological manipulation.</p>
      `,
      requirements: [
        'Female actress, aged 30-40 years',
        'Extensive dramatic acting experience',
        'Ability to portray intellectual authority',
        'Experience with psychological/thriller genres preferred',
        'Comfortable with complex, morally ambiguous characters',
        'Strong improvisational skills',
        'Available for 3-month shooting schedule',
        'Previous film experience required'
      ],
      auditionPreparation: [
        'Prepare one dramatic monologue (3-4 minutes)',
        'Focus on psychological complexity and subtext',
        'Be prepared for script reading and character discussion',
        'Bring professional headshots and detailed resume',
        'Research the original "Midnight" film',
        'Dress professionally (character-appropriate)'
      ],
      whatToExpected: [
        'Initial audition: 20-25 minutes',
        'Monologue and cold reading from script',
        'Character discussion with director',
        'Callback with lead actor for chemistry read',
        'Final audition with full creative team'
      ]
    }
  };

  const casting = castingData[id as keyof typeof castingData] || castingData['urban-chronicles-lead'];

  const relatedCastings = [
    {
      id: 'last-symphony-child',
      title: 'Child Actor - The Last Symphony',
      character: 'Young Aria',
      film: 'The Last Symphony',
      ageRange: '8-12 years'
    },
    {
      id: 'digital-souls-extras',
      title: 'Background Extras - Digital Souls',
      character: 'Tech Workers & Citizens',
      film: 'Digital Souls (Series)',
      ageRange: 'All Ages'
    }
  ];

  const handleExternalApplication = () => {
    window.open(casting.applicationUrl, '_blank', 'noopener,noreferrer');
  };

  const handleWishlist = () => {
    setIsWishlisted(!isWishlisted);
  };

  const handleShare = () => {
    if (navigator.share) {
      navigator.share({
        title: `${casting.title} - ${casting.film}`,
        text: `Check out this casting opportunity: ${casting.character} in ${casting.film}`,
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

      {/* Casting Header */}
      <section className="pb-16">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {/* Left Column - Casting Information */}
            <div className="lg:col-span-8">
              <div className="space-y-8">
                
                {/* Casting Header */}
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
                    <span className="px-4 py-2 bg-purple-500 text-white text-sm font-medium">
                      {casting.castingType}
                    </span>
                  </div>
                  
                  <h1 className="text-5xl md:text-6xl cinematic-title leading-tight">
                    {casting.character}
                  </h1>
                  
                  <div className="text-xl text-gray-600 font-medium flex items-center">
                    <Film className="h-6 w-6 mr-3" />
                    {casting.film}
                  </div>
                  
                  {/* Casting Details */}
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <User className="h-5 w-5 mr-3" />
                        <span className="font-medium">{casting.gender}, {casting.ageRange}</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <MapPin className="h-5 w-5 mr-3" />
                        <span className="font-medium">{casting.location}</span>
                      </div>
                    </div>
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <Camera className="h-5 w-5 mr-3" />
                        <span className="font-medium">Shoot: {casting.shootPeriod}</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <Clock className="h-5 w-5 mr-3" />
                        <span className="font-medium">Deadline: {casting.auditionDeadline}</span>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Role Description */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">About This Role</h2>
                  <div 
                    className="prose prose-lg max-w-none editorial-content"
                    dangerouslySetInnerHTML={{ __html: casting.description }}
                  />
                </div>

                {/* Character Background */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Character Background</h2>
                  <div 
                    className="editorial-text text-gray-700 leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: casting.characterBackground }}
                  />
                </div>

                {/* Requirements */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Casting Requirements</h2>
                  <ul className="space-y-3">
                    {casting.requirements.map((requirement, index) => (
                      <li key={index} className="flex items-start">
                        <CheckCircle className="h-5 w-5 text-green-500 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{requirement}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Audition Preparation */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Audition Preparation</h2>
                  <ul className="space-y-3">
                    {casting.auditionPreparation.map((prep, index) => (
                      <li key={index} className="flex items-start">
                        <Star className="h-5 w-5 text-yellow-400 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{prep}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* What to Expect */}
                <div>
                  <h2 className="text-3xl cinematic-title mb-6">Audition Process</h2>
                  <ul className="space-y-3">
                    {casting.whatToExpect.map((expectation, index) => (
                      <li key={index} className="flex items-start">
                        <Camera className="h-5 w-5 text-blue-500 mr-3 mt-1 flex-shrink-0" />
                        <span className="editorial-text text-gray-700">{expectation}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Important Notes */}
                <div className="bg-gray-50 p-8 border-l-4 border-black">
                  <h3 className="text-xl font-semibold mb-4">Important Notes</h3>
                  <div className="editorial-text text-gray-600 leading-relaxed space-y-3">
                    <p>• All auditions will be conducted in person at our Jakarta studio</p>
                    <p>• Please arrive 15 minutes early for check-in and preparation</p>
                    <p>• Bring multiple copies of headshots and resume</p>
                    <p>• Be prepared to stay for up to 2 hours if called back</p>
                    <p>• Professional representation is welcome but not required</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Right Column - Application Sidebar */}
            <div className="lg:col-span-4">
              <div className="sticky top-32 space-y-8">
                
                {/* Application Card */}
                <div className="bg-gray-50 p-8">
                  <h3 className="text-2xl font-semibold mb-6">Apply for This Role</h3>
                  
                  <div className="space-y-6">
                    <div className="space-y-4">
                      <div className="flex items-center text-gray-700">
                        <Calendar className="h-5 w-5 mr-3" />
                        <span className="font-medium">Deadline: {casting.auditionDeadline}</span>
                      </div>
                      <div className="flex items-center text-gray-700">
                        <Users className="h-5 w-5 mr-3" />
                        <span className="font-medium">{casting.gender}, {casting.ageRange}</span>
                      </div>
                    </div>
                    
                    <button
                      onClick={handleExternalApplication}
                      className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                    >
                      <span>APPLY TO AUDITION</span>
                      <ExternalLink className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                    </button>
                    
                    <p className="text-center text-gray-500 editorial-text text-sm">
                      Applications are processed via email. Please include headshots, resume, and reel if available.
                    </p>
                  </div>
                </div>

                {/* Related Castings */}
                <div>
                  <h3 className="text-xl font-semibold mb-6">Other Casting Calls</h3>
                  <div className="space-y-4">
                    {relatedCastings.map((relatedCasting, index) => (
                      <Link 
                        key={relatedCasting.id}
                        to={`/casting/${relatedCasting.id}`}
                        className="block p-4 bg-gray-50 hover:bg-gray-100 transition-colors duration-300 group"
                      >
                        <h4 className="font-semibold group-hover:text-gray-600 transition-colors duration-300 mb-2">
                          {relatedCasting.character}
                        </h4>
                        <p className="text-sm text-gray-600 mb-1">{relatedCasting.film}</p>
                        <p className="text-sm text-gray-500">{relatedCasting.ageRange}</p>
                      </Link>
                    ))}
                  </div>
                  
                  <div className="mt-6">
                    <Link 
                      to="/jobs"
                      className="block w-full text-center px-6 py-3 border border-black text-black font-semibold tracking-wide hover:bg-black hover:text-white transition-all duration-300"
                    >
                      VIEW ALL CASTINGS
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

export default CastingDetail;