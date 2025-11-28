@extends('layouts.navbar')
@section('content')
<div class="w-full mx-auto bg-white min-h-screen lg:min-h-0 lg:mt-12 lg:rounded-xl lg:shadow-xl lg:overflow-hidden">

    <header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b lg:border-gray-200">
        <div class="p-4 lg:p-6 flex items-center">
            <a href="{{ url('profile') }}" class="p-2 mr-2 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-800">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Manajemen Kategori</h1>
        </div>
    </header>

    <main class="p-4 sm:p-6 lg:p-8">

        <div class="mb-8 space-y-2">
            <div class="flex justify-between items-center mb-2 px-4">
                <h3 class="text-sm lg:text-xl font-semibold text-gray-500">Persentase</h3>
                <div class="flex space-x-1">
                    <button type="button" data-persentase="{{ $kategori->persentase ?? '' }}" class="open-kategori-modal p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($kategoris ?? [] as $kategori)
                <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center">
                        <div>
                            <span class="font-semibold text-xl text-gray-900">{{ $kategori->nama }}</span>
                            @if(!is_null($kategori->persentase))
                            <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $kategori->persentase }}%</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-sm lg:text-xl text-gray-500 px-4">Belum ada kategori.</div>
                @endforelse
            </div>
        </div>

        <hr class="my-2 border-t-4 border-gray-300">
        <div class=" space-y-2">
            <div class="flex justify-between items-center mb-2 px-4">
                <h3 class="text-sm lg:text-xl font-semibold text-gray-500">Kategori</h3>
                <a href="{{ route('subkategori.create') }}" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-green-600 px-3 py-1.5 text-sm lg:text-xl font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1 -ml-1">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah
                </a>
            </div>
            <div class="space-y-3">
                @if(isset($subKategoris) && $subKategoris->count())
                    @foreach($subKategoris as $sub)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:bg-gray-50">
                            <div>
                                <span class="font-semibold text-xl text-gray-900">{{ $sub->nama }}</span>
                                <p class="text-sm lg:text-xl text-gray-500">Dana: {{ $sub->kategori->nama ?? '-' }}</p>
                            </div>
                            <div class="flex space-x-1">
                                <a href="{{ route('subkategori.edit', $sub->id) }}" class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-blue-600" aria-label="Ubah">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <button type="button" data-id="{{ $sub->id }}" data-nama="{{ $sub->nama }}" class="open-delete-sub p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-red-600" aria-label="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                        <path d="M10 11v6"></path>
                                        <path d="M14 11v6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-sm lg:text-xl text-gray-500 px-4">Belum ada sub kategori.</div>
                @endif
            </div>
        </div>

    </main>
</div>

<div id="delete-sub-backdrop" class="hidden fixed inset-0 bg-black/40 z-50"></div>
<div id="delete-sub-modal" class="hidden fixed inset-0 z-60 flex items-center justify-center px-4">
    <div class="w-full md:max-w-md bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Hapus Kategori</h3>
            <button id="delete-sub-close" class="p-2 rounded-full text-gray-400 hover:bg-gray-100" aria-label="Tutup">✕</button>
        </div>
        <form id="delete-sub-form" method="POST" action="#" class="p-6">
            @csrf
            @method('DELETE')
            <p class="text-sm lg:text-xl text-gray-700 mb-4">Apakah Anda yakin ingin menghapus kategori <span id="delete-sub-nama" class="font-semibold"></span> ?</p>
            <div class="flex justify-end space-x-2">
                <button type="button" id="delete-sub-cancel" class="px-4 py-2 rounded-lg text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Hapus</button>
            </div>
        </form>
    </div>
</div>
<div id="kategori-modal-backdrop" class="hidden fixed inset-0 bg-black/40 z-40 transition-opacity duration-300 opacity-0"></div>

