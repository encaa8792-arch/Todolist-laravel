<?php $__env->startSection('title', 'Kategori'); ?>
<?php $__env->startSection('page-title', 'Kategori'); ?>

<?php $__env->startSection('styles'); ?>
    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .search-box {
        flex: 1;
        min-width: 200px;
        max-width: 400px;
        position: relative;
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
    }
    .search-box input {
        width: 100%;
        padding: 12px 14px 12px 40px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: all 0.2s;
        background: white;
    }
    .search-box input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), 0 4px 12px rgba(99, 102, 241, 0.1);
        background: white;
    }
    .search-box:focus-within i {
        color: #6366f1;
    }
    .search-box input::placeholder {
        color: #94a3b8;
    }
    .btn-add-category {
        background: #6366f1;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }
    .btn-add-category:hover {
        background: #4f46e5;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }
    .category-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .category-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
    }
    .category-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    .category-item.new-item {
        animation: slideIn 0.3s ease;
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .category-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .category-icon-box {
        width: 48px;
        height: 48px;
        background: #f1f5f9;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .category-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .category-name {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
    }
    .category-count {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        background: #f1f5f9;
        padding: 3px 10px;
        border-radius: 20px;
        display: inline-block;
    }
    .category-actions {
        display: flex;
        gap: 8px;
    }
    .category-actions button {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        position: relative;
    }
    .category-actions button::after {
        content: attr(data-tooltip);
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background: #1e293b;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        z-index: 100;
    }
    .category-actions button:hover::after {
        opacity: 1;
    }
    .category-actions .btn-delete {
        background: #f1f5f9;
        color: #64748b;
    }
    .category-actions .btn-delete:hover {
        background: #fee2e2;
        color: #ef4444;
    }
    .category-actions .btn-delete:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .category-actions .btn-default-delete {
        background: transparent;
        color: #94a3b8;
        cursor: not-allowed;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }
    .empty-state span {
        font-size: 60px;
        display: block;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    .empty-state p {
        font-size: 15px;
        margin: 0;
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
        color: #6366f1;
        margin: 0 0 20px;
        font-size: 20px;
    }
    .modal-content input {
        width: 100%;
        padding: 14px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        margin-bottom: 20px;
        transition: border-color 0.2s;
    }
    .modal-content input:focus {
        border-color: #6366f1;
    }
    .modal-content input.error {
        border-color: #ef4444;
    }
    .error-message {
        color: #ef4444;
        font-size: 12px;
        margin-top: -15px;
        margin-bottom: 15px;
        display: none;
    }
    .modal-content .btn-group {
        display: flex;
        gap: 12px;
    }
    .modal-content .btn-submit {
        flex: 1;
        background: #6366f1;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
    }
    .modal-content .btn-submit:hover:not(:disabled) {
        background: #4f46e5;
    }
    .modal-content .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    .modal-content .btn-cancel {
        flex: 1;
        background: #f1f5f9;
        color: #64748b;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
    }
    .modal-content .btn-cancel:hover {
        background: #e2e8f0;
    }
    .btn-edit {
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        font-size: 16px;
        opacity: 0.6;
        transition: all 0.2s;
        border-radius: 8px;
    }
    .btn-edit:hover {
        opacity: 1;
        background: #f1f5f9;
    }
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 3000;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .toast {
        padding: 16px 24px;
        border-radius: 12px;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: toastIn 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .toast.success {
        background: #10b981;
    }
    .toast.error {
        background: #ef4444;
    }
    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    @media (max-width: 640px) {
        .category-header {
            flex-direction: column;
            align-items: stretch;
        }
        .search-box {
            max-width: 100%;
        }
        .category-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .category-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="toast-container" id="toastContainer"></div>

    <div class="category-header">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchCategory" placeholder="Cari kategori..." onkeyup="filterCategories()">
        </div>
        <button class="btn-add-category" onclick="openAddModal()">
            <span>+</span> Tambah Kategori
        </button>
    </div>

    <div class="category-list" id="categoryList">
        <?php $__empty_1 = true; $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="category-item" data-name="<?php echo e(strtolower($cat['name'])); ?>" data-id="<?php echo e($cat['id'] ?? ''); ?>" data-default="<?php echo e($cat['is_default'] ?? false); ?>">
                <div class="category-left">
                    <div class="category-icon-box"><?php echo e($cat['icon']); ?></div>
                    <div class="category-info">
                        <div class="category-name"><?php echo e($cat['name']); ?></div>
                        <div class="category-count"><?php echo e($cat['count']); ?> Tugas Aktif</div>
                    </div>
                </div>
                <div class="category-actions">
                    <button class="btn-edit" data-tooltip="Edit" onclick="openEditModal('<?php echo e($cat['id'] ?? ''); ?>', '<?php echo e($cat['name'] ?? ''); ?>', '<?php echo e($cat['icon'] ?? '📁'); ?>')">✏️</button>
                    <button class="btn-delete" data-tooltip="Hapus" onclick="deleteCategory('<?php echo e($cat['id'] ?? ''); ?>', this)">🗑️</button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <span>📁</span>
                <p>Belum ada kategori. Yuk, tambah kategori baru!</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal-overlay" id="addCategoryModal">
        <div class="modal-content">
            <button onclick="closeAddModal()" style="position:absolute; top:15px; right:15px; background:#f1f5f9; border:none; color:#64748b; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3>+ Tambah Kategori</h3>
            <form id="addCategoryForm">
                <?php echo csrf_field(); ?>
                <input type="text" id="categoryName" name="name" placeholder="Nama Kategori" required>
                <p class="error-message" id="nameError"></p>
                <input type="text" id="categoryIcon" name="icon" placeholder="Icon (opsional, contoh: 📁)" maxlength="10">
                <div class="btn-group">
                    <button type="submit" class="btn-submit" id="submitBtn">Simpan</button>
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="editCategoryModal">
        <div class="modal-content">
            <button onclick="closeEditModal()" style="position:absolute; top:15px; right:15px; background:#f1f5f9; border:none; color:#64748b; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3>✏️ Edit Kategori</h3>
            <form id="editCategoryForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" id="editCategoryId">
                <input type="text" id="editCategoryName" name="name" placeholder="Nama Kategori" required>
                <p class="error-message" id="editNameError"></p>
                <input type="text" id="editCategoryIcon" name="icon" placeholder="Icon (opsional, contoh: 📁)" maxlength="10">
                <div class="btn-group">
                    <button type="submit" class="btn-submit" id="editSubmitBtn">Simpan</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${type === 'success' ? '✓' : '✕'}</span> ${message}`;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'toastIn 0.3s ease reverse';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function openAddModal() {
            document.getElementById('addCategoryModal').classList.add('show');
            document.getElementById('categoryName').focus();
        }

        function closeAddModal() {
            document.getElementById('addCategoryModal').classList.remove('show');
            document.getElementById('addCategoryForm').reset();
            document.getElementById('nameError').style.display = 'none';
            document.getElementById('categoryName').classList.remove('error');
        }

        let editingCategoryId = null;

        function openEditModal(id, name, icon) {
            editingCategoryId = id;
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editCategoryIcon').value = icon || '📁';
            document.getElementById('editNameError').style.display = 'none';
            document.getElementById('editCategoryName').classList.remove('error');
            document.getElementById('editCategoryModal').classList.add('show');
            document.getElementById('editCategoryName').focus();
        }

        function closeEditModal() {
            document.getElementById('editCategoryModal').classList.remove('show');
            document.getElementById('editCategoryForm').reset();
            document.getElementById('editNameError').style.display = 'none';
            document.getElementById('editCategoryName').classList.remove('error');
            editingCategoryId = null;
        }

        document.getElementById('editCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        document.getElementById('addCategoryModal').addEventListener('click', function(e) {
            if (e.target === this) closeAddModal();
        });

        function filterCategories() {
            const search = document.getElementById('searchCategory').value.toLowerCase();
            const items = document.querySelectorAll('.category-item');
            items.forEach(item => {
                const name = item.dataset.name;
                item.style.display = name.includes(search) ? '' : 'none';
            });
        }

        document.getElementById('addCategoryForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const nameInput = document.getElementById('categoryName');
            const iconInput = document.getElementById('categoryIcon');
            const nameError = document.getElementById('nameError');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
            nameError.style.display = 'none';
            nameInput.classList.remove('error');

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('name', nameInput.value.trim());
            if (iconInput.value.trim()) {
                formData.append('icon', iconInput.value.trim());
            }

            try {
                const response = await fetch('/categories', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422 && data.errors && data.errors.name) {
                        nameInput.classList.add('error');
                        nameError.textContent = data.errors.name[0];
                        nameError.style.display = 'block';
                    } else {
                        showToast(data.message || 'Terjadi kesalahan', 'error');
                    }
                    return;
                }

                showToast(data.message, 'success');
                closeAddModal();
                localStorage.setItem('categoriesUpdated', Date.now());

                const categoryList = document.getElementById('categoryList');
                const emptyState = categoryList.querySelector('.empty-state');
                if (emptyState) emptyState.remove();

                const isDefault = data.category && data.category.is_default;
                const newItem = document.createElement('div');
                newItem.className = 'category-item new-item';
                newItem.dataset.name = data.category.name.toLowerCase();
                newItem.dataset.id = data.category.id;
                newItem.dataset.default = isDefault ? 'true' : 'false';

                newItem.innerHTML = `
                    <div class="category-left">
                        <div class="category-icon-box">${data.category.icon}</div>
                        <div class="category-info">
                            <div class="category-name">${data.category.name}</div>
                            <div class="category-count">0 Tugas Aktif</div>
                        </div>
                    </div>
                    <div class="category-actions">
                        ${!isDefault
                            ? `<button class="btn-delete" data-tooltip="Hapus" onclick="deleteCategory('${data.category.id}', this)">🗑️</button>`
                            : `<button class="btn-default-delete" data-tooltip="Kategori default">🔒</button>`
                        }
                    </div>
                `;

                categoryList.appendChild(newItem);

            } catch (error) {
                console.error('Error:', error);
                showToast('Terjadi kesalahan koneksi', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Simpan';
            }
        });

        document.getElementById('editCategoryForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('editCategoryId').value;
            const nameInput = document.getElementById('editCategoryName');
            const iconInput = document.getElementById('editCategoryIcon');
            const nameError = document.getElementById('editNameError');
            const submitBtn = document.getElementById('editSubmitBtn');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
            nameError.style.display = 'none';
            nameInput.classList.remove('error');

            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('_method', 'PUT');
            formData.append('name', nameInput.value.trim());
            if (iconInput.value.trim()) {
                formData.append('icon', iconInput.value.trim());
            }

            try {
                const response = await fetch(`/categories/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422 && data.errors && data.errors.name) {
                        nameInput.classList.add('error');
                        nameError.textContent = data.errors.name[0];
                        nameError.style.display = 'block';
                    } else {
                        showToast(data.message || 'Terjadi kesalahan', 'error');
                    }
                    return;
                }

                showToast(data.message || 'Kategori berhasil diperbarui!', 'success');
                closeEditModal();
                localStorage.setItem('categoriesUpdated', Date.now());

                const item = document.querySelector(`.category-item[data-id="${id}"]`);
                if (item) {
                    item.dataset.name = data.category.name.toLowerCase();
                    item.querySelector('.category-name').textContent = data.category.name;
                    item.querySelector('.category-icon-box').textContent = data.category.icon;
                }

            } catch (error) {
                console.error('Error:', error);
                showToast('Terjadi kesalahan koneksi', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Simpan';
            }
        });

        async function deleteCategory(id, button) {
            if (!id || !confirm('Yakin ingin menghapus kategori ini?')) return;

            button.disabled = true;
            button.textContent = '⏳';

            try {
                const response = await fetch(`/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    showToast(data.message || 'Gagal menghapus kategori', 'error');
                    button.disabled = false;
                    button.textContent = '🗑️';
                    return;
                }

                showToast(data.message, 'success');
                const item = button.closest('.category-item');
                item.style.animation = 'toastIn 0.3s ease reverse';
                setTimeout(() => item.remove(), 300);

                localStorage.setItem('categoriesUpdated', Date.now());

            } catch (error) {
                console.error('Error:', error);
                showToast('Terjadi kesalahan koneksi', 'error');
                button.disabled = false;
                button.textContent = '🗑️';
            }
        }

        function notifyCategoriesUpdate() {
            localStorage.setItem('categoriesUpdated', Date.now());
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/categories.blade.php ENDPATH**/ ?>