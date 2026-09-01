@extends('layouts.app')

@section('title', 'Tugas Selesai')
@section('page-title', 'Tugas Selesai')

@section('styles')
    .completed-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .completed-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 18px;
        border-radius: 12px;
        border-left: 4px solid #16a34a;
        background: #f0fdf4;
        transition: all 0.2s;
    }
    .completed-item:hover {
        transform: translateY(-2px);
    }
    .completed-info {
        flex: 1;
        min-width: 0;
    }
    .completed-top {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .completed-category {
        background: linear-gradient(135deg, #a0c4ff, #c8d8ff);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .completed-name {
        font-size: 14px;
        font-weight: 500;
        color: #334155;
        opacity: 0.75;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .completed-name::before {
        content: '✓';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        background: #16a34a;
        color: white;
        border-radius: 50%;
        font-size: 10px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .completed-dates {
        display: flex;
        gap: 12px;
        margin-top: 6px;
        font-size: 12px;
        color: #64748b;
    }
    .completed-date {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .completed-date.selesai {
        color: #2ecc71;
    }
    .completed-date.waktu {
        color: #888;
    }
    .completed-btns {
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
    .btn-icon.restore {
        background: #fff3e0;
        color: #ff9800;
    }
    .btn-icon.restore:hover {
        background: #ff9800;
        color: white;
    }
    .btn-icon.delete {
        background: #fce4ec;
        color: #e91e63;
    }
    .btn-icon.delete:hover {
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
    .bulk-btn.restore {
        background: #fff3e0;
        color: #ff9800;
    }
    .bulk-btn.restore:hover {
        background: #ff9800;
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
    .completed-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #16a34a;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .completed-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .completed-info {
            width: 100%;
        }
        .completed-btns {
            width: 100%;
            justify-content: flex-end;
        }
        .completed-dates {
            flex-wrap: wrap;
        }
        .bulk-action-bar {
            flex-wrap: wrap;
        }
        .bulk-actions {
            width: 100%;
            flex-wrap: wrap;
        }
        .bulk-btn {
            flex: 1;
            justify-content: center;
        }
    }
@endsection

@section('content')
    <div class="bulk-action-bar" id="completedBulkBar">
        <span class="bulk-selected-count" id="completedBulkCount">0 Tugas Dipilih</span>
        <div class="bulk-actions">
            <button type="button" class="bulk-btn select-all" onclick="completedToggleSelectAll()">☑️ Pilih Semua</button>
            <button type="button" class="bulk-btn restore" onclick="completedBulkRestore()">↩️ Kembalikan</button>
            <button type="button" class="bulk-btn delete" onclick="completedBulkDelete()">🗑 Hapus</button>
        </div>
    </div>

    <div class="completed-list">
        @forelse($tasks as $task)
            <div class="completed-item" id="completed-task-{{ $task->id }}">
                <input type="checkbox" class="completed-checkbox completed-cb" data-id="{{ $task->id }}" onchange="updateCompletedBulkBar()">
                <div class="completed-info">
                    <div class="completed-top">
                        @if($task->category)
                            <span class="completed-category">{{ $task->category }}</span>
                        @endif
                        <span class="completed-name">{{ $task->task }}</span>
                    </div>
                    <div class="completed-dates">
                        @if($task->deadline)
                            <span class="completed-date selesai">
                                ✓ Selesai: {{ date('d M Y', strtotime($task->deadline)) }}
                            </span>
                        @endif
                        @if($task->updated_at)
                            <span class="completed-date waktu">
                                🕐 {{ date('H:i', strtotime($task->updated_at)) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="completed-btns">
                    <form method="POST" action="/tasks/{{ $task->id }}/done" style="display:inline;" class="ajax-restore">
                        @csrf
                        <button type="submit" class="btn-icon restore" data-tooltip="Kembalikan">↩️</button>
                    </form>
                    <form method="POST" action="/tasks/{{ $task->id }}" style="display:inline;" class="ajax-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon delete" data-tooltip="Hapus Permanen">🗑️</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <span>✨</span>
                <p>Belum ada tugas yang selesai</p>
            </div>
        @endforelse
    </div>

    @if($tasks->hasPages())
        <div style="margin-top: 20px;">
            {{ $tasks->links('vendor.pagination.default') }}
        </div>
    @endif

    <script>
        function updateCompletedBulkBar() {
            const checkboxes = document.querySelectorAll('.completed-cb:checked');
            const bulkBar = document.getElementById('completedBulkBar');
            const countSpan = document.getElementById('completedBulkCount');
            const count = checkboxes.length;

            if (count > 0) {
                bulkBar.classList.add('show');
                countSpan.textContent = count + ' Tugas Dipilih';
            } else {
                bulkBar.classList.remove('show');
            }
        }

        function completedToggleSelectAll() {
            const allCheckboxes = document.querySelectorAll('.completed-cb');
            const allChecked = document.querySelectorAll('.completed-cb:checked').length === allCheckboxes.length;

            allCheckboxes.forEach(cb => {
                cb.checked = !allChecked;
            });
            updateCompletedBulkBar();
        }

        function completedBulkRestore() {
            const checkboxes = document.querySelectorAll('.completed-cb:checked');
            if (checkboxes.length === 0) return;

            const count = checkboxes.length;
            let restored = 0;

            checkboxes.forEach(cb => {
                const taskId = cb.dataset.id;
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                fetch('/tasks/' + taskId + '/done', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    restored++;
                    cb.checked = false;
                    const taskItem = document.getElementById('completed-task-' + taskId);
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => {
                        taskItem.remove();
                        if (restored === count) {
                            showToast('Dikembalikan', count + ' Tugas dikembalikan ke daftar aktif', 'success');
                            document.getElementById('completedBulkBar').classList.remove('show');
                        }
                    }, 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan saat mengembalikan tugas', 'error');
                });
            });
        }

        function completedBulkDelete() {
            const checkboxes = document.querySelectorAll('.completed-cb:checked');
            if (checkboxes.length === 0) return;
            if (!confirm('Yakin ingin menghapus ' + checkboxes.length + ' tugas secara permanen?')) return;

            const count = checkboxes.length;
            let deleted = 0;

            checkboxes.forEach(cb => {
                const taskId = cb.dataset.id;
                const taskItem = document.getElementById('completed-task-' + taskId);
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'DELETE');

                fetch('/tasks/' + taskId, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    deleted++;
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => {
                        taskItem.remove();
                        if (deleted === count) {
                            showToast('Dihapus', count + ' Tugas dihapus secara permanen', 'error');
                            document.getElementById('completedBulkBar').classList.remove('show');
                        }
                    }, 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan saat menghapus', 'error');
                });
            });
        }

        // Individual restore/delete with AJAX
        document.querySelectorAll('.ajax-restore').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const taskItem = this.closest('.completed-item');
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    showToast('Dikembalikan', 'Tugas dikembalikan ke daftar aktif', 'success');
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => taskItem.remove(), 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan', 'error');
                });
            });
        });

        document.querySelectorAll('.ajax-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!confirm('Yakin ingin menghapus tugas ini secara permanen?')) return;
                const taskItem = this.closest('.completed-item');
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    showToast('Dihapus', 'Tugas dihapus secara permanen', 'error');
                    taskItem.style.animation = 'fadeOut 0.3s ease forwards';
                    setTimeout(() => taskItem.remove(), 300);
                })
                .catch(() => {
                    showToast('Gagal', 'Terjadi kesalahan', 'error');
                });
            });
        });
    </script>
@endsection
