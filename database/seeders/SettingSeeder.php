<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // File::copy(public_path('assets/dist/img/logo-20221017153924.png'), public_path('assets/dist/img/logo-20221017153924.png'));
        Setting::create([
            'nama_toko' => 'KDA Coffe & Foodcourt',
            'alamat' => 'Jl. Lintas Negeri Lama',
            'telp' => '082324129752',
            'path_logo' => 'logo-20221017153924.jpg'
        ]);
    }
}
