<?php

namespace Database\Seeders;

use App\Models\TahunAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAkademik::create([
            "TahunAjaran"=>"2021/2022",
            "kurikulum"=>"K13",
            
            
        ]);
        TahunAkademik::create([
            "TahunAjaran"=>"2022/2023",
            "kurikulum"=>"K13",
         
            
        ]);
    }
}
