<?php $__env->startSection('title', 'Tugas Selesai'); ?>

<?php $__env->startSection('styles'); ?>
    .completed-container {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }
    .completed-header {
        text-align: center;
        margin-bottom: 24px;
    }
    .completed-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #2ecc71;
        margin: 0;
    }
    .completed-header h1 span {
        color: #27ae60;
    }
    .completed-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .completed-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 18px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e8e8e8;
        transition: all 0.2s;
    }
    .completed-item:hover {
        border-color: #c8e6c9;
        box-shadow: 0 4px 16px rgba(46,204,113,0.1);
    }
    .completed-info {
        flex: 1;
        min-width: 0;
    }
    .completed-top {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .completed-category {
        background: linear-gradient(135deg, #a0c4ff, #c8d8ff);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .completed-name {
        font-size: 14px;
        font-weight: 500;
        color: #888;
        text-decoration: line-through;
    }
    .completed-dates {
        display: flex;
        gap: 12px;
        margin-top: 6px;
        font-size: 11px;
        color: #888;
    }
    .completed-date {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .completed-date.selesai {
        color: #2ecc71;
    }
    .completed-date.waktu {
        color: #888;
    }
    .completed-btns {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }
    .btn-icon {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        position: relative;
    }
    .btn-icon:hover {
        transform: scale(1.1);
    }
    .btn-icon.batal {
        background: #fff3e0;
        color: #ff9800;
    }
    .btn-icon.batal:hover {
        background: #ff9800;
        color: white;
    }
    .btn-icon.edit {
        background: #e3f2fd;
        color: #2196f3;
    }
    .btn-icon.edit:hover {
        background: #2196f3;
        color: white;
    }
    .btn-icon.hapus {
        background: #fce4ec;
        color: #e91e63;
    }
    .btn-icon.hapus:hover {
        background: #e91e63;
        color: white;
    }
    .btn-icon::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
    }
    .btn-icon:hover::after {
        opacity: 1;
    }
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #bbb;
    }
    .empty-state span {
        font-size: 50px;
        display: block;
        margin-bottom: 10px;
    }
    .empty-state p {
        font-size: 14px;
        margin: 0;
    }
    .bulk-actions {
        background: #fff0f5;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .bulk-actions label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        cursor: pointer;
    }
    .bulk-actions input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }
    .bulk-count {
        font-size: 12px;
        color: #888;
        font-weight: 500;
    }
    .btn-bulk {
        padding: 8px 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        transition: all 0.2s;
    }
    .btn-bulk.batal-selesai {
        background: #ff9800;
        color: white;
    }
    .btn-bulk.batal-selesai:hover {
        background: #f57c00;
    }
    .btn-bulk.hapus {
        background: #e91e63;
        color: white;
    }
    .btn-bulk.hapus:hover {
        background: #c2185b;
    }
    .btn-bulk.batal {
        background: #9e9e9e;
        color: white;
        padding: 8px 12px;
    }
    .btn-bulk.batal:hover {
        background: #757575;
    }
    .kebab-wrapper {
        position: relative;
    }
    .kebab-btn {
        background: #fff;
        border: 1px solid #e0e0e0;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        transition: all 0.2s;
    }
    .kebab-btn:hover {
        background: #fff0f5;
        border-color: #ff6b9d;
    }
    .kebab-btn span {
        display: block;
        width: 4px;
        height: 4px;
        background: #999;
        border-radius: 50%;
    }
    .kebab-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        min-width: 180px;
        z-index: 100;
        overflow: hidden;
        border: 1px solid #f0f0f0;
    }
    .kebab-menu.show {
        display: block;
    }
    .kebab-menu button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
    }
    .kebab-menu button:hover {
        background: #fff0f5;
        color: #ff6b9d;
    }
    .kebab-menu .menu-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 0;
    }
    @media (max-width: 768px) {
        .completed-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .completed-info {
            width: 100%;
        }
        .completed-btns {
            width: 100%;
            justify-content: flex-end;
        }
        .completed-dates {
            flex-wrap: wrap;
        }
        .bulk-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        .bulk-actions button {
            width: 100%;
        }
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="completed-container">
        <div class="completed-header">
            <h1>Tugas <span>Selesai</span></h1>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
            <div class="kebab-wrapper">
                <button class="kebab-btn" type="button" onclick="toggleKebabMenu(this)">
                    <span></span><span></span><span></span>
                </button>
                <div class="kebab-menu">
                    <button type="button" onclick="toggleBulkMode()">Bulk Action</button>
                    <div class="menu-divider"></div>
                    <button type="button" onclick="toggleBulkDeleteMode()">Hapus Massal</button>
                </div>
            </div>
        </div>

        <form method="POST" action="/tasks/bulk-done" id="bulkForm" class="bulk-actions" style="display:none;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" value="undo">
            <label>
                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Pilih Semua
            </label>
            <span id="selectedCount" class="bulk-count">0 dipilih</span>
            <button type="submit" class="btn-bulk batal-selesai" onclick="return confirm('Batalkan selesai tugas terpilih?')">↩️ Batal Selesai</button>
            <button type="button" onclick="cancelBulkMode()" class="btn-bulk batal">✕ Batal</button>
        </form>

        <form method="POST" action="/tasks/bulk-delete" id="bulkDeleteForm" class="bulk-actions" style="display:none;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <label>
                <input type="checkbox" id="selectAllDelete" onchange="toggleSelectAllDelete()"> Pilih Semua
            </label>
            <span id="selectedDeleteCount" class="bulk-count">0 dipilih</span>
            <button type="submit" class="btn-bulk hapus" onclick="return confirm('Yakin mau hapus tugas terpilih?')">🗑️ Hapus Terpilih</button>
            <button type="button" onclick="cancelBulkDeleteMode()" class="btn-bulk batal">✕ Batal</button>
        </form>

        <?php if(session('success')): ?>
            <div class="success" style="background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 12px 18px; border-radius: 10px; margin-bottom: 16px; text-align: center; font-size: 13px; font-weight: 500;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="completed-list">
            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="completed-item" data-task-id="<?php echo e($task->id); ?>">
                    <input type="checkbox" name="task_ids[]" value="<?php echo e($task->id); ?>" class="bulk-checkbox-done" onchange="updateSelectedCount()" form="bulkForm" style="display:none;">
                    <input type="checkbox" name="delete_ids[]" value="<?php echo e($task->id); ?>" class="bulk-checkbox-delete" onchange="updateSelectedDeleteCount()" form="bulkDeleteForm" style="display:none;">
                    <div class="completed-info">
                        <div class="completed-top">
                            <?php if($task->category): ?>
                                <span class="completed-category"><?php echo e($task->category); ?></span>
                            <?php endif; ?>
                            <span class="completed-name"><?php echo e($task->task); ?></span>
                        </div>
                        <div class="completed-dates">
                            <?php if($task->deadline): ?>
                                <span class="completed-date selesai">
                                    ✓ Selesai: <?php echo e(date('d M Y', strtotime($task->deadline))); ?>

                                </span>
                            <?php endif; ?>
                            <?php if($task->updated_at): ?>
                                <span class="completed-date waktu">
                                    🕐 <?php echo e(date('H:i', strtotime($task->updated_at))); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="completed-btns">
                        <form method="POST" action="/tasks/<?php echo e($task->id); ?>/done" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-icon batal" data-tooltip="Batalkan">↩️</button>
                        </form>
                        <a href="/tasks/<?php echo e($task->id); ?>/edit" class="btn-icon edit" data-tooltip="Edit">✏️</a>
                        <form method="POST" action="/tasks/<?php echo e($task->id); ?>?from=completed" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-icon hapus" data-tooltip="Hapus" onclick="return confirm('Yakin mau hapus?')">🗑️</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">
                    <span>✨</span>
                    <p>Belum ada tugas yang selesai</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if($tasks->hasPages()): ?>
            <div style="margin-top: 20px;">
                <?php echo e($tasks->links('vendor.pagination.default')); ?>

            </div>
        <?php endif; ?>
    </div>

    <script>
        let bulkMode = false;
        let bulkDeleteMode = false;

        function toggleKebabMenu(btn) {
            const menu = btn.nextElementSibling;
            document.querySelectorAll('.kebab-menu.show').forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });
            menu.classList.toggle('show');
        }

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

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.kebab-wrapper')) {
                closeKebabMenu();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/completed.blade.php ENDPATH**/ ?>