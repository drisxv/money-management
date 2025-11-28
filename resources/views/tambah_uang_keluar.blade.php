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

            <form action="{{ route('uang-keluar.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="force" id="force-input" value="0">

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <input id="deskripsi" name="deskripsi" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500" placeholder="Contoh: Makan siang">
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
                    <label for="sub_kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Sub Kategori</label>
                    @php
                        $subKategoris = \App\Models\SubKategori::with('kategori')->get();
                    @endphp
                    <select id="sub_kategori_id" name="sub_kategori_id" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500">
                        <option value="">Pilih sub kategori</option>
                        @foreach ($subKategoris as $sk)
                            <option value="{{ $sk->id }}">{{ $sk->kategori->nama ?? '—' }} — {{ $sk->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3" class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 text-gray-900 focus:border-green-500 focus:ring-green-500" placeholder="Contoh: Makan siang di warung..."></textarea>
                </div>

                <div id="alokasi-preview" class="hidden p-4 rounded-lg border mt-2">
                    <p id="alokasi-text" class="text-sm text-gray-700">Alokasi: <span class="font-semibold">-</span></p>
                    <p id="sisa-text" class="text-sm text-gray-700">Sisa setelah pengeluaran: <span class="font-semibold">-</span></p>
                    <p id="hint-text" class="text-sm mt-2"></p>
                </div>

                <div class="pt-4">
                    <button id="submit-btn" type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>

            </form>

        </main>
    </div>

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
                triggerPreview();
            });

            const subSelect = document.getElementById('sub_kategori_id');
            const previewBox = document.getElementById('alokasi-preview');
            const alokasiText = document.getElementById('alokasi-text');
            const sisaText = document.getElementById('sisa-text');
            const hintText = document.getElementById('hint-text');
            const submitBtn = document.getElementById('submit-btn');
            const form = document.querySelector('form');
            const forceInput = document.getElementById('force-input');

            window.needsConfirm = false;
            window.forceConfirmed = false;

            window.showConfirmModal = function(message) {
                const modal = document.getElementById('confirm-modal');
                const overlay = document.getElementById('modal-overlay');
                const modalMsg = document.getElementById('modal-message');
                if (modalMsg) modalMsg.textContent = message;
                if (modal) modal.classList.remove('hidden');
                if (overlay) overlay.classList.remove('hidden');
            }

            window.hideConfirmModal = function() {
                const modal = document.getElementById('confirm-modal');
                const overlay = document.getElementById('modal-overlay');
                if (modal) modal.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
            }

            // Intercept submit to require confirmation when needed
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (window.needsConfirm && !window.forceConfirmed) {
                        e.preventDefault();
                        window.showConfirmModal('Sisa alokasi untuk kategori ini kurang dari 0. Apakah Anda yakin ingin melanjutkan?');
                    }
                });
            }

            subSelect.addEventListener('change', function() {
                triggerPreview();
            });

            function getRawJumlah() {
                const v = input.value || '';
                return v.replace(/\./g, '').replace(/\s/g, '');
            }

            let previewTimeout = null;
            function triggerPreview() {
                if (previewTimeout) clearTimeout(previewTimeout);
                previewTimeout = setTimeout(fetchPreview, 300);
            }

            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 2 }).format(amount);
            }

            function fetchPreview() {
                const subId = subSelect.value;
                const jumlah = getRawJumlah();
                if (!subId || !jumlah) {
                    previewBox.classList.add('hidden');
                    submitBtn.disabled = false;
                    hintText.textContent = '';
                    return;
                }

                const params = new URLSearchParams({ sub_kategori_id: subId, jumlah: jumlah });

                fetch(`{{ route('uang-keluar.preview') }}?` + params.toString(), { credentials: 'same-origin' })
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            previewBox.classList.remove('hidden');
                            alokasiText.querySelector('span').textContent = '-';
                            sisaText.querySelector('span').textContent = '-';
                            hintText.textContent = data.error;
                            submitBtn.disabled = true;
                            return;
                        }

                        previewBox.classList.remove('hidden');
                        alokasiText.querySelector('span').textContent = formatRupiah(data.allocation);
                        sisaText.querySelector('span').textContent = formatRupiah(data.remaining);
                        if (typeof data.remaining !== 'undefined' && data.remaining < 0) {
                            hintText.textContent = 'Saldo alokasi tidak mencukupi.';
                            // require confirmation to proceed; leave submit enabled so user can click and confirm
                            window.needsConfirm = true;
                            window.forceConfirmed = false;
                            if (forceInput) forceInput.value = '0';
                            submitBtn.disabled = false;
                        } else if (!data.ok) {
                            hintText.textContent = 'Saldo alokasi tidak mencukupi.';
                            window.needsConfirm = false;
                            if (forceInput) forceInput.value = '0';
                            submitBtn.disabled = true;
                        } else {
                            hintText.textContent = 'Pengeluaran dapat dilakukan. Sisa setelah pengeluaran akan terlihat di atas.';
                            window.needsConfirm = false;
                            window.forceConfirmed = false;
                            if (forceInput) forceInput.value = '0';
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(err => {
                        previewBox.classList.remove('hidden');
                        hintText.textContent = 'Gagal mengambil data alokasi.';
                        submitBtn.disabled = false;
                    });
            }
        });
    </script>

    <!-- Modal overlay -->
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

    <!-- Confirmation Modal -->
    <div id="confirm-modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Peringatan</h3>
            </div>
            <div class="p-4">
                <p id="modal-message" class="text-sm text-gray-700">Sisa alokasi tidak mencukupi. Apakah Anda yakin ingin melanjutkan?</p>
            </div>
            <div class="p-4 border-t flex justify-end space-x-2">
                <button id="modal-cancel" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Batal</button>
                <button id="modal-confirm" class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded">Konfirmasi</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelBtn = document.getElementById('modal-cancel');
            const confirmBtn = document.getElementById('modal-confirm');
            const overlay = document.getElementById('modal-overlay');
            const modal = document.getElementById('confirm-modal');
            if (cancelBtn) cancelBtn.addEventListener('click', function() {
                window.hideConfirmModal();
            });
            if (overlay) overlay.addEventListener('click', function() {
                window.hideConfirmModal();
            });
            if (confirmBtn) confirmBtn.addEventListener('click', function() {
                // set force flag and submit
                const forceInputEl = document.getElementById('force-input');
                if (forceInputEl) forceInputEl.value = '1';
                window.forceConfirmed = true;
                window.hideConfirmModal();
                const frm = document.querySelector('form');
                if (frm) frm.submit();
            });
        });
    </script>

</body>

</html>