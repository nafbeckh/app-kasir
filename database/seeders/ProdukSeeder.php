<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Produk::create([
            'kategori_id' => 1,
            'nama_prod' => 'bengbeng 250g',
            'kode_prod' => 'P' . tambah_nol_didepan((int)0 + 1, 6),
            'merk_prod' => 'bengbeng',
            'harga_beli' => 800,
            'harga_jual' => 1000,
            'diskon' => 0,
            'ket' => '',
            'stok' => 0
        ]);


        // for ($i = 2; $i < 20; $i++) {
        //     $nama = ['bengbeng' . $i, 'nasi' . $i, 'pindang' . $i, 'kentang' . $i, 'kol' . $i];
        //     $merk = ['bengbeng', 'mawar', 'melati'];
        //     Produk::create([
        //         'kategori_id' => rand(1, 3),
        //         'nama_prod' => $nama[array_rand($nama)],
        //         'kode_prod' => 'P' . tambah_nol_didepan((int)$i + 1, 6),
        //         'merk_prod' => $merk[array_rand($merk)],
        //         'harga_beli' => 800,
        //         'harga_jual' => 1000,
        //         'diskon' => 0,
        //         'ket' => '',
        //         'stok' => 0,

        //     ]);
        // }
    }
}
