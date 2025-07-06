<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class KasirSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Kasir
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        // Produk (20 data)
        Product::insert([
            ['kode_barang' => 'BRG001', 'nama_barang' => 'Indomie Goreng', 'harga' => 3000, 'stok' => 100],
            ['kode_barang' => 'BRG002', 'nama_barang' => 'Susu Kotak Ultra', 'harga' => 6000, 'stok' => 50],
            ['kode_barang' => 'BRG003', 'nama_barang' => 'Air Mineral 600ml', 'harga' => 2000, 'stok' => 200],
            ['kode_barang' => 'BRG004', 'nama_barang' => 'Snack Chitato', 'harga' => 8500, 'stok' => 30],
            ['kode_barang' => 'BRG005', 'nama_barang' => 'Teh Botol Sosro', 'harga' => 5000, 'stok' => 75],
            ['kode_barang' => 'BRG006', 'nama_barang' => 'Roti Tawar Sari Roti', 'harga' => 12000, 'stok' => 40],
            ['kode_barang' => 'BRG007', 'nama_barang' => 'Coklat SilverQueen', 'harga' => 15000, 'stok' => 25],
            ['kode_barang' => 'BRG008', 'nama_barang' => 'Kopi Kapal Api', 'harga' => 2500, 'stok' => 60],
            ['kode_barang' => 'BRG009', 'nama_barang' => 'Baterai ABC AA', 'harga' => 7000, 'stok' => 80],
            ['kode_barang' => 'BRG010', 'nama_barang' => 'Minyak Goreng 1L', 'harga' => 16000, 'stok' => 45],
            ['kode_barang' => 'BRG011', 'nama_barang' => 'Gula Pasir 1kg', 'harga' => 14000, 'stok' => 70],
            ['kode_barang' => 'BRG012', 'nama_barang' => 'Sabun Lifebuoy', 'harga' => 3500, 'stok' => 120],
            ['kode_barang' => 'BRG013', 'nama_barang' => 'Shampoo Pantene 70ml', 'harga' => 9000, 'stok' => 55],
            ['kode_barang' => 'BRG014', 'nama_barang' => 'Pasta Gigi Pepsodent', 'harga' => 6000, 'stok' => 65],
            ['kode_barang' => 'BRG015', 'nama_barang' => 'Tisu Paseo', 'harga' => 8500, 'stok' => 40],
            ['kode_barang' => 'BRG016', 'nama_barang' => 'Sarden ABC', 'harga' => 11000, 'stok' => 30],
            ['kode_barang' => 'BRG017', 'nama_barang' => 'Beras 5kg', 'harga' => 70000, 'stok' => 15],
            ['kode_barang' => 'BRG018', 'nama_barang' => 'Mi Gelas Ayam Bawang', 'harga' => 2000, 'stok' => 100],
            ['kode_barang' => 'BRG019', 'nama_barang' => 'Kecap Bango 220ml', 'harga' => 8000, 'stok' => 50],
            ['kode_barang' => 'BRG020', 'nama_barang' => 'Masker Medis 3ply', 'harga' => 1500, 'stok' => 300],
        ]);

        // Tambahkan created_at dan updated_at
        Product::query()->update(['created_at' => now(), 'updated_at' => now()]);
    }
}
