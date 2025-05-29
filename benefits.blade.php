<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get the App - Budget Bee</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at center, #2b2b2b 0%, #1a1a1a 100%);
      color: white;
      overflow-x: hidden;
    }
    
    .animate-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .animate-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }
    
    .glow {
      animation: glow 2s infinite alternate;
    }
    
    @keyframes glow {
      from {
        box-shadow: 0 0 5px 0 rgba(250, 204, 21, 0.5);
      }
      to {
        box-shadow: 0 0 20px 5px rgba(250, 204, 21, 0.7);
      }
    }
    
    .float {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
    
    .pulse-ring {
      animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    }
    
    @keyframes pulse-ring {
      0% {
        transform: scale(0.33);
        opacity: 1;
      }
      80%, 100% {
        transform: scale(1.2);
        opacity: 0;
      }
    }
    
    .gradient-text {
      background: linear-gradient(90deg, #ffeb3b, #ffc107);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    
    .phone-mockup {
      background: linear-gradient(145deg, #333, #111);
      border-radius: 30px;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }
    
    .phone-mockup::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }
    
    .feature-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }
    
    .feature-card:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: translateY(-5px);
      border-color: rgba(250, 204, 21, 0.5);
    }
    
    .qr-container {
      background: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }
    
    .qr-container:hover {
      transform: scale(1.05);
    }
    
    .download-stats {
      background: linear-gradient(135deg, rgba(250, 204, 21, 0.1), rgba(255, 193, 7, 0.1));
      border: 1px solid rgba(250, 204, 21, 0.3);
    }
    
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }
    
    .mobile-menu.open {
      transform: translateX(0);
    }
    
    .floating-element {
      position: absolute;
      animation: float 6s ease-in-out infinite;
    }
    
    .floating-element:nth-child(2) {
      animation-delay: -2s;
    }
    
    .floating-element:nth-child(3) {
      animation-delay: -4s;
    }
  </style>
