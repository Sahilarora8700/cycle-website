import React from 'react';
import { ArrowRight } from 'lucide-react';
import aboutMoreImg from '../src/images/about_more.jpeg';

const AboutSection: React.FC = () => {
  return (
    <section className="w-full bg-dark py-20 px-6 md:px-12 border-t border-white/5" id="about">
      <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        
        {/* Left - Heading & Image */}
        <div className="relative">
          <h2 className="font-display text-5xl md:text-7xl italic text-primary uppercase mb-6 relative z-20">
            About <span className="text-white ml-2">More</span>
          </h2>
          <div className="relative w-full h-72 md:h-96 rounded overflow-hidden border border-white/10 group">
             <div className="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition-all duration-500 z-10"></div>
             <img 
               src={aboutMoreImg} 
               alt="About Cyclen" 
               className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
             />
          </div>
        </div>

        {/* Right - Text */}
        <div className="flex flex-col items-start space-y-8">
          <p className="text-gray-300 text-lg leading-relaxed font-light border-l-2 border-primary pl-6">
            Fueled by a deep passion for cycling and the thrill of adventure, we bring together a vibrant community of riders who share the same love for exploration and the open road. Our mission is to connect people through unforgettable journeys on two wheels — celebrating freedom, friendship, and the joy of discovering new places together.
          </p>
          
          <button className="group flex items-center gap-3 text-white uppercase text-sm font-bold tracking-widest border border-white/20 px-6 py-3 hover:border-primary hover:bg-primary/10 transition-all">
            About More 
            <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform text-primary" />
          </button>
        </div>

      </div>
    </section>
  );
};

export default AboutSection;