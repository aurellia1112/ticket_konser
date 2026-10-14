<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Event</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            + Tambah Event
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border shadow-sm rounded-lg overflow-hidden mt-4">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Gambar</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Harga</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $index => $event)
                        <tr class="border-b text-sm hover:bg-gray-50">
                            <td class="p-3 text-center font-medium text-gray-500">
                                {{ $events->firstItem() + $index }}
                            </td>

                            <td class="p-3 text-center">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-16 h-16 object-cover rounded-md mx-auto border">
                                @else
                                    <span class="text-xs text-gray-400 italic">Tanpa Foto</span>
                                @endif
                            </td>

                            <td class="p-3 font-semibold text-gray-800">{{ $event->name }}</td>
                            <td class="p-3 text-gray-600">{{ $event->category }}</td>
                            <td class="p-3 font-bold text-green-600">Rp {{ number_format($event->price, 0, ',', '.') }}</td>

                            <td class="p-3 text-center">
                                <a href="{{ route('events.edit', $event->id) }}" class="text-blue-600 hover:underline mr-3 font-semibold">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:underline font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data event.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>