</head>
<body>
  <!-- Floating Background Elements -->
  <div class="floating-element top-20 left-10 w-20 h-20 bg-yellow-400 rounded-full opacity-10"></div>
  <div class="floating-element top-40 right-20 w-16 h-16 bg-yellow-300 rounded-full opacity-10"></div>
  <div class="floating-element bottom-40 left-20 w-24 h-24 bg-yellow-500 rounded-full opacity-10"></div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 h-full w-3/4 bg-black bg-opacity-95 z-50 p-10 flex flex-col">
    <div class="flex justify-end mb-10">
      <button id="closeMenu" class="text-white text-2xl">&times;</button>
    </div>
    <nav class="flex flex-col space-y-6 text-white text-4xl font-medium">
      <a href="#" class="hover:text-yellow-400 transition">Services</a>
      <a href="#" class="hover:text-yellow-400 transition">How It Works</a>
      <a href="#" class="hover:text-yellow-400 transition">Download It</a>
      <div class="pt-6 space-y-4">
        <button class="w-full text-center py-3 border border-white rounded hover:bg-white hover:text-black transition">Log In</button>
        <button class="w-full text-center py-3 bg-yellow-400 rounded text-black font-semibold hover:bg-yellow-300 transition">Sign Up</button>
      </div>
    </nav>
  </div>

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 md:px-10 py-6 bg-black bg-opacity-70 transition-all duration-300 fixed w-full z-40">
     <h1 class="text-2xl font-bold">
      <a href="{{ url('/home') }}" class="gradient-text hover:underline">Budget Bee</a>
    </h1>

    <nav class="hidden md:flex space-x-8 text-white text-xl font-bold">
                  <a href="{{ url('/services') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Services</a>
                  <a href="{{ url('/how') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">How It Works</a>
                  <a href="{{ url('/benefits') }}" class="text-yellow-400 transition relative after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all">Get The App</a>
    </nav>

    <div class="hidden md:flex space-x-4">
      <a href="{{ url('/login') }}"class="flex items-center gap-2 text-white hover:text-yellow-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
        </svg>
        Log In
      </a>
      <a href="{{ url('/register') }}"class="bg-yellow-400 px-4 py-2 rounded text-black font-semibold hover:bg-yellow-300 transition glow">Sign Up</a>
    </div>

    <button id="menuToggle" class="text-white md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </header>

  <!-- Hero Section -->
  <section class="pt-32 pb-20 px-6 md:px-10 text-center">
    <div class="animate-in">
      <h1 class="text-5xl md:text-7xl font-bold mb-8">
        Get the <span class="gradient-text">Budget Bee</span> App
      </h1>
      <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto">
        Take control of your finances anywhere, anytime. Download our award-winning app and start your journey to financial freedom today.
      </p>
      
      <!-- Download Stats -->
      <div class="download-stats rounded-2xl p-8 mb-16 max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center">
            <div class="text-4xl font-bold gradient-text" id="downloads">0</div>
            <div class="text-gray-300 mt-2">Total Downloads</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold gradient-text" id="rating">0</div>
            <div class="text-gray-300 mt-2">App Store Rating</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold gradient-text" id="users">0</div>
            <div class="text-gray-300 mt-2">Active Users</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- App Features Section -->
  <section class="py-20 px-6 md:px-10">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Phone Mockup -->
        <div class="animate-in flex justify-center">
          <div class="phone-mockup w-80 h-96 flex items-center justify-center relative">
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-b from-yellow-400 to-yellow-600 opacity-20"></div>
            <div class="relative z-10 text-center">
              <div class="text-6xl mb-4">📱</div>
              <div class="text-xl font-semibold">Budget Bee</div>
              <div class="text-sm text-gray-300 mt-2">Your Financial Companion</div>
            </div>
          </div>
        </div>

        <!-- Features Grid -->
        <div class="animate-in space-y-6">
          <h2 class="text-4xl font-bold mb-8">Why Choose Our App?</h2>
          
          <div class="feature-card rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold">Lightning Fast</h3>
            </div>
            <p class="text-gray-300">Track expenses and manage budgets in real-time with our optimized mobile experience.</p>
          </div>

          <div class="feature-card rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold">Bank-Level Security</h3>
            </div>
            <p class="text-gray-300">Your financial data is protected with 256-bit encryption and biometric authentication.</p>
          </div>

          <div class="feature-card rounded-xl p-6">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold">Smart Analytics</h3>
            </div>
            <p class="text-gray-300">Get personalized insights and recommendations to improve your financial health.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- QR Code Section -->
  <section class="py-20 px-6 md:px-10 bg-gradient-to-b from-transparent to-black/30">
    <div class="max-w-4xl mx-auto text-center">
      <div class="animate-in">
        <h2 class="text-4xl md:text-5xl font-bold mb-8">
          Scan to Download
        </h2>
        <p class="text-xl text-gray-300 mb-16">
          Scan the QR code with your phone camera to download Budget Bee directly from your app store
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-2xl mx-auto">
          <!-- Google Play Store QR -->
          <div class="text-center">
            <div class="qr-container inline-block mb-6">
              <div id="playstore-qr" class="w-48 h-48 mx-auto"></div>
            </div>
            <div class="flex items-center justify-center space-x-3 mb-4">
              <svg class="w-8 h-8 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.92 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
              </svg>
              <h3 class="text-xl font-semibold">Google Play</h3>
            </div>
            <p class="text-gray-400">Available on Android</p>
          </div>

          <!-- Apple App Store QR -->
          <div class="text-center">
            <div class="qr-container inline-block mb-6">
              <div id="appstore-qr" class="w-48 h-48 mx-auto"></div>
            </div>
            <div class="flex items-center justify-center space-x-3 mb-4">
              <svg class="w-8 h-8 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
              </svg>
              <h3 class="text-xl font-semibold">App Store</h3>
            </div>
            <p class="text-gray-400">Available on iOS</p>
          </div>
        </div>

        <!-- Alternative Download Links -->
        <div class="mt-16 space-y-4 md:space-y-0 md:space-x-6 md:flex md:justify-center">
          <a href="https://play.google.com/store" target="_blank" class="inline-flex items-center px-8 py-4 bg-black rounded-xl hover:bg-gray-800 transition border border-gray-700 hover:border-yellow-400">
            <svg class="w-8 h-8 text-green-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
              <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.92 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
            </svg>
            <div class="text-left">
              <div class="text-xs text-gray-400">GET IT ON</div>
              <div class="text-lg font-semibold">Google Play</div>
            </div>
          </a>

          <a href="https://apps.apple.com" target="_blank" class="inline-flex items-center px-8 py-4 bg-black rounded-xl hover:bg-gray-800 transition border border-gray-700 hover:border-yellow-400">
            <svg class="w-8 h-8 text-blue-500 mr-3" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
            </svg>
            <div class="text-left">
              <div class="text-xs text-gray-400">Download on the</div>
              <div class="text-lg font-semibold">App Store</div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

   <!-- Footer -->
  <footer class="bg-black bg-opacity-90 px-6 md:px-10 py-10">
    <div class="grid md:grid-cols-4 gap-10">
      <div>
        <h3 class="gradient-text text-2xl font-bold mb-4">BUDGET BEE</h3>
        <p class="text-gray-400">Your trusted digital payment solution for secure and convenient transactions.</p>
      </div>
      <div>
        <h4 class="font-semibold mb-4">Quick Links</h4>
        <ul class="space-y-2 text-gray-400">
          <li><a href="#" class="hover:text-yellow-400 transition">Home</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">Features</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">About Us</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-4">Legal</h4>
        <ul class="space-y-2 text-gray-400">
          <li><a href="#" class="hover:text-yellow-400 transition">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">Terms of Service</a></li>
          <li><a href="#" class="hover:text-yellow-400 transition">Cookie Policy</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold mb-4">Newsletter</h4>
        <p class="text-gray-400 mb-4">Subscribe to get updates on new features and promotions.</p>
        <form class="flex">
          <input type="email" placeholder="Your email" class="bg-gray-800 px-4 py-2 rounded-l text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 flex-grow">
          <button class="bg-yellow-400 px-4 py-2 rounded-r text-black hover:bg-yellow-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </form>
      </div>
    </div>
    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
      <p>© 2025 BUDGET BEE. All rights reserved.</p>
    </div>
  </footer>


  <script>
    // Mobile menu functionality
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');

    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.add('open');
    });

    closeMenu.addEventListener('click', () => {
      mobileMenu.classList.remove('open');
    });

    // Animate on scroll
    gsap.registerPlugin(ScrollTrigger);

    const animateElements = document.querySelectorAll('.animate-in');
    animateElements.forEach(element => {
      gsap.fromTo(element, 
        { opacity: 0, y: 50 },
        {
          opacity: 1,
          y: 0,
          duration: 1,
          scrollTrigger: {
            trigger: element,
            start: "top 80%",
            end: "bottom 20%",
            toggleActions: "play none none reverse"
          }
        }
      );
    });

    // Animated counters
    function animateCounter(id, target, suffix = '') {
      const element = document.getElementById(id);
      let current = 0;
      const increment = target / 100;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        element.textContent = Math.floor(current).toLocaleString() + suffix;
      }, 20);
    }

    // Trigger counters when in view
    ScrollTrigger.create({
      trigger: ".download-stats",
      start: "top 80%",
      onEnter: () => {
        animateCounter('downloads', 250000, '+');
        animateCounter('rating', 4.8, '★');
        animateCounter('users', 50000, '+');
      }
    });

    // Generate QR Codes
    function generateQR(elementId, url) {
      const qr = qrcode(0, 'M');
      qr.addData(url);
      qr.make();
      document.getElementById(elementId).innerHTML = qr.createImgTag(4);
    }

    // Generate QR codes when page loads
    window.addEventListener('load', () => {
      generateQR('playstore-qr', 'https://play.google.com/store/apps/details?id=com.budgetbee.app');
      generateQR('appstore-qr', 'https://apps.apple.com/app/budget-bee/id123456789');
    });

    // Floating animation for background elements
    gsap.to(".floating-element", {
      y: -20,
      duration: 3,
      ease: "power2.inOut",
      repeat: -1,
      yoyo: true,
      stagger: 0.5
    });

    // Phone mockup animation
    gsap.to(".phone-mockup", {
      rotateY: 5,
      rotateX: 5,
      duration: 4,
      ease: "power2.inOut",
      repeat: -1,
      yoyo: true
    });

    // Parallax effect for hero section
    gsap.to(".floating-element", {
      y: -50,
      scrollTrigger: {
        trigger: "body",
        start: "top top",
        end: "bottom top",
        scrub: true
      }
    });
  </script>
</body>
</html>