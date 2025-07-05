@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Laporan Penjualan</h2>

    <form method="GET" class="flex gap-4 items-center mb-4">
        <div>
            <label>Dari</label>
            <input type="date" name="start_date" value="{{ $start }}" class="border p-2 rounded">
        </div>
        <div>
            <label>Sampai</label>
            <input type="date" name="end_date" value="{{ $end }}" class="border p-2 rounded">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('admin.laporan.pdf', ['start_date' => $start, 'end_date' => $end]) }}"
            class="bg-green-600 text-white px-4 py-2 rounded">Cetak PDF</a>
    </form>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Kasir</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td class="p-2 border">{{ $trx->created_at->format('d/m/Y') }}</td>
                <td class="p-2 border">{{ $trx->user->name }}</td>
                <td class="p-2 border">Rp {{ number_format($trx->total_harga) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-bold bg-gray-200">
                <td colspan="2" class="p-2 border text-right">Total:</td>
                <td class="p-2 border">Rp {{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
