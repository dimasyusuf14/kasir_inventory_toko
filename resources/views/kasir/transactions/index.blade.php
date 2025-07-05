@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Transaksi Baru</h2>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-200 text-red-800 p-3 rounded mb-3">{{ session('error') }}</div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif


    <form method="POST" action="{{ route('kasir.transaction.store') }}">
        @csrf

        <table class="w-full table-auto border mb-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Pilih</th>
                    <th class="p-2 border">Nama Barang</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Stok</th>
                    <th class="p-2 border">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                <tr>
                    <td class="p-2 border text-center">
                        <input type="checkbox" name="items[{{ $index }}][product_id]" value="{{ $product->id }}">
                    </td>
                    <td class="p-2 border">{{ $product->nama_barang }}</td>
                    <td class="p-2 border">Rp {{ number_format($product->harga) }}</td>
                    <td class="p-2 border">{{ $product->stok }}</td>
                    <td class="p-2 border">
                        <input type="number" name="items[{{ $index }}][qty]" class="w-20 border p-1" min="1" value="1">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-4">
            <label class="block font-medium">Bayar</label>
            <input type="number" name="bayar" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan Transaksi</button>
        </div>

        @if(session('transaction_id'))
        <a href="{{ route('kasir.transaksi.print', session('transaction_id')) }}"
            target="_blank" class="bg-green-500 text-white px-3 py-1 rounded inline-block mt-4">
            Cetak Struk PDF
        </a>
        @endif


    </form>
</div>
@endsection
