@extends('kasir.main')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Transaksi Baru</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- 📦 Daftar Barang --}}
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-3">Pilih Barang</h3>
            <ul class="max-h-[550px] overflow-y-auto pr-2">

                @foreach($products as $product)
                <li class="flex justify-between items-center border-b py-2">
                    <div>
                        <p class="font-medium">{{ $product->nama_barang }}<span class="text-xs text-gray-400">| Stok: {{ $product->stok }}</span></p>
                        <p class="text-sm text-gray-500">
                            Rp {{ number_format($product->harga) }}
                        </p>
                    </div>

                    <button type="button"
                        class="text-white bg-blue-600 px-3 py-1 rounded text-sm">+ Tambah</button>
                </li>
                @endforeach
            </ul>
        </div>


        {{-- 🛒 Keranjang dan Ringkasan --}}
        <div class="flex flex-col gap-6 sticky top-4 self-start">
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
