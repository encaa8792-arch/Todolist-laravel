@extends('layouts.app')

@section('title', 'Tugas Selesai')

@section('content')
    <h1 style="color: #2ecc71;">Tugas Selesai</h1>

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
            <div class="task" style="background: #f3f4f6; border-left: 4px solid #2ecc71; opacity: 0.8;">
                <span style="color: #9ca3af; text-decoration: line-through;">
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
                    <button type="submit" class="done-btn cancel">↩️ Batal</button>
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
    @endif
@endsection
