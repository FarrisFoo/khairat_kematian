<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan dan Analisis - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .report-icon {
            width: 120px;
            height: 120px;
            object-fit: contain;
            transition: transform 0.3s;
        }
        .report-icon:hover {
            transform: scale(1.1);
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
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Laporan dan Analisis</h2>
            <p class="text-gray-600 mt-2">Sila pilih jenis laporan yang ingin dilihat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Laporan Ahli -->
            <a href="{{ route('laporan.ahli') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/report-member.png') }}" alt="Laporan Ahli" class="report-icon">
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Laporan Ahli</h3>
                <p class="text-gray-600 mt-2">Statistik pendaftaran ahli</p>
            </a>

            <!-- Laporan Dana Masuk -->
            <a href="{{ route('laporan.dana-masuk') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/report-income.png') }}" alt="Laporan Dana Masuk" class="report-icon">
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Laporan Dana Masuk</h3>
                <p class="text-gray-600 mt-2">Statistik dana yang diterima</p>
            </a>

            <!-- Laporan Dana Keluar -->
            <a href="{{ route('laporan.dana-keluar') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/report-expense.png') }}" alt="Laporan Dana Keluar" class="report-icon">
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Laporan Dana Keluar</h3>
                <p class="text-gray-600 mt-2">Statistik dana yang dibelanjakan</p>
            </a>
        </div>
    </div>
</body>
</html>
