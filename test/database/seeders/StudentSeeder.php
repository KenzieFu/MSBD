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
      //Kelas Anggur
        User::create([
            'name'=>"Student",
            'NIS'=>"0101001",
            'email'=>"student@gmail.com",
            'gender'=>"L",

            'id_kelas'=>1,
            
            'password'=>Hash::make("0101001"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Nomor",
            'NIS'=>"0101002",
            'email'=>"nomor@gmail.com",
            'gender'=>"L",
            
            'id_kelas'=>1,
            'password'=>Hash::make("0101002"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Bayu",
            'NIS'=>"0101003",
            'email'=>"bayu@gmail.com",
            'gender'=>"L",
            'id_kelas'=>1,
            'password'=>Hash::make("0101003"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Natha",
            'NIS'=>"0101004",
            'email'=>"natha@gmail.com",
            'gender'=>"P",
            'id_kelas'=>1,
            'password'=>Hash::make("0101004"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Andre",
            'NIS'=>"0101005",
            'email'=>"Andre@gmail.com",
            'gender'=>"L",
            'id_kelas'=>1,
            'password'=>Hash::make("0101005"),
            'angkatan'=>1
          ]);

          //Kelas Bangka
        User::create([
            'name'=>"Dani",
            'NIS'=>"0101006",
            'email'=>"dani@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0101006"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Hans",
            'NIS'=>"0101007",
            'email'=>"hans@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0101007"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Peter",
            'NIS'=>"0101008",
            'email'=>"peter@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0101008"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Ucok",
            'NIS'=>"0101009",
            'email'=>"ucok@gmail.com",
            'gender'=>"L",
            'id_kelas'=>2,
            'password'=>Hash::make("0101009"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Mimi",
            'NIS'=>"0101010",
            'email'=>"mimi@gmail.com",
            'gender'=>"P",
            'id_kelas'=>2,
            'password'=>Hash::make("0101010"),
            'angkatan'=>1
          ]);

          //Kelas Puas
        User::create([
            'name'=>"Dom",
            'NIS'=>"0101011",
            'email'=>"dom@gmail.com",
            'gender'=>"L",
            'id_kelas'=>3,
            'password'=>Hash::make("0101011"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Troy",
            'NIS'=>"0101012",
            'email'=>"troy@gmail.com",
            'gender'=>"L",
            'id_kelas'=>3,
            'password'=>Hash::make("0101012"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Dante",
            'NIS'=>"0101013",
            'email'=>"dante@gmail.com",
            'gender'=>"L",
            'id_kelas'=>3,
            'password'=>Hash::make("0101013"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Jessy",
            'NIS'=>"0101014",
            'email'=>"jessy@gmail.com",
            'gender'=>"P",
            'id_kelas'=>3,
            'password'=>Hash::make("0101014"),
            'angkatan'=>1
          ]);
        User::create([
            'name'=>"Tuti",
            'NIS'=>"0101015",
            'email'=>"tuti@gmail.com",
            'gender'=>"P",
            'id_kelas'=>3,
            'password'=>Hash::make("0101015"),
            'angkatan'=>1
          ]);
    }
}
