<?php $__env->startSection('title', 'Laporan'); ?>
<?php $__env->startSection('page-title', 'Laporan'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    .flatpickr-input {
        background: white !important;
    }

    .export-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--theme-primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: filter 0.2s;
    }
    .export-btn:hover {
        filter: brightness(0.9);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }
    .stat-card {
        padding: 20px;
        border-radius: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
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
    .stat-card.pending::before { background: linear-gradient(90deg, #f39c12, #f5b041); }
    .stat-card.pending .number { color: #f39c12; }
    .stat-card.overdue::before { background: linear-gradient(90deg, #ff6b6b, #ff8a8a); }
    .stat-card.overdue .number { color: #ff6b6b; }

        .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }
    .chart-card {
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border-radius: 16px;
        padding: 20px;
    }
    .chart-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    .chart-card-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    .chart-card-title-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chart-filter-dropdown {
        padding: 6px 28px 6px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 12px;
        font-family: 'Poppins', sans-serif;
        background: white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M2 4l4 4 4-4'/%3E%3C/svg%3E") no-repeat right 8px center;
        appearance: none;
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s;
    }
    .chart-filter-dropdown:hover {
        border-color: var(--theme-primary);
    }
    .chart-filter-dropdown:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 2px rgba(255, 107, 157, 0.15);
    }
    .chart-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .chart-card-icon.purple { background: rgba(99, 102, 241, 0.15); }
    .chart-card-icon.blue { background: rgba(59, 130, 246, 0.15); }
    .chart-card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }
    .chart-container {
        position: relative;
        width: 100%;
        min-height: 300px;
        height: 300px;
    }
    .chart-container canvas {
        display: block;
        width: 100% !important;
        height: 100% !important;
    }
    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 16px;
        justify-content: center;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #64748b;
    }
    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .report-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .report-card {
        padding: 20px;
        border-radius: 16px;
        transition: transform 0.2s;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .report-card:hover {
        transform: translateY(-3px);
    }
    .report-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    .report-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .report-card-icon.pink { background: rgba(255,107,157,0.15); }
    .report-card-icon.green { background: rgba(46,204,113,0.15); }
    .report-card-icon.orange { background: rgba(243,156,18,0.15); }
    .report-card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }
    .report-card-stat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }
    .report-card-stat:not(:last-child) {
        border-bottom: 1px dashed #e2e8f0;
    }
    .report-card-stat-label {
        font-size: 13px;
        color: #64748b;
    }
    .mini-stat {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }
    .mini-stat-label {
        font-size: 12px;
        color: #64748b;
        width: 80px;
        flex-shrink: 0;
    }
    .mini-stat-bar {
        height: 8px;
        background: linear-gradient(90deg, var(--theme-primary), var(--theme-secondary));
        border-radius: 4px;
        flex: 1;
    }
    .mini-stat-count {
        font-size: 12px;
        font-weight: 600;
        color: #1e293b;
        width: 30px;
        text-align: right;
    }
    .overdue-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .overdue-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 12px;
        background: #fef2f2;
        border-radius: 10px;
        border-left: 3px solid #ef4444;
    }
    .overdue-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .overdue-name {
        font-size: 13px;
        font-weight: 500;
        color: #1e293b;
    }
    .overdue-category {
        font-size: 11px;
        background: rgba(0,0,0,0.05);
        padding: 2px 8px;
        border-radius: 10px;
        color: #64748b;
    }
    .overdue-date {
        font-size: 12px;
        font-weight: 600;
        color: #ef4444;
    }
    .report-card-stat-value {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }
    .report-card-stat-value.pink { color: var(--theme-primary); }
    .report-card-stat-value.green { color: #16a34a; }
    .report-card-stat-value.orange { color: #ea580c; }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .report-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .charts-grid {
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
        .filter-row {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-group select,
        .filter-group input[type="date"] {
            width: 100%;
            min-width: unset;
        }
        .btn-apply, .btn-reset {
            width: 100%;
        }
        .report-grid {
            grid-template-columns: 1fr;
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

<?php $__env->startSection('header-actions'); ?>
    <button class="topbar-btn" onclick="exportReport()" data-tooltip="Export Laporan">
        📥
    </button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="stats-grid">
        <div class="stat-card total">
            <span class="icon-bg">📋</span>
            <div class="number"><?php echo e($totalTasks); ?></div>
            <div class="label">Total Tugas</div>
            <div class="sublabel">Semua tugas dibuat</div>
        </div>
        <div class="stat-card completed">
            <span class="icon-bg">✓</span>
            <div class="number"><?php echo e($completedTasks); ?></div>
            <div class="label">Selesai</div>
            <div class="sublabel">Tugas selesai</div>
        </div>
        <div class="stat-card pending">
            <span class="icon-bg">⏳</span>
            <div class="number"><?php echo e($pendingTasks); ?></div>
            <div class="label">Belum Selesai</div>
            <div class="sublabel">Sedang berjalan</div>
        </div>
        <div class="stat-card overdue">
            <span class="icon-bg">⚠️</span>
            <div class="number"><?php echo e($overdueTasks); ?></div>
            <div class="label">Terlambat</div>
            <div class="sublabel">Melewati deadline</div>
        </div>
    </div>

        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-card-header-row">
                    <div class="chart-card-title-group">
                        <div class="chart-card-icon purple">📊</div>
                        <div class="chart-card-title">Proporsi Kategori</div>
                    </div>
                    <select class="chart-filter-dropdown" id="piePeriodFilter">
                        <option value="all">Semua</option>
                        <option value="week">7 Hari</option>
                        <option value="month">30 Hari</option>
                        <option value="3months">3 Bulan</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="categoryPieChart"></canvas>
                </div>
                <div class="chart-legend" id="categoryLegend"></div>
            </div>
            <div class="chart-card">
                <div class="chart-card-header-row">
                    <div class="chart-card-title-group">
                        <div class="chart-card-icon blue">📈</div>
                        <div class="chart-card-title">Tren Mingguan</div>
                    </div>
                    <select class="chart-filter-dropdown" id="barPeriodFilter">
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="3months">3 Bulan</option>
                    </select>
                </div>
                <div class="chart-container" style="min-height: 300px;">
                    <canvas id="weeklyBarChart"></canvas>
                </div>
            </div>
        </div>

        <div class="report-grid">
            <div class="report-card">
                <div class="report-card-header">
                    <div class="report-card-icon pink">⭐</div>
                    <div class="report-card-title">Kategori Terpopuler</div>
                </div>
                <?php if($topCategory): ?>
                    <div class="report-card-stat">
                        <span class="report-card-stat-label"><?php echo e($topCategory); ?></span>
                        <span class="report-card-stat-value pink"><?php echo e($categoryStats[$topCategory]); ?> tugas</span>
                    </div>
                <?php endif; ?>
                <div style="margin-top: 12px;">
                    <?php $__currentLoopData = $categoryStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mini-stat">
                            <span class="mini-stat-label"><?php echo e($cat); ?></span>
                            <span class="mini-stat-bar" style="width: <?php echo e(max(($count / max($categoryStats)) * 100, 10)); ?>%"></span>
                            <span class="mini-stat-count"><?php echo e($count); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="report-card" style="grid-column: span 2;">
                <div class="report-card-header">
                    <div class="report-card-icon orange">⚠️</div>
                    <div class="report-card-title">Tugas Terlambat</div>
                </div>
                <?php if($overdueTaskList->count() > 0): ?>
                    <div class="overdue-list">
                        <?php $__currentLoopData = $overdueTaskList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="overdue-item">
                                <div class="overdue-info">
                                    <span class="overdue-name"><?php echo e($task->task); ?></span>
                                    <?php if($task->category): ?>
                                        <span class="overdue-category"><?php echo e($task->category); ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="overdue-date"><?php echo e(\Carbon\Carbon::parse($task->deadline)->format('d M')); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 30px; color: #94a3b8;">
                        <span style="font-size: 40px;">✨</span>
                        <p style="margin: 10px 0 0; font-size: 13px;">Tidak ada tugas terlambat</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const categoryData = <?php echo json_encode($categoryStats, 15, 512) ?>;
        const weeklyData = <?php echo json_encode($weeklyStats, 15, 512) ?>;

        const categoryColors = ['#ff6b9d', '#667eea', '#16a34a', '#f59e0b', '#8b5cf6', '#06b6d4'];
        const categoryLabels = Object.keys(categoryData);
        const categoryCounts = Object.values(categoryData);

        const totalCount = categoryCounts.reduce((a, b) => a + b, 0);

        if (categoryLabels.length === 0) {
            document.getElementById('categoryLegend').innerHTML = '<span style="color: #94a3b8; font-size: 13px;">Belum ada data kategori</span>';
        }

        const pieCtx = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: categoryLabels.length ? categoryLabels : ['Tidak Ada Data'],
                datasets: [{
                    data: categoryCounts.length ? categoryCounts : [1],
                    backgroundColor: categoryLabels.length ? categoryColors.slice(0, categoryLabels.length) : ['#e2e8f0'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 800 },
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const percentage = totalCount > 0 ? Math.round((value / totalCount) * 100) : 0;
                                return ` ${value} tugas (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        const legendContainer = document.getElementById('categoryLegend');
        categoryLabels.forEach((label, i) => {
            const item = document.createElement('div');
            item.className = 'legend-item';
            item.innerHTML = `<span class="legend-dot" style="background: ${categoryColors[i]}"></span> ${label} (${categoryCounts[i]})`;
            legendContainer.appendChild(item);
        });

        const barCtx = document.getElementById('weeklyBarChart').getContext('2d');

        const barMaxValue = weeklyData.reduce((max, d) => Math.max(max, d.created, d.completed), 0);
        const barMax = Math.max(barMaxValue, 1);

        let pieChart, barChart;

        barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: weeklyData.map(d => d.day),
                datasets: [
                    {
                        label: 'Dibuat',
                        data: weeklyData.map(d => d.created),
                        backgroundColor: '#667eea',
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    },
                    {
                        label: 'Diselesaikan',
                        data: weeklyData.map(d => d.completed),
                        backgroundColor: '#16a34a',
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 1000 },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.ceil(barMax * 1.2) || 5,
                        ticks: {
                            stepSize: 1,
                            font: { size: 11 }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 } }
                    }
                }
            }
        });

        document.getElementById('piePeriodFilter').addEventListener('change', function() {
            const period = this.value;
            let labels = [], counts = [];

            <?php if(isset($categoryStatsByPeriod) && $categoryStatsByPeriod): ?>
                const allPeriodData = <?php echo json_encode($categoryStatsByPeriod, 15, 512) ?>;
                if (period === 'all') {
                    labels = Object.keys(allPeriodData.all || {});
                    counts = Object.values(allPeriodData.all || {});
                } else if (period === 'week') {
                    labels = Object.keys(allPeriodData.week || {});
                    counts = Object.values(allPeriodData.week || {});
                } else if (period === 'month') {
                    labels = Object.keys(allPeriodData.month || {});
                    counts = Object.values(allPeriodData.month || {});
                } else if (period === '3months') {
                    labels = Object.keys(allPeriodData['3months'] || {});
                    counts = Object.values(allPeriodData['3months'] || {});
                }
            <?php else: ?>
                labels = categoryLabels;
                counts = categoryCounts;
            <?php endif; ?>

            const newTotal = counts.reduce((a, b) => a + b, 0);
            pieChart.data.labels = labels.length ? labels : ['Tidak Ada Data'];
            pieChart.data.datasets[0].data = counts.length ? counts : [1];
            pieChart.data.datasets[0].backgroundColor = labels.length ? categoryColors.slice(0, labels.length) : ['#e2e8f0'];
            pieChart.options.plugins.tooltip.callbacks.label = function(context) {
                const value = context.raw;
                const percentage = newTotal > 0 ? Math.round((value / newTotal) * 100) : 0;
                return ` ${value} tugas (${percentage}%)`;
            };
            pieChart.update();
        });

        document.getElementById('barPeriodFilter').addEventListener('change', function() {
            const period = this.value;
            let weekData = weeklyData;

            <?php if(isset($weeklyStatsByPeriod) && $weeklyStatsByPeriod): ?>
                const allWeeklyData = <?php echo json_encode($weeklyStatsByPeriod, 15, 512) ?>;
                if (period === 'week') {
                    weekData = allWeeklyData.week || weeklyData;
                } else if (period === 'month') {
                    weekData = allWeeklyData.month || weeklyData;
                } else if (period === '3months') {
                    weekData = allWeeklyData['3months'] || weeklyData;
                }
            <?php endif; ?>

            const maxVal = weekData.reduce((max, d) => Math.max(max, d.created, d.completed), 0);
            barChart.data.labels = weekData.map(d => d.day);
            barChart.data.datasets[0].data = weekData.map(d => d.created);
            barChart.data.datasets[1].data = weekData.map(d => d.completed);
            barChart.options.scales.y.max = Math.ceil(maxVal * 1.2) || 5;
            barChart.update();
        });

        function exportReport() {
            alert('Fitur Export Laporan akan segera hadir!');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Todolist\resources\views/reports.blade.php ENDPATH**/ ?>