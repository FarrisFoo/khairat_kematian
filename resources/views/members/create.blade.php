<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ahli - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .input-bottom-border {
            border: none;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 0;
            padding-left: 0;
            padding-right: 0;
        }
        .input-bottom-border:focus {
            outline: none;
            border-bottom-color: #3b82f6;
            box-shadow: none;
        }
        .form-section {
            margin-bottom: 2rem;
        }
        .form-title {
            font-weight: bold;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        .form-full-width {
            grid-column: span 2;
        }
        .waris-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        .waris-table th, .waris-table td {
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
            text-align: left;
        }
        .waris-table th {
            background-color: #f8fafc;
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
            <div class="bg-gray-600 py-4 px-6">
                <h2 class="text-xl font-semibold text-white">Borang Permohonan Menjadi Ahli</h2>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('members.store') }}" class="p-6">
                @csrf

                <!-- Maklumat Pemohon Section -->
                <div class="form-section">
                    <h3 class="form-title">MAKLUMAT PEMOHON</h3>
                    <div class="form-grid">
                        <div class="mb-4">
                            <label for="member_name" class="block text-sm font-medium text-gray-700">NAMA</label>
                            <input type="text" id="member_name" name="member_name"
                                   class="w-full py-2 input-bottom-border" required>
                        </div>
                        <div class="mb-4">
                            <label for="ic_number" class="block text-sm font-medium text-gray-700">NO. K/PENGENALAN</label>
                            <input type="text" id="ic_number" name="ic_number"
                                   class="w-full py-2 input-bottom-border">
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">ALAMAT</label>
                            <textarea id="address" name="address" rows="3"
                                      class="w-full py-2 input-bottom-border" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">NO. TELEFON</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full py-2 input-bottom-border" required>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Waris Section -->
                <div class="form-section">
                    <h3 class="form-title">MAKLUMAT WARIS</h3>

                    <table class="waris-table">
                        <thead>
                            <tr>
                                <th>HUBUNGAN</th>
                                <th>NAMA</th>
                                <th>NO. K/P</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Spouse -->
                            <tr>
                                <td>Suami/Isteri</td>
                                <td><input type="text" name="waris_name" class="w-full py-1 px-2 input-bottom-border" required></td>
                                <td><input type="text" name="waris_ic" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                            <!-- Children (5 rows) -->
                            @for($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>Anak</td>
                                <td><input type="text" name="children_name[]" class="w-full py-1 px-2 input-bottom-border"></td>
                                <td><input type="text" name="children_ic[]" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                            @endfor
                            <!-- Parents and in-laws -->
                            <tr>
                                <td>Ibu</td>
                                <td><input type="text" name="mother_name" class="w-full py-1 px-2 input-bottom-border"></td>
                                <td><input type="text" name="mother_ic" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                            <tr>
                                <td>Bapa</td>
                                <td><input type="text" name="father_name" class="w-full py-1 px-2 input-bottom-border"></td>
                                <td><input type="text" name="father_ic" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                            <tr>
                                <td>Ibu Mertua</td>
                                <td><input type="text" name="mother_in_law_name" class="w-full py-1 px-2 input-bottom-border"></td>
                                <td><input type="text" name="mother_in_law_ic" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                            <tr>
                                <td>Bapa Mertua</td>
                                <td><input type="text" name="father_in_law_name" class="w-full py-1 px-2 input-bottom-border"></td>
                                <td><input type="text" name="father_in_law_ic" class="w-full py-1 px-2 input-bottom-border"></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-sm text-gray-500 mt-2">*(Sila gunakan lampiran jika ruang tidak mencukupi!)*</p>
                </div>

                <!-- Additional Information -->
                <div class="form-section">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">EMAIL</label>
                        <input type="email" id="email" name="email"
                               class="w-full py-2 input-bottom-border" required>
                    </div>
                </div>

                <!-- Declaration -->
                <div class="form-section border-t pt-4 mt-6">
                    <h3 class="form-title">PENGAKUAN PEMOHON</h3>
                    <p class="mb-4 text-sm">
                        Saya mengakui segala maklumat yang diberikan di atas adalah benar.<br>
                        Saya dengan ini bersetuju, menjadi ahli Pertubuhan Khairat Kematian Taman Sri Saujana, Kota Tinggi dan akan patuh dengan Undang-undang Kecilnya.
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        Hantar Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
