<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mapel::create([
            'mapel'=>"PAI",
        ]);

        Mapel::create([
            'mapel'=>"TIC",
        ]);
        Mapel::create([
            'mapel'=>"Civic",
        ]);
        Mapel::create([
            'mapel'=>"English",
        ]);
        Mapel::create([
            'mapel'=>"B.Ind",
        ]);
        Mapel::create([
            'mapel'=>"Math",
        ]);
        Mapel::create([
            'mapel'=>"Art&Cult",
        ]);
        Mapel::create([
            'mapel'=>"IPA",
        ]);
        Mapel::create([
            'mapel'=>"Arabic",
        ]);
        Mapel::create([
            'mapel'=>"IPS",
        ]);
        Mapel::create([
            'mapel'=>"Sport",
        ]);
        

    }
}
