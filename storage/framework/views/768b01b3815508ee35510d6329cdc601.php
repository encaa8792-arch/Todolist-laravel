<?php $__env->startSection('title', 'Tugas Selesai'); ?>

<?php $__env->startSection('content'); ?>
    <div class="header-row">
        <h1 style="color: #2ecc71;">Tugas Selesai</h1>
        <div class="kebab-wrapper">
            <button class="kebab-btn" type="button">
                <span></span><span></span><span></span>
            </button>
            <div class="kebab-menu">
                <button type="button" onclick="toggleBulkMode()">📋 Bulk Action</button>
                <div class="menu-divider"></div>
                <button type="button" onclick="toggleBulkDeleteMode()">🗑️ Hapus</button>
            </div>
        </div>
    </div>

    <form method="POST" action="/tasks/bulk-done" id="bulkForm" style="display:none; margin-bottom: 15px;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="undo">
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Pilih Semua
            </label>
            <span id="selectedCount">0 dipilih</span>
            <button type="submit" class="done-btn cancel">↩️ Batal Selesai</button>
            <button type="button" onclick="cancelBulkMode()" class="cancel-btn">✕ Batal</button>
        </div>
    </form>

    <form method="POST" action="/tasks/bulk-delete" id="bulkDeleteForm" style="display:none; margin-bottom: 15px;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" id="selectAllDelete" onchange="toggleSelectAllDelete()"> Pilih Semua
            </label>
            <span id="selectedDeleteCount">0 dipilih</span>
            <button type="submit" class="delete-btn" onclick="return confirm('Yakin mau hapus tugas terpilih? 🥺')">🗑️ Hapus Terpilih</button>
            <button type="button" onclick="cancelBulkDeleteMode()" class="cancel-btn">✕ Batal</button>
        </div>
    </form>

    <?php if(session('success')): ?>
        <div class="success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($tasks->isEmpty()): ?>
        <div class="empty">Belum ada tugas yang selesai</div>
    <?php else: ?>
        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isOverdue = $task->deadline && strtotime($task->deadline) < strtotime('today');
            ?>
            <div class="task" style="background: #f3f4f6; border-left: 4px solid #2ecc71; opacity: 0.8;" data-task-id="<?php echo e($task->id); ?>">
                <input type="checkbox" name="task_ids[]" value="<?php echo e($task->id); ?>" class="bulk-checkbox-done" onchange="updateSelectedCount()" form="bulkForm" style="display:none;">
                <input type="checkbox" name="delete_ids[]" value="<?php echo e($task->id); ?>" class="bulk-checkbox-delete" onchange="updateSelectedDeleteCount()" form="bulkDeleteForm" style="display:none;">
                <span style="color: #9ca3af; text-decoration: line-through;">
                    <?php if($task->category): ?>
                        <span class="badge"><?php echo e($task->category); ?></span>
                    <?php endif; ?>
                    <?php echo e($task->task); ?>

                </span>
                <div class="task-actions">
                    <?php if($task->start_date || $task->deadline): ?>
                        <span class="deadline-badge <?php echo e($isOverdue ? 'overdue' : ''); ?>">
                            <?php if($task->start_date && $task->deadline): ?>
                                <?php echo e($isOverdue ? '⚠️ ' : '📅 '); ?><?php echo e(date('d M', strtotime($task->start_date))); ?> - <?php echo e(date('d M Y', strtotime($task->deadline))); ?>

                            <?php elseif($task->deadline): ?>
                                <?php echo e($isOverdue ? '⚠️ ' : '📅 '); ?><?php echo e(date('d M Y', strtotime($task->deadline))); ?>

                            <?php else: ?>
                                📆 <?php echo e(date('d M Y', strtotime($task->start_date))); ?>

                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                    <form method="POST" action="/tasks/<?php echo e($task->id); ?>/done" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="done-btn cancel">↩️ Batal</button>
                    </form>
                    <a href="/tasks/<?php echo e($task->id); ?>/edit" class="edit-btn">✏️</a>
                    <form method="POST" action="/tasks/<?php echo e($task->id); ?>?from=completed" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="delete-btn" onclick="return confirm('Yakin mau hapus? 🥺')">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($tasks->hasPages()): ?>
            <?php echo e($tasks->links('vendor.pagination.default')); ?>

        <?php endif; ?>
    <?php endif; ?>

    <script>
        let bulkMode = false;
        let bulkDeleteMode = false;

        function closeKebabMenu() {
            document.querySelectorAll('.kebab-menu.show').forEach(function(menu) {
                menu.classList.remove('show');
            });
        }

        function toggleBulkMode() {
            closeKebabMenu();
            cancelBulkDeleteMode();
            bulkMode = !bulkMode;
            const form = document.getElementById('bulkForm');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done');

            form.style.display = bulkMode ? 'flex' : 'none';
            checkboxes.forEach(cb => cb.style.display = bulkMode ? 'inline' : 'none');

            if (!bulkMode) {
                checkboxes.forEach(cb => cb.checked = false);
                document.getElementById('selectAll').checked = false;
                updateSelectedCount();
            }
        }

        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done');
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.bulk-checkbox-done:checked');
            document.getElementById('selectedCount').textContent = checkboxes.length + ' dipilih';
        }

        function cancelBulkMode() {
            if (bulkMode) toggleBulkMode();
        }

        function toggleBulkDeleteMode() {
            closeKebabMenu();
            cancelBulkMode();
            bulkDeleteMode = !bulkDeleteMode;
            const form = document.getElementById('bulkDeleteForm');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete');

            form.style.display = bulkDeleteMode ? 'flex' : 'none';
            checkboxes.forEach(cb => cb.style.display = bulkDeleteMode ? 'inline' : 'none');

            if (!bulkDeleteMode) {
                checkboxes.forEach(cb => cb.checked = false);
                document.getElementById('selectAllDelete').checked = false;
                updateSelectedDeleteCount();
            }
        }

        function toggleSelectAllDelete() {
            const selectAll = document.getElementById('selectAllDelete');
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete');
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateSelectedDeleteCount();
        }

        function updateSelectedDeleteCount() {
            const checkboxes = document.querySelectorAll('.bulk-checkbox-delete:checked');
            document.getElementById('selectedDeleteCount').textContent = checkboxes.length + ' dipilih';
        }

        function cancelBulkDeleteMode() {
            if (bulkDeleteMode) toggleBulkDeleteMode();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/completed.blade.php ENDPATH**/ ?>