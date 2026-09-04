@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard TodoList')

@section('styles')
.dashboard-main {
    background: rgba(255, 255, 255, 0.92);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    height: calc(100vh - 80px);
    display: flex;
    flex-direction: column;
}
.dashboard-section {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0,0,0,0.08);
    flex-shrink: 0;
}
.dashboard-section:last-child {
    border-bottom: none;
}
.dashboard-section.stats-section {
    padding: 10px 16px;
}
.dashboard-section.content-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 0;
    overflow: hidden;
}
.section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}
.section-header i {
    font-size: 14px;
    color: var(--theme-primary);
}
.section-title {
    font-size: 12px;
    font-weight: 600;
    color: #1e293b;
}
.section-link {
    margin-left: auto;
    font-size: 11px;
    color: var(--theme-primary);
    text-decoration: none;
    font-weight: 500;
}
.section-link:hover {
    text-decoration: underline;
}
.stats-table {
    display: table;
    width: 100%;
    border-collapse: collapse;
}
.stats-row {
    display: table-row;
}
.stat-cell {
    display: table-cell;
    width: 25%;
    padding: 8px 12px;
    text-align: left;
    vertical-align: middle;
    border-right: 1px solid rgba(0,0,0,0.08);
}
.stat-cell:last-child {
    border-right: none;
}
.stat-cell-inner {
    display: flex;
    align-items: center;
    gap: 12px;
}
.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.stat-icon.total { background: rgba(59,130,246,0.12); color: #2563eb; }
.stat-icon.completed { background: rgba(22,163,74,0.12); color: #16a34a; }
.stat-icon.pending { background: rgba(234,179,8,0.12); color: #ca8a04; }
.stat-icon.overdue { background: rgba(220,38,38,0.12); color: #dc2626; }
.stat-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.stat-number {
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
}
.stat-number.total { color: #2563eb; }
.stat-number.completed { color: #16a34a; }
.stat-number.pending { color: #ca8a04; }
.stat-number.overdue { color: #dc2626; }
.stat-label {
    font-size: 11px;
    color: #64748b;
    font-weight: 500;
    margin-top: 2px;
}
.content-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 0;
    flex: 1;
    min-height: 0;
    padding: 0 8px 8px 8px;
}
.content-col {
    padding: 12px 16px;
    background: white;
    border-radius: 12px;
    margin: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    min-height: 0;
    overflow: hidden;
}
.task-list {
    display: flex;
    flex-direction: column;
    gap: 5px;
    overflow-y: auto;
    flex: 1;
}
.task-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 8px;
    background: white;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.05);
    height: 38px;
    flex-shrink: 0;
}
.task-item .btn-check {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: var(--theme-border);
}
.task-item .btn-check.checked {
    color: #16a34a;
}
.task-text {
    flex: 1;
    font-size: 11px;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.task-item.done .task-text {
    text-decoration: line-through;
    color: #94a3b8;
    opacity: 0.7;
}
.task-badge {
    background: var(--theme-bg);
    color: var(--theme-primary);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 9px;
    font-weight: 500;
    flex-shrink: 0;
}
.deadline-list {
    display: grid;
    grid-template-columns: 1fr;
    gap: 8px;
    overflow-y: auto;
    padding-right: 4px;
}
.deadline-wrapper {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-height: 0;
}
.deadline-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 12px;
    background: white;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.06);
    border-top: 3px solid #f59e0b;
    height: fit-content;
    transition: all 0.2s;
}
.deadline-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-1px);
}
.deadline-item.urgent {
    border-top-color: #dc2626;
    background: linear-gradient(to bottom, rgba(220,38,38,0.03), white);
}
.deadline-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}
.deadline-task {
    flex: 1;
    font-size: 12px;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.deadline-status {
    padding: 3px 8px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    flex-shrink: 0;
}
.deadline-status.normal {
    background: rgba(245,158,11,0.12);
    color: #b45309;
}
.deadline-status.urgent {
    background: rgba(220,38,38,0.12);
    color: #dc2626;
}
.deadline-meta {
    display: flex;
    align-items: center;
    gap: 12px;
}
.deadline-info {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #64748b;
}
.deadline-info i {
    font-size: 12px;
}
.deadline-date {
    font-weight: 500;
    color: #475569;
}
.deadline-priority {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 500;
}
.deadline-priority.high {
    background: rgba(220,38,38,0.1);
    color: #dc2626;
}
.deadline-priority.medium {
    background: rgba(245,158,11,0.1);
    color: #b45309;
}
.deadline-priority.low {
    background: rgba(34,197,94,0.1);
    color: #16a34a;
}
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 24px 12px;
    color: #94a3b8;
    font-size: 12px;
}
.dashboard-widget {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 16px;
    margin-top: 12px;
    color: white;
    flex-shrink: 0;
}
.widget-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
    opacity: 0.9;
}
.widget-header i {
    font-size: 14px;
}
.widget-content {
    text-align: center;
}
.widget-quote {
    font-size: 12px;
    font-style: italic;
    line-height: 1.5;
    margin-bottom: 8px;
    opacity: 0.95;
}
.widget-author {
    font-size: 10px;
    opacity: 0.7;
}
@endsection

