import React from "react";
import heroSection from "../src/images/hero section.jpeg";
import hero2 from "../src/images/hero2.jpeg";

const Hero: React.FC = () => {
  return (
    <section className="relative w-full h-screen min-h-[600px] overflow-hidden bg-black text-white flex flex-col justify-center">

      {/* Background Image */}
      <div className="absolute inset-0 z-0">
        <img
          src={heroSection}
          alt="Hero Bike Background"
          className="w-full h-full object-cover object-[center_30%] brightness-75 contrast-105"
        />
        <div className="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
      </div>

      {/* Main Content Container */}
      <div className="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-12 flex flex-col justify-center h-full">

        {/* Title Section */}
        <div className="mb-8 md:mb-0">
          <div className="flex items-center gap-4 mb-2">
            <div className="h-[2px] w-8 md:w-12 bg-white/80"></div>
            <h3 className="uppercase font-bold text-[3vw] md:text-base tracking-[0.35em] text-white">
              Let's Ride The
            </h3>
          </div>

          <h1 className="font-display italic font-extrabold text-white text-[13vw] md:text-7xl lg:text-8xl leading-none tracking-wider drop-shadow-2xl">
            ADVANTURE
          </h1>
        </div>

        {/* Feature Dots (Hidden on small mobile, visible on md+) */}
        {/* Seat Dot */}
        <div className="absolute top-[17.7%] right-[13.4%] hidden md:flex items-center gap-4">
          <div className="w-5 h-5 rounded-full bg-[#ff6b35] border-[3px] border-white relative">
            <div className="absolute -inset-1.5 rounded-full border border-white/20"></div>
          </div>
          <div className="w-20 h-[2px] bg-white/90"></div>
          <div className="uppercase font-bold text-xs tracking-widest">Protection</div>
        </div>

        {/* Frame Dot */}
        <div className="absolute top-[51%] right-[36.1%] hidden md:block">
          <div className="w-5 h-5 rounded-full bg-[#ff6b35] border-[3px] border-white"></div>
        </div>

        {/* Wheels Dot */}
        <div className="absolute bottom-[28.9%] right-[21.9%] hidden md:block">
          <div className="w-5 h-5 rounded-full bg-[#ff6b35] border-[3px] border-white"></div>
        </div>


        {/* Feature Boxes */}
        <div className="absolute bottom-10 left-6 right-6 md:left-12 md:right-12 flex flex-col md:flex-row justify-between items-end gap-6">

          {/* Left Feature Card */}
          <div className="bg-black/40 backdrop-blur-md border border-white/10 p-3 rounded-xl flex items-center gap-4 max-w-sm">
            <img
              src={hero2}
              alt="Cyclist thumb"
              className="w-16 h-16 rounded-lg object-cover border border-white/10"
            />
            <div>
              <h4 className="uppercase font-extrabold text-sm tracking-wide">
                High-Quality Materials
              </h4>
              <p className="text-gray-300 text-xs mt-1">
                Premium materials and advanced build for lasting durability.
              </p>
            </div>
          </div>

          {/* Right Text (Hidden on very small screens) */}
          <div className="hidden md:block text-left max-w-xs text-gray-200">
            <h4 className="uppercase font-bold text-sm">Since It's More</h4>
            <p className="text-xs mt-1 leading-relaxed">
              In general, mountain bike<br />
              provide more significant<br />
              protection.
            </p>
          </div>

        </div>

      </div>
    </section>
  );
};

export default Hero;