<div id="kategori-modal" class="hidden fixed inset-0 z-50 flex items-end md:items-center justify-center px-4 transition-transform duration-300 ease-out transform translate-y-full md:translate-y-0 md:opacity-0">
    <div class="w-full md:max-w-md bg-white rounded-t-xl md:rounded-xl shadow-2xl overflow-hidden transition-all duration-300">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900">Ubah Persentase</h3>
            <button id="kategori-modal-close" class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <form id="kategori-modal-form" method="POST" action="{{ route('kategori.updateMultiple') }}">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-5">
                <p class="text-sm lg:text-xl text-gray-600">Tentukan Alokasi Dana Anda.</p>
                <p class="text-sm lg:text-xl text-gray-600">Perubahan akan dilakukan pada pemasukan berikutnya.</p>

                <div>
                    <label for="pers-1" class="block text-sm lg:text-xl font-medium text-gray-700 mb-1">{{ optional($kategoris->firstWhere('id', 1))->nama }}</label>
                    <input id="pers-1" name="persentase[1]" type="number" min="0" max="100" step="1" placeholder="Masukkan persentase"
                        class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 text-base focus:border-green-500 focus:ring-green-500 transition duration-150" />
                </div>

                <div>
                    <label for="pers-2" class="block text-sm lg:text-xl font-medium text-gray-700 mb-1">{{ optional($kategoris->firstWhere('id', 2))->nama }}</label>
                    <input id="pers-2" name="persentase[2]" type="number" min="0" max="100" step="1" placeholder="Masukkan persentase"
                        class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 text-base focus:border-green-500 focus:ring-green-500 transition duration-150" />
                </div>

                <div>
                    <label for="pers-3" class="block text-sm lg:text-xl font-medium text-gray-700 mb-1">{{ optional($kategoris->firstWhere('id', 3))->nama }}</label>
                    <input id="pers-3" name="persentase[3]" type="number" min="0" max="100" step="1" placeholder="Masukkan persentase"
                        class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 text-base focus:border-green-500 focus:ring-green-500 transition duration-150" />
                </div>
            </div>

            <div class="p-5 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button type="button" id="kategori-modal-cancel"
                    class="px-4 py-2 rounded-lg text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 transition duration-150 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Batal
                </button>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    (function() {
        const batchUrl = "{{ route('kategori.updateMultiple') }}";
        const openButtons = document.querySelectorAll('.open-kategori-modal');
        const modal = document.getElementById('kategori-modal');
        const backdrop = document.getElementById('kategori-modal-backdrop');
        const closeBtn = document.getElementById('kategori-modal-close');
        const cancelBtn = document.getElementById('kategori-modal-cancel');
        const form = document.getElementById('kategori-modal-form');
        const input1 = document.getElementById('pers-1');
        const input2 = document.getElementById('pers-2');
        const input3 = document.getElementById('pers-3');

        const kategoriMap = @json($kategoris->pluck('persentase', 'id'));

        function openModal() {
            form.action = batchUrl;
            input1.value = kategoriMap['1'] ?? '';
            input2.value = kategoriMap['2'] ?? '';
            input3.value = kategoriMap['3'] ?? '';

            backdrop.classList.remove('hidden');
            setTimeout(() => backdrop.classList.add('opacity-100'), 10);
            backdrop.classList.remove('opacity-0');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('translate-y-full');
                modal.classList.remove('md:opacity-0');
                modal.classList.remove('md:translate-y-0');
                modal.classList.add('translate-y-0');
                modal.classList.add('md:opacity-100');
            }, 10);

            document.documentElement.style.overflow = 'hidden';
        }

        function closeModal() {
            backdrop.classList.add('opacity-0');

            modal.classList.remove('translate-y-0');
            modal.classList.add('translate-y-full');
            modal.classList.remove('md:opacity-100');
            modal.classList.add('md:opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                backdrop.classList.add('hidden');
            }, 300);

            document.documentElement.style.overflow = '';
        }

        openButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                openModal();
            });
        });

        backdrop.addEventListener('click', closeModal);
        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
    })();
</script>
@endpush

@push('scripts')
<script>
    (function() {
        const deleteButtons = document.querySelectorAll('.open-delete-sub');
        const modal = document.getElementById('delete-sub-modal');
        const backdrop = document.getElementById('delete-sub-backdrop');
        const closeBtn = document.getElementById('delete-sub-close');
        const cancelBtn = document.getElementById('delete-sub-cancel');
        const form = document.getElementById('delete-sub-form');
        const nameEl = document.getElementById('delete-sub-nama');

        const baseUrl = "{{ url('/sub-kategori') }}";

        function openDeleteModal(id, nama) {
            form.action = baseUrl + '/' + id;
            nameEl.textContent = nama;
            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            document.documentElement.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            backdrop.classList.add('hidden');
            modal.classList.add('hidden');
            document.documentElement.style.overflow = '';
        }

        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                openDeleteModal(id, nama);
            });
        });

        backdrop.addEventListener('click', closeDeleteModal);
        closeBtn.addEventListener('click', closeDeleteModal);
        cancelBtn.addEventListener('click', closeDeleteModal);
    })();
</script>
@endpush

@endsection