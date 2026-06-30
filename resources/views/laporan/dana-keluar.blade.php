<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Dana Masuk - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .chart-container {
            height: 300px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h2 class="text-xl font-semibold text-white">Laporan Dana Keluar (Tuntutan Diluluskan)</h2>
                <a href="{{ route('laporan.index') }}" class="bg-white text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-50 transition duration-150">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-blue-800">Jumlah Tuntutan Diluluskan</h3>
                        <p class="text-2xl font-bold text-blue-600 mt-2">{{ $approvedClaims->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-green-800">Jumlah Dana Keluar</h3>
                        <p class="text-2xl font-bold text-green-600 mt-2">RM {{ number_format($approvedClaims->sum('jumlah_diluluskan'), 2) }}</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-purple-800">Purata Tuntutan</h3>
                        <p class="text-2xl font-bold text-purple-600 mt-2">RM {{ number_format($approvedClaims->avg('jumlah_diluluskan'), 2) }}</p>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Monthly Approved Claims Chart -->
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Tuntutan Diluluskan Bulanan</h3>
                        <div class="chart-container">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>

                    <!-- Yearly Approved Claims Chart -->
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Tuntutan Diluluskan Tahunan</h3>
                        <div class="chart-container">
                            <canvas id="yearlyChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Approved Claims Table -->
                <div class="overflow-x-auto">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Senarai Tuntutan Diluluskan</h3>
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ahli</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tuntutan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Diluluskan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarikh Diluluskan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($approvedClaims as $index => $claim)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $claim->nama_ahli }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $claim->nama_tuntutan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">RM {{ number_format($claim->jumlah_diluluskan, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $claim->updated_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $approvedClaims->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyData->pluck('month_year')) !!},
                datasets: [{
                    label: 'Jumlah Diluluskan (RM)',
                    data: {!! json_encode($monthlyData->pluck('total')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'RM ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'RM ' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Yearly Chart
        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        const yearlyChart = new Chart(yearlyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($yearlyData->pluck('year')) !!},
                datasets: [{
                    label: 'Jumlah Diluluskan (RM)',
                    data: {!! json_encode($yearlyData->pluck('total')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'RM ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'RM ' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
