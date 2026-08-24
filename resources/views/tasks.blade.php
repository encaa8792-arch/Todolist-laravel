@extends('layouts.app')
@section('title', 'Todo List')
@section('page-title', 'Daftar Tugas')

@section('styles')
    .todo-container {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }
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
        gap: 10px;
        margin-bottom: 20px;
        align-items: flex-end;
        flex-wrap: wrap;
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
    .todo-form input[type="date"] {
        width: 140px;
    }
    .btn-tambah {
        background: linear-gradient(135deg, #ff6b9d, #ff8fa3);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        transition: all 0.2s;
        white-space: nowrap;
        height: 42px;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(255,107,157,0.3);
    }
    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255,107,157,0.4);
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
        background: white;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
    }
    .task-item:hover {
        border-color: #ffc2d1;
        box-shadow: 0 4px 16px rgba(255,107,157,0.1);
        transform: translateX(4px);
    }
    .task-item.done {
        background: #f8f8f8;
        opacity: 0.7;
    }
    .task-item.done .task-name {
        text-decoration: line-through;
        color: #aaa;
    }
    .task-item.overdue {
        background: #fff5f5;
        border-color: #ffcdd2;
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
        color: #333;
    }
    .task-item.overdue .task-name {
        color: #e74c3c;
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
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
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
    @media (max-width: 768px) {
        .todo-form {
            flex-direction: column;
            align-items: stretch;
        }
        .todo-form select,
        .todo-form input[type="text"],
        .todo-form input[type="date"] {
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

    <div class="todo-container">
        <form method="POST" action="/tasks" class="todo-form" style="margin-top: 0;">
            @csrf
            <div class="form-group">
                <label>Kategori</label>
                <select name="category" required>
                    <option value="">Pilih</option>
                    <option value="Kerja">💼 Kerja</option>
                    <option value="Kuliah">📚 Kuliah</option>
                    <option value="Pribadi">💖 Pribadi</option>
                    <option value="Sekolah">📓 Sekolah</option>
                </select>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Tugas</label>
                <input name="task" required placeholder="Apa yang perlu dikerjakan?">
            </div>
            <div class="form-group">
                <label>Mulai</label>
                <input type="date" name="start_date" id="startDate">
            </div>
            <div class="form-group">
                <label>Selesai</label>
                <input type="date" name="deadline" id="deadline">
            </div>
            <button type="submit" class="btn-tambah">+ Tambah</button>
        </form>

        <div class="task-list">
            @forelse($tasks as $task)
                @php
                    $isOverdue = $task->deadline && !$task->is_done && strtotime($task->deadline) < strtotime('today');
                @endphp
                <div class="task-item {{ $task->is_done ? 'done' : '' }} {{ $isOverdue ? 'overdue' : '' }}">
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
                        <form method="POST" action="/tasks/{{ $task->id }}/done">
                            @csrf
                            <button type="submit" class="btn-icon {{ $task->is_done ? 'batal' : 'selesai' }}" data-tooltip="{{ $task->is_done ? 'Batalkan' : 'Tandai Selesai' }}">
                                ✓
                            </button>
                        </form>
                        <a href="/tasks/{{ $task->id }}/edit" class="btn-icon edit" data-tooltip="Edit Tugas">✏</a>
                        <form method="POST" action="/tasks/{{ $task->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon hapus" data-tooltip="Hapus Tugas" onclick="return confirm('Yakin mau hapus?')">🗑</button>
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
        document.getElementById('deadline').addEventListener('change', function() {
            const startDate = document.getElementById('startDate');
            if (startDate.value && this.value) {
                if (new Date(startDate.value) > new Date(this.value)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                    startDate.value = this.value;
                }
            }
            if (this.value) {
                startDate.max = this.value;
            } else {
                startDate.removeAttribute('max');
            }
        });

        document.getElementById('startDate').addEventListener('change', function() {
            const deadline = document.getElementById('deadline');
            if (this.value && deadline.value) {
                if (new Date(this.value) > new Date(deadline.value)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                    deadline.value = this.value;
                }
            }
            if (this.value) {
                deadline.min = this.value;
            } else {
                deadline.removeAttribute('min');
            }
        });
    </script>
@endsection
