import React, { useState, useEffect } from 'react';
import { Star, ArrowRight, ChevronLeft, ChevronRight } from 'lucide-react';
import { Link } from 'react-router-dom';

const Shop = () => {
  const [currentProductIndex, setCurrentProductIndex] = useState(0);
  const [isAutoRotating, setIsAutoRotating] = useState(true);

  // All products for the rotator
  const allProducts = [
    {
      id: 'midnight-vinyl',
      title: "Midnight Vinyl Collection",
      image: "https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop",
      price: "$34.99",
      originalPrice: "$44.99",
      description: "Limited edition vinyl featuring the complete Midnight soundtrack. Hand-numbered, pressed on 180g black vinyl with exclusive artwork and liner notes from composer Elena Rodriguez.",
      rating: 4.8,
      reviews: 127,
      badge: "Editor's Pick",
      tagline: "Haunting melodies that define our latest thriller"
    },
    {
      id: 'art-book',
      title: "Behind the Lens Art Book",
      image: "https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop",
      price: "$39.99",
      originalPrice: "$49.99",
      description: "An intimate look at our filmmaking process with exclusive behind-the-scenes photography, concept art, and director's notes from our complete filmography.",
      rating: 4.9,
      reviews: 89,
      badge: "New Release",
      tagline: "The art of cinematic storytelling revealed"
    },
    {
      id: 'director-cut-4k',
      title: "Director's Cut 4K Collection",
      image: "https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop",
      price: "$29.99",
      originalPrice: "$39.99",
      description: "Complete digital collection featuring director's cuts, deleted scenes, and commentary tracks from our award-winning films in stunning 4K resolution.",
      rating: 4.7,
      reviews: 156,
      badge: "Exclusive",
      tagline: "Experience cinema as the director intended"
    },
    {
      id: 'studio-tote',
      title: "Sinemaku Studio Tote",
      image: "https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop",
      price: "$24.99",
      originalPrice: null,
      description: "Premium canvas tote bag featuring our signature logo. Perfect for carrying scripts, books, or everyday essentials. Made from sustainable materials.",
      rating: 4.6,
      reviews: 203,
      badge: "Editor's Pick",
      tagline: "Carry your passion for cinema everywhere"
    },
    {
      id: 'pin-collection',
      title: "Film Strip Pin Collection",
      image: "https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop",
      price: "$18.99",
      originalPrice: null,
      description: "Collectible enamel pins featuring iconic frames from our films. Each set includes 5 unique designs with premium backing cards.",
      rating: 4.5,
      reviews: 94,
      badge: "New Release",
      tagline: "Wearable pieces of cinematic history"
    }
  ];

  // Products for the grid (excluding the currently highlighted one)
  const gridProducts = allProducts.filter((_, index) => index !== currentProductIndex);

  // Auto-rotation effect
  useEffect(() => {
    if (!isAutoRotating) return;

    const interval = setInterval(() => {
      setCurrentProductIndex((prev) => (prev + 1) % allProducts.length);
    }, 7000); // 7 seconds

    return () => clearInterval(interval);
  }, [allProducts.length, isAutoRotating]);

  const handleManualNavigation = (direction: 'prev' | 'next') => {
    setIsAutoRotating(false);
    if (direction === 'prev') {
      setCurrentProductIndex((prev) => (prev - 1 + allProducts.length) % allProducts.length);
    } else {
      setCurrentProductIndex((prev) => (prev + 1) % allProducts.length);
    }
    
    // Resume auto-rotation after 10 seconds of inactivity
    setTimeout(() => setIsAutoRotating(true), 10000);
  };

  const handleDotNavigation = (index: number) => {
    setIsAutoRotating(false);
    setCurrentProductIndex(index);
    setTimeout(() => setIsAutoRotating(true), 10000);
  };

  const getBadgeStyle = (badge: string) => {
    const styles = {
      "Editor's Pick": "bg-black text-white",
      "New Release": "bg-green-600 text-white",
      "Exclusive": "bg-purple-600 text-white",
      "Limited Edition": "bg-red-600 text-white"
    };
    return styles[badge as keyof typeof styles] || "bg-gray-600 text-white";
  };

  const currentProduct = allProducts[currentProductIndex];

  return (
    <div className="bg-black text-white">
      {/* Dynamic Product Highlight Rotator - Edge to Edge */}
      <section className="inner-page bg-white text-black container-edge">
        <div className="container-content">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            {/* Product Image with Navigation */}
            <div className="lg:col-span-7 relative">
              <div className="relative group image-overlay">
                <Link to={`/product/${currentProduct.id}`}>
                  <img 
                    key={currentProductIndex}
                    src={currentProduct.image}
                    alt={currentProduct.title}
                    className="w-full aspect-square object-cover animate-cross-fade gpu-accelerated hover:scale-105 transition-transform duration-700"
                  />
                </Link>
                
                {/* Editorial Badge */}
                <div className="absolute top-8 left-8 animate-fade-in-up animate-delay-300">
                  <span className={`px-4 py-2 text-sm font-medium tracking-wide ${getBadgeStyle(currentProduct.badge)} cinematic-title`}>
                    {currentProduct.badge}
                  </span>
                </div>

                {/* Navigation Arrows */}
                <button
                  onClick={() => handleManualNavigation('prev')}
                  className="absolute left-4 top-1/2 -translate-y-1/2 p-3 bg-black/20 hover:bg-black/40 text-white backdrop-blur-sm transition-all duration-300 opacity-0 group-hover:opacity-100"
                  aria-label="Previous product"
                >
                  <ChevronLeft className="h-6 w-6" />
                </button>
                
                <button
                  onClick={() => handleManualNavigation('next')}
                  className="absolute right-4 top-1/2 -translate-y-1/2 p-3 bg-black/20 hover:bg-black/40 text-white backdrop-blur-sm transition-all duration-300 opacity-0 group-hover:opacity-100"
                  aria-label="Next product"
                >
                  <ChevronRight className="h-6 w-6" />
                </button>

                {/* Dot Navigation */}
                <div className="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3">
                  {allProducts.map((_, index) => (
                    <button
                      key={index}
                      onClick={() => handleDotNavigation(index)}
                      className={`w-3 h-3 rounded-full transition-all duration-300 ${
                        index === currentProductIndex 
                          ? 'bg-black scale-125' 
                          : 'bg-black/30 hover:bg-black/60'
                      }`}
                      aria-label={`Go to product ${index + 1}`}
                    />
                  ))}
                </div>
              </div>
            </div>
            
            {/* Product Details */}
            <div className="lg:col-span-5 space-y-8">
              <div key={`details-${currentProductIndex}`} className="animate-fade-in-right animate-delay-300">
                <h2 className="text-5xl md:text-6xl cinematic-title mb-4 animate-text-reveal">
                  {currentProduct.title}
                </h2>
                
                {currentProduct.tagline && (
                  <p className="text-lg text-gray-500 editorial-text mb-6 italic animate-text-reveal animate-delay-200">
                    {currentProduct.tagline}
                  </p>
                )}
                
                <div className="flex items-center space-x-3 mb-6 animate-fade-in-up animate-delay-400">
                  <div className="flex items-center">
                    {[...Array(5)].map((_, i) => (
                      <Star 
                        key={i} 
                        className={`h-5 w-5 ${i < Math.floor(currentProduct.rating) ? 'text-yellow-400 fill-current' : 'text-gray-300'}`} 
                      />
                    ))}
                  </div>
                  <span className="text-gray-600 editorial-text">({currentProduct.reviews} reviews)</span>
                </div>
                
                <p className="text-gray-600 editorial-text leading-relaxed mb-8 text-lg animate-text-reveal animate-delay-500">
                  {currentProduct.description}
                </p>
              </div>
              
              <div className="space-y-6 animate-scale-in animate-delay-700">
                <div className="flex items-baseline space-x-4">
                  <span className="text-4xl font-light">{currentProduct.price}</span>
                  {currentProduct.originalPrice && (
                    <span className="text-gray-500 line-through text-xl">{currentProduct.originalPrice}</span>
                  )}
                </div>
                
                <div className="flex flex-col gap-4">
                  <Link 
                    to={`/product/${currentProduct.id}`}
                    className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                  >
                    VIEW DETAILS
                    <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-2 transition-transform duration-300" />
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Product Grid - Edge to Edge */}
      <section className="py-32 bg-gray-50 text-black container-edge">
        <div className="container-content">
          <h2 className="text-6xl md:text-7xl cinematic-title mb-20 animate-slide-in-top">More Products</h2>
          
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 grid-stagger">
            {gridProducts.map((product, index) => (
              <Link
                key={`${product.id}-${index}`}
                to={`/product/${product.id}`}
                className="group cursor-pointer hover-lift hover-scale"
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="relative overflow-hidden image-overlay mb-6">
                  <img 
                    src={product.image}
                    alt={product.title}
                    className="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500 gpu-accelerated"
                  />
                  
                  {/* Editorial Badge */}
                  <div className="absolute top-4 left-4">
                    <span className={`px-3 py-1 text-xs font-medium tracking-wide ${getBadgeStyle(product.badge)}`}>
                      {product.badge}
                    </span>
                  </div>
                  
                  <div className="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                  
                  {/* Hover overlay with view details text */}
                  <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div className="bg-white/90 backdrop-blur-sm px-6 py-3 rounded-full">
                      <span className="text-black font-medium text-sm">View Details</span>
                    </div>
                  </div>
                </div>
                
                <div className="space-y-3">
                  <h3 className="text-lg font-semibold group-hover:text-gray-600 transition-colors duration-300 leading-tight">
                    {product.title}
                  </h3>
                  
                  <div className="flex items-center space-x-2 mb-2">
                    <div className="flex items-center">
                      {[...Array(5)].map((_, i) => (
                        <Star 
                          key={i} 
                          className={`h-3 w-3 ${i < Math.floor(product.rating) ? 'text-yellow-400 fill-current' : 'text-gray-300'}`} 
                        />
                      ))}
                    </div>
                    <span className="text-xs text-gray-500">({product.reviews})</span>
                  </div>
                  
                  <div className="flex items-center justify-between">
                    <div className="flex items-baseline space-x-2">
                      <span className="text-xl font-light">{product.price}</span>
                      {product.originalPrice && (
                        <span className="text-sm text-gray-500 line-through">{product.originalPrice}</span>
                      )}
                    </div>
                    <span className="text-sm text-gray-600 group-hover:text-black transition-colors duration-300">
                      View Details →
                    </span>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Digital Collection - Enhanced */}
      <section className="py-32 bg-black container-edge">
        <div className="container-content">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <div className="lg:col-span-5 space-y-8 animate-fade-in-left">
              <h2 className="text-6xl md:text-7xl cinematic-title text-white animate-text-reveal">
                Digital<br />Collection
              </h2>
              <p className="text-gray-300 editorial-text leading-relaxed text-lg animate-text-reveal animate-delay-300">
                Access our exclusive digital archive featuring high-resolution stills, 
                concept art, behind-the-scenes content, and director's commentary from 
                our complete filmography.
              </p>
              <Link
                to="/product/digital-pack"
                className="inline-flex items-center px-8 py-4 bg-white text-black font-semibold tracking-wide hover:bg-gray-100 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic animate-scale-in animate-delay-600"
              >
                BROWSE DIGITAL
                <ArrowRight className="ml-3 h-5 w-5 group-hover:translate-x-2 transition-transform duration-300" />
              </Link>
            </div>
            
            <div className="lg:col-span-7 animate-fade-in-right animate-delay-400">
              <div className="relative group image-overlay">
                <img 
                  src="https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                  alt="Digital Collection"
                  className="w-full aspect-video object-cover group-hover:scale-110 transition-transform duration-700 gpu-accelerated"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent" />
                
                {/* Floating elements */}
                <div className="absolute top-8 right-8 animate-float-in animate-delay-800">
                  <div className="bg-white/10 backdrop-blur-sm px-4 py-2 text-white text-sm font-medium">
                    4K Resolution
                  </div>
                </div>
                <div className="absolute bottom-8 left-8 animate-float-in animate-delay-1000">
                  <div className="bg-white/10 backdrop-blur-sm px-4 py-2 text-white text-sm font-medium">
                    Exclusive Content
                  </div>
                </div>
                <div className="absolute top-1/2 right-16 animate-float-in animate-delay-1200">
                  <div className="bg-white/10 backdrop-blur-sm px-4 py-2 text-white text-sm font-medium">
                    Director's Commentary
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Newsletter Signup */}
      <section className="py-32 bg-white text-black container-edge">
        <div className="container-content">
          <div className="max-w-4xl mx-auto text-center animate-zoom-in">
            <h2 className="text-6xl md:text-7xl cinematic-title mb-8 animate-text-reveal">
              Never Miss<br />a Release
            </h2>
            <p className="text-xl md:text-2xl editorial-text text-gray-600 mb-12 leading-relaxed animate-text-reveal animate-delay-300">
              Be the first to know about new merchandise drops, limited editions, 
              and exclusive member discounts from Sinemaku Pictures.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto animate-scale-in animate-delay-600">
              <input 
                type="email" 
                placeholder="Enter your email"
                className="flex-1 px-6 py-4 bg-gray-100 text-black focus:outline-none focus:ring-2 focus:ring-black focus:bg-white transition-all duration-300 editorial-text"
              />
              <button className="px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-colors duration-300 btn-cinematic">
                SUBSCRIBE
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Shop;