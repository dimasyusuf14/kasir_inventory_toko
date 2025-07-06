<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard.index', [ // <- view yang benar
            'totalProducts' => Product::count(),
            'totalUsers' => User::count(),
            'totalKasir' => User::where('role', 'kasir')->count(),
            'recentUsers' => User::latest()->take(5)->get(),
        ]);
    }

    public function kasirDashboard()
    {
        $user = auth()->user();

        $today = Carbon::today();

        $totalTransaksi = Transaction::whereDate('created_at', $today)
            ->where('user_id', $user->id)
            ->count();

        $totalPendapatan = Transaction::whereDate('created_at', $today)
            ->where('user_id', $user->id)
            ->sum('total_harga');

        return view('kasir.dashboard.index', compact('totalTransaksi', 'totalPendapatan', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
