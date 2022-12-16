<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiSiswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rombel;
use App\Models\roster_rombel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

     public function TambahRombel(Request $request)
     {
        $thn=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        
        $check=DB::table('rombels')->where('id_thnakademik','=',$thn->id)->where('SMP','=',$request->SMP)->where('id_kelas','=',$request->kelas)->first();

        if($check)
        {
            return redirect('/admin/create-rombel') ->with('success',"Rombel Sudah Terdaftar");
        }
      
        Rombel::create([
            'id_thnakademik'=>$thn->id,
            'id_wali'=>$request->wali??null,
            'id_kelas'=>$request->kelas,
            'SMP'=>$request->SMP
        ]);
        return redirect('/admin/create-rombel') ->with('success',"Rombel Berhasil Dibuat");
     }

     public function TambahJadwal(Request $request)
     {
       
        
        $check=collect(DB::select('SELECT validasi_roster('.$request->id_rombel.',"'.$request->sesi1.'","'.$request->sesi2.'","'.$request->hari.'") as res'))->first();
        
        if($check->res  >0)
        {
            return redirect()->route('admin.cvJadwal',$request->id_rombel)->with('success','Jadwal Kelas Tidak Bisa Dibuat Akibat Waktu Bentrok dengan Jadwal Lain Pada Hari tersebut');
        }

        roster_rombel::create([
            "id_rombel"=>$request->id_rombel,
            "id_mapel"=>$request->id_mapel,
            "Hari"=>$request->hari,
            'id_guru'=>$request->id_guru,
            'sesi1'=>$request->sesi1,
            'sesi2'=>$request->sesi2,
        ]);
        
        return redirect()->route('admin.vroster',$request->id_rombel)->with('success','Jadwal Kelas Berhasil Ditambahkan');
        
     }

     public function updateNilai(Request $request)
     {
       /*  $data=[]; */

        for($x=0;$x<count($request->get('id'));$x++)
        {
            $nilai_siswa=NilaiSiswa::find($request->get('id')[$x]);
            $nilai_siswa->nilai=$request->get('nilai')[$x];
            $nilai_siswa->save();
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
        $data_siswa=collect(DB::select('SELECT * FROM students WHERE NIS='.$request->NIS.''))->first();
        $nilai_siswa=DB::select('SELECT * FROM nilai_mapel_siswa WHERE id_rsiswa='.$request->id_rsiswa.'');
        Session::flash('success', 'Nilai Siswa dengan NIS ('.$request->NIS.') Berhasil di update'); 
         return view('admin.page.CRUD.updateNilaiSiswa',compact('rombel','nilai_siswa','data_siswa'));
     }
}
