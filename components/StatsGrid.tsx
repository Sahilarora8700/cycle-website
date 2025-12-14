import React from 'react';
import { STATS } from '../constants';

const StatsGrid: React.FC = () => {
  return (
    <section className="w-full bg-dark px-6 md:px-12 pb-24">
      <div className="max-w-7xl mx-auto">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 border border-white/10 bg-[#0f0f0f]">
          {STATS.map((stat, index) => (
            <div 
              key={index} 
              className={`
                p-8 md:p-12 flex flex-col justify-between h-48 md:h-64
                ${index !== STATS.length - 1 ? 'border-b md:border-b-0 md:border-r border-white/10' : ''}
                group hover:bg-[#151515] transition-colors
              `}
            >
              <h3 className="font-display text-4xl md:text-5xl text-white italic mb-4 group-hover:text-primary transition-colors">
                {stat.label}
              </h3>
              <p className="text-gray-500 text-sm leading-relaxed font-medium max-w-[200px]">
                {stat.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default StatsGrid;