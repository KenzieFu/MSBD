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
use App\Models\Announcement;
use Carbon\Carbon;
use PDF;


class AdminViewController extends Controller
{
   
    public function thnabsensiguru()
    {
        $thn=DB::select('SELECT * FROM tahun_akademiks');
        return view('admin.page.absensiguru',compact('thn'));
        
    }


    public function updateJadwal(Request $request)
    {
        $roster=collect(DB::select('SELECT * FROM semua_jadwal WHERE id='.$request->id_roster.''))->first();
        $mapel=DB::select('SELECT * FROM mapels WHERE status="Aktif" ');
        $teacher=DB::select('SELECT * FROM teachers WHERE status="Aktif"');
        
        return view('admin.page.CRUD.updateJadwal',compact('roster','mapel','teacher'));
    }


    public function pengumuman()
    {
        $pengumuman=Announcement::get();
         return view('admin.page.pengumuman',compact('pengumuman'));
    }





   
    public function index()
    {
        $ann=collect(DB::select('SELECT * FROM announcements ORDER BY created_at DESC LIMIT 1 '))->first();
        return view('admin.page.dashboard',compact('ann'));
    }


    //Fungsi page menampilkan daftar siswa
    public function userTable(){
        $users=DB::select('SELECT * FROM data_siswa');
    
        return view('admin.page.siswa',compact('users'));
    }

    //fungsi untuk menampilkan page daftar guru
    public function teacherTable(){
        $teachers=DB::select('SELECT * FROM data_guru ');
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

    public function pageAddGuru()
    {
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        if(!$active)
        {
            return redirect()->back()->with("success","Aktifkan Tahun Ajaran Terlebih dahulu");
        }
        return view('admin.page.CRUD.createGuru');
    }





    //fungsi untuk menampilkan page form menambahkan Rombel baru
    public function pageAddRombel(){
        $active=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        if(!$active)
        {
            return redirect()->back()->with("success","Aktifkan Tahun Ajaran Terlebih dahulu");
        }
        $daftarkelas=Kelas::get();
        $wali=DB::select(DB::raw('SELECT * FROM teachers t WHERE status="Aktif" AND NOT EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik ='.$active->id.' && r.id_wali=t.NIG)'));
     
        
     
        
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
        $guru=DB::select('SELECT * FROM teachers WHERE status="Aktif"');
      
        if(!$active)
        {
            $rombel=DB::select('SELECT * FROM data_rombel');
        }
        else
        {
            $rombel=DB::select('SELECT * FROM data_rombel_thn');
        }
        
       
        return view ('admin.page.rombel',compact('rombel','guru'));
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
    public function jadwal_kelas(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $roster=DB::select('SELECT * FROM roster_kelas WHERE id_rombel=? ',array($request->id_rombel));
        return view('admin.page.mapelkelas',compact('roster','rombel'));
    }

    public function pageAddJadwal(Request $request)
    { 
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        $mapel=DB::select('SELECT * FROM mapels WHERE status="Aktif" ');
        $teacher=DB::select('SELECT * FROM teachers WHERE status="Aktif"');
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        
        return view('admin.page.CRUD.createJadwal',compact('rombel','mapel','teacher'));
    }

    public function nilaisiswa(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $daftar_siswa=DB::select('SELECT * FROM data_rombel_siswa WHERE id_rombel= ?',array($request->id_rombel));
        return view('admin.page.nilai_siswa',compact('rombel','daftar_siswa'));
        
    }

    public function updateNilai(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $data_siswa=collect(DB::select('SELECT * FROM students WHERE NIS='.$request->NIS.''))->first();
        $nilai_siswa=DB::select('SELECT * FROM nilai_mapel_siswa WHERE id_rsiswa='.$request->id_rsiswa.'');
        
        
      

        return view('admin.page.CRUD.updateNilaiSiswa',compact('rombel','nilai_siswa','data_siswa'));
    }

    public function absensiSiswa(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
      
        $absensi_siswa=DB::select('SELECT * FROM absensisiswa WHERE  id_rombel='.$request->id_rombel.'');

        return view('admin.page.absensi_siswa',compact('rombel','absensi_siswa'));
    }

    public function reportsiswa(){

        $tes = DB::select('SELECT a.NIS, a.name, a.gender, a.SMP, a.nama_kelas, a.Tahun_Masuk, b.updated_at FROM data_siswa a LEFT JOIN students b ON a.NIS=b.NIS');
        $pdf = PDF::loadview('report.admin.tes',compact('tes'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('laporan_admin.pdf');

    }

    public function reportkelas(){

        $data= DB::select('SELECT a.id, a.name, a.nama_kelas, a.SMP, a.TahunAjaran, a.status, a.jumlah, b.updated_at FROM data_rombel a LEFT JOIN rombels b ON a.id=b.id');
        $pdf = PDF::loadview('report.admin.tes1',compact('data'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('laporan_admin.pdf');

    }

    public function reportmapel(){

        $data= DB::select('SELECT * FROM mapels');
        $pdf = PDF::loadview('report.admin.tes2',compact('data'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('laporan_admin.pdf');

    }

    public function reportteacher(){

        $data= DB::select('SELECT a.NIG, a.name, a.alias, a.gender, a.alamat, a.Tahun_Masuk, b.updated_at FROM data_guru a LEFT JOIN teachers b ON a.NIG=b.NIG');
        $pdf = PDF::loadview('report.admin.tes3',compact('data'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('laporan_admin.pdf');

    }

  

}
