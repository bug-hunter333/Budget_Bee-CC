<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dynamic Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black min-h-screen flex items-center justify-center font-sans overflow-hidden relative">
  <!-- Dynamic cursor effect -->
  <div id="cursor" class="fixed w-8 h-8 rounded-full pointer-events-none z-50 mix-blend-difference transition-transform duration-100 ease-out"></div>
  
  <!-- Gold particles background -->
  <div id="particles" class="absolute inset-0 z-0"></div>
  
  <div class="bg-black/70 backdrop-blur-md p-10 rounded-2xl border border-amber-500/30 shadow-2xl shadow-amber-500/20 w-full max-w-md animate-fade-in z-10">
    <div class="text-center mb-6">
      <h1 class="text-4xl font-extrabold text-amber-400">Welcome Back</h1>
      <p class="text-amber-300/70 mt-1">Sign in to continue</p>
    </div>

    <!-- Login Form -->
    <form id="loginForm" class="space-y-6">
      <!-- Email -->
      <div class="group">
        <label for="email" class="block text-sm font-semibold text-amber-300">Email</label>
        <input type="email" id="email" name="email" required
          class="mt-1 w-full px-4 py-2 bg-black/50 border border-amber-500/50 text-amber-100 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-300 hover:border-amber-400">
        <p id="emailError" class="text-red-500 text-xs mt-1 hidden">Enter a valid email address</p>
      </div>

      <!-- Password -->
      <div class="group">
        <label for="password" class="block text-sm font-semibold text-amber-300">Password</label>
        <div class="relative">
          <input type="password" id="password" name="password" required
            class="mt-1 w-full px-4 py-2 bg-black/50 border border-amber-500/50 text-amber-100 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-300 hover:border-amber-400">
          <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 top-2 text-amber-400 hover:text-amber-300 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
            </svg>
          </button>
        </div>
        <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least 6 characters</p>
      </div>

      <!-- Remember Me & Forgot -->
      <div class="flex justify-between items-center text-sm">
        <label class="inline-flex items-center text-amber-300 hover:text-amber-200 transition cursor-pointer group">
          <input type="checkbox" class="form-checkbox bg-black border-amber-500 text-amber-500 rounded focus:ring-amber-500 focus:ring-offset-black">
          <span class="ml-2 group-hover:text-amber-200 transition-colors duration-300">Remember me</span>
        </label>
        <a href="#" class="text-amber-400 hover:text-amber-300 hover:underline transition-all duration-300">Forgot password?</a>
      </div>

      <!-- Login Button -->
      <div>
        <button type="submit" id="loginButton"
          class="button-glow w-full py-3 px-4 bg-gradient-to-r from-amber-700 to-amber-500 text-white font-bold rounded-lg hover:from-amber-600 hover:to-amber-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-amber-500 transition duration-300">
          Sign In
        </button>
      </div>

      <!-- Status Message -->
      <div id="statusMessage" class="hidden p-3 rounded-md text-center text-sm font-medium"></div>
    </form>

    <!-- Sign Up -->
    <div class="mt-6 text-center text-sm text-amber-300/70">
      Don't have an account?
      <a href="#" class="text-amber-400 hover:text-amber-300 hover:underline font-semibold transition-colors duration-300">Sign up</a>
    </div>
  </div>

  <!-- Styles -->
  <style>
    .animate-fade-in {
      animation: fadeIn 0.8s ease-in-out both;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .button-glow {
      box-shadow: 0 0 15px rgba(245, 158, 11, 0.5);
      transition: all 0.3s ease;
    }
    
    .button-glow:hover {
      box-shadow: 0 0 25px rgba(245, 158, 11, 0.7);
    }
    
    #cursor {
      background: radial-gradient(circle, rgba(245, 158, 11, 1) 0%, rgba(245, 158, 11, 0.8) 50%, rgba(245, 158, 11, 0) 100%);
      transform: translate(-50%, -50%);
    }
    
    input:focus {
      box-shadow: 0 0 8px rgba(245, 158, 11, 0.5);
    }
    
    /* Form element hover effect */
    .group:hover label {
      color: #f59e0b;
      transition: color 0.3s ease;
    }
  </style>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const loginForm = document.getElementById('loginForm');
      const emailInput = document.getElementById('email');
      const emailError = document.getElementById('emailError');
      const passwordInput = document.getElementById('password');
      const passwordError = document.getElementById('passwordError');
      const togglePassword = document.getElementById('togglePassword');
      const statusMessage = document.getElementById('statusMessage');
      const cursor = document.getElementById('cursor');
      const particles = document.getElementById('particles');
      
      // Custom cursor effect
      document.addEventListener('mousemove', function(e) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        
        // Scale effect on interactive elements
        const interactiveElements = document.querySelectorAll('button, a, input, label');
        let isOverInteractive = false;
        
        interactiveElements.forEach(element => {
          const rect = element.getBoundingClientRect();
          if (
            e.clientX >= rect.left &&
            e.clientX <= rect.right &&
            e.clientY >= rect.top &&
            e.clientY <= rect.bottom
          ) {
            isOverInteractive = true;
            cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
            cursor.style.backgroundColor = 'rgba(245, 158, 11, 0.3)';
          }
        });
        
        if (!isOverInteractive) {
          cursor.style.transform = 'translate(-50%, -50%) scale(1)';
          cursor.style.backgroundColor = 'transparent';
        }
      });
      
      // Create gold particles
      function createParticles() {
        particles.innerHTML = '';
        const particleCount = 50;
        
        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement('div');
          const size = Math.random() * 4 + 1;
          
          particle.style.position = 'absolute';
          particle.style.width = `${size}px`;
          particle.style.height = `${size}px`;
          particle.style.background = `rgba(245, 158, 11, ${Math.random() * 0.5 + 0.2})`;
          particle.style.borderRadius = '50%';
          particle.style.left = `${Math.random() * 100}%`;
          particle.style.top = `${Math.random() * 100}%`;
          particle.style.boxShadow = '0 0 10px rgba(245, 158, 11, 0.8)';
          particle.style.pointerEvents = 'none';
          
          // Animation
          particle.style.animation = `
            float ${Math.random() * 10 + 10}s linear infinite,
            pulse ${Math.random() * 2 + 2}s ease-in-out infinite alternate
          `;
          
          particles.appendChild(particle);
        }
      }
      
      // Input focus effects
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('input-focused');
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('input-focused');
        });
      });
      
      // Additional CSS for particles animation
      const style = document.createElement('style');
      style.textContent = `
        @keyframes float {
          0% { transform: translateY(0) translateX(0); }
          25% { transform: translateY(-20px) translateX(10px); }
          50% { transform: translateY(0) translateX(20px); }
          75% { transform: translateY(20px) translateX(10px); }
          100% { transform: translateY(0) translateX(0); }
        }
        
        @keyframes pulse {
          0% { opacity: 0.3; }
          100% { opacity: 0.7; }
        }
        
        .input-focused label {
          color: #f59e0b !important;
          transform: translateY(-2px);
          transition: all 0.3s ease;
        }
      `;
      document.head.appendChild(style);
      
      // Initialize particles
      createParticles();
      
      // Toggle password visibility
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Change the eye icon (simplified version)
        togglePassword.innerHTML = type === 'password' 
          ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>'
          : '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" /><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" /></svg>';
      });
      
      // Button hover effect
      const loginButton = document.getElementById('loginButton');
      loginButton.addEventListener('mouseover', function() {
        cursor.style.transform = 'translate(-50%, -50%) scale(2)';
        cursor.style.opacity = '0.7';
      });
      
      loginButton.addEventListener('mouseout', function() {
        cursor.style.transform = 'translate(-50%, -50%) scale(1)';
        cursor.style.opacity = '1';
      });
      
      // Form validation
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        
        // Validate email
        if (!validateEmail(emailInput.value)) {
          emailError.classList.remove('hidden');
          shake(emailInput);
          isValid = false;
        } else {
          emailError.classList.add('hidden');
        }
        
        // Validate password
        if (passwordInput.value.length < 6) {
          passwordError.classList.remove('hidden');
          shake(passwordInput);
          isValid = false;
        } else {
          passwordError.classList.add('hidden');
        }
        
        if (isValid) {
          // If client-side validation passes, simulate server interaction
          simulateLogin();
        }
      });
      
      // Shake effect for invalid inputs
      function shake(element) {
        element.classList.add('error-shake');
        setTimeout(() => {
          element.classList.remove('error-shake');
        }, 500);
      }
      
      // Add shake animation
      const shakeStyle = document.createElement('style');
      shakeStyle.textContent = `
        @keyframes shake {
          0%, 100% { transform: translateX(0); }
          10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
          20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .error-shake {
          animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
          border-color: #ef4444 !important;
        }
      `;
      document.head.appendChild(shakeStyle);
      
      // Email validation function
      function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
      }
      
      // Simulate login process
      function simulateLogin() {
        const loginButton = document.getElementById('loginButton');
        
        // Disable button and show loading state
        loginButton.disabled = true;
        loginButton.innerHTML = `
          <svg class="animate-spin -ml-1 mr-2 inline-block h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Signing in...
        `;
        
        // In a real application, this would be an AJAX call to your backend
        setTimeout(function() {
          // Get form data
          const formData = new FormData(loginForm);
          const email = formData.get('email');
          
          // Example response - in production, this would come from the server
          if (email === "admin@example.com") {
            showStatus("Login successful! Redirecting...", "success");
            setTimeout(function() {
              window.location.href = "dashboard.html"; // In a real app, redirect to dashboard
            }, 1500);
          } else {
            showStatus("Invalid email or password. Please try again.", "error");
            loginButton.disabled = false;
            loginButton.innerHTML = "Sign In";
          }
        }, 1500);
      }
      
      // Show status message
      function showStatus(message, type) {
        statusMessage.textContent = message;
        statusMessage.classList.remove('hidden', 'bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800', 'bg-amber-100', 'text-amber-800');
        
        if (type === "success") {
          statusMessage.classList.add('bg-amber-100', 'text-amber-800', 'border', 'border-amber-500');
        } else if (type === "error") {
          statusMessage.classList.add('bg-red-100', 'text-red-800', 'border', 'border-red-500');
        }
        
        statusMessage.classList.remove('hidden');
        
        // Add entrance animation
        statusMessage.style.animation = 'fadeIn 0.3s ease-out forwards';
      }
    });
  </script>
</body>
</html>