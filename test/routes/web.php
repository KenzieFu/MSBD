<?php

use App\Http\Controllers\Admin\AdminCRUDController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController as TeacherAuth;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuth;
use App\Http\Controllers\Admin\AdminViewController;
use App\Http\Controllers\Teacher\TeacherController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';






# Teacher panel routes (Route khusus untuk guru)

Route::prefix('/teacher')->name('teacher.')->group(function(){
    Route::get('/login',[TeacherAuth::class,'create'])->middleware('guest:teacher')->name('login');
    Route::post('/login',[TeacherAuth::class,'store'])->middleware('guest:teacher');
    Route::post('/logout',[TeacherAuth::class,'destroy'])->name('logout');
    Route::get('/dashboard',[TeacherController::class,'index'])->middleware('teacher');
});








# Admin panel routes (Route khusus untuk admin)

Route::prefix('/admin')->name('admin.')->group(function(){

    Route::get('/login',[AdminAuth::class,'create'])->middleware('guest:admin')->name('login');
    Route::post('/login',[AdminAuth::class,'store'])->middleware('guest:admin');
    



    Route::middleware('admin')->group(function(){ // di grup agar hanya admin yang sudah login yang dapat mengaksesnya


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
    Route::get('/roster',[AdminViewController::class,'daftarRoster'])->name('vroster'); //Page daftar mapel

    Route::post('/details-rombel',[AdminViewController::class,'detailsrombel'])->name('detailsrombel'); //Page details rombel
   

    

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

    });

    
    
    
});