<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pemakaian</h2>
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

            <form action="{{ route('pemakaian.update', $pemakaian->id) }}" method="POST" onsubmit="return confirmUpdate()">
                @csrf
                @method('PUT')

                <!-- Searchable Dropdown -->
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <label for="no_kontrol" class="block text-sm font-medium text-gray-700">No Kontrol</label>
                    <select name="no_kontrol" id="no_kontrol" class="form-select block w-full text-black">
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->no_kontrol }}" {{ $pemakaian->no_kontrol == $pelanggan->no_kontrol ? 'selected' : '' }}>
                                {{ $pelanggan->no_kontrol }} - {{ $pelanggan->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Year Dropdown -->
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select name="tahun" id="tahun" class="form-select block w-full text-black" required>
                            @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                <option value="{{ $year }}" {{ $pemakaian->tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Month Dropdown -->
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select block w-full text-black" required>
                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}" {{ $pemakaian->bulan == $month ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="meter_awal" class="block text-sm font-medium text-gray-700">Meter Awal</label>
                        <input type="number" name="meter_awal" id="meter_awal" value="{{ $pemakaian->meter_awal }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                    <div>
                        <label for="meter_akhir" class="block text-sm font-medium text-gray-700">Meter Akhir</label>
                        <input type="number" name="meter_akhir" id="meter_akhir" value="{{ $pemakaian->meter_akhir }}" class="form-input w-full" required>
                    </div>
                </div>

                <!-- Status Display -->
                <div class="mt-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                    <p class="text-lg font-semibold {{ $pemakaian->status == 'lunas' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($pemakaian->status) }}
                    </p>
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function confirmUpdate() {
            return confirm('Apakah Anda yakin ingin memperbarui data pemakaian ini?');
        }
    </script>
</x-app-layout>
