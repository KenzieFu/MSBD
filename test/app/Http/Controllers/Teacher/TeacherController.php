<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeacherController extends Controller
{
    public function index()
    {
        return view('teacher.dashboard');
    }

    public function walikelas()
    {

        
       $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       
       if($check->res == 0)
       {
        return redirect()->route('teacher.dashboard')->with('success','Tahun Ajaran Belum Dimulai');

       }

       
        $nig=str_pad(auth()->guard('teacher')->user()->NIG,7,"0",STR_PAD_LEFT);
        $rombel=collect(DB::select('SELECT * FROM data_rombel  '))->first();

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

}
