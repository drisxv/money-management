<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengeluaran - Manajemen Keuangan</title>
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
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Tambah Pengeluaran</h1>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">

            <form action="#" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input id="nama" name="nama" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500" placeholder="Nama">
                </div>

                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 text-lg">Rp</span>
                        <input
                            type="text"
                            id="jumlah"
                            name="jumlah"
                            placeholder="0"
                            class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 pl-12 pr-4 text-gray-900 text-lg font-semibold focus:border-green-500 focus:ring-green-500">
                    </div>
                </div>

                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="kategori" name="kategori" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500">
                        <option value="">Pilih kategori</option>
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="transportasi">Transportasi</option>
                        <option value="tagihan">Tagihan</option>
                        <option value="belanja">Belanja</option>
                        <option value="hiburan">Hiburan</option>
                        <option value="kesehatan">Kesehatan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500" placeholder="Contoh: Makan siang di warung..."></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>

            </form>

        </main>
    </div>

    <!-- Script format angka -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById("jumlah");

            input.addEventListener("input", function() {
                let value = this.value.replace(/[^0-9]/g, "");
                if (value) {
                    this.value = new Intl.NumberFormat("id-ID").format(value);
                } else {
                    this.value = "";
                }
            });
        });
    </script>

</body>

</html>