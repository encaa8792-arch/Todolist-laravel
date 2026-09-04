<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - TodoList</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-attachment: fixed;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }
        .bg-shapes span {
            position: absolute;
            display: block;
            border-radius: 50%;
            opacity: 0.15;
        }
        .bg-shapes span:nth-child(1) {
            width: 300px;
            height: 300px;
            background: #fff;
            top: -100px;
            left: -100px;
            animation: float1 20s linear infinite;
        }
        .bg-shapes span:nth-child(2) {
            width: 200px;
            height: 200px;
            background: #ff6b9d;
            top: 50%;
            right: -50px;
            animation: float2 15s linear infinite;
        }
        .bg-shapes span:nth-child(3) {
            width: 150px;
            height: 150px;
            background: #fff;
            bottom: -50px;
            left: 30%;
            animation: float3 18s linear infinite;
        }
        .bg-shapes span:nth-child(4) {
            width: 250px;
            height: 250px;
            background: #f093fb;
            bottom: 10%;
            right: 10%;
            animation: float1 25s linear infinite reverse;
        }
        .bg-shapes span:nth-child(5) {
            width: 180px;
            height: 180px;
            background: #764ba2;
            top: 30%;
            left: 10%;
            animation: float2 22s linear infinite;
        }
        @keyframes float1 {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(360deg); }
        }
        @keyframes float2 {
            0% { transform: translateY(-100px) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(-360deg); }
        }
        @keyframes float3 {
            0% { transform: translateX(0) rotate(0deg); }
            100% { transform: translateX(100vw) rotate(360deg); }
        }
        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
        }
        .register-card {
            background: rgba(20, 20, 30, 0.85);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255,255,255,0.1) inset;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .register-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .register-logo {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 36px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        }
        .register-title {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }
        .register-title span {
            color: #f093fb;
        }
        .register-subtitle {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: rgba(255,255,255,0.95);
            color: #2d3748;
            outline: none;
            transition: all 0.2s;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .form-group input:focus {
            border-color: #f093fb;
            box-shadow: 0 0 0 3px rgba(240, 147, 251, 0.2);
            background: #fff;
        }
        .form-group input::placeholder {
            color: rgba(100, 100, 120, 0.5);
        }
        .form-group input.is-invalid {
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        }
        .form-group .error-text {
            color: #ff8a8a;
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }
        .form-group.has-error .error-text {
            display: block;
        }
        .password-wrapper {
            position: relative;
        }
        .password-wrapper input {
            padding-right: 48px;
        }
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            opacity: 0.5;
            transition: opacity 0.2s, transform 0.2s;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .password-toggle:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }
        .password-toggle .bi {
            font-size: 18px;
            color: #666;
        }
        .password-strength {
            margin-top: 8px;
            display: flex;
            gap: 4px;
        }
        .strength-bar {
            flex: 1;
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
            transition: background 0.2s;
        }
        .strength-bar.active {
            background: #10b981;
        }
        .strength-bar.active.medium {
            background: #f59e0b;
        }
        .strength-bar.active.weak {
            background: #ef4444;
        }
        .strength-text {
            font-size: 11px;
            color: rgba(255,255,255,0.5);
            margin-top: 4px;
        }
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #ff6b9d, #ff8fa3);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
            margin-top: 8px;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #ff4d8a, #ff7a93);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.5);
        }
        .btn-register:active {
            background: linear-gradient(135deg, #e55a87, #ff6d83);
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(255, 107, 157, 0.3);
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0 24px 0;
        }
        .divider-line {
            flex: 1;
            height: 0.5px;
            background: rgba(255,255,255,0.2);
        }
        .divider-text {
            padding: 0 16px;
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }
        .login-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        .login-link a {
            color: #f093fb;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .alert-error {
            background: rgba(255, 100, 100, 0.2);
            color: #ff8a8a;
            border: 1px solid rgba(255, 100, 100, 0.3);
        }
        .alert-success {
            background: rgba(100, 255, 150, 0.2);
            color: #8affaa;
            border: 1px solid rgba(100, 255, 150, 0.3);
        }
        .password-hint {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            margin-top: 4px;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }
            .register-logo {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
            .register-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <div class="register-logo">📋</div>
                <h1 class="register-title">Daftar ke <span>TodoList</span></h1>
                <p class="register-subtitle">Buat akun untuk mulai mengelola tugas</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/register" id="registerForm">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="nameInput" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                    <span class="error-text">Nama wajib diisi</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="emailInput" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    <span class="error-text">Email wajib diisi</span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="passwordInput" placeholder="Minimal 8 karakter" required minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePassword('passwordInput', 'toggleIcon')" aria-label="Toggle password visibility">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                    </div>
                    <span class="strength-text" id="strengthText"></span>
                    <p class="password-hint">Minimal 8 karakter</p>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation" id="passwordConfirmationInput" placeholder="Ulangi password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('passwordConfirmationInput', 'toggleIconConfirm')" aria-label="Toggle password visibility">
                            <i class="bi bi-eye-slash" id="toggleIconConfirm"></i>
                        </button>
                    </div>
                    <span class="error-text" id="confirmError">Konfirmasi password tidak cocok</span>
                </div>
                <button type="submit" class="btn-register" id="submitBtn">Daftar</button>
            </form>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">atau</span>
                <span class="divider-line"></span>
            </div>

            <p class="login-link">
                Sudah punya akun? <a href="/login">Masuk sekarang</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }

        const passwordInput = document.getElementById('passwordInput');
        const confirmInput = document.getElementById('passwordConfirmationInput');
        const strengthBars = document.querySelectorAll('.strength-bar');
        const strengthText = document.getElementById('strengthText');
        const confirmError = document.getElementById('confirmError');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;

            strengthBars.forEach((bar, index) => {
                bar.classList.remove('active', 'weak', 'medium');
                if (index < strength) {
                    bar.classList.add('active');
                    if (strength <= 1) bar.classList.add('weak');
                    else if (strength === 2) bar.classList.add('medium');
                }
            });

            const labels = ['', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
            strengthText.textContent = labels[strength] || '';

            checkPasswordMatch();
        });

        confirmInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            if (confirm.length > 0) {
                if (password === confirm) {
                    confirmInput.classList.remove('is-invalid');
                    confirmInput.parentElement.parentElement.classList.remove('has-error');
                    confirmError.style.display = 'none';
                } else {
                    confirmInput.classList.add('is-invalid');
                    confirmInput.parentElement.parentElement.classList.add('has-error');
                    confirmError.style.display = 'block';
                }
            } else {
                confirmInput.classList.remove('is-invalid');
                confirmInput.parentElement.parentElement.classList.remove('has-error');
                confirmError.style.display = 'none';
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            if (password !== confirm) {
                e.preventDefault();
                confirmInput.classList.add('is-invalid');
                confirmInput.parentElement.parentElement.classList.add('has-error');
                confirmError.style.display = 'block';
                confirmInput.focus();
            }
        });
    </script>
</body>
</html>
