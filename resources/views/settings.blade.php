@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('styles')
    .settings-section {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
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
    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: white;
        color: #ff6b6b;
        border: 2px solid var(--theme-danger);
        padding: 12px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        margin-top: auto;
    }
    .logout-btn:hover {
        background: #ffeaea;
        border-color: #ff6b6b;
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
    .about-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
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
    .about-desc {
        grid-column: 1 / -1;
        padding: 16px;
        border-radius: 14px;
        text-align: center;
    }
    .about-desc p {
        margin: 0;
        font-size: 13px;
        color: #666;
        line-height: 1.6;
    }
    .btn-panduan {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
        margin-top: 14px;
    }
    .btn-panduan:hover {
        filter: brightness(0.9);
    }

    @media (max-width: 1200px) {
        .settings-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .settings-section {
            grid-template-columns: 1fr;
        }
        .preference-grid {
            grid-template-columns: 1fr;
        }
        .about-info {
            grid-template-columns: 1fr;
        }
        .about-desc {
            grid-column: 1;
        }
    }
@endsection

@section('content')
    <div class="glass-card" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        @if(session('success'))
            <div class="success-message" style="background:#d4edda; color:#155724; padding:12px 16px; border-radius:12px; margin-bottom:10px; font-size:13px; display:flex; align-items:center; gap:8px;">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <div class="settings-section">
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon pink">👤</div>
                    <div class="settings-card-title">Profil</div>
                </div>
                <div class="settings-card-body">
                    <form method="POST" action="/settings/profile">
                        @csrf
                        @method('PUT')
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

            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon gray">ℹ️</div>
                    <div class="settings-card-title">Tentang Aplikasi</div>
                </div>
                <div class="settings-card-body">
                    <div class="about-info">
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
                    <p style="text-align:center; margin:16px 0 0; font-size:13px; color:#666; line-height:1.6;">
                        Aplikasi TodoList membantu Anda mengelola tugas harian dengan mudah.
                    </p>
                    <button type="button" class="btn-panduan" onclick="openGuide()" style="margin:16px auto 0; display:flex;">
                        📖 Lihat Panduan
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="glass-card" style="display:flex; justify-content:center; margin-top:0; background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <a href="/logout" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="max-width:300px;">
            🚪 Logout
        </a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
