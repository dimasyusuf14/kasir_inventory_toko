<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnsTransaction
{
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        $transaction = Transaction::findOrFail($id);

        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses transaksi ini.');
        }

        return $next($request);
    }
}
