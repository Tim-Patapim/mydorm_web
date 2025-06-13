<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogKeluarMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logs = [
            [
                "waktu" => "2024-12-30 16:16:16.000000",
                "aktivitas" => "keluar",
                "status" => "diterima",
                "dormitizen_id" => "197",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 18:16:16.000000",
                "aktivitas" => "keluar",
                "status" => "ditolak",
                "dormitizen_id" => "211",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 20:16:16.000000",
                "aktivitas" => "keluar",
                "status" => "pending",
                "dormitizen_id" => "301",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 21:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "diterima",
                "dormitizen_id" => "4",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 22:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "ditolak",
                "dormitizen_id" => "49",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 23:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "pending",
                "dormitizen_id" => "209",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 23:30:00.000000",
                "aktivitas" => "keluar",
                "status" => "diterima",
                "dormitizen_id" => "28",
                "helpdesk_id" => "3",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 00:15:00.000000",
                "aktivitas" => "masuk",
                "status" => "ditolak",
                "dormitizen_id" => "104",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 01:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "pending",
                "dormitizen_id" => "66",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 02:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "diterima",
                "dormitizen_id" => "205",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 03:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "ditolak",
                "dormitizen_id" => "84",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 04:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "pending",
                "dormitizen_id" => "37",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 05:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "diterima",
                "dormitizen_id" => "256",
                "helpdesk_id" => "3",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 06:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "ditolak",
                "dormitizen_id" => "100",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 07:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "pending",
                "dormitizen_id" => "15",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 08:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "diterima",
                "dormitizen_id" => "193",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 09:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "ditolak",
                "dormitizen_id" => "74",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 10:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "pending",
                "dormitizen_id" => "38",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 11:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "diterima",
                "dormitizen_id" => "95",
                "helpdesk_id" => "3",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 12:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "ditolak",
                "dormitizen_id" => "324",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 13:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "pending",
                "dormitizen_id" => "266",
                "helpdesk_id" => null,
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 14:00:00.000000",
                "aktivitas" => "masuk",
                "status" => "diterima",
                "dormitizen_id" => "176",
                "helpdesk_id" => "1",
                "senior_resident_id" => null
            ],
            [
                "waktu" => "2024-12-30 15:00:00.000000",
                "aktivitas" => "keluar",
                "status" => "ditolak",
                "dormitizen_id" => "56",
                "helpdesk_id" => "2",
                "senior_resident_id" => null
            ],
        ];
        DB::table('log_keluar_masuk')->insert($logs);
    }
}
