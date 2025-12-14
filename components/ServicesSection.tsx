import React from 'react';
import { SERVICES } from '../constants';

const ServicesSection: React.FC = () => {
  return (
    <section className="w-full bg-dark py-24 px-6 md:px-12 relative overflow-hidden">
      {/* Background decoration */}
      <div className="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-primary/5 to-transparent pointer-events-none" />

      <div className="max-w-7xl mx-auto">
        
        {/* Header */}
        <div className="text-center mb-16">
           <h2 className="font-display text-5xl md:text-6xl italic uppercase leading-none">
             <span className="text-primary block mb-2">Weve Got</span>
             <span className="text-white">You Covered</span>
           </h2>
           <p className="text-gray-400 mt-6 max-w-lg mx-auto text-sm">
             The anticipation is rising, and the thrill is at its peak — our exclusive Bike Lottery is officially kicking off!
           </p>
        </div>

        {/* Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {SERVICES.map((service) => (
            <div key={service.id} className="relative group h-[400px] w-full overflow-hidden border border-white/10 bg-[#111]">
              
              {/* Image Background */}
              <div className="absolute inset-0">
                <img 
                  src={service.image} 
                  alt={service.title} 
                  className="w-full h-full object-cover opacity-60 group-hover:opacity-80 group-hover:scale-110 transition-all duration-700 grayscale group-hover:grayscale-0"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90 group-hover:opacity-70 transition-opacity" />
              </div>

              {/* Content */}
              <div className="absolute inset-0 p-8 flex flex-col justify-between z-10">
                <div className="font-display text-4xl text-white/20 group-hover:text-white transition-colors">
                  {service.id}
                </div>
                
                <div>
                  <h3 className="font-display text-2xl uppercase text-white italic mb-2 translate-y-2 group-hover:translate-y-0 transition-transform">
                    {service.title}
                  </h3>
                  <div className="h-[2px] w-12 bg-primary mb-4 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500" />
                  <p className="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">
                    {service.description}
                  </p>
                </div>
              </div>

              {/* Hover Borders */}
              <div className="absolute inset-0 border border-white/10 pointer-events-none group-hover:border-primary/50 transition-colors duration-500" />
            </div>
          ))}
        </div>

      </div>
    </section>
  );
};

export default ServicesSection;