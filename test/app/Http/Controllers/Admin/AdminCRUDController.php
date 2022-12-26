<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\absensi_siswa;
use App\Models\Kelas;
use App\Models\NilaiSiswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rombel;
use App\Models\roster_rombel;
use App\Models\Announcement;
use App\Models\Teacher;
use App\Models\Mapel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;

class AdminCRUDController extends Controller
{
    public function listabsensiguru(Request $request)
    {
        $tahun=collect(DB::select('SELECT * FROM tahun_akademiks WHERE id='.$request->id_thnakademik.''))->first();
  
        $list=DB::select('SELECT * FROM view_daftar_absensi_guru WHERE id_thnakademik='.$request->id_thnakademik.'');

        return view('admin.page.CRUD.absensiguru',compact('list','tahun'));
    }

    public function createAnn(Request $request)
    {
        Announcement::create([
            'isi_pengumuman'=>$request->isi_pengumuman
        ]);
        return redirect()->back()->with('success','Berhasil Menambahkan Pengumuman');
    }

   
    
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
        
      
            return redirect('/admin/tabel-siswa') ->with('success',$nis->res);

    }
    public function deletePengumuman(Request $request)
    {
        $ann=Announcement::find($request->id_pengumuman);
        $ann->delete();

        return redirect()->back()->with('success','Pengumuman Berhasil Di Hapus');
    }


    public function createGuru(Request $request){
        $angkatan=DB::table("tahun_akademiks")->where("status","=","Aktif")->first();
        
     
         $nig=collect(DB::select('SELECT generate_nig('.$angkatan->angkatan.',no_urut_guru('.$angkatan->angkatan.')) as res'))->first();
        
             $request->validate([
                 'name' => 'required|string|max:255',
                
                 'email' => 'required|string|email|max:255|',
                 'alias'=>'required|string|max:255|',
                 'gender'=>'required',
                 
             ]);
           
     
              $teacher = Teacher::create([
                 'name' => $request->name,
                 'NIG'=>$nig->res,
                 'alias'=>$request->alias,
                 'email' => $request->email,
                 'angkatan'=>$angkatan->angkatan,
                 'Kota_Lahir'=>$request->Kota_Lahir,
                 'alamat'=>$request->alamat,
                 'gender'=>$request->gender,
             
                 'password' => Hash::make($nig->res)
             ]); 
             
          
       
             return redirect()->back()->with('success',$nig->res);
     
            
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
        $check=collect(DB::select('SELECT COUNT(*) as res FROM tahun_akademiks WHERE status="Aktif"'))->first();

       

        $thn=TahunAkademik::find($request->id);
        if($thn->status =="Aktif")
        {
            if($thn->Pembelajaran =="Selesai")
            {
                $thn->status="Tidak Aktif";
            }
            else if($thn->Pembelajaran =="Belum Selesai")
            {
                return redirect()->back()->with('success','Harus Menyelesaikan Tahun Ajaran Terlebih Dahulu');
            }
            
        }
        else
        {
            $thn->status="Aktif";
        }
            

        if($thn->status =="Aktif" && $check->res ==1 )
        {
            return redirect('/admin/thnak') ->with('success',"Tidak Boleh Mengaktifkan Dua Tahun Akademik");
        }
       
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

        $vcheck=collect(DB::select('SELECT id_guru as NIG from roster_rombels WHERE id_rombel='.$request->id_rombel.' AND id_mapel='.$request->id_mapel.' LIMIT 1'))->first();
            

        if($vcheck !=null)
        {
            if($vcheck->NIG != $request->id_guru )
            return redirect()->back()->with('success',"Satu Mapel Hanya Boleh diajari oleh satu guru saja");
        }
       
        
        $check=collect(DB::select('SELECT validasi_roster(-1,'.$request->id_rombel.',"'.$request->sesi1.'","'.$request->sesi2.'","'.$request->hari.'") as res'))->first();
 
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

     public function absensiSiswa(Request $request)
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
        return view('admin.page.absensi_siswa',compact('rombel','absensi_siswa'));

     }

     public function selesai_tahun_ajaran(Request $request)
     {
       

        $thn=TahunAkademik::find($request->id);
        if($thn->status =="Tidak Aktif")
        {
            return redirect()->back()->with('success','Tahun Ajaran '.$thn->TahunAjaran.' Belum Aktif');
        }
        else if($thn->status=="Aktif"){
            if($thn->Pembelajaran=="Belum Selesai")
            {
                $thn->Pembelajaran="Selesai";
                $thn->save();
                return redirect()->back()->with('success','Tahun Ajaran '.$thn->TahunAjaran.' Telah Diselesaikan');
            }
            else if($thn->Pembelajaran == "Selesai")
            {
                return redirect()->back()->with('success','Tidak Mengubah Pembelajaran Setelah Selesai');
            }

        }
       
       
     }

     ////////////CRUD 
     ///1. Table Students
        public function info_siswa(Request $request)
        {
            $siswa=collect(DB::select('SELECT s.*,k.nama_kelas,th.TahunAjaran FROM students s INNER JOIN kelas k ON k.id=id_kelas INNER JOIN tahun_akademiks th ON th.angkatan=s.angkatan WHERE NIS='.$request->id_siswa.''))->first();
           
            return view('admin.page.CRUD.info-siswa',compact('siswa'));
        }
        public function update_siswa(Request $request)
        {
            $siswa=collect(DB::select('SELECT s.*,k.nama_kelas FROM students s INNER JOIN kelas k ON k.id=id_kelas WHERE NIS='.$request->id_siswa.''))->first();
            $kelas=Kelas::get();
            return view('admin.page.CRUD.updatesiswa',compact('siswa','kelas'));
        }

        public function updt_siswa(Request $request)
        {
           
            $siswa=User::find($request->NIS);
          
            $siswa->name=$request->name;
            $siswa->gender=$request->gender;
            $siswa->SMP=$request->SMP;
            $siswa->id_kelas=$request->id_kelas;
            $siswa->Kota_Lahir=$request->Kota_Lahir;
            $siswa->alamat=$request->alamat;
            $siswa->save();

            return redirect()->back()->with('success','Siswa dengan NIS '.$siswa->NIS.' Berhasil Di Update');
        }

        public function delete_siswa(Request $request)
        {
            $siswa=User::find($request->id_siswa);
            $siswa->delete();
            return redirect()->back()->with('success','Siswa 0'.$siswa->NIS.' Berhasil di delete');
        }

        //2 Table Teachers

        public function info_guru(Request $request)
        {
            $guru=collect(DB::select('SELECT t.*, th.TahunAjaran FROM teachers t INNER JOIN tahun_akademiks th ON th.angkatan=t.angkatan WHERE NIG='.$request->id_guru.''))->first();
           
            return view('admin.page.CRUD.info-guru',compact('guru'));
        }

        public function update_guru(Request $request)
        {
            $guru=collect(DB::select('SELECT t.*, th.TahunAjaran FROM teachers t INNER JOIN tahun_akademiks th ON th.angkatan=t.angkatan WHERE NIG='.$request->id_guru.''))->first();
         
            return view('admin.page.CRUD.updateguru',compact('guru'));
        }

        public function updt_guru(Request $request)
        {
            $guru=Teacher::find($request->NIG);
            
            $guru->name=$request->name;
            $guru->alias=$request->alias;
            $guru->alamat=$request->alamat;
            $guru->Kota_Lahir=$request->Kota_Lahir;
            $guru->gender=$request->gender;
            $guru->save();
        
            return redirect()->back()->with('success','Guru dengan NIG '.$guru->NIG.' Berhasil Di Update');
            
        }

        public function delete_guru(Request $request)
        {
            $guru=Teacher::find($request->id_guru);
            $guru->delete();
            return redirect()->back()->with('success','Guru Berhasil di delete');
        }

        public function update_status_guru(Request $request)
        {
            $guru=Teacher::find($request->id_guru);
            if($guru->status == "Aktif")
                $guru->status="Tidak Aktif";
            else
                $guru->status="Aktif";
            
            $guru->save();
             return redirect()->back()->with('success','Status Guru Berhasil di update');
        }

        public function update_status_siswa(Request $request)
        {
            $siswa=User::find($request->NIS);
            if($siswa->status =="Aktif")
                $siswa->status="Tidak Aktif";
            else   
                $siswa->status="Aktif";
            
                $siswa->save();
             return redirect()->back()->with('success','Status Siswa Berhasil di Update');
        }


        //Table Kelas
        public function updt_kelas(Request $request)
        {
            $kelas=Kelas::find($request->id_kelas);
            $kelas->nama_kelas=$request->nama_kelas;
            $kelas->save();
            return redirect()->back()->with('success','Kelas berhasil diupdate');

        }

        public function delete_kelas(Request $request)
        {

            $kelas=Kelas::find($request->id_kelas);
            $kelas->delete();
            return redirect()->back()->with('success','Kelas Berhasil Dihapus');
        }
        public function createKelas(Request $request)
        {
            Kelas::create([
                'nama_kelas'=>$request->nama_kelas
            ]);
            return redirect()->back()->with('success','Kelas Berhasil Ditambah'); 
        }
        //4.Mapel

        public function createMapel(Request $request)
        {
            Mapel::create([
                'mapel'=>$request->mapel,
                'KKM'=>$request->KKM,
            ]);

            return redirect()->back()->with('success','Mapel Berhasil Ditambah'); 
        }

        public function updtMapel(Request $request)
        {
            $mapel=Mapel::find($request->id_mapel);
            $mapel->mapel=$request->mapel;
            $mapel->KKM=$request->KKM;
            $mapel->save();
            return redirect()->back()->with('success','Mapel Berhasil Diubah');
        }

        public function deleteMapel(Request $request)
        {
            $mapel=Mapel::find($request->id_mapel);
            $mapel->delete();

            return redirect()->back()->with('success','Mapel Berhasil Dihapus');
        }

        public function aktivasiMapel(Request $request)
        {
            $text="";
            $mapel=Mapel::find($request->id_mapel);
            if($mapel->status =="Aktif")
            {
                $mapel->status="Tidak Aktif";
                $text="Mapel Berhasil Di Nonaktifkan";
                
            }   
            else
            {
                $mapel->status="Aktif";
                $text="Mapel Berhasil Di Aktifkan";
  
            }

            $mapel->save();
            return redirect()->back()->with('success',$text);
            
                
        }

        //5.Rombel
        public function deleteRombel(Request $request)
        {
            $rombel=Rombel::find($request->id_rombel);
            $rombel->delete();

            return redirect()->back()->with('success','Rombel Berhasil di Delete');
        }

        public function updateWaliRombel(Request $request)
        {
 
          
            $rombel=Rombel::find($request->id_rombel);
            if($rombel->id_wali !=$request->id_wali)
            {
              
                $check= collect(DB::select('SELECT COUNT(*)as tes   FROM teachers t WHERE status="Aktif" AND  EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik ='.$request->id_thnakademik.' && r.id_wali='.$request->id_wali.')'))->first();
              
                 if($check->tes > 0)
                {
                    return redirect()->back()->with('success','Guru ini  telah menjadi wali kelas di kelas lain');
                }
            
            }
            
            $rombel->id_wali=$request->id_wali;
            
            $rombel->save();

            return redirect()->back()->with('success','Rombel Berhasil Di update');
        }
        public function deleteJadwal(Request $request)
        {
            $jadwal=roster_rombel::find($request->id_roster);
            $jadwal->delete();
            
            return redirect()->back()->with('success','Jadwal Berhasil Dihapus');
        }

        public function updateJadwal(Request $request)
        {
            $jadwal=roster_rombel::find($request->id_roster);
          /* dd($request->id_rombel,$request->id_mapel,$request->id_roster); */
            $vcheck=collect(DB::select('SELECT id_guru as NIG from roster_rombels WHERE id_rombel='.$request->id_rombel.' AND id_mapel='.$request->id_mapel.' AND id!='.$request->id_roster.' LIMIT 1'))->first();
            

            if($vcheck !=null)
            {
                if($vcheck->NIG != $request->id_guru )
                return redirect()->back()->with('success',"Satu Mapel Hanya Boleh diajari oleh satu guru saja");
            }
          
          
            

            $check=collect(DB::select('SELECT validasi_roster('.$request->id_roster.','.$request->id_rombel.',"'.$request->sesi1.'","'.$request->sesi2.'","'.$request->hari.'") as res'))->first();
        
            if($check->res  >0)
            {
                return redirect()->back()->with('success','Jadwal Kelas Tidak Bisa Dibuat Akibat Waktu Bentrok dengan Jadwal Lain Pada Hari tersebut');
            }
    
            $jadwal->id_guru=$request->id_guru;
            $jadwal->Hari=$request->hari;
            $jadwal->id_mapel=$request->id_mapel;
            $jadwal->sesi1=$request->sesi1;
            $jadwal->sesi2=$request->sesi2;
            $jadwal->save();

            return redirect()->back()->with('success','Jadwal Berhasil Di Ubah');
        }






}
