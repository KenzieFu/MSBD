<?php

use App\Http\Controllers\Admin\AdminCRUDController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController as TeacherAuth;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuth;
use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/',function()
{
    return view('auth.login');
});




Route::middleware(['auth','siswa'])->group(function(){
    Route::get('/dashboard',[SiswaController::class,'index'])->name('dashboard');
    Route::get('/profile',[SiswaController::class,'profile'])->name('profile');
    Route::post('/updtprofile',[SiswaController::class,'updtprofile'])->name('updtprofile');
    Route::get('/daftar-siswa-kelass',[SiswaController::class,'daftarsiswa'])->name('daftarsiswa');
    Route::get('/jadwal-kelas',[SiswaController::class,'jadwal_kelas'])->name('jadwal_kelas');
    Route::get('/nilai-siswa',[SiswaController::class,'nilaisiswa'])->name('nilaisiswa');
    Route::get('/absen-siswa',[SiswaController::class,'absensiswa'])->name('absensiswa');
    Route::get('/rekap-siswa',[SiswaController::class,'rekapkelas'])->name('rekapkelas');
    Route::get('/rekap-rombel',[SiswaController::class,'rombelsiswa'])->name('rombelsiswa');
    
});

require __DIR__.'/auth.php';








# Teacher panel routes (Route khusus untuk guru)

Route::prefix('/teacher')->name('teacher.')->group(function(){
    Route::get('/login',[TeacherAuth::class,'create'])->middleware('guest:teacher')->name('login');
    Route::post('/login',[TeacherAuth::class,'store'])->middleware('guest:teacher');

    Route::middleware(['teacher','auth'])->group(function(){
    Route::post('/logout',[TeacherAuth::class,'destroy'])->name('logout');
    Route::get('/dashboard',[TeacherController::class,'index'])->name('dashboard');
    Route::get('/wali-kelas',[TeacherController::class,'walikelas'])->name('walikelas');
    Route::get('/daftar-siswa-rombel',[TeacherController::class,'rombelsiswa'])->name('rombelsiswa');
    Route::get('/jadwal-kelas',[TeacherController::class,'jadwal_kelas'])->name('jadwal_kelas');
    Route::get('/absen-siswa',[TeacherController::class,'absensiswa'])->name('absensiswa');
    Route::post('/update-absensi-siswa',[TeacherController::class,'updtAbsensi'])->name('updtAbsensi');//Page  siswa di rombel tsb dengan button cek absensi
    Route::get('/nilai-siswa-per-rombel',[TeacherController::class,'nilaisiswa'])->name('nilaisiswa');//Page  siswa di rombel tsb dengan button cek nilai/input nilai
    Route::get('/nilai-siswa',[TeacherController::class,'lihatNilai'])->name('lihatNilai');//Page  siswa di rombel tsb nilai2 siswa

    Route::get('/jadwal-guru',[TeacherController::class,'jadwalGuru'])->name('jadwalGuru');//Page lihat jadwal guru pada tahun itu
        Route::get('/input-nilai',[TeacherController::class,'inputnilai'])->name('inputnilai');

    Route::get('/mapel-guru',[TeacherController::class,'mapelguru'])->name('mapelguru');
    Route::get('/updtnilai',[TeacherController::class,'updtnilai'])->name('updtnilai');

    Route::get('/rekap-wali-kelas',[TeacherController::class,'rekapwali'])->name('rekapwali');
    Route::get('/rekap-mapel-guru',[TeacherController::class,'rekapmapel'])->name('rekapmapel');

    
    });
});










# Admin panel routes (Route khusus untuk admin)

