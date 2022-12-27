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
            "id_wali"=>"0102001",
            "SMP"=>1
        ]);

        Rombel::create([
            "id_kelas"=>2,
            "id_thnakademik"=>1,
            "id_wali"=>"0102003",
            "SMP"=>1
        ]);

        Rombel::create([
            "id_kelas"=>3,
            "id_thnakademik"=>1,
            "id_wali"=>"0102005",
            "SMP"=>1
        ]);
        
        Rombel::create([
            "id_kelas"=>1,
            "id_thnakademik"=>1,
            "id_wali"=>"0102002",
            "SMP"=>2
        ]);
    }
}
