<?php

namespace Database\Seeders;

use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pengeluaran::create([
            'deskripsi' => 'beli barang',
            'nominal' => 50000
        ]);
    }
}
