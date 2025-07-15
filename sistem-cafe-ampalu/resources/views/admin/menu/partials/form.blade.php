<div class="mb-4">
    <label for="name" class="block text-gray-700">Nama Menu</label>
    <input type="text" name="name" id="name" value="{{ old('name', $menu->name ?? '') }}" class="w-full border border-gray-300 p-2 rounded" required>
</div>
<div class="mb-4">
    <label for="description" class="block text-gray-700">Deskripsi</label>
    <textarea name="description" id="description" class="w-full border border-gray-300 p-2 rounded">{{ old('description', $menu->description ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label for="price" class="block text-gray-700">Harga</label>
    <input type="number" name="price" id="price" value="{{ old('price', $menu->price ?? '') }}" class="w-full border border-gray-300 p-2 rounded" required>
</div>
<div class="mb-4">
    <label for="category" class="block text-gray-700">Kategori</label>
    <input type="text" name="category" id="category" value="{{ old('category', $menu->category ?? '') }}" class="w-full border border-gray-300 p-2 rounded" required>
</div>
<!-- (BARU) Input untuk upload gambar -->
<div class="mb-4">
    <label for="image" class="block text-gray-700">Gambar Menu</label>
    <input type="file" name="image" id="image" class="w-full border border-gray-300 p-2 rounded">
    @if(isset($menu) && $menu->image)
        <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-24 h-24 mt-2 object-cover">
    @endif
</div>
<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
