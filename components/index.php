<?php
error_reporting(0);
ini_set('display_errors', 0);

// Start session to track the login status
session_start();

// Primary database connection for the landing page
require_once __DIR__ . '/includes/db.php';

// Check if user is logged in (session variable set after login or signup)
$isLoggedIn   = isset($_SESSION['user_id']); // Assuming 'user_id' is stored in session after login/signup
$profilePhoto = isset($_SESSION['profile_photo']) ? $_SESSION['profile_photo'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="icon" type="image/png" href="favicon.png">
  <title>University Updates - Your Complete Academic Hub</title>
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <style>
    /* Modern CSS Reset and Base Styles */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Extra small device breakpoint */
    @media (min-width: 480px) {
      .xs\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    :root {
      --primary-color: #6366F1;
      --primary-light: #DBEAFE;
      --primary-dark: #312E81;
      --secondary-color: #0EA5E9;
      --accent-color: #22D3EE;
      --neon-pink: #F472B6;
      --text-primary: #0F172A;
      --text-secondary: #475569;
      --background-light: #EEF2FF;
      --ai-gradient: linear-gradient(120deg, #312E81 0%, #4338CA 20%, #2563EB 50%, #0EA5E9 80%, #22D3EE 100%);
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
      overflow-x: hidden;
      background: #ffffff;
      color: #1a202c;
      line-height: 1.6;
      min-height: 100vh;
    }

    html, body {
      max-width: 100vw;
      overflow-x: hidden;
    }

    * {
      box-sizing: border-box;
    }

    /* Ensure all links are clickable */
    a {
      cursor: pointer !important;
      pointer-events: auto !important;
      text-decoration: none;
    }

    footer a {
      cursor: pointer !important;
      pointer-events: auto !important;
    }

    footer a:active {
      color: #a3e635 !important;
    }

    body.mobile-performance {
      background: #020617;
    }

    body.mobile-menu-open {
      overflow: hidden;
    }

    body.mobile-performance .hero-section {
      animation: none;
      background: linear-gradient(180deg, rgba(2,6,23,0.98), rgba(2,6,23,0.85));
    }

    body.mobile-performance .hero-aurora,
    body.mobile-performance .hero-grid-overlay,
    body.mobile-performance .hero-section::before,
    body.mobile-performance .hero-section::after {
      opacity: 0.2;
      animation: none !important;
      filter: blur(20px);
      display: none;
    }

    body.mobile-performance .tech-logos-track,
    body.mobile-performance .testimonial-track {
      animation-duration: 60s !important;
      will-change: transform;
    }

    body.mobile-performance .feature-card,
    body.mobile-performance .team-card,
    body.mobile-performance .testimonial-card {
      transform: none !important;
      transition: none !important;
      will-change: auto;
    }

    body.mobile-performance * {
      transition-duration: 0.15s !important;
      animation-duration: 0.5s !important;
    }

    body.mobile-performance .ai-header {
      background: rgba(3, 7, 18, 0.95);
      border-color: rgba(14, 165, 233, 0.25);
      box-shadow: 0 8px 30px rgba(2, 6, 23, 0.8);
      backdrop-filter: blur(10px);
    }

    body.mobile-performance .ai-header::before {
      opacity: 0.2;
    }

    body.mobile-performance .feature-card,
    body.mobile-performance .team-card,
    body.mobile-performance .testimonial-card,
    body.mobile-performance .paper-card,
    body.mobile-performance .ai-card {
      backdrop-filter: none !important;
      border-color: rgba(148, 163, 184, 0.15) !important;
      box-shadow: 0 8px 20px rgba(2, 6, 23, 0.5);
    }

    body.mobile-performance .tech-logos-track,
    body.mobile-performance .testimonial-track {
      animation-duration: 32s !important;
    }

    body.mobile-performance .testimonial-track.reverse {
      animation-duration: 32s !important;
    }
    
    /* Remove outline on all interactive elements when clicked */
    a:focus, button:focus, input:focus, select:focus, textarea:focus {
      outline: none !important;
      box-shadow: none !important;
    }

    .gradient-bg {
      background: radial-gradient(circle at 15% 20%, rgba(99,102,241,0.25), transparent 45%), radial-gradient(circle at 80% 0%, rgba(14,165,233,0.25), transparent 40%), linear-gradient(135deg, #050b1d 0%, #0b1229 35%, #0f172a 70%, #111827 100%);
      position: relative;
      color: #e2e8f0;
    }

    .gradient-bg::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,%3Csvg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%230ea5e9" fill-opacity="0.08"%3E%3Cpath d="M12 1l2.09 6.41H20l-5.17 3.76 1.98 6.83L12 14.77l-5.81 3.23 1.98-6.83L3 7.41h5.91z"/%3E%3C/g%3E%3C/svg%3E');
      opacity: 0.35;
      z-index: 0;
    }

    .hero-section {
      background: radial-gradient(circle at 20% 20%, rgba(99,102,241,0.15), transparent 45%), radial-gradient(circle at 80% 0%, rgba(14,165,233,0.2), transparent 40%), linear-gradient(180deg, rgba(5,11,29,0) 0%, rgba(5,11,29,0.95) 80%);
      background-size: 140% 140%;
      animation: heroBackgroundFlow 24s ease-in-out infinite alternate;
    }

    .hero-section::before,
    .hero-section::after {
      content: '';
      position: absolute;
      inset: -20%;
      background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 55%);
      filter: blur(120px);
      opacity: 0.6;
      animation: pulseGlow 12s ease-in-out infinite alternate;
      pointer-events: none;
    }

    .hero-section::after {
      animation-delay: 3s;
      background: radial-gradient(circle, rgba(14,165,233,0.3) 0%, transparent 55%);
    }

    .hero-grid-overlay {
      position: absolute;
      inset: 0;
      background-image: linear-gradient(rgba(148,163,184,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,0.08) 1px, transparent 1px);
      background-size: 80px 80px;
      mask-image: radial-gradient(circle at center, rgba(255,255,255,0.9), transparent 65%);
      pointer-events: none;
      z-index: -1;
    }

    .hero-aurora {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 30% 20%, rgba(14,165,233,0.25), transparent 45%), radial-gradient(circle at 70% 10%, rgba(244,113,181,0.18), transparent 50%);
      filter: blur(60px);
      opacity: 0.8;
      animation: auroraShift 15s ease-in-out infinite alternate;
      pointer-events: none;
      will-change: transform, opacity;
    }

    @media (min-width: 1024px) {
      .hero-section {
        background:
          radial-gradient(circle at 15% 25%, rgba(59,130,246,0.25), transparent 45%),
          radial-gradient(circle at 75% 0%, rgba(147,51,234,0.18), transparent 40%),
          linear-gradient(140deg, rgba(15,23,42,0.95) 0%, rgba(2,6,23,0.85) 60%, rgba(2,6,23,0.65) 100%);
        background-size: 150% 150%;
      }

      .hero-section::before,
      .hero-section::after {
        opacity: 0.8;
        filter: blur(140px);
      }

      .hero-grid-overlay {
        mask-image: radial-gradient(circle at 40% 30%, rgba(255,255,255,0.9), transparent 68%);
        background-size: 120px 120px;
      }

      .hero-aurora {
        opacity: 0.95;
        filter: blur(80px);
      }

      .tech-logos-track {
        animation-duration: 26s;
      }

      .testimonial-track,
      .testimonial-track.reverse {
        animation-duration: 24s;
      }
    }

    @keyframes pulseGlow {
      from {
        transform: scale(0.9);
        opacity: 0.4;
      }
      to {
        transform: scale(1.1);
        opacity: 0.8;
      }
    }

    @keyframes auroraShift {
      from {
        transform: translateY(-20px) rotate(0deg);
      }
      to {
        transform: translateY(20px) rotate(5deg);
      }
    }

    @keyframes heroBackgroundFlow {
      0% {
        background-position: 0% 0%;
      }
      50% {
        background-position: 45% 40%;
      }
      100% {
        background-position: 0% 75%;
      }
    }

    /* Responsive Container */
    .container {
      width: 100%;
      margin-right: auto;
      margin-left: auto;
      padding-right: 1rem;
      padding-left: 1rem;
      overflow-x: hidden;
    }

    .ai-gradient-text {
      background: linear-gradient(120deg, #a855f7 0%, #6366f1 35%, #0ea5e9 65%, #22d3ee 100%);
      -webkit-background-clip: text;
      color: transparent;
    }

    .ai-badge {
      background: rgba(15, 23, 42, 0.6);
      border: 1px solid rgba(34, 211, 238, 0.4);
      box-shadow: 0 10px 30px rgba(14, 165, 233, 0.15);
    }

    .ai-button-primary {
      background: linear-gradient(120deg, #7c3aed 0%, #6366f1 30%, #0ea5e9 70%, #22d3ee 100%);
      color: #fff;
      box-shadow: 0 15px 40px rgba(14, 165, 233, 0.35);
      border: none;
      will-change: transform;
      backface-visibility: hidden;
      -webkit-font-smoothing: antialiased;
    }

    .ai-button-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 45px rgba(14, 165, 233, 0.4);
    }

    .ai-button-primary:active {
      transform: translateY(0);
    }

    .ai-button-secondary {
      background: rgba(15, 23, 42, 0.55);
      color: #E0F2FE;
      border: 1px solid rgba(224, 242, 254, 0.4);
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.3);
    }

    .ai-button-secondary:hover {
      background: rgba(15, 23, 42, 0.75);
      border-color: rgba(34, 211, 238, 0.6);
      color: #fff;
    }

    .ai-card {
      background: rgba(15, 23, 42, 0.82);
      border: 1px solid rgba(99, 102, 241, 0.25);
      border-radius: 1.5rem;
      padding: 1.5rem;
      box-shadow: 0 25px 50px rgba(2, 8, 23, 0.55);
      backdrop-filter: blur(18px);
      color: #E2E8F0;
    }

    .ai-card h3 {
      color: #F8FAFF;
    }

    .ai-card p {
      color: #c7d2fe;
    }

    .ai-icon {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.95), rgba(14, 165, 233, 0.9));
      box-shadow: 0 15px 40px rgba(14, 165, 233, 0.35);
    }

    .feature-card {
      background: rgba(15, 23, 42, 0.75) !important;
      border: 1px solid rgba(14, 165, 233, 0.25) !important;
      box-shadow: 0 20px 45px rgba(2, 6, 23, 0.45);
      color: #E2E8F0;
      backdrop-filter: blur(10px);
    }

    .feature-card h3 {
      color: #F8FAFF !important;
    }

    .feature-card p {
      color: #cdd8ff !important;
    }

    /* Tech Logos Marquee */
    .tech-logos-section {
      position: relative;
      overflow: hidden;
      width: 100%;
      background: transparent;
      padding: 2rem 0 3rem 0;
      margin-top: -1rem;
    }

    .tech-marquee-wrapper {
      position: relative;
      overflow: hidden;
      mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
      -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
    }

    .tech-logos-track {
      display: flex;
      gap: 4rem;
      animation: logoScroll 30s linear infinite;
      width: max-content;
      align-items: center;
      padding: 1rem 0;
      will-change: transform;
    }

    .tech-logo-item {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .tech-logo-item i {
      font-size: 4rem;
      opacity: 0.85;
      transition: opacity 0.3s ease, transform 0.3s ease, filter 0.3s ease;
    }

    .tech-marquee-wrapper:hover .tech-logos-track {
      animation-play-state: paused;
    }

    .tech-logo-item:hover i {
      opacity: 1;
      transform: scale(1.15);
      filter: drop-shadow(0 0 20px currentColor);
    }

    @keyframes logoScroll {
      0% { transform: translate3d(0, 0, 0); }
      100% { transform: translate3d(-50%, 0, 0); }
    }

    @media (max-width: 768px) {
      .tech-logos-track {
        animation-duration: 40s;
        gap: 3rem;
      }
      .tech-logo-item i {
        font-size: 3rem;
      }
    }

    @media (max-width: 480px) {
      .tech-logos-track {
        gap: 2.5rem;
      }
      .tech-logo-item i {
        font-size: 2.5rem;
      }
    }

    /* Testimonials Section */
    .testimonials-section {
      position: relative;
      overflow: hidden;
      background: linear-gradient(180deg, #0f172a 0%, #0b1229 50%, #050816 100%);
      width: 100%;
      max-width: 100vw;
    }

    .testimonials-section::before,
    .testimonials-section::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      border-radius: 999px;
      filter: blur(140px);
      opacity: 0.3;
      pointer-events: none;
    }

    .testimonials-section::before {
      top: -100px;
      left: -120px;
      background: rgba(99, 102, 241, 0.5);
    }

    .testimonials-section::after {
      bottom: -100px;
      right: -120px;
      background: rgba(14, 165, 233, 0.5);
    }

    .testimonial-marquee {
      overflow: hidden;
      mask-image: linear-gradient(to right, transparent, rgba(0,0,0,0.85) 12%, rgba(0,0,0,0.85) 88%, transparent);
      width: 100%;
      max-width: 100vw;
    }

    .testimonial-track {
      display: flex;
      gap: 1.5rem;
      width: max-content;
      animation: testimonials-left 30s linear infinite;
      will-change: transform;
    }

    .testimonial-track.reverse {
      animation-name: testimonials-right;
    }

    .testimonial-marquee:hover .testimonial-track {
      animation-play-state: paused;
    }

    @keyframes testimonials-left {
      0% { transform: translate3d(0, 0, 0); }
      100% { transform: translate3d(-50%, 0, 0); }
    }

    @keyframes testimonials-right {
      0% { transform: translate3d(-50%, 0, 0); }
      100% { transform: translate3d(0, 0, 0); }
    }

    .testimonial-card {
      width: clamp(280px, 32vw, 400px);
      min-height: 220px;
      border-radius: 1.5rem;
      padding: 2rem;
      box-shadow: 0 25px 60px rgba(2, 6, 23, 0.6);
      position: relative;
      overflow: hidden;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      background: rgba(15, 23, 42, 0.85) !important;
      border: 1px solid rgba(99, 102, 241, 0.2);
      backdrop-filter: blur(16px);
    }

    .testimonial-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 30px 70px rgba(2, 6, 23, 0.7);
      border-color: rgba(14, 165, 233, 0.4);
    }

    .testimonial-card .quote-icon {
      font-size: 2.5rem;
      opacity: 0.15;
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      color: #22d3ee;
    }

    .testimonial-card h4 {
      font-size: 1.05rem;
      margin-top: 1.5rem;
      font-weight: 700;
      color: #f8fafc;
    }

    .testimonial-card p {
      font-size: 1rem;
      line-height: 1.7;
      margin-bottom: 1.5rem;
      color: #cbd5e1;
    }

    .testimonial-meta {
      font-size: 0.875rem;
      opacity: 0.8;
      color: #94a3b8;
    }

    /* Testimonial Card Color Themes */
    .card-lilac {
      background: linear-gradient(135deg, rgba(168, 85, 247, 0.12), rgba(139, 92, 246, 0.08)) !important;
      border-color: rgba(168, 85, 247, 0.3) !important;
    }

    .card-sunset {
      background: linear-gradient(135deg, rgba(251, 146, 60, 0.12), rgba(249, 115, 22, 0.08)) !important;
      border-color: rgba(251, 146, 60, 0.3) !important;
    }

    .card-mint {
      background: linear-gradient(135deg, rgba(52, 211, 153, 0.12), rgba(16, 185, 129, 0.08)) !important;
      border-color: rgba(52, 211, 153, 0.3) !important;
    }

    .card-sky {
      background: linear-gradient(135deg, rgba(56, 189, 248, 0.12), rgba(14, 165, 233, 0.08)) !important;
      border-color: rgba(56, 189, 248, 0.3) !important;
    }

    .card-rose {
      background: linear-gradient(135deg, rgba(244, 114, 182, 0.12), rgba(236, 72, 153, 0.08)) !important;
      border-color: rgba(244, 114, 182, 0.3) !important;
    }

    .card-blush {
      background: linear-gradient(135deg, rgba(251, 191, 36, 0.12), rgba(245, 158, 11, 0.08)) !important;
      border-color: rgba(251, 191, 36, 0.3) !important;
    }

    .card-lagoon {
      background: linear-gradient(135deg, rgba(20, 184, 166, 0.12), rgba(13, 148, 136, 0.08)) !important;
      border-color: rgba(20, 184, 166, 0.3) !important;
    }

    .card-periwinkle {
      background: linear-gradient(135deg, rgba(129, 140, 248, 0.12), rgba(99, 102, 241, 0.08)) !important;
      border-color: rgba(129, 140, 248, 0.3) !important;
    }

    .feature-icon {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.95), rgba(14, 165, 233, 0.9));
      box-shadow: 0 15px 40px rgba(14, 165, 233, 0.35);
    }

    .ai-tabs {
      background: rgba(15, 23, 42, 0.65);
      border: 1px solid rgba(99, 102, 241, 0.25);
      box-shadow: 0 15px 35px rgba(2, 6, 23, 0.4);
      backdrop-filter: blur(12px);
    }

    .ai-tab {
      color: #cbd5f5;
      border-radius: 9999px;
      padding: 0.5rem 1.5rem;
      transition: color 0.25s ease, background-color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
      cursor: pointer;
      position: relative;
      will-change: color, background-color, border-color, box-shadow;
      touch-action: manipulation;
    }

    .ai-tab::after {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 9999px;
      border: 1px solid transparent;
      transition: border 0.3s ease;
    }

    .ai-tab:hover {
      color: #e0f2ff;
    }

    .ai-tab-active {
      color: #0ea5e9;
      background: rgba(14, 165, 233, 0.15);
      box-shadow: 0 10px 25px rgba(14, 165, 233, 0.25);
    }

    .ai-tab-active::after {
      border-color: rgba(14, 165, 233, 0.5);
    }

    .ai-header {
      position: sticky;
      top: 0;
      z-index: 50;
      background: rgba(15, 23, 42, 0.3);
      border-bottom: 1px solid rgba(14, 165, 233, 0.1);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(20px) saturate(180%);
      -webkit-backdrop-filter: blur(20px) saturate(180%);
      transition: all 0.3s ease;
    }

    .ai-header > .container {
      position: relative;
    }

    .ai-header::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(99,102,241,0.05), transparent 50%, rgba(14,165,233,0.05));
      pointer-events: none;
    }

    .ai-header::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(14,165,233,0.5) 50%, transparent);
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .ai-header.scrolled {
      background: rgba(5, 11, 29, 0.7);
      border-color: rgba(14, 165, 233, 0.25);
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
    }

    .ai-header.scrolled::after {
      opacity: 1;
    }

    .ai-nav-link {
      position: relative;
      padding: 0.65rem 1rem;
      color: rgba(224, 242, 254, 0.9);
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .ai-nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, #22d3ee 50%, transparent);
      box-shadow: 0 0 10px #22d3ee, 0 0 20px rgba(34, 211, 238, 0.5);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .ai-nav-link:hover {
      color: #ffffff;
    }

    .ai-nav-link:hover::after {
      opacity: 1;
    }

    /* Animated Splash Navbar */
    .nav-container {
      margin-left: auto;
      position: relative;
      z-index: 120;
      display: block;
    }

    .nav {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      min-height: 48px;
    }

    .nav__toggle {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: none;
      background: transparent;
      cursor: pointer;
      position: relative;
      z-index: 5;
    }

    .nav__toggle:focus-visible {
      outline: 2px solid #22d3ee;
      outline-offset: 2px;
    }

    .menuicon {
      width: 42px;
      height: 42px;
      color: #ffffff;
      transition: transform 0.3s ease;
    }

    .menuicon__bar,
    .menuicon__circle {
      fill: none;
      stroke: currentColor;
      stroke-width: 3;
      stroke-linecap: round;
      transition: transform 0.25s ease, opacity 0.2s ease;
    }

    .menuicon__circle {
      stroke-dasharray: 144;
      stroke-dashoffset: 144;
      transition: stroke-dashoffset 0.3s ease 0.1s;
    }

    .nav__overlay {
      position: fixed;
      inset: 0;
      background: rgba(2, 6, 23, 0.5);
      backdrop-filter: blur(2px);
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.25s ease;
      z-index: 400;
    }

    .nav--open .nav__overlay {
      opacity: 1;
      visibility: visible;
    }

    .nav__menu {
      position: fixed;
      top: 0;
      right: 0;
      width: min(360px, 90vw);
      height: 100vh;
      background: rgba(2, 6, 23, 0.98);
      border-left: 1px solid rgba(148, 163, 184, 0.1);
      box-shadow: -30px 0 60px rgba(2, 6, 23, 0.6);
      padding: 2.5rem 1.75rem;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      visibility: hidden;
      opacity: 0;
      transform: translateX(30px);
      transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
      z-index: 500;
      overflow-y: auto;
    }

    .nav__meta {
      text-align: left;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.3em;
      font-size: 0.75rem;
    }

    .nav__brand {
      color: #f8fafc;
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 0.4em;
    }

    .nav__sections {
      display: flex;
      flex-direction: column;
      gap: 0.35rem;
    }

    .nav__link {
      color: #f8fafc;
      text-decoration: none;
      font-weight: 700;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      font-size: 1rem;
      padding: 0.85rem 0;
      border-radius: 0.75rem;
      transition: background 0.2s ease, color 0.2s ease;
      text-align: center;
    }

    .nav__link:hover,
    .nav__link:focus-visible {
      background: rgba(255, 255, 255, 0.12);
      color: #e0f2fe;
      outline: none;
    }

    .splash {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 1px;
      height: 1px;
      pointer-events: none;
    }

    .splash::after {
      content: "";
      position: absolute;
      width: 200vmax;
      height: 200vmax;
      top: -100vmax;
      left: -100vmax;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.9), rgba(14, 165, 233, 0.85));
      transform: scale(0);
      transition: transform 0.45s cubic-bezier(0.76, 0.05, 0.86, 0.06);
      will-change: transform;
    }

    .nav--open .splash::after {
      transform: scale(1);
    }

    .nav--open .menuicon {
      transform: rotate(180deg);
    }

    .nav--open .menuicon__circle {
      stroke-dashoffset: 0;
    }

    .nav--open .menuicon__bar:first-child,
    .nav--open .menuicon__bar:last-child {
      opacity: 0;
    }

    .nav--open .menuicon__bar:nth-child(2) {
      transform: rotate(45deg);
    }

    .nav--open .menuicon__bar:nth-child(3) {
      transform: rotate(-45deg);
    }

    .nav--open .nav__menu {
      visibility: visible;
      opacity: 1;
      transform: translateX(0);
    }

    .nav--open .nav__sections .nav__link {
      animation: linkFade 0.2s forwards;
    }

    @keyframes linkFade {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }


    .ai-nav-link.active {
      color: #22d3ee;
    }

    .ai-nav-link.active::after {
      opacity: 1;
    }

    .ai-nav-cta {
      background: linear-gradient(120deg, #4338CA, #2563EB, #0EA5E9, #22D3EE);
      color: #fff;
      padding: 0.65rem 1.5rem;
      border-radius: 9999px;
      font-weight: 600;
      box-shadow: 0 15px 35px rgba(14, 165, 233, 0.35);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .ai-nav-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 45px rgba(14, 165, 233, 0.45);
    }

    .ai-desktop-nav {
      background: rgba(15, 23, 42, 0.55);
      border: 1px solid rgba(226, 232, 240, 0.08);
      border-radius: 999px;
      padding: 0.25rem 0.4rem;
      gap: 0.2rem;
      box-shadow: 0 15px 30px rgba(2, 6, 23, 0.55);
    }

    .ai-nav-divider {
      width: 1px;
      height: 32px;
      background: rgba(255, 255, 255, 0.08);
      margin: 0 0.35rem;
    }

    .ai-nav-group {
      display: flex;
      align-items: center;
      gap: 0.15rem;
    }

    .ai-nav-actions {
      margin-left: 1rem;
      padding-left: 1rem;
      border-left: 1px solid rgba(255, 255, 255, 0.08);
      gap: 0.35rem;
    }

    .ai-nav-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 1.5rem;
      padding: 0.1rem 0.5rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      background: rgba(34, 211, 238, 0.15);
      color: #67e8f9;
      border: 1px solid rgba(34, 211, 238, 0.5);
    }

    .team-card {
      position: relative;
      border-radius: 1.5rem;
      overflow: hidden;
      min-height: 400px;
      width: 100%;
      max-width: 320px;
      box-shadow: 0 25px 60px rgba(5, 8, 17, 0.6);
      background: #1f2437;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 30px 70px rgba(5, 8, 17, 0.7);
    }

    .team-photo-bg {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .team-photo-bg::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(8,10,20,0) 40%, rgba(5,8,15,0.95) 100%);
    }

    .team-overlay {
      position: absolute;
      left: 1.5rem;
      right: 1.5rem;
      bottom: 1.5rem;
      padding: 1.25rem;
      border-radius: 1rem;
      background: rgba(6, 10, 24, 0.75);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(148, 163, 184, 0.2);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      z-index: 10;
    }

    .team-overlay h3 {
      font-size: 1.15rem;
      color: #ffffff;
      margin-bottom: 0.25rem;
      font-weight: 700;
    }

    .team-overlay p {
      font-size: 0.9rem;
      color: #cbd5f5;
    }

    .team-social-btn {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.95);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      flex-shrink: 0;
      transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
      color: #0a66c2;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(10, 102, 194, 0.2);
    }

    .team-social-btn:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 8px 25px rgba(10, 102, 194, 0.35);
      background: #ffffff;
    }

    .team-social-btn.instagram {
      color: #C13584;
      box-shadow: 0 4px 15px rgba(193, 53, 132, 0.2);
    }

    .team-social-btn.instagram:hover {
      box-shadow: 0 8px 25px rgba(193, 53, 132, 0.35);
    }

    .team-fallback-avatar {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 5rem;
      font-weight: 700;
      color: #f8fafc;
      background: linear-gradient(135deg, #1e3a8a, #4338ca, #2563eb);
    }

    @media (min-width: 640px) {
      .container {
        max-width: 640px;
        padding-right: 2rem;
        padding-left: 2rem;
      }
    }

    @media (min-width: 768px) {
      .container {
        max-width: 768px;
      }
    }

    @media (min-width: 1024px) {
      .container {
        max-width: 1024px;
      }
    }

    @media (min-width: 1280px) {
      .container {
        max-width: 1280px;
      }
    }

    /* Card Hover Effects */
    .feature-card {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid transparent;
      backdrop-filter: blur(8px);
      background: rgba(255, 255, 255, 0.9);
    }

    .feature-card:hover {
      transform: translateY(-5px) scale(1.02);
      border-color: var(--primary-light);
      box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
      background: rgba(255, 255, 255, 0.95);
    }

    .feature-card::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 0.5rem;
      padding: 2px;
      background: linear-gradient(45deg, transparent, var(--primary-color), transparent);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .feature-card:hover::before {
      opacity: 1;
    }

    /* Button Styles */
    .btn {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
      border: none;
      color: white;
      padding: 1rem 2rem;
      border-radius: 9999px;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.2);
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
    }

    .btn:after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: -100%;
      background: linear-gradient(
        90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.2) 50%,
        rgba(255,255,255,0) 100%
      );
      transition: all 0.5s ease;
    }

    .btn:hover:after {
      left: 100%;
    }

    /* Responsive Text */
    @media (max-width: 640px) {
      .responsive-text-sm {
        font-size: 0.875rem;
      }
      .responsive-text-base {
        font-size: 1rem;
      }
      .responsive-text-lg {
        font-size: 1.125rem;
      }
      .responsive-text-xl {
        font-size: 1.25rem;
      }
      h1 {
        font-size: 1.75rem !important;
      }
      h2 {
        font-size: 1.5rem !important;
      }
      h3 {
        font-size: 1.25rem !important;
      }
    }
    
    /* Extra Small Devices */
    @media (max-width: 480px) {
      .responsive-text-sm {
        font-size: 0.75rem;
      }
      .responsive-text-base {
        font-size: 0.875rem;
      }
      .responsive-text-lg {
        font-size: 1rem;
      }
      .responsive-text-xl {
        font-size: 1.125rem;
      }
      h1 {
        font-size: 1.5rem !important;
      }
      h2 {
        font-size: 1.25rem !important;
      }
      h3 {
        font-size: 1.125rem !important;
      }
    }

    /* Disable default smooth scroll - using custom JS animation */
    html {
      scroll-behavior: auto;
    }

    /* Hide Scrollbar */
    ::-webkit-scrollbar {
      width: 0;
      height: 0;
      display: none;
    }

    ::-webkit-scrollbar-track {
      display: none;
    }

    ::-webkit-scrollbar-thumb {
      display: none;
    }

    /* Firefox */
    html {
      scrollbar-width: none;
    }
    
    /* IE/Edge */
    body {
      -ms-overflow-style: none;
    }

    /* Loading Animation */
    .loading {
      animation: shimmer 2s infinite linear;
      background: linear-gradient(
        to right,
        #f6f7f8 0%,
        #edeef1 20%,
        #f6f7f8 40%,
        #f6f7f8 100%
      );
      background-size: 1000px 100%;
    }

    @keyframes shimmer {
      0% {
        background-position: -1000px 0;
      }
      100% {
        background-position: 1000px 0;
      }
    }

    /* Grid Layout Improvements */
    .grid-responsive {
      display: grid;
      gap: 1.5rem;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    @media (max-width: 480px) {
      .grid-responsive {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      }
    }

    /* Footer Responsiveness */
    @media (max-width: 768px) {
      .footer-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
      }
    }

    @media (max-width: 640px) {
      .ai-tabs {
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }

      .ai-tabs::-webkit-scrollbar {
        display: none;
      }

      .feature-card,
      .team-card,
      .testimonial-card,
      .paper-card,
      .ai-card {
        transform: none !important;
        transition-duration: 0.2s !important;
        box-shadow: 0 10px 25px rgba(2, 6, 23, 0.35);
      }

      .feature-card:hover,
      .team-card:hover,
      .testimonial-card:hover,
      .paper-card:hover,
      .ai-card:hover {
        transform: none !important;
      }

      .hero-section {
        background: linear-gradient(180deg, rgba(15,23,42,0.95), rgba(2,6,23,0.9));
        padding-top: 4rem;
      }

      .hero-section::before,
      .hero-section::after,
      .hero-aurora {
        opacity: 0.45;
        filter: blur(45px);
      }

      .mobile-menu-link {
        border-radius: 1rem;
        border: 1px solid rgba(14, 165, 233, 0.12);
      }
    }

    @media (max-width: 768px) {
      .hero-aurora,
      .hero-grid-overlay {
        opacity: 0.25;
        filter: blur(10px);
      }

      .hero-section,
      .testimonials-section,
      .tech-logos-section {
        box-shadow: none;
      }

      .ai-card,
      .paper-card,
      .team-card {
        transform: none !important;
        box-shadow: 0 10px 25px rgba(2, 6, 23, 0.45);
      }

      .tech-logos-track {
        animation-duration: 50s;
      }
    }
    
    @media (max-width: 640px) {
      footer .grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
    }

    /* Image Optimization */
    img {
      max-width: 100%;
      height: auto;
      object-fit: cover;
    }
    
    /* Responsive Spacing */
    @media (max-width: 640px) {
      .py-12 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
      }
      .py-16 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
      }
      .px-6 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
      }
      .space-y-8 > :not([hidden]) ~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(1.5rem * calc(1 - var(--tw-space-y-reverse))) !important;
        margin-bottom: calc(1.5rem * var(--tw-space-y-reverse)) !important;
      }
      .mt-16 {
        margin-top: 2.5rem !important;
      }
      .gap-6 {
        gap: 1rem !important;
      }
    }

    /* Accessibility */
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      border: 0;
    }

    /* Focus States */
    a:focus, button:focus {
      outline: 2px solid #7C3AED;
      outline-offset: 2px;
    }

    /* Print Styles */
    @media print {
      .no-print {
        display: none;
      }
    }

    /* Popup Modal Styles */
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(8px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 99999;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.4s ease, visibility 0.4s ease;
      padding: 1rem;
      pointer-events: none;
    }

    .popup-overlay.active {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }
    
    .popup-overlay.active .popup-content {
      pointer-events: auto;
    }
    
    .popup-overlay.active * {
      pointer-events: auto;
    }

    .popup-content {
      background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(8, 47, 73, 0.95) 100%);
      border-radius: 1.5rem;
      max-width: 550px;
      width: 100%;
      position: relative;
      transform: scale(0.8) translateY(30px);
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      box-shadow: 0 30px 80px rgba(2, 6, 23, 0.6);
      overflow: hidden;
      border: 1px solid rgba(14, 165, 233, 0.35);
    }

    .popup-overlay.active .popup-content {
      transform: scale(1) translateY(0);
    }

    .popup-header {
      background: linear-gradient(135deg, #4338CA 0%, #2563EB 40%, #0EA5E9 70%, #22D3EE 100%);
      padding: 2rem;
      text-align: center;
      position: relative;
    }

    .popup-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      color: white;
      font-size: 1.25rem;
    }

    .popup-close:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
    }

    .popup-body {
      padding: 2rem;
    }

    .popup-button {
      background: linear-gradient(135deg, #4338CA 0%, #2563EB 40%, #0EA5E9 70%, #22D3EE 100%);
      color: white;
      padding: 1rem 2rem;
      border-radius: 0.75rem;
      font-weight: 600;
      border: none;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35);
      font-size: 1.125rem;
      text-decoration: none;
      display: block;
      pointer-events: auto;
      position: relative;
      z-index: 1;
    }

    .popup-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 35px rgba(14, 165, 233, 0.45);
      text-decoration: none;
      color: white;
    }
    
    .popup-button:active {
      transform: translateY(0);
    }

    @media (max-width: 640px) {
      .popup-content {
        max-width: 95vw;
      }
      
      .popup-header {
        padding: 1.5rem;
      }
      
      .popup-body {
        padding: 1.5rem;
      }
      
      .popup-button {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
      }
    }
  </style>
 
