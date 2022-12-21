<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\roster_rombel;

class RosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        roster_rombel::create([
            'id_mapel'=>1,
            'Hari'=>"Senin",
            'id_rombel'=>1,
            'id_guru'=>"0102001",
            'sesi1'=>"08:20",
            'sesi2'=>"09:00",

        ]);
    }
}
