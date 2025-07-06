<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $kasir = User::where('role', 'kasir')->first();
        $products = Product::all();

        if (!$kasir || $products->count() === 0) {
            $this->command->warn("Pastikan sudah ada user kasir dan data produk.");
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            // Tanggal acak antara hari ini sampai 6 hari lalu
            $createdAt = Carbon::now()->subDays(rand(0, 6));

            // Ambil produk acak (1–4 item)
            $items = $products->random(rand(1, 4));
            $total = 0;

            $transaction = Transaction::create([
                'user_id' => $kasir->id,
                'total_harga' => 0,
                'bayar' => 0,
                'kembalian' => 0,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            foreach ($items as $item) {
                $qty = rand(1, 3);
                $subtotal = $item->harga * $qty;
                $total += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->id,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            $bayar = $total + rand(0, 5000);
            $transaction->update([
                'total_harga' => $total,
                'bayar' => $bayar,
                'kembalian' => $bayar - $total,
            ]);
        }
    }
}
