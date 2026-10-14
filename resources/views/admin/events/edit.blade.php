<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Event</h2>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-sm border">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Event</label>
                <input type="text" name="name" value="{{ old('name', $event->name) }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category" class="w-full border rounded p-2" required>
                    <option value="Musik" {{ old('category', $event->category) == 'Musik' ? 'selected' : '' }}>Musik</option>
                    <option value="Festival" {{ old('category', $event->category) == 'Festival' ? 'selected' : '' }}>Festival</option>
                    <option value="Seminar" {{ old('category', $event->category) == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $event->price) }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2" rows="3" required>{{ old('description', $event->description) }}</textarea>
            </div>

            @if($event->image)
                <div class="mb-4">
                    <label class="block font-medium mb-1">Gambar Saat Ini</label>
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-32 h-32 object-cover rounded-md border">
                </div>
            @endif

            <div class="mb-6">
                <label class="block font-medium mb-1">Gambar Baru (Opsional)</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('events.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded font-semibold">Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded font-semibold">Update Data</button>
            </div>
        </form>
    </div>
</x-app-layout>