<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <!-- Total Users Card -->
                <div class="bg-blue-500 text-white shadow-md rounded-lg p-6 flex items-center">
                    <div class="mr-4">
                        <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-8a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Users</h3>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>

                <!-- Total Pelanggan Card -->
                <div class="bg-green-500 text-white shadow-md rounded-lg p-6 flex items-center">
                    <div class="mr-4">
                        <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Pelanggan</h3>
                        <p class="text-3xl font-bold">{{ $totalPelanggan }}</p>
                    </div>
                </div>

                <!-- Total Pemakaian Card -->
                <div class="bg-yellow-500 text-white shadow-md rounded-lg p-6 flex items-center">
                    <div class="mr-4">
                        <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12.34a9 9 0 11-9-9 9 9 0 019 9z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Pemakaian</h3>
                        <p class="text-3xl font-bold">{{ $totalPemakaian }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Admin only "Create" button --}}
                    @if (auth()->user()->role === 'admin')
                        <div class="mb-4">
                            <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Create
                            </a>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="grid grid-cols-6">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    {{-- Only show "Actions" column to admin --}}
                                    @if (auth()->user()->role === 'admin')
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $i = 1; @endphp
                                @foreach ($users as $user)
                                    <tr class="grid grid-cols-6 items-center">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $i++ }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                                                Active
                                            </span>
                                        </td>
                                        {{-- Admin only "Update" and "Delete" actions --}}
                                        @if (auth()->user()->role === 'admin' && auth()->user()->id !== $user->id)
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-100">
                                                        Update
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-5">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
