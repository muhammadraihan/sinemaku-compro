import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { 
  Star, 
  ArrowLeft, 
  ArrowRight, 
  Heart, 
  Share2, 
  ZoomIn,
  ChevronLeft,
  ChevronRight,
  X,
  Truck,
  Shield,
  RotateCcw,
  ExternalLink
} from 'lucide-react';

const ProductDetail = () => {
  const { id } = useParams();
  const [selectedImageIndex, setSelectedImageIndex] = useState(0);
  const [isImageModalOpen, setIsImageModalOpen] = useState(false);
  const [isWishlisted, setIsWishlisted] = useState(false);

  // Mock product data - in a real app, this would come from an API
  const productData = {
    'midnight-vinyl': {
      title: 'Midnight Vinyl Collection',
      price: 34.99,
      originalPrice: 44.99,
      rating: 4.8,
      reviews: 127,
      availability: 'In Stock',
      limitedEdition: 'Only 300 Available',
      sku: 'MVC-001-BLK',
      purchaseLink: 'https://tokopedia.com/sinemaku/midnight-vinyl-collection',
      platform: 'Tokopedia',
      images: [
        'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
        'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
        'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
        'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop'
      ],
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">Limited edition vinyl featuring the complete Midnight soundtrack. Hand-numbered, pressed on 180g black vinyl with exclusive artwork and liner notes from composer Elena Rodriguez.</p>
          
          <p>This collector's edition captures the haunting atmosphere of our psychological thriller through carefully mastered audio that brings every subtle detail to life. Each copy is individually numbered and comes with a certificate of authenticity.</p>
          
          <h3>What's Included</h3>
          <ul>
            <li>180g heavyweight vinyl record</li>
            <li>Gatefold sleeve with exclusive artwork</li>
            <li>12-page booklet with liner notes</li>
            <li>Digital download code</li>
            <li>Certificate of authenticity</li>
          </ul>
          
          <h3>Track Listing</h3>
          <ol>
            <li>Opening Theme - 3:42</li>
            <li>City at Night - 4:15</li>
            <li>The Investigation - 5:23</li>
            <li>Memories Fade - 3:58</li>
            <li>Midnight Hour - 6:12</li>
            <li>Resolution - 4:35</li>
          </ol>
          
          <blockquote>
            "Creating the score for Midnight was about finding beauty in darkness. Each track tells part of the story, building an emotional landscape that mirrors the protagonist's journey."
            <cite>— Elena Rodriguez, Composer</cite>
          </blockquote>
        </div>
      `,
      behindProduct: `This design was inspired by our 2024 film "Midnight" - a psychological thriller that explores the boundaries between reality and dreams. The vinyl artwork features original concept art from the film's production, making it a true collector's piece for cinema enthusiasts.`,
      specifications: {
        'Format': '12" LP',
        'Speed': '33 1/3 RPM',
        'Weight': '180g',
        'Color': 'Black',
        'Packaging': 'Gatefold Sleeve',
        'Limited Edition': 'Yes (300 copies)',
        'Release Date': 'March 2024'
      },
      shipping: {
        'Standard Shipping': 'Free (5-7 business days)',
        'Express Shipping': '$9.99 (2-3 business days)',
        'International': 'Calculated at checkout'
      }
    },
    'art-book': {
      title: 'Behind the Lens Art Book',
      price: 39.99,
      originalPrice: 49.99,
      rating: 4.9,
      reviews: 89,
      availability: 'In Stock',
      limitedEdition: 'First Edition',
      sku: 'BTL-001-HB',
      purchaseLink: 'https://shopee.co.id/sinemaku/behind-lens-art-book',
      platform: 'Shopee',
      images: [
        'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
        'https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
        'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop'
      ],
      description: `
        <div class="space-y-6">
          <p class="lead-paragraph">An intimate look at our filmmaking process with exclusive behind-the-scenes photography, concept art, and director's notes from our complete filmography.</p>
          
          <p>This comprehensive art book takes you behind the camera to explore the creative process that brings our stories to life. From initial concept sketches to final frame compositions, discover the artistry and craftsmanship that defines Sinemaku Pictures.</p>
          
          <h3>Features</h3>
          <ul>
            <li>200+ pages of exclusive content</li>
            <li>High-quality art paper printing</li>
            <li>Behind-the-scenes photography</li>
            <li>Director's commentary and insights</li>
            <li>Concept art and storyboards</li>
            <li>Cast and crew interviews</li>
          </ul>
        </div>
      `,
      behindProduct: `This art book represents five years of filmmaking journey, compiled from our archives of production materials, personal notes, and never-before-seen imagery from our film sets.`,
      specifications: {
        'Pages': '224',
        'Dimensions': '9" x 11"',
        'Paper': 'Premium Art Paper',
        'Binding': 'Hardcover',
        'Language': 'English',
        'ISBN': '978-0-123456-78-9',
        'Publisher': 'Sinemaku Pictures'
      },
      shipping: {
        'Standard Shipping': 'Free (3-5 business days)',
        'Express Shipping': '$7.99 (1-2 business days)',
        'International': 'Available'
      }
    }
  };

  const relatedProducts = [
    {
      id: 'director-cut-4k',
      title: "Director's Cut 4K Collection",
      price: 29.99,
      image: 'https://images.pexels.com/photos/2873486/pexels-photo-2873486.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop',
      rating: 4.7
    },
    {
      id: 'studio-tote',
      title: 'Sinemaku Studio Tote',
      price: 24.99,
      image: 'https://images.pexels.com/photos/1656684/pexels-photo-1656684.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop',
      rating: 4.6
    },
    {
      id: 'pin-collection',
      title: 'Film Strip Pin Collection',
      price: 18.99,
      image: 'https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop',
      rating: 4.5
    },
    {
      id: 'digital-pack',
      title: 'Digital Wallpaper Pack',
      price: 4.99,
      image: 'https://images.pexels.com/photos/7991579/pexels-photo-7991579.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop',
      rating: 4.8
    }
  ];

  const product = productData[id as keyof typeof productData] || productData['midnight-vinyl'];

  const handleWishlist = () => {
    setIsWishlisted(!isWishlisted);
  };

  const handleShare = () => {
    if (navigator.share) {
      navigator.share({
        title: product.title,
        text: `Check out this ${product.title} from Sinemaku Pictures`,
        url: window.location.href,
      });
    } else {
      navigator.clipboard.writeText(window.location.href);
    }
  };

  const handleExternalPurchase = () => {
    window.open(product.purchaseLink, '_blank', 'noopener,noreferrer');
  };

  const nextImage = () => {
    setSelectedImageIndex((prev) => (prev + 1) % product.images.length);
  };

  const prevImage = () => {
    setSelectedImageIndex((prev) => (prev - 1 + product.images.length) % product.images.length);
  };

  return (
    <div className="bg-white text-black min-h-screen">
      {/* Back Navigation */}
      <div className="inner-page">
        <div className="max-w-7xl mx-auto px-6 lg:px-8 pb-8">
          <Link 
            to="/shop"
            className="inline-flex items-center text-gray-600 hover:text-black transition-colors duration-300 group"
          >
            <ArrowLeft className="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" />
            Back to Shop
          </Link>
        </div>
      </div>

      {/* Main Product Section */}
      <section className="pb-20">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {/* Left Column - Product Images */}
            <div className="lg:col-span-7">
              {/* Main Image */}
              <div className="relative group mb-6">
                <div 
                  className="aspect-square overflow-hidden cursor-zoom-in"
                  onClick={() => setIsImageModalOpen(true)}
                >
                  <img 
                    src={product.images[selectedImageIndex]}
                    alt={product.title}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                </div>
                
                {/* Image Navigation */}
                {product.images.length > 1 && (
                  <>
                    <button
                      onClick={prevImage}
                      className="absolute left-4 top-1/2 -translate-y-1/2 p-3 bg-white/80 hover:bg-white text-black backdrop-blur-sm transition-all duration-300 opacity-0 group-hover:opacity-100"
                    >
                      <ChevronLeft className="h-5 w-5" />
                    </button>
                    <button
                      onClick={nextImage}
                      className="absolute right-4 top-1/2 -translate-y-1/2 p-3 bg-white/80 hover:bg-white text-black backdrop-blur-sm transition-all duration-300 opacity-0 group-hover:opacity-100"
                    >
                      <ChevronRight className="h-5 w-5" />
                    </button>
                  </>
                )}
                
                {/* Zoom Indicator */}
                <div className="absolute top-4 right-4 p-2 bg-white/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <ZoomIn className="h-4 w-4 text-black" />
                </div>
              </div>
              
              {/* Thumbnail Gallery */}
              {product.images.length > 1 && (
                <div className="flex space-x-4 overflow-x-auto pb-2">
                  {product.images.map((image, index) => (
                    <button
                      key={index}
                      onClick={() => setSelectedImageIndex(index)}
                      className={`flex-shrink-0 w-20 h-20 overflow-hidden border-2 transition-all duration-300 ${
                        index === selectedImageIndex 
                          ? 'border-black' 
                          : 'border-gray-200 hover:border-gray-400'
                      }`}
                    >
                      <img 
                        src={image}
                        alt={`${product.title} ${index + 1}`}
                        className="w-full h-full object-cover"
                      />
                    </button>
                  ))}
                </div>
              )}
            </div>

            {/* Right Column - Product Information */}
            <div className="lg:col-span-5">
              <div className="sticky top-32 space-y-8">
                
                {/* Product Header */}
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
                    {product.limitedEdition && (
                      <span className="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium">
                        {product.limitedEdition}
                      </span>
                    )}
                  </div>
                  
                  <h1 className="text-4xl md:text-5xl cinematic-title leading-tight">
                    {product.title}
                  </h1>
                  
                  {/* Rating */}
                  <div className="flex items-center space-x-4">
                    <div className="flex items-center">
                      {[...Array(5)].map((_, i) => (
                        <Star 
                          key={i} 
                          className={`h-5 w-5 ${i < Math.floor(product.rating) ? 'text-yellow-400 fill-current' : 'text-gray-300'}`} 
                        />
                      ))}
                    </div>
                    <span className="text-gray-600">({product.reviews} reviews)</span>
                  </div>
                  
                  {/* Price */}
                  <div className="flex items-baseline space-x-4">
                    <span className="text-4xl font-light">${product.price}</span>
                    {product.originalPrice && (
                      <span className="text-xl text-gray-500 line-through">${product.originalPrice}</span>
                    )}
                  </div>
                  
                  {/* Availability */}
                  <div className="flex items-center space-x-2">
                    <div className="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span className="text-green-700 font-medium">{product.availability}</span>
                  </div>
                </div>

                {/* External Purchase Button */}
                <div className="space-y-4">
                  <button
                    onClick={handleExternalPurchase}
                    className="w-full flex items-center justify-center px-8 py-4 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-all duration-500 transform hover:scale-105 hover-lift group btn-cinematic"
                  >
                    <span>BUY NOW ON {product.platform.toUpperCase()}</span>
                    <ExternalLink className="ml-3 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
                  </button>
                  
                  {/* Purchase Note */}
                  <p className="text-center text-gray-500 editorial-text text-sm">
                    Purchases are handled via our official store on external platforms.
                  </p>
                </div>

                {/* Product Features */}
                <div className="space-y-4 pt-8 border-t border-gray-200">
                  <div className="flex items-center space-x-3 text-gray-600">
                    <Truck className="h-5 w-5" />
                    <span className="editorial-text">Free shipping on orders over $25</span>
                  </div>
                  <div className="flex items-center space-x-3 text-gray-600">
                    <Shield className="h-5 w-5" />
                    <span className="editorial-text">Secure payment & buyer protection</span>
                  </div>
                  <div className="flex items-center space-x-3 text-gray-600">
                    <RotateCcw className="h-5 w-5" />
                    <span className="editorial-text">30-day return policy</span>
                  </div>
                </div>

                {/* Product Details */}
                <div className="space-y-4 pt-8 border-t border-gray-200">
                  <h3 className="text-lg font-semibold">Product Details</h3>
                  <div className="space-y-2 text-sm text-gray-600">
                    <div className="flex justify-between">
                      <span>SKU:</span>
                      <span>{product.sku}</span>
                    </div>
                    {Object.entries(product.specifications).map(([key, value]) => (
                      <div key={key} className="flex justify-between">
                        <span>{key}:</span>
                        <span>{value}</span>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Product Description */}
      <section className="py-20 bg-gray-50">
        <div className="max-w-4xl mx-auto px-6 lg:px-8">
          <div className="space-y-12">
            <div>
              <h2 className="text-4xl cinematic-title mb-8">About This Product</h2>
              <div 
                className="prose prose-lg max-w-none editorial-content"
                dangerouslySetInnerHTML={{ __html: product.description }}
              />
            </div>

            {/* Behind the Product */}
            {product.behindProduct && (
              <div className="bg-white p-8 border-l-4 border-black">
                <h3 className="text-xl font-semibold mb-4">Behind the Product</h3>
                <p className="editorial-text text-gray-600 leading-relaxed">
                  {product.behindProduct}
                </p>
              </div>
            )}

            {/* Shipping Information */}
            <div>
              <h3 className="text-2xl font-semibold mb-6">Shipping & Returns</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                  <h4 className="font-semibold mb-4">Shipping Options</h4>
                  <div className="space-y-2">
                    {Object.entries(product.shipping).map(([method, details]) => (
                      <div key={method} className="flex justify-between text-sm">
                        <span>{method}:</span>
                        <span className="text-gray-600">{details}</span>
                      </div>
                    ))}
                  </div>
                </div>
                <div>
                  <h4 className="font-semibold mb-4">Return Policy</h4>
                  <p className="text-sm text-gray-600 leading-relaxed">
                    We offer a 30-day return policy for all items in original condition. 
                    Limited edition items may have different return terms.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Related Products */}
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6 lg:px-8">
          <div className="flex justify-between items-end mb-12">
            <h2 className="text-4xl cinematic-title">You Might Also Like</h2>
            <Link 
              to="/shop"
              className="text-lg font-medium hover:text-gray-600 transition-colors duration-300 group"
            >
              View All
              <ArrowRight className="inline ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform duration-300" />
            </Link>
          </div>
          
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {relatedProducts.map((relatedProduct, index) => (
              <Link
                key={relatedProduct.id}
                to={`/product/${relatedProduct.id}`}
                className="group hover-lift"
              >
                <div className="relative overflow-hidden mb-4">
                  <img 
                    src={relatedProduct.image}
                    alt={relatedProduct.title}
                    className="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                </div>
                <div className="space-y-2">
                  <h3 className="font-semibold group-hover:text-gray-600 transition-colors duration-300">
                    {relatedProduct.title}
                  </h3>
                  <div className="flex items-center justify-between">
                    <span className="text-lg font-light">${relatedProduct.price}</span>
                    <div className="flex items-center">
                      <Star className="h-4 w-4 text-yellow-400 fill-current mr-1" />
                      <span className="text-sm text-gray-600">{relatedProduct.rating}</span>
                    </div>
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Image Modal */}
      {isImageModalOpen && (
        <div className="fixed inset-0 z-50 bg-black bg-opacity-90 flex items-center justify-center p-4">
          <div className="relative max-w-4xl max-h-full">
            <button
              onClick={() => setIsImageModalOpen(false)}
              className="absolute top-4 right-4 p-2 bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm transition-all duration-300 z-10"
            >
              <X className="h-6 w-6" />
            </button>
            
            <img 
              src={product.images[selectedImageIndex]}
              alt={product.title}
              className="max-w-full max-h-full object-contain"
            />
            
            {product.images.length > 1 && (
              <>
                <button
                  onClick={prevImage}
                  className="absolute left-4 top-1/2 -translate-y-1/2 p-3 bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm transition-all duration-300"
                >
                  <ChevronLeft className="h-6 w-6" />
                </button>
                <button
                  onClick={nextImage}
                  className="absolute right-4 top-1/2 -translate-y-1/2 p-3 bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm transition-all duration-300"
                >
                  <ChevronRight className="h-6 w-6" />
                </button>
              </>
            )}
          </div>
        </div>
      )}
    </div>
  );
};

export default ProductDetail;