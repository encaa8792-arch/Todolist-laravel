<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('page-title', 'Dashboard TodoList'); ?>

<?php $__env->startSection('styles'); ?>
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
    gap: 10px;
}
.stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}
.stat-icon.total { background: rgba(59,130,246,0.12); color: #2563eb; }
.stat-icon.completed { background: rgba(22,163,74,0.12); color: #16a34a; }
.stat-icon.pending { background: rgba(234,179,8,0.12); color: #ca8a04; }
.stat-icon.overdue { background: rgba(220,38,38,0.12); color: #dc2626; }
.stat-number {
    font-size: 18px;
    font-weight: 700;
    line-height: 1.2;
}
.stat-number.total { color: #2563eb; }
.stat-number.completed { color: #16a34a; }
.stat-number.pending { color: #ca8a04; }
.stat-number.overdue { color: #dc2626; }
.stat-label {
    font-size: 10px;
    color: #64748b;
    font-weight: 500;
}
.content-row {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    flex: 1;
    min-height: 0;
}
.content-col {
    padding: 12px 16px;
    background: rgba(0,0,0,0.015);
    display: flex;
    flex-direction: column;
    min-height: 0;
    overflow: hidden;
}
.content-col:first-child {
    border-right: 1px solid rgba(0,0,0,0.08);
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
.task-deadline {
    font-size: 9px;
    color: #94a3b8;
    flex-shrink: 0;
}
.deadline-list {
    display: flex;
    flex-direction: column;
    gap: 5px;
    overflow-y: auto;
    flex: 1;
}
.deadline-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 8px;
    background: white;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.05);
    border-left: 3px solid #f59e0b;
    height: 38px;
    flex-shrink: 0;
}
.deadline-item.urgent {
    border-left-color: #dc2626;
}
.deadline-text {
    flex: 1;
    font-size: 11px;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.deadline-badge {
    background: rgba(245,158,11,0.1);
    color: #b45309;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 9px;
    font-weight: 600;
    flex-shrink: 0;
}
.deadline-item.urgent .deadline-badge {
    background: rgba(220,38,38,0.1);
    color: #dc2626;
}
.empty-state {
    text-align: center;
    padding: 12px;
    color: #94a3b8;
    font-size: 11px;
}
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                        <div class="stat-info">
                            <div class="stat-number total"><?php echo e($totalTasks); ?></div>
                            <div class="stat-label">Total</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon completed"><i class="bi bi-check-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-number completed"><?php echo e($completedTasks); ?></div>
                            <div class="stat-label">Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon pending"><i class="bi bi-hourglass-split"></i></div>
                        <div class="stat-info">
                            <div class="stat-number pending"><?php echo e($pendingTasks); ?></div>
                            <div class="stat-label">Belum</div>
                        </div>
                    </div>
                </div>
                <div class="stat-cell">
                    <div class="stat-cell-inner">
                        <div class="stat-icon overdue"><i class="bi bi-exclamation-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-number overdue"><?php echo e($overdueTasks); ?></div>
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
                <?php $__empty_1 = true; $__currentLoopData = $recentTasks->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="task-item <?php echo e($task->is_done ? 'done' : ''); ?>">
                        <form action="/tasks/<?php echo e($task->id); ?>/toggle" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-check <?php echo e($task->is_done ? 'checked' : ''); ?>">
                                <i class="bi <?php echo e($task->is_done ? 'bi-check-circle-fill' : 'bi-circle'); ?>"></i>
                            </button>
                        </form>
                        <span class="task-text"><?php echo e($task->task); ?></span>
                        <?php if($task->category): ?>
                            <span class="task-badge"><?php echo e($task->category); ?></span>
                        <?php endif; ?>
                        <?php if($task->deadline): ?>
                            <span class="task-deadline"><?php echo e(date('d/m', strtotime($task->deadline))); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state">Belum ada tugas</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="content-col">
            <div class="section-header">
                <i class="bi bi-calendar-event"></i>
                <span class="section-title">Deadline Mendatang</span>
            </div>
            <div class="deadline-list">
                <?php $__empty_1 = true; $__currentLoopData = $upcomingDeadlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $daysLeft = now()->diffInDays($task->deadline, false);
                        $isUrgent = $daysLeft <= 2;
                    ?>
                    <div class="deadline-item <?php echo e($isUrgent ? 'urgent' : ''); ?>">
                        <span class="deadline-text"><?php echo e($task->task); ?></span>
                        <span class="deadline-badge">
                            <?php if($daysLeft < 0): ?>
                                Terlambat
                            <?php elseif($daysLeft == 0): ?>
                                Hari ini
                            <?php elseif($daysLeft == 1): ?>
                                Besok
                            <?php else: ?>
                                <?php echo e(round($daysLeft)); ?> hari
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state">Tidak ada deadline</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/dashboard.blade.php ENDPATH**/ ?>