<div class="text-sm">
    <h3 class="text-center font-bold mb-2">Struk Kasir Toko</h3>
    <p>No Transaksi: {{ $transaction->id }}<br>
    Kasir: {{ $transaction->user->name }}<br>
    Tanggal: {{ $transaction->created_at->translatedFormat('d F Y, H:i') }}</p>

    <table class="w-full text-xs my-2 border-t border-b border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-1">Barang</th>
                <th class="text-center p-1">Qty</th>
                <th class="text-right p-1">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td class="p-1">{{ $item->product->nama_barang }}</td>
                <td class="text-center p-1">{{ $item->qty }}</td>
                <td class="text-right p-1">Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-3">
        <strong>Total:</strong> Rp {{ number_format($transaction->total_harga) }}<br>
        <strong>Bayar:</strong> Rp {{ number_format($transaction->bayar) }}<br>
        <strong>Kembalian:</strong> Rp {{ number_format($transaction->kembalian) }}
    </p>

    <p class="text-center mt-4 text-xs text-gray-500 italic">Terima kasih!</p>
</div>
