import React from 'react';
import { ArrowUpRight } from 'lucide-react';
import { PRODUCTS } from '../constants';

const ProductGrid: React.FC = () => {
  return (
    <section className="w-full bg-dark py-24 px-6 md:px-12" id="shop">
      <div className="max-w-7xl mx-auto">

        {/* Header */}
        <div className="text-center mb-20">
          <h2 className="font-display text-4xl md:text-7xl italic uppercase leading-none mb-4">
            <span className="text-primary block">Get Your</span>
            <span className="text-white">Dream Cycle</span>
          </h2>
          <p className="text-gray-400 text-sm max-w-md mx-auto">
            Get your dream cycle and start your journey with freedom and excitement.
          </p>
        </div>

        {/* Products */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {PRODUCTS.map((product) => (
            <div key={product.id} className="group relative bg-[#111] border border-white/5 overflow-hidden">

              {/* Image Area */}
              <div className="h-72 md:h-96 overflow-hidden relative flex items-center justify-center bg-gradient-to-b from-[#151515] to-[#111]">
                <img
                  src={product.image}
                  alt={product.name}
                  className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                />
                {/* Decorative Grid Lines inside card */}
                <div className="absolute top-4 left-4 w-2 h-2 border-t border-l border-white/20"></div>
                <div className="absolute top-4 right-4 w-2 h-2 border-t border-r border-white/20"></div>
              </div>

              {/* Info Area */}
              <div className="p-6 relative">
                <div className="flex justify-between items-end">
                  <div>
                    <h3 className="font-display text-white text-xl uppercase italic mb-1 group-hover:text-primary transition-colors">
                      {product.name}
                    </h3>
                    <p className="text-gray-500 text-xs uppercase tracking-wider">
                      {product.category}
                    </p>
                  </div>

                  <div className="text-right">
                    <span className="font-display text-primary text-lg italic">
                      ${product.price}
                    </span>
                  </div>
                </div>

                {/* Hover Action */}
                <div className="mt-4 flex justify-end">
                  <button className="w-8 h-8 bg-white text-dark flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                    <ArrowUpRight size={18} />
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>

      </div>
    </section>
  );
};

export default ProductGrid;