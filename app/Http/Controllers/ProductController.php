<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_barang', 'like', "%$search%")
                ->orWhere('kode_barang', 'like', "%$search%");
        }

        // ↕️ Sort
        $sort = $request->get('sort', 'nama_barang'); // default sort by nama_barang
        $direction = $request->get('direction', 'asc'); // default ascending
        $query->orderBy($sort, $direction);

        $products = $query->get();

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:products',
            'nama_barang' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Product $barang)
    {
        return view('admin.products.edit', ['product' => $barang]);
    }

    public function update(Request $request, Product $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        $barang->update($request->all());

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Product $barang)
    {
        $barang->delete();
        return back()->with('success', 'Barang berhasil dihapus.');
    }
}
