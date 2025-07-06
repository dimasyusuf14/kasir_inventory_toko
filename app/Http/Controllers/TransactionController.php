<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('kasir.transactions.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'bayar' => 'required|integer|min:0',
        ]);

        // Hitung total harga dan validasi stok
        $total_harga = 0;
        $products = Product::whereIn('id', collect($request->items)->pluck('product_id'))->get();

        foreach ($request->items as $item) {
            $product = $products->where('id', $item['product_id'])->first();

            if (!$product) {
                return back()->with('error', 'Barang tidak ditemukan.');
            }

            if ($product->stok < $item['qty']) {
                return back()->with('error', 'Stok barang "' . $product->nama_barang . '" tidak mencukupi.');
            }

            $total_harga += $product->harga * $item['qty'];
        }


        if ($request->bayar < $total_harga) {
            return back()->with('error', 'Uang bayar kurang dari total harga.');
        }

        // Simpan transactions dan item secara atomic
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_harga' => $total_harga,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total_harga,
            ]);

            foreach ($request->items as $item) {
                $product = $products->where('id', $item['product_id'])->first();

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'subtotal' => $product->harga * $item['qty'],
                ]);

                // Kurangi stok barang
                $product->decrement('stok', $item['qty']);
            }

            DB::commit();

            // Simpan ID transactions terakhir (opsional untuk cetak struk otomatis)
            return redirect()->route('kasir.transaction')->with([
                'success' => 'Transaksi berhasil disimpan.',
                'transaction_id' => $transaction->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }

    public function print($id)
    {
        $transaction = Transaction::with(['items.product', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $pdf = PDF::loadView('kasir.transactions.struk', compact('transaction'))->setPaper('A6');

        return $pdf->stream('struk-transaksi.pdf');
    }

    public function report(Request $request)
    {
        $start = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = $request->end_date ?? Carbon::now()->endOfMonth()->format('Y-m-d');

        $transactions = Transaction::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $transactions->sum('total_harga');

        return view('admin.reports.index', compact('transactions', 'start', 'end', 'total'));
    }

    public function exportPdf(Request $request)
    {
        $start = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = $request->end_date ?? Carbon::now()->endOfMonth()->format('Y-m-d');

        $transactions = Transaction::with('user')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $transactions->sum('total_harga');

        $pdf = PDF::loadView('admin.laporan.pdf', compact('transactions', 'start', 'end', 'total'))->setPaper('A4', 'portrait');
        return $pdf->download('laporan-penjualan.pdf');
    }

    public function history(Request $request)
    {
        $query = Transaction::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($request->has('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $transactions = $query->paginate(10);

        return view('kasir.transactions.history', compact('transactions'));
    }

    public function chart()
    {
        $data = Transaction::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->limit(7) // 7 hari terakhir
            ->get();

        $labels = $data->pluck('tanggal');
        $totals = $data->pluck('total');

        return view('admin.dashboard.index', compact('labels', 'totals'));
    }

    public function detail($id)
    {
        $transaction = Transaction::with(['items.product', 'user'])->findOrFail($id);
        return view('kasir.transactions.detail', compact('transaction'));
    }
}
