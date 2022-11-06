<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Admin as admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function userTable(){
        $users=User::get();
        return view('admin.siswa',compact('users'));
    }
    public function teacherTable(){
        $teachers=Teacher::get();
        return view('admin.guru',compact('teachers'));
    }
    public function adminTable(){
        $admins=admin::get();
        return view('admin.admin',compact('admins'));
    }
}
