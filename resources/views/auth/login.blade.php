<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

            <!-- Right Column - Login Card -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">LOG MASUK</h2>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Masukkan Emel</label>
                            <input type="email" id="email" name="email" placeholder="Emel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required autofocus>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Masukkan Kata Laluan</label>
                            <input type="password" id="password" name="password" placeholder="Kata Laluan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500" required>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat akaun ini</label>
                            </div>
                            <a href="#" class="text-sm text-blue-600 hover:text-gray-800">Lupa Kata Laluan?</a>
                        </div>
                        <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150">
                            LOG MASUK
                        </button>
                        <div class="flex items-center mb-4">
                            <label for="terms" class="ml-2 block text-sm text-gray-700 text-center">
                               Dengan mendaftar, anda bersetuju dengan Terma, Syarat dan Dasar Privasi</a>
                            </label>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">Tidak mepunyai akaun? <a href="{{ route('register-page') }}" class="text-blue-600 hover:text-blue-800">Daftar sekarang</a></p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
