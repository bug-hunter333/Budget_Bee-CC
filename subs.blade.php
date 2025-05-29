<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Budget Bee</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at center, #2b2b2b 0%, #1a1a1a 100%);
      color: white;
      overflow-x: hidden;
      position: relative;
    }
    canvas#bgCanvas {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
    }
    .cursor-effect {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      position: fixed;
      pointer-events: none;
      background-color: rgba(250, 204, 21, 0.5);
      z-index: 9999;
      transform: translate(-50%, -50%);
      transition: width 0.3s, height 0.3s, background-color 0.3s;
    }
    .gradient-text {
      background: linear-gradient(90deg, #ffeb3b, #ffc107);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .feature-card {
      transition: all 0.3s ease;
    }
    .feature-card:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: scale(1.05);
    }
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }
    .mobile-menu.open {
      transform: translateX(0);
    }
    .hero-animation {
      animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
      100% { transform: translateY(0px); }
    }
    .subscription-form {
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .hexagon {
      clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
    }
  </style>
</head>
<body>
  <canvas id="bgCanvas"></canvas>
  <div class="cursor-effect hidden md:block"></div>

  <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 h-full w-3/4 bg-black bg-opacity-95 z-50 p-10 flex flex-col">
    <div class="flex justify-end mb-10">
      <button id="closeMenu" class="text-white text-2xl">&times;</button>
    </div>
    <nav class="flex flex-col space-y-6 text-white text-4xl font-medium">
      <a href="#" class="hover:text-yellow-400 transition">Services</a>
      <a href="#" class="hover:text-yellow-400 transition">How It Works</a>
      <a href="#" class="hover:text-yellow-400 transition">Benefits</a>
      <div class="pt-6 space-y-4">
        <button class="w-full text-center py-3 border border-white rounded hover:bg-white hover:text-black transition">Log In</button>
        <button class="w-full text-center py-3 bg-yellow-400 rounded text-black font-semibold hover:bg-yellow-300 transition">Sign Up</button>
      </div>
    </nav>
  </div>

  <!-- Navbar with ID -->
  <header id="navig" class="flex justify-between items-center px-6 md:px-10 py-6 bg-black bg-opacity-70 transition-all duration-300">
     <h1 class="text-2xl font-bold">
      <a href="{{ url('/home') }}" class="gradient-text hover:underline">Budget Bee</a>
    </h1>

    <nav class="hidden md:flex space-x-8 text-white text-xl font-bold">
      <a href="#" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Services</a>
      <a href="#" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">How It Works</a>
      <a href="#" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Benefits</a>
    </nav>
    <div class="hidden md:flex space-x-4">
      <button class="text-white hover:text-yellow-400 transition">Log In</button>
      <button class="bg-yellow-400 px-4 py-2 rounded text-black font-semibold hover:bg-yellow-300 transition glow">Sign Up</button>
    </div>
    <button id="menuToggle" class="text-white md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </header>


  <!-- Hero Section with Subscription -->
  <section class="py-16 md:py-28 px-6 md:px-20 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-1/4 left-10 w-32 h-32 bg-yellow-400 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-10 w-40 h-40 bg-yellow-500 opacity-10 rounded-full blur-3xl"></div>
    
    <!-- Left Content -->
    <div class="md:w-1/2 z-10 mb-12 md:mb-0">
      <h1 class="text-4xl md:text-6xl font-bold mb-6">
        <span class="gradient-text">Smart Budgeting</span>
        <br />For Your Digital Life
      </h1>
      <p class="text-xl md:text-2xl text-gray-300 mb-8">Take control of your finances with our AI-powered budgeting tool. Save more, spend wisely, and reach your financial goals faster.</p>
      
      <!-- Subscription Form -->
      <div class="subscription-form p-6 rounded-lg max-w-md">
        <h3 class="text-xl font-semibold mb-4">Get Early Access</h3>
        <p class="text-gray-400 mb-4">Join our waitlist and get 3 months free when we launch!</p>
        <form class="space-y-4">
          <div>
            <input type="email" placeholder="Your email address" class="w-full bg-gray-800 border border-gray-700 px-4 py-3 rounded text-white focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
          </div>
          <div class="flex flex-col md:flex-row gap-4">
            <select class="bg-gray-800 border border-gray-700 px-4 py-3 rounded text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 flex-grow">
              <option value="" disabled selected>Select your plan</option>
              <option value="basic">Basic</option>
              <option value="pro">Pro</option>
              <option value="enterprise">Enterprise</option>
            </select>
            <button type="submit" class="bg-yellow-400 px-6 py-3 rounded text-black font-bold hover:bg-yellow-300 transition transform hover:scale-105">Subscribe</button>
          </div>
          <p class="text-xs text-gray-500">By subscribing, you agree to our Terms of Service and Privacy Policy.</p>
        </form>
      </div>
      
      <!-- Social Proof -->
      <div class="mt-8 flex items-center">
        <div class="flex -space-x-2">
          <div class="w-8 h-8 rounded-full bg-gray-600 border-2 border-gray-800"></div>
          <div class="w-8 h-8 rounded-full bg-gray-700 border-2 border-gray-800"></div>
          <div class="w-8 h-8 rounded-full bg-gray-800 border-2 border-gray-800"></div>
        </div>
        <p class="ml-4 text-gray-400"><span class="text-yellow-400 font-bold">5,000+</span> users already joined</p>
      </div>
    </div>
    
    <!-- Right Image/Animation -->
    <div class="md:w-1/2 flex justify-center items-center z-10">
      <div class="hero-animation relative">
        <!-- Mockup image/animation -->
        <div class="relative">
          <!-- Phone frame -->
          <div class="w-64 h-96 md:w-80 md:h-auto bg-gray-900 rounded-3xl p-3 shadow-2xl border border-gray-800">
            <!-- Screen content -->
            <div class="h-full w-full bg-gray-800 rounded-2xl overflow-hidden relative">
              <!-- App header -->
              <div class="bg-black p-4 flex justify-between items-center">
                <span class="gradient-text font-bold">Budget Bee</span>
                <div class="w-6 h-6 bg-yellow-400 rounded-full"></div>
              </div>
              
              <!-- App content -->
              <div class="p-4">
                <!-- Balance section -->
                <div class="bg-gray-900 rounded-xl p-4 mb-4">
                  <p class="text-gray-400 text-sm">Total Balance</p>
                  <p class="text-2xl font-bold">$8,240.50</p>
                  <div class="flex justify-between mt-2">
                    <span class="text-green-400 text-sm">+12% this month</span>
                    <span class="text-xs text-gray-500">Updated just now</span>
                  </div>
                </div>
                
                <!-- Categories -->
                <div class="space-y-3">
                  <div class="flex justify-between items-center p-2 bg-gray-900 rounded-lg">
                    <div class="flex items-center">
                      <div class="w-8 h-8 bg-blue-500 hexagon flex items-center justify-center mr-2"></div>
                      <span>Food</span>
                    </div>
                    <span>$320.45</span>
                  </div>
                  <div class="flex justify-between items-center p-2 bg-gray-900 rounded-lg">
                    <div class="flex items-center">
                      <div class="w-8 h-8 bg-purple-500 hexagon flex items-center justify-center mr-2"></div>
                      <span>Utilities</span>
                    </div>
                    <span>$145.00</span>
                  </div>
                  <div class="flex justify-between items-center p-2 bg-gray-900 rounded-lg">
                    <div class="flex items-center">
                      <div class="w-8 h-8 bg-yellow-500 hexagon flex items-center justify-center mr-2"></div>
                      <span>Savings</span>
                    </div>
                    <span>$625.75</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Decorative elements -->
          <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-yellow-400 rounded-full opacity-20 blur-md"></div>
          <div class="absolute -left-8 top-1/3 w-16 h-16 bg-yellow-400 rounded-full opacity-40 blur-md"></div>
        </div>
      </div>
    </div>
  </section>


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

  
  <!-- JavaScript -->
  <script>

      // Mobile menu toggle
      document.getElementById('menuToggle').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.add('open');
    });
    
    document.getElementById('closeMenu').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.remove('open');
    });
    
    // Button click interactions
    document.querySelectorAll('button:not(#menuToggle, #closeMenu, .testimonial-dot)').forEach(btn => {
      btn.addEventListener('click', () => {
        // Add a ripple effect
        const ripple = document.createElement('span');
        ripple.classList.add('absolute', 'inset-0', 'bg-white', 'opacity-20', 'rounded', 'pointer-events-none');
        btn.appendChild(ripple);
        
        setTimeout(() => {
          ripple.remove();
          alert('Feature coming soon!');
        }, 300);
      });
    });

    // Sticky Navbar with enhanced animation
    window.addEventListener('DOMContentLoaded', () => {
      const navig = document.getElementById("navig");
      const menu = document.getElementById("menu");

      window.addEventListener("scroll", () => {
        if (window.scrollY >= 50) {
          navig.classList.add("sticky", "top-0", "z-50", "py-4", "shadow-md");
          navig.classList.add("bg-black");
        } else {
          navig.classList.remove("sticky", "top-0", "z-50", "py-4", "shadow-md");
          if (window.scrollY < menu.offsetTop) {
            navig.classList.remove("bg-black");
          }
        }
      });
    });
    
    // Background Particles
    const canvas = document.getElementById("bgCanvas");
    const ctx = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    const particles = [];
    function createParticle() {
      return {
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.random() * 2 + 0.5,
        speedX: (Math.random() - 0.5) * 0.5,
        speedY: (Math.random() - 0.5) * 0.5,
        alpha: Math.random()
      };
    }
    for (let i = 0; i < 150; i++) {
      particles.push(createParticle());
    }
    function animateParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(p => {
        p.x += p.speedX;
        p.y += p.speedY;
        if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
        if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(250, 204, 21, ${p.alpha})`;
        ctx.fill();
      });
      requestAnimationFrame(animateParticles);
    }
    animateParticles();
    window.addEventListener("resize", () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });

    // Mobile Menu
    document.getElementById('menuToggle').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.add('open');
    });
    document.getElementById('closeMenu').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.remove('open');
    });

    // Cursor Effect
    document.addEventListener('mousemove', (e) => {
      const cursor = document.querySelector('.cursor-effect');
      if (cursor) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
      }
    });

    // Simple scroll animation
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
      gsap.from('.hero-animation', {
        y: 50,
        opacity: 0,
        duration: 1.2,
        scrollTrigger: {
          trigger: '.hero-animation',
          start: 'top bottom',
          end: 'bottom center',
          toggleActions: 'play none none reverse'
        }
      });
    }
  </script>
</body>
</html>