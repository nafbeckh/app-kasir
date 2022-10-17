<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MemberSeeder::class,
            KategoriSeeder::class,
            ProdukSeeder::class,
            SettingSeeder::class,
            SupplierSeeder::class,
            PembelianSeeder::class,
            PembelianDetailSeeder::class,
            PengeluaranSeeder::class,
            PenjualanSeeder::class,
            PenjualanDetailSeeder::class
        ]);
    }
}
