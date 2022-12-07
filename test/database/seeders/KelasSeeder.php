<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
        
            'nama_kelas'=>"Anggur"
          ]);
        Kelas::create([
            
            'nama_kelas'=>"Bangka"
          ]);
    }
}
