<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Supplier::create([
            'nama' => 'wings wigit',
            'alamat' => 'bks',
            'telp' => '0982354852'
        ]);
    }
}
