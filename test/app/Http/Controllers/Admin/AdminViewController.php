<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Admin as admin;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\DB;
use App\Models\Rombel;
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
        $daftarkelas=Kelas::get();
      
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        if(!$active)
        {
            return redirect()->back()->with("success","Aktifkan Tahun Ajaran Terlebih dahulu");
        }
        return view('admin.page.CRUD.createSiswa',compact('daftarkelas'));
    }





    //fungsi untuk menampilkan page form menambahkan Rombel baru
    public function pageAddRombel(){
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        $daftarkelas=Kelas::get();
        $wali=DB::select(DB::raw('SELECT * FROM teachers t WHERE NOT EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik ='.$active->id.' && r.id_wali=t.id)'));
     
        
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        if(!$active)
        {
            return redirect()->back()->with("success","Aktifkan Tahun Ajaran Terlebih dahulu");
        }
        return view('admin.page.CRUD.createRombel',compact('daftarkelas','wali'));
    }







    //fungsi utk menampilkan page thn akademik
    public function thnak()
    {
        $thnak=TahunAkademik::get();
        return view('admin.page.thnaka',compact('thnak'));
    }

    //Fungi Menampilkan Kelas
    public function kelas()
    {
        $class=Kelas::get();
        return view ('admin.page.kelas',compact('class'));
    }
    //fungsi untuk menampilkan rombel
    public function rombel()
    {  
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        $rombel=null;
        if(!$active)
        {
            $rombel=Rombel::get();
        }
        else
        {
            $rombel=Rombel::where("id_thnakademik",$active->id)->get();
        }
       
        return view ('admin.page.rombel',compact('rombel'));
    }


}
