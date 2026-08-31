<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TodoList</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
        }
        .login-wrapper {
            width: 100%;
            max-width: 400px;
        }
        .login-card {
            background: rgba(20, 20, 30, 0.85);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255,255,255,0.1) inset;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo {
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
        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }
        .login-title span {
            color: #f093fb;
        }
        .login-subtitle {
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
            padding: 14px 16px 14px 16px;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: rgba(255,255,255,0.08);
            color: #2d3748;
            outline: none;
            transition: all 0.2s;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .form-group input:focus {
            border-color: #f093fb;
            box-shadow: 0 0 0 3px rgba(240, 147, 251, 0.2);
            background: rgba(255,255,255,0.12);
        }
        .form-group input::placeholder {
            color: rgba(255,255,255,0.4);
        }
        .form-group input:-webkit-autofill,
        .form-group input:-webkit-autofill:hover,
        .form-group input:-webkit-autofill:focus,
        .form-group input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px rgba(255,255,255,0.08) inset !important;
            -webkit-text-fill-color: #2d3748 !important;
            caret-color: #2d3748 !important;
            border: 2px solid rgba(255,255,255,0.2);
        }
        .form-group input:-internal-autofill-selected {
            background-color: rgba(255,255,255,0.08) !important;
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
            transition: opacity 0.2s;
            padding: 0;
        }
        .password-toggle:hover {
            opacity: 1;
        }
        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #ff6b9d;
            cursor: pointer;
        }
        .remember-me span {
            font-size: 13px;
            color: rgba(255,255,255,0.8);
        }
        .forgot-link {
            font-size: 13px;
            color: #f093fb;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }
        .btn-login {
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
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #ff4d8a, #ff7a93);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.5);
        }
        .btn-login:active {
            background: linear-gradient(135deg, #e55a87, #ff6d83);
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(255, 107, 157, 0.3);
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0 28px 0;
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
        .register-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        .register-link a {
            color: #f093fb;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
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

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }
            .login-logo {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
            .login-title {
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
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">📋</div>
                <h1 class="login-title">Masuk ke <span>TodoList</span></h1>
                <p class="login-subtitle">Kelola tugasmu dengan lebih mudah</p>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Email atau Username</label>
                    <input type="text" name="email" placeholder="Masukkan email atau username" value="<?php echo e(old('email')); ?>" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="passwordInput" placeholder="Masukkan password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">👁️</button>
                    </div>
                </div>
                <div class="remember-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>
                <button type="submit" class="btn-login"> Masuk </button>
            </form>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">atau</span>
                <span class="divider-line"></span>
            </div>

            <p class="register-link">
                Belum punya akun? <a href="/register">Daftar sekarang</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const toggle = document.querySelector('.password-toggle');
            if (input.type === 'password') {
                input.type = 'text';
                toggle.textContent = '🙈';
            } else {
                input.type = 'password';
                toggle.textContent = '👁️';
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Todolist\resources\views/login.blade.php ENDPATH**/ ?>