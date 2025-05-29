<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, rgba(251, 191, 36, 0.8) 0%, rgba(251, 191, 36, 0.2) 70%, transparent 100%);
            border-radius: 50%;
            pointer-events: none;
            animation: float 8s infinite ease-in-out;
        }
        
        .particle:nth-child(odd) {
            animation-delay: -2s;
            animation-duration: 12s;
        }
        
        .particle:nth-child(even) {
            animation-delay: -4s;
            animation-duration: 10s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            50% {
                transform: translateY(-100px) translateX(50px);
                opacity: 0.7;
            }
            90% {
                opacity: 1;
            }
        }
        
        .form-container {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(251, 191, 36, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        .input-field {
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(251, 191, 36, 0.3);
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            border-color: rgb(251, 191, 36);
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
            outline: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, rgb(234, 88, 12) 0%, rgb(251, 191, 36) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(251, 191, 36, 0.4);
        }
        
        .floating-label {
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        .floating-label.active {
            transform: translateY(-24px);
            font-size: 0.75rem;
            color: rgb(251, 191, 36);
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen bg-black overflow-hidden relative">
    <!-- Animated Background Particles -->
    <div id="particles" class="absolute inset-0 pointer-events-none"></div>
    
    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center p-4 relative z-10">
        <div class="form-container w-full max-w-md p-8 rounded-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-yellow-400 mb-2">Create Account</h1>
                <p class="text-yellow-600">Join us to get started</p>
            </div>
            
            <!-- Registration Form -->
            <form id="registrationForm" class="space-y-6">
                <!-- Full Name Field -->
                <div class="relative">
                    <label class="floating-label absolute left-4 top-4 text-yellow-600 pointer-events-none">Full Name</label>
                    <input 
                        type="text" 
                        id="fullName"
                        class="input-field w-full px-4 py-4 rounded-lg text-white placeholder-transparent"
                        required
                    >
                </div>
                
                <!-- Email Field -->
                <div class="relative">
                    <label class="floating-label absolute left-4 top-4 text-yellow-600 pointer-events-none">Email Address</label>
                    <input 
                        type="email" 
                        id="email"
                        class="input-field w-full px-4 py-4 rounded-lg text-white placeholder-transparent"
                        required
                    >
                    <div id="emailError" class="text-red-400 text-sm mt-1 hidden"></div>
                </div>
                
                <!-- Password Field -->
                <div class="relative">
                    <label class="floating-label absolute left-4 top-4 text-yellow-600 pointer-events-none">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        class="input-field w-full px-4 py-4 pr-12 rounded-lg text-white placeholder-transparent"
                        required
                    >
                    <button type="button" id="togglePassword" class="absolute right-4 top-4 text-yellow-400 hover:text-yellow-300">
                        <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="password-strength bg-gray-700 w-full">
                            <div id="strengthBar" class="password-strength h-full bg-red-500 w-0"></div>
                        </div>
                        <p id="strengthText" class="text-xs text-gray-400 mt-1">Password strength</p>
                    </div>
                </div>
                
                <!-- Confirm Password Field -->
                <div class="relative">
                    <label class="floating-label absolute left-4 top-4 text-yellow-600 pointer-events-none">Confirm Password</label>
                    <input 
                        type="password" 
                        id="confirmPassword"
                        class="input-field w-full px-4 py-4 rounded-lg text-white placeholder-transparent"
                        required
                    >
                    <div id="confirmError" class="text-red-400 text-sm mt-1 hidden"></div>
                </div>
                
                <!-- Terms and Conditions -->
                <div class="flex items-center space-x-3">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        class="w-4 h-4 rounded border-yellow-600 bg-transparent focus:ring-yellow-400"
                        required
                    >
                    <label for="terms" class="text-yellow-600 text-sm">
                        I agree to the <a href="#" class="text-yellow-400 hover:underline">Terms & Conditions</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn-primary w-full py-4 rounded-lg text-white font-semibold text-lg shadow-lg"
                >
                    Create Account
                </button>
                
                <!-- Sign In Link -->
                <div class="text-center mt-6">
                    <p class="text-yellow-600">
                        Already have an account? 
                        <a href="#" class="text-yellow-400 hover:underline font-medium">Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-black border border-yellow-400 rounded-2xl p-8 max-w-sm w-full text-center">
            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-yellow-400 mb-2">Account Created!</h3>
            <p class="text-yellow-600 mb-6">Welcome aboard! Your account has been successfully created.</p>
            <button id="closeModal" class="btn-primary px-6 py-2 rounded-lg">Continue</button>
        </div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        // Floating label animation
        function initFloatingLabels() {
            const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
            
            inputs.forEach(input => {
                const label = input.previousElementSibling;
                
                input.addEventListener('focus', () => {
                    label.classList.add('active');
                });
                
                input.addEventListener('blur', () => {
                    if (input.value === '') {
                        label.classList.remove('active');
                    }
                });
                
                // Check if input has value on load
                if (input.value !== '') {
                    label.classList.add('active');
                }
            });
        }
        
        // Password visibility toggle
        function initPasswordToggle() {
            const toggleButton = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            toggleButton.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'text') {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    `;
                } else {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
            });
        }
        
        // Password strength checker
        function initPasswordStrength() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            passwordInput.addEventListener('input', () => {
                const password = passwordInput.value;
                const strength = calculatePasswordStrength(password);
                
                strengthBar.style.width = strength.percentage + '%';
                strengthBar.className = `password-strength h-full ${strength.color} transition-all duration-300`;
                strengthText.textContent = strength.text;
                strengthText.className = `text-xs mt-1 ${strength.textColor}`;
            });
        }
        
        function calculatePasswordStrength(password) {
            let score = 0;
            
            if (password.length >= 8) score += 25;
            if (password.match(/[a-z]/)) score += 25;
            if (password.match(/[A-Z]/)) score += 25;
            if (password.match(/[0-9]/)) score += 25;
            if (password.match(/[^a-zA-Z0-9]/)) score += 25;
            
            if (score <= 25) {
                return { percentage: 25, color: 'bg-red-500', text: 'Weak', textColor: 'text-red-400' };
            } else if (score <= 50) {
                return { percentage: 50, color: 'bg-yellow-500', text: 'Fair', textColor: 'text-yellow-400' };
            } else if (score <= 75) {
                return { percentage: 75, color: 'bg-blue-500', text: 'Good', textColor: 'text-blue-400' };
            } else {
                return { percentage: 100, color: 'bg-green-500', text: 'Strong', textColor: 'text-green-400' };
            }
        }
        
        // Form validation
        function initFormValidation() {
            const form = document.getElementById('registrationForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const emailError = document.getElementById('emailError');
            const confirmError = document.getElementById('confirmError');
            
            // Email validation
            emailInput.addEventListener('blur', () => {
                const email = emailInput.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    emailError.textContent = 'Please enter a valid email address';
                    emailError.classList.remove('hidden');
                    emailInput.classList.add('border-red-500');
                } else {
                    emailError.classList.add('hidden');
                    emailInput.classList.remove('border-red-500');
                }
            });
            
            // Password confirmation
            confirmPasswordInput.addEventListener('blur', () => {
                if (confirmPasswordInput.value && confirmPasswordInput.value !== passwordInput.value) {
                    confirmError.textContent = 'Passwords do not match';
                    confirmError.classList.remove('hidden');
                    confirmPasswordInput.classList.add('border-red-500');
                } else {
                    confirmError.classList.add('hidden');
                    confirmPasswordInput.classList.remove('border-red-500');
                }
            });
            
            // Form submission
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Validate all fields
                if (validateForm()) {
                    showSuccessModal();
                }
            });
        }
        
        function validateForm() {
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!fullName || !email || !password || !confirmPassword || !terms) {
                alert('Please fill in all fields and accept the terms.');
                return false;
            }
            
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }
            
            if (password.length < 8) {
                alert('Password must be at least 8 characters long.');
                return false;
            }
            
            return true;
        }
        
        function showSuccessModal() {
            const modal = document.getElementById('successModal');
            modal.classList.remove('hidden');
            
            // Add entrance animation
            setTimeout(() => {
                modal.firstElementChild.style.transform = 'scale(1)';
                modal.firstElementChild.style.opacity = '1';
            }, 10);
        }
        
        function initModalClose() {
            const closeButton = document.getElementById('closeModal');
            const modal = document.getElementById('successModal');
            
            closeButton.addEventListener('click', () => {
                modal.classList.add('hidden');
                // Reset form
                document.getElementById('registrationForm').reset();
                // Reset floating labels
                document.querySelectorAll('.floating-label').forEach(label => {
                    label.classList.remove('active');
                });
            });
        }
        
        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            initFloatingLabels();
            initPasswordToggle();
            initPasswordStrength();
            initFormValidation();
            initModalClose();
        });
    </script>
</body>
</html>