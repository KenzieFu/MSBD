<?php

namespace Database\Seeders;

use App\Models\roster_rombel;
use Database\Seeders\TeacherSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\TahunAkademikSeeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\RosterSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TeacherSeeder::class,
            MapelSeeder::class,
            AdminSeeder::class,
            TahunAkademikSeeder::class,
            KelasSeeder::class,
            StudentSeeder::class,
            RombelSeeder::class,
            RosterSeeder::class,
            PengumumanSeeder::class,
            
        ]);
    }
}
