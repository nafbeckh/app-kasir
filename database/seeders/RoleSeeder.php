<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'kasir',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'waiters',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'bartender',
            'guard_name' => 'web'
        ]);
    }
}
