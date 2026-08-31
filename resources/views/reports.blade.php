@extends('layouts.app')
@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('styles')
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
    }
    .stat-card {
        padding: 20px;
        border-radius: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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

    .filter-section {
        padding: 20px;
        border-radius: 16px;
        background: white;
        margin-bottom: 16px;
    }
    .filter-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: flex-end;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .filter-group label {
        font-size: 11px;
        font-weight: 600;
        color: #475569;
    }
    .filter-group select,
    .filter-group input {
        padding: 10px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
        min-height: 42px;
    }
    .filter-group select:focus,
    .filter-group input:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
    }
    .filter-group select {
        min-width: 150px;
    }

    .filter-group input[type="date"] {
        min-width: 140px;
    }
    .date-placeholder-wrapper {
        position: relative;
        display: inline-block;
    }
    .date-placeholder-wrapper input {
        padding-right: 14px;
        min-width: 140px;
    }
    .date-placeholder-wrapper .placeholder-text {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
        pointer-events: none;
        font-family: 'Poppins', sans-serif;
    }
    .date-placeholder-wrapper input:not(:placeholder-shown) + .placeholder-text {
        display: none;
    }
    .flatpickr-input {
        background: white !important;
    }
    .btn-apply:hover {
        filter: brightness(0.9);
    }
    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        min-height: 42px;
        display: flex;
        align-items: center;
    }
    .btn-reset:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin: 20px 0;
    }
    .chart-card {
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border-radius: 16px;
        padding: 20px;
    }
    .chart-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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
@endsection

@section('header-actions')
    <button class="topbar-btn" onclick="exportReport()" data-tooltip="Export Laporan">
        📥
    </button>
@endsection

