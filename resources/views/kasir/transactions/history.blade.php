@extends('kasir.main')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">🧾 Riwayat Transaksi Saya</h2>

    {{-- Filter Tanggal --}}
    <form method="GET" class="mb-6 flex items-center gap-3">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border border-gray-300 rounded px-3 py-2 text-sm shadow-sm">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700">Filter</button>

        @if(request('tanggal'))
        <a href="{{ route('kasir.riwayat') }}" class="bg-gray-300 text-gray-800 px-4 py-2 text-sm rounded hover:bg-gray-400">Clear</a>
        @endif
    </form>

    {{-- Tabel Riwayat --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-3 border">ID</th>
                    <th class="px-4 py-3 border">Tanggal</th>
                    <th class="px-4 py-3 border">Total</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($transactions as $trx)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $trx->id }}</td>
                    <td class="px-4 py-2 border">{{ $trx->created_at->translatedFormat('j F Y, H:i') }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($trx->total_harga) }}</td>
                    <td class="px-4 py-2 border">

                        <button type="button" onclick="showDetailModal('{{ $trx->id }}')" class="text-green-600 hover:underline ml-2">Detail</button>
                        <a href="{{ route('kasir.transaction.print', $trx->id) }}" target="_blank"
                            class="text-blue-600 hover:underline">Cetak Struk</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 italic">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>



        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $transactions->withQueryString()->links() }}
    </div>
</div>


<!-- Modal Detail Transaksi -->
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-[90%] md:w-[400px] rounded shadow-lg p-6 relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeDetailModal()" class="absolute top-2 right-2 text-red-500 text-lg">×</button>
        <div id="modalDetailContent">
            <p class="text-center text-gray-500">Memuat...</p>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    function showDetailModal(id) {
        const modal = document.getElementById('modalDetail');
        const content = document.getElementById('modalDetailContent');
        modal.classList.remove('hidden');
        content.innerHTML = '<p class="text-center text-gray-500">Memuat...</p>';
        fetch(`/kasir/transaksi/${id}`)
            .then(res => res.text())
            .then(html => content.innerHTML = html)
            .catch(() => content.innerHTML = '<p class="text-red-500">Gagal memuat data.</p>');
    }

    function closeDetailModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>
@endpush
