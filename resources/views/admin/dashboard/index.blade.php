@extends('admin.main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total Barang</h2>
            <p class="text-3xl mt-2 text-blue-600 font-bold">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total User</h2>
            <p class="text-3xl mt-2 text-blue-600 font-bold">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total Kasir</h2>
            <p class="text-3xl mt-2 text-blue-600 font-bold">{{ $totalKasir }}</p>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Data User</h3>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left text-sm uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach($recentUsers as $user)
                    <tr class="border-b">
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-3">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
@endsection
