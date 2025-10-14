<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Manajemen Keuangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-lg mx-auto bg-white min-h-screen">
        <!-- Header -->
        <header class="bg-white sticky top-0 z-10 shadow-sm">
            <div class="p-4 flex items-center">
                <a href="index.html" class="p-2 mr-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-800">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-xl font-bold text-gray-900">Profil Saya</h1>
            </div>
        </header>

        <!-- Konten Profil -->
        <main class="p-4 sm:p-6">
            <!-- Info Pengguna -->
            <div class="flex flex-col items-center text-center py-8">
                <div class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden mb-4 ring-4 ring-green-100">
                    <img src="https://placehold.co/100x100/e2e8f0/334155?text=P" alt="Foto Profil" class="w-full h-full object-cover">
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Pengguna Setia</h2>
                <p class="text-sm text-gray-500 mt-1">pengguna.setia@email.com</p>
            </div>

            <!-- Menu Pengaturan -->
            <div class="mt-6 space-y-2">
                <h3 class="px-4 text-sm font-semibold text-gray-500 mb-2">PENGATURAN AKUN</h3>
                <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-green-600 mr-4">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <span class="font-semibold text-gray-800 flex-grow">Ubah Profil</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
                <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-green-600 mr-4">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span class="font-semibold text-gray-800 flex-grow">Keamanan Akun</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            </div>

            <!-- Menu Bantuan -->
            <div class="mt-8 space-y-2">
                <h3 class="px-4 text-sm font-semibold text-gray-500 mb-2">BANTUAN</h3>
                <a href="#" class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-green-600 mr-4">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span class="font-semibold text-gray-800 flex-grow">Pusat Bantuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </a>
            </div>

            <!-- Tombol Keluar -->
            <div class="mt-12">
                <button class="w-full text-left flex items-center p-4 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mr-4">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="font-semibold">Keluar</span>
                </button>
            </div>
        </main>
    </div>

</body>

</html>