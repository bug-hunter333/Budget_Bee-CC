<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Bee - Services</title>
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
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
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
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-card:hover {
            background: linear-gradient(145deg, rgba(250, 204, 21, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(250, 204, 21, 0.3);
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .service-icon {
            transition: all 0.5s ease;
        }

        .feature-card:hover .service-icon {
            transform: rotateY(360deg) scale(1.1);
        }

        .pricing-card {
            transition: all 0.4s ease;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .pricing-card:hover {
            transform: translateY(-10px) scale(1.03);
            background: linear-gradient(145deg, rgba(250, 204, 21, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border-color: rgba(250, 204, 21, 0.5);
            box-shadow: 0 25px 50px rgba(250, 204, 21, 0.2);
        }

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: black;
            transform: translateY(-2px);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .progress-bar {
            height: 4px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
            transform-origin: left;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .testimonial-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            background: rgba(250, 204, 21, 0.1);
            border-color: rgba(250, 204, 21, 0.3);
        }

        .pulse-ring {
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.33);
                opacity: 1;
            }

            80%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Custom cursor effect -->
    <div class="cursor-effect hidden md:block"></div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="mobile-menu fixed top-0 right-0 h-full w-3/4 bg-black bg-opacity-95 z-50 p-10 flex flex-col">
        <div class="flex justify-end mb-10">
            <button id="closeMenu" class="text-white text-2xl">&times;</button>
        </div>
        <nav class="flex flex-col space-y-6 text-white text-4xl font-medium">
            <a href="{{ url('/services') }}" class="hover:text-yellow-400 transition">Services</a>
            <a href="{{ url('/how') }}" class="hover:text-yellow-400 transition">How It Works</a>
            <a href="{{ url('/benefits') }}" class="hover:text-yellow-400 transition">Benefits</a>
            <div class="hidden md:flex space-x-4">
                <a href="{{ url('login') }}"
                    class="flex items-center gap-2 text-white hover:text-yellow-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7-7l7 7-7 7" />
                    </svg>
                    Log In
                </a>

                <a href="{{ url('/register') }}"
                    class="bg-yellow-400 px-4 py-2 rounded text-black font-semibold hover:bg-yellow-300 transition glow">Sign
                    Up</a>
            </div>
        </nav>
    </div>

    <!-- Navbar -->
    <header id="navbar"
        class="fixed w-full top-0 z-40 flex justify-between items-center px-6 md:px-10 py-6 bg-black bg-opacity-70 backdrop-filter backdrop-blur-lg transition-all duration-300">
         <h1 class="text-2xl font-bold">
      <a href="{{ url('/home') }}" class="gradient-text hover:underline">Budget Bee</a>
    </h1>

        <nav class="hidden md:flex space-x-8 text-white text-xl font-bold">
            <a href="{{ url('/services') }}"
                class="text-yellow-400 transition relative after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all">Services</a>
            <a href="{{ url('/how') }}"
                class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">How
                It Works</a>
            <a href="{{ url('/benefits') }}"
                class="hover:text-yellow-400 transition relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-400 after:left-0 after:bottom-[-5px] after:transition-all hover:after:w-full">Get The App</a>
        </nav>

        <div class="hidden md:flex space-x-4">
            <a href="{{ url('login') }}" class="flex items-center gap-2 text-white hover:text-yellow-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
                </svg>
                Log In
            </a>

            <a href="{{ url('/register') }}"
                class="bg-yellow-400 px-4 py-2 rounded text-black font-semibold hover:bg-yellow-300 transition glow">Sign
                Up</a>
        </div>

        <button id="menuToggle" class="text-white md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center px-6 pt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 via-transparent to-purple-600/10"></div>
        <div class="text-center z-10 max-w-4xl mx-auto">
            <div class="relative inline-block mb-6">
                <div class="absolute inset-0 bg-yellow-400 rounded-full pulse-ring"></div>
                <div
                    class="relative bg-yellow-400 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-in">
                Our <span class="gradient-text">Services</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 animate-in">
                Comprehensive financial solutions designed to elevate your business
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center animate-in">
                <button
                    class="bg-yellow-400 px-8 py-4 rounded-lg text-black font-semibold text-lg hover:bg-yellow-300 transition glow">
                    Explore Services
                </button>
                <button
                    class="border-2 border-yellow-400 px-8 py-4 rounded-lg text-yellow-400 font-semibold text-lg hover:bg-yellow-400 hover:text-black transition">
                    Get Started
                </button>
            </div>
        </div>
    </section>

    <!-- Service Tabs -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Choose Your <span class="gradient-text">Service
                        Category</span></h2>
                <p class="text-xl text-gray-300">Select a category to explore our specialized offerings</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <button
                    class="tab-button active px-8 py-3 rounded-full border border-yellow-400 text-white font-semibold"
                    data-tab="payment">
                    Payment Solutions
                </button>
                <button class="tab-button px-8 py-3 rounded-full border border-gray-600 text-gray-300 font-semibold"
                    data-tab="business">
                    Business Tools
                </button>
            </div>

            <!-- Tab Content -->
            <div id="tabContent" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Payment Solutions Tab -->
                <div class="tab-content active" data-content="payment">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-yellow-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Virtual Cards</h3>
                        <p class="text-gray-300 text-center mb-6">Create unlimited virtual cards for secure online
                            transactions with customizable spending limits.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Instant card
                                generation</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Custom spending
                                limits</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Real-time
                                notifications</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content active" data-content="payment">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-green-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Instant Transfers</h3>
                        <p class="text-gray-300 text-center mb-6">Send and receive money instantly with our advanced
                            transfer system and minimal fees.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> 24/7 availability
                            </li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Low transaction
                                fees</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Global reach</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content active" data-content="payment">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-blue-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Payment Tracking</h3>
                        <p class="text-gray-300 text-center mb-6">Monitor all your transactions in real-time with
                            detailed analytics and insights.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Real-time
                                monitoring</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Detailed analytics
                            </li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Custom alerts</li>
                        </ul>
                    </div>
                </div>

                <!-- Business Tools Tab (Hidden by default) -->
                <div class="tab-content hidden" data-content="business">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-purple-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Invoice Management</h3>
                        <p class="text-gray-300 text-center mb-6">Create, send, and track professional invoices with
                            automated follow-ups.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Professional
                                templates</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Automated
                                reminders</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Payment
                                integration</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content hidden" data-content="business">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Team Management</h3>
                        <p class="text-gray-300 text-center mb-6">Manage team access, permissions, and financial
                            workflows efficiently.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Role-based access
                            </li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Approval workflows
                            </li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Activity tracking
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content hidden" data-content="business">
                    <div class="feature-card p-8 rounded-2xl h-full">
                        <div
                            class="service-icon bg-indigo-400 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center">Expense Management</h3>
                        <p class="text-gray-300 text-center mb-6">Track, categorize, and manage business expenses with
                            smart automation.</p>
                        <div class="progress-bar mb-4"></div>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Smart
                                categorization</li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Receipt scanning
                            </li>
                            <li class="flex items-center"><span class="text-yellow-400 mr-2">✓</span> Budget alerts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 px-6 bg-gradient-to-r from-gray-900 to-black">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Choose Your <span class="gradient-text">Plan</span></h2>
                <p class="text-xl text-gray-300">Flexible pricing options for businesses of all sizes</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Starter Plan -->
                <div class="pricing-card p-8 rounded-2xl text-center">
                    <h3 class="text-2xl font-bold mb-4">Starter</h3>
                    <div class="text-4xl font-bold mb-6">
                        <span class="gradient-text">$19</span>
                        <span class="text-lg text-gray-400">/month</span>
                    </div>
                    <ul class="space-y-3 mb-8 text-gray-300">
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Up to 5
                            virtual cards</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Basic
                            analytics</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Email
                            support</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Mobile
                            app access</li>
                    </ul>
                    <a href="{{ url('/benefits') }}" class="block text-center w-full bg-yellow-400 py-3 rounded-lg text-black font-semibold hover:bg-yellow-300 transition">
                     Get Started
                    </a>

                </div>

                <!-- Professional Plan -->
                <div class="pricing-card p-8 rounded-2xl text-center border-2 border-yellow-400 relative">
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-semibold">
                        Most Popular
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Professional</h3>
                    <div class="text-4xl font-bold mb-6">
                        <span class="gradient-text">$49</span>
                        <span class="text-lg text-gray-400">/month</span>
                    </div>
                    <ul class="space-y-3 mb-8 text-gray-300">
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            Unlimited virtual cards</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            Advanced analytics</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            Priority support</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Team
                            management</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> API
                            access</li>
                    </ul>
                     <a href="{{ url('/benefits') }}" class="block text-center w-full bg-yellow-400 py-3 rounded-lg text-black font-semibold hover:bg-yellow-300 transition">
                     Get Started
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card p-8 rounded-2xl text-center">
                    <h3 class="text-2xl font-bold mb-4">Enterprise</h3>
                    <div class="text-4xl font-bold mb-6">
                        <span class="gradient-text">Custom</span>
                    </div>
                    <ul class="space-y-3 mb-8 text-gray-300">
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            Everything in Pro</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> Custom
                            integrations</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            Dedicated support</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span> SLA
                            guarantee</li>
                        <li class="flex items-center justify-center"><span class="text-yellow-400 mr-2">✓</span>
                            White-label options</li>
                    </ul>
                    <a href="{{ url('/benefits') }}" class="block text-center w-full bg-yellow-400 py-3 rounded-lg text-black font-semibold hover:bg-yellow-300 transition">
                     Get Started
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
                <p class="text-gray-400">Your trusted digital payment solution for secure and convenient transactions.
                </p>
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
                    <input type="email" placeholder="Your email"
                        class="bg-gray-800 px-4 py-2 rounded-l text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 flex-grow">
                    <button class="bg-yellow-400 px-4 py-2 rounded-r text-black hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
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
        // Custom cursor effect
        const cursor = document.querySelector('.cursor-effect');
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = `${e.pageX}px`;
            cursor.style.top = `${e.pageY}px`;
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMenu = document.getElementById('closeMenu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
        });

        // Tab functionality
        const tabs = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(tc => tc.classList.add('hidden'));
                tab.classList.add('active');
                const contentToShow = document.querySelector(`.tab-content[data-content="${tab.dataset.tab}"]`);
                contentToShow.classList.remove('hidden');
            });
        });

        // Animate elements on scroll
        gsap.registerPlugin(ScrollTrigger);

        gsap.utils.toArray('.animate-in').forEach((elem) => {
            gsap.from(elem, {
                opacity: 0,
                y: 20,
                duration: 0.8,
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse',
                },
            });
        });
        // Progress bar animation
        const progressBar = document.querySelector('.progress-bar');
        gsap.to(progressBar, {
            scaleX: 1,
            duration: 1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: progressBar,
                start: 'top 80%',
                toggleActions: 'play none none reverse',
            },
        });
        // Cursor effect on hover
        const serviceIcons = document.querySelectorAll('.service-icon');

        serviceIcons.forEach(icon => {
            icon.addEventListener('mouseenter', () => {
                cursor.style.width = '30px';
                cursor.style.height = '30px';
                cursor.style.backgroundColor = 'rgba(250, 204, 21, 0.7)';
            });
            icon.addEventListener('mouseleave', () => {
                cursor.style.width = '20px';
                cursor.style.height = '20px';
                cursor.style.backgroundColor = 'rgba(250, 204, 21, 0.5)';
            });
        });
    </script>
</body>

</html>