<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Professional Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #334155;
            background-image: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }
        
        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.12);
        }
        
        .left-section {
            flex: 1;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .left-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .left-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
            z-index: 2;
            position: relative;
        }
        
        .logo-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .welcome-text {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
            z-index: 2;
            position: relative;
        }
        
        .welcome-subtext {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 30px;
            z-index: 2;
            position: relative;
        }
        
        .features {
            list-style: none;
            margin-top: 30px;
            z-index: 2;
            position: relative;
        }
        
        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 15px;
        }
        
        .features li i {
            margin-right: 12px;
            background: rgba(255, 255, 255, 0.2);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        
        .right-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-header {
            margin-bottom: 40px;
        }
        
        .form-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #64748b;
            font-size: 15px;
        }
        
        .form-container {
            width: 100%;
        }
        
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .input-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #475569;
            font-size: 14px;
        }
        
        .input-field {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: #f8fafc;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #4f46e5;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .input-field:hover {
            border-color: #cbd5e1;
        }
        
        .input-icon {
            position: absolute;
            right: 16px;
            top: 42px;
            color: #94a3b8;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #4f46e5;
            cursor: pointer;
        }
        
        .remember-label {
            font-size: 14px;
            color: #475569;
            cursor: pointer;
        }
        
        .forgot-password {
            color: #4f46e5;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .forgot-password:hover {
            color: #7c3aed;
            text-decoration: underline;
        }
        
        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }
        
        .login-button:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #94a3b8;
            font-size: 14px;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }
        
        .divider span {
            padding: 0 15px;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .social-button {
            flex: 1;
            padding: 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .social-button:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }
        
        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }
        
        .signup-link a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-message {
            background: #10b981;
            color: white;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .left-section {
                padding: 40px 30px;
            }
            
            .right-section {
                padding: 40px 30px;
            }
            
            .welcome-text {
                font-size: 28px;
            }
        }
        
        @media (max-width: 480px) {
            .social-login {
                flex-direction: column;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .welcome-text {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Section with Branding -->
        <div class="left-section">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <span>PRODASH</span>
            </div>
            
            <h1 class="welcome-text">Welcome Back</h1>
            <p class="welcome-subtext">Sign in to your account to access the dashboard and manage your projects, team, and analytics.</p>
            
            <ul class="features">
                <li><i class="fas fa-check"></i> Secure & encrypted login</li>
                <li><i class="fas fa-check"></i> Access to all features</li>
                <li><i class="fas fa-check"></i> 24/7 customer support</li>
                <li><i class="fas fa-check"></i> Real-time analytics</li>
            </ul>
        </div>
        
        <!-- Right Section with Login Form -->
        <div class="right-section">
            <div class="form-header">
                <h2>Sign In</h2>
                <p>Enter your credentials to access your account</p>
            </div>
            
            <!-- Session Status -->
            <div class="status-message" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <span id="status-text">Session status message would appear here</span>
            </div>
            
            <!-- Social Login Options -->
            <div class="social-login">
                <button class="social-button">
                    <i class="fab fa-google"></i> Google
                </button>
                <button class="social-button">
                    <i class="fab fa-microsoft"></i> Microsoft
                </button>
            </div>
            
            <div class="divider">
                <span>Or continue with email</span>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="form-container">
                @csrf
                
                <!-- Email Address -->
                <div class="input-group">
                    <label class="input-label" for="email">Email Address</label>
                    <input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com">
                    <i class="fas fa-envelope input-icon"></i>
                    <div class="error-message" style="display: none;">
                        <i class="fas fa-exclamation-circle"></i>
                        <span id="email-error">Error message for email</span>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label class="input-label" for="password">Password</label>
                    <input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <i class="fas fa-lock input-icon"></i>
                    <div class="error-message" style="display: none;">
                        <i class="fas fa-exclamation-circle"></i>
                        <span id="password-error">Error message for password</span>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" class="remember-checkbox" name="remember">
                        <label for="remember_me" class="remember-label">Remember me</label>
                    </div>
                    
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
            
            <!-- Sign Up Link -->
            <div class="signup-link">
                Don't have an account? <a href="#">Sign up now</a>
            </div>
        </div>
    </div>
    
    <script>
        // Simulasi status message (bisa diaktifkan dengan menghapus style="display: none;" pada div status-message)
        document.addEventListener('DOMContentLoaded', function() {
            // Simulasi error pada input (untuk demo)
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            // Tambahkan event listener untuk validasi sederhana
            emailInput.addEventListener('blur', function() {
                if (emailInput.value && !emailInput.value.includes('@')) {
                    showError('email-error', 'Please enter a valid email address');
                } else {
                    hideError('email-error');
                }
            });
            
            passwordInput.addEventListener('blur', function() {
                if (passwordInput.value && passwordInput.value.length < 6) {
                    showError('password-error', 'Password must be at least 6 characters');
                } else {
                    hideError('password-error');
                }
            });
            
            // Fungsi helper untuk menampilkan error
            function showError(errorId, message) {
                const errorElement = document.getElementById(errorId);
                const errorContainer = errorElement.parentElement;
                errorElement.textContent = message;
                errorContainer.style.display = 'flex';
                
                // Tambahkan kelas error pada input
                const inputField = errorContainer.previousElementSibling;
                inputField.style.borderColor = '#ef4444';
            }
            
            // Fungsi helper untuk menyembunyikan error
            function hideError(errorId) {
                const errorElement = document.getElementById(errorId);
                const errorContainer = errorElement.parentElement;
                errorContainer.style.display = 'none';
                
                // Kembalikan border input ke normal
                const inputField = errorContainer.previousElementSibling;
                inputField.style.borderColor = '#e2e8f0';
            }
            
            // Simulasi login button click
            const loginButton = document.querySelector('.login-button');
            loginButton.addEventListener('click', function(e) {
                // Untuk demo, tidak melakukan submit sebenarnya
                console.log('Login attempt with:', {
                    email: emailInput.value,
                    password: passwordInput.value,
                    remember: document.getElementById('remember_me').checked
                });
            });
        });
    </script>
</body>
</html>