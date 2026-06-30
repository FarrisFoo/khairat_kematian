<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Ahli - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
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
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 py-4 px-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Laporan Ahli</h2>
                <a href="{{ route('laporan.index') }}" class="bg-white text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-50 transition duration-150">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <!-- Daily Chart -->
                <div class="mb-12">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pendaftaran Harian</h3>
                    <div class="chart-container">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>

                <!-- Monthly Chart -->
                <div class="mb-12">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pendaftaran Bulanan</h3>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

                <!-- Yearly Chart -->
                <div class="mb-12">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pendaftaran Tahunan</h3>
                    <div class="chart-container">
                        <canvas id="yearlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Daily Chart
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        const dailyChart = new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailyData->pluck('date')) !!},
                datasets: [{
                    label: 'Pendaftaran Harian',
                    data: {!! json_encode($dailyData->pluck('total')) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyLabels = {!! json_encode($monthlyData->map(function($item) {
            return \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
        })) !!};

        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Pendaftaran Bulanan',
                    data: {!! json_encode($monthlyData->pluck('total')) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Yearly Chart
        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        const yearlyChart = new Chart(yearlyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($yearlyData->pluck('year')) !!},
                datasets: [{
                    label: 'Pendaftaran Tahunan',
                    data: {!! json_encode($yearlyData->pluck('total')) !!},
                    backgroundColor: 'rgba(139, 92, 246, 0.2)',
                    borderColor: 'rgba(139, 92, 246, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
