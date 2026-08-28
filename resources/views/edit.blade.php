@extends('layouts.app')

@section('title', 'Edit Tugas')
@section('page-title', 'Edit Tugas')

@section('styles')
    .edit-form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 12px;
    }
    .edit-form-group label {
        font-size: 12px;
        font-weight: 500;
        color: #555;
    }
    .edit-form-group select,
    .edit-form-group input[type="text"] {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--theme-border);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
    }
    .edit-form-group select:focus,
    .edit-form-group input[type="text"]:focus {
        border-color: var(--theme-primary);
    }
    .date-row {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        flex-wrap: wrap;
    }
    .date-col {
        flex: 1;
        min-width: 140px;
    }
    .date-arrow {
        color: #999;
        font-size: 14px;
        margin-bottom: 12px;
    }
    .date-col label {
        font-size: 11px;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }
    .date-col label.start { color: #27ae60; }
    .date-col label.end { color: #e74c3c; }
    .date-col input {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--theme-border);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
    }
    .date-col input:focus {
        border-color: var(--theme-primary);
    }
    .btn-update {
        width: 100%;
        padding: 14px;
        background: var(--theme-primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 15px;
        font-family: 'Poppins', sans-serif;
        transition: filter 0.2s, transform 0.2s;
    }
    .btn-update:hover {
        filter: brightness(0.9);
        transform: translateY(-2px);
    }
    .btn-back {
        display: block;
        text-align: center;
        margin-top: 12px;
        color: var(--theme-primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 13px;
        transition: color 0.2s;
    }
    .btn-back:hover {
        color: var(--theme-secondary);
        text-decoration: underline;
    }
@endsection

@section('content')
    <div class="glass-card">
        <h2 style="text-align:center; margin:0 0 20px; color:#333;">✏️ Edit Tugas</h2>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="edit-form-group">
            <label for="category">Kategori</label>
            <select name="category" id="category" required>
                <option value="">Pilih Kategori</option>
                <option value="Kerja" {{ $task->category == 'Kerja' ? 'selected' : '' }}>💼 Kerja</option>
                <option value="Kuliah" {{ $task->category == 'Kuliah' ? 'selected' : '' }}>📚 Kuliah</option>
                <option value="Pribadi" {{ $task->category == 'Pribadi' ? 'selected' : '' }}>💖 Pribadi</option>
                <option value="Sekolah" {{ $task->category == 'Sekolah' || $task->category == 'sekolah' ? 'selected' : '' }}>📓 Sekolah</option>
            </select>
        </div>

        <div class="edit-form-group">
            <label for="task">Nama Tugas</label>
            <input type="text" name="task" id="task" value="{{ $task->task }}" placeholder="Nama tugas" required>
        </div>

        <div class="date-row">
            <div class="date-col">
                <label class="start" for="start_date">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ $task->start_date }}">
            </div>
            <span class="date-arrow">→</span>
            <div class="date-col">
                <label class="end" for="deadline">Tanggal Selesai</label>
                <input type="date" name="deadline" id="deadline" value="{{ $task->deadline }}">
            </div>
        </div>

        <button type="submit" class="btn-update">Update</button>
    </form>
    <a href="/tasks" class="btn-back">← Batal / Kembali</a>
    </div>

    <script>
        document.getElementById('deadline').addEventListener('change', function() {
            const startDate = document.getElementById('start_date');
            if (startDate.value && this.value) {
                if (new Date(startDate.value) > new Date(this.value)) {
                    startDate.value = this.value;
                }
                startDate.max = this.value;
            } else {
                startDate.max = this.value || '';
            }
        });

        document.getElementById('start_date').addEventListener('change', function() {
            const deadline = document.getElementById('deadline');
            if (this.value && deadline.value) {
                if (new Date(this.value) > new Date(deadline.value)) {
                    deadline.value = this.value;
                }
            }
            if (deadline.value) {
                deadline.min = this.value;
            }
        });
    </script>
@endsection
