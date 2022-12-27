<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'isi_pengumuman'=>"Mulai Tanggal 25 Desember 2022 sampai Tanggal 20 Januari 2023 Libur dan Masuk Sekolah Pada Tanggal 21 Januari 2023 "
        ]);
    }
}