<!-- Modern Header -->
<header class="modern-header sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-3 group">
                <div class="relative w-11 h-11 bg-gradient-to-br from-lime-400 to-lime-500 rounded-lg flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                    <span class="text-black text-xl font-black">U</span>
                </div>
                <span class="text-xl font-bold text-gray-900 tracking-tight">UNIVERSITY<span class="text-lime-500">.</span></span>
            </a>

            <?php
            require_once('includes/db.php');
            $notifCountQuery = "SELECT COUNT(*) as count FROM notifications WHERE is_active = 1";
            $notifCountResult = mysqli_query($conn, $notifCountQuery);
            $notifCount = 0;
            if ($notifCountResult) {
                $countRow = mysqli_fetch_assoc($notifCountResult);
                $notifCount = (int) ($countRow['count'] ?? 0);
            }
            ?>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="index.php#home" class="nav-link-modern" data-scroll-target="home">Home</a>
                
                <!-- About Dropdown -->
                <div class="relative dropdown-modern">
                    <button class="nav-link-modern flex items-center">
                        About <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu-modern">
                        <a href="index.php#team" class="dropdown-item-modern" data-scroll-target="team">Our Team</a>
                        <a href="contact.php" class="dropdown-item-modern">Contact Us</a>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="relative dropdown-modern">
                    <button class="nav-link-modern flex items-center">
                        Services <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu-modern">
                        <a href="notes.php" class="dropdown-item-modern"><i class="fas fa-sticky-note mr-2"></i>Notes</a>
                        <a href="previous_year.php" class="dropdown-item-modern"><i class="fas fa-file-alt mr-2"></i>Past Papers</a>
                        <a href="https://university-updates.co.in/videos.php" class="dropdown-item-modern"><i class="fas fa-video mr-2"></i>Video Lectures</a>
                        <a href="https://university-updates.co.in/forms_links.php" class="dropdown-item-modern"><i class="fas fa-link mr-2"></i>Forms & Links</a>
                    </div>
                </div>

                <a href="https://university-updates.co.in/applications.php" class="nav-link-modern">Applications</a>
                
                <a href="notifications.php" class="nav-link-modern relative">
                    Notifications
                    <?php if ($notifCount > 0): ?>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full"><?php echo $notifCount; ?></span>
                    <?php endif; ?>
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 flex items-center justify-center text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-100 bg-white">
        <div class="container mx-auto px-4 py-4 space-y-2">
            <a href="index.php#home" class="mobile-menu-item" data-scroll-target="home">Home</a>
            <a href="index.php#team" class="mobile-menu-item" data-scroll-target="team">About</a>
            <a href="notes.php" class="mobile-menu-item">Notes</a>
            <a href="previous_year.php" class="mobile-menu-item">Past Papers</a>
            <a href="https://university-updates.co.in/videos.php" class="mobile-menu-item">Video Lectures</a>
            <a href="https://university-updates.co.in/forms_links.php" class="mobile-menu-item">Forms & Links</a>
            <a href="https://university-updates.co.in/applications.php" class="mobile-menu-item">Applications</a>
            <a href="notifications.php" class="mobile-menu-item">
                Notifications
                <?php if ($notifCount > 0): ?>
                    <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"><?php echo $notifCount; ?></span>
                <?php endif; ?>
            </a>
            <a href="contact.php" class="mobile-menu-item">Contact</a>
        </div>
    </div>
