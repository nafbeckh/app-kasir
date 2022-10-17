<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Member::create([
            'kode_member' => 'M' . tambah_nol_didepan((int)0 + 1, 6),
            'nama' => 'Umum',
            'alamat' => '-',
            'telp' => '08',
        ]);
        Member::create([
            'kode_member' => 'M' . tambah_nol_didepan((int)1 + 1, 6),
            'nama' => 'Bagio',
            'alamat' => 'ngetrep',
            'telp' => '0823126767',
        ]);
        // for ($i = 3; $i < 20; $i++) {
        //     Member::create([
        //         'kode_member' => 'M' . tambah_nol_didepan((int)$i + 1, 6),
        //         'nama' => 'pak eko' . $i,
        //         'alamat' => 'bojong' . $i,
        //         'telp' => '0823126767' . $i,
        //     ]);
        // }
    }
}
