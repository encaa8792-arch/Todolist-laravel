<?php $__env->startSection('title', 'Pengaturan'); ?>
<?php $__env->startSection('page-title', 'Pengaturan'); ?>

<?php $__env->startSection('styles'); ?>
    .settings-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .settings-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .settings-header h1 span {
        color: #ff6b9d;
    }
    .settings-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .settings-card {
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }
    .settings-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255,107,157,0.15);
    }
    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #fff0f5;
    }
    .settings-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .settings-card-icon.pink { background: rgba(255,107,157,0.15); }
    .settings-card-icon.blue { background: rgba(160,196,255,0.15); }
    .settings-card-icon.green { background: rgba(46,204,113,0.15); }
    .settings-card-icon.red { background: rgba(255,107,107,0.15); }
    .settings-card-title {
        font-size: 15px;
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
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        background: white;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: #ff6b9d;
    }
    .btn-simpan {
        width: 100%;
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 14px;
    }
    .btn-simpan:hover {
        background: #e05585;
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
        background-color: #ff6b9d;
    }
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(20px);
    }
    .theme-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .theme-option {
        padding: 14px 10px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
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
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin: 0 auto 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .theme-name {
        font-size: 11px;
        font-weight: 500;
        color: #555;
    }
    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: white;
        color: #ff6b6b;
        border: 2px solid #ff8fa3;
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

    @media (max-width: 1200px) {
        .settings-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }
        .settings-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="settings-container">
        <div class="settings-header">
            <h1>Pengaturan <span>TodoList</span></h1>
        </div>

        <div class="settings-grid">
            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon pink">👤</div>
                    <div class="settings-card-title">Profil</div>
                </div>
                <div class="settings-card-body">
                    <form method="POST" action="/settings/profile">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="<?php echo e(auth()->user()->name ?? 'Pengguna'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo e(auth()->user()->email ?? 'email@contoh.com'); ?>">
                        </div>
                        <button type="submit" class="btn-simpan">💾 Simpan</button>
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
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Tugas Baru</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Tugas Selesai</span>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span class="toggle-label">Notifikasi Email</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="settings-card">
                <div class="settings-card-header">
                    <div class="settings-card-icon green">🎨</div>
                    <div class="settings-card-title">Tampilan</div>
                </div>
                <div class="settings-card-body">
                    <div class="form-group">
                        <label>Tema</label>
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
                </div>
                <a href="/logout" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    🚪 Logout
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.theme-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.theme-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/settings.blade.php ENDPATH**/ ?>