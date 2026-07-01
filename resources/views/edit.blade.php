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

        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" value="{{ $task->deadline }}">

        <button type="submit" class="btn-update">Update</button>
    </form>
    <a href="/tasks" class="btn-back">← Batal / Kembali</a>
@endsection
