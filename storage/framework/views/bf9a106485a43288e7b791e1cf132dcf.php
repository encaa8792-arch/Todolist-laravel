<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('styles'); ?>
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
    }
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
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
        box-shadow: 0 8px 25px rgba(255,107,157,0.15);
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
        font-weight: 500;
        color: #666;
    }
    .stat-card .sublabel {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }
    .stat-card.total::before { background: linear-gradient(90deg, #ff6b9d, #ff8fa3); }
    .stat-card.total .number { color: #ff6b9d; }
    .stat-card.completed::before { background: linear-gradient(90deg, #2ecc71, #58d68d); }
    .stat-card.completed .number { color: #2ecc71; }
    .stat-card.pending::before { background: linear-gradient(90deg, #f39c12, #f5b041); }
    .stat-card.pending .number { color: #f39c12; }
    .stat-card.overdue::before { background: linear-gradient(90deg, #ff6b6b, #ff8a8a); }
    .stat-card.overdue .number { color: #ff6b6b; }
    
    .content-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 20px;
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
        background: #fff0f5;
        border-radius: 12px;
        transition: 0.2s;
    }
    .task-item:hover {
        background: #ffe8f0;
        transform: translateX(3px);
    }
    .task-item .check-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid #ffc2d1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .task-item .check-circle.done {
        background: #2ecc71;
        border-color: #2ecc71;
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
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .task-item .task-meta {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 2px;
    }
    .task-item .task-badge {
        background: #a0c4ff;
        color: white;
        padding: 2px 8px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 500;
        flex-shrink: 0;
    }
    .task-item .task-date {
        font-size: 11px;
        color: #666;
        flex-shrink: 0;
    }
    .task-item .task-date.overdue {
        color: #ff6b6b;
        font-weight: 500;
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
        background: #fff0f5;
        border-radius: 12px;
        border-left: 4px solid #f39c12;
        transition: 0.2s;
    }
    .deadline-item:hover {
        background: #ffe8f0;
    }
    .deadline-item.urgent {
        border-left-color: #ff6b6b;
        background: #ffe5e5;
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
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .deadline-item .deadline-info {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 2px;
    }
    .deadline-item .deadline-date {
        background: #ffd6a5;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 500;
        color: #333;
        flex-shrink: 0;
    }
    .deadline-item.urgent .deadline-date {
        background: #ff6b6b;
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div>
                <h1>Dashboard <span>TodoList</span></h1>
                <p class="greeting">Selamat datang! Berikut ringkasan tugas kamu.</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card total">
                <span class="icon-bg">📋</span>
                <div class="number"><?php echo e($totalTasks); ?></div>
                <div class="label">Total Tugas</div>
                <div class="sublabel">Semua tugas yang dibuat</div>
            </div>
            <div class="stat-card completed">
                <span class="icon-bg">✓</span>
                <div class="number"><?php echo e($completedTasks); ?></div>
                <div class="label">Selesai</div>
                <div class="sublabel">Tugas yang sudah selesai</div>
            </div>
            <div class="stat-card pending">
                <span class="icon-bg">⏳</span>
                <div class="number"><?php echo e($pendingTasks); ?></div>
                <div class="label">Belum Selesai</div>
                <div class="sublabel">Sedang dikerjakan</div>
            </div>
            <div class="stat-card overdue">
                <span class="icon-bg">⚠️</span>
                <div class="number"><?php echo e($overdueTasks); ?></div>
                <div class="label">Terlambat</div>
                <div class="sublabel">Melewati deadline</div>
            </div>
        </div>



        <div class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h3><span>📋</span> Tugas Terbaru</h3>
                    <a href="/tasks" class="badge" style="text-decoration: none;">Lihat Semua</a>
                </div>
                
                <div class="task-list">
                    <?php $__empty_1 = true; $__currentLoopData = $recentTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="task-item">
                            <div class="check-circle <?php echo e($task->is_done ? 'done' : ''); ?>">
                                <?php if($task->is_done): ?> ✓ <?php endif; ?>
                            </div>
                            <div class="task-content">
                                <div class="task-name"><?php echo e($task->task); ?></div>
                                <div class="task-meta"><?php echo e(date('d M Y', strtotime($task->created_at))); ?></div>
                            </div>
                            <?php if($task->category): ?>
                                <span class="task-badge"><?php echo e($task->category); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <span>✨</span>
                            <p>Belum ada tugas. Yuk, buat tugas baru!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><span>⏰</span> Deadline Mendatang</h3>
                </div>
                
                <div class="deadline-list">
                    <?php $__empty_1 = true; $__currentLoopData = $upcomingDeadlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $daysLeft = now()->diffInDays($task->deadline, false);
                            $isUrgent = $daysLeft <= 2;
                        ?>
                        <div class="deadline-item <?php echo e($isUrgent ? 'urgent' : ''); ?>">
                            <span class="deadline-icon">⏰</span>
                            <div class="deadline-content">
                                <div class="deadline-name"><?php echo e($task->task); ?></div>
                                <div class="deadline-info">
                                    <?php if($task->category): ?>
                                        <span style="background: #a0c4ff; color: white; padding: 1px 6px; border-radius: 6px; font-size: 10px;"><?php echo e($task->category); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="deadline-date">
                                <?php if($daysLeft < 0): ?>
                                    Terlambat <?php echo e(abs($daysLeft)); ?> hari
                                <?php elseif($daysLeft == 0): ?>
                                    Hari ini
                                <?php elseif($daysLeft == 1): ?>
                                    Besok
                                <?php else: ?>
                                    <?php echo e($daysLeft); ?> hari
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <span>🎉</span>
                            <p>Tidak ada deadline mendatang</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h3><span>📈</span> Grafik Mingguan</h3>
                    <span class="badge">7 Hari Terakhir</span>
                </div>
                
                <div class="weekly-chart">
                    <?php $__empty_1 = true; $__currentLoopData = $dailyStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="chart-day">
                            <div class="chart-bars">
                                <div class="chart-bar created" style="height: <?php echo e(max($stat['created'] * 8, 6)); ?>px;"></div>
                                <div class="chart-bar completed" style="height: <?php echo e(max($stat['completed'] * 8, 6)); ?>px;"></div>
                            </div>
                            <span class="chart-label"><?php echo e($stat['day']); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state" style="width: 100%;">
                            <span>📊</span>
                            <p>Belum ada data untuk ditampilkan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><span>⚡</span> Aksi Cepat</h3>
                </div>
                
                <div class="quick-actions">
                    <a href="/tasks" class="quick-action">
                        <div class="action-icon pink">➕</div>
                        <span class="action-text">Tambah Tugas</span>
                    </a>
                    <a href="/tasks/completed" class="quick-action">
                        <div class="action-icon green">✓</div>
                        <span class="action-text">Lihat Selesai</span>
                    </a>
                    <a href="/categories" class="quick-action">
                        <div class="action-icon orange">📁</div>
                        <span class="action-text">Kategori</span>
                    </a>
                    <a href="/reports" class="quick-action">
                        <div class="action-icon blue">📊</div>
                        <span class="action-text">Laporan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/dashboard.blade.php ENDPATH**/ ?>