<?php

namespace Database\Seeders;

use App\Models\SeniorResident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder utama
        $this->call([
            GedungSeeder::class,
            KamarSeeder::class,
            DormitizenSeeder::class,
        ]);

        // Jalankan SeniorResidentSeeder setelah seeding selesai
        $this->seedPartDua();
    }

    /**
     * Fungsi untuk menjalankan SeniorResidentSeeder.
     */
    protected function seedPartDua(): void
    {
        $this->call([
            SeniorResidentSeeder::class,
            HelpdeskSeeder::class
        ]);

        $this->seedPartTiga();
    }

    protected function seedPartTiga(): void
    {
        $this->call([
            PaketSeeder::class,
            LogKeluarMasukSeeder::class,
            PelanggaranSeeder::class
        ]);
    }
}
