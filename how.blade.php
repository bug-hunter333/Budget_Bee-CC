<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Budget Bee - How It Works</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at center, #2b2b2b 0%, #1a1a1a 100%);
      color: white;
      overflow-x: hidden;
    }
    
    .gradient-text {
      background: linear-gradient(90deg, #ffeb3b, #ffc107);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
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
    
    .step-card {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.5s ease;
      transform: translateY(50px);
      opacity: 0;
    }
    
    .step-card.animate {
      transform: translateY(0);
      opacity: 1;
    }
    
    .step-card:hover {
      transform: translateY(-10px) scale(1.02);
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 20px 40px rgba(250, 204, 21, 0.2);
    }
    
    .step-number {
      background: linear-gradient(135deg, #ffeb3b, #ffc107);
      color: #000;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.5rem;
      margin: 0 auto 1rem auto;
      position: relative;
      overflow: hidden;
    }
    
    .step-number::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255,255,255,0.5), transparent);
      transform: rotate(45deg);
      animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
      0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
      100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }
    
    .floating-elements {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
    }
    
    .floating-element {
      position: absolute;
      background: rgba(250, 204, 21, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .progress-line {
      position: absolute;
      left: 50%;
      top: 100%;
      width: 2px;
      height: 100px;
      background: linear-gradient(to bottom, #ffeb3b, transparent);
      transform: translateX(-50%);
      opacity: 0;
    }
    
    .progress-line.animate {
      opacity: 1;
      animation: drawLine 1s ease-in-out;
    }
    
    @keyframes drawLine {
      from { height: 0; }
      to { height: 100px; }
    }
    
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }
    
    .mobile-menu.open {
      transform: translateX(0);
    }
    
    .interactive-demo {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 2rem;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }
    
    .demo-step {
      opacity: 0;
      transform: translateX(50px);
      transition: all 0.5s ease;
    }
    
    .demo-step.active {
      opacity: 1;
      transform: translateX(0);
    }
    
    .demo-button {
      background: linear-gradient(135deg, #ffeb3b, #ffc107);
      color: #000;
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .demo-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(250, 204, 21, 0.3);
    }
    
    .demo-button::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
      transform: rotate(45deg) translateX(-100%);
      transition: transform 0.6s;
    }
    
    .demo-button:hover::before {
      transform: rotate(45deg) translateX(100%);
    }
  </style>
</head>
<body>
  <!-- Floating Background Elements -->
  <div class="floating-elements">
    <div class="floating-element" style="width: 50px; height: 50px; top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="floating-element" style="width: 30px; height: 30px; top: 20%; right: 15%; animation-delay: 1s;"></div>
    <div class="floating-element" style="width: 40px; height: 40px; bottom: 30%; left: 20%; animation-delay: 2s;"></div>
    <div class="floating-element" style="width: 25px; height: 25px; bottom: 10%; right: 10%; animation-delay: 3s;"></div>
  </div>

  <!-- Mobile Menu -->
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

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 md:px-10 py-6 bg-black bg-opacity-70 backdrop-filter backdrop-blur-lg fixed w-full z-40 transition-all duration-300">
     <h1 class="text-2xl font-bold">
      <a href="{{ url('/home') }}" class="gradient-text hover:underline">Budget Bee</a>
    </h1>

    <nav class="hidden md:flex space-x-8 text-white text-xl font-bold">
     <a href="{{ url('/services') }}"class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Services</a>
     <a href="{{ url('/how') }}" class="text-yellow-400 transition relative after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all">How It Works</a>
     <a href="{{ url('/benefits') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Get The App</a>
    </nav>

    <div class="hidden md:flex space-x-4">
     <a href="{{ url('/login') }}"class="flex items-center gap-2 text-white hover:text-yellow-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
        </svg>
        Log In
      </a>
      <a href="{{ url('/register') }}" class="bg-yellow-400 px-4 py-2 rounded text-black font-semibold hover:bg-yellow-300 transition glow">Sign Up</a>
    </div>

    <button id="menuToggle" class="text-white md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </header>

  <!-- Hero Section -->
  <section class="pt-32 pb-20 px-6 md:px-10 text-center">
    <h1 class="text-5xl md:text-7xl font-bold mb-6">
      <span class="gradient-text">How It Works</span>
    </h1>
    <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
      Transform your financial life in just a few simple steps. Our intelligent budgeting system makes managing money effortless and effective.
    </p>
  </section>

  <!-- Steps Section -->
  <section class="px-6 md:px-10 py-20">
    <div class="max-w-6xl mx-auto">
      <div class="grid md:grid-cols-3 gap-8 md:gap-12 relative">
        <!-- Step 1 -->
        <div class="step-card rounded-2xl p-8 text-center relative" data-step="1">
          <div class="step-number">1</div>
          <div class="progress-line"></div>
          <h3 class="text-2xl font-bold mb-4 gradient-text">Connect Your Accounts</h3>
          <p class="text-gray-300 text-lg leading-relaxed mb-6">Securely link your bank accounts, credit cards, and financial institutions in seconds with our bank-level encryption.</p>
          <div class="flex justify-center">
            <svg class="w-16 h-16 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
            </svg>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="step-card rounded-2xl p-8 text-center relative" data-step="2">
          <div class="step-number">2</div>
          <div class="progress-line"></div>
          <h3 class="text-2xl font-bold mb-4 gradient-text">AI Analyzes Your Spending</h3>
          <p class="text-gray-300 text-lg leading-relaxed mb-6">Our smart AI categorizes transactions, identifies patterns, and discovers opportunities to save money automatically.</p>
          <div class="flex justify-center">
            <svg class="w-16 h-16 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="step-card rounded-2xl p-8 text-center relative" data-step="3">
          <div class="step-number">3</div>
          <h3 class="text-2xl font-bold mb-4 gradient-text">Get Personalized Insights</h3>
          <p class="text-gray-300 text-lg leading-relaxed mb-6">Receive tailored recommendations, budget alerts, and actionable insights to reach your financial goals faster.</p>
          <div class="flex justify-center">
            <svg class="w-16 h-16 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Interactive Demo Section -->
  <section class="px-6 md:px-10 py-20">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">
        <span class="gradient-text">See It In Action</span>
      </h2>
      
      <div class="interactive-demo">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div class="md:w-1/2 mb-8 md:mb-0">
            <div id="demo-content" class="space-y-6">
              <div class="demo-step active" data-demo="1">
                <h3 class="text-2xl font-bold mb-4">📱 Connect Accounts</h3>
                <p class="text-gray-300 mb-4">Link your financial accounts with enterprise-grade security. We support over 12,000 banks and credit unions.</p>
                <div class="bg-gray-800 rounded-lg p-4">
                  <div class="flex items-center space-x-3">
                    <div class="w-4 h-4 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm">Chase Bank Connected ✓</span>
                  </div>
                </div>
              </div>

              <div class="demo-step" data-demo="2">
                <h3 class="text-2xl font-bold mb-4">🤖 AI Analysis</h3>
                <p class="text-gray-300 mb-4">Watch as our AI instantly categorizes your transactions and identifies spending patterns.</p>
                <div class="bg-gray-800 rounded-lg p-4 space-y-2">
                  <div class="flex justify-between">
                    <span>Groceries</span>
                    <span class="text-yellow-400">$342.50</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Entertainment</span>
                    <span class="text-yellow-400">$128.30</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Transportation</span>
                    <span class="text-yellow-400">$89.20</span>
                  </div>
                </div>
              </div>

              <div class="demo-step" data-demo="3">
                <h3 class="text-2xl font-bold mb-4">💡 Smart Insights</h3>
                <p class="text-gray-300 mb-4">Get personalized recommendations to optimize your spending and reach your goals.</p>
                <div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg p-4 text-black">
                  <div class="font-semibold">💡 Insight: You can save $180/month by switching to a different phone plan!</div>
                </div>
              </div>
            </div>
          </div>

          <div class="md:w-1/2 md:pl-8">
            <div class="space-y-4">
              <button class="demo-button w-full active" data-target="1">Step 1: Connect</button>
              <button class="demo-button w-full" data-target="2">Step 2: Analyze</button>
              <button class="demo-button w-full" data-target="3">Step 3: Optimize</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Grid -->
  <section class="px-6 md:px-10 py-20">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">
        <span class="gradient-text">Why Choose Budget Bee?</span>
      </h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">🔒</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Bank-Level Security</h3>
          <p class="text-gray-300">256-bit encryption and read-only access ensure your data stays secure.</p>
        </div>

        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">⚡</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Real-Time Updates</h3>
          <p class="text-gray-300">Get instant notifications and updates as your financial picture changes.</p>
        </div>

        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">📊</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Smart Analytics</h3>
          <p class="text-gray-300">Advanced AI provides insights that traditional budgeting apps miss.</p>
        </div>

        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">🎯</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Goal Tracking</h3>
          <p class="text-gray-300">Set and achieve financial goals with personalized milestones.</p>
        </div>

        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">📱</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Mobile First</h3>
          <p class="text-gray-300">Beautiful, intuitive mobile app that works seamlessly across devices.</p>
        </div>

        <div class="feature-card bg-gray-800 bg-opacity-50 rounded-2xl p-6 backdrop-filter backdrop-blur-lg border border-gray-700 hover:border-yellow-400 transition-all duration-300">
          <div class="text-4xl mb-4">🤝</div>
          <h3 class="text-xl font-bold mb-3 gradient-text">Expert Support</h3>
          <p class="text-gray-300">Access to financial advisors and 24/7 customer support when you need it.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="px-6 md:px-10 py-20 text-center">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-4xl md:text-6xl font-bold mb-8">
        <span class="gradient-text">Ready to Get Started?</span>
      </h2>
      <p class="text-xl md:text-2xl text-gray-300 mb-12 leading-relaxed">
        Join thousands of users who have transformed their financial lives with Budget Bee. Start your journey to financial freedom today.
      </p>
      <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
        <button class="bg-yellow-400 text-black px-8 py-4 rounded-full text-xl font-bold hover:bg-yellow-300 transition-all duration-300 hover:scale-105 glow">
          Start Free Trial
        </button>
        <button class="border-2 border-yellow-400 text-yellow-400 px-8 py-4 rounded-full text-xl font-bold hover:bg-yellow-400 hover:text-black transition-all duration-300">
          Watch Demo Video
        </button>
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
    // GSAP ScrollTrigger setup
    gsap.registerPlugin(ScrollTrigger);

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

    // Animate step cards on scroll
    gsap.utils.toArray('.step-card').forEach((card, index) => {
      gsap.to(card, {
        scrollTrigger: {
          trigger: card,
          start: "top 80%",
          end: "bottom 20%",
          onEnter: () => {
            card.classList.add('animate');
            // Animate progress line after card animation
            setTimeout(() => {
              const progressLine = card.querySelector('.progress-line');
              if (progressLine && index < 2) { // Don't show line on last card
                progressLine.classList.add('animate');
              }
            }, 300);
          }
        }
      });
    });

    // Interactive demo functionality
    const demoButtons = document.querySelectorAll('.demo-button');
    const demoSteps = document.querySelectorAll('.demo-step');

    demoButtons.forEach(button => {
      button.addEventListener('click', () => {
        const target = button.getAttribute('data-target');
        
        // Remove active class from all buttons and steps
        demoButtons.forEach(btn => btn.classList.remove('active', 'bg-yellow-300'));
        demoSteps.forEach(step => step.classList.remove('active'));
        
        // Add active class to clicked button and corresponding step
        button.classList.add('active', 'bg-yellow-300');
        document.querySelector(`[data-demo="${target}"]`).classList.add('active');
      });
    });

    // Animate feature cards on scroll
    gsap.utils.toArray('.feature-card').forEach((card, index) => {
      gsap.fromTo(card, 
        { 
          opacity: 0, 
          y: 50,
          scale: 0.9
        },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.6,
          delay: index * 0.1,
          scrollTrigger: {
            trigger: card,
            start: "top 85%",
            end: "bottom 15%"
          }
        }
      );
    });

    // Smooth reveal animations for sections
    gsap.utils.toArray('section').forEach(section => {
      const elements = section.querySelectorAll('h1, h2, h3, p, .demo-button, .interactive-demo');
      
      gsap.fromTo(elements,
        { 
          opacity: 0, 
          y: 30 
        },
        {
          opacity: 1,
          y: 0,
          duration: 0.8,
            stagger: 0.2,
            scrollTrigger: {
                trigger: section,
                start: "top 80%",
                end: "bottom 20%"
                }
        }

        );
    });
    </script>
</body>
</html>

