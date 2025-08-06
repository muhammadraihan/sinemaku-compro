import React from 'react';
import { Film, Instagram, Twitter, Youtube, Mail } from 'lucide-react';
import { Link } from 'react-router-dom';

const Footer = () => {
  const navigationLinks = [
    { name: 'Home', path: '/' },
    { name: 'Films', path: '/movies' },
    { name: 'Series', path: '/series' },
    { name: 'Shop', path: '/shop' },
    { name: 'Articles', path: '/articles' },
    { name: 'Events', path: '/events' },
    { name: 'Careers', path: '/jobs' },
  ];

  const socialLinks = [
    { icon: Instagram, name: 'Instagram', url: '#' },
    { icon: Youtube, name: 'YouTube', url: '#' },
    { icon: Twitter, name: 'Twitter', url: '#' },
  ];

  return (
    <footer className="bg-black text-white relative overflow-hidden">
      {/* Subtle background pattern */}
      <div className="absolute inset-0 opacity-5">
        <div className="absolute inset-0 bg-gradient-to-br from-gray-800 via-transparent to-gray-900" />
      </div>
      
      <div className="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        {/* Main Footer Content */}
        <div className="py-20 lg:py-24">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            {/* Brand Section */}
            <div className="lg:col-span-5 space-y-8">
              <div className="flex items-center space-x-3 group">
                <Film className="h-10 w-10 text-white group-hover:text-gray-300 transition-colors duration-500" />
                <span className="text-2xl font-bold tracking-tight">SINEMAKU PICTURES</span>
              </div>
              
              <p className="text-gray-400 editorial-text text-lg leading-relaxed max-w-md">
                Creating cinematic experiences that challenge conventions and inspire new perspectives. 
                We are storytellers, dreamers, and rebels with cameras.
              </p>
            </div>

            {/* Navigation Links */}
            <div className="lg:col-span-4 space-y-8">
              <h3 className="text-lg font-semibold text-white">Navigation</h3>
              <div className="grid grid-cols-2 gap-4">
                {navigationLinks.map((link) => (
                  <Link 
                    key={link.name}
                    to={link.path}
                    className="text-gray-400 hover:text-white transition-colors duration-300 editorial-text text-base group"
                  >
                    <span className="group-hover:translate-x-1 transition-transform duration-300 inline-block">
                      {link.name}
                    </span>
                  </Link>
                ))}
              </div>
            </div>

            {/* Contact & Social */}
            <div className="lg:col-span-3 space-y-8">
              <h3 className="text-lg font-semibold text-white">Connect</h3>
              
              {/* Contact Info */}
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <Mail className="h-4 w-4 text-gray-400 flex-shrink-0" />
                  <a 
                    href="mailto:hello@sinemakupictures.com" 
                    className="text-gray-400 hover:text-white transition-colors duration-300 editorial-text"
                  >
                    hello@sinemakupictures.com
                  </a>
                </div>
                <p className="text-gray-500 editorial-text text-sm">
                  Jakarta, Indonesia
                </p>
              </div>

              {/* Social Media */}
              <div className="space-y-4">
                <h4 className="text-base font-medium text-white">Follow Us</h4>
                <div className="flex space-x-4">
                  {socialLinks.map((social) => (
                    <a 
                      key={social.name}
                      href={social.url}
                      className="p-3 bg-gray-900 hover:bg-gray-800 transition-all duration-300 group hover:scale-110"
                      aria-label={social.name}
                    >
                      <social.icon className="h-5 w-5 text-gray-400 group-hover:text-white transition-colors duration-300" />
                    </a>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="border-t border-gray-800 py-8">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div className="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-8">
              <p className="text-gray-500 editorial-text text-sm">
                © 2024 Sinemaku Pictures. All rights reserved.
              </p>
              <div className="flex space-x-6">
                {['Privacy Policy', 'Terms of Service', 'Cookies'].map((item) => (
                  <a 
                    key={item}
                    href="#" 
                    className="text-gray-500 hover:text-gray-300 transition-colors duration-300 editorial-text text-sm"
                  >
                    {item}
                  </a>
                ))}
              </div>
            </div>
            
            {/* Studio Badge */}
            <div className="flex items-center space-x-2 text-gray-600">
              <span className="text-xs editorial-text tracking-wider">EST. 2020</span>
              <div className="w-1 h-1 bg-gray-600 rounded-full" />
              <span className="text-xs editorial-text tracking-wider">JAKARTA</span>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;