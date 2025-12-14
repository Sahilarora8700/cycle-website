import { Product, Service, Stat, NavLink } from './types';

export const NAV_LINKS: NavLink[] = [
  { label: 'About Us', href: '#about' },
  { label: 'Membership', href: '#membership' },
  { label: 'Events', href: '#events' },
  { label: 'All Pages', href: '#pages' },
];

export const STATS: Stat[] = [
  { label: '4.9', value: '4.9', description: 'Designed and fabricated with passion.' },
  { label: '10k', value: '10k', description: 'Built a reputation for precision and power.' },
  { label: 'NO.1', value: 'NO.1', description: 'Each one unique, bold, and road-ready.' },
  { label: '8+', value: '8+', description: 'Delivering neon performance worldwide.' },
];

export const SERVICES: Service[] = [
  {
    id: '01',
    title: 'Organize Cycling',
    description: 'Get your ride delivered to your doorstep with no extra cost.',
    image: '/src/images/feature1.jpeg'
  },
  {
    id: '02',
    title: 'ON-Demand Repair',
    description: 'Access local partner mechanics for quick servicing.',
    image: '/src/images/feature2.jpeg'
  },
  {
    id: '03',
    title: 'Lifetime Warranty',
    description: 'Confidence that lasts, we back our frames for life.',
    image: '/src/images/feature3.jpeg'
  }
];

export const PRODUCTS: Product[] = [
  {
    id: 1,
    name: 'VeloStrive X1',
    category: 'Town Bike',
    price: 1500,
    image: '/src/images/c1.jpeg'
  },
  {
    id: 2,
    name: 'AeroBlaze Pro',
    category: 'Racing Bike',
    price: 1700,
    image: '/src/images/c2.jpeg'
  },
  {
    id: 3,
    name: 'UrbanEdge 500',
    category: 'City Bike',
    price: 2200,
    image: '/src/images/c3.jpeg'
  },
  {
    id: 4,
    name: 'NeonPulse R8',
    category: 'Luxury Bike',
    price: 1800,
    image: '/src/images/c4.jpeg'
  },
  {
    id: 5,
    name: 'FeltHawk A3',
    category: 'Town Bike',
    price: 1200,
    image: '/src/images/c5.jpeg'
  },
  {
    id: 6,
    name: 'TurboRush GT',
    category: 'Racing Bike',
    price: 2000,
    image: '/src/images/c6.jpeg'
  },
];

export const GALLERY_IMAGES = [
  "/src/images/d1.jpeg",
  "/src/images/d2.jpeg",
  "/src/images/d3.jpeg",
  "/src/images/d4.jpeg",
  "/src/images/d5.jpeg",
  "/src/images/d6.jpeg"
];
