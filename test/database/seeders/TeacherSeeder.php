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
        "NIG"=>"GZL",
        'name'=>"Gozali",
        'email'=>"teacher@gmail.com",
        'password'=>Hash::make("12345678")
      ]);
      Teacher::create([
        "NIG"=>"TBS",
        'name'=>"Tobias",
        'email'=>"tob@gmail.com",
        'password'=>Hash::make("12345678")
      ]);
      
      

     
    }
}