</header>

<style>
.modern-header {
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.nav-link-modern {
    padding: 0.625rem 1rem;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #374151;
    border-radius: 0.5rem;
    transition: all 0.2s;
    position: relative;
    cursor: pointer;
}

.nav-link-modern:hover {
    color: #000;
    background: #f9fafb;
}

.dropdown-modern {
    position: relative;
}

.dropdown-menu-modern {
    position: absolute;
    top: calc(100% + 0.5rem);
    left: 0;
    min-width: 220px;
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s;
    z-index: 50;
}

.dropdown-modern:hover .dropdown-menu-modern {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item-modern {
    display: block;
    padding: 0.75rem 1.25rem;
    font-size: 0.9375rem;
    color: #374151;
    transition: all 0.2s;
}

.dropdown-item-modern:first-child {
    border-radius: 0.75rem 0.75rem 0 0;
}

.dropdown-item-modern:last-child {
    border-radius: 0 0 0.75rem 0.75rem;
}

.dropdown-item-modern:hover {
    background: #f3f4f6;
    color: #000;
}

.btn-modern-primary {
    display: inline-flex;
    align-items: center;
    padding: 0.625rem 1.5rem;
    background: #000;
    color: white;
    font-size: 0.9375rem;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s;
}

.btn-modern-primary:hover {
    background: #1f2937;
    transform: translateY(-1px);
}

.mobile-menu-item {
    display: block;
    padding: 0.75rem 1rem;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #374151;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.mobile-menu-item:hover {
    background: #f9fafb;
    color: #000;
}
</style>

<script>
// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

function closeMobileMenu() {
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
        const icon = mobileMenuBtn?.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
}

mobileMenuBtn?.addEventListener('click', function() {
    const icon = this.querySelector('i');
    if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        closeMobileMenu();
    }
});

// Close menu when clicking on links
document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
});

