<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Pemakaian</h2>
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

            <form action="{{ route('pemakaian.store') }}" method="POST">
                @csrf

                <!-- Searchable Dropdown -->
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <label for="no_kontrol" class="block text-sm font-medium text-gray-700">No Kontrol</label>
                    <select name="no_kontrol" id="no_kontrol" class="form-select block w-full text-black">
                        <option value="">-- Cari No Kontrol / Nama --</option>
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->no_kontrol }}" data-meter-akhir="{{ $lastMeterAkhir[$pelanggan->no_kontrol] ?? '' }}">
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
                            <option value="">-- Pilih Tahun --</option>
                            @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Month Dropdown -->
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select block w-full text-black" required>
                            <option value="">-- Pilih Bulan --</option>
                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="meter_awal" class="block text-sm font-medium text-gray-700">Meter Awal</label>
                        <input type="number" name="meter_awal" id="meter_awal" value="" class="form-input w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                    <div>
                        <label for="meter_akhir" class="block text-sm font-medium text-gray-700">Meter Akhir</label>
                        <input type="number" name="meter_akhir" id="meter_akhir" class="form-input w-full" required>
                    </div>
                </div>

                <div class="mt-6">
                    <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#no_kontrol').select2({
                placeholder: "-- Cari No Kontrol / Nama --",
                allowClear: true
            });

            // Auto-fill Meter Awal based on selected No Kontrol
            $('#no_kontrol').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const meterAkhir = selectedOption.data('meter-akhir');

                // If no previous pemakaian exists, set meter_awal to 0
                $('#meter_awal').val(meterAkhir || 0);
            });
        });
    </script>
</x-app-layout>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Pemakaian</h2>
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

            <form action="{{ route('pemakaian.store') }}" method="POST">
                @csrf

                <!-- Searchable Dropdown -->
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <label for="no_kontrol" class="block text-sm font-medium text-gray-700">No Kontrol</label>
                    <select name="no_kontrol" id="no_kontrol" class="form-select block w-full text-black">
                        <option value="">-- Cari No Kontrol / Nama --</option>
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->no_kontrol }}"
                                    data-meter-akhir="{{ $lastMeterAkhir[$pelanggan->no_kontrol] ?? '' }}"
                                    data-next-month="{{ $nextUnpaidMonth[$pelanggan->no_kontrol]['bulan'] ?? '' }}"
                                    data-next-year="{{ $nextUnpaidMonth[$pelanggan->no_kontrol]['tahun'] ?? '' }}">
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
                            <option value="">-- Pilih Tahun --</option>
                            @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Month Dropdown -->
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select block w-full text-black" required>
                            <option value="">-- Pilih Bulan --</option>
                            @for ($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="meter_awal" class="block text-sm font-medium text-gray-700">Meter Awal</label>
                        <input type="number" name="meter_awal" id="meter_awal" value="" class="form-input w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                    <div>
                        <label for="meter_akhir" class="block text-sm font-medium text-gray-700">Meter Akhir</label>
                        <input type="number" name="meter_akhir" id="meter_akhir" class="form-input w-full" required>
                    </div>
                </div>

                <div class="mt-6">
                    <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#no_kontrol').select2({
                placeholder: "-- Cari No Kontrol / Nama --",
                allowClear: true
            });

            // Auto-fill Meter Awal based on selected No Kontrol
            $('#no_kontrol').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const meterAkhir = selectedOption.data('meter-akhir');
                const nextMonth = selectedOption.data('next-month');
                const nextYear = selectedOption.data('next-year');

                // If no previous pemakaian exists, set meter_awal to 0
                $('#meter_awal').val(meterAkhir || 0);

                // Set the next month and year in the dropdowns
                $('#bulan').val(nextMonth);
                $('#tahun').val(nextYear);
            });
        });
    </script>
</x-app-layout> --}}
