<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - Manajemen Keuangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-lg mx-auto bg-white min-h-screen lg:min-h-0 lg:max-w-5xl lg:mt-12 lg:rounded-xl lg:shadow-xl lg:overflow-hidden">

        <header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b lg:border-gray-200">
            <div class="p-4 lg:p-6 flex items-center">
                <a href="{{ url()->previous() }}" class="p-2 mr-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-800">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Manajemen Keuangan</h1>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">

            <div class="mb-8 space-y-2">
                <div class="flex justify-between items-center mb-2 px-4">
                    <h3 class="text-sm font-semibold text-gray-500">Presentase</h3>
                </div>

                <div class="space-y-3">
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center">
                            <span class="p-2 bg-green-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-700">
                                    <path d="M12 2.02c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12.02S6.477 2.02 12 2.02z"></path>
                                    <path d="M12 6v6l3 3"></path>
                                </svg>
                            </span>
                            <div>
                                <span class="font-semibold text-gray-900">Gaji</span>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pemasukan</span>
                            </div>
                        </div>
                        <div class="flex space-x-1">
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center">
                            <span class="p-2 bg-red-100 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-700">
                                    <path d="M12 2.02c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12.02S6.477 2.02 12 2.02z"></path>
                                    <path d="M12 6v6l3 3"></path>
                                </svg>
                            </span>
                            <div>
                                <span class="font-semibold text-gray-900">Makanan & Minuman</span>
                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pengeluaran</span>
                            </div>
                        </div>
                        <div class="flex space-x-1">
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-2 border-t-4 border-gray-300">
            <div class=" space-y-2">
                <div class="flex justify-between items-center mb-2 px-4">
                    <h3 class="text-sm font-semibold text-gray-500">Kategori</h3>
                    <button class="inline-flex items-center justify-center rounded-lg border border-transparent bg-green-600 px-3 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1 -ml-1">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                        <div>
                            <span class="font-semibold text-gray-900">Restoran</span>
                            <p class="text-sm text-gray-500">Induk: Makanan & Minuman</p>
                        </div>
                        <div class="flex space-x-1">
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                        <div>
                            <span class="font-semibold text-gray-900">Kafe</span>
                            <p class="text-sm text-gray-500">Induk: Makanan & Minuman</p>
                        </div>
                        <div class="flex space-x-1">
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>

</html>