// Close menu on resize to desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        closeMobileMenu();
    }
});
</script>

<script>
    // Ensure all footer links are clickable and working
    document.addEventListener('DOMContentLoaded', function() {
        const footerLinks = document.querySelectorAll('footer a');
        footerLinks.forEach(link => {
            link.style.cursor = 'pointer';
            link.style.pointerEvents = 'auto';
            
            // Ensure click events work
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href !== '#') {
                    // If it's a hash link, let default behavior handle it
                    if (href.startsWith('#')) {
                        return true;
                    }
                    // Otherwise ensure navigation happens
                    if (!e.defaultPrevented) {
                        window.location.href = href;
                    }
                }
            });
        });

        // Make sure all feature cards are clickable
        const featureCards = document.querySelectorAll('.group.block[href]');
        featureCards.forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function(e) {
                if (!e.defaultPrevented) {
                    const href = this.getAttribute('href');
                    if (href) {
                        window.location.href = href;
                    }
                }
            });
        });
    });

    // Smooth scroll functionality
    const header = document.querySelector('.modern-header');

    function smoothScrollToElement(targetElement) {
        const headerHeight = header ? header.offsetHeight : 80;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

        window.scrollTo({ 
            top: targetPosition, 
            behavior: 'smooth' 
        });
    }

    // Handle anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (!href || href === '#') return;

            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            if (!targetElement) return;

            e.preventDefault();
            
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                const menuIcon = document.querySelector('#mobile-menu-btn i');
                if (menuIcon) {
                    menuIcon.classList.remove('fa-times');
                    menuIcon.classList.add('fa-bars');
                }
            }
            
            smoothScrollToElement(targetElement);
        });
    });

    // Handle data-scroll-target links
    document.querySelectorAll('[data-scroll-target]').forEach(link => {
        link.addEventListener('click', function (e) {
            const targetId = this.dataset.scrollTarget;
            if (!targetId) return;

            const targetElement = document.getElementById(targetId);
            if (!targetElement) return;

            const linkUrl = new URL(this.href, window.location.href);
            const normalize = (path) => path.replace(/\/index\.php$/i, '').replace(/\/$/, '');
            const normalizedLinkPath = normalize(linkUrl.pathname);
            const normalizedCurrentPath = normalize(window.location.pathname);

            if (normalizedLinkPath === normalizedCurrentPath) {
                e.preventDefault();
                
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    const menuIcon = document.querySelector('#mobile-menu-btn i');
                    if (menuIcon) {
                        menuIcon.classList.remove('fa-times');
                        menuIcon.classList.add('fa-bars');
                    }
                }
                
                smoothScrollToElement(targetElement);
            }
        });
    });
