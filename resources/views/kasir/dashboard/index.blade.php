@extends('kasir.main')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Kartu info transaksi --}}
    <div class="bg-white p-4 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-gray-700">Total Transaksi Hari Ini</h2>
        <p class="text-3xl mt-2 text-blue-600 font-bold">{{ $totalTransaksi }}</p>
    </div>

    {{-- Kartu info pendapatan --}}
    <div class="bg-white p-4 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-gray-700">Total Pendapatan Hari Ini</h2>
        <p class="text-3xl mt-2 text-green-600 font-bold">Rp {{ number_format($totalPendapatan) }}</p>
    </div>

    {{-- Informasi user --}}
    <div class="bg-white p-4 rounded-xl shadow col-span-2">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi User</h2>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <a href="{{ route('profile.edit') }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            ✏️ Edit Profil
        </a>
    </div>
</div>
@endsection
