{{-- File: resources/views/admin/categories/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Kelola Kategori - Admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Kelola Kategori</h1>
    <button onclick="document.getElementById('addModal').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
        <i class="fas fa-plus mr-2"></i>Tambah Kategori
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($categories as $category)
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <i class="fas {{ $category->icon }} text-3xl text-blue-600"></i>
            <div class="flex gap-2">
                <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->icon }}')"
                        class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <h3 class="font-bold text-lg mb-1">{{ $category->name }}</h3>
        <p class="text-sm text-gray-600">{{ $category->products_count }} produk</p>
    </div>
    @endforeach
</div>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4">Tambah Kategori</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Kategori *</label>
                <input type="text" name="name" required class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Icon (FontAwesome)</label>
                <input type="text" name="icon" placeholder="fa-laptop" class="w-full border rounded px-4 py-2">
                <p class="text-xs text-gray-500 mt-1">Contoh: fa-laptop, fa-mobile-alt</p>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                    Simpan
                </button>
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 py-2 rounded">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Kategori *</label>
                <input type="text" name="name" id="editName" required class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Icon (FontAwesome)</label>
                <input type="text" name="icon" id="editIcon" class="w-full border rounded px-4 py-2">
            </div>
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                    Update
                </button>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 py-2 rounded">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function editCategory(id, name, icon) {
    document.getElementById('editForm').action = `/admin/categories/${id}`;
    document.getElementById('editName').value = name;
    document.getElementById('editIcon').value = icon;
    document.getElementById('editModal').classList.remove('hidden');
}
</script>
@endsection
