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
        min-height: 100vh;
        margin: 0;
        padding: 0;
      }
      .layout-wrapper {
        display: flex;
        min-height: 100vh;
      }
      .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 240px;
        background: white;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        transition: width 0.3s ease;
        z-index: 999;
        overflow: visible;
        border-radius: 0 24px 24px 0;
      }
      .sidebar.collapsed {
        width: 72px;
        border-radius: 16px;
      }
      .sidebar.collapsed .sidebar-header {
        display: none;
      }
      .sidebar-header {
        padding: 16px;
        border-bottom: 1px solid #f5f5f5;
      }
      .sidebar-brand {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .sidebar-brand a {
        font-weight: 700;
        font-size: 18px;
        color: #ff6b9d;
        text-decoration: none;
      }
      .sidebar.collapsed .sidebar-header {
        display: flex;
        justify-content: center;
        padding: 16px 8px;
      }
      .sidebar.collapsed .sidebar-brand {
        flex-direction: column;
        gap: 12px;
      }
      .sidebar.collapsed .sidebar-logo-text {
        display: none;
      }
      .toggle-btn {
        background: #fff5f8;
        border: 2px solid #ffc2d1;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(255,107,157,0.2);
        color: #ff6b9d;
      }
      .toggle-btn:hover {
        background: #fff0f5;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(255,107,157,0.3);
      }
      .sidebar-menu {
        padding: 0 0 15px 0;
        overflow: visible;
      }
      .menu-item {
        position: relative;
        display: flex;
        align-items: center;
        padding: 12px 20px;
        margin: 4px 12px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        overflow: visible;
        border-radius: 14px;
        transition: all 0.3s ease;
      }
      .menu-item:hover {
        background: #fff0f5;
        color: #ff6b9d;
      }
      .menu-item.active {
        background: #ff6b9d;
        color: white;
        box-shadow: 0 4px 15px rgba(255,107,157,0.3);
      }
      .menu-item .icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        margin-right: 12px;
      }
      .menu-item .label {
        opacity: 1;
        pointer-events: auto;
      }
      .sidebar.collapsed .menu-item {
        justify-content: center;
        padding: 12px 0;
      }
      .sidebar.collapsed .menu-item .icon {
        margin-left: auto;
        margin-right: auto;
      }
      .sidebar.collapsed .menu-item .label {
        display: none;
      }
      .sidebar.collapsed .menu-item::after {
        content: attr(data-tooltip);
        position: absolute;
        left: calc(100% + 10px);
        top: 50%;
        transform: translateY(-50%);
        background: #333;
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        z-index: 1003;
        transition: opacity 0.2s ease;
      }
      .sidebar.collapsed .menu-item:hover::after {
        opacity: 1;
        visibility: visible;
      }
      .menu-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 10px 20px;
      }
      .sidebar.collapsed .menu-divider {
        margin: 10px 15px;
      }
      .main-content {
        flex: 1;
        padding: 15px;
        margin-left: 248px;
        transition: margin-left 0.3s ease;
      }
      .page-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
      }
      .page-topbar-left {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .page-topbar-left .page-title {
        font-weight: 600;
        font-size: 16px;
        color: #333;
        transition: color 0.3s;
      }
      .page-topbar-right {
        display: flex;
        gap: 8px;
        position: relative;
      }
      .topbar-btn {
        position: relative;
        background: #fff0f5;
        border: none;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.2s;
        color: #ff6b9d;
      }
      .topbar-btn:hover {
        background: #ffe0eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255,107,157,0.2);
      }
      .topbar-btn .tooltip-text {
        position: absolute;
        bottom: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s;
        pointer-events: none;
        z-index: 100;
      }
      .topbar-btn .tooltip-text::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: #333;
      }
      .topbar-btn:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
      }
      .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 12px 6px 6px;
        background: #fff0f5;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.2s;
        margin-left: 8px;
        position: relative;
        z-index: 1002;
      }
      .user-profile:hover {
        background: #ffe0eb;
        transform: translateY(-1px);
        box-shadow: 0 2px 10px rgba(255,107,157,0.15);
      }
      .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #ff6b9d, #ff8fa3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
      }
      .user-avatar-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
      }
      .user-name {
        font-size: 13px;
        font-weight: 500;
        color: #333;
      }
      .dropdown-arrow {
        font-size: 10px;
        color: #999;
        transition: transform 0.2s;
      }
      .user-profile.active .dropdown-arrow {
        transform: rotate(180deg);
      }
      .user-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: white;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        min-width: 190px;
        z-index: 1003;
        overflow: hidden;
        display: none;
        border: 1px solid rgba(255,182,193,0.3);
      }
      .user-dropdown.show {
        display: block;
      }
      .dropdown-divider {
        height: 1px;
        background: #f5f0f2;
        margin: 4px 0;
      }
      .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        color: #555;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.15s ease;
        cursor: pointer;
      }
      .dropdown-item:hover {
        background: linear-gradient(135deg, #fff0f5, #fff5f8);
        color: #ff6b9d;
      }
      .dropdown-item.logout:hover {
        background: linear-gradient(135deg, #ffeaea, #fff0f0);
        color: #ff6b6b;
      }
      .dropdown-item span {
        font-size: 16px;
        width: 20px;
        text-align: center;
      }
      body.sidebar-collapsed .main-content {
        margin-left: 80px;
      }
      .box {
        background: white;
        padding: 24px;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 95%;
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
        color: #000;
        flex: 1;
        font-size: 14px;
        line-height: 1.6;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        border: 3px solid #e74c3c !important;
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
        padding: 10px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        z-index: 1001;
        border-radius: 0 0 20px 20px;
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
        border-radius: 24px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .navbar-nav a:hover {
        background: #fff0f5;
        color: #ff6b9d;
      }
      .navbar-nav a.active {
        background: #ff6b9d;
        color: white;
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

      @media (max-width: 768px) {
        body {
          padding: 10px;
        }
        .sidebar {
          transform: translateX(-100%);
          width: 240px;
          top: 0;
          bottom: 0;
          border-radius: 0 20px 20px 0;
          z-index: 1000;
        }
        .sidebar.mobile-open {
          transform: translateX(0);
        }
        body.sidebar-collapsed .main-content,
        .main-content {
          margin-left: 0;
        }
        .box {
          padding: 15px 12px;
          border-radius: 15px;
          max-width: 98%;
        }
        .sidebar-header {
          padding: 12px;
        }
        .sidebar-brand a {
          font-size: 16px;
        }
        .sidebar-icons {
          display: none;
        }
        .sidebar.mobile-open .sidebar-icons {
          display: flex;
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
        .mobile-sidebar-overlay {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: rgba(0,0,0,0.3);
          z-index: 998;
        }
        .mobile-sidebar-overlay.show {
          display: block;
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
        gap: 5px;
      }
      .guide-icon-btn span:hover {
        background: #ff6b9d;
        transform: scale(1.05);
      }
      .guide-icon-btn span {
        display: flex;
        align-items: center;
        justify-content: center;
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
    <div class="layout-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <a href="/dashboard" class="sidebar-logo-text">TodoList</a>
                    <button class="toggle-btn" onclick="toggleSidebar()">
                        <span id="toggleIcon">✕</span>
                    </button>
                </div>
            </div>
            <nav class="sidebar-menu">
                <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
                    <span class="icon">🏠</span>
                    <span class="label">Dashboard</span>
                </a>
                <a href="/tasks" class="menu-item {{ request()->is('tasks') ? 'active' : '' }}" data-tooltip="Tugas">
                    <span class="icon">📋</span>
                    <span class="label">Tugas</span>
                </a>
                <a href="/tasks/completed" class="menu-item {{ request()->is('tasks/completed') ? 'active' : '' }}" data-tooltip="Tugas Selesai">
                    <span class="icon">✓</span>
                    <span class="label">Selesai</span>
                </a>
                
                <div class="menu-divider"></div>
                
                <a href="/categories" class="menu-item {{ request()->is('categories') ? 'active' : '' }}" data-tooltip="Kategori">
                    <span class="icon">📁</span>
                    <span class="label">Kategori</span>
                </a>
                <a href="/reports" class="menu-item {{ request()->is('reports') ? 'active' : '' }}" data-tooltip="Laporan">
                    <span class="icon">📊</span>
                    <span class="label">Laporan</span>
                </a>
                <a href="/settings" class="menu-item {{ request()->is('settings') ? 'active' : '' }}" data-tooltip="Pengaturan">
                    <span class="icon">⚙️</span>
                    <span class="label">Pengaturan</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="page-topbar">
                <div class="page-topbar-left">
                    <span class="page-title">@yield('page-title', 'Dashboard TodoList')</span>
                </div>
                <div class="page-topbar-right">
                    <button class="topbar-btn" onclick="openBgModal()" title="Ganti Latar Belakang">
                        🖼️
                        <span class="tooltip-text">Ganti Latar Belakang</span>
                    </button>
                    <button class="topbar-btn" onclick="openGuide()" title="Buku Panduan">
                        📖
                        <span class="tooltip-text">Buku Panduan</span>
                    </button>
                    <div class="user-profile" id="userProfileBtn">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="user-avatar-img" alt="Profil">
                        @else
                            <div class="user-avatar">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</div>
                        @endif
                        <span class="user-name">{{ auth()->user()->name ?? 'User' }}</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#" class="dropdown-item" onclick="openPhotoModal(); closeUserDropdown();">
                            <span>📷</span> Foto Profil
                        </a>
                        <a href="#" class="dropdown-item" onclick="closeUserDropdown();">
                            <span>👤</span> Profil
                        </a>
                        <a href="/settings" class="dropdown-item" onclick="closeUserDropdown();">
                            <span>⚙️</span> Pengaturan
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item logout" onclick="confirmLogout();">
                            <span>🚪</span> Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="box box-overlay @yield('box-class')">
                @yield('content')
            </div>
        </main>
    </div>

    <div id="photoModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
        <div style="background:white; border-radius:20px; padding:30px; max-width:400px; width:90%; position:relative;">
            <button onclick="closePhotoModal()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <div style="text-align:center; margin-bottom:20px;">
                <span style="font-size:40px;">📷</span>
                <h3 style="color:#ff6b9d; margin:10px 0 5px;">Foto Profil</h3>
                <p style="color:#999; margin:0; font-size:13px;">Pilih foto dari komputer Anda</p>
            </div>
            <div style="text-align:center;">
                @if(auth()->user()->profile_photo)
                    <img id="photoPreview" src="{{ asset('storage/' . auth()->user()->profile_photo) }}" style="width:100px; height:100px; border-radius:50%; object-fit:cover; margin-bottom:20px; border:3px solid #ffc2d1;">
                @else
                    <div id="photoPreview" style="width:100px; height:100px; border-radius:50%; background:linear-gradient(135deg, #ff6b9d, #ff8fa3); margin:0 auto 20px; display:flex; align-items:center; justify-content:center; color:white; font-size:36px; font-weight:600; border:3px solid #ffc2d1;">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                @endif
                <form id="photoForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="photoInput" name="profile_photo" accept="image/*" style="display:none;" onchange="previewImage(this);">
                    <button type="button" onclick="document.getElementById('photoInput').click()" style="background:#fff0f5; color:#ff6b9d; border:2px dashed #ffc2d1; padding:12px 20px; border-radius:10px; font-size:13px; font-weight:500; font-family:'Poppins',sans-serif; cursor:pointer; width:100%; margin-bottom:15px; transition:all 0.2s;">
                        📁 Pilih Foto
                    </button>
                    <button type="submit" id="uploadBtn" style="background:#ff6b9d; color:white; border:none; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600; font-family:'Poppins',sans-serif; cursor:pointer; width:100%; transition:all 0.2s; opacity:0.5; pointer-events:none;">
                        💾 Simpan Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

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

    <div id="bgModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
        <div style="background:white; border-radius:20px; padding:25px; max-width:400px; width:90%; position:relative;">
            <button onclick="closeBgModal()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3 style="color:#ff6b9d; margin:0 0 15px; text-align:center;">🖼️ Ganti Background</h3>
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
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed', isCollapsed);
            document.getElementById('toggleIcon').textContent = isCollapsed ? '☰' : '✕';
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        }

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
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                document.getElementById('sidebar').classList.add('collapsed');
                document.body.classList.add('sidebar-collapsed');
                document.getElementById('toggleIcon').textContent = '☰';
            } else {
                document.getElementById('toggleIcon').textContent = '✕';
            }
        })();
        document.getElementById('guideModal').addEventListener('click', function(e) {
            if (e.target === this) closeGuide();
        });
        document.getElementById('bgModal').addEventListener('click', function(e) {
            if (e.target === this) closeBgModal();
        });
        var userDropdown = document.getElementById('userDropdown');
        var userProfileBtn = document.getElementById('userProfileBtn');
        userProfileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
            this.classList.toggle('active');
        });
        document.addEventListener('click', function(e) {
            if (!userProfileBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
                userProfileBtn.classList.remove('active');
            }
        });
        function openPhotoModal() {
            alert('Fitur upload foto profil akan segera hadir!');
        }
        function closeUserDropdown() {
            userDropdown.classList.remove('show');
            userProfileBtn.classList.remove('active');
        }
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/logout';
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
            closeUserDropdown();
        }
        function openPhotoModal() {
            document.getElementById('photoModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            closeUserDropdown();
        }
        function closePhotoModal() {
            document.getElementById('photoModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            document.getElementById('photoInput').value = '';
            document.getElementById('uploadBtn').style.opacity = '0.5';
            document.getElementById('uploadBtn').style.pointerEvents = 'none';
        }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('photoPreview');
                    preview.innerHTML = '<img src="' + e.target.result + '" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #ffc2d1;">';
                    document.getElementById('uploadBtn').style.opacity = '1';
                    document.getElementById('uploadBtn').style.pointerEvents = 'auto';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById('photoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var uploadBtn = document.getElementById('uploadBtn');
            uploadBtn.textContent = '⏳ Mengunggah...';
            uploadBtn.style.opacity = '0.7';

            fetch('/profile/photo', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                var contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('application/json') !== -1) {
                    return response.json().then(function(data) {
                        return { ok: response.ok, status: response.status, data: data };
                    });
                }
                return response.text().then(function(text) {
                    return { ok: response.ok, status: response.status, data: null, text: text };
                });
            })
            .then(function(result) {
                if (result.ok && result.data && result.data.success) {
                    var userProfileBtn = document.getElementById('userProfileBtn');
                    var existingImg = userProfileBtn.querySelector('.user-avatar-img');
                    var avatarDiv = userProfileBtn.querySelector('.user-avatar');

                    if (existingImg) {
                        existingImg.src = result.data.photo_url;
                    } else if (avatarDiv) {
                        var newImg = document.createElement('img');
                        newImg.src = result.data.photo_url;
                        newImg.className = 'user-avatar-img';
                        newImg.alt = 'Profil';
                        newImg.style.cssText = 'width:32px; height:32px; border-radius:50%; object-fit:cover; flex-shrink:0;';
                        avatarDiv.replaceWith(newImg);
                    }
                    var photoPreview = document.getElementById('photoPreview');
                    if (photoPreview) {
                        photoPreview.innerHTML = '<img src="' + result.data.photo_url + '" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #ffc2d1;">';
                    }
                    closePhotoModal();
                    alert('Foto profil berhasil diperbarui!');
                } else if (result.data && result.data.message) {
                    alert(result.data.message);
                } else if (result.status === 422 && result.data && result.data.errors) {
                    var errors = result.data.errors;
                    var firstError = Object.values(errors)[0];
                    alert(Array.isArray(firstError) ? firstError[0] : firstError);
                } else if (result.status === 419) {
                    alert('Sesi habis. Silakan refresh halaman dan coba lagi.');
                } else if (result.status === 401) {
                    alert('Silakan login terlebih dahulu.');
                } else {
                    alert('Terjadi kesalahan saat mengunggah foto (Status: ' + result.status + ')');
                }
            })
            .catch(function(error) {
                alert('Terjadi kesalahan saat mengunggah foto. Silakan coba lagi.');
                console.error('Upload error:', error);
            })
            .finally(function() {
                uploadBtn.textContent = '💾 Simpan Foto';
                uploadBtn.style.opacity = '1';
            });
        });
        document.getElementById('photoModal').addEventListener('click', function(e) {
            if (e.target === this) closePhotoModal();
        });
    </script>
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

