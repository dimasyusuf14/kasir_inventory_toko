@extends('kasir.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Transaksi Baru</h2>
    <!-- Form Search & Sort -->
    <form method="GET" action="{{ route('kasir.transactions') }}" class="mb-4 flex flex-wrap items-center gap-4">

        <input type="text" name="search" value="{{ request('search') }}"
            class="border p-2 rounded w-64" placeholder="Cari nama/kode barang...">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        @if(request('search'))
        <a href="{{ route('kasir.transactions') }}" class="bg-gray-300 text-gray-800 px-4 py-2 text-sm rounded hover:bg-gray-400">Clear</a>
        @endif
    </form>

    <div class="grid grid-cols-1 md:grid-cols-7 gap-6">

        {{-- 📦 Daftar Barang --}}
        <div class="bg-white rounded shadow p-4 col-span-4">
            <h3 class="text-lg font-semibold mb-3">Pilih Barang</h3>

            <div class="overflow-x-auto max-h-[550px] overflow-y-auto">
                <table class="min-w-full text-sm border border-gray-200">
                    <thead class="bg-gray-100 text-left text-gray-700 uppercase sticky top-0">
                        <tr>
                            <th class="p-2 border-b">Kode</th>
                            <th class="p-2 border-b">Nama Barang</th>
                            <th class="p-2 border-b">Stok</th>
                            <th class="p-2 border-b">Harga</th>
                            <th class="p-2 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2">{{ $product->kode_barang }}</td>
                            <td class="p-2">{{ $product->nama_barang }}</td>
                            <td class="p-2">{{ $product->stok }}</td>
                            <td class="p-2">Rp {{ number_format($product->harga) }}</td>
                            <td class="p-2 text-center">
                                <button type="button"
                                    
                                    class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-sm">+ Tambah</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500 italic">Tidak ada barang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 🛒 Keranjang dan Ringkasan --}}
        <div class="flex flex-col gap-6 sticky top-4 self-start col-span-3">
            {{-- 🛒 Keranjang Belanja --}}
            <div class="bg-white rounded shadow p-4">
                <h3 class="text-lg font-semibold mb-3">Keranjang Belanja</h3>

                <form method="POST" action="{{ route('kasir.transaction.store') }}" onsubmit="return prepareForm()">
                    @csrf


                    <table class="w-full text-sm mb-4" id="cartTable">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 text-left">Produk</th>
                                <th class="p-2">Harga</th>
                                <th class="p-2">Qty</th>
                                <th class="p-2">Subtotal</th>
                                <th class="p-2"></th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <tr id="emptyCartRow">
                                <td colspan="5" class="text-center text-gray-500 italic py-4">Keranjang kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            {{-- 💰 Ringkasan Belanja --}}
            <div class="bg-white rounded shadow p-4">
                <h3 class="text-lg font-semibold mb-3">Ringkasan</h3>

                <div class="mb-4">
                    <p>Subtotal: Rp <span id="subtotal">0</span></p>
                    <p>Total: <strong>Rp <span id="total">0</span></strong></p>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Dibayar (Rp)</label>
                    <input type="number" name="bayar" id="bayarInput" class="w-full border p-2 rounded" required
                        oninput="updateKembalian()">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Kembalian</label>
                    <p class="text-xl font-bold text-green-700">Rp <span id="kembalian">0</span></p>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">💵 Bayar</button>
                    <button type="button" onclick="clearCart()" class="bg-red-600 text-white px-4 py-2 rounded">❌ Batal</button>
                </div>

                <input type="hidden" name="bayar" value="0">
            </div>
        </div>
    </div>


</div>
@endsection
