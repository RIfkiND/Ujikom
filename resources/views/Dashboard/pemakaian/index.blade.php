<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemakaian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('dashboard.pemakaian') }}" class="flex items-center space-x-4">
                            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search by pelanggan or month" class="form-input w-2/3 border-gray-300 text-black">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Search
                            </button>
                        </form>

                        <!-- Create Button -->
                        <a href="{{ route('pemakaian.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Create Pemakaian
                        </a>
                    </div>

                    <!-- Table with Horizontal Scroll -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month/Year</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Awal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Akhir</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pakai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $i = 1; @endphp
                                @foreach ($pemakaians as $pemakaian)
                                    <tr class="text-sm">
                                        <td class="px-6 py-4 text-gray-500">{{ $i++ }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->no_kontrol }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->pelanggan?->name }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->bulan }}/{{ $pemakaian->tahun }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->meter_awal }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->meter_akhir }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $pemakaian->jumlah_pakai }}</td>

                                        <!-- Status with color -->
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold inline-block rounded-full
                                                {{ $pemakaian->status == 'lunas' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                {{ ucfirst($pemakaian->status) }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex space-x-2 justify-end">
                                                <a href="{{ route('pemakaian.show', $pemakaian->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                                    Show
                                                </a>
                                                <a href="{{ route('pemakaian.edit', $pemakaian->id) }}" class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('pemakaian.destroy', $pemakaian->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this pemakaian?');">
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
                        {{ $pemakaians->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
