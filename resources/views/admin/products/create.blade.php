@extends('layouts.admin')

@section('title', 'Tambah Produk - Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:underline">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Kategori *</label>
                <select name="category_id" required class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price') }}" required min="0"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Diskon (%)</label>
                <input type="number" name="discount" value="{{ old('discount', 0) }}" min="0" max="100"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required min="0"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Status</label>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                    <span>Aktif</span>
                </label>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded px-4 py-2" onchange="previewImage(event)">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>

                <!-- Preview Image -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="previewImg" src="" alt="Preview" class="w-48 h-48 object-cover rounded border">
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Spesifikasi (satu per baris)</label>
                <textarea name="specifications[]" rows="6" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Intel Core i7&#10;16GB RAM&#10;512GB SSD">{{ old('specifications.0') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Tulis setiap spesifikasi di baris baru</p>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                <i class="fas fa-save mr-2"></i>Simpan Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (file) {
        // Check file size (2MB max)
        if (file.size > 2048000) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            preview.classList.add('hidden');
            return;
        }

        // Check file type
        if (!file.type.match('image/jpeg') && !file.type.match('image/png') && !file.type.match('image/jpg') && !file.type.match('image/gif')) {
            alert('Format file tidak didukung! Gunakan JPG, PNG, atau GIF');
            event.target.value = '';
            preview.classList.add('hidden');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection
