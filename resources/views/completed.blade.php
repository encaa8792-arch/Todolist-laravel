@extends('layouts.app')

@section('title', 'Tugas Selesai')

@section('content')
    <div class="header-row">
        <h1 style="color: #2ecc71;">Tugas Selesai</h1>
        <div class="kebab-wrapper">
            <button class="kebab-btn" type="button">
                <span></span><span></span><span></span>
            </button>
            <div class="kebab-menu">
                <button type="button" onclick="toggleBulkMode()">📋 Bulk Action</button>
                <div class="menu-divider"></div>
                <button type="button" onclick="toggleBulkDeleteMode()">🗑️ Hapus</button>
            </div>
        </div>
    </div>

    <form method="POST" action="/tasks/bulk-done" id="bulkForm" style="display:none; margin-bottom: 15px;">
        @csrf
        <input type="hidden" name="action" value="undo">
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Pilih Semua
            </label>
            <span id="selectedCount">0 dipilih</span>
            <button type="submit" class="done-btn cancel">↩️ Batal Selesai</button>
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

    @if($tasks->isEmpty())
        <div class="empty">Belum ada tugas yang selesai</div>
    @else
        @foreach($tasks as $task)
            @php
                $isOverdue = $task->deadline && strtotime($task->deadline) < strtotime('today');
            @endphp
            <div class="task" style="background: #f3f4f6; border-left: 4px solid #2ecc71; opacity: 0.8;" data-task-id="{{ $task->id }}">
                <input type="checkbox" name="task_ids[]" value="{{ $task->id }}" class="bulk-checkbox-done" onchange="updateSelectedCount()" form="bulkForm" style="display:none;">
                <input type="checkbox" name="delete_ids[]" value="{{ $task->id }}" class="bulk-checkbox-delete" onchange="updateSelectedDeleteCount()" form="bulkDeleteForm" style="display:none;">
                <span style="color: #9ca3af; text-decoration: line-through;">
                    @if($task->category)
                        <span class="badge">{{ $task->category }}</span>
                    @endif
                    {{ $task->task }}
                </span>
                <div class="task-actions">
                    @if($task->start_date || $task->deadline)
                        <span class="deadline-badge {{ $isOverdue ? 'overdue' : '' }}">
                            @if($task->start_date && $task->deadline)
                                {{ $isOverdue ? '⚠️ ' : '📅 ' }}{{ date('d M', strtotime($task->start_date)) }} - {{ date('d M Y', strtotime($task->deadline)) }}
                            @elseif($task->deadline)
                                {{ $isOverdue ? '⚠️ ' : '📅 ' }}{{ date('d M Y', strtotime($task->deadline)) }}
                            @else
                                📆 {{ date('d M Y', strtotime($task->start_date)) }}
                            @endif
                        </span>
                    @endif
                    <form method="POST" action="/tasks/{{ $task->id }}/done" style="display:inline;">
                        @csrf
                        <button type="submit" class="done-btn cancel">↩️ Batal</button>
                    </form>
                    <a href="/tasks/{{ $task->id }}/edit" class="edit-btn">✏️</a>
                    <form method="POST" action="/tasks/{{ $task->id }}?from=completed" style="display:inline;">
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
