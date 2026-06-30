<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Baru - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .input-bottom-border {
            border: none;
            border-bottom: 2px solid #e2e8f0;
            border-radius: 0;
            padding-left: 0;
            padding-right: 0;
        }
        .input-bottom-border:focus {
            outline: none;
            border-bottom-color: #3b82f6;
            box-shadow: none;
        }
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- First Layer Navigation -->
    <div class="bg-white py-4 nav-shadow">
        <div class="flex items-center justify-center space-x-4">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">M</div>
            <h1 class="text-xl font-bold text-gray-800">Sistem web khairat kematian Masjid Taman Sri Saujana</h1>
        </div>
    </div>

    <!-- Second Layer Navigation -->
    <nav class="bg-white text-black py-3 nav-shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between space-x-2 overflow-x-auto">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Utama</a>
                <a href="{{ route('members.create') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Pendaftaran Ahli</a>
                <a href="{{ route('payment-methods') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Pembayaran Yuran</a>
                <a href="{{ route('tuntutan.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Permohonan Tuntutan</a>
                <a href="{{ route('members.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Pengurusan Maklumat Ahli</a>
                <a href="{{ route('notifications.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Notifikasi dan Pengumuman</a>
                <a href="{{ route('laporan.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Laporan dan Analisis</a>
                <a href="{{ route('logout') }}" class="px-3 py-2 hover:bg-red-400 rounded-md whitespace-nowrap">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex items-center justify-center min-h-[calc(100vh-8rem)] py-8">
        <div class="w-full max-w-4xl mx-4 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 py-4 px-6">
                <h2 class="text-xl font-semibold text-white">Notifikasi dan Pengumuman Baru</h2>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('notifications.store') }}" class="p-6">
                @csrf

                <div class="space-y-6">
                    <!-- Subjek -->
                    <div class="mb-6">
                        <label for="subjek" class="block text-gray-700 text-sm font-bold mb-2">Subjek</label>
                        <input type="text" id="subjek" name="subjek" placeholder="Subjek notifikasi"
                               class="w-full py-2 input-bottom-border focus:border-blue-500 transition duration-150" required>
                    </div>

                    <!-- Penerima -->
                    <div class="mb-6">
                        <label for="penerima" class="block text-gray-700 text-sm font-bold mb-2">Penerima</label>
                        <input type="text" id="penerima" name="penerima" placeholder="Nama penerima"
                               class="w-full py-2 input-bottom-border focus:border-blue-500 transition duration-150" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        Hantar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
