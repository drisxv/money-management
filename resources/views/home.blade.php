<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="lg:flex lg:gap-8">

            <div class="lg:w-2/3">
                <header class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Selamat datang,</p>
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $user->nama }}</h1>
                    </div>
                    <div class="w-14 h-14 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                        <a href="{{ route('profile') }}">
                            <img src="/user.png" alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                        </a>
                    </div>
                </header>

                <div class="bg-white rounded-2xl shadow-lg p-5">
                    <h2 class="text-lg font-semibold text-gray-900">Cash Flow</h2>
                    <p class="text-gray-500 text-sm mt-1">Bulan Ini</p>

                    <div class="text-3xl font-bold mt-2 text-gray-900">
                        Rp{{ number_format($totalCashFlow ?? 0, 0, ',', '.') }}
                    </div>

                    <div class="flex justify-between text-sm mb-1 text-gray-800">
                        <span>Pemasukan</span>
                        <span>Rp{{ number_format($uangMasuk ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-3 overflow-hidden">
                        <div
                            class="bg-emerald-500 h-3 rounded-full transition-all duration-700"
                            style="width: {{ $persenMasuk ?? 0 }}%">
                        </div>
                    </div>

                    <div class="flex justify-between text-sm mb-1 text-gray-800">
                        <span>Pengeluaran</span>
                        <span>Rp{{ number_format($uangKeluar ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-3 overflow-hidden">
                        <div
                            class="bg-red-500 h-3 rounded-full transition-all duration-700"
                            style="width: {{ $persenKeluar ?? 0 }}%">
                        </div>
                    </div>

                    <div class="flex justify-center gap-3 text-xs mt-3 text-gray-600">
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 bg-emerald-500 inline-block rounded-sm"></span>
                            Pemasukan
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 bg-red-500 inline-block rounded-sm"></span>
                            Pengeluaran
                        </span>
                    </div>
                </div>

                <div class="mt-8 bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Alokasi Dana</h2>
                    <p class="text-gray-500 text-sm -mt-2 mb-5">Berdasarkan sisa cash flow bulan ini</p>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-blue-600">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Living</p>
                                <p class="text-xs text-gray-500">Alokasi 50%</p>
                            </div>
                            <p class="font-bold text-blue-600 text-right ml-2">Rp{{ number_format(($totalCashFlow ?? 0) * 0.50, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-purple-600">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" x2="21" y1="6" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Playing</p>
                                <p class="text-xs text-gray-500">Alokasi 30%</p>
                            </div>
                            <p class="font-bold text-purple-600 text-right ml-2">Rp{{ number_format(($totalCashFlow ?? 0) * 0.30, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-green-600">
                                    <rect width="20" height="12" x="2" y="6" rx="2"></rect>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M6 12h.01M18 12h.01"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-800">Saving</p>
                                <p class="text-xs text-gray-500">Alokasi 20%</p>
                            </div>
                            <p class="font-bold text-green-600 text-right ml-2">Rp{{ number_format(($totalCashFlow ?? 0) * 0.20, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="mb-8 bg-white rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Atur Keuangan</h2>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <a href="{{ route('tambah-pengeluaran') }}" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="m16 12-4-4-4 4"></path>
                                <path d="M12 16V8"></path>
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Pengeluaran</span>
                        </a>
                        <a href="{{ route('tambah-pemasukan') }}" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="m8 12 4 4 4-4"></path>
                                <path d="M12 8v8"></path>
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Pemasukan</span>
                        </a>
                        <a href="{{ route('riwayat') }}" class="flex flex-col items-center space-y-2 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-green-600">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M12 7v5l4 2" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-800">Riwayat</span>
                        </a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm sticky top-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-900">Pengeluaran Terbaru</h2>
                        <a href="#" class="text-sm font-semibold text-green-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
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