<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { padding: 5px; border-bottom: 1px dotted #000; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h3 class="text-center">Toko Yusuf Alexandre</h3>
    <p>No Transaksi: {{ $transaction->id }}<br>
    Kasir: {{ $transaction->user->name }}<br>
    Tanggal: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td>{{ $item->product->nama_barang }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->product->harga) }}</td>
                <td>Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> Rp {{ number_format($transaction->total_harga) }}<br>
       <strong>Bayar:</strong> Rp {{ number_format($transaction->bayar) }}<br>
       <strong>Kembalian:</strong> Rp {{ number_format($transaction->kembalian) }}</p>

    <p class="text-center">Terima kasih!</p>
</body>
</html>
