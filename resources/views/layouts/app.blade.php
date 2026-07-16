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
      .task.overdue-red {
        background: #ffe5e5 !important;
        border-left: 4px solid #ff6b6b;
      }
      .task.overdue-red span {
        color: #c0392b !important;
      }
      .task.overdue-red .badge {
        background: #ff6b6b !important;
        color: white !important;
      }
      .task.overdue-red .deadline-badge {
        background: #ffcccc !important;
        color: #c0392b !important;
      }
      .task.overdue-red .done-btn {
        background: #ff8fa3 !important;
        color: white !important;
      }
      .task.overdue-red .done-btn:hover {
        background: #e07088 !important;
      }
      .task.overdue-red .edit-btn {
        background: #ff6b6b !important;
        color: white !important;
      }
      .task.overdue-red .edit-btn:hover {
        background: #e05585 !important;
      }
      .task.overdue-red .delete-btn {
        background: #ffcccc !important;
        color: #c0392b !important;
      }
      .task.overdue-red .delete-btn:hover {
        background: #ff9999 !important;
      }
      .task.urgent-deadline {
        border-left: 4px solid #e74c3c;
        background: #fff5f5;
        animation: pulse-border 2s infinite;
      }
      @keyframes pulse-border {
        0%, 100% { border-left-color: #e74c3c; }
        50% { border-left-color: #ff8fa3; }
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
      .box-overlay {
        background: rgba(255,255,255,0.7);
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

      /* Responsive Styles */
      @media (max-width: 768px) {
        body {
          padding: 10px;
          padding-top: 70px;
        }
        .box {
          padding: 20px 15px;
          border-radius: 15px;
        }
        .navbar {
          padding: 10px 15px;
        }
        .navbar-brand {
          font-size: 16px;
        }
        .navbar-nav {
          display: none;
          position: absolute;
          top: 100%;
          left: 0;
          right: 0;
          background: white;
          flex-direction: column;
          padding: 10px;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1);
          gap: 5px;
        }
        .navbar-nav.show {
          display: flex;
        }
        .navbar-nav a {
          padding: 10px 15px;
          text-align: center;
        }
        .mobile-menu-btn {
          display: flex !important;
        }
        .form.add {
          flex-direction: column;
        }
        form.add select,
        form.add input[type="text"] {
          width: 100%;
        }
        form.add .date-range-input {
          width: 100%;
          flex-wrap: wrap;
        }
        form.add .date-range-input input[type="date"] {
          flex: 1;
          min-width: 45%;
        }
        form.add button {
          width: 100%;
        }
        .task {
          flex-direction: column;
          align-items: flex-start;
        }
        .task span {
          width: 100%;
          margin-bottom: 10px;
        }
        .task-actions {
          width: 100%;
          flex-wrap: wrap;
          gap: 5px;
        }
        .task-actions form,
        .task-actions a {
          flex: 1;
          min-width: auto;
        }
        .task-actions button,
        .task-actions .edit-btn {
          width: 100%;
          text-align: center;
        }
        .deadline-badge {
          display: block;
          width: 100%;
          text-align: center;
          margin-bottom: 8px;
        }
        .stats-grid {
          grid-template-columns: repeat(2, 1fr) !important;
          gap: 10px !important;
        }
        .stat-card {
          padding: 15px 10px !important;
        }
        .stat-card .number {
          font-size: 24px !important;
        }
        .weekly-stats {
          grid-template-columns: repeat(3, 1fr) !important;
        }
        .weekly-stat {
          padding: 8px 5px !important;
        }
        .weekly-stat .number {
          font-size: 18px !important;
        }
        .weekly-chart {
          height: 60px !important;
          overflow-x: auto;
        }
        .bar {
          width: 8px !important;
        }
        .header-row {
          flex-direction: column;
          align-items: flex-start;
          gap: 10px;
        }
        .header-row .kebab-wrapper {
          align-self: flex-end;
        }
        .pagination {
          flex-wrap: wrap;
          justify-content: center;
        }
        .edit-box {
          padding: 20px 15px !important;
        }
        .edit-box h2 {
          font-size: 20px !important;
        }
        #bulkForm,
        #bulkDeleteForm {
          flex-direction: column;
          gap: 8px;
        }
        #bulkForm button,
        #bulkDeleteForm button {
          width: 100%;
        }
        .success {
          font-size: 12px;
          padding: 8px 10px;
        }
        #guideModal > div {
          padding: 20px 15px !important;
          width: 95% !important;
        }
      }

      @media (max-width: 480px) {
        .box {
          padding: 15px 12px;
        }
        .stats-grid {
          grid-template-columns: 1fr 1fr !important;
        }
        .weekly-stats {
          grid-template-columns: 1fr !important;
        }
        .weekly-stat {
          padding: 10px !important;
        }
        .category-list .category-item {
          flex-direction: column;
          align-items: flex-start;
          gap: 8px;
        }
        .category-stats {
          width: 100%;
        }
        .chart-bar {
          min-width: 30px;
        }
      }

      .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        flex-direction: column;
        gap: 4px;
      }
      .mobile-menu-btn span {
        display: block;
        width: 22px;
        height: 2px;
        background: #ff6b9d;
        border-radius: 2px;
        transition: 0.3s;
      }
      .mobile-menu-btn.active span:nth-child(1) {
        transform: rotate(45deg) translate(4px, 5px);
      }
      .mobile-menu-btn.active span:nth-child(2) {
        opacity: 0;
      }
      .mobile-menu-btn.active span:nth-child(3) {
        transform: rotate(-45deg) translate(4px, -5px);
      }

      @yield('styles')
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/dashboard" class="navbar-brand">TodoList</a>
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="navbar-nav" id="navbarNav">
            <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="/tasks" class="{{ request()->is('tasks') ? 'active' : '' }}">Tugas</a></li>
            <li><a href="/tasks/completed" class="{{ request()->is('tasks/completed') ? 'active' : '' }}">Selesai</a></li>
            <li><a href="#" onclick="openBgModal(); return false;" title="Ganti Background">🎨</a></li>
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
        function openBgModal() {
            document.getElementById('bgModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeBgModal() {
            document.getElementById('bgModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        function setBackground(url, name) {
            document.body.style.backgroundImage = 'url(' + url + ')';
            document.body.style.backgroundSize = 'cover';
            document.body.style.backgroundPosition = 'center';
            document.body.style.backgroundAttachment = 'fixed';
            localStorage.setItem('bgChoice', JSON.stringify({url: url, name: name}));
            document.querySelectorAll('.bg-option').forEach(el => el.classList.remove('active'));
            document.querySelector('.bg-option[data-bg="' + name + '"]')?.classList.add('active');
            closeBgModal();
        }
        function resetBackground() {
            setBackground('/images/bg-tulip.jpg', 'tulip');
        }
        function handleCustomBgUpload(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const base64 = e.target.result;
                setBackground(base64, 'custom');
                localStorage.setItem('customBg', base64);
                document.getElementById('customBgActions').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
        function deleteCustomBg() {
            localStorage.removeItem('customBg');
            document.getElementById('customBgActions').style.display = 'none';
            resetBackground();
        }
        (function() {
            const customBg = localStorage.getItem('customBg');
            if (customBg) {
                document.body.style.backgroundImage = 'url(' + customBg + ')';
                document.body.style.backgroundSize = 'cover';
                document.body.style.backgroundPosition = 'center';
                document.body.style.backgroundAttachment = 'fixed';
                document.getElementById('customBgActions').style.display = 'block';
                return;
            }
            const saved = localStorage.getItem('bgChoice');
            if (saved) {
                try {
                    const data = JSON.parse(saved);
                    document.body.style.backgroundImage = 'url(' + data.url + ')';
                    document.body.style.backgroundSize = 'cover';
                    document.body.style.backgroundPosition = 'center';
                    document.body.style.backgroundAttachment = 'fixed';
                } catch(e) {}
            }
        })();
        document.getElementById('guideModal').addEventListener('click', function(e) {
            if (e.target === this) closeGuide();
        });
        document.getElementById('bgModal').addEventListener('click', function(e) {
            if (e.target === this) closeBgModal();
        });
        function toggleMobileMenu() {
            var nav = document.getElementById('navbarNav');
            var btn = document.querySelector('.mobile-menu-btn');
            nav.classList.toggle('show');
            btn.classList.toggle('active');
        }
        document.addEventListener('click', function(e) {
            var nav = document.getElementById('navbarNav');
            var btn = document.querySelector('.mobile-menu-btn');
            if (!nav.contains(e.target) && !btn.contains(e.target) && nav.classList.contains('show')) {
                nav.classList.remove('show');
                btn.classList.remove('active');
            }
        });
    </script>

    <div class="box box-overlay @yield('box-class')">
        @yield('content')
    </div>
    <div id="bgModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
        <div style="background:white; border-radius:20px; padding:25px; max-width:400px; width:90%; position:relative;">
            <button onclick="closeBgModal()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3 style="color:#ff6b9d; margin:0 0 15px; text-align:center;">🎨 Ganti Background</h3>
            <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">
                <div onclick="setBackground('/images/bg-tulip.jpg', 'tulip')" style="cursor:pointer; border-radius:12px; overflow:hidden; border:3px solid transparent; transition:0.2s;" class="bg-option" data-bg="tulip">
                    <img src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=200&h=120&fit=crop" style="width:100%; height:80px; object-fit:cover;">
                    <div style="text-align:center; padding:8px; font-size:12px; font-weight:500;">Tulip 🌷</div>
                </div>
                <div onclick="setBackground('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800', 'gunung')" style="cursor:pointer; border-radius:12px; overflow:hidden; border:3px solid transparent; transition:0.2s;" class="bg-option" data-bg="gunung">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=200&h=120&fit=crop" style="width:100%; height:80px; object-fit:cover;">
                    <div style="text-align:center; padding:8px; font-size:12px; font-weight:500;">Gunung 🏔️</div>
                </div>
                <div onclick="setBackground('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', 'pantai')" style="cursor:pointer; border-radius:12px; overflow:hidden; border:3px solid transparent; transition:0.2s;" class="bg-option" data-bg="pantai">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=200&h=120&fit=crop" style="width:100%; height:80px; object-fit:cover;">
                    <div style="text-align:center; padding:8px; font-size:12px; font-weight:500;">Pantai 🏖️</div>
                </div>
                <div onclick="setBackground('https://images.unsplash.com/photo-1557683316-973673baf926?w=800', 'minimalis')" style="cursor:pointer; border-radius:12px; overflow:hidden; border:3px solid transparent; transition:0.2s;" class="bg-option" data-bg="minimalis">
                    <img src="https://images.unsplash.com/photo-1557683316-973673baf926?w=200&h=120&fit=crop" style="width:100%; height:80px; object-fit:cover;">
                    <div style="text-align:center; padding:8px; font-size:12px; font-weight:500;">Minimalis ✨</div>
                </div>
                <div onclick="document.getElementById('customBgInput').click()" style="cursor:pointer; border-radius:12px; overflow:hidden; border:3px solid #ff6b9d; transition:0.2s; display:flex; flex-direction:column; align-items:center; justify-content:center; background:#fff0f5; min-height:110px;" class="bg-option" data-bg="custom">
                    <span style="font-size:28px;">📁</span>
                    <div style="text-align:center; padding:8px; font-size:12px; font-weight:500;">Upload Foto</div>
                </div>
            </div>
            <input type="file" id="customBgInput" accept=".jpg,.jpeg,.png,.webp" style="display:none;" onchange="handleCustomBgUpload(event)">
            <div id="customBgActions" style="margin-top:10px; display:none;">
                <button onclick="deleteCustomBg()" style="width:100%; background:#ff6b6b; color:white; border:none; padding:10px; border-radius:10px; cursor:pointer; font-size:13px; font-weight:500; font-family:'Poppins',sans-serif;">🗑️ Hapus Foto Custom</button>
            </div>
            <button onclick="resetBackground()" style="margin-top:10px; width:100%; background:#f0f0f0; color:#666; border:none; padding:10px; border-radius:10px; cursor:pointer; font-size:13px; font-weight:500; font-family:'Poppins',sans-serif;">🔄 Reset ke Default</button>
        </div>
    </div>
    <style>
        .bg-option:hover {
            border-color: #ff6b9d !important;
            transform: scale(1.02);
        }
        .bg-option.active {
            border-color: #ff6b9d !important;
        }
    </style>
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
