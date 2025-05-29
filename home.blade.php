<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Budget Bee</title>
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
    
    .count-up {
      visibility: hidden;
    }
  </style>
</head>
<body>
  <!-- Custom cursor effect -->
  <div class="cursor-effect hidden md:block"></div>

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



  <!-- Navbar with ID -->
  <header id="navig" class="flex justify-between items-center px-6 md:px-10 py-6 bg-black bg-opacity-70 transition-all duration-300">
    <h1 class="text-2xl font-bold">
      <a href="{{ url('/home') }}" class="gradient-text hover:underline">Budget Bee</a>
    </h1>

    <nav class="hidden md:flex space-x-8 text-white text-xl font-bold">
      <a href="{{ url('/services') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Services</a>
      <a href="{{ url('/how') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">How It Works</a>
      <a href="{{ url('/benefits') }}" class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Get The App</a>
    </nav>

     <div class="hidden md:flex space-x-4">
    <a href="{{ url('login') }}" class="flex items-center gap-2 text-white hover:text-yellow-400 transition">
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

  <!-- Hero section -->
  <section id="menu" class="grid md:grid-cols-2 px-6 md:px-10 py-16 items-center">
    <div class="space-y-6 animate-in">
      <div class="inline-block px-3 py-1 bg-yellow-400 bg-opacity-20 rounded-full mb-2">
        <span class="text-yellow-400 text-sm font-semibold">Secure Digital Payments</span>
      </div>
      
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">Fast And Simple <br> <span class="gradient-text typed-text">Digital Payment Solution</span></h2>
      
      <p class="text-gray-300">Many credit cards are lost by the users, stolen, or expired. But, these cards can still be used by others. This app can provide you with a card and necessary information. They also offer burner credit cards (single-use virtual cards).</p>
      
      <div class="space-x-4 flex flex-wrap gap-4">
       <a href="{{ url('/register') }}" class="bg-yellow-400 px-6 py-3 font-semibold rounded hover:bg-yellow-300 transition relative overflow-hidden group">
          <span class="relative z-10">Sign Up Now</span>
          <span class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300"></span>
       </a>
       <a href="{{ url('/benefits') }}" class="border border-white px-6 py-3 font-semibold rounded hover:bg-white hover:text-black transition group inline-block">
        Download App
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
        </a>

      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-10">
        <div class="feature-card p-4 rounded-lg animate-in">
          <h3 class="text-yellow-400 text-lg font-bold">01</h3>
          <p class="font-semibold">Financial Transaction</p>
          <p class="text-sm text-gray-400">Manage everything from the latter app or website</p>
        </div>
        <div class="feature-card p-4 rounded-lg animate-in" style="transition-delay: 100ms;">
          <h3 class="text-yellow-400 text-lg font-bold">02</h3>
          <p class="font-semibold">Easy To Use System</p>
          <p class="text-sm text-gray-400">Each card can have its own unique card holder name balance</p>
        </div>
        <div class="feature-card p-4 rounded-lg animate-in" style="transition-delay: 200ms;">
          <h3 class="text-yellow-400 text-lg font-bold">03</h3>
          <p class="font-semibold">Secure Payment</p>
          <p class="text-sm text-gray-400">All transactions are secured with encryption</p>
        </div>
        <div class="feature-card p-4 rounded-lg animate-in" style="transition-delay: 300ms;">
          <h3 class="text-yellow-400 text-lg font-bold">04</h3>
          <p class="font-semibold">Instant Notifications</p>
          <p class="text-sm text-gray-400">Get instant notifications for every transaction</p>
        </div>
        <div class="feature-card p-4 rounded-lg animate-in" style="transition-delay: 400ms;">
          <h3 class="text-yellow-400 text-lg font-bold">05</h3>
          <p class="font-semibold">24/7 Support</p>
          <p class="text-sm text-gray-400">Our support team is available 24/7 to assist you</p>
        </div>
        <div class="feature-card p-4 rounded-lg animate-in" style="transition-delay: 500ms;">
          <h3 class="text-yellow-400 text-lg font-bold">06</h3>
          <p class="font-semibold">Multiple Currencies</p>
          <p class="text-sm text-gray-400">Support for multiple currencies and international transactions</p>
        </div>
      </div>
    </div>
    
    <div class="relative mt-10 md:mt-0 animate-in" style="transition-delay: 300ms;">
        <div class="absolute -left-10 -top-10 w-40 h-40 bg-yellow-400 rounded-full filter blur-3xl opacity-20 animate-pulse"></div>
        <img src="./assests/freepik__the-style-is-candid-image-photography-with-natural__23922-removebg-preview.png" alt="Cards in hand" class="w-3/4 mx-auto rounded-xl shadow-2xl relative z-10">
        <div class="absolute -bottom-5 -right-5 w-40 h-40 bg-blue-500 rounded-full filter blur-3xl opacity-20 animate-pulse"></div>

      <div class="absolute bottom-10 right-10 bg-yellow-400 px-4 py-3 rounded-xl shadow-lg text-black font-semibold flex items-center space-x-2 card-hover">
        <span class="count-up font-bold text-xl" data-target="1240000">0</span>
        <div class="flex -space-x-2">
          <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-300"></div>
          <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-400"></div>
          <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-500"></div>
        </div>
        <span class="text-sm">World Active Users</span>
      </div>
    </div>
  </section>
  
  <!-- New section: Testimonials with slider -->
  <section class="px-6 md:px-10 py-16 bg-black bg-opacity-50">
    <h3 class="text-3xl font-bold text-center mb-10">What Our <span class="gradient-text">Users Say</span></h3>
    
    <div class="testimonial-slider relative overflow-hidden">
      <div class="testimonial-track flex transition-transform duration-500 ease-out">
        <!-- Testimonial 1 -->

        <div class="testimonial-slide min-w-full md:min-w-[33.333%] p-4">
        <div class="bg-gray-800 p-6 rounded-xl card-hover">
          <div class="flex items-center mb-4">
            <img src="{{ asset('images/sarah.jpg') }}" alt="Sarah" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400">
            <div class="ml-4">
              <h4 class="font-semibold">Sarah Johnson</h4>
              <p class="text-gray-400 text-sm">Business Owner</p>
            </div>
          </div>
          <p class="text-gray-300">"BUDGET BEE has completely transformed how I manage payments for my business. The virtual cards feature is a game-changer!"</p>
          <div class="flex mt-4 text-yellow-400">
            ★★★★★
          </div>
        </div>
      </div>

        
        <!-- Testimonial 2 -->
        <div class="testimonial-slide min-w-full md:min-w-[33.333%] p-4">
          <div class="bg-gray-800 p-6 rounded-xl card-hover">
            <div class="flex items-center mb-4">
              <img src="{{ asset('images/mark.jpg') }}" alt="mark" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400">
              <div class="ml-4">
                <h4 class="font-semibold">Mark Thompson</h4>
                <p class="text-gray-400 text-sm">Freelancer</p>
              </div>
            </div>
            <p class="text-gray-300">"I love how secure and easy to use BUDGET BEE is. It's become an essential tool for managing my client payments."</p>
            <div class="flex mt-4 text-yellow-400">
              ★★★★★
            </div>
          </div>
        </div>
        
        <!-- Testimonial 3 -->
        <div class="testimonial-slide min-w-full md:min-w-[33.333%] p-4">
          <div class="bg-gray-800 p-6 rounded-xl card-hover">
            <div class="flex items-center mb-4">
              <img src="{{ asset('images/james.jpg') }}" alt="james" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400">
              <div class="ml-4">
                <h4 class="font-semibold">James Wilson</h4>
                <p class="text-gray-400 text-sm">Developer</p>
              </div>
            </div>
            <p class="text-gray-300">"The instant notifications and detailed transaction history have made tracking my expenses so much easier."</p>
            <div class="flex mt-4 text-yellow-400">
              ★★★★★
            </div>
          </div>
        </div>
      </div>
      
      <div class="flex justify-center space-x-2 mt-6">
        <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-500 hover:bg-yellow-400 transition active"></button>
        <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-500 hover:bg-yellow-400 transition"></button>
        <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-500 hover:bg-yellow-400 transition"></button>
      </div>
    </div>
  </section>
  
  <!-- New section: Call to action -->
  <section class="px-6 md:px-10 py-16 text-center relative overflow-hidden">
    <div class="absolute inset-0 bg-yellow-400 opacity-10 transform -skew-y-6"></div>
    <div class="relative z-10 max-w-3xl mx-auto animate-in">
      <h3 class="text-4xl font-bold mb-6">Ready to <span class="gradient-text">Simplify</span> Your Payments?</h3>
      <p class="text-gray-300 mb-8">Join over 1.2 million users who have already switched to BUDGET BEE for secure and convenient digital payments.</p>
      <a href="{{ url('/how') }}" class="bg-yellow-400 px-8 py-4 rounded-xl text-black font-semibold hover:bg-yellow-300 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 glow">
        Get Started Today
      </a>

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

  <!-- Interaction Script -->
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
    
    // Custom cursor effect
    if (window.innerWidth > 768) {
      const cursor = document.querySelector('.cursor-effect');
      
      document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        cursor.classList.remove('hidden');
      });
      
      document.addEventListener('mouseout', () => {
        cursor.classList.add('hidden');
      });
      
      // Cursor effects on interactive elements
      const interactiveElements = document.querySelectorAll('a, button, .card-hover');
      interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
          cursor.style.width = '50px';
          cursor.style.height = '50px';
          cursor.style.backgroundColor = 'rgba(250, 204, 21, 0.2)';
        });
        
        el.addEventListener('mouseleave', () => {
          cursor.style.width = '20px';
          cursor.style.height = '20px';
          cursor.style.backgroundColor = 'rgba(250, 204, 21, 0.5)';
        });
      });
    }
    
    // Animation on scroll
    function checkVisibility() {
      const elements = document.querySelectorAll('.animate-in');
      const windowHeight = window.innerHeight;
      
      elements.forEach(element => {
        const position = element.getBoundingClientRect().top;
        
        if (position < windowHeight - 100) {
          element.classList.add('visible');
        }
      });
      
      // Check if counter is visible
      const counter = document.querySelector('.count-up');
      if (counter && counter.getBoundingClientRect().top < windowHeight - 100 && counter.style.visibility !== 'visible') {
        counter.style.visibility = 'visible';
        animateCounter(counter, parseInt(counter.getAttribute('data-target')));
      }
    }
    
    window.addEventListener('scroll', checkVisibility);
    window.addEventListener('load', checkVisibility);
    
    // Counter animation
    function animateCounter(element, target) {
      let current = 0;
      const increment = target / 100;
      const duration = 2000;
      const interval = duration / 100;
      
      const counter = setInterval(() => {
        current += increment;
        
        if (current >= target) {
          current = target;
          clearInterval(counter);
        }
        
        // Format the number with commas
        element.textContent = Math.floor(current).toLocaleString();
      }, interval);
    }
    
    // Testimonial slider
    const track = document.querySelector('.testimonial-track');
    const dots = document.querySelectorAll('.testimonial-dot');
    const slides = document.querySelectorAll('.testimonial-slide');
    const slideWidth = 100; // percentage
    let currentSlide = 0;
    
    // Initialize for mobile first
    updateSlides();
    
    // Update slides on window resize
    window.addEventListener('resize', updateSlides);
    
    function updateSlides() {
      // Adjust slide width based on screen size
      const slidesPerView = window.innerWidth < 768 ? 1 : 3;
      const width = 100 / slidesPerView;
      
      slides.forEach(slide => {
        slide.style.minWidth = `${width}%`;
      });
      
      // Reset to first slide
      goToSlide(0);
    }
    
    function goToSlide(slideIndex) {
      currentSlide = slideIndex;
      
      // Calculate the translation amount
      const slidesPerView = window.innerWidth < 768 ? 1 : 3;
      const slideWidth = 100 / slidesPerView;
      const offset = slideIndex * slideWidth;
      
      track.style.transform = `translateX(-${offset}%)`;
      
      // Update active dot
      dots.forEach((dot, index) => {
        if (index === slideIndex) {
          dot.classList.add('bg-yellow-400');
          dot.classList.remove('bg-gray-500');
        } else {
          dot.classList.remove('bg-yellow-400');
          dot.classList.add('bg-gray-500');
        }
      });
    }
    
    // Add click events to dots
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        goToSlide(index);
      });
    });
    
    // Auto-rotate slides every 5 seconds
    setInterval(() => {
      const nextSlide = (currentSlide + 1) % dots.length;
      goToSlide(nextSlide);
    }, 5000);
    
    // Typing effect for heading
    const text = "Digital Payment Solution";
    const typedText = document.querySelector('.typed-text');
    let i = 0;
    
    function typeWriter() {
      if (i < text.length) {
        typedText.textContent += text.charAt(i);
        i++;
        setTimeout(typeWriter, 100);
      }
    }
    
    // Reset and start typing animation
    function resetTypingAnimation() {
      typedText.textContent = '';
      i = 0;
      setTimeout(typeWriter, 1000);
    }
    
    // Start typing animation
    resetTypingAnimation();
    
    // Repeat typing animation every 10 seconds
    setInterval(resetTypingAnimation, 15000);
  </script>

</body>
</html>

<!-- //service , how it works, benefits , help , sign up, log in -->