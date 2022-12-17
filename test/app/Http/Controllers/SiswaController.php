<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    
}
