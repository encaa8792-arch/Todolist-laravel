@extends('layouts.app')
@section('title', 'Todo List')

@section('content')
    <div class="header-row">
        <h1 style="color: #ff6b9d;">✨Todo List✨</h1>
        <div class="kebab-wrapper">
            <button class="kebab-btn" type="button">
                <span></span><span></span><span></span>
            </button>
            <div class="kebab-menu">
                <button type="button" onclick="toggleBulkMode()">📋 Bulk Action</button>
                <div class="menu-divider"></div>
                <form method="POST" action="/tasks/mark-all-done">
                    @csrf
                    <button type="submit" onclick="return confirm('Tandai semua tugas sebagai selesai?')">✓ Done Semua</button>
                </form>
                <div class="menu-divider"></div>
                <button type="button" onclick="toggleBulkDeleteMode()">🗑️ Hapus</button>
            </div>
        </div>
    </div>

    <form method="POST" action="/tasks/bulk-done" id="bulkForm" style="display:none; margin-bottom: 15px;">
        @csrf
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Pilih Semua
            </label>
            <span id="selectedCount">0 dipilih</span>
            <button type="submit" name="action" value="done" class="done-btn">✓ Done Terpilih</button>
            <button type="submit" name="action" value="undo" class="done-btn" style="background: #f39c12;">↩️ Batal Terpilih</button>
            <button type="button" onclick="cancelBulkMode()" class="cancel-btn">✕ Batal</button>
        </div>
    </form>

    <form method="POST" action="/tasks/bulk-delete" id="bulkDeleteForm" style="display:none; margin-bottom: 15px;">
        @csrf
        @method('DELETE')
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" id="selectAllDelete" onchange="toggleSelectAllDelete()"> Pilih Semua
            </label>
            <span id="selectedDeleteCount">0 dipilih</span>
            <button type="submit" class="delete-btn" onclick="return confirm('Yakin mau hapus tugas terpilih? 🥺')">🗑️ Hapus Terpilih</button>
            <button type="button" onclick="cancelBulkDeleteMode()" class="cancel-btn">✕ Batal</button>
        </div>
    </form>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/tasks" class="add">
        @csrf
        <select name="category" required>
            <option value="">Kategori</option>
            <option value="Kerja">💼 Kerja</option>
            <option value="Kuliah">📚 Kuliah</option>
            <option value="Pribadi">💖 Pribadi</option>
            <option value="Sekolah">📓 Sekolah</option>
        </select>
        <input name="task" required placeholder="Mau ngerjain apa hari ini?">
        <input type="date" name="deadline" class="deadline-input">
        <button type="submit">+ Tambah</button>
    </form>

    @foreach($tasks as $task)
        @php
            $isOverdue = $task->deadline && !$task->is_done && strtotime($task->deadline) < strtotime('today');
        @endphp
        <div class="task {{ $task->is_done ? 'done-box' : '' }} {{ $isOverdue ? 'overdue-red' : '' }}" data-task-id="{{ $task->id }}">
            <input type="checkbox" name="task_ids[]" value="{{ $task->id }}" class="bulk-checkbox-done" onchange="updateSelectedCount()" form="bulkForm" style="display:none;">
            <input type="checkbox" name="delete_ids[]" value="{{ $task->id }}" class="bulk-checkbox-delete" onchange="updateSelectedDeleteCount()" form="bulkDeleteForm" style="display:none;">
            <span class="{{ $task->is_done ? 'done' : '' }}">
                @if($task->category)
                    <span class="badge">{{ $task->category }}</span>
                @endif
                {{ $task->task }}
            </span>
            <div class="task-actions">
                @if($task->start_date || $task->deadline)
                    <span class="deadline-badge {{ $isOverdue ? 'overdue-red' : '' }}">
                        @if($isOverdue && $task->start_date)
                            ⚠️ TELAT - {{ date('d M', strtotime($task->start_date)) }} - {{ date('d M Y', strtotime($task->deadline)) }}
                        @elseif($isOverdue)
                            ⚠️ TELAT - {{ date('d M Y', strtotime($task->deadline)) }}
                        @elseif($task->start_date && $task->deadline)
                            📅 {{ date('d M', strtotime($task->start_date)) }} - {{ date('d M Y', strtotime($task->deadline)) }}
                        @elseif($task->deadline)
                            📅 {{ date('d M Y', strtotime($task->deadline)) }}
                        @elseif($task->start_date)
                            ▶️ {{ date('d M Y', strtotime($task->start_date)) }}
                        @endif
                    </span>
                @endif
                <form method="POST" action="/tasks/{{ $task->id }}/done" style="display:inline;">
                    @csrf
                    <button type="submit" class="done-btn {{ $task->is_done ? 'cancel' : '' }}">
                        {{ $task->is_done ? '↩️ Batal' : '✓ Done' }}
                    </button>
                </form>
                <a href="/tasks/{{ $task->id }}/edit" class="edit-btn">✏️</a>
                <form method="POST" action="/tasks/{{ $task->id }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Yakin mau hapus? 🥺')">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach

    @if($tasks->hasPages())
        {{ $tasks->links('vendor.pagination.default') }}
    @endif

    <script>
        let bulkMode = false;
        let bulkDeleteMode = false;

        function closeKebabMenu() {
            document.querySelectorAll('.kebab-menu.show').forEach(function(menu) {
                menu.classList.remove('show');
            });
        }

        function toggleBulkMode() {
            closeKebabMenu();
            cancelBulkDeleteMode();
            bulkMode = !bulkMode;
            const form = document.getElementById('bulkForm');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done');

            form.style.display = bulkMode ? 'flex' : 'none';
            checkboxes.forEach(cb => cb.style.display = bulkMode ? 'inline' : 'none');

            if (!bulkMode) {
                checkboxes.forEach(cb => cb.checked = false);
                document.getElementById('selectAll').checked = false;
                updateSelectedCount();
            }
        }

        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done');
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done:checked');
            document.getElementById('selectedCount').textContent = checkboxes.length + ' dipilih';
        }

        function cancelBulkMode() {
            if (bulkMode) toggleBulkMode();
        }

        function toggleBulkDeleteMode() {
            closeKebabMenu();
            cancelBulkMode();
            bulkDeleteMode = !bulkDeleteMode;
            const form = document.getElementById('bulkDeleteForm');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete');

            form.style.display = bulkDeleteMode ? 'flex' : 'none';
            checkboxes.forEach(cb => cb.style.display = bulkDeleteMode ? 'inline' : 'none');

            if (!bulkDeleteMode) {
                checkboxes.forEach(cb => cb.checked = false);
                document.getElementById('selectAllDelete').checked = false;
                updateSelectedDeleteCount();
            }
        }

        function toggleSelectAllDelete() {
            const selectAll = document.getElementById('selectAllDelete');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete');
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateSelectedDeleteCount();
        }

        function updateSelectedDeleteCount() {
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete:checked');
            document.getElementById('selectedDeleteCount').textContent = checkboxes.length + ' dipilih';
        }

        function cancelBulkDeleteMode() {
            if (bulkDeleteMode) toggleBulkDeleteMode();
        }
    </script>
@endsection
