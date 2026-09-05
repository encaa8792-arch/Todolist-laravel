@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('styles')
    .settings-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        padding: 24px;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }
    .settings-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f0f0f0;
    }
    .settings-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .settings-card-icon.pink { background: rgba(255,107,157,0.15); }
    .settings-card-icon.blue { background: rgba(160,196,255,0.15); }
    .settings-card-icon.green { background: rgba(46,204,113,0.15); }
    .settings-card-icon.purple { background: rgba(155,89,182,0.15); }
    .settings-card-icon.orange { background: rgba(255,165,0,0.15); }
    .settings-card-icon.gray { background: rgba(150,150,150,0.15); }
    .settings-card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }
    .settings-card-body {
        flex: 1;
    }
    .form-group {
        margin-bottom: 14px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 500;
        color: #666;
        margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid var(--theme-border);
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        background: white;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--theme-primary);
    }
    .btn-simpan {
        width: 100%;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
        margin-top: 14px;
    }
    .btn-simpan:hover {
        filter: brightness(0.9);
    }
    .toggle-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
    }
    .toggle-row:not(:last-child) {
        border-bottom: 1px dashed #f0f0f0;
    }
    .toggle-label {
        font-size: 13px;
        color: #555;
    }
    .toggle-switch {
        position: relative;
        width: 44px;
        height: 24px;
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
        border-radius: 24px;
    }
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }
    .toggle-switch input:checked + .toggle-slider {
        background-color: var(--theme-primary);
    }
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(20px);
    }
    .preference-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    .preference-item {
        padding: 14px;
        border-radius: 12px;
        transition: all 0.2s;
    }
    .preference-item:hover {
        transform: translateY(-2px);
    }
    .preference-label {
        font-size: 12px;
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }
    .preference-select {
        width: 100%;
        padding: 8px 10px;
        border: 2px solid var(--theme-border);
        border-radius: 8px;
        font-size: 12px;
        font-family: 'Poppins', sans-serif;
        background: white;
        outline: none;
        cursor: pointer;
    }
    .preference-select:focus {
        border-color: var(--theme-primary);
    }
    .about-item {
        text-align: center;
        padding: 20px 16px;
        border-radius: 14px;
        transition: transform 0.2s;
    }
    .about-item:hover {
        transform: translateY(-2px);
    }
    .about-icon {
        font-size: 32px;
        margin-bottom: 10px;
    }
    .about-title {
        font-size: 13px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }
    .about-value {
        font-size: 11px;
        color: #888;
    }
    .btn-panduan {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
    }
    .btn-panduan:hover {
        filter: brightness(0.9);
    }
    .profile-avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }
    .profile-avatar-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
    }
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--theme-primary), var(--theme-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        font-weight: 600;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .profile-avatar-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-change-photo {
        margin-top: 10px;
        padding: 6px 14px;
        background: white;
        border: 2px solid var(--theme-border);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        color: #666;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .btn-change-photo:hover {
        border-color: var(--theme-primary);
        color: var(--theme-primary);
        background: rgba(255,107,157,0.05);
    }
    .avatar-input {
        display: none;
    }
    .background-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-top: 16px;
    }
    .bg-option {
        aspect-ratio: 16/9;
        border-radius: 10px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.2s;
        background-size: cover;
        background-position: center;
    }
    .bg-option:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .bg-option.active {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 2px var(--theme-primary);
    }
    .bg-option.default {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 11px;
        font-weight: 600;
    }

    .settings-cards-row {
        display: flex;
        align-items: stretch;
        gap: 16px;
    }
    .settings-card {
        flex: 1;
    }
    .about-full-width {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        padding: 24px;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-top: 16px;
        margin-bottom: 16px;
    }
    .about-full-width:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    .about-horizontal {
        display: flex;
        justify-content: center;
        gap: 80px;
    }

    @media (max-width: 1200px) {
        .settings-cards-row {
            flex-wrap: wrap;
        }
        .settings-card {
            flex: 1 1 calc(50% - 8px);
            min-width: 280px;
        }
        .about-horizontal {
            gap: 40px;
        }
    }
    @media (max-width: 768px) {
        .settings-cards-row {
            flex-direction: column;
        }
        .settings-card {
            flex: none;
            width: 100%;
        }
        .preference-grid {
            grid-template-columns: 1fr;
        }
        .about-horizontal {
            flex-direction: column;
            gap: 16px;
        }
    }
@endsection

