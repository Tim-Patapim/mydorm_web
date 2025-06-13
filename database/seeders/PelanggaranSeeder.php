<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggaran = [
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "292"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "292"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "292"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "174"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "174"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "100"
            ],
            [
                'kategori' => 'merokok',
                "waktu" => "2024-12-30 16:16:16.000000",
                "gambar" => "bukti_pelanggaran.jpg",
                "senior_resident_id" => "1",
                "dormitizen_id" => "50"
            ],
        ];
        DB::table('pelanggaran')->insert($pelanggaran);
    }
}
