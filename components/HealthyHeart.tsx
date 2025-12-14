import React from 'react';
import healthImg from '../src/images/health.jpeg';

const HealthyHeart: React.FC = () => {
  return (
    <section className="w-full bg-dark py-24 px-6 md:px-12">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-12">
          <h2 className="font-display text-4xl md:text-5xl italic uppercase text-primary mb-2">
            Healthy Heart Exercise
          </h2>
          <p className="text-white font-bold tracking-widest text-sm uppercase">
            Ride It To Make It Happen
          </p>
        </div>

        <div className="relative w-full h-64 md:h-[600px] bg-gradient-to-b from-[#ff8555] to-[#ff6b35] rounded-lg overflow-hidden flex items-center justify-center">

          {/* Image - Full Cover */}
          <div className="absolute inset-0 z-0">
            <img
              src={healthImg}
              alt="Cyclist Sprinting"
              className="w-full h-full object-cover"
            />
          </div>

          {/* Big Background Text */}
          <div className="absolute inset-0 flex items-center justify-center overflow-hidden pointer-events-none select-none z-10">
            <span className="font-display text-[20vw] text-white/10 italic leading-none translate-y-10">
              RIDE
            </span>
          </div>

        </div>
      </div>
    </section>
  );
};

export default HealthyHeart;