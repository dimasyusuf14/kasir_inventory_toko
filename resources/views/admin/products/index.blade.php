@extends('admin.main')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Daftar Barang</h2>
        <a href="{{ route('admin.barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form Search & Sort -->
    <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
            class="border p-2 rounded w-64" placeholder="Cari nama/kode barang...">

        <select name="sort" class="border p-2 rounded">
            <option value="nama_barang" {{ request('sort') == 'nama_barang' ? 'selected' : '' }}>Sort Nama</option>
            <option value="harga" {{ request('sort') == 'harga' ? 'selected' : '' }}>Sort Harga</option>
            <option value="stok" {{ request('sort') == 'stok' ? 'selected' : '' }}>Sort Stok</option>
        </select>

        <select name="direction" class="border p-2 rounded">
            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Naik</option>
            <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Turun</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
    </form>


    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Kode</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Harga</th>
                <th class="p-2 border">Stok</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
            <tr>
                <td class="p-2 border">{{ $item->kode_barang }}</td>
                <td class="p-2 border">{{ $item->nama_barang }}</td>
                <td class="p-2 border">Rp {{ number_format($item->harga) }}</td>
                <td class="p-2 border">{{ $item->stok }}</td>
                <td class="p-2 border flex gap-2">
                    <a href="{{ route('admin.barang.edit', $item->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
