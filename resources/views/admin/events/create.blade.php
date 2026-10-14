<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Event</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-sm border">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Event</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category" class="w-full border rounded p-2" required>
                    <option value="Musik" {{ old('category') == 'Musik' ? 'selected' : '' }}>Musik</option>
                    <option value="Festival" {{ old('category') == 'Festival' ? 'selected' : '' }}>Festival</option>
                    <option value="Seminar" {{ old('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Gambar Event</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('events.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded font-semibold">Kembali</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded font-semibold">Simpan Data</button>
            </div>
        </form>
    </div>
</x-app-layout>