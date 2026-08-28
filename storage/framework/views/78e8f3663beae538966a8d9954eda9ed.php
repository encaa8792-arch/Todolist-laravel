<?php $__env->startSection('title', 'Kategori'); ?>
<?php $__env->startSection('page-title', 'Kategori'); ?>

<?php $__env->startSection('styles'); ?>
    .add-category-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
    }
    .add-category-btn:hover {
        filter: brightness(0.9);
    }
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    .category-card {
        border-radius: 16px;
        padding: 20px;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .category-card:hover {
        transform: translateY(-3px);
    }
    .category-card .category-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }
    .category-card .category-name {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .category-card .category-count {
        font-size: 13px;
        color: #888;
        margin-bottom: 0;
    }
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #9ca3af;
    }
    .empty-state span {
        font-size: 50px;
        opacity: 0.5;
    }
    .empty-state p {
        margin: 15px 0 0;
        font-size: 14px;
    }
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 2000;
        justify-content: center;
        align-items: center;
    }
    .modal-overlay.show {
        display: flex;
    }
    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 30px;
        max-width: 400px;
        width: 90%;
        position: relative;
    }
    .modal-content h3 {
        text-align: center;
        color: var(--theme-primary);
        margin: 0 0 20px;
        font-size: 20px;
    }
    .modal-content input {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--theme-border);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        margin-bottom: 20px;
    }
    .modal-content input:focus {
        border-color: var(--theme-primary);
    }
    .modal-content .btn-group {
        display: flex;
        gap: 10px;
    }
    .modal-content .btn-submit {
        flex: 1;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
    }
    .modal-content .btn-submit:hover {
        filter: brightness(0.9);
    }
    .modal-content .btn-cancel {
        flex: 1;
        background: #f0f0f0;
        color: #666;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
    }
    .modal-content .btn-cancel:hover {
        background: #e0e0e0;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="glass-card" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(255, 255, 255, 0.5); box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <div style="display:flex;align-items:center;gap:12px;">
            <button class="add-category-btn" onclick="openAddModal()" style="margin-bottom:0;">
                ➕ Tambah Kategori
            </button>
        </div>

        <div class="category-grid">
            <?php
                $categories = [
                    ['name' => 'Kerja', 'icon' => '💼', 'count' => 0],
                    ['name' => 'Kuliah', 'icon' => '📚', 'count' => 0],
                    ['name' => 'Pribadi', 'icon' => '💖', 'count' => 0],
                    ['name' => 'Sekolah', 'icon' => '📓', 'count' => 0],
                ];
            ?>

            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="category-card">
                    <div class="category-icon"><?php echo e($cat['icon']); ?></div>
                    <div class="category-name"><?php echo e($cat['name']); ?></div>
                    <div class="category-count"><?php echo e($cat['count']); ?> tugas</div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span>📁</span>
                    <p>Belum ada kategori. Yuk, tambah kategori baru!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal-overlay" id="addCategoryModal">
        <div class="modal-content">
            <button onclick="closeAddModal()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3>➕ Tambah Kategori</h3>
            <form method="POST" action="/categories">
                <?php echo csrf_field(); ?>
                <input type="text" name="name" placeholder="Nama Kategori" required>
                <div class="btn-group">
                    <button type="submit" class="btn-submit">Simpan</button>
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addCategoryModal').classList.add('show');
        }
        function closeAddModal() {
            document.getElementById('addCategoryModal').classList.remove('show');
        }
        document.getElementById('addCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) closeAddModal();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/categories.blade.php ENDPATH**/ ?>