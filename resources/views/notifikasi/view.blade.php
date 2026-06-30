<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Notifikasi - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 py-4 px-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Maklumat Notifikasi</h2>
                <a href="{{ route('notifications.index') }}" class="bg-white text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-50 transition duration-150">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Maklumat Notifikasi</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Subjek</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $notification->subjek }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Penerima</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $notification->penerima }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Status</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $notification->status == 'dihantar' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($notification->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Hantar</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $notification->created_at }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
