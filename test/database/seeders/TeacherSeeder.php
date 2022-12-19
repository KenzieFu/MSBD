<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Teacher::create([
        "NIG"=>"0102001",
        "angkatan"=>1,
        "alias"=>"GZL",
        'name'=>"Gozali",
        "gender"=>"L",
        "Kota_Lahir"=>"Medan",
        'email'=>"teacher@gmail.com",
        'password'=>Hash::make("0102001")
      ]);
      Teacher::create([
        "NIG"=>"0102002",
        "alias"=>"TBS",
        'name'=>"Tobias",
        "gender"=>"L",
        'email'=>"tob@gmail.com",
        
        "angkatan"=>1,
        'password'=>Hash::make("0102002")
      ]);
      
      

     
    }
}
