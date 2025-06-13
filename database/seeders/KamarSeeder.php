<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamarData = [];
        $gedung = DB::table('gedung')->get(); // Ambil data semua gedung

        foreach ($gedung as $g) {
            // Lantai 1: 22 kamar
            for ($i = 1; $i <= 20; $i++) {
                $kamarData[] = [
                    'nomor' => '1' . str_pad($i, 2, '0', STR_PAD_LEFT), // Format 1xx
                    'status' => 'terkunci', // Default status
                    'gedung_id' => $g->gedung_id,
                ];
            }

            // Lantai 2, 3, dan 4: 24 kamar per lantai
            for ($lantai = 2; $lantai <= 4; $lantai++) {
                for ($i = 1; $i <= 24; $i++) {
                    if ($i % 2 == 0) {
                        $kamarData[] = [
                            'nomor' => $lantai . str_pad($i, 2, '0', STR_PAD_LEFT), // Format Lantai xx
                            'status' => 'terbuka', // Default status
                            'gedung_id' => $g->gedung_id,
                        ];
                    } else {
                        $kamarData[] = [
                            'nomor' => $lantai . str_pad($i, 2, '0', STR_PAD_LEFT), // Format Lantai xx
                            'status' => 'terkunci', // Default status
                            'gedung_id' => $g->gedung_id,
                        ];
                    }
                }
            }
        }

        // Insert data ke database
        DB::table('kamar')->insert($kamarData);
    }
}
