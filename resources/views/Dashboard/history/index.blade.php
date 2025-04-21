<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Search and Filter Form -->
                    <div class="mb-4 flex items-center justify-between">
                        <form method="GET" action="{{ route('dashboard.history') }}" class="flex items-center space-x-4 mb-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by pelanggan or no kontrol" class="form-input w-2/3 border-gray-300 text-black">

                            <select name="status" class="form-select border-gray-300 text-black">
                                <option value="">All Status</option>
                                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            </select>

                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-input border-gray-300 text-black">
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-input border-gray-300 text-black">

                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Filter
                            </button>
                        </form>

                        <!-- Generate PDF Button -->
                        @auth
                        @if (auth()->user()->role === 'admin')
                            <form method="GET" action="{{ route('laporan.pembayaran') }}" class="flex items-center space-x-4 mb-4">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">

                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                    Generate PDF Report
                                </button>
                            </form>
                        @endif
                    @endauth

                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Dibayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembalian</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @php $i = 1; @endphp
                                @foreach ($pemakaians as $pemakaian)
                                    <tr>
                                        <td class="px-6 py-4 text-gray-600">{{ $i++ }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $pemakaian->no_kontrol }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $pemakaian->pelanggan?->name }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $pemakaian->bulan }}/{{ $pemakaian->tahun }}</td>
                                        <td class="px-6 py-4 text-gray-600">Rp {{ number_format($pemakaian->total_bayar, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-gray-600">Rp {{ number_format($pemakaian->jumlah_bayar ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-gray-600">
                                            Rp {{ number_format(($pemakaian->jumlah_bayar ?? 0) - $pemakaian->total_bayar, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 text-xs font-semibold inline-block rounded-full
                                                {{ $pemakaian->status == 'lunas' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                {{ ucfirst($pemakaian->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('pemakaian.show', $pemakaian->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $pemakaians->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
