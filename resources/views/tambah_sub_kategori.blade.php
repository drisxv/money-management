
@extends('layouts.navbar')
@section('content')
<div class="w-auto mx-auto bg-white min-h-screen lg:min-h-0 lg:mt-12 lg:rounded-xl lg:shadow-xl lg:overflow-hidden">

	<header class="bg-white sticky top-0 z-10 shadow-sm lg:shadow-none lg:border-b lg:border-gray-200">
		<div class="p-4 lg:p-6 flex items-center">
			<a href="{{ route('kategori') }}" class="p-2 mr-2 rounded-full hover:bg-gray-100">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-800">
					<path d="M19 12H5"></path>
					<path d="M12 19l-7-7 7-7"></path>
				</svg>
			</a>
			<h1 class="text-xl lg:text-2xl font-bold text-gray-900">@if(isset($sub)) Ubah Kategori @else Tambah Kategori @endif</h1>
		</div>
	</header>

	<main class="p-4 sm:p-6 lg:p-8">
		<div class="max-w-md mx-auto">
			@if($errors->any())
				<div class="mb-4 p-3 bg-red-50 border border-red-100 text-red-700 rounded">
					<ul class="list-disc pl-5">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form method="POST" action="{{ isset($sub) ? route('subkategori.update', $sub->id) : route('subkategori.store') }}">
				@csrf
				@if(isset($sub))
					@method('PUT')
				@endif

				<div class="mb-4">
					<label for="nama" class="block text-xl font-medium text-gray-700 mb-1">Nama Kategori</label>
					<input id="nama" name="nama" type="text" value="{{ old('nama', isset($sub) ? $sub->nama : '') }}" required
						class="block w-full rounded-md border-2 border-black shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-xl p-2 lg:mb-8" />
				</div>

				<div class="mb-6">
					<label for="kategori_id" class="block text-xl font-medium text-gray-700 mb-1">Pilih Sumber Dana</label>
					<select id="kategori_id" name="kategori_id" required class="block w-full rounded-md border-2 lg:mb-8 border-black shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-xl p-2">
						@foreach($kategoris as $kat)
							<option value="{{ $kat->id }}" {{ (int)old('kategori_id', isset($sub) ? $sub->kategori_id : '') === $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
						@endforeach
					</select>
				</div>

				<div class="flex justify-end space-x-2">
					<a href="{{ route('kategori') }}" class="px-4 py-2 text-xl rounded-lg text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">Batal</a>
					<button type="submit" class="inline-flex items-center text-xl justify-center rounded-lg border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-md hover:bg-green-700">@if(isset($sub)) Perbarui @else Simpan @endif</button>
				</div>
			</form>
		</div>
	</main>

</div>

@endsection