</script>



<body class="gradient-bg min-h-screen">

<!-- Modern Hero Section -->
<section id="home" class="relative pt-20 pb-12 sm:pt-24 sm:pb-16 lg:pt-32 lg:pb-24 bg-gradient-to-br from-gray-50 via-lime-50/30 to-white overflow-hidden">
  <!-- Decorative elements -->
  <div class="absolute top-20 right-10 w-72 h-72 bg-lime-400/20 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-10 left-10 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>
  
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      
      <!-- Left Content -->
      <div class="text-center lg:text-left">
        <!-- Badge -->
        <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-lime-100 text-lime-700 rounded-full mb-4 sm:mb-6 text-xs sm:text-sm font-semibold">
          <span class="mr-1 sm:mr-2">#</span>Online Course 2024
        </div>
        
        <!-- Main Heading -->
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black mb-6 leading-tight text-gray-900">
          Latest Technical Skills. <br class="hidden sm:block"/>
          Yours For The <span class="relative inline-block">
            Taking
            <span class="absolute -right-6 sm:-right-8 -top-2 text-lime-500 text-3xl sm:text-4xl">+</span>
          </span>
        </h1>
        
        <!-- Description -->
        <p class="text-gray-600 text-sm sm:text-base lg:text-lg mb-6 sm:mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
          Access all university resources, notes, papers, and updates in one convenient platform.
        </p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          <a href="#features" class="inline-flex items-center justify-center px-8 py-4 bg-black hover:bg-gray-800 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
            Get Started
            <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>

      <!-- Right Visual -->
      <div class="relative flex items-center justify-center lg:justify-end">
        <!-- Main Image Container -->
        <div class="relative w-full max-w-md lg:max-w-lg">
          <!-- Background shape with stock image -->
          <div class="relative rounded-3xl overflow-hidden shadow-2xl">
            <div class="aspect-[3/4]">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&h=800&fit=crop" 
                   alt="Students learning" 
                   class="w-full h-full object-cover"
                   loading="lazy">
            </div>
          </div>

          <!-- Stats Badge -->
          <div class="absolute top-4 left-4 bg-black text-white rounded-2xl p-4 shadow-xl">
            <div class="text-xs font-semibold mb-2">Grow your best skills</div>
            <div class="flex items-center gap-3">
              <div>
                <div class="text-xl font-bold">10K+</div>
                <div class="text-xs text-gray-400">students</div>
              </div>
              <div>
                <div class="text-xl font-bold">500+</div>
                <div class="text-xs text-gray-400">notes</div>
              </div>
            </div>
          </div>

          <!-- Edition Badge -->
          <div class="absolute bottom-4 left-4 w-20 h-20 bg-lime-400 rounded-full flex items-center justify-center shadow-xl">
            <div class="text-center">
              <div class="text-white font-black text-xs">SPECIAL</div>
              <div class="text-white font-black text-xs">EDITION</div>
              <div class="text-white text-lg">+</div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- Stats Bar -->
<?php
// Get counts from database
$studyMaterialsCount = 0;
$notificationsCount = 0;
$previousPapersCount = 0;
$teamMembersCount = 0;

$studyQuery = "SELECT COUNT(*) as count FROM study_materials";
$studyResult = mysqli_query($conn, $studyQuery);
if ($studyResult) {
    $studyMaterialsCount = mysqli_fetch_assoc($studyResult)['count'];
}

$notifQuery = "SELECT COUNT(*) as count FROM notifications WHERE is_active = 1";
$notifResult = mysqli_query($conn, $notifQuery);
if ($notifResult) {
    $notificationsCount = mysqli_fetch_assoc($notifResult)['count'];
}

$papersQuery = "SELECT COUNT(*) as count FROM previous_year_papers";
$papersResult = mysqli_query($conn, $papersQuery);
if ($papersResult) {
    $previousPapersCount = mysqli_fetch_assoc($papersResult)['count'];
}

$teamCountQuery = "SELECT COUNT(*) as count FROM team_members WHERE is_active = 1";
$teamCountResult = mysqli_query($conn, $teamCountQuery);
if ($teamCountResult) {
    $teamMembersCount = mysqli_fetch_assoc($teamCountResult)['count'];
}
?>
<section class="bg-black text-white py-8">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 text-center">
      <div class="border-r border-white/20 last:border-r-0">
        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1"><?php echo $studyMaterialsCount; ?>+</div>
        <div class="text-xs sm:text-sm text-gray-400">Study Materials</div>
      </div>
      <div class="border-r border-white/20 last:border-r-0">
        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1"><?php echo $notificationsCount; ?>+</div>
        <div class="text-xs sm:text-sm text-gray-400">Active Notifications</div>
      </div>
      <div class="border-r border-white/20 last:border-r-0">
        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1"><?php echo $previousPapersCount; ?>+</div>
        <div class="text-xs sm:text-sm text-gray-400">Previous Papers</div>
      </div>
      <div>
        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1"><?php echo $teamMembersCount; ?>+</div>
        <div class="text-xs sm:text-sm text-gray-400">Team Members</div>
      </div>
    </div>
  </div>
</section>



