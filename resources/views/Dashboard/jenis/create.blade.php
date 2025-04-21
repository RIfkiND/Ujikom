<!-- filepath: d:\ujikom\ujikom_rifki\resources\views\Dashboard\jenis\create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Jenis Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('jenis.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Name:</label>
                    <input type="text" id="name" name="name" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="description" class="block text-gray-700 font-medium">Description:</label>
                    <textarea id="description" name="description" class="form-input w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div>
                    <label for="type" class="block text-gray-700 font-medium">Type:</label>
                    <select id="type" name="type" class="form-select w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="normal">Normal</option>
                        <option value="subsidi">Subsidi</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
