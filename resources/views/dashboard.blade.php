@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard TodoList')

@section('styles')
    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .dashboard-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .dashboard-header h1 span {
        color: #ff6b9d;
    }
    .greeting {
        font-size: 13px;
        color: #9ca3af;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    .stat-card {
        padding: 20px;
        border-radius: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
    .stat-card .icon-bg {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 40px;
        opacity: 0.15;
    }
    .stat-card .number {
        font-size: 32px;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 6px;
    }
    .stat-card .label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }
    .stat-card .sublabel {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
    }
    .stat-card.total::before { background: linear-gradient(90deg, var(--theme-primary), var(--theme-secondary)); }
    .stat-card.total .number { color: var(--theme-primary); }
    .stat-card.completed::before { background: linear-gradient(90deg, #16a34a, #22c55e); }
    .stat-card.completed .number { color: #16a34a; }
    .stat-card.pending::before { background: linear-gradient(90deg, #ca8a04, #eab308); }
    .stat-card.pending .number { color: #ca8a04; }
    .stat-card.overdue::before { background: linear-gradient(90deg, #dc2626, #ef4444); }
    .stat-card.overdue .number { color: #dc2626; }
    
    .content-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 20px;
    }
    .dashboard-section {
        padding: 0;
    }
    .card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #fff0f5;
    }
    .card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-header h3 span {
        font-size: 20px;
    }
    .card-header .badge {
        background: #fff0f5;
        color: #ff6b9d;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
    .task-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 280px;
        overflow-y: auto;
    }
    .task-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        transition: 0.2s;
    }
    .task-item:hover {
        background: white;
        transform: translateX(3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .task-item .check-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid var(--theme-border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .task-item .check-circle.done {
        background: #16a34a;
        border-color: #16a34a;
        color: white;
        font-size: 12px;
    }
    .task-item .task-content {
        flex: 1;
        min-width: 0;
    }
    .task-item .task-name {
        font-size: 13px;
        font-weight: 500;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .task-item .task-meta {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }
    .task-item .task-badge {
        background: var(--theme-primary);
        color: white;
        padding: 2px 8px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 600;
        flex-shrink: 0;
    }
    .task-item .task-date {
        font-size: 12px;
        color: #475569;
        flex-shrink: 0;
    }
    .task-item .task-date.overdue {
        color: #dc2626;
        font-weight: 600;
    }
    
    .deadline-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 280px;
        overflow-y: auto;
    }
    .deadline-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        border-left: 4px solid var(--theme-primary);
        transition: 0.2s;
    }
    .deadline-item:hover {
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .deadline-item.urgent {
        border-left-color: #dc2626;
        background: rgba(254,226,226,0.9);
    }
    .deadline-item .deadline-icon {
        font-size: 20px;
        flex-shrink: 0;
    }
    .deadline-item .deadline-content {
        flex: 1;
        min-width: 0;
    }
    .deadline-item .deadline-name {
        font-size: 13px;
        font-weight: 500;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .deadline-item .deadline-info {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }
    .deadline-item .deadline-date {
        background: var(--theme-bg);
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        color: #475569;
        flex-shrink: 0;
    }
    .deadline-item.urgent .deadline-date {
        background: #dc2626;
        color: white;
    }
    
    .weekly-chart {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        height: 100px;
        padding: 10px 0;
    }
    .chart-day {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        flex: 1;
    }
    .chart-bars {
        display: flex;
        gap: 4px;
        align-items: flex-end;
        height: 70px;
    }
    .chart-bar {
        width: 14px;
        border-radius: 4px 4px 0 0;
        transition: height 0.3s;
    }
    .chart-bar.created { background: linear-gradient(180deg, #ff6b9d, #ff8fa3); }
    .chart-bar.completed { background: linear-gradient(180deg, #2ecc71, #58d68d); }
    .chart-label {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 500;
    }
    
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .quick-action {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px;
        background: #fff0f5;
        border-radius: 12px;
        text-decoration: none;
        color: #333;
        transition: 0.2s;
    }
    .quick-action:hover {
        background: #ffe8f0;
        transform: translateY(-2px);
    }
    .quick-action .action-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .quick-action .action-icon.pink { background: rgba(255,107,157,0.2); }
    .quick-action .action-icon.green { background: rgba(46,204,113,0.2); }
    .quick-action .action-icon.orange { background: rgba(243,156,18,0.2); }
    .quick-action .action-icon.blue { background: rgba(160,196,255,0.2); }
    .quick-action .action-text {
        font-size: 12px;
        font-weight: 500;
    }
    
    .empty-state {
        text-align: center;
        padding: 30px;
        color: #9ca3af;
    }
    .empty-state span {
        font-size: 40px;
        opacity: 0.5;
    }
    .empty-state p {
        margin: 10px 0 0;
        font-size: 13px;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .stat-card {
            padding: 16px;
        }
        .stat-card .number {
            font-size: 26px;
        }
        .stat-card .icon-bg {
            font-size: 30px;
        }
        .quick-actions {
            grid-template-columns: 1fr;
        }
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .progress-container {
            flex-direction: column;
        }
    }
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
        .stat-card {
            padding: 14px 12px;
        }
        .stat-card .number {
            font-size: 22px;
        }
    }
@endsection

@section('content')
    <div class="glass-card" style="background: rgba(255, 255, 255, 0.72); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
        <div class="stats-grid">
            <div class="stat-card total">
                <span class="icon-bg">📋</span>
                <div class="number">{{ $totalTasks }}</div>
                <div class="label">Total Tugas</div>
                <div class="sublabel">Semua tugas yang dibuat</div>
            </div>
            <div class="stat-card completed">
                <span class="icon-bg">✓</span>
                <div class="number">{{ $completedTasks }}</div>
                <div class="label">Selesai</div>
                <div class="sublabel">Tugas yang sudah selesai</div>
            </div>
            <div class="stat-card pending">
                <span class="icon-bg">⏳</span>
                <div class="number">{{ $pendingTasks }}</div>
                <div class="label">Belum Selesai</div>
                <div class="sublabel">Sedang dikerjakan</div>
            </div>
            <div class="stat-card overdue">
                <span class="icon-bg">⚠️</span>
                <div class="number">{{ $overdueTasks }}</div>
                <div class="label">Terlambat</div>
                <div class="sublabel">Melewati deadline</div>
            </div>
        </div>

        <div class="content-grid" style="margin-top: 0;">
            <div class="dashboard-section">
                <div class="glass-card-header">
                    <div class="glass-card-icon" style="background: rgba(255,107,157,0.15);">📋</div>
                    <div class="glass-card-title">Tugas Terbaru</div>
                    <a href="/tasks" class="badge" style="text-decoration: none; margin-left:auto;">Lihat Semua</a>
                </div>
                
                <div class="task-list">
                    @forelse($recentTasks as $task)
                        <div class="task-item">
                            <div class="check-circle {{ $task->is_done ? 'done' : '' }}">
                                @if($task->is_done) ✓ @endif
                            </div>
                            <div class="task-content">
                                <div class="task-name">{{ $task->task }}</div>
                                <div class="task-meta">{{ date('d M Y', strtotime($task->created_at)) }}</div>
                            </div>
                            @if($task->category)
                                <span class="task-badge">{{ $task->category }}</span>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">
                            <span>✨</span>
                            <p>Belum ada tugas. Yuk, buat tugas baru!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="dashboard-section">
                <div class="glass-card-header">
                    <div class="glass-card-icon" style="background: rgba(243,156,18,0.15);">⏰</div>
                    <div class="glass-card-title">Deadline Mendatang</div>
                </div>
                
                <div class="deadline-list">
                    @forelse($upcomingDeadlines as $task)
                        @php
                            $daysLeft = now()->diffInDays($task->deadline, false);
                            $isUrgent = $daysLeft <= 2;
                        @endphp
                        <div class="deadline-item {{ $isUrgent ? 'urgent' : '' }}">
                            <span class="deadline-icon">⏰</span>
                            <div class="deadline-content">
                                <div class="deadline-name">{{ $task->task }}</div>
                                <div class="deadline-info">
                                    @if($task->category)
                                        <span style="background: var(--theme-primary); color: white; padding: 1px 6px; border-radius: 6px; font-size: 10px;">{{ $task->category }}</span>
                                    @endif
                                </div>
                            </div>
                            <span class="deadline-date">
                                @if($daysLeft < 0)
                                    Terlambat {{ round(abs($daysLeft)) }} hari
                                @elseif($daysLeft == 0)
                                    Hari ini
                                @elseif($daysLeft == 1)
                                    Besok
                                @else
                                    {{ round($daysLeft) }} hari
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="empty-state">
                            <span>🎉</span>
                            <p>Tidak ada deadline mendatang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
