<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController as TeacherAuth;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuth;
use App\Http\Controllers\Admin\AdminController;
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



Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/',function()
{
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';






# Teacher panel routes

Route::prefix('/teacher')->name('teacher.')->group(function(){

    Route::get('/login',[TeacherAuth::class,'create'])->middleware('guest:teacher')->name('login');
    Route::post('/login',[TeacherAuth::class,'store'])->middleware('guest:teacher');
    Route::post('/logout',[TeacherAuth::class,'destroy'])->name('logout');
    Route::get('/dashboard',[TeacherController::class,'index'])->middleware('teacher');
});

# Admin panel routes

Route::prefix('/admin')->name('admin.')->group(function(){

    Route::get('/login',[AdminAuth::class,'create'])->middleware('guest:admin')->name('login');
    Route::post('/login',[AdminAuth::class,'store'])->middleware('guest:admin');
    
    Route::middleware('admin')->group(function(){
        Route::post('/logout',[AdminAuth::class,'destroy'])->name('logout');
    Route::get('/dashboard',[AdminController::class,'index']);
    Route::get('/tabel-siswa',[AdminController::class,'userTable']);
    Route::get('/tabel-guru',[AdminController::class,'teacherTable']);
    Route::get('/tabel-admin',[AdminController::class,'adminTable']);
    });
    
    
});