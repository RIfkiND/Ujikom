<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <!-- Pelanggan Information -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Informasi Pelanggan</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                <p><strong>No Kontrol:</strong> {{ $pelanggan->no_kontrol }}</p>
                <p><strong>Nama:</strong> {{ $pelanggan->name }}</p>
                <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
                <p><strong>No HP:</strong> {{ $pelanggan->no_telepon }}</p>
                <p><strong>Jenis Pelanggan:</strong> {{ $pelanggan->tarif->jenis_plg ?? '-' }}</p>
            </div>

            <!-- Pemakaian Table -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Pemakaian</h3>
                @if($pelanggan->pemakaian->isEmpty())
                    <p class="text-gray-500 italic">Tidak ada data pemakaian untuk pelanggan ini.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="px-6 py-3 text-left">Tahun</th>
                                    <th class="px-6 py-3 text-left">Bulan</th>
                                    <th class="px-6 py-3 text-left">Meter Awal</th>
                                    <th class="px-6 py-3 text-left">Meter Akhir</th>
                                    <th class="px-6 py-3 text-left">Jumlah Pakai (kWh)</th>
                                    <th class="px-6 py-3 text-left">Biaya Beban</th>
                                    <th class="px-6 py-3 text-left">Biaya Pemakaian</th>
                                    <th class="px-6 py-3 text-left">Total Bayar</th>
                                    <th class="px-6 py-3 text-left">Jumlah Bayar</th>
                                    <th class="px-6 py-3 text-left">Tanggal Bayar</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pelanggan->pemakaian as $pemakaian)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pemakaian->tahun }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ \Carbon\Carbon::create()->month($pemakaian->bulan)->translatedFormat('F') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pemakaian->meter_awal }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pemakaian->meter_akhir }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pemakaian->jumlah_pakai }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($pemakaian->biaya_beban_pemakaian, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($pemakaian->biaya_pemakaian, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($pemakaian->total_bayar, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            Rp {{ $pemakaian->jumlah_bayar ? number_format($pemakaian->jumlah_bayar, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $pemakaian->tanggal_bayar ? \Carbon\Carbon::parse($pemakaian->tanggal_bayar)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                {{ $pemakaian->status === 'lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                                {{ ucfirst($pemakaian->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('dashboard.pelanggan') }}" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
