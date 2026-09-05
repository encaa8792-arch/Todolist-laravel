<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - TodoList</title>
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
        .forgot-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }
        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px 32px;
        }
        .forgot-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .forgot-logo {
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
        .forgot-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .forgot-subtitle {
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
            padding: 12px 16px;
            border: 2px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            outline: none;
            transition: all 0.2s;
        }
        .form-group input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .form-group input::placeholder {
            color: #94a3b8;
        }
        .btn-submit {
            width: 100%;
            background: #6366f1;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .btn-submit:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }
        .btn-submit:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
        }
        .btn-submit:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0 20px 0;
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
        .back-login-link {
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .back-login-link a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
        }
        .back-login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .info-text {
            font-size: 12px;
            color: #64748b;
            text-align: center;
            margin-top: 8px;
        }

        @media (max-width: 480px) {
            .forgot-card {
                padding: 32px 24px;
            }
            .forgot-logo {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
            .forgot-title {
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
    <div class="forgot-wrapper">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="forgot-logo"><i class="bi bi-journal-bookmark-fill"></i></div>
                <h1 class="forgot-title">Lupa Password</h1>
                <p class="forgot-subtitle">Kelola tugasmu dengan lebih mudah</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan email terdaftar" value="{{ old('email') }}" required autofocus>
                </div>
                <button type="submit" class="btn-submit" id="submitBtn">Kirim Link Reset</button>
                <p class="info-text">Kami akan mengirim link reset password ke email Anda</p>

                <div class="divider">
                    <span class="divider-line"></span>
                    <span class="divider-text">atau</span>
                    <span class="divider-line"></span>
                </div>

                <div class="back-login-link">
                    Sudah ingat password? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const savedBg = localStorage.getItem('userSelectedBg');
            if (savedBg) {
                document.body.style.backgroundImage = `url('${savedBg}')`;
                document.body.style.backgroundSize = 'cover';
                document.body.style.backgroundPosition = 'center';
                document.body.style.backgroundAttachment = 'fixed';
            } else {
                document.body.style.backgroundImage = "url('/images/bg-tulip.jpg')";
                document.body.style.backgroundSize = 'cover';
            }
        });
    </script>
</body>
</html>
