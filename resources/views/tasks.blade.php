@extends('layouts.app')
@section('title', 'Todo List')
@section('page-title', 'Daftar Tugas')

@section('styles')
    .todo-header {
        text-align: center;
        margin-bottom: 24px;
    }
    .todo-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    .todo-header h1 span {
        color: #ff6b9d;
    }
    .todo-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 20px;
    }
    .form-row {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        flex-wrap: wrap;
    }
    .form-actions {
        margin-left: auto;
    }
    .form-row-end {
        justify-content: flex-start;
    }
    .form-spacer {
        flex: 1;
    }
    .task-form-card {
        background: white;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 16px;
    }
    .filter-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .search-box {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
    }
    .search-box input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: all 0.2s;
        background: white;
    }
    .search-box input:focus {
        border-color: #ff6b9d;
    }
    .filter-group {
        display: flex;
        gap: 10px;
    }
    .filter-group select {
        padding: 10px 14px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-group select:focus {
        border-color: #ff6b9d;
    }
    .todo-form .form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .todo-form label {
        font-size: 11px;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .todo-form select,
    .todo-form input {
        padding: 10px 14px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: all 0.2s;
        background: #fafafa;
    }
    .todo-form select:focus,
    .todo-form input:focus {
        border-color: #ff6b9d;
        background: white;
    }
    .todo-form select {
        width: 130px;
    }
    .todo-form input[type="text"] {
        flex: 1;
        min-width: 180px;
    }
    .date-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .date-input {
        width: 140px;
        padding: 10px 36px 10px 14px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
        outline: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .date-input:focus {
        border-color: var(--theme-primary);
        background: white;
    }
    .date-input::placeholder {
        color: #94a3b8;
    }
    .date-icon {
        position: absolute;
        right: 12px;
        font-size: 14px;
        pointer-events: none;
        color: #94a3b8;
    }
    .flatpickr-alt-input {
        width: 140px;
        padding: 10px 36px 10px 14px;
        border: 2px solid #f0f0f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
        outline: none;
        transition: all 0.2s;
        cursor: pointer;
        position: absolute;
        top: 0;
        left: 0;
    }
    .flatpickr-alt-input:focus {
        border-color: var(--theme-primary);
        background: white;
    }
    .flatpickr-active {
        border-color: var(--theme-primary);
        background: white;
    }
    .btn-tambah {
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        transition: all 0.2s;
        white-space: nowrap;
        height: 42px;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(255, 107, 157, 0.3);
    }
    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 107, 157, 0.4);
    }
    .task-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .task-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 18px;
        border-radius: 12px;
        overflow: visible !important;
        position: relative;
        transition: all 0.2s;
    }
    .task-item:hover {
        transform: translateX(4px);
    }
    .task-item.done {
        opacity: 0.7;
    }
    .task-item.done .task-name {
        text-decoration: line-through;
        color: #aaa;
    }
    .task-item.overdue {
        background: #fef2f2;
    }
    .task-info {
        flex: 1;
        min-width: 0;
    }
    .task-top {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .task-category {
        background: linear-gradient(135deg, #a0c4ff, #c8d8ff);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .task-name {
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
    }
    .task-item.overdue {
        border-left: 4px solid #dc2626;
    }
    .task-item.overdue .task-name {
        color: #1e293b;
    }
    .task-dates {
        display: flex;
        gap: 12px;
        margin-top: 6px;
        font-size: 11px;
        color: #888;
    }
    .task-date {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .task-date.mulai {
        color: #27ae60;
    }
    .task-date.selesai {
        color: #e74c3c;
    }
    .task-date.selesai.overdue {
        color: #c0392b;
        font-weight: 600;
    }
    .task-btns {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }
    .btn-icon {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        position: relative;
    }
    .btn-icon:hover {
        transform: scale(1.1);
    }
    .btn-icon.selesai {
        background: #e8f5e9;
        color: #4caf50;
    }
    .btn-icon.selesai:hover {
        background: #4caf50;
        color: white;
    }
    .btn-icon.batal {
        background: #fff3e0;
        color: #ff9800;
    }
    .btn-icon.batal:hover {
        background: #ff9800;
        color: white;
    }
    .btn-icon.edit {
        background: #e3f2fd;
        color: #2196f3;
    }
    .btn-icon.edit:hover {
        background: #2196f3;
        color: white;
    }
    .btn-icon.hapus {
        background: #fce4ec;
        color: #e91e63;
    }
    .btn-icon.hapus:hover {
        background: #e91e63;
        color: white;
    }
    .btn-icon::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background-color: #1e293b;
        color: #ffffff;
        padding: 4px 8px;
        font-size: 11px;
        border-radius: 6px;
        white-space: nowrap;
        z-index: 9999 !important;
        pointer-events: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        opacity: 0;
        transition: opacity 0.2s;
    }
    .btn-icon:hover::after {
        opacity: 1;
    }
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #bbb;
    }
    .empty-state span {
        font-size: 50px;
        display: block;
        margin-bottom: 10px;
    }
    .empty-state p {
        font-size: 14px;
        margin: 0;
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
    .bulk-action-bar {
        display: none;
        background: white;
        border-radius: 14px;
        padding: 12px 16px;
        margin-bottom: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        align-items: center;
        gap: 12px;
        animation: slideDown 0.2s ease;
    }
    .bulk-action-bar.show {
        display: flex;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .bulk-selected-count {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        flex: 1;
    }
    .bulk-actions {
        display: flex;
        gap: 8px;
    }
    .bulk-btn {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: 'Poppins', sans-serif;
    }
    .bulk-btn.select-all {
        background: #f1f5f9;
        color: #64748b;
    }
    .bulk-btn.select-all:hover {
        background: #e2e8f0;
    }
    .bulk-btn.done {
        background: #d1fae5;
        color: #059669;
    }
    .bulk-btn.done:hover {
        background: #059669;
        color: white;
    }
    .bulk-btn.delete {
        background: #fee2e2;
        color: #dc2626;
    }
    .bulk-btn.delete:hover {
        background: #dc2626;
        color: white;
    }
    .task-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: var(--theme-primary);
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .todo-form {
            flex-direction: column;
            align-items: stretch;
        }
        .todo-form select,
        .todo-form input[type="text"],
        .date-input,
        .flatpickr-alt-input {
            width: 100%;
        }
        .form-actions {
            margin-left: 0;
            width: 100%;
        }
        .btn-tambah {
            width: 100%;
            justify-content: center;
        }
        .task-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .task-info {
            width: 100%;
        }
        .task-btns {
            width: 100%;
            justify-content: flex-end;
        }
        .task-dates {
            flex-wrap: wrap;
        }
    }
@endsection

@section('content')
    @if(session('success'))
        <div class="success-msg">{{ session('success') }}</div>
    @endif

    <div class="task-form-card">
        <form method="POST" action="/tasks" class="todo-form" id="addTaskForm" style="margin-top: 0;">
            @csrf
            <div class="form-row">
                <div class="form-group" style="flex: 1;">
                    <label>Kategori</label>
                    <select name="category" id="taskCategory" required>
                        <option value="">Pilih</option>
                        <option value="Kerja">💼 Kerja</option>
                        <option value="Kuliah">📚 Kuliah</option>
                        <option value="Pribadi">💖 Pribadi</option>
                        <option value="Sekolah">📓 Sekolah</option>
                    </select>
                </div>
                <div class="form-group" style="flex: 3;">
                    <label>Tugas</label>
                    <input name="task" id="taskName" required placeholder="Apa yang perlu dikerjakan?">
                </div>
            </div>
            <div class="form-row form-row-end">
                <div class="form-group">
                    <label>Mulai</label>
                    <div class="date-input-wrapper">
                        <input type="text" name="start_date" id="startDate" class="date-input" placeholder="Pilih Tgl Mulai" readonly>
                        <span class="date-icon">📅</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Selesai</label>
                    <div class="date-input-wrapper">
                        <input type="text" name="deadline" id="deadline" class="date-input" placeholder="Pilih Tgl Selesai" readonly>
                        <span class="date-icon">📅</span>
                    </div>
                </div>
                <div class="form-spacer"></div>
                <div class="form-actions">
                    <button type="submit" class="btn-tambah">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>

    <div class="filter-bar">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari tugas..." onkeyup="filterTasks()">
        </div>
        <div class="filter-group">
            <select id="categoryFilter" onchange="filterTasks()">
                <option value="">Semua Kategori</option>
                <option value="Kerja">💼 Kerja</option>
                <option value="Kuliah">📚 Kuliah</option>
                <option value="Pribadi">💖 Pribadi</option>
                <option value="Sekolah">📓 Sekolah</option>
            </select>
            <select id="statusFilter" onchange="filterTasks()">
                <option value="">Semua Status</option>
                <option value="pending">Belum Selesai</option>
                <option value="done">Selesai</option>
                <option value="overdue">Terlambat</option>
            </select>
        </div>
    </div>

    <div class="bulk-action-bar" id="bulkActionBar">
        <span class="bulk-selected-count" id="bulkSelectedCount">0 Tugas Dipilih</span>
        <div class="bulk-actions">
            <button type="button" class="bulk-btn select-all" onclick="toggleSelectAll()">☑️ Pilih Semua</button>
            <button type="button" class="bulk-btn done" onclick="bulkMarkDone()">✓ Tandai Selesai</button>
            <button type="button" class="bulk-btn delete" onclick="bulkDelete()">🗑 Hapus</button>
        </div>
    </div>

        <div class="task-list" id="taskList">
            @forelse($tasks as $task)
                @php
                    $isOverdue = $task->deadline && !$task->is_done && strtotime($task->deadline) < strtotime('today');
                @endphp
                <div class="task-item {{ $task->is_done ? 'done' : '' }} {{ $isOverdue ? 'overdue' : '' }}"
                     data-category="{{ $task->category ?? '' }}"
                     data-status="{{ $isOverdue ? 'overdue' : ($task->is_done ? 'done' : 'pending') }}"
                     data-task="{{ strtolower($task->task) }}" id="task-{{ $task->id }}">
                    <input type="checkbox" class="task-checkbox" data-id="{{ $task->id }}" onchange="updateBulkBar()">
                    <div class="task-info">
                        <div class="task-top">
                            @if($task->category)
                                <span class="task-category">{{ $task->category }}</span>
                            @endif
                            <span class="task-name">{{ $task->task }}</span>
                        </div>
                        <div class="task-dates">
                            @if($task->start_date)
                                <span class="task-date mulai">
                                    🟢 Mulai: {{ date('d M Y', strtotime($task->start_date)) }}
                                </span>
                            @endif
                            @if($task->deadline)
                                <span class="task-date selesai {{ $isOverdue ? 'overdue' : '' }}">
                                    🔴 Selesai: {{ date('d M Y', strtotime($task->deadline)) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="task-btns">
                        <form method="POST" action="/tasks/{{ $task->id }}/done" class="ajax-form-done">
                            @csrf
                            <button type="submit" class="btn-icon {{ $task->is_done ? 'batal' : 'selesai' }}" data-tooltip="{{ $task->is_done ? 'Batalkan' : 'Tandai Selesai' }}">
                                ✓
                            </button>
                        </form>
                        <a href="/tasks/{{ $task->id }}/edit" class="btn-icon edit" data-tooltip="Edit Tugas">✏</a>
                        <form method="POST" action="/tasks/{{ $task->id }}" class="ajax-form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon hapus" data-tooltip="Hapus Tugas">🗑</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <span>✨</span>
                    <p>Belum ada tugas. Yuk tambah tugas baru!</p>
                </div>
            @endforelse
        </div>

        @if($tasks->hasPages())
            <div style="margin-top: 20px;">
                {{ $tasks->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>

    <script>
        // Flatpickr date validation for form
        document.addEventListener('DOMContentLoaded', function() {
            const startPicker = document.getElementById('startDate');
            const endPicker = document.getElementById('deadline');

            if (startPicker && endPicker && typeof flatpickr !== 'undefined') {
                const locale = {
                    weekdays: {
                        shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                        longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                    },
                    months: {
                        shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                    }
                };

                flatpickr('#startDate', {
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'd M Y',
                    disableMobile: true,
                    locale: locale,
                    onChange: function(selectedDates, dateStr, instance) {
                        if (dateStr && endPicker._flatpickr) {
                            endPicker._flatpickr.set('minDate', dateStr);
                        }
                    }
                });

                flatpickr('#deadline', {
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'd M Y',
                    disableMobile: true,
                    locale: locale,
                    onChange: function(selectedDates, dateStr, instance) {
                        if (dateStr && startPicker._flatpickr) {
                            startPicker._flatpickr.set('maxDate', dateStr);
                        }
                    }
                });
            }
        });

        function filterTasks() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value;
            const status = document.getElementById('statusFilter').value;
            const tasks = document.querySelectorAll('.task-item');

            tasks.forEach(task => {
                const taskName = task.dataset.task;
                const taskCategory = task.dataset.category;
                const taskStatus = task.dataset.status;

                const matchSearch = taskName.includes(search);
                const matchCategory = !category || taskCategory === category;
                const matchStatus = !status || taskStatus === status;

                if (matchSearch && matchCategory && matchStatus) {
                    task.style.display = '';
                } else {
                    task.style.display = 'none';
                }
            });
        }

        // Add Task via AJAX
        document.getElementById('addTaskForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '⏳';
            submitBtn.disabled = true;

            fetch('/tasks', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.id) {
                    showToast('Berhasil', 'Tugas baru telah ditambahkan', 'success');
                    addNotification('Tugas Baru', 'Tugas "' + document.getElementById('taskName').value + '" berhasil ditambahkan', 'success', 'Baru saja');
                    form.reset();
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Gagal', 'Gagal menambahkan tugas', 'error');
                }
            })
            .catch(() => {
                showToast('Gagal', 'Terjadi kesalahan saat menambahkan tugas', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // Done/Cancel Task via AJAX
        document.querySelectorAll('.ajax-form-done').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const taskItem = this.closest('.task-item');
                const isDone = this.querySelector('button').classList.contains('batal');

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (isDone) {
                        showToast('Dibatalkan', 'Tugas dikembalikan ke daftar', 'info');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showToast('Selesai', 'Tugas berhasil diselesaikan!', 'success');
                        setTimeout(() => window.location.href = '/tasks/completed', 500);
                    }
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan', 'error');
                });
            });
        });

        // Delete Task via AJAX
        document.querySelectorAll('.ajax-form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!confirm('Yakin mau hapus?')) return;
                const taskItem = this.closest('.task-item');
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showToast('Dihapus', 'Tugas telah dihapus', 'error');
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => {
                        taskItem.remove();
                        if (document.querySelectorAll('.task-item').length === 0) {
                            location.reload();
                        }
                    }, 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan saat menghapus', 'error');
                });
            });
        });

        // Bulk Action Functions
        function updateBulkBar() {
            const checkboxes = document.querySelectorAll('.task-checkbox:checked');
            const bulkBar = document.getElementById('bulkActionBar');
            const countSpan = document.getElementById('bulkSelectedCount');
            const count = checkboxes.length;

            if (count > 0) {
                bulkBar.classList.add('show');
                countSpan.textContent = count + ' Tugas Dipilih';
            } else {
                bulkBar.classList.remove('show');
            }
        }

        function toggleSelectAll() {
            const allCheckboxes = document.querySelectorAll('.task-checkbox');
            const allChecked = document.querySelectorAll('.task-checkbox:checked').length === allCheckboxes.length;

            allCheckboxes.forEach(cb => {
                cb.checked = !allChecked;
            });
            updateBulkBar();
        }

        function bulkMarkDone() {
            const checkboxes = document.querySelectorAll('.task-checkbox:checked');
            if (checkboxes.length === 0) return;

            const count = checkboxes.length;
            let completed = 0;

            checkboxes.forEach(cb => {
                const taskId = cb.dataset.id;
                fetch('/tasks/' + taskId + '/done', {
                    method: 'POST',
                    body: new FormData(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    completed++;
                    cb.checked = false;
                    const taskItem = cb.closest('.task-item');
                    taskItem.classList.add('done');
                    taskItem.querySelector('.task-name').style.textDecoration = 'line-through';
                    taskItem.querySelector('.task-name').style.color = '#aaa';

                    if (completed === count) {
                        showToast('Selesai', count + ' Tugas berhasil diselesaikan!', 'success');
                        document.getElementById('bulkActionBar').classList.remove('show');
                    }
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan', 'error');
                });
            });
        }

        function bulkDelete() {
            const checkboxes = document.querySelectorAll('.task-checkbox:checked');
            if (checkboxes.length === 0) return;
            if (!confirm('Yakin ingin menghapus ' + checkboxes.length + ' tugas?')) return;

            const count = checkboxes.length;
            let deleted = 0;

            checkboxes.forEach(cb => {
                const taskId = cb.dataset.id;
                const taskItem = cb.closest('.task-item');
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'DELETE');

                fetch('/tasks/' + taskId, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    deleted++;
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => {
                        taskItem.remove();
                        if (deleted === count) {
                            showToast('Dihapus', count + ' Tugas telah dihapus', 'error');
                            document.getElementById('bulkActionBar').classList.remove('show');
                        }
                    }, 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan saat menghapus', 'error');
                });
            });
        }
    </script>
@endsection
