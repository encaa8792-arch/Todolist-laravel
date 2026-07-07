<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Todo List')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      * {
        box-sizing: border-box;
      }
      body {
        background-image: url('/images/bg-tulip.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
      }
      .box {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 900px;
      }
      h1 {
        text-align: center;
        margin-bottom: 25px;
      }
      .success {
        background: #d4edda;
        color: #155724;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
      }
      form.add {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
      }
      select, input[type="text"] {
        flex: 1;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
      }
      input[type="date"] {
        width: auto;
        min-width: 140px;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
      }
      .date-range-input {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-shrink: 0;
      }
      .date-range-input input[type="date"] {
        min-width: 120px;
      }
      select:focus, input[type="text"]:focus, input[type="date"]:focus {
        border-color: #ff6b9d;
      }
      button {
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        transition: background 0.2s, transform 0.2s;
      }
      button:hover {
        background: #e05585;
        transform: translateY(-1px);
      }
      .task {
        background: #fff0f5;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
      }
      .task:hover {
        box-shadow: 0 4px 12px rgba(255,107,157,0.15);
      }
      .task span {
        color: #333;
        flex: 1;
        font-size: 14px;
        line-height: 1.6;
      }
      .task-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
      }
      .badge {
        background: #a0c4ff;
        color: white;
        padding: 3px 10px;
        border-radius: 8px;
        font-size: 11px;
        margin-right: 6px;
        font-weight: 500;
      }
      .task.done-box {
        background: #f3f4f6;
        border-left: 4px solid #2ecc71;
        opacity: 0.7;
      }
      .task.done-box span.done {
        text-decoration: line-through;
        color: #9ca3af;
      }
      .done-btn {
        background: #4CAF50;
        padding: 8px 14px;
        font-size: 12px;
        white-space: nowrap;
      }
      .done-btn:hover {
        background: #43a047;
      }
      .done-btn.cancel {
        background: #f39c12;
      }
      .done-btn.cancel:hover {
        background: #e08e0b;
      }
      .delete-btn {
        background: #ff8fa3;
        padding: 8px 14px;
        font-size: 12px;
      }
      .delete-btn:hover {
        background: #e07088;
      }
      .edit-btn {
        background: #a0c4ff;
        color: white;
        padding: 8px 12px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        display: inline-block;
        transition: background 0.2s;
      }
      .edit-btn:hover {
        background: #7eb3f5;
      }
      .deadline-input {
        max-width: 140px;
      }
      .deadline-badge {
        background: #ffd6a5;
        color: #333;
        padding: 3px 10px;
        border-radius: 8px;
        font-size: 11px;
        margin-left: 5px;
        font-weight: 500;
      }
      .deadline-badge.overdue {
        background: #ff6b6b;
        color: white;
      }
      .task.overdue-task {
        border-left: 4px solid #ff6b6b;
      }
      .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 15px 0 0;
      }
      .pagination li a, .pagination li span {
        padding: 8px 14px;
        border-radius: 8px;
        background: #fff0f5;
        color: #ff6b9d;
        text-decoration: none;
        font-size: 13px;
        transition: 0.2s;
      }
      .pagination li a:hover {
        background: #ff6b9d;
        color: white;
      }
      .pagination li.active span {
        background: #ff6b9d;
        color: white;
      }
      .pagination li.disabled span {
        opacity: 0.5;
      }
      .nav-link {
        text-align: center;
        margin-bottom: 20px;
      }
      .nav-link a {
        color: #2ecc71;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: color 0.2s;
      }
      .nav-link a:hover {
        color: #27ae60;
      }
      .back-btn {
        display: inline-block;
        background: #ff6b9d;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s;
      }
      .back-btn:hover {
        background: #e05585;
      }
      .empty {
        text-align: center;
        color: #9ca3af;
        padding: 30px;
        font-style: italic;
        font-size: 14px;
      }
      .edit-box {
        padding: 40px;
      }
      .edit-box h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 24px;
      }
      .edit-box label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #555;
        margin-bottom: 4px;
        margin-top: 12px;
      }
      .edit-box select, .edit-box input[type="text"], .edit-box input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
      }
      .edit-box select:focus, .edit-box input:focus {
        border-color: #ff6b9d;
      }
      .btn-update {
        width: 100%;
        padding: 14px;
        background: #ff6b9d;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s, transform 0.2s;
      }
      .btn-update:hover {
        background: #e05585;
        transform: translateY(-2px);
      }
      .btn-back {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #ff6b9d;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.2s;
      }
      .btn-back:hover {
        color: #e05585;
        text-decoration: underline;
      }
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: white;
        padding: 12px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        z-index: 1000;
      }
      .navbar-brand {
        font-weight: 700;
        font-size: 18px;
        color: #ff6b9d;
        text-decoration: none;
      }
      .navbar-nav {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
      }
      .navbar-nav a {
        color: #666;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
      }
      .navbar-nav a:hover {
        background: #fff0f5;
        color: #ff6b9d;
      }
      .navbar-nav a.active {
        background: #ff6b9d;
        color: white;
      }
      body {
        padding-top: 80px;
      }
      .kebab-wrapper {
        position: relative;
        display: inline-block;
      }
      .kebab-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        transition: background 0.2s;
      }
      .kebab-btn:hover {
        background: #fff0f5;
      }
      .kebab-btn span {
        display: block;
        width: 4px;
        height: 4px;
        background: #999;
        border-radius: 50%;
      }
      .kebab-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        min-width: 200px;
        z-index: 1001;
        overflow: hidden;
        border: 1px solid #f0f0f0;
      }
      .kebab-menu.show {
        display: block;
      }
      .kebab-menu form {
        margin: 0;
      }
      .kebab-menu button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 18px;
        font-size: 13px;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
        border-radius: 0;
        transform: none;
      }
      .kebab-menu button:hover {
        background: #fff0f5;
        color: #ff6b9d;
        transform: none;
      }
      .kebab-menu button.danger {
        color: #e74c3c;
      }
      .kebab-menu button.danger:hover {
        background: #ffeaea;
        color: #c0392b;
      }
      .kebab-menu .menu-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 0;
      }
      .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
      }
      .header-row h1 {
        margin-bottom: 0;
      }
      .cancel-btn {
        background: #9ca3af;
        padding: 8px 14px;
        font-size: 12px;
      }
      .cancel-btn:hover {
        background: #7f8c8d;
      }
      #bulkForm {
        background: #fff0f5;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
      }
      .bulk-checkbox {
        margin-right: 10px;
        width: 18px;
        height: 18px;
        cursor: pointer;
      }
      @yield('styles')
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/dashboard" class="navbar-brand">TodoList</a>
        <ul class="navbar-nav">
            <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="/tasks" class="{{ request()->is('tasks') ? 'active' : '' }}">Tugas</a></li>
            <li><a href="/tasks/completed" class="{{ request()->is('tasks/completed') ? 'active' : '' }}">Selesai</a></li>
            <li><a href="#" onclick="openGuide(); return false;" title="Panduan">📖</a></li>
        </ul>
    </nav>

    <div id="guideModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
        <div style="background:white; border-radius:20px; padding:30px; max-width:550px; width:90%; max-height:80vh; overflow-y:auto; position:relative;">
            <button onclick="closeGuide()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <div style="text-align:center; margin-bottom:25px;">
                <span style="font-size:50px;">📘</span>
                <h2 style="color:#ff6b9d; margin:10px 0 5px;">Panduan TodoList</h2>
                <p style="color:#999; margin:0;">Langkah-langkah penggunaan aplikasi</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">📝 Menambah Tugas</h4>
                <p style="margin:0; color:#666; font-size:14px;">1. Pilih kategori tugas<br>2. Masukkan nama tugas<br>3. (Opsional) Tambah deadline<br>4. Klik tombol "+ Tambah"</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">✓ Menandai Selesai</h4>
                <p style="margin:0; color:#666; font-size:14px;">Klik tombol <strong>"✓ Done"</strong> pada tugas untuk menandai selesai. Klik <strong>"↩️ Batal"</strong> untuk membatalkan.</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">✏️ Mengedit Tugas</h4>
                <p style="margin:0; color:#666; font-size:14px;">Klik ikon ✏️ pada tugas untuk mengedit nama, kategori, atau deadline.</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">🗑️ Menghapus Tugas</h4>
                <p style="margin:0; color:#666; font-size:14px;">Klik tombol "Hapus" pada tugas, atau gunakan fitur <strong>Bulk Hapus</strong> untuk menghapus banyak tugas sekaligus.</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">📋 Bulk Action</h4>
                <p style="margin:0; color:#666; font-size:14px;">Fitur bulk memungkinkan kamu menandai selesai, membatalkan, atau menghapus banyak tugas sekaligus.<br><br><strong>Cara pakai:</strong><br>1. Klik menu ⋮ (kebab) di halaman<br>2. Pilih "Bulk Action" atau "Hapus"<br>3. Centang tugas yang dipilih<br>4. Klik aksi yang diinginkan</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">✓ Done Semua</h4>
                <p style="margin:0; color:#666; font-size:14px;">Di halaman Tugas, klik menu ⋮ > <strong>"Done Semua"</strong> untuk menandai semua tugas sebagai selesai.</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">📊 Dashboard</h4>
                <p style="margin:0; color:#666; font-size:14px;">Halaman Dashboard menampilkan statistik tugas kamu: total tugas, tugas selesai, tugas tertunda, dan tugas overdue.</p>
            </div>

            <div style="border-left:3px solid #ffc2d1; padding-left:20px; margin-bottom:20px;">
                <h4 style="color:#ff6b9d; margin:0 0 8px;">📅 Deadline</h4>
                <p style="margin:0; color:#666; font-size:14px;">Tugas dengan deadline yang lewat akan muncul dengan <span style="background:#ff6b6b; color:white; padding:2px 8px; border-radius:5px;">tanda peringatan ⚠️</span></p>
            </div>

            <div style="text-align:center; padding:15px; background:#fff0f5; border-radius:15px;">
                <p style="margin:0; color:#ff6b9d; font-weight:600;">💡 Tips: Gunakan Bulk Action untuk kerja lebih cepat!</p>
            </div>
        </div>
    </div>

    <script>
        function openGuide() {
            document.getElementById('guideModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeGuide() {
            document.getElementById('guideModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        document.getElementById('guideModal').addEventListener('click', function(e) {
            if (e.target === this) closeGuide();
        });
    </script>

    <div class="box @yield('box-class')">
        @yield('content')
    </div>
    <script>
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.kebab-menu.show').forEach(function(menu) {
                if (!menu.parentElement.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });
        });
        document.querySelectorAll('.kebab-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var menu = this.nextElementSibling;
                document.querySelectorAll('.kebab-menu.show').forEach(function(m) {
                    if (m !== menu) m.classList.remove('show');
                });
                menu.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
