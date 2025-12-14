import React, { useState } from 'react';
import { ArrowLeft, ArrowRight } from 'lucide-react';

const UpgradeSection: React.FC = () => {
  const [sliderPosition, setSliderPosition] = useState(50);

  const handleMouseMove = (e: React.MouseEvent<HTMLDivElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const percentage = (x / rect.width) * 100;
    setSliderPosition(Math.max(0, Math.min(100, percentage)));
  };

  return (
    <section className="w-full bg-dark py-24 px-6 md:px-12">
      <div className="max-w-4xl mx-auto text-center mb-12">
        <h2 className="font-display text-5xl md:text-6xl italic uppercase leading-none">
          <span className="text-primary block mb-2">Upgrade</span>
          <span className="text-white">Old Bike</span>
        </h2>
        <p className="text-gray-400 mt-6 max-w-sm mx-auto text-sm">
          Upgrade your old bike and give your ride a fresh new life.
        </p>
      </div>

      <div 
        className="relative w-full max-w-6xl mx-auto h-[400px] md:h-[600px] rounded-2xl overflow-hidden bg-gradient-to-b from-[#FDB871] to-[#E96D3B] flex items-center justify-center cursor-ew-resize"
        onMouseMove={handleMouseMove}
      >
        
        {/* Old Bike Image - Full Fill */}
        <div className="absolute inset-0 z-0">
            <img 
              src="/src/images/oldbike.jpeg" 
              alt="Old Bike" 
              className="w-full h-full object-cover"
            />
        </div>

        {/* Vertical White Line */}
        <div 
          className="absolute top-0 bottom-0 w-[3px] bg-white z-10 transition-all duration-100"
          style={{ left: `${sliderPosition}%` }}
        />

        {/* Center UI Element (Slider Handle) */}
        <div 
          className="absolute top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 transition-all duration-100"
          style={{ left: `${sliderPosition}%` }}
        >
           <div className="w-14 h-14 rounded-full bg-white/95 backdrop-blur flex items-center justify-center cursor-pointer hover:scale-110 transition-transform shadow-2xl border-2 border-white">
             <div className="flex gap-1">
               <ArrowLeft size={14} className="text-dark" />
               <ArrowRight size={14} className="text-dark" />
             </div>
           </div>
        </div>

      </div>
    </section>
  );
};

export default UpgradeSection;
