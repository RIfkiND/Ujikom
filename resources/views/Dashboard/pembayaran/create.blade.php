<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran Pemakaian</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Error!</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <h1 class="text-2xl font-bold text-blue-600 mb-6">Pembayaran untuk Pemakaian</h1>

            <!-- Display Pemakaian Information -->
            <div class="mb-6 bg-gray-50 p-4 rounded shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pemakaian</h2>
                <p><strong>No Kontrol:</strong> {{ $pemakaian->no_kontrol }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $pemakaian->pelanggan->name ?? '-' }}</p>
                <p><strong>Bulan:</strong> {{ \Carbon\Carbon::create()->month($pemakaian->bulan)->translatedFormat('F') }} {{ $pemakaian->tahun }}</p>
                <p><strong>Total Bayar:</strong> Rp {{ number_format($pemakaian->total_bayar, 0, ',', '.') }}</p>
                <p><strong>Status Pembayaran:</strong>
                    @if($pemakaian->status == 'lunas')
                        <span class="text-green-500 font-semibold">Lunas</span>
                    @else
                        <span class="text-red-500 font-semibold">Belum Bayar</span>
                    @endif
                </p>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Display Tunggakan -->
                @if ($tunggakan->isNotEmpty())
                    <div class="mb-6 bg-yellow-50 p-4 rounded shadow-sm">
                        <h2 class="text-lg font-semibold text-yellow-700 mb-4">Tunggakan (Unpaid Months)</h2>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tunggakan as $unpaid)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="pemakaian_ids[]" value="{{ $unpaid->id }}" class="tunggakan-checkbox" data-total="{{ $unpaid->total_bayar }}">
                                        </td>
                                        <td>{{ \Carbon\Carbon::create()->month($unpaid->bulan)->translatedFormat('F') }}</td>
                                        <td>{{ $unpaid->tahun }}</td>
                                        <td>Rp {{ number_format($unpaid->total_bayar, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- Current Month Payment -->
                <input type="hidden" name="pemakaian_id" value="{{ $pemakaian->id }}">

                <div>
                    <label for="jumlah_bayar" class="block text-gray-700 font-medium">Jumlah Bayar:</label>
                    <input type="number" id="jumlah_bayar" name="jumlah_bayar" value="{{ $pemakaian->total_bayar }}" class="form-input w-full border-gray-300 rounded-md shadow-sm text-gray-700" readonly required>
                </div>

                <div>
                    <label for="tanggal_bayar" class="block text-gray-700 font-medium">Tanggal Bayar:</label>
                    <input type="date" id="tanggal_bayar" name="tanggal_bayar" value="{{ now()->toDateString() }}" class="form-input w-full border-gray-300 rounded-md shadow-sm text-gray-700" required>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                        Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tunggakanCheckboxes = document.querySelectorAll('.tunggakan-checkbox');
            const jumlahBayarInput = document.getElementById('jumlah_bayar');
            let currentTotal = parseFloat(jumlahBayarInput.value);

            tunggakanCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const tunggakanTotal = parseFloat(this.dataset.total);

                    if (this.checked) {
                        currentTotal += tunggakanTotal;
                    } else {
                        currentTotal -= tunggakanTotal;
                    }

                    jumlahBayarInput.value = currentTotal.toFixed(2);
                });
            });
        });
    </script>
</x-app-layout>
