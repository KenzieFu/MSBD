<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController as TeacherAuth;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuth;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});


# Teacher panel routes

Route::prefix('/teacher')->name('teacher.')->group(function(){

    Route::get('/login',[TeacherAuth::class,'create'])->middleware('guest:teacher')->name('login');
    Route::post('/login',[TeacherAuth::class,'store'])->middleware('guest:teacher');
    Route::get('/logout',[TeacherAuth::class,'destroy'])->name('logout');
    Route::get('/dashboard',[TeacherController::class,'index'])->middleware('teacher');
});




# Admin panel routes

Route::prefix('/admin')->name('admin.')->group(function(){

Route::get('/login',[AdminAuth::class,'create'])->middleware('guest:admin')->name('login');
Route::post('/login',[AdminAuth::class,'store'])->middleware('guest:admin');
Route::get('/logout',[AdminAuth::class,'destroy'])->middleware('admin')->name('logout');
Route::get('/dashboard',[AdminController::class,'index'])->middleware('admin');

});