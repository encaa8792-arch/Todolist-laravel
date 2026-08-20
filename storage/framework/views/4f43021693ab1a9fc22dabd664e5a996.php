<?php $__env->startSection('title', 'Edit Tugas'); ?>

<?php $__env->startSection('box-class', 'edit-box'); ?>

<?php $__env->startSection('styles'); ?>
    .edit-form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 12px;
    }
    .edit-form-group label {
        font-size: 12px;
        font-weight: 500;
        color: #555;
    }
    .edit-form-group select,
    .edit-form-group input[type="text"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
    }
    .edit-form-group select:focus,
    .edit-form-group input[type="text"]:focus {
        border-color: #ff6b9d;
    }
    .date-row {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        flex-wrap: wrap;
    }
    .date-col {
        flex: 1;
        min-width: 140px;
    }
    .date-arrow {
        color: #999;
        font-size: 14px;
        margin-bottom: 12px;
    }
    .date-col label {
        font-size: 11px;
        font-weight: 500;
        display: block;
        margin-bottom: 4px;
    }
    .date-col label.start { color: #27ae60; }
    .date-col label.end { color: #e74c3c; }
    .date-col input {
        width: 100%;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.3s;
    }
    .date-col input:focus {
        border-color: #ff6b9d;
    }
    .btn-update {
        width: 100%;
        padding: 14px;
        background: #ff6b9d;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 15px;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s, transform 0.2s;
    }
    .btn-update:hover {
        background: #e05585;
        transform: translateY(-2px);
    }
    .btn-back {
        display: block;
        text-align: center;
        margin-top: 12px;
        color: #ff6b9d;
        text-decoration: none;
        font-weight: 500;
        font-size: 13px;
        transition: color 0.2s;
    }
    .btn-back:hover {
        color: #e05585;
        text-decoration: underline;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h2>✏️ Edit Tugas</h2>
    <form action="<?php echo e(route('tasks.update', $task->id)); ?>" method="POST" id="editForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="edit-form-group">
            <label for="category">Kategori</label>
            <select name="category" id="category" required>
                <option value="">Pilih Kategori</option>
                <option value="Kerja" <?php echo e($task->category == 'Kerja' ? 'selected' : ''); ?>>💼 Kerja</option>
                <option value="Kuliah" <?php echo e($task->category == 'Kuliah' ? 'selected' : ''); ?>>📚 Kuliah</option>
                <option value="Pribadi" <?php echo e($task->category == 'Pribadi' ? 'selected' : ''); ?>>💖 Pribadi</option>
                <option value="Sekolah" <?php echo e($task->category == 'Sekolah' || $task->category == 'sekolah' ? 'selected' : ''); ?>>📓 Sekolah</option>
            </select>
        </div>

        <div class="edit-form-group">
            <label for="task">Nama Tugas</label>
            <input type="text" name="task" id="task" value="<?php echo e($task->task); ?>" placeholder="Nama tugas" required>
        </div>

        <div class="date-row">
            <div class="date-col">
                <label class="start" for="start_date">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="<?php echo e($task->start_date); ?>">
            </div>
            <span class="date-arrow">→</span>
            <div class="date-col">
                <label class="end" for="deadline">Tanggal Selesai</label>
                <input type="date" name="deadline" id="deadline" value="<?php echo e($task->deadline); ?>">
            </div>
        </div>

        <button type="submit" class="btn-update">Update</button>
    </form>
    <a href="/tasks" class="btn-back">← Batal / Kembali</a>

    <script>
        document.getElementById('deadline').addEventListener('change', function() {
            const startDate = document.getElementById('start_date');
            if (startDate.value && this.value) {
                if (new Date(startDate.value) > new Date(this.value)) {
                    startDate.value = this.value;
                }
                startDate.max = this.value;
            } else {
                startDate.max = this.value || '';
            }
        });

        document.getElementById('start_date').addEventListener('change', function() {
            const deadline = document.getElementById('deadline');
            if (this.value && deadline.value) {
                if (new Date(this.value) > new Date(deadline.value)) {
                    deadline.value = this.value;
                }
            }
            if (deadline.value) {
                deadline.min = this.value;
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/edit.blade.php ENDPATH**/ ?>