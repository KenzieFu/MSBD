<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>"Student",
            'NIS'=>"0135001",
            'email'=>"student@gmail.com",
            'gender'=>"L",
            'id_kelas'=>1,
            'password'=>Hash::make("0135001"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Nomor",
            'NIS'=>"0135002",
            'email'=>"nomor@gmail.com",
            'gender'=>"L",
            'id_kelas'=>1,
            'password'=>Hash::make("0135002"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Bayu",
            'NIS'=>"0135003",
            'email'=>"bayu@gmail.com",
            'gender'=>"P",
            'id_kelas'=>1,
            'password'=>Hash::make("0135003"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Natha",
            'NIS'=>"0135004",
            'email'=>"natha@gmail.com",
            'gender'=>"L",
            'id_kelas'=>1,
            'password'=>Hash::make("0135004"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Andre",
            'NIS'=>"0135005",
            'email'=>"Andre@gmail.com",
            'gender'=>"P",
            'id_kelas'=>2,
            'password'=>Hash::make("0135005"),
            'angkatan'=>1
          ]);

          
        User::create([
            'name'=>"Dani",
            'NIS'=>"0135006",
            'email'=>"dani@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0135006"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Hans",
            'NIS'=>"0135007",
            'email'=>"hans@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0135007"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Peter",
            'NIS'=>"0135008",
            'email'=>"peter@gmail.com",
            'gender'=>"P",
            'id_kelas'=>2,
            'password'=>Hash::make("0135008"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Ucok",
            'NIS'=>"0135009",
            'email'=>"ucok@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0135009"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Mimi",
            'NIS'=>"0135010",
            'email'=>"mimi@gmail.com",
            'gender'=>"P",
            'id_kelas'=>2,
            'password'=>Hash::make("0135010"),
            'angkatan'=>1
          ]);
    }
}
