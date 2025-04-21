<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('dashboard.history*') ? 'Riwayat Pembayaran' : 'Detail Pemakaian' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow text-black space-y-4">
            <h1 class="text-2xl font-bold">
                {{ request()->routeIs('dashboard.history*') ? 'Detail Riwayat Pembayaran' : 'Pemakaian Detail' }}
            </h1>

            <p><strong>No Kontrol:</strong> {{ $pemakaian->no_kontrol }}</p>
            <p><strong>Nama:</strong> {{ $pemakaian->pelanggan->name ?? '-' }}</p>
            <p><strong>Tahun:</strong> {{ $pemakaian->tahun }}</p>
            <p><strong>Bulan:</strong> {{ $pemakaian->bulan }}</p>
            <p><strong>Meter Awal:</strong> {{ $pemakaian->meter_awal }}</p>
            <p><strong>Meter Akhir:</strong> {{ $pemakaian->meter_akhir }}</p>
            <p><strong>Jumlah Pakai:</strong> {{ $pemakaian->jumlah_pakai }} kWh</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($pemakaian->total_bayar, 0, ',', '.') }}</p>

            <!-- Status Display -->
            <h2 class="text-xl font-bold
                @if($pemakaian->status == 'lunas')
                    text-green-500
                @else
                    text-red-500
                @endif">
                Status: {{ ucfirst($pemakaian->status) }}
            </h2>

            <!-- Tanggal & Jumlah Bayar Info -->
            @if($pemakaian->status == 'lunas')
                <p><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($pemakaian->tanggal_bayar)->format('d M Y') }}</p>
                <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($pemakaian->jumlah_bayar, 0, ',', '.') }}</p>
            @else
                <p class="text-red-600 italic">Belum melakukan pembayaran.</p>
            @endif

            <!-- Action Buttons -->
            <div class="flex space-x-4 mt-6">
                @if($pemakaian->status == 'lunas')
                    <button class="px-4 py-2 bg-green-500 text-white rounded cursor-not-allowed" disabled>Lunas</button>
                @else
                    <a href="{{ route('pembayaran.create', $pemakaian->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Bayar
                    </a>
                @endif

                <a href="{{ request()->routeIs('dashboard.history*') ? route('dashboard.history') : route('dashboard.pemakaian') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Back
                </a>

                <!-- Download PDF Button -->
                <a href="{{ route('laporan.struct', $pemakaian->id) }}"
                   class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
