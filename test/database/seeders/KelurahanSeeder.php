<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelurahan::create([
            'Kelurahan'=>'Tegal Sari II',
            'id_kecamatan'=>1,
            'Kode_Pos'=>'20216'
        ]);
        Kelurahan::create([
            'Kelurahan'=>'Pasar Merah Timur',
            'id_kecamatan'=>1,
            'Kode_Pos'=>'20217'
        ]);
        Kelurahan::create([
            'Kelurahan'=>'Denai',
            'id_kecamatan'=>2,
            'Kode_Pos'=>'20227'
        ]);
        Kelurahan::create([
            'Kelurahan'=>'Medan Tenggara',
            'id_kecamatan'=>2,
            'Kode_Pos'=>'20228'
        ]);


      
    }
}