@section('content')
    <div style="margin-bottom: 16px;">

    <div class="stats-grid">
        <div class="stat-card total">
            <span class="icon-bg">📋</span>
            <div class="number">{{ $totalTasks }}</div>
            <div class="label">Total Tugas</div>
            <div class="sublabel">Semua tugas dibuat</div>
        </div>
        <div class="stat-card completed">
            <span class="icon-bg">✓</span>
            <div class="number">{{ $completedTasks }}</div>
            <div class="label">Selesai</div>
            <div class="sublabel">Tugas selesai</div>
        </div>
        <div class="stat-card pending">
            <span class="icon-bg">⏳</span>
            <div class="number">{{ $pendingTasks }}</div>
            <div class="label">Belum Selesai</div>
            <div class="sublabel">Sedang berjalan</div>
        </div>
        <div class="stat-card overdue">
            <span class="icon-bg">⚠️</span>
            <div class="number">{{ $overdueTasks }}</div>
            <div class="label">Terlambat</div>
            <div class="sublabel">Melewati deadline</div>
        </div>
    </div>

    <div class="filter-section">
        <div class="filter-row">
                <div class="filter-group">
                    <label>Kategori</label>
                    <select id="filterCategory">
                        <option value="">Semua</option>
                        <option value="kerja">💼 Kerja</option>
                        <option value="kuliah">📚 Kuliah</option>
                        <option value="pribadi">💖 Pribadi</option>
                        <option value="sekolah">📓 Sekolah</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Dari Tanggal</label>
                    <input type="text" class="flatpickr-date" id="filterDateFrom">
                </div>
                <div class="filter-group">
                    <label>Sampai Tanggal</label>
                    <input type="text" class="flatpickr-date" id="filterDateTo">
                </div>
                <button class="btn-apply" onclick="applyFilter()">🔍 Terapkan</button>
                <button class="btn-reset" onclick="resetFilter()">↺ Reset</button>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-card-header">
                    <div class="chart-card-icon purple">📊</div>
                    <div class="chart-card-title">Proporsi Kategori</div>
                </div>
                <div class="chart-container">
                    <canvas id="categoryPieChart"></canvas>
                </div>
                <div class="chart-legend" id="categoryLegend"></div>
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <div class="chart-card-icon blue">📈</div>
                    <div class="chart-card-title">Tren Mingguan</div>
                </div>
                <div class="chart-container">
                    <canvas id="weeklyBarChart"></canvas>
                </div>
            </div>
        </div>

        <div class="report-grid">
            <div class="report-card">
                <div class="report-card-header">
                    <div class="report-card-icon pink">📊</div>
                    <div class="report-card-title">Ringkasan</div>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Total Tugas</span>
                    <span class="report-card-stat-value pink">{{ $totalTasks }}</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Tingkat Penyelesaian</span>
                    <span class="report-card-stat-value green">{{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0 }}%</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Tingkat Keterlambatan</span>
                    <span class="report-card-stat-value">{{ $totalTasks > 0 ? round(($overdueTasks / $totalTasks) * 100) : 0 }}%</span>
                </div>
            </div>

            <div class="report-card">
                <div class="report-card-header">
                    <div class="report-card-icon green">✓</div>
                    <div class="report-card-title">Tugas Selesai</div>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Jumlah Selesai</span>
                    <span class="report-card-stat-value green">{{ $completedTasks }}</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Jumlah Tertunda</span>
                    <span class="report-card-stat-value orange">{{ $pendingTasks }}</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Tugas Aktif</span>
                    <span class="report-card-stat-value">{{ $pendingTasks - $overdueTasks }}</span>
                </div>
            </div>

            <div class="report-card">
                <div class="report-card-header">
                    <div class="report-card-icon orange">⏳</div>
                    <div class="report-card-title">Status Tugas</div>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Selesai</span>
                    <span class="report-card-stat-value green">{{ $completedTasks }}</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Belum Selesai</span>
                    <span class="report-card-stat-value orange">{{ $pendingTasks }}</span>
                </div>
                <div class="report-card-stat">
                    <span class="report-card-stat-label">Terlambat</span>
                    <span class="report-card-stat-value">{{ $overdueTasks }}</span>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        flatpickr(".flatpickr-date", {
            dateFormat: "d-m-Y",
            locale: "id",
            allowInput: true
        });

        const categoryData = @json($categoryStats);
        const weeklyData = @json($weeklyStats);

        const categoryColors = ['#ff6b9d', '#667eea', '#16a34a', '#f59e0b', '#8b5cf6', '#06b6d4'];
        const categoryLabels = Object.keys(categoryData);
        const categoryCounts = Object.values(categoryData);

        const totalCount = categoryCounts.reduce((a, b) => a + b, 0);

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

        const maxValue = Math.max(
            ...weeklyData.map(d => Math.max(d.created, d.completed)),
            1
        );

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: weeklyData.map(d => d.day),
                datasets: [
                    {
                        label: 'Dibuat',
                        data: weeklyData.map(d => d.created),
                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                        borderRadius: 6,
                        borderSkipped: false
                    },
                    {
                        label: 'Diselesaikan',
                        data: weeklyData.map(d => d.completed),
                        backgroundColor: 'rgba(22, 163, 74, 0.8)',
                        borderRadius: 6,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 800 },
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
                        max: Math.ceil(maxValue * 1.2),
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

        function applyFilter() {
            const category = document.getElementById('filterCategory').value;
            const dateFrom = document.getElementById('filterDateFrom').value;
            const dateTo = document.getElementById('filterDateTo').value;

            let url = '/reports?';
            const params = [];

            if (category) params.push('category=' + category);
            if (dateFrom) {
                const parts = dateFrom.split('-');
                params.push('from=' + parts[2] + '-' + parts[1] + '-' + parts[0]);
            }
            if (dateTo) {
                const parts = dateTo.split('-');
                params.push('to=' + parts[2] + '-' + parts[1] + '-' + parts[0]);
            }

            if (params.length > 0) {
                url += params.join('&');
            }

            window.location.href = url;
        }

        function resetFilter() {
            document.getElementById('filterCategory').value = '';
            document.getElementById('filterDateFrom').value = '';
            document.getElementById('filterDateTo').value = '';
            window.location.href = '/reports';
        }

        function exportReport() {
            alert('Fitur Export Laporan akan segera hadir!');
        }
    </script>
@endsection
