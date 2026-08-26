@extends('layouts.app')
@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('styles')
    .category-container {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }
    .add-category-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 20px;
    }
    .add-category-btn:hover {
        background: #e05585;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255,107,157,0.3);
    }
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    .category-card {
        background: linear-gradient(135deg, #fff0f5 0%, #fff5f8 100%);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,182,193,0.2);
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255,107,157,0.15);
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
        color: #ff6b9d;
        margin: 0 0 20px;
        font-size: 20px;
    }
    .modal-content input {
        width: 100%;
        padding: 12px;
        border: 2px solid #ffc2d1;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        margin-bottom: 20px;
    }
    .modal-content input:focus {
        border-color: #ff6b9d;
    }
    .modal-content .btn-group {
        display: flex;
        gap: 10px;
    }
    .modal-content .btn-submit {
        flex: 1;
        background: #ff6b9d;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background 0.2s;
    }
    .modal-content .btn-submit:hover {
        background: #e05585;
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
    .category-form {
        display: inline;
    }
@endsection

@section('content')
    <div class="category-container">
        <button class="add-category-btn" onclick="openAddModal()">
            ➕ Tambah Kategori
        </button>

        <div class="category-grid">
            @php
                $categories = [
                    ['name' => 'Kerja', 'icon' => '💼', 'count' => 0],
                    ['name' => 'Kuliah', 'icon' => '📚', 'count' => 0],
                    ['name' => 'Pribadi', 'icon' => '💖', 'count' => 0],
                    ['name' => 'Sekolah', 'icon' => '📓', 'count' => 0],
                ];
            @endphp

            @forelse($categories as $cat)
                <div class="category-card">
                    <div class="category-icon">{{ $cat['icon'] }}</div>
                    <div class="category-name">{{ $cat['name'] }}</div>
                    <div class="category-count">{{ $cat['count'] }} tugas</div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span>📁</span>
                    <p>Belum ada kategori. Yuk, tambah kategori baru!</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="modal-overlay" id="addCategoryModal">
        <div class="modal-content">
            <button onclick="closeAddModal()" style="position:absolute; top:15px; right:15px; background:#ff6b9d; border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3>➕ Tambah Kategori</h3>
            <form method="POST" action="/categories">
                @csrf
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
@endsection
