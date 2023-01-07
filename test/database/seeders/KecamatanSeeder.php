<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kecamatan::create([
            'Kecamatan'=>'Kec. Medan Area'
        ]);
        Kecamatan::create([
            'Kecamatan'=>'Kec. Medan Denai'
        ]);
     
    }
}
