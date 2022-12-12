<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rombel;

class RombelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rombel::create([
            "id_kelas"=>1,
            "id_thnakademik"=>1,
            "id_wali"=>1,
            "SMP"=>1
        ]);
    }
}
