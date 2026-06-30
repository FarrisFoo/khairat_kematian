<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaedah Pembayaran - Sistem Khairat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .payment-icon {
            width: 100px;
            height: 100px;
            object-fit: contain;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .payment-icon:hover {
            transform: scale(1.1);
        }
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
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
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
                <a href="{{ route('payment-methods') }}" class="px-3 py-2 bg-gray-400 rounded-md whitespace-nowrap">Pembayaran Yuran</a>
                <a href="{{ route('tuntutan.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Permohonan Tuntutan</a>
                <a href="{{ route('members.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Pengurusan Maklumat Ahli</a>
                <a href="{{ route('notifications.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Notifikasi dan Pengumuman</a>
                <a href="{{ route('laporan.index') }}" class="px-3 py-2 hover:bg-gray-400 rounded-md whitespace-nowrap">Laporan dan Analisis</a>
                <a href="{{ route('logout') }}" class="px-3 py-2 hover:bg-red-400 rounded-md whitespace-nowrap">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Payment Methods Content -->
    <div class="flex items-center justify-center min-h-[calc(100vh-8rem)] py-8">
        <div class="w-full max-w-4xl mx-4 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-600 py-4 px-6">
                <h2 class="text-xl font-semibold text-white">Kaedah Pembayaran</h2>
            </div>

            <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="text-center mb-8">
                    <h3 class="text-lg font-semibold text-gray-700">Sila pilih kaedah pembayaran anda</h3>
                </div>

                <!-- Payment Method Selection -->
                <div class="mb-8">
                    <center><label class="block text-gray-700 text-sm font-bold mb-2">Kaedah Pembayaran</label></center>
                    <div class="flex flex-wrap justify-center gap-12">
                        <!-- QR Code Payment -->
                        <div class="text-center">
                            <label>
                                <input type="radio" name="kaedah_bayaran" value="QR" class="hidden" required>
                                <img src="{{ asset('images/qr-icon.png') }}" alt="QR Code Payment" class="payment-icon cursor-pointer">
                                <p class="mt-2 font-medium">QR Code</p>
                            </label>
                        </div>

                        <!-- FPX Payment -->
                        <div class="text-center">
                            <label>
                                <input type="radio" name="kaedah_bayaran" value="FPX" class="hidden">
                                <img src="{{ asset('images/fpx-icon.png') }}" alt="FPX Payment" class="payment-icon cursor-pointer">
                                <p class="mt-2 font-medium">FPX</p>
                            </label>
                        </div>

                        <!-- Debit Card -->
                        <div class="text-center">
                            <label>
                                <input type="radio" name="kaedah_bayaran" value="Debit" class="hidden">
                                <img src="{{ asset('images/debit-card-icon.png') }}" alt="Debit Card" class="payment-icon cursor-pointer">
                                <p class="mt-2 font-medium">Kad Debit</p>
                            </label>
                        </div>
                    </div>
                    @error('kaedah_bayaran')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Jumlah Dana Input -->
                <div class="mb-8">
                    <label for="jumlah_dana" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Dana (RM)</label>
                    <input type="number" id="jumlah_dana" name="jumlah" placeholder="Masukkan jumlah"
                           class="w-full py-2 px-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           step="0.01" min="0" required>
                </div>

                <!-- Add this below Jumlah Dana input -->
                <div class="mb-8">
                    <label for="nama_ahli" class="block text-gray-700 text-sm font-bold mb-2">Nama Ahli</label>
                    <input type="text" id="nama_ahli" name="nama_ahli" placeholder="Masukkan nama penuh"
                        class="w-full py-2 px-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Receipt Upload Section -->
                <div class="mt-6 border-t pt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Muat Naik Resit Pembayaran</h4>
                    <div class="mb-4">
                        <label for="resit" class="block text-gray-700 text-sm font-bold mb-2">Resit Pembayaran (Gambar)</label>
                        <input type="file" id="resit" name="resit" accept="image/*"
                               class="w-full py-2 px-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <div class="mt-2">
                            <img id="receipt_preview" src="#" alt="Preview Resit" class="preview-image"/>
                        </div>
                        @error('resit')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        Hantar Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar Menggunakan QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/actual-qr-code.png') }}" alt="Payment QR Code" class="img-fluid mb-4">
                    <p class="text-gray-600">Scan QR code ini untuk membuat pembayaran</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FPX Modal -->
    <div class="modal fade" id="fpxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar Menggunakan FPX</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan diarahkan ke portal pembayaran FPX.</p>
                    <div class="mt-4">
                        <label class="block text-gray-700 mb-2">Pilih Bank:</label>
                        <select class="w-full p-2 border rounded">
                            <option>Maybank</option>
                            <option>CIMB</option>
                            <option>Public Bank</option>
                            <option>RHB</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Teruskan ke FPX</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Debit Card Modal -->
    <div class="modal fade" id="debitCardModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar Menggunakan Kad Debit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-2">Nombor Kad:</label>
                        <input type="text" class="w-full p-2 border rounded" placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Tarikh Luput:</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="MM/YY">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">CVV:</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="123">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS for modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('resit').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('receipt_preview');
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(file);
            }
        });

        // Highlight selected payment method
        document.querySelectorAll('input[name="kaedah_bayaran"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.payment-icon').forEach(icon => {
                    icon.style.transform = 'scale(1)';
                    icon.style.filter = 'grayscale(100%) opacity(70%)';
                });
                if (this.checked) {
                    const img = this.closest('label').querySelector('.payment-icon');
                    img.style.transform = 'scale(1.1)';
                    img.style.filter = 'none';
                }
            });
        });
    </script>
</body>
</html>
