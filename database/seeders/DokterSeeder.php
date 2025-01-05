<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokters')->insert([
            [
                'nama' => 'Dr. Yudha',
                'alamat' => 'Jl. Raya No. 2',
                'no_hp' => '082131047298',
                'id_poli' => 1,
            ]

        ]);
    }
}
