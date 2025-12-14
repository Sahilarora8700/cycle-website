import React from 'react';
import Navbar from './components/Navbar';
import Hero from './components/Hero';
import AboutSection from './components/AboutSection';
import StatsGrid from './components/StatsGrid';
import ServicesSection from './components/ServicesSection';
import MarqueeBar from './components/MarqueeBar';
import HealthyHeart from './components/HealthyHeart';
import ProductGrid from './components/ProductGrid';
import UpgradeSection from './components/UpgradeSection';
import Gallery from './components/Gallery';
import Footer from './components/Footer';

const App: React.FC = () => {
  return (
    <div className="w-full min-h-screen bg-dark flex flex-col font-sans">
      <Navbar />
      <main className="flex-grow">
        <Hero />
        <AboutSection />
        <StatsGrid />
        <ServicesSection />
        <MarqueeBar />
        <HealthyHeart />
        <ProductGrid />
        <UpgradeSection />
        <Gallery />
      </main>
      <Footer />
    </div>
  );
};

export default App;