Route::prefix('/admin')->name('admin.')->group(function(){

    Route::get('/login',[AdminAuth::class,'create'])->middleware('guest:admin')->name('login');
    Route::post('/login',[AdminAuth::class,'store'])->middleware('guest:admin');
    



    Route::middleware(['admin','auth'])->group(function(){ // di grup agar hanya admin yang sudah login yang dapat mengaksesnya


        Route::post('/logout',[AdminAuth::class,'destroy'])->name('logout');


        //Halaman Pertama setelah login
        Route::get('/dashboard',[AdminViewController::class,'index']);
        ///////////////////////////

    // Page-Page admin yang menampilkan data2 table

    Route::get('/tabel-siswa',[AdminViewController::class,'userTable'])->name('tSiswa'); // Page Menampilkan daftar siswa
    Route::get('/tabel-guru',[AdminViewController::class,'teacherTable'])->name('tGuru'); //Page Menampilan daftar guru
    Route::get('/tabel-admin',[AdminViewController::class,'adminTable'])->name('tAdmin'); //Page Menampilkan daftar Admin

    Route::get('/thnak',[AdminViewController::class,'thnak'])->name('thnak'); //Page Tahun Akademik
    Route::get('/kelas',[AdminViewController::class,'kelas'])->name('kelas'); //Page daftar kelas
    Route::get('/rombel',[AdminViewController::class,'rombel'])->name('rombel'); //Page daftar rombel
    Route::get('/mapel',[AdminViewController::class,'mapel'])->name('mapel'); //Page daftar mapel
    Route::get('/roster/{id_rombel}',[AdminViewController::class,'jadwal_kelas'])->name('vroster'); //Page jadwal_mapel

    Route::get('/details-rombel/{id_rombel}',[AdminViewController::class,'detailsrombel'])->name('detailsrombel'); //Page details siswa di rombel tsb

    Route::get('/nilai-siswa-per-rombel',[AdminViewController::class,'nilaisiswa'])->name('nilaisiswa');//Page  siswa di rombel tsb dengan button cek nilai/input nilai
    Route::get('/absensi-siswa-per-rombel',[AdminViewController::class,'absensiSiswa'])->name('absensisiswa');//Page  siswa di rombel tsb dengan button cek absensi
    Route::post('/update-absensi-siswa',[AdminCRUDController::class,'absensiSiswa'])->name('abssiswa');//Page  siswa di rombel tsb dengan button cek absensi

    Route::get('/updateNilai',[AdminViewController::class,'updateNilai'])->name('updateNilai');//Page details nilai siswa di rombel tsb

    Route::post('/update-nilai',[AdminCRUDController::class,'updateNilai'])->name('updtNilai');//Page Update Nilai siswa

    Route::post('/update-pembelajaran',[AdminCRUDController::class,'selesai_tahun_ajaran'])->name('updatePembelajaran');



    //VIEW CRUD ADMIN
    //1.Students
    Route::get('/info-siswa',[AdminCRUDController::class,'info_siswa'])->name('info_siswa');
    Route::get('/update-siswa',[AdminCRUDController::class,'update_siswa'])->name('update_siswa');
    Route::post('/updt-siswa',[AdminCRUDController::class,'updt_siswa'])->name('updt_siswa');
    Route::post('/delete-siswa',[AdminCRUDController::class,'delete_siswa'])->name('delete_siswa');
    Route::post('/update-status-siswa',[AdminCRUDController::class,'update_status_siswa'])->name('usiswa');
    //2.Teachers
    Route::get('/create-guru',[AdminViewController::class,'pageAddGuru'])->name('cvGuru');
    Route::post('/create-guru',[AdminCRUDController::class,'createGuru'])->name('cGuru');
    Route::get('/info-guru',[AdminCRUDController::class,'info_guru'])->name('info_guru');
    Route::get('/update-guru',[AdminCRUDController::class,'update_guru'])->name('update_guru');
    Route::post('/updt-guru',[AdminCRUDController::class,'updt_guru'])->name('updt_guru');
    Route::post('/delete-guru',[AdminCRUDController::class,'delete_guru'])->name('delete_guru');
    Route::post('/update-status-guru',[AdminCRUDController::class,'update_status_guru'])->name('uguru');
    //3 Kelas
    Route::post('/create-kelas',[AdminCRUDController::class,'createKelas'])->name('createKelas');
    Route::post('/updt-kelas',[AdminCRUDController::class,'updt_kelas'])->name('updt_kelas');
    Route::post('/delete-kelas',[AdminCRUDController::class,'delete_kelas'])->name('delete_kelas');

    //4.Mapel
    Route::post('/create-mapel',[AdminCRUDController::class,'createMapel'])->name('createMapel');
    Route::post('/updt-mapel',[AdminCRUDController::class,'updtMapel'])->name('updtMapel');
    Route::post('/delete-mapel',[AdminCRUDController::class,'deleteMapel'])->name('deleteMapel');
    Route::post('aktivasi-mapel',[AdminCRUDController::class,'aktivasiMapel'])->name('aktivasiMapel');

    //5.Rombel
    Route::post('/delete-rombel',[AdminCRUDController::class,'deleteRombel'])->name('deleteRombel');
    Route::post('/update-wali-rombel',[AdminCRUDController::class,'updateWaliRombel'])->name('updateWaliRombel');
    Route::post('/delete-jadwal-rombel',[AdminCRUDController::class,'deleteJadwal'])->name('deleteJadwal');

    //6.Jadwal
    Route::get('/update-jadwal',[AdminViewController::class,'updateJadwal'])->name('updateJadwal');
    Route::post('/update-jadwal',[AdminCRUDController::class,'updateJadwal'])->name('updatesJadwal');


    //7.Pengumuman
    Route::get('/view-pengumuman',[AdminViewController::class,'pengumuman'])->name('view-pengumuman');
    Route::post('/delete-pengumuman',[AdminCRUDController::class,'deletePengumuman'])->name('deletePengumuman');
    Route::post('/create-pengumuman',[AdminCRUDController::class,'createAnn'])->name('createAnn');

    //8.Absensi-Guru
    Route::get('/view-absensi-guru',[AdminViewController::class,'thnabsensiguru'])->name('view-absensi-guru');
    Route::get('/update-absensi-guru',[AdminCRUDController::class,'listabsensiguru'])->name('list-absensi-guru');
    Route::post('/tambah-list-guru',[AdminCRUDController::class,'addlistguru'])->name('add-absensi-guru');
    Route::post('/update-absensi-guru',[AdminCRUDController::class,'updateabsensiguru'])->name('update-absensi-guru');
   
    



   
    




   

    

    ////////////////////////////////////////////////////


    //Pge form mendaftar akun/macam2 user

        //Create User
        Route::get('/create-siswa',[AdminViewController::class,'pageAddUser'])->name('cvSiswa');                //tampilan form
        Route::post('/create-siswa',[AdminCRUDController::class,'createSiswa'])->name('cSiswa');            //Input data 
        
        /////////////////////////////////////
        //Tahn Akademik
        Route::post('/create-thnak',[AdminCRUDController::class,'createthnak'])->name('cthnak'); //menginsert data ke table tahun_akademiks
        Route::post('/update-thnak',[AdminCRUDController::class,'updateStatusThnak'])->name('uthnak'); //update status thn akademik

        //Create Rombel
        Route::get('/create-rombel',[AdminViewController::class,'pageAddRombel'])->name('cvRombel');  
        Route::post('/create-rombel',[AdminCRUDController::class,'TambahRombel'])->name('cRombel');  
        //Create Jadwal
        Route::get('/create-page-jadwal/{id_rombel}',[AdminViewController::class,'pageAddJadwal'])->name('cvJadwal');
        Route::post('/create-jadwal',[AdminCRUDController::class,'TambahJadwal'])->name('cJadwal');
    


    //page report table
        Route::get('/laporan_siswa',[AdminViewController::class,'reportsiswa'])->name('tes');  //unfinish report siswa
        Route::get('/laporan_kelas',[AdminViewController::class,'reportkelas'])->name('tes1');  //unfinish report kelas
        Route::get('/laporan_mata_pelajaran',[AdminViewController::class,'reportmapel'])->name('tes2');  //unfinish report matpel
        Route::get('/laporan_guru',[AdminViewController::class,'reportteacher'])->name('tes3');  //unfinish report teacher

    //Create Akun
        Route::post('/create-akun-siswa',[AdminCRUDController::class,'buatAkunSiswa'])->name('buatAkunSiswa');
        Route::post('/delete-akun-siswa',[AdminCRUDController::class,'deleteAkunSiswa'])->name('deleteAkunSiswa');

        Route::post('/create-akun-guru',[AdminCRUDController::class,'buatAkunGuru'])->name('buatAkunGuru');
        Route::post('/delete-akun-guru',[AdminCRUDController::class,'deleteAkunGuru'])->name('deleteAkunGuru');

    
    //Tambah SIswa ke ROmbel
    Route::post('/tambah-siswa-rombel',[AdminCRUDController::class,'tambahSiswaRombel'])->name('tambahSiswaRombel');

    Route::post('/delete-siswa-rombel',[AdminCRUDController::class,'deleteSiswaRombel'])->name('deleteSiswaRombel');//hapus siswa dri rombel

    });

    
});