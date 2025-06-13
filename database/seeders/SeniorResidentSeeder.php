<?php

namespace Database\Seeders;

use App\Models\SeniorResident;
use App\Models\Kamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeniorResidentSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kamar dengan nomor 101
        $kamar101 = Kamar::where('nomor', '101')->get();

        // Array untuk menyimpan data senior resident
        $seniorResidentData = [];

        foreach ($kamar101 as $kamar) {
            // Ambil hingga 4 penghuni dari kamar tersebut
            $dormitizens = $kamar->dormitizens()->take(4)->get();

            if ($dormitizens->isEmpty()) {
                echo "Tidak ada penghuni di kamar ID: {$kamar->id}\n";
                continue;
            }

            foreach ($dormitizens as $dormitizen) {
                // Menambahkan data untuk senior resident
                $seniorResidentData[] = [
                    'dormitzen_id' => $dormitizen->dormitizen_id, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Jika ada data senior resident yang dikumpulkan, masukkan ke tabel senior_resident
        if (!empty($seniorResidentData)) {
            DB::table('senior_resident')->insert($seniorResidentData);
        }
    }
}
