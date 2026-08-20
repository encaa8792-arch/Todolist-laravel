<?php $__env->startSection('title', 'Todo List'); ?>

<?php $__env->startSection('styles'); ?>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .page-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .page-header h1 span {
        color: #ff6b9d;
    }
    .add-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: flex-end;
        flex-wrap: wrap;
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .form-group label {
        font-size: 11px;
        font-weight: 500;
        color: #666;
    }
    .form-group select,
    .form-group input {
        padding: 10px 14px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.2s;
        background: white;
        height: 42px;
    }
    .form-group select:focus,
    .form-group input:focus {
        border-color: #ff6b9d;
    }
    .form-group select {
        width: 140px;
    }
    .form-group input[type="text"] {
        flex: 1;
        min-width: 200px;
    }
    .form-group input[type="date"] {
        width: 145px;
    }
    .btn-add {
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        transition: background 0.2s, transform 0.2s;
        white-space: nowrap;
        height: 42px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-add:hover {
        background: #e05585;
        transform: translateY(-1px);
    }
    
    .task-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .task-card {
        background: white;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: 0.2s;
        border: 1px solid rgba(255,182,193,0.2);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .task-card:hover {
        border-color: #ffc2d1;
        box-shadow: 0 4px 12px rgba(255,107,157,0.1);
        transform: translateX(3px);
    }
    .task-card.overdue {
        background: #ffe5e5;
        border-color: #ff6b6b;
    }
    .task-card.done {
        background: #f8f8f8;
        opacity: 0.75;
    }
    .task-content {
        flex: 1;
        min-width: 0;
    }
    .task-title {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .task-card.done .task-title {
        text-decoration: line-through;
        color: #9ca3af;
    }
    .task-card.overdue .task-title {
        color: #c0392b;
    }
    .task-dates {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 11px;
        margin-top: 6px;
    }
    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 500;
    }
    .date-badge.start {
        background: rgba(46,204,113,0.15);
        color: #27ae60;
    }
    .date-badge.end {
        background: rgba(231,76,60,0.15);
        color: #e74c3c;
    }
    .date-badge.overdue {
        background: #ff6b6b;
        color: white;
    }
    .task-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }
    .task-actions form {
        display: inline;
        margin: 0;
    }
    .btn-action {
        background: none;
        border: none;
        padding: 6px 10px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-action:hover {
        transform: scale(1.1);
    }
    .btn-done-action {
        background: #4CAF50;
        color: white;
    }
    .btn-done-action:hover {
        background: #43a047;
    }
    .btn-cancel-action {
        background: #f39c12;
        color: white;
    }
    .btn-cancel-action:hover {
        background: #e08e0b;
    }
    .btn-edit-action {
        background: #a0c4ff;
        color: white;
    }
    .btn-edit-action:hover {
        background: #7eb3f5;
    }
    .btn-delete-action {
        background: #ff8fa3;
        color: white;
    }
    .btn-delete-action:hover {
        background: #e07088;
    }
    .tooltip {
        position: relative;
    }
    .tooltip::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        margin-bottom: 4px;
        z-index: 10;
    }
    .tooltip:hover::after {
        opacity: 1;
    }
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
    }
    .empty-state span {
        font-size: 40px;
        opacity: 0.5;
    }
    .empty-state p {
        margin: 10px 0 0;
        font-size: 14px;
    }
    .success {
        background: #d4edda;
        color: #155724;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .add-form {
            flex-direction: column;
            align-items: stretch;
        }
        .form-group select,
        .form-group input[type="text"],
        .form-group input[type="date"] {
            width: 100%;
        }
        .btn-add {
            width: 100%;
            justify-content: center;
        }
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .task-card {
            flex-direction: column;
            align-items: flex-start;
        }
        .task-content {
            width: 100%;
        }
        .task-actions {
            width: 100%;
            flex-wrap: wrap;
        }
        .task-actions > * {
            flex: 1;
        }
        .task-actions form,
        .task-actions a {
            min-width: 70px;
            text-align: center;
            justify-content: center;
        }
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="page-header">
        <h1><span>Todo</span> List</h1>
    </div>

    <form method="POST" action="/tasks" class="add-form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Kategori</label>
            <select name="category" required>
                <option value="">Pilih</option>
                <option value="Kerja">💼 Kerja</option>
                <option value="Kuliah">📚 Kuliah</option>
                <option value="Pribadi">💖 Pribadi</option>
                <option value="Sekolah">📓 Sekolah</option>
            </select>
        </div>
        <div class="form-group" style="flex: 1;">
            <label>Tugas</label>
            <input name="task" required placeholder="Apa yang perlu dikerjakan?">
        </div>
        <div class="form-group">
            <label>Mulai</label>
            <input type="date" name="start_date" id="startDate">
        </div>
        <div class="form-group">
            <label>Selesai</label>
            <input type="date" name="deadline" id="deadline">
        </div>
        <button type="submit" class="btn-add">+ Tambah</button>
    </form>

    <div class="task-list">
        <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $isOverdue = $task->deadline && !$task->is_done && strtotime($task->deadline) < strtotime('today');
            ?>
            <div class="task-card <?php echo e($task->is_done ? 'done' : ''); ?> <?php echo e($isOverdue ? 'overdue' : ''); ?>" data-task-id="<?php echo e($task->id); ?>">
                <div class="task-content">
                    <div class="task-title">
                        <?php if($task->category): ?>
                            <span class="badge"><?php echo e($task->category); ?></span>
                        <?php endif; ?>
                        <?php echo e($task->task); ?>

                    </div>
                    <div class="task-dates">
                        <?php if($task->start_date): ?>
                            <span class="date-badge start">
                                🟢 Mulai: <?php echo e(date('d M Y', strtotime($task->start_date))); ?>

                            </span>
                        <?php endif; ?>
                        <?php if($task->deadline): ?>
                            <span class="date-badge end <?php echo e($isOverdue ? 'overdue' : ''); ?>">
                                🔴 Selesai: <?php echo e(date('d M Y', strtotime($task->deadline))); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="task-actions">
                    <form method="POST" action="/tasks/<?php echo e($task->id); ?>/done" style="display: inline-block; margin: 0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-action <?php echo e($task->is_done ? 'btn-cancel-action' : 'btn-done-action'); ?> tooltip" data-tooltip="<?php echo e($task->is_done ? 'Batalkan' : 'Tandai Selesai'); ?>" title="<?php echo e($task->is_done ? 'Batalkan' : 'Tandai Selesai'); ?>">
                            Done
                        </button>
                    </form>
                    <a href="/tasks/<?php echo e($task->id); ?>/edit" class="btn-action btn-edit-action tooltip" data-tooltip="Edit Tugas" title="Edit Tugas">Edit</a>
                    <form method="POST" action="/tasks/<?php echo e($task->id); ?>" style="display: inline-block; margin: 0;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-action btn-delete-action tooltip" data-tooltip="Hapus Tugas" title="Hapus Tugas" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <span>✨</span>
                <p>Tidak ada tugas. Tambahkan tugas baru!</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if($tasks->hasPages()): ?>
        <div style="margin-top: 15px;">
            <?php echo e($tasks->links('vendor.pagination.default')); ?>

        </div>
    <?php endif; ?>

    <script>
        document.getElementById('deadline').addEventListener('change', function() {
            const startDate = document.getElementById('startDate');
            if (startDate.value && this.value) {
                if (new Date(startDate.value) > new Date(this.value)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                    startDate.value = this.value;
                }
            }
            if (this.value) {
                startDate.max = this.value;
            } else {
                startDate.removeAttribute('max');
            }
        });

        document.getElementById('startDate').addEventListener('change', function() {
            const deadline = document.getElementById('deadline');
            if (this.value && deadline.value) {
                if (new Date(this.value) > new Date(deadline.value)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                    deadline.value = this.value;
                }
            }
            if (this.value) {
                deadline.min = this.value;
            } else {
                deadline.removeAttribute('min');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/tasks.blade.php ENDPATH**/ ?>