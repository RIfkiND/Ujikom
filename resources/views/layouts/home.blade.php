<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App | @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css') {{-- If you're using Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">Water Billing App</h1>
            <div>
                <a href="/" class="text-gray-700 hover:text-blue-600 px-3">Home</a>
                <a href="{{ route('pelanggan.index') }}" class="text-gray-700 hover:text-blue-600 px-3">Cek Pemakaian</a>
                <!-- Add more nav links here -->
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Water Billing System. All rights reserved.
        </div>
    </footer>
</body>
</html>
