<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Tuntutan - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .amount-approved {
            color: #059669;
            font-weight: bold;
        }
        .amount-claimed {
            text-decoration: line-through;
            color: #6b7280;
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
                <a href="{{ route('tuntutan.index') }}" class="px-3 py-2 bg-gray-400 rounded-md whitespace-nowrap">Permohonan Tuntutan</a>
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
                <h2 class="text-xl font-semibold text-white">Maklumat Tuntutan</h2>
                <a href="{{ route('tuntutan.index') }}" class="bg-white text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-50 transition duration-150">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Maklumat Tuntutan</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Nama Ahli</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tuntutan->nama_ahli }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Nama Tuntutan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tuntutan->nama_tuntutan }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Jumlah Dituntut</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        RM {{ number_format($tuntutan->jumlah_dituntut, 2) }}
                                        @if($tuntutan->status == 'diluluskan' && $tuntutan->jumlah_diluluskan != $tuntutan->jumlah_dituntut)
                                            <span class="text-gray-400 text-xs ml-2">(Asal: RM {{ number_format($tuntutan->jumlah_dituntut, 2) }})</span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Status Tuntutan</h3>
                            <dl class="mt-4 space-y-4">
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $tuntutan->status == 'diluluskan' ? 'bg-green-100 text-green-800' :
                                               ($tuntutan->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($tuntutan->status) }}
                                        </span>
                                    </dd>
                                </div>
                                @if($tuntutan->status == 'diluluskan')
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Jumlah Diluluskan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 amount-approved">
                                        RM {{ number_format($tuntutan->jumlah_diluluskan, 2) }}
                                    </dd>
                                </div>
                                @endif
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Mohon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tuntutan->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                <div class="border-b border-gray-100 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Tarikh Kemaskini</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tuntutan->updated_at->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Full Width - Sijil Kematian -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Sijil Kematian</h3>
                        <div class="mt-4 p-4 bg-gray-50 rounded-md">
                            <a href="{{ Storage::url($tuntutan->sijil_kematian_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-file-pdf mr-2"></i> Lihat Sijil Kematian (PDF)
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if(auth()->user()->user_type == 2)
                <div class="mt-8 flex justify-end space-x-4">
                    @if($tuntutan->status != 'diluluskan')
                    <form method="POST" action="{{ route('tuntutan.approve', $tuntutan->id) }}" class="flex items-center space-x-4">
                        @csrf
                        @method('PUT')
                        <div class="w-48">
                            <label for="jumlah_diluluskan" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Diluluskan (RM)</label>
                            <input type="number" id="jumlah_diluluskan" name="jumlah_diluluskan"
                                   value="{{ old('jumlah_diluluskan', $tuntutan->jumlah_dituntut) }}"
                                   step="0.01" min="0" max="{{ $tuntutan->jumlah_dituntut }}"
                                   class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 h-10 self-end">
                            <i class="fas fa-check-circle mr-2"></i> Luluskan
                        </button>
                    </form>
                    @endif

                    @if($tuntutan->status != 'ditolak')
                    <form method="POST" action="{{ route('tuntutan.reject', $tuntutan->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 h-10">
                            <i class="fas fa-times-circle mr-2"></i> Tolak
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
