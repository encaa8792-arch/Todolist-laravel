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
        max-width: 650px;
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
      select, input[type="text"], input[type="date"] {
        flex: 1;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
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
      @yield('styles')
    </style>
</head>
<body>
    <div class="box @yield('box-class')">
        @yield('content')
    </div>
</body>
</html>
