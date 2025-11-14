<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat - Manajemen Keuangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-lg mx-auto bg-white min-h-screen lg:min-h-0 lg:max-w-5xl lg:mt-12 lg:rounded-xl lg:shadow-xl lg:overflow-hidden">

        <header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b lg:border-gray-200">
            <div class="p-4 lg:p-6 flex items-center">
                <a href="{{ url()->previous() }}" class="p-2 mr-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-800">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Riwayat</h1>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <div class="space-y-6">

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-3 px-1">Hari Ini - 11 November 2025</h3>
                    <div class="space-y-2">

                        <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="19" x2="12" y2="5"></line>
                                    <polyline points="5 12 12 5 19 12"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <span class="font-semibold text-gray-800">Gaji Bulanan</span>
                                <span class="block text-sm text-gray-500">09:00 WIB - Transfer Bank</span>
                            </div>
                            <span class="font-semibold text-green-600">+ Rp 5.000.000</span>
                        </a>

                        <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <span class="font-semibold text-gray-800">Makan Siang</span>
                                <span class="block text-sm text-gray-500">12:30 WIB - Tunai</span>
                            </div>
                            <span class="font-semibold text-red-600">- Rp 25.000</span>
                        </a>

                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-3 px-1">Kemarin - 10 November 2025</h3>
                    <div class="space-y-2">

                        <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <span class="font-semibold text-gray-800">Makan Siang</span>
                                <span class="block text-sm text-gray-500">12:30 WIB - Tunai</span>
                            </div>
                            <span class="font-semibold text-red-600">- Rp 25.000</span>
                        </a>

                        <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <span class="font-semibold text-gray-800">Makan Siang</span>
                                <span class="block text-sm text-gray-500">12:30 WIB - Tunai</span>
                            </div>
                            <span class="font-semibold text-red-600">- Rp 25.000</span>
                        </a>

                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>