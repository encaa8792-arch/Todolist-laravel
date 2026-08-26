@extends('layouts.app')
@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('styles')
    .report-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .report-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .report-header h1 span {
        color: #ff6b9d;
    }
    .export-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
    }
    .export-btn:hover {
        background: #e05585;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255,107,157,0.3);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
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
        box-shadow: 0 8px 25px rgba(255,107,157,0.15);
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
        font-weight: 500;
        color: #666;
    }
    .stat-card .sublabel {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }
    .stat-card.total::before { background: linear-gradient(90deg, #ff6b9d, #ff8fa3); }
    .stat-card.total .number { color: #ff6b9d; }
    .stat-card.completed::before { background: linear-gradient(90deg, #2ecc71, #58d68d); }
    .stat-card.completed .number { color: #2ecc71; }
    .stat-card.pending::before { background: linear-gradient(90deg, #f39c12, #f5b041); }
    .stat-card.pending .number { color: #f39c12; }
    .stat-card.overdue::before { background: linear-gradient(90deg, #ff6b6b, #ff8a8a); }
    .stat-card.overdue .number { color: #ff6b6b; }

    .filter-section {
        background: white;
        padding: 16px 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
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
        font-weight: 500;
        color: #888;
    }
    .filter-group select,
    .filter-group input {
        padding: 8px 12px;
        border: 2px solid #ffc2d1;
        border-radius: 8px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.2s;
        background: white;
    }
    .filter-group select:focus,
    .filter-group input:focus {
        border-color: #ff6b9d;
    }
    .filter-group select {
        min-width: 140px;
    }
    .filter-group input[type="date"] {
        min-width: 130px;
    }
    .btn-apply {
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-apply:hover {
        background: #e05585;
    }
    .btn-reset {
        background: #f0f0f0;
        color: #666;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-reset:hover {
        background: #e0e0e0;
    }

    .report-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .report-card {
        background: white;
        padding: 18px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255,107,157,0.15);
    }
    .report-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        padding-bottom: 12px;
        border-bottom: 2px solid #fff0f5;
    }
    .report-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .report-card-icon.pink { background: rgba(255,107,157,0.15); }
    .report-card-icon.green { background: rgba(46,204,113,0.15); }
    .report-card-icon.orange { background: rgba(243,156,18,0.15); }
    .report-card-title {
        font-size: 14px;
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
        border-bottom: 1px dashed #f5f5f5;
    }
    .report-card-stat-label {
        font-size: 12px;
        color: #888;
    }
    .report-card-stat-value {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }
    .report-card-stat-value.pink { color: #ff6b9d; }
    .report-card-stat-value.green { color: #2ecc71; }
    .report-card-stat-value.orange { color: #f39c12; }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .report-grid {
            grid-template-columns: repeat(2, 1fr);
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
        .report-header {
            flex-direction: column;
            align-items: flex-start;
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

@section('content')
    <div class="report-container">
        <div class="report-header">
            <h1>Laporan <span>Tugas</span></h1>
            <button class="export-btn" onclick="exportReport()">
                📥 Export Laporan
            </button>
        </div>

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
                    <input type="date" id="filterDateFrom">
                </div>
                <div class="filter-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" id="filterDateTo">
                </div>
                <button class="btn-apply" onclick="applyFilter()">🔍 Terapkan</button>
                <button class="btn-reset" onclick="resetFilter()">↺ Reset</button>
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
    </div>

    <script>
        function applyFilter() {
            const category = document.getElementById('filterCategory').value;
            const dateFrom = document.getElementById('filterDateFrom').value;
            const dateTo = document.getElementById('filterDateTo').value;
            
            let url = '/reports?';
            const params = [];
            
            if (category) params.push('category=' + category);
            if (dateFrom) params.push('from=' + dateFrom);
            if (dateTo) params.push('to=' + dateTo);
            
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
