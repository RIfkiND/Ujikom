<!-- filepath: resources/views/Dashboard/tarif/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Create Tarif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-md rounded-md">
            <h1 class="text-2xl font-bold mb-6 text-black">Create Tarif</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tarif.store') }}" method="POST">
                @csrf

                <!-- Jenis Pelanggan Field -->
                <div class="mb-4">
                    <label for="jenis_plg" class="block text-sm font-medium text-black mb-1">Jenis Pelanggan</label>
                    <input type="text" name="jenis_plg" id="jenis_plg"
                        class="form-input w-full border-gray-300 text-black @error('jenis_plg') border-red-500 @enderror"
                        value="{{ old('jenis_plg') }}" required>
                    @error('jenis_plg')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Biaya Beban Field -->
                <div class="mb-4">
                    <label for="biaya_beban" class="block text-sm font-medium text-black mb-1">Biaya Beban</label>
                    <input type="number" step="0.01" name="biaya_beban" id="biaya_beban"
                        class="form-input w-full border-gray-300 text-black @error('biaya_beban') border-red-500 @enderror"
                        value="{{ old('biaya_beban') }}" required>
                    @error('biaya_beban')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tarif kWh Field -->
                <div class="mb-4">
                    <label for="tarif_kwh" class="block text-sm font-medium text-black mb-1">Tarif kWh</label>
                    <input type="number" step="0.01" name="tarif_kwh" id="tarif_kwh"
                        class="form-input w-full border-gray-300 text-black @error('tarif_kwh') border-red-500 @enderror"
                        value="{{ old('tarif_kwh') }}" required>
                    @error('tarif_kwh')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Create
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

<!-- filepath: d:\ujikom\ujikom_rifki\resources\views\Dashboard\tarifs\create.blade.php -->
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Create Tarif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-md rounded-md">
            <h1 class="text-2xl font-bold mb-6 text-black">Create Tarif</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tarif.store') }}" method="POST">
                @csrf

                <!-- Jenis Pelanggan Dropdown -->
                <div class="mb-4">
                    <label for="jenis_plg" class="block text-sm font-medium text-black mb-1">Jenis Pelanggan</label>
                    <select name="jenis_plg" id="jenis_plg" class="form-select w-full border-gray-300 text-black @error('jenis_plg') border-red-500 @enderror" required>
                        <option value="">Select Jenis Pelanggan</option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item->id }}" {{ old('jenis_plg') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_plg')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Biaya Beban Field -->
                <div class="mb-4">
                    <label for="biaya_beban" class="block text-sm font-medium text-black mb-1">Biaya Beban</label>
                    <input type="number" step="0.01" name="biaya_beban" id="biaya_beban"
                        class="form-input w-full border-gray-300 text-black @error('biaya_beban') border-red-500 @enderror"
                        value="{{ old('biaya_beban') }}" required>
                    @error('biaya_beban')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tarif kWh Field -->
                <div class="mb-4">
                    <label for="tarif_kwh" class="block text-sm font-medium text-black mb-1">Tarif kWh</label>
                    <input type="number" step="0.01" name="tarif_kwh" id="tarif_kwh"
                        class="form-input w-full border-gray-300 text-black @error('tarif_kwh') border-red-500 @enderror"
                        value="{{ old('tarif_kwh') }}" required>
                    @error('tarif_kwh')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Create
                </button>
            </form>
        </div>
    </div>
</x-app-layout> --}}
