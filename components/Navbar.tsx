import React from 'react';
import { ShoppingBag, ChevronDown } from 'lucide-react';
import { NAV_LINKS } from '../constants';

const Navbar: React.FC = () => {
  return (
    <nav className="w-full bg-dark/95 backdrop-blur-sm text-white py-4 px-6 md:px-12 fixed top-0 z-50 border-b border-white/10">
      <div className="max-w-7xl mx-auto flex items-center justify-between">
        {/* Logo */}
        <div className="font-display font-bold text-2xl tracking-widest italic">
          CYCLEN.
        </div>

        {/* Links */}
        <div className="hidden md:flex items-center space-x-8">
          {NAV_LINKS.map((link) => (
            <a 
              key={link.label} 
              href={link.href}
              className="text-sm uppercase font-medium tracking-wide text-gray-300 hover:text-primary transition-colors flex items-center gap-1"
            >
              {link.label}
              {link.label === 'All Pages' && <ChevronDown size={14} />}
            </a>
          ))}
        </div>

        {/* Actions */}
        <div className="flex items-center space-x-6">
          <div className="flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
            <ShoppingBag size={18} />
            <span className="text-sm font-medium">Cart-0</span>
          </div>
          <button className="bg-primary hover:bg-orange-700 text-white text-xs font-bold uppercase tracking-wider px-6 py-2.5 transition-all">
            Shop Now
          </button>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;