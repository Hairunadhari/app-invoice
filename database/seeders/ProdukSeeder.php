<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Laptop',
            'deskripsi' => 'Untuk Bermain Game',
            'stock' => '20',
            'harga' => '7000000',
        ]);
        Produk::create([
            'nama' => 'Kipas Angin',
            'deskripsi' => 'Pendingin Ruangan',
            'stock' => '15',
            'harga' => '3000000',
        ]);
        Produk::create([
            'nama' => 'Handphone',
            'deskripsi' => 'Untuk Kirim Pesan',
            'stock' => '30',
            'harga' => '5000000',
        ]);
      
    }
}
