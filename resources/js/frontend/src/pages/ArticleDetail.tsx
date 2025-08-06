import React from 'react';
import { useParams, Link } from 'react-router-dom';
import { Calendar, User, Clock, ArrowLeft, Share2, Bookmark, ArrowRight } from 'lucide-react';

const ArticleDetail = () => {
  const { id } = useParams();

  // Mock article data - in a real app, this would come from an API
  const articleData = {
    'cinematic-storytelling': {
      title: 'The Evolution of Cinematic Storytelling in the Digital Age',
      author: 'Elena Rodriguez',
      publishedDate: 'March 10, 2024',
      readTime: '8 min read',
      category: 'Analysis',
      heroImage: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop',
      excerpt: 'Exploring how modern filmmakers are revolutionizing narrative techniques through innovative technology and creative vision, pushing the boundaries of what cinema can achieve.',
      content: `
        <p class="lead-paragraph">In an era where technology evolves at breakneck speed, the art of cinematic storytelling has undergone a profound transformation. Today's filmmakers are not merely adapting to new tools—they're reimagining the very essence of narrative cinema.</p>

        <p>The digital revolution has democratized filmmaking in ways previously unimaginable. Independent creators now have access to professional-grade equipment and post-production software that was once exclusive to major studios. This shift has led to an explosion of diverse voices and experimental approaches to storytelling.</p>

        <h2>The New Language of Visual Narrative</h2>

        <p>Modern cinema speaks in a language that previous generations of filmmakers could never have conceived. Virtual reality, augmented reality, and interactive media have expanded the boundaries of what constitutes a "film." Directors like Denis Villeneuve and Christopher Nolan continue to push the envelope, creating immersive experiences that blur the line between reality and fiction.</p>

        <blockquote>
          "Cinema is not just about telling stories anymore—it's about creating worlds that audiences can inhabit and explore." 
          <cite>— Elena Rodriguez, Director</cite>
        </blockquote>

        <p>The integration of artificial intelligence in post-production has also opened new creative possibilities. From automated color grading to AI-assisted editing, technology is becoming a collaborative partner in the creative process rather than just a tool.</p>

        <h2>Character Development in the Digital Era</h2>

        <p>Perhaps nowhere is the evolution more evident than in character development. Digital technology allows for unprecedented depth in character creation, from motion capture performances that blur the line between actor and digital avatar to data-driven character arcs that respond to audience engagement.</p>

        <p>The rise of streaming platforms has also fundamentally changed how stories are told. Serialized content allows for character development over extended periods, creating deeper emotional connections between audiences and characters.</p>

        <h2>The Future of Cinematic Expression</h2>

        <p>As we look toward the future, several trends are emerging that will continue to shape cinematic storytelling:</p>

        <ul>
          <li><strong>Immersive Technologies:</strong> VR and AR will create new forms of narrative experience</li>
          <li><strong>AI Collaboration:</strong> Artificial intelligence will become a creative partner in storytelling</li>
          <li><strong>Interactive Narratives:</strong> Audiences will have greater agency in shaping story outcomes</li>
          <li><strong>Global Perspectives:</strong> Digital distribution enables diverse, international voices</li>
        </ul>

        <p>The challenge for contemporary filmmakers is not just to master these new technologies, but to use them in service of meaningful storytelling. The most successful films of the digital age are those that use technology to enhance rather than replace the fundamental human elements of narrative.</p>

        <p>As we continue to push the boundaries of what's possible in cinema, one thing remains constant: the power of a well-told story to move, inspire, and transform audiences. Technology may change the tools we use, but the heart of great filmmaking will always be the human experience.</p>
      `,
      tags: ['Filmmaking', 'Technology', 'Storytelling', 'Digital Cinema'],
      relatedArticles: [
        {
          id: 'midnight-score',
          title: "Behind the Scenes: Creating Midnight's Atmospheric Score",
          excerpt: "Composer Sarah Chen discusses the creative process behind the haunting melodies.",
          image: 'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
          readTime: '5 min read'
        },
        {
          id: 'practical-effects',
          title: "The Art of Practical Effects in Modern Cinema",
          excerpt: "Why practical effects still matter in an age of digital dominance.",
          image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
          readTime: '6 min read'
        },
        {
          id: 'director-interview',
          title: "Interview: Director's Vision for the Future of Cinema",
          excerpt: "Our creative director shares insights on upcoming projects.",
          image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop',
          readTime: '10 min read'
        }
      ]
    }
  };

  const article = articleData[id as keyof typeof articleData] || articleData['cinematic-storytelling'];

  return (
    <div className="bg-white text-black min-h-screen">
      {/* Back Navigation */}
      <div className="pt-32 pb-8">
        <div className="max-w-4xl mx-auto px-6 lg:px-8">
          <Link 
            to="/articles"
            className="inline-flex items-center text-gray-600 hover:text-black transition-colors duration-300 group"
          >
            <ArrowLeft className="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" />
            Back to Articles
          </Link>
        </div>
      </div>

      {/* Article Header */}
      <header className="pb-16">
        <div className="max-w-4xl mx-auto px-6 lg:px-8">
          <div className="space-y-8">
            {/* Category */}
            <span className="inline-block px-4 py-2 bg-black text-white text-sm font-medium tracking-wide">
              {article.category}
            </span>

            {/* Title */}
            <h1 className="text-5xl md:text-6xl cinematic-title leading-tight">
              {article.title}
            </h1>

            {/* Excerpt */}
            <p className="text-xl editorial-text text-gray-600 leading-relaxed max-w-3xl">
              {article.excerpt}
            </p>

            {/* Meta Information */}
            <div className="flex flex-wrap items-center gap-6 text-gray-500 border-b border-gray-200 pb-8">
              <div className="flex items-center">
                <User className="h-4 w-4 mr-2" />
                <span className="editorial-text">{article.author}</span>
              </div>
              <div className="flex items-center">
                <Calendar className="h-4 w-4 mr-2" />
                <span className="editorial-text">{article.publishedDate}</span>
              </div>
              <div className="flex items-center">
                <Clock className="h-4 w-4 mr-2" />
                <span className="editorial-text">{article.readTime}</span>
              </div>
              
              {/* Share Actions */}
              <div className="flex items-center space-x-4 ml-auto">
                <button className="p-2 hover:bg-gray-100 rounded-full transition-colors duration-300">
                  <Share2 className="h-4 w-4" />
                </button>
                <button className="p-2 hover:bg-gray-100 rounded-full transition-colors duration-300">
                  <Bookmark className="h-4 w-4" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </header>

      {/* Hero Image */}
      <div className="mb-16">
        <div className="max-w-6xl mx-auto px-6 lg:px-8">
          <div className="relative overflow-hidden">
            <img 
              src={article.heroImage}
              alt={article.title}
              className="w-full aspect-video object-cover"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent" />
          </div>
        </div>
      </div>

      {/* Article Content */}
      <article className="pb-20">
        <div className="max-w-4xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            {/* Main Content */}
            <div className="lg:col-span-8">
              <div 
                className="prose prose-lg max-w-none editorial-content"
                dangerouslySetInnerHTML={{ __html: article.content }}
              />

              {/* Tags */}
              <div className="mt-16 pt-8 border-t border-gray-200">
                <h3 className="text-lg font-semibold mb-4">Tags</h3>
                <div className="flex flex-wrap gap-3">
                  {article.tags.map((tag, index) => (
                    <span 
                      key={index}
                      className="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium tracking-wide hover:bg-gray-200 transition-colors duration-300 cursor-pointer"
                    >
                      {tag}
                    </span>
                  ))}
                </div>
              </div>
            </div>

            {/* Sidebar */}
            <div className="lg:col-span-4">
              <div className="sticky top-32 space-y-12">
                {/* Author Info */}
                <div className="bg-gray-50 p-8">
                  <h3 className="text-lg font-semibold mb-4">About the Author</h3>
                  <div className="space-y-4">
                    <div className="w-16 h-16 bg-gray-300 rounded-full"></div>
                    <div>
                      <h4 className="font-semibold">{article.author}</h4>
                      <p className="text-gray-600 editorial-text text-sm leading-relaxed">
                        Award-winning director and storyteller with over 15 years of experience 
                        in cinematic arts and digital media production.
                      </p>
                    </div>
                  </div>
                </div>

                {/* Related Articles */}
                <div>
                  <h3 className="text-lg font-semibold mb-6">Related Articles</h3>
                  <div className="space-y-6">
                    {article.relatedArticles.map((related, index) => (
                      <Link 
                        key={related.id}
                        to={`/article/${related.id}`}
                        className="block group hover-lift"
                      >
                        <div className="flex space-x-4">
                          <div className="w-20 h-20 flex-shrink-0 overflow-hidden">
                            <img 
                              src={related.image}
                              alt={related.title}
                              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                          </div>
                          <div className="flex-1">
                            <h4 className="font-semibold text-sm mb-2 group-hover:text-gray-600 transition-colors duration-300 leading-tight">
                              {related.title}
                            </h4>
                            <p className="text-gray-600 editorial-text text-xs mb-2 leading-relaxed">
                              {related.excerpt}
                            </p>
                            <span className="text-gray-500 text-xs">{related.readTime}</span>
                          </div>
                        </div>
                      </Link>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>

      {/* Newsletter Signup */}
      <section className="py-20 bg-black text-white">
        <div className="max-w-4xl mx-auto text-center px-6 lg:px-8">
          <h2 className="text-4xl cinematic-title mb-6">
            Stay Updated
          </h2>
          <p className="text-lg editorial-text text-gray-300 mb-8 leading-relaxed">
            Get the latest articles and insights delivered to your inbox.
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

export default ArticleDetail;