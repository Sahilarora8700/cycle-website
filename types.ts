export interface Product {
  id: number;
  name: string;
  category: string;
  price: number;
  image: string;
}

export interface Stat {
  label: string;
  value: string;
  description: string;
}

export interface Service {
  id: string;
  title: string;
  description: string;
  image: string;
}

export interface NavLink {
  label: string;
  href: string;
}