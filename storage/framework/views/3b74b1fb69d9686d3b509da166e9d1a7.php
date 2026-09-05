<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TodoList</title>
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
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 400px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 40px 32px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 36px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
        }
        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .login-subtitle {
            font-size: 13px;
            color: #64748b;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            color: #1e293b;
            outline: none;
            transition: all 0.2s;
        }
        .form-group input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .form-group input::placeholder {
            color: #94a3b8;
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
            color: #64748b;
        }
        .password-toggle:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
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
            accent-color: #6366f1;
            cursor: pointer;
        }
        .remember-me span {
            font-size: 13px;
            color: #1e293b;
        }
        .forgot-link {
            font-size: 13px;
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }
        .btn-login:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0 28px 0;
        }
        .divider-line {
            flex: 1;
            height: 0.5px;
            background: #e2e8f0;
        }
        .divider-text {
            padding: 0 16px;
            font-size: 12px;
            color: #94a3b8;
        }
        .register-link {
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .register-link a {
            color: #6366f1;
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
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
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
                <h1 class="login-title">Masuk ke TodoList</h1>
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
                        <button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="remember-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
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
            const icon = document.getElementById('toggleIcon');
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

        document.addEventListener('DOMContentLoaded', function() {
            const savedBg = localStorage.getItem('userSelectedBg');
            if (savedBg) {
                document.body.style.backgroundImage = `url('${savedBg}')`;
                document.body.style.backgroundSize = 'cover';
                document.body.style.backgroundPosition = 'center';
                document.body.style.backgroundAttachment = 'fixed';
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Todolist\resources\views/login.blade.php ENDPATH**/ ?>