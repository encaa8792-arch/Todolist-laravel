@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    .dashboard-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .dashboard-header h1 {
        color: #ff6b9d;
        margin-bottom: 5px;
    }
    .dashboard-header p {
        color: #9ca3af;
        font-size: 14px;
        margin: 0;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }
    .stat-card {
        background: linear-gradient(135deg, #fff0f5 0%, #ffe8f0 100%);
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255,107,157,0.15);
    }
    .stat-card .number {
        font-size: 32px;
        font-weight: 700;
        color: #ff6b9d;
        margin: 5px 0;
    }
    .stat-card .label {
        font-size: 12px;
        color: #9ca3af;
        font-weight: 500;
    }
    .stat-card.completed .number { color: #2ecc71; }
    .stat-card.completed { background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); }
    .stat-card.pending .number { color: #f39c12; }
    .stat-card.pending { background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); }
    .stat-card.overdue .number { color: #ff6b6b; }
    .stat-card.overdue { background: linear-gradient(135deg, #ffe0e0 0%, #ffb3b3 100%); }
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #ffc2d1;
    }
    .category-list {
        margin-bottom: 25px;
    }
    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: #fff0f5;
        border-radius: 10px;
        margin-bottom: 8px;
    }
    .category-name {
        font-weight: 500;
        font-size: 14px;
    }
    .category-stats {
        display: flex;
        gap: 10px;
        font-size: 12px;
    }
    .category-stats span {
        padding: 4px 10px;
        border-radius: 15px;
        background: white;
    }
    .task-mini {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background: #fff0f5;
        border-radius: 10px;
        margin-bottom: 8px;
        font-size: 13px;
    }
    .task-mini .task-text {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 10px;
    }
    .task-mini .task-date {
        font-size: 11px;
        color: #9ca3af;
        white-space: nowrap;
    }
    .deadline-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: #fff0f5;
        border-radius: 10px;
        margin-bottom: 8px;
    }
    .deadline-item .task-name {
        flex: 1;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 10px;
    }
    .deadline-item .deadline-date {
        background: #ffd6a5;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
    }
    .deadline-item .deadline-date.urgent {
        background: #ff6b6b;
        color: white;
    }
    .empty-section {
        text-align: center;
        color: #9ca3af;
        padding: 20px;
        font-style: italic;
        font-size: 13px;
    }
    .weekly-report {
        background: linear-gradient(135deg, #e8f4f8 0%, #d4ecf7 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
    }
    .weekly-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .weekly-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .weekly-range {
        font-size: 12px;
        color: #6b7280;
    }
    .weekly-trend {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }
    .weekly-trend.up { background: #d4edda; color: #2ecc71; }
    .weekly-trend.down { background: #ffe0e0; color: #ff6b6b; }
    .weekly-trend.same { background: #e8f4f8; color: #6b7280; }
    .weekly-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 15px;
    }
    .weekly-stat {
        text-align: center;
        padding: 12px;
        background: white;
        border-radius: 10px;
    }
    .weekly-stat .number {
        font-size: 24px;
        font-weight: 700;
        color: #ff6b9d;
    }
    .weekly-stat .label {
        font-size: 11px;
        color: #9ca3af;
    }
    .weekly-chart {
        display: flex;
        justify-content: space-around;
        align-items: flex-end;
        height: 80px;
        padding: 10px 0;
    }
    .chart-bar {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    .bar-container {
        display: flex;
        gap: 3px;
        align-items: flex-end;
        height: 50px;
    }
    .bar {
        width: 12px;
        border-radius: 3px 3px 0 0;
    }
    .bar.created { background: #ff6b9d; }
    .bar.completed { background: #2ecc71; }
    .chart-day {
        font-size: 10px;
        color: #9ca3af;
    }
@endsection

@section('content')
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Kelola tugasmu dengan lebih baik</p>
    </div>

    <div class="weekly-report">
        <div class="weekly-header">
            <h3>Laporan Mingguan</h3>
            <span class="weekly-range">{{ $weekStart->format('d M') }} - {{ $weekEnd->format('d M Y') }}</span>
        </div>
        <div style="text-align: right; margin-bottom: 10px;">
            <span class="weekly-trend {{ $weeklyTrend > 0 ? 'up' : ($weeklyTrend < 0 ? 'down' : 'same') }}">
                {{ $weeklyTrend > 0 ? '+' : '' }}{{ $weeklyTrend }}% dari minggu lalu
            </span>
        </div>
        <div class="weekly-stats">
            <div class="weekly-stat">
                <div class="number">{{ $weeklyTotal }}</div>
                <div class="label">Dibuat</div>
            </div>
            <div class="weekly-stat">
                <div class="number">{{ $weeklyCompleted }}</div>
                <div class="label">Diselesaikan</div>
            </div>
            <div class="weekly-stat">
                <div class="number">{{ $weeklyPending }}</div>
                <div class="label">Belum Selesai</div>
            </div>
        </div>
        <div class="weekly-chart">
            @foreach($dailyStats as $stat)
                <div class="chart-bar">
                    <div class="bar-container">
                        <div class="bar created" style="height: {{ max($stat['created'] * 10, 4) }}px;"></div>
                        <div class="bar completed" style="height: {{ max($stat['completed'] * 10, 4) }}px;"></div>
                    </div>
                    <span class="chart-day">{{ $stat['day'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="label">Total Tugas</div>
            <div class="number">{{ $totalTasks }}</div>
        </div>
        <div class="stat-card completed">
            <div class="label">Selesai</div>
            <div class="number">{{ $completedTasks }}</div>
        </div>
        <div class="stat-card pending">
            <div class="label">Dikerjakan</div>
            <div class="number">{{ $pendingTasks }}</div>
        </div>
        <div class="stat-card overdue">
            <div class="label">Terlambat</div>
            <div class="number">{{ $overdueTasks }}</div>
        </div>
    </div>

    @if($categoryStats->count())
        <div class="category-list">
            <div class="section-title">Kategori</div>
            @foreach($categoryStats as $stat)
                <div class="category-item">
                    <span class="category-name">{{ $stat->category ?? 'Tanpa Kategori' }}</span>
                    <div class="category-stats">
                        <span>{{ $stat->completed ?? 0 }}/{{ $stat->total }} selesai</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($upcomingDeadlines->count())
        <div>
            <div class="section-title">Deadline Mendatang</div>
            @foreach($upcomingDeadlines as $task)
                @php
                    $daysLeft = now()->diffInDays($task->deadline, false);
                    $isUrgent = $daysLeft <= 2;
                @endphp
                <div class="deadline-item">
                    <span class="task-name">
                        @if($task->category)
                            <span class="badge">{{ $task->category }}</span>
                        @endif
                        {{ $task->task }}
                    </span>
                    <span class="deadline-date {{ $isUrgent ? 'urgent' : '' }}">
                        {{ date('d M', strtotime($task->deadline)) }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif

    @if($recentTasks->count())
        <div style="margin-top: 25px;">
            <div class="section-title">Tugas Terbaru</div>
            @foreach($recentTasks as $task)
                <div class="task-mini">
                    <span class="task-text">
                        @if($task->category)
                            <span class="badge">{{ $task->category }}</span>
                        @endif
                        {{ $task->task }}
                    </span>
                    <span class="task-date">{{ date('d M', strtotime($task->created_at)) }}</span>
                </div>
            @endforeach
        </div>
    @endif
@endsection