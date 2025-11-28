@extends('layouts.navbar')
@section('content')
        <header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b lg:border-gray-200">
            <div class="p-4 lg:p-6 flex items-center">
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Detail Riwayat</h1>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-2xl mx-auto bg-white rounded shadow-sm p-6">
                <div class="mb-4">
                    <a href="{{ route('riwayat') }}" class="text-blue-600">&larr; Kembali ke Riwayat</a>
                </div>

                <h2 class="text-lg font-semibold mb-2">{{ $entry->description }}</h2>
                <div class="text-sm text-gray-600 mb-4">Tanggal: {{ \Carbon\Carbon::parse($entry->tanggal)->format('d M Y') }}</div>

                <div class="grid grid-cols-1 gap-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tipe</span>
                        <span class="font-semibold">{{ ucfirst($entry->type) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah</span>
                        <span class="font-semibold">Rp {{ number_format($entry->amount,0,',','.') }}</span>
                    </div>

                    @if(isset($entry->kategori_nama))
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kategori</span>
                        <span class="font-semibold">{{ $entry->kategori_nama }}</span>
                    </div>
                    @endif

                    @if(isset($entry->sub_kategori_nama))
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sub Kategori</span>
                        <span class="font-semibold">{{ $entry->sub_kategori_nama }}</span>
                    </div>
                    @endif

                    @if(isset($entry->catatan) && $entry->catatan)
                    <div>
                        <div class="text-gray-600">Catatan</div>
                        <div class="mt-1">{{ $entry->catatan }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
@endsection
