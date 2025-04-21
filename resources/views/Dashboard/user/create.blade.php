<!-- filepath: d:\ujikom\ujikom_rifki\resources\views\Dashboard\user\create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-md rounded-md">
            <h1 class="text-2xl font-bold mb-6 text-black">
                Create User
            </h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black mb-1">Name</label>
                    <input type="text" name="name" id="name"
                        class="form-input w-full border-gray-300 text-black @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-black mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-input w-full border-gray-300 text-black @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Field -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-black mb-1">Role</label>
                    <select name="role" id="role"
                        class="form-select w-full border-gray-300 text-black @error('role') border-red-500 @enderror" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-black mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-input w-full border-gray-300 text-black @error('password') border-red-500 @enderror" required>
                    @error('password')
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
