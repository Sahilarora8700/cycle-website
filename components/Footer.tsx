import React from 'react';

const Footer: React.FC = () => {
  return (
    <footer className="w-full bg-dark border-t border-white/10 pt-20 pb-0 overflow-hidden relative">
      <div className="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
        
        {/* Col 1 */}
        <div>
          <h4 className="font-display text-white text-lg uppercase mb-6">About</h4>
          <ul className="space-y-3 text-sm text-gray-400">
            <li><a href="#" className="hover:text-primary transition-colors">Partnership</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Terms of Use</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Privacy</a></li>
          </ul>
        </div>

        {/* Col 2 */}
         <div>
          <h4 className="font-display text-white text-lg uppercase mb-6">Products</h4>
          <ul className="space-y-3 text-sm text-gray-400">
            <li><a href="#" className="hover:text-primary transition-colors">About</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Features</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Support</a></li>
          </ul>
        </div>

        {/* Col 3 */}
         <div>
          <h4 className="font-display text-white text-lg uppercase mb-6">Links</h4>
          <ul className="space-y-3 text-sm text-gray-400">
            <li><a href="#" className="hover:text-primary transition-colors">Home</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Products</a></li>
            <li><a href="#" className="hover:text-primary transition-colors">Gallery</a></li>
          </ul>
        </div>

        {/* Col 4 */}
         <div>
          <h4 className="font-display text-white text-lg uppercase mb-6">Contact</h4>
          <ul className="space-y-3 text-sm text-gray-400">
            <li>info@cyclenbd.com</li>
            <li>+8801680782800</li>
            <li>Los, Angeles, CA</li>
          </ul>
        </div>
      </div>

      {/* Massive Logo */}
      <div className="w-full flex justify-center items-end leading-none select-none pointer-events-none">
        <h1 className="font-display italic font-bold text-primary text-[22vw] uppercase tracking-widest leading-[0.75]">
          CYCLEN
        </h1>
      </div>
      
      {/* Copyright/Bottom Bar */}
      <div className="w-full border-t border-white/5 py-4 text-center">
         <p className="text-gray-600 text-[10px] uppercase tracking-widest">© 2024 Cyclen. All Rights Reserved.</p>
      </div>
    </footer>
  );
};

export default Footer;