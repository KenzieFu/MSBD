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
        $users=DB::select('SELECT * FROM data_siswa');
        
        return view('admin.page.siswa',compact('users'));
    }

    //fungsi untuk menampilkan page daftar guru
    public function teacherTable(){
        $teachers=DB::select('SELECT * FROM teachers');
        return view('admin.page.guru',compact('teachers'));
    }

    //funsgi untuk menampilkan page daftar admin
    public function adminTable(){
        $admins=DB::select('SELECT * FROM admins');
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
        if(!$active)
        {
            return redirect()->back()->with("success","Aktifkan Tahun Ajaran Terlebih dahulu");
        }
        $daftarkelas=Kelas::get();
        $wali=DB::select(DB::raw('SELECT * FROM teachers t WHERE NOT EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik ='.$active->id.' && r.id_wali=t.NIG)'));
     
        
     
        
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
            $rombel=DB::select('SELECT * FROM data_rombel');
        }
        else
        {
            $rombel=DB::select('SELECT * FROM data_rombel_thn');
        }
       
        return view ('admin.page.rombel',compact('rombel'));
    }


    public function detailsrombel(Request $request)
    {
       
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $daftar_siswa=DB::select('SELECT * FROM data_rombel_siswa WHERE id_rombel= ?',array($request->id_rombel));
       
        return view('admin.page.detailrombel',compact('rombel','daftar_siswa'));
    }

    public function mapel()
    {
        $mapel=DB::select('SELECT * FROM mapels ');
        return view('admin.page.mapel',compact('mapel'));   
    }


}
