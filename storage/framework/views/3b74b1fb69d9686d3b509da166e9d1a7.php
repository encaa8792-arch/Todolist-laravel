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
            background-image: url('/images/bg-tulip.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 20px;
        }
        .login-wrapper {
            width: 100%;
            max-width: 400px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #ff6b9d, #ff8fa3);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 36px;
            box-shadow: 0 4px 20px rgba(255, 107, 157, 0.3);
        }
        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }
        .login-title span {
            color: #ff6b9d;
        }
        .login-subtitle {
            font-size: 13px;
            color: #9ca3af;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #ffc2d1;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: white;
            outline: none;
            transition: all 0.2s;
        }
        .form-group input:focus {
            border-color: #ff6b9d;
            box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.15);
        }
        .form-group input::placeholder {
            color: #bbb;
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
            color: #666;
        }
        .forgot-link {
            font-size: 13px;
            color: #ff6b9d;
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
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.4);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }
        .divider-line {
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }
        .divider-text {
            padding: 0 16px;
            font-size: 12px;
            color: #9ca3af;
        }
        .register-link {
            text-align: center;
            font-size: 13px;
            color: #666;
        }
        .register-link a {
            color: #ff6b9d;
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
            background: #ffeaea;
            color: #c0392b;
            border: 1px solid #ffcccc;
        }
        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
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