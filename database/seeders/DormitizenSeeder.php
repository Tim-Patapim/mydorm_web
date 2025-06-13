<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DormitizenSeeder extends Seeder
{
    public function run(): void
    {
        $dormitizenData = [];
        $kamar = DB::table('kamar')->get();

        $nama_depan_pria = [
            "Agus",
            "Rizky",
            "Ahmad",
            "Fajar",
            "Hendra",
            "Muhammad",
            "Joko",
            "Bayu"
        ];

        $nama_tengah_pria = [
            "Prasetyo",
            "Wahyudi",
            "Saputra",
            "Kurniawan",
            "Surya",
            "Permadi",
            "Cahyono",
        ];

        $nama_akhir_pria = [
            "Santoso",
            "Putra",
            "Saputra",
            "Gunawan",
            "Ramadhan",
            "Pratama",
            "Rahman",
        ];

        $nama_depan_wanita = [
            "Siti",
            "Dewi",
            "Ayu",
            "Fitri",
            "Indah",
            "Lina",
            "Rina",
            "Nadia",
        ];

        $nama_tengah_wanita = [
            "Kartika",
            "Sari",
            "Wulandari",
            "Melati",
            "Permata",
            "Cahyani",
            "Anggraeni",
        ];

        $nama_akhir_wanita = [
            "Putri",
            "Dewi",
            "Lestari",
            "Saputri",
            "Anggraini",
            "Pratiwi",
            "Handayani",
        ];

        // Kombinasi nama lengkap pria
        $namaPria = [];
        foreach ($nama_depan_pria as $depan) {
            foreach ($nama_tengah_pria as $tengah) {
                foreach ($nama_akhir_pria as $akhir) {
                    $namaPria[] = $depan . " " . $tengah . " " . $akhir;
                }
            }
        }

        // Kombinasi nama lengkap wanita
        $namaWanita = [];
        foreach ($nama_depan_wanita as $depan) {
            foreach ($nama_tengah_wanita as $tengah) {
                foreach ($nama_akhir_wanita as $akhir) {
                    $namaWanita[] = $depan . " " . $tengah . " " . $akhir;
                }
            }
        }

        // Filter kamar menjadi pria dan wanita
        $kamarPria = $kamar->slice(0, 92); // 92 kamar pertama untuk pria
        $kamarWanita = $kamar->slice(92, 92); // 92 kamar berikutnya untuk wanita
        $prodi = ['Informatika', 'Teknik Industri', 'Desain Produk', 'Rekayasa Perangkat Lunak'];
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
        $index_prodi = 0;
        $index_dormitizen = 0;
        $index_agama = 0;

        foreach ($kamarPria as $kp) {
            for ($i = 0; $i < 4; $i++){
                $nim = strval(1302220000 + $index_dormitizen);
                $no_hp = '08' . strval(2000000000+(12345*$index_dormitizen));
                $no_hp_ortu = '08' . strval(5400000000+(22345*$index_dormitizen));
                
                $dormitizenData[] = [
                    // 'dormitizen_id' => $idDormitizen++,
                    'nim' => $nim,
                    'nama' => $namaPria[$index_dormitizen++],
                    'prodi' => $prodi[$index_prodi],
                    'agama' => $agama[$index_agama],
                    'no_hp' => $no_hp,
                    'no_hp_ortu' => $no_hp_ortu,
                    'alamat_ortu' => 'Jl. MH Thamrin No. 1, Menteng, Jakarta Pusat, DKI Jakarta.',
                    'gambar' => '-',
                    'kamar_id' => $kp->kamar_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $index_prodi = ($index_prodi + 1) % count($prodi);
                $index_agama = ($index_agama + 1) % count($agama);
            }
        }

        $index_dormitizen = 0;

        foreach ($kamarWanita as $kp) {
            for ($i = 0; $i < 4; $i++){
                $nim = strval(1302223000 + $index_dormitizen);
                $no_hp = '08' . strval(3000000000+(12345*$index_dormitizen));
                $no_hp_ortu = '08' . strval(9700000000+(22345*$index_dormitizen));

                $dormitizenData[] = [
                    // 'dormitizen_id' => $idDormitizen++,
                    'nim' => $nim,
                    'nama' => $namaWanita[$index_dormitizen++],
                    'prodi' => $prodi[$index_prodi],
                    'agama' => $agama[$index_agama],
                    'no_hp' => $no_hp,
                    'no_hp_ortu' => $no_hp_ortu,
                    'alamat_ortu' => 'Jl. Tunjungan No. 25, Genteng, Kota Surabaya, Jawa Timur.',
                    'gambar' => '-',
                    'kamar_id' => $kp->kamar_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $index_prodi = ($index_prodi + 1) % count($prodi);
                $index_agama = ($index_agama + 1) % count($agama);
            }
        }
        DB::table('dormitizen')->insert($dormitizenData);
    }
}


