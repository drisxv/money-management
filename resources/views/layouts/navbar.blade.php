<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 min-h-screen">
    <nav class="hidden lg:block lg:w-64 bg-white shadow-lg fixed top-0 left-0 h-full p-4 z-30">
        <div class="flex flex-col h-full">
            <header class="flex flex-col items-center justify-center mb-10 mt-4">
                <div class="w-20 h-20 bg-gray-200 rounded-full overflow-hidden mb-3">
                    <a href="{{ route('profile') }}">
                        <img src="/user.png" alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                    </a>
                </div>
                <p class="text-sm text-gray-500">Selamat datang,</p>
            </header>

            <ul class="space-y-2 flex-grow">
                <li>
                    <a href="{{ route('home') }}" class="flex items-center p-3 text-base font-semibold text-white bg-green-600 rounded-xl shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('riwayat') }}" class="flex items-center p-3 text-base font-semibold text-gray-700 hover:bg-green-50 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12a9 9 0 1 0 9-9" />
                            <path d="M3 3v5h5" />
                            <path d="M12 7v5l4 2" />
                        </svg>
                        <span>Riwayat</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile') }}" class="flex items-center p-3 text-base font-semibold text-gray-700 hover:bg-green-50 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span>Akun</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="mx-auto sm:p-6 lg:p-8 lg:ml-64 pb-24 lg:pb-8">
        @yield('content')
    </main>
    @stack('scripts')

</body>

</html>