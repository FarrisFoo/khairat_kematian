<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Ahli - Sistem Khairat</title>
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
                <h2 class="text-xl font-semibold text-white">Maklumat Ahli</h2>
                <a href="{{ route('members.index') }}" class="bg-white text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-50 transition duration-150">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Maklumat Peribadi</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Nama Ahli</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->member_name }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Nama Waris</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->waris_name }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->email }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">No Telefon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->phone }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Maklumat Tambahan</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Status Pengesahan</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->verification_status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $member->verification_status ? 'Telah Sah' : 'Belum Sah' }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Daftar</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Kemaskini</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $member->updated_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Full Width Address -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Alamat</h3>
                        <div class="mt-4 p-4 bg-gray-50 rounded-md">
                            <p class="text-sm text-gray-900 whitespace-pre-line">{{ $member->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sahkan Keahlian Button -->
                @if(!$member->verification_status && auth()->user()->user_type == 2)
                <div class="mt-8 flex justify-end">
                    <form method="POST" action="{{ route('members.verify', $member->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150">
                            <i class="fas fa-check-circle mr-2"></i> Sahkan Keahlian
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