@section('content')
    @if(session('success'))
            <div class="success-message" style="background:#d4edda; color:#155724; padding:12px 16px; border-radius:12px; margin-bottom:10px; font-size:13px; display:flex; align-items:center; gap:8px;">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <div class="settings-cards-row">
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon pink">👤</div>
                    <div class="settings-card-title">Profil</div>
                </div>
                <div class="settings-card-body">
                    <form method="POST" action="/settings/profile" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="profile-avatar-section">
                            <div class="profile-avatar-wrapper">
                                <div class="profile-avatar">{{ substr(auth()->user()->name ?? 'P', 0, 1) }}</div>
                            </div>
                            <label class="btn-change-photo" for="avatarInput">📷 Ubah Foto</label>
                            <input type="file" id="avatarInput" class="avatar-input" name="avatar" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? 'Pengguna' }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? 'email@contoh.com' }}">
                        </div>
                        <button type="submit" class="btn-simpan">💾 Simpan Profil</button>
                    </form>
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon blue">🔔</div>
                    <div class="settings-card-title">Notifikasi</div>
                </div>
                <div class="settings-card-body">
                    <div class="toggle-row">
                        <span class="toggle-label">Pengingat Deadline</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="notif_deadline" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Tugas Baru</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="notif_new" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Tugas Selesai</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="notif_done">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Notifikasi Email</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="notif_email" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon pink">⚙️</div>
                    <div class="settings-card-title">Preferensi Todo List</div>
                </div>
                <div class="settings-card-body">
                    <div class="preference-grid">
                        <div class="preference-item">
                            <div class="preference-label">Urutan Tugas</div>
                            <select class="preference-select" id="taskSort">
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                                <option value="deadline">Deadline</option>
                                <option value="az">A-Z</option>
                                <option value="za">Z-A</option>
                            </select>
                        </div>
                        <div class="preference-item">
                            <div class="preference-label">Tampilkan Tugas Selesai</div>
                            <select class="preference-select" id="showCompleted">
                                <option value="always">Selalu</option>
                                <option value="page">Halaman Terpisah</option>
                                <option value="never">Tidak Pernah</option>
                            </select>
                        </div>
                        <div class="preference-item">
                            <div class="preference-label">Konfirmasi Hapus</div>
                            <select class="preference-select" id="confirmDelete">
                                <option value="yes">Ya, selalu konfirmasi</option>
                                <option value="no">Tidak, hapus langsung</option>
                            </select>
                        </div>
                        <div class="preference-item">
                            <div class="preference-label">Tugas per Halaman</div>
                            <select class="preference-select" id="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-card" style="margin-top: 16px;">
            <div class="settings-card-header">
                <div class="settings-card-icon purple">🖼️</div>
                <div class="settings-card-title">Background Halaman Login</div>
            </div>
            <div class="settings-card-body">
                <p style="font-size:12px; color:#666; margin-bottom:8px;">Pilih background untuk halaman login</p>
                <div class="background-grid">
                    <div class="bg-option default active" data-bg="" onclick="selectBg(this)">Default</div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400');" data-bg="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400');" data-bg="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1518173946687-a4c036bc6e1c?w=400');" data-bg="https://images.unsplash.com/photo-1518173946687-a4c036bc6e1c?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=400');" data-bg="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1507400492013-162706c8c05e?w=400');" data-bg="https://images.unsplash.com/photo-1507400492013-162706c8c05e?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?w=400');" data-bg="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1920" onclick="selectBg(this)"></div>
                    <div class="bg-option" style="background-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=400');" data-bg="https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=1920" onclick="selectBg(this)"></div>
                </div>
            </div>
        </div>

        <div class="settings-card about-full-width">
            <div class="settings-card-header">
                <div class="settings-card-icon gray">ℹ️</div>
                <div class="settings-card-title">Tentang Aplikasi</div>
            </div>
            <div class="settings-card-body">
                <div class="about-horizontal">
                    <div class="about-item">
                        <div class="about-icon">📝</div>
                        <div class="about-title">TodoList</div>
                        <div class="about-value">Manajer Tugas Harian</div>
                    </div>
                    <div class="about-item">
                        <div class="about-icon">📌</div>
                        <div class="about-title">Versi</div>
                        <div class="about-value">1.0.0</div>
                    </div>
                    <div class="about-item">
                        <div class="about-icon">👨‍💻</div>
                        <div class="about-title">Developer</div>
                        <div class="about-value">TodoList Team</div>
                    </div>
                </div>
                <div style="text-align:center; margin-top:14px;">
                    <p style="font-size:13px; color:#666; margin:0 0 12px;">Aplikasi TodoList membantu Anda mengelola tugas harian dengan mudah.</p>
                    <button type="button" class="btn-panduan" onclick="openGuide()">📖 Lihat Panduan</button>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('avatarInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const wrapper = document.querySelector('.profile-avatar-wrapper');
                        const existing = wrapper.querySelector('.profile-avatar, .profile-avatar-img');
                        if (existing) existing.remove();
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'profile-avatar-img';
                        wrapper.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            function selectBg(el) {
                document.querySelectorAll('.bg-option').forEach(opt => opt.classList.remove('active'));
                el.classList.add('active');
                const bgUrl = el.dataset.bg;
                localStorage.setItem('userSelectedBg', bgUrl);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const savedBg = localStorage.getItem('userSelectedBg');
                if (savedBg) {
                    document.querySelectorAll('.bg-option').forEach(opt => {
                        opt.classList.remove('active');
                        if (opt.dataset.bg === savedBg) {
                            opt.classList.add('active');
                        }
                    });
                }
            });
        </script>
@endsection
