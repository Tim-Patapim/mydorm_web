<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gedungData = [
            //GD asrama putra
            ['kode' => 'A01', 'nama' => 'Laag','created_at' => now(), 'updated_at' => now()],

            // GD asrama putri
            ['kode' => 'B01', 'nama' => 'Dana','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('gedung')->insert($gedungData);
    }
}

