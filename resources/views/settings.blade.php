@extends('layouts.app')

@section('title', 'Pengaturan')

@section('styles')
    .settings-container {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }
    .settings-header {
        text-align: center;
        margin-bottom: 24px;
    }
    .settings-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    .settings-header h1 span {
        color: #ff6b9d;
    }
    .settings-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 12px;
    }
    .tab-btn {
        padding: 10px 20px;
        border: none;
        background: transparent;
        color: #888;
        font-size: 14px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        border-radius: 10px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tab-btn:hover {
        background: #fff0f5;
        color: #ff6b9d;
    }
    .tab-btn.active {
        background: #ff6b9d;
        color: white;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
        transition: all 0.2s;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: #ff6b9d;
        background: white;
        outline: none;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .btn-simpan {
        background: linear-gradient(135deg, #ff6b9d, #ff8fa3);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(255,107,157,0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,107,157,0.4);
    }
    .settings-card {
        background: #fff0f5;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 16px;
    }
    .settings-card h3 {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .toggle-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,182,193,0.3);
    }
    .toggle-row:last-child {
        border-bottom: none;
    }
    .toggle-label {
        font-size: 13px;
        color: #555;
    }
    .toggle-sublabel {
        font-size: 11px;
        color: #999;
        margin-top: 2px;
    }
    .toggle-switch {
        position: relative;
        width: 48px;
        height: 26px;
    }
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.3s;
        border-radius: 26px;
    }
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }
    .toggle-switch input:checked + .toggle-slider {
        background-color: #ff6b9d;
    }
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(22px);
    }
    .theme-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    .theme-option {
        padding: 16px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .theme-option:hover {
        border-color: #ffc2d1;
    }
    .theme-option.active {
        border-color: #ff6b9d;
        background: #fff0f5;
    }
    .theme-preview {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 0 auto 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .theme-name {
        font-size: 12px;
        font-weight: 500;
        color: #555;
    }
    .bg-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .bg-option {
        padding: 12px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .bg-option:hover {
        border-color: #ffc2d1;
    }
    .bg-option.active {
        border-color: #ff6b9d;
        background: #fff0f5;
    }
    .bg-preview {
        width: 100%;
        height: 60px;
        border-radius: 8px;
        margin-bottom: 8px;
        object-fit: cover;
    }
    .bg-name {
        font-size: 11px;
        font-weight: 500;
        color: #555;
    }
    .success-msg {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 16px;
        text-align: center;
        font-size: 13px;
        font-weight: 500;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .theme-options {
            grid-template-columns: repeat(2, 1fr);
        }
        .bg-options {
            grid-template-columns: repeat(2, 1fr);
        }
        .settings-tabs {
            flex-wrap: wrap;
        }
        .tab-btn {
            padding: 8px 14px;
            font-size: 13px;
        }
    }
@endsection

@section('content')
    <div class="settings-container">
        <div class="settings-header">
            <h1>Pengaturan <span>TodoList</span></h1>
        </div>

        <div class="settings-tabs">
            <button class="tab-btn active" onclick="openTab('akun')">
                <span>👤</span> Akun
            </button>
            <button class="tab-btn" onclick="openTab('notifikasi')">
                <span>🔔</span> Notifikasi
            </button>
            <button class="tab-btn" onclick="openTab('tampilan')">
                <span>🎨</span> Tampilan
            </button>
        </div>

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div id="akun" class="tab-content active">
            <form method="POST" action="/settings/profile">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
                    </div>
                </div>
                <button type="submit" class="btn-simpan">
                    💾 Simpan Perubahan
                </button>
            </form>
        </div>

        <div id="notifikasi" class="tab-content">
            <div class="settings-card">
                <h3>🔔 Pengaturan Notifikasi</h3>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Notifikasi Email</div>
                        <div class="toggle-sublabel">Kirim notifikasi ke email</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Pengingat Deadline</div>
                        <div class="toggle-sublabel">Ingatkan saat deadline mendekat</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Tugas Baru</div>
                        <div class="toggle-sublabel">Notifikasi saat ada tugas baru</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Tugas Selesai</div>
                        <div class="toggle-sublabel">Notifikasi saat tugas ditandai selesai</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <div id="tampilan" class="tab-content">
            <div class="settings-card">
                <h3>🎨 Tema</h3>
                <div class="theme-options">
                    <div class="theme-option active">
                        <div class="theme-preview" style="background: linear-gradient(135deg, #ff6b9d, #ff8fa3);">🌸</div>
                        <div class="theme-name">Pink</div>
                    </div>
                    <div class="theme-option">
                        <div class="theme-preview" style="background: linear-gradient(135deg, #667eea, #764ba2);">💜</div>
                        <div class="theme-name">Ungu</div>
                    </div>
                    <div class="theme-option">
                        <div class="theme-preview" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">💙</div>
                        <div class="theme-name">Biru</div>
                    </div>
                    <div class="theme-option">
                        <div class="theme-preview" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">💚</div>
                        <div class="theme-name">Hijau</div>
                    </div>
                </div>
            </div>

            <div class="settings-card">
                <h3>🖼️ Background</h3>
                <div class="bg-options">
                    <div class="bg-option active" onclick="selectBg(this)">
                        <img src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=200&h=120&fit=crop" class="bg-preview">
                        <div class="bg-name">Tulip 🌷</div>
                    </div>
                    <div class="bg-option" onclick="selectBg(this)">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=200&h=120&fit=crop" class="bg-preview">
                        <div class="bg-name">Gunung 🏔️</div>
                    </div>
                    <div class="bg-option" onclick="selectBg(this)">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=200&h=120&fit=crop" class="bg-preview">
                        <div class="bg-name">Pantai 🏖️</div>
                    </div>
                </div>
            </div>

            <div class="settings-card">
                <h3>📐 Tampilan</h3>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Sidebar Minimal</div>
                        <div class="toggle-sublabel">Tampilan sidebar saat dibuka</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Animasi Halus</div>
                        <div class="toggle-sublabel">Aktifkan animasi transisi</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            document.getElementById(tabName).classList.add('active');
            event.target.closest('.tab-btn').classList.add('active');
        }

        function selectBg(element) {
            document.querySelectorAll('.bg-option').forEach(opt => {
                opt.classList.remove('active');
            });
            element.classList.add('active');
        }
    </script>
@endsection
