@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Riwayat Transaksi Saya</h2>

    <form method="GET" class="mb-4 flex items-center gap-3">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border p-2 rounded">
        <button class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
    </form>

    <table class="w-full border table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td class="p-2 border">{{ $trx->id }}</td>
                <td class="p-2 border">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-2 border">Rp {{ number_format($trx->total_harga) }}</td>
                <td class="p-2 border">
                    <a href="{{ route('kasir.transaksi.print', $trx->id) }}" target="_blank" class="text-blue-600">Cetak Struk</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $transactions->withQueryString()->links() }}
    </div>
</div>
@endsection