<!-- Why Choose Section -->
<section id="features" class="py-12 sm:py-16 lg:py-24 bg-black text-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="text-center mb-12">
      <h2 class="text-4xl lg:text-5xl font-black mb-6">
        Why Should Choose 
        <span class="relative inline-block">
          <span class="relative z-10">University Updates</span>
          <span class="absolute bottom-0 left-0 w-full h-3 bg-lime-400 -z-0"></span>
        </span>
      </h2>
      <p class="text-gray-400 text-lg max-w-2xl mx-auto">
        Get the proper academic support from University Updates. We are here to help you with all your educational needs.
      </p>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- Feature: Smart Notes -->
      <a href="notes.php" class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 group relative block cursor-pointer" onclick="window.location.href='notes.php'; return false;">
        <div class="absolute top-4 right-4">
          <span class="px-3 py-1 bg-indigo-500 text-white text-xs font-bold rounded-full">POPULAR</span>
        </div>
        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-sticky-note text-white text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Smart Notes</h3>
        <p class="text-gray-400 mb-4 leading-relaxed">Create, organize, and collaborate on study notes with classmates</p>
        <span class="inline-flex items-center text-lime-400 font-semibold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>

      <!-- Feature: Learn Anywhere - Highlighted -->
      <a href="notes.php" class="bg-lime-400 text-black rounded-2xl p-8 hover:bg-lime-500 transition-all duration-300 group transform hover:scale-105 block cursor-pointer" onclick="window.location.href='notes.php'; return false;">
        <div class="w-12 h-12 bg-black/10 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-laptop text-black text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Learn Anywhere</h3>
        <p class="text-gray-800 mb-4 leading-relaxed">Study material that you love and can access anytime and anywhere</p>
        <span class="inline-flex items-center text-black font-bold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>

      <!-- Feature: Exam Papers -->
      <a href="previous_year.php" class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 group relative block cursor-pointer" onclick="window.location.href='previous_year.php'; return false;">
        <div class="absolute top-4 right-4">
          <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">NEW</span>
        </div>
        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-file-alt text-white text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Previous Year Papers</h3>
        <p class="text-gray-400 mb-4 leading-relaxed">Access comprehensive archive of past examination papers</p>
        <span class="inline-flex items-center text-lime-400 font-semibold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>

      <!-- Feature: Forms & Applications -->
      <a href="https://university-updates.co.in/applications.php" class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 group block cursor-pointer" onclick="window.location.href='https://university-updates.co.in/applications.php'; return false;">
        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-file-signature text-white text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Forms & Applications</h3>
        <p class="text-gray-400 mb-4 leading-relaxed">Easy access to all university forms and applications</p>
        <span class="inline-flex items-center text-lime-400 font-semibold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>

      <!-- Feature: Video Lectures -->
      <a href="https://university-updates.co.in/videos.php" class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 group block cursor-pointer" onclick="window.location.href='https://university-updates.co.in/videos.php'; return false;">
        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-video text-white text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Video Lectures</h3>
        <p class="text-gray-400 mb-4 leading-relaxed">Comprehensive collection of educational video content</p>
        <span class="inline-flex items-center text-lime-400 font-semibold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>

      <!-- Feature: Important Links -->
      <a href="https://university-updates.co.in/forms_links.php" class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 group block cursor-pointer" onclick="window.location.href='https://university-updates.co.in/forms_links.php'; return false;">
        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center mb-6">
          <i class="fas fa-link text-white text-xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Important Links</h3>
        <p class="text-gray-400 mb-4 leading-relaxed">Quick access to essential university links in one place</p>
        <span class="inline-flex items-center text-lime-400 font-semibold group-hover:translate-x-2 transition-transform duration-300">
          Explore <i class="fas fa-arrow-right ml-2"></i>
        </span>
      </a>
      
    </div>
  </div>
</section>


<!-- Our Team Section -->
<section id="team" class="py-12 sm:py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl lg:text-5xl font-black mb-6 text-gray-900">
                Meet Our 
                <span class="relative inline-block">
                    <span class="relative z-10">Team</span>
                    <span class="absolute bottom-0 left-0 w-full h-3 bg-lime-400 -z-0"></span>
                </span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Dedicated individuals working together to make your university experience better.
            </p>
        </div>

        <!-- Team Members Grid -->
        <?php
        // Fetch active team members from database
        require_once('includes/db.php');
        $teamQuery = "SELECT * FROM team_members WHERE is_active = 1 ORDER BY display_order ASC";
        $teamResult = mysqli_query($conn, $teamQuery);
        $teamMembers = [];
        if ($teamResult) {
            while ($row = mysqli_fetch_assoc($teamResult)) {
                $teamMembers[] = $row;
            }
        }
        
        // Get gradient colors for cards
        $gradients = [
            ['from' => 'sky-500', 'via' => 'indigo-600', 'to' => 'violet-800', 'text' => 'sky-200', 'hover' => 'sky-300'],
            ['from' => 'cyan-500', 'via' => 'blue-600', 'to' => 'indigo-800', 'text' => 'cyan-200', 'hover' => 'cyan-300'],
            ['from' => 'fuchsia-500', 'via' => 'violet-700', 'to' => 'violet-900', 'text' => 'fuchsia-200', 'hover' => 'fuchsia-300'],
            ['from' => 'emerald-500', 'via' => 'teal-500', 'to' => 'cyan-600', 'text' => 'emerald-200', 'hover' => 'emerald-300'],
        ];
        ?>
        
        <!-- Team Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            
            <?php foreach ($teamMembers as $index => $member): 
                $initials = strtoupper(substr($member['name'], 0, 1) . (strpos($member['name'], ' ') ? substr($member['name'], strpos($member['name'], ' ') + 1, 1) : substr($member['name'], 1, 1)));
                $hasPhoto = $member['photo'] && file_exists($member['photo']);
            ?>
            
            <!-- Team Member: <?php echo htmlspecialchars($member['name']); ?> -->
            <div class="modern-team-card group">
                <!-- Photo Container -->
                <div class="aspect-[3/4] bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl overflow-hidden mb-6 relative">
                    <?php if ($hasPhoto): ?>
                        <img src="<?php echo htmlspecialchars($member['photo']); ?>" 
                             alt="<?php echo htmlspecialchars($member['name']); ?>" 
                             class="w-full h-full object-cover"
                             loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-lime-400 to-lime-500">
                            <span class="text-6xl font-black text-white"><?php echo $initials; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Social Icons Overlay -->
                    <div class="absolute bottom-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <?php if (!empty($member['linkedin_url'])): ?>
                            <a href="<?php echo htmlspecialchars($member['linkedin_url']); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-lg">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($member['instagram_url'])): ?>
                            <a href="<?php echo htmlspecialchars($member['instagram_url']); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-pink-600 hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-lg">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Info -->
                <div class="text-center">
                    <h3 class="text-xl font-bold mb-1 text-gray-900"><?php echo htmlspecialchars($member['name']); ?></h3>
                    <p class="text-lime-600 font-semibold"><?php echo htmlspecialchars($member['position']); ?></p>
                </div>
            </div>
            
            <?php endforeach; ?>
        </div>

    </div>
</section>

<style>
.modern-team-card {
    transition: transform 0.3s ease;
}

.modern-team-card:hover {
    transform: translateY(-8px);
}
</style>


<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
</style>

<!-- Modern Footer Section -->
<footer class="bg-black text-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    
    <!-- Main Footer Content -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10 mb-10">
      
      <!-- About Section -->
      <div class="lg:col-span-2">
        <a href="index.php" class="flex items-center space-x-3 mb-6 cursor-pointer inline-block">
          <div class="w-11 h-11 bg-lime-400 rounded-lg flex items-center justify-center">
            <span class="text-black text-xl font-black">U</span>
          </div>
          <h3 class="text-xl font-bold">UNIVERSITY UPDATES<span class="text-lime-400">.</span></h3>
        </a>
        <p class="text-gray-400 text-sm leading-relaxed mb-6 max-w-sm">
          Your comprehensive platform for all university resources, study materials, and academic updates. Empowering students to achieve excellence through accessible education and timely information.
        </p>
        <div class="flex space-x-3">
          <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-all duration-300 cursor-pointer">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-all duration-300 cursor-pointer">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.instagram.com/creative_sujay__" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-all duration-300 cursor-pointer">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.linkedin.com/in/sujay-kumar22" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-all duration-300 cursor-pointer">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-all duration-300 cursor-pointer">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>

      <!-- Contact & About -->
      <div>
        <h4 class="text-lg font-bold mb-6">Contact & About</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="contact.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Contact</a></li>
          <li><a href="index.php#team" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer" data-scroll-target="team">About</a></li>
          <li><a href="index.php#features" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer" data-scroll-target="features">Services</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div>
        <h4 class="text-lg font-bold mb-6">Resources</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="notes.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Study Notes</a></li>
          <li><a href="previous_year.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Past Papers</a></li>
          <li><a href="https://university-updates.co.in/videos.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Video Lectures</a></li>
          <li><a href="notifications.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Notifications</a></li>
        </ul>
      </div>

      <!-- Legal -->
      <div>
        <h4 class="text-lg font-bold mb-6">Legal</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="terms.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Terms & Conditions</a></li>
          <li><a href="privacy_policy.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Privacy Policy</a></li>
          <li><a href="https://university-updates.co.in/applications.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Applications</a></li>
          <li><a href="https://university-updates.co.in/forms_links.php" class="text-gray-400 hover:text-white hover:underline transition-colors block cursor-pointer">Forms & Links</a></li>
        </ul>
      </div>

      <!-- Location -->
      <div>
        <h4 class="text-lg font-bold mb-6">Find Us</h4>
        <div class="text-gray-300 text-sm mb-4">
          <p class="font-semibold text-white mb-2">School of Open Learning</p>
          <p>University of Delhi</p>
        </div>
        <div class="space-y-3">
          <button id="turnOnNavigation" class="w-full bg-gradient-to-r from-lime-400 to-lime-500 hover:from-lime-500 hover:to-lime-600 text-black py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center font-semibold shadow-lg cursor-pointer">
            <i class="fas fa-directions mr-2"></i>
            Get Directions
          </button>
          
          <div class="rounded-lg overflow-hidden border-2 border-gray-700 hover:border-lime-400 transition-colors duration-300">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.881850803716!2d77.21037007493283!3d28.693180681325043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfdeb39678399%3A0x994c4cc9d8ecbd11!2sSchool%20of%20Open%20Learning%2C%20University%20of%20Delhi!5e0!3m2!1sen!2sin!4v1733673297401!5m2!1sen!2sin" 
              width="100%" 
              height="180" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-gray-400 text-sm">
          © 2025 University Updates. All rights reserved.
        </p>
        <div class="flex items-center gap-6 text-sm">
          <a href="privacy_policy.php" class="text-gray-400 hover:text-lime-400 transition-colors cursor-pointer">Privacy</a>
          <span class="text-gray-600">•</span>
          <a href="terms.php" class="text-gray-400 hover:text-lime-400 transition-colors cursor-pointer">Terms</a>
          <span class="text-gray-600">•</span>
          <a href="contact.php" class="text-gray-400 hover:text-lime-400 transition-colors cursor-pointer">Contact</a>
        </div>
      </div>
    </div>
    
  </div>
