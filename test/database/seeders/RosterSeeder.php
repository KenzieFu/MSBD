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
        roster_rombel::create([
            'id_mapel'=>2,
            'Hari'=>"Senin",
            'id_rombel'=>1,
            'id_guru'=>"0102002",
            'sesi1'=>"10:00",
            'sesi2'=>"10:40",

        ]);

        roster_rombel::create([
            'id_mapel'=>3,
            'Hari'=>"Senin",
            'id_rombel'=>1,
            'id_guru'=>"0102005",
            'sesi1'=>"11:20",
            'sesi2'=>"12:00",

        ]);

        roster_rombel::create([
            'id_mapel'=>5,
            'Hari'=>"Senin",
            'id_rombel'=>2,
            'id_guru'=>"0102003",
            'sesi1'=>"08:20",
            'sesi2'=>"09:00",

        ]);

        roster_rombel::create([
            'id_mapel'=>1,
            'Hari'=>"Selasa",
            'id_rombel'=>2,
            'id_guru'=>"0102005",
            'sesi1'=>"10:00",
            'sesi2'=>"10:40",
        ]);
    }
}
