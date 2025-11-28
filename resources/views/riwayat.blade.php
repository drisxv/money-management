@extends('layouts.app')
@section('content')
<div class="mx-auto sm:p-6 lg:p-8">

    <header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b mb-4 lg:border-gray-200">
        <div class="p-4 lg:p-6 flex items-center">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Riwayat</h1>
        </div>
    </header>
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Filter</h2>
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $filters['start_date'] ?? '' }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition-colors" />
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $filters['end_date'] ?? '' }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition-colors" />
                </div>
                <div>
                    <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                    <select id="tipe" name="tipe" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition-colors">
                        <option value="">Semua</option>
                        <option value="masuk" {{ (isset($filters['tipe']) && $filters['tipe']=='masuk')? 'selected':'' }}>Pemasukan</option>
                        <option value="keluar" {{ (isset($filters['tipe']) && $filters['tipe']=='keluar')? 'selected':'' }}>Pengeluaran</option>
                        <option value="data" {{ (isset($filters['tipe']) && $filters['tipe']=='data')? 'selected':'' }}>Data (Alokasi)</option>
                    </select>
                </div>
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition-colors">
                        <option value="">Semua</option>
                        @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ (isset($filters['kategori_id']) && $filters['kategori_id']==$kat->id)? 'selected':'' }}>{{ ucfirst($kat->nama) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="pt-3 flex gap-3">
                <button type="submit" class="px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition-colors duration-200 shadow-md">
                    Terapkan Filter
                </button>
                <a href="{{ route('riwayat') }}" class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition-colors duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>


    <div class="space-y-4">
        @php
        $groups = collect($riwayat->items())->groupBy(function($item) {
        return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
        });
        @endphp

        @if($groups->isEmpty())
        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-200 text-center text-gray-500">
            <p>Tidak ada riwayat yang cocok dengan kriteria filter.</p>
            <a href="{{ route('riwayat') }}" class="mt-2 inline-block text-green-600 hover:text-green-700 font-semibold">Reset Filter</a>
        </div>
        @else
        @foreach($groups as $day => $items)
        <div>
            <div class="mb-3 text-sm font-semibold text-gray-700">{{ \Carbon\Carbon::parse($day)->translatedFormat('l, d M Y') }}</div>

            <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
                @foreach($items as $item)
                @php
                $colorClass = match($item->type) {
                'masuk' => 'text-green-600',
                'keluar' => 'text-red-600',
                default => 'text-indigo-600',
                };
                $amountClass = match($item->type) {
                'masuk' => 'text-green-600',
                'keluar' => 'text-red-600',
                default => 'text-gray-800',
                };
                $sign = match($item->type) {
                'masuk' => '+',
                'keluar' => '-',
                default => '',
                };
                @endphp

                <a href="{{ route('riwayat.detail', ['type' => $item->type, 'id' => $item->entry_id]) }}" class="flex items-center p-4 rounded-lg bg-transparent border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <div class="w-10 h-10 rounded-full text-white flex items-center justify-center mr-4 flex-shrink-0">
                        @if($item->type == 'masuk')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="m8 12 4 4 4-4"></path>
                            <path d="M12 8v8"></path>
                        </svg>
                        @elseif($item->type == 'keluar')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="m16 12-4-4-4 4"></path>
                            <path d="M12 16V8"></path>
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                        </svg>
                        @endif
                    </div>

                    <div class="flex-grow min-w-0">
                        <p class="font-semibold text-gray-900 truncate">{{ $item->description }}</p>
                        <p class="text-xs text-gray-600 mt-0.5">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            @if(isset($item->sub_kategori_nama) && $item->sub_kategori_nama)
                            <span class="font-medium text-gray-500"> - {{ ucfirst($item->sub_kategori_nama) }}</span>
                            @endif
                        </p>
                    </div>

                    <p class="font-bold {{ $amountClass }} text-right ml-4 flex-shrink-0">
                        {{ $sign }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <div class="pt-6">
        {{ $riwayat->withQueryString()->links('pagination::tailwind') }}
    </div>

</div>
@endsection