</footer>
</body>
</html>


<script>
    // Disable keyboard shortcuts and developer tools
    document.addEventListener('keydown', function(e) {
      // Disable Ctrl+S
      if (e.ctrlKey && (e.key === 's' || e.key === 'S')) {
        e.preventDefault();
        return false;
      }
      
      // Disable F12
      if (e.key === 'F12' || e.keyCode === 123) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+Shift+I
      if (e.ctrlKey && e.shiftKey && (e.key === 'i' || e.key === 'I')) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+Shift+J
      if (e.ctrlKey && e.shiftKey && (e.key === 'j' || e.key === 'J')) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+U (View Source)
      if (e.ctrlKey && (e.key === 'u' || e.key === 'U')) {
        e.preventDefault();
        return false;
      }

      // Disable Ctrl+Shift+C
      if (e.ctrlKey && e.shiftKey && (e.key === 'c' || e.key === 'C')) {
        e.preventDefault();
        return false;
      }
    });

    // Disable right-click context menu (but allow on links)
    document.addEventListener('contextmenu', function(e) {
      // Allow context menu on links
      if (e.target.tagName === 'A' || e.target.closest('a')) {
        return true;
      }
      e.preventDefault();
      return false;
    });

    // Disable copy
    document.addEventListener('copy', function(e) {
      e.preventDefault();
      return false;
    });

    // Disable cut
    document.addEventListener('cut', function(e) {
      e.preventDefault();
      return false;
    });

    // Disable paste
    document.addEventListener('paste', function(e) {
      e.preventDefault();
      return false;
    });

    // Detect and prevent DevTools
    function detectDevTools() {
      const widthThreshold = window.outerWidth - window.innerWidth > 160;
      const heightThreshold = window.outerHeight - window.innerHeight > 160;
      
      if(widthThreshold || heightThreshold) {
        document.body.innerHTML = 'Developer tools are not allowed on this website.';
      }
    }

    // Check periodically for DevTools
    setInterval(detectDevTools, 1000);

    // Additional DevTools detection
    (function() {
      let devtools = {
        open: false,
        orientation: null
      };
      
      const threshold = 160;
      const emitEvent = (isOpen, orientation) => {
        window.dispatchEvent(new CustomEvent('devtoolschange', {
          detail: {
            isOpen,
            orientation
          }
        }));
      };

      setInterval(() => {
        const widthThreshold = window.outerWidth - window.innerWidth > threshold;
        const heightThreshold = window.outerHeight - window.innerHeight > threshold;
        const orientation = widthThreshold ? 'vertical' : 'horizontal';

        if (
          !(heightThreshold && widthThreshold) &&
          ((window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized) || widthThreshold || heightThreshold)
        ) {
          if (!devtools.open || devtools.orientation !== orientation) {
            emitEvent(true, orientation);
          }
          devtools.open = true;
          devtools.orientation = orientation;
        } else {
          if (devtools.open) {
            emitEvent(false, null);
          }
          devtools.open = false;
          devtools.orientation = null;
        }
      }, 500);

      // Disable console
      const consoleOutput = console.log;
      console.log = function() {
        consoleOutput.apply(console, ['Console output is disabled']);
      };
    })();

    // Prevent drag and drop
    document.addEventListener('dragstart', function(e) {
      e.preventDefault();
      return false;
    });

    // Prevent text selection
    document.addEventListener('selectstart', function(e) {
      if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        return false;
      }
    });

    // Additional protection against view source
    document.onkeypress = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onmousedown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onkeydown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }

    // Disable print
    window.addEventListener('keydown', function(e) {
      if (e.ctrlKey && (e.key === 'p' || e.key === 'P')) {
        e.cancelBubble = true;
        e.preventDefault();
        e.stopImmediatePropagation();
      }
    });
  </script>
  
  <!-- Popups (Placement & Notice Board) -->
  <?php
  // Fetch active popups from database
  // Check if popup_type column exists
  $checkColumnQuery = "SHOW COLUMNS FROM placement_popup LIKE 'popup_type'";
  $checkResult = mysqli_query($conn, $checkColumnQuery);
  $columnExists = $checkResult && mysqli_num_rows($checkResult) > 0;
  
  if ($columnExists) {
      $popupQuery = "SELECT * FROM placement_popup WHERE is_active = 1 ORDER BY popup_type";
  } else {
      // Fallback: if popup_type column doesn't exist, treat all as placement
      $popupQuery = "SELECT *, 'placement' as popup_type FROM placement_popup WHERE is_active = 1";
  }
  
  $popupResult = mysqli_query($conn, $popupQuery);
  $popups = [];
  if ($popupResult) {
      if (mysqli_num_rows($popupResult) > 0) {
          while ($row = mysqli_fetch_assoc($popupResult)) {
              // Ensure popup_type is set
              if (!isset($row['popup_type']) || empty($row['popup_type'])) {
                  $row['popup_type'] = 'placement';
              }
              $popups[] = $row;
          }
      }
  } else {
      // Log error for debugging
      error_log("Popup query error: " . mysqli_error($conn));
  }
  
  if (count($popups) === 0) {
      // Fallback: Create a default notice board popup if none found (for testing)
      if (isset($_GET['showPopup']) || isset($_GET['testPopup'])) {
          $popups[] = [
              'id' => 0,
              'popup_type' => 'notice_board',
              'title' => 'Submit Your Project 📋',
              'description' => 'Share your innovative projects with us! Submit your project details and showcase your work to the community.',
              'button_text' => 'Submit Your Project',
              'form_link' => 'https://forms.gle/ymFXYPt5Bx26toU87',
              'is_active' => 1,
              'show_frequency' => 'once',
              'background_color' => '#10B981'
          ];
      }
  }
  
  foreach ($popups as $index => $popupData):
      $popupId = $popupData['popup_type'] . 'Popup';
      $popupType = isset($popupData['popup_type']) ? $popupData['popup_type'] : 'placement';
      $emoji = $popupType === 'notice_board' ? '📋' : '🎯';
      $storageKey = $popupType . 'Popup';
  ?>
  <div id="<?php echo $popupId; ?>" class="popup-overlay" data-frequency="<?php echo htmlspecialchars($popupData['show_frequency']); ?>">
    <div class="popup-content">
      <button type="button" class="popup-close" onclick="if(typeof window.closePopup === 'function') { window.closePopup('<?php echo $popupId; ?>'); } else { document.getElementById('<?php echo $popupId; ?>').classList.remove('active'); document.body.style.overflow = ''; }">
        <i class="fas fa-times"></i>
      </button>
      
      <div class="popup-header" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($popupData['background_color']); ?> 0%, <?php echo $popupType === 'notice_board' ? '#059669' : '#EC4899'; ?> 100%);">
        <div class="text-4xl sm:text-5xl mb-3"><?php echo $emoji; ?></div>
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-2">
          <?php echo htmlspecialchars($popupData['title']); ?>
        </h2>
      </div>
      
      <div class="popup-body">
        <p class="text-slate-200 text-sm sm:text-base md:text-lg mb-6 leading-relaxed text-center">
          <?php echo nl2br(htmlspecialchars($popupData['description'])); ?>
        </p>
        
        <div class="space-y-3">
          <a href="<?php echo htmlspecialchars($popupData['form_link']); ?>" 
             target="_blank"
             rel="noopener noreferrer"
             class="popup-button block text-center text-sm sm:text-base"
             >
            <i class="fas fa-<?php echo $popupType === 'notice_board' ? 'paper-plane' : 'edit'; ?> mr-2"></i>
            <?php echo htmlspecialchars($popupData['button_text']); ?>
          </a>
          
          <button type="button" onclick="if(typeof window.closePopup === 'function') { window.closePopup('<?php echo $popupId; ?>'); } else { document.getElementById('<?php echo $popupId; ?>').classList.remove('active'); document.body.style.overflow = ''; }" 
                  class="w-full py-2 sm:py-3 px-4 sm:px-6 bg-white/10 text-slate-100 rounded-lg font-semibold border border-white/20 hover:bg-white/20 transition-all duration-300 text-sm sm:text-base cursor-pointer">
            Maybe Later
          </button>
        </div>
        
        <div class="mt-4 text-center">
          <label class="inline-flex items-center cursor-pointer text-xs sm:text-sm text-slate-300 hover:text-white">
            <input type="checkbox" id="dontShowAgain_<?php echo $popupId; ?>" class="mr-2 rounded">
            <span>Don't show this again</span>
          </label>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Popup Logic for <?php echo $popupType; ?>
    (function() {
      const popup = document.getElementById('<?php echo $popupId; ?>');
      const dontShowCheckbox = document.getElementById('dontShowAgain_<?php echo $popupId; ?>');
      const showFrequency = '<?php echo $popupData['show_frequency']; ?>';
      const storageKey = '<?php echo $storageKey; ?>';
      
      // Check if popup should be shown
      function shouldShowPopup() {
        // Check URL parameter for force show (for testing)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('showPopup') === 'true' || urlParams.get('testPopup') === 'true') {
          return true;
        }
        
        const today = new Date().toDateString();
        const dismissedKey = storageKey + 'Dismissed';
        
        // Check if permanently dismissed
        if (localStorage.getItem(dismissedKey) === 'true') {
          return false;
        }
        
        // Check show frequency
        if (showFrequency === 'always') {
          return true;
        } else if (showFrequency === 'daily') {
          const lastShown = localStorage.getItem(storageKey + 'LastShown');
          return lastShown !== today;
        } else if (showFrequency === 'once') {
          const shown = sessionStorage.getItem(storageKey + 'Shown');
          return shown !== 'true';
        }
        
        return true; // Default to show
      }
      
      // Show popup function
      function showPopup() {
        if (!popup) {
          popup = document.getElementById('<?php echo $popupId; ?>');
          if (!popup) {
            return;
          }
        }
        
        if (!shouldShowPopup()) {
          return;
        }
        
        // Delay based on popup type (notice board shows first, then placement)
        const delay = <?php echo $popupType === 'notice_board' ? 2000 : 4000; ?>;
        
          setTimeout(() => {
          // Check if another popup is currently showing
          const activePopups = document.querySelectorAll('.popup-overlay.active');
          if (activePopups.length > 0) {
            setTimeout(showPopup, 1000);
            return;
          }
          
          if (!popup) {
            popup = document.getElementById('<?php echo $popupId; ?>');
          }
          
          if (popup) {
            popup.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Track that popup was shown
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.get('showPopup') && !urlParams.get('testPopup')) {
            if (showFrequency === 'daily') {
                localStorage.setItem(storageKey + 'LastShown', new Date().toDateString());
            } else if (showFrequency === 'once') {
                sessionStorage.setItem(storageKey + 'Shown', 'true');
              }
            }
            }
        }, delay);
      }
      
      // Close popup function (global)
      if (typeof window.closePopup !== 'function') {
        window.closePopup = function(popupId) {
          const targetPopup = document.getElementById(popupId);
          if (targetPopup) {
            targetPopup.classList.remove('active');
          document.body.style.overflow = '';
          
          // Check if user selected "don't show again"
            const checkbox = document.getElementById('dontShowAgain_' + popupId);
            if (checkbox && checkbox.checked) {
              const popupStorageKey = popupId.replace('Popup', '') + 'Popup';
              localStorage.setItem(popupStorageKey + 'Dismissed', 'true');
              localStorage.setItem(popupStorageKey + 'LastShown', new Date().toDateString());
          }
        }
      };
      }
      
      // Initialize popup
      function initPopup() {
        if (!popup) {
          popup = document.getElementById('<?php echo $popupId; ?>');
          if (!popup) {
            return;
          }
        }
        showPopup();
      }
      
      // Initialize popup
      setTimeout(function() {
        initPopup();
      }, 500);
      
      // Fallback after window load
      window.addEventListener('load', function() {
        setTimeout(function() {
          if (!popup) {
            popup = document.getElementById('<?php echo $popupId; ?>');
          }
          if (popup && !popup.classList.contains('active')) {
      showPopup();
          }
        }, 1000);
      });
      
      // Close on ESC key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popup?.classList.contains('active')) {
          window.closePopup('<?php echo $popupId; ?>');
        }
      });
      
      // Close on overlay click
      popup?.addEventListener('click', (e) => {
        if (e.target === popup) {
          window.closePopup('<?php echo $popupId; ?>');
        }
      });
    })();
  </script>
  <?php endforeach; ?>
  
  <!-- Global Popup Fallback Script -->
  <script>
    (function() {
      const urlParams = new URLSearchParams(window.location.search);
      const isForceShow = urlParams.get('showPopup') === 'true' || urlParams.get('testPopup') === 'true';
      
      function ensurePopupsShow() {
        const allPopups = document.querySelectorAll('.popup-overlay');
        if (allPopups.length === 0) return;
        
        allPopups.forEach(function(popup) {
          const popupId = popup.id;
          const isActive = popup.classList.contains('active');
          
          if (isForceShow && !isActive) {
            popup.classList.add('active');
            document.body.style.overflow = 'hidden';
          } else if (!isForceShow && !isActive) {
            const popupType = popupId.replace('Popup', '');
            const storageKey = popupType + 'Popup';
            const popupFrequency = popup.getAttribute('data-frequency') || 'once';
            const today = new Date().toDateString();
            
            let shouldShow = false;
            if (popupFrequency === 'always') {
              shouldShow = true;
            } else if (popupFrequency === 'daily') {
              const lastShown = localStorage.getItem(storageKey + 'LastShown');
              shouldShow = lastShown !== today;
            } else if (popupFrequency === 'once') {
              const shown = sessionStorage.getItem(storageKey + 'Shown');
              shouldShow = shown !== 'true';
            } else {
              shouldShow = true;
            }
            
            if (shouldShow) {
              const delay = popupType === 'notice_board' ? 2000 : 4000;
              setTimeout(function() {
                if (!popup.classList.contains('active')) {
                  popup.classList.add('active');
                  document.body.style.overflow = 'hidden';
                  if (popupFrequency === 'daily') {
                    localStorage.setItem(storageKey + 'LastShown', today);
                  } else if (popupFrequency === 'once') {
                    sessionStorage.setItem(storageKey + 'Shown', 'true');
                  }
                }
              }, delay);
            }
          }
        });
      }
      
      setTimeout(ensurePopupsShow, 1500);
      window.addEventListener('load', function() {
        setTimeout(ensurePopupsShow, 2000);
      });
    })();
  </script>
  
  <script>
    // Map Navigation Functionality
    document.getElementById('turnOnNavigation')?.addEventListener('click', function() {
      window.open('https://www.google.com/maps/dir//28.693119,77.213579/@28.6943226,77.2108464,17z', '_blank');
    });
  </script>

  <script>
    // Disable keyboard shortcuts and developer tools
    document.addEventListener('keydown', function(e) {
      // Disable Ctrl+S
      if (e.ctrlKey && (e.key === 's' || e.key === 'S')) {
        e.preventDefault();
        return false;
      }
      
      // Disable F12
      if (e.key === 'F12' || e.keyCode === 123) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+Shift+I
      if (e.ctrlKey && e.shiftKey && (e.key === 'i' || e.key === 'I')) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+Shift+J
      if (e.ctrlKey && e.shiftKey && (e.key === 'j' || e.key === 'J')) {
        e.preventDefault();
        return false;
      }
      
      // Disable Ctrl+U (View Source)
      if (e.ctrlKey && (e.key === 'u' || e.key === 'U')) {
        e.preventDefault();
        return false;
      }

      // Disable Ctrl+Shift+C
      if (e.ctrlKey && e.shiftKey && (e.key === 'c' || e.key === 'C')) {
        e.preventDefault();
        return false;
      }
    });

    // Disable copy
    document.addEventListener('copy', function(e) {
      e.preventDefault();
      return false;
    });

    // Disable cut
    document.addEventListener('cut', function(e) {
      e.preventDefault();
      return false;
    });

    // Disable paste
    document.addEventListener('paste', function(e) {
      e.preventDefault();
      return false;
    });

    // Detect and prevent DevTools
    function detectDevTools() {
      const widthThreshold = window.outerWidth - window.innerWidth > 160;
      const heightThreshold = window.outerHeight - window.innerHeight > 160;
      
      if(widthThreshold || heightThreshold) {
        document.body.innerHTML = 'Developer tools are not allowed on this website.';
      }
    }

    // Check periodically for DevTools
    setInterval(detectDevTools, 1000);

    // Additional DevTools detection
    (function() {
      let devtools = {
        open: false,
        orientation: null
      };
      
      const threshold = 160;
      const emitEvent = (isOpen, orientation) => {
        window.dispatchEvent(new CustomEvent('devtoolschange', {
          detail: {
            isOpen,
            orientation
          }
        }));
      };

      setInterval(() => {
        const widthThreshold = window.outerWidth - window.innerWidth > threshold;
        const heightThreshold = window.outerHeight - window.innerHeight > threshold;
        const orientation = widthThreshold ? 'vertical' : 'horizontal';

        if (
          !(heightThreshold && widthThreshold) &&
          ((window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized) || widthThreshold || heightThreshold)
        ) {
          if (!devtools.open || devtools.orientation !== orientation) {
            emitEvent(true, orientation);
          }
          devtools.open = true;
          devtools.orientation = orientation;
        } else {
          if (devtools.open) {
            emitEvent(false, null);
          }
          devtools.open = false;
          devtools.orientation = null;
        }
      }, 500);

      // Disable console
      const consoleOutput = console.log;
      console.log = function() {
        consoleOutput.apply(console, ['Console output is disabled']);
      };
    })();

    // Prevent drag and drop
    document.addEventListener('dragstart', function(e) {
      e.preventDefault();
      return false;
    });

    // Prevent text selection (except inputs)
    document.addEventListener('selectstart', function(e) {
      if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        return false;
      }
    });

    // Additional protection against view source
    document.onkeypress = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onmousedown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onkeydown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }

    // Disable print
    window.addEventListener('keydown', function(e) {
      if (e.ctrlKey && (e.key === 'p' || e.key === 'P')) {
        e.cancelBubble = true;
        e.preventDefault();
        e.stopImmediatePropagation();
      }
    });
  </script>

  <?php include 'bot.php'; ?>
</body>
</html>