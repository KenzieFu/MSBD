<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('profilesiswa');
    }
    //updt profile

    public function updtprofile(Request $request)
    {
        $user=User::find(auth()->user()->NIS);
        $user->name=$request->name;
        $user->alamat=$request->alamat;
        $user->Kota_Lahir=$request->Kota_Lahir;
        $user->save();
        return redirect()->route('profile')->with('success','Data Berhasil Diupdate');
    }

    public function daftarsiswa(Request $request){
       
       

       $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       
       if($check->res == 0)
       {
        return redirect()->route('dashboard')->with('success','Tahun Ajaran Belum Dimulai');

       }

       if($request->id_rombel == null)
       {
        
     
        return redirect()->route('dashboard')->with('success','Kelas Anda Belum Dibagi');
       }
    
      
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id=? AND id_thnakademik=? AND status="Aktif"',array($request->id_rombel,$request->id_thnakademik));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }

        $daftar_siswa=DB::select('SELECT * FROM data_rombel_siswa WHERE id_rombel= ?',array($request->id_rombel));
        

        return view('kelasSiswa',compact('rombel','daftar_siswa'));
        
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
        return view('jadwalKelas',compact('roster','rombel'));
    }

    public function nilaisiswa(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $nis=str_pad(auth()->user()->NIS,7,"0",STR_PAD_LEFT);
        
        $rsiswa=collect(DB::select('SELECT * FROM rombel_siswas WHERE id_rombel='.$request->id_rombel.' AND id_siswa='.$nis.''))->first();
       
        $data_siswa=collect(DB::select('SELECT * FROM students WHERE NIS='.$nis.''))->first();
      
         $nilai_siswa=DB::select('SELECT * FROM nilai_mapel_siswa WHERE id_rsiswa='.$rsiswa->id.''); 

         return view('nilaisiswa',compact('rombel','data_siswa','nilai_siswa'));
        
    }

    public function absensiswa(Request $request)
    {
        $rombel=DB::select('SELECT * FROM data_rombel WHERE id= ?',array($request->id_rombel));
        foreach($rombel as $r)
        {
            $rombel=$r;
            break;
        }
        $nis=str_pad(auth()->user()->NIS,7,"0",STR_PAD_LEFT);
        $data_siswa=collect(DB::select('SELECT * FROM students WHERE NIS='.$nis.''))->first();
      
        $absensi_siswa=collect(DB::select('SELECT * FROM absensisiswa WHERE  id_rombel='.$request->id_rombel.' AND NIS='.$nis.''))->first();
 
        return view('absensisiswa',compact('rombel','absensi_siswa','data_siswa'));
    }

    public function rombel()
    {  
   
            $rombel=DB::select('SELECT * FROM data_rombel');
        
  
       
        return view ('admin.page.rombel',compact('rombel'));
    }
    
}
