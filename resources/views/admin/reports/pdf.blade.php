<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Penjualan</h2>
    <p>Periode: {{ $start }} sampai {{ $end }}</p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $trx->created_at->format('d/m/Y') }}</td>
                <td>{{ $trx->user->name }}</td>
                <td>Rp {{ number_format($trx->total_harga) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total Penjualan</strong></td>
                <td><strong>Rp {{ number_format($total) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
