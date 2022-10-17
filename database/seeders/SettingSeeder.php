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
        File::copy(public_path('assets/dist/img/logo.png'), public_path('assets/dist/img/logo.png'));
        Setting::create([
            'nama_toko' => 'KCNPOS',
            'alamat' => 'Ngetrep Kulonan',
            'telp' => '082324129752',
            'path_logo' => 'logo.png'
        ]);
    }
}
