<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        File::copy(public_path('assets/dist/img/old/avatar4.png'), public_path('assets/dist/img/avatar4.png'));
        $adm1 = User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'foto' => 'avatar4.png'
        ]);
        $adm1->assignRole('admin');

        File::copy(public_path('assets/dist/img/old/avatar1.png'), public_path('assets/dist/img/avatar1.png'));
        $kas1 = User::create([
            'nama' => 'KAsir 2',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir12345'),
            'foto' => 'avatar1.png'
        ]);
        $kas1->assignRole('kasir');
    }
}
