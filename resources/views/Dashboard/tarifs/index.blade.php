<!-- filepath: d:\ujikom\ujikom_rifki\resources\views\dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tarif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Add horizontal scrolling -->
                    <div class="mb-4">
                        <a href="{{ route('tarif.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Create
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="grid grid-cols-5">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jenis Pelanggan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Biaya Beban
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tarif KWH
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $i = 1; @endphp <!-- Initialize counter -->
                                @foreach ($tarifs as $tarif)
                                    <tr class="grid grid-cols-5 items-center">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $i++ }} <!-- Increment counter -->
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tarif->jenis_plg }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ number_format($tarif->biaya_beban, 2, ',', '.') }}.Kwh
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp.{{ number_format($tarif->tarif_kwh, 2, ',', '.') }} 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('tarif.edit', $tarif->id) }}" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-100">
                                                    Update
                                                </a>
                                                <form action="{{ route('tarif.destroy', $tarif->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tarif?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
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

                    <!-- Pagination Links -->
                    <div class="mt-5">
                        {{ $tarifs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
