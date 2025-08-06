import React from 'react';
import { Calendar, User, ArrowRight, Clock } from 'lucide-react';
import { Link } from 'react-router-dom';

const Articles = () => {
  const featuredArticle = {
    id: 'cinematic-storytelling',
    title: "The Evolution of Cinematic Storytelling in the Digital Age",
    excerpt: "Exploring how modern filmmakers are revolutionizing narrative techniques through innovative technology and creative vision, pushing the boundaries of what cinema can achieve.",
    image: "https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=800&h=500&fit=crop",
    author: "Elena Rodriguez",
    date: "March 10, 2024",
    readTime: "8 min read",
    category: "Analysis"
  };

  const articles = [
    {
      id: 'midnight-score',
      title: "Behind the Scenes: Creating Midnight's Atmospheric Score",
      excerpt: "Composer Sarah Chen discusses the creative process behind the haunting melodies that define our latest psychological thriller.",
      image: "https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "Michael Torres",
      date: "March 8, 2024",
      readTime: "5 min read",
      category: "Music"
    },
    {
      id: 'practical-effects',
      title: "The Art of Practical Effects in Modern Cinema",
      excerpt: "Why practical effects still matter in an age of digital dominance and how we blend both worlds seamlessly.",
      image: "https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "David Kim",
      date: "March 5, 2024",
      readTime: "6 min read",
      category: "Production"
    },
    {
      id: 'director-interview',
      title: "Interview: Director's Vision for the Future of Cinema",
      excerpt: "Our creative director shares insights on upcoming projects and the evolving landscape of independent film production.",
      image: "https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "Lisa Wang",
      date: "March 3, 2024",
      readTime: "10 min read",
      category: "Interview"
    },
    {
      id: 'color-grading',
      title: "Color Grading: Painting Emotions Through Light",
      excerpt: "The subtle art of color correction and how it shapes the emotional journey of our characters and stories.",
      image: "https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "James Park",
      date: "February 28, 2024",
      readTime: "7 min read",
      category: "Post-Production"
    },
    {
      id: 'casting-choices',
      title: "Casting Choices: Finding the Perfect Voice",
      excerpt: "Our casting director reveals the process of selecting actors who bring authenticity to every role.",
      image: "https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "Anna Martinez",
      date: "February 25, 2024",
      readTime: "4 min read",
      category: "Casting"
    },
    {
      id: 'sound-design',
      title: "The Sound of Silence: Designing Audio Landscapes",
      excerpt: "How strategic use of silence and ambient sound creates powerful emotional moments in film.",
      image: "https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop",
      author: "Robert Chen",
      date: "February 22, 2024",
      readTime: "6 min read",
      category: "Sound"
    }
  ];

  const getCategoryColor = (category: string) => {
    const colors = {
      'Analysis': 'bg-gray-500 text-white',
      'Music': 'bg-purple-500 text-white',
      'Production': 'bg-blue-500 text-white',
      'Interview': 'bg-green-500 text-white',
      'Post-Production': 'bg-red-500 text-white',
      'Casting': 'bg-yellow-500 text-black',
      'Sound': 'bg-indigo-500 text-white'
    };
    return colors[category as keyof typeof colors] || 'bg-gray-500 text-white';
  };

  return (
    <div className="bg-black text-white">
      {/* Featured Article - Edge to Edge Editorial Layout */}
      <section className="inner-page bg-white text-black container-edge">
        <div className="container-content">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div className="lg:col-span-8 animate-fade-in-left">
              <Link to={`/article/${featuredArticle.id}`} className="group cursor-pointer image-overlay">
                <div className="relative overflow-hidden">
                  <img 
                    src={featuredArticle.image}
                    alt={featuredArticle.title}
                    className="w-full aspect-video object-cover group-hover:scale-110 transition-transform duration-700 gpu-accelerated"
                  />
                  <div className="absolute top-8 left-8">
                    <span className={`px-4 py-2 text-sm font-medium tracking-wide ${getCategoryColor(featuredArticle.category)}`}>
                      Featured Story
                    </span>
                  </div>
                  <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                </div>
              </Link>
            </div>
            
            <div className="lg:col-span-4 flex flex-col justify-center space-y-8 animate-fade-in-right animate-delay-300">
              <div>
                <h2 className="text-4xl md:text-5xl cinematic-title mb-6 leading-tight animate-text-reveal">
                  {featuredArticle.title}
                </h2>
                <p className="text-gray-600 editorial-text mb-6 leading-relaxed text-lg animate-text-reveal animate-delay-200">
                  {featuredArticle.excerpt}
                </p>
              </div>
              
              <div className="flex items-center text-gray-500 space-x-6 animate-fade-in-up animate-delay-400">
                <div className="flex items-center">
                  <User className="h-4 w-4 mr-2" />
                  <span className="text-sm">{featuredArticle.author}</span>
                </div>
                <div className="flex items-center">
                  <Calendar className="h-4 w-4 mr-2" />
                  <span className="text-sm">{featuredArticle.date}</span>
                </div>
                <div className="flex items-center">
                  <Clock className="h-4 w-4 mr-2" />
                  <span className="text-sm">{featuredArticle.readTime}</span>
                </div>
              </div>
              
              <Link 
                to={`/article/${featuredArticle.id}`}
                className="inline-flex items-center text-black font-semibold hover:text-gray-600 transition-colors duration-300 group btn-cinematic animate-scale-in animate-delay-600"
              >
                READ FULL STORY
                <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-2 transition-transform duration-300" />
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Articles Grid - Edge to Edge */}
      <section className="py-32 bg-gray-50 text-black container-edge">
        <div className="container-content">
          <h2 className="text-6xl md:text-7xl cinematic-title mb-20 animate-slide-in-top">All Stories</h2>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 slide-alternate">
            {articles.map((article, index) => (
              <Link 
                key={article.id}
                to={`/article/${article.id}`}
                className="bg-white shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-500 hover-lift hover-tilt"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="relative overflow-hidden image-overlay">
                  <img 
                    src={article.image}
                    alt={article.title}
                    className="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500 gpu-accelerated"
                  />
                  <div className="absolute top-4 left-4">
                    <span className={`px-3 py-1 text-xs font-medium tracking-wide ${getCategoryColor(article.category)}`}>
                      {article.category}
                    </span>
                  </div>
                  <div className="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                </div>
                
                <div className="p-6">
                  <h3 className="text-xl font-semibold mb-3 group-hover:text-gray-600 transition-colors duration-300 leading-tight">
                    {article.title}
                  </h3>
                  
                  <p className="text-gray-600 editorial-text mb-6 leading-relaxed">
                    {article.excerpt}
                  </p>
                  
                  <div className="flex items-center text-gray-500 text-sm mb-4 space-x-4">
                    <div className="flex items-center">
                      <User className="h-4 w-4 mr-1" />
                      <span>{article.author}</span>
                    </div>
                    <div className="flex items-center">
                      <Calendar className="h-4 w-4 mr-1" />
                      <span>{article.date}</span>
                    </div>
                  </div>
                  
                  <div className="flex items-center justify-between">
                    <span className="text-gray-500 text-sm">{article.readTime}</span>
                    <span className="flex items-center text-black font-medium hover:text-gray-600 transition-colors duration-300 group">
                      Read More
                      <ArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" />
                    </span>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Newsletter Signup - Enhanced */}
      <section className="py-32 bg-black container-edge">
        <div className="container-content">
          <div className="max-w-4xl mx-auto text-center animate-zoom-in">
            <h2 className="text-6xl md:text-7xl cinematic-title mb-8 text-white animate-text-reveal">
              Stay in the<br />Conversation
            </h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-300 mb-12 leading-relaxed animate-text-reveal animate-delay-300">
              Get the latest stories, behind-the-scenes content, and industry insights 
              delivered directly to your inbox. Join our community of film enthusiasts.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto animate-scale-in animate-delay-600">
              <input 
                type="email" 
                placeholder="Enter your email"
                className="flex-1 px-6 py-4 bg-white text-black focus:outline-none focus:ring-2 focus:ring-gray-300 editorial-text transition-all duration-300"
              />
              <button className="px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-colors duration-300 btn-cinematic">
                SUBSCRIBE
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Articles;