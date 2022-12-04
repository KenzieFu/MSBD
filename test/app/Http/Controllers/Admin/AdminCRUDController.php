<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class AdminCRUDController extends Controller
{
    
    public function createSiswa(Request $request){
       $angkatan=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
    
        $nim=collect(DB::select('SELECT generate_nim('.$angkatan->angkatan.',no_urut('.$angkatan->angkatan.')) as res'))->first();
            $request->validate([
                'name' => 'required|string|max:255',
               
                'email' => 'required|string|email|max:255|',
                'Kota_Lahir'=>'required|string|max:255|',
                'alamat'=>'required|string|max:255|',
                'gender'=>'required',
                
            ]);
          
    
             $user = User::create([
                'name' => $request->name,
                'NIM'=>$nim->res,
                'email' => $request->email,
                'angkatan'=>$angkatan->angkatan,
                'Kota_Lahir'=>$request->Kota_Lahir,
                'alamat'=>$request->alamat,
                'gender'=>$request->gender,
                'password' => Hash::make($nim->res)
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
      
            return redirect('/admin/tabel-siswa') ->with('success',$nim->res);
    
           
    }
}
