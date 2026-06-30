<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akaun</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sticky Navigation Bar -->
    <nav class="sticky-nav bg-white py-4 px-6">
        <div class="flex justify-end space-x-4">
            <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600">Utama</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600">Servis</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600">Tentang Kami</a>
            <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600">Hubungi Kami</a>
        </div>
    </nav>

    <!-- Two Column Layout -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Left Column - Logo -->
            <div class="w-full md:w-1/2 flex justify-center mb-10 md:mb-0">
                <div class="w-64 h-64 md:w-96 md:h-96 bg-blue-100 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-5xl md:text-7xl font-bold text-blue-600">LOGO</span>
                </div>
            </div>

            <!-- Right Column - Registration Card -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">DAFTAR AKAUN</h2>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Penuh</label>
                            <input type="text" id="name" name="name" placeholder="Nama anda" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Emel</label>
                            <input type="email" id="email" name="email" placeholder="Emel anda" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Kata Laluan</label>
                            <input type="password" id="password" name="password" placeholder="Minimum 8 aksara" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required>
                        </div>
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Masukkan Kembali Kata Laluan</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Masukkan semula kata laluan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required>
                        </div>
                        <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                            DAFTAR
                        </button>
                        <div class="flex items-center mb-4">
                            <label for="terms" class="ml-2 block text-sm text-gray-700 text-center">
                               Dengan mendaftar, anda bersetuju dengan Terma, Syarat dan Dasar Privasi</a>
                            </label>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">Sudah mempunyai akaun? <a href="{{ route('login-page') }}" class="text-blue-600 hover:text-blue-800">Log Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
