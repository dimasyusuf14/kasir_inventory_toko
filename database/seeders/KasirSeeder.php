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

        // Produk
        Product::insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Indomie Goreng',
                'harga' => 3000,
                'stok' => 100,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Susu Kotak Ultra',
                'harga' => 6000,
                'stok' => 50,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Air Mineral 600ml',
                'harga' => 2000,
                'stok' => 200,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Snack Chitato',
                'harga' => 8500,
                'stok' => 30,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Teh Botol Sosro',
                'harga' => 5000,
                'stok' => 75,
                'created_at' => now(), 'updated_at' => now(),
            ]
        ]);
    }
}
