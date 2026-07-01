@extends('layouts.app')

@section('title', 'Todo List')

@section('content')
    <h1 style="color: #ff6b9d;">✨Todo List✨</h1>

    <div class="nav-link">
        <a href="/tasks/completed">Lihat Tugas Selesai →</a>
    </div>

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
        <div class="task {{ $task->is_done ? 'done-box' : '' }} {{ $isOverdue ? 'overdue-task' : '' }}">
            <span class="{{ $task->is_done ? 'done' : '' }}">
                @if($task->category)
                    <span class="badge">{{ $task->category }}</span>
                @endif
                {{ $task->task }}
                @if($task->deadline)
                    <span class="deadline-badge {{ $isOverdue ? 'overdue' : '' }}">
                        {{ $isOverdue ? '⚠️ ' : '📅 ' }}{{ date('d M Y', strtotime($task->deadline)) }}
                    </span>
                @endif
            </span>

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
    @endforeach

    <div style="margin-top: 20px;">
        {{ $tasks->links() }}
    </div>
@endsection
