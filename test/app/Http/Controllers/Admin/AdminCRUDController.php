<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class AdminCRUDController extends Controller
{
    
    public function createSiswa(Request $request){
       $angkatan=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
       
    
        $nis=collect(DB::select('SELECT generate_nim('.$angkatan->angkatan.',no_urut('.$angkatan->angkatan.')) as res'))->first();
            $request->validate([
                'name' => 'required|string|max:255',
               
                'email' => 'required|string|email|max:255|',
                'Kota_Lahir'=>'required|string|max:255|',
                'alamat'=>'required|string|max:255|',
                'gender'=>'required',
                
            ]);
          
    
             $user = User::create([
                'name' => $request->name,
                'NIS'=>$nis->res,
                'email' => $request->email,
                'angkatan'=>$angkatan->angkatan,
                'Kota_Lahir'=>$request->Kota_Lahir,
                'alamat'=>$request->alamat,
                'gender'=>$request->gender,
                'id_kelas'=>$request->kelas,
                'password' => Hash::make($nis->res)
            ]); 
             /* $user = new User();
            $user->name=$request->name;
            $user->NIM=$nim;
            $user->email= $request->email;
            $user->angkatan=$angkatan->angkatan;
            $user->Kota_Lahir=$request->KotaLahir;
            $user->alamat=$request->alamat;
            $user->gender=$request->gender;
            $user->password="123";
            $user->save(); */
      
            return redirect('/admin/tabel-siswa') ->with('success',$nis->res);
    
           
    }
    public function createThnAk(Request $request){
        
             $thn=TahunAkademik::create([
                'TahunAjaran'=>$request->thn_ajaran,
                'kurikulum'=>$request->kurikulum
             ]);

             return redirect('/admin/thnak') ->with('success',"Tahun Ajaran Baru Berhasil dimasukkan");
     
            
     }

     public function updateStatusThnak(Request $request)
     {
        $thn=TahunAkademik::find($request->id);
        if($thn->status =="Aktif")
        {
            $thn->status="Tidak Aktif";
        }
        else
            $thn->status="Aktif";
       
        $thn->save();
            return redirect('/admin/thnak') ->with('success',"Status Berhasil Di update");
     }
}
