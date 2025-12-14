import React from 'react';
import { Bike, Mountain, Heart, Zap, Flag } from 'lucide-react';

const ITEMS = [
  { icon: Bike, label: 'CYCLING' },
  { icon: Mountain, label: 'MOUNTAIN' },
  { icon: Heart, label: 'HEALTHY LIFE' },
  { icon: Flag, label: 'ADVANTURE' },
  { icon: Zap, label: 'RIDE' },
  { icon: Zap, label: 'POWER' },
];

const MarqueeBar: React.FC = () => {
  return (
    <div className="w-full bg-[#1a1a1a] border-y border-white/10 py-3 overflow-hidden flex">
      <div className="flex animate-marquee whitespace-nowrap">
        {[...Array(6)].map((_, i) => (
          <div key={i} className="flex items-center shrink-0">
             {ITEMS.map((item, idx) => (
               <div key={idx} className="flex items-center mx-6 md:mx-12">
                 <item.icon size={16} className="text-white mr-3" />
                 <span className="text-white font-display text-sm md:text-base uppercase tracking-widest">{item.label}</span>
               </div>
             ))}
          </div>
        ))}
      </div>
       <style>{`
        @keyframes marquee {
          0% { transform: translateX(0); }
          100% { transform: translateX(-100%); }
        }
        .animate-marquee {
          animation: marquee 30s linear infinite;
        }
      `}</style>
    </div>
  );
};

export default MarqueeBar;