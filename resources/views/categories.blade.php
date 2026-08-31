@extends('layouts.app')
@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('styles')
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
    }
    .category-actions .btn-edit {
        background: #f1f5f9;
        color: #64748b;
    }
    .category-actions .btn-edit:hover {
        background: #dbeafe;
        color: #3b82f6;
    }
    .category-actions .btn-delete {
        background: #f1f5f9;
        color: #64748b;
    }
    .category-actions .btn-delete:hover {
        background: #fee2e2;
        color: #ef4444;
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
    .modal-content .btn-submit:hover {
        background: #4f46e5;
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
@endsection

@section('content')
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
        @forelse($defaultCategories as $cat)
            <div class="category-item" data-name="{{ strtolower($cat['name']) }}">
                <div class="category-left">
                    <div class="category-icon-box">{{ $cat['icon'] }}</div>
                    <div class="category-info">
                        <div class="category-name">{{ $cat['name'] }}</div>
                        <div class="category-count">{{ $cat['count'] }} Tugas Aktif</div>
                    </div>
                </div>
                <div class="category-actions">
                    <button class="btn-edit" title="Edit">✏️</button>
                    <button class="btn-delete" title="Hapus">🗑️</button>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <span>📁</span>
                <p>Belum ada kategori. Yuk, tambah kategori baru!</p>
            </div>
        @endforelse
    </div>

    <div class="modal-overlay" id="addCategoryModal">
        <div class="modal-content">
            <button onclick="closeAddModal()" style="position:absolute; top:15px; right:15px; background:#f1f5f9; border:none; color:#64748b; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center;">×</button>
            <h3>+ Tambah Kategori</h3>
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

        function filterCategories() {
            const search = document.getElementById('searchCategory').value.toLowerCase();
            const items = document.querySelectorAll('.category-item');
            items.forEach(item => {
                const name = item.dataset.name;
                item.style.display = name.includes(search) ? '' : 'none';
            });
        }
    </script>
@endsection
