<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\absensi_siswa;
use Illuminate\Support\Facades\Session;
use App\Models\NilaiSiswa;
class TeacherController extends Controller
{
    public function index()
    {
        $ann=collect(DB::select('SELECT * FROM announcements ORDER BY created_at DESC LIMIT 1 '))->first();
        return view('teacher.dashboard',compact('ann'));
    }

    public function walikelas()
    {

        
       $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       
       if($check->res == 0)
       {
        return redirect()->route('teacher.dashboard')->with('success','Tahun Ajaran Belum Dimulai');

       }

       
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $rombel=collect(DB::select('SELECT * FROM data_rombel WHERE status="Aktif" '))->first();

        if($rombel == null)
       {
        
     
        return redirect()->route('teacher.dashboard')->with('success','Anda Bukan Merupakan Wali Kelas Saat Ini');
       }


        $daftar_siswa=DB::select('SELECT * FROM data_rombel_siswa WHERE id_rombel= ?',array($rombel->id));
        

        return view('teacher.walikelas',compact('rombel','daftar_siswa'));
    }

    public function rombelsiswa(Request $request){
     
       
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id=? ',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }

        $daftar_siswa=DB::select('SELECT * FROM data_rombel_siswa WHERE id_rombel= ?',array($request->id_rombel));
        

        return view('teacher.walikelas',compact('rombel','daftar_siswa'));
        
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
        return view('teacher.jadwalKelas',compact('roster','rombel'));
    }

    public function absensiswa(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
      
        $absensi_siswa=DB::select('SELECT * FROM absensisiswa WHERE  id_rombel='.$request->id_rombel.'');

        return view('teacher.absensiswa',compact('rombel','absensi_siswa'));
    }

    public function updtAbsensi(Request $request)
    {
       for($x=0;$x<count($request->get('id'));$x++)
       {
           $absensi_siswa=absensi_siswa::find($request->get('id')[$x]);
           
           $absensi_siswa->absen=$request->get('absen')[$x];
           $absensi_siswa->sakit=$request->get('sakit')[$x];
           $absensi_siswa->izin=$request->get('izin')[$x];
           $absensi_siswa->save();
         
          /*  $data[]=[
               'id'=>$request->get('id')[$x],
               'nilai'=>$request->get('nilai')[$x]
           ]; */
       }
       
       $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
       foreach($rombel as $r)
       {
           $rombel=$r;
           break;
       }
       
       $absensi_siswa=DB::select('SELECT * FROM absensisiswa WHERE  id_rombel='.$request->id_rombel.'');
       Session::flash('success', 'Absensi Berhasil Di update'); 
       return view('teacher.absensiswa',compact('rombel','absensi_siswa'));

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
        return view('teacher.nilaisiswa',compact('rombel','daftar_siswa'));
        
    }

    public function lihatNilai(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $data_siswa=collect(DB::select('SELECT * FROM students WHERE NIS='.$request->NIS.''))->first();
        $nilai_siswa=DB::select('SELECT * FROM nilai_mapel_siswa WHERE id_rsiswa='.$request->id_rsiswa.'');
        
        
      

        return view('teacher.lihatNilai',compact('rombel','nilai_siswa','data_siswa'));
    }

    public function jadwalGuru(Request $request)
    {
        $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       
       if($check->res == 0)
       {
        return redirect()->route('teacher.dashboard')->with('success','Tahun Ajaran Belum Dimulai');

       }

       
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $jadwal=DB::select('SELECT * FROM semua_jadwal WHERE NIG="'.$nig.'" AND status_tahun="Aktif" ');

       
        

        return view('teacher.jadwalGuru',compact('jadwal'));
    }

    public function inputnilai(Request $request)
    {
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $jadwal=collect(DB::select('SELECT  * FROM semua_jadwal WHERE NIG="'.$nig.'" AND id_rombel= '.$request->id_rombel.''))->first();
    
        $daftar_siswa=DB::select('SELECT * FROM input_nilai_mapel WHERE id_rombel= '.$request->id_rombel.' AND id_mapel='.$request->id_mapel.'');
      
        return view('teacher.inputnilai',compact('jadwal','daftar_siswa'));
        

    }

    public function mapelguru(Request $request)
    {
        $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       
       if($check->res == 0)
       {

        return redirect()->route('teacher.dashboard')->with('success','Tahun Ajaran Belum Dimulai');

       }

       
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $jadwal=DB::select('SELECT DISTINCT alias,nama_kelas,SMP,mapel,TahunAjaran,id_rombel,id_mapel FROM semua_jadwal WHERE NIG="'.$nig.'" AND status_tahun="Aktif" ');

       
        

        return view('teacher.mapelguru',compact('jadwal'));
    }

    public function updtnilai(Request $request)
    {
        for($x=0;$x<count($request->get('id'));$x++)
        {
            $nilai_siswa=NilaiSiswa::find($request->get('id')[$x]);
            $nilai_siswa->nilai=$request->get('nilai')[$x];
            $nilai_siswa->save();
         
        }

        return redirect()->back()->with('success','Nilai Berhasil di Update');
    }


    public function rekapwali(Request $request)
    {
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $rombel=DB::select('SELECT * FROM data_rombel WHERE NIG='.$nig.'');
        return view('teacher.rekap-wali',compact('rombel'));

    }

    public function rekapmapel(Request $request)
    {
        $nig=str_pad(auth()->user()->id,7,"0",STR_PAD_LEFT);
        $jadwal=DB::select('SELECT DISTINCT alias,nama_kelas,SMP,mapel,TahunAjaran,id_rombel,id_mapel FROM semua_jadwal WHERE NIG="'.$nig.'"');

       
        

        return view('teacher.rekapmapel',compact('jadwal'));
    }

    

  

}
