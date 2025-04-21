<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold text-black mb-6">Form Tambah Pelanggan</h1>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black mb-1">Nama</label>
                    <input type="text" name="name" id="name" class="form-input w-full border-gray-300 text-black"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-black mb-1">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-input w-full border-gray-300 text-black"
                        value="{{ old('alamat') }}" required>
                </div>

                <div class="mb-4">
                    <label for="no_telepon" class="block text-sm font-medium text-black mb-1">No Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-input w-full border-gray-300 text-black"
                        value="{{ old('no_telepon') }}" required>
                </div>

                <div class="mb-6">
                    <label for="jenis_plg" class="block text-sm font-medium text-black mb-1">Jenis Pelanggan</label>
                    <select name="jenis_plg" id="jenis_plg" class="form-select w-full border-gray-300 text-black" required>
                        <option value="" disabled selected>-- Pilih Jenis Pelanggan --</option>
                        @foreach ($tarifs as $tarif)
                            <option value="{{ $tarif->id }}" {{ old('jenis_plg') == $tarif->id ? 'selected' : '' }}>
                                {{ $tarif->jenis_plg }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