@section('content')
<div class="dashboard-main">
    <div class="dashboard-section stats-section">
        <div class="section-header">
            <i class="bi bi-grid-3x3-gap"></i>
            <span class="section-title">Statistik</span>
        </div>
        <div class="stats-table">
            <div class="stats-row">
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon total"><i class="bi bi-list-task"></i></div>
                        <div class="stat-text">
                            <div class="stat-number total">{{ $totalTasks }}</div>
                            <div class="stat-label">Total</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon completed"><i class="bi bi-check-circle"></i></div>
                        <div class="stat-text">
                            <div class="stat-number completed">{{ $completedTasks }}</div>
                            <div class="stat-label">Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon pending"><i class="bi bi-hourglass-split"></i></div>
                        <div class="stat-text">
                            <div class="stat-number pending">{{ $pendingTasks }}</div>
                            <div class="stat-label">Belum</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon overdue"><i class="bi bi-exclamation-circle"></i></div>
                        <div class="stat-text">
                            <div class="stat-number overdue">{{ $overdueTasks }}</div>
                            <div class="stat-label">Overdue</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-row">
        <div class="content-col">
            <div class="section-header">
                <i class="bi bi-list-task"></i>
                <span class="section-title">Tugas Terbaru</span>
                <a href="/tasks" class="section-link">Lihat Semua →</a>
            </div>
            <div class="task-list">
                @forelse($recentTasks->take(4) as $task)
                    <div class="task-item {{ $task->is_done ? 'done' : '' }}">
                        <form action="/tasks/{{ $task->id }}/toggle" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-check {{ $task->is_done ? 'checked' : '' }}">
                                <i class="bi {{ $task->is_done ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                            </button>
                        </form>
                        <span class="task-text">{{ $task->task }}</span>
                        @if($task->category)
                            <span class="task-badge">{{ $task->category }}</span>
                        @endif
                        @if($task->deadline)
                            <span class="deadline-info">{{ date('d/m', strtotime($task->deadline)) }}</span>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">Belum ada tugas</div>
                @endforelse
            </div>
        </div>

        <div class="content-col">
            <div class="section-header">
                <i class="bi bi-calendar-event"></i>
                <span class="section-title">Deadline Mendatang</span>
            </div>
            <div class="deadline-wrapper">
            <div class="deadline-list">
                @forelse($upcomingDeadlines as $task)
                    @php
                        $daysLeft = now()->diffInDays($task->deadline, false);
                        $isUrgent = $daysLeft <= 2;
                        $deadlineDate = \Carbon\Carbon::parse($task->deadline)->format('d M Y');
                        $priority = $task->priority ?? 'medium';
                    @endphp
                    <div class="deadline-item {{ $isUrgent ? 'urgent' : '' }}">
                        <div class="deadline-header">
                            <span class="deadline-task">{{ $task->task }}</span>
                            <span class="deadline-status {{ $isUrgent ? 'urgent' : 'normal' }}">
                                @if($daysLeft < 0)
                                    Terlambat
                                @elseif($daysLeft == 0)
                                    Hari ini
                                @elseif($daysLeft == 1)
                                    Besok
                                @else
                                    {{ round($daysLeft) }} hari
                                @endif
                            </span>
                        </div>
                        <div class="deadline-meta">
                            <div class="deadline-info">
                                <i class="bi bi-calendar3"></i>
                                <span class="deadline-date">{{ $deadlineDate }}</span>
                            </div>
                            <span class="deadline-priority {{ $priority }}">
                                <i class="bi bi-flag-fill"></i>
                                {{ ucfirst($priority) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">Tidak ada deadline mendatang</div>
                @endforelse
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
