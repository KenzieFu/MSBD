<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Admin as admin;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function index()
    {
        return view('admin.page.dashboard');
    }


    //Fungsi page menampilkan daftar siswa
    public function userTable(){
        $users=User::get();
        return view('admin.page.siswa',compact('users'));
    }

    //fungsi untuk menampilkan page daftar guru
    public function teacherTable(){
        $teachers=Teacher::get();
        return view('admin.page.guru',compact('teachers'));
    }

    //funsgi untuk menampilkan page daftar admin
    public function adminTable(){
        $admins=admin::get();
        return view('admin.page.admin',compact('admins'));
    }

    //fungsi untuk menampilkan page form menambahkan siswa baru
    public function pageAddUser(){
        return view('admin.page.CRUD.createSiswa');
    }

    //fungsi utk menampilkan page thn akademik
    public function thnak()
    {
        $thnak=TahunAkademik::get();
        return view('admin.page.thnaka',compact('thnak'));
    }



}
