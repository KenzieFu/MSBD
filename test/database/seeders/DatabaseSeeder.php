<?php

namespace Database\Seeders;
use Database\Seeders\TeacherSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\TahunAkademikSeeder;
use Database\Seeders\KelasSeeder;

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
            AdminSeeder::class,
            TahunAkademikSeeder::class,
            KelasSeeder::class
        ]);
    }
}
