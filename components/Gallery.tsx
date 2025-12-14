import React from 'react';
import { GALLERY_IMAGES } from '../constants';

const Gallery: React.FC = () => {
  // Duplicate for seamless loop
  const displayImages = [...GALLERY_IMAGES, ...GALLERY_IMAGES];

  return (
    <section className="w-full bg-dark py-24 overflow-hidden" id="gallery">
      {/* Marquee Container */}
      <div className="flex w-full overflow-hidden group">
        <div className="flex gap-4 animate-marquee whitespace-nowrap px-4 w-max hover:[animation-play-state:paused]">
          {displayImages.map((src, index) => (
            <div
              key={index}
              className={`
                relative w-40 md:w-64 h-56 md:h-80 shrink-0 rounded-lg overflow-hidden border-4 border-white shadow-2xl transition-transform hover:z-50 hover:scale-110 duration-300
                ${index % 2 === 0 ? 'rotate-[-6deg] translate-y-4' : 'rotate-[6deg] -translate-y-4'}
              `}
            >
              <img src={src} alt={`Gallery ${index}`} className="w-full h-full object-cover" />

              {/* Overlay */}
              <div className="absolute inset-0 bg-primary/20 hover:bg-transparent transition-colors duration-300"></div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Gallery;