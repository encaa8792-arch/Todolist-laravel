@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('box-class', 'edit-box')

@section('content')
    <h2>✏️ Edit Tugas</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="category">Kategori</label>
        <select name="category" id="category" required>
            <option value="">Pilih Kategori</option>
            <option value="Kerja" {{ $task->category == 'Kerja' ? 'selected' : '' }}>💼 Kerja</option>
            <option value="Kuliah" {{ $task->category == 'Kuliah' ? 'selected' : '' }}>📚 Kuliah</option>
            <option value="Pribadi" {{ $task->category == 'Pribadi' ? 'selected' : '' }}>💖 Pribadi</option>
            <option value="Sekolah" {{ $task->category == 'Sekolah' || $task->category == 'sekolah' ? 'selected' : '' }}>📓 Sekolah</option>
        </select>

        <label for="task">Nama Tugas</label>
        <input type="text" name="task" id="task" value="{{ $task->task }}" placeholder="Nama tugas" required>

        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 120px;">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ $task->start_date }}">
            </div>
            <span style="color: #999; font-size: 12px; margin-top: 20px;">→</span>
            <div style="flex: 1; min-width: 120px;">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" id="deadline" value="{{ $task->deadline }}">
            </div>
        </div>

        <button type="submit" class="btn-update">Update</button>
    </form>
    <a href="/tasks" class="btn-back">← Batal / Kembali</a>
@endsection
