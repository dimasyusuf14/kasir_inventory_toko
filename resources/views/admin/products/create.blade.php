@extends('admin.main')

@section('content')
<div class="max-w-xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Tambah Barang</h2>

    <form action="{{ route('admin.barang.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Kode Barang</label>
            <input type="text" name="kode_barang" class="w-full border p-2 rounded" required>
            @error('kode_barang') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block">Nama Barang</label>
            <input type="text" name="nama_barang" class="w-full border p-2 rounded" required>
            @error('nama_barang') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block">Harga</label>
            <input type="number" name="harga" class="w-full border p-2 rounded" required>
            @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block">Stok</label>
            <input type="number" name="stok" class="w-full border p-2 rounded" required>
            @error('stok') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.barang.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
