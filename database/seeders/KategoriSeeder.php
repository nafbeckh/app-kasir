<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Kategori::create([
            'nama_kat' => 'Makanan'
        ]);
        Kategori::create([
            'nama_kat' => 'Minuman'
        ]);
        Kategori::create([
            'nama_kat' => 'Snack'
        ]);
    }
}
