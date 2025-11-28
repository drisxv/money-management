@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4">Keamanan Akun</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('profile.updatePassword') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm text-gray-700">Password Saat Ini</label>
            <input type="password" name="current_password" class="mt-1 block w-full rounded border-gray-200" required />
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-700">Password Baru</label>
            <input type="password" name="password" class="mt-1 block w-full rounded border-gray-200" required />
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full rounded border-gray-200" required />
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Ubah Password</button>
            <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
