<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paket = [
            [
                "waktu_tiba" => "2024-12-29 23:55:31.000000",
                "dormitizen_id" => "236",
                "penerima_paket" => "1",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 10:15:45.000000",
                "dormitizen_id" => "45",
                "penerima_paket" => "3",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 08:30:12.000000",
                "dormitizen_id" => "128",
                "penerima_paket" => "2",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 09:45:10.000000",
                "dormitizen_id" => "300",
                "penerima_paket" => "4",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 15:20:05.000000",
                "dormitizen_id" => "75",
                "penerima_paket" => "1",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 18:30:45.000000",
                "dormitizen_id" => "210",
                "penerima_paket" => "2",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 14:22:33.000000",
                "dormitizen_id" => "56",
                "penerima_paket" => "3",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 11:11:11.000000",
                "dormitizen_id" => "89",
                "penerima_paket" => "4",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 16:45:00.000000",
                "dormitizen_id" => "150",
                "penerima_paket" => "1",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 20:00:00.000000",
                "dormitizen_id" => "300",
                "penerima_paket" => "2",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 09:30:30.000000",
                "dormitizen_id" => "45",
                "penerima_paket" => "3",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 12:00:00.000000",
                "dormitizen_id" => "78",
                "penerima_paket" => "4",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 13:15:15.000000",
                "dormitizen_id" => "200",
                "penerima_paket" => "1",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 17:45:45.000000",
                "dormitizen_id" => "150",
                "penerima_paket" => "2",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 19:00:00.000000",
                "dormitizen_id" => "300",
                "penerima_paket" => "3",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 14:30:30.000000",
                "dormitizen_id" => "45",
                "penerima_paket" => "4",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 22:22:22.000000",
                "dormitizen_id" => "128",
                "penerima_paket" => "1",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 10:10:10.000000",
                "dormitizen_id" => "75",
                "penerima_paket" => "2",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-29 21:30:30.000000",
                "dormitizen_id" => "210",
                "penerima_paket" => "3",
                "gambar" => "images/gambarPaket/contoh-paket-2.jpg"
            ],
            [
                "waktu_tiba" => "2024-12-30 16:16:16.000000",
                "dormitizen_id" => "56",
                "penerima_paket" => "4",
                "gambar" => "images/gambarPaket/contoh-paket-1.jpg"
            ],
        ];



        DB::table('paket')->insert($paket);
    }
}
