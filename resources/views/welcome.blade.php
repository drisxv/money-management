<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Manajemen Keuangan - Gaya GoPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="lg:flex lg:gap-8">

            <div class="lg:w-2/3">
                <!-- Header -->
                <header class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Selamat datang,</p>
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Pengguna Setia</h1>
                    </div>
                    <div class="w-14 h-14 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                        <img src="https://placehold.co/100x100/e2e8f0/334155?text=P" alt="Foto Profil" class="w-full h-full object-cover">
                    </div>
                </header>

                <!-- Kartu Saldo -->
                <div class="bg-green-600 text-white p-6 rounded-2xl shadow-lg mb-8 transform hover:scale-105 transition-transform duration-300">
                    <p class="text-sm font-medium opacity-80">Sisa Uang Anda</p>
                    <p class="text-4xl lg:text-5xl font-extrabold tracking-tighter mt-1">Rp1.284.500</p>
                    <div class="mt-4 h-1 bg-white bg-opacity-30 rounded-full"></div>
                    <p class="text-xs mt-3 opacity-80">Harap Berhati - hati</p>
                </div>

                <!-- Menu Layanan -->
                <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Layanan Kami</h2>
                    <!-- Menu Layanan Terpadu -->
                    <div class="grid grid-cols-4 gap-4 text-center">
                        <!-- Tombol Bayar -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                                <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                                <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                                <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                                <line x1="7" x2="17" y1="12" y2="12" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">PEngeluaran</span>
                        </a>
                        <!-- Tombol Isi Saldo -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="16" />
                                <line x1="8" x2="16" y1="12" y2="12" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Pemasukan</span>
                        </a>
                        <!-- Tombol Kirim -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Kirim</span>
                        </a>
                        <!-- Tombol Riwayat -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M12 7v5l4 2" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Riwayat</span>
                        </a>
                        <!-- Tombol Tagihan -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Tagihan</span>
                        </a>
                        <!-- Tombol Profil -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="4" />
                                <path d="M12 21.7C17.3 21.7 19.8 19 19.8 19c-.2-2.3-2.5-4-7.8-4s-7.6 1.7-7.8 4c0 0 2.5 2.7 7.8 2.7z" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Profil</span>
                        </a>
                        <!-- Tombol Bantuan -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                <path d="M12 17h.01" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Bantuan</span>
                        </a>
                        <!-- Tombol Lainnya -->
                        <a href="#" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <rect width="7" height="7" x="3" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="3" rx="1" />
                                <rect width="7" height="7" x="14" y="14" rx="1" />
                                <rect width="7" height="7" x="3" y="14" rx="1" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Lainnya</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pengeluaran Terbaru -->
            <!-- mt-8 untuk margin di mobile, lg:mt-0 untuk reset di PC -->
            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white p-6 rounded-2xl shadow-sm sticky top-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-900">Pengeluaran Terbaru</h2>
                        <a href="#" class="text-sm font-semibold text-green-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        <!-- Item Transaksi 1: Pengeluaran -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m16 12-4-4-4 4" />
                                    <path d="M12 16V8" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Kopi Kenangan</p>
                                <p class="text-xs text-gray-500">Hari ini, 08:15</p>
                            </div>
                            <p class="font-bold text-red-600 text-right ml-2">-Rp25.000</p>
                        </div>

                        <!-- Item Transaksi 2: Pengeluaran -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m16 12-4-4-4 4" />
                                    <path d="M12 16V8" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Bayar Listrik</p>
                                <p class="text-xs text-gray-500">Kemarin, 10:00</p>
                            </div>
                            <p class="font-bold text-red-600 text-right ml-2">-Rp152.000</p>
                        </div>

                        <!-- Item Transaksi 3: Pengeluaran -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m16 12-4-4-4 4" />
                                    <path d="M12 16V8" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Makan Siang</p>
                                <p class="text-xs text-gray-500">Kemarin, 12:30</p>
                            </div>
                            <p class="font-bold text-red-600 text-right ml-2">-Rp35.000</p>
                        </div>

                        <!-- Item Transaksi 4: Pengeluaran -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m16 12-4-4-4 4" />
                                    <path d="M12 16V8" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Transportasi Online</p>
                                <p class="text-xs text-gray-500">2 hari lalu, 18:45</p>
                            </div>
                            <p class="font-bold text-red-600 text-right ml-2">-Rp18.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>