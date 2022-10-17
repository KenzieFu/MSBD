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
        'name'=>"Teacher",
        'email'=>"teacher@gmail.com",
        'password'=>Hash::make("12345678")
      ]);

      User::create([
        'name'=>"Student",
        'email'=>"student@gmail.com",
        'password'=>Hash::make("12345678")
      ]);
    }
}
