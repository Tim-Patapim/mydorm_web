<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HelpdeskSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua gedung
        $gedungs = Gedung::all();
        $helpdeskData = [];
        $index = 0;
        $helpdesk = [
            ["nama" => "Cahyadi Prakasa", "nip" => "202401010101000001", "username" => "cahyadi", "password" => "12345"],
            ["nama" => "Indra Mansur", "nip" => "202401010102000002", "username" => "indra", "password" => "12345"],
            ["nama" => "Luthfi Budiman", "nip" => "202401010103000003", "username" => "luthfi", "password" => "12345"],
            ["nama" => "Emong Halim", "nip" => "202401010104000004", "username" => "emong", "password" => "12345"],
            ["nama" => "Cinta Mandasari", "nip" => "202401010105000005", "username" => "cinta", "password" => "12345"],
            ["nama" => "Ina Purnawati", "nip" => "202401010106000006", "username" => "ina", "password" => "12345"],
            ["nama" => "Febi Hariyah", "nip" => "202401010107000007", "username" => "febi", "password" => "12345"],
            ["nama" => "Jane Permata", "nip" => "202401010108000008", "username" => "jane", "password" => "12345"]
        ];

        // Untuk setiap gedung, buat 4 helpdesk
        foreach ($gedungs as $gedung) {
            for ($i = 0; $i < 4; $i++) {
                $helpdeskData[] = [
                    'nama' => $helpdesk[$index]['nama'],
                    'nip' => $helpdesk[$index]['nip'],
                    'username' => $helpdesk[$index]['username'],
                    'password' => Hash::make($helpdesk[$index]['password']),
                    'gedung_id' => $gedung->gedung_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $index++;
            }
        }

        DB::table('helpdesk')->insert($helpdeskData);
    }
}
