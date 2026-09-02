<?php if($paginator->hasPages()): ?>
    <nav class="pagination-wrapper" role="navigation">
        <ul class="pagination">
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled">
                    <span class="page-link">&lsaquo;</span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link" rel="prev">&lsaquo;</a>
                </li>
            <?php endif; ?>

            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_string($element)): ?>
                    <li class="disabled">
                        <span class="page-link"><?php echo e($element); ?></span>
                    </li>
                <?php endif; ?>

                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="active">
                                <span class="page-link"><?php echo e($page); ?></span>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>" class="page-link"><?php echo e($page); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="page-link" rel="next">&rsaquo;</a>
                </li>
            <?php else: ?>
                <li class="disabled">
                    <span class="page-link">&rsaquo;</span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <style>
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination li {
            display: inline-block;
        }
        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 10px;
            background: #fff0f5;
            color: #ff6b9d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .pagination li a:hover {
            background: #ff6b9d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 157, 0.3);
        }
        .pagination li.active span {
            background: #ff6b9d;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 107, 157, 0.3);
        }
        .pagination li.disabled span {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f0f0f0;
            color: #999;
        }
    </style>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Todolist\resources\views/vendor/pagination/default.blade.php ENDPATH**/ ?>