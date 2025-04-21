<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('dashboard.pelanggan') }}" class="flex items-center space-x-4">
                            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search by name or no_kontrol" class="form-input w-2/3 border-gray-300 text-black">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Search
                            </button>
                        </form>


                        <!-- Create Button -->
                        <a href="{{ route('pelanggan.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Create Pelanggan
                        </a>
                    </div>


                    <!-- Table with Horizontal Scroll -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="grid grid-cols-6">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No telepon</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $i = 1; @endphp
                                @foreach ($pelanggans as $pelanggan)
                                    <tr class="grid grid-cols-6 items-center">
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $i++ }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pelanggan->no_kontrol }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pelanggan->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pelanggan->alamat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pelanggan->no_telepon }}</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex space-x-2 justify-end">
                                                <a href="{{ route('pelanggan.show', $pelanggan->no_kontrol) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                                    Show
                                                </a>
                                                <a href="{{ route('pelanggan.edit', $pelanggan->no_kontrol) }}" class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('pelanggan.destroy', $pelanggan->no_kontrol) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this pelanggan?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $pelanggans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
